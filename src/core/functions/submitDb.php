<?php
//Добавление информации в базу данных
				function submitDb($basa, $sql) {
					$prep = $basa->prepare($sql);
					$arr = $prep->execute([$_POST['theme'],$_POST['title'], $_POST['message']]); 
					return $arr ;
				}
