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
        $perini = $data->fi;
        $perfin = $data->ff;
        $empresa = $data->empresa;
        $saldo = 0;
        $codi= " ingastotipo NOT IN ('C') AND ingastoempresa =  " .$empresa ;
        if ($perini != ''){ $codi .= " AND ingastoperiodo >= ".$perini;}
        if ($perfin != ''){ $codi .= " AND ingastoperiodo <= ".$perfin;}
        { 
            $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, ingastocomprobante," . 
                    " ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, 0 AS saldo" .
                    " FROM containgregastos WHERE " .$codi .
                    " ORDER BY ingastoFecha ";             
            $result = mysqli_query($con, $query); 
            $arr = array(); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                        if($row['ingastotipo']=='I' || $row['ingastotipo']=='A'){$saldo = $saldo + $row['ingastovalor']; }
                        else {$saldo = $saldo - $row['ingastovalor']; }
                        $row['saldo'] = $saldo;
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
        $query = "DELETE FROM containgregastos WHERE ingastoid=$data->ingastoid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $ingastoid =  $data->ingastoid; 
        $ingastoempresa =  $data->ingastoempresa; 
        $ingastoFecha =  $data->ingastoFecha; 
        $ingastoperiodo =  $data->ingastoperiodo; 
        $ingastotipo =  $data->ingastotipo; 
        $ingastocomprobante =  $data->ingastocomprobante; 
        $ingastodetalle =  $data->ingastodetalle; 
        $ingastovalor =  $data->ingastovalor; 
        $ingastocontabiliza =  $data->ingastocontabiliza; 
        $ingastoDocumento  =  $data->ingastoDocumento; 
        if($ingastoid  == 0) 
        { 
           $query = "INSERT INTO containgregastos(ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " .
                   " ingastocomprobante, ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza)" .
                   " VALUES ('" . $ingastoempresa."', '".$ingastoFecha."', '".$ingastoperiodo."', '".
                   $ingastotipo."', '".$ingastocomprobante."', '".$ingastodetalle."', '". $ingastoDocumento."', '".
                   $ingastovalor."', '".$ingastocontabiliza."')";  
            mysqli_query($con, $query);

            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE containgregastos  SET ingastoempresa = '".$ingastoempresa."', ingastoFecha = '".
                    $ingastoFecha."', ingastoperiodo = '".$ingastoperiodo."', ingastotipo = '".
                    $ingastotipo."', ingastocomprobante = '".$ingastocomprobante."', ingastodetalle = '".
                    $ingastodetalle. "', ingastoDocumento = '".$ingastoDocumento. "', ingastovalor = '".
                    $ingastovalor."', ingastocontabiliza = '".
                    $ingastocontabiliza."' WHERE ingastoid = ".$ingastoid;
            mysqli_query($con, $query); 
           
            echo 'Ok';
        } 
 
    } 
 
 function exportaXls($data){ 
       global $objClase;
        $con = $objClase->conectar(); 
        $empresa = $data->empresa; 
        $periIni= $data->fi;
        $periFin= $data->ff;
        $expo=''; 
        $expo .= '<table border=1 class="table2Excel"> '; 
        $expo .=  '<tr> '; 
        $expo .=  '          <th>ID</th>';
        $expo .=  '          <th>EMPRESA</th>';
        $expo .=  '          <th>FECHA</th>';
        $expo .=  '          <th>PERIODO</th>';
        $expo .=  '          <th>TIPO</th>';
        $expo .=  '          <th>COMPROBANTE</th>';
        $expo .=  '          <th>DETALLE</th>';
        $expo .=  '          <th>DOCUMENTO</th>';
        $expo .=  '          <th>VALOR</th>';
        $expo .=  '          <th>CONTABILIZA</th>';
            $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, " .
                    " CASE ingastotipo WHEN 'I' THEN 'Ingreso' ELSE 'Gasto' END ingastotipo, ingastocomprobante," . 
                    " ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, 0 AS saldo" .
                    " FROM containgregastos WHERE ingastotipo IN ('I','G') AND ingastoempresa =  " .$empresa .
                    " AND ( ingastoperiodo >= '" . $periIni ."' AND ingastoperiodo <= '".$periFin . "') ".
                    " ORDER BY ingastoFecha ";              
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['ingastoid']. '</td> ';
                $expo .=  	'<td>' .$row['ingastoempresa']. '</td> ';
                $expo .=  	'<td>' .$row['ingastoFecha']. '</td> ';
                $expo .=  	'<td>' .$row['ingastoperiodo']. '</td> ';
                $expo .=  	'<td>' .$row['ingastotipo']. '</td> ';
                $expo .=  	'<td>' .$row['ingastocomprobante']. '</td> ';  
                $expo .=  	'<td>' .$row['ingastoDocumento']. '</td> ';  
                $expo .=  	'<td>' .$row['ingastodetalle']. '</td> ';
                $expo .=  	'<td>' .$row['ingastovalor']. '</td> ';
                $expo .=  	'<td>' .$row['ingastocontabiliza']. '</td> ';
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
        $query = "SELECT  MAX(ingastoid) as id 
                    FROM containgregastos"; 
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
        $ingastoid = $data->ingastoid;      
        $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, ingastocomprobante, ".
                " ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza  " . 
                    " FROM containgregastos  WHERE ingastoid = " . $ingastoid  . 
                    " ORDER BY ingastoFecha "; 
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
       $empresa = $data->empresa; 
        $con = $objClase->conectar();	 
         $query = "SELECT compId,  compNombre FROM contacomprobantes ".
         " WHERE compEmpresaId = " . $empresa . " AND compActivo IN ('I','E') ORDER BY  compNombre";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Nov 27, 2019 1:57:50   <<<<<<< 
