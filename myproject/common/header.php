<?php
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
if (isset($rubric)){
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

//Добавление картинки
if(isset($_POST["go"])){
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

// Работа с базой данных
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
			    
