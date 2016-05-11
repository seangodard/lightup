-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: lightup
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE lightup;

-- ------------------------------------------------------
/* User accounts and passwords */
-- ------------------------------------------------------
/* username = sky pass = coolio */
/* username = sean pass = watson */
/* username = alice pass = alpha */
/* username = bob pass = bravo */
/* username = craig pass = charlie */
/* username = domino pass = delta */
-- ------------------------------------------------------

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiences` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `experience` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`exp_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,1,'Over 9000!!!'),(2,1,'Research Intern'),(3,1,'Mentor'),(4,1,'Co-manager'),(5,2,'- Mentor'),(6,2,'- Researcher'),(7,3,'- Hacktivist'),(8,4,'- Praesent et ex vel justo rhoncus interdum.'),(9,5,'Java'),(10,6,'- Habitat for humanity volunteer'),(12,5,'C'),(13,5,'SQL'),(14,6,'- Museum guide'),(15,3,'- Paranormal Activity');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hobbies` (
  `hobby_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `hobby` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`hobby_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hobbies`
--

LOCK TABLES `hobbies` WRITE;
/*!40000 ALTER TABLE `hobbies` DISABLE KEYS */;
INSERT INTO `hobbies` VALUES (1,1,'Being Awesome'),(2,2,'- Art'),(3,2,'- Customization'),(4,3,'- Hacking'),(6,5,'Plot to take over the world'),(7,6,'- Graffiti'),(8,2,'- Problem Solving'),(9,4,'- Integer eget arcu pharetra elit'),(10,5,'Find goats on trees'),(11,6,'- Finding world peace'),(12,3,'- World\'s Largest Candy Collection');
/*!40000 ALTER TABLE `hobbies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_queue`
--

DROP TABLE IF EXISTS `members_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_queue` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `members_queue_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  CONSTRAINT `members_queue_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_queue`
--

LOCK TABLES `members_queue` WRITE;
/*!40000 ALTER TABLE `members_queue` DISABLE KEYS */;
INSERT INTO `members_queue` VALUES (3,1),(2,2),(5,2),(8,2),(4,3),(7,3),(8,4),(3,5),(8,6);
/*!40000 ALTER TABLE `members_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL,
  `blurb` varchar(1000) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Awesome Person. Ego princeps animae meae.','New York City','NY','USA','0123456789','awesome@sky.com'),(2,'Part time husky lover. Phasellus luctus elementum nisi, at consequat ante egestas non. In varius sem bibendum, eleifend diam in, dignissim purus. Aenean laoreet blandit dui in dapibus. Aliquam id efficitur odio, vel euismod felis. Fusce pulvinar a erat eget hendrerit. Morbi vehicula luctus eros non placerat. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. ','','NY','USA','3845093782','sean@godard.com'),(3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','','NY','','',''),(4,'Famous person used in programming examples around the world. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. Nunc ac turpis eget leo commodo eleifend. Integer eget arcu pharetra elit lobortis molestie eu vel purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lacinia ipsum at dignissim pellentesque.','Boston','Ma','USA','3895542139','bob@programmersunited.com'),(5,'All your base are belong to us. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo!','Mountain View','Ca','USA','6767677676','craig@127.0.0.1.com'),(6,'All day I think about art. lectus nisi vulputate erat, egestas suscipit tellus augue non tellus. Proin non sagittis nibh, in sodales sem. Ut dignissim vehicula suscipit. Praesent et ex vel justo rhoncus interdum. Integer dictum massa diam, sed posuere est luctus a. Duis sed tristique ante, egestas pellentesque tellus. Proin scelerisque velit laoreet felis varius mattis. Praesent eget odio orci. Sed aliquam porttitor metus, venenatis accumsan nunc dapibus et. Nullam feugiat elit nibh, id cursus nunc euismod nec. Sed at pellentesque lorem, a pharetra leo.','','','Australia','7773129840','domino29@art_world.com');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_journal`
--

DROP TABLE IF EXISTS `project_journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_journal` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `posting_user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `body` text NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`),
  KEY `posting_user_id` (`posting_user_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_journal_ibfk_1` FOREIGN KEY (`posting_user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `project_journal_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_journal`
--

LOCK TABLES `project_journal` WRITE;
/*!40000 ALTER TABLE `project_journal` DISABLE KEYS */;
INSERT INTO `project_journal` VALUES (1,2,3,'New thought!','Vestibulum consequat tortor turpis. Sed aliquet ligula rutrum quam sodales pretium. Aliquam erat volutpat. Maecenas pulvinar enim vitae rutrum porttitor. Nulla congue, sem eget gravida dignissim, ligula sem vehicula eros, commodo porta leo ipsum molestie mauris. Nulla sodales purus non augue semper, ut maximus sapien cursus. Cras interdum, risus nec semper viverra, ante dui pharetra leo, ut eleifend mi turpis sit amet nibh. Curabitur pellentesque consectetur ex molestie ultricies.\n\nPhasellus luctus elementum nisi, at consequat ante egestas non. In varius sem bibendum, eleifend diam in, dignissim purus. Aenean laoreet blandit dui in dapibus. Aliquam id efficitur odio, vel euismod felis. Fusce pulvinar a erat eget hendrerit. Morbi vehicula luctus eros non placerat. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. Nunc ac turpis eget leo commodo eleifend. Integer eget arcu pharetra elit lobortis molestie eu vel purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lacinia ipsum at dignissim pellentesque. Morbi commodo risus id gravida euismod.','2016-05-10 19:23:11'),(2,3,3,'Initial Idea','Listen up guys. I was just hit with the greatest idea ever. Katana Knitting Needles. I know what you guys are thinking, why hasn\'t anyone thought of this already? Aliquam id efficitur odio, vel euismod felis. Fusce pulvinar a erat eget hendrerit. Morbi vehicula luctus eros non placerat. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. Nunc ac turpis eget leo commodo eleifend. Integer eget arcu pharetra elit lobortis molestie eu vel purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lacinia ipsum at dignissim pellentesque. Morbi commodo risus id gravida euismod.','2016-05-10 19:20:50'),(3,2,1,'Initial Idea','LightUp is a website that we came up with to share ideas with others while the project is still in its infancy. We hope that this project will allow the users of the internet to come together to come up with new ideas and projects that they couldn\'t achieve on their own.','2016-05-10 19:04:17'),(4,2,3,'You\'re right this is awesome!','Hey guys, thanks for letting me join the group. Can\'t wait to get this project off the ground!  Praesent et ex vel justo rhoncus interdum. Integer dictum massa diam, sed posuere est luctus a. Duis sed tristique ante, egestas pellentesque tellus. Proin scelerisque velit laoreet felis varius mattis. Praesent eget odio orci. Sed aliquam porttitor metus, venenatis accumsan nunc dapibus et. Nullam feugiat elit nibh, id cursus nunc euismod nec. Sed at pellentesque lorem, a pharetra leo. Sed ullamcorper, libero at maximus consectetur, ipsum erat bibendum libero, in lobortis ligula ipsum sit amet mauris. Proin blandit orci vel erat malesuada dapibus. Vestibulum lacinia mi felis, eu convallis ante vestibulum et.\n','2016-05-10 19:22:28'),(5,1,1,'Future of the project','We hope to continue working on this project after we graduate. \n\nThere are plenty of more features that we can add in order for our site to be what we both envisioned, and of course, there is always room for improvements.\n\nCheers for the future of LightUp!','2016-05-10 19:23:01'),(6,6,4,'Here\'s the plan!','Nulla accumsan, lorem et tempus molestie, lectus nisi vulputate erat, egestas suscipit tellus augue non tellus. Proin non sagittis nibh, in sodales sem. Ut dignissim vehicula suscipit. Praesent et ex vel justo rhoncus interdum. Integer dictum massa diam, sed posuere est luctus a. Duis sed tristique ante, egestas pellentesque tellus. Proin scelerisque velit laoreet felis varius mattis. Praesent eget odio orci. Sed aliquam porttitor metus, venenatis accumsan nunc dapibus et. Nullam feugiat elit nibh, id cursus nunc euismod nec. Sed at pellentesque lorem, a pharetra leo. Sed ullamcorper, libero at maximus consectetur, ipsum erat bibendum libero, in lobortis ligula ipsum sit amet mauris. Proin blandit orci vel erat malesuada dapibus. Vestibulum lacinia mi felis, eu convallis ante vestibulum et.\n\nProin pellentesque iaculis nulla sit amet vestibulum. Donec suscipit tortor ac felis tempus molestie. Vestibulum pretium elit mollis mattis porttitor. Donec sollicitudin gravida orci at ultricies. Mauris sit amet vestibulum felis, nec cursus sapien. Donec convallis magna ac velit egestas, vel congue quam iaculis. Vestibulum quis mattis elit. Etiam in odio facilisis, interdum nulla sed, gravida lacus. Donec pellentesque fringilla mi, id rhoncus libero cursus eu. Nunc posuere convallis sollicitudin. Ut non mauris ut massa pretium aliquam interdum sodales erat. Donec vehicula luctus mauris, mattis dictum arcu ultrices sit amet.','2016-05-10 19:30:23'),(7,1,2,'I believe I can fly','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.','2016-05-10 19:41:09'),(8,1,2,'New project picture!','Check it out guys! Uploaded new project picture!\n\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?','2016-05-10 19:42:32'),(9,6,6,'New Plan','Fusce aliquam interdum maximus. Suspendisse gravida nunc et dolor malesuada, sed scelerisque ligula convallis. Nulla aliquam gravida tortor. In et cursus mi. Quisque vulputate pellentesque leo. Morbi sagittis enim et massa varius, sed iaculis eros ornare. In erat enim, scelerisque ac diam eget, ullamcorper tincidunt lectus. Praesent orci tortor, blandit ut dui at, venenatis venenatis erat. Curabitur sollicitudin, lorem ultricies efficitur pellentesque, metus metus tempus erat, sit amet lacinia dolor magna a nunc. Phasellus lorem lectus, molestie fermentum mauris a, bibendum aliquet massa. Nulla volutpat purus diam, a porttitor enim elementum at. Aliquam turpis nulla, aliquam vitae ex eu, consequat bibendum justo. Integer id velit sapien. Pellentesque nec massa ut libero congue venenatis. In nunc tellus, ultrices eget mattis tempor, ornare non tortor.\n\nNunc sodales tortor a finibus sodales. Nulla dictum gravida dolor, quis ullamcorper enim egestas vel. Maecenas metus urna, euismod at commodo eget, elementum vel sem. Curabitur viverra sodales ipsum in maximus. Fusce venenatis, libero venenatis eleifend tristique, diam sem vestibulum ligula, nec feugiat nisl est nec mi. Cras nisl leo, elementum quis lacus et, auctor interdum mi. Morbi lacinia rutrum nisl quis mollis.\n\nUt luctus, quam ac lacinia egestas, nulla lorem interdum magna, vel aliquam quam nunc in justo. Sed non eros vel ipsum mollis blandit quis sit amet tellus. Ut nec arcu odio. Morbi quis ipsum urna. Donec vulputate vehicula lacus nec sollicitudin. Curabitur vitae aliquam velit. Maecenas convallis neque semper, blandit urna vitae, varius tellus. Maecenas in pulvinar lorem, ac rutrum justo. Vestibulum laoreet tempor nulla id vehicula. Ut rutrum sapien a tellus ullamcorper, id semper nisi cursus. Sed blandit ultrices facilisis. Quisque tincidunt nunc ut diam fermentum ornare.\n\nVestibulum viverra nunc non nulla molestie tempor. Pellentesque ultrices vulputate pharetra. Vestibulum eget neque tincidunt, pharetra mauris at, dapibus neque. Cras quis lectus sit amet velit facilisis dapibus vel ultricies elit. Aliquam auctor cursus tellus. Morbi vestibulum nibh nec tortor ullamcorper molestie. Donec congue non turpis ac facilisis. Donec tincidunt nisi ac nulla interdum, a pharetra ipsum ultricies. Nunc dapibus eget augue in scelerisque. Aliquam sollicitudin purus in lobortis luctus.','2016-05-10 19:43:10'),(10,6,2,'Love the new image <3','Totally love the new pic!\n','2016-05-10 19:44:50'),(11,2,7,'So what\'s the plan?!','Fusce aliquam interdum maximus. Suspendisse gravida nunc et dolor malesuada, sed scelerisque ligula convallis. Nulla aliquam gravida tortor. In et cursus mi. Quisque vulputate pellentesque leo. Morbi sagittis enim et massa varius, sed iaculis eros ornare. In erat enim, scelerisque ac diam eget, ullamcorper tincidunt lectus. Praesent orci tortor, blandit ut dui at, venenatis venenatis erat. Curabitur sollicitudin, lorem ultricies efficitur pellentesque, metus metus tempus erat, sit amet lacinia dolor magna a nunc. Phasellus lorem lectus, molestie fermentum mauris a, bibendum aliquet massa. Nulla volutpat purus diam, a porttitor enim elementum at. Aliquam turpis nulla, aliquam vitae ex eu, consequat bibendum justo. Integer id velit sapien. Pellentesque nec massa ut libero congue venenatis. In nunc tellus, ultrices eget mattis tempor, ornare non tortor.\n\nNunc sodales tortor a finibus sodales. Nulla dictum gravida dolor, quis ullamcorper enim egestas vel. Maecenas metus urna, euismod at commodo eget, elementum vel sem. Curabitur viverra sodales ipsum in maximus. Fusce venenatis, libero venenatis eleifend tristique, diam sem vestibulum ligula, nec feugiat nisl est nec mi. Cras nisl leo, elementum quis lacus et, auctor interdum mi. Morbi lacinia rutrum nisl quis mollis.\n\nUt luctus, quam ac lacinia egestas, nulla lorem interdum magna, vel aliquam quam nunc in justo. Sed non eros vel ipsum mollis blandit quis sit amet tellus. Ut nec arcu odio. Morbi quis ipsum urna. Donec vulputate vehicula lacus nec sollicitudin. Curabitur vitae aliquam velit. Maecenas convallis neque semper, blandit urna vitae, varius tellus. Maecenas in pulvinar lorem, ac rutrum justo. Vestibulum laoreet tempor nulla id vehicula. Ut rutrum sapien a tellus ullamcorper, id semper nisi cursus. Sed blandit ultrices facilisis. Quisque tincidunt nunc ut diam fermentum ornare.\n\nVestibulum viverra nunc non nulla molestie tempor. Pellentesque ultrices vulputate pharetra. Vestibulum eget neque tincidunt, pharetra mauris at, dapibus neque. Cras quis lectus sit amet velit facilisis dapibus vel ultricies elit. Aliquam auctor cursus tellus. Morbi vestibulum nibh nec tortor ullamcorper molestie. Donec congue non turpis ac facilisis. Donec tincidunt nisi ac nulla interdum, a pharetra ipsum ultricies. Nunc dapibus eget augue in scelerisque. Aliquam sollicitudin purus in lobortis luctus.','2016-05-10 19:52:02'),(12,4,5,'Experiment 1','So I was playing with the formulas and I think I have made a breakthrough! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum velit risus, dignissim sit amet euismod id, commodo at ante. Fusce at laoreet magna. Nunc eu magna dolor. Etiam ac placerat mi. Ut pulvinar cursus est, et finibus nibh euismod vitae. Curabitur risus orci, laoreet ut blandit a, laoreet vel eros. Pellentesque a hendrerit diam, at scelerisque ante. In at nibh et lectus placerat vulputate in quis quam.\n\nFusce aliquam interdum maximus. Suspendisse gravida nunc et dolor malesuada, sed scelerisque ligula convallis. Nulla aliquam gravida tortor. In et cursus mi. Quisque vulputate pellentesque leo. Morbi sagittis enim et massa varius, sed iaculis eros ornare. In erat enim, scelerisque ac diam eget, ullamcorper tincidunt lectus. Praesent orci tortor, blandit ut dui at, venenatis venenatis erat. Curabitur sollicitudin, lorem ultricies efficitur pellentesque, metus metus tempus erat, sit amet lacinia dolor magna a nunc. Phasellus lorem lectus, molestie fermentum mauris a, bibendum aliquet massa. Nulla volutpat purus diam, a porttitor enim elementum at. Aliquam turpis nulla, aliquam vitae ex eu, consequat bibendum justo. Integer id velit sapien. Pellentesque nec massa ut libero congue venenatis. In nunc tellus, ultrices eget mattis tempor, ornare non tortor.\n\nNunc sodales tortor a finibus sodales. Nulla dictum gravida dolor, quis ullamcorper enim egestas vel. Maecenas metus urna, euismod at commodo eget, elementum vel sem. Curabitur viverra sodales ipsum in maximus. Fusce venenatis, libero venenatis eleifend tristique, diam sem vestibulum ligula, nec feugiat nisl est nec mi. Cras nisl leo, elementum quis lacus et, auctor interdum mi. Morbi lacinia rutrum nisl quis mollis.','2016-05-10 19:53:27'),(13,1,7,'New function','This function will help protect the world against all bugs. \nNo bugs means that everything works well.\nEverything works well mean that nothing breaks.\nNothing breaks means no need to fix it.\nNo need to fix it means spike in productivity.\nSpike in productivity means advanced machines.\nAdvanced machines means time machine.\nTime machine means...\n\nLet\'s go back and fix all bugs before deployment','2016-05-10 19:56:53'),(14,3,5,'Are you sure...?','Are you sure those formulas are correct??! I tried it and nearly burnt down the house! Ut luctus, quam ac lacinia egestas, nulla lorem interdum magna, vel aliquam quam nunc in justo. Sed non eros vel ipsum mollis blandit quis sit amet tellus. Ut nec arcu odio. Morbi quis ipsum urna. Donec vulputate vehicula lacus nec sollicitudin. Curabitur vitae aliquam velit. Maecenas convallis neque semper, blandit urna vitae, varius tellus. Maecenas in pulvinar lorem, ac rutrum justo. Vestibulum laoreet tempor nulla id vehicula. Ut rutrum sapien a tellus ullamcorper, id semper nisi cursus. Sed blandit ultrices facilisis. Quisque tincidunt nunc ut diam fermentum ornare.\n\nVestibulum viverra nunc non nulla molestie tempor. Pellentesque ultrices vulputate pharetra. Vestibulum eget neque tincidunt, pharetra mauris at, dapibus neque. Cras quis lectus sit amet velit facilisis dapibus vel ultricies elit. Aliquam auctor cursus tellus. Morbi vestibulum nibh nec tortor ullamcorper molestie. Donec congue non turpis ac facilisis. Donec tincidunt nisi ac nulla interdum, a pharetra ipsum ultricies. Nunc dapibus eget augue in scelerisque. Aliquam sollicitudin purus in lobortis luctus.','2016-05-10 19:54:36'),(15,4,7,'Are you guys sane...?','1010100010010010. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum velit risus, dignissim sit amet euismod id, commodo at ante. Fusce at laoreet magna. Nunc eu magna dolor. Etiam ac placerat mi. Ut pulvinar cursus est, et finibus nibh euismod vitae. Curabitur risus orci, laoreet ut blandit a, laoreet vel eros. Pellentesque a hendrerit diam, at scelerisque ante. In at nibh et lectus placerat vulputate in quis quam.\n\nFusce aliquam interdum maximus. Suspendisse gravida nunc et dolor malesuada, sed scelerisque ligula convallis. Nulla aliquam gravida tortor. In et cursus mi. Quisque vulputate pellentesque leo. Morbi sagittis enim et massa varius, sed iaculis eros ornare. In erat enim, scelerisque ac diam eget, ullamcorper tincidunt lectus. Praesent orci tortor, blandit ut dui at, venenatis venenatis erat. Curabitur sollicitudin, lorem ultricies efficitur pellentesque, metus metus tempus erat, sit amet lacinia dolor magna a nunc. Phasellus lorem lectus, molestie fermentum mauris a, bibendum aliquet massa. Nulla volutpat purus diam, a porttitor enim elementum at. Aliquam turpis nulla, aliquam vitae ex eu, consequat bibendum justo. Integer id velit sapien. Pellentesque nec massa ut libero congue venenatis. In nunc tellus, ultrices eget mattis tempor, ornare non tortor.\n\nNunc sodales tortor a finibus sodales. Nulla dictum gravida dolor, quis ullamcorper enim egestas vel. Maecenas metus urna, euismod at commodo eget, elementum vel sem. Curabitur viverra sodales ipsum in maximus. Fusce venenatis, libero venenatis eleifend tristique, diam sem vestibulum ligula, nec feugiat nisl est nec mi. Cras nisl leo, elementum quis lacus et, auctor interdum mi. Morbi lacinia rutrum nisl quis mollis.\n\nUt luctus, quam ac lacinia egestas, nulla lorem interdum magna, vel aliquam quam nunc in justo. Sed non eros vel ipsum mollis blandit quis sit amet tellus. Ut nec arcu odio. Morbi quis ipsum urna. Donec vulputate vehicula lacus nec sollicitudin. Curabitur vitae aliquam velit. Maecenas convallis neque semper, blandit urna vitae, varius tellus. Maecenas in pulvinar lorem, ac rutrum justo. Vestibulum laoreet tempor nulla id vehicula. Ut rutrum sapien a tellus ullamcorper, id semper nisi cursus. Sed blandit ultrices facilisis. Quisque tincidunt nunc ut diam fermentum ornare.\n\nVestibulum viverra nunc non nulla molestie tempor. Pellentesque ultrices vulputate pharetra. Vestibulum eget neque tincidunt, pharetra mauris at, dapibus neque. Cras quis lectus sit amet velit facilisis dapibus vel ultricies elit. Aliquam auctor cursus tellus. Morbi vestibulum nibh nec tortor ullamcorper molestie. Donec congue non turpis ac facilisis. Donec tincidunt nisi ac nulla interdum, a pharetra ipsum ultricies. Nunc dapibus eget augue in scelerisque. Aliquam sollicitudin purus in lobortis luctus.','2016-05-10 20:00:49'),(16,3,8,'Note to self.','Bring socks.','2016-05-10 20:09:39');
/*!40000 ALTER TABLE `project_journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(40) NOT NULL,
  `description` text,
  `picture` varchar(500) DEFAULT NULL,
  `creation_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `project_name` (`project_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'LightUp','Welcome to LightUp! LightUp is a website that we came up with to share ideas with others while the project is still in its infancy. We hope that this project will allow the users of the internet to come together to come up with new ideas and projects that they couldn\'t achieve on their own.','views/pictures/projects/lightup.svg','2016-05-10 19:03:41'),(2,'Sky Group, LTD.','Skyler is awesome club. Nulla accumsan, lorem et tempus molestie, lectus nisi vulputate erat, egestas suscipit tellus augue non tellus. Proin non sagittis nibh, in sodales sem. Ut dignissim vehicula suscipit. Praesent et ex vel justo rhoncus interdum. Integer dictum massa diam, sed posuere est luctus a. Duis sed tristique ante, egestas pellentesque tellus. Proin scelerisque velit laoreet felis varius mattis. Praesent eget odio orci. Sed aliquam porttitor metus, venenatis accumsan nunc dapibus et. Nullam feugiat elit nibh, id cursus nunc euismod nec. Sed at pellentesque lorem, a pharetra leo. Sed ullamcorper, libero at maximus consectetur, ipsum erat bibendum libero, in lobortis ligula ipsum sit amet mauris. Proin blandit orci vel erat malesuada dapibus. Vestibulum lacinia mi felis, eu convallis ante vestibulum et.\r\n\r\nProin pellentesque iaculis nulla sit amet vestibulum. Donec suscipit tortor ac felis tempus molestie. Vestibulum pretium elit mollis mattis porttitor. Donec sollicitudin gravida orci at ultricies. Mauris sit amet vestibulum felis, nec cursus sapien. Donec convallis magna ac velit egestas, vel congue quam iaculis. Vestibulum quis mattis elit. Etiam in odio facilisis, interdum nulla sed, gravida lacus. Donec pellentesque fringilla mi, id rhoncus libero cursus eu. Nunc posuere convallis sollicitudin. Ut non mauris ut massa pretium aliquam interdum sodales erat. Donec vehicula luctus mauris, mattis dictum arcu ultrices sit amet.','views/pictures/projects/project1stars.jpg','2016-05-10 19:41:22'),(3,'Katana Knitting Needles','Listen up guys. I was just hit with the greatest idea ever. Katana Knitting Needles. I know what you guys are thinking, why hasn\'t anyone thought of this already? Aliquam id efficitur odio, vel euismod felis. Fusce pulvinar a erat eget hendrerit. Morbi vehicula luctus eros non placerat. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. Nunc ac turpis eget leo commodo eleifend. Integer eget arcu pharetra elit lobortis molestie eu vel purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lacinia ipsum at dignissim pellentesque. Morbi commodo risus id gravida euismod.','views/pictures/projects/project2katana_knitting_kneedles.jpg','2016-05-10 19:36:21'),(4,'Save the world! With art!','How can art save the world? Join and we can do this together! Suspendisse viverra enim et nisl ultricies rhoncus. Suspendisse eu ultricies felis, a sollicitudin elit. Aenean pharetra, sapien eget pellentesque venenatis, lorem massa sollicitudin velit, eu fringilla nunc sapien consequat mauris. Sed sit amet volutpat diam, et suscipit est. Pellentesque vel magna et neque volutpat pretium. Pellentesque ornare lorem mattis turpis auctor venenatis. Donec nisl dui, molestie eget posuere a, posuere et ex. Vestibulum consequat tortor turpis. Sed aliquet ligula rutrum quam sodales pretium. Aliquam erat volutpat. Maecenas pulvinar enim vitae rutrum porttitor. Nulla congue, sem eget gravida dignissim, ligula sem vehicula eros, commodo porta leo ipsum molestie mauris. Nulla sodales purus non augue semper, ut maximus sapien cursus. Cras interdum, risus nec semper viverra, ante dui pharetra leo, ut eleifend mi turpis sit amet nibh. Curabitur pellentesque consectetur ex molestie ultricies.\r\n\r\nPhasellus luctus elementum nisi, at consequat ante egestas non. In varius sem bibendum, eleifend diam in, dignissim purus. Aenean laoreet blandit dui in dapibus. Aliquam id efficitur odio, vel euismod felis. Fusce pulvinar a erat eget hendrerit. Morbi vehicula luctus eros non placerat. Suspendisse eleifend gravida odio sodales convallis. Integer vel dignissim nibh, non venenatis nisi. Nam viverra, eros eget interdum rutrum, nulla tortor pharetra massa, sit amet ultricies neque metus at lacus. Sed auctor, mi sit amet hendrerit auctor, ipsum nisl mollis mauris, in consequat nunc massa at enim. Nunc ac turpis eget leo commodo eleifend. Integer eget arcu pharetra elit lobortis molestie eu vel purus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec lacinia ipsum at dignissim pellentesque. Morbi commodo risus id gravida euismod.','views/pictures/projects/project6group.jpg','2016-05-10 19:29:33'),(5,'Candy Pencils','Ever wanted to eat candy while in class but couldn\'t because you didn\'t have any? Ever had the nervous habit of biting your pencil while trying to focus on the lecture but couldn\'t because you were too hungry? Please join me as I start my quest to make candy pencils! The one and only useful snack you\'ll ever need (until you finish it...)\r\n\r\nNOTE: I cannot be held responsible for any food poisoning experienced during testing.','views/pictures/projects/project3candypencil.png','2016-05-10 19:33:34'),(6,'Art fights fire!','Proin dignissim dui in sapien iaculis, vitae maximus nisl pretium. Aliquam erat volutpat. Sed in arcu condimentum, euismod nibh non, vulputate nunc. Etiam eget sapien tempus, faucibus turpis id, blandit neque. Aliquam erat volutpat. Nam pulvinar mollis tortor vel sagittis. Vivamus dignissim, felis et dictum porta, sem leo aliquam eros, quis pulvinar quam leo non mi. Ut felis quam, elementum vitae orci a, laoreet efficitur sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur at sollicitudin velit. Aliquam a elit a lectus porttitor congue. Duis at elit quis dolor vulputate malesuada eu quis sem. Nam vestibulum quam dictum dolor gravida, at consectetur leo placerat. Vestibulum commodo accumsan tortor eget pharetra.\r\n\r\nNulla facilisi. Phasellus in est egestas, porta arcu quis, laoreet quam. Fusce commodo mauris vitae nulla condimentum, sit amet vulputate magna feugiat. Cras in luctus dui, a consectetur risus. Aliquam id risus quis risus congue ornare quis non tellus. Mauris pulvinar, sem id efficitur fermentum, velit ipsum commodo nunc, nec efficitur quam nisl et erat. Suspendisse id egestas purus. In interdum risus vel nulla elementum pellentesque. Nullam et dapibus enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean nec orci ornare, accumsan lectus quis, rutrum orci. Proin faucibus ut nulla sit amet euismod. Maecenas tempus turpis lorem, vel suscipit elit vulputate bibendum. Ut urna enim, aliquet vel pretium sit amet, luctus quis metus.\r\n\r\nVestibulum vitae magna non erat bibendum facilisis. Aliquam maximus ut nunc vel lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec at justo vitae velit aliquam pharetra. Sed sem orci, volutpat sit amet nisl at, ultrices venenatis massa. Morbi blandit, risus vel posuere laoreet, mauris arcu fermentum risus, non egestas tortor ante id urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel urna maximus, maximus nisl fermentum, accumsan urna. Proin id nisi a turpis lacinia placerat.','views/pictures/projects/project6fire-art-wallpaper-preview-4.jpg','2016-05-10 19:42:04'),(7,'Save the world! With Code!','public static void main(String[] args) {\r\n    System.out.println(\"Hello World\");\r\n}','views/pictures/projects/project1comp.png','2016-05-10 19:49:24'),(8,'Wonderland','So, LightUp community... I think I found something that I shouldn\'t have. There is a hole in my backyard and it goes somewhere... strange. I need a team of adventures to join in and help take note of the journey deep down the rabbit hole...','views/pictures/projects/project3nature_big_tree_hd.jpg','2016-05-10 20:05:59');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_member`
--

DROP TABLE IF EXISTS `projects_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_member` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `projects_member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `projects_member_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_member`
--

LOCK TABLES `projects_member` WRITE;
/*!40000 ALTER TABLE `projects_member` DISABLE KEYS */;
INSERT INTO `projects_member` VALUES (1,1),(2,1),(1,2),(6,2),(2,3),(3,3),(6,4),(3,5),(4,5),(6,6),(1,7),(2,7),(4,7),(3,8);
/*!40000 ALTER TABLE `projects_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `skill` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`skill_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,1,'Awesomeness'),(2,1,'Breakdance'),(3,1,'Sponge-Bob'),(4,1,'Running man'),(5,2,'- Programming'),(6,2,'-Ut dignissim'),(7,3,'- Super programming skillz'),(8,4,'- Nunc ac turpis eget leo'),(9,5,'Full stack'),(10,6,'- Painting'),(11,6,'');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `picture` varchar(500) DEFAULT NULL,
  `hashed_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sky','views/pictures/profiles/sky.png','$2y$10$4hIG5/dkqLkm/y5ghYw9OenK/8eaIfDCOXgiUIkEZacOVfKC0nDbq'),(2,'sean','views/pictures/profiles/lion.jpg','$2y$10$xXXIs1ryJyhzh8z7BXvfveY0F7hqnRl/IcwSzzpYD3qeWtHdKPI72'),(3,'alice','views/pictures/profiles/profile3candy.png','$2y$10$ewk9.kUTBR/ZvTwWWS4LfeyjHhpvlWWHhsDWMMCVyhb6/zcPO/RZ.'),(4,'bob','views/pictures/profiles/profile4code.jpg','$2y$10$vVZgMSk/EMIzDUwKDt8.1es8ib/MQNhHklvK0IbdRS7aPeFOj7pT2'),(5,'craig','views/pictures/profiles/profile5smiley.png','$2y$10$5vrxTPRTikAYj36KwEvO2uaD.8SnQ9/BjtMy05I0yAlihCm1PyIzm'),(6,'domino','views/pictures/profiles/profile6domino-square_0.png','$2y$10$PIfFGTaqzeHNJcAY9X2N/.HfcPphfKJP9FTDtSFpDcdKmRBlRZO12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-10 16:13:03
