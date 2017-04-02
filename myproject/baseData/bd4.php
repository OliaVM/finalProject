<?php
//Подключение базы данных
$dns = 'mysql:host=localhost; dbname=publications';
$user = 'manager';
$pass = 'passwdord';
$basa = new PDO($dns, $user, $pass);

/*
// Добавление переменных величин в БД (год не принимается)
$sql="INSERT INTO classics(author, title, category, year) VALUES ('author1', 'title1', 'category1', ':year')";
$prep = $basa->prepare($sql);
$prep->bindParam(':year',$year);
$year = 2017;
$prep->execute();
//$prep->execute([$_POST['year']]);
*/

// Добавление переменных величин в БД+++
$sql="INSERT INTO classics(author, title, category, year) VALUES (?, ?, ?, ?)";
$prep = $basa->prepare($sql);
$prep->execute([$_POST['author'],$_POST['title'], $_POST['category'], $_POST['year']]);
//$prep->execute([$_POST['title']]);
//$prep->execute([$_POST['category']]);
//$prep->execute([$_POST['year']]);

//вывод на экран данных из БД
$sql2 = 'SELECT * FROM classics'; 
foreach ($basa->query($sql2) as $row) {
    echo $row['author'] . "\t";
    echo $row['title'] . "\t";
    echo $row['category'] . "\t";
    echo $row['year'] . "\n";
    echo "<br>";
}
?>

<html>
    <head>
    </head>
    <body>
    	<form method="POST" >
	    	Введите автора: <input type="text" name="author" size="15" maxlength="15" value=""> <br>
	    	Введите название: <input type="text" name="title" size="50" maxlength="50" value=""> <br>
	    	Введите жанр: <input type="text" name="category" size="15" maxlength="15" value=""> <br>
            Введите год: <input type="text" name="year" size="5" maxlength="55" value=""> <br>
            <input type="submit" value="отправить">
        </form>
    </body>
</html>
