<?php
require_once('functions.php');

session_start();

$connect = mysqli_connect(
    'localhost', //host
    'root', //user
    '', //pass
    'yeticave' //db
);

mysqli_set_charset($connect, 'utf-8');

$categories = [];
$connect = '';

if (!$connect) {
    $error = mysqli_connect_error();
    exit();
    $errorPage = renderTemplate(
        'error',
        [
            'error' => $error,
            'connect' => $connect
        ]
    );
    $layout_content = renderTemplate(
        'layout',
        [
            'title' => 'Yeti Cave — Ошибка',
            'content' => $content,
            'email' => $email,
            'password' => $password,
            'users' => $users
        ]
    );
    print($layout_content);
}
else {
    print("Соединение установлено");
};
?>