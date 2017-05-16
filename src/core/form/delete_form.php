<!-- Удаление, изменение записи -->
<?php if ($_SESSION['role'] == "admin"): ?>
	<?php foreach ($news as $row): ?>
		<br> 
		<p><h2><?php echo $row['id']; ?></h2></p>
		<p><h2><?php echo $row['data']; ?></h2></p>
		<p><h2><?php echo $row['rubrika']; ?></h2></p>
		<p><h2><?php echo $row['article_name']; ?></h2></p>
		<img src="<?php echo "http://myproject.local/".$row['image']."" ?>"> <br>  
		<?php echo $row['article_text']; ?><br>
		<?php echo "<br>"; ?>
		<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
			<form method="post">
				<input type='hidden' name="del_id" value="<?php echo $row['id']; ?>">
				<input name="button_del" value="Удалить" type="submit">
				<input type='hidden' name="red_id" value="<?php echo $row['id']; ?>">
				<a href='http://myproject.local/administrator_page/editor.php?red_id=<?php echo $row['id']; ?>'>Изменить информацию </a>
			</form>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>

