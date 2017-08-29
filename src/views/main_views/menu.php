<ul>
				<li><a href="/index.php">Главная</a></li>
				<br>
				<li><a href="/index.php?page_name=authorization_page">Авторизоваться</a></li>
				<li><a href="/index.php?page_name=registration_page">Зарегистрироваться</a></li>
				<br>
				<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
						<!-- Вход под ролью администратора - The input under the administrator role -->
						<?php if ($_SESSION['role'] == "admin"): ?>
							<div> 
								<a href="/index.php?page_name=admin_role_page">Перейти на страницу администратора</a>
							</div>
						<!-- Вход под ролью редактора The input under the editor role-->
						<?php elseif ($_SESSION['role'] == "editor"): ?>
							<div> 
								<a href="/index.php?page_name=editor_role_page">Перейти на страницу редактора</a>
							</div>
						<?php endif; ?>
						<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
						<?php require_once '/var/www/html/src/core/form/exit_button.php' ?>
				<?php endif; ?>
				<br>
				<li><a href="/index.php?page_name=news&theme=russia&page=1">Россия</a></li>
				<li><a href="/index.php?page_name=news&theme=world&page=1">Мир</a></li>
				<li><a href="/index.php?page_name=news&theme=economics&page=1">Экономика</a></li>
				<li><a href="/index.php?page_name=news&theme=science&page=1">Наука</a></li>
				<li><a href="/index.php?page_name=news&theme=culture&page=1">Культура</a></li>
				<li><a href="/index.php?page_name=news&theme=sport&page=1">Спорт</a></li>
				<li><a href="/index.php?page_name=news&theme=travel&page=1">Путешествия</a></li>
</ul>

