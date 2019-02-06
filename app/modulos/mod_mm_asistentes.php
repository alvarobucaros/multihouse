
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
    case '0':
        lista0($data);
        break;
    case '1':
        lista1($data);
        break;
    case 'su':
        seleccionaUsuario($data);
    break;
}
  

 
    function  leeRegistros($data) 
    { 
      $empresa = $data->empresa;
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  asistente_id, asistente_comite, comite_nombre, asistente_usuarioId, ".
                "CASE asistente_usuarioId WHEN 0 THEN 'NO' ELSE 'SI' END  AS usuario_nombre, asistente_nombre, ".
                " asistente_empresa, asistente_cargo, asistente_celuar, asistente_email, " .
                " CASE  WHEN asistente_titulo = 'P' THEN 'Presidente' WHEN  asistente_titulo = 'S' THEN 'Secretario' WHEN asistente_titulo ='T' THEN 'Transcriptor' ELSE '' END AS asistente_titulo  ".             
		" FROM mm_asistentes INNER JOIN mm_comites ON asistente_comite = comite_id  WHERE asistente_empresaId = '" .  $empresa ."' " .     
                " ORDER BY comite_nombre, asistente_nombre";  
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
        $asistente_id = 0; 
        $query = "DELETE FROM mm_asistentes WHERE asistente_id=$data->asistente_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {    
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();       	 
        $asistente_id =  $data->asistente_id; 
        $asistente_comiteId =  $data->asistente_comite;
        $asistente_usuarioId =  $data->asistente_usuarioId; 
        $asistente_nombre =  $data->asistente_nombre; 
        $asistente_empresa =  $data->asistente_empresa; 
        $asistente_cargo =  $data->asistente_cargo; 
        $asistente_celuar =  $data->asistente_celuar; 
        $asistente_email =  $data->asistente_email; 
        $empresa = $data->asistente_empresaId;
        $asistente_titulo =  $data->asistente_titulo;
      
        if($asistente_id  == 0) 
        { 
            $condicions = "asistente_empresaId = " . $empresa . " AND "
                   . "asistente_comite = " . $asistente_comiteId ." AND asistente_nombre = '".$asistente_nombre ."' ";
            $rowcount = $objClase->cuentaRegistros('mm_asistentes', $condicions);          
           if($rowcount==0){
           $query = "INSERT INTO mm_asistentes(asistente_comite, asistente_usuarioId, asistente_nombre, ".
                    " asistente_empresa, asistente_cargo, asistente_celuar, asistente_email, asistente_empresaId, asistente_titulo)";
           $query .= "  VALUES ('" . $asistente_comiteId."', '".$asistente_usuarioId."', '".
                   $asistente_nombre."', '".$asistente_empresa."', '".$asistente_cargo."', '".
                   $asistente_celuar."', '".$asistente_email."'," . $empresa . ",'" . $asistente_titulo. "')";          
           mysqli_query($con, $query);
           echo 'Ok';
           }
           else
           {
               echo 'Ya se ha creado un asistente con este nombre para este comite '; 
           }
        } 
        else 
        { 
            $query = "UPDATE mm_asistentes  SET asistente_comite = '".$asistente_comiteId.
                    "', asistente_usuarioId = '".$asistente_usuarioId."', asistente_nombre = '".$asistente_nombre.
                    "', asistente_empresa = '".$asistente_empresa."', asistente_cargo = '".$asistente_cargo.
                    "', asistente_celuar = '".$asistente_celuar."', asistente_email = '".$asistente_email.
                    "',  asistente_titulo = '".$asistente_titulo.
                    "' WHERE asistente_id = ".$asistente_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        }
   //echo $query;     
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $asistente_id = $data->asistente_id;      
    $query = "SELECT  asistente_id, asistente_comite, asistente_usuarioId, asistente_nombre, asistente_empresa, " .
            " asistente_cargo, asistente_celuar, asistente_email, asistente_titulo  " . 
                    " FROM mm_asistentes  WHERE asistente_id = " . $asistente_id  . 
                    " ORDER BY asistente_comite "; 
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
 	 
    function lista0($data) 
    { 
        $empresa = $data->empresa;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
         $query = "SELECT comite_id,  comite_nombre FROM mm_comites  WHERE  comite_Activo = 'A' AND comite_empresa = ".$empresa .
                 " ORDER BY comite_nombre";  
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
 
    function lista1($data) 
    { 
        $empresa = $data->empresa;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
         $query = "SELECT usuario_id, usuario_nombre FROM mm_usuarios WHERE usuario_estado ='A' AND usuario_empresa = " . 
                 $empresa. " ORDER BY usuario_nombre";
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
 
    function seleccionaUsuario($data)
    {  
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $query = "SELECT usuario_nombre, usuario_empresa, empresa_nombre, usuario_email, usuario_celular, usuario_titulo " .
                 " FROM mm_usuarios, mm_empresa ".
                 " WHERE  empresa_id = usuario_empresa AND usuario_id = ". $data->asistente_usuarioId;
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
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Oct 27, 2017 7:40:45   <<<<<<< 
