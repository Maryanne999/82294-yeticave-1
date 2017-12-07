<?php
require_once('functions.php');
session_start ();

$cookies_name = "lotinfo";
$cookies = null;
$path = "/";

$lot = $_POST['lot'] ?? '';
$bet = $_POST['bet'] ?? '';
$lotDate = $_POST['lotDate'] ?? '';
$lot_id = $_GET['lot_id'];

$cookie_arr = [
    $lot =>
    [
        'bet' => $bet,
        'lotDate' => $lotDate
    ]
];

if (isset($_COOKIE['lotinfo'])) {
    $cookies = json_decode($_COOKIE["lotinfo"], TRUE);

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
        'lotDate' => $lotDate,
        'lot_id' => $lot_id
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
}

print($layout_content);
?>