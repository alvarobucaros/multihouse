<?php

$data = json_decode(file_get_contents("php://input")); 
$op =  $data->op;
switch ($op)

{
    case 'r':
        leeRegistros($data);
        break;
    case 'b':
        borra($data);
        break;
    case 'a2':
        actualiza2($data);
        break;    
    case 'a':
        actualiza($data);
        break; 
    case 'u':
        unRegistro($data);
        break;
    case 'm':
        maxRegistroId($data);
        break;
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $sql = "SELECT  id, servidor, basedatos, usuario, password, estado" 
                    . " FROM mm_instala ORDER BY servidor ";             
            $result = mysqli_query($con, $sql); 
            $arr = array(); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                        $arr[] = $row; 
                    } 
                } 
            echo $json_info = json_encode($arr); 
       } 
    } 
 
    function borra($data)
    { 
       global $objClase;
        $con = $objClase->conectar(); 
        $sql = "DELETE FROM mm_instala WHERE id=$data->id"; 
        mysqli_query($con, $sql); 
        echo 'Ok'; 
    }
 
    function actualiza2($data)
    {     
        error_reporting(0);
        $servername =  $data->servidor; 
        $BaseDatos =  $data->basedatos; 
        $username =  $data->usuario; 
        $password =  $data->password; 
        $estado =  $data->estado; 
        $txt=   funde($servername).'~'.funde($BaseDatos).'~'.funde($username) .'~'.funde($password) .'~'. $estado;  
        $file = fopen("../bin/cls/mm.ctl", "w");
        fwrite($file, $txt . PHP_EOL);
        fclose($file);
        $txt= $servername.'~'.$BaseDatos.'~'.$username .'~'.$password .'~'. $estado;  

        $nota2= ''; //<p>Ya se hizo una instalacion en este servidor con esta base de datos</p>';

        $link = mysqli_connect($servername, $username, $password, $BaseDatos);
       
        $err =  mysqli_connect_errno(); 
        if ($err)
        {
            $err =  mysqli_connect_errno(); 
            if ($err === 1045 ) {$nota2 .= '<p>Usuario no creado y/o password errado</p>';}
            if ($err === 1044 ) {$nota2 .= '<p>El usuario no está creado en la base de datos</p>';}
            if ($err === 2001 ) {$nota2 .= '<p>No existe este servidor de base de datos</p>';}
            if ($err === 2002 ) {$nota2 .= '<p>No existe el servidor o No se puede conectar al servidor MySQL loca, verificar los archivos de configuración.</p>';}
            if ($err === 1049 ) {
                $nota2.='<p>Debe crear la Base de Datos '.$BaseDatos .'</p>'.'<p>Vaya a la carpeta scripts y ejecute creaBaseDatos.sql</p>';   
                actualiza($txt);                
            }
        }
        else
        {
            if ($err === 0) {$nota2 = '<p>Ya se hizo una instalación en este servidor con esta Base de Batos</p>';
                          //   $nota2 .= '<p>Si no lo ha hecho, para crear la base de datos debe ejecutar el script instalaDb.sql que está en la carpeta multimeeting/scripts </p>';
                             $nota2 .= '<p>Para reinstalar borre la base de datos del servidor y repita este proceso.</p>';}            
        }
        $nota = 'Importante:'; //Error : '.$err;
        if ($err==0){$nota  = '';}
        echo $nota.'  '.$nota2;  
    }
    
    function actualiza($data)
    { 
        $rec=  explode('~', $data);
        
        $servername =  $rec[0]; 
        $BaseDatos =  $rec[1]; 
        $username =  $rec[2]; 
        $password =  $rec[3]; 
        $estado =  $rec[4];
        $hoy = date("l,M d, Y g:i:s");

        $file = fopen("../../scripts/creaBaseDatos.sql", "w");

        graba($file,"-- MySQL dbcreate database for multimeeting");
        graba($file,"--");
        graba($file,"-- Host: ".$servername);    
        graba($file,"-- Database:".$BaseDatos);
        graba($file,"-- Script date ".$hoy); 
        graba($file,"-- by AtomIngenieria sas");
        graba($file,"");
        graba($file,"--");
        graba($file,"-- Crea Base de datos");
        graba($file,"--");
        graba($file,"CREATE DATABASE ".$BaseDatos ." CHARACTER SET utf8 COLLATE utf8_spanish_ci;");
        graba($file,"USE ".$BaseDatos. "; ");   
        graba($file,"");
        graba($file,"--");
        graba($file,"-- Table structure for table mm_instala");
        graba($file,"--");

        graba($file,"   DROP TABLE IF EXISTS ".$BaseDatos .".mm_instala;");              
        graba($file,"	CREATE TABLE IF NOT EXISTS  ".$BaseDatos .".mm_instala ( ");
        graba($file,"	id int(11) NOT NULL AUTO_INCREMENT,");
        graba($file,"	servidor varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,");
        graba($file,"	basedatos varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,");
        graba($file,"	usuario varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,");
        graba($file,"	password varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,");
        graba($file,"	estado char(1),");
        graba($file,"	PRIMARY KEY (id)");
        graba($file,"	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");
        graba($file,"");
        graba($file,"   SELECT 'Tabla mm_instala creada';");
        graba($file,"	");
        graba($file,"   INSERT INTO ".$BaseDatos .".mm_instala (servidor,basedatos, usuario, password, estado) VALUES ( '".$servername.
                        "','".$BaseDatos ."','".$username."','".$password."','".$estado."');");
        graba($file,"   ");
        graba($file,"   SELECT 'Datos de instalacion creados' ;");  
        graba($file,"   ");

        graba($file,"--");
        graba($file,"-- Table structure for table mm_accesos");
        graba($file,"--");
        graba($file,"   DROP TABLE IF EXISTS ".$BaseDatos .".mm_accesos;");    
        graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_accesos (  ");
        graba($file,"   acceso_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  ");
        graba($file,"	acceso_empresa int(11) DEFAULT NULL,  ");
        graba($file,"	acceso_asistenteId int(11) DEFAULT NULL COMMENT 'ASISTENTE', "); 
        graba($file,"	acceso_comiteId int(11) DEFAULT NULL COMMENT 'COMITE',  ");
        graba($file,"	acceso_tipoAcceso char(1) DEFAULT NULL COMMENT 'TIPO_ACCESO', ");
        graba($file,"	PRIMARY KEY (acceso_id)  ");
        graba($file,"	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='acceso de asistentes a reuniones'; ");
        graba($file," ");
        graba($file,"   SELECT 'Tabla mm_accesos creada'; ");
        graba($file,"	 ");
        graba($file,"--");
        graba($file,"-- Table structure for table mm_agendaanexos");
        graba($file,"--");
        graba($file,"   DROP TABLE IF EXISTS ".$BaseDatos .".mm_agendaanexos;");  
        graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendaanexos ( "); 
        graba($file,"	anexos_id int(11) NOT NULL AUTO_INCREMENT,  ");
        graba($file,"   anexos_empresa int(11) DEFAULT NULL, "); 
        graba($file,"	anexos_comiteid int(11) DEFAULT NULL, ");
        graba($file,"   anexos_agendaid int(11) DEFAULT NULL, "); 
        graba($file,"   anexos_usuario int(11) DEFAULT NULL, "); 
        graba($file,"	anexos_anno varchar(4) DEFAULT NULL,  ");
        graba($file,"	anexos_anexo varchar(100) DEFAULT NULL,  ");
        graba($file,"	anexos_ruta varchar(100) DEFAULT NULL,  ");
        graba($file,"	anexos_fecha varchar(20) DEFAULT NULL,  ");
        graba($file,"	anexos_descripcion varchar(100) DEFAULT NULL, ");  
        graba($file,"	PRIMARY KEY (anexos_id)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ; ");
        graba($file," ");
        graba($file,"   SELECT 'Tabla mm_agendaanexos creada'; ");
        graba($file,"	 ");

graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendainvitados (  invitado_id int(11) NOT NULL AUTO_INCREMENT,  ");
graba($file,"	invitado_agendaId int(11) DEFAULT NULL,  invitado_nombre varchar(120) DEFAULT NULL,  ");
graba($file,"	invitado_empresa varchar(120) DEFAULT NULL,  invitado_cargo varchar(45) DEFAULT NULL,  ");
graba($file,"	invitado_celuar varchar(20) DEFAULT NULL,  invitado_email varchar(120) DEFAULT NULL,  ");
graba($file,"	invitado_asistio char(1) DEFAULT NULL,  invitado_titulo char(1) DEFAULT NULL,  ");
graba($file,"	invitado_orden int(11) DEFAULT NULL,  invitado_causa varchar(45) DEFAULT NULL,  ");
graba($file,"	invitado_comite int(11) DEFAULT NULL,  invitado_causa invitado_empresaID(11) DEFAULT NULL,  ");

graba($file,"	PRIMARY KEY (invitado_id) ");
graba($file,"	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ; ");            
graba($file," ");
graba($file,"   SELECT 'Tabla mm_agendainvitados creada'; ");
graba($file,"   ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendamiento ( "); 
graba($file,"	agenda_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  ");
graba($file,"	agenda_empresa int(11) DEFAULT NULL,  ");
graba($file,"	agenda_salonId int(11) DEFAULT NULL COMMENT 'SALON', "); 
graba($file,"	agenda_Descripcion varchar(500) DEFAULT NULL,  ");
graba($file,"	agenda_comiteId int(11) DEFAULT NULL COMMENT 'COMITE', "); 
graba($file,"	agenda_fechaDesde datetime DEFAULT NULL COMMENT 'FCH_DESDE', "); 
graba($file,"	agenda_fechaHasta datetime DEFAULT NULL COMMENT 'FCH_HASTA',  ");
graba($file,"	agenda_comiteAnteriorId int(11) DEFAULT NULL COMMENT 'COMITE_ANTERIOR', "); 
graba($file,"	agenda_usuario int(11) DEFAULT NULL,   ");
graba($file,"   agenda_enFirme char(1) DEFAULT NULL,  ");
graba($file,"	agenda_conCitacion char(1) DEFAULT NULL,   ");
graba($file,"   agenda_acta int(11) DEFAULT NULL,  ");
graba($file,"	agenda_estado char(1) DEFAULT NULL,  ");
graba($file,"   agenda_causal varchar(100) DEFAULT NULL, "); 
graba($file,"	agenda_ProxCitacion varchar(45) DEFAULT NULL, "); 
graba($file,"	agenda_revisa int(11) NULL DEFAULT 0, ") ;
graba($file,"	agenda_cierraActa char(1) NULL DEFAULT 'N', ") ;
graba($file,"	PRIMARY KEY (agenda_id))  ");
graba($file,"	ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Ocupacion de los salones'; ");
graba($file,"	 ");
graba($file,"   SELECT 'Tabla mm_agendamiento creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendapendientes ( ");
graba($file,"	pendiente_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"	pendiente_agendaId int(11) DEFAULT NULL, ");
graba($file,"	pendiente_empresa int(11) DEFAULT NULL, ");
graba($file,"	pendiente_titulo varchar(128) DEFAULT NULL, ");
graba($file,"	pendiente_detalle varchar(1024) DEFAULT NULL, ");
graba($file,"	pendiente_responsable varchar(128) DEFAULT NULL, ");
graba($file,"	pendiente_fecha date DEFAULT NULL, ");
graba($file,"	pendiente_estado char(1) DEFAULT NULL, ");
graba($file,"	PRIMARY KEY (pendiente_id)) ");
graba($file,"	ENGINE=InnoDB   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
 graba($file,"  SELECT 'Tabla mm_agendapendientes creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendatemas ( ");
graba($file,"		 tema_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 tema_agendaId int(11) DEFAULT NULL, ");
graba($file,"		 tema_empresa int(11) DEFAULT NULL, ");
graba($file,"		 tema_comite int(11) DEFAULT NULL, ");
graba($file,"		 tema_titulo varchar(128) DEFAULT NULL, ");
graba($file,"		 tema_detalle varchar(1024) DEFAULT NULL, ");
graba($file,"		 tema_tipo varchar(5) DEFAULT NULL, ");
graba($file,"		 tema_responsable varchar(45) DEFAULT NULL, ");
graba($file,"		 tema_desarrollo varchar(2048) DEFAULT NULL, ");
graba($file,"		 tema_fechaAsigna date DEFAULT NULL, ");
graba($file,"		 tema_fechaCumple date DEFAULT NULL, ");
graba($file,"		 tema_estado char(1) DEFAULT NULL, ");
graba($file,"		 tema_orden int(6) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (tema_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_agendatemas creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_asistentes ( ");
graba($file,"		 asistente_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 asistente_comite varchar(20) DEFAULT NULL COMMENT 'GRUPO', ");
graba($file,"		 asistente_usuarioId int(11) DEFAULT NULL COMMENT 'USUARIO_ID', ");
graba($file,"		 asistente_nombre varchar(120) DEFAULT NULL COMMENT 'NOMBRE', ");
graba($file,"		 asistente_empresa varchar(120) DEFAULT NULL COMMENT 'EMPRESA', ");
graba($file,"		 asistente_cargo varchar(45) DEFAULT NULL COMMENT 'CARGO', ");
graba($file,"		 asistente_celuar varchar(20) DEFAULT NULL COMMENT 'CELULAR', ");
graba($file,"		 asistente_email varchar(120) DEFAULT NULL COMMENT 'E_MAIL', ");
graba($file,"		 asistente_empresaId int(11) DEFAULT NULL, ");
graba($file,"		 asistente_titulo varchar(4) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (asistente_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_asistentes creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_cargadocumentos ( ");
graba($file,"		 carga_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 carga_empresa int(11) DEFAULT NULL, ");
graba($file,"		 carga_comite int(11) DEFAULT NULL, ");
graba($file,"		 carga_agendaId int(11) DEFAULT NULL, ");
graba($file,"		 carga_titulo varchar(45) DEFAULT NULL, ");
graba($file,"		 carga_descripcion varchar(500) DEFAULT NULL, ");
graba($file,"		 carga_tipo varchar(20) DEFAULT NULL, ");
graba($file,"		 carga_documento varchar(500) DEFAULT NULL, ");
graba($file,"		 carga_ruta varchar(500) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (carga_id)) ");
graba($file,"		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_cargadocumentos creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_comites ( ");
graba($file,"		 comite_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 comite_empresa int(11) DEFAULT NULL, ");
graba($file,"		 comite_nombre varchar(120) DEFAULT NULL COMMENT 'NOMBRE', ");
graba($file,"		 comite_descripcion varchar(512) DEFAULT NULL COMMENT 'DESCRIPCION', ");
graba($file,"		 comite_activo char(1) DEFAULT NULL, ");
graba($file,"		 comite_lider varchar(100) DEFAULT NULL, ");
graba($file,"		 comite_email varchar(100) DEFAULT NULL, ");
graba($file,"		 comite_consecActa int(11) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (comite_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");
graba($file," ");
graba($file,"   SELECT 'Tabla mm_comites creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_empresa ( ");
graba($file,"		 empresa_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 empresa_nombre varchar(120) NOT NULL COMMENT 'NOMBRE', ");
graba($file,"		 empresa_nit varchar(45) DEFAULT NULL COMMENT 'NIT', ");
graba($file,"		 empresa_web varchar(120) DEFAULT NULL COMMENT 'WEB', ");
graba($file,"		 empresa_direccion varchar(120) DEFAULT NULL COMMENT 'DIRECCION', ");
graba($file,"		 empresa_telefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS', ");
graba($file,"		 empresa_ciudad varchar(45) DEFAULT NULL COMMENT 'CIUDAD', ");
graba($file,"		 empresa_logo varchar(45) DEFAULT NULL COMMENT 'LOGO', ");
graba($file,"		 empresa_autentica char(1) DEFAULT NULL, ");
graba($file,"		 empresa_lenguaje char(3) DEFAULT NULL, ");
graba($file,"		 empresa_versionPrd varchar(100) DEFAULT NULL, ");
graba($file,"		 empresa_versionBd varchar(100) DEFAULT NULL, ");
graba($file,"		 empresa_clave varchar(50) DEFAULT NULL, ");
graba($file,"		 empresa_email varchar(50) DEFAULT NULL, ");
graba($file,"		 empresa_registrsoXpagina int(11) DEFAULT NULL, ");
graba($file,"		 empresa_diasTrabaja varchar(45) DEFAULT NULL, ");
graba($file,"		 empresa_horarioInicio varchar(45) DEFAULT NULL, ");
graba($file,"		 empresa_horarioTermina varchar(45) DEFAULT NULL, ");
graba($file,"		 empresa_intervaloCalendario char(1) DEFAULT NULL, ");
graba($file,"		 empresa_FormatoActa varchar(45) DEFAULT NULL, ");
graba($file,"		 empresa_cresidencial char(1) DEFAULT NULL COMMENT 'S es un conjunto residencial N no lo es', ");
graba($file,"		 empresa_ctrl varchar(45) DEFAULT NULL,         ");
graba($file,"		 PRIMARY KEY (empresa_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_empresa creada'; ");
graba($file," ");
graba($file,"   DELETE FROM ".$BaseDatos .".mm_empresa WHERE empresa_id > 0; ");
graba($file,"    ");
graba($file,"   INSERT INTO ".$BaseDatos .".mm_empresa (empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, ");
graba($file,"empresa_telefonos, empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje,  ");
graba($file,"empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, "); 
graba($file,"empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario,  ");
graba($file,"empresa_FormatoActa, empresa_cresidencial, empresa_ctrl) ");
graba($file,"VALUES ('1', 'ATOM INGENIERIA SAS', '12345678', 'http://www.atomingenieria.com', "); 
graba($file,"'Cra 54 55-44 Ap 412', '3174142133', 'Bogota DC', 'logoEmpresa.png', 'M', 'ESP',  ");
graba($file,"'TEST-201806', 'TEST-201806', 'TEST', 'info@atomingenieria.com', '10', 'L-M-M-J-V',  ");
graba($file,"'7:00', '19:00', 'M', 'Estandard', 'N','wefB875s13846s12518refd8624A12'); ");
graba($file," ");
graba($file,"   SELECT 'Empresa AtomIngenieria creada '; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_grupos ( ");
graba($file,"		 grupo_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 grupo_empresa int(11) DEFAULT NULL, ");
graba($file,"		 grupo_nombre varchar(45) DEFAULT NULL COMMENT 'NOMBRE', ");
graba($file,"		 grupo_detalle varchar(120) DEFAULT NULL COMMENT 'DETALLE', ");
graba($file,"		 grupo_comite int(11) DEFAULT NULL, ");
graba($file,"		 grupo_activo char(1) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (grupo_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
 graba($file,"  SELECT 'Tabla mm_grupos creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_inmuebles ( ");
graba($file,"		 inmueble_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 inmueble_empresa int(11) DEFAULT NULL COMMENT 'EMPRESA', ");
graba($file,"		 inmueble_codigo varchar(10) NOT NULL COMMENT 'CODIGO', ");
graba($file,"		 inmueble_descripcion varchar(45) NOT NULL COMMENT 'DESCRIPCION', ");
graba($file,"		 inmueble_area decimal(8,2) DEFAULT NULL COMMENT 'AREA', ");
graba($file,"		 inmueble_coeficiente decimal(10,6) DEFAULT NULL COMMENT 'COEFICIENTE', ");
graba($file,"		 inmueble_ubicacion varchar(45) DEFAULT NULL COMMENT 'UBICACION', ");
graba($file,"		 inmueble_propNombre varchar(50) NOT NULL COMMENT 'NOMBRE', ");
graba($file,"		 inmueble_propCedula varchar(10) DEFAULT NULL COMMENT 'CEDULA', ");
graba($file,"		 inmueble_propTelefonos varchar(45) DEFAULT NULL COMMENT 'TELEFONOS', ");
graba($file,"		 inmueble_propDireccion varchar(45) DEFAULT NULL COMMENT 'DIRECCION', ");
graba($file,"		 inmueble_propCorreo varchar(45) DEFAULT NULL COMMENT 'E-MAIL', ");
graba($file,"		 inmueble_Activo char(1) DEFAULT NULL COMMENT 'ACTIVO', ");
graba($file,"		 inmueble_comite int(11) DEFAULT NULL, ");
graba($file,"		 inmueble_prinipal char(1) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (inmueble_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_inmuebles creada'; ");
graba($file," ");
 graba($file,"  CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_invitados_comite ( ");
graba($file,"		 invitado_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 invitado_agendaId int(11) DEFAULT NULL, ");
graba($file,"		 invitado_empresa int(11) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (invitado_id)) ");
graba($file,"		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
 graba($file,"  SELECT 'Tabla mm_invitados_comite creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_menu ( ");
graba($file,"		 menu_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 menu_codigo int(11) DEFAULT NULL, ");
graba($file,"		 menu_empresa int(11) DEFAULT NULL, ");
graba($file,"		 menu_descripcion varchar(45) DEFAULT NULL, ");
graba($file,"		 menu_nodo int(11) DEFAULT NULL, ");
graba($file,"		 menu_nodoPadre int(11) DEFAULT NULL, ");
graba($file,"		 menu_modulo varchar(45) DEFAULT NULL, ");
graba($file,"		 menu_orden int(11) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (menu_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_menu creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_parametros ( ");
graba($file,"		 param_Id varchar(45) NOT NULL, ");
graba($file,"		 param_empresaid int(11) NOT NULL, ");
graba($file,"		 param_registrsoXpagina int(11) DEFAULT NULL, ");
graba($file,"		 param_diasTrabaja varchar(45) DEFAULT NULL, ");
graba($file,"		 param_horarioInicio varchar(45) DEFAULT NULL, ");
graba($file,"		 param_horarioTermina varchar(45) DEFAULT NULL, ");
graba($file,"		 param_intervaloCalendario char(1) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (param_Id)) ");
graba($file,"		ENGINE=InnoDB   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");
graba($file," ");
graba($file,"   SELECT 'Tabla mm_parametros creada'; ");
graba($file," ");
 graba($file,"  CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_perfiles ( ");
graba($file,"		 perfil_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 perfil_empresa int(11) DEFAULT NULL, ");
graba($file,"		 perfil_codigo varchar(10) NOT NULL, ");
graba($file,"		 perfil_nombre varchar(45) NOT NULL, ");
graba($file,"		 perfil_activo char(1) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (perfil_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");
graba($file," ");
graba($file,"   SELECT 'Tabla mm_perfiles creada'; ");
graba($file," ");
graba($file,"   DELETE FROM ".$BaseDatos .".mm_perfiles WHERE perfil_id > 0; ");
graba($file,"	 ");
graba($file," ");
graba($file,"   INSERT INTO ".$BaseDatos .".mm_perfiles (perfil_empresa, perfil_codigo, ");
graba($file,"			perfil_nombre, perfil_activo) VALUES ('1', '1', 'GENERAL', 'A') ; ");
graba($file," ");
graba($file,"   SELECT 'perfil general creado'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_popup ( ");
graba($file,"		 popup_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 popup_codigo varchar(10) DEFAULT NULL, ");
graba($file,"		 popup_titulo varchar(45) DEFAULT NULL, ");
graba($file,"		 popup_comentario text, ");
graba($file,"		 PRIMARY KEY (popup_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");
graba($file," ");
graba($file,"   SELECT 'Tabla mm_popup creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_reservasalon ( ");
graba($file,"		 reservaSal_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 reservaSal_idEmpresa int(11) DEFAULT NULL, ");
graba($file,"		 reservaSal_idSalon int(11) DEFAULT NULL, ");
graba($file,"		 reservaSal_idComite int(11) DEFAULT NULL, ");
graba($file,"		 reservaSal_FechaDesde datetime DEFAULT NULL, ");
graba($file,"		 reservaSal_FechaHasta datetime DEFAULT NULL, ");
graba($file,"		 reservaSal_reservadoPor varchar(60) DEFAULT NULL, ");
graba($file,"		 reservaSal_FechaReserva datetime DEFAULT NULL, ");
graba($file,"		 reservaSal_Confirmado char(1) DEFAULT NULL, ");
graba($file,"		 reservaSal_Observaciones varchar(500) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (reservaSal_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");
graba($file," ");
graba($file,"   SELECT 'Tabla mm_reservasalon creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_salones ( ");
graba($file,"		 salon_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 salon_empresa int(11) DEFAULT NULL, ");
graba($file,"		 salon_nombre varchar(50) DEFAULT NULL COMMENT 'NOMBRE', ");
graba($file,"		 salon_ubicacion varchar(45) DEFAULT NULL COMMENT 'UBICACION ', ");
graba($file,"		 salon_capacidad int(11) DEFAULT NULL COMMENT 'CAPACIDAD', ");
graba($file,"		 salon_apoyovisual varchar(120) DEFAULT NULL COMMENT 'APOYOS', ");
graba($file,"		 salon_responsable varchar(45) DEFAULT NULL COMMENT 'RESPONSABLE', ");
graba($file,"		 salon_activo char(1) DEFAULT NULL COMMENT 'ACTIVO', ");
graba($file,"		 salon_observaciones varchar(512) DEFAULT NULL COMMENT 'OBSERVACIONES', ");
graba($file,"		 PRIMARY KEY (salon_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_salones creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_temasgrales ( ");
graba($file,"		 temasGrales_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 temasGrales_empresa int(11) DEFAULT NULL, ");
graba($file,"		 temasGrales_comiteId int(11) DEFAULT NULL, ");
graba($file,"		 temasGrales_titulo varchar(60) DEFAULT NULL, ");
graba($file,"		 temasGrales_detalle varchar(1000) DEFAULT NULL, ");
graba($file,"		 temasGrales_estado char(1) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (temasGrales_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_temasgrales creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_temp01 ( ");
graba($file,"		 hora varchar(10) COLLATE utf8_spanish_ci NOT NULL, ");
graba($file,"		 detalle varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (hora) ) ");
graba($file,"		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_temp01 creada'; ");
graba($file," ");
graba($file,"  CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_tipoacta ( ");
graba($file,"		 tipoActa_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 tipoActa_empresa int(11) DEFAULT NULL, ");
graba($file,"		 tipoActa_nombre varchar(45) DEFAULT NULL COMMENT 'NOMBRE', ");
graba($file,"		 tipoActa_formato varchar(100) DEFAULT NULL COMMENT 'FORMATO', ");
graba($file,"		 PRIMARY KEY (tipoActa_id) ) ");
graba($file,"		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_tipoacta creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_usuariomenu ( ");
graba($file,"		 usuarioMenu_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 usuarioMenu_menu int(11) DEFAULT NULL, ");
graba($file,"		 usuarioMenu_empresa int(11) DEFAULT NULL, ");
graba($file,"		 usuarioMenu_perfil int(11) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (usuarioMenu_id)) ");
graba($file,"		ENGINE=InnoDB    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_usuariomenu creada'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_usuarios ( ");
graba($file,"		 usuario_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', ");
graba($file,"		 usuario_nombre varchar(100) NOT NULL COMMENT 'NOMBRE', ");
graba($file,"		 usuario_empresa int(11) DEFAULT NULL, ");
graba($file,"		 usuario_email varchar(80) NOT NULL COMMENT 'LOGIN', ");
graba($file,"		 usuario_password varchar(45) NOT NULL COMMENT 'PASSWORD', ");
graba($file,"		 usuario_tipo_acceso char(1) NOT NULL COMMENT 'ACCESO', ");
graba($file,"		 usuario_fechaCreado date DEFAULT NULL, ");
graba($file,"		 usuario_fechaActualizado date DEFAULT NULL, ");
graba($file,"		 usuario_estado char(1) DEFAULT NULL, ");
graba($file,"		 usuario_perfil varchar(10) DEFAULT NULL, ");
graba($file,"		 usuario_avatar varchar(45) DEFAULT NULL, ");
graba($file,"		 usuario_user varchar(20) DEFAULT NULL, ");
graba($file,"		 usuario_celular varchar(12) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (usuario_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1   DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci; "); 
graba($file," ");
graba($file,"   SELECT 'Tabla mm_usuarios creada' ; ");
graba($file," ");
graba($file,"  DELETE FROM ".$BaseDatos .".mm_usuarios WHERE usuario_id > 0; ");
graba($file," ");
graba($file,"   INSERT INTO ".$BaseDatos .".mm_usuarios (usuario_nombre, usuario_empresa, usuario_email, ");
graba($file,"		 usuario_password, usuario_tipo_acceso, usuario_fechaCreado, ");
graba($file,"		 usuario_fechaActualizado, usuario_estado, usuario_perfil, ");
graba($file,"		 usuario_avatar, usuario_user, usuario_celular) ");
graba($file,"		  VALUES ('admin', '1', 'admin@com.co', md5('admin123'), 'A', ");
graba($file,"		 '2018-12-31', '2018-12-31', 'A', '1', 'AVATAR.PNG', 'admin', '3101231231'); ");
graba($file," ");
graba($file,"   SELECT 'Usuario admin@com.co y su contraseña admin123 creado'; ");
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mn_privilegios ( ");
graba($file,"		 privilegio_id int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"		 privilegio_perfil int(11) DEFAULT NULL, ");
graba($file,"		 privilegio_menu int(11) DEFAULT NULL, ");
graba($file,"		 PRIMARY KEY (privilegio_id)) ");
graba($file,"		ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;  ");                
graba($file,"	    ");
graba($file,"	SELECT 'Tabla mn_privilegios creada'; ");               
graba($file," ");
graba($file,"   CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_llamalista ( ");
graba($file,"	lista_id  int(11) NOT NULL AUTO_INCREMENT, ");
graba($file,"	lista_empresa INT(11) NULL , ");
graba($file,"	lista_codigo VARCHAR(10) NULL , ");
graba($file,"	lista_inmueble VARCHAR(10) NULL , ");
graba($file,"    lista_asiste1 CHAR(1) NULL , ");
graba($file,"	lista_asiste2 CHAR(1) NULL , ");
graba($file,"    lista_asiste3 CHAR(1) NULL , ");
graba($file,"	lista_asiste4 CHAR(1) NULL , ");
graba($file,"	lista_asiste5 CHAR(1) NULL , ");
graba($file,"	lista_asiste6 CHAR(1) NULL , ");
graba($file,"    lista_area DECIMAL(12,2) NULL , ");
graba($file,"	lista_coeficiente DECIMAL(12,8) NULL , ");
graba($file,"	lista_propietario VARCHAR(60) NULL , ");
graba($file,"	lista_cedula VARCHAR(12) NULL , ");
graba($file,"    lista_obervacion VARCHAR(45) NULL , ");
graba($file,"    lista_descripcion VARCHAR(45) NULL , ");
 graba($file,"  PRIMARY KEY (lista_id) ) ");
graba($file,"   ENGINE=InnoDB AUTO_INCREMENT=1    DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;   ");               
graba($file,"	    ");
graba($file,"	SELECT 'Tabla mm_llamalista creada'; "); 
graba($file," ");
 graba($file,"  CREATE TABLE IF NOT EXISTS ".$BaseDatos .".mm_agendamiento ( "); 
graba($file,"	agenda_id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',  ");
graba($file,"	agenda_empresa int(11) DEFAULT NULL,  ");
graba($file,"	agenda_salonId int(11) DEFAULT NULL COMMENT 'SALON', "); 
graba($file,"	agenda_Descripcion varchar(500) DEFAULT NULL,  ");
graba($file,"	agenda_comiteId int(11) DEFAULT NULL COMMENT 'COMITE', "); 
graba($file,"	agenda_fechaDesde datetime DEFAULT NULL COMMENT 'FCH_DESDE',  ");
graba($file,"	agenda_fechaHasta datetime DEFAULT NULL COMMENT 'FCH_HASTA',  ");
graba($file,"	agenda_comiteAnteriorId int(11) DEFAULT NULL COMMENT 'COMITE_ANTERIOR', "); 
graba($file,"	agenda_usuario int(11) DEFAULT NULL,   ");
graba($file,"    agenda_enFirme char(1) DEFAULT NULL,  ");
graba($file,"	agenda_conCitacion char(1) DEFAULT NULL,   ");
graba($file,"    agenda_acta int(11) DEFAULT NULL,  ");
graba($file,"	agenda_estado char(1) DEFAULT NULL,  ");
graba($file,"    agenda_causal varchar(100) DEFAULT NULL, "); 
graba($file,"	agenda_ProxCitacion varchar(45) DEFAULT NULL, "); 
graba($file,"	PRIMARY KEY (agenda_id), ");
graba($file,"	INDEX agendaComites_idx (agenda_comiteId ASC) , ");
graba($file,"   INDEX agendaSalones_idx (agenda_salonId ASC) , ");
graba($file,"	CONSTRAINT agendaComite ");
graba($file,"		   FOREIGN KEY (agenda_comiteId) ");
graba($file,"		   REFERENCES mm_comites (comite_id) ");
graba($file,"		   ON DELETE RESTRICT ");
graba($file,"		   ON UPDATE RESTRICT, ");
graba($file,"    CONSTRAINT  agendaSalones ");
graba($file,"		   FOREIGN KEY (agenda_salonId) ");
graba($file,"		   REFERENCES mm_salones (salon_id) ");
graba($file,"		   ON DELETE RESTRICT ");
graba($file,"		   ON UPDATE RESTRICT) ");
graba($file,"           ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Ocupacion de los salones'; ");
graba($file,"	 ");
graba($file,"   SELECT 'Tabla mm_agendamiento creada'; ");
graba($file,"    ");
 
       
                fclose($file);
      

                             


                 echo '          
                        <a href="documentation/PresentacionMM.pdf" class="btn btn-primary btn-block btn-flat"> 
                        Ver Folleto empresarial</a>

                        <a href="documentation/instalacion.pdf" class="btn btn-primary btn-block btn-flat"> 
                        Ver manual instalaciòn</a>
                    ';           
 //           }
            
           // $err = 'Esta Instalación ya fue efectuada ' ;
     
        }
 
//        else { 
//            mysqli_set_charset($mysqli,"utf8");   
//            }
            
//    echo $err;  
//    error_reporting(E_ALL);
//    } 

function grabar($ar,$ln){
    str_replace('|','"',$ln);
    fputs($ar,$ln);
    fputs($ar,"\n");
}

function funde($txt){
    $n= strlen($txt);
    $ret='';
    for ($i=0;$i<=$n;$i++)
    {
        $ret.= substr($txt,$n - $i,1);
    }
    return $ret;
}
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $sql = "SELECT  MAX(id) as id 
                    FROM mm_instala"; 
        $result = mysqli_query($con, $sql); 
            while($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
                $id +=1;
           } 
        echo $id; 
        return $id; 
        } 
 
    function unRegistro($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id = $data->id;      
        $sql = "SELECT  id, servidor, basedatos, usuario, password, estado  " . 
                    " FROM mm_instala  WHERE id = " . $id  . 
                    " ORDER BY servidor "; 
        $result = mysqli_query($con, $sql); 
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $arr[] = $row;
           } 
        } 
        echo $json_info = json_encode($arr); 
 
    } 
 
 function graba($ar,$ln){
    str_replace('|','"',$ln);
    fputs($ar,$ln);
    fputs($ar,"\n");
}	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Nov 04, 2018 12:51:53   <<<<<<< 
