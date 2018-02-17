<!-- Список пользователей -->
<table border="1">
    <caption>Список пользователей</caption>
    <tr><th>логин</th>
	    <th>id</th>
	    <th>информация</th>
    </tr>
	<?php foreach ($users_list as $rowUser): ?>
	<tr><td><?php echo $rowUser['login']; ?></td>
		<td><?php echo $rowUser['id']; ?></td>
		<td><a href='/index.php?page_name=get_list_of_users_page&userId=<?php echo $rowUser['id']; ?>'>Посмотреть информацию о пользователе</a><td>
	</tr>
	<?php endforeach; ?>
</table> 