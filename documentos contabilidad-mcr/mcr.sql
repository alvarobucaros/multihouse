-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: atominge_ncr
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
-- Table structure for table `contaanticipos`
--

DROP TABLE IF EXISTS `contaanticipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaanticipos` (
  `anticipoid` int(11) NOT NULL AUTO_INCREMENT,
  `anticipoempresa` int(11) NOT NULL,
  `anticipoinmueble` int(11) DEFAULT NULL,
  `anticipofecha` date DEFAULT NULL,
  `anticipovalor` decimal(12,2) DEFAULT NULL,
  `anticiposaldo` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`anticipoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='anticipos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaanticipos`
--

LOCK TABLES `contaanticipos` WRITE;
/*!40000 ALTER TABLE `contaanticipos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contaanticipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaclasificacion`
--

DROP TABLE IF EXISTS `contaclasificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaclasificacion` (
  `clasificacionId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `clasificacionEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `clasificacionCodigo` varchar(10) DEFAULT NULL COMMENT 'CODIGO',
  `clasificacionDetalle` varchar(45) DEFAULT NULL COMMENT 'DETALLE',
  PRIMARY KEY (`clasificacionId`)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaclasificacion`
--

LOCK TABLES `contaclasificacion` WRITE;
/*!40000 ALTER TABLE `contaclasificacion` DISABLE KEYS */;
INSERT INTO `contaclasificacion` VALUES (374,6,'APTIPO1','APTIPO1'),(375,6,'APTIPO2','APTIPO2'),(376,6,'APTIPO3','APTIPO3'),(377,6,'GRAGSENC','GRAGSENC'),(378,6,'GRAGDOBLE','GRAGDOBLE'),(379,6,'BODEGA','BODEGA'),(380,6,'','');
/*!40000 ALTER TABLE `contaclasificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacomprobantes`
--

DROP TABLE IF EXISTS `contacomprobantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacomprobantes` (
  `compId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `compEmpresaId` int(11) NOT NULL COMMENT 'EMPRESA',
  `compCodigo` char(3) DEFAULT NULL COMMENT 'CODIGO',
  `compNombre` varchar(45) NOT NULL COMMENT 'NOMBRE',
  `compConsecutivo` int(11) NOT NULL COMMENT 'SECUENCIA',
  `compActivo` char(1) NOT NULL COMMENT 'ACTIVO',
  `compDetalle` varchar(100) DEFAULT NULL COMMENT 'DETALLE',
  PRIMARY KEY (`compId`),
  UNIQUE KEY `comprId_UNIQUE` (`compId`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacomprobantes`
--

LOCK TABLES `contacomprobantes` WRITE;
/*!40000 ALTER TABLE `contacomprobantes` DISABLE KEYS */;
INSERT INTO `contacomprobantes` VALUES (78,6,'01','FACTURACION (INGRESOS)',0,'A',NULL),(79,6,'02','EGRESOS',9,'A',NULL),(80,6,'07','NOMINA',4,'A',NULL),(81,6,'05','AJUSTES',0,'A','Ajustes de contabilidad'),(82,6,'04','COMPRAS Y SERVICIOS',0,'A',NULL),(83,6,'06','OTROS INGRESOS',1,'A','Ingresos diferentes a los normales del negocio'),(84,6,'03','CONSIGNACIONES BANCARIAS',0,'A',NULL),(85,6,'08','SALDOS INICIALES',1,'A','Movimiento de apertura de cuentas');
/*!40000 ALTER TABLE `contacomprobantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contadptos`
--

DROP TABLE IF EXISTS `contadptos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contadptos` (
  `DeptoCod` int(11) NOT NULL,
  `DeptoNombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`DeptoCod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contadptos`
--

LOCK TABLES `contadptos` WRITE;
/*!40000 ALTER TABLE `contadptos` DISABLE KEYS */;
INSERT INTO `contadptos` VALUES (5,'ANTIOQUIA'),(8,'ATLANTICO'),(11,'BOGOTA, D.C.'),(13,'BOLIVAR'),(15,'BOYACA'),(17,'CALDAS'),(18,'CAQUETA'),(19,'CAUCA'),(20,'CESAR'),(23,'CORDOBA'),(25,'CUNDINAMARCA'),(27,'CHOCO'),(41,'HUILA'),(44,'LA GUAJIRA'),(47,'MAGDALENA'),(50,'META'),(52,'NARINO'),(54,'NORTE DE SANTANDER'),(63,'QUINDIO'),(66,'RISARALDA'),(68,'SANTANDER'),(70,'SUCRE'),(73,'TOLIMA'),(76,'VALLE DEL CAUCA'),(81,'ARAUCA'),(85,'CASANARE'),(86,'PUTUMAYO'),(88,'ARCHIPIELAGO DE SAN ANDRES'),(91,'AMAZONAS'),(94,'GUAINIA'),(95,'GUAVIARE'),(97,'VAUPES'),(99,'VICHADA');
/*!40000 ALTER TABLE `contadptos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaempresas`
--

DROP TABLE IF EXISTS `contaempresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaempresas` (
  `empresaId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `empresaClave` char(10) NOT NULL DEFAULT '' COMMENT 'CLAVE',
  `empresaNombre` varchar(50) NOT NULL DEFAULT '' COMMENT 'NOMBRE',
  `empresaNit` char(10) NOT NULL DEFAULT '' COMMENT 'NIT',
  `empresaDigito` char(1) NOT NULL DEFAULT '0' COMMENT 'DIGITO',
  `empresaDireccion` varchar(45) NOT NULL COMMENT 'DIRECCION',
  `empresaCiudad` varchar(45) DEFAULT NULL,
  `empresaTelefonos` varchar(40) NOT NULL COMMENT 'TELEFONOS',
  `empresaFchCreacion` date NOT NULL COMMENT 'FCH CREACION',
  `empresaFchModificacion` date NOT NULL COMMENT 'FCH MODIFICA',
  `empresaFchVigencia` date NOT NULL COMMENT 'FCH VIGENCIA',
  `empresaPeriodoActual` char(6) NOT NULL COMMENT 'PERIODO',
  `empresaTwiter` varchar(45) DEFAULT NULL COMMENT 'CUENTA TWITER',
  `empresaFacebook` varchar(45) DEFAULT NULL COMMENT 'CUENTA FACEBOOK',
  `empresaWeb` varchar(45) DEFAULT NULL COMMENT 'PAGINA WEB',
  `empresaEmail` varchar(45) DEFAULT NULL COMMENT 'CUENTA CORREO',
  `empresaActiva` char(1) NOT NULL COMMENT 'ACTIVA',
  `empresaPuertoCorreo` int(11) DEFAULT NULL COMMENT 'PRTO_EMAIL',
  `empresaRepresentante` varchar(45) NOT NULL COMMENT 'REPREENTANTE LEGAL',
  `empresaIdentifRepresentante` varchar(10) NOT NULL COMMENT 'CEDULA REPREENTANTE',
  `empresaContador` varchar(45) DEFAULT NULL COMMENT 'CONTADOR',
  `empresaMatriculaContador` varchar(10) DEFAULT NULL COMMENT 'MATRICULA CONTADOR',
  `empresaIdentifContador` varchar(10) DEFAULT NULL COMMENT 'CEDULA CONTADOR',
  `empresaRevisor` varchar(45) DEFAULT NULL COMMENT 'REVISOR FISCAL',
  `empresaMatriculaRevisor` varchar(10) DEFAULT NULL COMMENT 'MATRICULA REVISOR',
  `empresaIdentifRevisor` varchar(10) DEFAULT NULL COMMENT 'CEDULA REVISOR',
  `empresaAnoFiscal` char(4) DEFAULT NULL COMMENT 'ANO FISCAL',
  `empresaEstructura` varchar(20) DEFAULT NULL COMMENT 'ESTRUCTURA',
  `empresaAdministrador` varchar(45) DEFAULT NULL COMMENT 'ADMINISTRADOR',
  `empresaAdministradorCed` varchar(10) DEFAULT NULL COMMENT 'CEDULA ADMON',
  `empresaSecretaria` varchar(45) DEFAULT NULL COMMENT 'SECRETARIA',
  `empresaSecretariaCedula` varchar(10) DEFAULT NULL COMMENT 'CEDULA SECRETARIA',
  `empresaMensaje1` varchar(400) DEFAULT NULL COMMENT 'MENSAJE 1',
  `empresaMensaje2` varchar(400) DEFAULT NULL COMMENT 'MENSAJE 2',
  `empresaPeriodoFactura` varchar(6) DEFAULT NULL COMMENT 'PERIODO FACTURA',
  `empresaPeriCierreFactura` varchar(6) DEFAULT NULL COMMENT 'PERIODO CERRADO',
  `empresaCompFra` char(2) DEFAULT NULL COMMENT 'COMPR FACTURA',
  `empresaCompRcaja` char(2) DEFAULT NULL COMMENT 'COMPR RCAJA',
  `empresaCompAjustes` char(2) DEFAULT NULL COMMENT 'COMPR AJUSTES',
  `empresaCompEgreso` char(2) DEFAULT NULL,
  `empresaCompCierreMes` char(2) DEFAULT NULL,
  `empresaCompApertura` char(2) DEFAULT NULL,
  `empresaCuentaCierre` varchar(10) DEFAULT NULL,
  `empresaCuentaCaja` varchar(10) DEFAULT NULL COMMENT 'CUENTA CAJA',
  `empresaRecargoPorc` decimal(8,2) DEFAULT NULL COMMENT 'MORA PORC',
  `empresaRecargoPesos` decimal(8,2) DEFAULT NULL COMMENT 'MORA EN PESOS',
  `empresaRecargoDias` int(11) DEFAULT NULL COMMENT 'MORA DIAS',
  `empresaDescPorc` decimal(8,2) DEFAULT NULL COMMENT 'DESCNTO PORC',
  `empresaDescPesos` decimal(8,2) DEFAULT NULL COMMENT 'DESCNTO PESOS',
  `empresaDescDias` int(11) DEFAULT NULL COMMENT 'DESCNTO DIAS',
  `empresaPagosParciales` char(1) DEFAULT NULL COMMENT 'PAGOS PARCIALES',
  `empresaPeriodosAnuales` int(11) DEFAULT NULL COMMENT 'PERIODOS ANUALES',
  `empresaFactorRedondeo` char(1) DEFAULT NULL COMMENT 'REDONDEO',
  `empresaConsecRcaja` int(11) DEFAULT NULL COMMENT 'CONSEC RCAJA',
  `empresaConsecFactura` int(11) DEFAULT NULL COMMENT 'CONSEC FACTURA',
  `empresaIdioma` char(2) DEFAULT NULL,
  `empresaNroInmuebles` int(11) DEFAULT NULL,
  `empresaLogo` varchar(45) DEFAULT NULL,
  `empresaccosto` char(1) DEFAULT NULL,
  `empresaservicios` char(1) DEFAULT NULL,
  `empresafacturaNota` varchar(1000) DEFAULT NULL,
  `empresafacturaresDIAN` varchar(200) DEFAULT NULL,
  `empresafacturaNumeracion` varchar(200) DEFAULT NULL,
  `empresafacturanotaiva` varchar(200) DEFAULT NULL,
  `empresafacturanotaica` varchar(200) DEFAULT NULL,
  `empresafacturactacxc` varchar(20) DEFAULT NULL,
  `empresafacturactaivta` varchar(20) DEFAULT NULL,
  `empresafacturactaica` varchar(20) DEFAULT NULL,
  `empresafacturactaiva` varchar(20) DEFAULT NULL,
  `empresaRegimen` char(1) DEFAULT NULL,
  `empresaporcentajeiva` decimal(6,2) DEFAULT NULL,
  `empresaAutentica` char(1) DEFAULT NULL,
  `empresaVersionPrd` varchar(45) DEFAULT NULL,
  `empresaVersionBd` varchar(45) DEFAULT NULL,
  `empresaRegistrosXpagina` int(11) DEFAULT NULL,
  PRIMARY KEY (`empresaId`),
  UNIQUE KEY `empresaId_UNIQUE` (`empresaId`)
) ENGINE=MyISAM AUTO_INCREMENT=4082 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaempresas`
--

LOCK TABLES `contaempresas` WRITE;
/*!40000 ALTER TABLE `contaempresas` DISABLE KEYS */;
INSERT INTO `contaempresas` VALUES (1,'MPK','MAURICIO PARDO ferere','899999022','1','CRA 57','Chia','2210953','2013-03-19','2012-10-11','2012-10-18','201301','@min','@minas','www.minminas.gov.co','aortiz@minminas.gov.co','A',25,'Alvaro','123','Viky Solano','123','0987645','Juan Valdez','345','567','2013','X-X-XX-XX-XX-XXXXX','Jorge Ortiz','986','la secre','432','El no pago oportuno genera intereses de mora. \r\nGire su cheque a favor de \"Conjunto residencial para pruebas\"\r\nLos cheques no pagados por el banco tendran intereses del 20% - Art 731 CC.                                                 ','Sin mensaje                                                                                     ','201303','201302','06','0','0','','','','','110505',2.00,0.00,30,0.00,0.00,5,'S',12,'Q',0,0,'ES',45,'logoEmpresa0.png','S','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No.777','nota iva','','','','','','C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(2,'AMO','ANGELA MARIA ORTIZ','899999022','1','CRA 57','Chia','2210953','2013-03-19','2012-10-11','2012-10-18','201301','@min','@minas','www.minminas.gov.co','aortiz@minminas.gov.co','A',25,'Alvaro','123','Viky Solano','123','0987645','Juan Valdez','345','567','2013','X-X-XX-XX-XX-XXXXX','Jorge Ortiz','986','la secre','432','El no pago oportuno genera intereses de mora. \r\nGire su cheque a favor de \"Conjunto residencial para pruebas\"\r\nLos cheques no pagados por el banco tendran intereses del 20% - Art 731 CC.                                                 ','Sin mensaje                                                                                     ','201301','201212','06','0','0',NULL,NULL,NULL,NULL,'110505',2.00,0.00,30,0.00,0.00,5,'S',12,'Q',0,0,'ES',20,'logoEmpresa0.png','N','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000',NULL,NULL,NULL,NULL,NULL,NULL,'C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(3,'MPK SAS','MPK SAS','899999022','1','CRA 57','Chia','2210953','2013-03-19','2012-10-11','2012-10-18','201301','@min','@minas','www.minminas.gov.co','aortiz@minminas.gov.co','A',25,'Alvaro','123','Viky Solano','123','0987645','Juan Valdez','345','567','2013','X-X-XX-XX-XX-XXXXX','Jorge Ortiz','986','la secre','432','El no pago oportuno genera intereses de mora. \r\nGire su cheque a favor de \"Conjunto residencial para pruebas\"\r\nLos cheques no pagados por el banco tendran intereses del 20% - Art 731 CC.                                                 ','Sin mensaje                                                                                     ','201301','201212','06','0','0',NULL,NULL,NULL,NULL,'110505',2.00,0.00,30,0.00,0.00,5,'S',12,'Q',0,0,'ES',20,'logoEmpresa0.png','N','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000',NULL,NULL,NULL,NULL,NULL,NULL,'C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(4,'TERRACOT S','TERRACOT SAS',' 900532394','4','','BogotÃ¡ D.C.','','2015-10-01','2015-10-01','2017-12-31','201512','','','','','A',25,'','','','','','','','','','X-X-XX-XX-XX-XXXXX','','','','','','','','','','','',NULL,NULL,NULL,NULL,'',0.00,0.00,30,0.00,0.00,0,'S',12,'0',0,0,'ES',0,'logoEmpresa4.png','N','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000',NULL,NULL,NULL,NULL,NULL,NULL,'C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(5,'OKRE SAS','OKRE SAS','900796151','4','CLL 92 19-36','BOGOTA','314 445 5461','2015-10-01','2015-10-01','2015-12-31','201613','','','','','A',25,'MAURICIO PARDO KOPPEL','','CONRADO BETANCURT','833 T ','17094257','','','','2016','X-X-XX-XX-XX-XXXXX','','','','','No practicar retención en la fuente de acuerdo con la Ley 1429/2010 Art 4, par 2.','','','','01','01',NULL,'02','09','08','360505','110505',0.00,0.00,30,0.00,0.00,0,'S',12,'0',0,0,'ES',0,'logoEmpresa5.png','N','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Habilitaciónde facturación formulario No.18762005977184 de Dic.5 de 2.017,hasta Dicbre. 04 de 2.019','Numeración autorizada desde el No. 0031 hasta el No. 1000','','','130505','415505','','240805','C',19.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(6,'PRUEBAS','EMPRESA PARA LAS PRUEBAS - SAS','13808659','1','CRA 54 # 55-44','Bogota','3174142133','2015-10-01','2015-01-01','2020-12-31','201801','','','atomingenieria.com/lb','','A',0,'Carlos Javier Romero','65444444','ANITA GARCIA','T 6782','51825654','','','','2015','X-X-XX-XX-XX-XXXXX','JUAN FELIPE CARDENAS','74859600','DORA VILLALBA','102568741','El pago oportuno de esta factura evita intereses moratoios','Cuidemos el medio ambiente, apoye nuestra campaña de reciclage.','201801','201712','01','01','01','02','05','08','360505','01',2.00,0.00,12,1.00,0.00,10,'S',12,'C',0,482,'ES',36,'losBrevos.png','S','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000','','','25','','25','25','C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20),(7,'CONJUTEST','CONJUNTO RESIDENCIAL EL DORADO (PARA  PRUEBAS)','13808655','4','CLL 92 19-36','BOGOTA','314 445 5461','2015-10-01','2015-10-01','2018-12-31','201601','','','','','A',25,'ALVARO ORTIZ','112233','JUANITA VELOZA','123T5','45670098','','','','2016','X-X-XX-XX-XX-XXXXX','CRYSTINA LESTER','7666','ANNY BERTMAN','9877','No practicar retención en la fuente de acuerdo con la Ley 1429/2010 Art 4, par 2.','','201512','201601','01','06',NULL,'02','09','08','360505','110505',2.00,0.00,30,5.00,0.00,12,'S',12,'0',0,0,'ES',42,'logoEmpresa7.png','N','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000','','','130505','415505','','240805','C',19.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20);
/*!40000 ALTER TABLE `contaempresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contafactdef`
--

DROP TABLE IF EXISTS `contafactdef`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contafactdef` (
  `factdefid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `factdefempresa` int(11) NOT NULL,
  `factdefnro` int(11) NOT NULL,
  `factdefcliente` int(11) NOT NULL,
  `factdeffechcrea` date DEFAULT NULL,
  `factdeffechvence` date DEFAULT NULL,
  `factdefvalor` decimal(12,2) DEFAULT NULL,
  `factdefiva` decimal(12,2) DEFAULT NULL,
  `factdefsaldo` decimal(12,2) DEFAULT NULL,
  `factdefneto` decimal(12,2) DEFAULT NULL,
  `factdefcontabiliza` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`factdefid`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contafactdef`
--

LOCK TABLES `contafactdef` WRITE;
/*!40000 ALTER TABLE `contafactdef` DISABLE KEYS */;
INSERT INTO `contafactdef` VALUES (1,6,1,237,'2016-04-14','2016-04-14',562000.00,89920.00,651920.00,651920.00,0.00),(2,4,1,459,'2016-04-14','2016-04-14',3000000.00,480000.00,3480000.00,3480000.00,0.00),(6,5,3,922,'2016-04-01','2016-04-15',4875000.00,780000.00,5655000.00,5655000.00,0.00),(4,5,1,922,'2016-03-01','2016-03-01',3250000.00,520000.00,3770000.00,3770000.00,0.00),(5,5,2,922,'2016-03-01','2016-03-01',580600.00,0.00,580600.00,580600.00,0.00),(7,5,4,922,'2016-05-15','2016-05-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(8,5,5,922,'2016-06-15','2016-06-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(9,5,6,922,'2016-07-15','2016-07-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(10,5,6,922,'2016-07-15','2016-07-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(11,5,6,922,'2016-07-15','2016-07-15',3250000.00,520.00,3770000.00,3770000.00,0.00),(25,6,3,239,'2016-11-16','2016-11-16',8500.00,1360.00,9860.00,9860.00,0.00),(13,5,7,922,'2016-08-15','2016-08-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(14,5,8,922,'2016-09-15','2016-09-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(15,5,9,922,'2016-10-15','2016-10-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(16,5,10,922,'2016-11-15','2016-11-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(17,5,11,922,'2016-12-15','2016-12-15',3250000.00,520000.00,3770000.00,3770000.00,0.00),(18,6,2,346,'2016-10-20','2016-10-20',0.00,0.00,450000.00,450000.00,0.00),(19,6,2,346,'2016-10-20','2016-10-20',400000.00,64000.00,464000.00,464000.00,0.00),(29,5,16,922,'2017-01-12','2017-01-12',3250000.00,617500.00,3867500.00,3867500.00,0.00),(28,5,15,884,'2016-11-18','2016-11-22',3500000.00,560000.00,4060000.00,4060000.00,0.00),(27,5,14,884,'2016-11-18','2016-11-22',3500000.00,560000.00,4060000.00,4060000.00,0.00),(26,5,13,884,'2016-11-22','2016-11-22',8176000.00,1308160.00,9484160.00,9484160.00,0.00),(24,5,12,884,'2016-11-15','2016-11-15',4088000.00,654080.00,4742080.00,4742080.00,0.00),(30,5,17,922,'2017-02-06','2017-02-06',3250000.00,617500.00,3867500.00,3867500.00,0.00),(31,5,18,922,'2017-02-06','2017-02-06',3250000.00,617500.00,3867500.00,3867500.00,0.00),(32,5,19,922,'2017-03-15','2017-03-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(33,5,20,922,'2017-05-15','2017-05-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(34,5,21,922,'2017-06-15','2017-06-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(35,5,22,922,'2017-07-15','2017-07-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(36,5,23,922,'2017-08-15','2017-08-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(37,5,24,922,'2017-09-15','2017-09-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(38,5,25,922,'2017-10-16','2017-10-16',3599375.00,683881.00,4283256.00,4283256.00,0.00),(39,5,26,922,'2017-11-15','2017-11-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(40,5,27,922,'2017-12-15','2017-12-15',3599375.00,683881.00,4283256.00,4283256.00,0.00),(41,5,28,884,'2017-09-23','2017-12-05',0.00,0.00,0.00,0.00,0.00),(42,5,31,884,'2017-09-23','2017-12-05',38500000.00,7315000.00,45815000.00,45815000.00,0.00),(43,5,32,922,'2018-01-05','2018-01-15',3599375.00,683881.25,4283256.25,4283256.25,0.00),(44,5,33,922,'2018-02-05','2018-02-15',3599375.00,683881.25,4283256.25,4283256.25,0.00),(45,5,34,922,'2018-03-02','2018-03-15',3926558.00,746046.00,4672604.00,4672604.00,0.00),(46,5,35,922,'2018-04-02','2018-04-16',3926558.00,746046.00,4672604.00,4672604.00,0.00),(47,5,36,922,'2018-05-02','2018-05-08',3926558.00,746046.00,4672604.00,4672604.00,0.00),(48,5,37,922,'2018-06-01','2018-06-07',3926558.00,746046.00,4672604.00,4672604.00,0.00),(49,5,38,922,'2018-07-03','2018-07-06',3926558.00,746046.00,4672604.00,4672604.00,0.00),(50,5,39,922,'2018-08-01','2018-08-06',3926558.00,746046.00,4672604.00,4672604.00,0.00),(51,5,40,922,'2018-09-07','2018-09-07',3926558.00,746046.00,4672604.00,4672604.00,0.00),(52,5,41,922,'2018-10-01','2018-10-05',3926558.00,746046.00,4672604.00,4672604.00,0.00),(53,5,42,922,'2018-11-01','2018-11-06',3926558.00,746046.00,4672604.00,4672604.00,0.00),(54,5,43,922,'2018-12-01','2018-12-06',3926558.00,746046.00,4672604.00,4672604.00,0.00),(55,5,44,922,'2019-01-01','2019-01-04',3926558.00,746046.00,4672604.00,4672604.00,0.00),(56,5,45,922,'2019-02-01','2019-02-06',3926558.00,746046.00,4672604.00,4672604.00,0.00),(57,5,46,922,'2019-03-01','2019-03-06',4247749.00,807072.00,5054821.00,5054821.00,0.00),(58,5,47,922,'2019-04-01','2019-04-06',4247749.00,807072.00,5054821.00,5054821.00,0.00),(59,5,48,922,'2019-05-02','2019-05-07',4247749.00,807072.00,5054821.00,5054821.00,0.00),(60,5,49,922,'2019-06-03','2019-06-07',4247749.00,807072.00,5054821.00,5054821.00,0.00);
/*!40000 ALTER TABLE `contafactdef` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contafactserviciomvt`
--

DROP TABLE IF EXISTS `contafactserviciomvt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contafactserviciomvt` (
  `factmvtid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `factmvtfacdef` int(11) NOT NULL,
  `factmvtdetalle` varchar(500) DEFAULT NULL,
  `factmvtvalor` decimal(12,2) DEFAULT NULL,
  `factmvtivaporc` decimal(12,2) DEFAULT NULL,
  `factmvtivavalor` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`factmvtid`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contafactserviciomvt`
--

LOCK TABLES `contafactserviciomvt` WRITE;
/*!40000 ALTER TABLE `contafactserviciomvt` DISABLE KEYS */;
INSERT INTO `contafactserviciomvt` VALUES (1,1,'feria de navidad: venta de adornos y servicios',562000.00,16.00,89920.00),(2,2,'arriendo oficina mes de maezo de 2.016',3000000.00,16.00,480000.00),(3,3,'ARRIENDO DEL MES DE MARZO DE 2016,  POR $ 3.250.000 MAS IVA Y CUOTA DE ADMINISTRACION DE $580,600',3830600.00,16.00,520000.00),(4,4,'Arriendo Oficina del 01 al 31 de de marzo de 2.016',3250000.00,16.00,520000.00),(5,5,'Administracion del mes de marzo de 2.016',580600.00,0.00,0.00),(6,6,'Arriendo oficina de abril 01 a mayo 15 de 2.016',4875000.00,16.00,780000.00),(7,7,'Arriendo oficina de mayo 16 a junio 15 de  2.016',3250000.00,16.00,520000.00),(8,8,'Arriendo oficina de junio 16 a julio 15 de 2.016',3250000.00,16.00,520000.00),(9,9,'Arriendo oficina de julio 16 a agosto 15 de 2.016 ',3250000.00,16.00,520000.00),(10,10,'Arriendo oficina de julio 16 a agosto 15 de 2.016 ',3250000.00,16.00,520000.00),(11,11,'Arriendo oficina de julio 16 a agosto 15 de 2.016 ',3250000.00,16.00,520.00),(25,25,'espaÃ±ol y japonÃ©s',8500.00,16.00,1360.00),(13,13,'Arriendo oficina de agosto 16 a septiembre 15 de 2.016',3250000.00,16.00,520000.00),(14,14,'Arriendo oficina de septiembre 16 a octubre 15  de 2.016',3250000.00,16.00,520000.00),(15,15,'Arriendo oficina de octubre 16 a noviembre 15  de 2.016',3250000.00,16.00,520000.00),(16,16,'Arriendo oficina de noviembre 16 a diciembre 15  de 2.016',3250000.00,16.00,520000.00),(17,17,'Arriendo oficina de diciembre 16 a enero 15  de 2.017',3250000.00,16.00,520000.00),(18,18,'Un ejemplo',0.00,16.00,0.00),(19,19,'Un ejemplo',400000.00,16.00,64000.00),(30,30,'Arriendo oficina de febrero 16 a marzo 15  de 2.017\n\n',3250000.00,19.00,617500.00),(26,26,'DirecciÃ³n DiseÃ±o CafeterÃ­a Acatraz y zonas aledaÃ±as',8176000.00,16.00,1308160.00),(27,27,'Segundo abono contrato de consultorÃ­a para el Plan Maestro, mes de Noviembre',3500000.00,16.00,560000.00),(28,28,'Segundo abono contrato de consultorÃ­a para el Plan Maestro, mes de Noviembre',3500000.00,16.00,560000.00),(29,29,'Arriendo oficina de enero 16 a febrero 15  de 2.017\n\n',3250000.00,19.00,617500.00),(24,24,'DIRECCION DEL DISEÃ‘O DE  LA REMODELACION DE LA CAFETERIA ALCATRAZ Y ZONAS ALEDAÃ‘AS PRIMER ABONO 50%',4088000.00,16.00,654080.00),(31,31,'Arriendo oficina de febrero 16 a marzo 15  de 2.017\n\n',3250000.00,19.00,617500.00),(32,32,'Arriendo Oficina del 16 de marzo a abril 15 de 2.017\nIncluye ajuste del IPC 5.75% mas 5 puntos\n',3599375.00,19.00,683881.00),(33,33,'Arriendo Local mes de Mayo de 2.017\n',3599375.00,19.00,683881.00),(34,34,'Arriendo Local mes de Junio de 2.017\n',3599375.00,19.00,683881.00),(35,35,'Arriendo Local mes de Julio de 2.017\n',3599375.00,19.00,683881.00),(36,36,'Arriendo Local mes de Agosto de 2.017\n',3599375.00,19.00,683881.00),(37,37,'Arriendo Local mes de Septiembre de 2.017\n',3599375.00,19.00,683881.00),(38,38,'Arriendo Local mes de Octubre  de 2.017\n',3599375.00,19.00,683881.00),(39,39,'Arriendo Local mes de Noviembre  de 2.017\n',3599375.00,19.00,683881.00),(40,40,'Arriendo Local mes de Diciembre  de 2.017\n',3599375.00,19.00,683881.00),(41,41,'Saldo del Contrato de ConsultorÃ­a para ActualizaciÃ³n Plan Maestro\n\nF A  C T U R A    A N U L A D A',0.00,19.00,0.00),(42,42,'Saldo del Contrato de ConsultorÃ­a para ActualizaciÃ³n Plan Maestro',38500000.00,19.00,7315000.00),(43,43,'Arriendo mes de enero de 2.018',3599375.00,19.00,683881.25),(44,44,'Arriendo local febrero de 2.018',3599375.00,19.00,683881.25),(45,45,'Arriendo del Local Marzo de 2.018\nNota: De acuerdo con el Contrato, a partir del 01 de marzo del año 2.018 \n         el canon de arrendamiento se ajusta en 4.09% (IPC 2.017) más 5%  ',3926558.00,19.00,746046.00),(46,46,'Arriendo  Local mes de Abril de 2.018',3926558.00,19.00,746046.00),(47,47,'Arriendo local mes de Mayo de 2.018',3926558.00,19.00,746046.00),(48,48,'Arriendo local mes de Junio de 2.018',3926558.00,19.00,746046.00),(49,49,'Arriendo local mes de Julio de 2.018',3926558.00,19.00,746046.00),(50,50,'Arriendo local mes de Agosto de 2.018',3926558.00,19.00,746046.00),(51,51,'Arriendo local mes de Septiembre de 2.018',3926558.00,19.00,746046.00),(52,52,'Arriendo local mes de Octubre de 2.018',3926558.00,19.00,746046.00),(53,53,'Arriendo local mes de Noviembre de 2.018',3926558.00,19.00,746046.00),(54,54,'Arriendo local mes de Diciembre de 2.018',3926558.00,19.00,746046.00),(55,55,'Arriendo local mes de enero de 2.019',3926558.00,19.00,746046.00),(56,56,'Arriendo local mes de febrero de 2.019',3926558.00,19.00,746046.00),(57,57,'Arriendo local mes de marzo de 2.019',4247749.00,19.00,807072.00),(59,59,'Arriendo local mes de Mayo de 2.019',4247749.00,19.00,807072.00),(58,58,'Arriendo local mes de Abril de 2.019',4247749.00,19.00,807072.00),(60,60,'Arriendo local mes de junio de 2.019',4247749.00,19.00,807072.00);
/*!40000 ALTER TABLE `contafactserviciomvt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contafactura`
--

DROP TABLE IF EXISTS `contafactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contafactura` (
  `facturaid` int(11) NOT NULL AUTO_INCREMENT,
  `facturaEmpresaid` int(11) DEFAULT NULL,
  `facturaNumero` varchar(12) DEFAULT NULL,
  `facturaInmuebleid` int(11) DEFAULT NULL,
  `facturaservicioid` int(11) DEFAULT NULL,
  `facturaperiodo` varchar(6) DEFAULT NULL,
  `facturasecuencia` int(11) DEFAULT NULL,
  `facturavalor` decimal(12,2) DEFAULT NULL,
  `facturadetalle` varchar(100) DEFAULT NULL,
  `facturafechafac` date DEFAULT NULL,
  `facturafechavence` date DEFAULT NULL,
  `facturafechacontrol` date DEFAULT NULL,
  `facturasaldo` decimal(12,2) DEFAULT NULL,
  `facturaprioridad` int(11) DEFAULT NULL,
  `facturadescuento` decimal(12,2) DEFAULT NULL,
  `facturaMora` decimal(12,2) DEFAULT NULL,
  `facturaNroReciboPago` varchar(12) DEFAULT NULL,
  `facturaTipo` char(1) DEFAULT NULL,
  `facturaPropietario` int(11) DEFAULT NULL,
  `facturaDiasMora` int(11) DEFAULT NULL,
  PRIMARY KEY (`facturaid`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contafactura`
--

LOCK TABLES `contafactura` WRITE;
/*!40000 ALTER TABLE `contafactura` DISABLE KEYS */;
INSERT INTO `contafactura` VALUES (88,6,'1',5049,6,'201710',1,110000.00,'Administración Apartamento','2017-10-01','2017-10-30','2017-10-30',110000.00,1,0.00,0.00,'0','F',113,0),(89,6,'2',5049,6,'201711',1,110000.00,'Administración Apartamento','2017-11-01','2017-11-30','2017-11-30',110000.00,1,0.00,0.00,'0','F',113,0),(90,6,'5',5053,7,'201711',1,110000.00,'Administración Apartamento','2017-11-01','2017-11-30','2017-11-30',110000.00,1,0.00,0.00,'0','F',117,0),(91,6,'3',5049,6,'201712',1,110000.00,'Administración Apartamento','2017-12-01','2017-12-30','2017-12-30',110000.00,1,0.00,0.00,'0','F',113,0),(92,6,'4',5049,6,'201709',1,110000.00,'Administración Apartamento','2017-09-01','2017-09-30','2017-09-30',110000.00,1,0.00,0.00,'0','F',113,0),(93,6,'6',5053,7,'201712',1,110000.00,'Administración Apartamento','2017-12-01','2017-12-30','2017-12-30',110000.00,1,0.00,0.00,'0','F',117,0),(94,6,'9',5057,7,'201712',1,5200.00,'Administración Apartamento','2017-12-01','2017-12-30','2017-12-30',5200.00,1,0.00,0.00,'0','F',121,0),(95,6,'10',5060,8,'201712',1,117000.00,'Administración Apartamento','2017-12-01','2017-12-30','2017-12-30',117000.00,1,0.00,0.00,'0','F',124,0),(96,6,'1',5061,10,'201710',1,15000.00,'Administración Garage','2017-10-01','2017-10-30','2017-10-30',15000.00,1,0.00,0.00,'0','F',113,0),(97,6,'2',5061,10,'201711',1,15000.00,'Administración Garage','2017-11-01','2017-11-30','2017-11-30',15000.00,1,0.00,0.00,'0','F',113,0),(98,6,'3',5061,10,'201712',1,15000.00,'Administración Garage','2017-12-01','2017-12-30','2017-12-30',15000.00,1,0.00,0.00,'0','F',113,0),(99,6,'4',5061,10,'201709',1,15000.00,'Administración Garage','2017-09-01','2017-09-30','2017-09-30',15000.00,1,0.00,0.00,'0','F',113,0),(100,6,'1',5073,11,'201710',1,8500.00,'Administracion Bodega','2017-10-01','2017-10-30','2017-10-30',8500.00,1,0.00,0.00,'0','F',113,0),(101,6,'2',5073,11,'201711',1,8500.00,'Administracion Bodega','2017-11-01','2017-11-30','2017-11-30',8500.00,1,0.00,0.00,'0','F',113,0),(102,6,'3',5073,11,'201712',1,8500.00,'Administracion Bodega','2017-12-01','2017-12-30','2017-12-30',8500.00,1,0.00,0.00,'0','F',113,0),(103,6,'4',5073,11,'201709',1,8500.00,'Administracion Bodega','2017-09-01','2017-09-30','2017-09-30',8500.00,1,0.00,0.00,'0','F',113,0),(104,6,'5',5064,10,'201711',1,15000.00,'Administración Garage','2017-11-01','2017-11-30','2017-11-30',15000.00,1,0.00,0.00,'0','F',117,0),(105,6,'6',5064,10,'201712',1,15000.00,'Administración Garage','2017-12-01','2017-12-30','2017-12-30',15000.00,1,0.00,0.00,'0','F',117,0),(106,6,'9',5069,10,'201711',1,15000.00,'Administración Garage','2017-11-01','2017-11-30','2017-11-30',15000.00,1,0.00,0.00,'0','F',121,0),(107,6,'10',5072,24,'201712',1,25000.00,'Administración Garage','2017-12-01','2017-12-30','2017-12-30',25000.00,1,0.00,0.00,'0','F',124,0),(108,6,'10',5078,11,'201712',1,8500.00,'Administracion Bodega','2017-12-01','2017-12-30','2017-12-30',8500.00,1,0.00,0.00,'0','F',124,0);
/*!40000 ALTER TABLE `contafactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containmueblepropietario`
--

DROP TABLE IF EXISTS `containmueblepropietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containmueblepropietario` (
  `contaInmuPropietarioId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `contaInmuPropietarioEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `contaInmuPropietarioInmuebleId` int(11) DEFAULT NULL COMMENT 'INMUEBLE',
  `contaInmuPropietarioPropietarioId` int(11) DEFAULT NULL COMMENT 'PROPIETARIO',
  PRIMARY KEY (`contaInmuPropietarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containmueblepropietario`
--

LOCK TABLES `containmueblepropietario` WRITE;
/*!40000 ALTER TABLE `containmueblepropietario` DISABLE KEYS */;
INSERT INTO `containmueblepropietario` VALUES (363,6,5049,113),(364,6,5050,114),(365,6,5051,115),(366,6,5052,116),(367,6,5053,117),(368,6,5054,118),(369,6,5055,119),(370,6,5056,120),(371,6,5057,121),(372,6,5058,122),(373,6,5059,123),(374,6,5060,124),(375,6,5061,113),(376,6,5062,114),(377,6,5063,116),(378,6,5064,117),(379,6,5065,115),(380,6,5066,118),(381,6,5067,119),(382,6,5068,120),(383,6,5069,121),(384,6,5070,122),(385,6,5071,123),(386,6,5072,124),(387,6,5073,113),(388,6,5074,116),(389,6,5075,115),(390,6,5076,119),(391,6,5077,122),(392,6,5078,124),(393,6,5079,125);
/*!40000 ALTER TABLE `containmueblepropietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containmuebles`
--

DROP TABLE IF EXISTS `containmuebles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containmuebles` (
  `inmuebleId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `inmuebleEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `inmuebleCodigo` varchar(10) NOT NULL COMMENT 'CODIGO',
  `inmuebleDescripcion` varchar(45) NOT NULL COMMENT 'DESCRIPCION',
  `inmueblePrincipal` varchar(10) DEFAULT NULL COMMENT 'PRINCIPAL',
  `inmuebleArea` decimal(8,2) DEFAULT NULL COMMENT 'AREA',
  `inmuebleCoeficiente` decimal(10,6) DEFAULT NULL COMMENT 'COEFICIENTE',
  `inmuebleUbicacion` varchar(45) DEFAULT NULL COMMENT 'UBICACION',
  `inmuebleClasificacionId` int(11) DEFAULT NULL COMMENT 'CLASIFICACION',
  `inmuebleDepende` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`inmuebleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5080 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containmuebles`
--

LOCK TABLES `containmuebles` WRITE;
/*!40000 ALTER TABLE `containmuebles` DISABLE KEYS */;
INSERT INTO `containmuebles` VALUES (5049,6,'AP101','APARTAMENTO 1-101','SI',55.20,0.045590,'PISO 1',374,''),(5050,6,'AP102','APARTAMENTO 1-102','SI',55.20,0.045590,'PISO 1',374,''),(5051,6,'AP203','APARTAMENTO 1-105','SI',75.55,0.062397,'PISO 2',375,''),(5052,6,'AP201','APARTAMENTO 1-103','SI',75.55,0.062397,'PISO 2',375,''),(5053,6,'AP202','APARTAMENTO 1-104','SI',75.55,0.062397,'PISO 2',375,''),(5054,6,'AP204','APARTAMENTO 1-106','SI',75.55,0.062397,'PISO 2',375,''),(5055,6,'AP301','APARTAMENTO 1-201','SI',75.55,0.062397,'PISO 3',375,''),(5056,6,'AP302','APARTAMENTO 1-202','SI',75.55,0.062397,'PISO 3',375,''),(5057,6,'AP303','APARTAMENTO 1-203','SI',75.55,0.062397,'PISO 3',375,''),(5058,6,'AP304','APARTAMENTO 1-204','SI',75.55,0.062397,'PISO 3',375,''),(5059,6,'AP401','APARTAMENTO 1-205','SI',110.00,0.090849,'PISO 4',376,''),(5060,6,'AP402','APARTAMENTO 1-206','SI',110.00,0.090849,'PISO 4',376,''),(5061,6,'G-01','GARAGE 1-01','NO',18.00,0.014866,'SOTANO 1',377,'AP101'),(5062,6,'G-02','GARAGE 1-02','NO',18.00,0.014866,'SOTANO 1',377,'AP102'),(5063,6,'G-03','GARAGE 1-03','NO',18.00,0.014866,'SOTANO 1',377,'AP201'),(5064,6,'G-04','GARAGE 1-04','NO',18.00,0.014866,'SOTANO 1',377,'AP202'),(5065,6,'G-05','GARAGE 1-05','NO',18.00,0.014866,'SOTANO 1',377,'AP203'),(5066,6,'G-06','GARAGE 1-06','NO',24.00,0.019822,'SOTANO 1',378,'AP204'),(5067,6,'G-07','GARAGE 1-07','NO',24.00,0.019822,'SOTANO 1',378,'AP301'),(5068,6,'G-08','GARAGE 1-08','NO',24.00,0.019822,'SOTANO 1',378,'AP302'),(5069,6,'G-09','GARAGE 1-09','NO',24.00,0.019822,'SOTANO 1',378,'AP303'),(5070,6,'G-10','GARAGE 1-10','NO',24.00,0.019822,'SOTANO 1',378,'AP304'),(5071,6,'G-11','GARAGE 1-11','NO',24.00,0.019822,'SOTANO 1',378,'AP401'),(5072,6,'G-12','GARAGE 1-12','NO',24.00,0.019822,'SOTANO 1',378,'AP402'),(5073,6,'BOD1','GARAGE 1-13','NO',3.00,0.002478,'SOTANO 1',379,'AP101'),(5074,6,'BOD2','GARAGE 1-14','NO',3.00,0.002478,'SOTANO 1',379,'AP201'),(5075,6,'BOD3','GARAGE 1-15','NO',3.00,0.002478,'SOTANO 1',379,'AP203'),(5076,6,'BOD4','GARAGE 1-16','NO',3.00,0.002478,'SOTANO 1',379,'AP301'),(5077,6,'BOD5','GARAGE 1-17','NO',3.00,0.002478,'SOTANO 1',379,'AP304'),(5078,6,'BOD6','GARAGE 1-18','NO',3.00,0.002478,'SOTANO 1',379,'AP402'),(5079,6,'','','',0.00,0.000000,'',380,'');
/*!40000 ALTER TABLE `containmuebles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containmuebleservicios`
--

DROP TABLE IF EXISTS `containmuebleservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `containmuebleservicios` (
  `InmuebleServicioId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `InmuebleServicioEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `InmuebleServicioInmuebleId` int(11) DEFAULT NULL COMMENT 'INMUEBLE',
  `InmuebleServicioServicioId` int(11) DEFAULT NULL COMMENT 'SERVICIO',
  `InmuebleServicioMonto` decimal(12,2) DEFAULT NULL COMMENT 'MONTO',
  `InmuebleServicioCuota` decimal(12,2) DEFAULT NULL COMMENT 'VALOR CUOTA',
  `InmuebleServicioSaldo` decimal(12,2) DEFAULT NULL COMMENT 'SALDO',
  `InmuebleServicioFechaInicio` date DEFAULT NULL COMMENT 'FECHA INICIO',
  `InmuebleServicioActivo` char(1) DEFAULT NULL COMMENT 'ACTIVO',
  PRIMARY KEY (`InmuebleServicioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containmuebleservicios`
--

LOCK TABLES `containmuebleservicios` WRITE;
/*!40000 ALTER TABLE `containmuebleservicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `containmuebleservicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contamovicabeza`
--

DROP TABLE IF EXISTS `contamovicabeza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contamovicabeza` (
  `movicaId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `movicaEmpresaId` int(11) NOT NULL COMMENT 'EMPRESA',
  `movicaComprId` char(3) NOT NULL COMMENT 'COMPROBANTE',
  `movicaCompNro` int(11) DEFAULT NULL COMMENT 'NUMERO',
  `movicaTerceroId` int(11) NOT NULL COMMENT 'TERCERO',
  `movicaDetalle` varchar(128) NOT NULL COMMENT 'DETALLE',
  `movicaProcesado` char(1) NOT NULL COMMENT 'PROCESADO',
  `movicaFecha` date NOT NULL COMMENT 'FECHA',
  `movicaPeriodo` char(6) NOT NULL COMMENT 'PERIODO',
  `movicaDocumPpal` varchar(20) DEFAULT NULL,
  `movicaDocumSec` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`movicaId`),
  UNIQUE KEY `moviId_UNIQUE` (`movicaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contamovicabeza`
--

LOCK TABLES `contamovicabeza` WRITE;
/*!40000 ALTER TABLE `contamovicabeza` DISABLE KEYS */;
/*!40000 ALTER TABLE `contamovicabeza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contamovidetalle`
--

DROP TABLE IF EXISTS `contamovidetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contamovidetalle` (
  `moviConId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `moviConCabezaId` int(11) NOT NULL COMMENT 'CABEZA',
  `moviConDetalle` varchar(128) NOT NULL COMMENT 'DETALLE',
  `moviConCuenta` varchar(20) DEFAULT NULL COMMENT 'CUENTA',
  `moviConDebito` decimal(12,2) NOT NULL COMMENT 'VALOR DEBITO',
  `moviConCredito` decimal(12,2) NOT NULL COMMENT 'VALOR CREDITO',
  `moviConBase` decimal(12,2) NOT NULL COMMENT 'BASE',
  `moviConImpTipo` char(1) DEFAULT NULL COMMENT 'TIPO IMPUESTO',
  `moviConImpPorc` decimal(6,2) DEFAULT NULL COMMENT 'IMPUESTO %',
  `moviConImpValor` decimal(12,2) DEFAULT NULL COMMENT 'IMPUESTO VALOR',
  `moviConIdTercero` int(11) DEFAULT NULL,
  `moviConIdCadmin` int(11) DEFAULT NULL,
  `moviConIdCcosto` int(11) DEFAULT NULL,
  `moviDocum1` varchar(20) DEFAULT NULL,
  `moviDocum2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`moviConId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contamovidetalle`
--

LOCK TABLES `contamovidetalle` WRITE;
/*!40000 ALTER TABLE `contamovidetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `contamovidetalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contapagos`
--

DROP TABLE IF EXISTS `contapagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contapagos` (
  `pagosid` int(11) NOT NULL AUTO_INCREMENT,
  `pagosempresa` int(11) DEFAULT NULL,
  `pagosfacturaid` int(11) DEFAULT NULL,
  `pagosfecha` date DEFAULT NULL,
  `pagostipo` char(1) DEFAULT NULL,
  `pagosvalor` decimal(12,2) DEFAULT NULL,
  `pagosreferencia` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`pagosid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contapagos`
--

LOCK TABLES `contapagos` WRITE;
/*!40000 ALTER TABLE `contapagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contapagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contapropietarios`
--

DROP TABLE IF EXISTS `contapropietarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contapropietarios` (
  `propietarioId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `propietarioEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `propietarioNombre` varchar(50) NOT NULL COMMENT 'NOMBRE',
  `propietarioCedula` varchar(10) DEFAULT NULL COMMENT 'CEDULA',
  `propietarioTelefonos` varchar(45) DEFAULT NULL COMMENT 'TELEFONOS',
  `propietarioDireccion` varchar(45) DEFAULT NULL COMMENT 'DIRECCION',
  `propietarioCorreo` varchar(45) DEFAULT NULL COMMENT 'E-MAIL',
  `propietarioActivo` char(1) DEFAULT NULL COMMENT 'ACTIVO',
  PRIMARY KEY (`propietarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contapropietarios`
--

LOCK TABLES `contapropietarios` WRITE;
/*!40000 ALTER TABLE `contapropietarios` DISABLE KEYS */;
INSERT INTO `contapropietarios` VALUES (113,6,'Jénnifer López','19295811','68991179','Cra 75 # 87-22','alvaro.oycsoft@gmail.com','S'),(114,6,'Angelíná Jolie','9739534','57198632','av 13','alvaro.oycsoft@gmail.com','S'),(115,6,'42489535','53382090','12725817','av 15','alvaro.oycsoft@gmail.com','S'),(116,6,'Shakirañú','42489535','278682','av 14','alvaro.oycsoft@gmail.com','S'),(117,6,'JOSE ANTONIO','51615053','42712923','av 13','alvaro.oycsoft@gmail.com','S'),(118,6,'Thalía','10290603','31507125','av 16','alvaro.oycsoft@gmail.com','S'),(119,6,'Salma Hayek','6821636','78932271','av 17','alvaro.oycsoft@gmail.com','S'),(120,6,'Sofía Vergara','29387407','91894056','av 18','alvaro.oycsoft@gmail.com','S'),(121,6,'Zoe Zaldaña','62951221','95332910','av 19','alvaro.oycsoft@gmail.com','S'),(122,6,'Rihanna','90097602','80817678','av 20','alvaro.oycsoft@gmail.com','S'),(123,6,'Pen‚lope Cruz','831995','85150821','av 21','alvaro.oycsoft@gmail.com','S'),(124,6,'William','65667104','63420412','av 22','alvaro.oycsoft@gmail.com','S'),(125,6,'','','','','','S');
/*!40000 ALTER TABLE `contapropietarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaredondeo`
--

DROP TABLE IF EXISTS `contaredondeo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaredondeo` (
  `redondeoId` int(11) NOT NULL AUTO_INCREMENT,
  `redondeoCodigo` char(1) DEFAULT NULL,
  `redondeoDetalle` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`redondeoId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaredondeo`
--

LOCK TABLES `contaredondeo` WRITE;
/*!40000 ALTER TABLE `contaredondeo` DISABLE KEYS */;
INSERT INTO `contaredondeo` VALUES (1,'L','Cincuenta'),(2,'C','Cien'),(3,'Q','Qunientos'),(4,'M','Mil');
/*!40000 ALTER TABLE `contaredondeo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaresidentes`
--

DROP TABLE IF EXISTS `contaresidentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaresidentes` (
  `residenteId` int(11) NOT NULL,
  `residenteNombre` varchar(45) DEFAULT NULL,
  `residenteCedula` varchar(10) DEFAULT NULL,
  `residenteTipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`residenteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaresidentes`
--

LOCK TABLES `contaresidentes` WRITE;
/*!40000 ALTER TABLE `contaresidentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `contaresidentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaservicios`
--

DROP TABLE IF EXISTS `contaservicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaservicios` (
  `ServicioId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `servicioEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `ServicioCodigo` char(8) NOT NULL COMMENT 'CODIGO',
  `ServicioDetalle` varchar(80) NOT NULL COMMENT 'DETALLE',
  `ServicioPeriodo` char(6) NOT NULL COMMENT 'PERIODO',
  `ServicioFechaDesde` date NOT NULL COMMENT 'FECHA DESDE',
  `ServicioFechaHasta` date NOT NULL COMMENT 'FECHA HASTA',
  `ServicioValor` decimal(12,2) NOT NULL COMMENT 'VALOR',
  `ServicioPrioridad` int(11) DEFAULT NULL COMMENT 'PRIORIDAD',
  `ServicioTipo` char(1) DEFAULT NULL COMMENT 'TIPO',
  `ServicioMora` char(1) DEFAULT NULL COMMENT 'MORA',
  `ServicioMoraPorcentaje` decimal(6,2) DEFAULT NULL COMMENT '% MORA',
  `servicioMoraValor` decimal(12,2) DEFAULT NULL COMMENT 'VALOR MORA',
  `ServicioCuentaDB` varchar(10) DEFAULT NULL COMMENT 'CUENTA DB',
  `ServicioCuentaCR` varchar(10) DEFAULT NULL COMMENT 'CUENTA CR',
  `ServicioPPporcentaje` decimal(6,2) DEFAULT NULL COMMENT '% PRONTO PAGO',
  `ServicioPPvalor` decimal(12,2) DEFAULT NULL COMMENT '$ PRONTO PAGO',
  `ServicioActivo` char(1) DEFAULT NULL COMMENT 'ACTIVO',
  `ServicioAmbito` char(1) DEFAULT NULL COMMENT 'AMBITO',
  `servicioClasificacionId` int(11) DEFAULT NULL COMMENT 'CLASIFICACION',
  PRIMARY KEY (`ServicioId`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaservicios`
--

LOCK TABLES `contaservicios` WRITE;
/*!40000 ALTER TABLE `contaservicios` DISABLE KEYS */;
INSERT INTO `contaservicios` VALUES (6,6,'AdmAp1','Administracion Apartamentos tipo 1','2018','2018-01-01','2018-12-31',110000.00,1,'C','S',2.00,0.00,'210505','4050615',0.00,0.00,'A','G',359),(7,6,'AdmAp2','Administracion Apartamentos tipo 2','2018','2018-01-01','2018-12-31',115000.00,1,'C','S',2.00,0.00,'210505','4050615',0.00,0.00,'A','G',360),(8,6,'AdmAp3','Administracion Apartamentos tipo 3','2018','2018-01-01','2018-12-31',122000.00,1,'C','S',2.00,0.00,'210505','4050615',0.00,0.00,'A','G',361),(10,6,'Grje Sen','Admon Garaje sencillo','2018','2018-01-01','2018-12-31',42000.00,1,'C','S',2.00,0.00,'210505','4050622',0.00,0.00,'A','G',362),(11,6,'Bodega','Admon Bodegas','2018','2018-01-01','2018-12-31',12000.00,1,'C','S',2.00,0.00,'210505','4050626',0.00,0.00,'A','G',364),(24,6,'Grje Dob','Admon Garaje Doble','2018','2018-01-01','2018-12-31',62000.00,1,'C','S',2.00,0.00,'210505','4050626',0.00,0.00,'A','G',363),(25,6,'Aporte E','Aportes extraordinarios','2019','2019-09-07','2019-09-28',1500.00,1,'C','S',0.00,0.00,'1','2',0.00,0.00,'A','T',0),(132,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(133,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(134,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(135,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(136,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(137,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(138,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(139,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(140,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(141,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(142,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(143,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(144,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(145,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(146,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(147,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(148,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(149,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(150,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(151,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0),(152,1,'COD','Servicio','0000','0000-00-00','0000-00-00',0.00,1,'C','S',0.00,0.00,'','',0.00,0.00,'A','T',0);
/*!40000 ALTER TABLE `contaservicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contaterceros`
--

DROP TABLE IF EXISTS `contaterceros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contaterceros` (
  `terceroId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `terceroEmpresaId` int(11) DEFAULT NULL COMMENT 'EMPRESA',
  `terceroNombre` varchar(100) DEFAULT NULL COMMENT 'NOMBRE',
  `terceroIdenTipo` char(1) DEFAULT NULL COMMENT 'TIPO ID',
  `terceroIdenNumero` varchar(20) DEFAULT NULL,
  `terceroDireccion` varchar(50) DEFAULT NULL COMMENT 'DIRECCION',
  `terceroTelefonos` varchar(45) DEFAULT NULL COMMENT 'TELEFONOS',
  `terceroCorreo` varchar(50) DEFAULT NULL COMMENT 'E-MAIL',
  `terceroTwiter` varchar(50) DEFAULT NULL COMMENT 'CTA TWITER',
  `terceroFacebook` varchar(50) DEFAULT NULL COMMENT 'CTA FACEBOOK',
  `terceroComentario` varchar(128) DEFAULT NULL COMMENT 'COMENTARIOS',
  `tercero_codigo` varchar(10) DEFAULT NULL,
  `terceroActivo` char(1) NOT NULL COMMENT 'ACTIVO',
  `terceroRegimen` char(1) DEFAULT NULL,
  `terceroContribuyente` char(1) DEFAULT NULL,
  PRIMARY KEY (`terceroId`),
  UNIQUE KEY `terceroId_UNIQUE` (`terceroId`)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaterceros`
--

LOCK TABLES `contaterceros` WRITE;
/*!40000 ALTER TABLE `contaterceros` DISABLE KEYS */;
INSERT INTO `contaterceros` VALUES (3,1,'ACUAGRANJA LTDA.','N','890.324.48','AVENIDA 13 N. 137-50','6153344','','','','','ACUAGRANJA','A','S','N'),(4,1,'ACUEDUCTO Y ALCANTARILLADO DE BOGOTA','N','','','','','','','','AAB','A','S','N'),(5,1,'ADRIANA TORRES ARTUNDUAGA FOTOCOPIAS CHI','N','51815901-5','','','','','','','COPIASCHI','A','S','N'),(6,1,'AIRES','N','','','','','','','','AIRES','A','S','N'),(7,1,'AGROINSUMOS LOS PINOS  SAS','N','800090263-','Centro Chía locales 1109-1110 ','8616330  3124477647','','','','','AGROINSUMO','A','S','N'),(8,1,'ALCALDÍA MUNICIPAL DE B145CAJICÁ ','','','','','','','','','ALCCAJICÁ','A','S','N'),(9,1,'ALCALDÍA MAYOR DE BOGOTA D.C. INSTITUTO','N','899.999.08','DESARROLLO URBANO','','','','','','ALCBOGOTA','A','S','N'),(10,1,'ALDICOM OPERADORES LTDA-','N','830060549','','','','','','','ALDICOM','A','S','N'),(11,1,'ALFAGRES','N','','','','','','','','ALFAGRES','A','S','N'),(12,1,'ALFREDO LOPEZ VELANDIA','N','4.178.722-','CARRERA 13A N. 89-38 OF.','6185727','','','',' ','ALFLOPEZ','A','S','N'),(13,1,'ALMACÉN EL ARQUITECTO SAS','N','860000054-','cra 11   80-45','5304010','ventas@alamacenelarquitectosa.com','','','','ARQUITECTO','A','S','N'),(14,1,'ALMACENES EXITO S.A.','N','','','','','','','','EXITOS.A.','A','S','N'),(15,1,'ALKOSTO SA C0LOMBIANA DE COMERCIA SA ','N','890900943-','Av cra 68 73 43','4376868','','','','','ALKOSTO','A','S','N'),(16,1,'ANACAONA AGCIA.DE VIAJES Y TURISMO','N','12141467-4','','','','','','','ANACAONA','A','S','N'),(17,1,'ANA CECILIA VARGAS   SALOTTY HUMBERTO DÍAZ','N','39635194-8','cra 50  78-14 ','4876789 3108599668 4910268','','','','Reg común','ANACECILIA','A','S','N'),(18,1,'ÁNGELA MARÍA ORTIZ CABAL','N','38860299','CLE. 92 19-36 AP.301','6114112 6348156 6348157','','','','ACT.PPAL. ACT.SEC.','ÁNGELAMARÍ','A','S','N'),(19,1,'APARCAR LTDA.','N','860.503.56','CALLE 84 N. 20-10','6369866','','','','','APARCAR','A','S','N'),(20,1,'APARTAMENTO CALLE 92 19-36','N','','CLE 92 19-36','','','','','MATR.APTO 50 C 361951 MATR.GARJ 50 C 361943','APCALLE92','A','S','N'),(21,1,'ARTURO CALLE','N','2.913.770-','','','','','','','ARTUROCALL','A','S','N'),(22,1,'AUTOLAVADO EL GRAN BARON','N','53055236','ADRIANA BARON ROZO','','','','','','AUTOLAVADO','A','S','N'),(23,1,'AUTOMÓVIL NISSAN SENTRA 2.002','N','','','','','','','PLACA BOD045','AUTONISSAN','A','S','N'),(24,1,'AVIANCA','N','','','','','','','','AVIANCA','A','S','N'),(25,1,'BAMLUZ  cortinas y pisos ','N','900408744-','Av cra 68 68-43','2400075','ventas@bamluz.com','','','','BAMLUZ','A','S','N'),(26,1,'BANCO DE BOGOTA','N','','','','','','','','BCOBOGOTA','A','S','N'),(27,1,'BANCO SANTANDER','N','','','','','','','','BCOSANTAND','A','S','N'),(28,1,'BRISSA CLUB           ','N','800161656-','Cra 52  10-80 ','7430875','servicioalacliente@brissa.com.co','','','','BRISSACLUB','A','S','N'),(29,1,'CÁMARA DE COMERCIO DE BOGOTÁ ','N','860007322-','CRA 15 CLE 93 SEDE NORTE ','','','','','','CCB','A','S','N'),(30,1,'CARLOS ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','CARLOMELO','A','S','N'),(31,1,'CARLOS JULIO SALAMANCA ','C','19260511','','','','','','','CARLOSSALA','A','S','N'),(32,1,'CARULLA VIVERO S.A. CHICO','N','860.002.09','','','','','','','CARULLA','A','S','N'),(33,1,'CENCOSUD COLOMBIA SA','N','900155107-','ave Pradilla 2 E 71','8611000','','','','','CENCOSUD','A','S','N'),(34,1,'CENTRAL PARKING SYSTEM COL LTDA.','N','830.087.09','CALLE 93 N. 13-19','6361113','','','','','CENTRALPAR','A','S','N'),(35,1,'CENTRO COMERCIAL ANDINO','N','800199501-','','','','','','','CCOMERCIAL','A','S','N'),(36,1,'CENTRO COMERCIAL SANTAFE','N','900083038-','','','','','','','CCIALSANTA','A','S','N'),(37,1,'CENTRO DE DIAGN.AUTOMOTOR DE LA SABANA S.A','N','900.084.96','','','','','','','DIAGNDELAS','A','S','N'),(38,1,'CENTRO RURAL SOFIA KOPPEL','N','860020425','Jorge Bolivar Alfaro','','','','','C.C. 19.245.461','CTRORURAL','A','S','N'),(39,1,'CERRADURAS INTER ATLANTICA LTDA','N','830.097.85','','','','','','','CERRADURAS','A','S','N'),(40,1,'CITY PARKING','N','830050619-','','','','','','','CITYPARKIN','A','S','N'),(41,1,'CIUDADELA CCIAL UNICDENTRO','N','860048836-','','','','','','','CIUDADELAC','A','S','N'),(42,1,'CLUB CAMPESTRE PEREIRA','N','','','','','','','','CLUBCAMPES','A','S','N'),(43,1,'CODENSA ESP.','N','830.037.24','','','','','','','CODENSAESP','A','S','N'),(44,1,'COLSANITAS','N','860078828','','','','','','','COLSANITAS','A','S','N'),(45,1,'COMBUSTIBLES DE COLOMBIA S.A. - TEXACO E','N','830.513.72','L COMUN','6760241','','','','AUTOPISTA NORTE KM 20','TEXACOE','A','S','N'),(46,1,'COMCEL S.A.','N','800.153.99','','','','','','','COMCELS.A.','A','S','N'),(47,1,'COMERCIAL PAPELERA','N','860.528.39','','','','','','','COMERCIALP','A','S','N'),(48,1,'COMERCIALIZADORA RUMBOS','N','830.508.16','','','','','','','COMERCIALI','A','S','N'),(49,1,'COMPAÑIAS ASOCIADAS DE GAS S.A. E.S.P.','N','800.074.03','','','','','','','CIAASOCIAD','A','S','N'),(50,1,'COMPENSAR','N','860066942-','','','','','','','COMPENSAR','A','S','N'),(51,1,'CONCESION BRICENO TUNJA SOGAMOSO','N','830052998-','','','','','','','CONCESIONB','A','S','N'),(52,1,'CONCESIONARIA SAN RAFAEL S.A.','N','','','','','','','','CONCESIONA','A','S','N'),(53,1,'CONCESION NEIVA GIRARDOT','N','5199222','','','','','','','CONCESIONN','A','S','N'),(54,1,'CONSTRUCCIONES JORGE BOLÍVAR ','N','900323576-','','','','','','','CONSTRUCCI','A','S','N'),(55,1,'CONRADO BETANCOURT','N','','','','','','','','CONRADOBET','A','S','N'),(56,1,'COPIAS CHICO','N','51608610','','','','','','','COPIASCHIC','A','S','N'),(57,1,'COPYPLOTTER Y ENVIOS-CARLOS ERNESTO MORE','N','19477828','NO FORERO','','','','','','COPYPLOTTE','A','S','N'),(58,1,'CORPORACION CLUB CAMPESTRE DE PEREIRA','N','891400467-','','','','','','','CORPORACIO','A','S','N'),(59,1,'CORREA CARO ABELLA & CIA LTDA.','N','860.352.46','CALLE 71 N, 5-41','2170011','','','','','CORREACARO','A','S','N'),(60,1,'CORREDOR HNOS. & ASOCIADOS LTDA','N','860.032.68','CALLE 59A N. 8-83','2356166','','','','','CORREDORHN','A','S','N'),(61,1,'CREPRES & WAFFLES S.A.','N','860.076.91','','','','','','','CREPRES&WA','A','S','N'),(62,1,'CRUZ ROJA COLOMBIANA','N','','','','','','','','CRUZROJACO','A','S','N'),(63,1,'CHIMENEAS DE COLOMBIA  ','C','35199155','','','','','','','CHIMENEASD','A','S','N'),(64,1,'DAVID GUTIÉRREZ BUITRAGO','N','17139692-7','','','','','','','DAVIDGUTIÉ','A','S','N'),(65,1,'DECORCERÁMICA ','N','800165377','autop norte cle 135  45-16 ','7433838','','','','','DECORCERÁM','A','S','N'),(66,1,'D H L EXPRESS COLOMBIA LTDA.','N','860.502.60','','','','','','','DHLEXPRESS','A','S','N'),(67,1,'DEPRISA - AVIANCA','N','890.100.57','','','','','','','DEPRISA','A','S','N'),(68,1,'DEVINORTE','','6760652','','6760652','','','','','DEVINORTE','A','S','N'),(69,1,'DIAGNOSTIAUTOS S.A.','N','830130337-','','','','','','','DIAGNOSTIA','A','S','N'),(70,1,'DIEGO JAVIER BARAJAS P.','N','79862748-6','cra 40 25 21 ap 111','3173419428','sigmaarquitecto@yahoo.com.ar','','','Rég.Simp.','DIEGOJAVIE','A','S','N'),(71,1,'DIEGO PARDO KOPPEL','N','','','','','','','','DIEGOPARDO','A','S','N'),(72,1,'DIEGO PUENTES','C','79504216','','','','','','','DIEGOPUENT','A','S','N'),(73,1,'DIGUES LTDA ','N','800112126-','Av Cra 30  88 A 19','6353041 3144618625','','','','','DIGUESLTDA','A','S','N'),(74,1,'DIR. DE IMPUESTOS Y ADUANAS NACIONALES','N','','','','','','','','DIAN','A','S','N'),(75,1,'DISERCOM S.A. -MOBIL EL RODEO','N','830.046.00','AUTOPISTA NORTE-KM 20','6760183','','','','','DISERCOM','A','S','N'),(76,1,'E.D.S.PETROBRAS LA MILAGROSA','N','900182159-','','','','','','','PETROBRASL','A','S','N'),(77,1,'EBAY CAR - EBANISTERIA Y CARPINTERIA','N','','CALLE 10 N. 66A-42','2604755','','','','','EBAYCAR-EB','A','S','N'),(78,1,'EDIFICIO PORLAMAR P.H.','N','860.075.49','CLE 92 19-36','5303040','','','','','EDIFICIOPO','A','S','N'),(79,1,'EDS MERCASA','N','830095213','','','','','','','EDSMERCASA','A','S','N'),(80,1,'ELECTRILUCES  LTDA ','N','900322522-','CRA 12 16-34','6083901 2833484','ELECTRILUCES@HOTMAIL.COM','','','','ELECTRILUC','A','S','N'),(81,1,'EL TIEMPO SA','C','860599421','Av. El Dorado','277 775 775','','','','proveedor de publicaciones','ELTIEMPOSA','A','S','N'),(82,1,'ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','ENRIQUEMEL','A','S','N'),(83,1,'ENRIQUE GONZALEZ \"VIVERO LA ESTANCIA\"','N','860043771-','Cra 80  175-36   ','','','','','','ENRIQUEGON','A','S','N'),(84,1,'EQUIPOS DE OFICINA','N','','','','','','','','EQUIPOSDEO','A','S','N'),(85,1,'ESPACIOS Y SOLUCIONES SAS','N','830104599','CLE 116 15-20 ','6122983 6370873/76','espaciosysoluciones@gmail.com  ','','','','ESPACIOSYS','A','S','N'),(86,1,'ESPERANZA SANTACOLOMA','N','','','','','','','','ESPERANZAS','A','S','N'),(87,1,'ESSE CONNSULTORES','N','830137656-','','','','','','','ESSECONNSU','A','S','N'),(88,1,'ESSO EL RODEO DISERCOM S.A.','N','830046009-','','','','','','','ESSOELRODE','A','S','N'),(89,1,'ESTACION DE SCIO.LAS MARGARITAS','N','3264700-1','','','','','','','EDSLASMARG','A','S','N'),(90,1,'ESTACION DE SERVICIO BRIO BIMA','N','830.066.13','CARRERA 45 N.232-35','','','','','313-8893900','EDSBRIOBIM','A','S','N'),(91,1,'ESTACION DE SERVICIO COUNTRY','N','900.093.28','','','','','','','EDSCOUNTRY','A','S','N'),(92,1,'ESTACION DE SERVICIO EL CANELON CIA LTDA','N','830136907-','','','','','','','EDSELCANEL','A','S','N'),(93,1,'ESTACION DE SERVICIO MOBIL LA CARO','N','17108681','','','','','','','EDSMOBILLA','A','S','N'),(94,1,'ESTACION DESERVICIO EL CANELON Y CIA LTD','N','830.136.90','A.','','','','','','EDSELCANEL','A','S','N'),(95,1,'ESTACION RUMBOS LA CARO','N','830508167-','','','','','','','ESTACIONRU','A','S','N'),(96,1,'ESTACIONES DE PEAJE UTDVVCC','N','830059605-','','','','','','','ESTACIONES','A','S','N'),(97,1,'EMPRESA DE TELEFONOS DE BOGOTA','N','3777777','centro','3777777','info@etb.com','','','','ETB','A','S','N'),(98,1,'EVERNET SAS','N','900677172-','Cr. 1 D  31-38  Chía ','3142221757','evernetwireless@gmail.com','','','','EVERNETSAS','A','S','N'),(99,1,'FERNANDO GONZALEZ','N','80210671','','','','','','','FERNANDOGO','A','S','N'),(100,1,'FERREPLAST','N','','','','','','','','FERREPLAST','A','S','N'),(101,1,'FERRETERIA JOSE GOMEZ','N','19192006-6','','','','','','','FERRETERIA','A','S','N'),(102,1,'FERRETERIA LA LLAVE DEL NORTE','N','19310323','','','','','','','FERRETERIA','A','S','N'),(103,1,'FIDEICOMISO CONCESIONES CCFC S.A.','N','800256769-','','','','','','','FIDEICOMIS','A','S','N'),(104,1,'FIDEICOMISO FUDUCOLDEX','N','830054060-','','','','','','','FIDEICOMIS','A','S','N'),(105,1,'FIDEICOMISO PANAMERICANA','N','830053630-','','','','','','','FIDEICOMIS','A','S','N'),(106,1,'FIDUCIARIA CORFICOLOMBIANA','N','800140887-','','','','','','','FIDUCIARIA','A','S','N'),(107,1,'FUNDACIÓN SALDARRIAGA','N','860.038.33','','','','','','','FUNDACIÓNS','A','S','N'),(108,1,'GRUPO DE INVERSIONES N&R SAS ','N','900424448-','cra 15  78-33  local 276','3004839','www.grupnyr.com','','','','GRUPODEINV','A','S','N'),(109,1,'HABITAT STORE  SAS ','N','830086688-','av cra 45 183 A 70','6767777','','','','','HABITATSTO','A','S','N'),(110,1,'HÉCTOR GUTIÉRREZ GONZÁLEZ ','C','','','','','','','','HÉCTORGUTI','A','S','N'),(111,1,'(Héctor Gut.Gonz). HOME CENTER (SODIMAC COL.SA)','N','800242106-','','','','','','','HOMECENTER','A','S','N'),(112,1,'HENAO LUNA EU','N','900.241.02','','','','','','','HENAOLUNAE','A','S','N'),(113,1,'HIDROMET LTDA','','','','','','','','','HIDROMETLT','A','S','N'),(114,1,'HOMECENTER SODIMAC COLOMBIA S.A.','N','800242106-','','','','','','','SODIMAC','A','S','N'),(115,1,'HOTEL CHICALA','N','891101711-','','','','','','','HOTELCHICA','A','S','N'),(116,1,'HOTEL SEBASTIAN','N','R.U.C.1790','DIEGO DE ALMAGRO 822','','','','','QUITO - ECUADOR','HOTELSEBAS','A','S','N'),(117,1,'IGNACIO TURBAY','N','','','','','','','','IGNACIOTUR','A','S','N'),(118,1,'INES RUBIANO','C','8050154','','','','','','','INESRUBIAN','A','S','N'),(119,1,'INGENIERÍA DE ESTRUCTURAS Y CONSTRUCCION SAS ','N','900199597-','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','INGESTRUCT','A','S','N'),(120,1,'INSTITUTO DE SEGUROS SOCIALES','N','','','','','','','','INSTITUTOD','A','S','N'),(121,1,'INSTITUTO NACIONAL DE VIAS','N','800215807-','','','','','','','INSTITUTON','A','S','N'),(122,1,'INVERSET BOTERO GOMEZ Y CIA','N','816004255-','HOSTAL HACIENDA MALABAR','','','','','','INVERSETBO','A','S','N'),(123,1,'INVERSIONES EL CIPRES COLOMBIA S.A.','N','811.032.44','CALLE 94 N. 12-55','','','','','','INVERSIONE','A','S','N'),(124,1,'INVERSIONES LEAL S.A.','N','900016780-','','','','','','','INVERSIONE','A','S','N'),(125,1,'INVERSIONES LIBRA S.A. COSMOS 100','N','860048182-','','','','','','','INVERSIONE','A','S','N'),(126,1,'IROTAMA S.A.','N','891700612-','','','','','','','IROTAMA','A','S','N'),(127,1,'JAIME URIBE BOTERO','N','','','','','','','','JAIMEURIBE','A','S','N'),(128,1,'JAVIER PARRA','N','805010511','','','','','','','JAVIERPARR','A','S','N'),(129,1,'JORGE  ELIÉCER  BOLIVAR ALFARO ','N','19245461-3','CL 163 B  48 34 AP 201','8636277 3107683925','gerencia@construccionesjorgebolivar ','','','','JORGEELIÉC','A','S','N'),(130,1,'JOSÉ NICOLÁS SERNA ','C','3150893','','3134909804','','','','','JOSÉNICOLÁ','A','S','N'),(131,1,'JUAN CARLOS DIAZ','N','79758019','','','','','','','JUANCARLOS','A','S','N'),(132,1,'JUAN CARLOS DOBLADO CÁRDENAS ','N','79980860','AV PRADILLA 5 62  CHÍA  CUND.','8630283 3107994599','jcdoblado@hotmail.com','','','','JUANCARLOS','A','S','N'),(133,1,'JUAN PABLO KOUSEN','C','79186474','','','','','','','JUANPABLOK','A','S','N'),(134,1,'JULIAN ARANA','N','94487211','','','','','','','JULIANARAN','A','S','N'),(135,1,'JULIO BORDA G. SUPER EST.TEXACO 10','N','2917960-1','','','','','','','JULIOBORDA','A','S','N'),(136,1,'JULIO FLOREZ','N','19146712','','','','','','','JULIOFLORE','A','S','N'),(137,1,'JULIO FONTAN Y CÍA','N','800.217.63','','','','','','','JULIOFONTA','A','S','N'),(138,1,'HÉCTOR GUTIÉRREZ GONZÁLEZ+B19  Arquitecto','C','17020239','','','','','','','HÉCTORGUTI','A','S','N'),(139,1,'KATA S.A.S','N','830047411-','','','','','','','KATAS.A.S','A','S','N'),(140,1,'LAO KAO S.A.','N','830047537-','','','','','','','LAOKAOS.A.','A','S','N'),(141,1,'LAS CUADRAS TERRENO CAJICÁ C/MARCA.','N','','','','','','','MATR.176-40270 MATR.176-40271','LASCUADRAS','A','S','N'),(142,1,'LEASING BANCOLOMBIA  SA ','N','860059294-','CR 48 26 85 TORRE NORTE PISO 1','','','','','','LEASINGBAN','A','S','N'),(143,1,'LIBERTY SEGUROS S.A.','N','860.039.96','','','','','','','LIBERTYSEG','A','S','N'),(144,1,'LIBRERIA NACIONAL S.A.','N','','','','','','','','LIBRERIANA','A','S','N'),(145,1,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(146,1,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(147,1,'LIGHTS DESIGN','N','1020735710','Cle 65  13-61 ','3573828 5411846','ligthsdesigncolombia@gmail.com','','','','LIGHTSDESI','A','S','N'),(148,1,'LISANDRO ACOSTA GONZÁLEZ (Electrogas del Llano)','C','4284616-1','Cle 15 1015 Chía centro','88584017 3106192008','','','','','LISANDROAC','A','S','N'),(149,1,'LOS TRES ELEFANTES ','N','860030478-','Cento Chía local 1170','','','','','','LOSTRESELE','A','S','N'),(150,1,'LOTA LA ESTACADA','N','','','','','','','','LOTALAESTA','A','S','N'),(151,1,'LUBRICANTES LA ISLA-MARIA MYRIAM VALCARC','N','41534714','EL MANRIQUE','','','','','','LUBRICANTE','A','S','N'),(152,1,'LUBRISERVICIOS KIKO E/S ESSO COUNTRY','N','51898765','','','','','','','LUBRISERVI','A','S','N'),(153,1,'LUIS ALBERTO CADENA','N','79147302','','','','','','','LUISALBERT','A','S','N'),(154,1,'LUIS GUINARD','N','','','','','','','','LUISGUINAR','A','S','N'),(155,1,'LUIS HUMBERTO GAMBA V.','N','3163305-1','','','','','','','LUISHUMBER','A','S','N'),(156,1,'MARIA ELIZA HERRERA','N','','','','','','','','MARIAELIZA','A','S','N'),(157,1,'MARIA ELVIRA PARDO O.','N','','','','','','','','MARIAELVIR','A','S','N'),(158,1,'MARIA MYRIAM VALCARCEL MANRIQUE','N','41534714-1','','','','','','','MARIAVALCA','A','S','N'),(159,1,'MAURICIO PARDO KOPPEL','N','17130450','CLE. 92 19-36 OFN.301','6114112 6348156 6348157','','','','ACT.PPAL.7421 ACT.SEC. 0010','MAURICIOPA','A','S','N'),(160,1,'MECANICA AUTOMOTRIZ - ALFREDO MOTOR.COM','N','79388361','CALLE 91 N. 39-37','','','','','','MECANICAAU','A','S','N'),(161,1,'MERCA','N','0','','','','','','','MERCA','A','S','N'),(162,1,'MIGUEL CRUZ','N','19253448','','','','','','','MIGUELCRUZ','A','S','N'),(163,1,'MIGUEL FELIPE COTTS','N','17151077','','','','','','','MIGUELFELI','A','S','N'),(164,1,'MINISTERIO DE CULTURA','N','899999066','','','','','','','MINISTERIO','A','S','N'),(165,1,'MOLINO DE LA FLORIDA S.A.','N','','','','','','','','MOLINODELA','A','S','N'),(166,1,'MOVISTAR','N','1234566','CAN','4545','ventas@movistar.com.co','','','Telefonia empresarial','MOVISTAR','A','S','N'),(167,1,'MPKSAS - EMPRESA','N','','','','','','','','MPKSAS-EMP','A','S','N'),(168,1,'MUEBLES Y ENSERES CASA-OFICINA','N','','','','','','','','MUEBLESYEN','A','S','N'),(169,1,'NAVAS&NAVAS-ALAMCEN DE ARTE','N','800120675-','','','','','','','NAVAS&NAVA','A','S','N'),(170,1,'NOTARIA 25 DEL CIRCUITO DE BOGOTA D.C...','N','21069048','','','','','','','NOTARIA25','A','S','N'),(171,1,'NOTARIA 42 DE BOGOTA','N','23268456','','','','','','','NOTARIA42D','A','S','N'),(172,1,'NOTARIA NOVENA DE BOGOTA','N','11371163','','','','','','','NOTARIANOV','A','S','N'),(173,1,'OLGA LEONOR DE BRIGARD','N','39790002','','','','','','','OLGALEONOR','A','S','N'),(174,1,'OPENVIAS LTDA','N','830054076-','','','','','','','OPENVIASLT','A','S','N'),(175,1,'ORLANDO MENDEZ','N','80017590','','','','','','','ORLANDOMEN','A','S','N'),(176,1,'OSCAR BOLÍVAR RINCÓN ','C','79981828','','','','','','','OSCARBOLÍV','A','S','N'),(177,1,'OSCAR ISAZA','N','','','','','','','','OSCARISAZA','A','S','N'),(178,1,'OVER CHICO TOURS LTDA','N','800.202.05','','','','','','','OVERCHICOT','A','S','N'),(179,1,'PANAMERICANA LIBRERIA Y PAPELERIA S.A.','N','830.037.94','','','','','','','PANAMERICA','A','S','N'),(180,1,'PARCEALCIÓN MOLINO LA FLORIDA ','N','900243304-','','3166365613','','','','','PARCEALCIÓ','A','S','N'),(181,1,'PARKING INTERNATIONAL LTDA.','N','860.058.76','','','','','','','PARKINGINT','A','S','N'),(182,1,'PARQUEADERO TORRES 47 GOMEZ AMPARO','N','20302596-7','','','','','','','PARQUEADER','A','S','N'),(183,1,'PARQUEQDERO ACLA','N','860532264-','','','','','','','PARQUEQDER','A','S','N'),(184,1,'PEAJE LOS PATIOS','N','830132323-','','','','','','','PEAJELOSPA','A','S','N'),(185,1,'PEDRO PABLO VARGAS ','C','321422','','','','','','','PEDROPABLO','A','S','N'),(186,1,'PERIODICOS LTDA.','N','','','','','','','','PERIODICOS','A','S','N'),(187,1,'PUDONG LTDA','N','900.113.79','','','','','','','PUDONGLTDA','A','S','N'),(188,1,'Rafael Cortés Daza','C','2859469','','','','','','','RafaelCort','A','S','N'),(189,1,'RAFAEL A CORREDOR B. ABC  de los MUEBLES ','N','18004263-4','cra 27  12-39','2084141 2257157','ventasabcmuebles@hotmail.com','','','Reg. Común','RAFAELACOR','A','S','N'),(190,1,'RAÚL CAMACHO ALFONSO (ING. DE ESTR.Y CONSTR.) ','C','19109035','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','RAÚLCAMACH','A','S','N'),(191,1,'RESTAURANTE SAN ALEJO-BEATRIZ NIÑO DE H.','N','20252749','DIAG. 6 N.3-35 CAJICA','8660691','','','','DIAG. 6 N.3-35 CAJICA','RESTAURANT','A','S','N'),(192,1,'RESTAURANTE ZOE S.A.','N','','','','','','','','RESTAURANT','A','S','N'),(193,1,'RICARDO CARVAJAL ORTIZ ','N','79537297-3','DIAG 49 F BIS SUR 6 33 AP 101','6969846 3133718580','ricardocarvajal@yahoo.com','','','Rég. Simpl.','RICARDOCAR','A','S','N'),(194,1,'RODRIGO OSPINA','N','8241088','','','','','','','RODRIGOOSP','A','S','N'),(195,1,'RODRIGO PARDO K.','N','','','','','','','','RODRIGOPAR','A','S','N'),(196,1,'RUDOLFF DIAZ LOPEZ','N','80076610-0','','','','','','','RUDOLFFDIA','A','S','N'),(197,1,'SAAD Y CIA C.S.A. (SERVICENTRO 3er.p)','N','800.006.07','','','','','','','SAADYCIAC','A','S','N'),(198,1,'SECRETARÍA DE HACIENDA CARTAGENA','N','','','','','','','','SEHDACARTA','A','S','N'),(199,1,'SECRETARIA DE HACIENDA DE BOGOTA','N','','','','','','','','SECRETARIA','A','S','N'),(200,1,'SECRETARIA DE HACIENDA MUNICIPAL CAJICA','N','899.999.46','','','','','','','SHDAMUNICI','A','S','N'),(201,1,'SERVICIO ESSO MIROLINDO','N','14201328','','','','','','','SERVICIOES','A','S','N'),(202,1,'SERVIENTREGA','N','860.512.33','','','','','','','SERVIENTRE','A','S','N'),(203,1,'SERVIPLETTER FELIX DIAZ D.','N','19239900','','','','','','','SERVIPLETT','A','S','N'),(204,1,'SUPERPLOTTER - RUDOLFF DIAZ LOPEZ','N','80076610','CALLE 98 N. 15-28','2572505','','','','','SUPERPLOTT','A','S','N'),(205,1,'TEJIDOS GAVIOTA SAS (INNOVACIÓN TEXTIL)','N','800067448-','cra 50 79-55','2312535 2400820','','','','','TEJIDOSGAV','A','S','N'),(206,1,'TEJIDOS LAV','N','860000867-','Av 19 114 A-05 /Cra 5A 4-88 Sur Caj.E56 ','','','','','','TEJIDOSLAV','A','S','N'),(207,1,'TELMEX HOGAR S.A.','N','830053,8','CARRERA 11 N. 94-76','','','','','','TELMEXHOGA','A','S','N'),(208,1,'TERRAKOT SAS ','N','900532394-','CLE 92 19-36 OF 301','','','','','','TERRAKOTSA','A','S','N'),(209,1,'TERPEL- ESTACION DE SERVICIO ORO NEGRO L','N','832.006.76',',','','','','','','TERPELORON','A','S','N'),(210,1,'TEXACO 20 EL COMUN','N','','','','','','','','TEXACO20EL','A','S','N'),(211,1,'TEXTURAS Y MATICES  SA ','N','800066571-','Autp Norte paralela 88-49','2569090 2569128','','','','','TEXTURASYM','A','S','N'),(212,1,'TRANSPORTE Y PARQUEO LTDA.','N','900.192.41','','','','','','','TRANSPORTE','A','S','N'),(213,1,'TUGO SAS ','N','830087848-','','2405880 OPC.2','','','','','TUGOSAS','A','S','N'),(214,1,'ULTRABURSÁTILES','N','','','','','','','','ULTRABURSÁ','A','S','N'),(215,1,'ULTRAVALORES','N','','','','','','','','ULTRAVALOR','A','S','N'),(216,1,'UNIANDINOS','N','','','','','','','','UNIANDINOS','A','S','N'),(217,1,'UNION TEMPORAL DEVINORTE','N','830002623','','','','','','','DEVINORTE','A','S','N'),(218,1,'UNIVERSIDAD TECNOLOGICA DE BOLIVAR','N','890.401.96','','','','','','','UTECNOLOGI','A','S','N'),(219,1,'VIVERO LA ESTANCIA  Enrique González ','N','860043771-','Cra 80  175-36   ','6732971 6711465','viverolaestancia@gmail.com ','','','','VIVEROLAES','A','S','N'),(220,1,'VIVERO LA FLORIDA','N','80501054','','','','','','','VIVEROLAFL','A','S','N'),(221,1,'XICOM TECMOLOGY','N','','','3103039730','','','','','XICOM','A','S','N'),(222,6,'AGRICOLA PARRILLA S.A.S','N','900722569-','','','','','','','AGRICOPARR','A','S','N'),(223,6,'ACADEMIA COLOMBIANA DE ARQUITECTURA Y D','N','830142801-','','','','','','','ACA','A','S','N'),(224,6,'ACUAGRANJA LTDA.','N','890.324.48','AVENIDA 13 N. 137-50','6153344','','','','','ACUAGRANJA','A','S','N'),(225,6,'ACUEDUCTO Y ALCANTARILLADO DE BOGOTA','N','','','','','','','','AAB','A','S','N'),(226,6,'ADRIANA TORRES ARTUNDUAGA FOTOCOPIAS CHI','N','51815901-5','','','','','','','COPIASCHI','A','S','N'),(227,6,'AIRES','N','','','','','','','','AIRES','A','S','N'),(228,6,'AGROINSUMOS LOS PINOS  SAS','N','800090263-','Centro Chía locales 1109-1110 ','8616330  3124477647','','','','','AGROINSUMO','A','S','N'),(229,6,'ALCALDÍA MUNICIPAL DE B145CAJICÁ ','','','','','','','','','ALCCAJICÁ','A','S','N'),(230,6,'ALCALDÍA MAYOR DE BOGOTA D.C. INSTITUTO','N','899.999.08','DESARROLLO URBANO','','','','','','ALCBOGOTA','A','S','N'),(231,6,'ALDICOM OPERADORES LTDA-','N','830060549','','','','','','','ALDICOM','A','S','N'),(232,6,'ALFAGRES','N','','','','','','','','ALFAGRES','A','S','N'),(233,6,'ALFREDO LOPEZ VELANDIA','N','4.178.722-','CARRERA 13A N. 89-38 OF.','6185727','','','',' ','ALFLOPEZ','A','S','N'),(234,6,'ALMACÉN EL ARQUITECTO SAS','N','860000054-','cra 11   80-45','5304010','ventas@alamacenelarquitectosa.com','','','','ARQUITECTO','A','S','N'),(235,6,'ALMACENES EXITO S.A.','N','','','','','','','','EXITOS.A.','A','S','N'),(236,6,'ALKOSTO SA C0LOMBIANA DE COMERCIA SA ','N','890900943-','Av cra 68 73 43','4376868','','','','','ALKOSTO','A','S','N'),(237,6,'ANACAONA AGCIA.DE VIAJES Y TURISMO','N','12141467-4','','','','','','','ANACAONA','A','S','N'),(238,6,'ANA CECILIA VARGAS   SALOTTY HUMBERTO DÍAZ','N','39635194-8','cra 50  78-14 ','4876789 3108599668 4910268','','','','Reg común','ANACECILIA','A','S','N'),(239,6,'ÁNGELA MARÍA ORTIZ CABAL','N','38860299','CLE. 92 19-36 AP.301','6114112 6348156 6348157','','','','ACT.PPAL. ACT.SEC.','ÁNGELAMARÍ','A','S','N'),(240,6,'APARCAR LTDA.','N','860.503.56','CALLE 84 N. 20-10','6369866','','','','','APARCAR','A','S','N'),(241,6,'APARTAMENTO CALLE 92 19-36','N','','CLE 92 19-36','','','','','MATR.APTO 50 C 361951 MATR.GARJ 50 C 361943','APCALLE92','A','S','N'),(242,6,'ARTURO CALLE','N','2.913.770-','','','','','','','ARTUROCALL','A','S','N'),(243,6,'AUTOLAVADO EL GRAN BARON','N','53055236','ADRIANA BARON ROZO','','','','','','AUTOLAVADO','A','S','N'),(244,6,'AUTOMÓVIL NISSAN SENTRA 2.002','N','','','','','','','PLACA BOD045','AUTONISSAN','A','S','N'),(245,6,'AVIANCA','N','','','','','','','','AVIANCA','A','S','N'),(246,6,'BAMLUZ  cortinas y pisos ','N','900408744-','Av cra 68 68-43','2400075','ventas@bamluz.com','','','','BAMLUZ','A','S','N'),(247,6,'BANCO DE BOGOTA','N','','','','','','','','BCOBOGOTA','A','S','N'),(248,6,'BANCO SANTANDER','N','','','','','','','','BCOSANTAND','A','S','N'),(249,6,'BRISSA CLUB           ','N','800161656-','Cra 52  10-80 ','7430875','servicioalacliente@brissa.com.co','','','','BRISSACLUB','A','S','N'),(250,6,'CÁMARA DE COMERCIO DE BOGOTÁ ','N','860007322-','CRA 15 CLE 93 SEDE NORTE ','','','','','','CCB','A','S','N'),(251,6,'CARLOS ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','CARLOMELO','A','S','N'),(252,6,'CARLOS JULIO SALAMANCA ','C','19260511','','','','','','','CARLOSSALA','A','S','N'),(253,6,'CARULLA VIVERO S.A. CHICO','N','860.002.09','','','','','','','CARULLA','A','S','N'),(254,6,'CENCOSUD COLOMBIA SA','N','900155107-','ave Pradilla 2 E 71','8611000','','','','','CENCOSUD','A','S','N'),(255,6,'CENTRAL PARKING SYSTEM COL LTDA.','N','830.087.09','CALLE 93 N. 13-19','6361113','','','','','CENTRALPAR','A','S','N'),(256,6,'CENTRO COMERCIAL ANDINO','N','800199501-','','','','','','','CCOMERCIAL','A','S','N'),(257,6,'CENTRO COMERCIAL SANTAFE','N','900083038-','','','','','','','CCIALSANTA','A','S','N'),(258,6,'CENTRO DE DIAGN.AUTOMOTOR DE LA SABANA S.A','N','900.084.96','','','','','','','DIAGNDELAS','A','S','N'),(259,6,'CENTRO RURAL SOFIA KOPPEL','N','860020425','Jorge Bolivar Alfaro','','','','','C.C. 19.245.461','CTRORURAL','A','S','N'),(260,6,'CERRADURAS INTER ATLANTICA LTDA','N','830.097.85','','','','','','','CERRADURAS','A','S','N'),(261,6,'CITY PARKING','N','830050619-','','','','','','','CITYPARKIN','A','S','N'),(262,6,'CIUDADELA CCIAL UNICDENTRO','N','860048836-','','','','','','','CIUDADELAC','A','S','N'),(263,6,'CLUB CAMPESTRE PEREIRA','N','','','','','','','','CLUBCAMPES','A','S','N'),(264,6,'CODENSA ESP.','N','830.037.24','','','','','','','CODENSAESP','A','S','N'),(265,6,'COLSANITAS','N','860078828','','','','','','','COLSANITAS','A','S','N'),(266,6,'COMBUSTIBLES DE COLOMBIA S.A. - TEXACO E','N','830.513.72','L COMUN','6760241','','','','AUTOPISTA NORTE KM 20','TEXACOE','A','S','N'),(267,6,'COMCEL S.A.','N','800.153.99','','','','','','','COMCELS.A.','A','S','N'),(268,6,'COMERCIAL PAPELERA','N','860.528.39','','','','','','','COMERCIALP','A','S','N'),(269,6,'COMERCIALIZADORA RUMBOS','N','830.508.16','','','','','','','COMERCIALI','A','S','N'),(270,6,'COMPAÑIAS ASOCIADAS DE GAS S.A. E.S.P.','N','800.074.03','','','','','','','CIAASOCIAD','A','S','N'),(271,6,'COMPENSAR','N','860066942-','','','','','','','COMPENSAR','A','S','N'),(272,6,'CONCESION BRICENO TUNJA SOGAMOSO','N','830052998-','','','','','','','CONCESIONB','A','S','N'),(273,6,'CONCESIONARIA SAN RAFAEL S.A.','N','','','','','','','','CONCESIONA','A','S','N'),(274,6,'CONCESION NEIVA GIRARDOT','N','5199222','','','','','','','CONCESIONN','A','S','N'),(275,6,'CONSTRUCCIONES JORGE BOLÍVAR ','N','900323576-','','','','','','','CONSTRUCCI','A','S','N'),(276,6,'CONRADO BETANCOURT','N','','','','','','','','CONRADOBET','A','S','N'),(277,6,'COPIAS CHICO','N','51608610','','','','','','','COPIASCHIC','A','S','N'),(278,6,'COPYPLOTTER Y ENVIOS-CARLOS ERNESTO MORE','N','19477828','NO FORERO','','','','','','COPYPLOTTE','A','S','N'),(279,6,'CORPORACION CLUB CAMPESTRE DE PEREIRA','N','891400467-','','','','','','','CORPORACIO','A','S','N'),(280,6,'CORREA CARO ABELLA & CIA LTDA.','N','860.352.46','CALLE 71 N, 5-41','2170011','','','','','CORREACARO','A','S','N'),(281,6,'CORREDOR HNOS. & ASOCIADOS LTDA','N','860.032.68','CALLE 59A N. 8-83','2356166','','','','','CORREDORHN','A','S','N'),(282,6,'CREPRES & WAFFLES S.A.','N','860.076.91','','','','','','','CREPRES&WA','A','S','N'),(283,6,'CRUZ ROJA COLOMBIANA','N','','','','','','','','CRUZROJACO','A','S','N'),(284,6,'CHIMENEAS DE COLOMBIA  ','C','35199155','','','','','','','CHIMENEASD','A','S','N'),(285,6,'DAVID GUTIÉRREZ BUITRAGO','N','17139692-7','','','','','','','DAVIDGUTIÉ','A','S','N'),(286,6,'DECORCERÁMICA ','N','800165377','autop norte cle 135  45-16 ','7433838','','','','','DECORCERÁM','A','S','N'),(287,6,'D H L EXPRESS COLOMBIA LTDA.','N','860.502.60','','','','','','','DHLEXPRESS','A','S','N'),(288,6,'DEPRISA - AVIANCA','N','890.100.57','','','','','','','DEPRISA','A','S','N'),(289,6,'DEVINORTE','','6760652','','6760652','','','','','DEVINORTE','A','S','N'),(290,6,'DIAGNOSTIAUTOS S.A.','N','830130337-','','','','','','','DIAGNOSTIA','A','S','N'),(291,6,'DIEGO JAVIER BARAJAS P.','N','79862748-6','cra 40 25 21 ap 111','3173419428','sigmaarquitecto@yahoo.com.ar','','','Rég.Simp.','DIEGOJAVIE','A','S','N'),(292,6,'DIEGO PARDO KOPPEL','N','','','','','','','','DIEGOPARDO','A','S','N'),(293,6,'DIEGO PUENTES','C','79504216','','','','','','','DIEGOPUENT','A','S','N'),(294,6,'DIGUES LTDA ','N','800112126-','Av Cra 30  88 A 19','6353041 3144618625','','','','','DIGUESLTDA','A','S','N'),(295,6,'DIR. DE IMPUESTOS Y ADUANAS NACIONALES','N','','','','','','','','DIAN','A','S','N'),(296,6,'DISERCOM S.A. -MOBIL EL RODEO','N','830.046.00','AUTOPISTA NORTE-KM 20','6760183','','','','','DISERCOM','A','S','N'),(297,6,'E.D.S.PETROBRAS LA MILAGROSA','N','900182159-','','','','','','','PETROBRASL','A','S','N'),(298,6,'EBAY CAR - EBANISTERIA Y CARPINTERIA','N','','CALLE 10 N. 66A-42','2604755','','','','','EBAYCAR-EB','A','S','N'),(299,6,'EDIFICIO PORLAMAR P.H.','N','860.075.49','CLE 92 19-36','5303040','','','','','EDIFICIOPO','A','S','N'),(300,6,'EDS MERCASA','N','830095213','','','','','','','EDSMERCASA','A','S','N'),(301,6,'ELECTRILUCES  LTDA ','N','900322522-','CRA 12 16-34','6083901 2833484','ELECTRILUCES@HOTMAIL.COM','','','','ELECTRILUC','A','S','N'),(302,6,'EL TIEMPO SA','C','860599421','Av. El Dorado','277 775 775','','','','proveedor de publicaciones','ELTIEMPOSA','A','S','N'),(303,6,'ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','ENRIQUEMEL','A','S','N'),(304,6,'ENRIQUE GONZALEZ \"VIVERO LA ESTANCIA\"','N','860043771-','Cra 80  175-36   ','','','','','','ENRIQUEGON','A','S','N'),(305,6,'EQUIPOS DE OFICINA','N','','','','','','','','EQUIPOSDEO','A','S','N'),(306,6,'ESPACIOS Y SOLUCIONES SAS','N','830104599','CLE 116 15-20 ','6122983 6370873/76','espaciosysoluciones@gmail.com  ','','','','ESPACIOSYS','A','S','N'),(307,6,'ESPERANZA SANTACOLOMA','N','','','','','','','','ESPERANZAS','A','S','N'),(308,6,'ESSE CONNSULTORES','N','830137656-','','','','','','','ESSECONNSU','A','S','N'),(309,6,'ESSO EL RODEO DISERCOM S.A.','N','830046009-','','','','','','','ESSOELRODE','A','S','N'),(310,6,'ESTACION DE SCIO.LAS MARGARITAS','N','3264700-1','','','','','','','EDSLASMARG','A','S','N'),(311,6,'ESTACION DE SERVICIO BRIO BIMA','N','830.066.13','CARRERA 45 N.232-35','','','','','313-8893900','EDSBRIOBIM','A','S','N'),(312,6,'ESTACION DE SERVICIO COUNTRY','N','900.093.28','','','','','','','EDSCOUNTRY','A','S','N'),(313,6,'ESTACION DE SERVICIO EL CANELON CIA LTDA','N','830136907-','','','','','','','EDSELCANEL','A','S','N'),(314,6,'ESTACION DE SERVICIO MOBIL LA CARO','N','17108681','','','','','','','EDSMOBILLA','A','S','N'),(315,6,'ESTACION DESERVICIO EL CANELON Y CIA LTD','N','830.136.90','A.','','','','','','EDSELCANEL','A','S','N'),(316,6,'ESTACION RUMBOS LA CARO','N','830508167-','','','','','','','ESTACIONRU','A','S','N'),(317,6,'ESTACIONES DE PEAJE UTDVVCC','N','830059605-','','','','','','','ESTACIONES','A','S','N'),(318,6,'EMPRESA DE TELEFONOS DE BOGOTA','N','3777777','centro','3777777','info@etb.com','','','','ETB','A','S','N'),(319,6,'EVERNET SAS','N','900677172-','Cr. 1 D  31-38  Chía ','3142221757','evernetwireless@gmail.com','','','','EVERNETSAS','A','S','N'),(320,6,'FERNANDO GONZALEZ','N','80210671','','','','','','','FERNANDOGO','A','S','N'),(321,6,'FERREPLAST','N','','','','','','','','FERREPLAST','A','S','N'),(322,6,'FERRETERIA JOSE GOMEZ','N','19192006-6','','','','','','','FERRETERIA','A','S','N'),(323,6,'FERRETERIA LA LLAVE DEL NORTE','N','19310323','','','','','','','FERRETERIA','A','S','N'),(324,6,'FIDEICOMISO CONCESIONES CCFC S.A.','N','800256769-','','','','','','','FIDEICOMIS','A','S','N'),(325,6,'FIDEICOMISO FUDUCOLDEX','N','830054060-','','','','','','','FIDEICOMIS','A','S','N'),(326,6,'FIDEICOMISO PANAMERICANA','N','830053630-','','','','','','','FIDEICOMIS','A','S','N'),(327,6,'FIDUCIARIA CORFICOLOMBIANA','N','800140887-','','','','','','','FIDUCIARIA','A','S','N'),(328,6,'FUNDACIÓN SALDARRIAGA','N','860.038.33','','','','','','','FUNDACIÓNS','A','S','N'),(329,6,'GRUPO DE INVERSIONES N&R SAS ','N','900424448-','cra 15  78-33  local 276','3004839','www.grupnyr.com','','','','GRUPODEINV','A','S','N'),(330,6,'HABITAT STORE  SAS ','N','830086688-','av cra 45 183 A 70','6767777','','','','','HABITATSTO','A','S','N'),(331,6,'HÉCTOR GUTIÉRREZ GONZÁLEZ ','C','','','','','','','','HÉCTORGUTI','A','S','N'),(332,6,'(Héctor Gut.Gonz). HOME CENTER (SODIMAC COL.SA)','N','800242106-','','','','','','','HOMECENTER','A','S','N'),(333,6,'HENAO LUNA EU','N','900.241.02','','','','','','','HENAOLUNAE','A','S','N'),(334,6,'HIDROMET LTDA','','','','','','','','','HIDROMETLT','A','S','N'),(335,6,'HOMECENTER SODIMAC COLOMBIA S.A.','N','800242106-','','','','','','','SODIMAC','A','S','N'),(336,6,'HOTEL CHICALA','N','891101711-','','','','','','','HOTELCHICA','A','S','N'),(337,6,'HOTEL SEBASTIAN','N','R.U.C.1790','DIEGO DE ALMAGRO 822','','','','','QUITO - ECUADOR','HOTELSEBAS','A','S','N'),(338,6,'IGNACIO TURBAY','N','','','','','','','','IGNACIOTUR','A','S','N'),(339,6,'INES RUBIANO','C','8050154','','','','','','','INESRUBIAN','A','S','N'),(340,6,'INGENIERÍA DE ESTRUCTURAS Y CONSTRUCCION SAS ','N','900199597-','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','INGESTRUCT','A','S','N'),(341,6,'INSTITUTO DE SEGUROS SOCIALES','N','','','','','','','','INSTITUTOD','A','S','N'),(342,6,'INSTITUTO NACIONAL DE VIAS','N','800215807-','','','','','','','INSTITUTON','A','S','N'),(343,6,'INVERSET BOTERO GOMEZ Y CIA','N','816004255-','HOSTAL HACIENDA MALABAR','','','','','','INVERSETBO','A','S','N'),(344,6,'INVERSIONES EL CIPRES COLOMBIA S.A.','N','811.032.44','CALLE 94 N. 12-55','','','','','','INVERSIONE','A','S','N'),(345,6,'INVERSIONES LEAL S.A.','N','900016780-','','','','','','','INVERSIONE','A','S','N'),(346,6,'INVERSIONES LIBRA S.A. COSMOS 100','N','860048182-','','','','','','','INVERSIONE','A','S','N'),(347,6,'IROTAMA S.A.','N','891700612-','','','','','','','IROTAMA','A','S','N'),(348,6,'JAIME URIBE BOTERO','N','','','','','','','','JAIMEURIBE','A','S','N'),(349,6,'JAVIER PARRA','N','805010511','','','','','','','JAVIERPARR','A','S','N'),(350,6,'JORGE  ELIÉCER  BOLIVAR ALFARO ','N','19245461-3','CL 163 B  48 34 AP 201','8636277 3107683925','gerencia@construccionesjorgebolivar ','','','','JORGEELIÉC','A','S','N'),(351,6,'JOSÉ NICOLÁS SERNA ','C','3150893','','3134909804','','','','','JOSÉNICOLÁ','A','S','N'),(352,6,'JUAN CARLOS DIAZ','N','79758019','','','','','','','JUANCARLOS','A','S','N'),(353,6,'JUAN CARLOS DOBLADO CÁRDENAS ','N','79980860','AV PRADILLA 5 62  CHÍA  CUND.','8630283 3107994599','jcdoblado@hotmail.com','','','','JUANCARLOS','A','S','N'),(354,6,'JUAN PABLO KOUSEN','C','79186474','','','','','','','JUANPABLOK','A','S','N'),(355,6,'JULIAN ARANA','N','94487211','','','','','','','JULIANARAN','A','S','N'),(356,6,'JULIO BORDA G. SUPER EST.TEXACO 10','N','2917960-1','','','','','','','JULIOBORDA','A','S','N'),(357,6,'JULIO FLOREZ','N','19146712','','','','','','','JULIOFLORE','A','S','N'),(358,6,'JULIO FONTAN Y CÍA','N','800.217.63','','','','','','','JULIOFONTA','A','S','N'),(359,6,'HÉCTOR GUTIÉRREZ GONZÁLEZ+B19  Arquitecto','C','17020239','','','','','','','HÉCTORGUTI','A','S','N'),(360,6,'KATA S.A.S','N','830047411-','','','','','','','KATAS.A.S','A','S','N'),(361,6,'LAO KAO S.A.','N','830047537-','','','','','','','LAOKAOS.A.','A','S','N'),(362,6,'LAS CUADRAS TERRENO CAJICÁ C/MARCA.','N','','','','','','','MATR.176-40270 MATR.176-40271','LASCUADRAS','A','S','N'),(363,6,'LEASING BANCOLOMBIA  SA ','N','860059294-','CR 48 26 85 TORRE NORTE PISO 1','','','','','','LEASINGBAN','A','S','N'),(364,6,'LIBERTY SEGUROS S.A.','N','860.039.96','','','','','','','LIBERTYSEG','A','S','N'),(365,6,'LIBRERIA NACIONAL S.A.','N','','','','','','','','LIBRERIANA','A','S','N'),(366,6,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(367,6,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(368,6,'LIGHTS DESIGN','N','1020735710','Cle 65  13-61 ','3573828 5411846','ligthsdesigncolombia@gmail.com','','','','LIGHTSDESI','A','S','N'),(369,6,'LISANDRO ACOSTA GONZÁLEZ (Electrogas del Llano)','C','4284616-1','Cle 15 1015 Chía centro','88584017 3106192008','','','','','LISANDROAC','A','S','N'),(370,6,'LOS TRES ELEFANTES ','N','860030478-','Cento Chía local 1170','','','','','','LOSTRESELE','A','S','N'),(371,6,'LOTA LA ESTACADA','N','','','','','','','','LOTALAESTA','A','S','N'),(372,6,'LUBRICANTES LA ISLA-MARIA MYRIAM VALCARC','N','41534714','EL MANRIQUE','','','','','','LUBRICANTE','A','S','N'),(373,6,'LUBRISERVICIOS KIKO E/S ESSO COUNTRY','N','51898765','','','','','','','LUBRISERVI','A','S','N'),(374,6,'LUIS ALBERTO CADENA','N','79147302','','','','','','','LUISALBERT','A','S','N'),(375,6,'LUIS GUINARD','N','','','','','','','','LUISGUINAR','A','S','N'),(376,6,'LUIS HUMBERTO GAMBA V.','N','3163305-1','','','','','','','LUISHUMBER','A','S','N'),(377,6,'MARIA ELIZA HERRERA','N','','','','','','','','MARIAELIZA','A','S','N'),(378,6,'MARIA ELVIRA PARDO O.','N','','','','','','','','MARIAELVIR','A','S','N'),(379,6,'MARIA MYRIAM VALCARCEL MANRIQUE','N','41534714-1','','','','','','','MARIAVALCA','A','S','N'),(380,6,'MAURICIO PARDO KOPPEL','N','17130450','CLE. 92 19-36 OFN.301','6114112 6348156 6348157','','','','ACT.PPAL.7421 ACT.SEC. 0010','MAURICIOPA','A','S','N'),(381,6,'MECANICA AUTOMOTRIZ - ALFREDO MOTOR.COM','N','79388361','CALLE 91 N. 39-37','','','','','','MECANICAAU','A','S','N'),(382,6,'MERCA','N','0','','','','','','','MERCA','A','S','N'),(383,6,'MIGUEL CRUZ','N','19253448','','','','','','','MIGUELCRUZ','A','S','N'),(384,6,'MIGUEL FELIPE COTTS','N','17151077','','','','','','','MIGUELFELI','A','S','N'),(385,6,'MINISTERIO DE CULTURA','N','899999066','','','','','','','MINISTERIO','A','S','N'),(386,6,'MOLINO DE LA FLORIDA S.A.','N','','','','','','','','MOLINODELA','A','S','N'),(387,6,'MOVISTAR','N','1234566','CAN','4545','ventas@movistar.com.co','','','Telefonia empresarial','MOVISTAR','A','S','N'),(388,6,'MPKSAS - EMPRESA','N','','','','','','','','MPKSAS-EMP','A','S','N'),(389,6,'MUEBLES Y ENSERES CASA-OFICINA','N','','','','','','','','MUEBLESYEN','A','S','N'),(390,6,'NAVAS&NAVAS-ALAMCEN DE ARTE','N','800120675-','','','','','','','NAVAS&NAVA','A','S','N'),(391,6,'NOTARIA 25 DEL CIRCUITO DE BOGOTA D.C...','N','21069048','','','','','','','NOTARIA25','A','S','N'),(392,6,'NOTARIA 42 DE BOGOTA','N','23268456','','','','','','','NOTARIA42D','A','S','N'),(393,6,'NOTARIA NOVENA DE BOGOTA','N','11371163','','','','','','','NOTARIANOV','A','S','N'),(394,6,'OLGA LEONOR DE BRIGARD','N','39790002','','','','','','','OLGALEONOR','A','S','N'),(395,6,'OPENVIAS LTDA','N','830054076-','','','','','','','OPENVIASLT','A','S','N'),(396,6,'ORLANDO MENDEZ','N','80017590','','','','','','','ORLANDOMEN','A','S','N'),(397,6,'OSCAR BOLÍVAR RINCÓN ','C','79981828','','','','','','','OSCARBOLÍV','A','S','N'),(398,6,'OSCAR ISAZA','N','','','','','','','','OSCARISAZA','A','S','N'),(399,6,'OVER CHICO TOURS LTDA','N','800.202.05','','','','','','','OVERCHICOT','A','S','N'),(400,6,'PANAMERICANA LIBRERIA Y PAPELERIA S.A.','N','830.037.94','','','','','','','PANAMERICA','A','S','N'),(401,6,'PARCEALCIÓN MOLINO LA FLORIDA ','N','900243304-','','3166365613','','','','','PARCEALCIÓ','A','S','N'),(402,6,'PARKING INTERNATIONAL LTDA.','N','860.058.76','','','','','','','PARKINGINT','A','S','N'),(403,6,'PARQUEADERO TORRES 47 GOMEZ AMPARO','N','20302596-7','','','','','','','PARQUEADER','A','S','N'),(404,6,'PARQUEQDERO ACLA','N','860532264-','','','','','','','PARQUEQDER','A','S','N'),(405,6,'PEAJE LOS PATIOS','N','830132323-','','','','','','','PEAJELOSPA','A','S','N'),(406,6,'PEDRO PABLO VARGAS ','C','321422','','','','','','','PEDROPABLO','A','S','N'),(407,6,'PERIODICOS LTDA.','N','','','','','','','','PERIODICOS','A','S','N'),(408,6,'PUDONG LTDA','N','900.113.79','','','','','','','PUDONGLTDA','A','S','N'),(409,6,'Rafael Cortés Daza','C','2859469','','','','','','','RafaelCort','A','S','N'),(410,6,'RAFAEL A CORREDOR B. ABC  de los MUEBLES ','N','18004263-4','cra 27  12-39','2084141 2257157','ventasabcmuebles@hotmail.com','','','Reg. Común','RAFAELACOR','A','S','N'),(411,6,'RAÚL CAMACHO ALFONSO (ING. DE ESTR.Y CONSTR.) ','C','19109035','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','RAÚLCAMACH','A','S','N'),(412,6,'RESTAURANTE SAN ALEJO-BEATRIZ NIÑO DE H.','N','20252749','DIAG. 6 N.3-35 CAJICA','8660691','','','','DIAG. 6 N.3-35 CAJICA','RESTAURANT','A','S','N'),(413,6,'RESTAURANTE ZOE S.A.','N','','','','','','','','RESTAURANT','A','S','N'),(414,6,'RICARDO CARVAJAL ORTIZ ','N','79537297-3','DIAG 49 F BIS SUR 6 33 AP 101','6969846 3133718580','ricardocarvajal@yahoo.com','','','Rég. Simpl.','RICARDOCAR','A','S','N'),(415,6,'RODRIGO OSPINA','N','8241088','','','','','','','RODRIGOOSP','A','S','N'),(416,6,'RODRIGO PARDO K.','N','','','','','','','','RODRIGOPAR','A','S','N'),(417,6,'RUDOLFF DIAZ LOPEZ','N','80076610-0','','','','','','','RUDOLFFDIA','A','S','N'),(418,6,'SAAD Y CIA C.S.A. (SERVICENTRO 3er.p)','N','800.006.07','','','','','','','SAADYCIAC','A','S','N'),(419,6,'SECRETARÍA DE HACIENDA CARTAGENA','N','','','','','','','','SEHDACARTA','A','S','N'),(420,6,'SECRETARIA DE HACIENDA DE BOGOTA','N','','','','','','','','SECRETARIA','A','S','N'),(421,6,'SECRETARIA DE HACIENDA MUNICIPAL CAJICA','N','899.999.46','','','','','','','SHDAMUNICI','A','S','N'),(422,6,'SERVICIO ESSO MIROLINDO','N','14201328','','','','','','','SERVICIOES','A','S','N'),(423,6,'SERVIENTREGA','N','860.512.33','','','','','','','SERVIENTRE','A','S','N'),(424,6,'SERVIPLETTER FELIX DIAZ D.','N','19239900','','','','','','','SERVIPLETT','A','S','N'),(425,6,'SUPERPLOTTER - RUDOLFF DIAZ LOPEZ','N','80076610','CALLE 98 N. 15-28','2572505','','','','','SUPERPLOTT','A','S','N'),(426,6,'TEJIDOS GAVIOTA SAS (INNOVACIÓN TEXTIL)','N','800067448-','cra 50 79-55','2312535 2400820','','','','','TEJIDOSGAV','A','S','N'),(427,6,'TEJIDOS LAV','N','860000867-','Av 19 114 A-05 /Cra 5A 4-88 Sur Caj.E56 ','','','','','','TEJIDOSLAV','A','S','N'),(428,6,'TELMEX HOGAR S.A.','N','830053,8','CARRERA 11 N. 94-76','','','','','','TELMEXHOGA','A','S','N'),(429,6,'TERRAKOT SAS ','N','900532394-','CLE 92 19-36 OF 301','','','','','','TERRAKOTSA','A','S','N'),(430,6,'TERPEL- ESTACION DE SERVICIO ORO NEGRO L','N','832.006.76',',','','','','','','TERPELORON','A','S','N'),(431,6,'TEXACO 20 EL COMUN','N','','','','','','','','TEXACO20EL','A','S','N'),(432,6,'TEXTURAS Y MATICES  SA ','N','800066571-','Autp Norte paralela 88-49','2569090 2569128','','','','','TEXTURASYM','A','S','N'),(433,6,'TRANSPORTE Y PARQUEO LTDA.','N','900.192.41','','','','','','','TRANSPORTE','A','S','N'),(434,6,'TUGO SAS ','N','830087848-','','2405880 OPC.2','','','','','TUGOSAS','A','S','N'),(435,6,'ULTRABURSÁTILES','N','','','','','','','','ULTRABURSÁ','A','S','N'),(436,6,'ULTRAVALORES','N','','','','','','','','ULTRAVALOR','A','S','N'),(437,6,'UNIANDINOS','N','','','','','','','','UNIANDINOS','A','S','N'),(438,6,'UNION TEMPORAL DEVINORTE','N','830002623','','','','','','','DEVINORTE','A','S','N'),(439,6,'UNIVERSIDAD TECNOLOGICA DE BOLIVAR','N','890.401.96','','','','','','','UTECNOLOGI','A','S','N'),(440,6,'VIVERO LA ESTANCIA  Enrique González ','N','860043771-','Cra 80  175-36   ','6732971 6711465','viverolaestancia@gmail.com ','','','','VIVEROLAES','A','S','N'),(441,6,'VIVERO LA FLORIDA','N','80501054','','','','','','','VIVEROLAFL','A','S','N'),(442,6,'XICOM TECMOLOGY','N','','','3103039730','','','','','XICOM','A','S','N'),(443,4,'AGRICOLA PARRILLA S.A.S','N','900722569-','','','','','','','AGRICOPARR','A','S','N'),(444,4,'ACADEMIA COLOMBIANA DE ARQUITECTURA Y D','N','830142801-','','','','','','','ACA','A','S','N'),(445,4,'ACUAGRANJA LTDA.','N','890.324.48','AVENIDA 13 N. 137-50','6153344','','','','','ACUAGRANJA','A','S','N'),(446,4,'ACUEDUCTO Y ALCANTARILLADO DE BOGOTA','N','','','','','','','','AAB','A','S','N'),(447,4,'ADRIANA TORRES ARTUNDUAGA FOTOCOPIAS CHI','N','51815901-5','','','','','','','COPIASCHI','A','S','N'),(448,4,'AIRES','N','','','','','','','','AIRES','A','S','N'),(449,4,'AGROINSUMOS LOS PINOS  SAS','N','800090263-','Centro ChÃ­a locales 1109-1110','8616330  3124477647','','','','','AGROINSUMO','A','S','N'),(450,4,'ALCALDÍA MUNICIPAL DE CAJICÁ ','','','','','','','','','ALCCAJICÁ','A','S','N'),(451,4,'ALCALDÍA MAYOR DE BOGOTA D.C. INSTITUTO','N','899.999.08','DESARROLLO URBANO','','','','','','ALCBOGOTA','A','S','N'),(452,4,'ALDICOM OPERADORES LTDA-','N','830060549','','','','','','','ALDICOM','A','S','N'),(453,4,'ALFAGRES','N','','','','','','','','ALFAGRES','A','S','N'),(454,4,'ALFREDO LOPEZ VELANDIA','N','4.178.722-','CARRERA 13A N. 89-38 OF.','6185727','','','',' ','ALFLOPEZ','A','S','N'),(455,4,'ALMACEN EL ARQUITECTO SAS','N','860000054-','cra 11   80-45','5304010','ventas@alamacenelarquitectosa.com','','','','ARQUITECTO','A','S','N'),(456,4,'ALMACENES EXITO S.A.','N','','','','','','','','EXITOS.A.','A','S','N'),(457,4,'ALKOSTO SA C0LOMBIANA DE COMERCIA SA ','N','890900943-','Av cra 68 73 43','4376868','','','','','ALKOSTO','A','S','N'),(458,4,'ANACAONA AGCIA.DE VIAJES Y TURISMO','N','12141467-4','','','','','','','ANACAONA','A','S','N'),(459,4,'ANA CECILIA VARGAS   SALOTTY HUMBERTO DÍAZ','N','39635194-8','cra 50  78-14 ','4876789 3108599668 4910268','','','','Reg común','ANACECILIA','A','S','N'),(460,4,'ÁNGELA MARÍA ORTIZ CABAL','N','38860299','CLE. 92 19-36 AP.301','6114112 6348156 6348157','','','','ACT.PPAL. ACT.SEC.','ÁNGELAMARÍ','A','S','N'),(461,4,'APARCAR LTDA.','N','860.503.56','CALLE 84 N. 20-10','6369866','','','','','APARCAR','A','S','N'),(462,4,'APARTAMENTO CALLE 92 19-36','N','','CLE 92 19-36','','','','','MATR.APTO 50 C 361951 MATR.GARJ 50 C 361943','APCALLE92','A','S','N'),(463,4,'ARTURO CALLE','N','2.913.770-','','','','','','','ARTUROCALL','A','S','N'),(464,4,'AUTOLAVADO EL GRAN BARON','N','53055236','ADRIANA BARON ROZO','','','','','','AUTOLAVADO','A','S','N'),(465,4,'AUTOMÓVIL NISSAN SENTRA 2.002','N','','','','','','','PLACA BOD045','AUTONISSAN','A','S','N'),(466,4,'AVIANCA','N','','','','','','','','AVIANCA','A','S','N'),(467,4,'BAMLUZ  cortinas y pisos ','N','900408744-','Av cra 68 68-43','2400075','ventas@bamluz.com','','','','BAMLUZ','A','S','N'),(468,4,'BANCO DE BOGOTA','N','','','','','','','','BCOBOGOTA','A','S','N'),(469,4,'BANCO SANTANDER','N','','','','','','','','BCOSANTAND','A','S','N'),(470,4,'BRISSA CLUB           ','N','800161656-','Cra 52  10-80 ','7430875','servicioalacliente@brissa.com.co','','','','BRISSACLUB','A','S','N'),(471,4,'CÁMARA DE COMERCIO DE BOGOTÁ ','N','860007322-','CRA 15 CLE 93 SEDE NORTE ','','','','','','CCB','A','S','N'),(472,4,'CARLOS ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','CARLOMELO','A','S','N'),(473,4,'CARLOS JULIO SALAMANCA ','C','19260511','','','','','','','CARLOSSALA','A','S','N'),(474,4,'CARULLA VIVERO S.A. CHICO','N','860.002.09','','','','','','','CARULLA','A','S','N'),(475,4,'CENCOSUD COLOMBIA SA','N','900155107-','ave Pradilla 2 E 71','8611000','','','','','CENCOSUD','A','S','N'),(476,4,'CENTRAL PARKING SYSTEM COL LTDA.','N','830.087.09','CALLE 93 N. 13-19','6361113','','','','','CENTRALPAR','A','S','N'),(477,4,'CENTRO COMERCIAL ANDINO','N','800199501-','','','','','','','CCOMERCIAL','A','S','N'),(478,4,'CENTRO COMERCIAL SANTAFE','N','900083038-','','','','','','','CCIALSANTA','A','S','N'),(479,4,'CENTRO DE DIAGN.AUTOMOTOR DE LA SABANA S.A','N','900.084.96','','','','','','','DIAGNDELAS','A','S','N'),(480,4,'CENTRO RURAL SOFIA KOPPEL','N','860020425','Jorge Bolivar Alfaro','','','','','C.C. 19.245.461','CTRORURAL','A','S','N'),(481,4,'CERRADURAS INTER ATLANTICA LTDA','N','830.097.85','','','','','','','CERRADURAS','A','S','N'),(482,4,'CITY PARKING','N','830050619-','','','','','','','CITYPARKIN','A','S','N'),(483,4,'CIUDADELA CCIAL UNICDENTRO','N','860048836-','','','','','','','CIUDADELAC','A','S','N'),(484,4,'CLUB CAMPESTRE PEREIRA','N','','','','','','','','CLUBCAMPES','A','S','N'),(485,4,'CODENSA ESP.','N','830.037.24','','','','','','','CODENSAESP','A','S','N'),(486,4,'COLSANITAS','N','860078828','','','','','','','COLSANITAS','A','S','N'),(487,4,'COMBUSTIBLES DE COLOMBIA S.A. - TEXACO E','N','830.513.72','L COMUN','6760241','','','','AUTOPISTA NORTE KM 20','TEXACOE','A','S','N'),(488,4,'COMCEL S.A.','N','800.153.99','','','','','','','COMCELS.A.','A','S','N'),(489,4,'COMERCIAL PAPELERA','N','860.528.39','','','','','','','COMERCIALP','A','S','N'),(490,4,'COMERCIALIZADORA RUMBOS','N','830.508.16','','','','','','','COMERCIALI','A','S','N'),(491,4,'COMPAÑIAS ASOCIADAS DE GAS S.A. E.S.P.','N','800.074.03','','','','','','','CIAASOCIAD','A','S','N'),(492,4,'COMPENSAR','N','860066942-','','','','','','','COMPENSAR','A','S','N'),(493,4,'CONCESION BRICENO TUNJA SOGAMOSO','N','830052998-','','','','','','','CONCESIONB','A','S','N'),(494,4,'CONCESIONARIA SAN RAFAEL S.A.','N','','','','','','','','CONCESIONA','A','S','N'),(495,4,'CONCESION NEIVA GIRARDOT','N','5199222','','','','','','','CONCESIONN','A','S','N'),(496,4,'CONSTRUCCIONES JORGE BOLÍVAR ','N','900323576-','','','','','','','CONSTRUCCI','A','S','N'),(497,4,'CONRADO BETANCOURT','N','','','','','','','','CONRADOBET','A','S','N'),(498,4,'COPIAS CHICO','N','51608610','','','','','','','COPIASCHIC','A','S','N'),(499,4,'COPYPLOTTER Y ENVIOS-CARLOS ERNESTO MORE','N','19477828','NO FORERO','','','','','','COPYPLOTTE','A','S','N'),(500,4,'CORPORACION CLUB CAMPESTRE DE PEREIRA','N','891400467-','','','','','','','CORPORACIO','A','S','N'),(501,4,'CORREA CARO ABELLA & CIA LTDA.','N','860.352.46','CALLE 71 N, 5-41','2170011','','','','','CORREACARO','A','S','N'),(502,4,'CORREDOR HNOS. & ASOCIADOS LTDA','N','860.032.68','CALLE 59A N. 8-83','2356166','','','','','CORREDORHN','A','S','N'),(503,4,'CREPRES & WAFFLES S.A.','N','860.076.91','','','','','','','CREPRES&WA','A','S','N'),(504,4,'CRUZ ROJA COLOMBIANA','N','','','','','','','','CRUZROJACO','A','S','N'),(505,4,'CHIMENEAS DE COLOMBIA  ','C','35199155','','','','','','','CHIMENEASD','A','S','N'),(506,4,'DAVID GUTIÉRREZ BUITRAGO','N','17139692-7','','','','','','','DAVIDGUTIÉ','A','S','N'),(507,4,'DECORCERÁMICA ','N','800165377','autop norte cle 135  45-16 ','7433838','','','','','DECORCERÁM','A','S','N'),(508,4,'D H L EXPRESS COLOMBIA LTDA.','N','860.502.60','','','','','','','DHLEXPRESS','A','S','N'),(509,4,'DEPRISA - AVIANCA','N','890.100.57','','','','','','','DEPRISA','A','S','N'),(510,4,'DEVINORTE','','6760652','','6760652','','','','','DEVINORTE','A','S','N'),(511,4,'DIAGNOSTIAUTOS S.A.','N','830130337-','','','','','','','DIAGNOSTIA','A','S','N'),(512,4,'DIEGO JAVIER BARAJAS P.','N','79862748-6','cra 40 25 21 ap 111','3173419428','sigmaarquitecto@yahoo.com.ar','','','Rég.Simp.','DIEGOJAVIE','A','S','N'),(513,4,'DIEGO PARDO KOPPEL','N','','','','','','','','DIEGOPARDO','A','S','N'),(514,4,'DIEGO PUENTES','C','79504216','','','','','','','DIEGOPUENT','A','S','N'),(515,4,'DIGUES LTDA ','N','800112126-','Av Cra 30  88 A 19','6353041 3144618625','','','','','DIGUESLTDA','A','S','N'),(516,4,'DIR. DE IMPUESTOS Y ADUANAS NACIONALES DIAN','N','111','','','','','','','DIAN','A','S','N'),(517,4,'DISERCOM S.A. -MOBIL EL RODEO','N','830.046.00','AUTOPISTA NORTE-KM 20','6760183','','','','','DISERCOM','A','S','N'),(518,4,'E.D.S.PETROBRAS LA MILAGROSA','N','900182159-','','','','','','','PETROBRASL','A','S','N'),(519,4,'EBAY CAR - EBANISTERIA Y CARPINTERIA','N','','CALLE 10 N. 66A-42','2604755','','','','','EBAYCAR-EB','A','S','N'),(520,4,'EDIFICIO PORLAMAR P.H.','N','860.075.49','CLE 92 19-36','5303040','','','','','EDIFICIOPO','A','S','N'),(521,4,'EDS MERCASA','N','830095213','','','','','','','EDSMERCASA','A','S','N'),(522,4,'ELECTRILUCES  LTDA ','N','900322522-','CRA 12 16-34','6083901 2833484','ELECTRILUCES@HOTMAIL.COM','','','','ELECTRILUC','A','S','N'),(523,4,'EL TIEMPO SA','C','860599421','Av. El Dorado','277 775 775','','','','proveedor de publicaciones','ELTIEMPOSA','A','S','N'),(524,4,'ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','ENRIQUEMEL','A','S','N'),(525,4,'ENRIQUE GONZALEZ \"VIVERO LA ESTANCIA\"','N','860043771-','Cra 80  175-36   ','','','','','','ENRIQUEGON','A','S','N'),(526,4,'EQUIPOS DE OFICINA','N','','','','','','','','EQUIPOSDEO','A','S','N'),(527,4,'ESPACIOS Y SOLUCIONES SAS','N','830104599','CLE 116 15-20 ','6122983 6370873/76','espaciosysoluciones@gmail.com  ','','','','ESPACIOSYS','A','S','N'),(528,4,'ESPERANZA SANTACOLOMA','N','','','','','','','','ESPERANZAS','A','S','N'),(529,4,'ESSE CONNSULTORES','N','830137656-','','','','','','','ESSECONNSU','A','S','N'),(530,4,'ESSO EL RODEO DISERCOM S.A.','N','830046009-','','','','','','','ESSOELRODE','A','S','N'),(531,4,'ESTACION DE SCIO.LAS MARGARITAS','N','3264700-1','','','','','','','EDSLASMARG','A','S','N'),(532,4,'ESTACION DE SERVICIO BRIO BIMA','N','830.066.13','CARRERA 45 N.232-35','','','','','313-8893900','EDSBRIOBIM','A','S','N'),(533,4,'ESTACION DE SERVICIO COUNTRY','N','900.093.28','','','','','','','EDSCOUNTRY','A','S','N'),(534,4,'ESTACION DE SERVICIO EL CANELON CIA LTDA','N','830136907-','','','','','','','EDSELCANEL','A','S','N'),(535,4,'ESTACION DE SERVICIO MOBIL LA CARO','N','17108681','','','','','','','EDSMOBILLA','A','S','N'),(536,4,'ESTACION DESERVICIO EL CANELON Y CIA LTD','N','830.136.90','A.','','','','','','EDSELCANEL','A','S','N'),(537,4,'ESTACION RUMBOS LA CARO','N','830508167-','','','','','','','ESTACIONRU','A','S','N'),(538,4,'ESTACIONES DE PEAJE UTDVVCC','N','830059605-','','','','','','','ESTACIONES','A','S','N'),(539,4,'EMPRESA DE TELEFONOS DE BOGOTA','N','3777777','centro','3777777','info@etb.com','','','','ETB','A','S','N'),(540,4,'EVERNET SAS','N','900677172-','Cr. 1 D  31-38  Chía ','3142221757','evernetwireless@gmail.com','','','','EVERNETSAS','A','S','N'),(541,4,'FERNANDO GONZALEZ','N','80210671','','','','','','','FERNANDOGO','A','S','N'),(542,4,'FERREPLAST','N','','','','','','','','FERREPLAST','A','S','N'),(543,4,'FERRETERIA JOSE GOMEZ','N','19192006-6','','','','','','','FERRETERIA','A','S','N'),(544,4,'FERRETERIA LA LLAVE DEL NORTE','N','19310323','','','','','','','FERRETERIA','A','S','N'),(545,4,'FIDEICOMISO CONCESIONES CCFC S.A.','N','800256769-','','','','','','','FIDEICOMIS','A','S','N'),(546,4,'FIDEICOMISO FUDUCOLDEX','N','830054060-','','','','','','','FIDEICOMIS','A','S','N'),(547,4,'FIDEICOMISO PANAMERICANA','N','830053630-','','','','','','','FIDEICOMIS','A','S','N'),(548,4,'FIDUCIARIA CORFICOLOMBIANA','N','800140887-','','','','','','','FIDUCIARIA','A','S','N'),(549,4,'FUNDACIÓN SALDARRIAGA','N','860.038.33','','','','','','','FUNDACIÓNS','A','S','N'),(550,4,'GRUPO DE INVERSIONES N&R SAS ','N','900424448-','cra 15  78-33  local 276','3004839','www.grupnyr.com','','','','GRUPODEINV','A','S','N'),(551,4,'HABITAT STORE  SAS ','N','830086688-','av cra 45 183 A 70','6767777','','','','','HABITATSTO','A','S','N'),(552,4,'HÉCTOR GUTIÉRREZ GONZÁLEZ ','C','','','','','','','','HÉCTORGUTI','A','S','N'),(553,4,'(Héctor Gut.Gonz). HOME CENTER (SODIMAC COL.SA)','N','800242106-','','','','','','','HOMECENTER','A','S','N'),(554,4,'HENAO LUNA EU','N','900.241.02','','','','','','','HENAOLUNAE','A','S','N'),(555,4,'HIDROMET LTDA','','','','','','','','','HIDROMETLT','A','S','N'),(556,4,'HOMECENTER SODIMAC COLOMBIA S.A.','N','800242106-','','','','','','','SODIMAC','A','S','N'),(557,4,'HOTEL CHICALA','N','891101711-','','','','','','','HOTELCHICA','A','S','N'),(558,4,'HOTEL SEBASTIAN','N','R.U.C.1790','DIEGO DE ALMAGRO 822','','','','','QUITO - ECUADOR','HOTELSEBAS','A','S','N'),(559,4,'IGNACIO TURBAY','N','','','','','','','','IGNACIOTUR','A','S','N'),(560,4,'INES RUBIANO','C','8050154','','','','','','','INESRUBIAN','A','S','N'),(561,4,'INGENIERÍA DE ESTRUCTURAS Y CONSTRUCCION SAS ','N','900199597-','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','INGESTRUCT','A','S','N'),(562,4,'INSTITUTO DE SEGUROS SOCIALES','N','','','','','','','','INSTITUTOD','A','S','N'),(563,4,'INSTITUTO NACIONAL DE VIAS','N','800215807-','','','','','','','INSTITUTON','A','S','N'),(564,4,'INVERSET BOTERO GOMEZ Y CIA','N','816004255-','HOSTAL HACIENDA MALABAR','','','','','','INVERSETBO','A','S','N'),(565,4,'INVERSIONES EL CIPRES COLOMBIA S.A.','N','811.032.44','CALLE 94 N. 12-55','','','','','','INVERSIONE','A','S','N'),(566,4,'INVERSIONES LEAL S.A.','N','900016780-','','','','','','','INVERSIONE','A','S','N'),(567,4,'INVERSIONES LIBRA S.A. COSMOS 100','N','860048182-','','','','','','','INVERSIONE','A','S','N'),(568,4,'IROTAMA S.A.','N','891700612-','','','','','','','IROTAMA','A','S','N'),(569,4,'JAIME URIBE BOTERO','N','','','','','','','','JAIMEURIBE','A','S','N'),(570,4,'JAVIER PARRA','N','805010511','','','','','','','JAVIERPARR','A','S','N'),(571,4,'JORGE  ELIÉCER  BOLIVAR ALFARO ','N','19245461-3','CL 163 B  48 34 AP 201','8636277 3107683925','gerencia@construccionesjorgebolivar ','','','','JORGEELIÉC','A','S','N'),(572,4,'JOSÉ NICOLÁS SERNA ','C','3150893','','3134909804','','','','','JOSÉNICOLÁ','A','S','N'),(573,4,'JUAN CARLOS DIAZ','N','79758019','','','','','','','JUANCARLOS','A','S','N'),(574,4,'JUAN CARLOS DOBLADO CÁRDENAS ','N','79980860','AV PRADILLA 5 62  CHÍA  CUND.','8630283 3107994599','jcdoblado@hotmail.com','','','','JUANCARLOS','A','S','N'),(575,4,'JUAN PABLO KOUSEN','C','79186474','','','','','','','JUANPABLOK','A','S','N'),(576,4,'JULIAN ARANA','N','94487211','','','','','','','JULIANARAN','A','S','N'),(577,4,'JULIO BORDA G. SUPER EST.TEXACO 10','N','2917960-1','','','','','','','JULIOBORDA','A','S','N'),(578,4,'JULIO FLOREZ','N','19146712','','','','','','','JULIOFLORE','A','S','N'),(579,4,'JULIO FONTAN Y CÍA','N','800.217.63','','','','','','','JULIOFONTA','A','S','N'),(580,4,'HÉCTOR GUTIÉRREZ GONZÁLEZ+B19  Arquitecto','C','17020239','','','','','','','HÉCTORGUTI','A','S','N'),(581,4,'KATA S.A.S','N','830047411-','','','','','','','KATAS.A.S','A','S','N'),(582,4,'LAO KAO S.A.','N','830047537-','','','','','','','LAOKAOS.A.','A','S','N'),(583,4,'LAS CUADRAS TERRENO CAJICÁ C/MARCA.','N','','','','','','','MATR.176-40270 MATR.176-40271','LASCUADRAS','A','S','N'),(584,4,'LEASING BANCOLOMBIA  SA ','N','860059294-','CR 48 26 85 TORRE NORTE PISO 1','','','','','','LEASINGBAN','A','S','N'),(585,4,'LIBERTY SEGUROS S.A.','N','860.039.96','','','','','','','LIBERTYSEG','A','S','N'),(586,4,'LIBRERIA NACIONAL S.A.','N','','','','','','','','LIBRERIANA','A','S','N'),(587,4,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(588,4,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(589,4,'LIGHTS DESIGN','N','1020735710','Cle 65  13-61 ','3573828 5411846','ligthsdesigncolombia@gmail.com','','','','LIGHTSDESI','A','S','N'),(590,4,'LISANDRO ACOSTA GONZÁLEZ (Electrogas del Llano)','C','4284616-1','Cle 15 1015 Chía centro','88584017 3106192008','','','','','LISANDROAC','A','S','N'),(591,4,'LOS TRES ELEFANTES ','N','860030478-','Cento Chía local 1170','','','','','','LOSTRESELE','A','S','N'),(592,4,'LOTA LA ESTACADA','N','','','','','','','','LOTALAESTA','A','S','N'),(593,4,'LUBRICANTES LA ISLA-MARIA MYRIAM VALCARC','N','41534714','EL MANRIQUE','','','','','','LUBRICANTE','A','S','N'),(594,4,'LUBRISERVICIOS KIKO E/S ESSO COUNTRY','N','51898765','','','','','','','LUBRISERVI','A','S','N'),(595,4,'LUIS ALBERTO CADENA','N','79147302','','','','','','','LUISALBERT','A','S','N'),(596,4,'LUIS GUINARD','N','','','','','','','','LUISGUINAR','A','S','N'),(597,4,'LUIS HUMBERTO GAMBA V.','N','3163305-1','','','','','','','LUISHUMBER','A','S','N'),(598,4,'MARIA ELIZA HERRERA','N','','','','','','','','MARIAELIZA','A','S','N'),(599,4,'MARIA ELVIRA PARDO O.','N','','','','','','','','MARIAELVIR','A','S','N'),(600,4,'MARIA MYRIAM VALCARCEL MANRIQUE','N','41534714-1','','','','','','','MARIAVALCA','A','S','N'),(601,4,'MAURICIO PARDO KOPPEL','N','17130450','CLE. 92 19-36 OFN.301','6114112 6348156 6348157','','','','ACT.PPAL.7421 ACT.SEC. 0010','MAURICIOPA','A','S','N'),(602,4,'MECANICA AUTOMOTRIZ - ALFREDO MOTOR.COM','N','79388361','CALLE 91 N. 39-37','','','','','','MECANICAAU','A','S','N'),(603,4,'MERCA','N','0','','','','','','','MERCA','A','S','N'),(604,4,'MIGUEL CRUZ','N','19253448','','','','','','','MIGUELCRUZ','A','S','N'),(605,4,'MIGUEL FELIPE COTTS','N','17151077','','','','','','','MIGUELFELI','A','S','N'),(606,4,'MINISTERIO DE CULTURA','N','899999066','','','','','','','MINISTERIO','A','S','N'),(607,4,'MOLINO DE LA FLORIDA S.A.','N','','','','','','','','MOLINODELA','A','S','N'),(608,4,'MOVISTAR','N','1234566','CAN','4545','ventas@movistar.com.co','','','Telefonia empresarial','MOVISTAR','A','S','N'),(609,4,'MPKSAS - EMPRESA','N','','','','','','','','MPKSAS-EMP','A','S','N'),(610,4,'MUEBLES Y ENSERES CASA-OFICINA','N','','','','','','','','MUEBLESYEN','A','S','N'),(611,4,'NAVAS&NAVAS-ALAMCEN DE ARTE','N','800120675-','','','','','','','NAVAS&NAVA','A','S','N'),(612,4,'NOTARIA 25 DEL CIRCUITO DE BOGOTA D.C...','N','21069048','','','','','','','NOTARIA25','A','S','N'),(613,4,'NOTARIA 42 DE BOGOTA','N','23268456','','','','','','','NOTARIA42D','A','S','N'),(614,4,'NOTARIA NOVENA DE BOGOTA','N','11371163','','','','','','','NOTARIANOV','A','S','N'),(615,4,'OLGA LEONOR DE BRIGARD','N','39790002','','','','','','','OLGALEONOR','A','S','N'),(616,4,'OPENVIAS LTDA','N','830054076-','','','','','','','OPENVIASLT','A','S','N'),(617,4,'ORLANDO MENDEZ','N','80017590','','','','','','','ORLANDOMEN','A','S','N'),(618,4,'OSCAR BOLÍVAR RINCÓN ','C','79981828','','','','','','','OSCARBOLÍV','A','S','N'),(619,4,'OSCAR ISAZA','N','','','','','','','','OSCARISAZA','A','S','N'),(620,4,'OVER CHICO TOURS LTDA','N','800.202.05','','','','','','','OVERCHICOT','A','S','N'),(621,4,'PANAMERICANA LIBRERIA Y PAPELERIA S.A.','N','830.037.94','','','','','','','PANAMERICA','A','S','N'),(622,4,'PARCEALCIÓN MOLINO LA FLORIDA ','N','900243304-','','3166365613','','','','','PARCEALCIÓ','A','S','N'),(623,4,'PARKING INTERNATIONAL LTDA.','N','860.058.76','','','','','','','PARKINGINT','A','S','N'),(624,4,'PARQUEADERO TORRES 47 GOMEZ AMPARO','N','20302596-7','','','','','','','PARQUEADER','A','S','N'),(625,4,'PARQUEQDERO ACLA','N','860532264-','','','','','','','PARQUEQDER','A','S','N'),(626,4,'PEAJE LOS PATIOS','N','830132323-','','','','','','','PEAJELOSPA','A','S','N'),(627,4,'PEDRO PABLO VARGAS ','C','321422','','','','','','','PEDROPABLO','A','S','N'),(628,4,'PERIODICOS LTDA.','N','','','','','','','','PERIODICOS','A','S','N'),(629,4,'PUDONG LTDA','N','900.113.79','','','','','','','PUDONGLTDA','A','S','N'),(630,4,'RAFAEL CORTÉS DAZA','C','2859469','','','','','','','RafaelCort','A','S','N'),(631,4,'RAFAEL A CORREDOR B. ABC  de los MUEBLES ','N','18004263-4','cra 27  12-39','2084141 2257157','ventasabcmuebles@hotmail.com','','','Reg. Común','RAFAELACOR','A','S','N'),(632,4,'RAÚL CAMACHO ALFONSO (ING. DE ESTR.Y CONSTR.) ','C','19109035','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','RAÚLCAMACH','A','S','N'),(633,4,'RESTAURANTE SAN ALEJO-BEATRIZ NIÑO DE H.','N','20252749','DIAG. 6 N.3-35 CAJICA','8660691','','','','DIAG. 6 N.3-35 CAJICA','RESTAURANT','A','S','N'),(634,4,'RESTAURANTE ZOE S.A.','N','','','','','','','','RESTAURANT','A','S','N'),(635,4,'RICARDO CARVAJAL ORTIZ ','N','79537297-3','DIAG 49 F BIS SUR 6 33 AP 101','6969846 3133718580','ricardocarvajal@yahoo.com','','','Rég. Simpl.','RICARDOCAR','A','S','N'),(636,4,'RODRIGO OSPINA','N','8241088','','','','','','','RODRIGOOSP','A','S','N'),(637,4,'RODRIGO PARDO K.','N','','','','','','','','RODRIGOPAR','A','S','N'),(638,4,'RUDOLFF DIAZ LOPEZ','N','80076610-0','','','','','','','RUDOLFFDIA','A','S','N'),(639,4,'SAAD Y CIA C.S.A. (SERVICENTRO 3er.p)','N','800.006.07','','','','','','','SAADYCIAC','A','S','N'),(640,4,'SECRETARÍA DE HACIENDA CARTAGENA','N','','','','','','','','SEHDACARTA','A','S','N'),(641,4,'SECRETARIA DE HACIENDA DE BOGOTA','N','','','','','','','','SECRETARIA','A','S','N'),(642,4,'SECRETARIA DE HACIENDA MUNICIPAL CAJICA','N','899.999.46','','','','','','','SHDAMUNICI','A','S','N'),(643,4,'SERVICIO ESSO MIROLINDO','N','14201328','','','','','','','SERVICIOES','A','S','N'),(644,4,'SERVIENTREGA','N','860.512.33','','','','','','','SERVIENTRE','A','S','N'),(645,4,'SERVIPLETTER FELIX DIAZ D.','N','19239900','','','','','','','SERVIPLETT','A','S','N'),(646,4,'SUPERPLOTTER - RUDOLFF DIAZ LOPEZ','N','80076610','CALLE 98 N. 15-28','2572505','','','','','SUPERPLOTT','A','S','N'),(647,4,'TEJIDOS GAVIOTA SAS (INNOVACIÓN TEXTIL)','N','800067448-','cra 50 79-55','2312535 2400820','','','','','TEJIDOSGAV','A','S','N'),(648,4,'TEJIDOS LAV','N','860000867-','Av 19 114 A-05 /Cra 5A 4-88 Sur Caj.E56 ','','','','','','TEJIDOSLAV','A','S','N'),(649,4,'TELMEX HOGAR S.A.','N','830053,8','CARRERA 11 N. 94-76','','','','','','TELMEXHOGA','A','S','N'),(650,4,'TERRAKOT SAS ','N','900532394-','CLE 92 19-36 OF 301','','','','','','TERRAKOTSA','A','S','N'),(651,4,'TERPEL- ESTACION DE SERVICIO ORO NEGRO L','N','832.006.76',',','','','','','','TERPELORON','A','S','N'),(652,4,'TEXACO 20 EL COMUN','N','','','','','','','','TEXACO20EL','A','S','N'),(653,4,'TEXTURAS Y MATICES  SA ','N','800066571-','Autp Norte paralela 88-49','2569090 2569128','','','','','TEXTURASYM','A','S','N'),(654,4,'TRANSPORTE Y PARQUEO LTDA.','N','900.192.41','','','','','','','TRANSPORTE','A','S','N'),(655,4,'TUGO SAS ','N','830087848-','','2405880 OPC.2','','','','','TUGOSAS','A','S','N'),(656,4,'ULTRABURSÁTILES','N','','','','','','','','ULTRABURSÁ','A','S','N'),(657,4,'ULTRAVALORES','N','','','','','','','','ULTRAVALOR','A','S','N'),(658,4,'UNIANDINOS','N','','','','','','','','UNIANDINOS','A','S','N'),(659,4,'UNION TEMPORAL DEVINORTE','N','830002623','','','','','','','DEVINORTE','A','S','N'),(660,4,'UNIVERSIDAD TECNOLOGICA DE BOLIVAR','N','890.401.96','','','','','','','UTECNOLOGI','A','S','N'),(661,4,'VIVERO LA ESTANCIA  Enrique González ','N','860043771-','Cra 80  175-36   ','6732971 6711465','viverolaestancia@gmail.com ','','','','VIVEROLAES','A','S','N'),(662,4,'VIVERO LA FLORIDA','N','80501054','','','','','','','VIVEROLAFL','A','S','N'),(663,4,'XICOM TECMOLOGY','N','','','3103039730','','','','','XICOM','A','S','N'),(665,4,'DANIEL GUTIERREZ','C','17139692','','','','','',' ',NULL,'A','S','N'),(666,4,'DIGICAT (Esperanza Villarraga)','C','20422047-1','','','','','',' ',NULL,'A','S','N'),(667,5,'AGRICOLA PARRILLA S.A.S','N','900722569-','','','','','','','AGRICOPARR','A','S','N'),(668,5,'ACADEMIA COLOMBIANA DE ARQUITECTURA Y D','N','830142801-','','','','','','','ACA','A','S','N'),(669,5,'ACUAGRANJA LTDA.','N','890.324.48','AVENIDA 13 N. 137-50','6153344','','','','','ACUAGRANJA','A','S','N'),(670,5,'ACUEDUCTO Y ALCANTARILLADO DE BOGOTA','N','','','','','','','','AAB','A','S','N'),(671,5,'ADRIANA TORRES ARTUNDUAGA FOTOCOPIAS CHI','N','51815901-5','','','','','','','COPIASCHI','A','S','N'),(672,5,'AIRES','N','','','','','','','','AIRES','A','S','N'),(673,5,'AGROINSUMOS LOS PINOS  SAS','N','800090263-','Centro ChÃ­a locales 1109-1110','8616330  3124477647','','','','','AGROINSUMO','A','S','N'),(674,5,'ALCALDÍA MUNICIPAL DE CAJICÁ ','','','','','','','','','ALCCAJICÁ','A','S','N'),(675,5,'ALCALDÍA MAYOR DE BOGOTA D.C. INSTITUTO','N','899.999.08','DESARROLLO URBANO','','','','','','ALCBOGOTA','A','S','N'),(676,5,'ALDICOM OPERADORES LTDA-','N','830060549','','','','','','','ALDICOM','A','S','N'),(677,5,'ALFAGRES','N','','','','','','','','ALFAGRES','A','S','N'),(678,5,'ALFREDO LOPEZ VELANDIA','N','4.178.722-','CARRERA 13A N. 89-38 OF.','6185727','','','',' ','ALFLOPEZ','A','S','N'),(679,5,'ALMACEN EL ARQUITECTO SAS','N','860000054-','cra 11   80-45','5304010','ventas@alamacenelarquitectosa.com','','','','ARQUITECTO','A','S','N'),(680,5,'ALMACENES EXITO S.A.','N','','','','','','','','EXITOS.A.','A','S','N'),(681,5,'ALKOSTO SA C0LOMBIANA DE COMERCIA SA ','N','890900943-','Av cra 68 73 43','4376868','','','','','ALKOSTO','A','S','N'),(682,5,'ANACAONA AGCIA.DE VIAJES Y TURISMO','N','12141467-4','','','','','','','ANACAONA','A','S','N'),(683,5,'ANA CECILIA VARGAS   SALOTTY HUMBERTO DÍAZ','N','39635194-8','cra 50  78-14 ','4876789 3108599668 4910268','','','','Reg común','ANACECILIA','A','S','N'),(684,5,'ÁNGELA MARÍA ORTIZ CABAL','N','38860299','CLE. 92 19-36 AP.301','6114112 6348156 6348157','','','','ACT.PPAL. ACT.SEC.','ÁNGELAMARÍ','A','S','N'),(685,5,'APARCAR LTDA.','N','860.503.56','CALLE 84 N. 20-10','6369866','','','','','APARCAR','A','S','N'),(686,5,'APARTAMENTO CALLE 92 19-36','N','','CLE 92 19-36','','','','','MATR.APTO 50 C 361951 MATR.GARJ 50 C 361943','APCALLE92','A','S','N'),(687,5,'ARTURO CALLE','N','2.913.770-','','','','','','','ARTUROCALL','A','S','N'),(688,5,'AUTOLAVADO EL GRAN BARON','N','53055236','ADRIANA BARON ROZO','','','','','','AUTOLAVADO','A','S','N'),(689,5,'AUTOMÓVIL NISSAN SENTRA 2.002','N','','','','','','','PLACA BOD045','AUTONISSAN','A','S','N'),(690,5,'AVIANCA','N','','','','','','','','AVIANCA','A','S','N'),(691,5,'BAMLUZ  cortinas y pisos ','N','900408744-','Av cra 68 68-43','2400075','ventas@bamluz.com','','','','BAMLUZ','A','S','N'),(692,5,'BANCO DE BOGOTA','N','','','','','','','','BCOBOGOTA','A','S','N'),(693,5,'BANCO SANTANDER','N','','','','','','','','BCOSANTAND','A','S','N'),(694,5,'BRISSA CLUB           ','N','800161656-','Cra 52  10-80 ','7430875','servicioalacliente@brissa.com.co','','','','BRISSACLUB','A','S','N'),(695,5,'CÁMARA DE COMERCIO DE BOGOTÁ ','N','860007322-','CRA 15 CLE 93 SEDE NORTE ','','','','','','CCB','A','S','N'),(696,5,'CARLOS ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','CARLOMELO','A','S','N'),(697,5,'CARLOS JULIO SALAMANCA ','C','19260511','','','','','','','CARLOSSALA','A','S','N'),(698,5,'CARULLA VIVERO S.A. CHICO','N','860.002.09','','','','','','','CARULLA','A','S','N'),(699,5,'CENCOSUD COLOMBIA SA','N','900155107-','ave Pradilla 2 E 71','8611000','','','','','CENCOSUD','A','S','N'),(700,5,'CENTRAL PARKING SYSTEM COL LTDA.','N','830.087.09','CALLE 93 N. 13-19','6361113','','','','','CENTRALPAR','A','S','N'),(701,5,'CENTRO COMERCIAL ANDINO','N','800199501-','','','','','','','CCOMERCIAL','A','S','N'),(702,5,'CENTRO COMERCIAL SANTAFE','N','900083038-','','','','','','','CCIALSANTA','A','S','N'),(703,5,'CENTRO DE DIAGN.AUTOMOTOR DE LA SABANA S.A','N','900.084.96','','','','','','','DIAGNDELAS','A','S','N'),(704,5,'CENTRO RURAL SOFIA KOPPEL','N','860020425','Jorge Bolivar Alfaro','','','','','C.C. 19.245.461','CTRORURAL','A','S','N'),(705,5,'CERRADURAS INTER ATLANTICA LTDA','N','830.097.85','','','','','','','CERRADURAS','A','S','N'),(706,5,'CITY PARKING','N','830050619-','','','','','','','CITYPARKIN','A','S','N'),(707,5,'CIUDADELA CCIAL UNICDENTRO','N','860048836-','','','','','','','CIUDADELAC','A','S','N'),(708,5,'CLUB CAMPESTRE PEREIRA','N','','','','','','','','CLUBCAMPES','A','S','N'),(709,5,'CODENSA ESP.','N','830.037.24','','','','','','','CODENSAESP','A','S','N'),(710,5,'COLSANITAS','N','860078828','','','','','','','COLSANITAS','A','S','N'),(711,5,'COMBUSTIBLES DE COLOMBIA S.A. - TEXACO E','N','830.513.72','L COMUN','6760241','','','','AUTOPISTA NORTE KM 20','TEXACOE','A','S','N'),(712,5,'COMCEL S.A.','N','800.153.99','','','','','','','COMCELS.A.','A','S','N'),(713,5,'COMERCIAL PAPELERA','N','860.528.39','','','','','','','COMERCIALP','A','S','N'),(715,5,'COMPAÑIAS ASOCIADAS DE GAS S.A. E.S.P.','N','800.074.03','','','','','','','CIAASOCIAD','A','S','N'),(716,5,'COMPENSAR','N','860066942-','','','','','','','COMPENSAR','A','S','N'),(717,5,'CONCESION BRICENO TUNJA SOGAMOSO','N','830052998-','','','','','','','CONCESIONB','A','S','N'),(718,5,'CONCESIONARIA SAN RAFAEL S.A.','N','','','','','','','','CONCESIONA','A','S','N'),(719,5,'CONCESION NEIVA GIRARDOT','N','5199222','','','','','','','CONCESIONN','A','S','N'),(720,5,'CONSTRUCCIONES JORGE BOLÍVAR ','N','900323576-','','','','','','','CONSTRUCCI','A','S','N'),(721,5,'CONRADO BETANCOURT ARISTIZABAL','N','','','','','','','','CONRADOBET','A','S','N'),(722,5,'COPIAS CHICO','N','51608610','','','','','','','COPIASCHIC','A','S','N'),(723,5,'COPYPLOTTER Y ENVIOS-CARLOS ERNESTO MORE','N','19477828','NO FORERO','','','','','','COPYPLOTTE','A','S','N'),(724,5,'CORPORACION CLUB CAMPESTRE DE PEREIRA','N','891400467-','','','','','','','CORPORACIO','A','S','N'),(725,5,'CORREA CARO ABELLA & CIA LTDA.','N','860.352.46','CALLE 71 N, 5-41','2170011','','','','','CORREACARO','A','S','N'),(726,5,'CORREDOR HNOS. & ASOCIADOS LTDA','N','860.032.68','CALLE 59A N. 8-83','2356166','','','','','CORREDORHN','A','S','N'),(727,5,'CREPRES & WAFFLES S.A.','N','860.076.91','','','','','','','CREPRES&WA','A','S','N'),(728,5,'CRUZ ROJA COLOMBIANA','N','','','','','','','','CRUZROJACO','A','S','N'),(729,5,'CHIMENEAS DE COLOMBIA  ','C','35199155','','','','','','','CHIMENEASD','A','S','N'),(730,5,'DAVID GUTIÉRREZ BUITRAGO','N','17139692-7','','','','','','','DAVIDGUTIÉ','A','S','N'),(731,5,'DECORCERÁMICA ','N','800165377','autop norte cle 135  45-16 ','7433838','','','','','DECORCERÁM','A','S','N'),(732,5,'D H L EXPRESS COLOMBIA LTDA.','N','860.502.60','','','','','','','DHLEXPRESS','A','S','N'),(733,5,'DEPRISA - AVIANCA','N','890.100.57','','','','','','','DEPRISA','A','S','N'),(734,5,'DEVINORTE','','6760652','','6760652','','','','','DEVINORTE','A','S','N'),(735,5,'DIAGNOSTIAUTOS S.A.','N','830130337-','','','','','','','DIAGNOSTIA','A','S','N'),(736,5,'DIEGO JAVIER BARAJAS P.','N','79862748-6','cra 40 25 21 ap 111','3173419428','sigmaarquitecto@yahoo.com.ar','','','Rég.Simp.','DIEGOJAVIE','A','S','N'),(737,5,'DIEGO PARDO KOPPEL','N','','','','','','','','DIEGOPARDO','A','S','N'),(738,5,'DIEGO PUENTES','C','79504216','','','','','','','DIEGOPUENT','A','S','N'),(739,5,'DIGUES LTDA ','N','800112126-','Av Cra 30  88 A 19','6353041 3144618625','','','','','DIGUESLTDA','A','S','N'),(740,5,'DIR. DE IMPUESTOS Y ADUANAS NACIONALES DIAN','N','111','','','','','','','DIAN','A','S','N'),(741,5,'DISERCOM S.A. -MOBIL EL RODEO','N','830.046.00','AUTOPISTA NORTE-KM 20','6760183','','','','','DISERCOM','A','S','N'),(742,5,'E.D.S.PETROBRAS LA MILAGROSA','N','900182159-','','','','','','','PETROBRASL','A','S','N'),(743,5,'EBAY CAR - EBANISTERIA Y CARPINTERIA','N','','CALLE 10 N. 66A-42','2604755','','','','','EBAYCAR-EB','A','S','N'),(744,5,'EDIFICIO PORLAMAR P.H.','N','860.075.49','CLE 92 19-36','5303040','','','','','EDIFICIOPO','A','S','N'),(745,5,'EDS MERCASA','N','830095213','','','','','','','EDSMERCASA','A','S','N'),(746,5,'ELECTRILUCES  LTDA ','N','900322522-','CRA 12 16-34','6083901 2833484','ELECTRILUCES@HOTMAIL.COM','','','','ELECTRILUC','A','S','N'),(747,5,'EL TIEMPO SA','C','860599421','Av. El Dorado','277 775 775','','','','proveedor de publicaciones','ELTIEMPOSA','A','S','N'),(748,5,'ENRIQUE MELO RODRÍGUEZ','N','19408103-2','CL 157  107A VIA CLÍNICA CORPAS ','5369390 3153491878','','','','','ENRIQUEMEL','A','S','N'),(749,5,'ENRIQUE GONZALEZ \"VIVERO LA ESTANCIA\"','N','860043771-','Cra 80  175-36   ','','','','','','ENRIQUEGON','A','S','N'),(750,5,'EQUIPOS DE OFICINA','N','','','','','','','','EQUIPOSDEO','A','S','N'),(751,5,'ESPACIOS Y SOLUCIONES SAS','N','830104599','CLE 116 15-20 ','6122983 6370873/76','espaciosysoluciones@gmail.com  ','','','','ESPACIOSYS','A','S','N'),(752,5,'ESPERANZA SANTACOLOMA','N','','','','','','','','ESPERANZAS','A','S','N'),(753,5,'ESSE CONNSULTORES','N','830137656-','','','','','','','ESSECONNSU','A','S','N'),(754,5,'ESSO EL RODEO DISERCOM S.A.','N','830046009-','','','','','','','ESSOELRODE','A','S','N'),(755,5,'ESTACION DE SCIO.LAS MARGARITAS','N','3264700-1','','','','','','','EDSLASMARG','A','S','N'),(756,5,'ESTACION DE SERVICIO BRIO BIMA','N','830.066.13','CARRERA 45 N.232-35','','','','','313-8893900','EDSBRIOBIM','A','S','N'),(757,5,'ESTACION DE SERVICIO COUNTRY','N','900.093.28','','','','','','','EDSCOUNTRY','A','S','N'),(758,5,'ESTACION DE SERVICIO EL CANELON CIA LTDA','N','830136907-','','','','','','','EDSELCANEL','A','S','N'),(759,5,'ESTACION DE SERVICIO MOBIL LA CARO','N','17108681','','','','','','','EDSMOBILLA','A','S','N'),(760,5,'ESTACION DESERVICIO EL CANELON Y CIA LTD','N','830.136.90','A.','','','','','','EDSELCANEL','A','S','N'),(761,5,'ESTACION RUMBOS LA CARO','N','830508167-','','','','','','','ESTACIONRU','A','S','N'),(762,5,'ESTACIONES DE PEAJE UTDVVCC','N','830059605-','','','','','','','ESTACIONES','A','S','N'),(763,5,'EMPRESA DE TELEFONOS DE BOGOTA','N','3777777','centro','3777777','info@etb.com','','','','ETB','A','S','N'),(764,5,'EVERNET SAS','N','900677172-','Cr. 1 D  31-38  Chía ','3142221757','evernetwireless@gmail.com','','','','EVERNETSAS','A','S','N'),(765,5,'FERNANDO GONZALEZ','N','80210671','','','','','','','FERNANDOGO','A','S','N'),(766,5,'FERREPLAST','N','','','','','','','','FERREPLAST','A','S','N'),(767,5,'FERRETERIA JOSE GOMEZ','N','19192006-6','','','','','','','FERRETERIA','A','S','N'),(768,5,'FERRETERIA LA LLAVE DEL NORTE','N','19310323','','','','','','','FERRETERIA','A','S','N'),(769,5,'FIDEICOMISO CONCESIONES CCFC S.A.','N','800256769-','','','','','','','FIDEICOMIS','A','S','N'),(770,5,'FIDEICOMISO FUDUCOLDEX','N','830054060-','','','','','','','FIDEICOMIS','A','S','N'),(771,5,'FIDEICOMISO PANAMERICANA','N','830053630-','','','','','','','FIDEICOMIS','A','S','N'),(772,5,'FIDUCIARIA CORFICOLOMBIANA','N','800140887-','','','','','','','FIDUCIARIA','A','S','N'),(773,5,'FUNDACIÓN SALDARRIAGA','N','860.038.33','','','','','','','FUNDACIÓNS','A','S','N'),(774,5,'GRUPO DE INVERSIONES N&R SAS ','N','900424448-','cra 15  78-33  local 276','3004839','www.grupnyr.com','','','','GRUPODEINV','A','S','N'),(775,5,'HABITAT STORE  SAS ','N','830086688-','av cra 45 183 A 70','6767777','','','','','HABITATSTO','A','S','N'),(776,5,'HÉCTOR GUTIÉRREZ GONZÁLEZ ','C','','','','','','','','HÉCTORGUTI','A','S','N'),(777,5,'(Héctor Gut.Gonz). HOME CENTER (SODIMAC COL.SA)','N','800242106-','','','','','','','HOMECENTER','A','S','N'),(778,5,'HENAO LUNA EU','N','900.241.02','','','','','','','HENAOLUNAE','A','S','N'),(779,5,'HIDROMET LTDA','','','','','','','','','HIDROMETLT','A','S','N'),(780,5,'HOMECENTER SODIMAC COLOMBIA S.A.','N','800242106-','','','','','','','SODIMAC','A','S','N'),(781,5,'HOTEL CHICALA','N','891101711-','','','','','','','HOTELCHICA','A','S','N'),(782,5,'HOTEL SEBASTIAN','N','R.U.C.1790','DIEGO DE ALMAGRO 822','','','','','QUITO - ECUADOR','HOTELSEBAS','A','S','N'),(783,5,'IGNACIO TURBAY','N','','','','','','','','IGNACIOTUR','A','S','N'),(784,5,'INES RUBIANO','C','8050154','','','','','','','INESRUBIAN','A','S','N'),(785,5,'INGENIERÍA DE ESTRUCTURAS Y CONSTRUCCION SAS ','N','900199597-','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','INGESTRUCT','A','S','N'),(786,5,'INSTITUTO DE SEGUROS SOCIALES','N','','','','','','','','INSTITUTOD','A','S','N'),(787,5,'INSTITUTO NACIONAL DE VIAS','N','800215807-','','','','','','','INSTITUTON','A','S','N'),(788,5,'INVERSET BOTERO GOMEZ Y CIA','N','816004255-','HOSTAL HACIENDA MALABAR','','','','','','INVERSETBO','A','S','N'),(789,5,'INVERSIONES EL CIPRES COLOMBIA S.A.','N','811.032.44','CALLE 94 N. 12-55','','','','','','INVERSIONE','A','S','N'),(790,5,'INVERSIONES LEAL S.A.','N','900016780-','','','','','','','INVERSIONE','A','S','N'),(791,5,'INVERSIONES LIBRA S.A. COSMOS 100','N','860048182-','','','','','','','INVERSIONE','A','S','N'),(792,5,'IROTAMA S.A.','N','891700612-','','','','','','','IROTAMA','A','S','N'),(793,5,'JAIME URIBE BOTERO','N','','','','','','','','JAIMEURIBE','A','S','N'),(794,5,'JAVIER PARRA','N','805010511','','','','','','','JAVIERPARR','A','S','N'),(795,5,'JORGE  ELIÉCER  BOLIVAR ALFARO ','N','19245461-3','CL 163 B  48 34 AP 201','8636277 3107683925','gerencia@construccionesjorgebolivar ','','','','JORGEELIÉC','A','S','N'),(796,5,'JOSÉ NICOLÁS SERNA ','C','3150893','','3134909804','','','','','JOSÉNICOLÁ','A','S','N'),(797,5,'JUAN CARLOS DIAZ','N','79758019','','','','','','','JUANCARLOS','A','S','N'),(798,5,'JUAN CARLOS DOBLADO CÁRDENAS ','N','79980860','AV PRADILLA 5 62  CHÍA  CUND.','8630283 3107994599','jcdoblado@hotmail.com','','','','JUANCARLOS','A','S','N'),(799,5,'JUAN PABLO KOUSEN','C','79186474','','','','','','','JUANPABLOK','A','S','N'),(800,5,'JULIAN ARANA','N','94487211','','','','','','','JULIANARAN','A','S','N'),(801,5,'JULIO BORDA G. SUPER EST.TEXACO 10','N','2917960-1','','','','','','','JULIOBORDA','A','S','N'),(802,5,'JULIO FLOREZ','N','19146712','','','','','','','JULIOFLORE','A','S','N'),(803,5,'JULIO FONTAN Y CÍA','N','800.217.63','','','','','','','JULIOFONTA','A','S','N'),(804,5,'HÉCTOR GUTIÉRREZ GONZÁLEZ+B19  Arquitecto','C','17020239','','','','','','','HÉCTORGUTI','A','S','N'),(805,5,'KATA S.A.S','N','830047411-','','','','','','','KATAS.A.S','A','S','N'),(806,5,'LAO KAO S.A.','N','830047537-','','','','','','','LAOKAOS.A.','A','S','N'),(807,5,'LAS CUADRAS TERRENO CAJICÁ C/MARCA.','N','','','','','','','MATR.176-40270 MATR.176-40271','LASCUADRAS','A','S','N'),(808,5,'LEASING BANCOLOMBIA  SA ','N','860059294-','CR 48 26 85 TORRE NORTE PISO 1','','','','','','LEASINGBAN','A','S','N'),(809,5,'LIBERTY SEGUROS S.A.','N','860.039.96','','','','','','','LIBERTYSEG','A','S','N'),(810,5,'LIBRERIA NACIONAL S.A.','N','','','','','','','','LIBRERIANA','A','S','N'),(811,5,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(812,5,'LIBRERIA Y DISTRIBUIDORA LERNER LTDA.','N','860.029.10','','','','','','','LERNERLTDA','A','S','N'),(813,5,'LIGHTS DESIGN','N','1020735710','Cle 65  13-61 ','3573828 5411846','ligthsdesigncolombia@gmail.com','','','','LIGHTSDESI','A','S','N'),(814,5,'LISANDRO ACOSTA GONZÁLEZ (Electrogas del Llano)','C','4284616-1','Cle 15 1015 Chía centro','88584017 3106192008','','','','','LISANDROAC','A','S','N'),(815,5,'LOS TRES ELEFANTES ','N','860030478-','Cento Chía local 1170','','','','','','LOSTRESELE','A','S','N'),(816,5,'LOTA LA ESTACADA','N','','','','','','','','LOTALAESTA','A','S','N'),(817,5,'LUBRICANTES LA ISLA-MARIA MYRIAM VALCARC','N','41534714','EL MANRIQUE','','','','','','LUBRICANTE','A','S','N'),(818,5,'LUBRISERVICIOS KIKO E/S ESSO COUNTRY','N','51898765','','','','','','','LUBRISERVI','A','S','N'),(819,5,'LUIS ALBERTO CADENA','N','79147302','','','','','','','LUISALBERT','A','S','N'),(820,5,'LUIS GUINARD','N','','','','','','','','LUISGUINAR','A','S','N'),(821,5,'LUIS HUMBERTO GAMBA V.','N','3163305-1','','','','','','','LUISHUMBER','A','S','N'),(822,5,'MARIA ELIZA HERRERA','N','','','','','','','','MARIAELIZA','A','S','N'),(823,5,'MARIA ELVIRA PARDO O.','N','','','','','','','','MARIAELVIR','A','S','N'),(824,5,'MARIA MYRIAM VALCARCEL MANRIQUE','N','41534714-1','','','','','','','MARIAVALCA','A','S','N'),(825,5,'MAURICIO PARDO KOPPEL','N','17130450','CLE. 92 19-36 OFN.301','6114112 6348156 6348157','','','','ACT.PPAL.7421 ACT.SEC. 0010','MAURICIOPA','A','S','N'),(826,5,'MECANICA AUTOMOTRIZ - ALFREDO MOTOR.COM','N','79388361','CALLE 91 N. 39-37','','','','','','MECANICAAU','A','S','N'),(827,5,'MERCA','N','0','','','','','','','MERCA','A','S','N'),(828,5,'MIGUEL CRUZ','N','19253448','','','','','','','MIGUELCRUZ','A','S','N'),(829,5,'MIGUEL FELIPE COTTS','N','17151077','','','','','','','MIGUELFELI','A','S','N'),(830,5,'MINISTERIO DE CULTURA','N','899999066','','','','','','','MINISTERIO','A','S','N'),(831,5,'MOLINO DE LA FLORIDA S.A.','N','','','','','','','','MOLINODELA','A','S','N'),(832,5,'MOVISTAR','N','1234566','CAN','4545','ventas@movistar.com.co','','','Telefonia empresarial','MOVISTAR','A','S','N'),(833,5,'MPKSAS - EMPRESA','N','','','','','','','','MPKSAS-EMP','A','S','N'),(834,5,'MUEBLES Y ENSERES CASA-OFICINA','N','','','','','','','','MUEBLESYEN','A','S','N'),(835,5,'NAVAS&NAVAS-ALAMCEN DE ARTE','N','800120675-','','','','','','','NAVAS&NAVA','A','S','N'),(836,5,'NOTARIA 25 DEL CIRCUITO DE BOGOTA D.C...','N','21069048','','','','','','','NOTARIA25','A','S','N'),(837,5,'NOTARIA 42 DE BOGOTA','N','23268456','','','','','','','NOTARIA42D','A','S','N'),(838,5,'NOTARIA NOVENA DE BOGOTA','N','11371163','','','','','','','NOTARIANOV','A','S','N'),(839,5,'OLGA LEONOR DE BRIGARD','N','39790002','','','','','','','OLGALEONOR','A','S','N'),(840,5,'OPENVIAS LTDA','N','830054076-','','','','','','','OPENVIASLT','A','S','N'),(841,5,'ORLANDO MENDEZ','N','80017590','','','','','','','ORLANDOMEN','A','S','N'),(842,5,'OSCAR BOLÍVAR RINCÓN ','C','79981828','','','','','','','OSCARBOLÍV','A','S','N'),(843,5,'OSCAR ISAZA','N','','','','','','','','OSCARISAZA','A','S','N'),(844,5,'OVER CHICO TOURS LTDA','N','800.202.05','','','','','','','OVERCHICOT','A','S','N'),(845,5,'PANAMERICANA LIBRERIA Y PAPELERIA S.A.','N','830.037.94','','','','','','','PANAMERICA','A','S','N'),(846,5,'PARCEALCIÓN MOLINO LA FLORIDA ','N','900243304-','','3166365613','','','','','PARCEALCIÓ','A','S','N'),(847,5,'PARKING INTERNATIONAL LTDA.','N','860.058.76','','','','','','','PARKINGINT','A','S','N'),(848,5,'PARQUEADERO TORRES 47 GOMEZ AMPARO','N','20302596-7','','','','','','','PARQUEADER','A','S','N'),(849,5,'PARQUEQDERO ACLA','N','860532264-','','','','','','','PARQUEQDER','A','S','N'),(850,5,'PEAJE LOS PATIOS','N','830132323-','','','','','','','PEAJELOSPA','A','S','N'),(851,5,'PEDRO PABLO VARGAS ','C','321422','','','','','','','PEDROPABLO','A','S','N'),(852,5,'PERIODICOS LTDA.','N','','','','','','','','PERIODICOS','A','S','N'),(853,5,'PUDONG LTDA','N','900.113.79','','','','','','','PUDONGLTDA','A','S','N'),(854,5,'Rafael Cortés Daza','C','2859469','','','','','','','RafaelCort','A','S','N'),(855,5,'RAFAEL A CORREDOR B. ABC  de los MUEBLES ','N','18004263-4','cra 27  12-39','2084141 2257157','ventasabcmuebles@hotmail.com','','','Reg. Común','RAFAELACOR','A','S','N'),(856,5,'RAÚL CAMACHO ALFONSO (ING. DE ESTR.Y CONSTR.) ','C','19109035','CRA 8 16 49 SOACHA Raúl Camacho','7815398 7214633','idecingas@outlook.com','','','','RAÚLCAMACH','A','S','N'),(857,5,'RESTAURANTE SAN ALEJO-BEATRIZ NIÑO DE H.','N','20252749','DIAG. 6 N.3-35 CAJICA','8660691','','','','DIAG. 6 N.3-35 CAJICA','RESTAURANT','A','S','N'),(858,5,'RESTAURANTE ZOE S.A.','N','','','','','','','','RESTAURANT','A','S','N'),(859,5,'RICARDO CARVAJAL ORTIZ ','N','79537297-3','DIAG 49 F BIS SUR 6 33 AP 101','6969846 3133718580','ricardocarvajal@yahoo.com','','','Rég. Simpl.','RICARDOCAR','A','S','N'),(860,5,'RODRIGO OSPINA','N','8241088','','','','','','','RODRIGOOSP','A','S','N'),(861,5,'RODRIGO PARDO K.','N','','','','','','','','RODRIGOPAR','A','S','N'),(862,5,'RUDOLFF DIAZ LOPEZ','N','80076610-0','','','','','','','RUDOLFFDIA','A','S','N'),(863,5,'SAAD Y CIA C.S.A. (SERVICENTRO 3er.p)','N','800.006.07','','','','','','','SAADYCIAC','A','S','N'),(864,5,'SECRETARÍA DE HACIENDA CARTAGENA','N','','','','','','','','SEHDACARTA','A','S','N'),(865,5,'SECRETARIA DE HACIENDA DE BOGOTA','N','','','','','','','','SECRETARIA','A','S','N'),(866,5,'SECRETARIA DE HACIENDA MUNICIPAL CAJICA','N','899.999.46','','','','','','','SHDAMUNICI','A','S','N'),(867,5,'SERVICIO ESSO MIROLINDO','N','14201328','','','','','','','SERVICIOES','A','S','N'),(868,5,'SERVIENTREGA','N','860.512.33','','','','','','','SERVIENTRE','A','S','N'),(869,5,'SERVIPLETTER FELIX DIAZ D.','N','19239900','','','','','','','SERVIPLETT','A','S','N'),(870,5,'SUPERPLOTTER - RUDOLFF DIAZ LOPEZ','N','80076610','CALLE 98 N. 15-28','2572505','','','','','SUPERPLOTT','A','S','N'),(871,5,'TEJIDOS GAVIOTA SAS (INNOVACIÓN TEXTIL)','N','800067448-','cra 50 79-55','2312535 2400820','','','','','TEJIDOSGAV','A','S','N'),(872,5,'TEJIDOS LAV','N','860000867-','Av 19 114 A-05 /Cra 5A 4-88 Sur Caj.E56 ','','','','','','TEJIDOSLAV','A','S','N'),(873,5,'TELMEX HOGAR S.A.','N','830053,8','CARRERA 11 N. 94-76','','','','','','TELMEXHOGA','A','S','N'),(874,5,'TERRAKOT SAS ','N','900532394-','CLE 92 19-36 OF 301','','','','','','TERRAKOTSA','A','S','N'),(875,5,'TERPEL- ESTACION DE SERVICIO ORO NEGRO L','N','832.006.76',',','','','','','','TERPELORON','A','S','N'),(876,5,'TEXACO 20 EL COMUN','N','','','','','','','','TEXACO20EL','A','S','N'),(877,5,'TEXTURAS Y MATICES  SA ','N','800066571-','Autp Norte paralela 88-49','2569090 2569128','','','','','TEXTURASYM','A','S','N'),(878,5,'TRANSPORTE Y PARQUEO LTDA.','N','900.192.41','','','','','','','TRANSPORTE','A','S','N'),(879,5,'TUGO SAS ','N','830087848-','','2405880 OPC.2','','','','','TUGOSAS','A','S','N'),(880,5,'ULTRABURSÁTILES','N','','','','','','','','ULTRABURSÁ','A','S','N'),(881,5,'ULTRAVALORES','N','','','','','','','','ULTRAVALOR','A','S','N'),(883,5,'UNION TEMPORAL DEVINORTE','N','830002623','','','','','','','DEVINORTE','A','S','N'),(884,5,'UNIVERSIDAD TECNOLOGICA DE BOLIVAR','N','890401962','U.T.B. Cartagena de Indias','','','','','','UTECNOLOGI','A','C','N'),(885,5,'VIVERO LA ESTANCIA  Enrique González ','N','860043771-','Cra 80  175-36   ','6732971 6711465','viverolaestancia@gmail.com ','','','','VIVEROLAES','A','S','N'),(886,5,'VIVERO LA FLORIDA','N','80501054','','','','','','','VIVEROLAFL','A','S','N'),(887,5,'XICOM TECMOLOGY','N','','','3103039730','','','','','XICOM','A','S','N'),(888,5,'DANIEL GUTIERREZ','C','17139692','','','','','',' ',NULL,'A','S','N'),(889,5,'DIGICAT (Esperanza Villarraga)','C','20422047-1','','','','','',' ',NULL,'A','S','N'),(922,5,'MECANOMEGA LTDA','C','900199294-8','Calle 26 Nro  27-20','','','','','reg.',NULL,'A','C','N'),(923,4,'HOME CENTRY','N','860001584','','','','','',' ',NULL,'A',NULL,NULL),(924,4,'AGROCAMPO SAS','N','860069284-2','','','','','',' ',NULL,'A',NULL,NULL),(925,4,'BANCOLOMBIA','N','890903938','','','','','',' ',NULL,'A',NULL,NULL),(926,4,'ABC DE LOS MUEBLES METALICOS','N','18004263-4','CRA 27 12-39 Barrio Rucaurte','4085007','ventasabcmuebles@hotmail.com','','',' ',NULL,'A',NULL,NULL),(928,5,'MAURICIO PARDO K ','C','17130450','','','',NULL,NULL,'','Mau171','A','C','N'),(929,5,'MARIA ELSA VARELA  ','C','52419750','','','',NULL,NULL,'','Mar524','A','C','N'),(930,5,'SERGI DAZA','C','79435222','','','',NULL,NULL,'','Ser794','A','C','N'),(931,5,'UNIANDINOS BOGOTA','N',' 860023338-3','','','',NULL,NULL,'','Uni86','A','C','N'),(932,5,'HERNANDO GAITAN','C','79718401-0','','','',NULL,NULL,'','Her797','A','C','N'),(933,5,'CIAS ASOCIADAS DE GAS ','N','800074033-2 ','','','',NULL,NULL,'','Cï¿½a800','A','C','N'),(934,5,'CLARO COMCEL S.A.','N','800153993-7','','','',NULL,NULL,'','Cla800','A','C','N'),(935,5,'CODENSA','N','830037248-0','','','',NULL,NULL,'','Cod830','A','C','N'),(936,5,'COMERCIALIZADORA RUMBOS  ','N','830508167-4','','','',NULL,NULL,'','Com830','A','C','N'),(937,5,'TOURING AUT.CLUB DE ','N','860007637-3','','','',NULL,NULL,'','Tou860','A','C','N'),(938,5,'FICPI  (PARA VIVIANA PARDO) ','N','860031010-7 ','','','',NULL,NULL,'','FIC860','A','C','N'),(939,5,'PARDO CUELLAR Y CIA ','N','860500858-8','','','',NULL,NULL,'','Par860','A','C','N'),(940,5,'COOPSERFUN L A CANDELARAI ','N','860516881-8','','','',NULL,NULL,'','Coo860','A','C','N'),(941,5,'E.T.B ','N','899999115-8','','','',NULL,NULL,'','ET899','A','C','N'),(942,5,'FILIGRAMA LTDA ','N','900103636-1','','','',NULL,NULL,'','Fil900','A','C','N'),(943,5,'ACADEMIA LA ESCALA ','N','100','','','',NULL,NULL,'','Aca','A','C','N'),(944,5,'ACUEDUCTO ','N','110','','','',NULL,NULL,'','Acu','A','C','N'),(945,5,'ANGELA MA- ORTIZ C','C','120','','','',NULL,NULL,'','Ang','A','C','N'),(946,5,'ASOGAS ','N','130','','','',NULL,NULL,'','Aso','A','C','N'),(947,5,'CAMARA DE CCIO ','N','140','','','',NULL,NULL,'','VAM','A','C','N'),(948,5,'CARITAS COLOMBIANA ','N','150','','','',NULL,NULL,'','CAR','A','C','N'),(949,5,'CENTRO SAOFIA KOPEL','N','160','','','',NULL,NULL,'','Cen','A','C','N'),(950,5,'CORPORACION MUSICAL LA ESCALA','N','170','','','',NULL,NULL,'','Cor','A','C','N'),(951,5,'DEPTO DE C/MARCA  SECR.HDA ','N','180','','','',NULL,NULL,'','Dep','A','C','N'),(952,5,'DIAN','N','190','','','',NULL,NULL,'','DIA','A','C','N'),(953,5,'DIEGO ANDRES ADAMES PRADA ','C','200','','','',NULL,NULL,'','Die','A','C','N'),(954,5,'E.A.B','N','210','','','',NULL,NULL,'','EA','A','C','N'),(955,5,'EDIF. EL PORTAL DEL PARQUE','N','220','','','',NULL,NULL,'','Edi','A','C','N'),(956,5,'EDIFICIO PORLAMAR','N','230','','','',NULL,NULL,'','Edip','A','C','N'),(957,5,'ESPERANZA GUEVARA ','C','240','','','',NULL,NULL,'','Esp','A','C','N'),(958,5,'FIDUCIARIA BOGOTA ','N','250','','','',NULL,NULL,'','Fid','A','C','N'),(959,5,'JAIME URIBE ','C','260','','','',NULL,NULL,'','Jai','A','C','N'),(961,5,'M P K ','N','280','','','',NULL,NULL,'','MP','A','C','N'),(962,5,'OKRE -','N','290','','','',NULL,NULL,'','OKR','A','C','N'),(963,5,'PANAMERICANA ','N','300','','','',NULL,NULL,'','Pan','A','C','N'),(964,5,'PETROBRAS','N','310','','','',NULL,NULL,'','Pet','A','C','N'),(965,5,'SECER.HDA.DEL DISTRITO','N','320','','','',NULL,NULL,'','Sec','A','C','N'),(966,5,'SELMAN CONTRERAS ','C','330','','','',NULL,NULL,'','Sel','A','C','N'),(967,5,'SUPERINT DE NOTARIADO Y REGIDTRO','N','340','','','',NULL,NULL,'','Sup','A','C','N'),(968,5,'TERRAKOT - CAMARA.CCIO ','N','350','','','',NULL,NULL,'','TER','A','C','N'),(969,5,'ZAPHER TRAVEL','N','360','','','',NULL,NULL,'','zap','A','C','N'),(970,5,'APORTES EN LINEA','N','900147238-2','','','','','',' ',NULL,'A',NULL,NULL),(971,5,'GRUPO EDITORIAL 87 SAS','N','800020895-2','CL 79A Nr. 18-41 Of 201','6212550','','','',' ',NULL,'A',NULL,NULL),(972,5,'OFFICE DEPOT','N','90003386-1','l 85 -  14-48','','','','',' ',NULL,'A',NULL,NULL),(973,5,'OLD MUTUAL','N','800194363-2','','','','','','',NULL,'A',NULL,NULL),(974,5,'DIRECTV','N','805006014-0','','','','','',' ',NULL,'A',NULL,NULL),(975,5,'ESTRAVAL EN LIQUIDACION','N','1','','','','','',' ',NULL,'A',NULL,NULL),(976,5,'PINTO CHINCHILLA VICTOR','C','2','','','','','',' ',NULL,'A',NULL,NULL),(977,5,'AGROCONCENTRADOS','N','20500046','CAJICA','','','','',' ',NULL,'A',NULL,NULL),(978,5,'SEGUROS DEL ESTADO','N','3','','','','','',' ',NULL,'A',NULL,NULL),(979,5,'GAS SUPERIOR','N','900089989-4','Km 1 via Quipama','3202101594','gassuperiorcolombia@hotmail.com','','','',NULL,'A',NULL,NULL),(980,5,'LUBICITY SAS','N','900554198-1','CAJICA','','','','',' ',NULL,'A',NULL,NULL),(981,5,'CACERES Y FERRO  FINCA RAIZ','N','900252318-2','CRA 7 NR 99-53 P 16 TR2','5942323','','','',' ',NULL,'A',NULL,NULL),(982,5,'EQUILIBRIO SAS','N','830075323-7','','','','','',' ',NULL,'A',NULL,NULL),(983,5,'AUTOCENTRO L.B.','N','49369938-5','CLL 3 S NR 4-18 CAJICA','3115307122','','','',' ',NULL,'A',NULL,NULL),(984,5,'MORSE AGENCIA DE SEGUROS','N','6','','','','','',' ',NULL,'A',NULL,NULL),(985,5,'VISA','N','8','','','','','',' ',NULL,'A',NULL,NULL),(986,5,'AGROPECUARIA BONANZA','N','2178679-2','CAJICA','8661O051','','','',' ',NULL,'A',NULL,NULL),(987,5,'AGROROJAS CAJICA','N','3146742-5','cra 6 s nr 02-174','3143041214','','','','',NULL,'A',NULL,NULL),(988,5,'ADMINISTRACION OPERATICA AUTOMOTRIZ SAS','N','900174552-5','','','','','',' ',NULL,'A',NULL,NULL),(989,5,'GRUPO SAPS SAS','N','900604230-5','','','','','',' ',NULL,'A',NULL,NULL),(990,5,'SEIKOU S.A.','N','830079234-8','Cra 20 Nr 66-24 BogotÃ ','3462004','','','',' ',NULL,'A',NULL,NULL),(991,5,'RINES Y LLANTAS CAJICA','N','79296573-6','','312 377 2628','','','',' ',NULL,'A',NULL,NULL),(992,5,'NOEMI DELGADO','C','8','','','','','',' ',NULL,'A',NULL,NULL),(993,5,'CDA  METROPOLITANO S.A.','N','10','','','','','',' ',NULL,'A',NULL,NULL),(994,5,'KRISMA','N','12','','','','','',' ',NULL,'A',NULL,NULL),(995,5,'ROCIO AYALA','C','13','','','','','',' ',NULL,'A',NULL,NULL),(996,5,'PAYU COLOMBIA SAS','N','8301097238','','','','','',' ',NULL,'A',NULL,NULL),(997,5,'POSADA GONIMA','N','800144736','','6184709','financiera@pasadagonima.com','','',' ',NULL,'A',NULL,NULL),(998,5,'HOCAES','N','901','','','','','','',NULL,'A',NULL,NULL),(999,5,'PLANILLA ASISTIDA - AVEVILLAS','N','902','','','','','',' ',NULL,'A',NULL,NULL),(1000,5,'GABRIEL VELANDIA','C','903','','8661786','','','',' ',NULL,'A',NULL,NULL),(1001,5,'ALEJANDRO AMADO PIÑEROS','C','80227816','','','','','','',NULL,'A',NULL,NULL),(1002,5,'EPC - EMPRESA DE SERVICIOS PUBLICOS DE CAJICA','N','905','','','','','',' ',NULL,'A',NULL,NULL),(1003,5,'PRACO DIDACOL','N','860047657-1','','','','','',' ',NULL,'A',NULL,NULL),(1004,5,'YORAMI RICO','C','79824837','','','','','',' ',NULL,'A',NULL,NULL),(1005,5,'SAMSONITE','N','900518732-2','CC. FONTANAR LOC 2-48','','','','',' ',NULL,'A',NULL,NULL),(1006,5,'FERNANDO OBREGON','C','1201','','','','','',' ',NULL,'A',NULL,NULL),(1007,5,'PONBO CUELLAR Y COMPAÑIA','N','101','','','','','',' ',NULL,'A',NULL,NULL),(1008,7,'','0','','','','','','','','','','','');
/*!40000 ALTER TABLE `contaterceros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contatmpagos`
--

DROP TABLE IF EXISTS `contatmpagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contatmpagos` (
  `pagoid` int(11) NOT NULL AUTO_INCREMENT,
  `pagoempresa` int(11) DEFAULT NULL,
  `pagocedula` varchar(14) DEFAULT NULL,
  `pagoinmueble` varchar(10) DEFAULT NULL,
  `pagofecha` date DEFAULT NULL,
  `pagovalor` decimal(12,2) DEFAULT NULL,
  `pagoestado` char(1) DEFAULT NULL,
  `pagopropietarioid` int(11) DEFAULT NULL,
  `pagoinmuebleid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pagoid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatmpagos`
--

LOCK TABLES `contatmpagos` WRITE;
/*!40000 ALTER TABLE `contatmpagos` DISABLE KEYS */;
INSERT INTO `contatmpagos` VALUES (1,6,'','5049','0000-00-00',0.00,'P',0,0),(2,6,'','5049','0000-00-00',0.00,'P',0,0),(3,6,'','5049','0000-00-00',0.00,'P',0,0),(4,6,'','5049','0000-00-00',0.00,'P',0,0),(5,6,'','5053','0000-00-00',0.00,'P',0,0),(6,6,'','5053','0000-00-00',0.00,'P',0,0),(7,6,'','5057','0000-00-00',0.00,'P',0,0),(8,6,'','5060','0000-00-00',0.00,'P',0,0),(9,6,'','5061','0000-00-00',0.00,'P',0,0),(10,6,'','5061','0000-00-00',0.00,'P',0,0),(11,6,'','5061','0000-00-00',0.00,'P',0,0),(12,6,'','5061','0000-00-00',0.00,'P',0,0),(13,6,'','5073','0000-00-00',0.00,'P',0,0),(14,6,'','5073','0000-00-00',0.00,'P',0,0),(15,6,'','5073','0000-00-00',0.00,'P',0,0),(16,6,'','5073','0000-00-00',0.00,'P',0,0),(17,6,'','5064','0000-00-00',0.00,'P',0,0),(18,6,'','5064','0000-00-00',0.00,'P',0,0),(19,6,'','5069','0000-00-00',0.00,'P',0,0),(20,6,'','5072','0000-00-00',0.00,'P',0,0),(21,6,'','5078','0000-00-00',0.00,'P',0,0);
/*!40000 ALTER TABLE `contatmpagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contausuarios`
--

DROP TABLE IF EXISTS `contausuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contausuarios` (
  `usuarioId` int(11) NOT NULL COMMENT 'ID',
  `usuarioEmpresaId` int(11) NOT NULL COMMENT 'EMPRESA',
  `usuarioUsuario` varchar(20) NOT NULL COMMENT 'USUARIO',
  `usuarioClave` varchar(50) NOT NULL COMMENT 'CLAVE',
  `usuarioNombre` varchar(40) NOT NULL COMMENT 'NOMBRE',
  `usuarioAplicacion` char(1) NOT NULL COMMENT 'MODULO',
  `usuarioPerfil` char(1) NOT NULL COMMENT 'PERFIL',
  `usuarioFechaCreacion` date DEFAULT NULL COMMENT 'Fch CREACION',
  `usuarioFechaVigencia` date DEFAULT NULL COMMENT 'Fch VIGENCIA',
  `usuarioActivo` char(1) NOT NULL COMMENT 'ACTIVO',
  `usuarioCedula` varchar(10) DEFAULT NULL COMMENT 'CEDULA',
  `usuarioDireccion` varchar(45) DEFAULT NULL COMMENT 'DIRECCION',
  `usuarioCiudad` varchar(45) DEFAULT NULL COMMENT 'CIUDAD',
  `usuarioEmail` varchar(45) DEFAULT NULL COMMENT 'E-MAIL',
  `usuarioTelefonos` varchar(20) DEFAULT NULL COMMENT 'TELEFONOS',
  `usuarioCelular` varchar(10) DEFAULT NULL COMMENT 'CELULAR',
  PRIMARY KEY (`usuarioId`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contausuarios`
--

LOCK TABLES `contausuarios` WRITE;
/*!40000 ALTER TABLE `contausuarios` DISABLE KEYS */;
INSERT INTO `contausuarios` VALUES (1,1,'mpk','202cb962ac59075b964b07152d234b70','Mauricio Pardo','C','A','2012-07-01','2017-12-31','A','123123','CRA 45','BOGOTA','mpk@mpk.com','','31055'),(4,2,'amo','202cb962ac59075b964b07152d234b70','Angela Maria Ortiz','C','A','2012-07-01','2017-12-31','A',NULL,NULL,'Bogotá','terra@mpk.com',NULL,NULL),(129,3,'mpksas','202cb962ac59075b964b07152d234b70','Empresa MPK SAS','C','A','2012-09-08','2017-12-31','A','80965554','','Bogotá','otra@mpk.com','','2344444'),(7,4,'terrakot','202cb962ac59075b964b07152d234b70','empresa TERRAKOT','C','A','2012-07-01','2017-12-31','A','','','Bogotá','oyc@mi.com','',''),(41,5,'okre','202cb962ac59075b964b07152d234b70','Empresa OKRE','C','A','2012-07-01','2017-12-31','A','','','Bogotá','adm2@mi.com','',''),(2,1,'admin','202cb962ac59075b964b07152d234b70','administrador ','C','A','2012-07-01','2017-12-31','A',NULL,NULL,'Bogotá','adm1@mi.com',NULL,NULL),(3,7,'oyc','72a52cf2f2c5082ff3530c15e97255e2','Pruebas conjunto','T','A','2017-09-08','2017-12-31','A','80965554','','Bogotà','oyc@mi.com','','2344444'),(140,6,'alvaro','202cb962ac59075b964b07152d234b70','Admiistrador conjuntos','P','A','2012-01-12','2017-12-31','A','3125444','','','','',''),(141,6,'aortiz','c5cbb9bb4822f8cf927e42d064ca9a1e','Alvaro Ortiz C.','T','A','2015-12-31','2020-12-31','A',NULL,NULL,NULL,'alvaro@com.co',NULL,'3174142133'),(142,7,'test','68eacb97d86f0c4621fa2b0e17cabd8c','Pruebas sistema MCR','T','A','2016-02-01','2019-12-31','A','123','PRUEBAS','PRUEBAS','','','123'),(143,4,'terrakot1','202cb962ac59075b964b07152d234b70','MAURICIO PARDO','C','C','2016-10-01','2017-12-31','A','','','Bogotá','mpardo@co.com','','123456');
/*!40000 ALTER TABLE `contausuarios` ENABLE KEYS */;
UNLOCK TABLES;

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
  `usuario_empresa` int(11) DEFAULT NULL,
  `usuario_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  `usuario_email` varchar(80) COLLATE utf8_spanish_ci NOT NULL COMMENT 'LOGIN',
  `usuario_celular` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_password` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'PASSWORD',
  `usuario_tipo_acceso` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'ACCESO',
  `usuario_fechaCreado` date DEFAULT NULL,
  `usuario_fechaActualizado` date DEFAULT NULL,
  `usuario_perfil` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_avatar` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_tipodoc` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_nrodoc` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_ciudad` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_usuarios`
--

LOCK TABLES `mm_usuarios` WRITE;
/*!40000 ALTER TABLE `mm_usuarios` DISABLE KEYS */;
INSERT INTO `mm_usuarios` VALUES (1,1,'admin','admin@com.co','3101231231','202cb962ac59075b964b07152d234b70','A','2018-12-31','2018-12-31','1','ava3.png','A',NULL,'admin','',''),(2,6,'Alvarín','aortiz@com.co','3300','202cb962ac59075b964b07152d234b70','A','2019-04-22','2019-04-22','1','avatar.png','A','','123456','Avenila Lopez','chaicas'),(3,1,'comercio','aoc@com','2200','202cb962ac59075b964b07152d234b70','S','2019-05-05','2020-05-05','1','avatar.png','A',NULL,'comercio',NULL,NULL),(4,1,'Pedro','pep','123','123','C','2019-09-01','2019-09-01','1','avatar.png','A','','980058585','Chua','dide'),(5,6,'Ejemplo','adm@com.co','123','202cb962ac59075b964b07152d234b70','S','2019-09-01','2019-09-01','1','ava4.png','A','','123','cra','bta');
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

-- Dump completed on 2019-10-18 20:53:20
