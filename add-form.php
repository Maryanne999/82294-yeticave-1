<?
require_once('functions.php');
require_once('init.php');
require_once('mysql_helper.php');
session_start();

$required = ['email', 'password'];
$rules = ['email' => 'validateEmail'];
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];
$err_messages = [];

//Валидация полей формы

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

        $sql = "SELECT * FROM users WHERE email = ?";
        $data = [$email];
        $stmt = db_get_prepare_stmt($connect, $sql, $data);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

	if (password_verify($password, $user['password'])) {
		$_SESSION['user'] = $user;
		header("Location: /index.php");
		 	}
	}
};


$content = renderTemplate(
    'add-form', [
            'email' => $email,
            'password' => $password,
            'users' => $users,
            'required' => $required,
            'rules' => $rules,
            'errors' => $errors,
            'categories' => $categories,
            'err_messages' => $err_messages
        ]
    );

$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Форма входа',
		'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    ]
);
print($layout_content);
?>