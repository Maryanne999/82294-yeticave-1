USE yeticave;

INSERT INTO categories (name) VALUES ('Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное');

INSERT INTO users (email, password, name, date_registered, contacts) VALUES ('ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Игнат', '02.11.2017', 'Санкт-Петербург, ул. Невский проспект, 28. Тел.: +7 812 448-23-55'),
('kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Леночка', '29.09.2017', 'Москва, ул. Арбат, 53. Тел.: +7 499 241-92-95'),
('warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Руслан', '15.11.2017', 'Пятигорк, ул. Лермонтова, 14. Тел.: +7 928 999-90-05');

INSERT INTO lots (id, name, num_rate, description, image, price, category)  VALUES
('1', '2014 Rossignol District Snowboard', '3', 'Вы еще не ломали ноги? Тогда мы идем к вам', 'img/lot-1.jpg', '10999', 'Доски и лыжи'),
('2', 'DC Ply Mens 2016/2017 Snowboard', '2', 'Легкий маневренный сноуборд, готовый дать жару в любом парке.', 'img/lot-2.jpg', '159999', 'Доски и лыжи'),
('3', 'Крепления Union Contact Pro 2015 года размер L/XL', '5', 'Нет описания', 'img/lot-3.jpg', '8000', 'Крепления'),
('4', 'Ботинки для сноуборда DC Mutiny Charocal', '4', 'Такие ботинки будут только у вас и у Дональда Трампа', 'img/lot-4.jpg', '10999', 'Ботинки'),
('5', 'Куртка для сноуборда DC Mutiny Charocal', '6', 'Супер-пупер куртка', 'img/lot-5.jpg', '7500', 'Одежда'),
('6', 'Маска Oakley Canopy', '7', 'Анастейша Стил нервно курит', 'img/lot-6.jpg', '5400','Разное');

INSERT INTO bets  (date, price, user_id, lot_id) VALUES ('5.12.2017', '11500', '1', '10'), ('1.12.2017', '10500', '2', '20'), ('21.11.2017', '15000', '3', '30');


--Получение категорий
SELECT name FROM categories;

--Получение новых лотов
SELECT  name, num_rate, description, image, price, category FROM lots /*Как получить самые новые, исходя из имеющихся данных*/

--Получение лота по название и описанию
SELECT * FROM lots WHERE  name = 'Куртка для сноуборда DC Mutiny Charocal';
SELECT * FROM lots WHERE description = 'Супер-пупер куртка';

--Обновление название лота по идентификтору

UPDATE lots SET name = 'Маска Cтил' WHERE id = '6';

--Получение новых ставок по id

SELECT  * FROM bets ORDER BY id DESC;
