CREATE DATABASE IF NOT EXISTS idleDevlopment;

CREATE TABLE Candidat(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	birthday date,
	poleEmploiNumber varchar(64),
	idRole int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE ProjectManager(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	idRole int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Admin(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	idRole int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Role(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Test(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	idCreator int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE InformationDay(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	dateOfTheDay date,
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Question(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(300),
	level varchar(64),
	isEliminatory boolean,
	idCaracteristic int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE QuestionMedia(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(300),
	level varchar(64),
	isEliminatory boolean,
	idCaracteristic int(11),
	urlMedia varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE TestQuestion(
	id int(11) NOT NULL AUTO_INCREMENT,
	idTest int(11),
	idQuestion int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Caracteristic(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Response(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE ResponseMedia(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	urlMedia varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE QuestionResponse(
	id int(11) NOT NULL AUTO_INCREMENT,
	idQuestion int(11),
	idResponse int(11),
	isRight boolean,
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

ALTER TABLE Candidat
ADD CONSTRAINT id_Role
FOREIGN KEY (idRole)
REFERENCES Role(id);

ALTER TABLE ProjectManager
ADD CONSTRAINT id_RoleManager
FOREIGN KEY (idRole)
REFERENCES Role(id);

ALTER TABLE Admin
ADD CONSTRAINT id_RoleAdmin
FOREIGN KEY (idRole)
REFERENCES Role(id);

ALTER TABLE Test
ADD CONSTRAINT id_Creator
FOREIGN KEY (idCreator)
REFERENCES Admin(id);

ALTER TABLE Question
ADD CONSTRAINT id_Caracteristic
FOREIGN KEY (idCaracteristic)
REFERENCES Caracteristic(id);

ALTER TABLE QuestionMedia
ADD CONSTRAINT id_CaracteristicMedia
FOREIGN KEY (idCaracteristic)
REFERENCES Caracteristic(id);

ALTER TABLE TestQuestion
ADD CONSTRAINT id_Test
FOREIGN KEY (idTest)
REFERENCES Test(id);

ALTER TABLE TestQuestion
ADD CONSTRAINT id_Question
FOREIGN KEY (idQuestion)
REFERENCES Question(id);

ALTER TABLE QuestionResponse
ADD CONSTRAINT id_ResponseQuestion
FOREIGN KEY (idQuestion)
REFERENCES Question(id);

ALTER TABLE QuestionResponse
ADD CONSTRAINT id_QuestionResponse
FOREIGN KEY (idResponse)
REFERENCES Response(id);

INSERT INTO Role (label)
VALUES ("Candidat"),
("ProjectManager"),
("Admin");

INSERT INTO ProjectManager (login, password, name, firstname, idRole)
VALUES ("projectManager", md5("projectManager"), "MANAGER", "Jean-ProjectManager", 2);

INSERT INTO Admin (login, password, name, firstname, idRole)
VALUES ("admin", md5("admin"), "ADMIN", "Jean-Admin", 3);

INSERT INTO Caracteristic (label)
VALUES ("Php"),
("HTML");