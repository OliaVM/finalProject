<?php
//Удаление записи - Deleting of record
if (isset($_POST['button_del'])) {  //проверяем, есть ли переменная
    $del = $_POST['del_id'];
    $sql = 'DELETE FROM articles WHERE id =:del'; //удаляем строку из таблицы
    $prep = $basa->prepare($sql);
	$prep->bindValue(':del', $del, PDO::PARAM_INT);
	$prep->execute(); 
	header("Location: /index.php?page_name=delete_page");
	
}


