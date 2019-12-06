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
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  acuerdoid, acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario" 
                    . " FROM contaacuerdos ORDER BY acuerdofecha, acuerdoinmueble ";             
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
        $query = "DELETE FROM contaacuerdos WHERE acuerdoid=$data->acuerdoid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $acuerdoid =  $data->acuerdoid; 
        $acuerdoempresa =  $data->acuerdoempresa; 
        $acuerdoinmueble =  $data->acuerdoinmueble; 
        $acuerdofecha =  $data->acuerdofecha; 
        $acuerdovalor =  $data->acuerdovalor; 
        $acuerdoplazo =  $data->acuerdoplazo; 
        $acuerdodetalle =  $data->acuerdodetalle; 
        $acuerdopropietario =  $data->acuerdopropietario; 
        if($acuerdopropietario===0){
            $acuerdopropietario = traePropietario($acuerdoempresa, $acuerdoinmueble );
        }
        if($acuerdoid  == 0) 
        { 
           $query = "INSERT INTO contaacuerdos(acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario)";
           $query .= "  VALUES ('" . $acuerdoempresa."', '".$acuerdoinmueble."', '".$acuerdofecha."', '".$acuerdovalor."', '".$acuerdoplazo."', '".$acuerdodetalle."', '".$acuerdopropietario."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contaacuerdos  SET acuerdoempresa = '".$acuerdoempresa."', acuerdoinmueble = '".$acuerdoinmueble."', acuerdofecha = '".$acuerdofecha."', acuerdovalor = '".$acuerdovalor."', acuerdoplazo = '".$acuerdoplazo."', acuerdodetalle = '".$acuerdodetalle."', acuerdopropietario = '".$acuerdopropietario."' WHERE acuerdoid = ".$acuerdoid;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(acuerdoid) as id 
                    FROM contaacuerdos"; 
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
        $acuerdoid = $data->acuerdoid;      
        $query = "SELECT  acuerdoid, acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario  " . 
                    " FROM contaacuerdos  WHERE acuerdoid = " . $acuerdoid  . 
                    " ORDER BY acuerdofecha "; 
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
 
    function traePropietario($acuerdoempresa, $acuerdoinmueble ){
        global $objClase;
        $con = $objClase->conectar();
        $empresa =  $data->empresa;
        $contaInmuPropietarioPropietarioId = 0;
        $query = "SELECT contaInmuPropietarioPropietarioId FROM containmueblepropietario ".
                 " WHERE contaInmuPropietarioEmpresaId = ".
                $acuerdoempresa. "  AND contaInmuPropietarioInmuebleId = ".$acuerdoinmueble;
                 if(mysqli_num_rows($result) != 0)
         { 
             while($row = mysqli_fetch_assoc($result)) {
                 $contaInmuPropietarioPropietarioId = $row['contaInmuPropietarioPropietarioId'];
              }
         }
         echo $contaInmuPropietarioPropietarioId;
    }
    
    function lista0($data) 
    { 
        global $objClase;
        $con = $objClase->conectar();
        $empresa =  $data->empresa;
         $query = "SELECT inmuebleId,  inmuebleCodigo FROM containmuebles WHERE inmuebleEmpresaId = ".
                $empresa. " ORDER BY  inmuebleCodigo";
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
        $empresa =  $data->empresa;
         $query = "SELECT propietarioId,  propietarioNombre  FROM contapropietarios WHERE propietarioEmpresaId = ".
                  $empresa. "ORDER BY  propietarioNombre ";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Dec 06, 2019 12:48:39   <<<<<<< 
