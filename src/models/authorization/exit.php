<?php
session_start();
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	//echo "Вы успешно вошли в систему1: ".$_SESSION['login'] ."<br>";
	// destroy the session
	unset($_SESSION['count']);
	session_destroy();
	   
    //Удаляем куки авторизации путем установления времени их жизни на текущий момент - Delete the cookies
	setcookie('login', '', time()); //удаляем логин
	setcookie('key', '', time()); //удаляем ключ

	header("Location: http://myproject.local/index.php"); 
	//header("Location: http://192.168.50.5/index.php");
    exit; 
}
?>
<a href="/index.php">Перейти на главную страницу</a> 


