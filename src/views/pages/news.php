<!-- Вывод новостей на экран -->
<?php foreach ($news as $row): ?>
	<p><h2><?php echo $row['article_date']; ?></h2></p>
	<p><h2><?php echo $row['rubric']; ?></h2></p>
	<p><h2><?php echo $row['article_title']; ?></h2></p>
	<img src="<?php echo "/".$row['image']."" ?>"> <br> 
	<?php echo $row['article_short_text']; ?><br>
	<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
		<!-- Удаление, редактирование записи - Delete and edit of record -->
		<?php if ($_SESSION['role'] == "admin"): ?>
			<form method="post">
				<input type='hidden' name="del_id" value="<?php echo $row['id']; ?>">
				<input name="button_del" value="Удалить" type="submit">
				<input type='hidden' name="edit_id" value="<?php echo $row['id']; ?>">
				<a href='/index.php?page_name=editor_page&edit_id=<?php echo $row['id']; ?>'>Изменить информацию </a>
			</form>
		<?php	endif; ?>

		<!-- Likes -->
		<form method="post">
			<input type='hidden' name="id" value="<?php echo $row['id']; ?>">
			<input type='hidden' name="like" value="<?php echo $row['count_of_likes']; ?>">
			<button  name="image_go" value="image_go" type="submit" style="background: #fdeaa8; border: none; margin: 0; padding: 0; border-radius: 0px"><img src="like.jpg"  width="100" height="40"></button> <b><?php echo $row['count_of_likes']; ?></b>
		</form> 
	<?php endif; ?>	
	<!-- Исключения при оценке новости -->
	<?php	if (isset($exLike)): ?> 
		<h2 class="redcolor"><?php echo $exLike; ?></h2>
	<?php	endif; ?>  
	<br> 
<?php endforeach; ?>
<!-- Постраничная навигация -->
<?php	require __DIR__ . '/../pagination/newsPagination.php'; ?>





