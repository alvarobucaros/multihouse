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
       global $objClase;
      $con = $objClase->conectar(); 
       { 
           $empresa =  $data->empresa;
            $query = "SELECT  propietarioId, propietarioEmpresaId, propietarioNombre, propietarioCedula, " .
                    " propietarioTelefonos, propietarioDireccion, propietarioCorreo, " .
                    " propietarioActivo " .
                    " FROM contapropietarios where propietarioEmpresaId = " . $empresa .
                    " ORDER BY propietarioNombre ";             
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
        $query = "DELETE FROM contapropietarios WHERE propietarioId=$data->propietarioId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $propietarioId =  $data->propietarioId; 
        $propietarioEmpresaId =  $data->propietarioEmpresaId; 
        $propietarioNombre =  $data->propietarioNombre; 
        $propietarioCedula =  $data->propietarioCedula; 
        $propietarioTelefonos =  $data->propietarioTelefonos; 
        $propietarioDireccion =  $data->propietarioDireccion; 
        $propietarioCorreo =  $data->propietarioCorreo; 
        $propietarioActivo =  $data->propietarioActivo; 
   
        if($propietarioId  == 0) 
        { 
           $query = "INSERT INTO contapropietarios(propietarioEmpresaId, propietarioNombre, propietarioCedula, propietarioTelefonos, propietarioDireccion, propietarioCorreo, propietarioActivo)";
           $query .= "  VALUES ('" . $propietarioEmpresaId."', '".$propietarioNombre."', '".$propietarioCedula."', '".$propietarioTelefonos."', '".$propietarioDireccion."', '".$propietarioCorreo."', '".$propietarioActivo."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contapropietarios  SET propietarioEmpresaId = '".$propietarioEmpresaId."', propietarioNombre = '".$propietarioNombre."', propietarioCedula = '".$propietarioCedula."', propietarioTelefonos = '".$propietarioTelefonos."', propietarioDireccion = '".$propietarioDireccion."', propietarioCorreo = '".$propietarioCorreo."', propietarioActivo = '".$propietarioActivo."' WHERE propietarioId = ".$propietarioId;
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
      $expo .=  '          <th>NOMBRE</th>';
      $expo .=  '          <th>CEDULA</th>';
      $expo .=  '          <th>TELEFONOS</th>';
      $expo .=  '          <th>DIRECCION</th>';
      $expo .=  '          <th>E-MAIL</th>';
      $expo .=  '          <th>ACTIVO</th>';
            $query = "SELECT  propietarioId, propietarioEmpresaId, propietarioNombre, propietarioCedula, " .
                    " propietarioTelefonos, propietarioDireccion, propietarioCorreo, propietarioActivo" .
                    " FROM contapropietarios where propietarioEmpresaId = " . $empresa . 
                    "ORDER BY propietarioNombre ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['propietarioId']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioNombre']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioCedula']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioTelefonos']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioDireccion']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioCorreo']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioActivo']. '</td> ';
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
        $query = "SELECT  MAX(propietarioId) as id 
                    FROM contapropietarios"; 
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
        $propietarioId = $data->propietarioId;      
        $query = "SELECT  propietarioId, propietarioEmpresaId, propietarioNombre, propietarioCedula, propietarioTelefonos, propietarioDireccion, propietarioCorreo, propietarioActivo  " . 
                    " FROM contapropietarios  WHERE propietarioId = " . $propietarioId  . 
                    " ORDER BY propietarioNombre "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 03, 2019 8:17:09   <<<<<<< 
