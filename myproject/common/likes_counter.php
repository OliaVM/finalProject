<?php
if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	if (isset($_POST['image_go'])) {
			$sql9 = 'SELECT * FROM likes WHERE user_id = :user_id and like_id = :like_id';
			$prep9 = $basa->prepare($sql9); 
			$prep9-> bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT); 
			$prep9-> bindParam(':like_id', $_POST['id'], PDO::PARAM_INT); 
			$prep9->execute();
			$rowLike = $prep9->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива
			//var_dump($rowLike);
			//var_dump($rowLike['like_count']);
			//var_dump($_POST['id']);
			//var_dump($_SESSION['id']);
			//Если база данных вернула не пустой ответ 
			
			if (empty($rowLike['like_count'])) {
					$id = $_POST['id'];
					$like = $_POST['like'];
					$like = $like + 1;
										
					$sql = 'UPDATE articles  SET  like_number =:like_number WHERE id='.$id.'';
					$prep = $basa->prepare($sql);
					$prep->bindValue(':like_number', $like, PDO::PARAM_INT);
					$prep->execute(); 
					$result = $prep9->fetch(PDO::FETCH_ASSOC);
					header('Location: http://myproject.local/button2.php');
			}
			else {
					echo "Вы уже проголосовали";
			}
			
			if ($rowLike == false) {
					$id = $_POST['id'];
					$like = $_POST['like'];
					$like = $like + 1;
					$sql = 'UPDATE articles  SET  like_number =:like_number WHERE id='.$id.'';
					$prep = $basa->prepare($sql);
					$prep->bindValue(':like_number', $like, PDO::PARAM_INT);
					$prep->execute(); 
					$result = $prep9->fetch(PDO::FETCH_ASSOC);
					header('Location: http://myproject.local/index.php');

					$sql2 = "INSERT INTO likes(user_id, like_id, like_count) VALUES (:user_id, :like_id, '1')"; 
					$prep2 = $basa->prepare($sql2); 
					$prep2-> bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT); 
					$prep2-> bindParam(':like_id', $_POST['id'], PDO::PARAM_INT); 
					$prep2->execute();
			}
	}
}





