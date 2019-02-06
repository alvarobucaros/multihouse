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
}
  

 
    function  leeRegistros($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  perfil_id, perfil_empresa, perfil_numero, perfil_codigo, perfil_nombre, perfil_activo" 
                    . " FROM mm_perfiles ORDER BY perfil_codigo ";             
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
        $perfil_id = 0; 
        $query = "DELETE FROM mm_perfiles WHERE perfil_id=$data->perfil_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $perfil_id =  $data->perfil_id; 
        $perfil_empresa =  $data->perfil_empresa; 
        $perfil_numero =  $data->perfil_numero; 
        $perfil_codigo =  $data->perfil_codigo; 
        $perfil_nombre =  $data->perfil_nombre; 
        $perfil_activo =  $data->perfil_activo; 
   
        if($perfil_id  == 0) 
        { 
           $query = "INSERT INTO mm_perfiles(perfil_empresa, perfil_numero, perfil_codigo, perfil_nombre, perfil_activo)";
           $query .= "  VALUES ('" . $perfil_empresa."', '".$perfil_numero."', '".$perfil_codigo."', '".$perfil_nombre."', '".$perfil_activo."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_perfiles  SET perfil_empresa = '".$perfil_empresa."', perfil_numero = '".$perfil_numero."', perfil_codigo = '".$perfil_codigo."', perfil_nombre = '".$perfil_nombre."', perfil_activo = '".$perfil_activo."' WHERE perfil_id = ".$perfil_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $perfil_id = $data->perfil_id;      
        $query = "SELECT  perfil_id, perfil_empresa, perfil_numero, perfil_codigo, perfil_nombre, perfil_activo  " . 
                    " FROM mm_perfiles  WHERE perfil_id = " . $perfil_id  . 
                    " ORDER BY perfil_codigo "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,May 17, 2018 12:00:26   <<<<<<< 
