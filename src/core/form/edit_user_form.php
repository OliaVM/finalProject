<!-- Редактирование записи -->
<?php if ($_SESSION['role'] == "admin"): ?>
	<?php if (isset($_GET['edit_userId'])): ?>
		<?php foreach ($user as $row): ?>
		    <form method="POST">
				Логин: <input type="text" name="login" value='<?php echo $row['login']; ?>'><br><br>
				Роль: <input type="text" name="role" value='<?php echo $row['role']; ?>'><br><br>
				Пароль: <input type="password" name="password" value="<?php echo $row['password']; ?>"><br><br>
				email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
				<input type="submit" name="go_edit_user"> 	
			</form>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>

<?php	if (isset($exEditUser)): ?>  
	<?php echo "<h2 class='redcolor'>" . $exEditUser . "</h2>"; ?>
<?php	endif; ?> 
