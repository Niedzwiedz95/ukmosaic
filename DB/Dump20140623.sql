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
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'classic_35_3L','unglazed_tiles3.5x3.5','/img/catalogue/unglazed/tiles3.5x3.5/classic_35_3L.gif',NULL),(2,'classic_35_2L','unglazed_tiles3.5x3.5','/img/catalogue/unglazed/tiles3.5x3.5/classic_35_2L.gif',NULL),(3,'classic_100_70dog_4L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_4L.gif',NULL),(4,'classic_100_70dog_2L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_2L.gif',NULL),(5,'classic_100_3L_v2','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_3L_v2.gif',NULL),(6,'classic_100_dog_7L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_dog_7L.gif',NULL),(7,'classic_100_vis_2L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_vis_2L.gif',NULL),(8,'classic_100_70dog_3L_v2','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_3L_v2.gif',NULL),(9,'classic_100_70dog_3L_v3','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_3L_v3.gif',NULL),(10,'classic_100_1L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_1L.gif',NULL),(11,'classic_100_70dog_3L_v4','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_3L_v4.gif',NULL),(12,'classic_100_2L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_2L.gif',NULL),(13,'classic_100_70dia_2L_v2','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dia_2L_v2.gif',NULL),(14,'classic_100_70dog_3L_v1','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dog_3L_v1.gif',NULL),(15,'classic_100_3L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_3L.gif',NULL),(16,'classic_100_70dia_2L','unglazed_tiles10x10','/img/catalogue/unglazed/tiles10x10/classic_100_70dia_2L.gif',NULL),(17,'classic_50_rev_dia_rev_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_dia_rev_2L.gif',NULL),(18,'classic_50_50tri_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_50tri_2L.gif',NULL),(19,'classic_50_rev_dia_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_dia_3L.gif',NULL),(20,'classic_50_dia_2L_v2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v2.gif',NULL),(21,'classic_50_farringdon_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_farringdon_3L.gif',NULL),(22,'classic_50_dia_2L_v6','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v6.gif',NULL),(23,'classic_50_dia_rev_4L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_rev_4L.gif',NULL),(24,'classic_50_pyr70_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_pyr70_3L.gif',NULL),(25,'classic_50_rev_dia_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_dia_2L.gif',NULL),(26,'classic_50_dia_2L_v5','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v5.gif',NULL),(27,'classic_50_dia_2L_v7','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v7.gif',NULL),(28,'classic_50_50str_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_50str_2L.gif',NULL),(29,'classic_50_35sq_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_35sq_2L.gif',NULL),(30,'classic_50_dia_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L.gif',NULL),(31,'classic_50_zz_2L_v2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_zz_2L_v2.gif',NULL),(32,'classic_50_zz_2L_v3','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_zz_2L_v3.gif',NULL),(33,'classic_50_dia_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_3L.gif',NULL),(34,'classic_50_dia_6L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_6L.gif',NULL),(35,'classic_50_dia_5L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_5L.gif',NULL),(36,'classic_50_dia_35mm2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_35mm2L.gif',NULL),(37,'classic_50_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_3L.gif',NULL),(38,'classic_50_zz_4L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_zz_4L.gif',NULL),(39,'classic_50_dia_2L_v3','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v3.gif',NULL),(40,'classic_50_rev_zz_rev_3L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_zz_rev_3L.gif',NULL),(41,'classic_50_rev_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_2L.gif',NULL),(42,'classic_50_1L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_1L.gif',NULL),(43,'classic_50_dia_2L_v4','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dia_2L_v4.gif',NULL),(44,'classic_50_3L_v2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_3L_v2.gif',NULL),(45,'classic_50_dog_4L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_dog_4L.gif',NULL),(46,'classic_50_zz_2L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_zz_2L.gif',NULL),(47,'classic_50_zz_4L_v2','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_zz_4L_v2.gif',NULL),(48,'classic_50_35grid','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_35grid.gif',NULL),(49,'classic_50_rev_dog_4L','unglazed_tiles5x5-9mm','/img/catalogue/unglazed/tiles5x5-9mm/classic_50_rev_dog_4L.gif',NULL),(50,'classic_150_2L','unglazed_tiles15x15','/img/catalogue/unglazed/tiles15x15/classic_150_2L.gif',NULL),(51,'classic_150_rev_3L','unglazed_tiles15x15','/img/catalogue/unglazed/tiles15x15/classic_150_rev_3L.gif',NULL),(52,'classic_70_50dia_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_2L.gif',NULL),(53,'classic_70_70tri_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_70tri_2L.gif',NULL),(54,'classic_70_dog_3L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dog_3L.gif',NULL),(55,'classic_70_pyr_5L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_pyr_5L.gif',NULL),(56,'classic_70_50zz_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50zz_2L.gif',NULL),(57,'classic_70_1L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_1L.gif',NULL),(58,'classic_70_rev_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_rev_2L.gif',NULL),(59,'classic_70_dog_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dog_2L.gif',NULL),(60,'classic_70_dia_4L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dia_4L.gif',NULL),(61,'classic_70_3L_v2','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_3L_v2.gif',NULL),(62,'classic_70_vis_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_vis_2L.gif',NULL),(63,'classic_70_50dia_rev_4L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_rev_4L.gif',NULL),(64,'classic_70_50dia_2L_v3','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_2L_v3.gif',NULL),(65,'classic_70_3L_v4','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_3L_v4.gif',NULL),(66,'classic_70_dia_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dia_2L.gif',NULL),(67,'classic_70_50dia_2L_v2','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_2L_v2.gif',NULL),(68,'classic_70_50dia_3L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_3L.gif',NULL),(69,'classic_70_dia_5L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dia_5L.gif',NULL),(70,'classic_70_dog_3L_v2','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_dog_3L_v2.gif',NULL),(71,'classic_70_50dia_rev_3L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_rev_3L.gif',NULL),(72,'classic_70_3L_v3','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_3L_v3.gif',NULL),(73,'classic_70_rev_2L_v2','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_rev_2L_v2.gif',NULL),(74,'classic_70_50dia_4L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_4L.gif',NULL),(75,'classic_70_rev_dia_3L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_rev_dia_3L.gif',NULL),(76,'classic_70_50dia_2L_v4','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_50dia_2L_v4.gif',NULL),(77,'classic_70_2L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_2L.gif',NULL),(78,'classic_70_3L','unglazed_tiles7x7','/img/catalogue/unglazed/tiles7x7/classic_70_3L.gif',NULL),(79,'octagon_100_50dia_6L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_50dia_6L.gif',NULL),(80,'octagon_100_3L_v3','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_3L_v3.gif',NULL),(81,'octagon_100_3L_v4','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_3L_v4.gif',NULL),(82,'octagon_100_3L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_3L.gif',NULL),(83,'octagon_100_50zz_2L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_50zz_2L.gif',NULL),(84,'octagon_100_3L_v2','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_3L_v2.gif',NULL),(85,'octagon_100_50dog_3L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_50dog_3L.gif',NULL),(86,'octagon_100_diain_50dog_4L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_diain_50dog_4L.gif',NULL),(87,'octagon_100_50zz_4L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_50zz_4L.gif',NULL),(88,'octagon_100_1L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_1L.gif',NULL),(89,'octagon_100_50dia_2L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_50dia_2L.gif',NULL),(90,'octagon_100_diain_3L','unglazed_octagon10x10','/img/catalogue/unglazed/octagon10x10/octagon_100_diain_3L.gif',NULL),(91,'yvonne_70','unglazed_victorian','/img/catalogue/unglazed/victorian/yvonne_70.gif',NULL),(92,'petersham_vis_5L','unglazed_victorian','/img/catalogue/unglazed/victorian/petersham_vis_5L.gif',NULL),(93,'stevenson_50_2L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_2L_v2.gif',NULL),(94,'willesden_50_granada_4L','unglazed_victorian','/img/catalogue/unglazed/victorian/willesden_50_granada_4L.gif',NULL),(95,'stevenson_50_dia_2L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_2L_v2.gif',NULL),(96,'stevenson_70_50dia_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_50dia_3L.gif',NULL),(97,'stevenson_50_3L_v3','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L_v3.gif',NULL),(98,'portland_50_dia_2L','unglazed_victorian','/img/catalogue/unglazed/victorian/portland_50_dia_2L.gif',NULL),(99,'stevenson_50_dia_3L_v4','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_3L_v4.gif',NULL),(100,'stevenson_50_3L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L_v2.gif',NULL),(101,'shoto_70_1L','unglazed_victorian','/img/catalogue/unglazed/victorian/shoto_70_1L.gif',NULL),(102,'w3','unglazed_victorian','/img/catalogue/unglazed/victorian/w3.jpg',NULL),(103,'stevenson_50_dia_3L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_3L_v2.gif',NULL),(104,'stevenson_70_50dog_3L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_50dog_3L_v2.gif',NULL),(105,'sova_70_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/sova_70_3L.gif',NULL),(106,'stevenson_50_70dia_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_70dia_3L.gif',NULL),(107,'stevenson_70_50dog_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_50dog_3L.gif',NULL),(108,'stevenson_50_3L_v6','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L_v6.gif',NULL),(109,'stevenson_50_dia_4L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_4L.gif',NULL),(110,'stevenson_70_chapel_4L_v3','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_chapel_4L_v3.gif',NULL),(111,'sova_50_metro_4L','unglazed_victorian','/img/catalogue/unglazed/victorian/sova_50_metro_4L.gif',NULL),(112,'stevenson_50_1L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_1L.gif',NULL),(113,'stevenson_50_2L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_2L.gif',NULL),(114,'w1','unglazed_victorian','/img/catalogue/unglazed/victorian/w1.jpg',NULL),(115,'stevenson_70_chapel_4L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_chapel_4L.gif',NULL),(116,'stevenson_50_dia_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_3L.gif',NULL),(117,'stevenson_50_3L_v4','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L_v4.gif',NULL),(118,'stevenson_50_dia_4L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_4L_v2.gif',NULL),(119,'shoto_70_2L','unglazed_victorian','/img/catalogue/unglazed/victorian/shoto_70_2L.gif',NULL),(120,'stevenson_50_dia_3L_v3','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_3L_v3.gif',NULL),(121,'stevenson_50_3L_v5','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L_v5.gif',NULL),(122,'stevenson_70_chapel_4L_v2','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_70_chapel_4L_v2.gif',NULL),(123,'stevenson_50_3L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_3L.gif',NULL),(124,'stevenson_50_dia_2L','unglazed_victorian','/img/catalogue/unglazed/victorian/stevenson_50_dia_2L.gif',NULL),(125,'w2','unglazed_victorian','/img/catalogue/unglazed/victorian/w2.jpg',NULL),(126,'72x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/72x2.jpg',NULL),(127,'122x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/122x2.jpg',NULL),(128,'342x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/342x2.jpg',NULL),(129,'82x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/82x2.jpg',NULL),(130,'162x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/162x2.jpg',NULL),(131,'192x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/192x2.jpg',NULL),(132,'102x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/102x2.jpg',NULL),(133,'222x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/222x2.jpg',NULL),(134,'332x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/332x2.jpg',NULL),(135,'112x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/112x2.jpg',NULL),(136,'322x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/322x2.jpg',NULL),(137,'242x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/242x2.jpg',NULL),(138,'172x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/172x2.jpg',NULL),(139,'302x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/302x2.jpg',NULL),(140,'182x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/182x2.jpg',NULL),(141,'142x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/142x2.jpg',NULL),(142,'pasek6','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek6.jpg',NULL),(143,'pasek4','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek4.jpg',NULL),(144,'pasek5','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek5.jpg',NULL),(145,'262x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/262x2.jpg',NULL),(146,'252x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/252x2.jpg',NULL),(147,'232x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/232x2.jpg',NULL),(148,'pasek3','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek3.jpg',NULL),(149,'132x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/132x2.jpg',NULL),(150,'352x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/352x2.jpg',NULL),(151,'pasek1','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek1.jpg',NULL),(152,'152x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/152x2.jpg',NULL),(153,'212x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/212x2.jpg',NULL),(154,'282x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/282x2.jpg',NULL),(155,'Winckelmans2014-page-019','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/Winckelmans2014-page-019.jpg',NULL),(156,'pasek2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/pasek2.jpg',NULL),(157,'92x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/92x2.jpg',NULL),(158,'202x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/202x2.jpg',NULL),(159,'292x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/292x2.jpg',NULL),(160,'272x2','unglazed_tiles2x2-38mm','/img/catalogue/unglazed/tiles2x2-38mm/272x2.jpg',NULL),(161,'octagon_150_50vis_2L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_50vis_2L.gif',NULL),(162,'octagon_150_70dia_3L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_70dia_3L.gif',NULL),(163,'octagon_150_1L_v2','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_1L_v2.gif',NULL),(164,'octagon_150_diasetin_50dia_2L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_diasetin_50dia_2L.gif',NULL),(165,'octagon_150_sqsetin_50dia_6L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_sqsetin_50dia_6L.gif',NULL),(166,'octagon_150_2L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_2L.gif',NULL),(167,'octagon_150_sqset_1L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_sqset_1L.gif',NULL),(168,'octagon_150_50dia_50str_1L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_50dia_50str_1L.gif',NULL),(169,'octagon_150_sqsetin_50dia_5L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_sqsetin_50dia_5L.gif',NULL),(170,'octagon_150_sqsetin_2L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_sqsetin_2L.gif',NULL),(171,'octagon_150_sqset_100dia_4L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_sqset_100dia_4L.gif',NULL),(172,'octagon_150_1L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_1L.gif',NULL),(173,'octagon_150_50str_2L','unglazed_octagon15x15','/img/catalogue/unglazed/octagon15x15/octagon_150_50str_2L.gif',NULL),(174,'Topaze Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Topaze Tiles 348x348.jpg',NULL),(175,'Minium Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Minium Tiles 348x348.jpg',NULL),(176,'Lazuli Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Lazuli Tiles 348x348.jpg',NULL),(177,'Amethyste Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Amethyste Tiles 348x348.jpg',NULL),(178,'Quartz Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Quartz Tiles 348x348.jpg',NULL),(179,'Mastic Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Mastic Tiles 348x348.jpg',NULL),(180,'Albatre Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Albatre Tiles 348x348.jpg',NULL),(181,'Saphir Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Saphir Tiles 348x348.jpg',NULL),(182,'Emeraude Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Emeraude Tiles 348x348.jpg',NULL),(183,'Porphyre Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Porphyre Tiles 348x348.jpg',NULL),(184,'Corali Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Corali Tiles 348x348.jpg',NULL),(185,'Rubis Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Rubis Tiles 348x348.jpg',NULL),(186,'Fabulite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Fabulite Tiles 348x348.jpg',NULL),(187,'Cobalt Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Cobalt Tiles 348x348.jpg',NULL),(188,'Onyx Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Onyx Tiles 348x348.jpg',NULL),(189,'Jaspe Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Jaspe Tiles 348x348.jpg',NULL),(190,'Gelene Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Gelene Tiles 348x348.jpg',NULL),(191,'Calcedoine Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Calcedoine Tiles 348x348.jpg',NULL),(192,'Resine Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Resine Tiles 348x348.jpg',NULL),(193,'Bentonite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Bentonite Tiles 348x348.jpg',NULL),(194,'Malachite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Malachite Tiles 348x348.jpg',NULL),(195,'Turquoise Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Turquoise Tiles 348x348.jpg',NULL),(196,'Holite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Holite Tiles 348x348.jpg',NULL),(197,'Lave Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Lave Tiles 348x348.jpg',NULL),(198,'Craie Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Craie Tiles 348x348.jpg',NULL),(199,'Chaux Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Chaux Tiles 348x348.jpg',NULL),(200,'Pepite Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Pepite Tiles 348x348.jpg',NULL),(201,'Silex Tiles 348x348','satin&matt_tiles2.5x2.5','/img/catalogue/satin&matt/tiles2.5x2.5/Silex Tiles 348x348.jpg',NULL),(202,'Danube','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Danube.jpg',NULL),(203,'Prunelle','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Prunelle.jpg',NULL),(204,'Californie','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Californie.jpg',NULL),(205,'Gravier','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Gravier.jpg',NULL),(206,'Mouette','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Mouette.jpg',NULL),(207,'Pollen','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pollen.jpg',NULL),(208,'Quetsche','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Quetsche.jpg',NULL),(209,'Lavender Tiles','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lavender Tiles.jpg',NULL),(210,'Fuschia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Fuschia.jpg',NULL),(211,'Coriandre','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Coriandre.jpg',NULL),(212,'Camelia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Camelia.jpg',NULL),(213,'Cipagno Tiles','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Cipagno Tiles.jpg',NULL),(214,'Egee','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Egee.jpg',NULL),(215,'Noisetier','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Noisetier.jpg',NULL),(216,'Schiste','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Schiste.jpg',NULL),(217,'Bahia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Bahia.jpg',NULL),(218,'Lotus','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lotus.jpg',NULL),(219,'Cipagno','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Cipagno.jpg',NULL),(220,'Aster','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Aster.jpg',NULL),(221,'Zinnia','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Zinnia.jpg',NULL),(222,'Flores','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Flores.jpg',NULL),(223,'Buis','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Buis.jpg',NULL),(224,'Pierre','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pierre.jpg',NULL),(225,'Genet','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Genet.jpg',NULL),(226,'Bahamas','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Bahamas.jpg',NULL),(227,'Caraibes','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Caraibes.jpg',NULL),(228,'Lavender','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Lavender.jpg',NULL),(229,'Fuschia Tiles','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Fuschia Tiles.jpg',NULL),(230,'Clairiere','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Clairiere.jpg',NULL),(231,'Camel','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Camel.jpg',NULL),(232,'Ivraie','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Ivraie.jpg',NULL),(233,'Galapagos','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Galapagos.jpg',NULL),(234,'Pivoine','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Pivoine.jpg',NULL),(235,'Flores Tiles','glazed_tiles2.5x2.5','/img/catalogue/glazed/tiles2.5x2.5/Flores Tiles.jpg',NULL);
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

-- Dump completed on 2014-06-23 15:46:34
