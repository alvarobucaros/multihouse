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
            $query = "SELECT  InmuebleServicioId, InmuebleServicioEmpresaId, InmuebleServicioInmuebleId, InmuebleServicioServicioId, 
                    InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, InmuebleServicioFechaInicio, InmuebleServicioActivo,
                    inmuebleCodigo, ServicioCodigo
                    FROM containmuebleservicios 
                    INNER JOIN containmuebles ON inmuebleId = InmuebleServicioInmuebleId
                    INNER JOIN contaservicios ON ServicioId = InmuebleServicioServicioId
                    WHERE InmuebleServicioEmpresaId = " . $empresa .
                    " ORDER BY InmuebleServicioServicioId ;";             
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
        $query = "DELETE FROM containmuebleservicios WHERE InmuebleServicioId=$data->InmuebleServicioId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $InmuebleServicioId =  $data->InmuebleServicioId; 
        $InmuebleServicioEmpresaId =  $data->InmuebleServicioEmpresaId; 
        $InmuebleServicioInmuebleId =  $data->InmuebleServicioInmuebleId; 
        $InmuebleServicioServicioId =  $data->InmuebleServicioServicioId; 
        $InmuebleServicioMonto =  $data->InmuebleServicioMonto; 
        $InmuebleServicioCuota =  $data->InmuebleServicioCuota; 
        $InmuebleServicioSaldo =  $data->InmuebleServicioSaldo; 
        $InmuebleServicioFechaInicio =  $data->InmuebleServicioFechaInicio; 
        $InmuebleServicioActivo =  $data->InmuebleServicioActivo; 
   
        if($InmuebleServicioId  == 0) 
        { 
           $query = "INSERT INTO containmuebleservicios(InmuebleServicioEmpresaId, InmuebleServicioInmuebleId, InmuebleServicioServicioId, InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, InmuebleServicioFechaInicio, InmuebleServicioActivo)";
           $query .= "  VALUES ('" . $InmuebleServicioEmpresaId."', '".$InmuebleServicioInmuebleId."', '".$InmuebleServicioServicioId."', '".$InmuebleServicioMonto."', '".$InmuebleServicioCuota."', '".$InmuebleServicioSaldo."', '".$InmuebleServicioFechaInicio."', '".$InmuebleServicioActivo."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE containmuebleservicios  SET InmuebleServicioEmpresaId = '".$InmuebleServicioEmpresaId."', InmuebleServicioInmuebleId = '".$InmuebleServicioInmuebleId."', InmuebleServicioServicioId = '".$InmuebleServicioServicioId."', InmuebleServicioMonto = '".$InmuebleServicioMonto."', InmuebleServicioCuota = '".$InmuebleServicioCuota."', InmuebleServicioSaldo = '".$InmuebleServicioSaldo."', InmuebleServicioFechaInicio = '".$InmuebleServicioFechaInicio."', InmuebleServicioActivo = '".$InmuebleServicioActivo."' WHERE InmuebleServicioId = ".$InmuebleServicioId;
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
 //     $expo .=  '          <th>ID</th>';
 //     $expo .=  '          <th>EMPRESA</th>';
      $expo .=  '          <th>INMUEBLE</th>';
      $expo .=  '          <th>SERVICIO</th>';
      $expo .=  '          <th>MONTO</th>';
      $expo .=  '          <th>VALOR CUOTA</th>';
      $expo .=  '          <th>SALDO</th>';
      $expo .=  '          <th>FECHA INICIO</th>';
      $expo .=  '          <th>ACTIVO</th>';
            $query = "SELECT  InmuebleServicioId, InmuebleServicioEmpresaId, InmuebleServicioInmuebleId, InmuebleServicioServicioId, 
                    InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, InmuebleServicioFechaInicio, InmuebleServicioActivo,
                    inmuebleCodigo, ServicioCodigo
                    FROM containmuebleservicios 
                    INNER JOIN containmuebles ON inmuebleId = InmuebleServicioInmuebleId
                    INNER JOIN contaservicios ON ServicioId = InmuebleServicioServicioId
                    WHERE InmuebleServicioEmpresaId = " . $empresa .
                    " ORDER BY InmuebleServicioServicioId ;";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
 //               $expo .=  	'<td>' .$row['InmuebleServicioId']. '</td> ';
 //               $expo .=  	'<td>' .$row['InmuebleServicioEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['inmuebleCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['ServicioCodigo']. '</td> ';
                $expo .=  	'<td>' .$row['InmuebleServicioMonto']. '</td> ';
                $expo .=  	'<td>' .$row['InmuebleServicioCuota']. '</td> ';
                $expo .=  	'<td>' .$row['InmuebleServicioSaldo']. '</td> ';
                $expo .=  	'<td>' .$row['InmuebleServicioFechaInicio']. '</td> ';
                $expo .=  	'<td>' .$row['InmuebleServicioActivo']. '</td> ';
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
        $query = "SELECT  MAX(InmuebleServicioId) as id 
                    FROM containmuebleservicios"; 
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
        $InmuebleServicioId = $data->InmuebleServicioId;      
        $query = "SELECT  InmuebleServicioId, InmuebleServicioEmpresaId, InmuebleServicioInmuebleId, InmuebleServicioServicioId, InmuebleServicioMonto, InmuebleServicioCuota, InmuebleServicioSaldo, InmuebleServicioFechaInicio, InmuebleServicioActivo  " . 
                    " FROM containmuebleservicios  WHERE InmuebleServicioId = " . $InmuebleServicioId  . 
                    " ORDER BY InmuebleServicioServicioId "; 
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
         $query = "SELECT  inmuebleId, inmuebleCodigo FROM containmuebles WHERE inmuebleEmpresaId = " . $empresa . 
                 " ORDER BY  inmuebleCodigo";
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
         $query = "SELECT  ServicioId,  ServicioCodigo FROM contaservicios WHERE servicioEmpresaId = " . $empresa .
                 " ORDER BY  ServicioCodigo";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 5:07:04   <<<<<<< 
