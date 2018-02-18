<!-- Список пользователей -->
<table cellspacing="5" cellpadding="10" border="1" width="100%" style="text-align:center">
    <caption>Список пользователей</caption>
    <tr>
    	<th>id</th>
    	<th>Логин</th>
	    <th>Посмотреть информацию о пользователе</th>
	    <th>Изменить информацию о пользователе</th>
	    <th>Удалить пользователя</th>
    </tr>
	<?php foreach ($users_list as $rowUser): ?>
	<tr>
		<td><?php echo $rowUser['id']; ?></td>
		<td><?php echo $rowUser['login']; ?></td>
		<td><a href='/index.php?page_name=get_list_of_users_page&userId=<?php echo $rowUser['id']; ?>'>Посмотреть подробнее</a></td>
		<td><a href='/index.php?page_name=get_list_of_users_page&edit_userId=<?php echo $rowUser['id']; ?>'>Отредактировать</a></td>
		<td><form method="post">
			<input type='hidden' name="delete_userId" value="<?php echo $rowUser['id']; ?>">
			<input name="button_del_user" value="Удалить" type="submit">
		</form></td>
	</tr>
	<?php endforeach; ?>
</table> 


