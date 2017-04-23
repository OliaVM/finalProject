<!-- Список пользователей -->
<table border="1">
    <caption>Список пользователей</caption>
    <tr><th>логин</th>
	    <th>id</th>
	    <th>информация</th>
    </tr>
	<?php foreach ($users_list as $row1): ?>
	<tr><td><?php echo $row1['login']; ?></td>
		<td><?php echo $row1['id']; ?></td>
		<?php //$x = 1; ?>
		<td><a href='http://myproject.local/administrator_page/get_list_of_users.php?userId=<?php echo $row1['id']; ?>'>Посмотреть информацию о пользователе</a><td>
	</tr>
	<?php endforeach; ?>
</table> 