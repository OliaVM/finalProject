					<?php //if (!isset($row) && !isset($rowUser)): ?>
					<?php if (!isset($_SESSION['password'])): ?>
						<div align="center"><h2>Регистрация на сайте:</h2>
							<form  method="post">
								Логин: <input type="text" name="login2"><br><br>
								Пароль: <input type="password" name="password2"><br><br>
								email: <input type="email" name="email2"><br>
								<input type="submit" name="submit2">
							</form>
						</div>
					<?php else: echo "Вы уже авторизованы"; ?>
					<?php endif; ?>
					<div>




