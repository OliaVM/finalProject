<?php
//Подключение базы данных
//$user = 'root';
//$pass = 'vagrant';
$dns = 'mysql:host=localhost; dbname=publications';
$user = 'manager';
$pass = 'passwdord';
//$basa = new PDO('mysql:host=localhost; dbname=publications', $user, $pass);
$basa = new PDO($dns, $user, $pass);
//echo "connect";

//добавление в бд информации
echo "<br>";
$sql = 'SELECT * FROM classics'; 
$basa->exec("INSERT INTO classics(author, title, category, year) VALUES ('автор', 'название', 'жанр', '1893')");
foreach ($basa->query($sql) as $row) {
        echo $row['author'] . "\t";
        echo $row['title'] . "\t";
        echo $row['category'] . "\t";
        echo $row['year'] . "\n";
    }
?>
