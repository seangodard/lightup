use lightup;

drop table if exists users;

/* Note: this will automatically create an index on the username since it is unique */
/* Note: Salting scheme is salt + pass = hashed_pass */
create table users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16) NOT NULL UNIQUE,
	salt VARCHAR(10) NOT NULL,
	hashed_pass VARCHAR(1000) NOT NULL,
	CONSTRAINT user_length_check CHECK(LENGTH(username) > 3)
);

/* username = sky pass = coolio */
INSERT INTO users(username, salt, hashed_pass) VALUES ("sky", "vSCHdQxwSM", "51ef1d83515589011dac3bd247b40b68e60a5e287d1defb7299e329d49a11aae8381348386ec51962d95635cfd3c373f13295be3bbce166be0ae32a9bdf21819"); 
/* username = sean pass = watson */
INSERT INTO users(username, salt, hashed_pass) VALUES ("sean", "wOKOolrUSe", "840aac58f588cf42b9832165cd05a0a93e5f4ce14be05bfb8f99842f40952b694c15d003a38c22a0fdff1cc80823b978f06e688475763236ec6fb9862d593787");
/* username = alice pass = alpha */
INSERT INTO users(username, salt, hashed_pass) VALUES ("alice", "fAFYcmhoaJ", "0931a30632b623649f34c4fd79f77e47883c599ef12b66ed7f3967209656c0066ac0011a6d40b36004d7defd185769767ccafe02c4f266557a711f655fd04cc8");
/* username = bob pass = bravo */
INSERT INTO users(username, salt, hashed_pass) VALUES ("bob", "aoNUTFuPkw", "3328b52ee2d681498e3666d59ddc83db5b2e1ed69a3b637bc5cec4a453f3cf11ecd65eea759ad7356ed7e4b7707cacf60fbc951d35e402da137c17428e7cc978");
/* username = craig pass = charlie */
INSERT INTO users(username, salt, hashed_pass) VALUES ("craig", "esyytsMKmu", "1a85d4c52a7912c30519b632cfaeca3eee215521523953dba2d3d905937f691251b7802b2bb794d708674200416cbd6549ee377ba0ca932611df1b358f808aae");
/* username = domino pass = delta */
INSERT INTO users(username, salt, hashed_pass) VALUES ("domino", "gCCIfjBOwB", "3106762d861f84fcaff2f87fb176e7a35840256e8e2eb58d47a69d73daf938c2eeca73f924779360d4b472ab11e6c681e7f54d45befd909d9d086b37c85122aa");

# project(project_id, name, description, picture, creation_timestamp)
/* TODO: picture is the reference path to the directory containing the image [4/11/16] */
create table projects (
	project_id INT AUTO_INCREMENT PRIMARY KEY,
	project_name VARCHAR(40) NOT NULL UNIQUE,
	description VARCHAR(1000),
	picture VARCHAR(500),
	creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO projects(project_name, description, picture) VALUES ("LightUp", "Web Programming Final Project.", "views/lightup.svg");
INSERT INTO projects(project_name, description, picture) VALUES ("Sky Group, LTD.", "Skyler is awesome club.", "views/sky.jpg");
INSERT INTO projects(project_name, description, picture) VALUES ("Knitting Needle Katanas", "Web Programming Final Project", "views/lightup.svg");

/* users(user_id, username, password, profile_picture, name, blurb, city, state, country,
phone, email, experience, skills, hobbies) */
create table profiles (
	user_id INT PRIMARY KEY,
	blurb VARCHAR(1000),
	city VARCHAR(40),
	state VARCHAR(2),
	country VARCHAR(40),
	phone VARCHAR(10),
	email VARCHAR(40),
	experience VARCHAR(40),
	skills VARCHAR(40),
	hobbies VARCHAR(40),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

INSERT INTO profiles(user_id, blurb, city, state, country, phone, email, experience, skills, hobbies) 
	VALUES (1, "Awesome Person", "New York City", "NY", "USA", "0123456789", "awesome@sky.com", "Over 9000!!!", "Awesomeness", "Being Awesome");
INSERT INTO profiles(user_id, blurb, city, state, country, phone, email, experience, skills, hobbies) 
	VALUES (2, "Just another upstanding citizen from Bombay.", "Bombay", "NY", "USA", "3845093782", "arrow@sean.com", "*&!^%*^&%(&^", "Keeping it fresh", "Art");