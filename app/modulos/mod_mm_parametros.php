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
}
  

 
    function  leeRegistros($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $reservaSal_idEmpresa =  $data->reservaSal_idEmpresa; 
        if ($con){
            $query = "SELECT param_horarioInicio, param_horarioTermina, param_intervaloCalendario ".
                    "FROM mm_parametros where param_empresaid = " . $reservaSal_idEmpresa;
            $result = mysqli_query($con, $query);
            $arr = array(); 
            if(mysqli_num_rows($result) != 0) 
                {
                    while($row = mysqli_fetch_assoc($result)) {
                       $horarioInicio = $row['param_horarioInicio'];
                       $horarioTermina = $row['param_horarioTermina'];
                       $intervaloCalendario = $row['param_intervaloCalendario'];
                    } 
                }  
        } 
     $retorno='';
     $fch = array();
     $ini = array();
     $fin = array();
     $ini = explode(':',$horarioInicio);
     $fin = explode(':',$horarioTermina);
     $i = $ini[1];
     $n = $fin[1] + 12;
     $ampm='am';
     for($x=$i; $x<=$n; $x++){
         $mm='';
         if($x < 0){$mm='0';}
         $mm+=$x+$ampm;
         if($x<12){$ampm='pm';}
         array_push($fch, $mm);
     }
     echo $fch;
     return $fch;
    } 
 
    function borra($data)
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $reservaSal_id =  $data->reservaSal_id; 
        $query = "DELETE FROM mm_reservasalon WHERE reservaSal_id=$data->reservaSal_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       // print_r($data);
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $reservaSal_id =  $data->reservaSal_id; 
        $reservaSal_idEmpresa =  $data->reservaSal_idEmpresa; 
        $reservaSal_idSalon =  $data->reservaSal_idSalon; 
        $reservaSal_idComite =  $data->reservaSal_idComite; 
        $reservaSal_FechaDesde =  $data->reservaSal_FechaDesde; 
        $reservaSal_FechaHasta =  $data->reservaSal_FechaHasta; 
        $reservaSal_reservadoPor =  $data->reservaSal_reservadoPor; 
        $reservaSal_FechaReserva =  $data->reservaSal_FechaReserva; 
        $reservaSal_Confirmado =  $data->reservaSal_Confirmado; 
        $reservaSal_Observaciones =  $data->reservaSal_Observaciones; 
   

        if($reservaSal_id  == 0) 
        { 
           $query = "INSERT INTO mm_reservasalon(reservaSal_idEmpresa, reservaSal_idSalon, reservaSal_idComite, reservaSal_FechaDesde, reservaSal_FechaHasta, reservaSal_reservadoPor, reservaSal_FechaReserva, reservaSal_Confirmado, reservaSal_Observaciones)";
           $query .= "  VALUES ('" . $reservaSal_idEmpresa."', '".$reservaSal_idSalon."', '".$reservaSal_idComite."', '".$reservaSal_FechaDesde."', '".$reservaSal_FechaHasta."', '".$reservaSal_reservadoPor."', '".$reservaSal_FechaReserva."', '".$reservaSal_Confirmado."', '".$reservaSal_Observaciones."')";  
            mysqli_query($con, $query);
            echo 'Ok ';
        } 
        else 
        { 
            $query = "UPDATE mm_reservasalon  SET reservaSal_idEmpresa = '".$reservaSal_idEmpresa."', reservaSal_idSalon = '".$reservaSal_idSalon."', reservaSal_idComite = '".$reservaSal_idComite."', reservaSal_FechaDesde = '".$reservaSal_FechaDesde."', reservaSal_FechaHasta = '".$reservaSal_FechaHasta."', reservaSal_reservadoPor = '".$reservaSal_reservadoPor."', reservaSal_FechaReserva = '".$reservaSal_FechaReserva."', reservaSal_Confirmado = '".$reservaSal_Confirmado."', reservaSal_Observaciones = '".$reservaSal_Observaciones."' WHERE reservaSal_id = ".$reservaSal_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $reservaSal_id = $data->reservaSal_id;      
        $query = "SELECT  reservaSal_id, reservaSal_idEmpresa, reservaSal_idSalon, reservaSal_idComite, reservaSal_FechaDesde, reservaSal_FechaHasta, reservaSal_reservadoPor, reservaSal_FechaReserva, reservaSal_Confirmado, reservaSal_Observaciones  " . 
                    " FROM mm_reservasalon  WHERE reservaSal_id = " . $reservaSal_id  . 
                    " ORDER BY reservaSal_FechaReserva "; 
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
 

// >>>>>>>   Creado por:   Alvaro Ortiz Friday,Nov 04, 2016 9:40:34   <<<<<<< 
