<?php
require_once('functions.php');
require_once('init.php');

session_start ();

$required = ['email', 'password', 'name', 'contacts'];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$contacts = $_POST['contacts'] ?? '';
$errors = [];
$err_messages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (in_array($key, $required) && $value === '') {
            $errors[] = $key;
            $err_messages[$key] = 'Обязательное поле';
            continue;
        }
        if (in_array($key, $rules)) {
            $result= call_user_func('validateEmail', $value);
            if (!result) {
                $eerrors[] = $key;
            }
        }
    }

    if(!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($user = searchUserByEmail($email, $users)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /index.php");
            }
        }
    }
}


$content = renderTemplate(
    'sign-up',
    [
        'email' => $email,
        'password' => $password,
        'users' => $users,
        'required' => $required,
        'rules' => $rules,
        'errors' => $errors,
        'err_messages' => $err_messages
    ]
);

$layout_content = renderTemplate(
    'layout',
    array(
        'title' => 'Yeti Cave — Регистрация на сайте',
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    )
);
print($layout_content);


?>