<?php
require_once('functions.php');


$connect = mysqli_connect('localhost','root','','yeticave');

mysqli_set_charset($connect, 'utf8');

$categories = [];
$lots = [];
$bets = [];

session_start();

if (!$connect) {
    $error = 'Ошибка подключения:' . mysqli_connect_error();

    $content = renderTemplate(
        'error',
        [
            'error' => $error
        ]
    );
    $layout_content = renderTemplate(
        'layout',
        [
            'title' => 'Yeti Cave — Ошибка',
            'content' => $content
        ]
    );
    print($layout_content);
    exit();
};
?>