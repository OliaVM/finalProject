<?php	
$rubric = $_GET['theme'];
//	echo $rubric;
?>
<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php $sql2 = "SELECT * FROM articles WHERE rubrika='$rubric'"; ?> 
<?php $news_list = $basa->query($sql2); ?>
<?php require '/var/www/html/myproject/common/news_list.php'; ?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 



