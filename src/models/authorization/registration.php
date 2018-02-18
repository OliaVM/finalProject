<?php
// регистрация - Registration
//Отправляем в базу данных информацию из формы - Sent information to the database from the form
try {
	//Не заполнено какое-либо из полей - Not filled any of the fields
	if (isset($_POST['submit_regisration'])) {
		//Если форма регистрации отправлена и ВСЕ поля непустые - If the registration form is sent and all fields are not empty
		if (empty($_REQUEST['password']) || empty($_REQUEST['login']) || empty($_REQUEST['email'])) {
			throw new Exception('Заполните все поля!');
		}
		$login = $_REQUEST['login']; 
		$password = $_REQUEST['password']; 
		$email = $_REQUEST['email']; 
				
		// Выполняем проверку на незанятость логина. Ответ базы данных запишем в переменную $row
		// Performs the validation to freedom login. The response from the database record into a variable $row
		$sql = 'SELECT * FROM users WHERE login=:login';
		$prep = $сonnection_db->prepare($sql);
		$prep->bindValue(':login', $login, PDO::PARAM_STR);
		$prep->execute(); 
		$row = $prep->fetch(PDO::FETCH_ASSOC);

		//Если $row НЕ пустой - то логин занят! - - If $row is not empty - the login is not free
		if ($login == $row['login']) {
			throw new Exception('Этот логин уже занят!');
     	}
     	//Если $row пустой - то логин не занят! - If $row is empty - the login is free
		//Генерируем соль с помощью функции generateSalt() и солим пароль
		//Generate the salt using the function generateSalt() and salt the password
		$salt = generateSalt(); 
		$saltedPassword = md5($password.$salt); 

		// Добавляем в базу данных информацию из формы - Added information to the database from the form
		$sql2 = 'INSERT INTO users SET login = :login, role = "user", password= :saltedPassword, salt= :salt, email = :email';
		$prep2 = $сonnection_db->prepare($sql2);
		$prep2->bindValue(':login', $login, PDO::PARAM_STR);
		$prep2->bindValue(':saltedPassword', $saltedPassword, PDO::PARAM_STR);
		$prep2->bindValue(':salt', $salt, PDO::PARAM_STR);
		$prep2->bindValue(':email', $email, PDO::PARAM_STR);
		$prep2->execute(); 
		//The message about the successful registration
		echo 'Вы успешно зарегистрированы!';
	}
}
catch (Exception $ex_registration) {
	$exRegistration = $ex_registration->getMessage();
}

