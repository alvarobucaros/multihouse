<?php
session_start();

class reportesCls{

    public function cargaEmpresa($empresa){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	
        $obj = new reportesCls();

            $result = '';
            $sql="SELECT empresaId, empresaNombre, empresaNit, empresaDigito, empresaWeb, " .
                 " empresaDireccion ,empresaCiudad ,empresaTelefonos ,empresaLogo ," .
                 " empresaMensaje1, empresaMensaje2, empresaEmail, empresafacturaNota, " .
                 " empresaRecargoPorc, empresaRecargoPesos, empresaRecargoDias, empresaDescPorc,".
                 " empresaDescPesos, empresaFactorRedondeo, empresaPeriCierreFactura " .
                 " FROM contaempresas  WHERE  empresaId = ". $empresa ;
            $result =  mysqli_query($con, $sql);

 //             echo $result;
        return $result;   
            }

 
    public function preparaImpresionFactura($periodo, $empresa, $fecCorte, $empresaRecargoPorc, 
        $empresaRecargoPesos, $empresaRecargoDias, $empresaDescPorc, 
        $empresaDescPesos, $empresaFactorRedondeo,$inmueble){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	
        $resultado='';

        if($con==true){  

            $facRedondeo=$empresaFactorRedondeo;

            //  Borra descuentos y mora WHERE facturaservicioid = '201701' AND facturaEmpresaid = 7 AND facturasaldo <> 0 AND  facturaid= 7
            $sql= " UPDATE contafactura SET facturaMora = 0, facturaDescuento = 0, facturaDiasMora = 0 " .
                  " WHERE facturaEmpresaId = " . $empresa.
                  " AND facturasaldo <> 0  AND  facturaid > 0";
            if($inmueble > 0){
                $sql .= " AND facturaInmuebleid = " . $inmueble ;              
            }
            
            $result =  mysqli_query($con, $sql);
            // recupera informacion para liquidar
            $sql =  " SELECT facturaid, facturaNumero,  facturaInmuebleid, facturaservicioid, facturaperiodo, facturasecuencia, ".
                    " facturavalor, facturadetalle, facturafechafac, facturafechavence,  facturafechacontrol, facturasaldo, ".
                    " facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago, ServicioTipo, ServicioMora, ".
                    " ServicioMoraPorcentaje, servicioMoraValor,ServicioPPporcentaje, ServicioPPvalor ".
                    " FROM contafactura INNER JOIN contaservicios ON ServicioId = facturaservicioid ".
                    " WHERE  FacturaPeriodo <= '". $periodo . "'  AND FacturaEmpresaId = " . $empresa . 
                    " AND facturasaldo <> 0 AND ServicioTipo='C' AND facturaTipo <> 'M' ";
            if($inmueble > 0){
                $sql .= " AND facturaInmuebleid = " . $inmueble ;              
            }
                $sql .= " ORDER BY facturaInmuebleid ,facturaperiodo DESC, facturaservicioid ";

                $j=0;
                $result =  mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                   $hoy=$fecCorte;  
                   $facturaId =  $row['facturaid'];
                   $mora=0;
                   $descuento=0;
                   if(trim($row['ServicioMora'])=== 'S'){
                       $diasM=$this->dias_transcurridos($hoy,$row['facturafechavence']) ;
                       if ($diasM > 0){
                           $mora += $empresaRecargoPesos;
                           $mora += $row['facturasaldo'] * $empresaRecargoPorc * $diasM / 3600;
                           $mora = $this->redondeo($mora, $facRedondeo);
                           if ($mora==""){$mora=0;}
                       }                      
                   } 
                   $diasT=$this->dias_transcurridos($hoy,$row['facturafechacontrol']) ;
                   if ($diasT > 0){
                       $descuento = $row['facturasaldo'] * ($row['ServicioPPporcentaje'] )/ 100;
                       $descuento = $descuento + $row['ServicioPPvalor'] ;
                       $descuento =  $this->redondeo($descuento, $facRedondeo);
                       if ($descuento==""){$descuento=0;}
                   }                         
                    $sql='UPDATE contafactura SET FacturaDescuento = ' . $descuento .
                        ', FacturaMora = ' . $mora . ',  facturaDiasMora = ' . $diasM. 
                        ', facturaprioridad = '. $diasT . ' WHERE FacturaId = ' . $facturaId;                         
                    $resulta2 = mysqli_query($con, $sql);

            //    }
                  $j+=1;         
               }
         
           }
           return $resultado;
       }
 
    function preparaImpresionFacturaRep($periodo, $empresa, $inmueble){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	 
        $sql = "SELECT  IF (inmueblePrincipal = 'SI', inmuebleCodigo , inmuebleDepende) inmuebleCodigo, " .
               " facturaid, facturaNumero, facturaInmuebleid, facturaservicioid, facturaperiodo, facturasecuencia, ".
               " facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, ".
               " facturasaldo, facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago,  ".
               " ServicioTipo, ServicioMora, ServicioMoraPorcentaje, servicioMoraValor,ServicioPPporcentaje, ".
               " ServicioPPvalor, ServicioDetalle, inmuebleDescripcion, propietarioNombre  ".
               " FROM contafactura INNER JOIN contaservicios ON ServicioId = facturaservicioid  ".
               " INNER JOIN containmuebles ON facturaInmuebleid = inmuebleId  ".
               " INNER JOIN containmueblepropietario ON inmuebleId = contaInmuPropietarioInmuebleId ". 
               " INNER JOIN contapropietarios ON contaInmuPropietarioPropietarioId = propietarioId  ".
               " WHERE FacturaPeriodo <= " .$periodo ." AND FacturaEmpresaId =  ". $empresa .
               " AND facturasaldo > 0 AND facturaTipo <> 'M'  ";
            if($inmueble > 0){
                $sql .= " AND facturaInmuebleid = " . $inmueble ;              
            }
                $sql .= " ORDER BY inmuebleCodigo, facturaperiodo desc,  facturadetalle , facturaservicioid   ";
        $result = mysqli_query($con, $sql);
        return  $result;	   
     }

    function preparaImpresionUnaFactura($periodo, $empresa, $inmueble){
      include_once("clsConection.php");
      $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
      $con = $objClase->conectar();	 
      $sql = " SELECT facturaNumero, facturaperiodo, facturafechafac, facturafechavence, inmuebleId, " .
              " facturadetalle, facturasaldo, facturaDiasMora, inmuebleCodigo, inmuebleDescripcion " .
              " FROM contafactura " .
              " INNER JOIN containmuebles ON facturaInmuebleid = inmuebleId " .
              " WHERE facturaEmpresaid = ". $empresa . 
              " AND inmuebleEmpresaId = facturaEmpresaid ".
              " AND facturaperiodo <= " . $periodo ;
          if($inmueble > 0){
              $sql .= " AND facturaInmuebleid = " . $inmueble ;              
          }
              $sql .= " ORDER BY inmuebleCodigo, facturaperiodo desc,  facturadetalle , facturaservicioid   ";
      $result = mysqli_query($con, $sql);
      return  $result;	   
   }   

    function preparaReimpresionFactura($periodo, $empresa, $inmueble, $op, $propietario){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();
       
        $sql="SELECT facturaid, facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, ".
            " facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac,  ".
            " facturafechavence, facturafechacontrol, facturasaldo, facturaprioridad, facturadescuento,  ".
            " facturaMora,facturaNroReciboPago, facturaTipo, facturaPropietario, facturaDiasMora,  ".
            " facturaMoraInmuebId FROM contafactura  ".
            " WHERE facturasaldo > 0   AND facturaTipo IN ('F','T','C','D') AND facturaEmpresaid = " . $empresa ;
        if($op == 'N'){
            $sql.= " AND facturaInmuebleid = " . $inmueble;
        }
        $sql.= " ORDER BY facturaInmuebleid, facturaperiodo, facturaTipo, facturasecuencia;";
        $result = mysqli_query($con, $sql);
       // echo $result;
        return  $result;	  
    }
     
    function traeNomApto($apto, $empresa){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();
        $nomInmueble='';
        $sql = "SELECT inmuebleDescripcion FROM containmuebles ".
                " WHERE inmuebleCodigo = '". $apto . "' AND  inmuebleEmpresaId = " .$empresa;
        $result = mysqli_query($con, $sql);
        while( $rec = mysqli_fetch_array($result, MYSQL_ASSOC) )
        {
             $nomInmueble = $rec['inmuebleDescripcion'];
        }
        return $nomInmueble;
    } 
        
    function traeAptoPropietario($inmueble, $empresa){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	 
        $sql = "SELECT propietarioNombre, propietarioCedula, propietarioTelefonos,  ".
                " propietarioDireccion, propietarioCorreo  , contaInmuPropietarioInmuebleId,  ".
                " inmuebleCodigo, inmuebleDescripcion ".
                " FROM contapropietarios  ".
                " INNER JOIN containmueblepropietario ON contaInmuPropietarioPropietarioId = propietarioId ".
                " INNER JOIN containmuebles ON contaInmuPropietarioInmuebleId = inmuebleId ".
                " WHERE inmueblePrincipal = 'SI' AND  propietarioEmpresaId =  ".
                $empresa ;        
        if($inmueble > 0){
            $sql .= " AND contaInmuPropietarioInmuebleId = " . $inmueble ;              
        }
            $sql .= " ORDER BY propietarioNombre, inmuebleCodigo   ";
        $result = mysqli_query($con, $sql);
        return  $result;        
    }
    
    function traeReciboCaja($inmueble, $empresa, $rcaja, $uno){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	
        $sql = "SELECT pagosfacturaid, pagosfecha, pagostipo, pagosvalor, pagosreferencia , pagosPeriodoPago, pagosTipoPago ".
                " FROM contapagos   ".
                " WHERE pagosempresa = ".$empresa." AND pagosNrReciCaja = '".$rcaja."' AND pagosinmueble = " . $inmueble;
        if($uno == 1){
          $sql .=  " LIMIT 0, 1";
        }
        $result = mysqli_query($con, $sql);
        return  $result; 
    }
    
    function reporteIngresosGastos($empresa, $periIni, $periFin){
        include_once("clsConection.php");
        $objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
        $con = $objClase->conectar();	
        $sql =  "SELECT ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " .
                " CASE ingastotipo WHEN 'I' THEN 'Ingreso' WHEN 'G' THEN 'Gasto' ELSE 'Inicial' END tipo," . 
                " ingastocomprobante, " . 
                " ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, 0 AS saldo" .
                " FROM containgregastos WHERE ingastotipo NOT IN ('C') AND ingastoempresa =  " .$empresa .
                " AND ( ingastoperiodo >= '" . $periIni ."' AND ingastoperiodo <= '".$periFin . "') ".
                " ORDER BY ingastoFecha ";              
    $result = mysqli_query($con, $sql);
        return  $result;  
    }
    function dias_transcurridos($fecha_i,$fecha_f){
        $di = (int)substr($fecha_i, 0, 4) * 360 + (int)substr($fecha_i, 5, 2) * 30 + (int)substr($fecha_i, 8, 2); //    2018/01/31
        $df = (int)substr($fecha_f, 0, 4) * 360 + (int)substr($fecha_f, 5, 2) * 30 + (int)substr($fecha_f, 8, 2); 
        $dias = abs($df - $di);
        return $dias;
    }

     
    function redondeo($monto, $factor){
        $factor = strtoupper($factor);
        $multiplica = 1;
        switch ($factor) 
        {
            case "L":
               $multiplica = 50;
                break;
            case "C":
                $multiplica = 100;
                break;
            case "Q":
                $multiplica = 500;
                break;
            case "D":
               $multiplica = 10;
                break;
        }  
        $redondo = round($monto / $multiplica);
        $redondo = $redondo * $multiplica;
        return $redondo;
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

       }
 //   }    

?>