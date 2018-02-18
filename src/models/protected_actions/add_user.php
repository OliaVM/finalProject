<?php
try {
	//Не заполнено какое-либо из полей - Not filled any of the fields
	if (isset($_POST['create_new_user'])) {
		//Если форма регистрации отправлена и ВСЕ поля непустые - If the registration form is sent and all fields are not empty
		if (empty($_POST['password']) || empty($_POST['login']) || empty($_POST['email']) || empty($_POST['role'])) {
			throw new Exception('Заполните все поля!');
		}
		$login = $_POST['login']; 
		$password = $_POST['password']; 
		$email = $_POST['email']; 
		$role = $_POST['role']; 

		$sql = 'SELECT * FROM users WHERE login=:login';
		$prep = $сonnection_db->prepare($sql);
		$prep->bindValue(':login', $login, PDO::PARAM_STR);
		$prep->execute(); 
		$row = $prep->fetch(PDO::FETCH_ASSOC);

		//Если $row НЕ пустой - то логин занят! - - If $row is not empty - the login is not free
		if ($login == $row['login']) {
			throw new Exception('Этот логин уже занят!');
     	}
				
		//Generate the salt using the function generateSalt() and salt the password
		$salt = generateSalt(); 
		$saltedPassword = md5($password.$salt); 

		// Added information to the database from the form
		$sql2 = 'INSERT INTO users SET login = :login, role = :role, password= :saltedPassword, salt= :salt, email = :email';
		$prep2 = $сonnection_db->prepare($sql2);
		$prep2->bindValue(':login', $login, PDO::PARAM_STR);
		$prep2->bindValue(':role', $role, PDO::PARAM_STR);
		$prep2->bindValue(':saltedPassword', $saltedPassword, PDO::PARAM_STR);
		$prep2->bindValue(':salt', $salt, PDO::PARAM_STR);
		$prep2->bindValue(':email', $email, PDO::PARAM_STR);
		$prep2->execute(); 
		echo "Пользователь создан";
	}
}
catch (Exception $ex) {
	$exNewUser = $ex->getMessage();
}
