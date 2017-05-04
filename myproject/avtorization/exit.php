<?php
session_start();
if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
	//echo "Вы успешно вошли в систему1: ".$_SESSION['login'] ."<br>";
	unset($_SESSION['count']);
	session_destroy();
	//echo "Вы успешно вошли в систему2: ".$_SESSION['login'] ."<br>";
	header("Location: http://myproject.local/index.php"); 
	//header("Location: http://192.168.50.5/index.php");
    exit; 
    
    //Удаляем куки авторизации путем установления времени их жизни на текущий момент:
	setcookie('login', '', time()); //удаляем логин
	setcookie('key', '', time()); //удаляем ключ
}
?>
<a href="/index.php">Перейти на главную страницу</a> 


