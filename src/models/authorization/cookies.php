<?php
	/*
		Если пользователь не авторизован, проверим его куки, 
		если в куках есть логин и ключ,
		то роверим их по базе данных.
		Если пара логин-ключ подходит -  авторизуем пользователя.
		Если пользователь авторизован - ничего не делаем. 
	*/
	if (empty($_SESSION['auth']) or $_SESSION['auth'] == false) {
		//Проверяем, не пустые ли нужные нам куки - If a cookies is not empty
		if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']) ) {
			//Сохраняем логин и ключ из КУК в переменные - Save the username and key from the COOKIE to the variables
			$login = $_COOKIE['login']; 
			$key = $_COOKIE['key']; //ключ из кук (аналог пароля в базе данных)
			//ВЫБРАТЬ ИЗ таблицы users ГДЕ поле_логин = $login
			$sql = 'SELECT*FROM users WHERE login="'.$login.'" AND cookie="'.$key.'"';
			$sth = $basa->query($sql);
			$rowUser = $sth->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива - String of array

			//Если база данных вернула не пустой ответ - значит пара логин-ключ к кукам подошла
			//If the database returned not empty response - login and key from cookies no true
			if (!empty($rowUser)) {
				//Сохраняем в сессию информацию о том, что мы авторизовались
				$_SESSION['auth'] = true; 
				//Пишем в сессию логин и id пользователя (их мы берем из переменной $user)
				$_SESSION['id'] = $rowUser['id']; 
				$_SESSION['login'] = $rowUser['login']; 
				//$_SESSION['password'] = $rowUser['password']; 
				//$_SESSION['role'] = $rowUser['role']; 
			}
		}
	}