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
    case 'rt':
        recuperaTemas($data);
        break;
}
  

 
    function  leeRegistros($data) 
    { 
      $empresa = $data->empresa;  
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  tema_id, tema_agendaId, tema_empresa, tema_comite, comite_nombre, tema_titulo, tema_detalle, ".
                    " tema_tipo, tema_responsable, tema_fechaAsigna, tema_estado " .
                    " FROM mm_agendatemas INNER JOIN mm_comites ON comite_id = tema_comite WHERE tema_empresa = ".$empresa .
                    " ORDER BY tema_comite ";             
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
 
    function  recuperaTemas($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
      $cmte =  $data->comite_id;
       { 
            $query = "SELECT  tema_id, tema_agendaId, tema_empresa, tema_comite, comite_nombre, tema_titulo, tema_detalle, ".
                    " tema_tipo, tema_responsable, tema_fechaAsigna, tema_estado,  tema_orden " .
                    " FROM mm_agendatemas INNER JOIN mm_comites ON comite_id = tema_comite WHERE tema_comite = " . $cmte . " ORDER BY tema_comite ";             
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
        $tema_id = 0; 
        $query = "DELETE FROM mm_agendatemas WHERE tema_id=$data->tema_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $tema_id =  $data->tema_id; 
        $tema_agendaId =  $data->tema_agendaId; 
        $tema_empresa =  $data->tema_empresa; 
        $tema_comite =  $data->tema_comite; 
        $tema_titulo =  $data->tema_titulo; 
        $tema_detalle =  $data->tema_detalle; 
        $tema_tipo =  $data->tema_tipo; 
        $tema_responsable =  $data->tema_responsable; 
        $tema_fechaAsigna =  $data->tema_fechaAsigna; 
        $tema_estado =  $data->tema_estado; 
   
        if($tema_id  == 0) 
        { 
           $query = "INSERT INTO mm_agendatemas(tema_agendaId, tema_empresa, tema_comite, tema_titulo, tema_detalle, tema_tipo, tema_responsable, tema_fechaAsigna, tema_estado)";
           $query .= "  VALUES ('" . $tema_agendaId."', '".$tema_empresa."', '".$tema_comite."', '".$tema_titulo."', '".$tema_detalle."', '".$tema_tipo."', '".$tema_responsable."', '".$tema_fechaAsigna."', '".$tema_estado."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_agendatemas  SET tema_agendaId = '".$tema_agendaId."', tema_empresa = '".$tema_empresa."', tema_comite = '".$tema_comite."', tema_titulo = '".$tema_titulo."', tema_detalle = '".$tema_detalle."', tema_tipo = '".$tema_tipo."', tema_responsable = '".$tema_responsable."', tema_fechaAsigna = '".$tema_fechaAsigna."', tema_estado = '".$tema_estado."' WHERE tema_id = ".$tema_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $tema_id = $data->tema_id;      
        $query = "SELECT  tema_id, tema_agendaId, tema_empresa, tema_comite, tema_titulo, tema_detalle, tema_tipo, tema_responsable, tema_fechaAsigna, tema_estado  " . 
                    " FROM mm_agendatemas  WHERE tema_id = " . $tema_id  . 
                    " ORDER BY tema_comite "; 
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
         $query = "SELECT comite_id,  comite_nombre FROM mm_comites WHERE comite_empresa = " . $empresa . " ORDER BY  comite_nombre";
         $result = mysqli_query($con, $query); 
         $arr = array(); 
         if(mysqli_num_rows($result) != 0)
         { 
             while($row = mysqli_fetch_assoc($result)) {
                 $arr[] = $row;
              }
         } 
         echo $query;
      echo $json_info = json_encode($arr); 
    } 
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 5:02:00   <<<<<<< 
