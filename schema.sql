CREATE DATABASE yeticave CHARACTER SET utf8 COLLATE utf8_bin;
use yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(255)
);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  creation_date DATETIME,
  name VARCHAR(255),
  description TEXT,
  image CHAR(32),
  price DECIMAL,
  end_date DATETIME,
  rate_step DECIMAL,
  author_id INT,
  winner_id INT,
  category_id CHAR
);

CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  price DECIMAL,
  user_id INT,
  lot_id INT
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) unique key,
  password CHAR(64),
  name VARCHAR(255),
  avatar VARCHAR(255),
  date_registered DATETIME,
  contacts VARCHAR(127),
  is_deleted TINYINT default 0
);

CREATE UNIQUE INDEX category_name ON categories(name);
CREATE UNIQUE INDEX email ON users(email);
CREATE UNIQUE INDEX user_name ON users(name);

CREATE INDEX lot_name ON lots(name);