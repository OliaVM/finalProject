<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
	<!-- Доступно всем зарегистрированным пользователям - is available to all registered users -->
	<h2><?php echo "Вы успешно вошли в систему под именем ".$_SESSION['login']; // Выводим сообщение, что пользователь авторизирован ?> </h2>
	<h2><?php echo "id= ".$_SESSION['id']; ?> </h2>
	<h2> secret text </h2><br>
	bla bla bla  <br>
	bla bla bla <br>
	<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
	<?php require_once __DIR__ . '/../../../core/form/exit_button.php' ?>
<?php endif; ?>	

