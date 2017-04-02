<?php
$dns = 'mysql:host=localhost; dbname=publications';
$user = 'manager';
$pass = 'passwdord';
$db = new PDO($dns, $user, $pass);

//фильтр по году
$sql = 'SELECT author, title, category, year FROM classics WHERE year < :year';
$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array(':year' => 2000));
$year= $sth->fetchAll();
var_dump($year);

//вывод таблицы  на экран
$sql2 = 'SELECT * FROM classics'; 
foreach ($db->query($sql2) as $row) {
        echo $row['author'] . "\t";
        echo $row['title'] . "\t";
        echo $row['category'] . "\t";
        echo $row['year'] . "\n";
    }
?>
