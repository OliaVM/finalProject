<?php //if ((!isset($_SESSION['login']) || !isset($_SESSION['id'])) && !isset($_GET['exit']) && !isset($_POST['reg'])): ?>
						<div align="center"><h2>Для авторизации на сайте введите данные:</h2>
							<form  method="post">
								Логин: <input type="text" name="login"><br>
								Пароль: <input type="password" name="password"><br>
								<input type="submit" name="submit">
								<br>
								<input type="submit" name="reg" value="Зарегистрироваться">
							</form>
						</div>
<?php	//endif; ?> 




