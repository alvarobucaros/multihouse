-- MySQL dbcreate database for multimeeting
--
-- Host: localhost
-- Database:atominge_ncr
-- Script date Friday,Apr 05, 2019 6:34:14
-- by AtomIngenieria sas

--
-- Crea Base de datos
--
-- CREATE DATABASE atominge_ncr CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE atominge_ncr; 

DROP TABLE IF EXISTS contatmpcartera;

CREATE TABLE contatmpcartera (
  pagoid int(11) NOT NULL AUTO_INCREMENT,
  pagoempresa int(11) DEFAULT NULL,
  pagofchfac date DEFAULT NULL,
  pagofchvnc date DEFAULT NULL,
  pagovalor decimal(12,2) DEFAULT NULL,
  pagodias int(11) DEFAULT NULL,
  pagoinmuebleid int(11) DEFAULT NULL,
  pagopropietarioid int(11) DEFAULT NULL,
  pagoCrnte decimal(12,2) DEFAULT NULL,
  pago0130 decimal(12,2) DEFAULT NULL,
  pago3160 decimal(12,2) DEFAULT NULL,
  pago6190 decimal(12,2) DEFAULT NULL,
  pago91120 decimal(12,2) DEFAULT NULL,
  pago121mas decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (pagoid)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS contaacuerdos;

CREATE TABLE contaacuerdos (
  acuerdoid int(11) NOT NULL AUTO_INCREMENT,
  acuerdoempresa int(11) NOT NULL,
  acuerdoinmueble int(11) DEFAULT NULL,
  acuerdofecha date DEFAULT NULL,
  acuerdovalor decimal(12,2) DEFAULT NULL,
  acuerdoplazo int(11) DEFAULT NULL,
  acuerdodetalle varchar(2000) DEFAULT NULL,
  acuerdopropietario int(11) DEFAULT NULL,
  acuerdomora decimal(12,2) DEFAULT NULL,
  acuerdocorriente decimal(12,2) DEFAULT NULL,
  acuerdodescmora decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (acuerdoid)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='anticipos';

DROP TABLE IF EXISTS contaclasificacion;

CREATE TABLE contaclasificacion (
  clasificacionId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  clasificacionEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  clasificacionCodigo varchar(10) DEFAULT NULL COMMENT 'CODIGO',
  clasificacionDetalle varchar(45) DEFAULT NULL COMMENT 'DETALLE',
  PRIMARY KEY (clasificacionId)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8;

--
-- Table structure for table contacomprobantes
--

DROP TABLE IF EXISTS contacomprobantes;
  
CREATE TABLE contacomprobantes (
  compId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  compEmpresaId int(11) NOT NULL COMMENT 'EMPRESA',
  compCodigo char(3) DEFAULT NULL COMMENT 'CODIGO',
  compNombre varchar(45) NOT NULL COMMENT 'NOMBRE',
  compConsecutivo int(11) NOT NULL COMMENT 'SECUENCIA',
  compActivo char(1) NOT NULL COMMENT 'ACTIVO',
  compDetalle varchar(100) DEFAULT NULL COMMENT 'DETALLE',
  PRIMARY KEY (compId),
  UNIQUE KEY comprId_UNIQUE (compId)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

INSERT INTO contacomprobantes VALUES (1,1,'01','FACTURA',0,'A','Cuentas de cobro');
INSERT INTO contacomprobantes VALUES (1,1,'02','PAGOS',0,'A','Recibos de Caja');
--
-- Table structure for table contadptos
--

DROP TABLE IF EXISTS contadptos;
 
CREATE TABLE contadptos (
  DeptoCod int(11) NOT NULL,
  DeptoNombre varchar(45) DEFAULT NULL,
  PRIMARY KEY (DeptoCod)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO contadptos VALUES (5,'ANTIOQUIA'),(8,'ATLANTICO'),(11,'BOGOTA, D.C.'),(13,'BOLIVAR'),(15,'BOYACA'),(17,'CALDAS'),(18,'CAQUETA'),(19,'CAUCA'),(20,'CESAR'),(23,'CORDOBA'),(25,'CUNDINAMARCA'),(27,'CHOCO'),(41,'HUILA'),(44,'LA GUAJIRA'),(47,'MAGDALENA'),(50,'META'),(52,'NARINO'),(54,'NORTE DE SANTANDER'),(63,'QUINDIO'),(66,'RISARALDA'),(68,'SANTANDER'),(70,'SUCRE'),(73,'TOLIMA'),(76,'VALLE DEL CAUCA'),(81,'ARAUCA'),(85,'CASANARE'),(86,'PUTUMAYO'),(88,'ARCHIPIELAGO DE SAN ANDRES'),(91,'AMAZONAS'),(94,'GUAINIA'),(95,'GUAVIARE'),(97,'VAUPES'),(99,'VICHADA');

--
-- Table structure for table contaempresas
--

DROP TABLE IF EXISTS contaempresas;
  
 
CREATE TABLE contaempresas (
  empresaId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  empresaClave char(10) NOT NULL DEFAULT '' COMMENT 'CLAVE',
  empresaNombre varchar(50) NOT NULL DEFAULT '' COMMENT 'NOMBRE',
  empresaNit char(10) NOT NULL DEFAULT '' COMMENT 'NIT',
  empresaDigito char(1) NOT NULL DEFAULT '0' COMMENT 'DIGITO',
  empresaDireccion varchar(45) NOT NULL COMMENT 'DIRECCION',
  empresaCiudad varchar(45) DEFAULT NULL,
  empresaTelefonos varchar(40) NOT NULL COMMENT 'TELEFONOS',
  empresaFchCreacion date NOT NULL COMMENT 'FCH CREACION',
  empresaFchModificacion date NOT NULL COMMENT 'FCH MODIFICA',
  empresaFchVigencia date NOT NULL COMMENT 'FCH VIGENCIA',
  empresaPeriodoActual char(6) NOT NULL COMMENT 'PERIODO',
  empresaTwiter varchar(45) DEFAULT NULL COMMENT 'CUENTA TWITER',
  empresaFacebook varchar(45) DEFAULT NULL COMMENT 'CUENTA FACEBOOK',
  empresaWeb varchar(45) DEFAULT NULL COMMENT 'PAGINA WEB',
  empresaEmail varchar(45) DEFAULT NULL COMMENT 'CUENTA CORREO',
  empresaActiva char(1) NOT NULL COMMENT 'ACTIVA',
  empresaPuertoCorreo int(11) DEFAULT NULL COMMENT 'PRTO_EMAIL',
  empresaRepresentante varchar(45) NOT NULL COMMENT 'REPREENTANTE LEGAL',
  empresaIdentifRepresentante varchar(10) NOT NULL COMMENT 'CEDULA REPREENTANTE',
  empresaContador varchar(45) DEFAULT NULL COMMENT 'CONTADOR',
  empresaMatriculaContador varchar(10) DEFAULT NULL COMMENT 'MATRICULA CONTADOR',
  empresaIdentifContador varchar(10) DEFAULT NULL COMMENT 'CEDULA CONTADOR',
  empresaRevisor varchar(45) DEFAULT NULL COMMENT 'REVISOR FISCAL',
  empresaMatriculaRevisor varchar(10) DEFAULT NULL COMMENT 'MATRICULA REVISOR',
  empresaIdentifRevisor varchar(10) DEFAULT NULL COMMENT 'CEDULA REVISOR',
  empresaAnoFiscal char(4) DEFAULT NULL COMMENT 'ANO FISCAL',
  empresaEstructura varchar(20) DEFAULT NULL COMMENT 'ESTRUCTURA',
  empresaAdministrador varchar(45) DEFAULT NULL COMMENT 'ADMINISTRADOR',
  empresaAdministradorCed varchar(10) DEFAULT NULL COMMENT 'CEDULA ADMON',
  empresaSecretaria varchar(45) DEFAULT NULL COMMENT 'SECRETARIA',
  empresaSecretariaCedula varchar(10) DEFAULT NULL COMMENT 'CEDULA SECRETARIA',
  empresaMensaje1 varchar(400) DEFAULT NULL COMMENT 'MENSAJE 1',
  empresaMensaje2 varchar(400) DEFAULT NULL COMMENT 'MENSAJE 2',
  empresaPeriodoFactura varchar(6) DEFAULT NULL COMMENT 'PERIODO FACTURA',
  empresaPeriCierreFactura varchar(6) DEFAULT NULL COMMENT 'PERIODO CERRADO',
  empresaCompFra char(2) DEFAULT NULL COMMENT 'COMPR FACTURA',
  empresaCompRcaja char(2) DEFAULT NULL COMMENT 'COMPR RCAJA',
  empresaCompAjustes char(2) DEFAULT NULL COMMENT 'COMPR AJUSTES',
  empresaCompEgreso char(2) DEFAULT NULL,
  empresaCompCierreMes char(2) DEFAULT NULL,
  empresaCompApertura char(2) DEFAULT NULL,
  empresaCuentaCierre varchar(10) DEFAULT NULL,
  empresaCuentaCaja varchar(10) DEFAULT NULL COMMENT 'CUENTA CAJA',
  empresaRecargoPorc decimal(8,2) DEFAULT NULL COMMENT 'MORA PORC',
  empresaRecargoPesos decimal(8,2) DEFAULT NULL COMMENT 'MORA EN PESOS',
  empresaRecargoDias int(11) DEFAULT NULL COMMENT 'MORA DIAS',
  empresaDescPorc decimal(8,2) DEFAULT NULL COMMENT 'DESCNTO PORC',
  empresaDescPesos decimal(8,2) DEFAULT NULL COMMENT 'DESCNTO PESOS',
  empresaDescDias int(11) DEFAULT NULL COMMENT 'DESCNTO DIAS',
  empresaPagosParciales char(1) DEFAULT NULL COMMENT 'PAGOS PARCIALES',
  empresaPeriodosAnuales int(11) DEFAULT NULL COMMENT 'PERIODOS ANUALES',
  empresaFactorRedondeo char(1) DEFAULT NULL COMMENT 'REDONDEO',
  empresaConsecRcaja varchar(10) DEFAULT NULL COMMENT 'CONSEC RCAJA',
  empresaConsecFactura varchar(10) DEFAULT NULL COMMENT 'CONSEC FACTURA',
  empresaIdioma char(2) DEFAULT NULL,
  empresaNroInmuebles int(11) DEFAULT NULL,
  empresaLogo varchar(45) DEFAULT NULL,
  empresaccosto char(1) DEFAULT NULL,
  empresaservicios char(1) DEFAULT NULL,
  empresafacturaNota varchar(1000) DEFAULT NULL,
  empresafacturaresDIAN varchar(200) DEFAULT NULL,
  empresafacturaNumeracion varchar(200) DEFAULT NULL,
  empresafacturanotaiva varchar(200) DEFAULT NULL,
  empresafacturanotaica varchar(200) DEFAULT NULL,
  empresafacturactacxc varchar(20) DEFAULT NULL,
  empresafacturactaivta varchar(20) DEFAULT NULL,
  empresafacturactaica varchar(20) DEFAULT NULL,
  empresafacturactaiva varchar(20) DEFAULT NULL,
  empresaRegimen char(1) DEFAULT NULL,
  empresaporcentajeiva decimal(6,2) DEFAULT NULL,
  empresaAutentica char(1) DEFAULT NULL,
  empresaVersionPrd varchar(45) DEFAULT NULL,
  empresaVersionBd varchar(45) DEFAULT NULL,
  empresaRegistrosXpagina int(11) DEFAULT NULL,
  PRIMARY KEY (empresaId),
  UNIQUE KEY empresaId_UNIQUE (empresaId)
) ENGINE=MyISAM AUTO_INCREMENT=4082 DEFAULT CHARSET=latin1;

INSERT INTO contaempresas VALUES (1,'PRUEBAS','CONJUNTO PARA MIS PRUEBAS ','13808659','1','CRA 54 # 55-44','Bogota','3174142133','2015-10-01','2015-01-01','2020-12-31','201801','','','atomingenieria.com/lb','','A',0,'Carlos Javier Romero','65444444','ANITA GARCIA','T 6782','51825654','','','','2015','X-X-XX-XX-XX-XXXXX','JUAN FELIPE CARDENAS','74859600','DORA VILLALBA','102568741','El pago oportuno de esta factura evita intereses moratoios','Cuidemos el medio ambiente, apoye nuestra campaña de reciclage.','201801','201712','01','01','01','02','05','08','360505','0000000001',2.00,0.00,12,1.00,0.00,10,'S',12,'C','00000000','183','ES',36,'losBrevos.png','S','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000','','','25','','25','25','C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20);

--
-- Table structure for table contafactdef
--

DROP TABLE IF EXISTS contafactdef;
   
CREATE TABLE contafactdef (
  factdefid int(6) unsigned NOT NULL AUTO_INCREMENT,
  factdefempresa int(11) NOT NULL,
  factdefnro int(11) NOT NULL,
  factdefcliente int(11) NOT NULL,
  factdeffechcrea date DEFAULT NULL,
  factdeffechvence date DEFAULT NULL,
  factdefvalor decimal(12,2) DEFAULT NULL,
  factdefiva decimal(12,2) DEFAULT NULL,
  factdefsaldo decimal(12,2) DEFAULT NULL,
  factdefneto decimal(12,2) DEFAULT NULL,
  factdefcontabiliza decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (factdefid)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Table structure for table contafactserviciomvt
--

DROP TABLE IF EXISTS contafactserviciomvt;
  
 
CREATE TABLE contafactserviciomvt (
  factmvtid int(6) unsigned NOT NULL AUTO_INCREMENT,
  factmvtfacdef int(11) NOT NULL,
  factmvtdetalle varchar(500) DEFAULT NULL,
  factmvtvalor decimal(12,2) DEFAULT NULL,
  factmvtivaporc decimal(12,2) DEFAULT NULL,
  factmvtivavalor decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (factmvtid)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Table structure for table contafactura
--

DROP TABLE IF EXISTS contafactura;
  
CREATE TABLE contafactura (
  facturaid int(11) NOT NULL AUTO_INCREMENT,
  facturaEmpresaid int(11) DEFAULT NULL,
  facturaNumero varchar(10) DEFAULT NULL,
  facturaInmuebleid int(11) DEFAULT NULL,
  facturaservicioid int(11) DEFAULT NULL,
  facturaperiodo varchar(6) DEFAULT NULL,
  facturasecuencia int(11) DEFAULT NULL,
  facturavalor decimal(12,2) DEFAULT NULL,
  facturadetalle varchar(100) DEFAULT NULL,
  facturafechafac date DEFAULT NULL,
  facturafechavence date DEFAULT NULL,
  facturafechacontrol date DEFAULT NULL,
  facturasaldo decimal(12,2) DEFAULT NULL,
  facturaprioridad int(11) DEFAULT NULL,
  facturadescuento decimal(12,2) DEFAULT NULL,
  facturaMora decimal(12,2) DEFAULT NULL,
  facturaNroReciboPago varchar(12) DEFAULT NULL,
  facturaTipo char(1) DEFAULT NULL,
  facturaPropietario int(11) DEFAULT NULL,
  facturaDiasMora int(11) DEFAULT NULL,
  facturaMoraInmuebId int(11) DEFAULT NULL,
  facturaAcuerdo int(11) DEFAULT NULL,
  PRIMARY KEY (facturaid)
) ENGINE=InnoDB AUTO_INCREMENT=1748 DEFAULT CHARSET=latin1;
--
-- Table structure for table containgregastos
--

DROP TABLE IF EXISTS containgregastos;
  
CREATE TABLE containgregastos (
  ingastoid int(11) NOT NULL AUTO_INCREMENT,
  ingastoempresa int(11) DEFAULT NULL,
  ingastoFecha date DEFAULT NULL,
  ingastoperiodo char(6) DEFAULT NULL,
  ingastotipo char(1) DEFAULT NULL,
  ingastocomprobante int(11) DEFAULT NULL,
  ingastodetalle varchar(200) DEFAULT NULL,
  ingastoDocumento varchar(15) DEFAULT NULL,
  ingastovalor decimal(12,2) DEFAULT NULL,
  ingastocontabiliza char(1) DEFAULT NULL,
  PRIMARY KEY (ingastoid)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO containgregastos VALUES (1,1,'2018-01-01','201801','A',0,'SALDOS INICIALES','0',0.00,'N');

--
-- Table structure for table containmueblepropietario
--

DROP TABLE IF EXISTS containmueblepropietario;
  
CREATE TABLE containmueblepropietario (
  contaInmuPropietarioId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  contaInmuPropietarioEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  contaInmuPropietarioInmuebleId int(11) DEFAULT NULL COMMENT 'INMUEBLE',
  contaInmuPropietarioPropietarioId int(11) DEFAULT NULL COMMENT 'PROPIETARIO',
  PRIMARY KEY (contaInmuPropietarioId)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8;

--
-- Table structure for table containmuebles
--

DROP TABLE IF EXISTS containmuebles;

CREATE TABLE containmuebles (
  inmuebleId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  inmuebleEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  inmuebleCodigo varchar(10) NOT NULL COMMENT 'CODIGO',
  inmuebleDescripcion varchar(45) NOT NULL COMMENT 'DESCRIPCION',
  inmueblePrincipal varchar(10) DEFAULT NULL COMMENT 'PRINCIPAL',
  inmuebleArea decimal(8,2) DEFAULT NULL COMMENT 'AREA',
  inmuebleCoeficiente decimal(10,6) DEFAULT NULL COMMENT 'COEFICIENTE',
  inmuebleUbicacion varchar(45) DEFAULT NULL COMMENT 'UBICACION',
  inmuebleClasificacionId int(11) DEFAULT NULL COMMENT 'CLASIFICACION',
  inmuebleDepende varchar(10) DEFAULT NULL,
  PRIMARY KEY (inmuebleId)
) ENGINE=InnoDB AUTO_INCREMENT=5079 DEFAULT CHARSET=utf8;

--
-- Table structure for table containmuebleservicios
--

DROP TABLE IF EXISTS containmuebleservicios;
   
CREATE TABLE containmuebleservicios (
  InmuebleServicioId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  InmuebleServicioEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  InmuebleServicioInmuebleId int(11) DEFAULT NULL COMMENT 'INMUEBLE',
  InmuebleServicioServicioId int(11) DEFAULT NULL COMMENT 'SERVICIO',
  InmuebleServicioMonto decimal(12,2) DEFAULT NULL COMMENT 'MONTO',
  InmuebleServicioCuota decimal(12,2) DEFAULT NULL COMMENT 'VALOR CUOTA',
  InmuebleServicioSaldo decimal(12,2) DEFAULT NULL COMMENT 'SALDO',
  InmuebleServicioFechaInicio date DEFAULT NULL COMMENT 'FECHA INICIO',
  InmuebleServicioActivo char(1) DEFAULT NULL COMMENT 'ACTIVO',
  PRIMARY KEY (InmuebleServicioId)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Table structure for table contamovicabeza
--

DROP TABLE IF EXISTS contamovicabeza;
  
CREATE TABLE contamovicabeza (
  movicaId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  movicaEmpresaId int(11) NOT NULL COMMENT 'EMPRESA',
  movicaComprId char(3) NOT NULL COMMENT 'COMPROBANTE',
  movicaCompNro int(11) DEFAULT NULL COMMENT 'NUMERO',
  movicaTerceroId int(11) NOT NULL COMMENT 'TERCERO',
  movicaDetalle varchar(128) NOT NULL COMMENT 'DETALLE',
  movicaProcesado char(1) NOT NULL COMMENT 'PROCESADO',
  movicaFecha date NOT NULL COMMENT 'FECHA',
  movicaPeriodo char(6) NOT NULL COMMENT 'PERIODO',
  movicaDocumPpal varchar(20) DEFAULT NULL,
  movicaDocumSec varchar(20) DEFAULT NULL,
  PRIMARY KEY (movicaId),
  UNIQUE KEY moviId_UNIQUE (movicaId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table contamovidetalle
--

DROP TABLE IF EXISTS contamovidetalle;
  
CREATE TABLE contamovidetalle (
  moviConId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  moviConCabezaId int(11) NOT NULL COMMENT 'CABEZA',
  moviConDetalle varchar(128) NOT NULL COMMENT 'DETALLE',
  moviConCuenta varchar(20) DEFAULT NULL COMMENT 'CUENTA',
  moviConDebito decimal(12,2) NOT NULL COMMENT 'VALOR DEBITO',
  moviConCredito decimal(12,2) NOT NULL COMMENT 'VALOR CREDITO',
  moviConBase decimal(12,2) NOT NULL COMMENT 'BASE',
  moviConImpTipo char(1) DEFAULT NULL COMMENT 'TIPO IMPUESTO',
  moviConImpPorc decimal(6,2) DEFAULT NULL COMMENT 'IMPUESTO %',
  moviConImpValor decimal(12,2) DEFAULT NULL COMMENT 'IMPUESTO VALOR',
  moviConIdTercero int(11) DEFAULT NULL,
  moviConIdCadmin int(11) DEFAULT NULL,
  moviConIdCcosto int(11) DEFAULT NULL,
  moviDocum1 varchar(20) DEFAULT NULL,
  moviDocum2 varchar(20) DEFAULT NULL,
  PRIMARY KEY (moviConId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table contapagos
--

DROP TABLE IF EXISTS contapagos;
   
CREATE TABLE contapagos (
  pagosid int(11) NOT NULL AUTO_INCREMENT,
  pagosempresa int(11) DEFAULT NULL,
  pagosfacturaid int(11) DEFAULT NULL,
  pagosfecha date DEFAULT NULL,
  pagostipo char(1) DEFAULT NULL,
  pagosvalor decimal(12,2) DEFAULT NULL,
  pagosreferencia varchar(50) DEFAULT NULL,
  pagosNrReciCaja varchar(12) DEFAULT NULL,
  pagosinmueble int(11) DEFAULT NULL,
  pagosTipoPago char(1) DEFAULT NULL,
  pagosPeriodoPago varchar(6) DEFAULT NULL,
  pagosEstado char(1) DEFAULT NULL,
  PRIMARY KEY (pagosid)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Table structure for table contapropietarios
--

DROP TABLE IF EXISTS contapropietarios;
  
CREATE TABLE contapropietarios (
  propietarioId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  propietarioEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  propietarioNombre varchar(50) NOT NULL COMMENT 'NOMBRE',
  propietarioCedula varchar(10) DEFAULT NULL COMMENT 'CEDULA',
  propietarioTelefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS',
  propietarioDireccion varchar(45) DEFAULT NULL COMMENT 'DIRECCION',
  propietarioCorreo varchar(45) DEFAULT NULL COMMENT 'E-MAIL',
  propietarioActivo char(1) DEFAULT NULL COMMENT 'ACTIVO',
  PRIMARY KEY (propietarioId)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

--
-- Table structure for table contaredondeo
--

DROP TABLE IF EXISTS contaredondeo;
 
CREATE TABLE contaredondeo (
  redondeoId int(11) NOT NULL AUTO_INCREMENT,
  redondeoCodigo char(1) DEFAULT NULL,
  redondeoDetalle varchar(10) DEFAULT NULL,
  PRIMARY KEY (redondeoId)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO contaredondeo VALUES (1,'L','Cincuenta'),(2,'C','Cien'),(3,'Q','Qunientos'),(4,'M','Mil');

--
-- Table structure for table contaresidentes
--

DROP TABLE IF EXISTS contaresidentes;
  
 
CREATE TABLE contaresidentes (
  residenteId int(11) NOT NULL,
  residenteNombre varchar(45) DEFAULT NULL,
  residenteCedula varchar(10) DEFAULT NULL,
  residenteTipo char(1) DEFAULT NULL,
  PRIMARY KEY (residenteId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table contaservicios
--

DROP TABLE IF EXISTS contaservicios; 
 
CREATE TABLE contaservicios (
  ServicioId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  servicioEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  ServicioCodigo char(8) NOT NULL COMMENT 'CODIGO',
  ServicioDetalle varchar(80) NOT NULL COMMENT 'DETALLE',
  ServicioPeriodo char(6) NOT NULL COMMENT 'PERIODO',
  ServicioFechaDesde date NOT NULL COMMENT 'FECHA DESDE',
  ServicioFechaHasta date NOT NULL COMMENT 'FECHA HASTA',
  ServicioValor decimal(12,2) NOT NULL COMMENT 'VALOR',
  ServicioPrioridad int(11) DEFAULT NULL COMMENT 'PRIORIDAD',
  ServicioTipo char(1) DEFAULT NULL COMMENT 'TIPO',
  ServicioMora char(1) DEFAULT NULL COMMENT 'MORA',
  ServicioMoraPorcentaje decimal(6,2) DEFAULT NULL COMMENT '% MORA',
  servicioMoraValor decimal(12,2) DEFAULT NULL COMMENT 'VALOR MORA',
  ServicioCuentaDB varchar(10) DEFAULT NULL COMMENT 'CUENTA DB',
  ServicioCuentaCR varchar(10) DEFAULT NULL COMMENT 'CUENTA CR',
  ServicioPPporcentaje decimal(6,2) DEFAULT NULL COMMENT '% PRONTO PAGO',
  ServicioPPvalor decimal(12,2) DEFAULT NULL COMMENT '$ PRONTO PAGO',
  ServicioActivo char(1) DEFAULT NULL COMMENT 'ACTIVO',
  ServicioAmbito char(1) DEFAULT NULL COMMENT 'AMBITO',
  servicioClasificacionId int(11) DEFAULT NULL COMMENT 'CLASIFICACION',
  PRIMARY KEY (ServicioId)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

INSERT INTO contaservicios VALUES (1,1,'ANTI','Anticipos','2020','2020-01-01','2030-01-01',0.00,3,'C','N',0.00,0.00,'1','2',0.00,0.00,'S','G',0);
INSERT INTO contaservicios VALUES (1,1,'ACUERDO','Acuerdo de pago','2020','2020-01-01','2030-01-01',0.00,3,'C','N',0.00,0.00,'1','2',0.00,0.00,'S','G',0);

--
-- Table structure for table contaterceros
--

DROP TABLE IF EXISTS contaterceros;
  
 
CREATE TABLE contaterceros (
  terceroId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  terceroEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  terceroNombre varchar(100) DEFAULT NULL COMMENT 'NOMBRE',
  terceroIdenTipo char(1) DEFAULT NULL COMMENT 'TIPO ID',
  terceroIdenNumero varchar(20) DEFAULT NULL,
  terceroDireccion varchar(50) DEFAULT NULL COMMENT 'DIRECCION',
  terceroTelefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS',
  terceroCorreo varchar(50) DEFAULT NULL COMMENT 'E-MAIL',
  terceroTwiter varchar(50) DEFAULT NULL COMMENT 'CTA TWITER',
  terceroFacebook varchar(50) DEFAULT NULL COMMENT 'CTA FACEBOOK',
  terceroComentario varchar(128) DEFAULT NULL COMMENT 'COMENTARIOS',
  tercero_codigo varchar(10) DEFAULT NULL,
  terceroActivo char(1) NOT NULL COMMENT 'ACTIVO',
  terceroRegimen char(1) DEFAULT NULL,
  terceroContribuyente char(1) DEFAULT NULL,
  PRIMARY KEY (terceroId),
  UNIQUE KEY terceroId_UNIQUE (terceroId)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8;


--
-- Table structure for table contatmpagos
--

DROP TABLE IF EXISTS contatmpagos;
  
 
CREATE TABLE contatmpagos (
  pagoid int(11) NOT NULL AUTO_INCREMENT,
  pagoempresa int(11) DEFAULT NULL,
  pagocedula varchar(14) DEFAULT NULL,
  pagoinmueble varchar(10) DEFAULT NULL,
  pagofecha date DEFAULT NULL,
  pagovalor decimal(12,2) DEFAULT NULL,
  pagoestado char(1) DEFAULT NULL,
  pagopropietarioid int(11) DEFAULT NULL,
  pagoinmuebleid int(11) DEFAULT NULL,
  pagodetalle varchar(100) DEFAULT NULL,
  PRIMARY KEY (pagoid)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Table structure for table contausuarios
--

DROP TABLE IF EXISTS contausuarios;
  
 
CREATE TABLE contausuarios (
  usuarioId int(11) NOT NULL COMMENT 'ID',
  usuarioEmpresaId int(11) NOT NULL COMMENT 'EMPRESA',
  usuarioUsuario varchar(20) NOT NULL COMMENT 'USUARIO',
  usuarioClave varchar(50) NOT NULL COMMENT 'CLAVE',
  usuarioNombre varchar(40) NOT NULL COMMENT 'NOMBRE',
  usuarioAplicacion char(1) NOT NULL COMMENT 'MODULO',
  usuarioPerfil char(1) NOT NULL COMMENT 'PERFIL',
  usuarioFechaCreacion date DEFAULT NULL COMMENT 'Fch CREACION',
  usuarioFechaVigencia date DEFAULT NULL COMMENT 'Fch VIGENCIA',
  usuarioActivo char(1) NOT NULL COMMENT 'ACTIVO',
  usuarioCedula varchar(10) DEFAULT NULL COMMENT 'CEDULA',
  usuarioDireccion varchar(45) DEFAULT NULL COMMENT 'DIRECCION',
  usuarioCiudad varchar(45) DEFAULT NULL COMMENT 'CIUDAD',
  usuarioEmail varchar(45) DEFAULT NULL COMMENT 'E-MAIL',
  usuarioTelefonos varchar(20) DEFAULT NULL COMMENT 'TELEFONOS',
  usuarioCelular varchar(10) DEFAULT NULL COMMENT 'CELULAR',
  PRIMARY KEY (usuarioId)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

INSERT INTO contausuarios VALUES (1,1,'admin','202cb962ac59075b964b07152d234b70','Administrador ','C','A','2012-07-01','2017-12-31','A','123123','CRA 45','BOGOTA','mpk@mpk.com','','31055'),(4,2,'amo','202cb962ac59075b964b07152d234b70','Angela Maria Ortiz','C','A','2012-07-01','2017-12-31','A',NULL,NULL,'Bogotá','terra@mpk.com',NULL,NULL),(129,3,'mpksas','202cb962ac59075b964b07152d234b70','Empresa MPK SAS','C','A','2012-09-08','2017-12-31','A','80965554','','Bogotá','otra@mpk.com','','2344444'),(7,4,'terrakot','202cb962ac59075b964b07152d234b70','empresa TERRAKOT','C','A','2012-07-01','2017-12-31','A','','','Bogotá','oyc@mi.com','',''),(41,5,'okre','202cb962ac59075b964b07152d234b70','Empresa OKRE','C','A','2012-07-01','2017-12-31','A','','','Bogotá','adm2@mi.com','',''),(2,1,'admin','202cb962ac59075b964b07152d234b70','administrador ','C','A','2012-07-01','2017-12-31','A',NULL,NULL,'Bogotá','adm1@mi.com',NULL,NULL),(3,7,'oyc','72a52cf2f2c5082ff3530c15e97255e2','Pruebas conjunto','T','A','2017-09-08','2017-12-31','A','80965554','','Bogotà','oyc@mi.com','','2344444'),(140,6,'alvaro','202cb962ac59075b964b07152d234b70','Admiistrador conjuntos','P','A','2012-01-12','2017-12-31','A','3125444','','','','',''),(141,6,'aortiz','c5cbb9bb4822f8cf927e42d064ca9a1e','Alvaro Ortiz C.','T','A','2015-12-31','2020-12-31','A',NULL,NULL,NULL,'alvaro@com.co',NULL,'3174142133'),(142,7,'test','68eacb97d86f0c4621fa2b0e17cabd8c','Pruebas sistema MCR','T','A','2016-02-01','2019-12-31','A','123','PRUEBAS','PRUEBAS','','','123'),(143,4,'terrakot1','202cb962ac59075b964b07152d234b70','MAURICIO PARDO','C','C','2016-10-01','2017-12-31','A','','','Bogotá','mpardo@co.com','','123456');

--
-- Table structure for table mm_empresa
--

DROP TABLE IF EXISTS mm_empresa;
  
 
CREATE TABLE mm_empresa (
  empresa_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  empresa_nombre varchar(120) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  empresa_nit varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'NIT',
  empresa_web varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'WEB',
  empresa_direccion varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'DIRECCION',
  empresa_telefonos varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'TELEFONOS',
  empresa_ciudad varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'CIUDAD',
  empresa_logo varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'LOGO',
  empresa_autentica char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_lenguaje char(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_versionPrd varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_versionBd varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_clave varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_email varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_registrsoXpagina int(11) DEFAULT NULL,
  empresa_diasTrabaja varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_horarioInicio varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_horarioTermina varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_intervaloCalendario char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_FormatoActa varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  empresa_cresidencial char(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'S es un conjunto residencial N no lo es',
  empresa_ctrl varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (empresa_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table mm_empresa
--

LOCK TABLES mm_empresa WRITE;
/*!40000 ALTER TABLE mm_empresa DISABLE KEYS */;
INSERT INTO mm_empresa VALUES (1,'ATOM INGENIERIA SAS','12345678','http://www.atomingenieria.com','Cra 54 55-44 Ap 412','3174142133','Bogota DC','logoEmpresa0.png','M','ING','TEST-201806','TEST-201806','TEST','alvaro.oycsoft@gmail.com',10,'L-M-M-J-V','7:00','19:00','M','Estandard','S','wefB875s13846s12518refd8624A12'),(2,'Colombiana de Comercio SAS','8009545','www.colcio.com','cara 56','78255','bta','logoEmpresa.png','C','ESP','2019colPrd','2019colBd','col','com',10,'L-M-M-J-V','7:00','18:00','M','Estandard','N','wefB875s13846s12518refd8624A12'),(3,'suma ltda','45678','www.suma','454','45','cali','logoEmpresa.png','C','ESP','2019sumaPrd','2019sumaBd','suma','s',10,'L-M-M-J-V','7:00','18:00','M','Estandard','S','wefB875s13846s12518refd8624A12');
/*!40000 ALTER TABLE mm_empresa ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table mm_usuarios
--

DROP TABLE IF EXISTS mm_usuarios;
  
 
CREATE TABLE mm_usuarios (
  usuario_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  usuario_empresa int(11) DEFAULT NULL,
  usuario_nombre varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'NOMBRE',
  usuario_email varchar(80) COLLATE utf8_spanish_ci NOT NULL COMMENT 'LOGIN',
  usuario_celular varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_password varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'PASSWORD',
  usuario_tipo_acceso char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'ACCESO',
  usuario_fechaCreado date DEFAULT NULL,
  usuario_fechaActualizado date DEFAULT NULL,
  usuario_perfil varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_avatar varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_estado char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_tipodoc char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_nrodoc varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_direccion varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_ciudad varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (usuario_id)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table mm_usuarios
--

LOCK TABLES mm_usuarios WRITE;
/*!40000 ALTER TABLE mm_usuarios DISABLE KEYS */;
INSERT INTO mm_usuarios VALUES (1,1,'admin','admin@com.co','3101231231','202cb962ac59075b964b07152d234b70','A','2018-12-31','2018-12-31','1','ava3.png','A',NULL,'admin','',''),(2,6,'Alvarín','aortiz@com.co','3300','202cb962ac59075b964b07152d234b70','A','2019-04-22','2019-04-22','1','avatar.png','A','','123456','Avenila Lopez','chaicas'),(3,1,'comercio','aoc@com','2200','202cb962ac59075b964b07152d234b70','S','2019-05-05','2020-05-05','1','avatar.png','A',NULL,'comercio',NULL,NULL),(4,1,'Pedro','pep','123','123','C','2019-09-01','2019-09-01','1','avatar.png','A','','980058585','Chua','dide'),(5,6,'Ejemplo','adm@com.co','123','202cb962ac59075b964b07152d234b70','S','2019-09-01','2019-09-01','1','ava4.png','A','','123','cra','bta');
/*!40000 ALTER TABLE mm_usuarios ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table mn_privilegios
--

DROP TABLE IF EXISTS mn_privilegios;
  
 
CREATE TABLE mn_privilegios (
  privilegio_id int(11) NOT NULL AUTO_INCREMENT,
  privilegio_perfil int(11) DEFAULT NULL,
  privilegio_menu int(11) DEFAULT NULL,
  PRIMARY KEY (privilegio_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table mn_privilegios
--

LOCK TABLES mn_privilegios WRITE;
/*!40000 ALTER TABLE mn_privilegios DISABLE KEYS */;
/*!40000 ALTER TABLE mn_privilegios ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-02 12:55:00
