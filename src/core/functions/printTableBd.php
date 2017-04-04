<?php
//вывод информации из БД на экран
function printTableBd($basa, $sql2) {
					foreach ($basa->query($sql2) as $row) {
						echo "<br>"; 
						echo "<h2>" . $row['data'] . "<br>" . "</h2>";
						echo "<h2>" . $row['rubrika'] . "<br>" . "</h2>";
						echo "<h2>" . $row['article_name'] . "<br>" . "</h2>";
						echo '<img src="'.$row['image'].'">';
						echo "<br>"; 
						echo $row['article_text'] . "<br>";
						echo "<br>"; 
					}
				}