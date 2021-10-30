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
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  cptosid, cptosEmpresa, cptosCodigo, cptosDetalle, cptosValor, cptosIva, cptosEstado" 
                    . " FROM contafactcptos ORDER BY cptosCodigo ";             
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
        $query = "DELETE FROM contafactcptos WHERE cptosid=$data->cptosid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $cptosid =  $data->cptosid; 
        $cptosEmpresa =  $data->cptosEmpresa; 
        $cptosCodigo =  $data->cptosCodigo; 
        $cptosDetalle =  $data->cptosDetalle; 
        $cptosValor =  $data->cptosValor; 
        $cptosIva =  $data->cptosIva; 
        $cptosEstado =  $data->cptosEstado; 
   
        if($cptosid  == 0) 
        { 
           $query = "INSERT INTO contafactcptos(cptosEmpresa, cptosCodigo, cptosDetalle, cptosValor, cptosIva, cptosEstado)";
           $query .= "  VALUES ('" . $cptosEmpresa."', '".$cptosCodigo."', '".$cptosDetalle."', '".$cptosValor."', '".$cptosIva."', '".$cptosEstado."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contafactcptos  SET cptosEmpresa = '".$cptosEmpresa."', cptosCodigo = '".$cptosCodigo."', cptosDetalle = '".$cptosDetalle."', cptosValor = '".$cptosValor."', cptosIva = '".$cptosIva."', cptosEstado = '".$cptosEstado."' WHERE cptosid = ".$cptosid;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(cptosid) as id 
                    FROM contafactcptos"; 
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
        $cptosid = $data->cptosid;      
        $query = "SELECT  cptosid, cptosEmpresa, cptosCodigo, cptosDetalle, cptosValor, cptosIva, cptosEstado  " . 
                    " FROM contafactcptos  WHERE cptosid = " . $cptosid  . 
                    " ORDER BY cptosCodigo "; 
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
 
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 9:05:47   <<<<<<< 
