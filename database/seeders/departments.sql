-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: save_table_comments
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` int DEFAULT NULL,
  `nom_district` text,
  `region_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Ain',1),(2,'Aisne',9),(3,'Allier',1),(4,'Alpes',12),(101,'Provence',12),(7,'Ardennes',6),(8,'Ariège',15),(9,'Aube',6),(10,'Aude',15),(11,'Aveyron',15),(12,'Cotes d\'Azur',12),(13,'Calvados',13),(14,'Cantal',1),(15,'Charente',14),(16,'Charente-Maritime',14),(17,'Cher',4),(18,'Corrèze',14),(19,'Corse',5),(97,'Artois',9),(21,'Côte-d\'or',2),(22,'Côtes-d\'armor',3),(23,'Creuse',14),(24,'Dordogne - Périgord',14),(25,'Doubs - Territoire de Belfort',2),(26,'Drôme - Ardèche',1),(27,'Eure',13),(28,'Eure-et-Loir',4),(29,'Finistère',3),(30,'Gard - Lozère',15),(31,'Haute-Garonne',15),(32,'Gers',15),(33,'Gironde',14),(34,'Hérault',15),(35,'Ile-et-Vilaine',3),(36,'Indre',4),(37,'Indre-et-Loire',4),(38,'Isère',1),(39,'Jura',2),(40,'Landes',14),(41,'Loir-et-Cher',4),(42,'Loire',1),(43,'Haute-Loire',1),(44,'Loire-Atlantique',17),(45,'Loiret',4),(46,'Lot',15),(47,'Lot-et-Garonne',14),(49,'Maine-et-Loire',17),(50,'Manche',13),(51,'Marne',6),(52,'Haute-Marne',6),(53,'Mayenne',17),(54,'Meurthe-et-Moselle',6),(55,'Meuse',6),(56,'Morbihan',3),(57,'Mosellan',6),(58,'Nièvre',2),(59,'Oise',9),(60,'Orne',13),(61,'Puy-de-Dôme',1),(62,'Pyrénées-Atlantiques',14),(63,'Hautes-Pyrénées',15),(64,'Pyrénées-Orientales',15),(65,'Alsace',6),(66,'Lyon et du Rhône',1),(67,'Haute-Saône',2),(68,'Saône-et-Loire',2),(69,'Sarthe',17),(70,'Savoie',1),(71,'Haute-Savoie Pays-de-Gex',1),(73,'Seine-Maritime',13),(74,'Seine-et-Marne',16),(75,'Yvelines',16),(76,'Deux-Sèvres',14),(77,'Somme',9),(78,'Tarn',15),(79,'Tarn-et-Garonne',15),(80,'Var',12),(81,'Grand-Vaucluse',12),(82,'Vendée',17),(83,'Vienne',14),(84,'Haute-Vienne',14),(85,'Vosges',6),(86,'Yonne',2),(87,'Essonne',16),(88,'Hauts-de-Seine',16),(89,'Seine-Saint-Denis',16),(90,'Val-de-Marne',16),(91,'Val-d\'oise',16),(92,'Mayotte',11),(93,'Guadeloupe',7),(94,'Guyane',8),(95,'Martinique',10),(96,'Réunion',18),(98,'Escaut',9),(99,'Flandres',9),(100,'Cote d\'Opale',9);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-04 16:09:44
