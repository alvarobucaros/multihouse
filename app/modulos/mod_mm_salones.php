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
      $empresa =  $data->empresa;
       { 
            $query = "SELECT  salon_id, salon_empresa, salon_nombre, salon_ubicacion, salon_capacidad, salon_apoyovisual, salon_responsable, salon_activo, salon_observaciones" 
                    . " FROM mm_salones WHERE salon_empresa = " .  $empresa . " ORDER BY salon_nombre "; 
      
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
        $info ='Ok'; 
        $query = "DELETE FROM mm_salones WHERE salon_id=$data->salon_id"; 
        mysqli_query($con, $query); 
        $err = mysqli_errno($con);
        if($err == '1451'){$info='No se puede borrar, este  se encuentra en una agenda, para no usuarlo se puede inhabilitar';}
        echo $info; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $salon_id =  $data->salon_id; 
        $salon_empresa =  $data->salon_empresa; 
        $salon_nombre =  $data->salon_nombre; 
        $salon_ubicacion =  $data->salon_ubicacion; 
        $salon_capacidad =  $data->salon_capacidad; 
        $salon_apoyovisual =  $data->salon_apoyovisual; 
        $salon_responsable =  $data->salon_responsable; 
        $salon_activo =  $data->salon_activo; 
        $salon_observaciones =  $data->salon_observaciones; 
   
        if($salon_id  == 0) 
        {  
            $condicion = "salon_empresa = '" . $salon_empresa . 
                   "' AND salon_nombre = '" .$salon_nombre."' ";
            $nr = $objClase->cuentaRegistros('mm_salones', $condicion);
            if($nr==0)
            {
                $query = "INSERT INTO mm_salones(salon_empresa, salon_nombre, salon_ubicacion, salon_capacidad, salon_apoyovisual, salon_responsable, salon_activo, salon_observaciones)";
                $query .= "  VALUES ('" . $salon_empresa."', '".$salon_nombre."', '".$salon_ubicacion."', '".$salon_capacidad."', '".$salon_apoyovisual."', '".$salon_responsable."', '".$salon_activo."', '".$salon_observaciones."')";  
                mysqli_query($con, $query);
                echo 'Ok';
             }else{ echo 'Ya existe este salon '.$salon_nombre;}
        } 
        else 
        { 
            $query = "UPDATE mm_salones  SET salon_empresa = '".$salon_empresa."', salon_nombre = '".$salon_nombre."', salon_ubicacion = '".$salon_ubicacion."', salon_capacidad = '".$salon_capacidad."', salon_apoyovisual = '".$salon_apoyovisual."', salon_responsable = '".$salon_responsable."', salon_activo = '".$salon_activo."', salon_observaciones = '".$salon_observaciones."' WHERE salon_id = ".$salon_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $salon_id = $data->salon_id;      
        $query = "SELECT  salon_id, salon_empresa, salon_nombre, salon_ubicacion, salon_capacidad, salon_apoyovisual, salon_responsable, salon_activo, salon_observaciones  " . 
                    " FROM mm_salones  WHERE salon_id = " . $salon_id  . 
                    " ORDER BY salon_nombre "; 
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
 
	 
// >>>>>>>   Creado por:   Alvaro Ortiz Wednesday,Oct 26, 2016 3:38:47   <<<<<<< 
