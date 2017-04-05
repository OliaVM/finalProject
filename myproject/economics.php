<?php require_once  'header.php'; ?> 
<?php	
				//Подключение к базе данных
				$pathToConfig = __DIR__ . '/../config/app.php';
				$oConfig = new Config($pathToConfig);
				//$countOfNews = $oConfig->get('count_of_news');
				$dbConfig = $oConfig->get('db');
				$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
				
				//вывод информации из БД на экран
				$sql2 = "SELECT * FROM articles WHERE rubrika='Экономика'"; 
				printTableBd($basa, $sql2);
									
?>
<?php require_once  'footer.php'; ?> 




