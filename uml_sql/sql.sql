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

ALTER TABLE cours ADD COLUMN image varchar(500);

CREATE TABLE tags (
    id_tag INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_tag VARCHAR(50) NOT NULL
);

CREATE TABLE tagscours (
    id_tagscours INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_tag INT NOT NULL,
    id_cours INT NOT NULL
);


CREATE TABLE categories (
    id_categories INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_categories VARCHAR(50) NOT NULL
);

CREATE TABLE classcours (
    id_classcours INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cours INT NOT NULL,
	id_user INT NOT NULL,
    s_status ENUM('active', 'not_active') NOT NULL

)


ALTER TABLE user
ADD PRIMARY KEY (id_user);

ALTER TABLE role
ADD PRIMARY KEY (id_role);



ALTER TABLE user
ADD FOREIGN KEY (id_role) 
REFERENCES role(id_role);


ALTER TABLE tagscours
ADD FOREIGN KEY (id_tag) 
REFERENCES tags(id_tag);

ALTER TABLE tagscours
ADD FOREIGN KEY (id_cours) 
REFERENCES cours(id_cours);

ALTER TABLE classcours
ADD FOREIGN KEY (id_cours) 
REFERENCES cours(id_cours);

ALTER TABLE classcours
ADD FOREIGN KEY (id_user) 
REFERENCES user(id_user);