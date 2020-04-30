<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
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
        $empresa = $data->empresa; 
        global $objClase;
        $con = $objClase->conectar(); 
        { 
            $query = "SELECT  tipoId, tipoEmpresa, tipoCodigo, tipoDetalle, tipoEstado" 
                    . " FROM contatipoinforme WHERE tipoEmpresa = " . 
                    $empresa . "  ORDER BY tipoDetalle ";             
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
        $query = "DELETE FROM contatipoinforme WHERE tipoId=$data->tipoId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $tipoId =  $data->tipoId; 
        $tipoEmpresa =  $data->tipoEmpresa; 
        $tipoCodigo =  $data->tipoCodigo; 
        $tipoDetalle =  $data->tipoDetalle; 
        $tipoEstado =  $data->tipoEstado; 
   
        if($tipoId  == 0) 
        { 
           $query = "INSERT INTO contatipoinforme(tipoEmpresa, tipoCodigo, tipoDetalle, tipoEstado)";
           $query .= "  VALUES ('" . $tipoEmpresa."', '".$tipoCodigo."', '".$tipoDetalle."', '".$tipoEstado."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contatipoinforme  SET tipoEmpresa = '".$tipoEmpresa."', tipoCodigo = '".$tipoCodigo."', tipoDetalle = '".$tipoDetalle."', tipoEstado = '".$tipoEstado."' WHERE tipoId = ".$tipoId;
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
      $expo .=  '          <th>ESTADO</th>';
            $query = "SELECT  tipoId, tipoEmpresa, tipoCodigo, tipoDetalle, tipoEstado" 
                    . " FROM contatipoinforme ORDER BY tipoDetalle ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['tipoId']. '</td> ';
                $expo .=  	'<td>' .$row['tipoEmpresa']. '</td> ';
                $expo .=  	'<td>' .$row['tipoCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['tipoDetalle']. '</td> ';
                $expo .=  	'<td>' .$row['tipoEstado']. '</td> ';
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
        $query = "SELECT  MAX(tipoId) as id 
                    FROM contatipoinforme"; 
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
        $tipoId = $data->tipoId;      
        $query = "SELECT  tipoId, tipoEmpresa, tipoCodigo, tipoDetalle, tipoEstado  " . 
                    " FROM contatipoinforme  WHERE tipoId = " . $tipoId  . 
                    " ORDER BY tipoDetalle "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Mar 09, 2020 8:14:22   <<<<<<< 
