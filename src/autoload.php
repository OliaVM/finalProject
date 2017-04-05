<?php
require_once __DIR__ . '/../src/core/classes/Config.php';
//Добавление картинки
require_once __DIR__ . '/../src/core/functions/uploadImage.php';
// Добавление даты публикации
require_once __DIR__ . '/../src/core/functions/GetFullNowDateInCity.php';
//Подключение к базе данных
require_once __DIR__ . '/../src/core/classes/Config.php';
require_once __DIR__ . '/../src/core/functions/db.php';
//Добавление информации в базу данных
require_once __DIR__ . '/../src/core/functions/submitDb.php';
//вывод информации из БД
require_once __DIR__ . '/../src/core/functions/printTableBd.php';				
