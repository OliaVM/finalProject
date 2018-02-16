<form method="POST" ENCTYPE="multipart/form-data" accept-charset="UTF-8">
	Выберите название рубрики: 
	<SELECT name = "rubric">
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
	<input type="text" name="article_title" size="52" maxlength="50" value=""> 
	<br>
	Введите краткий текст статьи (объемом до 500 знаков):  <br>
	<textarea name="article_short_text" rows="10" cols="70" maxlength="500" value=""></textarea>
	<br>
	Введите полный текст статьи (объемом до 5000 знаков):  <br>
	<textarea name="article_full_text" rows="10" cols="100" maxlength="5000" value=""></textarea>
	<br>
	Выберите картинку для загрузки: 
	<input type="file" name="userfile">
	<br>
	<input type="submit" name="go" value="загрузить на сервер">
</form>


