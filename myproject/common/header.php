<?php
session_start();
/*
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	echo "Вы успешно вошли в систему1: ".$_SESSION['login'] ."<br>";
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

//вывод информации из базы данных на страницы (c постраничной навигацией)
require_once '/var/www/html/myproject/common/news_with_pagination_show.php';
// Работа с базой данных: 
//Занесение в базу картинки и текстовой информации, добавленных пользователем; текущей даты,вычисленной с помощью функции 
require_once '/var/www/html/myproject/common/work_with_databases.php';

//счетчик лайков
require_once '/var/www/html/myproject/common/likes_counter.php';

//авторизация	
require_once '/var/www/html/myproject/avtorization/avtorization.php';
// регистрация
require_once '/var/www/html/myproject/avtorization/registration.php';
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
			    
