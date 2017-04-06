<form method="POST" ENCTYPE="multipart/form-data" accept-charset="UTF-8">
						   	  Выберите название рубрики: 
						   	  <SELECT name = "theme">
									<OPTION value = "russia">Россия
									<OPTION value = "world">Мир
									<OPTION value = "economics">Экономика
									<OPTION value = "science">Наука
									<OPTION value = "culture">Культура
									<OPTION value = "sport">Спорт
									<OPTION value = "travel">Путешествия
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



