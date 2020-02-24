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
    case 'rm':
        leeRegistrosMov($data);
        break;
    case 'sm':
        sumaDbyCr($data);
        break;
    case 'b':
        borra($data);
        break;
    case 'a':
        actualiza($data);
        break; 
    case 'am':
        actualizaMov($data);
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
    case 'cp':
        comprobante($data);
        break;
    case 'bo':
        buscaComprobante($data);
        break;
    case 'te':
        traeEncabezados($data);
        break;
    case '0':
        lista0($data);
        break;
    case '1':
        lista1($data);
        break;
    case '2':
        lista2($data);
        break;
}
  
    function  leeRegistros($data) 
    { 
       global $objClase;
       $con = $objClase->conectar(); 
       $empresa = $data->empresa; 
       $periodo = $data->periodo; 
       { 
            $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, compNombre,  movicaCompNro, movicaTerceroId, ".
                    " terceroNombre, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec" .
                    " FROM contamovicabeza  ".
                    " INNER JOIN contacomprobantes ON movicaComprId=compId " .
                    " INNER JOIN contaterceros ON movicaTerceroId = terceroId ".
                    " WHERE movicaEmpresaId = " . $empresa . " AND movicaPeriodo = '" . $periodo . "' ". 
                    " ORDER BY movicaPeriodo ";             
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
 
    function  leeRegistrosMov($data) 
    { 
        global $objClase;
        $con = $objClase->conectar(); 
        $cabeza = $data->cabeza;     
        $query = "SELECT moviConId ,moviConCabezaId ,moviConDetalle ,moviConCuenta ,moviConDebito ,".
                " moviConCredito ,moviConBase ,moviConImpTipo ,moviConImpPorc ,moviConImpValor ,".
                " moviConIdTercero ,moviDocum1 ,moviDocum2, moviTipoCta ".
                " FROM contamovidetalle WHERE moviConCabezaId = " . $cabeza .
                " ORDER BY moviTipoCta DESC, moviConCuenta";
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
    
    function traeEncabezados($data){
        global $objClase;
        $con = $objClase->conectar();  
        $empresa = $data->empresa; 
        $query = " SELECT movicaId,  movicaEmpresaId, movicaComprId, compNombre, movicaCompNro, movicaTerceroId, " .
                 " terceroNombre, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal,  " .
                 " movicaDocumSec   " .
                 " FROM contamovicabeza  " .
                 " INNER JOIN contacomprobantes ON compId = movicaComprId  " .
                 " INNER JOIN contaterceros ON terceroId = movicaTerceroId  " .
                 " WHERE movicaEmpresaId = " . $empresa .
                 " AND compEmpresaId = movicaEmpresaId AND terceroEmpresaId = movicaEmpresaId AND " .
                 " movicaProcesado = 'N' ";
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
    
    function sumaDbyCr($data){
        global $objClase;
        $con = $objClase->conectar(); 
        $cabeza = $data->cabeza; 
        $empresa = $data->empresa; 
        $debitos=0;
        $creditos=0;
        $query = " SELECT SUM(moviConDebito) AS debito, sum(moviConCredito) AS credito " .
                 " FROM contamovidetalle, contamovicabeza ".
                 " WHERE moviConCabezaId = movicaId AND  movicaId = " . $cabeza .
                 " AND movicaEmpresaId = " .$empresa ;
        $result = mysqli_query($con, $query);  

        while($row = mysqli_fetch_assoc($result)) { 
            $debitos=$row['debito'];
            $creditos=$row['credito'];
        } 
        echo $debitos.'||'.$creditos;
    }

    function borra($data)
    { 
       global $objClase;
        $con = $objClase->conectar(); 
        $query = "DELETE FROM contamovicabeza WHERE movicaId=$data->movicaId"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
    
    
    function comprobante($data)
    { 
       global $objClase;
        $con = $objClase->conectar();
        $empresa =  $data->empresa;
        $cpbnte = $data->cp;
        $consec = 0;
        $query = "SELECT compConsecutivo FROM contacomprobantes WHERE compId = '" . $cpbnte .
                "' AND compEmpresaId = " .$empresa; 
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) { 
            $consec = $row['compConsecutivo']+1;
        }
        echo $consec; 
    }
 
    
    function buscaComprobante($data)
    { 
       global $objClase;
        $con = $objClase->conectar();
        $empresa =  $data->empresa;
        $cpbnte = $data->cp;
        $res=array();
        $response='';
        $query = "SELECT compConsecutivo, compctadb0, compctadb1, compctadb2, compctacr0, compctacr1, compctacr2, compDetalle ".
                " FROM contacomprobantes WHERE compEmpresaId = " . $empresa . " AND compId = " . $cpbnte;
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) {
            array_push($res,$row['compConsecutivo'],$row['compDetalle'],$row['compctadb0'],$row['compctadb1'],
                    $row['compctadb2'],$row['compctacr0'],$row['compctacr1'],$row['compctacr2']);
        }
        $response= $res[0].'||'.$res[1].'||'; 
        $query = "SELECT compCodigo, compNombre, compConsecutivo FROM contacomprobantes  WHERE compId = " . $res[0];
        $result = mysqli_query($con, $query); 
        while($row = mysqli_fetch_assoc($result)) { 
            $response .= $row['compCodigo'].'||'.$row['compNombre'].'||'. ($row['compConsecutivo']+1).'||';
        }
        for ($i = 2; $i < count($res); $i++) {
            $nombre='';
            if($res[$i] !=''){
                $query = "SELECT pucNombre FROM contaplancontable WHERE pucEmpresaId = " . $empresa .
                        " AND pucCuenta='".$res[$i]."' "; 
                $result = mysqli_query($con, $query); 
                while($r = mysqli_fetch_assoc($result)) { 
                    $nombre=$r['pucNombre'];
                }
            }
                $response.= $res[$i].'&'.$nombre.'||';
        }
   
        echo $response;    
    }
 
     
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $movicaId =  $data->movicaId; 
        $movicaEmpresaId =  $data->movicaEmpresaId; 
        $movicaComprId =  $data->movicaComprId; 
        $movicaCompNro =  $data->movicaCompNro; 
        $movicaTerceroId =  $data->movicaTerceroId; 
        $movicaDetalle =  $data->movicaDetalle; 
        $movicaProcesado =  $data->movicaProcesado; 
        $movicaFecha =  $data->movicaFecha; 
        $movicaPeriodo =  $data->movicaPeriodo; 
        $movicaDocumPpal =  $data->movicaDocumPpal; 
        $movicaDocumSec =  $data->movicaDocumSec; 
   
        if($movicaId  == 0) 
        { 
           $query = "INSERT INTO contamovicabeza(movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec)";
           $query .= "  VALUES ('" . $movicaEmpresaId."', '".$movicaComprId."', '".$movicaCompNro."', '".$movicaTerceroId."', '".$movicaDetalle."', '".$movicaProcesado."', '".$movicaFecha."', '".$movicaPeriodo."', '".$movicaDocumPpal."', '".$movicaDocumSec."')";  
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE contamovicabeza  SET movicaEmpresaId = '".$movicaEmpresaId."', movicaComprId = '".$movicaComprId."', movicaCompNro = '".$movicaCompNro."', movicaTerceroId = '".$movicaTerceroId."', movicaDetalle = '".$movicaDetalle."', movicaProcesado = '".$movicaProcesado."', movicaFecha = '".$movicaFecha."', movicaPeriodo = '".$movicaPeriodo."', movicaDocumPpal = '".$movicaDocumPpal."', movicaDocumSec = '".$movicaDocumSec."' WHERE movicaId = ".$movicaId;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function actualizaMov($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $dato =  $data->dato;
        $rec = explode('||',$dato);
        $query = "INSERT INTO contamovidetalle (moviConCabezaId ,moviConDetalle, moviConCuenta, ".
                 " moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, ".
                 " moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2, moviTipoCta) VALUES (".
                 $rec[1].",'".$rec[2]."','".$rec[3]."','".$rec[4]."','".$rec[5]."','".$rec[6]."','".
                 $rec[7]."','".$rec[8]."','".$rec[9]."','".$rec[10]."','".$rec[11]."','".
                 $rec[12]."','".$rec[13]."')";
                    mysqli_query($con, $query);
            echo 'Ok';
        //0||1||Compra de productos de aseo y cafetería||110505||100||0||0||K||5||5||235||||||D
        //
//                        dato=$scope.registroMov.moviConId+'||'+$scope.registroMov.moviConCabezaId+'||'+$scope.registroMov.moviConDetalle+'||'
//                dato+=$scope.registroMov.moviConCuenta+'||'+$scope.registroMov.moviConDebito+'||'+$scope.registroMov.moviConCredito+'||'
//                dato+=$scope.registroMov.moviConBase+'||'+$scope.registroMov.moviConImpTipo+'||'+$scope.registroMov.moviConImpPorc+'||'
//                dato+=$scope.registroMov.moviConImpValor+'||'+$scope.registroMov.moviConIdTercero+'||';
//                dato+=$scope.registroMov.moviDocum1+'||'+$scope.registroMov.moviDocum2+'||'+$scope.registroMov.moviTipoCta;
// 
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
      $expo .=  '          <th>COMPROBANTE</th>';
      $expo .=  '          <th>NUMERO</th>';
      $expo .=  '          <th>TERCERO</th>';
      $expo .=  '          <th>DETALLE</th>';
      $expo .=  '          <th>PROCESADO</th>';
      $expo .=  '          <th>FECHA</th>';
      $expo .=  '          <th>PERIODO</th>';
      $expo .=  '          <th>DOCUMPPAL</th>';
      $expo .=  '          <th>DOCUMSEC</th>';
            $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec" 
                    . " FROM contamovicabeza ORDER BY movicaPeriodo ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $expo .=  '<tr> '; 
                    $expo .=  	'<td>' .$row['movicaId']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaEmpresaId']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaComprId']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaCompNro']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaTerceroId']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaDetalle']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaProcesado']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaFecha']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaPeriodo']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaDocumPpal']. '</td> ';
                    $expo .=  	'<td>' .$row['movicaDocumSec']. '</td> ';
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
        $query = "SELECT  MAX(movicaId) as id 
                    FROM contamovicabeza"; 
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
        $movicaId = $data->movicaId;      
        $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec  " . 
                    " FROM contamovicabeza  WHERE movicaId = " . $movicaId  . 
                    " ORDER BY movicaPeriodo "; 
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
        $control = $data->control;
        $query = "SELECT compId, compNombre FROM contacomprobantes WHERE compEmpresaId = " . $empresa;
        if ($control === 'M'){
            $query .= " AND compTipo = 'O' ";
        }else{
            $query .= " AND compTipo = 'C' ";
        }
        $query .=" ORDER BY  compNombre";
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
         $query = "SELECT terceroId,  terceroNombre FROM contaterceros  WHERE terceroEmpresaId = " . $empresa . 
                 "ORDER BY  terceroNombre";
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
    
     function lista2($data)
     { 
       global $objClase;
        $con = $objClase->conectar();	
        $empresa = $data->empresa;
         $query = "SELECT pucCuenta,  pucNombre FROM contaplancontable " .
                  "WHERE pucTipo = 'M' AND pucEmpresaId = " . $empresa . 
                 " ORDER BY  pucNombre";
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
 
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< 
