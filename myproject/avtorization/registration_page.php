						<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
						<!-- Регистрация  - Registration -->	
						<?php require '/var/www/html/src/core/form/registration_form.php'; ?>
						<!-- Исключения при регистрации - Exception during the registration attempt -->
						<?php	if (isset($exRegistration5)): ?> 
							<h2 class="redcolor"><?php echo $exRegistration5; ?></h2>
						<?php	endif; ?> 
						<?php	if (isset($exRegistration6)): ?>  
							<h2 class="redcolor"><?php echo $exRegistration6; ?></h2>
						<?php	endif; ?>

						<a href="/index.php">Перейти на главную страницу</a>  
						<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 




