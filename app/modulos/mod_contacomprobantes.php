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
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
      $empresa =  $data->empresa;
       { 
            $query = "SELECT  compId, compEmpresaId, compCodigo, compNombre, compConsecutivo, " .
                    " compActivo, compDetalle" .
                    " FROM contacomprobantes " .
                    " WHERE compEmpresaId = " . $empresa . " ORDER BY compNombre ";             
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
        $query = "DELETE FROM contacomprobantes WHERE compId=$data->compId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $compId =  $data->compId; 
        $compEmpresaId =  $data->compEmpresaId; 
        $compCodigo =  $data->compCodigo; 
        $compNombre =  $data->compNombre; 
        $compConsecutivo =  $data->compConsecutivo; 
        $compActivo =  $data->compActivo; 
        $compDetalle =  $data->compDetalle; 
   
        if($compId  == 0) 
        { 
           $query = "INSERT INTO contacomprobantes(compEmpresaId, compCodigo, compNombre, compConsecutivo, compActivo, compDetalle)";
           $query .= "  VALUES ('" . $compEmpresaId."', '".$compCodigo."', '".$compNombre."', '".$compConsecutivo."', '".$compActivo."', '".$compDetalle."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contacomprobantes  SET compEmpresaId = '".$compEmpresaId."', compCodigo = '".$compCodigo."', compNombre = '".$compNombre."', compConsecutivo = '".$compConsecutivo."', compActivo = '".$compActivo."', compDetalle = '".$compDetalle."' WHERE compId = ".$compId;
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
      $expo .=  '          <th>CODIGO</th>';
      $expo .=  '          <th>NOMBRE</th>';
      $expo .=  '          <th>SECUENCIA</th>';
      $expo .=  '          <th>ACTIVO</th>';
      $expo .=  '          <th>DETALLE</th>';
            $query = "SELECT  compId, compEmpresaId, compCodigo, compNombre, compConsecutivo, " .
                    " compActivo, compDetalle" .
                    " FROM contacomprobantes " .
                    " WHERE compEmpresaId = " . $empresa . " ORDER BY compNombre ";               
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['compId']. '</td> ';
                $expo .=  	'<td>' .$row['compEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['compCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['compNombre']. '</td> ';
                $expo .=  	'<td>' .$row['compConsecutivo']. '</td> ';
                $expo .=  	'<td>' .$row['compActivo']. '</td> ';
                $expo .=  	'<td>' .$row['compDetalle']. '</td> ';
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
        $query = "SELECT  MAX(compId) as id 
                    FROM contacomprobantes"; 
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
        $compId = $data->compId;      
        $query = "SELECT  compId, compEmpresaId, compCodigo, compNombre, compConsecutivo, compActivo, compDetalle  " . 
                    " FROM contacomprobantes  WHERE compId = " . $compId  . 
                    " ORDER BY compNombre "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 10:33:12   <<<<<<< 
