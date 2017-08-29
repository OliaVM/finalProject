<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
						<!-- Вход под ролью администратора - The input under the administrator role -->
						<?php if ($_SESSION['role'] == "admin"): ?>
							<div> 
								<a href="http://myproject.local/administrator_page/admin_page.php">Перейти на страницу администратора</a>
							</div>
						<!-- Вход под ролью редактора The input under the editor role-->
						<?php elseif ($_SESSION['role'] == "editor"): ?>
							<div> 
								<a href="http://myproject.local/administrator_page/editor_page.php">Перейти на страницу редактора</a>
							</div>
						<?php endif; ?>
						<!-- Доступно всем зарегистрированным пользователям - is available to all registered users -->
						<h2><?php echo "Вы успешно вошли в систему под именем ".$_SESSION['login']; // Выводим сообщение, что пользователь авторизирован ?> </h2>
						<h2><?php echo "id= ".$_SESSION['id']; ?> </h2>
						<h2> secret text </h2><br>
						bla bla bla  <br>
						bla bla bla <br>
						<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
						<?php require_once '/var/www/html/src/core/form/exit_button.php' ?>
<?php endif; ?>	

