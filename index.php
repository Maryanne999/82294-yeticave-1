<?php

require_once('functions.php');
require_once('init.php');

session_start();

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_time_remaining = $tomorrow - $now;
// задание 5
$lot_time_remaining = date("H:i", $lot_time_remaining);

//получение категорий из базы данных
$sql = "SELECT name FROM categories";

$result = mysqli_query($connect, $sql);

$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);


//получение лотов из базы данных

$sql_lots = "SELECT *, categories.name as 'category_name' FROM lots JOIN  categories ON lots.category_id = categories.id";

$result_lots = mysqli_query($connect, $sql_lots);

$lots = mysqli_fetch_all($result_lots, MYSQLI_ASSOC);

$content = renderTemplate(
    'index',
    [
        'categories' => $categories,
        'ads' => $ads,
        'lot_time_remaining' => $lot_time_remaining,
        'lots' => $lots
    ]
);
$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Главная',
		'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    ]
);
print($layout_content);
?>