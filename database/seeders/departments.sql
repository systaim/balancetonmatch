-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: save_table_comments
-- ------------------------------------------------------
-- Server version	8.0.20


--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `region_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Ain',1,NULL,NULL),(2,'Aisne',9,NULL,NULL),(3,'Allier',1,NULL,NULL),(4,'Alpes',12,NULL,NULL),(7,'Ardennes',6,NULL,NULL),(8,'Ariège',15,NULL,NULL),(9,'Aube',6,NULL,NULL),(10,'Aude',15,NULL,NULL),(11,'Aveyron',15,NULL,NULL),(12,'Cotes d\'Azur',12,NULL,NULL),(13,'Calvados',13,NULL,NULL),(14,'Cantal',1,NULL,NULL),(15,'Charente',14,NULL,NULL),(16,'Charente-Maritime',14,NULL,NULL),(17,'Cher',4,NULL,NULL),(18,'Corrèze',14,NULL,NULL),(19,'Corse',5,NULL,NULL),(21,'Côte-d\'or',2,NULL,NULL),(22,'Côtes-d\'armor',3,NULL,NULL),(23,'Creuse',14,NULL,NULL),(24,'Dordogne - Périgord',14,NULL,NULL),(25,'Doubs - Territoire de Belfort',2,NULL,NULL),(26,'Drôme - Ardèche',1,NULL,NULL),(27,'Eure',13,NULL,NULL),(28,'Eure-et-Loir',4,NULL,NULL),(29,'Finistère',3,NULL,NULL),(30,'Gard - Lozère',15,NULL,NULL),(31,'Haute-Garonne',15,NULL,NULL),(32,'Gers',15,NULL,NULL),(33,'Gironde',14,NULL,NULL),(34,'Hérault',15,NULL,NULL),(35,'Ile-et-Vilaine',3,NULL,NULL),(36,'Indre',4,NULL,NULL),(37,'Indre-et-Loire',4,NULL,NULL),(38,'Isère',1,NULL,NULL),(39,'Jura',2,NULL,NULL),(40,'Landes',14,NULL,NULL),(41,'Loir-et-Cher',4,NULL,NULL),(42,'Loire',1,NULL,NULL),(43,'Haute-Loire',1,NULL,NULL),(44,'Loire-Atlantique',17,NULL,NULL),(45,'Loiret',4,NULL,NULL),(46,'Lot',15,NULL,NULL),(47,'Lot-et-Garonne',14,NULL,NULL),(49,'Maine-et-Loire',17,NULL,NULL),(50,'Manche',13,NULL,NULL),(51,'Marne',6,NULL,NULL),(52,'Haute-Marne',6,NULL,NULL),(53,'Mayenne',17,NULL,NULL),(54,'Meurthe-et-Moselle',6,NULL,NULL),(55,'Meuse',6,NULL,NULL),(56,'Morbihan',3,NULL,NULL),(57,'Mosellan',6,NULL,NULL),(58,'Nièvre',2,NULL,NULL),(59,'Oise',9,NULL,NULL),(60,'Orne',13,NULL,NULL),(61,'Puy-de-Dôme',1,NULL,NULL),(62,'Pyrénées-Atlantiques',14,NULL,NULL),(63,'Hautes-Pyrénées',15,NULL,NULL),(64,'Pyrénées-Orientales',15,NULL,NULL),(65,'Alsace',6,NULL,NULL),(66,'Lyon et du Rhône',1,NULL,NULL),(67,'Haute-Saône',2,NULL,NULL),(68,'Saône-et-Loire',2,NULL,NULL),(69,'Sarthe',17,NULL,NULL),(70,'Savoie',1,NULL,NULL),(71,'Haute-Savoie Pays-de-Gex',1,NULL,NULL),(73,'Seine-Maritime',13,NULL,NULL),(74,'Seine-et-Marne',16,NULL,NULL),(75,'Yvelines',16,NULL,NULL),(76,'Deux-Sèvres',14,NULL,NULL),(77,'Somme',9,NULL,NULL),(78,'Tarn',15,NULL,NULL),(79,'Tarn-et-Garonne',15,NULL,NULL),(80,'Var',12,NULL,NULL),(81,'Grand-Vaucluse',12,NULL,NULL),(82,'Vendée',17,NULL,NULL),(83,'Vienne',14,NULL,NULL),(84,'Haute-Vienne',14,NULL,NULL),(85,'Vosges',6,NULL,NULL),(86,'Yonne',2,NULL,NULL),(87,'Essonne',16,NULL,NULL),(88,'Hauts-de-Seine',16,NULL,NULL),(89,'Seine-Saint-Denis',16,NULL,NULL),(90,'Val-de-Marne',16,NULL,NULL),(91,'Val-d\'oise',16,NULL,NULL),(92,'Mayotte',11,NULL,NULL),(93,'Guadeloupe',7,NULL,NULL),(94,'Guyane',8,NULL,NULL),(95,'Martinique',10,NULL,NULL),(96,'Réunion',18,NULL,NULL),(97,'Artois',9,NULL,NULL),(98,'Escaut',9,NULL,NULL),(99,'Flandres',9,NULL,NULL),(100,'Cote d\'Opale',9,NULL,NULL),(101,'Provence',12,NULL,NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

-- Dump completed on 2021-01-19 21:56:11
