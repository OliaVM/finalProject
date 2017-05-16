<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php
//Удаление записи - Deleting of record
if (isset($_POST['button_del'])) {  //проверяем, есть ли переменная
    //$sql = 'DELETE FROM articles WHERE id ="'.$_GET['del_id'].'"'; //удаляем строку из таблицы
    //$y = 28;
    $del = $_POST['del_id'];
    $sql4 = 'DELETE FROM articles WHERE id =:del'; //удаляем строку из таблицы
    //$sql4 = 'DELETE FROM articles WHERE id ="29"'; //удаляем строку из таблицы
	$prep = $basa->prepare($sql4);
	$prep->bindValue(':del', $del, PDO::PARAM_INT);
	$prep->execute(); 
	//echo $del;
	//var_dump($sql4);
	//var_dump($prep);
	header("Location: http://myproject.local/administrator_page/delete_information.php");
}
?>
<?php require_once '/var/www/html/src/core/form/delete_form.php'; ?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 