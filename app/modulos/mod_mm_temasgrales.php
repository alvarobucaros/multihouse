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
}
  

 
    function  leeRegistros($data) 
    { 
      $empresa = $data->empresa;
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  temasGrales_id, temasGrales_empresa, temasGrales_comiteId, comite_nombre, " .
                    " temasGrales_titulo, temasGrales_detalle, temasGrales_estado " .
                    " FROM mm_temasgrales INNER JOIN mm_comites ON  temasGrales_comiteId = comite_id " .
                    " WHERE temasGrales_empresa = ".$empresa. " AND temasGrales_estado = 'A' ORDER BY comite_nombre, temasGrales_titulo ";             
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
        $temasGrales_id = 0; 
        $query = "DELETE FROM mm_temasgrales WHERE temasGrales_id=$data->temasGrales_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $temasGrales_id =  $data->temasGrales_id; 
        $temasGrales_empresa =  $data->temasGrales_empresa; 
        $temasGrales_comiteId =  $data->temasGrales_comiteId; 
        $temasGrales_titulo =  $data->temasGrales_titulo; 
        $temasGrales_detalle =  $data->temasGrales_detalle; 
        $temasGrales_estado =  $data->temasGrales_estado; 
   
        if($temasGrales_id  == 0) 
        { 
           $query = "SELECT temasGrales_id FROM mm_temasgrales WHERE temasGrales_empresa = " . $temasGrales_empresa . " AND " .
           "temasGrales_comiteId = " . $temasGrales_comiteId ." AND temasGrales_titulo = '".$temasGrales_titulo ."' "; 
           $result = mysqli_query($con, $query);
           $rowcount=mysqli_num_rows($result);       
           if($rowcount==0){
            $query = "INSERT INTO mm_temasgrales(temasGrales_empresa, temasGrales_comiteId, temasGrales_titulo, " .
                    " temasGrales_detalle, temasGrales_estado)";
            $query .= "  VALUES ('" . $temasGrales_empresa."', '".$temasGrales_comiteId."', '".$temasGrales_titulo.
                      "', '".$temasGrales_detalle."', '".$temasGrales_estado."')";  
            mysqli_query($con, $query);
            echo 'Ok';
           }
            else
           {
               echo 'Ya se ha creado un tema con este título'; 
           }
        } 
        else 
        { 
            $query = "UPDATE mm_temasgrales  SET temasGrales_empresa = '".$temasGrales_empresa."', temasGrales_comiteId = '".$temasGrales_comiteId."', temasGrales_titulo = '".$temasGrales_titulo."', temasGrales_detalle = '".$temasGrales_detalle."', temasGrales_estado = '".$temasGrales_estado."' WHERE temasGrales_id = ".$temasGrales_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $temasGrales_id = $data->temasGrales_id;      
        $query = "SELECT  temasGrales_id, temasGrales_empresa, temasGrales_comiteId, temasGrales_titulo, temasGrales_detalle, temasGrales_estado  " . 
                    " FROM mm_temasgrales  WHERE temasGrales_id = " . $temasGrales_id  . 
                    " ORDER BY temasGrales_titulo "; 
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
         $query = "SELECT comite_id,  comite_nombre FROM mm_comites WHERE comite_empresa = " . $empresa . 
                 " AND comite_activo = 'A' ORDER BY  comite_nombre";

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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 10:19:17   <<<<<<< 
