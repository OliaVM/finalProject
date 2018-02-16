<?php
session_start();
//Подключение к БД - Connection with database
require_once __DIR__ . '/../src/core/classes/Config.php';
$pathToConfig = '/var/www/html/config/app.php';
$oConfig = new Config($pathToConfig);
$dbConfig = $oConfig->get('db');
$basa  = new PDO($dbConfig['dns'], $dbConfig['user'], $dbConfig['password']);
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
require_once __DIR__ . '/../src/models/authorization/cookies.php';
//авторизация	- Authorization
require_once __DIR__ . '/../src/models/authorization/avtorization.php';
// регистрация - Registration
require_once __DIR__ . '/../src/models/authorization/registration.php';
//exit
require_once __DIR__ . '/../src/models/authorization/exit.php';


//вывод информации из базы данных на страницы (c постраничной навигацией)
//show information from database (with pagination)
require_once __DIR__ . '/../src/models/show_articles_with_pagination.php';
//add in database: picture and text information, date
require_once __DIR__ . '/../src/models/protected_actions/add_articles.php';
//add likes
require_once __DIR__ . '/../src/models/protected_actions/add_likes.php';
//delete article
require_once __DIR__ . '/../src/models/protected_actions/delete_article.php';
//add article	
require_once __DIR__ . '/../src/models/protected_actions/edit_article.php';


require_once __DIR__ . '/../src/views/main_views/template.php'; 





