-- CREATE DATABASE  IF NOT EXISTS `ug207337_mosaic` /*!40100 DEFAULT CHARACTER SET utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'pl-x7','unglazed_tiles15x15-9mm','/img/catalogue/unglazed/tiles15x15-9mm/pl-x7.jpg',NULL),(2,'Anthracite','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Anthracite.jpg',NULL),(3,'Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Blanc.jpg',NULL),(4,'Bleu Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Fonce.jpg',NULL),(5,'Bleu Nuit','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Nuit.jpg',NULL),(6,'Bleu Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu Pale.jpg',NULL),(7,'Bleu','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Bleu.jpg',NULL),(8,'Brun','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Brun.jpg',NULL),(9,'Café','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Café.jpg',NULL),(10,'Caramel','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Caramel.jpg',NULL),(11,'Cognac','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Cognac.jpg',NULL),(12,'Gris Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris Pale.jpg',NULL),(13,'Gris','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Gris.jpg',NULL),(14,'Havane','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Havane.jpg',NULL),(15,'Ivoire','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ivoire.jpg',NULL),(16,'Jaune','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Jaune.jpg',NULL),(17,'Linen','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Linen.jpg',NULL),(18,'Noir','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Noir.jpg',NULL),(19,'Ontario','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Ontario.jpg',NULL),(20,'Parme','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Parme.jpg',NULL),(21,'Perle','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Perle.jpg',NULL),(22,'Pistache','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Pistache.jpg',NULL),(23,'Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rose.jpg',NULL),(24,'Rouge','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Rouge.jpg',NULL),(25,'Super Blanc','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Super Blanc.jpg',NULL),(26,'Vanille','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vanille.jpg',NULL),(27,'Vert Fonce','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Fonce.jpg',NULL),(28,'Vert Pale','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert Pale.jpg',NULL),(29,'Vert','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vert.jpg',NULL),(30,'Vieux Rose','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/Vieux Rose.jpg',NULL),(31,'aWinckelmans','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/aWinckelmans.jpg',NULL),(32,'pion_1','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_1.jpg',NULL),(33,'pion_2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_2.jpg',NULL),(34,'pion_3','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_3.jpg',NULL),(35,'pion_4','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_4.jpg',NULL),(36,'pion_5','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_5.jpg',NULL),(37,'pion_6','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/pion_6.jpg',NULL),(38,'plytka102x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka102x2.jpg',NULL),(39,'plytka112x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka112x2.jpg',NULL),(40,'plytka122x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka122x2.jpg',NULL),(41,'plytka132x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka132x2.jpg',NULL),(42,'plytka142x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka142x2.jpg',NULL),(43,'plytka152x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka152x2.jpg',NULL),(44,'plytka162x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka162x2.jpg',NULL),(45,'plytka172x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka172x2.jpg',NULL),(46,'plytka182x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka182x2.jpg',NULL),(47,'plytka192x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka192x2.jpg',NULL),(48,'plytka202x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka202x2.jpg',NULL),(49,'plytka212x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka212x2.jpg',NULL),(50,'plytka222x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka222x2.jpg',NULL),(51,'plytka232x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka232x2.jpg',NULL),(52,'plytka242x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka242x2.jpg',NULL),(53,'plytka252x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka252x2.jpg',NULL),(54,'plytka262x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka262x2.jpg',NULL),(55,'plytka272x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka272x2.jpg',NULL),(56,'plytka282x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka282x2.jpg',NULL),(57,'plytka292x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka292x2.jpg',NULL),(58,'plytka302x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka302x2.jpg',NULL),(59,'plytka72x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka72x2.jpg',NULL),(60,'plytka82x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka82x2.jpg',NULL),(61,'plytka92x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/plytka92x2.jpg',NULL),(62,'poziom_322x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_322x2.jpg',NULL),(63,'poziom_332x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_332x2.jpg',NULL),(64,'poziom_342x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_342x2.jpg',NULL),(65,'poziom_352x2','unglazed_tiles2x2-3.8mm','/img/catalogue/unglazed/tiles2x2-3.8mm/poziom_352x2.jpg',NULL),(66,'pl-x1','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x1.jpg',NULL),(67,'pl-x11','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x11.jpg',NULL),(68,'pl-x2','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x2.jpg',NULL),(69,'pl-x3','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x3.jpg',NULL),(70,'pl-x4','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x4.jpg',NULL),(71,'pl-x5','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x5.jpg',NULL),(72,'pl-x6','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x6.jpg',NULL),(73,'pl-x9','unglazed_tiles10x10-9mm','/img/catalogue/unglazed/tiles10x10-9mm/pl-x9.jpg',NULL),(74,'pl-x10','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x10.jpg',NULL),(75,'pl-x8','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/pl-x8.jpg',NULL),(76,'w1','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w1.jpg',NULL),(77,'w2','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w2.jpg',NULL),(78,'w3','unglazed_victorian-9mm','/img/catalogue/unglazed/victorian-9mm/w3.jpg',NULL),(79,'basket1','unglazed_basket','/img/catalogue/unglazed/basket/basket1.jpg',NULL),(80,'basket2','unglazed_basket','/img/catalogue/unglazed/basket/basket2.jpg',NULL),(81,'basket3','unglazed_basket','/img/catalogue/unglazed/basket/basket3.jpg',NULL),(82,'basket4','unglazed_basket','/img/catalogue/unglazed/basket/basket4.jpg',NULL),(83,'basket5','unglazed_basket','/img/catalogue/unglazed/basket/basket5.jpg',NULL),(84,'basket6','unglazed_basket','/img/catalogue/unglazed/basket/basket6.jpg',NULL),(85,'Albatre Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Albatre Tiles 348x348.jpg',NULL),(86,'Amethyste Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Amethyste Tiles 348x348.jpg',NULL),(87,'Bentonite Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Bentonite Tiles 348x348.jpg',NULL),(88,'Calcedoine Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Calcedoine Tiles 348x348.jpg',NULL),(89,'Chaux Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Chaux Tiles 348x348.jpg',NULL),(90,'Cobalt Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Cobalt Tiles 348x348.jpg',NULL),(91,'Corali Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Corali Tiles 348x348.jpg',NULL),(92,'Craie Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Craie Tiles 348x348.jpg',NULL),(93,'Emeraude Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Emeraude Tiles 348x348.jpg',NULL),(94,'Fabulite Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Fabulite Tiles 348x348.jpg',NULL),(95,'Gelene Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Gelene Tiles 348x348.jpg',NULL),(96,'Holite Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Holite Tiles 348x348.jpg',NULL),(97,'Jaspe Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Jaspe Tiles 348x348.jpg',NULL),(98,'Lave Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lave Tiles 348x348.jpg',NULL),(99,'Lazuli Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Lazuli Tiles 348x348.jpg',NULL),(100,'Malachite Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Malachite Tiles 348x348.jpg',NULL),(101,'Mastic Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Mastic Tiles 348x348.jpg',NULL),(102,'Minium Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Minium Tiles 348x348.jpg',NULL),(103,'Onyx Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Onyx Tiles 348x348.jpg',NULL),(104,'Pepite Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Pepite Tiles 348x348.jpg',NULL),(105,'Porphyre Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Porphyre Tiles 348x348.jpg',NULL),(106,'Quartz Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Quartz Tiles 348x348.jpg',NULL),(107,'Resine Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Resine Tiles 348x348.jpg',NULL),(108,'Rubis Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Rubis Tiles 348x348.jpg',NULL),(109,'Saphir Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Saphir Tiles 348x348.jpg',NULL),(110,'Silex Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Silex Tiles 348x348.jpg',NULL),(111,'Topaze Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Topaze Tiles 348x348.jpg',NULL),(112,'Turquoise Tiles 348x348','satin&matt_tiles2.5x2.5-cmm','/img/catalogue/satin&matt/tiles2.5x2.5-cmm/Turquoise Tiles 348x348.jpg',NULL),(113,'Aster','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Aster.jpg',NULL),(114,'Bahamas','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahamas.jpg',NULL),(115,'Bahia','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Bahia.jpg',NULL),(116,'Buis','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Buis.jpg',NULL),(117,'Californie','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Californie.jpg',NULL),(118,'Camel','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camel.jpg',NULL),(119,'Camelia','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Camelia.jpg',NULL),(120,'Caraibes','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Caraibes.jpg',NULL),(121,'Cipagno','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Cipagno.jpg',NULL),(122,'Clairiere','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Clairiere.jpg',NULL),(123,'Coriandre','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Coriandre.jpg',NULL),(124,'Danube','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Danube.jpg',NULL),(125,'Egee','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Egee.jpg',NULL),(126,'Flores','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Flores.jpg',NULL),(127,'Fuschia','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Fuschia.jpg',NULL),(128,'Galapagos','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Galapagos.jpg',NULL),(129,'Genet','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Genet.jpg',NULL),(130,'Gravier','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Gravier.jpg',NULL),(131,'Ivraie','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Ivraie.jpg',NULL),(132,'Lavender Tiles','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lavender Tiles.jpg',NULL),(133,'Lavender','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lavender.jpg',NULL),(134,'Lotus','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Lotus.jpg',NULL),(135,'Mouette','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Mouette.jpg',NULL),(136,'Noisetier','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Noisetier.jpg',NULL),(137,'Pierre','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pierre.jpg',NULL),(138,'Pivoine','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pivoine.jpg',NULL),(139,'Pollen','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Pollen.jpg',NULL),(140,'Prunelle','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Prunelle.jpg',NULL),(141,'Quetsche','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Quetsche.jpg',NULL),(142,'Schiste','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Schiste.jpg',NULL),(143,'Zinnia','glazed_tiles2.5x2.5-cmm','/img/catalogue/glazed/tiles2.5x2.5-cmm/Zinnia.jpg',NULL);
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

-- Dump completed on 2014-07-07 20:18:34
