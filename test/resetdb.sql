USE lightup;

DROP TABLE IF EXISTS members_queue;
DROP TABLE IF EXISTS project_journal;
DROP TABLE IF EXISTS projects_member;
DROP TABLE IF EXISTS hobbies;
DROP TABLE IF EXISTS skills;
DROP TABLE IF EXISTS experiences;
DROP TABLE IF EXISTS profiles;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS users;


/* Note: this will automatically create an index on the username since it is unique */
CREATE TABLE users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16) NOT NULL UNIQUE,
	picture VARCHAR(500),
	hashed_pass VARCHAR(255) NOT NULL
);

/*  project(project_id, name, description, picture, creation_timestamp)*/
CREATE TABLE projects (
	project_id INT AUTO_INCREMENT PRIMARY KEY,
	project_name VARCHAR(40) NOT NULL UNIQUE,
	description TEXT,
	picture VARCHAR(500),
	creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

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


CREATE TABLE experiences(
	exp_id INT AUTO_INCREMENT,
	user_id INT,
	experience VARCHAR(1000),
	PRIMARY KEY(exp_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE skills(
	skill_id INT AUTO_INCREMENT,
	user_id INT,
	skill VARCHAR(1000),
	PRIMARY KEY(skill_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE hobbies(
	hobby_id INT AUTO_INCREMENT,
	user_id INT,
	hobby VARCHAR(1000),
	PRIMARY KEY(hobby_id, user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE projects_member (
	user_id INT NOT NULL,
	project_id INT NOT NULL,
	PRIMARY KEY(user_id,project_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id),
	FOREIGN KEY(project_id) REFERENCES projects(project_id)
);

/* project_journal(entry_id, user_id, project_id, title, body, entry_time)*/
CREATE TABLE project_journal (
	entry_id INT AUTO_INCREMENT NOT NULL,
	posting_user_id INT NOT NULL,
	project_id INT NOT NULL,
	title VARCHAR(30) NOT NULL,
	body TEXT NOT NULL, 
	entry_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (entry_id),
	FOREIGN KEY (posting_user_id) REFERENCES users(user_id),
	FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

/* members_queue(project_id, user_id) */
CREATE TABLE members_queue (
	project_id INT NOT NULL,
	user_id INT NOT NULL, 
	PRIMARY KEY (project_id, user_id),
	FOREIGN KEY (project_id) REFERENCES projects(project_id),
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);
