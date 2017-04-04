<?php require_once __DIR__ . '/../header.php'; ?> 
<?php	
				if (isset($_POST['go'])) {
					if (isset($_POST['theme']) && isset($_POST['title']) && isset($_POST['message']) && isset($ourimage)) {
						if(!empty($_POST['theme']) && !empty($_POST['title']) && !empty($_POST['message'])) {
							$sql2 = "SELECT * FROM articles WHERE rubrika='Россия'"; 
							printTableBd($basa, $sql2);
						}
					}
					if (isset($x)) { // выполняем исключение, если оно есть
						echo $x;
					}
					if (isset($x2)) { // выполняем исключение, если оно есть
						echo $x2;
					}
				}
?>
<?php require_once __DIR__ . '/../footer.php'; ?> 




