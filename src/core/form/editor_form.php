<!-- Редактирование записи -->
<?php if (!empty($_GET['red_id'])): ?>
	<?php foreach ($row5 as $row): ?>
	    <form method="POST">
			<br> 
			<p><h2><?php echo $row['id']; ?></h2></p>
			<p><h2><?php echo $row['data']; ?></h2></p>
			Выберите название рубрики: 
		 	<input type="text" name="theme" value="<?php echo $row['rubrika']; ?>"><br>
			Введите название статьи (объемом до 150 знаков): 
			<input type="text" name="title" size="152" maxlength="150" value="<?php echo $row['article_name']; ?>"><br>
			Введите текст статьи (объемом до 7000 знаков): <br>
			<textarea name="message" rows="10" cols="50" maxlength="7000"><?php echo $row['article_text']; ?></textarea><br>
			<input type="submit" name="go_edit" value="загрузить на сервер"><br>
		</form>
	<?php endforeach; ?>
<?php endif; ?>


