<?php
if (isset($_POST['button_del_user'])) {
	$del = $_POST['delete_userId'];
    $sql = 'DELETE FROM users WHERE id =:del'; //удаляем строку из таблицы
    $prep = $сonnection_db->prepare($sql);
	$prep->bindValue(':del', $del, PDO::PARAM_INT);
	$prep->execute(); 
	header("Location: /index.php?page_name=get_list_of_users_page");
}
