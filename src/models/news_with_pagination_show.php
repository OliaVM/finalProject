<?php
//вывод информации из БД на страницы -  display of information from database  on pages
//$rubric = $_GET['rubric'];
if (isset($rubric)) {
	echo "aa";
	var_dump($rubric);
	if (isset($_GET['page'])) { 
		// число статей, выводимых на станице - the count of articles, displayed on the page
		$num = 3; 
		// Получаем из URL номер текущей страницы - Get the current page number from the URL
		$page = $_GET['page']; 
		// Определяем общее число статей в базе данных - Define the total count of articles in the database
		$query=$basa->query("SELECT id FROM articles WHERE rubric='$rubric'");
		$posts =$query->rowCount();
		//echo $posts . "<br>";
			
		// Находим общее число страниц - Find the total count of pages
		$total = ceil($posts / $num); 
		//echo $total. "<br>"; 
		// ceil - Округляет дробь в большую сторону, если
		//на последней странице будет меньшее количество записей, чем на остальных.
		//если не будет делиться без остатка

		// Вычисляем c какого номера следует выводить статьи на данной странице 
		// Calculated what the number of article is start of page
		$start = $page * $num - $num;  // нумерация начинается с 0
		//echo $start . "=start";
		// Выбираем количество статей $num начиная с номера $start 
		// Choose the number of articles $num starting with number $start
		$sql2 = "SELECT * FROM articles WHERE rubrikc='$rubric' LIMIT $start, $num"; 
		$news = getNewsList($basa, $sql2);
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
	//echo $posts;

	// Находим общее число страниц - Find the total count of pages
	$total = ceil($posts / $num); 
	//echo $total; //4
	// ceil - Округляет дробь в большую сторону, если
	//на последней странице будет меньшее количество записей, чем на остальных.
	//если не будет делиться без остатка

	// Вычисляем c какого номера следует выводить статьи на данной странице
	// Calculated what the number of article is start of page 
	$start = $page * $num - $num;  // нумерация начинается с 0
	//echo $start;
	// Choose the number of articles $num starting with number $start
	// Выбираем количество статей $num начиная с номера $start 
	$sql2 = "SELECT * FROM articles LIMIT $start, $num";
	$news = getNewsList($basa, $sql2);
}
else {
	$sql2 = "SELECT * FROM articles"; 
	$news = getNewsList($basa, $sql2);
}