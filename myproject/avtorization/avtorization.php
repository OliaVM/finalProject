<?php
// авторизация
// получаем информацию из БД и сравниваем с введенной полььзователем
//Если форма авторизации отправлена...
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
	
	//Если база данных вернула не пустой ответ - значит такой логин есть...
	if (isset($rowUser['login'])) {
		$salt = $rowUser['salt'];
		//Посолим пароль из формы:
		$saltedPassword = md5($password.$salt);
			
		//Если соленый пароль из базы данных совпадает с соленым паролем из формы...
		if ($rowUser['password'] == $saltedPassword) {
			//открываем сессию
			//session_start(); 
			//echo "secret page";
			//echo "Вы успешно вошли в систему под именем1 ".$_SESSION['login'];
			//Пишем в сессию информацию о том, что мы авторизовались:
			$_SESSION['auth'] = true; 

			// Пишем в сессию логин и id пользователя (их мы берем из $rowUser)
			$_SESSION['id'] = $rowUser['id']; 
			$_SESSION['login'] = $rowUser['login']; 
			$_SESSION['password'] = $rowUser['password']; 
			$_SESSION['role'] = $rowUser['role']; 
			if (!isset($_SESSION['count'])) {
				$_SESSION['count'] = 0;
			}	
			else {
				$_SESSION['count']++;  
			}
		}
		//Если соленый пароль из базы НЕ совпадает с соленым паролем из формы
		//Выводим сообщение 'Неправильный логин или пароль'.
		else {
			echo "не верно введен логин или пароль";
			/*
			echo "<br>";
			echo "saltedPassword= ".$saltedPassword;
			echo "<br>";
			echo "rowUser['password']=" . $rowUser['password'];
			echo "<br>";
			echo " md salt =" . md5($salt);
			*/
		}
	} else {
		echo "пользователь с таким именем не зарегистрирован";
	}
}