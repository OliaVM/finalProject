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
if (isset($_GET['rubric'])) {
	$rubric = $_GET['rubric'];
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
//show information from database (with pagination)
require_once '/var/www/html/src/models/news_with_pagination_show.php';

//add in database: picture and text information, date
require_once '/var/www/html/src/models/work_with_databases.php';
//add likes
require_once '/var/www/html/src/models/actions_of_authorized_users/likes_counter.php';


