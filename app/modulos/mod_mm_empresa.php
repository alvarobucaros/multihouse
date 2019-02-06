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
    case 'l':
        leeUnaEmpresa();
        break;
}
  

 
    function  leeRegistros($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  empresa_id, empresa_nombre, empresa_nit, empresa_web, "
                    . "empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, "
                    . " empresa_autentica, empresa_lenguaje, empresa_versionPrd, "
                    . " empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, "
                    . " empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, "
                    . " empresa_intervaloCalendario, empresa_FormatoActa, empresa_cresidencial " 
                    . " FROM mm_empresa ORDER BY empresa_nombre ";             
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
        $empresa_id = 0; 
        $query = "DELETE FROM mm_empresa WHERE empresa_id=$data->empresa_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $empresa_id =  $data->empresa_id; 
        $empresa_nombre =  $data->empresa_nombre; 
        $empresa_nit =  $data->empresa_nit; 
        $empresa_web =  $data->empresa_web; 
        $empresa_direccion =  $data->empresa_direccion; 
        $empresa_telefonos =  $data->empresa_telefonos; 
        $empresa_ciudad =  $data->empresa_ciudad; 
        $empresa_logo =  $data->empresa_logo; 
        $empresa_autentica =  $data->empresa_autentica; 
        $empresa_lenguaje =  $data->empresa_lenguaje; 
        $empresa_versionPrd =  $data->empresa_versionPrd; 
        $empresa_versionBd =  $data->empresa_versionBd; 
        $empresa_clave =  $data->empresa_clave; 
        $empresa_email =  $data->empresa_email; 
        $empresa_registrsoXpagina =  $data->empresa_registrsoXpagina; 
        $empresa_diasTrabaja =  $data->empresa_diasTrabaja; 
        $empresa_horarioInicio =  $data->empresa_horarioInicio; 
        $empresa_horarioTermina =  $data->empresa_horarioTermina; 
        $empresa_intervaloCalendario =  $data->empresa_intervaloCalendario; 
        $empresa_FormatoActa =  $data->empresa_FormatoActa; 
        $empresa_cresidencial = $data->empresa_cresidencial;
        if($empresa_id  == 0) 
        { 
           $query = "INSERT INTO mm_empresa(empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, ".
                   " empresa_logo, empresa_autentica, empresa_lenguaje, empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, ".
                   " empresa_registrsoXpagina, empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario, ".
                   " empresa_FormatoActa, empresa_cresidencial)";
           $query .= "  VALUES ('" . $empresa_nombre."', '".$empresa_nit."', '".$empresa_web."', '".$empresa_direccion."', '".
                   $empresa_telefonos."', '".$empresa_ciudad."', '".$empresa_logo."', '".$empresa_autentica."', '".$empresa_lenguaje."', '".
                   $empresa_versionPrd."', '".$empresa_versionBd."', '".$empresa_clave."', '".$empresa_email."', '".
                   $empresa_registrsoXpagina."', '".$empresa_diasTrabaja."', '".$empresa_horarioInicio."', '".$empresa_horarioTermina."', '".
                   $empresa_intervaloCalendario."', '".$empresa_FormatoActa."', '".$empresa_cresidencial."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_empresa  SET empresa_nombre = '".$empresa_nombre."', empresa_nit = '".$empresa_nit.
                    "', empresa_web = '".$empresa_web."', empresa_direccion = '".$empresa_direccion."', empresa_telefonos = '".$empresa_telefonos.
                    "', empresa_ciudad = '".$empresa_ciudad."', empresa_logo = '".$empresa_logo."', empresa_autentica = '".$empresa_autentica.
                    "', empresa_lenguaje = '".$empresa_lenguaje."', empresa_versionPrd = '".$empresa_versionPrd.
                    "', empresa_versionBd = '".$empresa_versionBd."', empresa_clave = '".$empresa_clave.
                    "', empresa_email = '".$empresa_email."', empresa_registrsoXpagina = '".$empresa_registrsoXpagina.
                    "', empresa_diasTrabaja = '".$empresa_diasTrabaja."', empresa_horarioInicio = '".$empresa_horarioInicio.
                    "', empresa_horarioTermina = '".$empresa_horarioTermina."', empresa_intervaloCalendario = '".$empresa_intervaloCalendario.
                    "', empresa_FormatoActa = '".$empresa_FormatoActa.
                    "', empresa_cresidencial = '".$empresa_cresidencial.
                    "' WHERE empresa_id = ".$empresa_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $empresa_id = $data->empresa_id;      
        $query = "SELECT  empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, ".
                " empresa_logo, empresa_autentica, empresa_lenguaje, empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, ".
                " empresa_registrsoXpagina, empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario, ".
                " empresa_FormatoActa, empresa_cresidencial  " . 
                " FROM mm_empresa  WHERE empresa_id = " . $empresa_id  . 
                " ORDER BY empresa_nombre "; 
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

    function leeUnaEmpresa()
    {  
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
            $query = "SELECT  empresa_id, empresa_nombre, empresa_nit, empresa_web, "
                    . "empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, "
                    . " empresa_autentica, empresa_lenguaje, empresa_versionPrd, "
                    . " empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, "
                    . " empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, "
                    . " empresa_intervaloCalendario, empresa_FormatoActa, empresa_cresidencial " 
                    . " FROM mm_empresa ORDER BY empresa_nombre ";     
        $result = mysqli_query($con, $query); 
        
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $arr[] = $row;
           } 
        }
       
        echo $json_info = json_encode($arr); 
        echo '.';
    }    
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 23, 2017 9:07:44   <<<<<<< 
