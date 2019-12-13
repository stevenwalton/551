-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: ix    Database: climbing
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `idArea` int(11) NOT NULL,
  `idSite` smallint(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idArea`),
  KEY `fk_Site_idx` (`idSite`),
  CONSTRAINT `fk_Site` FOREIGN KEY (`idSite`) REFERENCES `site` (`idSite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (0,0,'Kiss of the Lepers Buttress'),(1,0,'Monkey Face'),(2,1,'Twin Butte'),(3,2,'Steall Hut Crag'),(4,3,'Secteur Berlin'),(5,4,'Real Hidden Valley'),(6,5,'Skyline Buttress'),(7,5,'Sparerib'),(8,6,'Snow Creek'),(9,7,'Central Wall');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `completed`
--

DROP TABLE IF EXISTS `completed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `completed` (
  `Route_idRoute` int(11) NOT NULL,
  `Users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`Route_idRoute`,`Users_idUsers`),
  KEY `fk_Route_has_Users_Users1_idx` (`Users_idUsers`),
  KEY `fk_Route_has_Users_Route1_idx` (`Route_idRoute`),
  CONSTRAINT `fk_Route_has_Users_Route1` FOREIGN KEY (`Route_idRoute`) REFERENCES `route` (`idRoute`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Route_has_Users_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `completed`
--

LOCK TABLES `completed` WRITE;
/*!40000 ALTER TABLE `completed` DISABLE KEYS */;
/*!40000 ALTER TABLE `completed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `idCountry` tinyint(4) NOT NULL,
  `hemisphere` tinyint(4) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (0,NULL,'US'),(1,NULL,'UK'),(2,NULL,'FR');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `idPictures` int(11) NOT NULL,
  `pictureURL` varchar(255) DEFAULT NULL,
  `uploadedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPictures`),
  KEY `fk_UploadedBy_idx` (`uploadedBy`),
  CONSTRAINT `fk_UploadedBy` FOREIGN KEY (`uploadedBy`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (0,'https://i.imgur.com/ZAO7OL9.jpg',0),(1,'https://i.imgur.com/ZAO7OL9.jpg',0),(2,'https://cdn-files.apstatic.com/climb/111214049_large_1494343131.jpg',0),(3,'https://cdn-files.apstatic.com/climb/109008245_large_1494302719.jpg',0),(4,'https://cdn-files.apstatic.com/climb/112806378_large_1494316128.jpg',0),(5,'https://cdn.ukc2.com/i/226639.jpg',0),(6,'https://cdn-files.apstatic.com/climb/107381362_medium_1494185290.jpg',0),(7,'https://cdn-files.apstatic.com/climb/106540193_large_1494118505.jpg',0),(8,'https://i.imgur.com/mPvk4K8.jpg',1),(9,'https://i.imgur.com/diYnE9u.jpg',0),(10,'https://i.imgur.com/v3KWW1Y.jpg',0),(11,'https://cdn-files.apstatic.com/climb/106396576_large_1494104985.jpg',1),(12,'https://cdn-files.apstatic.com/climb/115193380_large_1536762896.jpg',NULL),(13,'https://cdn-files.apstatic.com/climb/106891531_large_1494148857.jpg',1),(14,'https://cdn-files.apstatic.com/climb/108735925_large_1494294609.jpg',1),(15,'https://i.imgur.com/mwQkSeO.jpg',5),(16,'https://imgix.ranker.com/node_img/66/1314165/original/john-salathe-all-people-photo-1?w=650&q=50&fm=pjpg&fit=crop&crop=faces',6),(17,'https://www.thoughtco.com/thmb/K0fHWc9qVl4w0Vsilxf4eeyYlek=/768x0/filters:no_upscale():max_bytes(150000):strip_icc()/Tenzing-Norgay-and-Edmund-Hillary-58c199a73df78c353c2a70bd.jpg',8),(18,'https://www.thoughtco.com/thmb/K0fHWc9qVl4w0Vsilxf4eeyYlek=/768x0/filters:no_upscale():max_bytes(150000):strip_icc()/Tenzing-Norgay-and-Edmund-Hillary-58c199a73df78c353c2a70bd.jpg',9);
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pitch`
--

DROP TABLE IF EXISTS `pitch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pitch` (
  `idPitch` int(11) NOT NULL,
  `idRoute` int(11) NOT NULL,
  `length` tinyint(4) DEFAULT NULL,
  `difficulty` float(4,2) DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `pitchNum` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idPitch`),
  KEY `fk_Route_idx` (`idRoute`),
  CONSTRAINT `fk_Route` FOREIGN KEY (`idRoute`) REFERENCES `route` (`idRoute`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pitch`
--

LOCK TABLES `pitch` WRITE;
/*!40000 ALTER TABLE `pitch` DISABLE KEYS */;
INSERT INTO `pitch` VALUES (0,0,30,7.00,9,1),(1,0,30,6.00,7,2),(2,0,30,5.00,5,3),(3,0,30,5.00,7,4),(4,0,30,7.00,10,5),(5,1,30,11.00,8,1),(6,1,30,11.25,10,2),(7,7,30,6.00,7,1),(8,7,30,6.00,7,2),(9,7,30,6.00,0,3),(10,7,30,6.00,2,4),(11,7,30,6.00,8,5),(12,7,30,6.00,10,6),(13,8,30,6.00,8,1),(14,8,35,3.00,0,2),(15,9,30,2.00,3,1),(16,9,30,2.00,4,2),(17,9,30,9.00,7,3),(18,9,30,8.00,9,4),(19,9,35,7.00,10,5),(20,9,30,9.00,10,6),(21,10,30,8.00,6,1),(22,10,30,10.00,8,2),(23,10,30,10.50,10,3);
/*!40000 ALTER TABLE `pitch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `idRoute` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `numPitches` tinyint(4) DEFAULT NULL,
  `approach` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `idSite` smallint(6) NOT NULL,
  `idArea` int(11) NOT NULL,
  `difficulty` float(4,2) DEFAULT NULL,
  `likability` int(11) DEFAULT NULL,
  `likeVotes` smallint(6) NOT NULL,
  `diffVotes` smallint(6) NOT NULL,
  PRIMARY KEY (`idRoute`),
  KEY `fk_Route_Area1_idx` (`idArea`),
  KEY `fk_Route_Site_idx` (`idSite`),
  CONSTRAINT `fk_Route_Area1` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Route_Site` FOREIGN KEY (`idSite`) REFERENCES `site` (`idSite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (0,'sport',5,'Go over the hill like you\'re going towards monkey face. Turn right and you\'re there.','Beautiful climb. Everyone can and should try it.','First Kiss',0,0,7.00,10,10,2),(1,'sport',2,'Go around the main hill and down the stairs. Can\'t miss it','Iconic view and climb','Monkey Space',0,1,11.25,8,1,1),(2,'sport',1,'East side of monkey face','Hard classic straight on monkey face','Just Do It',0,1,14.50,10,2,2),(3,'sport',1,'Left side of cave','Best 12d in Arizona. ','Mission To Mars',1,2,12.75,5,2,2),(4,'trad',1,'Beautiful hike in. Hard to miss','One of the hardest and best climbs in the UK','Stolen',2,3,13.75,10,1,1),(5,'trad',1,'further left blue streaks on the Berlin Sector','Sustained 5.12 climbing on classic Ceuse dishes and pockets all the way to the top','Blocage Violent',3,4,12.50,8,1,1),(6,'trad',1,'Located on the far right side of the west face of The Sentinel','There\'s a beer named after this route, so why wouldn\'t you want to climb it?','Illusion Dweller',4,5,10.25,8,1,1),(7,'trad',6,'','Skyline Arete is the longest route in the canyon. Sitting high above the river, the route offers fun climbing at a modest grade with sweeping views from comfortable belays','Skyline Arete',5,6,6.00,6,1,1),(8,'trad',2,'Sparerib is its own formation.','The crux is on the second pitch. For 5.8, it is very exposed but well worth the hike and effort. ','Sparerib',5,7,6.00,5,1,1),(9,'trad',6,'Can\'t miss it','Probably the most popular route in Leavenworth. Starts at the base of Snow Creek Wall and follows fantastic features up through the main shield to the top. T','Outer Space',6,8,9.00,10,1,1),(10,'trad',3,'The route is immediately to the left when you reach the upper town walls via the standard approach trail. It heads up a corner to the left of a blank face. ','Super classic at Index','Davis Holland',7,9,10.50,9,1,1);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route_has_pictures`
--

DROP TABLE IF EXISTS `route_has_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route_has_pictures` (
  `Route_idRoute` int(11) NOT NULL,
  `Pictures_idPictures` int(11) NOT NULL,
  PRIMARY KEY (`Route_idRoute`,`Pictures_idPictures`),
  KEY `fk_Route_has_Pictures_Pictures1_idx` (`Pictures_idPictures`),
  KEY `fk_Route_has_Pictures_Route1_idx` (`Route_idRoute`),
  CONSTRAINT `fk_Route_has_Pictures_Pictures1` FOREIGN KEY (`Pictures_idPictures`) REFERENCES `pictures` (`idPictures`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Route_has_Pictures_Route1` FOREIGN KEY (`Route_idRoute`) REFERENCES `route` (`idRoute`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route_has_pictures`
--

LOCK TABLES `route_has_pictures` WRITE;
/*!40000 ALTER TABLE `route_has_pictures` DISABLE KEYS */;
INSERT INTO `route_has_pictures` VALUES (0,1),(1,2),(2,3),(3,4),(4,5),(5,6),(6,7),(7,11),(8,12),(9,13),(10,14);
/*!40000 ALTER TABLE `route_has_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route_has_pitch`
--

DROP TABLE IF EXISTS `route_has_pitch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route_has_pitch` (
  `Pitch_idPitch` int(11) NOT NULL,
  `Route_idRoute` int(11) NOT NULL,
  PRIMARY KEY (`Pitch_idPitch`,`Route_idRoute`),
  KEY `fk_Pitch_has_Route_Route1_idx` (`Route_idRoute`),
  KEY `fk_Pitch_has_Route_Pitch1_idx` (`Pitch_idPitch`),
  CONSTRAINT `fk_Pitch_has_Route_Pitch1` FOREIGN KEY (`Pitch_idPitch`) REFERENCES `pitch` (`idPitch`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pitch_has_Route_Route1` FOREIGN KEY (`Route_idRoute`) REFERENCES `route` (`idRoute`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route_has_pitch`
--

LOCK TABLES `route_has_pitch` WRITE;
/*!40000 ALTER TABLE `route_has_pitch` DISABLE KEYS */;
INSERT INTO `route_has_pitch` VALUES (0,0),(1,0),(2,0),(3,0),(4,0),(5,1),(6,1),(7,7),(8,7),(9,7),(10,7),(11,7),(12,7),(13,8),(14,8),(15,9),(16,9),(17,9),(18,9),(19,9),(20,9),(21,10),(22,10),(23,10);
/*!40000 ALTER TABLE `route_has_pitch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `idSite` smallint(6) NOT NULL,
  `idState` tinyint(4) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idSite`),
  KEY `fk_State_idx` (`idState`),
  CONSTRAINT `fk_State` FOREIGN KEY (`idState`) REFERENCES `state` (`idState`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (0,0,'Smith Rock'),(1,1,'Sedona'),(2,2,'Glen Nevis'),(3,3,'Ceuse'),(4,4,'Joshua Tree'),(5,5,'Gallatin Canyon'),(6,6,'Icicle Creek'),(7,6,'Skykomish Valleu');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `idState` tinyint(4) NOT NULL,
  `idCountry` tinyint(4) NOT NULL,
  `name` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idState`),
  KEY `fk_State_1_idx` (`idCountry`),
  CONSTRAINT `fk_State_1` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (0,0,'OR'),(1,0,'AZ'),(2,1,'SL'),(3,2,'SA'),(4,0,'CA'),(5,0,'MT'),(6,0,'WA');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bib` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'Steven Walton','I made this ^_^'),(1,'SpiderMan','I don\'t need ropes.'),(2,'David Bowie','I can climb into a bed, that\'s about it.'),(3,'Alex Honnold','I did that free climb thing. No biggie.'),(4,'Adam Ondra','I finally made the Olympics. Speedclimbing is hard!'),(5,'Trevor Bergstrom ','Aspiring Trad Dad. Lives for 5.FUN! routes to show off all his brand new cams.'),(6,'John Salathe','You could say I invented this.'),(7,'Warren Harding','I climb the hardest!'),(8,'Edmund Hillary','Everest? That was me'),(9,'Tenzing Norgay','You don\'t make it up Everest without a Nepalese sherpa carrying all your stuff.');
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

-- Dump completed on 2019-12-12 19:57:40
