<?php
/*
 * Metdos para la administracion de la tabla de inmuebles
 * @author aortiz
 */
include_once("conexion.class.php");
$objClase=new DBManager;
 
class contafactura {
var $con;
 
function contafactura(){
   $this->con=new DBManager;
}
 
function numeroFactura($empresa)
    {
        $respuesta='';
        $objClase=new DBManager;
        if($objClase->conectar()==true){
            $sql = "SELECT ifnull(max(factdefnro),0) AS nro , empresaRegimen, empresaporcentajeiva " .
                " FROM contafactdef  INNER JOIN contaempresas ON factdefempresa = empresaId ".
                " WHERE factdefempresa = " .$empresa;
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
            {
                $respuesta = $row['nro'].'||'. $row['empresaRegimen'].'||'. $row['empresaporcentajeiva'];
            }
           return $respuesta;
        }
    }
    
function traeTercero($empresa, $tercero)
{
    $resultado='';
        $objClase=new DBManager;
        if($objClase->conectar()==true){
            $sql = "SELECT convert(terceroNombre using utf8) as  terceroNombre, terceroIdenNumero, terceroDireccion, ".
                    "terceroTelefonos, terceroCorreo, terceroRegimen, ".
                    "terceroContribuyente, terceroIdenTipo FROM contaterceros WHERE terceroEmpresaId = ". $empresa . " AND  terceroId = " .$tercero;
          //  echo $sql;
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
            {
                $resultado =  $row['terceroNombre'] .'||'. $row['terceroIdenNumero'] .'||'. $row['terceroDireccion'] .'||'. 
                $row['terceroTelefonos'] .'||'. $row['terceroCorreo'] .'||'. $row['terceroRegimen'] .'||'. 
                $row['terceroContribuyente'].'||'. $row['terceroIdenTipo'];
            }
           return $resultado;
        }   
}

function grabaFactura($registro)
{
    $resultado='';
    $objClase=new DBManager;
    if($objClase->conectar()==true)
    {
        $nro = 0;
        $id=$registro["id"];
        $idNew=0;
        if($id==0)
        {
            $sql = 'SELECT COUNT(factdefnro) AS nro FROM contafactdef ' .
            ' WHERE factdefempresa = ' . $registro["empresa"] . ' AND factdefnro = ' . $registro["factNro"]; 
          
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result))
            {
                $nro = $row['nro'];
            }
            
            if($nro > 0){
                $sql = 'SELECT factdefid AS id FROM contafactdef '.
                ' WHERE factdefempresa = ' . $registro["empresa"] . ' AND factdefnro = ' . $registro["factNro"] .
                '  LIMIT 1 ';
                $result = mysql_query($sql);
                while($row = mysql_fetch_array($result))
                {
                    $nro = $row['id'];
                }
                $id=$nro;
            }
        }
        if($id==0){
            $sql = 'INSERT INTO contafactdef(factdefempresa,factdefnro,factdefcliente,factdeffechcrea,factdeffechvence,factdefvalor,factdefiva,' .
                    'factdefsaldo,factdefneto, factdefcontabiliza )'.
                   'VALUES ("'. $registro["empresa"] . '","'. $registro["factNro"] . '","'. $registro["tercero"] . '","'.
                    $registro["facFecha"] . '","'.$registro["facFechaV"] . '","'.
                    $registro["factmvtvalor"] . '","'.$registro["factmvtivavalor"] . '","'.$registro["factmvtneto"] .
                    '","'.$registro["factmvtneto"]  . '","N")';
                    $result = mysql_query($sql); 
                   
            $sql = 'SELECT LAST_INSERT_ID() as id';
            $result = mysql_query($sql); 
            while($row = mysql_fetch_array($result))
                {
                    $id = $row['id'];
                }
            $sql= 'INSERT INTO contafactserviciomvt(factmvtfacdef,factmvtdetalle,factmvtvalor,factmvtivaporc,factmvtivavalor)'. 
               'VALUES ("'. $id . '","'. $registro["factmvtdetalle"] . '","'. $registro["factmvtvalor"] . '","'.
                    $registro["factmvtivaporc"] . '","'.$registro["factmvtivavalor"] .  '")';
            $result = mysql_query($sql); 
       // echo '  1.==>  '. $sql; 
        }
        else 
        {
            $sql = "UPDATE contafactdef SET factdefcliente = ". $registro["tercero"] . ", " .
                    ' factdefcliente = "' . $registro["tercero"] . '", ' .
                    ' factdeffechcrea ="' .  $registro["facFecha"] . '", ' .
                    ' factdeffechvence ="' .$registro["facFechaV"]  . '", ' .
                    ' factdefvalor ="' .  $registro["factmvtvalor"] . '", ' .
                    ' factdefiva ="' .$registro["factmvtivavalor"] . '", ' .
                    ' factdefneto ="' . $registro["factmvtneto"] . '", ' .
                    ' factdefsaldo ="' . $registro["factmvtneto"] . '" ' .
                    ' WHERE factdefempresa = ' . $registro["empresa"] . ' AND factdefnro = ' . $registro["factNro"] .
                    ' AND factdefid > 0';
            $result = mysql_query($sql); 
       //     echo '  2.==>  '. $sql; 
            $sql= 'UPDATE contafactserviciomvt SET factmvtdetalle = "' .$registro["factmvtdetalle"] . 
                    '", factmvtvalor = "' . $registro["factmvtvalor"] . 
                    '", factmvtivaporc = "' . $registro["factmvtivaporc"] . 
                    '", factmvtivavalor = "' . $registro["factmvtivavalor"] . 
                    '" WHERE factmvtid  > 0 AND  factmvtfacdef = (SELECT factdefid FROM contafactdef '.
                    ' WHERE factdefempresa = ' . $registro["empresa"] . 
                    ' AND factdefnro = ' . $registro["factNro"] . ')'; 
               $result = mysql_query($sql); 
        }           
        
        $sql='UPDATE contaterceros SET 
        terceroIdenTipo = "' . $registro["factTipo"] . '",
        terceroIdenNumero = "' . $registro["factNit"] . '",
        terceroDireccion = "' . $registro["factDireccion"] . '",
        terceroTelefonos = "' . $registro["factTelefono"] . '",
        terceroCorreo = "' . $registro["factEmail"] . '",
        terceroRegimen = "C", terceroContribuyente = "' . $registro["factretenedor"] . '" 
        WHERE terceroId = '. $registro["tercero"] . ' AND terceroEmpresaId = '. $registro["empresa"];
      
        $result = mysql_query($sql);   
        
        $resultado = ' Actualiza factura '. $registro["factNro"] ;
    }
    return $resultado;
       
}

function recuperaFactura($empresa,$nro,$cond)
{        
    $resultado='';
    $objClase=new DBManager;
    if($objClase->conectar()==true)
        {                
        $sql='SELECT factdefempresa,factdefnro,factdefcliente,factdeffechcrea,factdeffechvence, factmvtdetalle, '. 
            'factdefvalor,factmvtivaporc, factdefiva,factdefsaldo,factdefneto, factdefcontabiliza, '.
            'empresaRegimen, empresaporcentajeiva '.
            ' FROM contafactdef INNER JOIN contafactserviciomvt ON factdefid = factmvtfacdef '.
            ' INNER JOIN contaempresas ON factdefempresa = empresaId '.
            ' WHERE factdefnro = ' . $nro . ' AND factdefempresa = ' .$empresa;
        $result = mysql_query($sql);
        if ($cond==0){return $result;}
        else
        {
            while($row = mysql_fetch_array($result))
            {
                $resultado =  $row['factdefempresa'] .'||'. $row['factdefnro'] .'||'. $row['factdefcliente'] .'||'. 
                $row['factdeffechcrea'] .'||'. $row['factdeffechvence'] .'||'. $row['factmvtdetalle'] .'||'. $row['factdefvalor'].'||'. 
                $row['factmvtivaporc'] . '||'. $row['factdefiva'] .'||'. $row['factdefsaldo'] .'||'. 
                $row['factdefneto'] .'||'. $row['factdefcontabiliza'] .'||'. $row['empresaRegimen']  .'||'. 
                $row['empresaporcentajeiva'];
            }
           return $resultado; 
        }
        }
    }
    
 
function num2letras($numero, $fem = false, $dec = true) { 
    
    // Primero tomamos el numero y le quitamos los caracteres especiales y extras 
    // Dejando solamente el punto "." que separa los decimales 
    // Si encuentra mas de un punto, devuelve error. 
    // NOTA: Para los paises en que el punto y la coma se usan de forma 
    // inversa, solo hay que cambiar la coma por punto en el array de "extras" 
    // y el punto por coma en el explode de $partes 
     
    $extras= array("/[\$]/","/ /","/,/","/-/"); 
    $limpio=preg_replace($extras,"",$numero); 
    $partes=explode(".",$limpio); 
    if (count($partes)>2) { 
        return "Error, el n&uacute;mero no es correcto"; 
        exit(); 
    } 
     
    // Ahora explotamos la parte del numero en elementos de un array que 
    // llamaremos $digitos, y contamos los grupos de tres digitos 
    // resultantes 
     
    $digitos_piezas=chunk_split ($partes[0],1,"#"); 
    $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1); 
    $digitos=explode("#",$digitos_piezas); 
    $todos=count($digitos); 
    $grupos=ceil (count($digitos)/3); 
     
    // comenzamos a dar formato a cada grupo 
     
    $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve'); 
    $decenas = array ('diez','once','doce', 'trece','catorce','quince'); 
    $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa'); 
    $centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos'); 
    $resto=$todos; 
     
    for ($i=1; $i<=$grupos; $i++) { 
         
        // Hacemos el grupo 
        if ($resto>=3) { 
            $corte=3; } else { 
            $corte=$resto; 
        } 
            $offset=(($i*3)-3)+$corte; 
            $offset=$offset*(-1); 
         
        // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB 
         
        $num=implode("",array_slice ($digitos,$offset,$corte)); 
        $resultado[$i] = ""; 
        $cen = (int) ($num / 100);              //Cifra de las centenas 
        $doble = $num - ($cen*100);             //Cifras de las decenas y unidades 
        $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas 
        $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades 
        if ($cen > 0) { 
           if ($num == 100) $resultado[$i] = "cien"; 
           else $resultado[$i] = $centena[$cen-1].' '; 
        }//end if 
        if ($doble>0) { 
           if ($doble == 20) { 
              $resultado[$i] .= " veinte"; 
           }elseif (($doble < 16) and ($doble>9)) { 
              $resultado[$i] .= $decenas[$doble-10]; 
           }else { 
              $resultado[$i] .=' '. $decena[$dec-1]; 
           }//end if 
           if ($dec>2 and $uni<>0) $resultado[$i] .=' y '; 
           if (($uni>0) and ($doble>15) or ($dec==0)) { 
              if ($i==1 && $uni == 1) $resultado[$i].="uno"; 
              elseif ($i==2 && $num == 1) $resultado[$i].=""; 
              else $resultado[$i].=$unidad[$uni-1]; 
           } 
        } 

        // Le agregamos la terminacion del grupo 
        switch ($i) { 
            case 2: 
            $resultado[$i].= ($resultado[$i]=="") ? "" : " mil "; 
            break; 
            case 3: 
            $resultado[$i].= ($num==1) ? " mill&oacute;n " : " millones "; 
            break; 
        } 
        $resto-=$corte; 
    } 
     
    // Sacamos el resultado (primero invertimos el array) 
    $resultado_inv= array_reverse($resultado, TRUE); 
    $final=""; 
    foreach ($resultado_inv as $parte){ 
        $final.=$parte; 
    } 
    $final = 'SON: ' .$final . ' pesos  m/cte.';
    return $final; 
} 

//condicion = empresa + '||'+periodo + '||'+consecutivo + '||'+comprobante+'||'+DescDias+'||'+fchini+'||'+fchfin;
function facturar($Codempresa, $periodoFac, $nroFactura,  $comprobante, $DescDias, $fchfactini, $fchfactfin){
    $ano=  substr($periodoFac,0,4);
    $mes=  substr($periodoFac,4,2);
    $mes +=1;
    if ($mes > 12){$mes=01;$ano+=1;}
    if ($mes <10){$nuevoPeriodo = $ano.'0'.$mes;}else{$nuevoPeriodo = $ano.$mes;}
   
    include_once("conexion.class.php");
    $objClase=new DBManager;
    include_once("class.administracion.php");
    $objetosAdmin=new administracion();
    // Borra la Facturacion del Periodo y su contabilizacion
    $resultado = $this->borraFacturacion($periodoFac, $Codempresa, $comprobante);
    if ($resultado == ''){
    // recupera datos generales
        $fechaControl = $objClase->  sumaDias_fecha($fchfactini, $DescDias);
       // echo $fechaControl;
        include_once 'clscontaservicios.php';
        $objServ = new contaservicios();
        

        $condicion = 'ServicioActivo = "A" AND  servicioEmpresaId = ' . $Codempresa .
                     ' AND "' . $fchfactfin .'" <= ServicioFechaHasta '.
                     ' AND "' . $fchfactini .'" >= ServicioFechaDesde '; 

        // proceso los servicios generales a todos los inmuebles
        $inmuebleCodigo = '';
        $inmuebleId=0;
        $facturar = $this->recupera_facturacion($condicion);
        $masFactura = 0;
        $nr=0;
        while( $registro = mysql_fetch_array($facturar) )           
        {  
            $codigo = $registro['ServicioId'];
            $detalle = $registro['ServicioDetalle'];
            $valor = $registro['ServicioValor'];
            $tipo = $registro['ServicioTipo'];
            $prioridad = $registro['ServicioPrioridad'];
            $clasificacion = $registro['servicioClasificacionId'];
            $descuentoDesc=0;
            $inmuebleCodigo = $registro['inmuebleCodigo'];
            $inmuebleIdAux = $registro['inmuebleId'];
            $condicion = "inmuebleEmpresaId = ". $Codempresa ;

            if ($inmuebleId != $inmuebleIdAux){
                $nroFactura = $nroFactura + 1;
                $inmuebleId = $inmuebleIdAux;
                $masFactura = 0;
            }
            $factura = array( 'facturaid'=>0, 'facturaEmpresaid'=>0, 'facturaNumero'=>0, 'facturaInmuebleid'=>0, 
            'facturaservicioid'=>0,'facturaperiodo'=>"", 'facturasecuencia'=>0, 'facturavalor'=>0.0, 
            'facturadetalle'=>"", 'facturafechafac'=>"", 'facturafechavence'=>"", 'facturafechacontrol'=>"", 
            'facturasaldo'=>0.0, 'facturaprioridad'=>0,  'facturadescuento'=>0.0, 'facturaNroReciboPago'=>0, 
            'facturaMora'=>0.0,'facturaTipo'=>'F');
            $factura['facturaid']=0;
            $factura['facturaEmpresaid']=$Codempresa; 
            $factura['facturaNumero']=$nroFactura;
            $factura['facturaInmuebleid']=$inmuebleId;
            $factura['facturaservicioid']=$codigo;
            $factura['facturaperiodo']=$periodoFac;
            $factura['facturasecuencia']=0;
            $factura['facturavalor']=$valor;
            $factura['facturadetalle']=$detalle;
            $factura['facturafechafac']=$fchfactini;  
            $factura['facturafechavence']=$fchfactfin;  
            $factura['facturafechacontrol']=$fechaControl;
            $factura['facturasaldo']=$valor;  
            $factura['facturaprioridad']=$prioridad;   
            $factura['facturadescuento']=0;
            $factura['facturaNroReciboPago']=0; 
            $factura['facturaMora']=0.0;  
            $factura['facturaTipo']='F';  
            $this->grabaFacturacion($factura); 
            if  ($masFactura == 0)
            {
                $condicion = ' InmuebleServicioServicioId =  ServicioId AND InmuebleServicioSaldo > 0 '.
               ' AND "' . $fchfactini .'" >= InmuebleServicioFechaInicio AND '.
               'InmuebleServicioInmuebleId = ' . $inmuebleId . ' AND '.
               'InmuebleServicioActivo = "A" AND InmuebleServicioEmpresaId = ' .$Codempresa;              
                $result = $objServ-> recuperaServiciosInmueble($condicion);
                while( $regis1 = mysql_fetch_array($result) )           
                { 
                    $valor = $regis1['InmuebleServicioCuota'];
                    if ($valor > $regis1['InmuebleServicioSaldo'] ){$valor = $regis1['InmuebleServicioSaldo'];}
                    $factura['facturaid']=0;
                    $factura['facturaEmpresaid']=$Codempresa; 
                    $factura['facturaNumero']=$nroFactura;
                    $factura['facturaInmuebleid']=$inmuebleId;
                    $factura['facturaservicioid']=$regis1['InmuebleServicioServicioId'];
                    $factura['facturaperiodo']=$periodoFac;
                    $factura['facturasecuencia']=0;
                    $factura['facturavalor']=$valor;
                    $factura['facturadetalle']=$regis1['ServicioDetalle'];
                    $factura['facturafechafac']=$fchfactini;  
                    $factura['facturafechavence']=$fchfactfin;  
                    $factura['facturafechacontrol']=$fechaControl;
                    $factura['facturasaldo']=$valor;  
                    $factura['facturaprioridad']=$prioridad;   
                    $factura['facturadescuento']=0;
                    $factura['facturaNroReciboPago']=0; 
                    $factura['facturaMora']=0.0; 
                    $factura['facturaTipo']='F';  
                    $this->grabaFacturacion($factura);  
                }
                $masFactura=1;
                 $nr+=1;
            }
        }
        $this->ActualizaNumeroFactura($Codempresa, $nroFactura, $periodoFac, $nuevoPeriodo );
        $msg="Actuaizó ".$nr." Facturas";
    }
    else
        {
            $msg="Err. No Factura, en el periodo hay movimiento de pagos o notas DB/CR";
        }
        echo $msg;
        return $msg;    
}

  function ActualizaNumeroFactura($empresa, $factura, $periodoFac, $nuevoPeriodo){ 
     if($this->con->conectar()==true){
       $sql = "UPDATE contaempresas SET  empresaConsecFactura = ".$factura.   
              ", empresaPeriodoFactura = '" . $nuevoPeriodo . "' , empresaPeriCierreFactura = '". $periodoFac .
        "' WHERE empresaId = ".$empresa; 
        $result = mysql_query($sql);
     }
 }  
 
        function borraFacturacion($periodo, $Codempresa, $comprobante){
            if($this->con->conectar()==true){
                $resultado="";
                $sql="SELECT count(*) as nroRec FROM contafactura ".
                     " WHERE facturaEmpresaid=".$Codempresa." AND facturaperiodo = '".$periodo."' AND facturaTipo IN ('P','C','D') ";
//  echo $sql;
                 $result = mysql_query($sql);
                while ($row = mysql_fetch_array($result)) {
                    $nroRec=$row['nroRec'];            
                } 
                if ($nroRec==0){
                    $sql = 'SET SQL_SAFE_UPDATES=0; ';
                    $result = mysql_query($sql);
                    $sql = 'DELETE FROM contafactura WHERE FacturaPeriodo = "' . $periodo . '" AND  facturaEmpresaid = ' . $Codempresa ;
                    $result = mysql_query($sql);
                    $sql = 'DELETE FROM contamovidetalle WHERE moviConCabezaId IN (SELECT movicaId FROM contamovicabeza WHERE movicaEmpresaId= ' .
                            $Codempresa . ' AND movicaComprId = "'. $comprobante. '" AND movicaPeriodo = "'.$periodo . '" ) ;';
                    $sql = $sql. 'DELETE FROM contamovicabeza WHERE movicaEmpresaId= ' . $Codempresa . ' AND movicaComprId = "'. $comprobante. 
                            '" AND movicaPeriodo = "'.$periodo . '" ';
                   $result = mysql_query($sql);
                      $sql = 'SET SQL_SAFE_UPDATES=1; ';
                    $result = mysql_query($sql);
                  
               }
               else
               {
                   $resultado="NO Se liquida porque el periodo ya tiene movimiento de pagos o de ajustes";
               }
                return $resultado;
            }
        } 
 
    function recupera_facturacion($condicion){ 
   if($this->con->conectar()==true){   
        $sql = "SELECT ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, ".
                "ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ".
                "ServicioMora, ServicioMoraPorcentaje, servicioMoraValor,ServicioCuentaDB, ".
                "ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioAmbito, 'Todos'".
                "clasificacionDetalle, 0 servicioClasificacionId, ServicioActivo, inmuebleId, ".
                "inmuebleEmpresaId,inmuebleCodigo,inmuebleClasificacionId ". 
                "FROM contaservicios,  containmuebles WHERE servicioAmbito = 'T' AND ".
                "inmuebleEmpresaId = servicioEmpresaId AND ".
                "((servicioAmbito = 'T' and servicioClasificacionId = 0 ) OR ".
                " (servicioAmbito = 'T' and inmuebleClasificacionId = servicioClasificacionId  )) AND " .
                $condicion .   
                "UNION ".
                "SELECT ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, ".
                "ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ".
                "ServicioMora, ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, ".
                "ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioAmbito, ".
                "clasificacionDetalle, servicioClasificacionId, ServicioActivo, inmuebleId, ".
                "inmuebleEmpresaId,inmuebleCodigo,inmuebleClasificacionId ".
                "FROM contaservicios, contaclasificacion, containmuebles ".
                "WHERE servicioEmpresaId = clasificacionEmpresaId AND ".
                "servicioClasificacionId = clasificacionId AND servicioAmbito = 'G'  AND  ".
                "inmuebleEmpresaId = servicioEmpresaId AND inmuebleClasificacionId = servicioClasificacionId AND " .
                $condicion .  
                " ORDER BY inmuebleCodigo, ServicioCodigo ";   
   
      $result = mysql_query($sql);
      return $result;
   }
}        
  
        function grabaFacturacion($factura){
            if($this->con->conectar()==true){            
                $sql = 'INSERT INTO contafactura (facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, 
                    facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, 
                    facturasaldo, facturaprioridad,  facturadescuento, facturaNroReciboPago, facturaMora, facturaTipo) '.
                'VALUE (' .  $factura['facturaEmpresaid'] . ',"' .  $factura['facturaNumero'] . '",' .
                $factura['facturaInmuebleid'] . ',' .  $factura['facturaservicioid'] . ',"' .  $factura['facturaperiodo'] . '",' .
                $factura['facturasecuencia'] . ',' .  $factura['facturavalor'] . ',"' .  $factura['facturadetalle'] . '","' .
                $factura['facturafechafac'] . '","' .  $factura['facturafechavence'] . '","' .
                $factura['facturafechacontrol'] . '",' .  $factura['facturasaldo'] . ',' .  
                $factura['facturaprioridad'] . ',' .  $factura['facturadescuento'] . ',' .
                $factura['facturaNroReciboPago'] . ',' .  $factura['facturaMora'] . ',"F")' ;                 
                $result = mysql_query($sql);
                return $result;                
            }
        }




}
