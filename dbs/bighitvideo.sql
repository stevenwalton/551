-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,MYSQL323' */;


--
-- Create schema bighitvideo
--

CREATE DATABASE IF NOT EXISTS bighitvideo;
USE bighitvideo;

--
-- Definition of table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `accountId` int(10) NOT NULL,
  `lastName` varchar(50) default NULL,
  `firstName` varchar(50) default NULL,
  `street` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(2) default NULL,
  `zipcode` varchar(9) default NULL,
  `balance` decimal(19,4) default NULL,
  PRIMARY KEY  (`accountId`),
  KEY `accountId` (`accountId`),
  KEY `zipcode` (`zipcode`)
) ENGINE=InnoDB;

--
-- Dumping data for table `customer`
--

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`accountId`,`lastName`,`firstName`,`street`,`city`,`state`,`zipcode`,`balance`) VALUES 
 (101,'Block','Jane','345 Randolph Circle','Apopka','FL','30458','0.0000'),
 (102,'Hamilton','Cherry','3230 Dade St.','Dade City','FL','30555','3.4700'),
 (103,'Harrison','Katherine','103 Landis Hall','Bratt','FL','30457','30.5700'),
 (104,'Breaux','Carroll','76 Main St.','Apopka','FL','30458','34.5800'),
 (106,'Morehouse','Anita','9501 Lafayette St.','Houma','LA','44099','0.0000'),
 (111,'Doe','Jane','123 Main St.','Apopka','FL','30458','0.0000'),
 (201,'Greaves','Joseph','14325 N. Bankside St.','Godfrey','IL','43580','0.0000'),
 (444,'Doe','Jane','Cawthon Dorm, room 642','Tallahassee','FL','32306','0.0000'),
 (445,'Riccardi','Greg','101 Thanet St.','London','FL','33333','0.0000'),
 (446,'Riccardi','Greg','101 Thanet St.','London','FL','33333','0.0000'),
 (447,'Riccardi','Greg','101 Thanet St.','London','FL','33333','0.0000'),
 (448,'Mylopoulos','Janet','4402 Elm St.','Apopka','FL','33455','0.0000'),
 (449,'Mylopoulos','Janet','4402 Elm St.','Apopka','FL','33455','0.0000'),
 (450,'Mylopoulos','Janet','4402 Elm St.','Apopka','FL','33455','0.0000'),
 (451,'O\'Connell','Janet','4402 Elm St.','Apopka','FL','33455','0.0000'),
 (452,'O\'Connell','Janet','4402 Elm St.','Apopka','FL','33455','0.0000');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


--
-- Definition of table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `ssn` varchar(50) NOT NULL,
  `lastName` varchar(50) default NULL,
  `firstName` varchar(50) default NULL,
  PRIMARY KEY  (`ssn`)
) ENGINE=InnoDB;

--
-- Dumping data for table `employee`
--

/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`ssn`,`lastName`,`firstName`) VALUES 
 ('145-09-0967','Uno','Jane'),
 ('245-11-4554','Toulouse','Jie'),
 ('376-77-0099','Threat','Ayisha'),
 ('479-98-0098','Fortune','Julian'),
 ('579-98-8778','Fivozinsky','Bruce');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


--
-- Definition of table `hourlyemployee`
--

DROP TABLE IF EXISTS `hourlyemployee`;
CREATE TABLE `hourlyemployee` (
  `ssn` varchar(50) NOT NULL,
  `hourlyRate` decimal(19,4) default NULL,
  PRIMARY KEY  (`ssn`),
  UNIQUE KEY `{CC921662-F1CE-40BD-B451-CD5052` (`ssn`)
) ENGINE=InnoDB;

--
-- Dumping data for table `hourlyemployee`
--

/*!40000 ALTER TABLE `hourlyemployee` DISABLE KEYS */;
INSERT INTO `hourlyemployee` (`ssn`,`hourlyRate`) VALUES 
 ('145-09-0967','6.0500'),
 ('245-11-4554','5.5000'),
 ('376-77-0099','10.7500'),
 ('479-98-0098','9.5000'),
 ('579-98-8778','5.5000');
/*!40000 ALTER TABLE `hourlyemployee` ENABLE KEYS */;


--
-- Definition of table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `movieId` int(10) NOT NULL,
  `title` varchar(50) default NULL,
  `genre` varchar(50) default NULL,
  `length` int(10) default NULL,
  `rating` varchar(50) default NULL,
  PRIMARY KEY  (`movieId`),
  KEY `movieId` (`movieId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `movie`
--

/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` (`movieId`,`title`,`genre`,`length`,`rating`) VALUES 
 (101,'The Thirty-Nine Steps','mystery',101,'R'),
 (123,'Annie Hall','romantic comedy',110,'R'),
 (145,'Lady and the Tramp','animated comedy',93,'PG'),
 (189,'Animal House','comedy',87,'PG-13'),
 (450,'Elizabeth','costume drama',123,'PG-13'),
 (553,'Stagecoach','western',130,'R'),
 (987,'Duck Soup','comedy',99,'PG-13');
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;


--
-- Definition of table `otherusers`
--

DROP TABLE IF EXISTS `otherusers`;
CREATE TABLE `otherusers` (
  `accountId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`accountId`,`name`),
  KEY `{CE5D3D35-8BD6-4174-B922-FDEE2B` (`accountId`),
  KEY `accountId` (`accountId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `otherusers`
--

/*!40000 ALTER TABLE `otherusers` DISABLE KEYS */;
INSERT INTO `otherusers` (`accountId`,`name`) VALUES 
 (101,'Greg Jones'),
 (101,'Joe Block'),
 (104,'Cyrus Lambeaux'),
 (104,'Jean Deaux'),
 (104,'Judy Breaux');
/*!40000 ALTER TABLE `otherusers` ENABLE KEYS */;


--
-- Definition of table `paystatement`
--

DROP TABLE IF EXISTS `paystatement`;
CREATE TABLE `paystatement` (
  `ssn` varchar(50) NOT NULL,
  `hourlyRate` decimal(19,4) default NULL,
  `numHours` int(10) default NULL,
  `amountPaid` decimal(19,4) default NULL,
  `datePaid` datetime NOT NULL,
  PRIMARY KEY  (`ssn`,`datePaid`),
  KEY `amountPaid` (`amountPaid`),
  KEY `numHours` (`numHours`),
  KEY `PayStatementssn` (`ssn`)
) ENGINE=InnoDB;

--
-- Dumping data for table `paystatement`
--

/*!40000 ALTER TABLE `paystatement` DISABLE KEYS */;
INSERT INTO `paystatement` (`ssn`,`hourlyRate`,`numHours`,`amountPaid`,`datePaid`) VALUES 
 ('145-09-0967','6.0500',8,'45.3750','1999-05-17 00:00:00'),
 ('245-11-4554','5.5000',4,'20.6250','1999-05-17 00:00:00'),
 ('376-77-0099','10.7500',16,'172.0000','1999-05-17 00:00:00');
/*!40000 ALTER TABLE `paystatement` ENABLE KEYS */;


--
-- Definition of table `previousrental`
--

DROP TABLE IF EXISTS `previousrental`;
CREATE TABLE `previousrental` (
  `accountId` int(10) NOT NULL,
  `videoId` int(10) NOT NULL,
  `dateRented` datetime NOT NULL,
  `dateReturned` datetime default NULL,
  `cost` decimal(19,4) default NULL,
  PRIMARY KEY  (`accountId`,`videoId`,`dateRented`),
  KEY `{EC9DB354-14CF-4055-8C03-FEBD3C` (`accountId`),
  KEY `{F8FB5EF8-A80D-401A-9DD2-E9FF64` (`videoId`),
  KEY `accountId` (`accountId`),
  KEY `videoId` (`videoId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `previousrental`
--

/*!40000 ALTER TABLE `previousrental` DISABLE KEYS */;
INSERT INTO `previousrental` (`accountId`,`videoId`,`dateRented`,`dateReturned`,`cost`) VALUES 
 (101,101,'2001-12-09 00:00:00','2001-12-10 00:00:00','2.4900'),
 (101,112,'2001-01-13 00:00:00','2001-01-04 00:00:00','1.9900'),
 (101,113,'2002-01-15 00:00:00','2002-01-15 00:00:00','0.9900'),
 (102,113,'2001-12-01 00:00:00','2001-12-03 00:00:00','2.4900'),
 (111,101,'2001-12-04 00:00:00','2001-12-06 00:00:00','2.4900'),
 (111,99787,'2002-01-01 00:00:00','2002-01-04 00:00:00','3.9500'),
 (201,113,'2001-12-09 00:00:00','2001-12-14 00:00:00','3.9900'),
 (201,77564,'2002-01-14 00:00:00','2002-01-24 00:00:00','3.3500');
/*!40000 ALTER TABLE `previousrental` ENABLE KEYS */;


--
-- Definition of table `purchaseorder`
--

DROP TABLE IF EXISTS `purchaseorder`;
CREATE TABLE `purchaseorder` (
  `purchaseOrderId` int(10) NOT NULL,
  `supplierId` varchar(50) default NULL,
  `date` datetime default NULL,
  `total` decimal(19,4) default NULL,
  PRIMARY KEY  (`purchaseOrderId`),
  KEY `{B2E00A44-11D2-446B-8500-570CDC` (`supplierId`),
  KEY `purchaseOrderId` (`purchaseOrderId`),
  KEY `supplierId` (`supplierId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `purchaseorder`
--

/*!40000 ALTER TABLE `purchaseorder` DISABLE KEYS */;
INSERT INTO `purchaseorder` (`purchaseOrderId`,`supplierId`,`date`,`total`) VALUES 
 (99001,'101101','1999-01-15 00:00:00','100.0000');
/*!40000 ALTER TABLE `purchaseorder` ENABLE KEYS */;


--
-- Definition of table `purchaseorderdetail`
--

DROP TABLE IF EXISTS `purchaseorderdetail`;
CREATE TABLE `purchaseorderdetail` (
  `purchaseOrderId` int(10) NOT NULL,
  `movieId` int(10) NOT NULL,
  `quantity` int(10) default NULL,
  `price` decimal(19,4) default NULL,
  PRIMARY KEY  (`purchaseOrderId`,`movieId`),
  KEY `{72967CAA-B6BB-44C4-B6F9-718C51` (`purchaseOrderId`),
  KEY `{F17E7BC1-43A2-4E07-A035-CB448E` (`movieId`),
  KEY `purchaseOrderId` (`purchaseOrderId`),
  KEY `videoId` (`movieId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `purchaseorderdetail`
--

/*!40000 ALTER TABLE `purchaseorderdetail` DISABLE KEYS */;
INSERT INTO `purchaseorderdetail` (`purchaseOrderId`,`movieId`,`quantity`,`price`) VALUES 
 (99001,450,3,'25.0000'),
 (99001,987,1,'25.0000');
/*!40000 ALTER TABLE `purchaseorderdetail` ENABLE KEYS */;


--
-- Definition of table `rental`
--

DROP TABLE IF EXISTS `rental`;
CREATE TABLE `rental` (
  `accountId` int(10) default NULL,
  `videoId` int(10) NOT NULL,
  `dateRented` datetime default NULL,
  `dateDue` datetime default NULL,
  `cost` decimal(19,4) default NULL,
  PRIMARY KEY  (`videoId`),
  UNIQUE KEY `{0CF92969-0A44-4FD2-BA9B-B234C1` (`videoId`),
  UNIQUE KEY `videotapeId` (`videoId`),
  KEY `{21C9A279-E5B4-458A-9F10-8FCB0B` (`accountId`),
  KEY `accountId` (`accountId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `rental`
--

/*!40000 ALTER TABLE `rental` DISABLE KEYS */;
INSERT INTO `rental` (`accountId`,`videoId`,`dateRented`,`dateDue`,`cost`) VALUES 
 (103,101,'2002-01-03 00:00:00','2002-01-04 00:00:00','1.5900'),
 (101,111,'2002-04-24 00:00:00','2002-05-02 00:00:00','3.9900'),
 (101,112,'2002-04-24 00:00:00','2002-04-30 00:00:00','1.9900'),
 (101,113,'2002-02-22 00:00:00','2002-02-25 00:00:00','3.0000'),
 (101,114,'2002-02-22 00:00:00','2002-02-25 00:00:00','3.0000'),
 (103,123,'2001-12-01 00:00:00','2001-12-31 00:00:00','10.9900'),
 (101,145,'2002-02-14 00:00:00','2002-02-16 00:00:00','1.9900'),
 (101,77564,'2002-04-24 00:00:00',NULL,NULL),
 (101,90987,'2002-01-01 00:00:00','2002-01-08 00:00:00','2.9900'),
 (101,99787,'2002-01-01 00:00:00','2002-01-04 00:00:00','3.4900');
/*!40000 ALTER TABLE `rental` ENABLE KEYS */;


--
-- Definition of table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `accountId` int(10) NOT NULL,
  `videoId` int(10) NOT NULL,
  `dateReserved` datetime default NULL,
  PRIMARY KEY  (`accountId`,`videoId`),
  KEY `{1F0A2213-05D7-4F6D-A476-06DD49` (`videoId`),
  KEY `{8A58F9C8-AF74-404E-8BD4-24E712` (`accountId`),
  KEY `videoId` (`videoId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `reservation`
--

/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`accountId`,`videoId`,`dateReserved`) VALUES 
 (101,111,'2000-01-30 23:12:42'),
 (101,77564,'2000-01-30 23:12:41');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;


--
-- Definition of table `salariedemployee`
--

DROP TABLE IF EXISTS `salariedemployee`;
CREATE TABLE `salariedemployee` (
  `ssn` varchar(50) NOT NULL,
  `weeklyPayRate` decimal(19,4) default NULL,
  `vacationLeaveHours` int(10) default NULL,
  `sickLeaveHours` int(10) default NULL,
  PRIMARY KEY  (`ssn`),
  UNIQUE KEY `{5E1245AE-BC7F-4025-96EE-5347E3` (`ssn`)
) ENGINE=InnoDB;

--
-- Dumping data for table `salariedemployee`
--

/*!40000 ALTER TABLE `salariedemployee` DISABLE KEYS */;
INSERT INTO `salariedemployee` (`ssn`,`weeklyPayRate`,`vacationLeaveHours`,`sickLeaveHours`) VALUES 
 ('145-09-0967','0.0000',0,0);
/*!40000 ALTER TABLE `salariedemployee` ENABLE KEYS */;


--
-- Definition of table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `storeId` int(10) NOT NULL,
  `street` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `zipcode` varchar(50) default NULL,
  `manager` varchar(50) default NULL,
  PRIMARY KEY  (`storeId`),
  KEY `storeId` (`storeId`),
  KEY `zipcode` (`zipcode`)
) ENGINE=InnoDB;

--
-- Dumping data for table `store`
--

/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` (`storeId`,`street`,`city`,`state`,`zipcode`,`manager`) VALUES 
 (3,'2010 Liberty Rd.','Apopka','FL','34505','145-09-0967'),
 (5,'1004 N. Monroe St.','Apopka','FL','34506','588-99-0093');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;


--
-- Definition of table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplierId` varchar(50) NOT NULL,
  `name` varchar(50) default NULL,
  `street` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  PRIMARY KEY  (`supplierId`),
  KEY `SupplierId` (`supplierId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `supplier`
--

/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`supplierId`,`name`,`street`,`city`,`state`) VALUES 
 ('101101','Acme Video','101 Main','Smithfield','LA');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;


--
-- Definition of table `timecard`
--

DROP TABLE IF EXISTS `timecard`;
CREATE TABLE `timecard` (
  `ssn` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime default NULL,
  `storeId` int(10) default NULL,
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ssn`,`date`,`startTime`),
  KEY `{82194334-595F-4FD7-810D-52CC8B` (`ssn`),
  KEY `{A4F6BCBD-EDA6-4DDF-936A-3EE5B7` (`storeId`),
  KEY `employeeId` (`ssn`),
  KEY `storeId` (`storeId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `timecard`
--

/*!40000 ALTER TABLE `timecard` DISABLE KEYS */;
INSERT INTO `timecard` (`ssn`,`date`,`startTime`,`endTime`,`storeId`,`paid`) VALUES 
 ('145-09-0967','2002-01-14 00:00:00','1899-12-30 08:15:00','1899-12-30 12:00:00',3,-1),
 ('145-09-0967','2002-01-16 00:00:00','1899-12-30 08:15:00','1899-12-30 12:00:00',3,-1),
 ('245-11-4554','2002-01-14 00:00:00','1899-12-30 08:15:00','1899-12-30 12:00:00',3,-1),
 ('376-77-0099','2002-01-03 00:00:00','1899-12-30 10:00:00','1899-12-30 14:00:00',5,-1),
 ('376-77-0099','2002-01-03 00:00:00','1899-12-30 15:00:00','1899-12-30 19:00:00',3,-1),
 ('376-77-0099','2002-02-23 00:00:00','1899-12-30 14:00:00','1899-12-30 22:00:00',5,-1),
 ('376-77-0099','2002-03-21 00:00:00','1899-12-30 15:00:00','1899-12-30 19:00:00',5,-1);
/*!40000 ALTER TABLE `timecard` ENABLE KEYS */;


--
-- Definition of table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `videoId` int(10) NOT NULL,
  `dateAcquired` datetime default NULL,
  `movieId` int(10) default NULL,
  `storeId` int(10) default NULL,
  PRIMARY KEY  (`videoId`),
  KEY `{118415F5-C661-41C1-811B-850E4A` (`storeId`),
  KEY `{C53DE723-EA6C-444C-9BC2-4A188B` (`movieId`),
  KEY `movieId` (`movieId`),
  KEY `storeId` (`storeId`),
  KEY `videotapeId` (`videoId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `video`
--

/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` (`videoId`,`dateAcquired`,`movieId`,`storeId`) VALUES 
 (101,'1998-01-25 00:00:00',101,3),
 (111,'1997-02-05 00:00:00',123,3),
 (112,'1995-12-31 00:00:00',123,5),
 (113,'1998-04-05 00:00:00',123,5),
 (114,'1998-04-05 00:00:00',189,5),
 (123,'1986-03-25 00:00:00',123,3),
 (145,'1995-05-12 00:00:00',145,5),
 (77564,'1991-04-29 00:00:00',189,3),
 (90987,'1999-03-25 00:00:00',450,3),
 (99787,'1997-10-10 00:00:00',987,5);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;


--
-- Definition of table `worksin`
--

DROP TABLE IF EXISTS `worksin`;
CREATE TABLE `worksin` (
  `ssn` varchar(50) NOT NULL,
  `storeId` int(10) NOT NULL,
  PRIMARY KEY  (`ssn`,`storeId`),
  KEY `{6F8AC539-9DB6-42BA-AD18-37F840` (`storeId`),
  KEY `{BD518805-671C-4A08-B164-45A793` (`ssn`),
  KEY `storeId` (`storeId`)
) ENGINE=InnoDB;

--
-- Dumping data for table `worksin`
--

/*!40000 ALTER TABLE `worksin` DISABLE KEYS */;
INSERT INTO `worksin` (`ssn`,`storeId`) VALUES 
 ('145-09-0967',3),
 ('245-11-4554',3),
 ('145-09-0967',5),
 ('245-11-4554',5),
 ('376-77-0099',5);
/*!40000 ALTER TABLE `worksin` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
