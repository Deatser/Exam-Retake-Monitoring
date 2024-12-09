-- Создание базы данных, если она не существует
CREATE DATABASE IF NOT EXISTS mydb;

-- Создание пользователя, если он не существует
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'example';

-- Предоставление прав на базу данных указанному пользователю
GRANT SELECT, UPDATE, INSERT ON mydb.* TO 'user'@'%';

-- Применение изменений
FLUSH PRIVILEGES;

-- Использование базы данных
USE mydb;

CREATE TABLE retakes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    monday VARCHAR(255) DEFAULT NULL,
    tuesday VARCHAR(255) DEFAULT NULL,
    wednesday VARCHAR(255) DEFAULT NULL,
    thursday VARCHAR(255) DEFAULT NULL,
    friday VARCHAR(255) DEFAULT NULL,
    saturday VARCHAR(255) DEFAULT NULL,
    sunday VARCHAR(255) DEFAULT NULL
);


