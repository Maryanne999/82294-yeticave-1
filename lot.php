<?php
require_once('functions.php');
require_once('lots_array.php');

session_start();

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

//переменные ставок
$cookies_name = "lotinfo";
$cookies = null;
$path = "/";

$lot = $_POST['lot'] ?? '';
$bet = $_POST['bet'] ?? '';
$lotDate = $_POST['lotDate'] ?? '';
$errors = [];
$err_messages = [];

$cookie_arr = [
    $lot =>
        [
            'bet' => $bet,
            'lotDate' => $lotDate
        ]
];


if (isset($_GET['lot_id']) && isset($ads[$_GET['lot_id']]))  {
	$lot_item = $_GET['lot_id'];
	$lot = $ads[$lot_item];
}
else {
	http_response_code (404);
		exit('Ошибка 404. Страница не найдена');
};

//Обработка формы отправки ставки и сохранение в куки значений
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (in_array($key) && $value === '') {
            $errors[] = $key;
            $err_messages[$key] = 'Введите ставку';
            continue;
        }
    }
    if(!empty($_POST)) {
        $bet = $_POST['bet'];
        $lotDate = $_POST['lotDate'];
        $lot = $_POST['lot'];
        setcookie($bet, $lotDate, $lot);{
                header("Location: /mylots.php");
        }
    }
};




$content = renderTemplate(
    'lot',
    [
        'lot_name' => $lot_name,
        'avatar' => $avatar,
        'message' => $message,
        'lot_rate' => $lot_rate,
        'lot_step' => $lot_step,
        'lotDate' => $lotDate,
        'file_url' => $file_url,
        'required' => $required,
        'category' => $category,
        'bets' => $bets,
        'email' => $email,
        'password' => $password,
        'users' => $users,
        'required' => $required,
        'rules' => $rules,
        'errors' => $errors,
        'err_messages' => $err_messages,
        'lot' => $lot

    ]
);

$layout_content = renderTemplate(
    'layout',
    array(
        'title' => 'Yeti Cave — Страница лота',
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    )
);
print($layout_content);

?>
