<?php	
$rubric = $_GET['theme'];
//echo $rubric;
?>
<?php require_once '/var/www/html/myproject/common/header.php'; ?> 		
<!-- Информация, доступная после авторизации -->
<?php require '/var/www/html/myproject/avtorization/protected_text.php'; ?>	
<!-- Вывод списка новостей -->	
<?php require '/var/www/html/myproject/common/news_list.php'; ?>
<!-- Постраничная навигация -->
<?php	require '/var/www/html/src/core/pagination/newsPagination.php'; ?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 




