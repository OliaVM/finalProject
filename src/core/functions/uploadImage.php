<?php
//Добавление картинки
function uploadImage($uploaddir, $nameOfimage) {
				$uploadfile = "$uploaddir$nameOfimage"; 
				//в переменную $uploadfile будет входить папка и имя изображения
				// проверяем загружается ли изображение 
				// проверяем продходит ли изображение по размеру и формату. Разрешенный размер - до 512 Кб
				//Допустимые форматы: jpg, jpeg, png
				if(($_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/png') && ($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size']<=512000)) { 
				// Указываем максимальный размер загружаемого файла. Сейчас до 512 Кб 
				  	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { //eсли файл действительно загружен на 
			           //сервер, он будет перемещён в "$uploaddir$apend"; 
					   //идет процесс загрузки изображения 
					   $size = getimagesize($uploadfile); 
					   // получаем размер пикселей изображения 
					   if ($size[0] < 501 && $size[1]<1501) { 
					     // если размер изображения не более 500 пикселей по ширине и не более 1500 по  высоте 
					     //echo "Файл загружен. Путь к файлу: <b>http://myproject.local/".$uploadfile."</b>"; 
					    } else {
				     		unlink($uploadfile); 
				     		// удаление файла 
				     	} 
				   	} 
				}
				return $uploadfile;
}


