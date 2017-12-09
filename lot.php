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

$lot = $_POST['lot'] ?? '';
$bet = $_POST['cost'] ?? '';
$lotDate = strtotime('now');
$lot_id = $_GET['lot_id'];

if (isset($_GET['lot_id']) && isset($ads[$_GET['lot_id']]))  {
	$lot_item = $_GET['lot_id'];
	$lot = $ads[$lot_item];
}
else {
	http_response_code (404);
		exit('Ошибка 404. Страница не найдена');
};

//Обработка формы отправки ставки и сохранение в куки значений
$required = ['bet'];
$errors = [];
$err_messages = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if (in_array($key, $required) && $value === '') {
            $errors[] = $key;
            $err_messages[$key] = 'Введите ставку';
            continue;
        }
    }
    //переменные ставок
    $cookies_name = "lotinfo";
    $cookies = null;
    $path = "/";
    $is_betted;

    $cookie_arr = [
        'bet' => $bet,
        'lotDate' => $lotDate,
        'lot_id' => $lot_id,
        'name' => $lot['name'],
        'url' => $lot['url'],
        'price' => $lot['price'],
        'categories' => $lot['categories']
    ];

    if(!empty($_POST)) {
        if (isset($_COOKIE['lotinfo'])) {//если куки уже есть
            $cookies = json_decode($_COOKIE["lotinfo"], TRUE);
            array_push($cookies, $cookie_arr);
            $for_cookie = json_encode($cookies);
            setcookie("lotinfo", $for_cookie);
            header("Location: /mylots.php");
        } else { //если нет куков с другими ставками
            $for_cookie = json_encode($cookie_arr);
            setcookie("lotinfo", $for_cookie);
            header("Location: /mylots.php");
        }
    }

};


$cookies = json_decode($_COOKIE["lotinfo"], TRUE);
$test = 1;
if ($cookies['lot_id'] == $_GET['lot_id']) {
    $is_betted = true;
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
        'errors' => $errors,
        'err_messages' => $err_messages,
        'lot' => $lot,
        'is_betted' => $is_betted,
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
        'title' => 'Yeti Cave — Страница лота',
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    )
);
print($layout_content);

?>
