<?php	
// Показsываем информацию о пользователе - Show the information about the user
if (isset($_GET['userId'])) {
	$userId = $_GET['userId'];
	$sql = "SELECT * FROM users WHERE id = :id";
	$prep = $сonnection_db->prepare($sql); 
	$prep->bindValue(':id', $userId, PDO::PARAM_INT); 
	$prep->execute();
	$user= $prep->fetchAll(PDO::FETCH_ASSOC);
}
		