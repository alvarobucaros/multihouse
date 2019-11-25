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
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  pagoid, pagoempresa, pagocedula, pagoinmueble,  inmuebleCodigo, pagofecha, pagovalor, pagoestado, ".
            " pagopropietarioid, pagoinmuebleid " .
            " FROM contatmpagos  INNER JOIN containmuebles ON inmuebleId = pagoinmueble ".
            " ORDER BY pagocedula ";             
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
        $query = "DELETE FROM contatmpagos WHERE pagoid=$data->pagoid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $pagoid =  $data->pagoid; 
        $pagoempresa =  $data->pagoempresa; 
        $pagocedula =  $data->pagocedula; 
        $pagoinmueble =  $data->pagoinmueble; 
        $pagofecha =  $data->pagofecha; 
        $pagovalor =  $data->pagovalor; 
        $pagoestado =  $data->pagoestado; 
        $pagopropietarioid =  $data->pagopropietarioid; 
        $pagoinmuebleid =  $data->pagoinmuebleid; 
   
        if($pagoid  == 0) 
        { 
           $query = "INSERT INTO contatmpagos(pagoempresa, pagocedula, pagoinmueble, pagofecha, pagovalor, pagoestado, pagopropietarioid, pagoinmuebleid)";
           $query .= "  VALUES ('" . $pagoempresa."', '".$pagocedula."', '".$pagoinmueble."', '".$pagofecha."', '".$pagovalor."', '".$pagoestado."', '".$pagopropietarioid."', '".$pagoinmuebleid."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contatmpagos  SET pagoempresa = '".$pagoempresa."', pagocedula = '".$pagocedula."', pagoinmueble = '".$pagoinmueble."', pagofecha = '".$pagofecha."', pagovalor = '".$pagovalor."', pagoestado = '".$pagoestado."', pagopropietarioid = '".$pagopropietarioid."', pagoinmuebleid = '".$pagoinmuebleid."' WHERE pagoid = ".$pagoid;
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
//      $expo .=  '          <th>EMPRESA</th>';
      $expo .=  '          <th>CEDULA</th>';
      $expo .=  '          <th>INMUEBLE</th>';
      $expo .=  '          <th>FECHA</th>';
      $expo .=  '          <th>VALOR</th>';
      $expo .=  '          <th>ESTADO</th>';
//      $expo .=  '          <th>PROPIETARIOID</th>';
//      $expo .=  '          <th>INMUEBLEID</th>';
            $query = "SELECT  pagoid, pagoempresa, pagocedula, pagoinmueble, inmuebleCodigo, pagofecha, " .
                    " pagovalor, CASE pagoestado WHEN 'P' THEN 'Pendiente' ELSE 'Aplicado' END pagoestado,".
                    " pagopropietarioid, pagoinmuebleid " .
                    " FROM contatmpagos INNER JOIN  containmuebles ON inmuebleId = pagoinmueble ".
                    " WHERE pagoempresa = '" . $empresa .  "' ".
                    " ORDER BY inmuebleCodigo ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
 //               $expo .=  	'<td>' .$row['pagoid']. '</td> ';
//                $expo .=  	'<td>' .$row['pagoempresa']. '</td> ';
                $expo .=  	'<td>' .$row['pagocedula']. '</td> ';
                $expo .=  	'<td>' .$row['inmuebleCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['pagofecha']. '</td> ';
                $expo .=  	'<td>' .$row['pagovalor']. '</td> ';
                $expo .=  	'<td>' .$row['pagoestado']. '</td> ';
//                $expo .=  	'<td>' .$row['pagopropietarioid']. '</td> ';
//                $expo .=  	'<td>' .$row['pagoinmuebleid']. '</td> ';
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
        $query = "SELECT  MAX(pagoid) as id 
                    FROM contatmpagos"; 
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
        $pagoid = $data->pagoid;      
        $query = "SELECT  pagoid, pagoempresa, pagocedula, pagoinmueble, pagofecha, pagovalor, pagoestado, pagopropietarioid, pagoinmuebleid  " . 
                    " FROM contatmpagos  WHERE pagoid = " . $pagoid  . 
                    " ORDER BY pagocedula "; 
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
         $query = "SELECT inmuebleId, inmuebleCodigo FROM containmuebles " . 
         " WHERE inmueblePrincipal = 'SI' AND inmuebleEmpresaId = " .$empresa ." ORDER BY inmuebleCodigo";
    echo $query;
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,Oct 10, 2019 8:48:35   <<<<<<< 
