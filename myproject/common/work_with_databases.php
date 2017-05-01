<?php
// Работа с базой данных: 
//Занесение в базу картинки и текстовой информации, добавленных пользователем; текущей даты,вычисленной с помощью функции 
if(isset($_POST["go"])){
	//Добавление картинки
	try {
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$uploaddir = 'images/'; 	// это папка, в которую будет загружаться картинка
			$nameOfimage=date('YmdHis').rand(100,1000).'.jpg'; 	// это имя, которое будет присвоенно изображению 
			$ourimage = uploadImage($uploaddir, $nameOfimage);
		}
		else {
		//Генерируем исключение
        throw new Exception('Добавьте картинку!');
     	}
    }
	catch (Exception $ex1) {
		//Выводим сообщение об исключении.
		$x = $ex1->getMessage();
	}

	// Работа с базой данных: добавление даты, текстовой информации
	if (isset($_POST['theme']) && isset($_POST['title']) && isset($_POST['message']) && isset($ourimage)) {
		try {
			if(!empty($_POST['theme']) && !empty($_POST['title']) && !empty($_POST['message'])){
				// Вычисление даты публикации - текущей даты
				$data = GetFullNowDateInCity(7);
				
				//Добавление информации в базу данных
				$sql="INSERT INTO articles(rubrika, article_name, data, image, article_text) VALUES (?, ?, '$data', '$ourimage', ?)"; 
				submitDb ($basa, $sql);
			}
			else {
				//Генерируем исключение
        		throw new Exception('Заполните все поля!');
			}
		}
		catch (Exception $ex) {
			//Выводим сообщение об исключении.
			$x2 = $ex->getMessage();
		}
	}
}