<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<!-- Выводим кнопку выхода из сессии - Display the exit button from the session -->
<?php require_once '/var/www/html/src/core/form/exit_button.php' ?>
<!-- Display the administrator menu -->
<div> 
			<ul>
				<li><a href="http://myproject.local/administrator_page/delete_information.php">Удаление записи </a></li>
				<li><a href="http://myproject.local/administrator_page/editor.php">Редактирование записи</a></li>
				<li><a href="http://myproject.local/administrator_page/get_list_of_users.php">Показать список пользователей</a></li>
				<li><a href="http://myproject.local/administrator_page/get_list_of_users.php">Показать информацию о пользователе</a></li>
			</ul>
</div>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 
