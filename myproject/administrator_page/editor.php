<?php require_once '/var/www/html/myproject/common/header.php'; ?> 
<?php
//Достаем запсись из БД и выводим на экран для редактирования
if (isset($_GET['red_id'])) { 
    	$id = $_GET['red_id']; 
       	$sql3 = 'SELECT * FROM articles WHERE id='.$id.'';
		$row5 = $basa->query($sql3); 
		//$sth = $basa->prepare($sql); 
		//$sth->execute();
		//$row5 = $sth->fetch(PDO::FETCH_ASSOC); //Преобразуем ответ из БД в строку массива
}
//Редактирование записи
if (isset($_GET['red_id'])) { //обновляем информацию в отредавтированной записи (в БД)
        if (isset($_POST['go'])) { 
        	$sql = 'UPDATE articles  SET  article_name='.$_POST['title'].' WHERE id='.$_GET['red_id'].'';
        	$result = $basa->query($sql);
			//$sql5 = 'UPDATE articles  SET  article_name='.$_POST['title'].', article_text='.$_POST['message'].' , rubrika='.$_POST['theme'].'  WHERE id='.$_GET['red_id'].'';
			$message = $_POST['message'];
			$sql2 = 'UPDATE articles  SET  article_text='.$message.' WHERE id='.$_GET['red_id'].'';
			$result2 = $basa->query($sql2);
			
			$sql3 = 'UPDATE articles  SET  rubrika='.$_POST['theme'].' WHERE id='.$_GET['red_id'].'';
			$result3 = $basa->query($sql3);
		}
    }
?>

<?php
require_once '/var/www/html/src/core/form/editor_form.php';	
require_once '/var/www/html/src/core/form/delete_form.php';	
?>
<?php require_once '/var/www/html/myproject/common/footer.php'; ?> 