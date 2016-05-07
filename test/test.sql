USE lightup;

/* Table: users*/
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

/* Table: projects */
INSERT INTO projects(project_name, description, picture) VALUES ("LightUp", "Web Programming Final Project.", "views/lightup.svg");
INSERT INTO projects(project_name, description, picture) VALUES ("Sky Group, LTD.", "Skyler is awesome club.", "views/sky.jpg");
INSERT INTO projects(project_name, description, picture) VALUES ("Katana Knitting Needles", "Web Programming Final Project", "views/lightup.svg");

/* Table: profiles */
INSERT INTO profiles(user_id, blurb, city, state, country, phone, email) 
	VALUES (1, "Awesome Person", "New York City", "NY", "USA", "0123456789", "awesome@sky.com");
INSERT INTO profiles(user_id, blurb, city, state, country, phone, email) 
	VALUES (2, "Just another upstanding citizen from Bombay.", "Bombay", "NY", "USA", "3845093782", "arrow@sean.com");

/* Table: experiences */
INSERT INTO experiences(user_id, experience) VALUES(1, "Over 9000!!!");
INSERT INTO experiences(user_id, experience) VALUES(1, "Research Intern");
INSERT INTO experiences(user_id, experience) VALUES(1, "Mentor");
INSERT INTO experiences(user_id, experience) VALUES(1, "Co-manager");
INSERT INTO experiences(user_id, experience) VALUES(2, "Mentor");
INSERT INTO experiences(user_id, experience) VALUES(2, "Research Intern");
INSERT INTO experiences(user_id, experience) VALUES(3, "Hacktivist");

/* Table: skills */
INSERT INTO skills(user_id, skill) VALUES(1, "Awesomeness");
INSERT INTO skills(user_id, skill) VALUES(1, "Breakdance");
INSERT INTO skills(user_id, skill) VALUES(1, "Sponge-Bob");
INSERT INTO skills(user_id, skill) VALUES(1, "Running man");
INSERT INTO skills(user_id, skill) VALUES(2, "*&!^%*^&%(&^");
INSERT INTO skills(user_id, skill) VALUES(2, "C");
INSERT INTO skills(user_id, skill) VALUES(3, "Super programming skillz");
INSERT INTO skills(user_id, skill) VALUES(3, "Proficient in C");

/* Table: hobbies */
INSERT INTO hobbies(user_id, hobby) VALUES(1, "Being Awesome");
INSERT INTO hobbies(user_id, hobby) VALUES(2, "Art");
INSERT INTO hobbies(user_id, hobby) VALUES(2, "Customization");
INSERT INTO hobbies(user_id, hobby) VALUES(3, "Hacking");

/* Table: projects_member */
INSERT INTO projects_member(user_id,project_id) VALUES (1, 1);
INSERT INTO projects_member(user_id,project_id) VALUES (1, 2);
INSERT INTO projects_member(user_id,project_id) VALUES (2, 3);
INSERT INTO projects_member(user_id,project_id) VALUES (2, 1);
INSERT INTO projects_member(user_id,project_id) VALUES (3, 3);

/* Table: project_journal */
INSERT INTO project_journal(posting_user_id, project_id, title, body) VALUES (2, 3, 'Brilliant idea team!', 'I just had the greatest idea ever, it will make us millions!');
INSERT INTO project_journal(posting_user_id, project_id, title, body) VALUES (3, 3, 'Better idea team!', 'I just had a way better ida, it will make us billions!');