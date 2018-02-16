<?php
//вывод информации из БД на страницы -  display of information from database  on pages
if (isset($rubric)) {
	if (isset($_GET['page'])) { 
		// число статей, выводимых на станице - the count of articles, displayed on the page
		$num = 3; 
		// Получаем из URL номер текущей страницы - Get the current page number from the URL
		$page = $_GET['page']; 
		// Определяем общее число статей в базе данных - Define the total count of articles in the database
		$query=$basa->query("SELECT id FROM articles WHERE rubric='$rubric'");
		$posts =$query->rowCount();
		// Находим общее число страниц - Find the total count of pages
		$total = ceil($posts / $num); 
		// ceil - Округляет дробь в большую сторону, если на последней странице будет меньшее количество записей, чем на остальных. Т.е. если не будет делиться без остатка
		// Вычисляем c какого номера следует выводить статьи на данной странице 
		// Calculated what the number of article is start of page
		$start = $page * $num - $num;  // нумерация начинается с 0
		// Выбираем количество статей $num начиная с номера $start 
		// Choose the number of articles $num starting with number $start
		$sql = "SELECT * FROM articles WHERE rubric='$rubric' LIMIT $start, $num"; 
		$news = $basa->query($sql);
	}
}
//вывод информации из БД на главную страницу - display of information from database on main page
else if (isset($_GET['page'])) { 
	// число статей, выводимых на станице - the count of articles, displayed on the page
	$num = 7; 
	// Получаем из URL номер текущей страницу - Get the current page number from the URL
	$page = $_GET['page']; 
	// Определяем общее число статей в базе данных - Define the total count of articles in the database
	$query=$basa->query("SELECT id FROM articles");
	$posts =$query->rowCount();
	// Находим общее число страниц - Find the total count of pages
	$total = ceil($posts / $num); 
	// Calculated what the number of article is start of page 
	$start = $page * $num - $num;  // нумерация начинается с 0
	$sql = "SELECT * FROM articles LIMIT $start, $num";
	$news = $basa->query($sql);
}
else {
	$sql = "SELECT * FROM articles"; 
	$news = $basa->query($sql);
}
