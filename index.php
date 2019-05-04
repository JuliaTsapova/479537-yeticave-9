<?php
$is_auth = rand(0, 1);

$user_name = 'Юлия';

$categories = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное'
];

$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => $categories['boards'],
        'price' => 10999,
        'img_url' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => $categories['boards'],
        'price' => 159999,
        'img_url' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => $categories['attachment'],
        'price' => 8000,
        'img_url' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => $categories['boots'],
        'price' => 10999,
        'img_url' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => $categories['clothing'],
        'price' => 7500,
        'img_url' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => $categories['other'],
        'price' => 5400,
        'img_url' => 'img/lot-6.jpg'
    ]
];

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

require('helpers.php'); 

$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots,
    'time' => $time_before_tomorrow
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