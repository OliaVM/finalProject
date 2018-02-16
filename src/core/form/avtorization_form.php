						<?php if (!isset($_SESSION['password'])): ?>
						<?php //if ($_SESSION['auth'] == false): ?>
							<div align="center"><h2>Для авторизации на сайте введите данные:</h2>
								<form  method="post">
									Логин: <input type="text" name="login"><br>
									Пароль: <input type="password" name="password"><br>
									Запомнить меня: <input name='remember' type='checkbox' value='1'><br>
									<input type="submit" name="submit" value='Отправить'><br>
								</form>
							</div>
						<?php endif; ?> 





