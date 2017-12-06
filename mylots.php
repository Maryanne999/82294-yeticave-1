<?php
require_once('functions.php');
session_start ();

$cookies_name = "lotinfo";
$cookies = null;
$path = "/";

$lot = $_POST['lot'] ?? '';
$bet = $_POST['bet'] ?? '';
$lotDate = $_POST['lotDate'] ?? '';

$cookie_arr = [
    $lot =>
    [
        'bet' => $bet,
        'lotDate' => $lotDate
    ]
];




$content = renderTemplate(
    'mylots',
    [
        'email' => $email,
        'password' => $password,
        'users' => $users,
        'required' => $required,
        'rules' => $rules,
        'errors' => $errors,
        'err_messages' => $err_messages,
        'cookies_name' => $cookies_name,
        'cookies' => $cookies,
        'path' => $path,
        'lot' => $lot,
        'bet' => $bet,
        'lotDate' => $lotDate
    ]
);

$layout_content = renderTemplate(
    'layout',
    array(
        'title' => 'Yeti Cave — Мои ставки',
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    )
);
print($layout_content);
?>
