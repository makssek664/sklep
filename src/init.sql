CREATE DATABASE IF NOT EXISTS dev_db;

USE dev_db;

CREATE TABLE IF NOT EXISTS `users` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  type ENUM ('admin', 'manager', 'supplier', 'client')
);

INSERT INTO
  `users` (email, password, type)
VALUES
  (
    "qqq@qqq.com",
    "$2y$12$8Ppcagvt4Psv3hn9WopilOfAKjS7Z5CClzOvL9tnuzEzbRzhM9VYW",
    'admin'
  );
