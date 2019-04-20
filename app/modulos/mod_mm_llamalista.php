<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('mmeeting2','127,0,0,1','root','');
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

switch ($op)
{
    case '1':
        lista1($data);
        break;
    case '0':
        lista0($data);
        break;
    case 'lc':
        leeCodigos($data);
        break;
    case 'll':
        llamaLista($data);
        break;
    case 'vl':
        visualizaLista($data);
        break;
    case 'rn':
        leeRegistrosNvo($data);
        break;
    case 'ri':
        leeRegistrosIni($data);
        break;
    case 'dl':
        datosLista($data);
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
    case 'imp':
        imprime($data);
        break;     
}
  
    function  leeRegistrosIni($data) 
    { 
          leeRegistros($data,'I') ;    
    }
 
    function  leeRegistrosNvo($data) 
    { 
          leeRegistros($data,'N') ;    
    }
 
    function  leeRegistros($data, $opcion) 
    { 
        $empresa = $data->empresa; 
        $codigo = $data->codigo;
        $nr=0;
        global $objClase;
        $con = $objClase->conectar(); 
       
        if ($opcion === 'I'){  // si hay listas activas trae la mas reciente
            $query = "SELECT  listactrl_id, listactrl_empresa, listactrl_codigo, listactrl_estado, listactrl_llamado ".
                    " FROM mm_listactrl " .
                    " WHERE  listactrl_empresa = '" . $empresa ."' AND listactrl_estado='A' " .
                    " ORDER BY listactrl_codigo  DESC , listactrl_llamado DESC LIMIT 1 " ;
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0)
            { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $codigo = $row['listactrl_codigo']; 
                } 
            }               
        }

        $query = "SELECT count(*) AS nr FROM  mm_llamalista WHERE " .
                 "lista_empresa = " . $empresa . " AND  lista_codigo = '" . $codigo ."' ";
         $result = mysqli_query($con, $query);
         while($row = mysqli_fetch_assoc($result)) { 
                     $nr = $row['nr']; 
                 } 
         if($nr == 0 && $opcion == 'N')  
            {
            $query = "INSERT INTO mm_llamalista (lista_empresa, lista_codigo, " .
                    " lista_inmueble, lista_asiste1,  lista_asiste2,  lista_asiste3, " .
                    " lista_asiste4,  lista_asiste5,  lista_asiste6, lista_obervacion, " .
                    " lista_area, lista_coeficiente, lista_descripcion, ".
                    " lista_propietario,lista_cedula) " .
                    " SELECT inmueble_empresa, '" .$codigo . "', inmueble_codigo," .
                    " '0', '0', '0', '0', '0', '0', '', inmueble_area, inmueble_coeficiente, ".
                    " inmueble_descripcion, inmueble_propNombre, inmueble_propCedula " .
                    " FROM mm_inmuebles WHERE inmueble_empresa = '" .
                    $empresa ."' ORDER BY inmueble_codigo ";           
                    $result = mysqli_query($con, $query);
            $atreaTot=0;        
            $query = "select sum(lista_area) atreaTot " .
                     " FROM  mm_llamalista WHERE lista_empresa= " .$empresa .
                     " AND lista_codigo = '".$codigo . "' ";
                     while($row = mysqli_fetch_assoc($result)) { 
                        $atreaTot = $row['atreaTot']; 
                     } 
            $query = "UPDATE mm_llamalista SET lista_coeficiente = lista_area / " .
                    $atreaTot . " WHERE lista_empresa= " .$empresa .
                     " AND lista_codigo = '".$codigo . "'  and lista_id>0 ";

                     
            $query = "INSERT INTO mm_listactrl (listactrl_empresa, listactrl_codigo, listactrl_estado, " .
                    " listactrl_llamado ) VALUES ('".$empresa . "','".$codigo. "','A',1)";
                    $result = mysqli_query($con, $query);
            }
           
            $query = "SELECT  lista_id, lista_empresa, lista_codigo, lista_inmueble, " .
                    "  lista_obervacion, lista_area, lista_coeficiente, " .
                    " lista_asiste1, lista_asiste2,  lista_asiste3, lista_asiste4,  " .
                    " lista_asiste5,  lista_asiste6,lista_descripcion, lista_propietario, lista_cedula " .
                    " FROM mm_llamalista WHERE  lista_empresa = '".$empresa ."' AND ".
                    " lista_codigo = '" . $codigo . "' ORDER BY lista_inmueble ";             
            $result = mysqli_query($con, $query); 
           
 // echo $query;
            $arr = array(); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                        $arr[] = $row; 
                    } 
                }  
            echo $json_info = json_encode($arr); 
         
    } 
 
    function borra($data)
    { 
       global $objClase;
        $con = $objClase->conectar(); 
        $query = "DELETE FROM mm_llamalista WHERE lista_id=$data->lista_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
       global $objClase;
        $con = $objClase->conectar(); 
        $datos =  $data->datos;	
        $reg = explode('||',$datos);
        $lista_id =  $reg[0];  
        $lista_asiste1 =  $reg[1]; 
        $lista_asiste2 =  $reg[2]; 
        $lista_asiste3 =  $reg[3]; 
        $lista_asiste4 =  $reg[4];  
        $lista_asiste5 =  $reg[5]; 
        $lista_asiste6 =  $reg[6];  
        $observa = $reg[7];
            $query = "UPDATE mm_llamalista  SET  lista_asiste1 = '".$lista_asiste1.
                    "', lista_asiste2 = '".$lista_asiste2."', lista_asiste3 = '".$lista_asiste3.
                    "', lista_asiste4 = '".$lista_asiste4."', lista_asiste5 = '".$lista_asiste5.
                    "', lista_asiste6 = '".$lista_asiste6."', lista_obervacion = '" . $observa . "' WHERE lista_id = ".$lista_id;
            mysqli_query($con, $query); 
            echo 'Ok'; 
    } 
 
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $query = "SELECT  MAX(lista_id) as id 
                    FROM mm_llamalista"; 
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
        $lista_id = $data->lista_id;      
        $query = "SELECT  lista_id, lista_empresa, lista_codigo, lista_inmueble, lista_asiste1, " .
                    " lista_asiste2, lista_asiste3, lista_asiste4, lista_asiste5, lista_asiste6, " .
                    " lista_area, lista_coeficiente, lista_propietario, lista_cedula, " .
                    " lista_obervacion, lista_descripcion  " . 
                    " FROM mm_llamalista  WHERE lista_id = " . $lista_id  . 
                    " ORDER BY lista_inmueble "; 
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
 
        function leeCodigos($data){
            global $objClase;
            $con = $objClase->conectar();	 
            $empresa= $data->empresa; 
            $query = "SELECT listactrl_codigo,  listactrl_codigo FROM mm_listactrl  " .
                     " WHERE listactrl_empresa = '".$empresa ."' AND listactrl_estado ='A' " .
                     " ORDER BY listactrl_codigo DESC ";
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
        $empresa = $data->empresa;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $query = "SELECT listactrl_id,  listactrl_codigo FROM mm_listactrl  " .
                     " WHERE listactrl_empresa = '".$empresa ."' AND listactrl_estado ='A' " .
                     " ORDER BY listactrl_codigo DESC ";
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
       
    function llamaLista($data) 
    { 
        $id = $data->id;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $query = "SELECT lista_id,lista_empresa,lista_codigo,lista_inmueble,lista_propietario," .
                     " lista_asiste1,lista_asiste2,lista_asiste3,lista_asiste4," .
                     " lista_asiste5,lista_asiste6,lista_area,lista_coeficiente," .
                     " lista_cedula,lista_obervacion,lista_descripcion " .
                     " FROM mm_llamalista WHERE lista_codigo = " .
                     " (SELECT listactrl_codigo FROM mm_listactrl WHERE listactrl_id = ".$id .") ORDER BY lista_inmueble";       
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
    
    function datosLista($data){
        $id = $data->id;
        global $objClase;
        $con = $objClase->conectar();
        $query = "SELECT COUNT(*) AS nr  FROM mm_llamalista WHERE lista_codigo = " .
                     "  (SELECT listactrl_codigo FROM mm_listactrl WHERE listactrl_id = ".$id .")" . 
       " UNION SELECT listactrl_llamado AS nr FROM  mm_listactrl WHERE listactrl_id  = ".$id .
       " UNION SELECT listactrl_codigo AS nr FROM  mm_listactrl WHERE listactrl_id  = ".$id;
        
        $result = mysqli_query($con, $query);
        $nr='';
        if(mysqli_num_rows($result) != 0)
            { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $nr .= $row['nr'].'||';
               } 
            } 
        echo $nr;
    }
    
    
    
    function lista0($data) 
    { 
        $empresa = $data->empresa;
        global $objClase;
        $con = $objClase->conectar();	 
         $query = "SELECT listactrl_id, listactrl_codigo FROM mm_listactrl " .
                  " WHERE listactrl_empresa = '".$empresa ."' AND listactrl_estado ='A' " .
                  " ORDER BY listactrl_codigo";
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
    
    function visualizaLista($data){
        global $objClase;
        $codigo = $data->codigo;
        $empresa = $data->empresa;
        $con = $objClase->conectar();
        $lista = 0;
        $query = "SELECT listactrl_llamado FROM mm_listactrl  WHERE listactrl_empresa = '". $empresa.
                "' AND listactrl_codigo = '" . $codigo ."' ";
        $result = mysqli_query($con, $query); 
        if(mysqli_num_rows($result) != 0)
        {
            while($row = mysqli_fetch_assoc($result)) { 
                $lista = $row['listactrl_llamado']; 
            }              
        }        
        echo $lista;
    }
    

 function exportaXls($data){ 
        global $objClase;
        $con = $objClase->conectar(); 
        $empresa = $data->empresa; 
        $codigo = $data->codigo; 
        $expo=''; 
        $expo .= '<table border=1 class="table2Excel"> '; 
        $expo .=  '<tr> '; 
        $expo .=  '          <th>ID</th>';
        $expo .=  '          <th>EMPRESA</th>';
        $expo .=  '          <th>CODIGO</th>';
        $expo .=  '          <th>INMUEBLE</th>';
        $expo .=  '          <th>ASISTE1</th>';
        $expo .=  '          <th>ASISTE2</th>';
        $expo .=  '          <th>ASISTE3</th>';
        $expo .=  '          <th>ASISTE4</th>';
        $expo .=  '          <th>ASISTE5</th>';
        $expo .=  '          <th>ASISTE6</th>';
        $expo .=  '          <th>AREA</th>';
        $expo .=  '          <th>COEFICIENTE</th>';
        $expo .=  '          <th>PROPIETARIO</th>';
        $expo .=  '          <th>CEDULA</th>';
        $expo .=  '          <th>OBERVACION</th>';
        $expo .=  '          <th>DESCRIPCION</th>';
        $query = "SELECT  lista_id, lista_empresa, lista_codigo, lista_inmueble, ".
                 " lista_asiste1, lista_asiste2, lista_asiste3, lista_asiste4,".
                 " lista_asiste5, lista_asiste6, lista_area, lista_coeficiente, ".
                 " lista_propietario, lista_cedula, lista_obervacion, lista_descripcion " . 
                 " FROM mm_llamalista WHERE lista_empresa = '". $empresa .
                 "' AND lista_codigo = '" . $codigo . "' ORDER BY lista_inmueble ";             
            $result = mysqli_query($con, $query); 
            if(mysqli_num_rows($result) != 0)  
                { 
                    while($row = mysqli_fetch_assoc($result)) { 
                 $expo .=  '<tr> '; 
                $expo .=  	'<td>' .$row['lista_id']. '</td> ';
                $expo .=  	'<td>' .$row['lista_empresa']. '</td> ';
                $expo .=  	'<td>' .$row['lista_codigo']. '</td> ';
                $expo .=  	'<td>' .$row['lista_inmueble']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste1']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste2']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste3']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste4']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste5']. '</td> ';
                $expo .=  	'<td>' .$row['lista_asiste6']. '</td> ';
                $expo .=  	'<td>' .$row['lista_area']. '</td> ';
                $expo .=  	'<td>' .$row['lista_coeficiente']. '</td> ';
                $expo .=  	'<td>' .$row['lista_propietario']. '</td> ';
                $expo .=  	'<td>' .$row['lista_cedula']. '</td> ';
                $expo .=  	'<td>' .$row['lista_obervacion']. '</td> ';
                $expo .=  	'<td>' .$row['lista_descripcion']. '</td> ';
                 $expo .=  '</tr> '; 
                    } 
                } 
        $expo .=  '</table> ';  
        echo $expo; 
    return $expo; 
 }     
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Aug 26, 2018 10:18:56   <<<<<<< 
