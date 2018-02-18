<?php
//Добавление в базу картинки и текстовой информации, добавленных пользователем; текущей даты,вычисленной с помощью функции 
//adding in database: picture and text information, which the user uploaded; date,calculated using the function 
try {
	//Добавление картинки на сервер и ссылки на картинку в базу данных
	//Adding the picture on the server, and a link to the picture in the database
	if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) { 
		throw new Exception('Авторизуйтесь, чтобы добавить статью!');
	}
	if (isset($_POST["go"])) {
		if (is_uploaded_file($_FILES['userfile']['tmp_name']) == false) {
		     throw new Exception('Добавьте картинку!');
		}
		$uploaddir = 'images/'; 	// это папка, в которую будет загружаться картинка
		$nameOfimage=date('YmdHis').rand(100,1000).'.jpg'; 	
		//uploadImage($uploaddir, $nameOfimage);
		$uploadfile_with_short_path = "$uploaddir$nameOfimage";
		$uploadfile = __DIR__ . "/../../../myproject/" ."$uploaddir$nameOfimage"; //"/var/www/html/myproject/"
		//в переменную $uploadfile будет входить папка и имя изображения
		// проверяем загружается ли изображение 
		// проверяем продходит ли изображение по размеру и формату. Разрешенный размер - до 512 Кб
		//Допустимые форматы: jpg, jpeg, png
		if (($_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/png') && ($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size']<=512000)) { 
			// Указываем максимальный размер загружаемого файла. Сейчас до 512 Кб 
		  	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //eсли файл действительно загружен на сервер, он будет перемещён в "$uploaddir"; 
			   $size = getimagesize($uploadfile); 
			   // получаем размер пикселей изображения 
			   if ($size[0] < 501 && $size[1]<1501) { 
			     // если размер изображения не более 500 пикселей по ширине и не более 1500 по  высоте 
			     //echo "Файл загружен. Путь к файлу: <b>http://myproject.local/".$uploadfile."</b>"; 
			    } else {
		     		unlink($uploadfile); // удаление файла 
		     	} 
		   	} 
		}
		$ourimage = $uploadfile_with_short_path;

		//Work with database: Adding the text information and the date
		if (empty($_POST['article_title']) || empty($_POST['rubric'])  || empty($_POST['article_short_text']) || empty($_POST['article_full_text']) || empty($ourimage)) {
			//Генерируем исключение - Generate the exception
	        throw new Exception('Заполните все поля!');
		}
		// Вычисление даты публикации - текущей даты - The calculation of the date of publication
		$data = GetFullNowDateInCity(7);
		$login_id = $_SESSION['id'];
		$image = $ourimage;
		//Добавление информации в базу данных - Adding information in the database
		$sql="INSERT INTO articles (login_id, rubric, article_title, article_date, image, article_short_text, article_full_text, count_of_likes) VALUES (:login_id, :rubric, :article_title, :article_date, :image, :article_short_text, :article_full_text, :count_of_likes)"; 
		$prep = $сonnection_db->prepare($sql);
		/*
		//ptotect from injections
		$_POST['article_title'] = $сonnection_db->quote($_POST['article_title']); 
		$_POST['article_short_text'] = $сonnection_db->quote($_POST['article_short_text']); 
		$_POST['article_full_text'] = $сonnection_db->quote($_POST['article_full_text']); 
		*/
		$prep->bindValue(':login_id', $_SESSION['id'], PDO::PARAM_INT);
		$prep->bindValue(':rubric', $_POST['rubric'], PDO::PARAM_STR);
		$prep->bindValue(':article_title', $_POST['article_title'], PDO::PARAM_STR);
		$prep->bindValue(':article_full_text', $_POST['article_full_text'], PDO::PARAM_STR);
		$prep->bindValue(':article_short_text', $_POST['article_short_text'], PDO::PARAM_STR);		
		$prep->bindValue(':count_of_likes', 0, PDO::PARAM_INT);
		$prep->bindValue(':article_date', $data, PDO::PARAM_STR);
		$prep->bindValue(':image', $image, PDO::PARAM_STR);
		$arr = $prep->execute();
	}
}
catch (Exception $ex) {
	$exAdd = $ex->getMessage();
}


// get date of create of article
function GetFullNowDateInCity($timezoneInCity){
	$FullNowDateInCity = date('d.m.Y H:i', (time()+$timezoneInCity*60*60));
	return $FullNowDateInCity;
}