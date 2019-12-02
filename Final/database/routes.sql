-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.24a-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema routes
--

CREATE DATABASE IF NOT EXISTS routes;
USE routes;

--
-- Definition of table `routes`.`country`
--

DROP TABLE IF EXISTS `routes`.`country`;
CREATE TABLE `routes`.`country` 
(
    `idCountry` tinyint(4) NOT NULL,
    `hemisphere` varchar(255) default NULL,
    PRIMARY KEY (`idCountry`)
);

--
-- Definition of table `routes`.`state`
--

DROP TABLE IF EXISTS `routes`.`state`;
CREATE TABLE `routes`.`state`
(
    `idState` tinyint(4) NOT NULL,
    `idCountry` tinyint(4) NOT NULL,
    PRIMARY KEY (`idState`),
    KEY `FK_country` (`idCountry`),
    CONSTRAINT `FK_country` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`)
);

--
-- Definition of table `routes`.`site`
--
DROP TABLE IF EXISTS `routes`.`site`;
CREATE TABLE `routes`.`site`
(
    `idSite` smallint NOT NULL, 
    `idState` tinyint(4) NOT NULL,
    `name` varchar(255),
    PRIMARY KEY (`idSite`),
    KEY `FK_state` (`idState`),
    CONSTRAINT `FK_state` FOREIGN KEY (`idState`) REFERENCES `state` (`idState`)
);

--
-- Definition of table `routes`.`users`
--
DROP TABLE IF EXISTS `routes`.`users`;
CREATE TABLE `routes`.`users`
(
    `idUser` int NOT NULL,
    `name` varchar(255),
    `idState` tinyint(4) NOT NULL,
    PRIMARY KEY (`idUser`),
    KEY `FK_state2` (`idState`),
    CONSTRAINT `FK_state2` FOREIGN KEY (`idState`) REFERENCES `state` (`idState`)
);

--
-- Definition of table `routes`.`area`
--
DROP TABLE IF EXISTS `routes`.`area`;
CREATE TABLE `routes`.`area`
(
    `idArea` int NOT NULL,
    `idSite` smallint NOT NULL,
    PRIMARY KEY (`idArea`),
    KEY `FK_site` (`idSite`),
    CONSTRAINT `FK_site` FOREIGN KEY (`idSite`) REFERENCES `site` (`idSite`)
);

--
-- Definition of table `routes`.`route`
--
DROP TABLE IF EXISTS `routes`.`route`;
CREATE TABLE `routes`.`route`
(
    `idRoute` int NOT NULL,
    `type` varchar(45),
    `numPitches` tinyint(4),
    `approach` varchar(255),
    `description` varchar(255), 
    `name` varchar(255),
    `idSite` smallint,
    `idArea` int,
    `difficulty` float(4,2),
    `likeability` int,
    PRIMARY KEY (`idRoute`),
    KEY `FK_site2` (`idSite`),
    KEY `FK_area` (`idArea`),
    CONSTRAINT `FK_site2` FOREIGN KEY (`idSite`) REFERENCES `site` (`idSite`),
    CONSTRAINT `FK_area` FOREIGN KEY (`idArea`) REFERENCES `area` (`idArea`)
);

--
-- Definition of table `routes`.`pitch`
--
DROP TABLE IF EXISTS `routes`.`pitch`;
CREATE TABLE `routes`.`pitch`
(
    `idPitch` int NOT NULL,
    `idRoute` int NOT NULL,
    `length` tinyint(4),
    `difficulty` float(4,2),
    `rating` tinyint(4),
    `pitchNum` tinyint(8),
    PRIMARY KEY (`idPitch`),
    KEY `FK_route` (`idRoute`),
    CONSTRAINT `FK_route` FOREIGN KEY (`idRoute`) REFERENCES `route` (`idRoute`)
);


--
-- Definition of table `routes`.`pictures`
--
DROP TABLE IF EXISTS `routes`.`pictures`;
CREATE TABLE `routes`.`pictures`
(
    `idPicture` int NOT NULL,
    `pictureURL` varchar(255),
    `uploadedBy` int NOT NULL,
    PRIMARY KEY (`idPicture`),
    KEY `FK_user` (`uploadedBy`),
    CONSTRAINT `FK_user` FOREIGN KEY (`uploadedBy`) REFERENCES `users` (`idUser`)
);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
