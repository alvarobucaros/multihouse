<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);
//print_r($data);
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
}
  

 
    function  leeRegistros($data) 
    { 
      $empresa =  $data->grupo_empresa; 
     // $grupo_empresa =  $data->grupo_empresa; 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            
            $query = " SELECT  grupo_id, grupo_empresa, grupo_nombre, grupo_detalle, grupo_comite, " .
                    " comite_nombre, grupo_activo FROM mm_grupos INNER JOIN mm_comites ".
                    " ON grupo_comite = comite_id AND grupo_empresa = comite_empresa" .
                    "  WHERE  grupo_empresa = " . $empresa . 
                    " ORDER BY grupo_nombre " ;
//echo $query;            
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
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $grupo_id = 0; 
        $query = "DELETE FROM mm_grupos WHERE grupo_id=$data->grupo_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $grupo_id =  $data->grupo_id; 
        $grupo_empresa =  $data->grupo_empresa; 
        $grupo_nombre =  $data->grupo_nombre; 
        $grupo_detalle =  $data->grupo_detalle; 
        $grupo_comite =  $data->grupo_comite; 
        $grupo_activo =  $data->grupo_activo; 
   
        if($grupo_id  == 0) 
        { 
           $query = "INSERT INTO mm_grupos(grupo_empresa, grupo_nombre, grupo_detalle, grupo_comite, grupo_activo)";
           $query .= "  VALUES ('" . $grupo_empresa."', '".$grupo_nombre."', '".$grupo_detalle."', '".$grupo_comite."', '".$grupo_activo."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_grupos  SET grupo_empresa = '".$grupo_empresa."', grupo_nombre = '".$grupo_nombre."', grupo_detalle = '".$grupo_detalle."', grupo_comite = '".$grupo_comite."', grupo_activo = '".$grupo_activo."' WHERE grupo_id = ".$grupo_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $grupo_id = $data->grupo_id;      
        $query = "SELECT  grupo_id, grupo_empresa, grupo_nombre, grupo_detalle, grupo_comite, grupo_activo  " . 
                    " FROM mm_grupos  WHERE grupo_id = " . $grupo_id  . 
                    " ORDER BY grupo_nombre "; 
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
 
	 
// >>>>>>>   Creado por:   Alvaro Ortiz Friday,Oct 28, 2016 8:47:23   <<<<<<< 
