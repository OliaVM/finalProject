					    <?php require '/var/www/html/src/core/form/add_news_form.php'; ?>
					</div>
					<div>
			 
			 <?php	if (isset($x)): ?> 
				<?php echo "<h2>" . $x . "</h2>";?>
			<?php	endif; ?> 
			<?php	if (isset($x2)): ?>  
				<?php echo "<h2>" . $x2 . "</h2>";?>
			<?php	endif; ?> 
			<?php	require '/var/www/html/myproject/common/news_list.php'; ?> 
			<?php	require '/var/www/html/src/core/pagination/contentPagination.php'; ?>

