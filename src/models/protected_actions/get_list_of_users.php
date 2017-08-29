<?php	
// Показываем список пользователей - Show the list of the users
$sql = "SELECT login, id FROM users";
$users_list = $basa->query($sql);

// Показsываем информацию о пользователе - Show the information about the user
if (isset($_GET['userId'])) {
	$showUser = $_GET['userId'];
	$sql = 'SELECT id, login, email, role FROM users WHERE id="'.$showUser.'"'; 
	$user = $basa->query($sql);
}
