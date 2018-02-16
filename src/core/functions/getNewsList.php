<?php
function getNewsList($basa, $sql2) { 
	//$sql2 = "SELECT * FROM articles WHERE rubrika='$rubric'"; 
	$news_list = $basa->query($sql2);
	return $news_list;
}
?>