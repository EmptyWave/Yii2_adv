-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: frutella
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.16.04.1

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

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','1',1558945443),('moder','2',1558945443);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,NULL,NULL,NULL,1558945443,1558945443),('moder',1,NULL,NULL,NULL,1558945443,1558945443),('TaskCreate',2,NULL,NULL,NULL,1558945443,1558945443),('TaskDelete',2,NULL,NULL,NULL,1558945443,1558945443),('TaskEdit',2,NULL,NULL,NULL,1558945443,1558945443),('Test Role',1,'Test Role',NULL,NULL,1558955475,1558955475);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('Test Role','moder'),('admin','TaskCreate'),('moder','TaskCreate'),('admin','TaskDelete'),('admin','TaskEdit'),('moder','TaskEdit');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1555792963),('m140506_102106_rbac_init',1558906838),('m140602_111327_create_menu_table',1558950109),('m160312_050000_create_user',1558950109),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1558906838),('m180523_151638_rbac_updates_indexes_without_prefix',1558906838),('m190124_110200_add_verification_token_column_to_user_table',1560350016),('m190420_193433_create_task_table',1555792972),('m190420_193531_create_users_table',1555792973),('m190505_162434_create_task_statuses_table',1557077819),('m190505_165135_add_column_to_task_table',1557077820),('m190524_190530_create_task_comments_table',1558727056),('m190524_194023_create_task_attachments_table',1558727057),('m190526_214536_rbac_init',1558945443),('m190612_142036_updateUser',1560350583);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `responsible_id` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_statuses` (`status_id`),
  CONSTRAINT `fk_task_statuses` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Знакомство с фреймворком','Знакомство с фреймворком',1,2,NULL,1,'2019-04-05 17:36:59','2019-05-07 09:05:36'),(2,'Изучение ORM','Изучение ORM',1,2,NULL,1,'2019-05-03 17:36:59','2019-05-24 16:07:22'),(3,'Постичь непостижимое','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eros ipsum, tristique lobortis elementum vel, commodo a magna. In pharetra venenatis ex quis pellentesque. Proin vehicula elementum sapien, et semper elit tempus eu. Sed laoreet orci suscipit velit efficitur, malesuada accumsan felis bibendum. Morbi cursus iaculis lacus et aliquet. Nulla elit magna, mollis vel ipsum et, molestie elementum urna. Praesent enim quam, tincidunt in purus non, maximus sagittis neque. In id ligula nunc. Nullam mollis egestas imperdiet. Vivamus tempus erat id massa consequat porttitor. Fusce id ullamcorper nulla, a sodales odio. Etiam est risus, tempus sed lobortis non, dignissim at nunc. Cras quis sollicitudin lacus.',1,2,'2019-06-02',1,'2019-03-05 17:36:59','2019-05-08 21:39:59'),(5,'Test task 2 (Lorem5)','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eros ipsum, tristique lobortis elementum vel, commodo a magna. In pharetra venenatis ex quis pellentesque. Proin vehicula elementum sapien, et semper elit tempus eu. Sed laoreet orci suscipit velit efficitur, malesuada accumsan felis bibendum. Morbi cursus iaculis lacus et aliquet. Nulla elit magna, mollis vel ipsum et, molestie elementum urna. Praesent enim quam, tincidunt in purus non, maximus sagittis neque. In id ligula nunc. Nullam mollis egestas imperdiet. Vivamus tempus erat id massa consequat porttitor. Fusce id ullamcorper nulla, a sodales odio. Etiam est risus, tempus sed lobortis non, dignissim at nunc. Cras quis sollicitudin lacus.\r\n\r\nDonec sed porta risus. Sed eget venenatis ex. Ut ornare massa et ante feugiat, sit amet porttitor tellus finibus. Nam sed tristique mi. Nullam a urna magna. Fusce condimentum luctus suscipit. Nam consequat nunc sit amet dui hendrerit dictum. Cras laoreet felis ac erat malesuada, id pellentesque ex mollis.\r\n\r\nDuis quis ligula et enim scelerisque imperdiet. Sed imperdiet pretium lorem nec luctus. Duis aliquet feugiat fermentum. Praesent ullamcorper ut urna vel fermentum. Nulla rhoncus nisl sed maximus faucibus. Mauris felis est, mollis at leo suscipit, lacinia convallis metus. Donec non dui a mi ultrices maximus at id justo. Ut ut leo vel nisi pellentesque lobortis. Aenean rhoncus est id tempor pellentesque.\r\n\r\nAenean tincidunt, turpis et dignissim venenatis, turpis nisl tempor nunc, quis tincidunt libero massa ac velit. Ut dignissim neque id aliquam convallis. Integer sit amet faucibus lacus, eu egestas eros. Morbi interdum turpis eu turpis vulputate, eget dapibus nulla auctor. Nunc elementum libero elit, eget vehicula ligula placerat sed. Aliquam ultricies a quam vitae feugiat. Suspendisse et accumsan lorem, nec finibus ligula. Nam eget consectetur massa. Sed iaculis venenatis neque, id dapibus nibh rhoncus et. Donec pellentesque, odio quis volutpat dapibus, urna sem eleifend neque, vitae venenatis augue urna vel eros. Donec sed neque augue. In erat lectus, bibendum in euismod quis, cursus eu diam. Curabitur dictum iaculis porta. Suspendisse lobortis ullamcorper risus eget fringilla. Nunc dui orci, iaculis nec lorem at, pretium imperdiet ante. In commodo faucibus felis eget tempor.\r\n\r\nPellentesque sed aliquet quam. Suspendisse laoreet mauris vitae ipsum egestas vestibulum. Nullam eget sodales ipsum, eget tincidunt ipsum. Aenean sed lacus laoreet, porttitor libero vitae, dignissim urna. Maecenas ultrices ipsum libero, non lacinia elit auctor et. Sed in finibus sapien, vitae pretium turpis. Duis sed fermentum nunc, vitae scelerisque lectus.',1,2,'2019-05-31',1,'2019-03-05 17:36:59','2019-05-08 21:40:51'),(6,'Test task 3','Test task 3',1,1,'2019-03-31',1,'2019-05-05 17:36:59','2019-05-07 21:45:13'),(8,'Test task 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla luctus turpis non purus vestibulum, porta consequat erat dictum. Sed euismod massa non augue congue commodo. Praesent euismod, magna a consequat egestas, dolor elit laoreet urna, et tristique ',1,1,'2019-05-05',1,'2019-05-05 17:36:59','2019-05-08 20:59:26'),(16,'Test task 5','Test task 5',1,1,'2019-05-05',1,'2019-03-05 17:36:59','2019-05-07 21:53:14'),(18,'Test task 6','Test task 6',1,2,'2019-05-25',1,'2019-05-05 17:36:59',NULL),(21,'Test task 7','Test task 7',1,2,'2019-05-05',1,'2019-05-05 17:36:59',NULL),(23,'Test task 9','Test task 9',1,2,'2019-05-05',1,'2019-04-05 18:02:35','2019-05-07 09:06:21'),(24,'test deadline','asdaffasf',1,1,'2019-05-26',1,'2019-05-26 17:04:04','2019-05-26 17:04:04'),(25,'create_task_test','create_task_test',1,1,'2019-06-12',1,'2019-06-12 20:17:45','2019-06-12 20:17:45');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_attachments`
--

DROP TABLE IF EXISTS `task_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachments_tasks` (`task_id`),
  CONSTRAINT `fk_attachments_tasks` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_attachments`
--

LOCK TABLES `task_attachments` WRITE;
/*!40000 ALTER TABLE `task_attachments` DISABLE KEYS */;
INSERT INTO `task_attachments` VALUES (5,5,'omer-tunc-4.jpg'),(6,5,'omer-tunc-5.jpg'),(7,5,'сделано-в-ссср-png-3.png');
/*!40000 ALTER TABLE `task_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_comments`
--

DROP TABLE IF EXISTS `task_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `comment` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_tasks` (`task_id`),
  KEY `fk_comments_users` (`creator_id`),
  CONSTRAINT `fk_comments_tasks` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_comments`
--

LOCK TABLES `task_comments` WRITE;
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
INSERT INTO `task_comments` VALUES (1,5,1,'\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quam risus, vehicula in porta a, dictum vel ipsum. Vivamus pretium eros elit, egestas viverra tortor aliquet et. Etiam euismod ullamcorper lacus et malesuada. Duis orci erat posuere.','2019-05-24 21:45:18',NULL),(2,5,1,'\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quam risus, vehicula in porta a, dictum vel ipsum. Vivamus pretium eros elit, egestas viverra tortor aliquet et. Etiam euismod ullamcorper lacus et malesuada. Duis orci erat posuere.','2019-05-24 21:47:54',NULL);
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_statuses`
--

DROP TABLE IF EXISTS `task_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_statuses`
--

LOCK TABLES `task_statuses` WRITE;
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
INSERT INTO `task_statuses` VALUES (1,'Новая',''),(2,'В работе',''),(3,'Выполнена',''),(4,'Закрыта',''),(5,'Тестирование',''),(6,'На доработке',''),(7,'На модерации',''),(8,'Редактируется','');
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','xrDAvZ7UBejEXYFZEC_U4CStatY8LfwE','$2y$13$JxggRZK6P7PU5/wEfGeZNOG0T2piJYd/NtngtVO8JSNBFElNraoOu',NULL,'admin@gmail.com',10,2019,2019,NULL,'+7(999)999-99-99'),(2,'demo','1GMkSxHqCKmWnkeALeDO583TVV5yISRV','$2y$13$ceL107zIFSVcygBKNIXdM.ujQGfRrnm/0dF3fhfa.HW0z.mCJGxNa',NULL,'demo@gmail.com',10,2019,2019,NULL,'+7(999)999-99-98'),(3,'test','AmEm4XtvakcJToE2QB2PJz1Wia-19AnK','$2y$13$jM0iTIhS5RBVU8vkY1UtT.l8iSDsvxS.bdJuu.wH9id40oVccCFYG',NULL,'testtest@test.test',10,1560370842,1560370842,'hYgqiT6gmFRvHIe_u1kfnCDMDC5Jpq-6_1560370842','99999999999');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-13 13:56:38
