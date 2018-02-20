CREATE USER nekop@localhost IDENTIFIED BY 'zeroday';
GRANT SELECT, INSERT, UPDATE, DELETE ON nekop.* to nekop@localhost IDENTIFIED BY 'zeroday';

CREATE DATABASE nekop DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use nekop;

CREATE TABLE user(
	idx int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(20) NOT NULL,
	password varchar(64) NOT NULL,
	auth int(1) NOT NULL,
	auth_time date NOT NULL,
	reg_time date NOT NULL
);

CREATE TABLE zero_day(
	idx int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL,
	description text NOT NULL,
	type int(10) NOT NULL
);

CREATE TABLE log(
	idx int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ip varchar(16) NOT NULL,
	url varchar(4096) NOT NULL,
	type int(1) NOT NULL,
	reason varchar(100) NOT NULL
);

insert into user values (0, 'KuroNeko', '30c473300d3d028d6d1966e2bf6191daeaf11abd89fa9979ed249e5e830971c6', 1, curdate(), curdate());
