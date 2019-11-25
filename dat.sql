-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: atominge_mmeetingt
-- ------------------------------------------------------
-- Server version	5.5.24-log

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
-- Table structure for table `mm_empresa`
--

DROP TABLE IF EXISTS `mm_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_empresa` (
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `empresa_nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  `empresa_nit` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NIT',
  `empresa_web` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'WEB',
  `empresa_direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DIRECCION',
  `empresa_telefonos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'TELEFONOS',
  `empresa_ciudad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CIUDAD',
  `empresa_logo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'LOGO',
  `empresa_autentica` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_lenguaje` char(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_versionPrd` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_versionBd` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_clave` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_registrsoXpagina` int(11) DEFAULT NULL,
  `empresa_diasTrabaja` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_horarioInicio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_horarioTermina` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_intervaloCalendario` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_FormatoActa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_cresidencial` char(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'S es un conjunto residencial N no lo es',
  `empresa_ctrl` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_empresa`
--

LOCK TABLES `mm_empresa` WRITE;
/*!40000 ALTER TABLE `mm_empresa` DISABLE KEYS */;
INSERT INTO `mm_empresa` VALUES (1,'ATOM INGENIERIA SAS','12345678','http://www.atomingenieria.com','Cra 54 55-44 Ap 412','3174142133','Bogota DC','logoEmpresa0.png','M','ING','TEST-201806','TEST-201806','TEST','alvaro.oycsoft@gmail.com',10,'L-M-M-J-V','7:00','19:00','M','Estandard','S','wefB875s13846s12518refd8624A12'),(2,'Colombiana de Comercio SAS','8009545','www.colcio.com','cara 56','78255','bta','logoEmpresa.png','C','ESP','2019colPrd','2019colBd','col','com',10,'L-M-M-J-V','7:00','18:00','M','Estandard','N','wefB875s13846s12518refd8624A12'),(3,'suma ltda','45678','www.suma','454','45','cali','logoEmpresa.png','C','ESP','2019sumaPrd','2019sumaBd','suma','s',10,'L-M-M-J-V','7:00','18:00','M','Estandard','S','wefB875s13846s12518refd8624A12');
/*!40000 ALTER TABLE `mm_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_usuarios`
--

DROP TABLE IF EXISTS `mm_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `usuario_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  `usuario_empresa` int(11) DEFAULT NULL,
  `usuario_email` varchar(80) COLLATE utf8_spanish_ci NOT NULL COMMENT 'LOGIN',
  `usuario_password` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'PASSWORD',
  `usuario_tipo_acceso` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'ACCESO',
  `usuario_fechaCreado` date DEFAULT NULL,
  `usuario_fechaActualizado` date DEFAULT NULL,
  `usuario_estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_perfil` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_avatar` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_user` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_celular` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_usuarios`
--

LOCK TABLES `mm_usuarios` WRITE;
/*!40000 ALTER TABLE `mm_usuarios` DISABLE KEYS */;
INSERT INTO `mm_usuarios` VALUES (1,'admin',1,'admin@com.co','202cb962ac59075b964b07152d234b70','A','2018-12-31','2018-12-31','A','1','ava3.png','admin','3101231231'),(2,'suma',3,'s','202cb962ac59075b964b07152d234b70','A','2019-04-22','2019-04-22','A','1','avatar.png','suma','3300'),(3,'comercio',2,'adm@com.co','202cb962ac59075b964b07152d234b70','A','2019-05-05','2020-05-05','A','1','avatar.png','comercio','2200');
/*!40000 ALTER TABLE `mm_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mn_privilegios`
--

DROP TABLE IF EXISTS `mn_privilegios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mn_privilegios` (
  `privilegio_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilegio_perfil` int(11) DEFAULT NULL,
  `privilegio_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`privilegio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mn_privilegios`
--

LOCK TABLES `mn_privilegios` WRITE;
/*!40000 ALTER TABLE `mn_privilegios` DISABLE KEYS */;
/*!40000 ALTER TABLE `mn_privilegios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-02 14:05:04
