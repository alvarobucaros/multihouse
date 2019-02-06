<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);
if ($op == 'r' || $op == 'xls'){
    $cadena =  mysqli_real_escape_string($con,$data->cadena);
}

switch ($op)
{
    case 'r':
        leeRegistros($cadena);
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
    case 'xls':
        actualizaXls($cadena);
        break; 
    case 'exp':
        exportaXls($data);
        break; 
    case 'lr':
        leeRegistrosLst($data);
        break;
}
  
    function  leeRegistros($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
      $empresa = $data;
       { 
            $query = "SELECT  inmueble_id, inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, ".
                    " inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula, ".
                    " inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo " .
                    " FROM mm_inmuebles WHERE inmueble_empresa = '" . $empresa . "'   ORDER BY inmueble_codigo ";  
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

    function  leeRegistrosLst($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
      $empresa = $data;
       { 
            $query = "SELECT  inmueble_id, inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, ".
                    " inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula, ".
                    " inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo " .
                    " FROM mm_inmuebles WHERE inmueble_empresa = '" . $empresa . "'   ORDER BY inmueble_codigo ";  
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
        $inmueble_id = 0; 
        $query = "DELETE FROM mm_inmuebles WHERE inmueble_id=$data->inmueble_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $inmueble_id =  $data->inmueble_id; 
        $inmueble_empresa =  $data->inmueble_empresa; 
        $inmueble_codigo =  $data->inmueble_codigo; 
        $inmueble_descripcion =  $data->inmueble_descripcion; 
        $inmueble_area =  $data->inmueble_area; 
        $inmueble_coeficiente =  $data->inmueble_coeficiente; 
        $inmueble_ubicacion =  $data->inmueble_ubicacion; 
        $inmueble_propNombre =  $data->inmueble_propNombre; 
        $inmueble_propCedula =  $data->inmueble_propCedula; 
        $inmueble_propTelefonos =  $data->inmueble_propTelefonos; 
        $inmueble_propDireccion =  $data->inmueble_propDireccion; 
        $inmueble_propCorreo =  $data->inmueble_propCorreo; 
        $inmueble_Activo =  $data->inmueble_Activo; 
   
        if($inmueble_id  == 0) 
        { 
           $query = "INSERT INTO mm_inmuebles(inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, ".
                    " inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula, ".
                    " inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo)";
           $query .= "  VALUES ('" . $inmueble_empresa."', '".$inmueble_codigo."', '".$inmueble_descripcion."', '".$inmueble_area."', '".
                   $inmueble_coeficiente."', '".$inmueble_ubicacion."', '".$inmueble_propNombre."', '".$inmueble_propCedula."', '".
                   $inmueble_propTelefonos."', '".$inmueble_propDireccion."', '".$inmueble_propCorreo."', '".$inmueble_Activo."')";  
echo $query;
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_inmuebles  SET inmueble_empresa = '".$inmueble_empresa."', inmueble_codigo = '".$inmueble_codigo."', inmueble_descripcion = '".$inmueble_descripcion."', inmueble_area = '".$inmueble_area."', inmueble_coeficiente = '".$inmueble_coeficiente."', inmueble_ubicacion = '".$inmueble_ubicacion."', inmueble_propNombre = '".$inmueble_propNombre."', inmueble_propCedula = '".$inmueble_propCedula."', inmueble_propTelefonos = '".$inmueble_propTelefonos."', inmueble_propDireccion = '".$inmueble_propDireccion."', inmueble_propCorreo = '".$inmueble_propCorreo."', inmueble_Activo = '".$inmueble_Activo."' WHERE inmueble_id = ".$inmueble_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
 function actualizaXls($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $reg = explode ('||', $data);
        $n=0;
        $query = "SELECT count(comite_id) as n  FROM mm_comites  WHERE comite_nombre = '". $reg[12] ."'";      
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) { 
            $n = $row['n']; 
        }       

        if($n > 0) 
        {
            $query = "SELECT comite_id  FROM mm_comites  WHERE comite_nombre = '". $reg[12] ."'";
            $result = mysqli_query($con, $query); 
            while($row = mysqli_fetch_assoc($result)) { 
                $idComite = $row['comite_id']; 
            } 
        }
        else 
        {
            $query = "INSERT INTO mm_comites (comite_empresa, comite_nombre, comite_descripcion, comite_activo, comite_lider, " .
                   " comite_email, comite_consecActa) VALUES (". $reg[1].",'". $reg[12]."','". $reg[12]."','A','','',0)";

            $result = mysqli_query($con, $query);  
            $query = "SELECT last_insert_id() AS comite_id";
            $result = mysqli_query($con, $query);   
            if(mysqli_num_rows($result) != 0) 
            {
                while($row = mysqli_fetch_assoc($result)) { 
                    $idComite = $row['comite_id']; 
                } 
            }
        }
         
        $idInmueble=0;
        $query = "SELECT inmueble_id FROM mm_inmuebles WHERE inmueble_codigo = '" . $reg[2] ."'";
        $result = mysqli_query($con, $query);   
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                    $idInmueble = $row['inmueble_id']; 
                } 
            $query = "UPDATE mm_inmuebles  SET inmueble_empresa = '". $reg[1] ."', inmueble_codigo = '".$reg[2].
                    "', inmueble_descripcion = '".$reg[3]."', inmueble_area = '".$reg[4]."', inmueble_coeficiente = '".
                    $reg[5]."', inmueble_ubicacion = '".$reg[6]."', inmueble_propNombre = '".$reg[7]."', inmueble_propCedula = '".
                    $reg[8]."', inmueble_propTelefonos = '".$reg[9]."', inmueble_propDireccion = '".
                    $reg[10]."', inmueble_propCorreo = '".$reg[11]."', inmueble_Activo = '".$reg[14].
                    "', inmueble_comite = '". $idComite . "', inmueble_prinipal = '". $reg[13] .
                    "' WHERE inmueble_id = ".$idInmueble;

        }
        else{
           $query = "INSERT INTO mm_inmuebles(inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, ".
                   " inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula, inmueble_propTelefonos,  ".
                   " inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo,inmueble_comite,inmueble_prinipal) ".
                   "  VALUES ('" . $reg[1] ."', '". $reg[2] ."', '". $reg[3] ."', '". $reg[4] ."', '". $reg[5] ."', '".
                    $reg[6] . "', '". $reg[7] ."', '". $reg[8] ."', '". $reg[9] . "', '". $reg[10] . "', '". 
                   $reg[11] . "', '".  $reg[14]  . "', '". $idComite  . "', '". $reg[13]."')";  

        }

        mysqli_query($con, $query);
   echo 'OK';
 };    
    
 function exportaXls($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $empresa = $data->empresa;
       // $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=  "<th>CODIGO</th> ";
        $expo .=  "<th>DESCRIPCION</th> ";
        $expo .=  "<th>AREA</th> ";
        $expo .=  "<th>COEFICIENTE</th> ";
        $expo .=  "<th>UBICACION</th> ";
        $expo .=  "<th>NOMBRE PROPIETARIO</th> ";
        $expo .=  "<th>CEDULA</th> ";
        $expo .=  "<th>TELEFONO</th> ";
        $expo .=  "<th>DIRECCION</th> ";
        $expo .=  "<th>CORREO</th> ";
        $expo .=  "<th>COMITE</th> ";
        $expo .=  "<th>PRINCIPAL ?</th> ";
        $expo .=  "</tr> ";
        $query = "SELECT  inmueble_codigo, inmueble_descripcion, " .
                 " inmueble_area,  inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre,  " .
                 " inmueble_propCedula,  inmueble_propTelefonos, inmueble_propDireccion,  " .
                 " inmueble_propCorreo, comite_nombre, inmueble_prinipal  " .
                 " FROM mm_inmuebles INNER JOIN mm_comites  ON comite_id  = inmueble_comite " .
                 " WHERE inmueble_empresa = '" .$empresa .
                 "' ORDER BY inmueble_id ";         
        $result = mysqli_query($con, $query); 
         while($reg = mysqli_fetch_assoc($result))
        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".$reg["inmueble_codigo"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_descripcion"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_area"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_coeficiente"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_ubicacion"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_propNombre"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_propCedula"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_propTelefonos"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_propDireccion"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_propCorreo"]."</td> ";
            $expo .=  	"<td>".$reg["comite_nombre"]."</td> ";
            $expo .=  	"<td>".$reg["inmueble_prinipal"]."</td> ";           
            $expo .=  "</tr> ";
        }        
         $expo .=  "</table> "; 
         echo $expo;
    return $expo;
 }

 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $inmueble_id = $data->inmueble_id;      
        $query = "SELECT  inmueble_id, inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula, inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo  " . 
                    " FROM mm_inmuebles  WHERE inmueble_id = " . $inmueble_id  . 
                    " ORDER BY inmueble_codigo "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,May 09, 2018 5:51:23   <<<<<<< 
