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
            $query = "SELECT  usuario_id, usuario_empresa, usuario_nombre, usuario_email, usuario_celular, ".
                    " usuario_password, CASE usuario_tipo_acceso WHEN 'S' THEN 'Super' WHEN 'A' THEN 'Admin' " .
                    " WHEN 'K' THEN 'Ctble' ELSE 'Consulta' END usuario_tipo_acceso, " .
                    " usuario_fechaCreado, usuario_fechaActualizado, usuario_perfil, usuario_avatar, " .
                    " usuario_estado, CASE usuario_tipodoc WHEN 'C' THEN 'C.C.' WHEN 'E' THEN 'C.E.' ELSE  'OTRO' END usuario_tipodoc, usuario_nrodoc, usuario_direccion, usuario_ciudad" 
                    . " FROM mm_usuarios ORDER BY usuario_nombre ";             
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
        $query = "DELETE FROM mm_usuarios WHERE usuario_id=$data->usuario_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $usuario_id =  $data->usuario_id; 
        $usuario_empresa =  $data->usuario_empresa; 
        $usuario_nombre =  $data->usuario_nombre; 
        $usuario_email =  $data->usuario_email; 
        $usuario_celular =  $data->usuario_celular; 
        $usuario_password =  $data->usuario_password; 
        $usuario_tipo_acceso =  $data->usuario_tipo_acceso; 
        $usuario_fechaCreado =  $data->usuario_fechaCreado; 
        $usuario_fechaActualizado =  $data->usuario_fechaActualizado; 
        $usuario_perfil =  $data->usuario_perfil; 
        $usuario_avatar =  $data->usuario_avatar; 
        $usuario_estado =  $data->usuario_estado; 
        $usuario_tipodoc =  $data->usuario_tipodoc; 
        $usuario_nrodoc =  $data->usuario_nrodoc; 
        $usuario_direccion =  $data->usuario_direccion; 
        $usuario_ciudad =  $data->usuario_ciudad; 
   
        if($usuario_id  == 0) 
        { 
           $query = "INSERT INTO mm_usuarios(usuario_empresa, usuario_nombre, usuario_email, usuario_celular, ".
                   " usuario_password, usuario_tipo_acceso, usuario_fechaCreado, usuario_fechaActualizado, ".
                   " usuario_perfil, usuario_avatar, usuario_estado, usuario_tipodoc, usuario_nrodoc, usuario_direccion, ".
                   " usuario_ciudad)";
           $query .= "  VALUES ('" . $usuario_empresa."', '".$usuario_nombre."', '".$usuario_email."', '".
                   $usuario_celular."', '".md5($usuario_password)."', '".$usuario_tipo_acceso."', '".
                   $usuario_fechaCreado."', '".$usuario_fechaActualizado."', '".$usuario_perfil."', '".
                   $usuario_avatar."', '".$usuario_estado."', '".$usuario_tipodoc."', '".$usuario_nrodoc."', '".
                   $usuario_direccion."', '".$usuario_ciudad."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_usuarios  SET usuario_empresa = '".$usuario_empresa."', usuario_nombre = '".
                    $usuario_nombre."', usuario_email = '".$usuario_email."', usuario_celular = '".$usuario_celular.
                    "', usuario_tipo_acceso = '".$usuario_tipo_acceso."', usuario_fechaCreado = '".
                    $usuario_fechaCreado."', usuario_fechaActualizado = '".
                    $usuario_fechaActualizado."', usuario_perfil = '".$usuario_perfil."', usuario_avatar = '".
                    $usuario_avatar."', usuario_estado = '".$usuario_estado."', usuario_tipodoc = '".
                    $usuario_tipodoc."', usuario_nrodoc = '".$usuario_nrodoc."', usuario_direccion = '".
                    $usuario_direccion."', usuario_ciudad = '".$usuario_ciudad."' WHERE usuario_id = ".$usuario_id;
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
      $expo .=  '          <th>NOMBRE</th>';
      $expo .=  '          <th>LOGIN</th>';
      $expo .=  '          <th>CELULAR</th>';
      $expo .=  '          <th>ACCESO</th>';
      $expo .=  '          <th>FECHACREADO</th>';
      $expo .=  '          <th>FECHAACTUALIZADO</th>';
      $expo .=  '          <th>AVATAR</th>';
      $expo .=  '          <th>ESTADO</th>';
      $expo .=  '          <th>TIPODOC</th>';
      $expo .=  '          <th>NRODOC</th>';
      $expo .=  '          <th>DIRECCION</th>';
      $expo .=  '          <th>CIUDAD</th>';
            $query = "SELECT  usuario_id, usuario_empresa, usuario_nombre, usuario_email, usuario_celular, ".
                    " usuario_password, CASE usuario_tipo_acceso WHEN 'S' THEN 'Super' WHEN 'A' THEN 'Admin' " .
                    "  WHEN 'K' THEN 'Contable' ELSE 'Consulta' END usuario_tipo_acceso, " .
                    " usuario_fechaCreado, usuario_fechaActualizado, usuario_perfil, usuario_avatar, " .
                    " usuario_estado, CASE usuario_tipodoc WHEN 'C' THEN 'C.C.' WHEN 'E' THEN 'C.E.' ELSE  'OTRO' END usuario_tipodoc, usuario_nrodoc, usuario_direccion, usuario_ciudad" 
                    . " FROM mm_usuarios ORDER BY usuario_nombre ";                 
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 

                $expo .=  	'<td>' .$row['usuario_nombre']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_email']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_celular']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_tipo_acceso']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_fechaCreado']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_fechaActualizado']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_avatar']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_estado']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_tipodoc']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_nrodoc']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_direccion']. '</td> ';
                $expo .=  	'<td>' .$row['usuario_ciudad']. '</td> ';
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
        $query = "SELECT  MAX(usuario_id) as id 
                    FROM mm_usuarios"; 
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
        $usuario_id = $data->usuario_id;      
        $query = "SELECT  usuario_id, usuario_empresa, usuario_nombre, usuario_email, usuario_celular, usuario_password, usuario_tipo_acceso, usuario_fechaCreado, usuario_fechaActualizado, usuario_perfil, usuario_avatar, usuario_estado, usuario_tipodoc, usuario_nrodoc, usuario_direccion, usuario_ciudad  " . 
                    " FROM mm_usuarios  WHERE usuario_id = " . $usuario_id  . 
                    " ORDER BY usuario_nombre "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 17, 2019 7:59:58   <<<<<<< 
