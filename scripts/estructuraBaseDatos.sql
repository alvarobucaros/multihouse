USE atominge_ncr123

SET FOREIGN_KEY_CHECKS = 0;

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
  acuerdocorriente decimal(12,2)  DEFAULT NULL,
  acuerdodescmora decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (acuerdoid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Acuerdos de pago';

--
-- Table structure for table contaclasificacion
--

DROP TABLE IF EXISTS contaclasificacion;

CREATE TABLE contaclasificacion (
  clasificacionId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  clasificacionEmpresaId int(11) DEFAULT NULL COMMENT 'EMPRESA',
  clasificacionCodigo varchar(10) DEFAULT NULL COMMENT 'CODIGO',
  clasificacionDetalle varchar(45) DEFAULT NULL COMMENT 'DETALLE',
  PRIMARY KEY (clasificacionId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Clasificación de inmuebles';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relación de inmuebles';


--
-- Table structure for table contacomprobantes
--

DROP TABLE IF EXISTS contacomprobantes;

CREATE TABLE contacomprobantes (
  compId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  compEmpresaId int(11) NOT NULL COMMENT 'EMPRESA',
  compCodigo char(3) NOT NULL COMMENT 'CODIGO',
  compTipo char(1) NOT NULL,
  compNombre varchar(45) NOT NULL COMMENT 'NOMBRE',
  compDetalle varchar(100) DEFAULT NULL COMMENT 'DETALLE',
  compConsecutivo int(11) NOT NULL COMMENT 'SECUENCIA',
  compctadb0 varchar(20) DEFAULT NULL,
  compctadb1 varchar(20) DEFAULT NULL,
  compctadb2 varchar(20) DEFAULT NULL,
  compctacr0 varchar(20) DEFAULT NULL,
  compctacr1 varchar(20) DEFAULT NULL,
  compctacr2 varchar(20) DEFAULT NULL,
  compActivo char(1) NOT NULL COMMENT 'ACTIVO',
  compcpbnte char(3) DEFAULT NULL,
  PRIMARY KEY (compId),
  UNIQUE KEY comprId_UNIQUE (compId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Comprobantes contables y operaciones';

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
  empresatercero int(11) DEFAULT NULL,
  empresaProformaCon char(1) DEFAULT NULL,
  empresaProformaFac char(1) DEFAULT NULL,
  empresaProformaLimSup int(11) DEFAULT NULL,
  empresaProformaLimInf int(11) DEFAULT NULL,
  PRIMARY KEY (empresaId),
  UNIQUE KEY empresaId_UNIQUE (empresaId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Definición de la empresa o copropiedad';

--
-- Table structure for table contafactdef
--

DROP TABLE IF EXISTS contafactdef;

CREATE TABLE contafactdef (
  factdefid int(11)  NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Definición de una factura de venta';

--
-- Table structure for table contafactserviciomvt
--

DROP TABLE IF EXISTS contafactserviciomvt;

CREATE TABLE contafactserviciomvt (
  factmvtid int(11)  NOT NULL AUTO_INCREMENT,
  factmvtfacdef int(11) NOT NULL,
  factmvtdetalle varchar(500) DEFAULT NULL,
  factmvtvalor decimal(12,2) DEFAULT NULL,
  factmvtivaporc decimal(12,2) DEFAULT NULL,
  factmvtivavalor decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (factmvtid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Detalle de la factura de venta';


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Servicios prestados por la copropiedad';


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Tabla de propietarios de inmuebles';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Factura de servicios de la copropiedad';

--
-- Table structure for table containformes
--

DROP TABLE IF EXISTS containformes;

CREATE TABLE containformes (
  infoId int(11) NOT NULL AUTO_INCREMENT,
  infoEmpresa int(11) DEFAULT NULL,
  infoReporte varchar(10) DEFAULT NULL,
  infoLinea int(11) DEFAULT NULL,
  intoTipo char(1) DEFAULT NULL,
  infoCodigo varchar(20) DEFAULT NULL,
  infoNombre varchar(200) DEFAULT NULL,
  infoCuentasIN varchar(200) DEFAULT NULL,
  infoCuentasOUT varchar(200) DEFAULT NULL,
  infoFormula varchar(20) DEFAULT NULL,
  infoNro int(11) DEFAULT NULL,
  infoNotas varchar(45) DEFAULT NULL,
  infoIndenta int(11) DEFAULT NULL,
  infoNuevaPagina char(1) DEFAULT NULL,
  infoMultiplicador int(11) DEFAULT NULL,
  PRIMARY KEY (infoId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Detalle de los informes NIF';

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
  ingastoctadb varchar(20) DEFAULT NULL,
  ingastoctacr varchar(20) DEFAULT NULL,
  ingastotercero int(11) DEFAULT NULL,
  ingastocompctble char(3) DEFAULT NULL,
  PRIMARY KEY (ingastoid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Relación de ingresos y gastos de la copropiedad';


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relación de inmuebles por propietario';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Servicios que se le ofrece a un inmueble';

--
-- Table structure for table contalistactrl
--

DROP TABLE IF EXISTS contalistactrl;

CREATE TABLE contalistactrl (
  listactrl_id int(11) NOT NULL AUTO_INCREMENT,
  listactrl_empresa int(11) NOT NULL,
  listactrl_codigo varchar(45) NOT NULL,
  listactrl_estado char(1) NOT NULL,
  listactrl_llamado int(11) DEFAULT NULL,
  PRIMARY KEY (listactrl_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Control de llamados a lista en reuniones';

--
-- Table structure for table contallamalista
--

DROP TABLE IF EXISTS contallamalista;

CREATE TABLE contallamalista (
  lista_id int(11) NOT NULL AUTO_INCREMENT,
  lista_empresa int(11) DEFAULT NULL,
  lista_codigo varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_inmueble varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste1 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste2 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste3 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste4 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste5 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_asiste6 char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_area decimal(12,2) DEFAULT NULL,
  lista_coeficiente decimal(12,8) DEFAULT NULL,
  lista_propietario varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_cedula varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_obervacion varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  lista_descripcion varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (lista_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Control de asistentes a reunión';


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Encabezado del comprobante contable';

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
  moviDocum1 varchar(20) DEFAULT NULL,
  moviDocum2 varchar(20) DEFAULT NULL,
  moviTipoCta char(1) DEFAULT NULL,
  PRIMARY KEY (moviConId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Detalle del movimiento del comprobante';

--
-- Table structure for table contanotascont
--

DROP TABLE IF EXISTS contanotascont;

CREATE TABLE contanotascont (
  notaid int(11) NOT NULL AUTO_INCREMENT,
  notaempresa int(11) DEFAULT NULL,
  notareporte varchar(45) DEFAULT NULL,
  notacodigo varchar(45) DEFAULT NULL,
  notadetalle varchar(4500) DEFAULT NULL,
  PRIMARY KEY (notaid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Notas contables en los informes NIF';


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
) ENGINE=InnoDB AUTO_INCREMENT=1  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='relación de pagos';

--
-- Table structure for table contaplancontable
--

DROP TABLE IF EXISTS contaplancontable;

CREATE TABLE contaplancontable (
  pucId int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  pucEmpresaId int(11) NOT NULL COMMENT 'EMPRESA',
  pucCuenta varchar(20) DEFAULT NULL COMMENT 'CUENTA',
  pucNombre varchar(60) DEFAULT NULL COMMENT 'NOMBRE CUENTA',
  pucMayor varchar(20) DEFAULT NULL COMMENT 'MAYOR',
  pucNivel int(11) DEFAULT NULL COMMENT 'NIVEL',
  pucTipo char(1) DEFAULT NULL COMMENT 'TIPO',
  pucActivo char(1) DEFAULT NULL COMMENT 'ACTIVO',
  pucClase char(1) DEFAULT NULL COMMENT 'CLASE',
  pucValor decimal(2,0) DEFAULT NULL COMMENT 'VALOR',
  PRIMARY KEY (pucId),
  UNIQUE KEY pucId_UNIQUE (pucId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Plan de cuentas ';

--
-- Table structure for table contaredondeo
--

DROP TABLE IF EXISTS contaredondeo;

CREATE TABLE contaredondeo (
  redondeoId int(11) NOT NULL AUTO_INCREMENT,
  redondeoCodigo char(1) DEFAULT NULL,
  redondeoDetalle varchar(10) DEFAULT NULL,
  PRIMARY KEY (redondeoId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Factores de redondeo';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Tabla de residentes, No se está usando';

--
-- Table structure for table contasaldoscontables
--

DROP TABLE IF EXISTS contasaldoscontables;

CREATE TABLE contasaldoscontables (
  saldcontId int(11) NOT NULL AUTO_INCREMENT,
  saldcontEmpresaid int(11) NOT NULL,
  saldcontPeriodo char(6) NOT NULL,
  saldcontTipo char(4) NOT NULL,
  saldcontCuenta char(20) NOT NULL,
  saldcontCuentaContable char(20) NOT NULL,
  saldcontInicialDb decimal(18,2) NOT NULL,
  saldcontInicialCr decimal(18,2) NOT NULL,
  saldcontDebitos decimal(18,2) NOT NULL,
  saldcontCreditos decimal(18,2) NOT NULL,
  saldcontFinalDb decimal(18,2) NOT NULL,
  saldconFinalCr decimal(18,2) NOT NULL,
  saldconNeto decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (saldcontId),
  UNIQUE KEY saldcontId_UNIQUE (saldcontId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Relación de Saldos contables';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Relación de terceros - contabilidad';

--
-- Table structure for table contatipoinforme
--

DROP TABLE IF EXISTS contatipoinforme;
;
CREATE TABLE contatipoinforme (
  tipoId int(11) NOT NULL AUTO_INCREMENT,
  tipoEmpresa int(11) DEFAULT NULL,
  tipoCodigo varchar(6) DEFAULT NULL,
  tipoDetalle varchar(60) DEFAULT NULL,
  tipoEstado char(1) DEFAULT NULL,
  PRIMARY KEY (tipoId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Relación de informes NIF';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Temporal para el manejo de pagos';

--
-- Table structure for table contatmpbalance
--

DROP TABLE IF EXISTS contatmpbalance;

CREATE TABLE contatmpbalance (
  tmpbalid int(11) NOT NULL AUTO_INCREMENT,
  tmpbalempresa int(11) DEFAULT NULL,
  tmpbalreporte varchar(10) DEFAULT NULL,
  tmpbalcuenta varchar(20) DEFAULT NULL,
  tmpbalnombre varchar(45) DEFAULT NULL,
  tmpbalvalor01 decimal(20,2) DEFAULT NULL,
  tmpbalvalor02 decimal(20,2) DEFAULT NULL,
  tmpbalvalor03 decimal(20,2) DEFAULT NULL,
  tmpbalusuario int(11) DEFAULT NULL,
  tmptipo char(1) DEFAULT NULL,
  tmpbalIndenta int(11) DEFAULT NULL,
  tmpbalNuevaPagina char(1) DEFAULT NULL,
  tmpbalcodigo varchar(20) DEFAULT NULL,
  tmpbalnotas varchar(45) DEFAULT NULL,
  PRIMARY KEY (tmpbalid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Temporal para informes NIF';

--
-- Table structure for table contatmpcartera
--

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
  pagodetalle varchar(200) DEFAULT NULL,
  pagonompropietario varchar(200) DEFAULT NULL,
  pagoinmuebledesc varchar(200) DEFAULT NULL,
  PRIMARY KEY (pagoid)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Temporal pagos de carteras';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Usuarios de la aplicación';

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Empresa, para compatibilidad con MultiMeeting';

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
  usuario_perfil char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_avatar varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_estado char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_tipodoc char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_nrodoc varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_direccion varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  usuario_ciudad varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (usuario_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci  COMMENT='Relación de usuarios';


--
-- Table structure for table mn_privilegios
--

DROP TABLE IF EXISTS mn_privilegios;

CREATE TABLE mn_privilegios (
  privilegio_id int(11) NOT NULL AUTO_INCREMENT,
  privilegio_perfil int(11) DEFAULT NULL,
  privilegio_menu int(11) DEFAULT NULL,
  PRIMARY KEY (privilegio_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Lista de privilegios de usuarios';



ALTER TABLE contaacuerdos 
ADD CONSTRAINT FK_acuerdo_inmueble
  FOREIGN KEY (acuerdoinmueble)
  REFERENCES containmuebles (inmuebleId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT FK_acuerdo_propietario
  FOREIGN KEY (acuerdopropietario)
  REFERENCES contapropietarios (propietarioId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE contaempresas 
ADD CONSTRAINT FK_empresa_tercero
  FOREIGN KEY (empresatercero)
  REFERENCES contaterceros (terceroId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT; 

ALTER TABLE contafactdef 
ADD CONSTRAINT FK_factura_tercero
  FOREIGN KEY (factdefcliente)
  REFERENCES contaterceros (terceroId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;  

ALTER TABLE contafactura 
ADD CONSTRAINT FK_factura_inmueble
  FOREIGN KEY (facturaInmuebleid)
  REFERENCES containmuebles (inmuebleId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT FK_factura_propietario
  FOREIGN KEY (facturaPropietario)
  REFERENCES contapropietarios (propietarioId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE containgregastos 
ADD CONSTRAINT FK_ingasto_tercero
  FOREIGN KEY (ingastotercero)
  REFERENCES contaterceros (terceroId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
  
ALTER TABLE containmueblepropietario 
ADD CONSTRAINT FK_alinmueble
  FOREIGN KEY (contaInmuPropietarioInmuebleId)
  REFERENCES containmuebles (inmuebleId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT,
ADD CONSTRAINT FK_alpropietario
  FOREIGN KEY (contaInmuPropietarioPropietarioId)
  REFERENCES contapropietarios (propietarioId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE containmuebleservicios
ADD CONSTRAINT FK_alservicio
  FOREIGN KEY (InmuebleServicioServicioId)
  REFERENCES contaservicios (ServicioId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE contamovicabeza 
ADD CONSTRAINT FK_cabeza_terdero
  FOREIGN KEY (movicaTerceroId)
  REFERENCES contaterceros (terceroId)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
 
 
SET FOREIGN_KEY_CHECKS = 1;


--
-- Dumping data for table contaterceros
--

LOCK TABLES contaterceros WRITE;
/*!40000 ALTER TABLE contaterceros DISABLE KEYS */;
INSERT INTO contaterceros VALUES (1,1,'CONJUNTO PARA PRUEBAS','N','123456789','Cra','0',NULL,NULL,NULL,NULL,'CONJUNTO','A','S','N');
/*!40000 ALTER TABLE contaterceros ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table contaempresas
--

LOCK TABLES contaempresas WRITE;
/*!40000 ALTER TABLE contaempresas DISABLE KEYS */;
INSERT INTO contaempresas VALUES (1,'PRUEBAS','CONJUNTO PARA  PRUEBAS ','9800200300','1','CRA 54 # 55-44','Bogota','3174142133','2019-10-01','2019-10-01','2022-12-31','202001','','','www.atomingenieria.com','','A',25,'Carlos Javier Romero','65444444','ANITA GARCIA','T 123456','51825654','Pablo Reverder','125777R','89544000','2020','X-X-XX-XX-XX-XXXXX','JUAN FELIPE CARDENAS','74859600','DORA VILLALBA','102568741','Manténgase al día, El pago oportuno de esta factura evita intereses moratoios','Cuidemos el medio ambiente, apoye nuestra campaña de reciclage.','202001','201912','01','02','05','03','09','10','360505','110505',2.00,0.00,15,1.00,0.00,15,'S',12,'C','00000000','212','ES',36,'losBrevos.png','S','S','Este documento se asimila en todos sus efectos legales a una letrea de cambio, Artículo 774 del Código de Comercio. Si el cheque sale devuelto por cualquier causa, el girador deberá pagar la sanción del 20% mas el valor de los intereses moratorios al máximo legal permitido. Artículo 731 del Código de Comercio','Resolución de facturación: 320001215741 de Diciembre 09 de 2.014','Numeración autorizada desde el No. 0001 hasta el No. 1000','S','S','25','','25','25','C',16.00,'M','NCR-201806.1.0.0','NCR-201806.5.0.0',20,1,'N','N',0,0);
/*!40000 ALTER TABLE contaempresas ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table contacomprobantes
--

LOCK TABLES contacomprobantes WRITE;
/*!40000 ALTER TABLE contacomprobantes DISABLE KEYS */;
INSERT INTO contacomprobantes VALUES (1,1,'01','C','FACTURACION (INGRESOS)','Cuentas por cobrar',0,'','','','','','','A','0'),(2,1,'02','C','INGRESOS RECIBOS DE CAJA','Ingresos por pago de CxC',0,'','','','','','','A','0'),(3,1,'03','C','EGRESOS','Pago de servicios públicos, aseo y vigilancia',0,'','','','','','','A','0'),(4,1,'04','C','COMPRAS Y SERVICIOS','Compras y otros servicios todos',0,'','','','','','','A','0'),(5,1,'06','C','OTROS INGRESOS','Ingresos diferentes a los normales del negocio',0,'','','','','','','A','0'),(6,1,'07','C','NOMINA','Gastos de personal',0,'','','','','','','A','0'),(7,1,'08','C','SALDOS INICIALES','Movimiento de apertura de cuentas',0,'','','','','','','A','0'),(8,1,'05','C','AJUSTES','Ajustes en valores de cuentas',0,'','','','','','','A','0'),(9,1,'09','C','APERTURA DE CUENTAS','Ajustes en valores de cuentas',0,'','','','','','','A','0'),(10,1,'10','C','CIERRES','Ajustes en valores de cuentas',0,'','','','','','','A','0');
/*!40000 ALTER TABLE contacomprobantes ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table contatipoinforme
--

LOCK TABLES contatipoinforme WRITE;
/*!40000 ALTER TABLE contatipoinforme DISABLE KEYS */;
INSERT INTO contatipoinforme VALUES (1,1,'INTRES','Estado Integral de Resultados','A'),(2,1,'SITFIN','Estado de Situación Financiera','A');
/*!40000 ALTER TABLE contatipoinforme ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table containformes
--


LOCK TABLES containformes WRITE;
/*!40000 ALTER TABLE containformes DISABLE KEYS */;
INSERT INTO containformes VALUES (1,1,'SITFIN',10,'T','L10','ACTIVO','','','',0,'',2,'N',0),(2,1,'SITFIN',20,'T','L20','ACTIVO CORRIENTE','','','',0,'',2,'N',0),(3,1,'SITFIN',30,'C','L30','Efectivo y equivalente a efectivo','11 ..  15','','',0,'1',4,'N',0),(4,1,'SITFIN',40,'C','L40','Cuentas y Documentos por Cobrar','13 +16','','',0,'2,3',4,'N',0),(5,1,'SITFIN',50,'C','L50','Diferidos y Pagos anticipados','17','','',0,'4,6',4,'N',0),(6,1,'SITFIN',60,'R','L60','TOTAL ACTIVO CORRIENTE','','','L30..L50',0,'',4,'N',0),(7,1,'SITFIN',70,'T','L70','ACTIVO NO CORRIENTE','','','',0,' ',2,'N',0),(8,1,'SITFIN',120,'R','L120','TOTAL INMUEBLES, MAQUINARIA Y EQUIPO','','','L90 + L100 +L110',0,'6',2,'N',0),(9,1,'SITFIN',130,'R','L130','TOTAL ACTIVO NO CORRIENTE','','','L120',0,'',4,'N',0),(10,1,'SITFIN',140,'R','L140','TOTAL ACTIVO','','','L60+L130',0,'',2,'N',0),(11,1,'SITFIN',150,'S','L150','SALTO','','','',0,'',2,'N',0),(12,1,'SITFIN',80,'T','L80','INMUEBLES, MAQUINARIA Y EQUIPO','','','',0,'',2,'N',0),(13,1,'SITFIN',90,'C','L90','EQUIPO DE OFICINA','5135','','',0,'7',4,'N',0),(14,1,'SITFIN',100,'C','L100','EQUIPO DE COMPUTACION Y COMUNICACION','1528','','',0,'8',4,'N',0),(15,1,'SITFIN',110,'C','L110','(DEPRECIACION ACUMULADA)','2368','','',0,'5',4,'N',-1),(16,1,'SITFIN',160,'T','L160','PASIVO',' ',' ','',0,'',2,'N',0),(17,1,'SITFIN',170,'T','L170','OBLIGACIONES FINANCIERAS','','','',0,'',2,'N',0),(18,1,'SITFIN',180,'T','L180','BANCOS NACIONALES','2105','','',0,'',4,'N',0),(19,1,'SITFIN',190,'T','L190','OTROS PASIVOS','','','',0,'',2,'N',0),(20,1,'INTRES',10,'T','L10','INGRESOS','','','',0,'',2,'N',0),(21,1,'INTRES',20,'C','L20','OPERACIONALES','41','','',0,'',4,'N',0),(22,1,'INTRES',30,'C','L30','NO OPERACIONALES','42','','',0,'',4,'N',0),(23,1,'INTRES',40,'R','L40','TOTAL INGRESOS','','','41+42',0,'',2,'N',0),(24,1,'INTRES',50,'T','L50','GASTOS','','','',0,'',2,'N',0),(25,1,'INTRES',60,'C','L60','GASTOS PERSONAL','5105','','',0,'',4,'N',0),(26,1,'INTRES',70,'T','L70','HONORARIOS','5110','','',0,'',4,'N',0),(27,1,'INTRES',80,'C','L80','IMPUESTOS','5115',' ','',0,' ',4,'N',1),(28,1,'INTRES',260,'R','L260','TOTAL GASTOS','','','L50..L250',0,'',2,'N',0),(29,1,'INTRES',250,'C','L250','GANANCIAS Y PERDIDAS','5905',' ','',0,' ',4,'N',1),(30,1,'INTRES',270,'R','L270','RESULTADO','','','L40-L260',0,'',2,'N',0),(31,1,'INTRES',90,'C','L90','ARRENDAMIENTOS','5120',' ','',0,' ',4,'N',1),(32,1,'INTRES',100,'C','L100','CONTRIBUCIONES Y AFILIACIONES','5125',' ','',0,' ',4,'N',1),(33,1,'INTRES',110,'C','L110','SEGUROS','5130',' ','',0,' ',4,'N',1),(34,1,'INTRES',120,'C','L120','SERVICIOS','5135',' ','',0,' ',4,'N',1),(35,1,'INTRES',130,'C','L130','GASTOS LEGALES','5140',' ','',0,' ',4,'N',1),(36,1,'INTRES',140,'C','L140','MANTENIMIENTO Y REPARACIONES','5145',' ','',0,' ',4,'N',1),(37,1,'INTRES',150,'C','L150','ADECUACION E INSTALACIONES','5150',' ','',0,' ',4,'N',1),(38,1,'INTRES',160,'C','L160','GASTOS DE VIAJE','5155',' ','',0,' ',4,'N',1),(39,1,'INTRES',170,'C','L170','DEPRECIACIONES','5160',' ','',0,' ',4,'N',1),(40,1,'INTRES',180,'C','L180','AMORTIZACIONES','5165',' ','',0,' ',4,'N',1),(41,1,'INTRES',190,'C','L190','OTROS GASTOS DE ADMINISTRACION','5195',' ','',0,'',4,'N',1),(42,1,'INTRES',200,'C','L200','FINANCIEROS','5305',' ','',0,' ',4,'N',1),(43,1,'INTRES',210,'C','L210','PERDIDA EN VENTA Y RETIRO BIENES','5310',' ','',0,' ',4,'N',1),(44,1,'INTRES',220,'C','L220','GASTOS EXTRAORDINARIOS','5315',' ','',0,' ',4,'N',1),(45,1,'INTRES',230,'C','L230','OTROS GASTOS NO OPERACIONALE','5395',' ','',0,' ',4,'N',1),(46,1,'INTRES',240,'C','L240','PROVISION IMPORRENTA Y RESERVAS','5405',' ','',0,' ',4,'N',1);
/*!40000 ALTER TABLE containformes ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table contaplancontable
--

LOCK TABLES contaplancontable WRITE;
/*!40000 ALTER TABLE contaplancontable DISABLE KEYS */;
INSERT INTO contaplancontable VALUES (152,1,'110505','CAJA MENOR','1105',4,'M','A','N',0),(153,1,'1110','BANCOS','11',3,'T','A','N',0),(154,1,'1','ACTIVOS','0',1,'T','A','N',0),(155,1,'1105','CAJA','11',3,'T','A','N',0),(156,1,'11','EFECTIVO Y SUS EQUIVALENTES','1',2,'T','A','N',0),(157,1,'111005','BANCO AVVILLAS','1110',4,'M','A','N',0),(158,1,'12','INVERSIONES','1',2,'T','A','N',0),(159,1,'1225','CERTIFICADOS','12',3,'T','A','N',0),(160,1,'122505','CERTIFICADOS DE DEPOSITO A TERMINO (C.D.T.)','1225',4,'M','A','N',0),(161,1,'13','DEUDORES','1',2,'T','A','N',0),(162,1,'1305','PROPIETARIOS Y/O RESIDENTES','13',3,'T','A','N',0),(163,1,'130505','EXPENSAS Y SERVICIOS COMUNES','1305',4,'T','A','N',0),(164,1,'13050505','CUOTAS DE ADMINISTRACION','130505',5,'M','A','N',0),(165,1,'13050510','INTERESES DE MORA CUOTAS DE ADMINISTRACION','130505',5,'M','A','N',0),(166,1,'13050515','CUOTA EXTRA','130505',5,'M','A','N',0),(167,1,'13050520','INTERESES DE MORA CUOTA EXTRA','130505',5,'M','A','N',0),(168,1,'13050525','SANCIONES ASAMBLEA','130505',5,'M','A','N',0),(169,1,'13050530','USO ZONAS COMUNES','130505',5,'M','A','N',0),(170,1,'13050535','HONORARIOS DE ABOGADO','130505',5,'M','A','N',0),(171,1,'13050540','COSTOS Y GASTOS DE COBRANZA','130505',5,'M','A','N',0),(172,1,'1330','ANTICIPOS Y AVANCES','13',3,'T','A','N',0),(173,1,'133005','ANTICIPOS A PROVEEDORES','1330',4,'M','A','N',0),(174,1,'133010','ANTICIPOS A CONTRATISTAS','1330',4,'M','A','N',0),(175,1,'133015','ANTICIPOS A TRABAJADORES','1330',4,'M','A','N',0),(176,1,'1360','RECLAMACIONES','13',3,'T','A','N',0),(177,1,'136005','A COMPAÇ?IAS ASEGURADORAS','1360',4,'M','A','N',0),(178,1,'136010','RENDICION DE CUENTAS A ADMINISTRADORES','1360',4,'M','A','N',0),(179,1,'1380','DEUDORES VARIOS','13',3,'T','A','N',0),(180,1,'138020','CUENTAS POR COBRAR DE TERCEROS','1380',4,'M','A','N',0),(181,1,'1399','DETERIORO DE CARTERA (ANTES PROVISIONES)','13',3,'T','A','N',0),(182,1,'139905','PROPIETARIOS Y/O RESIDENTES','1399',4,'T','A','N',0),(183,1,'13990505','PROV CUOTAS DE ADMINISTRACION','139905',5,'M','A','N',0),(184,1,'13990510','PROV INTERESES DE MORA','139905',5,'M','A','N',0),(185,1,'139910','ANTICIPOS RECLAMACIONES Y DEUDORES VARIOS','1399',4,'M','A','N',0),(186,1,'15','PROPIEDADES PLANTA Y EQUIPO','1',2,'T','A','N',0),(187,1,'1504','TERRENOS','15',3,'T','A','N',0),(188,1,'1516','CONSTRUCCIONES Y EDIFICACIONES','15',3,'T','A','N',0),(189,1,'151605','EDIFICIOS','1516',4,'M','A','N',0),(190,1,'1520','MAQUINARIA Y EQUIPO','15',3,'T','A','N',0),(191,1,'152005','MAQUINARIA Y EQUIPO','1520',4,'M','A','N',0),(192,1,'1524','EQUIPO DE OFICINA','15',3,'T','A','N',0),(193,1,'152405','MUEBLES Y ENSERES','1524',4,'M','A','N',0),(194,1,'152410','EQUIPOS VARIOS DE OFICINA','1524',4,'M','A','N',0),(195,1,'1528','EQUIPO DE COMPUTACION Y COMUNICACION','15',3,'T','A','N',0),(196,1,'152805','EQUIPOS DE COMPUTO','1528',4,'M','A','N',0),(197,1,'152810','EQUPOS DE COMUNICACIONES','1528',4,'M','A','N',0),(198,1,'152815','EQUIPOS CVSC','1528',4,'M','A','N',0),(199,1,'1592','DEPRECIACION ACUMULADA','15',3,'T','A','N',0),(200,1,'159205','CONSTRUCCIONES Y EDIFICACIONES','1592',4,'M','A','N',0),(201,1,'159210','MAQUINARIA Y EQUIPO','1592',4,'M','A','N',0),(202,1,'159215','EQUIPO DE OFICINA','1592',4,'M','A','N',0),(203,1,'159220','EQUIPO DE COMPUTACION Y COMUNICACION','1592',4,'M','A','N',0),(204,1,'17','DIFERIDOS','1',2,'T','A','N',0),(205,1,'1705','GASTOS PAGADOS POR ANTICIPADO','17',3,'T','A','N',0),(206,1,'170520','SEGUROS Y FIANZAS','1705',4,'T','A','N',0),(207,1,'17052005','POLIZA DE COPROPIEDADES','170520',5,'M','A','N',0),(208,1,'2','PASIVO','0',1,'T','A','N',0),(209,1,'21','OBLIGACIONES FINANCIERAS','2',2,'T','A','N',0),(210,1,'2105','BANCOS NACIONALES','21',3,'T','A','N',0),(211,1,'210505','SOBREGIROS','2105',4,'T','A','N',0),(212,1,'22','PROVEEDORES','2',2,'T','A','N',0),(213,1,'2205','PROVEEDORES NACIONALES','22',3,'T','A','N',0),(214,1,'220505','CXP PROVEEDORES NACIONALES','2205',4,'M','A','N',0),(215,1,'23','CUENTAS POR PAGAR','2',2,'T','A','N',0),(216,1,'2320','A CONTRATISTAS','23',3,'T','A','N',0),(217,1,'232005','CXP CONTRATISTAS','2320',4,'M','A','N',0),(218,1,'2335','COSTOS Y GASTOS POR PAGAR','23',3,'T','A','N',0),(219,1,'233505','GASTOS FINANCIEROS','2335',4,'M','A','N',0),(220,1,'233515','LIBROS, SUSCRIPCIONES, PERIODICOS Y REVISTAS','2335',4,'M','A','N',0),(221,1,'233525','HONORARIOS','2335',4,'T','A','N',0),(222,1,'23352505','ADMINISTRADOR','233525',5,'M','A','N',0),(223,1,'23352510','CONTADOR','233525',5,'M','A','N',0),(224,1,'23352515','REVISOR FISCAL','233525',5,'M','A','N',0),(225,1,'23352520','ASESORIA JURIDICA','233525',5,'M','A','N',0),(226,1,'233530','SERVICIOS TECNICOS','2335',4,'T','A','N',0),(227,1,'23353005','SERVICIO VIGILANCIA','233530',5,'M','A','N',0),(228,1,'23353010','SERVICIO ASEO','233530',5,'M','A','N',0),(229,1,'233535','SERVICIOS DE MANTENIMIENTO','2335',4,'T','A','N',0),(230,1,'23353510','SERVICIOS DE MANTENIMIENTO ASCENSOR','233535',5,'M','A','N',0),(231,1,'23353520','SERVICIOS DE MANTENIMIENTO HIDRAULICO','233535',5,'M','A','N',0),(232,1,'23353530','SERVICIOS DE MANTENIMIENTO ELECTRICO','233535',5,'M','A','N',0),(233,1,'23353540','SERVICIOS DE MANTENIMIENTO TV E INTERNET','233535',5,'M','A','N',0),(234,1,'23353550','MOTOBOMBAS','233535',5,'M','A','N',0),(235,1,'23353560','PRADOS Y JARDINES','233535',5,'M','A','N',0),(236,1,'23353590','SERVICIOS DE MANTENIMIENTO OTROS','233535',5,'M','A','N',0),(237,1,'233545','TRANSPORTES, FLETES Y ACARREOS','2335',4,'M','A','N',0),(238,1,'233550','SERVICIOS PUBLICOS','2335',4,'M','A','N',0),(239,1,'233555','SEGUROS','2335',4,'M','A','N',0),(240,1,'233570','CHEQUES GIRADOS PENDIENTES DE COBRO','2335',4,'M','A','N',0),(241,1,'233595','OTROS','2335',4,'M','A','N',0),(242,1,'2365','RETENCION EN LA FUENTE','23',3,'T','A','R',0),(243,1,'236505','RET. SALARIOS Y PAGOS LABORALES','2365',4,'M','A','R',0),(244,1,'236515','RET. HONORARIOS','2365',4,'M','A','R',0),(245,1,'236520','RET. COMISIONES','2365',4,'M','A','R',0),(246,1,'236525','RET. SERVICIOS','2365',4,'M','A','R',0),(247,1,'236540','RT. COMPRAS','2365',4,'M','A','R',0),(248,1,'2370','RETENCIONES Y APORTES DE NOMINA','23',3,'T','A','R',0),(249,1,'237005','APORTES AL I.S.S.','2370',4,'M','A','N',0),(250,1,'237010','APORTES AL I.C.B.F., SENA Y C. C. F.','2370',4,'M','A','N',0),(251,1,'2380','ACREEDORES VARIOS','23',3,'T','A','N',0),(252,1,'238030','FONDOS DE CESANTIAS Y/O PENSIONES','2380',4,'M','A','N',0),(253,1,'238095','OTROS','2380',4,'M','A','N',0),(254,1,'24','IMPUESTOS, GRAVAMENES Y TASAS','2',2,'T','A','N',0),(255,1,'2404','DE RENTA Y COMPLEMENTARIOS','24',3,'T','A','N',0),(256,1,'240405','IMP DE RENTA Y COMPLEMENTARIOS','2404',4,'M','A','N',0),(257,1,'2408','IMPUESTO SOBRE LAS VENTAS POR PAGAR','24',3,'T','A','I',0),(258,1,'240805','IMPUESTO SOBRE LAS VENTAS POR PAGAR','2408',4,'M','A','I',0),(259,1,'25','OBLIGACIONES LABORALES','2',2,'T','A','N',0),(260,1,'2505','SALARIOS POR PAGAR','25',3,'T','A','N',0),(261,1,'250505','SALARIOS POR PAGAR','2505',4,'M','A','N',0),(262,1,'2510','CESANTIAS CONSOLIDADAS','25',3,'T','A','N',0),(263,1,'251005','CESANTIAS CONSOLIDADAS','2510',4,'M','A','N',0),(264,1,'2515','INTERESES SOBRE CESANTIAS','25',3,'T','A','N',0),(265,1,'251505','INTERESES SOBRE CESANTIAS','2515',4,'M','A','N',0),(266,1,'2520','PRIMA DE SERVICIOS','25',3,'T','A','N',0),(267,1,'252005','PRIMA DE SERVICIOS','2520',4,'M','A','N',0),(268,1,'2525','VACACIONES CONSOLIDADAS','25',3,'T','A','N',0),(269,1,'252505','VACACIONES CONSOLIDADAS','2525',4,'M','A','N',0),(270,1,'2540','INDEMNIZACIONES LABORALES','25',3,'T','A','N',0),(271,1,'254005','INDEMNIZACIONES LABORALES','2540',4,'M','A','N',0),(272,1,'27','DIFERIDOS','2',2,'T','A','N',0),(273,1,'2705','INGRESOS RECIBIDOS POR ANTICIPADO','27',3,'T','A','N',0),(274,1,'270505','CUOTAS DE ADMINISTRACION','2705',4,'M','A','N',0),(275,1,'270510','CUOTAS EXTRAORDINARIAS','2705',4,'M','A','N',0),(276,1,'270595','OTROS DIFERIDOS','2705',4,'M','A','N',0),(277,1,'28','OTROS PASIVOS','2',2,'T','A','N',0),(278,1,'2810','DEPOSITOS RECIBIDOS','28',3,'T','A','N',0),(279,1,'281005','PARA OBRAS E INVERSIONES','2810',4,'T','A','N',0),(280,1,'28100505','PARA OBRA DE FACHADAS','281005',5,'M','A','N',0),(281,1,'281035','FONDO DE IMPREVISTOS','2810',4,'M','A','N',0),(282,1,'2815','INGRESOS RECIBIDOS PARA TERCEROS','28',3,'T','A','N',0),(283,1,'281505','VALORES RECIBIDOS PARA TERCEROS','2815',4,'M','A','N',0),(284,1,'2820','CONSIGNACIONES SIN IDENTIFICAR','28',3,'T','A','N',0),(285,1,'282005','CONSIGNACIONES SIN IDENTIFICAR','2820',4,'M','A','N',0),(286,1,'2825','RETENCIONES A TERCEROS SOBRE CONTRATOS','28',3,'T','A','N',0),(287,1,'282505','RETENCIONES A TERCEROS SOBRE CONTRATOS','2825',4,'M','A','N',0),(288,1,'3','PATRIMONIO','0',1,'T','A','N',0),(289,1,'33','RESERVAS','3',2,'T','A','N',0),(290,1,'3305','RESERVAS OBLIGATORIAS','33',3,'T','A','N',0),(291,1,'330505','FONDO DE IMPREVISTOS','3305',4,'M','A','N',0),(292,1,'3310','RESERVAS ESTATUTARIAS','33',3,'T','A','N',0),(293,1,'331005','PARA REPOSICION DE ACTIVOS','3310',4,'M','A','N',0),(294,1,'3315','RESERVAS OCASIONALES (Provisiones)','33',3,'T','A','N',0),(295,1,'331505','PARA MANTENIMIENTO','3315',4,'M','A','N',0),(296,1,'331510','PARA ADQUISICION DE ACTIVOS','3315',4,'M','A','N',0),(297,1,'331515','PARA FUTUROS ENSANCHES','3315',4,'M','A','N',0),(298,1,'331520','PARA GASTOS EXTRAORDINARIOS','3315',4,'M','A','N',0),(299,1,'331545','A DISPOSICION DEL MAXIMO ORGANO SOCIAL','3315',4,'M','A','N',0),(300,1,'36','RESULTADOS DEL EJERCICIO','3',2,'T','A','N',0),(301,1,'3605','EXCEDENTE DEL EJERCICIO','36',3,'T','A','N',0),(302,1,'360505','EXCEDENTE DEL EJERCICIO','3605',4,'M','A','N',0),(303,1,'3610','DEFICIT DEL EJERCICIO','36',3,'T','A','N',0),(304,1,'361005','DEFICIT DEL EJERCICIO','3610',4,'M','A','N',0),(305,1,'37','RESULTADOS DE EJERCICIOS ANTERIORES','3',2,'T','A','N',0),(306,1,'3705','EXCEDENTES ACUMULADOS','37',3,'M','A','N',0),(307,1,'3710','DEFICITS ACUMULADAS','37',3,'M','A','N',0),(308,1,'4','INGRESOS','0',1,'T','A','N',0),(309,1,'41','EXPENSAS Y SERVICIOS COMUNES','4',2,'T','A','N',0),(310,1,'4170','OTRAS ACTIVIDADES DE SERVICIOS COMUNITARIOS, SOCIALES Y PERS','41',3,'T','A','N',0),(311,1,'417005','CUOTAS DE ADMINISTRACION','4170',4,'M','A','N',0),(312,1,'417010','INTERESES DE MORA CUOTAS DE ADMINISTRACION','4170',4,'M','A','N',0),(313,1,'417015','CUOTA EXTRA','4170',4,'M','A','N',0),(314,1,'417020','INTERESES DE MORA CUOTA EXTRA','4170',4,'M','A','N',0),(315,1,'417025','SANCIONES ASAMBLEA','4170',4,'M','A','N',0),(316,1,'417030','USO ZONAS COMUNES','4170',4,'T','A','N',0),(317,1,'41703005','SALON SOCIAL','417030',5,'M','A','N',0),(318,1,'41703010','PARQUEADEROS COMUNALES','417030',5,'M','A','N',0),(319,1,'417035','INDEMNIZACION SEGUROS','4170',4,'M','A','N',0),(320,1,'417040','POR RECLAMACIONES','4170',4,'M','A','N',0),(321,1,'417050','POR RINTEGRO PROVISIONES','4170',4,'M','A','N',0),(322,1,'417060','RINTEGRO DE OTROS COSTOS Y GASTOS','4170',4,'M','A','N',0),(323,1,'417065','POR INCAPACIDADES I.S.S.','4170',4,'M','A','N',0),(324,1,'417085','APROVECHAMIENTOS','4170',4,'T','A','N',0),(325,1,'41708505','RECICLAJE','417085',5,'M','A','N',0),(326,1,'41708510','AJUSTE AL PESO O AL MIL','417085',5,'M','A','N',0),(327,1,'41708515','DONACIONES','417085',5,'M','A','N',0),(328,1,'417090','INGRESOS DE EJERCICIOS ANTERIORES','4170',4,'M','A','N',0),(329,1,'417095','INGRESOS FINANCIEROS','4170',4,'T','A','N',0),(330,1,'41709505','RENDIMIENTOS BANCARIOS','417095',5,'M','A','N',0),(331,1,'4175','DESCUENTOS (DB) ( Devoluciones Rebajas y Descuentos)','41',3,'T','A','N',0),(332,1,'417505','DESCUENTO PRONTO PAGO ADMINISTRACION','4175',4,'M','A','N',0),(333,1,'417510','CONDONACION INTERESES ASAMBLEA','4175',4,'M','A','N',0),(334,1,'417515','CONDONACION INTERESE DE MORA','4175',4,'M','A','N',0),(335,1,'5','GASTOS','0',1,'T','A','N',0),(336,1,'51','GASTOS DE ADMINISTRACION','5',2,'T','A','N',0),(337,1,'5105','GASTOS DE PERSONAL','51',3,'T','A','N',0),(338,1,'510506','SUELDOS','5105',4,'M','A','N',0),(339,1,'510515','HORAS EXTRAS Y RECARGOS','5105',4,'M','A','N',0),(340,1,'510524','INCAPACIDADES','5105',4,'M','A','N',0),(341,1,'510527','AUXILIO DE TRANSPORTE','5105',4,'M','A','N',0),(342,1,'510530','CESANTIAS','5105',4,'M','A','N',0),(343,1,'510533','INTERESES SOBRE CESANTIAS','5105',4,'M','A','N',0),(344,1,'510536','PRIMA DE SERVICIOS','5105',4,'M','A','N',0),(345,1,'510539','VACACIONES','5105',4,'M','A','N',0),(346,1,'510551','DOTACION Y SUMINISTRO A TRABAJADORES','5105',4,'M','A','N',0),(347,1,'510560','INDEMNIZACIONES LABORALES','5105',4,'M','A','N',0),(348,1,'510569','APORTES AL I.S.S','5105',4,'M','A','N',0),(349,1,'510572','APORTES CAJAS DE COMPENSACION FAMILIAR','5105',4,'M','A','N',0),(350,1,'510575','APORTES I.C.B.F.','5105',4,'M','A','N',0),(351,1,'510578','SENA','5105',4,'M','A','N',0),(352,1,'5110','HONORARIOS','51',3,'T','A','N',0),(353,1,'511005','ADMINISTRACION','5110',4,'M','A','N',0),(354,1,'511010','REVISORIA FISCAL','5110',4,'M','A','N',0),(355,1,'511015','CONTABILIDAD','5110',4,'M','A','N',0),(356,1,'511025','ASESORIA JURIDICA','5110',4,'M','A','N',0),(357,1,'5115','IMPUESTOS','51',3,'T','A','N',0),(358,1,'511570','IVA DESCONTABLE','5115',4,'M','A','I',0),(359,1,'5120','ARRENDAMIENTOS','51',3,'M','A','N',0),(360,1,'5125','CONTRIBUCIONES Y AFILIACIONES','51',3,'M','A','N',0),(361,1,'5130','SEGUROS','51',3,'T','A','N',0),(362,1,'513010','DE COPROPIEDADES','5130',4,'M','A','N',0),(363,1,'5135','SERVICIOS','51',3,'T','A','N',0),(364,1,'513505','ASEO','5135',4,'M','A','N',0),(365,1,'513510','VIGILANCIA','5135',4,'M','A','N',0),(366,1,'513525','ACUEDUCTO Y ALCANTARILLADO','5135',4,'M','A','N',0),(367,1,'513530','ENERGIA ELECTRICA','5135',4,'M','A','N',0),(368,1,'513535','TELEFONO','5135',4,'M','A','N',0),(369,1,'513540','TELEVISION E INTERNET','5135',4,'M','A','N',0),(370,1,'513545','CORREO, PORTES Y TELEGRAMAS','5135',4,'M','A','N',0),(371,1,'513555','GAS','5135',4,'M','A','N',0),(372,1,'5140','GASTOS LEGALES','51',3,'T','A','N',0),(373,1,'514005','NOTARIALES','5140',4,'M','A','N',0),(374,1,'514015','TRAMITES Y LICENCIAS','5140',4,'M','A','N',0),(375,1,'5145','MANTENIMIENTO Y REPARACIONES','51',3,'T','A','N',0),(376,1,'514505','PRADOS Y JARDINES','5145',4,'M','A','N',0),(377,1,'514510','CONSTRUCCIONES Y EDIFICACIONES','5145',4,'M','A','N',0),(378,1,'514515','MAQUINARIA Y EQUIPO','5145',4,'T','A','N',0),(379,1,'51451505','ASCENSORES','514515',5,'M','A','N',0),(380,1,'51451510','MOTOBOMBAS','514515',5,'M','A','N',0),(381,1,'51451515','PLANTA ELECTRICA (INCLUYE COMBUSTIBLES Y LUBRICANTES)','514515',5,'M','A','N',0),(382,1,'51451520','TANQUES DE AGUA POTABLE','514515',5,'M','A','N',0),(383,1,'51451525','CAJAS DE AGUAS NEGRAS','514515',5,'M','A','N',0),(384,1,'51451530','EQUIPO DE COMPUTO','514515',5,'M','A','N',0),(385,1,'51451535','EQUIPO DE OFICINA','514515',5,'M','A','N',0),(386,1,'51451540','CITOFONOS','514515',5,'M','A','N',0),(387,1,'51451545','CCTV','514515',5,'M','A','N',0),(388,1,'51451550','REPARACIONES LOCATIVAS','514515',5,'M','A','N',0),(389,1,'514525','CERRAJERIA Y SIMILARES','5145',4,'M','A','N',0),(390,1,'514530','ELECTRICOS Y BOMBILLOS','5145',4,'M','A','N',0),(391,1,'514535','EXTINTORES','5145',4,'M','A','N',0),(392,1,'514560','FUMIGACION Y ROEDORES','5145',4,'M','A','N',0),(393,1,'514565','MANTENIMIENTO CUBIERTAS Y FACHADAS','5145',4,'M','A','N',0),(394,1,'5150','ADECUACION E INSTALACION (Se suprime pues este concepto apl','51',3,'T','A','N',0),(395,1,'5155','GASTOS DE VIAJE','51',3,'T','A','N',0),(396,1,'515505','GASTOS DE VIAJES','5155',4,'M','A','N',0),(397,1,'5160','DEPRECIACIONES','51',3,'T','A','N',0),(398,1,'516005','CONSTRUCCIONES Y EDIFICACIONES','5160',4,'M','A','N',0),(399,1,'516010','MAQUINARIA Y EQUIPO','5160',4,'M','A','N',0),(400,1,'516015','EQUIPO DE OFICINA','5160',4,'M','A','N',0),(401,1,'516020','EQUIPO DE COMPUTACION Y COMUNICACION','5160',4,'M','A','N',0),(402,1,'5195','OTROS GASTOS DE FUNCIONAMIENTO','51',3,'T','A','N',0),(403,1,'519505','BONIFICACIONES','5195',4,'M','A','N',0),(404,1,'519510','LIBROS, SUSCRIPCIONES, PERIODICOS Y REVISTAS','5195',4,'M','A','N',0),(405,1,'519515','MUSICA AMBIENTAL Ç½ƒ?ªƒ?? DERECHOS SAYCO','5195',4,'M','A','N',0),(406,1,'519525','ELEMENTOS DE ASEO Y CAFETERIA','5195',4,'T','A','N',0),(407,1,'51952505','ASEO','519525',5,'M','A','N',0),(408,1,'51952510','CAFETERIA','519525',5,'M','A','N',0),(409,1,'519530','UTILES, PAPELERIA Y FOTOCOPIAS','5195',4,'M','A','N',0),(410,1,'519545','TRANSPORTES Y ACARREOS','5195',4,'T','A','N',0),(411,1,'51954505','TAXIS BUSES Y PARQUEADEROS','519545',5,'M','A','N',0),(412,1,'519550','FINANCIEROS','5195',4,'T','A','N',0),(413,1,'51955005','GASTOS BANCARIOS CHEQUERAS Y SIMILARES','519550',5,'M','A','N',0),(414,1,'51955010','COMISIONES','519550',5,'M','A','N',0),(415,1,'51955015','INTERESES','519550',5,'M','A','N',0),(416,1,'519560','COSTOS Y GASTOS DE EJERCICIOS ANTERIORES','5195',4,'M','A','N',0),(417,1,'519565','AJUSTE AL PESO O AL MIL','5195',4,'M','A','N',0),(418,1,'519570','INDEMNIZACION POR DAÇŸƒ??OS A TERCEROS','5195',4,'M','A','N',0),(419,1,'519575','FONDO DE IMPREVISTOS','5195',4,'M','A','N',0),(420,1,'5199','DETERIORO DE CARTERA','51',3,'T','A','N',0),(421,1,'519910','EXPENSAS Y SERVICIOS COMUNES','5199',4,'M','A','N',0),(422,1,'519915','ANTICIPOS RECLAMACIONES Y DEUDORES VARIOS','5199',4,'M','A','N',0),(423,1,'8','CUENTAS DE ORDEN DEUDORAS','0',1,'T','A','N',0),(424,1,'81','DERECHOS CONTINGENTES','8',2,'T','A','N',0),(425,1,'8105','BIENES Y VALORES ENTREGADOS EN CUSTODIA','81',3,'T','A','N',0),(426,1,'810505','VALORES MOBILIARIOS','8105',4,'M','A','N',0),(427,1,'810510','BIENES MUEBLES','8105',4,'M','A','N',0),(428,1,'8110','BIENES Y VALORES ENTREGADOS EN GARANTIA','81',3,'T','A','N',0),(429,1,'8115','BIENES Y VALORES EN PODER DE TERCEROS','81',3,'T','A','N',0),(430,1,'8120','LITIGIOS Y/O DEMANDAS','81',3,'T','A','N',0),(431,1,'812005','EJECUTIVOS','8120',4,'M','A','N',0),(432,1,'812010','INCUMPLIMIENTO DE CONTRATOS','8120',4,'M','A','N',0),(433,1,'83','DEUDORAS DE CONTROL','8',2,'T','A','N',0),(434,1,'8305','BIENES RECIBIDOS EN ARRENDAMIENTO FINANCIERO','83',3,'T','A','N',0),(435,1,'830505','BIENES MUEBLES','8305',4,'M','A','N',0),(436,1,'830510','BIENES INMUEBLES','8305',4,'M','A','N',0),(437,1,'8315','PROP PLANTA Y EQUIPO TOTALMENTE DEPRECIADOS, AGOTADOS','83',3,'T','A','N',0),(438,1,'831516','CONSTRUCCIONES Y EDIFICACIONES','8315',4,'M','A','N',0),(439,1,'831520','MAQUINARIA Y EQUIPO','8315',4,'M','A','N',0),(440,1,'831524','EQUIPO DE OFICINA','8315',4,'M','A','N',0),(441,1,'831528','EQUIPO DE COMPUTACION Y COMUNICACION','8315',4,'M','A','N',0),(442,1,'8325','ACTIVOS CASTIGADOS','83',3,'T','A','N',0),(443,1,'832510','DEUDORES','8325',4,'M','A','N',0),(444,1,'832595','OTROS ACTIVOS','8325',4,'M','A','N',0),(445,1,'8395','OTRAS CUENTAS DEUDORAS DE CONTROL','83',3,'T','A','N',0),(446,1,'839505','CHEQUES POSTFECHADOS','8395',4,'M','A','N',0),(447,1,'839515','CHEQUES DEVUELTOS','8395',4,'M','A','N',0),(448,1,'839525','INTERESES SOBRE DEUDAS VENCIDAS','8395',4,'M','A','N',0),(449,1,'839915','PROPIEDADES PLANTA Y EQUIPO','8399',4,'M','A','N',0),(450,1,'839920','INTANGIBLES','8399',4,'M','A','N',0),(451,1,'839925','CARGOS DIFERIDOS','8399',4,'M','A','N',0),(452,1,'839995','OTROS ACTIVOS','8399',4,'M','A','N',0),(453,1,'84','DERECHOS CONTINGENTES POR CONTRA (CR)','8',2,'T','A','N',0),(454,1,'9','CUENTAS DE ORDEN ACREEDORAS','0',1,'T','A','N',0),(455,1,'91','RESPONSABILIDADES CONTINGENTES','9',2,'T','A','N',0),(456,1,'9105','BIENES Y VALORES RECIBIDOS EN CUSTODIA','91',3,'T','A','N',0),(457,1,'910505','VALORES MOBILIARIOS','9105',4,'M','A','N',0),(458,1,'910510','BIENES MUEBLES','9105',4,'M','A','N',0),(459,1,'9110','BIENES Y VALORES RECIBIDOS EN GARANTIA','91',3,'T','A','N',0),(460,1,'911005','VALORES MOBILIARIOS','9110',4,'M','A','N',0),(461,1,'911010','BIENES MUEBLES','9110',4,'M','A','N',0),(462,1,'911015','BIENES INMUEBLES','9110',4,'M','A','N',0),(463,1,'9115','BIENES Y VALORES RECIBIDOS DE TERCEROS','91',3,'T','A','N',0),(464,1,'911505','EN ARRENDAMIENTO','9115',4,'M','A','N',0),(465,1,'911510','EN PRESTAMO','9115',4,'M','A','N',0),(466,1,'911515','EN DEPOSITO','9115',4,'M','A','N',0),(467,1,'911520','EN CONSIGNACION','9115',4,'M','A','N',0),(468,1,'911525','EN COMODATO','9115',4,'M','A','N',0),(469,1,'9120','LITIGIOS Y/O DEMANDAS','91',3,'T','A','N',0),(470,1,'912005','LABORALES','9120',4,'M','A','N',0),(471,1,'9195','OTRAS RESPONSABILIDADES CONTINGENTES','91',3,'T','A','N',0),(472,1,'93','ACREEDORAS DE CONTROL','9',2,'T','A','N',0),(473,1,'96','ACREEDORAS DE CONTROL POR CONTRA (DB)','9',2,'T','A','N',0),(474,1,'999999','CUENTA NO VALIDA','9999',4,'M','A','N',0);
/*!40000 ALTER TABLE contaplancontable ENABLE KEYS */;
UNLOCK TABLES;



--
-- Dumping data for table mm_usuarios
--

LOCK TABLES mm_usuarios WRITE;
/*!40000 ALTER TABLE mm_usuarios DISABLE KEYS */;
INSERT INTO mm_usuarios VALUES (1,1,'consul','consul@com.co','3101231231','d7d9d523737a8a9c2473125ec290e727','C','2018-12-31','2018-12-31','1','ava3.png','A','C','1578800','Cra 12 # 45-33','SantaMarta'),(2,1,'Sipervisor','super@com.co','3300','5498a4b022b998d7d81bf65ef1ca3c43','S','2019-04-22','2019-04-22','1','avatar.png','A','C','123456','Avenila Lopez','chaicas'),(3,1,'Contador','conta@com.co','2200','0bcf68a614bb71b23df4aebb900e1eec','K','2019-05-05','2020-05-05','1','avatar.png','A','C','c45877','Avenida 25','Chia C/marca'),(4,1,'Administra','admin@com.co','3105858544','e64b78fc3bc91bcbc7dc232ba8ec59e0','A','2019-09-01','2019-09-01','1','avatar1.png','A','E','123','Cl 58A 55-22','Bogota');
/*!40000 ALTER TABLE mm_usuarios ENABLE KEYS */;
UNLOCK TABLES;



