CREATE DATABASE first;

use first;

CREATE TABLE users (
	StudentID INT(10) UNSIGNED PRIMARY KEY, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	age INT(3),
	date TIMESTAMP
);