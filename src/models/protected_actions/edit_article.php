<?php
try {
	if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) { 
		throw new Exception('У вас нет прав на совершение этих действий!');
	}
	if ($_SESSION['role'] !== "admin") {
		throw new Exception('У вас нет прав на совершение этих действий!');
	}

	//Get the record from databases and display on the screen for editing
	if (isset($_GET['red_id'])) { 
	    $sql_select = "SELECT * FROM articles WHERE id = :id";
		$prep_select = $basa->prepare($sql_select);
		$prep_select->bindValue(':id', $_GET['red_id'], PDO::PARAM_INT);
		$prep_select->execute(); 
		$article_row = $prep_select->fetchAll(PDO::FETCH_ASSOC);

		//Редактирование записи - Editing the record
	    if (isset($_POST['go_edit'])) { 

	    	if (empty($_POST['article_title']) || empty($_POST['rubric'])  || empty($_POST['article_short_text']) || empty($_POST['article_full_text']) || empty($ourimage)) {
				//Генерируем исключение - Generate the exception
        		throw new Exception('Заполните все поля!');
			}
        	//Обновляем информацию в отредактированной записи (в БД) - Update information in the edited record in the database
			$sql = 'UPDATE articles SET article_title =:article_title, article_short_text =:article_short_text, article_full_text =:article_full_text, rubric =:rubric WHERE id =:id';
			$prep = $basa->prepare($sql);
			$prep->bindValue(':article_title', $_POST['article_title'], PDO::PARAM_STR);
			$prep->bindValue(':article_short_text', $_POST['article_short_text'], PDO::PARAM_STR);
			$prep->bindValue(':article_full_text', $_POST['article_full_text'], PDO::PARAM_STR);
			$prep->bindValue(':rubric', $_POST['rubric'], PDO::PARAM_STR);
			$prep->bindValue(':id', $_GET['red_id'], PDO::PARAM_INT);
			$prep->execute(); 
			header("Location: /index.php?page_name=editor_page");			
	    }
	}
}
catch (Exception $ex) {
	$exEdit = $ex->getMessage();
}
