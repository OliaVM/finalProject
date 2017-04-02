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

// Добавление новых данных в БД (в виде переменных)
$sql="INSERT INTO classics(author, title, category, year) VALUES ('author1', 'title1', 'category1', ?)";
$prep = $basa->prepare($sql);
$prep->execute([$_POST['year2']]);

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
            Введите год: <input type="text" name="year2" size="10" maxlength="10" value=""> <br>
            <input type="submit" value="загрузить на сервер">
        </form>
    </body>
</html>
