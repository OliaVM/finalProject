<?php
//вывод информации из БД на страницы
if (isset($rubric)) {
	if (isset($_GET['page'])) { 
		// число статей, выводимых на станице 
		// Получаем из URL номер текущей страницы 
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