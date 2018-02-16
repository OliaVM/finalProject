<!-- Информация, доступная после авторизации - Information available after authorization -->
<?php require '/var/www/html/src/views/views_for_authorized_users/protected_text.php'; ?>
<!-- Авторизация - Authorization -->
<?php require '/var/www/html/src/core/form/avtorization_form.php'; ?>
<!-- Исключения при авторизации - Exception during the authorization attempt -->
<?php	if (isset($exAvtoriz)): ?> 
		<h2 class="redcolor"><?php echo $exAvtoriz; ?></h2>
<?php	endif; ?> 
<a href="/index.php">Перейти на главную страницу</a> 





