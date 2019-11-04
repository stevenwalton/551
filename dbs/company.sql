CREATE DATABASE  IF NOT EXISTS `company` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `company`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: ix.cs.uoregon.edu    Database: company
-- ------------------------------------------------------
-- Server version	5.6.13-log

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
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `dname` char(30) DEFAULT NULL,
  `dnumber` smallint(2) NOT NULL,
  `mgrssn` int(4) DEFAULT NULL,
  `mgrstartdate` date DEFAULT NULL,
  PRIMARY KEY (`dnumber`),
  KEY `mgrssn` (`mgrssn`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`mgrssn`) REFERENCES `employee` (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES ('Headquarters',1,888665555,'1971-06-19'),('Administration',4,987654321,'1985-01-01'),('Research',5,333445555,'1978-05-22');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dependent`
--

DROP TABLE IF EXISTS `dependent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependent` (
  `essn` int(4) NOT NULL,
  `dependent_name` char(30) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `relationship` char(20) DEFAULT NULL,
  PRIMARY KEY (`dependent_name`,`essn`),
  KEY `essn` (`essn`),
  CONSTRAINT `dependent_ibfk_1` FOREIGN KEY (`essn`) REFERENCES `employee` (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependent`
--

LOCK TABLES `dependent` WRITE;
/*!40000 ALTER TABLE `dependent` DISABLE KEYS */;
INSERT INTO `dependent` VALUES (987654321,'Abner','M','1932-02-29','SPOUSE'),(123456789,'Alice','F','1978-12-31','DAUGHTER'),(333445555,'Alice','F','1976-04-05','DAUGHTER'),(123456789,'Elizabeth','F','1957-05-05','SPOUSE'),(333445555,'Joy','F','1948-05-03','SPOUSE'),(123456789,'Michael','M','1978-01-01','SON'),(333445555,'Theodore','M','1973-10-25','SON');
/*!40000 ALTER TABLE `dependent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dept_locations`
--

DROP TABLE IF EXISTS `dept_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dept_locations` (
  `dnumber` smallint(2) NOT NULL,
  `dlocation` char(30) NOT NULL,
  PRIMARY KEY (`dnumber`,`dlocation`),
  CONSTRAINT `fk_loc2dept` FOREIGN KEY (`dnumber`) REFERENCES `department` (`dnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dept_locations`
--

LOCK TABLES `dept_locations` WRITE;
/*!40000 ALTER TABLE `dept_locations` DISABLE KEYS */;
INSERT INTO `dept_locations` VALUES (1,'Houston'),(4,'Stafford'),(5,'Bellaire'),(5,'Houston'),(5,'Sugarland');
/*!40000 ALTER TABLE `dept_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `fname` char(20) DEFAULT NULL,
  `minit` char(20) DEFAULT NULL,
  `lname` char(20) DEFAULT NULL,
  `ssn` int(4) NOT NULL,
  `bdate` date DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `salary` decimal(16,2) NOT NULL,
  `superssn` int(4) DEFAULT NULL,
  `dno` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`ssn`),
  KEY `superssn` (`superssn`),
  KEY `dno` (`dno`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`superssn`) REFERENCES `employee` (`ssn`),
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`dno`) REFERENCES `department` (`dnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES ('John','B','Smith',123456789,'1955-01-09','731 Fondren, Houston, TX','M',30000.00,333445555,5),('Franklin','T','Wong',333445555,'1945-12-08','638 Voss, Houston, TX','M',40000.00,888665555,5),('Joyce','A','English',453453453,'1962-07-31','5631 Rice, Houston, TX','F',25000.00,333445555,5),('Ramesh','K','Narayan',666884444,'1952-09-15','975 Fire Oak, Humble, TX','M',38000.00,333445555,5),('James','E','Borg',888665555,'1927-11-10','450 Stone, Houston, TX','M',55000.00,NULL,1),('Jennifer','S','Wallace',987654321,'1931-06-20','291 Berry, Bellaire, TX','F',43000.00,888665555,4),('Ahmad','V','Jabbar',987987987,'1959-03-29','980 Dallas, Houston, TX','M',25000.00,987654321,4),('Alicia','J','Zelaya',999887777,'1958-07-19','\"3321 Castle, Spring, TX\"','F',25000.00,987654321,4);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `pname` char(20) DEFAULT NULL,
  `pnumber` smallint(2) NOT NULL,
  `plocation` char(30) DEFAULT NULL,
  `dnum` smallint(2) NOT NULL,
  PRIMARY KEY (`pnumber`),
  KEY `fk_proj2dept` (`dnum`),
  CONSTRAINT `fk_proj2dept` FOREIGN KEY (`dnum`) REFERENCES `department` (`dnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES ('ProductX',1,'Bellaire',5),('ProductY',2,'Sugarland',5),('ProductZ',3,'Houston',5),('Computerization',10,'Stafford',4),('Reorganization',20,'Houston',1),('Newbenefits',30,'Stafford',4);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `works_on`
--

DROP TABLE IF EXISTS `works_on`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works_on` (
  `essn` int(4) NOT NULL,
  `pno` smallint(2) NOT NULL,
  `hours` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`essn`,`pno`),
  KEY `pno` (`pno`),
  CONSTRAINT `works_on_ibfk_1` FOREIGN KEY (`essn`) REFERENCES `employee` (`ssn`),
  CONSTRAINT `works_on_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `project` (`pnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works_on`
--

LOCK TABLES `works_on` WRITE;
/*!40000 ALTER TABLE `works_on` DISABLE KEYS */;
INSERT INTO `works_on` VALUES (123456789,1,32.50),(123456789,2,7.50),(333445555,2,10.00),(333445555,3,10.00),(333445555,10,10.00),(333445555,20,10.00),(453453453,1,20.00),(453453453,2,20.00),(666884444,3,40.00),(888665555,20,NULL),(987654321,20,15.00),(987654321,30,20.00),(987987987,10,35.00),(987987987,30,5.00),(999887777,10,10.00),(999887777,30,30.00);
/*!40000 ALTER TABLE `works_on` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-04 20:38:56
