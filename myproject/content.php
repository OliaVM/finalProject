						<!-- Информация, доступная после авторизации -->
						<?php require '/var/www/html/myproject/avtorization/protected_text.php'; ?>
						<!-- Авторизация -->
						<?php require '/var/www/html/src/core/form/avtorization_form.php'; ?>
						<!-- Регистрация -->	
						<?php require '/var/www/html/src/core/form/registration_form.php'; ?>	
						<!-- Форма ввода новостей пользователем -->		
						<?php require '/var/www/html/src/core/form/add_news_form.php'; ?>
						<!-- Доступно неавторизованным пользователям -->
						<!-- Исключения -->
						<?php	if (isset($x)): ?> 
							<?php echo "<h2>" . $x . "</h2>";?>
						<?php	endif; ?> 
						<?php	if (isset($x2)): ?>  
							<?php echo "<h2>" . $x2 . "</h2>";?>
						<?php	endif; ?> 
					</div>
					<div>
						<?php require '/var/www/html/myproject/common/news_list.php'; ?> 
						<?php require '/var/www/html/src/core/pagination/contentPagination.php'; ?>
					

