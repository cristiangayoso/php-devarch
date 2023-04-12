sudo mysql;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'mysql2023!';
\q
sudo mysql -p
CREATE DATABASE php_frameworks;
USE php_frameworks;
CREATE TABLE users(
	id integer PRIMARY KEY AUTO_INCREMENT,
	login varchar(50) NOT NULL UNIQUE,
	password varchar(40) NOT NULL,
	tstamp_create timestamp NOT NULL DEFAULT NOW(),
	tstamp_update timestamp NOT NULL DEFAULT NOW()
);