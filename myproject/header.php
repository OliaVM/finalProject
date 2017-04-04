<?php
//Добавление картинки
if(isset($_POST["go"])){
	try {
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			require_once __DIR__ . '/../src/core/functions/uploadImage.php';
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
				require_once __DIR__ . '/../src/core/functions/GetFullNowDateInCity.php';
				$data = GetFullNowDateInCity(7);

				require_once __DIR__ . '/../src/core/classes/Config.php';
				require_once __DIR__ . '/../src/core/functions/db.php';
				$pathToConfig = __DIR__ . '/../config/app.php';
				//Подключение к базе данных
				$oConfig = new Config($pathToConfig);
				//$countOfNews = $oConfig->get('count_of_news');
				$dbConfig = $oConfig->get('db');
				$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);

				//Добавление информации в базу данных
				require_once __DIR__ . '/../src/core/functions/submitDb.php';
				$sql="INSERT INTO articles(rubrika, article_name, data, image, article_text) VALUES (?, ?, '$data', '$ourimage', ?)"; 
				submitDb ($basa, $sql);
				//вывод инф.
				require_once __DIR__ . '/../src/core/functions/printTableBd.php';
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
	  <link href="style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	  <link href="style/style.css" rel="stylesheet" type="text/css"/>
	  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	  <script type="text/javascript" src="js/bootstrap.min.js"></script>
	   <meta name="viewport" content="width=device-width, initial-scale = 1.0">
	   <link type="text/css" rel="stylesheet" href="style/bootstrap-responsive.css">
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
				<li><a href="/index.php">Главная</a></li>
				<li><a href="russia.php">Россия</a></li>
				<li><a href="world.php">Мир</a></li>
				<li><a href="economics.php">Экономика</a></li>
				<li><a href="science.php">Наука</a></li>
				<li><a href="culture.php">Культура</a></li>
				<li><a href="sport.php">Спорт</a></li>
				<li><a href="travel.php">Путешествия</a></li>
			</ul>
		</div>

		<div class="span10" id="box8">
			<div>
				<h1>Your news line</h1>
			</div>
			<div>
			    
