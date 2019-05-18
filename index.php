<?php
$is_auth = rand(0, 1);

$user_name = 'Юлия';

/**
 * Возвращает отформатированное число для поля "цена" в лотах.
 * 
 * @param float $price Число, которое будет являться ценой;
 * 
 * @return string $price Готовое выражение, содержащее в себе отформатированное число.
 */

function format_price($price) {
    $price = number_format(ceil($price), 0, '', ' ');

    return $price . ' ₽';
}

date_default_timezone_set("Asia/Novosibirsk");

$time_before_tomorrow = strtotime('tomorrow') - time();

$timer = ($time_before_tomorrow / 3600 < 1) ? 'timer--finishing' : '';

require('helpers.php');


// Работа с БД.
$con = mysqli_connect('localhost', 'root', '', 'yeticave');

mysqli_set_charset($con, 'utf8');

if ($con == false) {
    print('Ошибка подключения: ' . mysqli_connect_error());
}
else {
    // print('Соединение установлено');

    // Получаем лоты.
    $sql = 'SELECT l.create_date, l.name, l.start_price, l.img, c.name AS category, (l.start_price  + MAX(r.price)) AS price  FROM lot l
    LEFT JOIN rate r on l.id = r.lot_id
    JOIN category c ON l.category_id = c.id
    WHERE NOW() < finish_time 
    GROUP by l.id
    ORDER BY l.create_date DESC;';
    $result = mysqli_query($con, $sql);

    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Получаем категории.
    $sql = 'SELECT name, code FROM category;';
    $result = mysqli_query($con, $sql);

    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}


// Передаем данные в шаблоны и отрисовываем их.
$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots,
    'time' => $time_before_tomorrow,
    'timer' => $timer
]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'user_name' => $user_name,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'categories' => $categories
]);

print($layout_content);

?>