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
    case 'm':
        maxRegistroId($data);
        break;
    case 'ci':
        cierre($data);
        break;    
    case 'exp':
        exportaXls($data);
        break; 
    case 'tc':
        traeCuentas($data);
        break; 
    case 'nc':
        traeNomCuentas($data);
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
        $perini = $data->fi;
        $perfin = $data->ff;
        $empresa = $data->empresa;
        $saldo = 0;
        $codi= " ingastocontabiliza = 'N' AND ingastoempresa =  " .$empresa ;
        { 
            $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " . 
                    " CASE ingastotipo WHEN 'A' THEN 'Aper' WHEN 'I' THEN 'Ingre' ELSE 'Gasto' END nomtipo, " . 
                    " ingastocomprobante, ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, " .
                    " 0 AS saldo, ingastoctadb, ingastoctacr, ingastotercero, ingastocompctble " .
                    " FROM containgregastos WHERE " .$codi .
                    " ORDER BY ingastoFecha ";             
            $result = mysqli_query($con, $query); 
            $arr = array(); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                        if($row['ingastotipo']=='I' || $row['ingastotipo']=='A'){$saldo = $saldo + $row['ingastovalor']; }
                        else {$saldo = $saldo - $row['ingastovalor']; }
                        $row['saldo'] = $saldo;
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
        $query = "DELETE FROM containgregastos WHERE ingastoid=$data->ingastoid"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $ingastoid =  $data->ingastoid; 
        $ingastoempresa =  $data->ingastoempresa; 
        $ingastoFecha =  $data->ingastoFecha; 
        $ingastoperiodo =  $data->ingastoperiodo; 
        $ingastotipo =  $data->ingastotipo; 
        $ingastocomprobante =  $data->ingastocomprobante; 
        $ingastodetalle =  $data->ingastodetalle; 
        $ingastovalor =  $data->ingastovalor; 
        $ingastocontabiliza =  $data->ingastocontabiliza; 
        $ingastoDocumento  =  $data->ingastoDocumento; 
        $ingastoctadb = $data->ingastoctadb;
        $ingastoctacr = $data->ingastoctacr;
        $ingastotercero = $data->ingastotercero;
        $ingastocompro = $data->ingastocompro;
        if($ingastoid  == 0)   
        { 
           $query = "INSERT INTO containgregastos(ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " .
                   " ingastocomprobante, ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, " .
                   " ingastoctadb, ingastoctacr,ingastotercero, ingastocompctble )" .
                   " VALUES ('" . $ingastoempresa."', '".$ingastoFecha."', '".$ingastoperiodo."', '".
                   $ingastotipo."', '".$ingastocomprobante."', '".$ingastodetalle."', '". $ingastoDocumento."', '".
                   $ingastovalor."', '".$ingastocontabiliza."', '".$ingastoctadb."', '".$ingastoctacr."', '".
                   $ingastotercero."', '".$ingastocompro."')";          

        } 
        else 
        { 
            $query = "UPDATE containgregastos  SET ingastoempresa = '".$ingastoempresa."', ingastoFecha = '".
                    $ingastoFecha."', ingastoperiodo = '".$ingastoperiodo."', ingastotipo = '".
                    $ingastotipo."', ingastocomprobante = '".$ingastocomprobante."', ingastodetalle = '".
                    $ingastodetalle. "', ingastoDocumento = '".$ingastoDocumento. "', ingastovalor = '".
                    $ingastovalor."', ingastocontabiliza = '".
                    $ingastocontabiliza ."', ingastoctadb = '".
                    $ingastoctadb ."', ingastoctacr = '".
                    $ingastoctacr ."', ingastotercero = '" . $ingastotercero ."', ingastocompctble = '" . $ingastocompro . 
                    "' WHERE ingastoid = ".$ingastoid; 
        } 
        mysqli_query($con, $query);
        echo 'Ok';
        return 'Ok';
    } 
    
    function exportaXls($data){ 
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa = $data->empresa; 
        $periIni= $data->fi;
        $periFin= $data->ff;
        $expo=''; 
        $expo .= '<table border=1 class="table2Excel"> '; 
        $expo .=  '<tr> '; 
      //  $expo .=  '          <th>ID</th>';
      //  $expo .=  '          <th>EMPRESA</th>';
        $expo .=  '          <th>FECHA</th>';
        $expo .=  '          <th>PERIODO</th>';
        $expo .=  '          <th>TIPO</th>';
        $expo .=  '          <th>COMPROBANTE</th>';
        $expo .=  '          <th>DOCUMENTO</th>';
        $expo .=  '          <th>DETALLE</th>';
        $expo .=  '          <th>VALOR</th>';
        $expo .=  '          <th>SALDO</th>';
        $expo .=  '          <th>CTA DEBITO</th>';
        $expo .=  '          <th>CTA CREDITO</th>';
        $expo .=  '          <th>CONTABILIZA</th>';
            $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " .
                    " CASE ingastotipo WHEN 'I' THEN 'Ingreso' WHEN 'G' THEN 'Gasto' ELSE 'Inicial' END tipo," . 
                    " ingastocomprobante, ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza, " .
                    " ingastoctadb, ingastoctacr, 0 AS saldo, ingastotercero" .
                    " FROM containgregastos WHERE ingastotipo NOT IN ('C') AND ingastoempresa =  " .$empresa .
                    " AND ( ingastoperiodo >= '" . $periIni ."' AND ingastoperiodo <= '".$periFin . "') ".
                    " ORDER BY ingastoFecha ";              
            $result = mysqli_query($con, $query); 
            $saldo=0.00;
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) {
                        $valor = $row['ingastovalor'];
                        if($row['ingastotipo']==='G'){$valor = $valor * (-1); }
                        $saldo = $saldo + $valor;        
                        $expo .=  '<tr> '; 
                  //      $expo .=  'td>' .$row['ingastoid']. '</td> ';
                  //      $expo .=  '<td>' .$row['ingastoempresa']. '</td> ';
                        $expo .=  '<td>' .$row['ingastoFecha']. '</td> ';
                        $expo .=  '<td>' .$row['ingastoperiodo']. '</td> ';
                        $expo .=  '<td>' .$row['tipo']. '</td> ';
                        $expo .=  '<td>' .$row['ingastocomprobante']. '</td> ';  
                        $expo .=  '<td>' .$row['ingastoDocumento']. '</td> ';  
                        $expo .=  '<td>' .$row['ingastodetalle']. '</td> ';
                        $expo .=  '<td>' .number_format($valor, 2, '.', ','). '</td> ';
                        $expo .=  '<td>' .number_format($saldo, 2, '.', ','). '</td> ';
                        $expo .=  '<td>' .$row['ingastoctadb']. '</td> ';
                        $expo .=  '<td>' .$row['ingastoctacr']. '</td> ';
                        $expo .=  '<td>' .$row['ingastocontabiliza']. '</td> ';
                        $expo .=  '</tr> '; 
                    } 
                } 
        $expo .=  '</table> ';  
        echo $expo; 
        return $expo; 
     } 
     
     
     function cierre($data){ 
        global $objClase;
        $con = $objClase->conectar(); 
        $perini = $data->fi;
        $perfin = $data->ff;
        $empresa = $data->empresa;
        $comprobante='xx';
        $saldo = 0;
        $fecha = substr($perfin,0,4).'-'.substr($perfin,4,2).'-01';
        $detalle = 'Saldo parcial periodo '.$perfin;
        $query = "SELECT SUM(ingastovalor) AS suma FROM containgregastos WHERE ingastoperiodo = '".$perini."' AND ingastotipo IN ('A','I')";
        $result = mysqli_query($con, $query);   
        while($row = mysqli_fetch_assoc($result)) { 
             $saldo = $row['suma'];
        }
        $query = "SELECT SUM(ingastovalor) AS suma FROM containgregastos WHERE ingastoperiodo = '".$perini."' AND ingastotipo IN ('G')";
        $result = mysqli_query($con, $query);   
        while($row = mysqli_fetch_assoc($result)) { 
             $saldo -= $row['suma'];
        }
        $query = "INSERT INTO containgregastos(ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, " .
                " ingastocomprobante, ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza)" .
                " VALUES ('" . $empresa."', '".$fecha."', '".$perfin."', 'A','".
                $comprobante."', '".$detalle."', '0', '".$saldo."', 'N')";  
         mysqli_query($con, $query);
         echo 'Ok';
     }
     
    function maxRegistroId($data) 
    { 
         global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(ingastoid) as id 
                    FROM containgregastos"; 
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
        $ingastoid = $data->ingastoid;      
        $query = "SELECT  ingastoid, ingastoempresa, ingastoFecha, ingastoperiodo, ingastotipo, ingastocomprobante, ".
                " ingastodetalle, ingastoDocumento, ingastovalor, ingastocontabiliza  " . 
                    " FROM containgregastos  WHERE ingastoid = " . $ingastoid  . 
                    " ORDER BY ingastoFecha "; 
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
 
    
        function traeNomCuentas($data){
            global $objClase;
            $con = $objClase->conectar(); 
            $comp = $data->comp;
            $empresa = $data->empresa;
            $query = "SELECT compctadb0, compctacr0, compcpbnte FROM contacomprobantes  ".
                     " WHERE  compEmpresaId = ".$empresa. " AND compId = ".$comp;
                    $result = mysqli_query($con, $query); 
            while($row = mysqli_fetch_assoc($result)) { 
                $ret = $row['compctadb0'].'||'.$row['compctacr0'].'||'.$row['compcpbnte']; 
            } 
            echo $ret; 
            return $ret; 
    }
    
    function traeCuentas($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $comp = $data->comp;
        $empresa = $data->empresa;
        $query = " SELECT  compDetalle, compctadb0, cdb.pucNombre debito, compctacr0, ccr.pucNombre credito, compcpbnte  " . 
                " FROM contacomprobantes  " . 
                " INNER JOIN contaplancontable cdb ON compctadb0 = cdb.pucCuenta AND cdb.pucEmpresaId = compEmpresaId  " . 
                " INNER JOIN contaplancontable ccr ON compctacr0 = ccr.pucCuenta AND ccr.pucEmpresaId = compEmpresaId  " . 
                " WHERE compEmpresaId = ". $empresa ." AND compId = ".$comp ;
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) { 
            $ret = $row['compDetalle'].'||'.$row['compctadb0'].'||'.$row['debito'].
                   '||'.$row['compctacr0']. '||'.$row['credito'].'||'.$row['compcpbnte']; 
        } 
        echo $ret; 
        return $ret; 
    }
    
    
    
	 
    function lista0($data) 
    { 
       global $objClase;
       $empresa = $data->empresa; 
        $con = $objClase->conectar();	 
         $query = "SELECT compId, compNombre FROM contacomprobantes ".
         " WHERE compEmpresaId = " . $empresa . " AND compTipo IN ('O') ORDER BY  compNombre";
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
         $query = "SELECT  terceroId, terceroNombre FROM contaterceros  ".
         "  WHERE  terceroEmpresaId = " . $empresa . " AND terceroActivo='A' ORDER BY  terceroNombre";
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
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Nov 27, 2019 1:57:50   <<<<<<< 
