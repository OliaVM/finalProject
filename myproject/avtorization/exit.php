<?php
session_start();
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	echo "Вы успешно вошли в систему1: ".$_SESSION['login'] ."<br>";
	unset($_SESSION['count']);
	session_destroy();
	//echo "Вы успешно вошли в систему2: ".$_SESSION['login'] ."<br>";
	header("Location: http://myproject.local/index.php"); 
	//header("Location: http://192.168.50.5/index.php");
    exit; 
}
?>

<a href="/index.php">Перейти на главную страницу</a> 


