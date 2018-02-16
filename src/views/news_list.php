	<!-- Вывод новостей на экран -->
	<?php foreach ($news as $row): ?>
	<br> 
	<p><h2><?php echo $row['data']; ?></h2></p>
	<p><h2><?php echo $row['rubrika']; ?></h2></p>
	<p><h2><?php echo $row['article_name']; ?></h2></p>
	<img src="<?php echo "http://myproject.local/".$row['image']."" ?>"> <br> 
	<?php echo $row['article_text']; ?><br>
	<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
		<form method="post">
			<input type='hidden' name="id" value="<?php echo $row['id']; ?>">
			<input type='hidden' name="like" value="<?php echo $row['like_number']; ?>">
			<button  name="image_go" value="image_go" type="submit" style="background: #fdeaa8; border: none; margin: 0; padding: 0; border-radius: 0px"><img src="like.jpg"  width="100" height="40"></button> <b><?php echo $row['like_number']; ?></b>
		</form>
	<?php endif; ?>	
	<!-- Исключения при оценке новости -->
	<?php	if (isset($exLike)): ?> 
		<h2 class="redcolor"><?php echo  $exLike; ?></h2>
	<?php	endif; ?>  
	<br> 
	<?php endforeach; ?>



