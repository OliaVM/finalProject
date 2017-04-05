<?php require_once   '/var/www/html/myproject/header.php'; ?> 
<?php	
					//Подключение к базе данных
					$pathToConfig = '/var/www/html/config/app.php';
					$oConfig = new Config($pathToConfig);
					//$countOfNews = $oConfig->get('count_of_news');
					$dbConfig = $oConfig->get('db');
					$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
					
					//вывод информации из БД на экран
					$sql2 = "SELECT * FROM articles WHERE rubrika='Мир'"; 
					printTableBd($basa, $sql2);
					
?>
<?php require_once    '/var/www/html/myproject/footer.php'; ?> 




