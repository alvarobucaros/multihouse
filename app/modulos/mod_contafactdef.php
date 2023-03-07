<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('atominge_ncr','127,0,0,1','root','');
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

switch ($op)
{
    case 'a':
        actualiza($data);
        break; 
    case 'am':
        actualizaDetalle($data);
        break;        
    case 'b':
        borra($data);
        break;
    case 'd':
        Detalles($data);
        break;
    case 'r':
        leeRegistros($data);
        break;
    case 'u':
        unRegistro($data);
        break;
    case 'm':
        maxRegistroId($data);
        break;
    case 'ma':
        actualizaMaxRegistroId($data);
        break;    
    case 'tc':
        traeConcpto($data);
        break; 
    case '0':
        lista0($data);
        break;
    case '1':
        lista1($data);
        break;    
}

function  detalles($data) 
{ 
    global $objClase;
    $empresa = $data->empresa;
    $numero = $data->numero;
    $con = $objClase->conectar(); 
    
    $query = " SELECT factdefid, factdefempresa, factdefvalor, factdefiva, factdefsaldo, ";
    $query .= " factdefneto, factdefcptodeta, factdefconcepto, factdefcliente, ";
    $query .= " factdeffechcrea, factdeffechvence, factdefnro, factdefcptodeta as factdefdetalle ";
    $query .= " FROM contafactdef ";
    $query .= " WHERE factdefempresa = " . $empresa ;
    $query .= "  AND factdefnro = " .$numero . " order by factdefid desc ";
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

 
    function  leeRegistros($data) 
    { 
       global $objClase;
       $empresa = $data->empresa;
      $con = $objClase->conectar(); 
       { 
            $query = " SELECT factdefempresa, factdefnro, factdefcliente,  terceroNombre,  ";
            $query .= " factdeffechcrea, factdeffechvence, sum(factdefneto) as factdefneto ";
            $query .= " FROM contafactdef  INNER JOIN contaterceros ON factdefcliente = terceroId     ";     
            $query .= " WHERE factdefempresa = terceroEmpresaId  AND factdefempresa = " . $empresa;
            $query .= " GROUP BY factdefempresa, factdefnro, factdefcliente,  terceroNombre,  factdeffechcrea, factdeffechvence ";
            $query .= " ORDER BY factdefnro   ";          
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
        $query = "DELETE FROM contafactdef WHERE factdefid=$data->factdefid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $factdefid =  $data->factdefid; 
        $factdefempresa =  $data->factdefempresa; 
        $factdefnro =  $data->factdefnro; 
        $factdefcliente =  $data->factdefcliente; 
        $factdeffechcrea =  $data->factdeffechcrea; 
        $factdeffechvence =  $data->factdeffechvence; 
        $factdefvalor =  $data->factdefvalor; 
        $factdefiva =  $data->factdefiva; 
        $factdefsaldo =  $data->factdefsaldo; 
        $factdefneto =  $data->factdefneto; 
        $factdefcontabiliza =  $data->factdefcontabiliza; 
        $factdefconcepto = $data->factdefconcepto;
        $factdefcptodeta = $data->factdefcptodeta;
              
        if($factdefid  == 0) 
        { 
            $query = "INSERT INTO contafactdef(factdefempresa, factdefnro, factdefcliente, factdeffechcrea,  ";
            $query .= " factdeffechvence, factdefvalor, factdefiva, factdefsaldo, factdefneto, factdefcontabiliza, ";
            $query .= " factdefconcepto, factdefcptodeta )";
            $query .= "  VALUES ('" . $factdefempresa."', '".$factdefnro."', '".$factdefcliente."', '".
                   $factdeffechcrea."', '".$factdeffechvence."', '".$factdefvalor."', '".$factdefiva."', '".
                   $factdefsaldo."', '".$factdefneto."', '".$factdefcontabiliza."', '".
                   $factdefconcepto."', '".$factdefcptodeta."')";           
            mysqli_query($con, $query);
            $last = mysqli_insert_id($con);
            echo 'Ok||'.$last;
        } 
        else 
        { 
            $query = "UPDATE contafactdef  SET factdefcptodeta = '".$factdefcptodeta."', factdefnro = '".
                    $factdefnro."', factdefcliente = '".$factdefcliente."', factdeffechcrea = '".$factdeffechcrea.
                    "', factdeffechvence = '".$factdeffechvence."', factdefvalor = '".$factdefvalor.
                    "', factdefiva = '".$factdefiva."', factdefsaldo = '".$factdefsaldo."', factdefneto = '".
                    $factdefneto."', factdefcontabiliza = '".$factdefcontabiliza. "', factdefconcepto = '".
                    $factdefconcepto .
                    "' WHERE factdefid = ". $factdefid;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
    } 
 
    function actualizaDetalle($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;
        $factmvtId = $data->factmvtId;
        $factmvtCptoId =  $data->factmvtCptoId;
        $factmvtFacDef =  $data->factmvtFacDef; 
        $factmvtDetalle =  $data->factmvtDetalle;
        $factmvtValor =  $data->factmvtValor;
        $factmvtIvaPorc =  $data->factmvtIvaPorc;
        $factmvtIvaValor =  $data->factmvtIvaValor; 
        $factmvtDescPorc =  $data->factmvtDescPorc; 
        $factmvtDescValor =  $data->factmvtDescValor;            
        if($factmvtId  == 0) 
        { 
           $query = "INSERT INTO contafactserviciomvt (factmvtCptoId, factmvtFacDef, factmvtDetalle)";
            $query .= "VALUES('" . $factmvtCptoId . "', '" . $factmvtFacDef  . "', '";
            $query .= $factmvtDetalle. "')";
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contafactserviciomvt  SET factmvtDetalle = '".$factmvtDetalle ."'  WHERE factmvtId = ". $factmvtId;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    }
    
    function maxRegistroId($data) 
    { 
        global $objClase;
        $empresa = $data->empresa;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT empresaConsecFact FROM contaempresas WHERE empresaId = " . $empresa; 
        $result = mysqli_query($con, $query); 
            while($row = mysqli_fetch_assoc($result)) { 
                $id = $row['empresaConsecFact'];
                $id +=1;
           } 
        echo $id; 
        return $id; 
        } 
 
    function actualizaMaxRegistroId($data) 
    { 
        global $objClase;
        $empresa = $data->empresa;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "UPDATE contaempresas SET empresaConsecFact = empresaConsecFact + 1 " .
                " WHERE empresaId = " . $empresa; 
        $result = mysqli_query($con, $query); 

        echo 'Ok'; 
        return 'Ok'; 
        } 
        
    function unRegistro($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $factdefid = $data->factdefid;      
        $query = "SELECT  factdefid, factdefempresa, factdefnro, factdefcliente, factdeffechcrea, factdeffechvence, factdefvalor, factdefiva, factdefsaldo, factdefneto, factdefcontabiliza  " . 
                    " FROM contafactdef  WHERE factdefid = " . $factdefid  . 
                    " ORDER BY factdefnro "; 
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
 
    function traeConcpto($data){
        global $objClase;
        $empresa = $data->empresa;
        $concepto = $data->concepto;
        $con = $objClase->conectar();	 
        $query = "SELECT cptosCodigo, cptosValor, cptosIva FROM contafactcptos ";
        $query .= " WHERE cptosEmpresa = " . $empresa . " AND cptosid = ".$concepto;
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
        $empresa = $data->empresa;
        $con = $objClase->conectar();	 
        $query = "SELECT terceroId,  terceroNombre FROM contaterceros ";
        $query .= " WHERE terceroActivo = 'A' AND terceroEmpresaId = " . $empresa . " ORDER BY  terceroNombre";
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
        $empresa = $data->empresa;
        $con = $objClase->conectar();	 
        $query = "SELECT cptosid, cptosDetalle FROM contafactcptos ";
        $query .= " WHERE cptosEstado  = 'A' AND cptosEmpresa = " . $empresa . " ORDER BY  cptosDetalle";
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
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 7:09:26   <<<<<<< 