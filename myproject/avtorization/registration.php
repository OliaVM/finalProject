<?php
// регистрация - Registration
//Отправляем в базу данных информацию из формы - Sent information to the database from the form
if (isset($_POST['submit2'])) {
	try {
		//Если форма регистрации отправлена и ВСЕ поля непустые - If the registration form is sent and all fields are not empty
		if (!empty($_REQUEST['password2']) and !empty($_REQUEST['login2']) and !empty($_REQUEST['email2'])) {
			$login = $_REQUEST['login2']; 
			$password = $_REQUEST['password2']; 
			$email = $_REQUEST['email2']; 
					
			// Выполняем проверку на незанятость логина. Ответ базы данных запишем в переменную $row
			// Performs the validation to freedom login. The response from the database record into a variable $row
			$sql = 'SELECT * FROM users  WHERE login="'.$login.'"';
			$isLoginFree = $basa->query($sql);
			$row = $isLoginFree->fetch(PDO::FETCH_ASSOC);
			//print_r($row);
			
			try {
				//Если $row пустой - то логин не занят! - If $row is empty - the login is free
				if (!isset($row['login'])) {
					//Генерируем соль с помощью функции generateSalt() и солим пароль
					//Generate the salt using the function generateSalt() and salt the password
					$salt = generateSalt(); 
					$saltedPassword = md5($password.$salt); 

					// Добавляем в базу данных информацию из формы - Added information to the database from the form
					$sql2 = 'INSERT INTO users SET login="'.$login.'", role ="user", password="'.$saltedPassword.'", salt="'.$salt.'", email="'.$email.'"';
					$prep = $basa->prepare($sql2);
					$basa->query($sql2);
					//сообщение об успешной регистрации - The message about the successful registration
					echo 'Вы успешно зарегистрированы!';
				}
				//Если $row НЕ пустой - то логин занят! - - If $row is not empty - the login is not free
				else {
					//Генерируем исключение - Generate the exception
			        throw new Exception('Этот логин уже занят!');
		     	}
			}
			catch (Exception $ex6) {
				//Выводим сообщение об исключении - Print the exception message
				$exRegistration6 = $ex6->getMessage();
			}
		}
		//Не заполнено какое-либо из полей - Not filled any of the fields
		else {
			//Генерируем исключение - Generate the exception
	        throw new Exception('Заполните все поля!');
     	}
	}
	catch (Exception $ex5) {
		//Выводим сообщение об исключении - Print the exception message
		$exRegistration5 = $ex5->getMessage();
	}
}




