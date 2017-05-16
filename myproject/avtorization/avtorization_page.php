<?php require_once '/var/www/html/myproject/common/header.php'; ?> 	
<!-- Информация, доступная после авторизации - Information available after authorization -->
<?php require '/var/www/html/myproject/avtorization/protected_text.php'; ?>
<!-- Авторизация - Authorization -->
<?php require '/var/www/html/src/core/form/avtorization_form.php'; ?>
<!-- Исключения при авторизации - Exception during the authorization attempt -->
<?php	if (isset($exAvtoriz3)): ?> 
		<h2 class="redcolor"><?php echo $exAvtoriz3; ?></h2>
<?php	endif; ?> 
<?php	if (isset($exAvtoriz4)): ?>  
		<h2 class="redcolor"><?php echo $exAvtoriz4; ?></h2>
<?php	endif; ?> 
<?php	if (isset($exAvtoriz8)): ?>  
		<h2 class="redcolor"><?php echo $exAvtoriz8; ?></h2>
<?php	endif; ?> 
<a href="/index.php">Перейти на главную страницу</a> 
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 




