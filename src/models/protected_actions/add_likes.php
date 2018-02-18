<?php
try {
	if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {
		//throw new Exception('Авторизуйтесь');
	}
	if (isset($_POST['image_go'])) { //если пользователь нажал на кнопку поставить лайк
		$sql_arrayLike = "SELECT * FROM likes WHERE login_id = :login_id and article_id = :article_id"; //проверяем не голосовал ли уже пользователь за эту новость
		$prep = $сonnection_db->prepare($sql_arrayLike); 
		$prep->bindValue(':login_id', $_SESSION['id'], PDO::PARAM_INT); 
		$prep->bindValue(':article_id', $_POST['id'], PDO::PARAM_INT); 
		$prep->execute();
		$rowLike = $prep->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива
		//Convert the answer from database in a string of array
		
		//Если база данных вернула пустой ответ - If the database returned an empty response - Т.е. пользователь еще не голосовал
		if (empty($rowLike['count_of_likes'])) {
			//add in TABLE LIKES
			$likes = 1;
			$sql1 = "INSERT INTO likes (login_id, article_id, count_of_likes) VALUES (:login_id, :article_id, :count_of_likes)";
			$prep1 = $сonnection_db->prepare($sql1); 
			$prep1->bindValue(':login_id', $_SESSION['id'], PDO::PARAM_INT); 
			$prep1->bindValue(':article_id', $_POST['id'], PDO::PARAM_INT); 
			$prep1->bindValue(':count_of_likes', $likes, PDO::PARAM_INT); 
			$prep1->execute();

			//add in TABLE ARTICLES
			$sql2 = "SELECT COUNT(*) FROM likes WHERE count_of_likes = :count_of_likes and article_id = :article_id";
			$prep2 = $сonnection_db->prepare($sql2); 
			$prep2->bindValue(':count_of_likes', 1, PDO::PARAM_INT); 
			$prep2->bindValue(':article_id', $_POST['id'], PDO::PARAM_INT); 
			$prep2->execute();
			$row = $prep2->fetch(PDO::FETCH_ASSOC);
			$count_of_likes = $row['COUNT(*)'];
			
			$sql3 = "UPDATE articles SET count_of_likes = :count_of_likes WHERE id = :id";
			$prep3 = $сonnection_db->prepare($sql3);
			$prep3->bindValue(':count_of_likes', $count_of_likes, PDO::PARAM_INT);
			$prep3->bindValue(':id', $_POST['id'], PDO::PARAM_INT); 
			$prep3->execute(); 
			$result = $prep3->fetch(PDO::FETCH_ASSOC);
			//echo "Запись обновлена";
			header('Location: /index.php');				
		}
		else {
			throw new Exception('Вы уже проголосовали');	
		}
	}
}
catch (Exception $ex) {
		//Выводим сообщение об исключении - Print the exception message
		$exLike = $ex->getMessage();
}

