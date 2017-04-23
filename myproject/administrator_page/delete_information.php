<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php
//Удаление записи 
if (isset($_GET['del_id'])) {  //проверяем, есть ли переменная
    //$sql = 'DELETE FROM articles WHERE id ="'.$_GET['del_id'].'"'; //удаляем строку из таблицы
    //$y = 28;
    $del = $_GET['del_id'];
    $sql4 = 'DELETE FROM articles WHERE id='.$del.''; //удаляем строку из таблицы
    //$sql4 = 'DELETE FROM articles WHERE id ="29"'; //удаляем строку из таблицы
	$result = $basa->query($sql4);
	//var_dump($sql4);
	//var_dump($result);
	header("Location: /var/www/html/myproject/administrator_page/admin_page.php");
}
?>

<?php
require_once '/var/www/html/src/core/form/delete_form.php';	
?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 