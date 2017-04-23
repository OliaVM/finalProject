<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php	
// Показать список пользователей
$sql = "SELECT login, id FROM users";
$users_list = $basa->query($sql);

// Показать информацию о пользователе
if (isset($_GET['userId'])) {
	$showUser = $_GET['userId'];
	//var_dump($showUser);
	$sql = 'SELECT id, login, email, role FROM users WHERE id="'.$showUser.'"'; 
	//$x = "1"; 
	//$sql2 = 'SELECT id, login, email, role FROM users WHERE id="'.$x.'"'; 
	//$sql2 = 'SELECT id, login, email, role FROM users WHERE id="1"'; 
	$user = $basa->query($sql);
	//var_dump($sql2);
	//var_dump($user);
}
?>

<?php
require_once  '/var/www/html/src/core/form/info_about_user.php';	
?>

<?php
require_once '/var/www/html/src/core/form/list_of_users.php';	
?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 


