<?php
// Авторизация - Authorization
// получаем информацию из БД и сравниваем с введенной пользователем - Get the information from the database and compare with input user data
if (isset($_POST['submit'])) {
	try {
		//Если поля логин и пароль заполнены - If the fields username and password filled
		if (!empty($_REQUEST['password']) and !empty($_REQUEST['login'])) {
			$login = $_REQUEST['login']; 
			$password = $_REQUEST['password']; 

			//Формируем и отсылаем SQL запрос: ВЫБРАТЬ ИЗ таблицы_users ГДЕ поле_логин = $login
			$sql = 'SELECT * FROM users WHERE login="'.$login.'"';
			$sth = $basa->query($sql);
			//$sth = $basa->prepare($sql); 
			//$sth->execute();
			$rowUser = $sth->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива
			//var_dump($rowUser);
			
			try {
				//Если база данных вернула не пустой ответ - значит такой логин есть
				//If the database returned a non-empty answer, it means this login exist
				if (isset($rowUser['login'])) {
					$salt = $rowUser['salt'];
					//солим пароль из формы - Salt the password from the form
					$saltedPassword = md5($password.$salt);
					try {
						//Если соленый пароль из базы данных совпадает с соленым паролем из формы
						//If salt password from the database matches with the salted password from the form
						if ($rowUser['password'] == $saltedPassword) {
							//открываем сессию
							//session_start(); 
							//echo "secret page";
							//echo "Вы успешно вошли в систему под именем1 ".$_SESSION['login'];
							//Пишем в сессию информацию о том, что мы авторизовались
							$_SESSION['auth'] = true; 
							// Пишем в сессию логин и id пользователя (их мы берем из $rowUser)
							// Write to the session information about avtorization
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
								//ОБНОВИТЬ  таблицу users УСТАНОВИТЬ cookie = $key ГДЕ login=$login.
								$sql = 'UPDATE users SET cookie="'.$key.'" WHERE login="'.$login.'"';
								$keys = $basa->query($sql);
								//echo $key;
							}
							//счетчик сессий - Counter sessions
							if (!isset($_SESSION['count'])) {
								$_SESSION['count'] = 0;
							}	
							else {
								$_SESSION['count']++;  
							}
							
						}
						else {
							//Генерируем исключение - Generate the exception
							//Если соленый пароль из базы НЕ совпадает с соленым паролем из формы
							//Выводим сообщение 'Неправильный логин или пароль'.
						     throw new Exception('Не верно введен логин или пароль');
						}
					}
					catch (Exception $ex3) {
							//Выводим сообщение об исключении - Print the exception message
							$exAvtoriz3 = $ex3->getMessage();
					}
				}
				//Иначе такого логина в базе данных нет		
				else {
					//Генерируем исключение - Generate the exception
					//Если соленый пароль из базы НЕ совпадает с соленым паролем из формы
					//Выводим сообщение 'Неправильный логин или пароль'.
					throw new Exception('Пользователь с таким именем не зарегистрирован');
				}
			}
			catch (Exception $ex4) {
				//Выводим сообщение об исключении - Print the exception message
				$exAvtoriz4 = $ex4->getMessage();
			}
		}
		else {
			// Generate the exception
			throw new Exception('Запоните все поля!');
		}
	}
	catch (Exception $ex8) {
		//Выводим сообщение об исключении - Print the exception message
		$exAvtoriz8 = $ex8->getMessage();
	}
}