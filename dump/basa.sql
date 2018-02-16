vagrant   up
vagrant   ssh
mysql -u root -p
CREATE DATABASE news; 
GRANT ALL ON news.* TO 'news'@'localhost' IDENTIFIED BY 'password';
USE news;
CREATE TABLE articles (rubrika VARCHAR (23),  article_name VARCHAR (150),  data VARCHAR (20),   image VARCHAR (50),   article_text VARCHAR(7000) )  ENGINE InnoDB, CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE articles ADD id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY;
