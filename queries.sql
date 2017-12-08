USE yeticave;

INSERT INTO categories SET name = 'Доски и лыжи', name = 'Крепления', name = 'Ботинки', name = 'Одежда',
name = 'Инструменты', name = 'Разное';

INSERT INTO users SET email = 'ignat.v@gmail.com', password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', name = 'Игнат';
INSERT INTO users SET email = 'kitty_93@li.ru', password = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', name = 'Леночка';
INSERT INTO users SET email = 'warrior07@mail.ru', password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', name = 'Руслан';

INSERT INTO lots SET name = '2014 Rossignol District Snowboard',
                     description = 'Нет описания'
                     image = 'img/lot-1.jpg',
                     price = '10999',
                     category = 'Доски и лыжи';

INSERT INTO lots SET name = 'DC Ply Mens 2016/2017 Snowboard',
                     description = 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                    снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                    просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.'
                     image = 'img/lot-2.jpg',
                     price = '159999',
                     category = 'Доски и лыжи';

INSERT INTO lots SET name = 'Крепления Union Contact Pro 2015 года размер L/XL',
                     description = 'Нет описания'
                     image = 'img/lot-3.jpg',
                     price = '8000',
                     category = 'Крепления';

INSERT INTO lots SET name = 'Ботинки для сноуборда DC Mutiny Charocal',
                     description = 'Нет описания'
                     image = 'img/lot-4.jpg',
                     price = '10999',
                     category = 'Ботинки';

INSERT INTO lots SET name = 'Куртка для сноуборда DC Mutiny Charocal',
                     description = 'Нет описания'
                     image = 'img/lot-5.jpg',
                     price = '7500',
                     category = 'Одежда';

INSERT INTO lots SET name = 'Маска Oakley Canopy',
                     description = 'Нет описания'
                     image = 'img/lot-6.jpg',
                     price = '5400',
                     category = 'Разное';

INSERT INTO bets SET  date = '5.12.2017',
                      price = '11500';

INSERT INTO bets SET  date = '1.12.2017',
                      price = '10500';

INSERT INTO bets SET  date = '21.11.2017',
                      price = '15000';



