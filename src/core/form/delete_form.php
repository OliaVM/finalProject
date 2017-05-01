<!-- Удаление, изменение записи -->
<?php foreach ($news as $row): ?>
	<br> 
	<p><h2><?php echo $row['id']; ?></h2></p>
	<p><h2><?php echo $row['data']; ?></h2></p>
	<p><h2><?php echo $row['rubrika']; ?></h2></p>
	<p><h2><?php echo $row['article_name']; ?></h2></p>
	<img src="<?php echo "http://myproject.local/".$row['image']."" ?>"> <br>  
	<?php echo $row['article_text']; ?><br>
	<?php echo "<br>"; ?>
	<p><a href="http://myproject.local/administrator_page/delete_information.php?del_id=<?php echo $row['id'];?>">Удалить</a></p>
	<a href='http://myproject.local/administrator_page/editor.php?red_id=<?php echo $row['id']; ?>'>Изменить информацию </a>
<?php endforeach; ?>