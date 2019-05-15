USE yeticave;

-- Добавляем категории.
INSERT INTO category 
(code, name) VALUES
('boards', 'Доски и лыжи'),
('attachment', 'Крепления'),
('boots', 'Ботинки'),
('clothing', 'Одежда'),
('tools', 'Инструменты'),
('other', 'Разное');

-- Добавляем объявления.
INSERT INTO lot
(name, description, img, start_price, finish_time, step, user_id, winner_id, category_id) VALUES
('2014 Rossignol District Snowboard', NULL, 'img/lot-1.jpg', 10999, NOW() + INTERVAL 1 DAY, 100, 1, NULL, 1),
('DC Ply Mens 2016/2017 Snowboard', NULL, 'img/lot-1.jpg', 159999, NOW() + INTERVAL 2 DAY, 100, 2, NULL, 1),
('Крепления Union Contact Pro 2015 года размер L/XL', NULL, 'img/lot-3.jpg', 8000, NOW() + INTERVAL 3 DAY, 100, 2, NULL, 2),
('Ботинки для сноуборда DC Mutiny Charocal', NULL, 'img/lot-4.jpg', 10999, NOW() + INTERVAL 1 DAY, 100, 1, NULL, 3),
('Куртка для сноуборда DC Mutiny Charocal', NULL, 'img/lot-5.jpg', 7500, NOW() + INTERVAL 2 DAY, 100, 1, NULL, 4),
('Маска Oakley Canopy', NULL, 'img/lot-6.jpg', 5400, NOW() + INTERVAL 3 DAY, 100, 2, NULL, 6);

-- Добавляем пользователей.
INSERT INTO user
(email, name, password, img, contact) VALUES
('12tsapova@gmail.com', 'Julie', '12tsapova@gmail.com', NULL, '89089595934'),
('tsapova12@yandex.ru', 'Test Name', 'tsapova12@yandex.ru', NULL, '89138933877');

-- Добавляем ставки.
INSERT INTO rate
(price, user_id, lot_id) VALUES
(1000, 1, 3),
(700, 2, 5);

-- Получаем все категории.
SELECT * FROM category;

-- Получаем лоты.
SELECT l.create_date, l.name, l.start_price, l.img, c.name AS category, (l.start_price  + MAX(r.price)) AS price  FROM lot l
LEFT JOIN rate r on l.id = r.lot_id
JOIN category c ON l.category_id = c.id
WHERE NOW() < finish_time 
GROUP by l.id
ORDER BY l.create_date DESC;

-- Получить лот по его id.
SELECT l.id, l.name, c.name AS category FROM lot l
JOIN category c ON l.category_id = c.id
WHERE l.id = '2';

-- Обновить название лота по его идентификатору.
UPDATE lot
SET name = CONCAT('NEW NAME ', name)
WHERE id = '4';

-- Получить список самых свежих ставок для лота по его идентификатору.
SELECT * FROM rate 
WHERE lot_id = '5'
ORDER BY create_date DESC;

