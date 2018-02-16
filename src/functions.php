<?php
session_start();
require_once '/var/www/html/src/autoload.php';
$pathToConfig = '/var/www/html/config/app.php';
$oConfig = new Config($pathToConfig);

//Подключение к БД - Connection with database
$dbConfig = $oConfig->get('db');
$basa  = getDbConnection($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
$basa->exec("set names utf8");

//router
if (isset($_GET['theme'])) {
	$rubric = $_GET['theme'];
}
//path from template.php to our page
if (isset($_GET['page_name'])) {
	$page_name = $_GET['page_name'];
	switch ($_GET['page_name']) {
		case 'news':
		$path = "/../pages/";
		break;
		case 'authorization_page':
		$path = "/../pages/";
		break;
		case 'registration_page':
		$path = "/../pages/";
		break;
		case 'admin_role_page':
		$path = "/../pages/protected_page/";
		break;
		case 'editor_role_page':
		$path = "/../pages/protected_page/";
		break;
		case 'delete_page':
		$path = "/../pages/protected_page/";
		break;
		case 'editor_page':
		$path = "/../pages/protected_page/";
		break;
		case 'get_list_of_users_page':
		$path = "/../pages/protected_page/";
		break;
	}
}
else {
	$page_name = "content";
	$path = "/";
}

//Проверка существования куки - Cookie existence check
require_once '/var/www/html/src/models/authorization/cookies.php';
//авторизация	- Authorization
require_once '/var/www/html/src/models/authorization/avtorization.php';
// регистрация - Registration
require_once '/var/www/html/src/models/authorization/registration.php';


//вывод информации из базы данных на страницы (c постраничной навигацией)
//display of information from database on page(with pagination)
require_once '/var/www/html/src/models/news_with_pagination_show.php';
// Работа с базой данных: - Work with database:
//Занесение в базу картинки и текстовой информации, добавленных пользователем; текущей даты,вычисленной с помощью функции 
//adding in database: picture and text information, which the user uploaded; date,calculated using the function 
require_once '/var/www/html/src/models/work_with_databases.php';
//счетчик лайков - Counter of likes
require_once '/var/www/html/src/models/actions_of_authorized_users/likes_counter.php';


