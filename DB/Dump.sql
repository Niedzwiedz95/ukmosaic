CREATE DATABASE  IF NOT EXISTS `ug207337_mosaic` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ug207337_mosaic`;
-- MySQL dump 10.13  Distrib 5.5.38, for Linux (x86_64)
--
-- Host: localhost    Database: ug207337_mosaic
-- ------------------------------------------------------
-- Server version	5.5.38

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
-- Table structure for table `Addresses`
--

DROP TABLE IF EXISTS `Addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Addresses` (
  `AddressID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(16) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `HouseNumber` int(10) NOT NULL,
  `StreetName` varchar(32) NOT NULL,
  `PostalTown` varchar(32) NOT NULL,
  `Postcode` varchar(64) NOT NULL,
  PRIMARY KEY (`AddressID`),
  UNIQUE KEY `AddressID_UNIQUE` (`AddressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Addresses`
--

LOCK TABLES `Addresses` WRITE;
/*!40000 ALTER TABLE `Addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `Addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `OderID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  `Value` double unsigned NOT NULL,
  PRIMARY KEY (`OderID`),
  UNIQUE KEY `OderID_UNIQUE` (`OderID`),
  KEY `UserID_idx` (`UserID`),
  CONSTRAINT `fk_UserID` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(64) NOT NULL,
  `Category` varchar(32) NOT NULL,
  `Path` varchar(128) NOT NULL,
  `Price` double DEFAULT NULL,
  PRIMARY KEY (`ProductID`),
  UNIQUE KEY `ProductID_UNIQUE` (`ProductID`),
  UNIQUE KEY `ProductName_UNIQUE` (`ProductName`),
  UNIQUE KEY `Path_UNIQUE` (`Path`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'aWinckelmans','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/aWinckelmans.jpg',NULL),(2,'pion_1','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_1.jpg',NULL),(3,'pion_2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_2.jpg',NULL),(4,'pion_3','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_3.jpg',NULL),(5,'pion_4','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_4.jpg',NULL),(6,'pion_5','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_5.jpg',NULL),(7,'pion_6','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/pion_6.jpg',NULL),(8,'plytka102x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka102x2.jpg',NULL),(9,'plytka112x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka112x2.jpg',NULL),(10,'plytka122x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka122x2.jpg',NULL),(11,'plytka132x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka132x2.jpg',NULL),(12,'plytka142x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka142x2.jpg',NULL),(13,'plytka152x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka152x2.jpg',NULL),(14,'plytka162x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka162x2.jpg',NULL),(15,'plytka172x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka172x2.jpg',NULL),(16,'plytka182x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka182x2.jpg',NULL),(17,'plytka192x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka192x2.jpg',NULL),(18,'plytka202x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka202x2.jpg',NULL),(19,'plytka212x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka212x2.jpg',NULL),(20,'plytka222x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka222x2.jpg',NULL),(21,'plytka232x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka232x2.jpg',NULL),(22,'plytka242x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka242x2.jpg',NULL),(23,'plytka252x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka252x2.jpg',NULL),(24,'plytka262x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka262x2.jpg',NULL),(25,'plytka272x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka272x2.jpg',NULL),(26,'plytka282x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka282x2.jpg',NULL),(27,'plytka292x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka292x2.jpg',NULL),(28,'plytka302x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka302x2.jpg',NULL),(29,'plytka72x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka72x2.jpg',NULL),(30,'plytka82x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka82x2.jpg',NULL),(31,'plytka92x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/plytka92x2.jpg',NULL),(32,'poziom_322x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/poziom_322x2.jpg',NULL),(33,'poziom_332x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/poziom_332x2.jpg',NULL),(34,'poziom_342x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/poziom_342x2.jpg',NULL),(35,'poziom_352x2','unglazed_tiles2x2','/img/catalogue/unglazed/tiles2x2/poziom_352x2.jpg',NULL),(36,'w1','unglazed_victorian','/img/catalogue/unglazed/victorian/w1.jpg',NULL),(37,'w2','unglazed_victorian','/img/catalogue/unglazed/victorian/w2.jpg',NULL),(38,'w3','unglazed_victorian','/img/catalogue/unglazed/victorian/w3.jpg',NULL),(39,'basket1','unglazed_basket','/img/catalogue/unglazed/basket/basket1.jpg',NULL),(40,'basket2','unglazed_basket','/img/catalogue/unglazed/basket/basket2.jpg',NULL),(41,'basket3','unglazed_basket','/img/catalogue/unglazed/basket/basket3.jpg',NULL),(42,'basket4','unglazed_basket','/img/catalogue/unglazed/basket/basket4.jpg',NULL),(43,'basket5','unglazed_basket','/img/catalogue/unglazed/basket/basket5.jpg',NULL),(44,'basket6','unglazed_basket','/img/catalogue/unglazed/basket/basket6.jpg',NULL),(45,'Albatre Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Albatre Tiles 348x348.jpg',NULL),(46,'Amethyste Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Amethyste Tiles 348x348.jpg',NULL),(47,'Bentonite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Bentonite Tiles 348x348.jpg',NULL),(48,'Calcedoine Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Calcedoine Tiles 348x348.jpg',NULL),(49,'Chaux Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Chaux Tiles 348x348.jpg',NULL),(50,'Cobalt Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Cobalt Tiles 348x348.jpg',NULL),(51,'Corali Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Corali Tiles 348x348.jpg',NULL),(52,'Craie Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Craie Tiles 348x348.jpg',NULL),(53,'Emeraude Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Emeraude Tiles 348x348.jpg',NULL),(54,'Fabulite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Fabulite Tiles 348x348.jpg',NULL),(55,'Gelene Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Gelene Tiles 348x348.jpg',NULL),(56,'Holite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Holite Tiles 348x348.jpg',NULL),(57,'Jaspe Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Jaspe Tiles 348x348.jpg',NULL),(58,'Lave Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Lave Tiles 348x348.jpg',NULL),(59,'Lazuli Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Lazuli Tiles 348x348.jpg',NULL),(60,'Malachite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Malachite Tiles 348x348.jpg',NULL),(61,'Mastic Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Mastic Tiles 348x348.jpg',NULL),(62,'Minium Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Minium Tiles 348x348.jpg',NULL),(63,'Onyx Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Onyx Tiles 348x348.jpg',NULL),(64,'Pepite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Pepite Tiles 348x348.jpg',NULL),(65,'Porphyre Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Porphyre Tiles 348x348.jpg',NULL),(66,'Quartz Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Quartz Tiles 348x348.jpg',NULL),(67,'Resine Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Resine Tiles 348x348.jpg',NULL),(68,'Rubis Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Rubis Tiles 348x348.jpg',NULL),(69,'Saphir Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Saphir Tiles 348x348.jpg',NULL),(70,'Silex Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Silex Tiles 348x348.jpg',NULL),(71,'Topaze Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Topaze Tiles 348x348.jpg',NULL),(72,'Turquoise Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Turquoise Tiles 348x348.jpg',NULL),(73,'Aster','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Aster.jpg',NULL),(74,'Bahamas','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Bahamas.jpg',NULL),(75,'Bahia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Bahia.jpg',NULL),(76,'Buis','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Buis.jpg',NULL),(77,'Californie','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Californie.jpg',NULL),(78,'Camel','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Camel.jpg',NULL),(79,'Camelia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Camelia.jpg',NULL),(80,'Caraibes','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Caraibes.jpg',NULL),(81,'Cipagno','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Cipagno.jpg',NULL),(82,'Clairiere','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Clairiere.jpg',NULL),(83,'Coriandre','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Coriandre.jpg',NULL),(84,'Danube','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Danube.jpg',NULL),(85,'Egee','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Egee.jpg',NULL),(86,'Flores','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Flores.jpg',NULL),(87,'Fuschia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Fuschia.jpg',NULL),(88,'Galapagos','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Galapagos.jpg',NULL),(89,'Genet','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Genet.jpg',NULL),(90,'Gravier','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Gravier.jpg',NULL),(91,'Ivraie','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Ivraie.jpg',NULL),(92,'Lavender Tiles','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lavender Tiles.jpg',NULL),(93,'Lavender','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lavender.jpg',NULL),(94,'Lotus','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lotus.jpg',NULL),(95,'Mouette','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Mouette.jpg',NULL),(96,'Noisetier','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Noisetier.jpg',NULL),(97,'Pierre','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pierre.jpg',NULL),(98,'Pivoine','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pivoine.jpg',NULL),(99,'Pollen','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pollen.jpg',NULL),(100,'Prunelle','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Prunelle.jpg',NULL),(101,'Quetsche','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Quetsche.jpg',NULL),(102,'Schiste','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Schiste.jpg',NULL),(103,'Zinnia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Zinnia.jpg',NULL);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(16) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PasswordHash` char(128) NOT NULL,
  `Salt` char(128) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `CustomerID_UNIQUE` (`UserID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsersAddresses`
--

DROP TABLE IF EXISTS `UsersAddresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsersAddresses` (
  `UserID` int(10) unsigned NOT NULL,
  `AddressID` int(10) unsigned NOT NULL,
  UNIQUE KEY `AddressID_UNIQUE` (`AddressID`),
  KEY `UserID_idx` (`UserID`),
  CONSTRAINT `AddressID` FOREIGN KEY (`AddressID`) REFERENCES `Addresses` (`AddressID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsersAddresses`
--

LOCK TABLES `UsersAddresses` WRITE;
/*!40000 ALTER TABLE `UsersAddresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `UsersAddresses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-04 15:52:41
