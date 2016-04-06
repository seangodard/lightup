use lightup;

drop table if exists users;

create table users (
	username VARCHAR(16) NOT NULL UNIQUE,
	password VARCHAR(1000) NOT NULL,
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	CONSTRAINT user_length_check CHECK(LENGTH(username) > 3)
);

INSERT INTO users(username,password) values("AwesomeSky", ""); /* 1 - coolio */
INSERT INTO users(username,password) values("sean", "");       /* 2 - pokeball */
INSERT INTO users(username,password) values("pikachu", "");    /* 3 - ketchup */
INSERT INTO users(username,password) values("silvEr", "");     /* 4 - money */
INSERT INTO users(username,password) values("sierra", "");     /* 5 - nevada */
INSERT INTO users(username,password) values("california", ""); /* 6 - turkey */