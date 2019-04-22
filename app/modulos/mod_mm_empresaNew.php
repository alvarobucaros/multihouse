<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('atominge_mmeetingt','127,0,0,1','root','');
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
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje, empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario, empresa_FormatoActa, empresa_cresidencial, empresa_ctrl" 
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
       global $objClase;
        $con = $objClase->conectar(); 
        $query = "DELETE FROM mm_empresa WHERE empresa_id=$data->empresa_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;
        $version = date('Y').$data->empresa_clave;;
        $celular =  $data->empresa_ctrl; 
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
        $empresa_versionPrd =  $version.'Prd'; 
        $empresa_versionBd =  $version.'Bd'; 
        $empresa_clave =  $data->empresa_clave; 
        $empresa_email =  $data->empresa_email; 
        $empresa_registrsoXpagina =  $data->empresa_registrsoXpagina; 
        $empresa_diasTrabaja =  $data->empresa_diasTrabaja; 
        $empresa_horarioInicio =  $data->empresa_horarioInicio; 
        $empresa_horarioTermina =  $data->empresa_horarioTermina; 
        $empresa_intervaloCalendario =  $data->empresa_intervaloCalendario; 
        $empresa_FormatoActa =  $data->empresa_FormatoActa; 
        $empresa_cresidencial =  $data->empresa_cresidencial; 
        $empresa_ctrl = 'wefB875s13846s12518refd8624A12';// $data->empresa_ctrl; 
        $fechaActual = date('Y-m-d');
        if($empresa_id  == 0) 
        { 
            $query = "INSERT INTO mm_empresa(empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje, empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario, empresa_FormatoActa, empresa_cresidencial, empresa_ctrl)";
            $query .= "  VALUES ('" . $empresa_nombre."', '".$empresa_nit."', '".$empresa_web."', '".$empresa_direccion."', '".$empresa_telefonos."', '".$empresa_ciudad."', '".$empresa_logo."', '".$empresa_autentica."', '".$empresa_lenguaje."', '".$empresa_versionPrd."', '".$empresa_versionBd."', '".$empresa_clave."', '".$empresa_email."', '".$empresa_registrsoXpagina."', '".$empresa_diasTrabaja."', '".$empresa_horarioInicio."', '".$empresa_horarioTermina."', '".$empresa_intervaloCalendario."', '".$empresa_FormatoActa."', '".$empresa_cresidencial."', '".$empresa_ctrl."')";  
            mysqli_query($con, $query);
            $query = "SELECT last_insert_id() AS empresa_id";
            $result = mysqli_query($con, $query);   
            if(mysqli_num_rows($result) != 0) 
            {
                while($row = mysqli_fetch_assoc($result)) { 
                    $empresa_id = $row['empresa_id']; 
                } 
            }
            $query = "INSERT INTO mm_perfiles (perfil_empresa, perfil_codigo, perfil_nombre, perfil_activo) ".
                     " VALUES ('" . $empresa_id ."', '1', 'GENERAL', 'A')";
             $result = mysqli_query($con, $query); 
            
            $query = "INSERT INTO mm_usuarios(usuario_nombre, usuario_empresa, usuario_email, usuario_password, ".
                " usuario_tipo_acceso, usuario_fechaCreado, usuario_fechaActualizado, usuario_estado, ".
                " usuario_perfil, usuario_avatar, usuario_user, usuario_celular)";
             $query .= "  VALUES ('" . $empresa_clave."', '".$empresa_id."', '".$empresa_email."', '".
                md5('123')."', 'A', '".$fechaActual."', '".
                $fechaActual."', 'A', '1', 'avatar.png', '".
                $empresa_clave."', '".$celular."')";         
        mysqli_query($con, $query); 
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_empresa  SET empresa_nombre = '".$empresa_nombre."', empresa_nit = '".$empresa_nit."', empresa_web = '".$empresa_web."', empresa_direccion = '".$empresa_direccion."', empresa_telefonos = '".$empresa_telefonos."', empresa_ciudad = '".$empresa_ciudad."', empresa_logo = '".$empresa_logo."', empresa_autentica = '".$empresa_autentica."', empresa_lenguaje = '".$empresa_lenguaje."', empresa_versionPrd = '".$empresa_versionPrd."', empresa_versionBd = '".$empresa_versionBd."', empresa_clave = '".$empresa_clave."', empresa_email = '".$empresa_email."', empresa_registrsoXpagina = '".$empresa_registrsoXpagina."', empresa_diasTrabaja = '".$empresa_diasTrabaja."', empresa_horarioInicio = '".$empresa_horarioInicio."', empresa_horarioTermina = '".$empresa_horarioTermina."', empresa_intervaloCalendario = '".$empresa_intervaloCalendario."', empresa_FormatoActa = '".$empresa_FormatoActa."', empresa_cresidencial = '".$empresa_cresidencial."', empresa_ctrl = '".$empresa_ctrl."' WHERE empresa_id = ".$empresa_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function creaUsuario($usu,$emp,$celular){
   
        $usuario_nombre =  $usu; 
        $usuario_empresa =  $emp; 
        $fechaActual = date('Y-m-d');
        $usuario_email =  $data->usuario_email; 
        $usuario_password =  md5('123'); 
        $usuario_tipo_acceso =  'A'; 
        $usuario_fechaCreado = $fechaActual; 
        $usuario_fechaActualizado = $fechaActual; 
        $usuario_estado =  'A';  
        $usuario_perfil =  1; 
        $usuario_avatar = 'avatar.png'; 
        $usuario_user =  $usu; 
        $usuario_celular =  $celular; 

    }
    
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(empresa_id) as id 
                    FROM mm_empresa"; 
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
        $empresa_id = $data->empresa_id;      
        $query = "SELECT  empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje, empresa_versionPrd, empresa_versionBd, empresa_clave, empresa_email, empresa_registrsoXpagina, empresa_diasTrabaja, empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario, empresa_FormatoActa, empresa_cresidencial, empresa_ctrl  " . 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Apr 20, 2019 3:15:22   <<<<<<< 
