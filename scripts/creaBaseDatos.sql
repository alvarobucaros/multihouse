-- MySQL dbcreate database for multimeeting
--
-- Host: localhost
-- Database:atominge_mmeetingU
-- Script date Monday,Feb 18, 2019 1:09:15
-- by AtomIngenieria sas

--
-- Crea Base de datos
--
CREATE DATABASE atominge_mmeetingU CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE atominge_mmeetingU; 

--
-- Table structure for table mm_instala
--
   DROP TABLE IF EXISTS atominge_mmeetingU.mm_instala;
	CREATE TABLE IF NOT EXISTS  atominge_mmeetingU.mm_instala ( 
	id int(11) NOT NULL AUTO_INCREMENT,
	servidor varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
	basedatos varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
	usuario varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
	password varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
	estado char(1),
	PRIMARY KEY (id)
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

   SELECT 'Tabla mm_instala creada';
	
   INSERT INTO atominge_mmeetingU.mm_instala (servidor,basedatos, usuario, password, estado) VALUES ( 'localhost','atominge_mmeetingU','root','123','1');
   
   SELECT 'Datos de instalacion creados' ;
   
--
-- Table structure for table mm_accesos
--
   DROP TABLE IF EXISTS atominge_mmeetingU.mm_accesos;
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_accesos (  
   acceso_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  
	acceso_empresa int(11) DEFAULT NULL,  
	acceso_asistenteId int(11) DEFAULT NULL COMMENT 'ASISTENTE', 
	acceso_comiteId int(11) DEFAULT NULL COMMENT 'COMITE',  
	acceso_tipoAcceso char(1) DEFAULT NULL COMMENT 'TIPO_ACCESO', 
	PRIMARY KEY (acceso_id)  
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='acceso de asistentes a reuniones'; 
 
   SELECT 'Tabla mm_accesos creada'; 
	 
--
-- Table structure for table mm_agendaanexos
--
   DROP TABLE IF EXISTS atominge_mmeetingU.mm_agendaanexos;
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendaanexos ( 
	anexos_id int(11) NOT NULL AUTO_INCREMENT,  
   anexos_empresa int(11) DEFAULT NULL, 
	anexos_comiteid int(11) DEFAULT NULL, 
   anexos_agendaid int(11) DEFAULT NULL, 
   anexos_usuario int(11) DEFAULT NULL, 
	anexos_anno varchar(4) DEFAULT NULL,  
	anexos_anexo varchar(100) DEFAULT NULL,  
	anexos_ruta varchar(100) DEFAULT NULL,  
	anexos_fecha varchar(20) DEFAULT NULL,  
	anexos_descripcion varchar(100) DEFAULT NULL, 
	PRIMARY KEY (anexos_id)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ; 
 
   SELECT 'Tabla mm_agendaanexos creada'; 
	 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendainvitados (  invitado_id int(11) NOT NULL AUTO_INCREMENT,  
	invitado_agendaId int(11) DEFAULT NULL,  invitado_nombre varchar(120) DEFAULT NULL,  
	invitado_empresa varchar(120) DEFAULT NULL,  invitado_cargo varchar(45) DEFAULT NULL,  
	invitado_celuar varchar(20) DEFAULT NULL,  invitado_email varchar(120) DEFAULT NULL,  
	invitado_asistio char(1) DEFAULT NULL,  invitado_titulo char(1) DEFAULT NULL,  
	invitado_orden int(11) DEFAULT NULL,  invitado_causa varchar(45) DEFAULT NULL,  
	PRIMARY KEY (invitado_id) 
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ; 
 
   SELECT 'Tabla mm_agendainvitados creada'; 
   
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendamiento ( 
	agenda_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  
	agenda_empresa int(11) DEFAULT NULL,  
	agenda_salonId int(11) DEFAULT NULL COMMENT 'SALON', 
	agenda_Descripcion varchar(500) DEFAULT NULL,  
	agenda_comiteId int(11) DEFAULT NULL COMMENT 'COMITE', 
	agenda_fechaDesde datetime DEFAULT NULL COMMENT 'FCH_DESDE', 
	agenda_fechaHasta datetime DEFAULT NULL COMMENT 'FCH_HASTA',  
	agenda_comiteAnteriorId int(11) DEFAULT NULL COMMENT 'COMITE_ANTERIOR', 
	agenda_usuario int(11) DEFAULT NULL,   
    agenda_enFirme char(1) DEFAULT NULL,  
	agenda_conCitacion char(1) DEFAULT NULL,   
    agenda_acta int(11) DEFAULT NULL,  
	agenda_estado char(1) DEFAULT NULL,  
    agenda_causal varchar(100) DEFAULT NULL, 
	agenda_ProxCitacion varchar(45) DEFAULT NULL, 
	PRIMARY KEY (agenda_id))  
	ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Ocupacion de los salones'; 
	 
   SELECT 'Tabla mm_agendamiento creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendapendientes ( 
	pendiente_id int(11) NOT NULL AUTO_INCREMENT, 
	pendiente_agendaId int(11) DEFAULT NULL, 
	pendiente_empresa int(11) DEFAULT NULL, 
	pendiente_titulo varchar(128) DEFAULT NULL, 
	pendiente_detalle varchar(1024) DEFAULT NULL, 
	pendiente_responsable varchar(128) DEFAULT NULL, 
	pendiente_fecha date DEFAULT NULL, 
	pendiente_estado char(1) DEFAULT NULL, 
	PRIMARY KEY (pendiente_id)) 
	ENGINE=InnoDB   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
  SELECT 'Tabla mm_agendapendientes creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendatemas ( 
		 tema_id int(11) NOT NULL AUTO_INCREMENT, 
		 tema_agendaId int(11) DEFAULT NULL, 
		 tema_empresa int(11) DEFAULT NULL, 
		 tema_comite int(11) DEFAULT NULL, 
		 tema_titulo varchar(128) DEFAULT NULL, 
		 tema_detalle varchar(1024) DEFAULT NULL, 
		 tema_tipo varchar(5) DEFAULT NULL, 
		 tema_responsable varchar(45) DEFAULT NULL, 
		 tema_desarrollo varchar(2048) DEFAULT NULL, 
		 tema_fechaAsigna date DEFAULT NULL, 
		 tema_fechaCumple date DEFAULT NULL, 
		 tema_estado char(1) DEFAULT NULL, 
		 tema_orden int(6) DEFAULT NULL, 
		 PRIMARY KEY (tema_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_agendatemas creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_asistentes ( 
		 asistente_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 asistente_comite varchar(20) DEFAULT NULL COMMENT 'GRUPO', 
		 asistente_usuarioId int(11) DEFAULT NULL COMMENT 'USUARIO_ID', 
		 asistente_nombre varchar(120) DEFAULT NULL COMMENT 'NOMBRE', 
		 asistente_empresa varchar(120) DEFAULT NULL COMMENT 'EMPRESA', 
		 asistente_cargo varchar(45) DEFAULT NULL COMMENT 'CARGO', 
		 asistente_celuar varchar(20) DEFAULT NULL COMMENT 'CELULAR', 
		 asistente_email varchar(120) DEFAULT NULL COMMENT 'E_MAIL', 
		 asistente_empresaId int(11) DEFAULT NULL, 
		 PRIMARY KEY (asistente_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_asistentes creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_cargadocumentos ( 
		 carga_id int(11) NOT NULL AUTO_INCREMENT, 
		 carga_empresa int(11) DEFAULT NULL, 
		 carga_comite int(11) DEFAULT NULL, 
		 carga_agendaId int(11) DEFAULT NULL, 
		 carga_titulo varchar(45) DEFAULT NULL, 
		 carga_descripcion varchar(500) DEFAULT NULL, 
		 carga_tipo varchar(20) DEFAULT NULL, 
		 carga_documento varchar(500) DEFAULT NULL, 
		 carga_ruta varchar(500) DEFAULT NULL, 
		 PRIMARY KEY (carga_id)) 
		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_cargadocumentos creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_comites ( 
		 comite_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 comite_empresa int(11) DEFAULT NULL, 
		 comite_nombre varchar(120) DEFAULT NULL COMMENT 'NOMBRE', 
		 comite_descripcion varchar(512) DEFAULT NULL COMMENT 'DESCRIPCION', 
		 comite_activo char(1) DEFAULT NULL, 
		 comite_lider varchar(100) DEFAULT NULL, 
		 comite_email varchar(100) DEFAULT NULL, 
		 comite_consecActa int(11) DEFAULT NULL, 
		 PRIMARY KEY (comite_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
 
   SELECT 'Tabla mm_comites creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_empresa ( 
		 empresa_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 empresa_nombre varchar(120) NOT NULL COMMENT 'NOMBRE', 
		 empresa_nit varchar(45) DEFAULT NULL COMMENT 'NIT', 
		 empresa_web varchar(120) DEFAULT NULL COMMENT 'WEB', 
		 empresa_direccion varchar(120) DEFAULT NULL COMMENT 'DIRECCION', 
		 empresa_telefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS', 
		 empresa_ciudad varchar(45) DEFAULT NULL COMMENT 'CIUDAD', 
		 empresa_logo varchar(45) DEFAULT NULL COMMENT 'LOGO', 
		 empresa_autentica char(1) DEFAULT NULL, 
		 empresa_lenguaje char(3) DEFAULT NULL, 
		 empresa_versionPrd varchar(100) DEFAULT NULL, 
		 empresa_versionBd varchar(100) DEFAULT NULL, 
		 empresa_clave varchar(50) DEFAULT NULL, 
		 empresa_email varchar(50) DEFAULT NULL, 
		 empresa_registrsoXpagina int(11) DEFAULT NULL, 
		 empresa_diasTrabaja varchar(45) DEFAULT NULL, 
		 empresa_horarioInicio varchar(45) DEFAULT NULL, 
		 empresa_horarioTermina varchar(45) DEFAULT NULL, 
		 empresa_intervaloCalendario char(1) DEFAULT NULL, 
		 empresa_FormatoActa varchar(45) DEFAULT NULL, 
		 empresa_cresidencial char(1) DEFAULT NULL COMMENT 'S es un conjunto residencial N no lo es', 
		 empresa_ctrl varchar(45) DEFAULT NULL,         
		 PRIMARY KEY (empresa_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_empresa creada'; 
 
   DELETE FROM atominge_mmeetingU.mm_empresa WHERE empresa_id > 0; 
    
   INSERT INTO atominge_mmeetingU.mm_empresa (empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, 
empresa_telefonos, empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje,  
empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, 
empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario,  
empresa_FormatoActa, empresa_cresidencial, empresa_ctrl) 
VALUES ('1', 'ATOM INGENIERIA SAS', '12345678', 'http://www.atomingenieria.com', 
'Cra 54 55-44 Ap 412', '3174142133', 'Bogota DC', 'logoEmpresa.png', 'M', 'ESP',  
'TEST-201806', 'TEST-201806', 'TEST', 'info@atomingenieria.com', '10', 'L-M-M-J-V',  
'7:00', '19:00', 'M', 'Estandard', 'N','wefB875s13846s12518refd8624A12'); 
 
   SELECT 'Empresa AtomIngenieria creada '; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_grupos ( 
		 grupo_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 grupo_empresa int(11) DEFAULT NULL, 
		 grupo_nombre varchar(45) DEFAULT NULL COMMENT 'NOMBRE', 
		 grupo_detalle varchar(120) DEFAULT NULL COMMENT 'DETALLE', 
		 grupo_comite int(11) DEFAULT NULL, 
		 grupo_activo char(1) DEFAULT NULL, 
		 PRIMARY KEY (grupo_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
  SELECT 'Tabla mm_grupos creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_inmuebles ( 
		 inmueble_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 inmueble_empresa int(11) DEFAULT NULL COMMENT 'EMPRESA', 
		 inmueble_codigo varchar(10) NOT NULL COMMENT 'CODIGO', 
		 inmueble_descripcion varchar(45) NOT NULL COMMENT 'DESCRIPCION', 
		 inmueble_area decimal(8,2) DEFAULT NULL COMMENT 'AREA', 
		 inmueble_coeficiente decimal(10,6) DEFAULT NULL COMMENT 'COEFICIENTE', 
		 inmueble_ubicacion varchar(45) DEFAULT NULL COMMENT 'UBICACION', 
		 inmueble_propNombre varchar(50) NOT NULL COMMENT 'NOMBRE', 
		 inmueble_propCedula varchar(10) DEFAULT NULL COMMENT 'CEDULA', 
		 inmueble_propTelefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS', 
		 inmueble_propDireccion varchar(45) DEFAULT NULL COMMENT 'DIRECCION', 
		 inmueble_propCorreo varchar(45) DEFAULT NULL COMMENT 'E-MAIL', 
		 inmueble_Activo char(1) DEFAULT NULL COMMENT 'ACTIVO', 
		 inmueble_comite int(11) DEFAULT NULL, 
		 inmueble_prinipal char(1) DEFAULT NULL, 
		 PRIMARY KEY (inmueble_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_inmuebles creada'; 
 
  CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_invitados_comite ( 
		 invitado_id int(11) NOT NULL AUTO_INCREMENT, 
		 invitado_agendaId int(11) DEFAULT NULL, 
		 invitado_empresa int(11) DEFAULT NULL, 
		 PRIMARY KEY (invitado_id)) 
		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
  SELECT 'Tabla mm_invitados_comite creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_menu ( 
		 menu_id int(11) NOT NULL AUTO_INCREMENT, 
		 menu_codigo int(11) DEFAULT NULL, 
		 menu_empresa int(11) DEFAULT NULL, 
		 menu_descripcion varchar(45) DEFAULT NULL, 
		 menu_nodo int(11) DEFAULT NULL, 
		 menu_nodoPadre int(11) DEFAULT NULL, 
		 menu_modulo varchar(45) DEFAULT NULL, 
		 menu_orden int(11) DEFAULT NULL, 
		 PRIMARY KEY (menu_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_menu creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_parametros ( 
		 param_Id varchar(45) NOT NULL, 
		 param_empresaid int(11) NOT NULL, 
		 param_registrsoXpagina int(11) DEFAULT NULL, 
		 param_diasTrabaja varchar(45) DEFAULT NULL, 
		 param_horarioInicio varchar(45) DEFAULT NULL, 
		 param_horarioTermina varchar(45) DEFAULT NULL, 
		 param_intervaloCalendario char(1) DEFAULT NULL, 
		 PRIMARY KEY (param_Id)) 
		ENGINE=InnoDB   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
 
   SELECT 'Tabla mm_parametros creada'; 
 
  CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_perfiles ( 
		 perfil_id int(11) NOT NULL AUTO_INCREMENT, 
		 perfil_empresa int(11) DEFAULT NULL, 
		 perfil_codigo varchar(10) NOT NULL, 
		 perfil_nombre varchar(45) NOT NULL, 
		 perfil_activo char(1) DEFAULT NULL, 
		 PRIMARY KEY (perfil_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
 
   SELECT 'Tabla mm_perfiles creada'; 
 
   DELETE FROM atominge_mmeetingU.mm_perfiles WHERE perfil_id > 0; 
	 
 
   INSERT INTO atominge_mmeetingU.mm_perfiles (perfil_empresa, perfil_codigo, 
			perfil_nombre, perfil_activo) VALUES ('1', '1', 'GENERAL', 'A') ; 
 
   SELECT 'perfil general creado'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_popup ( 
		 popup_id int(11) NOT NULL AUTO_INCREMENT, 
		 popup_codigo varchar(10) DEFAULT NULL, 
		 popup_titulo varchar(45) DEFAULT NULL, 
		 popup_comentario text, 
		 PRIMARY KEY (popup_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
 
   SELECT 'Tabla mm_popup creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_reservasalon ( 
		 reservaSal_id int(11) NOT NULL AUTO_INCREMENT, 
		 reservaSal_idEmpresa int(11) DEFAULT NULL, 
		 reservaSal_idSalon int(11) DEFAULT NULL, 
		 reservaSal_idComite int(11) DEFAULT NULL, 
		 reservaSal_FechaDesde datetime DEFAULT NULL, 
		 reservaSal_FechaHasta datetime DEFAULT NULL, 
		 reservaSal_reservadoPor varchar(60) DEFAULT NULL, 
		 reservaSal_FechaReserva datetime DEFAULT NULL, 
		 reservaSal_Confirmado char(1) DEFAULT NULL, 
		 reservaSal_Observaciones varchar(500) DEFAULT NULL, 
		 PRIMARY KEY (reservaSal_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
 
   SELECT 'Tabla mm_reservasalon creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_salones ( 
		 salon_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 salon_empresa int(11) DEFAULT NULL, 
		 salon_nombre varchar(50) DEFAULT NULL COMMENT 'NOMBRE', 
		 salon_ubicacion varchar(45) DEFAULT NULL COMMENT 'UBICACION ', 
		 salon_capacidad int(11) DEFAULT NULL COMMENT 'CAPACIDAD', 
		 salon_apoyovisual varchar(120) DEFAULT NULL COMMENT 'APOYOS', 
		 salon_responsable varchar(45) DEFAULT NULL COMMENT 'RESPONSABLE', 
		 salon_activo char(1) DEFAULT NULL COMMENT 'ACTIVO', 
		 salon_observaciones varchar(512) DEFAULT NULL COMMENT 'OBSERVACIONES', 
		 PRIMARY KEY (salon_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_salones creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_temasgrales ( 
		 temasGrales_id int(11) NOT NULL AUTO_INCREMENT, 
		 temasGrales_empresa int(11) DEFAULT NULL, 
		 temasGrales_comiteId int(11) DEFAULT NULL, 
		 temasGrales_titulo varchar(60) DEFAULT NULL, 
		 temasGrales_detalle varchar(1000) DEFAULT NULL, 
		 temasGrales_estado char(1) DEFAULT NULL, 
		 PRIMARY KEY (temasGrales_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_temasgrales creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_temp01 ( 
		 hora varchar(10) COLLATE utf8_spanish_ci NOT NULL, 
		 detalle varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL, 
		 PRIMARY KEY (hora) ) 
		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_temp01 creada'; 
 
  CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_tipoacta ( 
		 tipoActa_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 tipoActa_empresa int(11) DEFAULT NULL, 
		 tipoActa_nombre varchar(45) DEFAULT NULL COMMENT 'NOMBRE', 
		 tipoActa_formato varchar(100) DEFAULT NULL COMMENT 'FORMATO', 
		 PRIMARY KEY (tipoActa_id) ) 
		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_tipoacta creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_usuariomenu ( 
		 usuarioMenu_id int(11) NOT NULL AUTO_INCREMENT, 
		 usuarioMenu_menu int(11) DEFAULT NULL, 
		 usuarioMenu_empresa int(11) DEFAULT NULL, 
		 usuarioMenu_perfil int(11) DEFAULT NULL, 
		 PRIMARY KEY (usuarioMenu_id)) 
		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_usuariomenu creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_usuarios ( 
		 usuario_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
		 usuario_nombre varchar(100) NOT NULL COMMENT 'NOMBRE', 
		 usuario_empresa int(11) DEFAULT NULL, 
		 usuario_email varchar(80) NOT NULL COMMENT 'LOGIN', 
		 usuario_password varchar(45) NOT NULL COMMENT 'PASSWORD', 
		 usuario_tipo_acceso char(1) NOT NULL COMMENT 'ACCESO', 
		 usuario_fechaCreado date DEFAULT NULL, 
		 usuario_fechaActualizado date DEFAULT NULL, 
		 usuario_estado char(1) DEFAULT NULL, 
		 usuario_perfil varchar(10) DEFAULT NULL, 
		 usuario_avatar varchar(45) DEFAULT NULL, 
		 usuario_user varchar(20) DEFAULT NULL, 
		 usuario_celular varchar(12) DEFAULT NULL, 
		 PRIMARY KEY (usuario_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; 
 
   SELECT 'Tabla mm_usuarios creada' ; 
 
  DELETE FROM atominge_mmeetingU.mm_usuarios WHERE usuario_id > 0; 
 
   INSERT INTO atominge_mmeetingU.mm_usuarios (usuario_nombre, usuario_empresa, usuario_email, 
		 usuario_password, usuario_tipo_acceso, usuario_fechaCreado, 
		 usuario_fechaActualizado, usuario_estado, usuario_perfil, 
		 usuario_avatar, usuario_user, usuario_celular) 
		  VALUES ('admin', '1', 'admin@com.co', md5('admin123'), 'A', 
		 '2018-12-31', '2018-12-31', 'A', '1', 'AVATAR.PNG', 'admin', '3101231231'); 
 
   SELECT 'Usuario admin@com.co y su contraseña admin123 creado'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mn_privilegios ( 
		 privilegio_id int(11) NOT NULL AUTO_INCREMENT, 
		 privilegio_perfil int(11) DEFAULT NULL, 
		 privilegio_menu int(11) DEFAULT NULL, 
		 PRIMARY KEY (privilegio_id)) 
		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  
	    
	SELECT 'Tabla mn_privilegios creada'; 
 
   CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_llamalista ( 
	lista_id  int(11) NOT NULL AUTO_INCREMENT, 
	lista_empresa INT(11) NULL , 
	lista_codigo VARCHAR(10) NULL , 
	lista_inmueble VARCHAR(10) NULL , 
    lista_asiste1 CHAR(1) NULL , 
	lista_asiste2 CHAR(1) NULL , 
    lista_asiste3 CHAR(1) NULL , 
	lista_asiste4 CHAR(1) NULL , 
	lista_asiste5 CHAR(1) NULL , 
	lista_asiste6 CHAR(1) NULL , 
    lista_area DECIMAL(12,2) NULL , 
	lista_coeficiente DECIMAL(12,8) NULL , 
	lista_propietario VARCHAR(60) NULL , 
	lista_cedula VARCHAR(12) NULL , 
    lista_obervacion VARCHAR(45) NULL , 
    lista_descripcion VARCHAR(45) NULL , 
  PRIMARY KEY (lista_id) ) 
   ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;   
	    
	SELECT 'Tabla mm_llamalista creada'; 
 
  CREATE TABLE IF NOT EXISTS atominge_mmeetingU.mm_agendamiento ( 
	agenda_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  
	agenda_empresa int(11) DEFAULT NULL,  
	agenda_salonId int(11) DEFAULT NULL COMMENT 'SALON', 
	agenda_Descripcion varchar(500) DEFAULT NULL,  
	agenda_comiteId int(11) DEFAULT NULL COMMENT 'COMITE', 
	agenda_fechaDesde datetime DEFAULT NULL COMMENT 'FCH_DESDE',  
	agenda_fechaHasta datetime DEFAULT NULL COMMENT 'FCH_HASTA',  
	agenda_comiteAnteriorId int(11) DEFAULT NULL COMMENT 'COMITE_ANTERIOR', 
	agenda_usuario int(11) DEFAULT NULL,   
    agenda_enFirme char(1) DEFAULT NULL,  
	agenda_conCitacion char(1) DEFAULT NULL,   
    agenda_acta int(11) DEFAULT NULL,  
	agenda_estado char(1) DEFAULT NULL,  
    agenda_causal varchar(100) DEFAULT NULL, 
	agenda_ProxCitacion varchar(45) DEFAULT NULL, 
	PRIMARY KEY (agenda_id), 
	INDEX agendaComites_idx (agenda_comiteId ASC) , 
   INDEX agendaSalones_idx (agenda_salonId ASC) , 
	CONSTRAINT agendaComite 
		   FOREIGN KEY (agenda_comiteId) 
		   REFERENCES mm_comites (comite_id) 
		   ON DELETE RESTRICT 
		   ON UPDATE RESTRICT, 
    CONSTRAINT  agendaSalones 
		   FOREIGN KEY (agenda_salonId) 
		   REFERENCES mm_salones (salon_id) 
		   ON DELETE RESTRICT 
		   ON UPDATE RESTRICT) 
           ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Ocupacion de los salones'; 
	 
   SELECT 'Tabla mm_agendamiento creada'; 
    
