<!-- Редактирование записи -->
<?php if ($_SESSION['role'] == "admin"): ?>
	<?php if (isset($_GET['red_id'])): ?>
		<?php foreach ($article_row as $row): ?>
		    <form method="POST">
				<br> 
				<p><h2><?php echo $row['id']; ?></h2></p>
				<p><h2><?php //echo $row['article_date']; ?></h2></p>
				Выберите название рубрики: 
			 	<input type="text" name="rubric" value="<?php echo $row['rubric']; ?>"><br>
				Введите название статьи (объемом до 150 знаков): 
				<input type="text" name="article_title" size="152" maxlength="150" value="<?php echo $row['article_title']; ?>"><br>
				Введите краткий текст статьи (объемом до 500 знаков): <br>
				<textarea name="article_short_text" rows="10" cols="50" maxlength="500"><?php echo $row['article_short_text']; ?></textarea><br>
				Введите текст статьи (объемом до 5000 знаков): <br>
				<textarea name="article_full_text" rows="10" cols="50" maxlength="5000"><?php echo $row['article_full_text']; ?></textarea><br>
				<input type="submit" name="go_edit" value="загрузить на сервер"><br>
			</form>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>


