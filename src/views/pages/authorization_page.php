<!-- Информация, доступная после авторизации - Information available after authorization -->
<?php require __DIR__ . '/protected_page/protected_text.php'; ?>
<!-- Авторизация - Authorization -->
<?php require __DIR__ . '/../../core/form/avtorization_form.php'; ?>
<!-- Исключения при авторизации - Exception during the authorization attempt -->
<?php	if (isset($exAvtoriz)): ?> 
		<h2 class="redcolor"><?php echo $exAvtoriz; ?></h2>
<?php	endif; ?> 
<a href="/index.php">Перейти на главную страницу</a> 





