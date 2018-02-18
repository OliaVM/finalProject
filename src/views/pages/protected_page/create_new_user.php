<?php if ($_SESSION['role'] == "admin"): ?>
    <form method="POST">
		Логин: <input type="text" name="login"><br><br>
		Роль:
		<SELECT name = "role">
			<OPTION value = "admin">admin
			<OPTION value = "admin">editor
			<OPTION value = "admin">user
		</SELECT><br><br>
		Пароль: <input type="password" name="password"><br><br>
		email: <input type="email" name="email"><br>
		<input type="submit" name="create_new_user"> 	
	</form>
<?php endif; ?>

<?php	if (isset($exNewUser)): ?>  
	<?php echo "<h2 class='redcolor'>" . $exNewUser . "</h2>"; ?>
<?php	endif; ?> 