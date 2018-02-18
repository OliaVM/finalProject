<!-- Удаление, изменение записи -->
<?php if ($_SESSION['role'] == "admin"): ?>
	<?php foreach ($news as $row): ?>
		<br> 
		<p><h2><?php echo $row['id']; ?></h2></p>
		<p><h2><?php echo $row['article_date']; ?></h2></p>
		<p><h2><?php echo $row['rubric']; ?></h2></p>
		<p><h2><?php echo $row['article_title']; ?></h2></p>
		<img src="<?php echo "/".$row['image']."" ?>"> <br>  
		<?php echo $row['article_short_text']; ?><br>
		<?php echo $row['article_full_text']; ?><br>
		<?php echo "<br>"; ?>
		<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
			<form method="post">
				<input type='hidden' name="del_id" value="<?php echo $row['id']; ?>">
				<input name="button_del" value="Удалить" type="submit">
				<input type='hidden' name="edit_id" value="<?php echo $row['id']; ?>">
				<a href='/index.php?page_name=editor_page&edit_id=<?php echo $row['id']; ?>'>Изменить информацию </a>
			</form>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

