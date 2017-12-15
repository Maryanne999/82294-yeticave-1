<?php
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');

session_start ();

$required = ['email', 'password', 'name', 'contacts'];
$rules = ['email' => 'validateEmail'];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$contacts = $_POST['contacts'] ?? '';
$avatar;
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

                $sql = "SELECT * FROM users WHERE email = ?";
                $data = [$email];
                $stmt = db_get_prepare_stmt($connect, $sql, $data);
                $result = mysqli_stmt_execute($stmt);
            }
        }
    }

    if(empty($errors)) {
        $sql_reg = "INSERT INTO users (email, password, name, contacts, date_registered) VALUES (?, ?, ?, ?, NOW())";
        $data = [$email, $password, $name, $contacts];
        $stmt = db_get_prepare_stmt($connect, $sql, $data);
        $result_reg = mysqli_stmt_execute($stmt);
        if ($result_reg) {
            if (password_verify($password, $user['password'])) {
            header("Location: add-form.php");
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