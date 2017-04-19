<?php
session_start();
/*
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	echo "Вы успешно вошли в систему1: ".$_SESSION['login'] ."<br>";
}
*/
/*
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	if (isset($_GET['exit'])) { // если пользователь нажал на "exit"
		//session_start();
		//unset($_SESSION['password']); // Очищаем сессию пароля
		//unset($_SESSION['login']); // Очищаем сессию логина
		//unset($_SESSION['id']); // Очищаем сессию id
		unset($_SESSION['count']);
		//echo "login ".$_SESSION['login']; 
	}
}
*/
require_once '/var/www/html/src/autoload.php';
$pathToConfig = '/var/www/html/config/app.php';
$oConfig = new Config($pathToConfig);
//$countOfNews = $oConfig->get('count_of_news');
//Подключение к БД
$dbConfig = $oConfig->get('db');
$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
//if($basa){
//echo 'Соединение установлено.';}
//else{
//die('Ошибка подключения к серверу баз данных.');}

//вывод информации из БД на страницы
if (isset($rubric)) {
	if (isset($_GET['page'])) { 
		// число статей, выводимых на станице 
		// Получаем из URL номер текущей страницу 
		$num = 3; 
		$page = $_GET['page']; 
		// Определяем общее число статей в базе данных 
		$query=$basa->query("SELECT id FROM articles WHERE rubrika='$rubric'");
		$posts =$query->rowCount();
		//echo $posts . "<br>";
			
		// Находим общее число страниц 
		$total = ceil($posts / $num); 
		//echo $total. "<br>"; 
		// ceil - Округляет дробь в большую сторону, если
		//на последней странице будет меньшее количество записей, чем на остальных.
		//если не будет делиться без остатка

		// Вычисляем c какого номера следует выводить статьи на данной странице 
		$start = $page * $num - $num;  // нумерация начинается с 0
		//echo $start . "=start";
		// Выбираем количество статей $num начиная с номера $start 
		$sql2 = "SELECT * FROM articles WHERE rubrika='$rubric' LIMIT $start, $num"; 
		$news = getNewsList($basa, $sql2);
	}
}
//вывод информации из БД на главную страницу
else if (isset($_GET['page'])) { 
	// число статей, выводимых на станице 
	// Получаем из URL номер текущей страницу 
	$num = 7; 
	$page = $_GET['page']; 
	// Определяем общее число статей в базе данных 
	$query=$basa->query("SELECT id FROM articles");
	$posts =$query->rowCount();
	//echo $posts;

	// Находим общее число страниц 
	$total = ceil($posts / $num); 
	//echo $total; //4
	// ceil - Округляет дробь в большую сторону, если
	//на последней странице будет меньшее количество записей, чем на остальных.
	//если не будет делиться без остатка

	// Вычисляем c какого номера следует выводить статьи на данной странице 
	$start = $page * $num - $num;  // нумерация начинается с 0
	//echo $start;
	// Выбираем количество статей $num начиная с номера $start 
	$sql2 = "SELECT * FROM articles LIMIT $start, $num";
	//$sql2 = "SELECT * FROM articles"; 
	$news = getNewsList($basa, $sql2);
}
else {
	$sql2 = "SELECT * FROM articles"; 
	$news = getNewsList($basa, $sql2);
}

// Работа с базой данных
if(isset($_POST["go"])){
	//Добавление картинки
	try {
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$uploaddir = 'images/'; 	// это папка, в которую будет загружаться картинка
			$nameOfimage=date('YmdHis').rand(100,1000).'.jpg'; 	// это имя, которое будет присвоенно изображению 
			$ourimage = uploadImage($uploaddir, $nameOfimage);
		}
		else {
		//Генерируем исключение
        throw new Exception('Добавьте картинку!');
     	}
    }
	catch (Exception $ex1) {
		//Выводим сообщение об исключении.
		$x = $ex1->getMessage();
	}

	// Работа с базой данных: добавление даты,  текстовой информации
	if (isset($_POST['theme']) && isset($_POST['title']) && isset($_POST['message']) && isset($ourimage)) {
		try {
			if(!empty($_POST['theme']) && !empty($_POST['title']) && !empty($_POST['message'])){
				// Добавление даты публикации
				$data = GetFullNowDateInCity(7);
				
				//Добавление информации в базу данных
				$sql="INSERT INTO articles(rubrika, article_name, data, image, article_text) VALUES (?, ?, '$data', '$ourimage', ?)"; 
				submitDb ($basa, $sql);
			}
			else {
				//Генерируем исключение
        		throw new Exception('Заполните все поля!');
			}
		}
		catch (Exception $ex) {
			//Выводим сообщение об исключении.
			$x2 = $ex->getMessage();
		}
	}
}
	
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
			$sql2 = 'INSERT INTO users SET login="'.$login.'", password="'.$saltedPassword.'", salt="'.$salt.'", email="'.$email.'"';
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

?>

<!DOCTYPE html>
<html lang="ru">
	<head>
	  <meta charset="UTF-8">
	  <link href="/style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	  <link href="/style/style.css" rel="stylesheet" type="text/css"/>
	  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
	  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
	  <link type="text/css" rel="stylesheet" href="/style/bootstrap-responsive.css">
	</head>
	<body>
	<div class="row-fluid" id="header">
		<div class="span12" id="box12">
			<h1>News line</h1>
		</div>
	</div>

	<div class="container-fluid">
	  <div class="row-fluid">
	    <div class="span2" id="box4" id="menu"> 
			<ul>
				<li><a href="/index.php?page=1">Главная</a></li>
				<li><a href="/news.php?theme=russia&page=1">Россия</a></li>
				<li><a href="/news.php?theme=world&page=1">Мир</a></li>
				<li><a href="/news.php?theme=economics&page=1">Экономика</a></li>
				<li><a href="/news.php?theme=science&page=1">Наука</a></li>
				<li><a href="/news.php?theme=culture&page=1">Культура</a></li>
				<li><a href="/news.php?theme=sport&page=1">Спорт</a></li>
				<li><a href="/news.php?theme=travel&page=1">Путешествия</a></li>
			</ul>
		</div>

		<div class="span10" id="box8">
			<div>
				<h1>Your news line</h1>
			</div>
			<div>
			    
