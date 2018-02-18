<?php	
// Показываем список пользователей - Show the list of the users
$sql_users = "SELECT * FROM users";
$prep_users = $сonnection_db->prepare($sql_users); 
$prep_users->execute();
$users_list = $prep_users->fetchAll(PDO::FETCH_ASSOC);
