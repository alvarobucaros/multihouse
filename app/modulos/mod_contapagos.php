<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

switch ($op)
{
    case 'r':
        leeRegistros($data);
        break;
    case 'b':
        borra($data);
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
    case 'exp':
        exportaXls($data);
        break; 
    case '0':
        lista0($data);
        break;
}
  

    function  leeRegistros($data) 
    { 
       global $objClase;
       $con = $objClase->conectar(); 
       $empresa = $data->empresa; 
       { 
            $query = "SELECT  pagosid, pagosempresa, pagosfacturaid, pagosfecha, pagostipo, pagosvalor, ".
                    " pagosreferencia, pagosNrReciCaja, pagosinmueble, pagosTipoPago, pagosPeriodoPago" .
                    " FROM contapagos ".
                    " WHERE pagosempresa = " . $empresa . " AND pagostipo = 'T' AND pagosEstado = 'A' ".
                    " ORDER BY pagosPeriodoPago ";             
            $result = mysqli_query($con, $query); 
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
        $query = "DELETE FROM contapagos WHERE pagosid=$data->pagosid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $pagosid =  $data->pagosid; 
        $pagosempresa =  $data->pagosempresa; 
        $pagosfacturaid =  $data->pagosfacturaid; 
        $pagosfecha =  $data->pagosfecha; 
        $pagostipo =  $data->pagostipo; 
        $pagosvalor =  $data->pagosvalor; 
        $pagosreferencia =  $data->pagosreferencia; 
        $pagosNrReciCaja =  $data->pagosNrReciCaja; 
        $pagosinmueble =  $data->pagosinmueble; 
        $pagosTipoPago =  $data->pagosTipoPago; 
        $pagosPeriodoPago =  $data->pagosPeriodoPago; 
   
        if($pagosid  == 0) 
        { 
           $query = "INSERT INTO contapagos(pagosempresa, pagosfacturaid, pagosfecha, pagostipo, ".
                   " pagosvalor, pagosreferencia, pagosNrReciCaja, pagosinmueble, pagosTipoPago, ".
                   " pagosPeriodoPago, pagosEstado)";
           $query .= "  VALUES ('" . $pagosempresa."', '".$pagosfacturaid."', '".$pagosfecha."', '".
                   $pagostipo."', '".$pagosvalor."', '".$pagosreferencia."', '".$pagosNrReciCaja."', '".
                   $pagosinmueble."', '".$pagosTipoPago."', '".$pagosPeriodoPago."','A')";  
            mysqli_query($con, $query);
            $query = "select last_insert_id() as id;";
            $result =mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
            }
            $query = "INSERT INTO contafactura(facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, ".
            " facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac, facturafechavence, ".
            " facturafechacontrol, facturasaldo, facturaprioridad, facturadescuento, facturaMora, facturaNroReciboPago, ".
            " facturaTipo, facturaPropietario, facturaDiasMora, facturaMoraInmuebId ) " .
            "  VALUES ('" . $pagosempresa."', '".$pagosNrReciCaja."', '". $pagosinmueble."',1,'".$pagosPeriodoPago.
            "',0,'".$pagosvalor."', '".$pagosreferencia."', '".$pagosfecha."', '".$pagosfecha."', '".$pagosfecha."', '".
            $pagosvalor."',4,0,0, '".$pagosNrReciCaja."', 'T',0,0,".$id.")";
            mysqli_query($con, $query);
            echo 'Ok'; 
        }
        else 
        { 
            $query = "UPDATE contapagos  SET pagosempresa = '".$pagosempresa."', pagosfacturaid = '".$pagosfacturaid."', pagosfecha = '".$pagosfecha."', pagostipo = '".$pagostipo."', pagosvalor = '".$pagosvalor."', pagosreferencia = '".$pagosreferencia."', pagosNrReciCaja = '".$pagosNrReciCaja."', pagosinmueble = '".$pagosinmueble."', pagosTipoPago = '".$pagosTipoPago."', pagosPeriodoPago = '".$pagosPeriodoPago."' WHERE pagosid = ".$pagosid;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
 function exportaXls($data){ 
       global $objClase;
        $con = $objClase->conectar(); 
        $empresa = $data->empresa; 
        $expo=''; 
        $expo .= '<table border=1 class="table2Excel"> '; 
        $expo .=  '<tr> '; 
      $expo .=  '          <th>ID</th>';
      $expo .=  '          <th>EMPRESA</th>';
      $expo .=  '          <th>FACTURAID</th>';
      $expo .=  '          <th>FECHA</th>';
      $expo .=  '          <th>TIPO</th>';
      $expo .=  '          <th>VALOR</th>';
      $expo .=  '          <th>REFERENCIA</th>';
      $expo .=  '          <th>NRRECICAJA</th>';
      $expo .=  '          <th>INMUEBLE</th>';
      $expo .=  '          <th>TIPOPAGO</th>';
      $expo .=  '          <th>PERIODOPAGO</th>';
            $query = "SELECT  pagosid, pagosempresa, pagosfacturaid, pagosfecha, pagostipo, pagosvalor, pagosreferencia, pagosNrReciCaja, pagosinmueble, pagosTipoPago, pagosPeriodoPago" 
                    . " FROM contapagos ORDER BY pagosPeriodoPago ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['pagosid']. '</td> ';
                $expo .=  	'<td>' .$row['pagosempresa']. '</td> ';
                $expo .=  	'<td>' .$row['pagosfacturaid']. '</td> ';
                $expo .=  	'<td>' .$row['pagosfecha']. '</td> ';
                $expo .=  	'<td>' .$row['pagostipo']. '</td> ';
                $expo .=  	'<td>' .$row['pagosvalor']. '</td> ';
                $expo .=  	'<td>' .$row['pagosreferencia']. '</td> ';
                $expo .=  	'<td>' .$row['pagosNrReciCaja']. '</td> ';
                $expo .=  	'<td>' .$row['pagosinmueble']. '</td> ';
                $expo .=  	'<td>' .$row['pagosTipoPago']. '</td> ';
                $expo .=  	'<td>' .$row['pagosPeriodoPago']. '</td> ';
                 $expo .=  '</tr> '; 
                    } 
                } 
        $expo .=  '</table> ';  
        echo $expo; 
    return $expo; 
 } 
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(pagosid) as id 
                    FROM contapagos"; 
        $result = mysqli_query($con, $query); 
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
        $pagosid = $data->pagosid;      
        $query = "SELECT  pagosid, pagosempresa, pagosfacturaid, pagosfecha, pagostipo, pagosvalor, pagosreferencia, pagosNrReciCaja, pagosinmueble, pagosTipoPago, pagosPeriodoPago  " . 
                    " FROM contapagos  WHERE pagosid = " . $pagosid  . 
                    " ORDER BY pagosPeriodoPago "; 
        $result = mysqli_query($con, $query); 
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $arr[] = $row;
           } 
        } 
        echo $json_info = json_encode($arr); 
 
    } 
 
	 
    function lista0($data)
    { 
        global $objClase;
        $con = $objClase->conectar();
        $empresa = $data->empresa; 
        $query = "SELECT inmuebleId,  inmuebleDescripcion  FROM containmuebles " .
             " WHERE inmuebleEmpresaId = " . $empresa . " AND inmueblePrincipal = 'SI' ".
             " ORDER BY  inmuebleDescripcion ";   
    echo $query;
        $result = mysqli_query($con, $query); 
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)
        { 
            while($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
             }
        } 
      echo $json_info = json_encode($arr); 
    } 
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Nov 22, 2019 7:28:35   <<<<<<< 
