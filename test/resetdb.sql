USE lightup;

DROP TABLE IF EXISTS project_journal;
DROP TABLE IF EXISTS projects_member;
DROP TABLE IF EXISTS hobbies;
DROP TABLE IF EXISTS skills;
DROP TABLE IF EXISTS experiences;
DROP TABLE IF EXISTS profiles;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS users;

/* TODO : Split the schema from the test data and put them in the models folder : Sat 16 Apr 2016 11:21:00 AM EDT */
/* TODO : Add indexes? : Sat 16 Apr 2016 04:33:15 PM EDT */

/* TODO : Fix username length check not working : Mon 25 Apr 2016 05:53:35 PM EDT */
/* Note: this will automatically create an index on the username since it is unique */
CREATE TABLE users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16) NOT NULL UNIQUE,
	hashed_pass VARCHAR(255) NOT NULL
);

/* username = sky pass = coolio */
INSERT INTO users(username, hashed_pass) VALUES ("sky", "$2y$10$4hIG5/dkqLkm/y5ghYw9OenK/8eaIfDCOXgiUIkEZacOVfKC0nDbq");
/* username = sean pass = watson */
INSERT INTO users(username, hashed_pass) VALUES ("sean", "$2y$10$xXXIs1ryJyhzh8z7BXvfveY0F7hqnRl/IcwSzzpYD3qeWtHdKPI72");
/* username = alice pass = alpha */
INSERT INTO users(username, hashed_pass) VALUES ("alice", "$2y$10$ewk9.kUTBR/ZvTwWWS4LfeyjHhpvlWWHhsDWMMCVyhb6/zcPO/RZ.");
/* username = bob pass = bravo */
INSERT INTO users(username, hashed_pass) VALUES ("bob", "$2y$10$vVZgMSk/EMIzDUwKDt8.1es8ib/MQNhHklvK0IbdRS7aPeFOj7pT2");
/* username = craig pass = charlie */
INSERT INTO users(username, hashed_pass) VALUES ("craig", "$2y$10$5vrxTPRTikAYj36KwEvO2uaD.8SnQ9/BjtMy05I0yAlihCm1PyIzm");
/* username = domino pass = delta */
INSERT INTO users(username, hashed_pass) VALUES ("domino", "$2y$10$PIfFGTaqzeHNJcAY9X2N/.HfcPphfKJP9FTDtSFpDcdKmRBlRZO12");

/*  project(project_id, name, description, picture, creation_timestamp)*/
/* TODO: picture is the reference path to the directory containing the image [4/11/16] */
/* TODO : Why is this timestamp on update? Don't we want this never to change here? : Sat 16 Apr 2016 04:29:25 PM EDT */
CREATE TABLE projects (
	project_id INT AUTO_INCREMENT PRIMARY KEY,
	project_name VARCHAR(40) NOT NULL UNIQUE,
	description VARCHAR(1000),
	picture VARCHAR(500),
	creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO projects(project_name, description, picture) VALUES ("LightUp", "Web Programming Final Project.", "views/lightup.svg");
INSERT INTO projects(project_name, description, picture) VALUES ("Sky Group, LTD.", "Skyler is awesome club.", "views/sky.jpg");
INSERT INTO projects(project_name, description, picture) VALUES ("Katana Knitting Needles", "Web Programming Final Project", "views/lightup.svg");

/* users(user_id, username, password, profile_picture, name, blurb, city, state, country,
phone, email, experience, skills, hobbies) */
CREATE TABLE profiles (
	user_id INT PRIMARY KEY,
	blurb VARCHAR(1000),
	city VARCHAR(40),
	state VARCHAR(2),
	country VARCHAR(40),
	phone VARCHAR(10),
	email VARCHAR(40),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

INSERT INTO profiles(user_id, blurb, city, state, country, phone, email) 
	VALUES (1, "Awesome Person", "New York City", "NY", "USA", "0123456789", "awesome@sky.com");
INSERT INTO profiles(user_id, blurb, city, state, country, phone, email) 
	VALUES (2, "Just another upstanding citizen from Bombay.", "Bombay", "NY", "USA", "3845093782", "arrow@sean.com");


CREATE TABLE experiences(
	exp_id INT AUTO_INCREMENT,
	user_id INT,
	experience VARCHAR(1000),
	PRIMARY KEY(exp_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

INSERT INTO experiences(user_id, experience) VALUES(1, "Over 9000!!!");
INSERT INTO experiences(user_id, experience) VALUES(1, "Research Intern");
INSERT INTO experiences(user_id, experience) VALUES(1, "Mentor");
INSERT INTO experiences(user_id, experience) VALUES(1, "Co-manager");
INSERT INTO experiences(user_id, experience) VALUES(2, "Mentor");
INSERT INTO experiences(user_id, experience) VALUES(2, "Research Intern");
INSERT INTO experiences(user_id, experience) VALUES(3, "Hacktivist");

CREATE TABLE skills(
	skill_id INT AUTO_INCREMENT,
	user_id INT,
	skill VARCHAR(1000),
	PRIMARY KEY(skill_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

INSERT INTO skills(user_id, skill) VALUES(1, "Awesomeness");
INSERT INTO skills(user_id, skill) VALUES(1, "Breakdance");
INSERT INTO skills(user_id, skill) VALUES(1, "Sponge-Bob");
INSERT INTO skills(user_id, skill) VALUES(1, "Running man");
INSERT INTO skills(user_id, skill) VALUES(2, "*&!^%*^&%(&^");
INSERT INTO skills(user_id, skill) VALUES(2, "C");
INSERT INTO skills(user_id, skill) VALUES(3, "Super programming skillz");
INSERT INTO skills(user_id, skill) VALUES(3, "Proficient in C");

CREATE TABLE hobbies(
	hobby_id INT AUTO_INCREMENT,
	user_id INT,
	hobby VARCHAR(1000),
	PRIMARY KEY(hobby_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

INSERT INTO hobbies(user_id, hobby) VALUES(1, "Being Awesome");
INSERT INTO hobbies(user_id, hobby) VALUES(2, "Art");
INSERT INTO hobbies(user_id, hobby) VALUES(2, "Customization");
INSERT INTO hobbies(user_id, hobby) VALUES(3, "Hacking");

CREATE TABLE projects_member (
	user_id INT NOT NULL,
	project_id INT NOT NULL,
	PRIMARY KEY(user_id,project_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id),
	FOREIGN KEY(project_id) REFERENCES projects(project_id)
);

INSERT INTO projects_member(user_id,project_id) VALUES (1, 1);
INSERT INTO projects_member(user_id,project_id) VALUES (1, 2);
INSERT INTO projects_member(user_id,project_id) VALUES (2, 3);
INSERT INTO projects_member(user_id,project_id) VALUES (2, 1);
INSERT INTO projects_member(user_id,project_id) VALUES (3, 3);

/* project_journal(entry_id, user_id, project_id, title, body, entry_time)*/
/* TODO : Add check that the user is a member of the project before adding : Wed 20 Apr 2016 12:20:03 PM EDT */
CREATE TABLE project_journal (
	entry_id INT AUTO_INCREMENT NOT NULL,
	posting_user_id INT NOT NULL,
	project_id INT NOT NULL,
	title VARCHAR(40) NOT NULL,
	body VARCHAR(1000) NOT NULL, 
	entry_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (entry_id),
	FOREIGN KEY (posting_user_id) REFERENCES users(user_id),
	FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

/* Some journal test data */
INSERT INTO project_journal(posting_user_id, project_id, title, body) VALUES (2, 3, 'Brilliant idea team!', 'I just had the greatest idea ever, it will make us millions!');
INSERT INTO project_journal(posting_user_id, project_id, title, body) VALUES (3, 3, 'Better idea team!', 'I just had a way better ida, it will make us billions!');
