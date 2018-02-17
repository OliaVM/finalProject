<?php if (!isset($_SESSION['password'])): ?>
	<div align="center"><h2>Регистрация на сайте:</h2>
		<form  method="post">
			Логин: <input type="text" name="login"><br><br>
			Пароль: <input type="password" name="password"><br><br>
			email: <input type="email" name="email"><br>
			<input type="submit" name="submit">
		</form>
	</div>
<?php else: //echo "<script language='javascript'> alert('Вы уже авторизованы!'); </script>"; ?>
	<h2 class='redcolor'><?php echo "Вы уже авторизованы!"; ?></h2>
<?php endif; ?>
<div>




