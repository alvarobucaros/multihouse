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
            $query = "SELECT  clasificacionId, clasificacionEmpresaId, clasificacionCodigo, clasificacionDetalle" 
                    . " FROM contaclasificacion WHERE clasificacionEmpresaId = " . 
                    $empresa . " ORDER BY clasificacionDetalle ";    
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
        $query = "DELETE FROM contaclasificacion WHERE clasificacionId=$data->clasificacionId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $clasificacionId =  $data->clasificacionId; 
        $clasificacionEmpresaId =  $data->clasificacionEmpresaId; 
        $clasificacionCodigo =  $data->clasificacionCodigo; 
        $clasificacionDetalle =  $data->clasificacionDetalle; 
   
        if($clasificacionId  == 0) 
        { 
           $query = "INSERT INTO contaclasificacion(clasificacionEmpresaId, clasificacionCodigo, clasificacionDetalle)";
           $query .= "  VALUES ('" . $clasificacionEmpresaId."', '".$clasificacionCodigo."', '".$clasificacionDetalle."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contaclasificacion  SET clasificacionEmpresaId = '".$clasificacionEmpresaId."', clasificacionCodigo = '".$clasificacionCodigo."', clasificacionDetalle = '".$clasificacionDetalle."' WHERE clasificacionId = ".$clasificacionId;
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
      $expo .=  '          <th>DETALLE</th>';
            $query = "SELECT  clasificacionId, clasificacionEmpresaId, clasificacionCodigo, clasificacionDetalle" 
                    . " FROM contaclasificacion ORDER BY clasificacionDetalle ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['clasificacionId']. '</td> ';
                $expo .=  	'<td>' .$row['clasificacionEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['clasificacionCodigo']. '</td> ';
                $expo .=  	'<td>' .  utf8_encode($row['clasificacionDetalle']). '</td> ';
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
        $query = "SELECT  MAX(clasificacionId) as id 
                    FROM contaclasificacion"; 
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
        $clasificacionId = $data->clasificacionId;      
        $query = "SELECT  clasificacionId, clasificacionEmpresaId, clasificacionCodigo, clasificacionDetalle  " . 
                    " FROM contaclasificacion  WHERE clasificacionId = " . $clasificacionId  . 
                    " ORDER BY clasificacionDetalle "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 02, 2019 7:20:48   <<<<<<< 
