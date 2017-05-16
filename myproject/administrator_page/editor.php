<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php
if ($_SESSION['role'] == "admin") {
	//Достаем запсись из БД и выводим на экран для редактирования
	//Get the record from databases and display on the screen for editing
	if (isset($_GET['red_id'])) { 
	    $id = $_GET['red_id']; 
	    $sql3 = 'SELECT * FROM articles WHERE id='.$id.'';
		$row5 = $basa->query($sql3); 
		//echo $id;
		//var_dump($row5);
		//$sth = $basa->prepare($sql); 
		//$sth->execute();
		//$row5 = $sth->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива

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
				header("Location: http://myproject.local/administrator_page/editor.php");			
	            /*
	        	$sql = 'UPDATE articles  SET  article_name='.$_POST['title'].' WHERE id='.$_GET['red_id'].'';
	        	$result = $basa->query($sql);
				//$sql5 = 'UPDATE articles  SET  article_name='.$_POST['title'].', article_text='.$_POST['message'].' , rubrika='.$_POST['theme'].'  WHERE id='.$_GET['red_id'].'';
				$message = $_POST['message'];
				$sql2 = 'UPDATE articles  SET  article_text='.$message.' WHERE id='.$_GET['red_id'].'';
				$result2 = $basa->query($sql2);
				
				$sql3 = 'UPDATE articles  SET  rubrika='.$_POST['theme'].' WHERE id='.$_GET['red_id'].'';
				$result3 = $basa->query($sql3);
				*/
		}
	}
}
?>

<?php
require_once '/var/www/html/src/core/form/editor_form.php';	
require_once '/var/www/html/src/core/form/delete_form.php';	
?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 