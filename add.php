<?php
require_once('functions.php');
require_once('init.php');
require_once('mysql_helper.php');

session_start ();



$sql = "SELECT name FROM categories";

$result = mysqli_query($connect, $sql);

$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!isset($_SESSION['user'])) {
	header(http_response_code(403));
}
else {

$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

//Валидация полей формы и проверка полей с цифрами
$required = ['lot-name', 'category', 'description', 'lot-rate', 'lot-step', 'lot-date'];
$num_fields = ['lot-step', 'lot-rate'];
$errors = [];
$err_messages = [];
$file_url;

//Сохранение значений формы
$lot_name = $_POST['lot-name'] ?? '';
$avatar = $_POST['avatar'] ?? '';
$description = $_POST['description'] ?? '';
$lot_rate = $_POST['lot-rate'] ?? '';
$lot_step = $_POST['lot-step'] ?? '';
$lotDate = $_POST['lot-date'] ?? '';
$category = $_POST['category'] ?? '';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
      if (in_array($key, $required) && $value === '') {
        $errors[] = $key;
        $err_messages[$key] = 'Обязательное поле';
		  continue;
      }
	  if(in_array($key, $num_fields) == true && is_numeric($value) == false) {
		  $errors[] = $key;
		  $err_messages[$key] = 'Введите целое положительное число';
	  }

   }

    if(strtotime($lot['lot_date']) < strtotime('tomorrow')) {
        $errors['lot_date'] = 'Введите дату больше текущей даты';
    }
    //Загрузка и сохранение фото
    if (isset($_FILES['avatar'])) {
        $file_name = $_FILES['avatar'] ['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = '/img/' . $file_name;

        move_uploaded_file($_FILES['avatar'] ['tmp_name'], $file_path . $file_name);

        $sql = 'INSERT INTO lots (creation_date, name, description, rate_step, image, price, category_id) VALUES (NOW(), ?, ?, ?, ?, ?)';
        $data = [$lotDate, $lot_name, $description, $lot_rate, $avatar, $category ];
        $stmt = db_get_prepare_stmt($connect, $sql, $data);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $lot_id = mysqli_insert_id($connect);

            header("Location: lot.php?lot_id=" . $lot_id);
        }
    }
    if (count($errors) == 0) {
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
                'bets' => $bets


            ]
        );
    } else{
        $content = renderTemplate(
            'add-lot',
            [
                'categories' => $categories,
                'errors' => $errors,
                'err_messages' => $err_messages,
                'lot_name' => $lot_name,
                'avatar' => $avatar,
                'message' => $message,
                'lot_rate' => $lot_rate,
                'lot_step' => $lot_step,
                'lotDate' => $lotDate,
                'file_url' => $file_url,
                'category' => $category
            ]
        );
    }
}
else {
    $content = renderTemplate(
        'add-lot',
        [
            'categories' => $categories,
            'errors' => $errors,
            'err_messages' => $err_messages,
            'lot_name' => $lot_name,
            'avatar' => $avatar,
            'message' => $message,
            'lot_rate' => $lot_rate,
            'lot_step' => $lot_step,
            'lotDate' => $lotDate,
            'file_url' => $file_url,
            'category' => $category

        ]
    );
}

$layout_content = renderTemplate(
    'layout',
    [
        'title' => 'Yeti Cave — Добавление лота',
		'content' => $content,
        'content' => $content,
        'email' => $email,
        'password' => $password,
        'users' => $users
    ]
);
print($layout_content);
}
?>