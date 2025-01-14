CREATE DATABASE Youdemy;
use Youdemy;


CREATE TABLE user (
  id_user int NOT NULL,
  FullName varchar(100) NOT NULL,
  Password varchar(255) NOT NULL,
  Email varchar(250) NOT NULL,
  id_role int DEFAULT NULL,
  image_user varchar(255) DEFAULT NULL
)