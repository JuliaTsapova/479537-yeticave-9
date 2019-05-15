DROP DATABASE IF EXISTS yeticave;

CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    code VARCHAR(255) NOT NULL UNIQUE
    );

CREATE TABLE lot (
    id INT AUTO_INCREMENT PRIMARY KEY,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    img VARCHAR(255) NOT NULL,
    start_price INT NOT NULL,
    finish_time DATETIME NOT NULL,
    step INT NOT NULL,
    user_id INT NOT NULL,
    winner_id INT,
    category_id INT NOT NULL
);

CREATE TABLE rate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    price INT NOT NULL,
    user_id INT NOT NULL,
    lot_id INT NOT NULL
);

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    img VARCHAR(255),
    contact VARCHAR(255) NOT NULL
)