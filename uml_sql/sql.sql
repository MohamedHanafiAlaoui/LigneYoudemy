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

CREATE TABLE role (
  id_role int NOT NULL,
  type_role varchar(70) NOT NULL
)


CREATE TABLE cours (
    id_cours INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titre_cours VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    description VARCHAR(250),
    id_user INT NOT NULL,
    s_status ENUM('active', 'not_active') NOT NULL,
    id_categories INT NOT NULL,
    d_date DATETIME DEFAULT NULL
);