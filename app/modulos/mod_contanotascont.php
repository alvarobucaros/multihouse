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
       $empresa = $data->empresa; 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  notaid, notaempresa, notareporte, notacodigo, notadetalle" .
                     " FROM contanotascont WHERE notaempresa = '".$empresa."' ORDER BY notareporte ";             
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
        $query = "DELETE FROM contanotascont WHERE notaid=$data->notaid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $notaid =  $data->notaid; 
        $notaempresa =  $data->notaempresa; 
        $notareporte =  $data->notareporte; 
        $notacodigo =  $data->notacodigo; 
        $notadetalle =  $data->notadetalle; 
   
        if($notaid  == 0) 
        { 
           $query = "INSERT INTO contanotascont(notaempresa, notareporte, notacodigo, notadetalle)";
           $query .= "  VALUES ('" . $notaempresa."', '".$notareporte."', '".$notacodigo."', '".$notadetalle."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contanotascont  SET notaempresa = '".$notaempresa."', notareporte = '".$notareporte."', notacodigo = '".$notacodigo."', notadetalle = '".$notadetalle."' WHERE notaid = ".$notaid;
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
      $expo .=  '          <th>REPORTE</th>';
      $expo .=  '          <th>CODIGO</th>';
      $expo .=  '          <th>DETALLE</th>';
            $query = "SELECT  notaid, notaempresa, notareporte, notacodigo, notadetalle" 
                    . " FROM contanotascont ORDER BY notareporte ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['notaid']. '</td> ';
                $expo .=  	'<td>' .$row['notaempresa']. '</td> ';
                $expo .=  	'<td>' .$row['notareporte']. '</td> ';
                $expo .=  	'<td>' .$row['notacodigo']. '</td> ';
                $expo .=  	'<td>' .$row['notadetalle']. '</td> ';
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
        $query = "SELECT  MAX(notaid) as id 
                    FROM contanotascont"; 
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
        $notaid = $data->notaid;      
        $query = "SELECT  notaid, notaempresa, notareporte, notacodigo, notadetalle  " . 
                    " FROM contanotascont  WHERE notaid = " . $notaid  . 
                    " ORDER BY notareporte "; 
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
 
	 
    function lista0() 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
         $query = "SELECT tipoCodigo,  tipoDetalle FROM contatipoinforme ORDER BY  tipoDetalle";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 05, 2021 12:29:20   <<<<<<< 
