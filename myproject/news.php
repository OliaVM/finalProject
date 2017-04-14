<?php	
$rubric = $_GET['theme'];
//echo $rubric;
?>
						
<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php if (isset($_SESSION['login']) && isset($_SESSION['id'])): ?>
						<?php session_start(); ?> 

						<h2><?php echo "Вы успешно вошли в систему под именем ".$login; // Выводим сообщение, что пользователь авторизирован ?> </h2>
						<h2> bla bla bla </h2>
						<br>
						bla bla bla 
						<br>
						bla bla bla 
						<br>
						<!-- Выводим кнопку выхода -->
						<form  method="post">
							<input type="submit" name="exit" value="выход">
						</form>
		
<?php endif; ?>				
<?php require '/var/www/html/myproject/common/news_list.php'; ?>
<?php	require '/var/www/html/src/core/pagination/newsPagination.php'; ?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 




