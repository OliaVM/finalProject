<?php
function generateSalt() {
		$salt = '';
		$saltLength = 8; //длина соли
		for($i=0; $i<$saltLength; $i++) {
			$salt .= chr(mt_rand(33,126)); //символ из ASCII-table 
			//Функция chr() используется для получения символа из кодировке ASCII 
			return $salt;
		}
}
