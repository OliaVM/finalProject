<?php
if (isset($_GET['edit_userId'])) {
	$userId = $_GET['edit_userId'];
	$sql = "SELECT * FROM users WHERE id = :id";
	$prep = $сonnection_db->prepare($sql); 
	$prep->bindValue(':id', $userId, PDO::PARAM_INT); 
	$prep->execute();
	$user = $prep->fetchAll(PDO::FETCH_ASSOC);
}

try {
	if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) { 
		throw new Exception('У вас нет прав на совершение этих действий!');
	}
	if ($_SESSION['role'] !== "admin") {
		throw new Exception('У вас нет прав на совершение этих действий!');
	}

	//Get the record from databases and display on the screen for editing
	if (isset($_POST['go_edit_user'])) { 
	    $sql_select = "SELECT * FROM users WHERE id = :id";
		$prep_select = $сonnection_db->prepare($sql_select);
		$prep_select->bindValue(':id', $_GET['edit_userId'], PDO::PARAM_INT);
		$prep_select->execute(); 
		$users_array = $prep_select->fetchAll(PDO::FETCH_ASSOC);

		//Editing the record
    	if (empty($_POST['login']) || empty($_POST['email']) || empty($_POST['role']) || empty($_POST['password'])) { 
    		//throw new Exception('Заполните все поля!');
		}

        $login = $_POST['login']; 
		$password = $_POST['password']; 
		$email = $_POST['email']; 
		$role = $_POST['role']; 

		$sql = 'SELECT * FROM users WHERE login=:login and id !==:id';
		$prep = $сonnection_db->prepare($sql);
		$prep->bindValue(':login', $login, PDO::PARAM_STR);
		$prep->bindValue(':id', $_GET['edit_userId'], PDO::PARAM_INT);
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
		$sql2 = 'UPDATE users SET login = :login, role = :role, password= :saltedPassword, salt= :salt, email = :email WHERE id =:id';
		$prep2 = $сonnection_db->prepare($sql2);
		$prep2->bindValue(':id', $_GET['edit_userId'], PDO::PARAM_INT);
		$prep2->bindValue(':login', $login, PDO::PARAM_STR);
		$prep2->bindValue(':role', $role, PDO::PARAM_STR);
		$prep2->bindValue(':saltedPassword', $saltedPassword, PDO::PARAM_STR);
		$prep2->bindValue(':salt', $salt, PDO::PARAM_STR);
		$prep2->bindValue(':email', $email, PDO::PARAM_STR);
		$prep2->execute(); 
		echo "Запись отредактирована";
	}
}
catch (Exception $ex) {
	$exEditUser = $ex->getMessage();
}






