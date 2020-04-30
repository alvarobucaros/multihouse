<?php
include_once("../bin/cls/clsConection.php");
//$objClase = new DBconexion();
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
        $empresa = $data->empresa; 
        { 
            $query = "SELECT  terceroId, terceroEmpresaId, terceroNombre, terceroIdenTipo, terceroIdenNumero, ".
                    " terceroDireccion, terceroTelefonos, terceroCorreo, terceroTwiter, terceroFacebook, ".
                    " terceroComentario, tercero_codigo, terceroActivo, terceroRegimen, terceroContribuyente" .
                    " FROM contaterceros WHERE terceroEmpresaId = " . $empresa . " ORDER BY terceroNombre ";             
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
        $query = "DELETE FROM contaterceros WHERE terceroId=$data->terceroId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $terceroId =  $data->terceroId; 
        $terceroEmpresaId =  $data->terceroEmpresaId; 
        $terceroNombre =  $data->terceroNombre; 
        $terceroIdenTipo =  $data->terceroIdenTipo; 
        $terceroIdenNumero =  $data->terceroIdenNumero; 
        $terceroDireccion =  $data->terceroDireccion; 
        $terceroTelefonos =  $data->terceroTelefonos; 
        $terceroCorreo =  $data->terceroCorreo; 
        $terceroTwiter =  $data->terceroTwiter; 
        $terceroFacebook =  $data->terceroFacebook; 
        $terceroComentario =  $data->terceroComentario; 
        $tercero_codigo =  $data->tercero_codigo; 
        $terceroActivo =  $data->terceroActivo; 
        $terceroRegimen =  $data->terceroRegimen; 
        $terceroContribuyente =  $data->terceroContribuyente; 
   
        if($terceroId  == 0) 
        { 
           $query = "INSERT INTO contaterceros(terceroEmpresaId, terceroNombre, terceroIdenTipo, terceroIdenNumero, terceroDireccion, terceroTelefonos, terceroCorreo, terceroTwiter, terceroFacebook, terceroComentario, tercero_codigo, terceroActivo, terceroRegimen, terceroContribuyente)";
           $query .= "  VALUES ('" . $terceroEmpresaId."', '".$terceroNombre."', '".$terceroIdenTipo."', '".$terceroIdenNumero."', '".$terceroDireccion."', '".$terceroTelefonos."', '".$terceroCorreo."', '".$terceroTwiter."', '".$terceroFacebook."', '".$terceroComentario."', '".$tercero_codigo."', '".$terceroActivo."', '".$terceroRegimen."', '".$terceroContribuyente."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contaterceros  SET terceroEmpresaId = '".$terceroEmpresaId."', terceroNombre = '".$terceroNombre."', terceroIdenTipo = '".$terceroIdenTipo."', terceroIdenNumero = '".$terceroIdenNumero."', terceroDireccion = '".$terceroDireccion."', terceroTelefonos = '".$terceroTelefonos."', terceroCorreo = '".$terceroCorreo."', terceroTwiter = '".$terceroTwiter."', terceroFacebook = '".$terceroFacebook."', terceroComentario = '".$terceroComentario."', tercero_codigo = '".$tercero_codigo."', terceroActivo = '".$terceroActivo."', terceroRegimen = '".$terceroRegimen."', terceroContribuyente = '".$terceroContribuyente."' WHERE terceroId = ".$terceroId;
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
        $expo .=  '          <th>CODIGO</th>';
        $expo .=  '          <th>TIPO ID</th>';
        $expo .=  '          <th>IDENNUMERO</th>';
        $expo .=  '          <th>DIRECCION</th>';
        $expo .=  '          <th>TELEFONOS</th>';
        $expo .=  '          <th>E-MAIL</th>';
        $expo .=  '          <th>CTA TWITER</th>';
        $expo .=  '          <th>CTA FACEBOOK</th>';
        $expo .=  '          <th>COMENTARIOS</th>';
        $expo .=  '          <th>ACTIVO</th>';
        $expo .=  '          <th>REGIMEN</th>';
        $expo .=  '          <th>GRAN CONTRIBUYENTE</th>';
            $query = "SELECT  terceroId, terceroEmpresaId, terceroNombre, terceroIdenTipo, terceroIdenNumero, ".
                    " terceroDireccion, terceroTelefonos, terceroCorreo, terceroTwiter, terceroFacebook, ".
                    " terceroComentario, tercero_codigo, terceroActivo, terceroRegimen, terceroContribuyente" .
                    " FROM contaterceros WHERE terceroEmpresaId = " . $empresa .  
                    " ORDER BY terceroNombre ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['terceroId']. '</td> ';
                $expo .=  	'<td>' .$row['terceroEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['terceroNombre']. '</td> ';
                $expo .=  	'<td>' .$row['tercero_codigo']. '</td> ';
                $expo .=  	'<td>' .$row['tercero_codigo']. '</td> ';
                $expo .=  	'<td>' .$row['terceroIdenTipo']. '</td> ';
                $expo .=  	'<td>' .$row['terceroIdenNumero']. '</td> ';
                $expo .=  	'<td>' .$row['terceroDireccion']. '</td> ';
                $expo .=  	'<td>' .$row['terceroTelefonos']. '</td> ';
                $expo .=  	'<td>' .$row['terceroCorreo']. '</td> ';
                $expo .=  	'<td>' .$row['terceroTwiter']. '</td> ';
                $expo .=  	'<td>' .$row['terceroFacebook']. '</td> ';
                $expo .=  	'<td>' .$row['terceroComentario']. '</td> ';
                $expo .=  	'<td>' .$row['terceroActivo']. '</td> ';
                $expo .=  	'<td>' .$row['terceroRegimen']. '</td> ';
                $expo .=  	'<td>' .$row['terceroContribuyente']. '</td> ';
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
        $query = "SELECT  MAX(terceroId) as id 
                    FROM contaterceros"; 
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
        $terceroId = $data->terceroId;      
        $query = "SELECT  terceroId, terceroEmpresaId, terceroNombre, terceroIdenTipo, terceroIdenNumero, terceroDireccion, terceroTelefonos, terceroCorreo, terceroTwiter, terceroFacebook, terceroComentario, tercero_codigo, terceroActivo, terceroRegimen, terceroContribuyente  " . 
                    " FROM contaterceros  WHERE terceroId = " . $terceroId  . 
                    " ORDER BY terceroNombre "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:47:34   <<<<<<< 
