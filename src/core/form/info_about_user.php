<!-- Информация о пользователе -->
<?php if (isset($_GET['userId'])): ?>
	<?php if (isset($user)): ?>
		<?php $showUser = $_GET['userId'];  ?>	
			<br> 
			<table border="1">
			    <caption>Информация о пользователе</caption>
			    <tr>
				    <th>логин</th>
				    <th>email</th>
				    <th>права доступа</th>
				    <th>id</th>
			    </tr>
				<?php foreach ($user as $row): ?>
				<tr>
					<td><?php echo $row['login']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['role']; ?></td>
					<td><?php echo $row['id']; ?> </td>
				</tr>
				<?php endforeach; ?>
			</table> 
			<br> 
	<?php endif; ?>
<?php endif; ?>
