CREATE DATABASE  IF NOT EXISTS `db_reservadeequipamentos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_reservadeequipamentos`;
-- MySQL dump 10.13  Distrib 5.7.12, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: db_reservadeequipamentos
-- ------------------------------------------------------
-- Server version	5.7.15

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
-- Table structure for table `Emprestimo`
--

DROP TABLE IF EXISTS `Emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidadeSolicitada` int(11) NOT NULL,
  `dataEmprestimo` date NOT NULL,
  `dataDevolucao` date NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A9DC384229000F31` (`funcionarioId`),
  KEY `IDX_A9DC3842F112F078` (`statusId`),
  CONSTRAINT `FK_A9DC384229000F31` FOREIGN KEY (`funcionarioId`) REFERENCES `Funcionario` (`masp`),
  CONSTRAINT `FK_A9DC3842F112F078` FOREIGN KEY (`statusId`) REFERENCES `Status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Emprestimo`
--

LOCK TABLES `Emprestimo` WRITE;
/*!40000 ALTER TABLE `Emprestimo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipamento`
--

DROP TABLE IF EXISTS `Equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Equipamento` (
  `numPatrimonio` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantidadeDisponivel` int(11) NOT NULL,
  PRIMARY KEY (`numPatrimonio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipamento`
--

LOCK TABLES `Equipamento` WRITE;
/*!40000 ALTER TABLE `Equipamento` DISABLE KEYS */;
INSERT INTO `Equipamento` VALUES (3025101,'Dell  OptiPlex-9020','Computador','Computador 8GB memória RAM, 500GB HD, Placa de Vídeo NVIDIA 1080GTX','DELL','OptiPlex-9020',1);
/*!40000 ALTER TABLE `Equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Funcionario`
--

DROP TABLE IF EXISTS `Funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Funcionario` (
  `masp` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nivelDeAcesso` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`masp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Funcionario`
--

LOCK TABLES `Funcionario` WRITE;
/*!40000 ALTER TABLE `Funcionario` DISABLE KEYS */;
INSERT INTO `Funcionario` VALUES (12345678,'Administrador do Sistema','admin@admin.com','12345678',1);
/*!40000 ALTER TABLE `Funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Status`
--

DROP TABLE IF EXISTS `Status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Status`
--

LOCK TABLES `Status` WRITE;
/*!40000 ALTER TABLE `Status` DISABLE KEYS */;
/*!40000 ALTER TABLE `Status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprestimo_equipamento`
--

DROP TABLE IF EXISTS `emprestimo_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprestimo_equipamento` (
  `emprestimo_id` int(11) NOT NULL,
  `numPatrimonio` int(11) NOT NULL,
  PRIMARY KEY (`emprestimo_id`,`numPatrimonio`),
  KEY `IDX_256B3E493EDBF5C6` (`emprestimo_id`),
  KEY `IDX_256B3E497B4EB046` (`numPatrimonio`),
  CONSTRAINT `FK_256B3E493EDBF5C6` FOREIGN KEY (`emprestimo_id`) REFERENCES `Emprestimo` (`id`),
  CONSTRAINT `FK_256B3E497B4EB046` FOREIGN KEY (`numPatrimonio`) REFERENCES `Equipamento` (`numPatrimonio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimo_equipamento`
--

LOCK TABLES `emprestimo_equipamento` WRITE;
/*!40000 ALTER TABLE `emprestimo_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `emprestimo_equipamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-07  8:25:26
