<?php if (!isset($_SESSION['password'])): ?>
	<div align="center"><h2>Регистрация на сайте:</h2>
		<form  method="post">
			Логин: <input type="text" name="login"><br><br>
			Пароль: <input type="password" name="password"><br><br>
			email: <input type="email" name="email"><br>
			<input type="submit" name="submit">
		</form>
	</div>
<?php else: echo "Вы уже авторизованы"; ?>
<?php endif; ?>
<div>




