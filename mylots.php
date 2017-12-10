<?php
require_once('functions.php');
//require_once('init.php');
require_once('lots_array.php');

session_start ();

$cookies_name = "lotinfo";
$cookies = null;
$path = "/";
$lot = $_POST['lot'] ?? '';
$bet = $_POST['cost'] ?? '';
$lotDate = strtotime('now');
$lot_id = $_GET['lot_id'];

if (isset($_GET['lot_id']) && isset($ads[$_GET['lot_id']]))  {
    $lot_item = $_GET['lot_id'];
    $lot = $ads[$lot_item];
};

$cookie_arr = [
    'bet' => $bet,
    'lotDate' => $lotDate,
    'name' => $lot['name'],
    'url' => $lot['url'],
    'price' => $lot['price'],
    'categories' => $lot['categories']
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
            'lot_id' => $lot_id,
            'name' => $lot['name'],
            'url' => $lot['url'],
            'price' => $lot['price'],
            'categories' => $lot['categories']
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