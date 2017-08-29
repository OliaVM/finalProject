<?php
// Работа с базой данных: - Work with database:
//Занесение в базу картинки и текстовой информации, добавленных пользователем; текущей даты,вычисленной с помощью функции 
//adding in database: picture and text information, which the user uploaded; date,calculated using the function 
if(isset($_POST["go"])){
	//Добавление картинки на сервер и ссылки на картинку в базу данных
	//Adding the picture on the server, and a link to the picture in the database
	try {
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$uploaddir = 'images/'; 	// это папка, в которую будет загружаться картинка
			$nameOfimage=date('YmdHis').rand(100,1000).'.jpg'; 	// это имя, которое будет присвоенно изображению 
			$ourimage = uploadImage($uploaddir, $nameOfimage);
		}
		else {
		//Генерируем исключение - Generate the exception
        throw new Exception('Добавьте картинку!');
     	}
    }
	catch (Exception $ex) {
		//Выводим сообщение об исключении - Print the exception message
		$x = $ex->getMessage();
	}

	// Работа с базой данных: добавление даты, текстовой информации
	//Work with database: Adding the text information and the date
	if (isset($_POST['theme']) && isset($_POST['title']) && isset($_POST['message']) && isset($ourimage)) {
		try {
			if(!empty($_POST['theme']) && !empty($_POST['title']) && !empty($_POST['message'])){
				// Вычисление даты публикации - текущей даты - The calculation of the date of publication
				$data = GetFullNowDateInCity(7);
				
				//Добавление информации в базу данных - Adding information in the database
				$sql="INSERT INTO articles(rubrika, article_name, data, image, article_text, like_number) VALUES (?, ?, '$data', '$ourimage', ?, '0')"; 
				submitDb ($basa, $sql);
			}
			else {
				//Генерируем исключение - Generate the exception
        		throw new Exception('Заполните все поля!');
			}
		}
		catch (Exception $ex2) {
			//Выводим сообщение об исключении - Print the exception message
			$x2 = $ex2->getMessage();
		}
	}
}