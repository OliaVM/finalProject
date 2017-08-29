<?php
if ($_SESSION['role'] == "admin") {
	//Достаем запсись из БД и выводим на экран для редактирования
	//Get the record from databases and display on the screen for editing
	if (isset($_GET['red_id'])) { 
	    $id = $_GET['red_id']; 
	    $sql3 = 'SELECT * FROM articles WHERE id='.$id.'';
		$row5 = $basa->query($sql3); 
		
		//Редактирование записи - Editing the record
	    if (isset($_POST['go_edit'])) { 
	        	//Обновляем информацию в отредактированной записи (в БД) - Update information in the edited record in the database
				$sql = 'UPDATE articles SET article_name =:article_name, article_text =:article_text, rubrika =:rubrika  WHERE id =:id';
				$prep = $basa->prepare($sql);
				$prep->bindValue(':article_name', $_POST['title'], PDO::PARAM_STR);
				$prep->bindValue(':article_text', $_POST['message'], PDO::PARAM_STR);
				$prep->bindValue(':rubrika', $_POST['theme'], PDO::PARAM_STR);
				$prep->bindValue(':id', $_GET['red_id'], PDO::PARAM_INT);
				$prep->execute(); 
				header("Location: /index.php?page_name=editor_page");			
	    }
	}
}
