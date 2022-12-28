-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: ::1    Database: local
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `attachment` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachment`
--

LOCK TABLES `attachment` WRITE;
/*!40000 ALTER TABLE `attachment` DISABLE KEYS */;
INSERT INTO `attachment` VALUES (1,'user.png',0,0);
INSERT INTO `attachment` VALUES (2,'2-Screenshot 2022-10-23 at 10.02.07 PM.png',6,1);
INSERT INTO `attachment` VALUES (3,'1-Screenshot 2022-10-23 at 10.02.07 PM.png',5,8);
INSERT INTO `attachment` VALUES (4,'4-Login Page.png',4,1);
/*!40000 ALTER TABLE `attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authentication`
--

DROP TABLE IF EXISTS `authentication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `authentication` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(999) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authentication`
--

LOCK TABLES `authentication` WRITE;
/*!40000 ALTER TABLE `authentication` DISABLE KEYS */;
INSERT INTO `authentication` VALUES (4,3,'3ff65b1e1d6d041a2d964afd3256c156','2022-10-29 23:37:00');
INSERT INTO `authentication` VALUES (8,6,'f3dd64bc260e5c07adfa916c27dbd58a','2022-11-06 13:55:32');
/*!40000 ALTER TABLE `authentication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,8,'Hi');
INSERT INTO `messages` VALUES (2,5,1,'Hi');
INSERT INTO `messages` VALUES (3,8,1,'Hello');
INSERT INTO `messages` VALUES (4,6,1,'Hi This is a test message');
INSERT INTO `messages` VALUES (5,1,6,'Ok Got it');
INSERT INTO `messages` VALUES (6,6,1,'Thank\'s');
INSERT INTO `messages` VALUES (7,4,6,':)');
INSERT INTO `messages` VALUES (8,1,6,':)');
INSERT INTO `messages` VALUES (9,1,6,'Currently does it support special characters in the message?');
INSERT INTO `messages` VALUES (10,6,1,'Yes! :) It\'s support all the special character like @, #, !, & ^, etc. Also it support semicolon, colon (\", \').');
INSERT INTO `messages` VALUES (11,1,6,'Oh! awesome :)');
INSERT INTO `messages` VALUES (12,6,1,'Hi');
INSERT INTO `messages` VALUES (13,6,1,'HEllo');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,'You have been given a new task on Home',1,1,'2022-11-06 13:28:08');
INSERT INTO `notification` VALUES (2,'You have been given a new task on Home',1,1,'2022-11-06 13:29:01');
INSERT INTO `notification` VALUES (3,'You have been given a new task on Home',1,1,'2022-11-06 13:37:01');
INSERT INTO `notification` VALUES (4,'BUBT CSE 328 Share with you',6,2,'2022-11-06 13:38:47');
INSERT INTO `notification` VALUES (5,'BUBT CSE 328 Share with you',2,2,'2022-11-06 13:39:55');
INSERT INTO `notification` VALUES (6,'You have been given a new task on BUBT CSE 328',1,2,'2022-11-06 13:43:35');
INSERT INTO `notification` VALUES (7,'You have been given a new task on Github Code Uploading System',8,3,'2022-11-06 13:49:51');
INSERT INTO `notification` VALUES (8,'Notepad Application Create Share with you',1,4,'2022-11-06 13:52:06');
INSERT INTO `notification` VALUES (9,'Notepad Application Create Share with you',6,4,'2022-11-06 13:52:16');
INSERT INTO `notification` VALUES (10,'You have been given a new task on Notepad Application Create',6,4,'2022-11-06 13:53:40');
INSERT INTO `notification` VALUES (11,'You have been given a new task on BUBT CSE 328',6,2,'2022-11-17 12:45:55');
INSERT INTO `notification` VALUES (12,'You have been given a new task on BUBT CSE 328',2,2,'2022-11-18 03:58:47');
INSERT INTO `notification` VALUES (13,'You have been given a new task on Notepad Application',8,4,'2022-11-19 20:29:19');
INSERT INTO `notification` VALUES (14,'BUBT CSE 328 Share with you',8,2,'2022-12-18 18:26:13');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_task_list`
--

DROP TABLE IF EXISTS `sub_task_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sub_task_list` (
  `sub_task_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_task_title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_task_status` int(11) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sub_task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_task_list`
--

LOCK TABLES `sub_task_list` WRITE;
/*!40000 ALTER TABLE `sub_task_list` DISABLE KEYS */;
INSERT INTO `sub_task_list` VALUES (1,'2nd floor Amber IT 1500tk',0,2,1,'2022-11-06 13:31:19');
INSERT INTO `sub_task_list` VALUES (2,'4th Floor Carnival 2000tk',1,2,1,'2022-11-06 13:35:48');
INSERT INTO `sub_task_list` VALUES (3,'Login Page',1,6,1,'2022-11-06 14:16:46');
INSERT INTO `sub_task_list` VALUES (4,'Registration Page',0,6,1,'2022-11-06 14:16:55');
INSERT INTO `sub_task_list` VALUES (5,'Password Recovery',0,6,1,'2022-11-06 14:17:06');
INSERT INTO `sub_task_list` VALUES (6,'Login Page',1,4,1,'2022-11-18 03:54:55');
INSERT INTO `sub_task_list` VALUES (7,'Registration Page',1,4,1,'2022-11-18 03:55:05');
INSERT INTO `sub_task_list` VALUES (8,'Recovery Password Page',0,4,1,'2022-11-18 03:55:27');
INSERT INTO `sub_task_list` VALUES (9,'Dashbord',0,4,1,'2022-11-18 03:55:39');
INSERT INTO `sub_task_list` VALUES (10,'User Profile',0,4,1,'2022-11-18 03:55:44');
INSERT INTO `sub_task_list` VALUES (11,'asdfasdf asdas',1,2,1,'2022-12-18 18:25:28');
/*!40000 ALTER TABLE `sub_task_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_categories`
--

DROP TABLE IF EXISTS `task_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `task_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_type` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_categories`
--

LOCK TABLES `task_categories` WRITE;
/*!40000 ALTER TABLE `task_categories` DISABLE KEYS */;
INSERT INTO `task_categories` VALUES (1,'Home',1,1,'2022-11-06 13:25:40');
INSERT INTO `task_categories` VALUES (2,'BUBT CSE 328',2,1,'2022-11-06 13:38:36');
INSERT INTO `task_categories` VALUES (3,'Github Code Uploading System',1,8,'2022-11-06 13:47:16');
INSERT INTO `task_categories` VALUES (4,'Notepad Application',2,8,'2022-11-06 13:51:07');
/*!40000 ALTER TABLE `task_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_list`
--

DROP TABLE IF EXISTS `task_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `task_list` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `task_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_remainder` datetime DEFAULT NULL,
  `task_due` datetime DEFAULT NULL,
  `task_note` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `task_status` int(11) NOT NULL DEFAULT '0',
  `task_priority` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_list`
--

LOCK TABLES `task_list` WRITE;
/*!40000 ALTER TABLE `task_list` DISABLE KEYS */;
INSERT INTO `task_list` VALUES (1,'Pay Desco Bill','2022-11-06 13:28:08','2022-11-25 00:00:00','2022-11-30 00:00:00','',0,2,1,1,1);
INSERT INTO `task_list` VALUES (2,'Pay Internet Bill','2022-11-06 13:29:01','2022-11-15 00:00:00','2022-11-16 00:00:00','Pay 200tk for the internet',1,3,1,1,1);
INSERT INTO `task_list` VALUES (3,'Renew Domain','2022-11-06 13:37:01','2022-11-28 00:00:00','2022-11-29 00:00:00','',0,1,1,1,1);
INSERT INTO `task_list` VALUES (4,'Project Frontend','2022-11-06 13:43:35','2022-11-05 00:00:00','2022-11-06 00:00:00','Complete all the front end work and present on the next class. Also make login and registration page functional',0,1,1,2,1);
INSERT INTO `task_list` VALUES (5,'Blood Donation Code Upload','2022-11-06 13:49:51','2022-11-06 00:00:00','2022-11-10 00:00:00','some code upload your project repository.',0,2,8,3,8);
INSERT INTO `task_list` VALUES (6,'upload some code for notepad application.','2022-11-06 13:53:40','2022-11-06 00:00:00','2022-11-10 00:00:00','upload code',1,1,1,4,8);
INSERT INTO `task_list` VALUES (7,'Database Connection','2022-11-17 12:45:55','2022-11-18 00:00:00','2022-11-19 00:00:00','Hi there,\r\nPlease make sure you connect the DB by using PDO.',1,3,6,2,1);
INSERT INTO `task_list` VALUES (8,'Project Proposal','2022-11-18 03:58:47','2022-10-20 00:00:00','2022-10-21 00:00:00','We have to submit Task Management Project Proposal with in 21 Oct, 2022',0,2,2,2,1);
INSERT INTO `task_list` VALUES (9,'Publish Application','2022-11-19 20:29:19','2022-11-25 00:00:00','2022-11-26 00:00:00','',0,2,8,4,1);
/*!40000 ALTER TABLE `task_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(99) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(999) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.png',
  `org_code` varchar(99) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(55) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Offline now',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Munzirul Alom','admin@admin.com','21232f297a57a5a743894a0e4a801fc3','phpB1BE-photo-1633332755192-727a05c4013d.jpg',NULL,'Active now','2022-03-13 23:16:33');
INSERT INTO `user` VALUES (2,'User','nacoko871@24rumen.com','fe01ce2a7fbac8fafaed7c982a04e229','user.png',NULL,'Offline now','2022-03-20 11:28:57');
INSERT INTO `user` VALUES (3,'Test User','nacoko8751@24rumen.com','202cb962ac59075b964b07152d234b70','user.png','','Offline now','2022-10-29 23:26:02');
INSERT INTO `user` VALUES (4,'gb','test@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','user.png','hdS4fS','Offline now','2022-10-30 00:44:11');
INSERT INTO `user` VALUES (5,'Test User','panegex482@evilant.com','81dc9bdb52d04dc20036dbd8313ed055','user.png','','Offline now','2022-10-30 09:35:06');
INSERT INTO `user` VALUES (6,'abani','abani@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','user.png','','Active now','2022-10-30 13:52:19');
INSERT INTO `user` VALUES (7,'Test User','teacher@gmail.com','202cb962ac59075b964b07152d234b70','user.png','','Offline now','2022-10-30 14:39:46');
INSERT INTO `user` VALUES (8,'Md. Zobayer Hasan Nayem','zobayer.hp3@gmail.com','6f3939fd96e2d06fd9f1c976e9e59fce','user.png','','Offline now','2022-11-06 13:45:44');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_task`
--

DROP TABLE IF EXISTS `user_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_task` (
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_task`
--

LOCK TABLES `user_task` WRITE;
/*!40000 ALTER TABLE `user_task` DISABLE KEYS */;
INSERT INTO `user_task` VALUES (1,1);
INSERT INTO `user_task` VALUES (1,2);
INSERT INTO `user_task` VALUES (1,4);
INSERT INTO `user_task` VALUES (2,2);
INSERT INTO `user_task` VALUES (6,2);
INSERT INTO `user_task` VALUES (6,4);
INSERT INTO `user_task` VALUES (8,2);
INSERT INTO `user_task` VALUES (8,3);
INSERT INTO `user_task` VALUES (8,4);
/*!40000 ALTER TABLE `user_task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-18 18:39:14
