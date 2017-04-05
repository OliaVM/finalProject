
		<form method="POST" ENCTYPE="multipart/form-data" accept-charset="UTF-8">
						   	  Выберите название рубрики: 
						   	  <SELECT name = "theme">
									<OPTION value = "Россия">Россия
									<OPTION value = "Мир">Мир
									<OPTION value = "Экономика">Экономика
									<OPTION value = "Наука">Наука
									<OPTION value = "Культура">Культура
									<OPTION value = "Спорт">Спорт
									<OPTION value = "Путешествия">Путешествия
							  </SELECT>
						   	  <br>
						   	  Введите название статьи (объемом до 150 знаков): 
						   	  <input type="text" name="title" size="152" maxlength="150" value=""> 
						   	  <br>
						      Введите текст статьи (объемом до 7000 знаков):  <br>
						      <textarea name="message" rows="10" cols="50" maxlength="7000" value=""></textarea>
						      <br>
						      Выберите картинку для загрузки: 
							  <input type="file" name="userfile">
							   <br>
							  <input type="submit" name="go" value="загрузить на сервер">
					    </form>
					</div>
					<div>
			  <?php	
			  	if (isset($x)) { // выполняем исключение, если оно есть
						echo "<h2>" . $x . "</h2>";
				}
				if (isset($x2)) { // выполняем исключение, если оно есть
						echo "<h2>" . $x2 . "</h2>";
				}

			  	
				$pathToConfig = __DIR__ . '/../config/app.php';
				$oConfig = new Config($pathToConfig);
				//$countOfNews = $oConfig->get('count_of_news');
				$dbConfig = $oConfig->get('db');
				$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
				//вывод информации из БД на экран
				
				$sql2 = "SELECT * FROM articles WHERE rubrika='Россия'"; 
				//if (!empty($basa->query('SELECT * FROM articles'))) {
				printTableBd($basa, $sql2);
				//}
				//if (isset($_POST['go'])) {
					//if (isset($_POST['theme']) && isset($_POST['title']) && isset($_POST['message']) && isset($ourimage)) {
						//if(!empty($_POST['theme']) && !empty($_POST['title']) && !empty($_POST['message'])) {
							$sql2 = 'SELECT * FROM articles'; 
							printTableBd($basa, $sql2);
						//}
					//}
					
				//}
			
			  ?>
			