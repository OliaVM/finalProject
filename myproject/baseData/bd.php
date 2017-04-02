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

//вывод информации из БД на php страницу
function getTable($basa) {
	$sql = 'SELECT * FROM classics'; 
    // ORDER BY year'; 
    //$sql = 'SELECT author, title, category, year FROM classics 
    // ORDER BY year'; 
    // сортировка по year
    foreach ($basa->query($sql) as $row) {
        echo $row['author'] . "\t";
        echo $row['title'] . "\t";
        echo $row['category'] . "\t";
        echo $row['year'] . "\n";
        echo "<br>";
    }
}
getTable(new PDO($dns, $user, $pass));

//добавление в бд информации
echo "<br>";
$basa->exec("INSERT INTO classics(author, title, category, year) VALUES ('автор', 'название', 'жанр', '1893')");
getTable(new PDO($dns, $user, $pass));
?>

