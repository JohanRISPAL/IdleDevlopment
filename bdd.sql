CREATE DATABASE IF NOT EXISTS idleDevlopment;
USE idleDevlopment;

CREATE TABLE Candidate(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	birthday date,
	poleEmploiNumber varchar(64),
	docket_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE ProjectManager(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	docket_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Admin(
	id int(11) NOT NULL AUTO_INCREMENT,
	login varchar(64),
	password varchar(64),
	name varchar(64),
	firstname varchar(64),
	docket_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Docket(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Result(
	id int(11) NOT NULL AUTO_INCREMENT,
	isPassed boolean,
	candidate_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Answer_Candidate(
	id int(11) NOT NULL AUTO_INCREMENT,
	answerCandidate int(11),
	candidate_ID int(11),
	question_ID int(11),
	test_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Answer(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	isTrue boolean,
	urlMedia varchar(64),
	question_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Question(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	isEliminatory boolean,
	urlMedia varchar(64),
	level_ID int(11),
	domain_ID int(11),
	test_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Level(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Domain(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Test(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	informationDay_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE InformationDay(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	dateOfDay date,
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Planing(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	informationDay_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Planing_Hour(
	id int(11) NOT NULL AUTO_INCREMENT,
	planing_ID int(11),
	hour_ID int(11),
	candidate_ID int(11),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE candidate_InformationDay (
    id int(11) NOT NULL AUTO_INCREMENT,
    candidate_ID int(11),
    informationday_ID int(11),
    PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

CREATE TABLE Hour(
	id int(11) NOT NULL AUTO_INCREMENT,
	label varchar(64),
	PRIMARY KEY (id)
)	DEFAULT CHARSET=utf8;

ALTER TABLE Candidate
ADD CONSTRAINT docket_Candidate_ID
FOREIGN KEY (docket_ID)
REFERENCES Docket(id);

ALTER TABLE Admin
ADD CONSTRAINT docket_Admin_ID
FOREIGN KEY (docket_ID)
REFERENCES Docket(id);

ALTER TABLE ProjectManager
ADD CONSTRAINT docket_ProjectManager_ID
FOREIGN KEY (docket_ID)
REFERENCES Docket(id);

ALTER TABLE Result
ADD CONSTRAINT candidate_ID
FOREIGN KEY (candidate_ID)
REFERENCES Candidate(id);

ALTER TABLE Answer_Candidate
ADD CONSTRAINT Answer_Candidate_Candidate_ID
FOREIGN KEY (candidate_ID)
REFERENCES Candidate(id);

ALTER TABLE Answer_Candidate
ADD CONSTRAINT Answer_Candidate_Question_ID
FOREIGN KEY (question_ID)
REFERENCES Question(id);

ALTER TABLE Answer_Candidate
ADD CONSTRAINT Answer_Candidate_Test_ID
FOREIGN KEY (test_ID)
REFERENCES Test(id);

ALTER TABLE Answer
ADD CONSTRAINT Answer_Question_ID
FOREIGN KEY (question_ID)
REFERENCES Question(id);

ALTER TABLE Question
ADD CONSTRAINT Question_Level_ID
FOREIGN KEY (level_ID)
REFERENCES Level(id);

ALTER TABLE Question
ADD CONSTRAINT Question_Domain_ID
FOREIGN KEY (domain_ID)
REFERENCES Domain(id);

ALTER TABLE Question
ADD CONSTRAINT Question_Test_ID
FOREIGN KEY (test_ID)
REFERENCES Test(id);

ALTER TABLE Test
ADD CONSTRAINT Test_InformationDay_ID
FOREIGN KEY (informationDay_ID)
REFERENCES InformationDay(id);

ALTER TABLE Planing
ADD CONSTRAINT Planing_InformationDay_ID
FOREIGN KEY (informationDay_ID)
REFERENCES InformationDay(id);

ALTER TABLE Planing_Hour
ADD CONSTRAINT Planing_Hour_Planing_ID
FOREIGN KEY (planing_ID)
REFERENCES Planing(id);

ALTER TABLE Planing_Hour
ADD CONSTRAINT Planing_Hour_Hour_ID
FOREIGN KEY (hour_ID)
REFERENCES Hour(id);

ALTER TABLE Planing_Hour
ADD CONSTRAINT Planing_Hour_Candidate_ID
FOREIGN KEY (candidate_ID)
REFERENCES Candidate(id);

ALTER TABLE candidate_informationday
ADD CONSTRAINT candidate_informationday_Candidate_ID
FOREIGN KEY (candidate_ID)
REFERENCES Candidate(id);

ALTER TABLE candidate_informationday
ADD CONSTRAINT candidate_informationday_InformationDay_ID
FOREIGN KEY (informationday_ID)
REFERENCES InformationDay(id)

INSERT INTO Docket (label)
VALUES ("Candidat"),
("ProjectManager"),
("Admin");

INSERT INTO ProjectManager (login, password, name, firstname, docket_ID)
VALUES ("projectManager", md5("projectManager"), "MANAGER", "Jean-ProjectManager", 2);

INSERT INTO Admin (login, password, name, firstname, docket_ID)
VALUES ("admin", md5("admin"), "ADMIN", "Jean-Admin", 3);