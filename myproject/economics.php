<?php require_once  'header.php'; ?> 
<?php	
		
				$sql2 = "SELECT * FROM articles WHERE rubrika='Экономика'"; 
				printTableBd($basa, $sql2);
									
?>
<?php require_once  'footer.php'; ?> 




