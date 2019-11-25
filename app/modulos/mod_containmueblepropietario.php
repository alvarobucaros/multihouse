<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
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
    case '0':
        lista0($data);
        break;
    case '1':
        lista1($data);
        break;
}
  

 
    function  leeRegistros($data) 
    { 
        global $objClase;
        $empresa = $data->empresa; 
        $con = $objClase->conectar(); 
       { 
            $query = "SELECT  contaInmuPropietarioId, contaInmuPropietarioEmpresaId, contaInmuPropietarioInmuebleId, inmuebleCodigo,
                contaInmuPropietarioPropietarioId  , propietarioNombre
               FROM containmueblepropietario 
               INNER JOIN containmuebles ON inmuebleId = contaInmuPropietarioInmuebleId
               INNER JOIN contapropietarios ON propietarioId = contaInmuPropietarioPropietarioId
               WHERE contaInmuPropietarioEmpresaId = " . $empresa .
               " ORDER BY inmuebleCodigo ";     
            
//            
//            SELECT  contaInmuPropietarioId, contaInmuPropietarioEmpresaId, contaInmuPropietarioInmuebleId, inmuebleCodigo,
//                contaInmuPropietarioPropietarioId  , propietarioNombre
//               FROM containmueblepropietario 
//               INNER JOIN containmuebles ON inmuebleId = contaInmuPropietarioInmuebleId
//               INNER JOIN contapropietarios ON propietarioId = contaInmuPropietarioPropietarioId
//               WHERE contaInmuPropietarioEmpresaId = 6
//                ORDER BY inmuebleCodigo;
//            
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
        $query = "DELETE FROM containmueblepropietario WHERE contaInmuPropietarioId=$data->contaInmuPropietarioId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $contaInmuPropietarioId =  $data->contaInmuPropietarioId; 
        $contaInmuPropietarioEmpresaId =  $data->contaInmuPropietarioEmpresaId; 
        $contaInmuPropietarioInmuebleId =  $data->contaInmuPropietarioInmuebleId; 
        $contaInmuPropietarioPropietarioId =  $data->contaInmuPropietarioPropietarioId; 
   
        if($contaInmuPropietarioId  == 0) 
        { 
           $query = "INSERT INTO containmueblepropietario(contaInmuPropietarioEmpresaId, contaInmuPropietarioInmuebleId, contaInmuPropietarioPropietarioId)";
           $query .= "  VALUES ('" . $contaInmuPropietarioEmpresaId."', '".$contaInmuPropietarioInmuebleId."', '".$contaInmuPropietarioPropietarioId."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE containmueblepropietario  SET contaInmuPropietarioEmpresaId = '".$contaInmuPropietarioEmpresaId."', contaInmuPropietarioInmuebleId = '".$contaInmuPropietarioInmuebleId."', contaInmuPropietarioPropietarioId = '".$contaInmuPropietarioPropietarioId."' WHERE contaInmuPropietarioId = ".$contaInmuPropietarioId;
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
//      $expo .=  '          <th>ID</th>';
      $expo .=  '          <th>EMPRESA</th>';
      $expo .=  '          <th>INMUEBLE</th>';
      $expo .=  '          <th>PROPIETARIO</th>';
            $query = "SELECT  contaInmuPropietarioId, contaInmuPropietarioEmpresaId, contaInmuPropietarioInmuebleId, inmuebleCodigo,
                contaInmuPropietarioPropietarioId  , propietarioNombre
               FROM containmueblepropietario 
               INNER JOIN containmuebles ON inmuebleId = contaInmuPropietarioInmuebleId
               INNER JOIN contapropietarios ON propietarioId = contaInmuPropietarioId
               WHERE contaInmuPropietarioEmpresaId = " . $empresa .
               " ORDER BY inmuebleCodigo ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
             //   $expo .=  	'<td>' .$row['contaInmuPropietarioId']. '</td> ';
                $expo .=  	'<td>' .$row['contaInmuPropietarioEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['inmuebleCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['propietarioNombre']. '</td> ';
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
        $query = "SELECT  MAX(contaInmuPropietarioId) as id 
                    FROM containmueblepropietario"; 
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
        $contaInmuPropietarioId = $data->contaInmuPropietarioId;      
        $query = "SELECT  contaInmuPropietarioId, contaInmuPropietarioEmpresaId, contaInmuPropietarioInmuebleId, contaInmuPropietarioPropietarioId  " . 
                    " FROM containmueblepropietario  WHERE contaInmuPropietarioId = " . $contaInmuPropietarioId  . 
                    " ORDER BY contaInmuPropietarioInmuebleId "; 
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
       global $objClase;
        $con = $objClase->conectar();
         $empresa = $data->empresa; 
         $query = "SELECT inmuebleId,  inmuebleCodigo FROM containmuebles " .
                 " WHERE inmuebleEmpresaId = " . $empresa . " ORDER BY  inmuebleCodigo";
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
       global $objClase;
        $con = $objClase->conectar();
         $empresa = $data->empresa; 
         $query = "SELECT  propietarioId,  propietarioNombre FROM contapropietarios " .
                 " WHERE propietarioEmpresaId = " . $empresa . " ORDER BY  propietarioNombre";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 4:11:22   <<<<<<< 
