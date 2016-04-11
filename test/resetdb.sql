use lightup;

drop table if exists users;

/* Note: this will automatically create an index on the username since it is unique */
/* Note: Salting scheme is salt + pass = hashed_pass */
create table users (
<<<<<<< HEAD
	username VARCHAR(16) NOT NULL UNIQUE,
	password VARCHAR(150) NOT NULL,
=======
>>>>>>> 82fd4f5ff31232624e2ea65b0868a825bd212d82
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16) NOT NULL UNIQUE,
	salt VARCHAR(10) NOT NULL,
	hashed_pass VARCHAR(1000) NOT NULL,
	CONSTRAINT user_length_check CHECK(LENGTH(username) > 3)
);

<<<<<<< HEAD
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
=======
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
>>>>>>> 82fd4f5ff31232624e2ea65b0868a825bd212d82
