<?php
include_once("../bin/cls/clsConection.php");
//$objClase = new DBconexion();
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

switch ($op)
{
    case 'acuer2':
        traeacuer2($data);
        break;     
    case 'busRc':
        buscaRcaja($data);
        break; 
    case 'cnslta2':
        consulta2($data);
        break; 
    case 'conta':
        contabilizar($data);
        break;    
    case 'expKrt':
        carteraEnMoraXLS($data);
        break; 
    case 'fac':
        facturar($data);
        break;
    case 'fchs':
        fechar($data);
        break; 
    case 'facRes':
        facturaResumen($data);
        break;    
    case 'facDet':
        facturaDetalle($data);
        break;
    case 'facSal2':
        traeSaldo($data);
        break;
    case 'leeCaja':
        leeRCaja($data);
        break;
 
    case 'pagaFac':
        pagaFactura($data);
        break; 
    case 'par':
        leeParametros($data);
        break;
    case 'saldoFac':
        saldoFacturacion($data);
        break;
    
    case '0':
        traeListInmuebles($data);
        break;
    case '1':
        traeListPropietarios($data);
        break;
    
}
    function contabilizar($data){
        
    }

    function leeParametros($data){
       global $objClase;
       $con = $objClase->conectar(); 
       $empresa =  $data->empresa;
       $msg = '';
        
            $query = 'SELECT empresaId,empresaClave,empresaNombre,empresaNit,empresaDigito,empresaDireccion,
            empresaCiudad,empresaTelefonos,empresaFchCreacion,empresaFchModificacion,empresaFchVigencia,
            empresaPeriodoActual,empresaTwiter,empresaFacebook,empresaWeb,empresaEmail,empresaActiva,
            empresaPuertoCorreo,empresaRepresentante,empresaIdentifRepresentante,empresaContador,
            empresaMatriculaContador,empresaIdentifContador,empresaRevisor,empresaMatriculaRevisor,
            empresaIdentifRevisor,empresaAnoFiscal,empresaEstructura,empresaAdministrador,
            empresaAdministradorCed,empresaSecretaria,empresaSecretariaCedula,empresaMensaje1,
            empresaMensaje2,empresaPeriodoFactura,empresaPeriCierreFactura,empresaCompFra,empresaCompRcaja,
            empresaCompAjustes,empresaCuentaCaja,empresaRecargoPorc,empresaRecargoPesos,empresaRecargoDias,
            empresaDescPorc,empresaDescPesos,empresaDescDias,empresaPagosParciales,empresaPeriodosAnuales,
            empresaFactorRedondeo,empresaConsecRcaja,empresaConsecFactura,empresaIdioma,
            empresaNroInmuebles,empresaLogo,empresaccosto, empresaservicios,
            empresafacturaNota,empresafacturaresDIAN,empresafacturaNumeracion,
            empresaCompCierreMes,  empresaCompApertura,  empresaCuentaCierre,empresafacturanotaiva,
            empresafacturanotaica,empresafacturactacxc,empresafacturactaivta,empresafacturactaica,
            empresafacturactaiva,empresaRegimen, empresaporcentajeiva, empresaCompEgreso
            FROM contaempresas WHERE empresaId = '. $empresa;
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
            { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $periodoFac = $row['empresaPeriodoFactura'];
                    $nuevoPeriodo = $periodoFac;
                    $ano=  substr($periodoFac,0,4);
                    $mes=  substr($periodoFac,4,2);
                    $dia = date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));
                    $fecCorte=$ano.'-'.$mes.'-'.$dia;
                    $conseRC = $row['empresaConsecRcaja'];
                    $consecutivo = $row['empresaConsecFactura'];
                    $comprobante = $row['empresaCompFra'];
                    $paramempresaDescDias = $row['empresaDescDias'];
                    $nombrePeriodo =  periodoNombre($periodoFac);
                    $descDias = $row['empresaDescDias'];
                    
                    $RecargoPorc = $row['empresaRecargoPorc'];
                    $RecargoPesos = $row['empresaRecargoPesos'];
                    $RecargoDias = $row['empresaRecargoDias'];
                    $FactorRedondeo = $row['empresaFactorRedondeo'];
                    $PeriCierreFactura = $row['empresaPeriCierreFactura'];
                    $estructura = $row['empresaEstructura'];
                    $query = "SELECT count(*) as nro FROM contafactura where facturaEmpresaid = " . $empresa . 
                            " AND facturaperiodo = '" . $nuevoPeriodo . "' ";  
             
                    $result = mysqli_query($con, $query); 
                    while( $rec =  mysqli_fetch_assoc($result))           
                    {
                        $rowcount = $rec['nro'];
                    } 

                    if ($comprobante=='')
                        {$msg='ERR. No se ha definido el tipo de comprobante, ir a parámetros';}
                        else{
                            $nomComprobante = nombreComprobante($empresa, $comprobante);
                             $msg=$periodoFac.'||'.$nuevoPeriodo.'||'.$fecCorte.'||'.$comprobante .'||'.
                                  $nomComprobante.'||'.$descDias.'||'.$consecutivo.'||'.$rowcount .
                                    '||'. $RecargoPorc .'||'. $RecargoPesos .'||'. $RecargoDias .'||'. 
                                     $FactorRedondeo .'||'.$PeriCierreFactura.'||' . $conseRC.
                                    '||'.$estructura;
                        }             
                    echo $msg;
                    
                } 
            } 
          

    }
    
    function saldoFacturacion($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $datos =$data->datos;
        $rec=  explode('||',$datos);
        $empresa =  $rec[0];
        $inmueble = $rec[2];
        $propietario = $rec[1];

        $condicion = "  facturaEmpresaid = " .$empresa . " ";
        if ($propietario >  0){
            $condicion .= " AND facturaPropietario =  " . $propietario;
        }
        if ($inmueble >  0){
            $condicion .= " AND facturaInmuebleid =  " . $inmueble;
        }
        $sql = "SELECT  facturaperiodo, facturadetalle, facturafechafac, facturafechavence ".
               " ,facturasaldo ,facturaprioridad ,facturadescuento ,facturaMora ,facturaNroReciboPago ,facturaTipo ".
               " ,facturaPropietario ,facturaDiasMora ,facturaMoraInmuebId ,facturaAcuerdo, 0 AS saldo ".
               " FROM contafactura WHERE facturasaldo > 0 AND ". $condicion .
               " ORDER BY facturaperiodo, facturaservicioid, facturaprioridad ";

        $facturar = mysqli_query($con, $sql); 
        $arr = array(); 
        $saldo = 0;
        if(mysqli_num_rows($facturar) != 0)  
            { 
                while($row = mysqli_fetch_assoc($facturar)) { 
                    $saldo = (float)$saldo + (float)$row['facturasaldo'];
                    $row['saldo']  =  $saldo;
                    $arr[] = $row; 
                } 
            } 
          
        echo $json_info = json_encode($arr);
    }
    
    function periodoNombre($peri){
        $meses = Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $mes = substr($peri,4,6);
        $per = $meses[$mes - 1] . ' / ' . substr($peri,0,4);
        return $per;
    }
    
    function nombreComprobante($empresa,$comprobante){
        global $objClase;
        $con = $objClase->conectar(); 
        $resulta2="";
        $query = "SELECT compNombre FROM contacomprobantes ".
                 " WHERE compEmpresaId = ". $empresa ." AND compCodigo ='" .$comprobante. "'";                   
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) { 
            $resulta2=$row['compNombre'];            
        }
        return $resulta2;
         
    }
   /*
    * Crea los recibos de cobro en estos pasos: Borra la facturacipon y la contabilidad anterior,
    * crea los registros de cartera en mora hasta la fecha de corte, factura los servicios indicados 
    * en la tabla  de servicios y los servicios en la tabla de inmuebleservicios
    */
    
    function facturar($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $condicion =  $data->condicion;
        $rec = explode("||", $condicion);
        $Codempresa = trim($rec[0]);
        $periodoFac = $rec[1];
        $nroFactura = $rec[2];
        $comprobante = $rec[3];
        $DescDias = $rec[4];
        $fchfactini = $rec[5];
        $fchfactfin = $rec[6];
        $recargoPorc = $rec[8];
        $recargoPesos = $rec[9];
        $recargoDias = $rec[10];
        $factorRedondeo = $rec[11];
        $ultimoPeriFac = $rec[12];
        $msg="Ok.";
        $ano=  substr($periodoFac,0,4);
        $mes=  substr($periodoFac,4,2);
        $mes +=1;
        if ($mes > 12){$mes=01;$ano+=1;}
        if ($mes <10){$nuevoPeriodo = $ano.'0'.$mes;}else{$nuevoPeriodo = $ano.$mes;}
               
        $resultado = borraFacturacion($periodoFac, $Codempresa, $comprobante);

        $resultaMora = carteraEnMora($ultimoPeriFac, $periodoFac, $Codempresa,$recargoPorc, $recargoPesos, $recargoDias, $factorRedondeo, $fchfactini, $fchfactfin);
        
        $resultado = '';
        if ($resultado == ''){
            $fechaControl = $objClase->sumaDias_fecha($fchfactini, $DescDias);
            $condicion = 'ServicioActivo = "A" AND  servicioEmpresaId = ' . $Codempresa .
                         ' AND "' . $fchfactfin .'" <= ServicioFechaHasta '.
                         ' AND "' . $fchfactini .'" >= ServicioFechaDesde '; 
          
            $inmuebleCodigo = '';
            $inmuebleId=0;
            $masFactura = 0;
            $facturaPropietarioAux=0;
            $nr=0;
            $msg='Ok';
            $factura = array( 'facturaid'=>0, 'facturaEmpresaid'=>0, 'facturaNumero'=>0, 'facturaInmuebleid'=>0, 
                'facturaservicioid'=>0,'facturaperiodo'=>"", 'facturasecuencia'=>0, 'facturavalor'=>0.0, 
                'facturadetalle'=>"", 'facturafechafac'=>"", 'facturafechavence'=>"", 'facturafechacontrol'=>"", 
                'facturasaldo'=>0.0, 'facturaprioridad'=>0,  'facturadescuento'=>0.0, 'facturaNroReciboPago'=>0, 
                'facturaMora'=>0.0,'facturaTipo'=>'F','inmueblePrincipal'=>'','inmuebleDepende'=>0, 'inmuebleCodigo'=>0,
                'facturaPropietario'=>0);
           
            $facturar = recupera_facturacion($condicion);

            while( $registro =  mysqli_fetch_assoc($facturar))           
            { 
                $nr += 1;
                $codigo = $registro['ServicioId'];
                $detalle = $registro['ServicioDetalle'];
                $valor = $registro['ServicioValor'];
                $tipo = $registro['ServicioTipo'];
                $prioridad = $registro['ServicioPrioridad'];
                $clasificacion = $registro['servicioClasificacionId'];
                $descuentoDesc=0;
                $inmuebleCodigo = $registro['inmuebleCodigo'];
                $inmuebleDepende = $registro['inmuebleDepende'];
                $inmueblePrincipal = $registro['inmueblePrincipal'];

                $condicion = "inmuebleEmpresaId = ". $Codempresa ;
                $inmuebleCodigo = $registro['inmuebleCodigo'];
                $facturaPropietario = $registro['contaInmuPropietarioPropietarioId'];
                  
                if($facturaPropietarioAux !== $facturaPropietario){
                    if ( $facturaPropietarioAux  > 0){
                        $resultar = serviciosEspeciales($Codempresa, $fchfactini, $inmuebleIdAux, $factura);
                    }

                    $inmuebleIdAux = $registro['inmuebleId']; 
                    if ($inmueblePrincipal === 'NO'){
                        $inmuebleIdAux = buscaPpal($inmuebleDepende);
                    }
                    $nroFactura = add1Factura($nroFactura);
                    $inmuebleId = $inmuebleIdAux;
                    $facturaPropietarioAux = $facturaPropietario;   
                }
                $factura['facturaid']=0;
                $factura['facturaEmpresaid']=$Codempresa; 
                $factura['facturaNumero']=$nroFactura;
                $factura['facturaInmuebleid']=$inmuebleIdAux;
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
                $factura['inmueblePrincipal']=$inmueblePrincipal;
                $factura['inmuebleDepende']=$inmuebleDepende;
                $factura['inmuebleCodigo']=$inmuebleCodigo;
                $factura['facturaPropietario']=$facturaPropietario;  
                grabaFacturacion($factura);   
                $resultar = serviciosEspeciales($Codempresa, $fchfactini, $inmuebleIdAux, $factura);
            }
  //          $resultar = serviciosEspeciales($Codempresa, $fchfactini, $inmueblePrincipal, $factura);
            ActualizaNumeroFactura($Codempresa, $nroFactura, $periodoFac, $nuevoPeriodo );
            $msg="Ok. Actuaizó ".$nr." Facturas " ;

        }
        else
        {
            $msg="Err. No puede Facturar, en el periodo hay movimiento de pagos o notas DB/CR";
        }
        echo $msg;
    return $msg;    
}

    function add1Factura($nr){
        $nr += 1;
        $n=strlen($nr);
        $val=  substr('00000000000', 0, 10-$n).$nr;
        return $val;
    }

    function buscaPpal($inmuebleDepende){
        global $objClase;
        $con = $objClase->conectar(); 
        $inmuebleId=0;
        $sql = "SELECT inmuebleId FROM containmuebles where inmuebleCodigo = '". $inmuebleDepende ."'";
        $result = mysqli_query($con, $sql); 
        while($row = mysqli_fetch_assoc($result)) { 
            $inmuebleId=$row['inmuebleId'];            
        } 
        return $inmuebleId;
    }

    function buscaRcaja($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble = $data->inmueble;
        $sql = "SELECT DISTINCT SUBSTRING(pagosNrReciCaja, 5,10) AS id, pagosNrReciCaja AS numero " .
                "FROM contapagos WHERE pagosempresa = ". $empresa .  " AND pagosinmueble= ". inmueble;
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
    
    function borraFacturacion($periodo, $empresa, $comprobante){
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        $sql="SELECT count(*) as nroRec FROM contafactura ".
             " WHERE facturaEmpresaid=".$empresa." AND facturaperiodo = '".$periodo."' AND facturaTipo IN ('P','C','D') ";
        $result = mysqli_query($con, $sql); 
        while($row = mysqli_fetch_assoc($result)) { 
            $nroRec=$row['nroRec'];            
        } 
        if ($nroRec==0){

            $sql = 'DELETE FROM contafactura WHERE FacturaPeriodo = "' . $periodo . '" AND  facturaEmpresaid = ' . $empresa .
                     " AND facturaid > 0";
            $result = mysqli_query($con, $sql);

            $sql = 'DELETE FROM contamovidetalle WHERE moviConCabezaId IN (SELECT movicaId FROM contamovicabeza WHERE movicaEmpresaId= ' .
                    $empresa . ' AND moviConId >  0 AND movicaComprId = "'. $comprobante. '" AND movicaPeriodo = "'.$periodo . '" ) ;';
            $result = mysqli_query($con, $sql);

            $sql = 'DELETE FROM contamovicabeza WHERE movicaEmpresaId= ' . $empresa . ' AND movicaComprId = "'. $comprobante. 
                    '" AND movicaId > 0 AND movicaPeriodo = "'.$periodo . '" ';
            $result = mysql_query($sql);

       }
       else
       {
           $resultado="NO Se liquida porque el periodo ya tiene movimiento de pagos o de ajustes";
       }
        return $resultado;
    }
    
    function carteraEnMora($ultimoPeriFac, $periodoFac, $empresa,$recargoPorc, $recargoPesos, $recargoDias, $factorRedondeo, $fchfactini, $fchfactfin){
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        
        $sql = "SELECT facturaid, facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, facturaperiodo, " .
                " facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, " .
                " facturasaldo, facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago, facturaTipo, facturaPropietario " .
                " FROM contafactura " .
                " WHERE facturaEmpresaid = " . $empresa . " AND facturaperiodo <= '" . $ultimoPeriFac . "' "  .
                " AND facturasaldo > 0 AND facturaTipo = 'F' " .
                " ORDER BY facturaPropietario";
        $resulter = mysqli_query($con, $sql);     
        while($row = mysqli_fetch_assoc($resulter)) {           
            if ($recargoPesos > 0 ){
               $mora = $recargoPesos;
            }
            else{
                $periodo = $row['facturaperiodo'];
                $n = diferenciaPeriodos($periodo, $periodoFac);
                $val= ((float)$row['facturasaldo'] * (float)$recargoPorc / 100) * $n;                
                $mora = (float)redondear($val,$factorRedondeo);
            }
            $secuencia = $row['facturasecuencia'] + 1;
            $detalle = $row['facturadetalle'] . ' Mora periodo ' . $row['facturaperiodo'];
            $moraId = $row['facturaid'];
            $sql = "INSERT INTO contafactura (facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, ".
            " facturaperiodo, facturasecuencia, facturavalor, facturadetalle, " .
            " facturafechafac, facturafechavence, facturafechacontrol,  ".
            " facturasaldo, facturaprioridad,  facturadescuento, ".
            " facturaNroReciboPago, facturaMora, facturaTipo, facturaPropietario, facturaMoraInmuebId)  ".
            " VALUE ('" . $empresa . "','" .  $row['facturaNumero'] . "','" .  $row['facturaInmuebleid'] . "','" . $row['facturaservicioid'] . "','" .
            $periodo . "','" . $secuencia . "','" . $mora . "','" .  $detalle . "','" .
            $fchfactini . "','" .  $fchfactfin . "','" .  $fchfactini . "','" . 
            $mora . "','3','" .  $row['facturadescuento'] . "','" .
            $row['facturaNroReciboPago'] . "','" .  $row['facturaMora'] . "','M','".  $row['facturaPropietario'] ."'," .$moraId. ")";                 
            $result = mysqli_query($con, $sql);  
        }
        return $resultado;
    }
      
   function carteraEnMoraXLS($data){
        $empresa = $data->empresa; 
        $fchCorte = $data->corte; 
        $op = $data->opcion; 
        include_once("../bin/cls/clsReportes.php");
       //'empresa':empresa,'corte':fc,'opcion':op
        $obj = new  reportesCls();
        $resultado = $obj->carteraEdades($empresa, $op, $fchCorte);
        $pagoCrnte=0;
        $pago0130=0;
        $pago3160=0;
        $pago6190=0;
        $pago91120=0;
        $pago121mas=0;
        $totSubtotal=0;
        $inmueble=0;

        $expo=''; 
        $expo .= '<table border=1 class="table2Excel"> '; 
        $expo .=  '<tr> '; 
        $expo .=  '          <th>INMUEBLE</th>';
        $expo .=  '          <th>PROPIETARIO</th>';
        if($op==='D'){
            $expo .=  '          <th>DETALLE</th>';
            $expo .=  '          <th>FCH FACTURA</th>';
            $expo .=  '          <th>FCH VENCE</th>';
            $expo .=  '          <th>DIAS</th>';
        }
        $expo .=  '          <th>CORRIENTE</th>';
        $expo .=  '          <th>DE 1 A 30 DIAS</th>';
        $expo .=  '          <th>DE 31 A 60 DIAS</th>';
        $expo .=  '          <th>DE 61 A 90 DIAS</th>';
        $expo .=  '          <th>DE 91 A 120 DIAS</th>';
        $expo .=  '          <th>MAS DE 120 DIAS</th>';
        $expo .=  '          <th>SUB TOTAL</th>';
        $expo .=  '</tr> '; 
        while( $row = mysqli_fetch_array($resultado, MYSQL_ASSOC) ) { 
            $subtotal=(float)$row['pagoCrnte']+(float)$row['pago0130']+(float)$row['pago6190']+
            (float)$row['pago3160']+(float)$row['pago91120']+(float)$row['pago121mas'];
            if($op==='R'){
                if ($inmueble != $row['pagoinmuebleid']){
                    if($inmueble > 0){
                        $expo .=  '<tr> '; 
                        $expo .=  '<td>' .$inmuebledesc. '</td> ';
                        $expo .=  '<td>' .$nompropietario. '</td> ';
                        $expo .=  '<td>' .$pagoCrnte. '</td> ';
                        $expo .=  '<td>' .$pago0130. '</td> ';
                        $expo .=  '<td>' .$pago3160. '</td> ';
                        $expo .=  '<td>' .$pago6190. '</td> ';
                        $expo .=  '<td>' .$pago91120. '</td> ';
                        $expo .=  '<td>' .$pago121mas. '</td> ';
                        $expo .=  '<td>' .$totSubtotal. '</td> ';
                        $expo .=  '</tr> ';
                    }
                    $inmueble = $row['pagoinmuebleid'];
                    $inmuebledesc=$row['pagoinmuebledesc'];
                    $nompropietario=utf8_decode($row['pagonompropietario']); 
                    $pagoCrnte=0;
                    $pago0130=0;
                    $pago3160=0;
                    $pago6190=0;
                    $pago91120=0;
                    $pago121mas=0;
                    $totSubtotal=0;
                }
                    $pagoCrnte+=(float)$row['pagoCrnte'];
                    $pago0130+=(float)$row['pago0130'];
                    $pago3160+=(float)$row['pago3160'];
                    $pago6190+=(float)$row['pago6190'];
                    $pago91120+=(float)$row['pago91120'];
                    $pago121mas+=(float)$row['pago121mas'];
                    $totSubtotal+=(float)$subtotal;
            }else{
                $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['pagoinmuebledesc']. '</td> ';
                $expo .=  	'<td>' .$row['pagonompropietario']. '</td> ';
                $expo .=  	'<td>' .$row['pagodetalle']. '</td> ';
                $expo .=  	'<td>' .$row['pagofchfac']. '</td> ';
                $expo .=  	'<td>' .$row['pagofchvnc']. '</td> ';
                $expo .=  	'<td>' .$row['pagodias']. '</td> ';
                $expo .=  	'<td>' .$row['pagoCrnte']. '</td> ';
                $expo .=  	'<td>' .$row['pago0130']. '</td> ';
                $expo .=  	'<td>' .$row['pago3160']. '</td> ';
                $expo .=  	'<td>' .$row['pago6190']. '</td> ';
                $expo .=  	'<td>' .$row['pago91120']. '</td> ';
                $expo .=  	'<td>' .$row['pago121mas']. '</td> ';
                $expo .=  	'<td>' .$subtotal. '</td> ';
                $expo .=  '</tr> ';
            }
           } 
        if($op==="R"){
             $expo .=  '<tr> '; 
            $expo .=  '<td>' .$inmuebledesc. '</td> ';
            $expo .=  '<td>' .$nompropietario. '</td> ';
            $expo .=  '<td>' .$pagoCrnte. '</td> ';
            $expo .=  '<td>' .$pago0130. '</td> ';
            $expo .=  '<td>' .$pago3160. '</td> ';
            $expo .=  '<td>' .$pago6190. '</td> ';
            $expo .=  '<td>' .$pago91120. '</td> ';
            $expo .=  '<td>' .$pago121mas. '</td> ';
            $expo .=  '<td>' .$totSubtotal. '</td> ';
            $expo .=  '</tr> ';
        }
        $expo .=  '</table> ';  
        echo $expo; 
    return $expo; 
   }
   
   function recupera_facturacion($condicion){ 
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        
        $sql1 = "SELECT ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, ".
            " ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ".
            " ServicioMora, ServicioMoraPorcentaje, servicioMoraValor,ServicioCuentaDB, ".
            " ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioAmbito, 'Todos'".
            " clasificacionDetalle, 0 servicioClasificacionId, ServicioActivo, inmuebleId, ".
            " inmuebleEmpresaId,inmuebleCodigo,inmuebleClasificacionId, inmueblePrincipal, ".
            " CASE WHEN inmueblePrincipal = 'SI' THEN inmuebleCodigo ELSE inmuebleDepende END inmuebleDepende , ".
            " contaInmuPropietarioPropietarioId, contaInmuPropietarioInmuebleId, 0 As saldo   ". 
            " FROM contaservicios,  containmuebles, containmueblepropietario  " .
            " WHERE servicioAmbito = 'T'  ".
            " AND contaInmuPropietarioEmpresaId = servicioEmpresaId AND contaInmuPropietarioInmuebleId = inmuebleId " .
            " AND inmuebleEmpresaId = servicioEmpresaId AND inmueblePrincipal = 'SI' AND ".
            "((servicioAmbito = 'T' and servicioClasificacionId = 0 ) OR ".
            " (servicioAmbito = 'T' and inmuebleClasificacionId = servicioClasificacionId  )) AND " .
            $condicion ;        
        $sql2 = " UNION ";
        $sql =    " SELECT ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, ".
            " ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ".
            " ServicioMora, ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, ".
            " ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioAmbito, ".
            " clasificacionDetalle, servicioClasificacionId, ServicioActivo, inmuebleId, ".
            " inmuebleEmpresaId,inmuebleCodigo,inmuebleClasificacionId, inmueblePrincipal,  " .
            " CASE WHEN inmueblePrincipal = 'SI' THEN inmuebleCodigo ELSE inmuebleDepende END inmuebleDepende , ".
            " contaInmuPropietarioPropietarioId, contaInmuPropietarioInmuebleId , 0 As saldo  ".
            " FROM contaservicios, contaclasificacion, containmuebles, containmueblepropietario  ".
            " WHERE servicioEmpresaId = clasificacionEmpresaId  ".
            " AND contaInmuPropietarioEmpresaId = servicioEmpresaId AND contaInmuPropietarioInmuebleId = inmuebleId " .
            " AND servicioClasificacionId = clasificacionId AND servicioAmbito = 'G'  AND  ".
            " inmuebleEmpresaId = servicioEmpresaId AND inmuebleClasificacionId = servicioClasificacionId AND " .
            $condicion ;
          //  $sql = $sql1. ' ' . $sql2. ' ORDER BY inmuebleDepende, ServicioCodigo, inmuebleCodigo ';   
            $result = mysqli_query($con, $sql);  
//            echo $sql;
    return $result; 
}        
 
    function consulta2($data){
        $empresa =  $data->empresa;
        $inmueble = $data->inmueble;
        $propietario = $data->propietario;
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        $condicion = " WHERE facturaEmpresaid = " .$empresa . " ";
        if ($propietario >  0){
            $condicion .= " AND facturaPropietario =  " . $propietario;
        }
        if ($inmueble >  0){
            $condicion .= " AND facturaInmuebleid =  " . $inmueble;
        }
         $sql = "SELECT facturaid, facturaEmpresaid, facturaNumero, facturaInmuebleid, inmuebleDescripcion, ".
                 " facturaservicioid, facturaperiodo, facturasecuencia, facturavalor, facturadetalle,  ".
                 " facturafechafac, facturafechavence, facturafechacontrol, facturasaldo, facturaprioridad,  ".
                 " facturadescuento,  facturaMora, facturaNroReciboPago, facturaTipo, facturaPropietario,  ".
                 " propietarioNombre, facturaDiasMora, 0 As saldo  ".
                 " FROM contafactura  ".
                 " INNER JOIN containmuebles ON facturaInmuebleid  = inmuebleId ".
                 " INNER JOIN contapropietarios ON facturaPropietario = propietarioId " .
                 $condicion . 
                 " ORDER BY facturaperiodo, facturaInmuebleid, facturaNumero ";
        $facturar = mysqli_query($con, $sql); 
        $arr = array(); 
        $saldo = 0;
        if(mysqli_num_rows($facturar) != 0)  
            { 
                while($row = mysqli_fetch_assoc($facturar)) { 
                    $saldo = (float)$saldo + (float)$row['facturasaldo'];
                    $row['saldo']  =  $saldo;
                    $arr[] = $row; 
                } 
            } 
          
        echo $json_info = json_encode($arr);
    }
    
    function pagaSerieFactura($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        $n=0;
        $empresa = $data->empresa;
        $sql ="SELECT pagocedula, pagoinmueble, pagofecha, pagovalor, pagopropietarioid, pagodetalle ".
                " FROM contatmpagos  WHERE pagoempresa= " . $empresa. " AND pagoestado='P'";
         $resultado = mysqli_query($con, $sql); 
         while($row = mysqli_fetch_assoc($resultado)) {
            $data=$empresa."||".$row['pagopropietarioid']."||".$row['pagoinmueble']."||C||".
            $row['pagovalor']."||".$row['pagodetalle']."||".$row['pagofecha'];
            pagaFactura($data);
            $n+=1;
         }
         echo 'Ok'.$n;
    }
    
        function pagaFactura($data){ 
//$empresa+"||"+prop+"||"+inmu+"||"+forma+"||"+valor+"||"+referencia+"||"+fecha;   
            global $objClase;
            $con = $objClase->conectar(); 
            $resultado="";
            $datos = $data->datos;
            $rec=  explode('||',$datos);

            $sql = "SELECT empresaConsecRcaja FROM contaempresas WHERE empresaId = ". $rec[0];
            $resul = mysqli_query($con, $sql);     
            while($row = mysqli_fetch_assoc($resul)) { 
                $consecReciCaja = $row['empresaConsecRcaja'];
            }
            
            $sql = "SELECT sum(facturasaldo) AS saldo FROM contafactura WHERE facturasaldo > 0  ".
                    "AND facturaTipo = 'T' AND facturaEmpresaid = ". $rec[0]. " AND facturaInmuebleid = ".$rec[2];
            $resul = mysqli_query($con, $sql);     
            while($row = mysqli_fetch_assoc($resul)) { 
                $valor = $row['saldo'];
            }
            if(is_null($valor)){
                $valor=0;
            }
            $inmueble=$rec[2];
            $propie=$rec[1];
            $saldo =  (float)$rec[4] + (float)$valor;
            $fecha = $rec[6];
            
            // Procesa saldos en mora          
            $sql0 = "SELECT facturaid, facturaNumero, facturaInmuebleid, facturaservicioid, facturaperiodo, facturasecuencia, " .
                    " facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, facturasaldo,  " .
                    " facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago, facturaTipo, facturaPropietario,  " .
                    " facturaDiasMora, facturaMoraInmuebId  " .
                    " FROM contafactura WHERE facturasaldo > 0  ";
                   
            if($rec[1]>0){
                $sql0 .= "  AND facturaPropietario = " . $rec[1];
            } 
            if($rec[2]>0){
                $sql0 .= "  AND facturaInmuebleid = " . $rec[2];
            }
            $sql1 =  "  AND facturaTipo = 'M' AND facturaEmpresaid = " . $rec[0];
            $sql2 = " ORDER BY facturaperiodo, facturaNumero ";
            $sql = $sql0 . $sql1 . $sql2;

            $resultado = mysqli_query($con, $sql); 
            $consecReciCaja =  add1Factura($consecReciCaja);
            while($row = mysqli_fetch_assoc($resultado)) { 
                $idFac = $row['facturaMoraInmuebId'];
                $inmueble = $row['facturaInmuebleid'];
                $id = $row['facturaid'];
                $priodo = $row['facturaperiodo'];
                $pago = $row['facturasaldo'];
                $propie = $row['facturaPropietario'];
                $facturaTipo = $row['facturaTipo'];
                $valor = (float)$saldo - (float)$row['facturasaldo'];
                if ($valor >= 0){
                    $hay=0;                    
                    $saldo = $valor;                    
                    // Cancela el saldo en mora
                    $sql = "UPDATE contafactura SET facturasaldo = 0,  facturaTipo='P'  WHERE facturaid = " . $id;
                    $resul = mysqli_query($con, $sql);

                    grabaContapagos($rec[0], $id, $rec[6], $facturaTipo, $pago, 'Paga Intereses de mora', $consecReciCaja ,$inmueble, $rec[3],$priodo);
                    // Trae saldo factura y detalle
                    $sql = "SELECT  facturasaldo, facturadetalle FROM contafactura WHERE facturaid = " . $idFac;
                    $resul = mysqli_query($con, $sql);     
                    while($row = mysqli_fetch_assoc($resul)) { 
                        $facSaldo = $row['facturasaldo'];
                        $detalle = 'Abono '.$row['facturadetalle'];
                    }
                    // aplica pago afactura
                    $valor = (float)$saldo - (float)$facSaldo;
                    if($valor >= 0){
                        $pago = $row['facturasaldo'];
                        $saldo = $valor;                      
                        $sql = "UPDATE contafactura SET facturasaldo = 0,  facturaTipo='A'  WHERE facturaid = " . $idFac;
                        $resul = mysqli_query($con, $sql);                      
                        grabaContapagos($rec[0], $idFac, $rec[6],$facturaTipo, $pago, $detalle, $consecReciCaja, $inmueble, $rec[3] ,$priodo);
                    }
                    else{
                        $pago = (float)$facSaldo - (float)$saldo;
                        $sql = "UPDATE contafactura SET facturasaldo = " . $pago .
                                ",  facturafechavence = '". $fecha . "' facturaTipo='A'  WHERE facturaid = " . $idFac;
                        $resul = mysqli_query($con, $sql); 
                        grabaContapagos($rec[0], $idFac, $rec[6], $facturaTipo, $valor, $detalle, $consecReciCaja, $inmueble, $rec[3],$priodo );
                    }
                }
                else{
                    // No le alcanza para pagar toda la mora
                    grabaContapagos($rec[0], $id, $rec[6], 'T', $saldo, 'Anticipo no cubre toda la mora', $consecReciCaja, $inmueble, $rec[3],$priodo ); 
                    grabaAnticipo($rec[0], $consecReciCaja, $inmueble, $saldo, $rec[6], 'Anticipo Sobrante de pagos', $propie);    
                    $saldo=0;
                    echo $consecReciCaja;
                    return;
                }
            }

            $sql1 =  "  AND facturaTipo = 'F' AND facturaEmpresaid = " . $rec[0];
            $sql2 = " ORDER BY facturaperiodo, facturaNumero, facturaprioridad ";
            $sql = $sql0 . $sql1 . $sql2;
            $fechaPago= $rec[6];
            $resultado = mysqli_query($con, $sql);     
            while($row = mysqli_fetch_assoc($resultado)) {
                if ($saldo > 0){
                    $descuento = 0;
                    if($fechaPago <= $row['facturafechacontrol']){
                        $descuento = hayDescuentos($fechaPago, $row['facturaid']) ;
                    }
                    $valor = (float)$saldo - ((float)$row['facturasaldo'] - $descuento);
                    $pago = $row['facturasaldo'] - $descuento;
                    $facturaTipo = $row['facturaTipo']; 
                    $inmueble = $row['facturaInmuebleid'];
                    $id = $row['facturaid']; 
                    $detalle = 'Abono '.$row['facturadetalle'];
                    $propie = $row['facturaPropietario'];
                    $priodo = $row['facturaperiodo'];
                    if ($valor >= 0){                  
                        $sql = "UPDATE contafactura SET facturasaldo = 0,  facturaTipo='A'  WHERE facturaid = " . $id;
                        $resul = mysqli_query($con, $sql); 
                        grabaContapagos($rec[0], $id, $rec[6], $facturaTipo, $pago, $detalle, $consecReciCaja, $inmueble, $rec[3],$priodo);
                        $saldo = $valor;
                    } 
                    else{
                      $valor = (float)$row['facturasaldo'] - (float)$saldo;
                      $sql = "UPDATE contafactura SET facturasaldo = ".$valor .",  facturaTipo='A'  WHERE facturaid = " . $id;
                        $resul = mysqli_query($con, $sql);   
                        grabaContapagos($rec[0], $id, $rec[6], $facturaTipo, $valor, $detalle, $consecReciCaja, $inmueble, $rec[3],$priodo );
                        $saldo= 0;
                    }
                }
            }
            if($saldo > 0){
                grabaContapagos($rec[0], 0, $rec[6], 'T', $saldo, 'Anticipo '.$row['facturadetalle'], $consecReciCaja, $inmueble, $rec[3],$priodo );
                grabaAnticipo($rec[0], $consecReciCaja, $inmueble, $saldo, $rec[6], 'Anticipo Sobrante de pagos', $propie); 
            }
           ActualizaNumeroRCaja($rec[0], $consecReciCaja);
           echo $consecReciCaja;        
        }
 //$empresa+"||"+prop+"||"+inmu+"||"+forma+"||"+valor+"||"+referencia+"||"+fecha;   
    function grabaContapagos($em, $id, $fch, $tp, $pago, $ref, $cons, $inmu, $tpPag, $periodo ){
        global $objClase;
        $con = $objClase->conectar();  
        $sql="INSERT INTO contapagos (pagosempresa, pagosfacturaid, pagosfecha, ".
        "pagostipo, pagosvalor, pagosreferencia, pagosNrReciCaja, pagosinmueble, pagosTipoPago, pagosPeriodoPago) " .
        " VALUES (" .$em . "," . $id . ", '" . $fch . "', '" . $tp . "', ".
        $pago . ", '" . $ref . "', '" . $cons . "',".$inmu.",'".$tpPag."','".$periodo."')";
        $resul = mysqli_query($con, $sql);
    }
    
    function grabaAnticipo($Codempresa, $cons, $inmu, $valor, $fch, $detalle, $propie){
        global $objClase;
        $con = $objClase->conectar();
        $peri= substr($fch,0,4) .  substr($fch,5,2);
        $sql = 'INSERT INTO contafactura (facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, 
        facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, 
        facturasaldo, facturaprioridad,  facturadescuento, facturaNroReciboPago, facturaMora, facturaTipo, facturaPropietario, 
        facturaMoraInmuebId) VALUES ('.$Codempresa.", '".$cons ."', " . $inmu . ",1,'" .$peri.
        "',0,".$valor.",'".$detalle."','".$fch."','".$fch."','".$fch."',".$valor.",1,0,'".$cons ."',0,'T',". $propie . ",0)";
        $result = mysqli_query($con, $sql);   
        return $result;    
    }
    function hayDescuentos($fechaPago, $id){
        
    }
    
    function serviciosEspeciales($Codempresa, $fchfactini, $inmueble, $factura){ 
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";
        $sql = "SELECT InmuebleServicioId, InmuebleServicioEmpresaId, ServicioCodigo, ServicioDetalle, " .
                " InmuebleServicioInmuebleId, inmuebleCodigo , inmuebleDescripcion , InmuebleServicioServicioId, " .
                " InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, InmuebleServicioFechaInicio, " .
                " InmuebleServicioActivo " .
                " FROM containmuebleservicios" .
                " INNER JOIN contaservicios ON ServicioId = InmuebleServicioServicioId" .
                " INNER JOIN containmuebles ON inmuebleId = InmuebleServicioInmuebleId" .
                " WHERE InmuebleServicioEmpresaId = " .$Codempresa . " AND InmuebleServicioSaldo > 0 " .
                " AND InmuebleServicioFechaInicio >='".$fchfactini."' AND InmuebleServicioInmuebleId = " . $inmueble;
        $resultado = mysqli_query($con, $sql);     
        while($row = mysqli_fetch_assoc($resultado)) {    
            $factura['facturaservicioid']=$row['InmuebleServicioServicioId'];
            $factura['facturavalor']=$row['InmuebleServicioCuota'];
            $factura['facturadetalle']=$row['ServicioDetalle']; 
            $factura['facturasaldo']=$row['InmuebleServicioCuota'];
            $factura['facturaprioridad'] = 4;
            grabaFacturacion($factura);  
        }
    }

    function grabaFacturacion($factura){
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado="";  
        $inmueble=$factura['inmuebleCodigo'];
        if ($factura['inmueblePrincipal']=='NO'){
            $sql = " SELECT  inmuebleId  FROM containmuebles WHERE inmuebleCodigo = '" .  $factura['inmuebleDepende'] ."'";
            $resulter = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($resulter)) { 
                $inmueble=$row['inmuebleId'];            
            }
        }
        $sql = 'INSERT INTO contafactura (facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, 
            facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, facturafechacontrol, 
            facturasaldo, facturaprioridad,  facturadescuento, facturaNroReciboPago, facturaMora, facturaTipo, facturaPropietario, 
            facturaMoraInmuebId) '.
        'VALUE (' .  $factura['facturaEmpresaid'] . ',"' .  $factura['facturaNumero'] . '",' .
        $factura['facturaInmuebleid'] . ',' .  $factura['facturaservicioid'] . ',"' .  $factura['facturaperiodo'] . '",' .
        $factura['facturasecuencia'] . ',' .  $factura['facturavalor'] . ',"' .  $factura['facturadetalle'] . '","' .
        $factura['facturafechafac'] . '","' .  $factura['facturafechavence'] . '","' .
        $factura['facturafechacontrol'] . '",' .  $factura['facturasaldo'] . ',' .  
        $factura['facturaprioridad'] . ',' .  $factura['facturadescuento'] . ',' .
        $factura['facturaNroReciboPago'] . ',' .  $factura['facturaMora'] . ',"F",'.  $factura['facturaPropietario'] .',0)' ;                 
        $result = mysqli_query($con, $sql);   
        return $resultado;                

    }

    function ActualizaNumeroFactura($empresa, $factura, $periodoFac, $nuevoPeriodo){ 
          global $objClase;
          $con = $objClase->conectar(); 
          $resultado="";
          $sql = "UPDATE contaempresas SET  empresaConsecFactura = ".$factura.   
                ", empresaPeriodoFactura = '" . $nuevoPeriodo . "' , empresaPeriCierreFactura = '". $periodoFac .
          "' WHERE empresaId = ".$empresa; 
          $result = mysqli_query($con, $sql); 
   }  
 
       function ActualizaNumeroRCaja($empresa, $consecutivo){ 
          global $objClase;
          $con = $objClase->conectar(); 
          $resultado="";
          $sql = "UPDATE contaempresas  SET empresaCuentaCaja= '" . $consecutivo . "' WHERE empresaId = " . $empresa; 
          $result = mysqli_query($con, $sql); 
   }  
 
 
    function recuperaServiciosInmueble($condi){
            global $objClase;
            $con = $objClase->conectar(); 
            $resultado="";
            $sql = "SELECT InmuebleServicioId, InmuebleServicioEmpresaId, InmuebleServicioInmuebleId, 
                InmuebleServicioServicioId, ServicioDetalle, InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, 
                InmuebleServicioFechaInicio, InmuebleServicioActivo
                FROM containmuebleservicios, contaservicios WHERE ".$condi ;
       //   echo $sql. '<br />';
             $result = mysqli_query($con, $sql); 
            return $result;
    } 

    function redondear($valor, $tipo){
        if ($tipo==='L') {$div=50;}
        if ($tipo==='C') {$div=100;}
        if ($tipo==='Q') {$div=500;}
        if ($tipo==='M') {$div=1000;}
        $vlr0 = (int)round($valor/$div, 0);
        $vlr1 = (float)$vlr0 * $div;
        return $vlr1;
    }

    function diferenciaPeriodos($ultimoPeriFac, $periodoFac){
        $v1 = (int)substr($ultimoPeriFac,0,4) * 12 + (int)substr($ultimoPeriFac,4,2);
        $v2 = (int)substr($periodoFac,0,4) * 12 + (int)substr($periodoFac,4,2);
        $a = $v2 - $v1;
        return $a;
    }
    
    function facturaResumen($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $resultado="";
        $sql = " SELECT facturaInmuebleid,  inmuebleDescripcion, propietarioNombre , sum(facturasaldo) as saldo ".
               " FROM contafactura  ".
               " INNER JOIN containmuebles ON facturaInmuebleid = inmuebleId  ".
               " INNER JOIN contapropietarios ON facturaPropietario = propietarioId  ".
               " WHERE facturaEmpresaid = '" . $empresa . "' AND  inmueblePrincipal = 'SI'  ".
               " GROUP BY facturaInmuebleid, facturaInmuebleid, facturaPropietario  ".
               " ORDER BY inmuebleDescripcion;";
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

    function facturaDetalle($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble =  $data->inmueble;
        $resultado="";
        $sql = "SELECT  facturaperiodo, facturadetalle, facturafechavence, facturasaldo " . 
                " FROM contafactura " .
                " WHERE facturaEmpresaid = '". $empresa . "' AND facturaInmuebleid = '" .
                $inmueble ."' AND facturasaldo > 0 ORDER BY facturaperiodo, facturadetalle";
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
 
    function  traeListInmuebles($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
    
        $resultado="";
        $sql = "SELECT inmuebleId, inmuebleDescripcion ".
                " FROM containmuebles WHERE inmueblePrincipal = 'SI' AND inmuebleEmpresaId = '".
                  $empresa  . "' ORDER BY inmuebleDescripcion";
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
   
    function leeRCaja($data){
         global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble = $data->inmu;
        $sql = "SELECT DISTINCT CONCAT(pagosNrReciCaja,' Del ',pagosfecha) AS recibo,  pagosNrReciCaja  ".
                " FROM contapagos   ".
                " WHERE pagosempresa = " . $empresa  . " AND  pagosinmueble =  " . $inmueble .
                " ORDER BY   pagosNrReciCaja desc";
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
 
    
    function  traeListPropietarios($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
    
        $resultado="";
        $sql = "SELECT propietarioId, propietarioNombre  ".
                "FROM contapropietarios WHERE propietarioEmpresaId = '".
                  $empresa  . "' ORDER BY propietarioNombre";
        
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
    
    function traeSaldo($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble = $data->inmueble;
        $propietario = $data->propietario;
        $sql = "SELECT sum(facturasaldo) AS saldo FROM contafactura " .
               " WHERE facturasaldo > 0 AND facturaEmpresaid = " . $empresa;
        if ($inmueble > 0){ $sql .= "  AND facturaInmuebleid = " . $inmueble; };
        if ($propietario > 0 ){ $sql .= "  AND facturaPropietario = " . $propietario;  } ;
        $result = mysqli_query($con, $sql); 
        $saldo=0;
        if(mysqli_num_rows($result) != 0)  
            { 
                while($row = mysqli_fetch_assoc($result)) { 
                   $saldo =  $row['saldo'];
                } 
            } 
        setlocale(LC_MONETARY,"es_CO"); 
        echo $saldo;
      }
      
    function traeacuer2($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble = $data->inmueble;
        $propietario = $data->propietario;
        $condicion = "";
        $mora = 0;
        $corriente =  0;
        $anticipos =  0;
        if($inmueble>0){$condicion = " AND facturaInmuebleid = " .$inmueble; }
        if($propietario>0){$condicion = " AND facturaPropietario = " . $propietario ;}
        $sql = "SELECT SUM(facturasaldo) As mora FROM contafactura where facturaEmpresaid= ". $empresa .
                " AND facturaTipo = 'M' AND facturasaldo > 0 " . $condicion;
        $result = mysqli_query($con, $sql); 
        if(mysqli_num_rows($result) != 0)  
        {
            while($row = mysqli_fetch_assoc($result)) { 
                $mora =  $row['mora'];
            }     
        }
         
        $sql = "SELECT SUM(facturasaldo) As corriente FROM contafactura where facturaEmpresaid=". $empresa .
                " AND facturaTipo = 'F' AND facturasaldo > 0 " . $condicion;
        $result = mysqli_query($con, $sql); 
        if(mysqli_num_rows($result) != 0)  
        {
            while($row = mysqli_fetch_assoc($result)) { 
                $corriente =  $row['corriente'];
            }
        }
        $sql = "SELECT SUM(facturasaldo) As anticipos FROM contafactura where facturaEmpresaid=". $empresa .
                " AND facturaTipo = 'T' AND facturasaldo > 0 " . $condicion; 
        $result = mysqli_query($con, $sql); 
        if(mysqli_num_rows($result) != 0)  
        {
            while($row = mysqli_fetch_assoc($result)) { 
                $anticipos =  $row['anticipos'];
            }
        }
        echo $mora.'||'.$corriente.'||'.$anticipos;
   
    }
    
//    function  aplicaAcuerdo($data){
//        global $objClase;
//        $con = $objClase->conectar(); 
//        $empresa =  $data->empresa;
//        $inmueble = $data->inmueble;
//        $propietario = $data->propietario;
//        $condicion = "";
//        $mora = 0;
//        $corriente =  0;
//        $anticipos =  0;
//        if($inmueble>0){$condicion = " AND facturaInmuebleid = " .$inmueble; }
//        if($propietario>0){$condicion = " AND facturaPropietario = " . $propietario ;}
//        $sql = "SELECT acuerdoid, acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario FROM contaacuerdos;";
//        echo 'Ok';
//    }
    function fechar($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa = $data->empresa;
        $sql ="SELECT COALESCE(MIN(ingastoFecha),'') AS f FROM containgregastos ".
            " WHERE ingastoempresa = " . $empresa . " AND ingastocontabiliza='N' ".
            " UNION " .
            " SELECT COALESCE(MAX(ingastoFecha),'') AS f FROM containgregastos ".
            " WHERE ingastoempresa = " . $empresa . " AND ingastocontabiliza='N'";
         $resultado = mysqli_query($con, $sql); 
         $data="";
         while($row = mysqli_fetch_assoc($resultado)) {
            $data .=$row['f']."||";
         }
         echo $data;
    }
    
    function recuperaUnInmueble($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa =  $data->empresa;
        $inmueble = $data->inmueble;
        $propietario = $data->propietario;  
        if ($inmueble > 0 ){
            $sql = "SELECT facturaperiodo, facturadetalle, facturasaldo , inmuebleId  " .
               " FROM contafactura  " .
               " INNER JOIN containmuebles ON facturaInmuebleid = inmuebleId  " .
               " WHERE facturaEmpresaid = " . $empresa . " AND  facturasaldo > 0 AND inmueblePrincipal='SI'   " .
               " AND inmuebleEmpresaId = " . $empresa . " AND inmuebleCodigo = '".$inmueble."'" .
               " UNION    " .
               " SELECT facturaperiodo, facturadetalle, facturasaldo , inmuebleId   " .
               " FROM contafactura   " .
               " INNER JOIN containmuebles ON facturaInmuebleid = inmuebleId   " .
               " WHERE facturaEmpresaid = " . $empresa . " AND  facturasaldo > 0  AND inmuebleEmpresaId = " . $empresa . 
               " AND inmuebleCodigo = '".$inmueble."'" .
               " ORDER BY facturaperiodo, facturadetalle";
        }
        else{
            $sql = "SELECT facturaperiodo, facturadetalle, facturasaldo  " .
               " FROM contafactura  " .
               " INNER JOIN contapropietarios ON propietarioId = facturaPropietario " .
               " WHERE propietarioEmpresaId = " . $empresa . " AND  propietarioCedula = '" .$propietario."'  " .
               " AND propietarioEmpresaId = " . $empresa . 
               " ORDER BY facturaperiodo,facturadetalle";
        }
               
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