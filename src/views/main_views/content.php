	<!-- Доступно неавторизованным пользователям -->
	<?php echo "<h2>" . "Добавление новости" . "</h2>"; ?>
	<!-- Форма ввода новостей пользователем -->		
	<?php require '/var/www/html/src/core/form/add_news_form.php'; ?>
	<!-- Исключения при добавлении новости -->
	<?php	if (isset($x)): ?> 
		<?php echo "<h2>" . $x . "</h2>"; ?>
	<?php	endif; ?> 
	<?php	if (isset($x2)): ?>  
		<?php echo "<h2>" . $x2 . "</h2>"; ?>
	<?php	endif; ?> 
</div>
<div>
	<?php require '/var/www/html/src/views/pages/news.php'; ?> 
						
					

