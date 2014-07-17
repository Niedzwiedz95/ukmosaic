-- CREATE DATABASE  IF NOT EXISTS `ug207337_mosaic2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ug207337_mosaic2`;
-- MySQL dump 10.13  Distrib 5.5.38, for Linux (x86_64)
--
-- Host: localhost    Database: ug207337_mosaic2
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
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'pl-x7','unglazed_tiles15x15-9mm','/img/catalogue/unglazed/tiles15x15-9mm/pl-x7.jpg',NULL),(2,'pl-x17','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x17.jpg',NULL),(3,'pl-x18','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x18.jpg',NULL),(4,'pl-x19','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x19.jpg',NULL),(5,'pl-5x5-1','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-1.jpg',NULL),(6,'pl-5x5-2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-2.jpg',NULL),(7,'pl-5x5-3','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-3.jpg',NULL),(8,'pl-5x5-4','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-4.jpg',NULL),(9,'pl-5x5-5','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-5.jpg',NULL),(10,'pl-x14','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-x14.jpg',NULL),(11,'Anthracite','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Anthracite.jpg',NULL),(12,'Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Blanc.jpg',49.99),(13,'Bleu Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Fonce.jpg',NULL),(14,'Bleu Nuit','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Nuit.jpg',NULL),(15,'Bleu Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Pale.jpg',NULL),(16,'Bleu','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu.jpg',NULL),(17,'Brun','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Brun.jpg',NULL),(18,'Café','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Café.jpg',NULL),(19,'Caramel','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Caramel.jpg',NULL),(20,'Cognac','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Cognac.jpg',52.45),(21,'Gris Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris Pale.jpg',49.99),(22,'Gris','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris.jpg',49.99),(23,'Havane','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Havane.jpg',49.99),(24,'Ivoire','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ivoire.jpg',52.45),(25,'Jaune','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Jaune.jpg',49.99),(26,'Linen','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Linen.jpg',52.45),(27,'Noir','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Noir.jpg',49.99),(28,'Ontario','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ontario.jpg',49.99),(29,'Parme','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Parme.jpg',57.45),(30,'Perle','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Perle.jpg',NULL),(31,'Pistache','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Pistache.jpg',57.45),(32,'Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rose.jpg',52.45),(33,'Rouge','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rouge.jpg',49.99),(34,'Super Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Super Blanc.jpg',52.45),(35,'Vanille','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vanille.jpg',57.45),(36,'Vert Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Fonce.jpg',57.45),(37,'Vert Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Pale.jpg',57.45),(38,'Vert','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert.jpg',57.45),(39,'Vieux Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vieux Rose.jpg',52.45),(40,'aWinckelmans','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/aWinckelmans.jpg',NULL),(41,'pion_1','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_1.jpg',NULL),(42,'pion_2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_2.jpg',NULL),(43,'pion_3','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_3.jpg',NULL),(44,'pion_4','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_4.jpg',NULL),(45,'pion_5','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_5.jpg',NULL),(46,'pion_6','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_6.jpg',NULL),(47,'plytka102x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka102x2.jpg',NULL),(48,'plytka112x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka112x2.jpg',NULL),(49,'plytka122x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka122x2.jpg',NULL),(50,'plytka132x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka132x2.jpg',NULL),(51,'plytka142x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka142x2.jpg',NULL),(52,'plytka152x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka152x2.jpg',NULL),(53,'plytka162x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka162x2.jpg',NULL),(54,'plytka172x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka172x2.jpg',NULL),(55,'plytka182x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka182x2.jpg',NULL),(56,'plytka192x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka192x2.jpg',NULL),(57,'plytka202x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka202x2.jpg',NULL),(58,'plytka212x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka212x2.jpg',NULL),(59,'plytka222x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka222x2.jpg',NULL),(60,'plytka232x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka232x2.jpg',NULL),(61,'plytka242x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka242x2.jpg',NULL),(62,'plytka252x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka252x2.jpg',NULL),(63,'plytka262x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka262x2.jpg',NULL),(64,'plytka272x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka272x2.jpg',NULL),(65,'plytka282x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka282x2.jpg',NULL),(66,'plytka292x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka292x2.jpg',NULL),(67,'plytka302x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka302x2.jpg',NULL),(68,'plytka72x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka72x2.jpg',NULL),(69,'plytka82x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka82x2.jpg',NULL),(70,'plytka92x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka92x2.jpg',NULL),(71,'poziom_322x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_322x2.jpg',NULL),(72,'poziom_332x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_332x2.jpg',NULL),(73,'poziom_342x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_342x2.jpg',NULL),(74,'poziom_352x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_352x2.jpg',NULL),(75,'pl-x1','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x1.jpg',NULL),(76,'pl-x11','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x11.jpg',NULL),(77,'pl-x2','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x2.jpg',NULL),(78,'pl-x3','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x3.jpg',NULL),(79,'pl-x4','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x4.jpg',NULL),(80,'pl-x5','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x5.jpg',NULL),(81,'pl-x6','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x6.jpg',NULL),(82,'pl-x9','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x9.jpg',NULL),(83,'pl-x10','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x10.jpg',NULL),(84,'pl-x15','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x15.jpg',NULL),(85,'pl-x21','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x21.jpg',NULL),(86,'pl-x8','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x8.jpg',NULL),(87,'w1','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w1.jpg',NULL),(88,'w2','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w2.jpg',NULL),(89,'w3','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w3.jpg',NULL),(90,'basket1','unglazed_basket','/img/catalogue/unglazed/basket/basket1.jpg',NULL),(91,'basket2','unglazed_basket','/img/catalogue/unglazed/basket/basket2.jpg',NULL),(92,'basket3','unglazed_basket','/img/catalogue/unglazed/basket/basket3.jpg',NULL),(93,'basket4','unglazed_basket','/img/catalogue/unglazed/basket/basket4.jpg',NULL),(94,'basket5','unglazed_basket','/img/catalogue/unglazed/basket/basket5.jpg',NULL),(95,'basket6','unglazed_basket','/img/catalogue/unglazed/basket/basket6.jpg',NULL),(96,'pl-7x7-1','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-1.jpg',NULL),(97,'pl-7x7-2','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-2.jpg',NULL),(98,'pl-7x7-3','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-3.jpg',NULL),(99,'pl-x12','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x12.jpg',NULL),(100,'pl-x13','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x13.jpg',NULL),(101,'pl-x16','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x16.jpg',NULL),(102,'pl-x20','unglazed_octagon15x15-9mm','/img/catalogue/unglazed/octagon15x15-9mm/pl-x20.jpg',NULL),(103,'Albatre 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Albatre 348x348.jpg',84.45),(104,'Amethyste 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Amethyste 348x348.jpg',119.45),(105,'Azurite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Azurite 348x348.jpg',148.24),(106,'Bentonite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Bentonite 348x348.jpg',84.45),(107,'Calcedoine 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Calcedoine 348x348.jpg',84.45),(108,'Chaux 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Chaux 348x348.jpg',84.45),(109,'Cobalt 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Cobalt 348x348.jpg',148.24),(110,'Corali 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Corali 348x348.jpg',148.24),(111,'Craie 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Craie 348x348.jpg',84.45),(112,'Emeraude 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Emeraude 348x348.jpg',119.45),(113,'Fabulite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Fabulite 348x348.jpg',119.45),(114,'Gelene 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Gelene 348x348.jpg',NULL),(115,'Holite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Holite 348x348.jpg',119.45),(116,'Jaspe 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Jaspe 348x348.jpg',119.45),(117,'Lave 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lave 348x348.jpg',119.45),(118,'Lazuli 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lazuli 348x348.jpg',148.24),(119,'Malachite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Malachite 348x348.jpg',119.45),(120,'Mastic 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Mastic 348x348.jpg',84.45),(121,'Minium 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Minium 348x348.jpg',148.24),(122,'Onyx 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Onyx 348x348.jpg',148.24),(123,'Pepite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Pepite 348x348.jpg',148.24),(124,'Porphyre 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Porphyre 348x348.jpg',119.45),(125,'Quartz 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Quartz 348x348.jpg',119.45),(126,'Resine 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Resine 348x348.jpg',148.24),(127,'Rubis 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Rubis 348x348.jpg',148.24),(128,'Saphir 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Saphir 348x348.jpg',148.24),(129,'Silex 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Silex 348x348.jpg',84.45),(130,'Sodalite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Sodalite 348x348.jpg',119.45),(131,'Topaze 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Topaze 348x348.jpg',148.24),(132,'Turquoise 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Turquoise 348x348.jpg',148.24),(133,'Aster 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Aster 348x348.jpg',79.4),(134,'Bahamas 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahamas 348x348.jpg',79.4),(135,'Bahia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahia 348x348.jpg',89.4),(136,'Buis 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Buis 348x348.jpg',89.4),(137,'Californie 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Californie 348x348.jpg',79.4),(138,'Camel 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camel 348x348.jpg',NULL),(139,'Camelia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camelia 348x348.jpg',79.4),(140,'Caraibes 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Caraibes 348x348.jpg',79.4),(141,'Clairiere 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Clairiere 348x348.jpg',79.4),(142,'Coriandre 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Coriandre 348x348.jpg',79.4),(143,'Danube 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Danube 348x348.jpg',89.4),(144,'Egee 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Egee 348x348.jpg',79.4),(145,'Fidij 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Fidij 348x348.jpg',79.4),(146,'Flores 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Flores 348x348.jpg',NULL),(147,'Galapagos 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Galapagos 348x348.jpg',89.4),(148,'Genet 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Genet 348x348.jpg',89.4),(149,'Gravier 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Gravier 348x348.jpg',79.4),(150,'Ivraie 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Ivraie 348x348.jpg',79.4),(151,'Lavande 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lavande 348x348.jpg',79.4),(152,'Lotus 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lotus 348x348.jpg',79.4),(153,'Mouette 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Mouette 348x348.jpg',79.4),(154,'Noisetier 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Noisetier 348x348.jpg',89.4),(155,'Petale 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Petale 348x348.jpg',79.4),(156,'Pierre 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pierre 348x348.jpg',79.4),(157,'Pivoine 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pivoine 348x348.jpg',98.4),(158,'Pollen 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pollen 348x348.jpg',89.4),(159,'Prunelle 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Prunelle 348x348.jpg',98.4),(160,'Quetsche 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Quetsche 348x348.jpg',98.4),(161,'Schiste 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Schiste 348x348.jpg',79.4),(162,'Tuile 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Tuile 348x348.jpg',79.4),(163,'Zinnia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Zinnia 348x348.jpg',89.4);
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

-- Dump completed on 2014-07-17 19:40:00
