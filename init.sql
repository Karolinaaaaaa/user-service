CREATE DATABASE IF NOT EXISTS app_db;

CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON app_db.* TO 'user'@'%';
FLUSH PRIVILEGES;
