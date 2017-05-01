<?php
// регистрация
//Отправляем в базу данных информаию из формы 
if (isset($_POST['submit2'])) {
	//Если форма регистрации отправлена и ВСЕ поля непустые...
	if (!empty($_REQUEST['password2']) and !empty($_REQUEST['login2']) and !empty($_REQUEST['email2'])) {
		$login = $_REQUEST['login2']; 
		$password = $_REQUEST['password2']; 
		$email = $_REQUEST['email2']; 
				
		// Выполняем проверку на незанятость логина. Ответ базы данных запишем в переменную $row. 
		$sql = 'SELECT * FROM users  WHERE login="'.$login.'"';
		$isLoginFree = $basa->query($sql);
		$row = $isLoginFree->fetch(PDO::FETCH_ASSOC);
		//print_r($row);
		
		//Если $row пустой - то логин не занят!
		if (!isset($row['login'])) {
			//Генерируем соль с помощью функции generateSalt() и солим пароль
			$salt = generateSalt(); 
			$saltedPassword = md5($password.$salt); 

			// Добавляем в базу данных информаию из формы
			$sql2 = 'INSERT INTO users SET login="'.$login.'", role ="user", password="'.$saltedPassword.'", salt="'.$salt.'", email="'.$email.'"';
			$prep = $basa->prepare($sql2);
			$basa->query($sql2);
			//сообщение об успешной регистрации
			echo 'Вы успешно зарегистрированы!';
		}
		//Если $isLoginFree НЕ пустой - то логин занят!
		else {
			echo 'Этот логин уже занят!';
		}
	}
	//Не заполнено какое-либо из полей
	else {
		echo 'Заполните все поля!';
	}
}




