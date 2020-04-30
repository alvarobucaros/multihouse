<?php

class opcCargaData {

function importaDatos($empresa, $file, $data){
        $empresa = trim($empresa);
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
    
        $array =  explode(';',  $data);
        $retorno='Importacion Correcta';
        $respuesta=" proceso ";
        $j=0;
        $n=0;
        $sql="";
        $array[2] = str_replace(",",".",$array[2]);
        $array[3] = str_replace(",",".",$array[3]);
        $inmueble_id=0;
        $inmueble_empresa=$empresa;
        $inmueble_codigo=$array[0];
        $inmueble_descripcion=$array[1];
        $inmueble_area=$array[2];
        $inmueble_coeficiente=floatval($array[3]);
        $inmueble_tipo = $array[4];
        $inmueble_principal = $array[5];
        $inmueble_depende = $array[6];
        $inmueble_ubicacion=$array[7];
        $inmueble_propNombre= $array[8]; // utf8_decode($array[5]);
        $inmueble_propCedula=$array[9];
        $inmueble_propTelefonos=$array[10];
        $inmueble_propDireccion=$array[11];
        $inmueble_propCorreo=$array[12];
        
        $inmueble_Activo='A';
        $inmueble_comite=0;
        $inmueble_prinipal='';
       
 // clasificacion       
        $nro=0;
        $query = "SELECT count(clasificacionId) as nro FROM contaclasificacion WHERE " .
                " clasificacionCodigo = '" . $inmueble_tipo . "' AND clasificacionEmpresaId = '" . $empresa ."' ";
        $resultado =  mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($resultado)) { 
            $nro = $row['nro'];
        } 

        $inmuebleCodigo=0;
        if ($nro > 0){
            $query = "SELECT clasificacionId  FROM contaclasificacion WHERE " .
            " clasificacionCodigo = '" . $inmueble_tipo . "' AND clasificacionEmpresaId = '" . $empresa ."' ";
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $inmuebleCodigo = $row['clasificacionId'];
            } 
        }
         
        if($inmuebleCodigo === 0){
             $query = "INSERT INTO contaclasificacion (clasificacionEmpresaId, clasificacionCodigo, clasificacionDetalle) ".
                     " VALUES ( '". $empresa ."', '" . $inmueble_tipo ."', '" . $inmueble_tipo ."') ";        
            $resultado =  mysqli_query($con, $query);

            $query = "SELECT LAST_INSERT_ID() as Id";
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $inmuebleCodigo = $row['Id'];
            }  
        }
        
// Inmuebles        
        $inmuebleId = 0;
        $query = "SELECT inmuebleId FROM containmuebles WHERE inmuebleCodigo = '" . $inmueble_codigo .
                "' AND inmuebleEmpresaId = '" . $empresa ."' ";
        $resultado =  mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($resultado)) { 
            $inmuebleId = $row['inmuebleId'];
        } 

        if ($inmuebleId > 0) {      
            $query="UPDATE containmuebles SET inmuebleCodigo = '".$inmueble_codigo ."', ".
            "inmuebleDescripcion = '" . $inmueble_descripcion . "', inmuebleArea = '".
            $inmueble_area . "', inmuebleCoeficiente =  '". $inmueble_coeficiente .
            "', inmuebleUbicacion = '" .$inmueble_ubicacion . "', inmuebleClasificacionId = '" .
            $inmuebleCodigo . "', inmueblePrincipal = '" . $inmueble_principal."'," .
            " inmuebleDepende = '" . $inmueble_depende . "' " .  
            "  WHERE inmuebleEmpresaId = '" . $inmueble_empresa. "' AND inmuebleCodigo = '". 
            $inmueble_codigo . "' ";
            $resultado =  mysqli_query($con, $query);
        }
        else{
        $query=" INSERT INTO containmuebles (inmuebleEmpresaId, inmuebleCodigo, inmuebleDescripcion, " .
                " inmueblePrincipal, inmuebleArea, inmuebleCoeficiente, inmuebleUbicacion, " .
                " inmuebleClasificacionId, inmuebleDepende) VALUES ('" .
                $inmueble_empresa . "','" . $inmueble_codigo  . "','" .
                $inmueble_descripcion. "','".$inmueble_principal."','" .
                $inmueble_area . "','" . $inmueble_coeficiente . "','" . $inmueble_ubicacion . "','" .
                $inmuebleCodigo . "','" . $inmueble_depende . "')"; 
                $resultado =  mysqli_query($con, $query);
                $query = "SELECT LAST_INSERT_ID() as Id";
                $resultado =  mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($resultado)) { 
                    $inmuebleId = $row['Id'];
                }
        }
       

// propietarios             
        $query=" SELECT count(propietarioId) AS nro  FROM  contapropietarios " .
               " WHERE propietarioEmpresaId = '" . $inmueble_empresa . "' AND propietarioCedula  = '"
            . $inmueble_propCedula . "' ";
        $resultado =  mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($resultado)) { 
            $nro = $row['nro'];
        } 

        if ($nro > 0) {
            $query=" SELECT propietarioId AS propietarioId  FROM  contapropietarios " .
             " WHERE propietarioEmpresaId = '" . $inmueble_empresa . "' AND propietarioCedula  = '"
            . $inmueble_propCedula . "' ";
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $propietarioId = $row['propietarioId'];
            }
            $query=" UPDATE contapropietarios SET propietarioNombre = '" . $inmueble_propNombre .
                     "', propietarioTelefonos = '" . $inmueble_propTelefonos .
                      "', propietarioDireccion = '" . $inmueble_propDireccion .
                      "', propietarioCorreo = '" . $inmueble_propCorreo .
                    " WHERE propietarioEmpresaId = '" . $inmueble_empresa . "' AND propietarioCedula  = '"
                . $inmueble_propCedula . "' ";
             $resultado =  mysqli_query($con, $query);
        }else
        {
            $query=" INSERT INTO contapropietarios(propietarioEmpresaId, propietarioNombre, propietarioCedula, " .
                  " propietarioTelefonos, propietarioDireccion, propietarioCorreo, propietarioActivo) VALUES ('".
                  $inmueble_empresa . "','". $inmueble_propNombre . "','". $inmueble_propCedula .
                  "','". $inmueble_propTelefonos . "','". $inmueble_propDireccion . 
                  "','". $inmueble_propCorreo . "','S') "; 
            $resultado =  mysqli_query($con, $query);
            $query = "SELECT LAST_INSERT_ID() as Id";
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $propietarioId = $row['Id'];
            }
        } 
        
// propietarios e inmuebles        
        $query="SELECT count(contaInmuPropietarioId) AS nro FROM containmueblepropietario WHERE " .
               " contaInmuPropietarioEmpresaId = " . $empresa . " AND " .
               " contaInmuPropietarioInmuebleId = " . $inmuebleId . " AND " .
               " contaInmuPropietarioPropietarioId = " . $propietarioId ;
        $resultado =  mysqli_query($con, $query);     
        while($row = mysqli_fetch_assoc($resultado)) { 
            $nro = $row['nro'];
        }
        
        if ($nro > 0){
        }
        else{
             $query="INSERT INTO containmueblepropietario (contaInmuPropietarioEmpresaId, ".
                     " contaInmuPropietarioInmuebleId, contaInmuPropietarioPropietarioId) VALUES ('".
                     $empresa . "', '" .$inmuebleId ."', '" .$propietarioId ."') ";
             $resultado =  mysqli_query($con, $query);
        }
 
                
        return $retorno;
    }

    function importaPagos($empresa, $file, $data){
        $empresa = trim($empresa);
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        
        $array =  explode(';',  $data);
        $retorno='Importacion Correcta';
        $respuesta=" proceso ";
        $cedula = $array[0];
        $inmueble = $array[1];
        $fecha = substr($array[2],6,4).'-'.substr($array[2],3,2).'-'.substr($array[2],0,2);  // dd/mm/aaaa  2019-10-05
        $pago = $array[3];
        $detalle = $array[4];
        $inmuebleId=0;
        $propietarioId = 0;
        $query = "SELECT propietarioId FROM contapropietarios WHERE propietarioEmpresaId = ".
            $empresa . " AND propietarioCedula = '" . $cedula . "'";
        $result =  mysqli_query($con, $query);
        while($reg = mysqli_fetch_assoc($result)) 
            {
                 $propietarioId =  $reg['propietarioId']; 
            } 
        $query= "SELECT  IFNULL(count(*), 0) as inmuebleId FROM containmuebles WHERE inmuebleCodigo = '".
             trim($inmueble) ."' ";        
        $result =  mysqli_query($con, $query);
        while($reg = mysqli_fetch_assoc($result)) 
            {
                 $inmuebleId =  $reg['inmuebleId']; 
            } 
        if (intval($inmuebleId) === 1){
            $query= "SELECT  inmuebleId  FROM containmuebles WHERE inmuebleCodigo = '". trim($inmueble) ."' ";        
            $result =  mysqli_query($con, $query);
            while($reg = mysqli_fetch_assoc($result)) 
                {
                     $inmuebleId =  $reg['inmuebleId']; 
                }
        }
          
        $query="INSERT INTO contatmpagos (pagoempresa ,pagocedula  ,pagoinmueble ,pagofecha ," .
                " pagovalor ,pagoestado ,pagopropietarioid ,pagoinmuebleid , pagodetalle  ) VALUES ('".
                $empresa . "', '" .$cedula . "', '" .$inmuebleId ."', '" .$fecha ."', '" .
                $pago ."','P',". $propietarioId. ",".$inmuebleId.",'" .$detalle."')";
         $resultado =  mysqli_query($con, $query);
    }
    
 function importaSaldos ($empresa, $file, $data){
        $empresa = trim($empresa);
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
//Numero Doc	 Inmuebleid	 Cedula Propietario	 Servicio	 Periodo	 Fecha Factura	 Fecha Vence	 Saldo	 Detalle	 Tipo
//1	 AP101	19295811	Administracion Apartamentos tipo 1	201710	01/10/2017	30/10/2017	110000	Administración Apartamento	F

        $array =  explode(';',  $data);
        $retorno='Importacion Correcta';
        $respuesta=" proceso ";
        $numeroDoc = (int)$array[0];
        $n=strlen($numeroDoc);
        $numeroDoc=  substr('00000000000', 0, 10-$n).$numeroDoc;
        $inmueble = $array[1];
        $cedPropietario = $array[2];
        $servicio = $array[3];
        $periodo = $array[4];
        $fechaFac = substr($array[5],6,4).'-'.substr($array[5],3,2).'-'.substr($array[5],0,2); 
        $fechaVnc = substr($array[6],6,4).'-'.substr($array[6],3,2).'-'.substr($array[6],0,2); 
        $saldo = $array[7];
        $detalle = $array[8];
        $principal = $array[9];
        $inmuebleId=0;
        $propieId=0;

        $query= "SELECT count(*) as Nr FROM containmuebles WHERE inmuebleEmpresaId = " . $empresa . 
                " AND inmuebleCodigo = '". trim($inmueble) ."' ";        
        $resultado =  mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($resultado)) 
        {
             $nr =  $row['Nr']; 
        } 

        if (intval($nr) === 1){
            $query= "SELECT  inmuebleId, inmueblePrincipal, inmuebleDepende " .
                    " FROM containmuebles WHERE inmuebleEmpresaId = " . $empresa . 
                    " AND inmuebleCodigo = '". trim($inmueble) ."' ";
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $inmuebleId =  $row['inmuebleId'];
                $inmueblePrincipal = $row['inmueblePrincipal'];
                $inmuebleDepende = $row['inmuebleDepende'];
            }
        }

        if ($inmueblePrincipal='SI'){
            $query= "SELECT inmuebleId FROM containmuebles WHERE inmuebleEmpresaId = " . $empresa . 
                    " AND inmuebleCodigo = '". trim($inmuebleDepende) ."' ";
                        $resultado =  mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($resultado)) { 
                        $inmuebleId =  $row['inmuebleId'];
                    }
        }
        
        $query = "SELECT count(*) Nr FROM contapropietarios WHERE propietarioEmpresaId  =  " . $empresa . 
                "  AND  propietarioCedula = '".$cedPropietario."'";
        $resultado =  mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($resultado))   
        {
             $nr =  $row['Nr']; 
        }  
     
        if (intval($nr) === 1){
            $query = "SELECT propietarioId FROM contapropietarios WHERE propietarioEmpresaId  =  " . $empresa . 
                "  AND  propietarioCedula = '".$cedPropietario."'";
        
            $resultado =  mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($resultado))   
            {
                 $propieId =  $row['propietarioId']; 
            } 
        }
    
        $query = "SELECT count(*) Nr FROM contaservicios WHERE servicioEmpresaId = " . $empresa . 
                "  AND ServicioDetalle = '".$servicio."' ";
        $result =  mysqli_query($con, $query);
        while($reg = mysqli_fetch_assoc($result)) 
            {
                 $nr =  $reg['Nr']; 
            }  
        if (intval($nr) === 1){
            $query = "SELECT ServicioId FROM contaservicios WHERE servicioEmpresaId = " . $empresa . 
            "  AND ServicioDetalle = '".$servicio."' ";
            $result =  mysqli_query($con, $query);
            while($reg = mysqli_fetch_assoc($result)) 
                {
                     $ServicioId =  $reg['ServicioId']; 
                }            
        }else{
            $query = "INSERT INTO contaservicios (ServicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, " .
                     " ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ServicioMora,  " .
                     " ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, ServicioPPporcentaje,  " .
                     " ServicioPPvalor, ServicioActivo, ServicioAmbito, servicioClasificacionId) VALUES('".
                    $empresa . "', 'COD','". $servicio. "','0000','','',0,1,'C','S',0,0,'','',0,0,'A','T',0)";
            $result =  mysqli_query($con, $query);
          
            $query = "SELECT LAST_INSERT_ID() as id";
            $result =  mysqli_query($con, $query);
            while($reg = mysqli_fetch_assoc($result)) 
            {
                 $ServicioId =  $reg['id']; 
            }
        }
        
      
        $query="INSERT INTO contafactura (facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, ".
               " facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, ".
               " facturafechacontrol, facturasaldo, facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago, ".
               " facturaTipo,facturaPropietario,facturaDiasMora) VALUES ('".
                $empresa . "', '" .$numeroDoc . "', '" .$inmuebleId ."', '" .$ServicioId ."', '" . 
                $periodo ."', 1, " . $saldo . ", '" . $detalle . "', '" .$fechaFac. "', '" . $fechaVnc . "', '" .                
                $fechaVnc . "', " . $saldo . ",1,0,0,0,'F',". $propieId . ",0)";
         $resultado =  mysqli_query($con, $query);
    }
      

    function importaPUCC($empresa, $file, $data){
        $empresa = trim($empresa);
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
  
        $array =  explode(';',  $data);
        $retorno='Importacion Correcta';
        $respuesta=" proceso ";
        $cuenta = trim($array[0]);
        $nombre = trim($array[1]);
        $tipo = trim($array[2]);
        $clase = trim($array[3]);
        $l = strlen($cuenta);
        $mayor = '0';
        $nivel = 1;
        if ($l===2){
            $nivel = 2;
            $mayor = substr($cuenta,0,1);
        }
        if ($l===4){
            $nivel = 3;
            $mayor = substr($cuenta,0,2);
        }
        if ($l===6){
            $nivel = 4;
            $mayor = substr($cuenta,0,4);
        }        
        if ($l===8){
            $nivel = 5;
            $mayor = substr($cuenta,0,6);
        }
        
        $query="INSERT INTO contaplancontable(pucEmpresaId, pucCuenta, pucNombre, pucMayor, " .
                " pucNivel, pucTipo, pucActivo, pucClase, pucValor) VALUES ('".
        $empresa . "', '" .$cuenta . "', '" .$nombre ."', '" .$mayor ."', '" .
        $nivel ."','".$tipo."','A','". $clase. "',0)";
         $resultado =  mysqli_query($con, $query);
         echo $query;
    }
    
 function borraTablas($empresa){
    $empresa = trim($empresa);
    include_once("../bin/cls/clsConection.php");
    $objClase = new DBconexion(); 
    $con = $objClase->conectar();
    $retorno='';
    
    $query = "DELETE FROM containmueblepropietario WHERE  contaInmuPropietarioEmpresaId  = ".
            $empresa . " AND contaInmuPropietarioId > 0 ";
    $resultado =  mysqli_query($con, $query);

    $query = "DELETE FROM containmuebleservicios WHERE  InmuebleServicioEmpresaId  = ".
            $empresa . " AND  InmuebleServicioId > 0 ";
    $resultado =  mysqli_query($con, $query);

    $query = "DELETE FROM containmuebles WHERE  inmuebleEmpresaId  = ".
            $empresa . "  AND inmuebleId  > 0 ";
    $resultado =  mysqli_query($con, $query);

    $query = "DELETE FROM contapropietarios WHERE propietarioEmpresaId  = ".
            $empresa . "  AND  propietarioId > 0 ";        
    $resultado =  mysqli_query($con, $query);
   
    $query = "DELETE FROM contaclasificacion WHERE clasificacionEmpresaId  = ".
            $empresa . "  AND  clasificacionId > 0 ";        
    $resultado =  mysqli_query($con, $query);

    return $retorno;
 }
 
  function borraSaldos($empresa){
    $empresa = trim($empresa);
    include_once("../bin/cls/clsConection.php");
    $objClase = new DBconexion(); 
    $con = $objClase->conectar();
    $retorno='';
    $query = "DELETE FROM contaanticipos WHERE anticipoempresa  = ".
            $empresa . " AND  anticipoid > 0 ";
    $resultado =  mysqli_query($con, $query);

    $query = "DELETE FROM contafactura WHERE  facturaEmpresaid  = ".
            $empresa . " AND  facturaid > 0 ";
    $resultado =  mysqli_query($con, $query);

    $query = "DELETE FROM contapagos WHERE  pagosempresa  = ".
            $empresa . "  AND pagosid  > 0 ";
    $resultado =  mysqli_query($con, $query);

    return $retorno;
 }
 
   function borrapucc($empresa){
    $empresa = trim($empresa);
    include_once("../bin/cls/clsConection.php");
    $objClase = new DBconexion(); 
    $con = $objClase->conectar();
    $retorno='';
    $query = "DELETE FROM contaplancontable WHERE pucEmpresaId  = ". $empresa ;
    $resultado =  mysqli_query($con, $query);
    return $retorno;
 }
 
    function nroRegistros($sql){ 
// echo $sql;      
        $obj = new DBManager();
        $con = $obj->conectar();
        $retorno = Array('nro'=>0, 'id'=>0); 
        if($con==true){     
            $result =  mysql_query($sql);
            while( $reg = mysql_fetch_assoc($result) )
            {
                 $retorno['nro'] =  $reg['nr']; 
                 $retorno['id'] =  $reg['id'];
            }      
          return $retorno;
       }
    }  
  
    function grabar($sql){ 
        $result = 0;
   //     echo $sql;        
        $obj = new DBManager();
        $con = $obj->conectar();
        if($con==true){     
          $result =  mysql_query($sql);
        }
        $con = $obj->desConectar();
        return $result;
    } 

}   