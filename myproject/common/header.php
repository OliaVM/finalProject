<?php
session_start();
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
	
// авторизация
// получаем информацию из БД и сравниваем с введенной полььзователем
if (isset($_POST['submit'])) { // Отлавливаем нажатие кнопки "Отправить"
	if (empty($_POST['login'])) { // Если поле логин пустое
		echo '<script>alert("Поле логин не заполнено");</script>'; // То выводим сообщение об ошибке
	}
	elseif (empty($_POST['password'])) { // Если поле пароль пустое
		echo '<script>alert("Поле пароль не заполнено");</script>'; // То выводим сообщение об ошибке
	}
	else { // Иначе если все поля заполненны
		$login = $_POST['login']; // Записываем логин в переменную 
		$password = $_POST['password']; // Записываем пароль в переменную           
		
		$result1 = $basa->query("SELECT id FROM users WHERE login = '$login' and password = '$password'"); 
		// запрос к базе данных с проверкой пользователя
		$row = $result1->fetch(PDO::FETCH_ASSOC); //Выбираем одну строку из результирующего набора и помещаем ее в ассоциативный массив
				
		if (!empty($row['id'])) {
			if (!isset($_SESSION['count'])) {
					$_SESSION['count'] = 0;
			}	
			else {
					$_SESSION['count']++;  
			}
			$_SESSION['password'] = $password; // Заносим в сессию  пароль
			$_SESSION['login'] = $login; // Заносим в сессию  логин
			$_SESSION['id'] = $row['id']; // Заносим в сессию  id
			echo "Вы успешно вошли в систему2: ".$_SESSION['login']; // Выводим сообщение что пользователь авторизирован  
			//echo "id " . $_SESSION['id']; 
			//echo "POST['login] " . $_POST['login'];
			echo "count= " . $_SESSION['count'];
			$sessionPass = $_SESSION['password']; 
			$sessionLog = $_SESSION['login']; 
			$sessionId = $_SESSION['id'];
			//Header("Location: protected.php");  // перенаправляем на protected.php
		else {
			echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
		}
	}  
}

// регистрация
//Отправляем в базу данных информаию из формы 
if (isset($_POST['submit2'])) {//Отлавливаем нажатие на кнопку отправить  
		if (empty($_POST['login2'])) {  // Условие - если поле логин пустое
			echo "<script>alert('Поле логин не заполнено');</script>"; // Выводим сообщение об ошибке
		}          
		elseif (empty($_POST['password2'])) { // Иначе если поле с паролем пустое
			echo "<script>alert('Поле пароль не заполнено');</script>"; // Выводим сообщение об ошибке
		} 
		elseif (empty($_POST['email2'])) { // Иначе если поле с паролем пустое
			echo "<script>alert('Поле email не заполнено');</script>"; // Выводим сообщение об ошибке
		}                          
		else { 
			//if (isset($_POST['login2']) & isset($_POST['password2']) & isset($_POST['email2']))
			// Иначе если поля не пустые
			$login2 = $_POST['login2']; // Присваиваем переменной значение из поля с логином             
			$password2 = $_POST['password2']; // Присваиваем другой переменной значение из поля с паролем
			$email2 = $_POST['email2'];
			$sql3="INSERT INTO users (login, password, email) VALUES ('$login2', '$password2', '$email2')"; 
			$prep = $basa->prepare($sql3);
			//$arr = $prep->execute(array("$_POST['login2']", "$_POST['password2']", "$_POST['email2']"));
			$arr = $basa->query($sql); // Запрос к базе данных - отпарляем данные пользователя
			//echo "Регистрация прошла успешно!"; 
			//var_dump($prep);
			//var_dump($arr );
			echo "<br>";
			$sql4 = "SELECT * FROM users"; 
			foreach ($basa->query($sql4) as $row) {
						echo "<br>"; 
						echo $row['login'] . "<br>" ;
						echo $row['password'] . "<br>" ;
						echo $row['email'] . "<br>" ;
						echo "<br>"; 
			}
		}
} 
//if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	if (isset($_GET['exit'])) { // если пользователь нажал на "exit"
		//session_start();
		//unset($_SESSION['password']); // Очищаем сессию пароля
		//unset($_SESSION['login']); // Очищаем сессию логина
		//unset($_SESSION['id']); // Очищаем сессию id
		unset($_SESSION['count']);
		//echo "login ".$_SESSION['login']; 
	}
//}
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
			    
