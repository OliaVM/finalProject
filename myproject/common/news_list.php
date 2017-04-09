<?php foreach ($news as $row): ?>
	<br> 
	<p><h2><?php echo $row['data']; ?></h2></p>
	<p><h2><?php echo $row['rubrika']; ?></h2></p>
	<p><h2><?php echo $row['article_name']; ?></h2></p>
	<img src="<?php echo $row['image'] ?>"> <br> 
	<?php echo $row['article_text']; ?><br>
	<?php echo "<br>"; ?>
<?php endforeach; ?>


