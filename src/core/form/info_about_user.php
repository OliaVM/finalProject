<a href='/index.php?page_name=create_new_user'>Добавить нового пользователя</a>

<!-- Информация о пользователе -->
<?php if (isset($_GET['userId'])): ?>
	<?php if (isset($user)): ?>
		<?php $showUser = $_GET['userId'];  ?>	
			<br> 
			<table cellspacing="5" cellpadding="10" border="1" width="100%" style="text-align:center">
			    <caption>Информация о пользователе</caption>
			    <tr>
				    <th>логин</th>
				    <th>email</th>
				    <th>дата рождения</th>
				    <th>права доступа</th>
				    <th>id</th>
			    </tr>
				<?php foreach ($user as $row): ?>
				<tr>
					<td><?php echo $row['login']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['date_of_birth']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td><?php echo $row['id']; ?> </td>
				</tr>
				<?php endforeach; ?>
			</table> 
			<br> 
	<?php endif; ?>
<?php endif; ?>
