<?php
// Authorization
// получаем информацию из БД и сравниваем с введенной пользователем - Get the information from the database and compare with input user data
try {
	if (isset($_POST['submit'])) {
		//Если поля логин и пароль заполнены - If the fields username and password filled
		if (empty($_REQUEST['password']) || empty($_REQUEST['login'])) {
			throw new Exception('Запоните все поля!');
		}
		$login = $_REQUEST['login']; 
		$password = $_REQUEST['password']; 
		$sql = 'SELECT * FROM users WHERE login="'.$login.'"';
		$sth = $basa->query($sql);
		//$sth = $basa->prepare($sql); 
		//$sth->execute();
		$rowUser = $sth->fetch(PDO::FETCH_ASSOC); 
		
		//Если база данных вернула не пустой ответ - значит такой логин есть
		//If the database returned a non-empty answer, it means this login exist
		if (!isset($rowUser['login'])) {
			throw new Exception('Пользователь с таким именем не зарегистрирован');
		}
		//солим пароль из формы - Salt the password from the form
		$salt = $rowUser['salt'];
		$saltedPassword = md5($password.$salt);
		
		//Если соленый пароль из базы НЕ совпадает с соленым паролем из формы, Выводим сообщение 'Неправильный логин или пароль'.
		if ($rowUser['password'] !== $saltedPassword) {		
		    throw new Exception('Не верно введен логин или пароль');
		}
		//Если соленый пароль из базы данных совпадает с соленым паролем из формы
		//If salt password from the database matches with the salted password from the form
		//Пишем в сессию информацию об авторизации
		// Write to the session information about avtorization
		$_SESSION['auth'] = true; 
		$_SESSION['id'] = $rowUser['id']; 
		$_SESSION['login'] = $rowUser['login']; 
		$_SESSION['password'] = $rowUser['password']; 
		$_SESSION['role'] = $rowUser['role']; 

		//Проверяем была ли нажата галочка 'Запомнить меня'
		//Verify whether the checkbox 'Remember me' is clicked 
		if ( !empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 ) {
			//формируем ключ 
			$key = generateSalt(); //назовем ее $key
			//Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
			setcookie('login', $rowUser['login'], time()+60*60*24*30); 
			setcookie('key', $key, time()+60*60*24*30); 
			//обновляем таблицу users 
			$sql = 'UPDATE users SET cookie="'.$key.'" WHERE login="'.$login.'"';
			$keys = $basa->query($sql);
		}
		//счетчик сессий - Counter sessions
		if (!isset($_SESSION['count'])) {
			$_SESSION['count'] = 0;
		}	
		else {
			$_SESSION['count']++;  
		}	
	}
}
catch (Exception $ex) {
	//Выводим сообщение об исключении - Print the exception message
	$exAvtoriz = $ex->getMessage();
}


function generateSalt() {
		$salt = '';
		$saltLength = 8; //длина соли
		for($i=0; $i<$saltLength; $i++) {
			$salt .= chr(mt_rand(33,126)); //символ из ASCII-table 
			//Функция chr() используется для получения символа из кодировке ASCII 
			return $salt;
		}
}