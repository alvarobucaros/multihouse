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
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor" 
                    . " FROM contaplancontable ORDER BY pucCuenta ";             
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
        $pucEmpresaId =  $data->empresa;
        $pucCuenta = $data->cuenta;
        $condi = "pucEmpresaId = ".$pucEmpresaId . " AND pucMayor = '".$pucCuenta."'"; 
        $query = "SELECT pucTipo FROM contaplancontable  WHERE " . $condi;  
        $result = mysqli_query($con, $query); 
        $count=0;
        $count=mysqli_num_rows($result);
        if ($count === 0){
            $query = "DELETE FROM contaplancontable WHERE pucId=$data->pucId"; 
            mysqli_query($con, $query); 
            echo 'Ok Cuenta Borrada'; 
        }else{
            echo 'Error. No puede borrar la cuenta '. $pucCuenta .', de esta depende otra cuenta';
        }
    }
 
    function actualiza($data)
    {     
        global $objClase;
        $con = $objClase->conectar(); 
        $resultado = "";	 
        $pucId =  $data->pucId; 
        $pucEmpresaId =  $data->pucEmpresaId; 
        $pucCuenta =  $data->pucCuenta; 
        $pucNombre =  $data->pucNombre; 
        $pucMayor =  $data->pucMayor; 
        $pucNivel =  $data->pucNivel; 
        $pucTipo =  $data->pucTipo; 
        $pucActivo =  $data->pucActivo; 
        $pucClase =  $data->pucClase; 
        $pucValor =  $data->pucValor; 
        $er='';  
        $pucTipoMy='';
        $condi = "pucEmpresaId = ".$pucEmpresaId . " AND pucCuenta = '".$pucMayor."'"; 
        $query = "SELECT pucTipo FROM contaplancontable  WHERE " . $condi;  
        $result = mysqli_query($con, $query); 
        $count=0;
        $count=mysqli_num_rows($result);
        
        if($count===0){
            $er="Error: No existe cuenta mayor";
        }else{
            while( $rec =  mysqli_fetch_assoc($result))         
            {
                $pucTipoMy = $rec['pucTipo'];
            }            
        }
    
        if($er === ""){
            if ($pucTipo === 'T'){
                if ($pucTipoMy == 'M'){
                    $er="Error: esta cuenta es de total y el mayor de movimiento"; 
                }
            }else{
                if ($pucTipoMy == 'M'){
                    $er="Error: esta cuenta es de movimiento y el mayor de movimiento"; 
                }
            }    
        }

    if ($er==''){
            if ($pucId != "0") {
                $resultado = "OK. Registro actualizado";
                $condi = "pucEmpresaId = ".$pucEmpresaId . " and pucMayor = '".$pucCuenta."' "; 
                $query = "SELECT pucTipo FROM contaplancontable WHERE " . $condi;
                $result = mysqli_query($con, $query); 

                $count=0;
                $count=mysqli_num_rows($result);

                if ($count > 0 ){
                    $er="Error: No puede cambiar el tipo de cuenta"; 
                }
                else{
                $sql = 'UPDATE contaplancontable SET pucEmpresaId = "' . trim($pucEmpresaId) .'",'. 
                'pucCuenta = "' . trim($pucCuenta) .'",'. 
                'pucMayor = "' . trim($pucMayor) .'",'. 
                'pucNombre = "' . utf8_decode(trim($pucNombre)) .'",'. 
                'pucNivel = "' . trim($pucNivel) .'",'. 
                'pucTipo = "' . $pucTipo .'",'. 'pucActivo = "' . $pucActivo .'",'. 
                'pucClase = "' . trim($pucClase) .'",'. 'pucValor = "' . trim($pucValor) .
                 '" WHERE pucId = ' . $pucId;
                }
            }else{
                $count=0;
                $condi = "pucEmpresaId = ".$pucEmpresaId . " and pucCuenta = '".$pucCuenta."'"; 
                $query = "SELECT COUNT(*) AS Nr FROM contaplancontable WHERE " . $condi;  
                $result = mysqli_query($con, $query);                 
                while( $rec =  mysqli_fetch_assoc($result))           
                {
                    $count = $rec['Nr'];
                }
                if ($count > 0){
                    $er="Error: Ya existe un registro con esta cuenta";
                }else{
                    $resultado = "Ok. Registro Creado";
                    $sql = 'INSERT INTO contaplancontable ( pucEmpresaId, pucCuenta, pucNombre, '.
                            'pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor) '. 
                        'VALUES ("'. $pucEmpresaId . '","'. $pucCuenta . '","'. $pucNombre . '","'.
                        $pucMayor . '","'.  $pucNivel . '","'. $pucTipo . '","'. 
                        $pucActivo . '","'. $pucClase . '","'. $pucValor .'")';
                }
            }
            if($er===""){
                    $result = mysqli_query($con, $sql); 

            }
        }
        if($er > ''){
            echo $er;
        }else{
            echo $resultado;
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
        $expo .=  '          <th>CUENTA</th>';
        $expo .=  '          <th>NOMBRE CUENTA</th>';
        $expo .=  '          <th>MAYOR</th>';
        $expo .=  '          <th>NIVEL</th>';
        $expo .=  '          <th>TIPO</th>';
        $expo .=  '          <th>ACTIVO</th>';
        $expo .=  '          <th>CLASE</th>';
        $expo .=  '          <th>VALOR</th>';
            $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor" 
                    . " FROM contaplancontable ORDER BY pucCuenta ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['pucId']. '</td> ';
                $expo .=  	'<td>' .$row['pucEmpresaId']. '</td> ';
                $expo .=  	'<td>' .$row['pucCuenta']. '</td> ';
                $expo .=  	'<td>' .$row['pucNombre']. '</td> ';
                $expo .=  	'<td>' .$row['pucMayor']. '</td> ';
                $expo .=  	'<td>' .$row['pucNivel']. '</td> ';
                $expo .=  	'<td>' .$row['pucTipo']. '</td> ';
                $expo .=  	'<td>' .$row['pucActivo']. '</td> ';
                $expo .=  	'<td>' .$row['pucClase']. '</td> ';
                $expo .=  	'<td>' .$row['pucValor']. '</td> ';
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
        $query = "SELECT  MAX(pucId) as id 
                    FROM contaplancontable"; 
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
        $pucId = $data->pucId;      
        $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor  " . 
                    " FROM contaplancontable  WHERE pucId = " . $pucId  . 
                    " ORDER BY pucCuenta "; 
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
 
    
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Jan 13, 2020 11:54:47   <<<<<<< 
