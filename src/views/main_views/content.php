	<!-- Доступно неавторизованным пользователям -->
	<?php echo "<h2>" . "Добавление новости" . "</h2>"; ?>
	<!-- Форма ввода новостей пользователем -->		
	<?php require __DIR__ . '/../../core/form/add_news_form.php'; ?>
	<!-- Исключения при добавлении новости -->
	<?php	if (isset($exAdd)): ?> 
		<h2 class="redcolor"><?php echo $exAdd; ?></h2>
	<?php	endif; ?> 
	<?php	if (isset($x2)): ?>  
		<h2 class="redcolor"><?php echo $x2; ?></h2>
	<?php	endif; ?> 
</div>
<div>
	<?php require __DIR__ . '/../pages/news.php'; ?> 
	<!-- Постраничная навигация -->
	<?php	require __DIR__ . '/../pagination/contentPagination.php'; ?>		
					

