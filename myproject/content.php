					    <?php require '/var/www/html/src/core/form/add_news_form.php'; ?>
					</div>
					<div>
			 <?php	
			  	if (isset($x)) { // выполняем исключение, если оно есть
						echo "<h2>" . $x . "</h2>";
				}
				if (isset($x2)) { // выполняем исключение, если оно есть
						echo "<h2>" . $x2 . "</h2>";
				}

			?>
			<?php $sql2 = "SELECT * FROM articles"; ?>
			<?php $news_list = $basa->query($sql2); ?>
			<?php require '/var/www/html/myproject/common/news_list.php'; ?>


