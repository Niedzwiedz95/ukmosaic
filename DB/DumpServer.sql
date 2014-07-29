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
  `FullName` varchar(256) NOT NULL,
  `Street` varchar(256) NOT NULL,
  `Locality` varchar(256) NOT NULL,
  `PostTown` varchar(256) NOT NULL,
  `Postcode` varchar(256) NOT NULL,
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
  `Description` char(255) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `PriceLoose1` double DEFAULT NULL,
  `PriceAssembledTiles` double DEFAULT NULL,
  `PriceLoose2` double DEFAULT NULL,
  `PriceAssembledBorders` double DEFAULT NULL,
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
INSERT INTO `Products` VALUES (1,'pl-x7','unglazed_tiles15x15-9mm','/img/catalogue/unglazed/tiles15x15-9mm/pl-x7.jpg','Black and white checkerboard with diamond',NULL,89.25,85.25,105.25,NULL),(2,'pl-x17','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x17.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(3,'pl-x18','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x18.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(4,'pl-x19','unglazed_octagon10x10-9mm','/img/catalogue/unglazed/octagon10x10-9mm/pl-x19.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(5,'pl-5x5-1','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-1.jpg','White and black checkerboard with diamond border',NULL,161.25,218.25,34.25,48.25),(6,'pl-5x5-2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-2.jpg','White and black checkerboard with border',NULL,165.25,218.25,29.25,NULL),(7,'pl-5x5-3','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-3.jpg','Red and grey checkerboard with diamond border',NULL,195.25,245.25,58.25,69.25),(8,'pl-5x5-4','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-4.jpg','White and black checkerboard with border',NULL,165.25,218.25,51.25,NULL),(9,'pl-5x5-5','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-5x5-5.jpg',NULL,NULL,165.25,218.25,33.25,48.25),(10,'pl-x14','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/pl-x14.jpg','White and black checkerboard with border',NULL,165.25,218.25,28.25,36.25),(11,'Anthracite','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Anthracite.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Blanc.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(13,'Bleu Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Fonce.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Bleu Nuit','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Nuit.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Bleu Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Pale.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(16,'Bleu','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(17,'Brun','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Brun.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(18,'Café','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Café.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(19,'Caramel','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Caramel.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(20,'Cognac','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Cognac.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(21,'Gris Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris Pale.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(22,'Gris','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(23,'Havane','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Havane.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(24,'Ivoire','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ivoire.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(25,'Jaune','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Jaune.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(26,'Linen','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Linen.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(27,'Noir','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Noir.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(28,'Ontario','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ontario.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(29,'Parme','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Parme.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(30,'Perle','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Perle.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(31,'Pistache','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Pistache.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(32,'Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rose.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(33,'Rouge','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rouge.jpg',NULL,49.99,NULL,NULL,NULL,NULL),(34,'Super Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Super Blanc.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(35,'Vanille','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vanille.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(36,'Vert Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Fonce.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(37,'Vert Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Pale.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(38,'Vert','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert.jpg',NULL,57.45,NULL,NULL,NULL,NULL),(39,'Vieux Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vieux Rose.jpg',NULL,52.45,NULL,NULL,NULL,NULL),(40,'aWinckelmans','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/aWinckelmans.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(41,'pion_1','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_1.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(42,'pion_2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(43,'pion_3','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_3.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(44,'pion_4','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_4.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(45,'pion_5','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_5.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(46,'pion_6','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_6.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(47,'plytka102x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka102x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(48,'plytka112x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka112x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(49,'plytka122x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka122x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(50,'plytka132x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka132x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(51,'plytka142x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka142x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(52,'plytka152x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka152x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(53,'plytka162x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka162x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(54,'plytka172x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka172x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(55,'plytka182x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka182x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(56,'plytka192x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka192x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(57,'plytka202x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka202x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(58,'plytka212x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka212x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(59,'plytka222x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka222x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(60,'plytka232x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka232x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(61,'plytka242x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka242x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(62,'plytka252x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka252x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(63,'plytka262x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka262x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(64,'plytka272x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka272x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(65,'plytka282x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka282x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(66,'plytka292x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka292x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(67,'plytka302x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka302x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(68,'plytka72x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka72x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(69,'plytka82x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka82x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(70,'plytka92x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka92x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(71,'poziom_322x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_322x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(72,'poziom_332x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_332x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(73,'poziom_342x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_342x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(74,'poziom_352x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_352x2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(75,'pl-x1','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x1.jpg','Red and white checkerboard with diamond border',NULL,75.25,109.25,49.25,58.5),(76,'pl-x11','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x11.jpg','White and black checkerboard with diamond border',NULL,75.25,109.25,72.25,86.25),(77,'pl-x2','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x2.jpg','White and black checkerboard with diamond border',NULL,75.25,109.25,68.45,79.25),(78,'pl-x3','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x3.jpg','White and black checkerboard with border',NULL,75.25,109.25,31,46.25),(79,'pl-x4','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x4.jpg','Black and coffe checkerboard with diamond border',NULL,79.25,114.25,71.45,83.45),(80,'pl-x5','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x5.jpg','White and black checkerboard with diamond border',NULL,75.25,109.25,41.25,58.25),(81,'pl-x6','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x6.jpg','Black and white checkerboard',NULL,75.25,109.25,85,104.45),(82,'pl-x9','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x9.jpg','White and black checkerboard with border',NULL,75.25,109.25,18.25,NULL),(83,'Panda Design','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/Panda Design.jpg','Black and white design with diamond border',NULL,345.25,399.25,38.25,49.25),(84,'Coral Design','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x15.jpg',NULL,NULL,311.25,389.25,43.25,56.25),(85,'Sydney Design','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x21.jpg',NULL,NULL,339.25,401.25,36.25,NULL),(86,'Aggy Design','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x8.jpg',NULL,NULL,162.25,221.25,72.25,83.25),(87,'w1','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w1.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(88,'w2','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w2.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(89,'w3','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w3.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(90,'Basket Weave 1','unglazed_basket','/img/catalogue/unglazed/basket/basket1.jpg','White with black dots',118.25,NULL,NULL,NULL,NULL),(91,'Basket Weave 2','unglazed_basket','/img/catalogue/unglazed/basket/basket2.jpg','Anthracite with ontario dots',127.25,NULL,NULL,NULL,NULL),(92,'Basket Weave 3','unglazed_basket','/img/catalogue/unglazed/basket/basket3.jpg',' Pistachio with super white dots',134.25,NULL,NULL,NULL,NULL),(93,'Basket Weave 4','unglazed_basket','/img/catalogue/unglazed/basket/basket4.jpg','Gris with black dots',118.25,NULL,NULL,NULL,NULL),(94,'Basket Weave 5','unglazed_basket','/img/catalogue/unglazed/basket/basket5.jpg','Blue nuit with ontario dots',163.25,NULL,NULL,NULL,NULL),(95,'Basket Weave 6','unglazed_basket','/img/catalogue/unglazed/basket/basket6.jpg','Black with white dots',118.25,NULL,NULL,NULL,NULL),(96,'pl-7x7-1','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-1.jpg','White and black checkerboard with diamond border',NULL,113.25,181.25,61.25,74.25),(97,'pl-7x7-2','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-2.jpg','White and black checkerboard with diamond border',NULL,113.25,181.25,29.25,41.25),(98,'pl-7x7-3','unglazed_tiles7x7-9mm','/img/catalogue/unglazed/tiles7x7-9mm/pl-7x7-3.jpg',NULL,NULL,113.25,181.25,49.25,61.25),(99,'pl-x12','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x12.jpg','Checkerboard red with grey with diamond border',NULL,311.25,358.25,63.25,76.25),(100,'pl-x13','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x13.jpg','Checkerboard black and white with border',NULL,265.25,318.25,43.25,59.25),(101,'pl-x16','unglazed_tiles3.5x3.5-9mm','/img/catalogue/unglazed/tiles3.5x3.5-9mm/pl-x16.jpg','Checkerboard black and white with border',NULL,262.25,318.25,26.25,NULL),(102,'pl-x20','unglazed_octagon15x15-9mm','/img/catalogue/unglazed/octagon15x15-9mm/pl-x20.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(103,'Albatre 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Albatre 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(104,'Amethyste 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Amethyste 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(105,'Azurite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Azurite 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(106,'Bentonite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Bentonite 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(107,'Calcedoine 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Calcedoine 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(108,'Chaux 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Chaux 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(109,'Cobalt 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Cobalt 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(110,'Corali 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Corali 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(111,'Craie 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Craie 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(112,'Emeraude 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Emeraude 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(113,'Fabulite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Fabulite 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(114,'Gelene 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Gelene 348x348.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(115,'Holite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Holite 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(116,'Jaspe 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Jaspe 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(117,'Lave 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lave 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(118,'Lazuli 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lazuli 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(119,'Malachite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Malachite 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(120,'Mastic 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Mastic 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(121,'Minium 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Minium 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(122,'Onyx 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Onyx 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(123,'Pepite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Pepite 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(124,'Porphyre 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Porphyre 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(125,'Quartz 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Quartz 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(126,'Resine 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Resine 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(127,'Rubis 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Rubis 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(128,'Saphir 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Saphir 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(129,'Silex 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Silex 348x348.jpg',NULL,84.45,NULL,NULL,NULL,NULL),(130,'Sodalite 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Sodalite 348x348.jpg',NULL,119.45,NULL,NULL,NULL,NULL),(131,'Topaze 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Topaze 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(132,'Turquoise 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Turquoise 348x348.jpg',NULL,148.24,NULL,NULL,NULL,NULL),(133,'Aster 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Aster 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(134,'Bahamas 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahamas 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(135,'Bahia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahia 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(136,'Buis 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Buis 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(137,'Californie 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Californie 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(138,'Camel 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camel 348x348.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(139,'Camelia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camelia 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(140,'Caraibes 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Caraibes 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(141,'Clairiere 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Clairiere 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(142,'Coriandre 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Coriandre 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(143,'Danube 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Danube 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(144,'Egee 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Egee 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(145,'Fidij 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Fidij 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(146,'Flores 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Flores 348x348.jpg',NULL,NULL,NULL,NULL,NULL,NULL),(147,'Galapagos 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Galapagos 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(148,'Genet 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Genet 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(149,'Gravier 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Gravier 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(150,'Ivraie 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Ivraie 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(151,'Lavande 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lavande 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(152,'Lotus 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lotus 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(153,'Mouette 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Mouette 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(154,'Noisetier 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Noisetier 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(155,'Petale 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Petale 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(156,'Pierre 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pierre 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(157,'Pivoine 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pivoine 348x348.jpg',NULL,98.4,NULL,NULL,NULL,NULL),(158,'Pollen 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pollen 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL),(159,'Prunelle 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Prunelle 348x348.jpg',NULL,98.4,NULL,NULL,NULL,NULL),(160,'Quetsche 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Quetsche 348x348.jpg',NULL,98.4,NULL,NULL,NULL,NULL),(161,'Schiste 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Schiste 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(162,'Tuile 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Tuile 348x348.jpg',NULL,79.4,NULL,NULL,NULL,NULL),(163,'Zinnia 348x348','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Zinnia 348x348.jpg',NULL,89.4,NULL,NULL,NULL,NULL);
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
  `Email` varchar(255) NOT NULL,
  `PasswordHash` char(128) NOT NULL,
  `Salt` char(128) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `CustomerID_UNIQUE` (`UserID`),
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

-- Dump completed on 2014-07-29 16:37:52
