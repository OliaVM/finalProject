					    
					<?php	if (isset($x)): ?> 
						<?php echo "<h2>" . $x . "</h2>";?>
					<?php	endif; ?> 
					<?php	if (isset($x2)): ?>  
						<?php echo "<h2>" . $x2 . "</h2>";?>
					<?php	endif; ?> 
					<!-- Доступно авторизованным пользователм -->
					<!-- если в сессии загружены логин и id -->
					<?php if (isset($_SESSION['login']) && isset($_SESSION['id'])): ?> 
						<?php session_start(); ?> 
						<?php if (!isset($_SESSION['count'])): ?> 
						  <?php $_SESSION['count'] = 0;?> 
						
						<?php  else: ?> 
						  <?php $_SESSION['count']++; ?> 
						<?php endif; ?> 
						<h2><?php echo "Вы успешно вошли в систему под именем ".$login; // Выводим сообщение что пользователь авторизирован ?> </h2>
						
						<h2><?php echo "id " . $row['id']; ?> </h2>
						<h2> bla bla bla </h2>
						<br>
						bla bla bla 
						<br>
						bla bla bla 
						<br>
						<!-- Выводим кнопку выхода -->
						<form  method="post">
							<input type="submit" name="exit" value="выход">
						</form>
					<?php endif; ?>
					<!-- Доступно неавторизованным пользователм -->
					<?php if ((!isset($_SESSION['login']) || !isset($_SESSION['id'])) && !isset($_GET['exit']) && !isset($_POST['reg'])): ?>
						<div align="center"><h2>Для авторизации на сайте введите данные:</h2>
							<form  method="post">
								Логин: <input type="text" name="login"><br>
								Пароль: <input type="password" name="password"><br>
								<input type="submit" name="submit">
								<br>
								<input type="submit" name="reg" value="Зарегистрироваться">
							</form>
						</div>
					<?php endif; ?>
					<?php if (isset($_POST['reg'])): ?>
						<div align="center"><h2>Регистрация на сайте:</h2>
							<form  method="post">
								Логин: <input type="text" name="login2"><br><br>
								Пароль: <input type="password" name="password2"><br><br>
								email: <input type="email" name="email2"><br>
								<input type="submit" name="submit2">
							</form>
						</div>
					<?php endif; ?>
					<div>
						<?php require '/var/www/html/src/core/form/add_news_form.php'; ?>
					</div>
					<div>
						<?php require '/var/www/html/myproject/common/news_list.php'; ?> 
						<?php require '/var/www/html/src/core/pagination/contentPagination.php'; ?>
					

