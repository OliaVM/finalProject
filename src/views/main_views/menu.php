<ul>
	<li><a href="/index.php?page=1">Главная</a></li>
	<br>
	<li><a href="/index.php?page_name=authorization_page">Авторизоваться</a></li>
	<li><a href="/index.php?page_name=registration_page">Зарегистрироваться</a></li>
	<br>
	<?php if (isset($_SESSION['login']) && isset($_SESSION['password'])): ?>
			<!-- Вход под ролью администратора - The input under the administrator role -->
			<?php if ($_SESSION['role'] == "admin"): ?>
				<div> 
					<li><a href="/index.php?page_name=admin_role_page">Перейти на страницу администратора</a></li>
					<li><a href="/index.php?page_name=delete_page">Удаление записей пользователей</a></li>
					<li><a href="/index.php?page_name=editor_page">Редактирование записей пользователей</a></li>
					<li><a href="/index.php?page_name=get_list_of_users_page">Показать список пользователей</a></li>
					<li><a href='/index.php?page_name=create_new_user'>Добавить нового пользователя</a></li>
				</div>
			<!-- Вход под ролью редактора The input under the editor role-->
			<?php elseif ($_SESSION['role'] == "editor"): ?>
				<div> 
					<a href="/index.php?page_name=editor_role_page">Перейти на страницу редактора</a>
				</div>
			<?php endif; ?>
			<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
			<?php require_once __DIR__ . '/../../core/form/exit_button.php' ?>
	<?php endif; ?>
	<br>
	<li><a href="/index.php?page_name=news&rubric=russia&page=1">Россия</a></li>
	<li><a href="/index.php?page_name=news&rubric=world&page=1">Мир</a></li>
	<li><a href="/index.php?page_name=news&rubric=economics&page=1">Экономика</a></li>
	<li><a href="/index.php?page_name=news&rubric=science&page=1">Наука</a></li>
	<li><a href="/index.php?page_name=news&rubric=culture&page=1">Культура</a></li>
	<li><a href="/index.php?page_name=news&rubric=sport&page=1">Спорт</a></li>
	<li><a href="/index.php?page_name=news&rubric=travel&page=1">Путешествия</a></li>
</ul>

