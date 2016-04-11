use lightup;

drop table if exists users;

create table users (
	username VARCHAR(16) NOT NULL UNIQUE,
	password VARCHAR(150) NOT NULL,
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	CONSTRAINT user_length_check CHECK(LENGTH(username) > 3)
);

/* 1 - coolio */
INSERT INTO users(username,password) values("AwesomeSky", "9558f291865a9c4aaa4bc2af5e5e827dfaf39b081dacc72d4ef793737cf7d8fb680fe433faf596ab43cb1f0d12e5c4106aec50ee9281cf666d5fa9b58bd86d71");

/* 2 - pokeball */
INSERT INTO users(username,password) values("sean", "c59378200f6591d69b9734333bd002142d9a76969d37745fb00efd722050e72495795f8af0ba85bf598f36ed42ec3c1599fef8b15b6b82ea6b2b8a2dbda2c3df");

/* 3 - ketchup */    
INSERT INTO users(username,password) values("pikachu", "61b6bfe77ae210529ca911d5b87dbd4d31d4a801651bd4a5c5ea5c455b3f4694f114c807e3098daf063ef9686837306c545e9d87a494c9b9b0762f3dfee1c5c6"); 

/* 4 - money */   
INSERT INTO users(username,password) values("silvEr", "8977fbeabc9c89dba2eca9a66bd2d37df2d21f194b159bca7240544a3f54394ea3c4fb51a129c4b76824e457dc23d6d6b5091745ccb1164645bd2823f91f3764");

/* 5 - nevada */
INSERT INTO users(username,password) values("sierra", "d39f2532ab585a3198c65f047caa601f026c2c13918f6d5a621578e0527c25b4261c5bf6ea8dcf787c13fa234b3b57ef707016f3cdcf3fd6b5b755944c91af53");

/* 6 - turkey */
INSERT INTO users(username,password) values("california", "0e971ae6873ecbb3c028aa7295753a5fe13b87c28022c1f5395724eb2bb5f28ca10fc8a41b7f57e3159b96ca2b7f4085456bd572e5f7ac1d48c8a30b14aa1d82");