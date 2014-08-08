USE `ug207337_mosaic2`;

-- Recreate the Products table from scratch.
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