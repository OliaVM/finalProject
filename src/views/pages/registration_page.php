<!-- Регистрация  - Registration -->	
<?php require '/var/www/html/src/core/form/registration_form.php'; ?>
<!-- Исключения при регистрации - Exception during the registration attempt -->
<?php	if (isset($exRegistration)): ?> 
	<h2 class="redcolor"><?php echo $exRegistration; ?></h2>
<?php	endif; ?> 
<a href="/index.php">Перейти на главную страницу</a>  
						




