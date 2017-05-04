<?php //if ((!isset($_SESSION['login']) || !isset($_SESSION['id'])) && !isset($_GET['exit']) && !isset($_POST['reg'])): ?>
						<div align="center"><h2>Для авторизации на сайте введите данные:</h2>
							<form  method="post">
								Логин: <input type="text" name="login"><br>
								Пароль: <input type="password" name="password"><br>
								Запомнить меня: <input name='remember' type='checkbox' value='1'><br>
								<input type="submit" name="submit" value='Отправить'><br>
								Если вы не зарегистрированы: <input type="submit" name="reg" value="Зарегистрироваться">
							</form>
						</div>
<?php	//endif; ?> 




