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
    case '1':
        lista1($data);
        break;
    case '2':
        buscaRegistroComite($data);
        break;
    case 'nc':
        nombreComite($data);
        break;  
    case 'ns':
        nombreSalon($data);
        break; 
    case 'rc':
        recuperaComites($data);
        break; 
    case 'hr':
        comboHoras($data);
        break;
    case 'ha':
        habilitaAgenda($data);
        break;
    case 'dc':
        detalleComite($data);
        break;
    case 'dtl':
        deleteTercerosLista($data); 
        break;
    case 'dtm':
        deleteTema($data); 
        break;       
    case 'atl':
        adicionaTercerosLista($data);
        break;
    case 'ara':
        actualizaReunionAgendada($data);
        break;
    case 'ctl':
        cambiaTercerosLista($data);
        break;  
    case 'cra':
        CierraActa($data);
        break;      
    case 'ctml':       
        cambiaTemaLista($data);
        break;
    case 'sel':
        siguenteEnLista($data);
        break;
    
    case 'lur':
        leeUnRegistro($data);
        break;
    
    case 'ti':
        traeInvitados($data);
        break;
    case 'tt':
        traeTemas($data);
        break;

    case 'atm':
        adicionaTema($data);
        break;
    
    case 'rfa':
        recuperaFormatoActa($data);
        break;
    
    case 'conv':
        convocatoria($data);
        break;
    
    case 'cnslta':
        consultaAgendas($data);
        break;
    
    case 'excel':
        exportaConsulta($data);
        break;
    
    case 'reor':
        reorganiza($data);
        break;
}

    function  leeRegistros($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT  agenda_id, agenda_empresa, agenda_salonId, agenda_Descripcion, agenda_comiteId, " .
                    " agenda_fechaDesde, agenda_fechaHasta, agenda_comiteAnteriorId, agenda_usuario, agenda_enFirme, " .
                    " agenda_conCitacion, agenda_acta, agenda_estado,agenda_causal " .
                    " FROM mm_agendamiento ORDER BY agenda_empresa ";  
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
 
    
function  leeUnRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $agenda_id = $data->agenda_id;  
        $empresa = $data->empresa;
        $query = "SELECT agenda_empresa, agenda_salonId, agenda_Descripcion, agenda_comiteId, " .
                " agenda_fechaDesde, agenda_fechaHasta, agenda_comiteAnteriorId, agenda_usuario, " .
                " agenda_enFirme, agenda_conCitacion, agenda_acta, salon_nombre, comite_nombre, agenda_id, " .
                " agenda_estado, agenda_causal FROM mm_agendamiento " .
                " INNER JOIN mm_salones ON agenda_salonId = salon_id " .
                " INNER JOIN mm_comites ON agenda_comiteId = comite_id " .
                " WHERE agenda_id = " .   $agenda_id . ' AND agenda_empresa = '.$empresa;
 
        $result = mysqli_query($con, $query); 
            while($row = mysqli_fetch_assoc($result)) { 
                $info=$row['agenda_empresa'].'||'.$row['agenda_salonId'].'||'.$row['agenda_Descripcion'].'||'.
                        $row['agenda_comiteId'].'||'.$row['agenda_fechaDesde'].'||'.$row['agenda_fechaHasta'].'||'.
                        $row['agenda_comiteAnteriorId'].'||'.$row['agenda_usuario'].'||'.$row['agenda_enFirme'].'||'.
                        $row['agenda_conCitacion'].'||'.$row['agenda_acta'].'||'.
                        $row['salon_nombre'].'||'.$row['comite_nombre'].'||'.$row['agenda_id'].'||'.
                        $row['agenda_estado'].'||'.$row['agenda_causal'].'||'.$agenda_id;
           } 
        echo $info;
       return $info;
    } 

    function borra($data)
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $agenda_id = 0; 
        $query = "DELETE FROM mm_agendamiento WHERE agenda_id=$data->agenda_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $dato = $data->dato; 
        $rec = explode('||',$dato) ;        
        $fchDsde=$rec[5] .":" . $rec[7];
        $fchHsta=$rec[6] .":" . $rec[8]; 
        $fDsde=$rec[5] ." " . $rec[7].":00";
        $fHsta=$rec[6] ." " . $rec[8].":00";  
        $agenda_id=$rec[11];
   
            if ($agenda_id==='0'){
                $query = "INSERT INTO mm_agendamiento (agenda_empresa, agenda_salonId, " . 
                       " agenda_Descripcion, agenda_comiteId, agenda_fechaDesde, agenda_fechaHasta,  " . 
                       " agenda_comiteAnteriorId, agenda_usuario, agenda_enFirme, agenda_conCitacion, agenda_acta, " . 
                       " agenda_estado, agenda_causal) VALUES ('";
                $query .=  $rec[3] ."', '" . $rec[9] ."', '" . $rec[1] ."', '" .
                          $rec[0] ."', '" . $fchDsde ."', '" . $fchHsta ."', '" .
                          $rec[2] ."', '" . $rec[10] ."', 'N','N','0','A','')";

                mysqli_query($con, $query);
                $last_id = $con->insert_id;
                $$agenda_id = $last_id;
// echo $query.'  '.$agenda_id;
                $query = "INSERT INTO mm_agendainvitados (invitado_agendaId, invitado_nombre, invitado_empresa, " . 
                       " invitado_cargo, invitado_celuar, invitado_email, invitado_asistio, invitado_titulo, " . 
                       " invitado_orden, invitado_causa, invitado_comite, invitado_empresaID )" . 
                       " SELECT " . $last_id. " AS agenda_id, " . 
                       " asistente_nombre, asistente_empresa, asistente_cargo, asistente_celuar, " . 
                       " asistente_email , 'S', asistente_titulo, 0 as orden,'', asistente_comite, asistente_empresaId " . 
                       " FROM mm_asistentes WHERE asistente_comite = " . $rec[0];
                mysqli_query($con, $query);

                $query = "INSERT INTO mm_agendatemas (tema_agendaId, tema_empresa, tema_comite, tema_titulo,  " . 
                       " tema_detalle, tema_tipo, tema_responsable, tema_desarrollo, tema_fechaAsigna,  " . 
                       " tema_fechaCumple, tema_estado, tema_orden) " . 
                       " SELECT " . $last_id. " AS agenda,  " . 
                       " temasGrales_empresa, temasGrales_comiteId,  temasGrales_titulo, temasGrales_detalle,  " . 
                       " 'GRAL' as tipo, '' as responsable, '' as desarrollo, '" . $fchDsde . "' AS fechaA, '' as fechaC,  " . 
                       " temasGrales_estado, 0 as orden  " . 
                       "  FROM mm_temasgrales WHERE temasGrales_estado = 'A' AND temasGrales_comiteId  = " . $rec[0];
                mysqli_query($con, $query);

                       $query = "INSERT INTO mm_agendatemas (tema_agendaId, tema_empresa, tema_comite, tema_titulo,  " . 
                       " tema_detalle, tema_tipo, tema_responsable, tema_desarrollo, tema_fechaAsigna,  " . 
                       " tema_fechaCumple, tema_estado, tema_orden) " . 
                       " SELECT " . $last_id. " AS  tema_agendaId, " .
                       " tema_empresa, tema_comite, tema_titulo, tema_detalle, tema_tipo, tema_responsable, tema_desarrollo, " .
                       " tema_fechaAsigna, tema_fechaCumple, tema_estado, tema_orden FROM mm_agendatemas WHERE tema_tipo='PDNT' " .
                       " AND tema_comite = " . $rec[0] . " AND tema_estado = 'A' " .
                       " AND tema_agendaId = (  SELECT MAX(tema_agendaId) FROM  mm_agendatemas WHERE tema_tipo='PDNT' AND " .
                       " tema_comite = " . $rec[0] . " ) ";
                mysqli_query($con, $query);
                $orden = 1;
                $query = "SELECT invitado_id FROM mm_agendainvitados WHERE invitado_agendaId = " .  $last_id;
                $result = mysqli_query($con, $query); 
                if(mysqli_num_rows($result) !== 0)                   
                { 
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['invitado_id'];
                        $query = "UPDATE mm_agendainvitados SET invitado_orden = " . $orden . "  WHERE invitado_id = " .  $id;
                        $orden += 1;
                        $resultar = mysqli_query($con, $query); 
                    } 
                }
                $orden = 1;
                $query = "SELECT tema_id FROM mm_agendatemas WHERE tema_agendaId = " .  $last_id;
                $result = mysqli_query($con, $query); 
                if(mysqli_num_rows($result) != 0)                   
                { 
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['tema_id'];
                        $query = "UPDATE mm_agendatemas SET tema_orden = " . $orden . "  WHERE tema_id = " .  $id;
                        $orden += 1;
                        $resultar = mysqli_query($con, $query); 
                    } 
                }

                echo 'Ok||'.$last_id.'||C';
            } 
            else 
            { 
                $query = "UPDATE mm_agendamiento  SET agenda_empresa = '".$rec[3].
                        "', agenda_salonId = '".$rec[9]."', agenda_Descripcion = '".$rec[1].
                        "', agenda_comiteId = '".$rec[0]."', agenda_fechaDesde = '".$fDsde.
                        "', agenda_fechaHasta = '".$fHsta."', agenda_comiteAnteriorId = '".$rec[2].
                        "', agenda_usuario = '".$rec[10]."' WHERE agenda_id = ".$agenda_id;
                mysqli_query($con, $query); 
                echo 'Ok||'.$agenda_id.'||U';
            } 

        }

    function buscaRegistroComite($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $comite_id = $data->comite_id;     
        $query = "SELECT agenda_id, CONCAT(agenda_Descripcion, ' De Fecha  ', SUBSTR(agenda_fechaDesde, 1, 10) " .
                 ", ' Hora inicio  ', SUBSTR(agenda_fechaDesde, 11, 7)) AS detalle  ".
                 " FROM mm_agendamiento WHERE agenda_estado = 'A' " .
                " AND agenda_enFirme = 'N' AND agenda_conCitacion = 'N' AND agenda_comiteId = " . $comite_id;
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
    
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $agenda_id = $data->agenda_id;      
        $query = "SELECT  agenda_id, agenda_empresa, agenda_salonId, agenda_Descripcion, agenda_comiteId, " .
                 " agenda_fechaDesde, agenda_fechaHasta, agenda_comiteAnteriorId, agenda_usuario, " .
                 " agenda_enFirme, agenda_conCitacion, agenda_acta, agenda_estado,agenda_causal " . 
                 " FROM mm_agendamiento  WHERE agenda_id = " . $agenda_id  . 
                 " ORDER BY agenda_empresa "; 
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
 
    function actualizaReunionAgendada($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $resp='';
        $datos = $data->datos; 
        $rec = explode("||",$datos);
        if($rec[3]=='Anula'){
            $resp="La reunipon ha sido anulada, para habilitarla de nuevo ir a: Desarrollo de reunión, actas ";
            $query = "UPDATE mm_agendamiento SET agenda_estado   = '".$rec[2] . 
                  "',  agenda_causal = '" .  $rec[1] . 
                  "' WHERE agenda_id = " . $rec[0];
        }
        else{
            $query='falta';
        }    
        $result = mysqli_query($con, $query); 
        $resp='Ok||'.$resp;
        echo $resp;
        return $resp;
    }
	 
    function lista0($data) 
    { 
        $empresa = $data->empresa;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $query = "SELECT salon_id,  salon_nombre FROM mm_salones WHERE salon_empresa = " . $empresa .
                 " AND salon_activo = 'A' ORDER BY  salon_nombre";
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
        $query = "SELECT comite_id,  comite_nombre FROM mm_comites WHERE  comite_empresa = " . $empresa .
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
 
    function nombreComite($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $comite_id = $data->comiteId;
        $empresa_id = $data->empresa; 
        $query = "SELECT comite_descripcion, comite_consecActa, comite_id FROM mm_comites WHERE comite_id =  " .$comite_id . 
                ' AND comite_empresa = ' . $empresa_id; 
      
        $result = mysqli_query($con, $query); 
        $info='';
        
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $info=$row['comite_descripcion'].'||'.$row['comite_consecActa'].'||'.$row['comite_id'];
           } 
        }
        $condicions=" agenda_estado = 'A' " .
                " AND agenda_enFirme = 'N' AND agenda_conCitacion = 'N' AND agenda_comiteId = " . $comite_id;         
        $nr=$objClase->cuentaRegistros('mm_agendamiento', $condicions);
              
        echo $info.'||'.$nr;
    }
 
    function detalleComite($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $comite_id = $data->comiteId; 
        $agendaId=0;
        $query="SELECT agenda_id, agenda_empresa, agenda_salonId, salon_nombre, agenda_Descripcion, agenda_comiteId, comite_nombre, ".
                "agenda_fechaDesde, agenda_fechaHasta, agenda_comiteAnteriorId, agenda_usuario, agenda_enFirme , agenda_conCitacion ".
                " FROM mm_agendamiento ".
                " INNER JOIN mm_comites ON agenda_comiteId = comite_id".
                " INNER JOIN mm_salones ON agenda_salonId = salon_id ".
                " WHERE agenda_comiteId = " . $comite_id . " AND agenda_enFirme= 'S' AND agenda_conCitacion = 'S' AND agenda_acta = 0";
        $result = mysqli_query($con, $query); 
        $info='';
         if(mysqli_num_rows($result) != 0)
         { 
             while($row = mysqli_fetch_assoc($result)) 
            {
                $agendaId=$row['agenda_id'];
                 $info= 'Comité: ' .$row['comite_nombre'] . ' ('. $row['agenda_Descripcion'] . ') Salón: '.$row['salon_nombre'] .
                        ', Desde: ' .$row['agenda_fechaDesde'] . ' Hasta: '.$row['agenda_fechaHasta'] .'||'. $row['agenda_id'] ;
                                          
            } 
         }
        else {
             $info = "NO HAY";
       }             
       echo $info;
       return $info;
     }
     

     function traeInvitados($data){    
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $arr = array(); 
        $agendaId = $data->agenda_id; 
        $empresa=$data->empresa;
        $query=" SELECT invitado_id, invitado_orden, invitado_nombre, invitado_empresa, invitado_cargo, invitado_asistio , " . 
               " CASE invitado_titulo WHEN 'S' THEN 'Secretario' WHEN 'T' THEN 'Transcriptor' WHEN 'P' " . 
               " THEN 'Presidente' ELSE '' END AS  invitado_titulo, invitado_celuar, invitado_email, invitado_comite, invitado_empresaId ".
               " FROM mm_agendainvitados  WHERE invitado_agendaId = " . $agendaId . " AND invitado_empresaId = " .$empresa . 
               " ORDER BY invitado_orden " ;       
        $result = mysqli_query($con, $query);
//echo $query;        
        if(mysqli_num_rows($result) != 0)  
          { 
              while($row = mysqli_fetch_assoc($result)) { 
                  $arr[] = $row; 
              } 
              $info = json_encode($arr); 
          }else{
              $info= 'No Hay';
        }
    
        echo $info;
        return $info;
     }
    
     
    function  deleteTercerosLista($data){
       $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $arr = array(); 
        $invitado_id = $data->invitado_id; 
        $query=" DELETE FROM mm_agendainvitados WHERE invitado_id =  " . $invitado_id;
        $result = mysqli_query($con, $query);
        $info = 'Ok';
        echo $info;
        return $info;
     }
    
    function deleteTema($data){
       $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $arr = array(); 
        $tema_id = $data->tema_id; 
        $query=" DELETE FROM mm_agendatemas WHERE tema_id = " . $tema_id;
        $result = mysqli_query($con, $query);
        $info = 'Ok';
        echo $info;
        return $info;
    } 
     
    function adicionaTercerosLista($data){
       $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $datos = $data->datos;    
        $invitado_orden = 0;
        $rec = explode("||",$datos);
        $query = "SELECT max(invitado_orden) + 1 AS orden FROM mm_agendainvitados";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) != 0)  
          { 
              while($row = mysqli_fetch_assoc($result)) { 
                  $invitado_orden = $row['orden']; 
              } 
          }
        $query="INSERT INTO mm_agendainvitados (invitado_agendaId, invitado_nombre, invitado_empresa, " . 
               " invitado_cargo, invitado_celuar, invitado_email, invitado_asistio, invitado_titulo, invitado_orden, invitado_causa, " .
                "invitado_comite, invitado_empresaId) " . 
               " VALUES ($rec[9], '". $rec[1] . "', '". $rec[3] . "', '". $rec[2] . "', '". $rec[10] . "', '". $rec[11] . 
               "','S','" . $rec[5] . "', '".$invitado_orden."','',". $rec[0] . ",". $rec[13] . ") ";
        $result = mysqli_query($con, $query);      
        $info = 'Ok';
        echo $info;
        return $info;
     }
        
     function cambiaTercerosLista($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $datos = $data->datos; 
        $invitado_orden = 0;
        $rec = explode("||",$datos);
        if($rec[12]==0){  
            $query = "SELECT  IFNULL(count(*), 0) as Nr FROM mm_agendainvitados WHERE invitado_nombre = '" . $rec[1] . "'";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)) { 
                  $Nr = $row['Nr']; 
              } 
            if($Nr==0){                      
        $query="INSERT INTO mm_agendainvitados (invitado_agendaId, invitado_nombre, invitado_empresa, " . 
               " invitado_cargo, invitado_celuar, invitado_email, invitado_asistio, invitado_titulo, invitado_orden, invitado_causa, " .
                "invitado_comite, invitado_empresaId) " .                     
                    
               " VALUES (" .$rec[9] . ", '" .$rec[1] . "', '" .$rec[3] . "', '" .
                $rec[2] . "', '" . $rec[10] . "', '" . $rec[11] . "', '". $rec[4] . "', '" .
                $rec[5] . "', '" . $rec[8] . "','','". $rec[0] . "', '" . $rec[14] . "')" ;      
        
            }
        }
        
      else {
        $query="UPDATE mm_agendainvitados SET
                invitado_agendaId =  " .$rec[9] . ", " .
                " invitado_nombre =  '" .$rec[1] . "', " .
                " invitado_empresa =  '" .$rec[3] . "', " .
                " invitado_cargo =  '" .$rec[2] . "', " .
                " invitado_asistio =  '" .$rec[4] . "', " .
                " invitado_titulo =  '" .$rec[5] . "', " .
                " invitado_orden = '" .$rec[8] . "', " .
                " invitado_causa =  '" .$rec[6] . "', " .
                " invitado_celuar = '" .$rec[10] . "', " .
                " invitado_email= '" .$rec[11] . "' " .
                " WHERE invitado_id = " .$rec[12];      
        }
        
        $result = mysqli_query($con, $query);
        $info = 'Ok';
        echo $info;
        return $info;
     }   

     function siguenteEnLista($data){    
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $agenda_id = $data->agenda_id;
        $opc=$data->opc;
        $orden = 1;
       
        if ($opc=='I'){
        $query = "SELECT IFNULL(MAX(invitado_orden), 0) + 1  AS orden FROM mm_agendainvitados " .
                " WHERE invitado_agendaId = " . $agenda_id;
        }
        else{
        $query = "SELECT IFNULL(MAX(tema_orden), 0) + 1 AS orden FROM mm_agendatemas " .
                " WHERE tema_agendaId = " . $agenda_id;   
        }

        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) != 0)  
          { 
              while($row = mysqli_fetch_assoc($result)) { 
                  $orden = $row['orden']; 
              } 
          }
          echo $orden;
          return $orden;
     }
     
     function traeTemas($data){     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $arr = array(); 
        $agendaId = $data->agenda_id; 
        $empresa=$data->empresa;

        $query="SELECT tema_id, tema_titulo, tema_detalle, tema_tipo, tema_responsable, ".
        " tema_desarrollo, tema_fechaAsigna, tema_fechaCumple, tema_estado, tema_orden, tema_agendaId, tema_comite " .
        " FROM mm_agendatemas ".
        " WHERE tema_agendaId = " . $agendaId . ' AND tema_empresa = ' . $empresa . ' ORDER BY tema_orden ';    
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) != 0)  
          { 
              while($row = mysqli_fetch_assoc($result)) { 
                  $arr[] = $row; 
              } 
              $info = json_encode($arr); 
          }else{
              $info= 'No Hay';
        }
        echo $info;
        return $info;   
     }
     
     function adicionaTema($datos){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $datos = $datos->datos; 
        $rec = explode("||",$datos);
        $tipo="GRAL";
        if ( $rec[6] != 'G'){$tipo="PDNT";}

        if($rec[0] == 0){        
            $tema_orden=0;
            $query="select max(tema_orden) + 1 As orden from mm_agendatemas where tema_agendaId =  ".  $rec[0];
                    $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0)  
              { 
                  while($row = mysqli_fetch_assoc($result)) { 
                      $tema_orden = $row['orden']; 
                  } 
              }       
            $query="INSERT INTO mm_agendatemas (tema_agendaId, tema_empresa, tema_comite, tema_titulo, tema_detalle, ".
                   " tema_tipo, tema_responsable,  tema_fechaAsigna,  tema_estado, tema_orden,  tema_fechaCumple, tema_desarrollo ) ".
                   " VALUES (" . $rec[1] . ", " .$rec[2] . ", '" . $rec[3] . "', '" . $rec[4] . "', '" . $rec[5] . 
                    "', '" . $tipo . "', '" .   $rec[7] .  "', '" . $rec[9] . "', '" .
                    $rec[11] . "', '" .   $rec[13] .  "','".$rec[8]."', '" . $rec[10] . "')";
           
        }else{
            $query = "UPDATE mm_agendatemas SET " .
                " tema_agendaId = '" . $rec[1] . "', " .
                " tema_empresa = '" . $rec[2] . "', " .
                " tema_comite = '" . $rec[3] . "', " .
                " tema_titulo ='" . $rec[4] . "', " .
                " tema_detalle = '" . $rec[5] . "', " .
                " tema_tipo = '" . $tipo . "', " .
                " tema_responsable = '" . $rec[7] . "', " .
                " tema_fechaCumple = '" . $rec[8] . "', " .
                " tema_fechaAsigna = '" . $rec[9] . "', " .
                " tema_desarrollo = '" . $rec[10] . "', " .
                " tema_estado = '" . $rec[11] . "', " .
                " tema_orden = " . $rec[13] . " " .  
               "  WHERE tema_id = '" . $rec[0] . "' ";
        }

        $result = mysqli_query($con, $query);
        $info='Ok'; 
        echo $info;
        return $info;   
     }
   
     function cambiaTemaLista($datos){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $datos = $datos->datos;
        $rec = explode("||",$datos);
        $tema_orden=0;
        $tipo = 'GRAL';
        if($rec[6]=='P'){$tipo = 'PNTE';}
        if($rec[9] > 0){
        $query = " UPDATE mm_agendatemas SET " .
            " tema_titulo = '" . $rec[0] . "', " .
            " tema_detalle = '" . $rec[1] . "', " .
            " tema_tipo = '" . $tipo . "', " .
            " tema_responsable = '" . $rec[3] . "', " .
            " tema_desarrollo = '" . $rec[2] . "', " .
            " tema_fechaAsigna = '" . $rec[7] . "', " .
            " tema_fechaCumple = '" . $rec[8] . "', " .
            " tema_estado = '" . $rec[4] . "', " .
            " tema_orden = '" . $rec[5] . "' " .
            " WHERE tema_id = " . $rec[9];
        }
        else{
            
        }
        $result = mysqli_query($con, $query);
        $info='Ok';

        echo $info;
        return $info;                   
     }
      
     
    function recuperaComites($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $comite_Id = $data->comite_Id; 
        $empresa = $data->empresa;
        $param = $data->param;
        $arr = array(); 
        $query = "SELECT agenda_id, salon_nombre, agenda_Descripcion, agenda_fechaDesde, ".
                 " agenda_fechaHasta,CASE agenda_enFirme WHEN 'S' THEN 'Si' ELSE  'No' END agenda_enFirme , ".
                 " CASE agenda_conCitacion  WHEN 'S' THEN 'Si' ELSE  'No' END agenda_conCitacion, agenda_acta, agenda_estado, agenda_causal, ".
                 " CASE agenda_estado WHEN 'A' THEN ' ' ELSE 'Aplazada' END agenda_observa, agenda_cierraActa ".
                 " FROM mm_agendamiento ".
                 " INNER JOIN mm_salones ON agenda_salonId = salon_id ".
                 " WHERE agenda_comiteId  = " .  $comite_Id . ' AND agenda_empresa = '.$empresa .
                 " AND agenda_acta > 0 ";
        if($param =='excluye'){
           $query .= "  AND (agenda_enFirme='S' AND agenda_conCitacion='S' ) OR agenda_estado = 'I' ORDER BY agenda_fechaDesde DESC, agenda_acta DESC";
        }
        
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) != 0)  
          { 
              while($row = mysqli_fetch_assoc($result)) { 
                  $arr[] = $row; 
              } 
              $info = json_encode($arr); 
          }else{
              $info= 'No Hay';
        }
        echo $info;
        return $info;
    }
    
    function habilitaAgenda($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $agenda_id = $data->agenda_id;
        $parametro = $data->parametro;
        
        $query = "update  mm_agendamiento SET agenda_enFirme = 'S', agenda_conCitacion = 'S', agenda_revisa = agenda_acta, agenda_acta = 0";
        if($parametro == 'I'){  
            $query .=  ", agenda_estado ='A' ,agenda_causal = ''";}       
        $query .=  " WHERE agenda_id = " . $agenda_id;
                $result = mysqli_query($con, $query);
        $info='Ok';
        
        echo $info;
        return $info; 
    }
    
    function nombreSalon($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $salon_id = $data->salonId;      
        $query = "SELECT salon_nombre, salon_id FROM mm_salones WHERE salon_id =  " .$salon_id ; 
        $result = mysqli_query($con, $query); 
        $info='';
        
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $info=$row['salon_nombre'];
           } 
        }
        echo $info;
    }  
    
    function recuperaFormatoActa($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $empresa_id = $data->empresa;  
        $formatoActa='Estandard';
        $query = "SELECT empresa_FormatoActa FROM mm_empresa WHERE empresa_id = " .$empresa_id ; 
        $result = mysqli_query($con, $query); 

        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $formatoActa=$row['empresa_FormatoActa'];
           } 
        }
        echo  $formatoActa;
        return $formatoActa;
    }
    
    function comboHoras($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $empresa_id = $data->empresaId;  
        $query = "DELETE FROM mm_temp01 WHERE hora > '' ";
        $result = mysqli_query($con, $query); 
        $query = "SELECT  empresa_horarioInicio, empresa_horarioTermina, empresa_intervaloCalendario ".
                 " FROM mm_empresa WHERE empresa_id=" .$empresa_id ; 
        $result = mysqli_query($con, $query); 

        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $horarioInicio=$row['empresa_horarioInicio'];
                $horarioTermina=$row['empresa_horarioTermina'];
                $intervaloCalendario=$row['empresa_intervaloCalendario'];
           } 
        }
 
    $ini=strpos($horarioInicio,':',0);
    $horaIni= substr($horarioInicio, 0,$ini);
    $minuIni = substr($horarioInicio,$ini+1);
    $ini=strpos($horarioTermina,':',0);
    $horaFin= substr($horarioTermina, 0,$ini);
    $minuFin = substr($horarioTermina,$ini+1);

    $minuAux=$minuIni;
    $horas=array();
    $json='[';
    $ok=true;
    while ($ok){
        $am='pm';
        if($horaIni<12){
            $am='am';
        }
        
        $hratmp=$horaIni;
        $horaAux=$horaIni;
        if($horaIni<10){
            $hratmp='0'.$horaIni;
        }
        if($horaAux>12){$horaAux-=12;}
            $json .= '{hora:"' .$hratmp.':'.$minuAux . '" , detalle:"'.$horaAux.':'.$minuAux.' '.$am. '"}'; 
            
            $query = " INSERT INTO mm_temp01(hora,detalle) VALUES('"   .$hratmp. ":" .$minuAux . 
                    "','" .$horaAux. ":". $minuAux . " " .$am. "')";

            $result = mysqli_query($con, $query); 
       if($horaIni<$horaFin){
           if($intervaloCalendario=='M'){
               if($minuAux==='00')
               {
                  $minuAux='30'; 
               }
               else
               {
                  $minuAux='00'; 
                  $horaIni+=1;
               }
           }
                      else
               {
                  $horaIni+=1;  
               }
       }else{
        $ok=false;
       }
       if($ok){$json .= ',';}
    }
    $json .= "];";
  
        $query = "SELECT hora,detalle FROM mm_temp01 ORDER BY hora  "; 
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

    function consultaAgendas($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $dato = $data->dato; 
        $rec = explode('||',$dato) ;
        $fi = $rec[3] . " 00:00:00";
        $ff = $rec[4] . " 23:55:00";
        $where = "agenda_empresa = " . $rec[6]. " AND agenda_fechaDesde > '". $fi . "'  AND agenda_fechaHasta < '". $ff . "'".
                 " AND agenda_acta >= ". $rec[1] . " AND  agenda_acta <= ". $rec[2] ; 
        $whereTema = "";
        $whereAnexos = "";
        $whereInvitado="";
        if($rec[5] != ''){ $whereTema = " WHERE  (tema_titulo LIKE '%". $rec[5] ."%' OR tema_detalle  LIKE '%". $rec[5] .
                                        "%' OR tema_desarrollo  LIKE '%". $rec[5] ."%' )";}
        if($rec[7] != ''){ $whereAnexos = " (anexos_anexo = '%". $rec[7] ."%' OR anexos_descripcion = '%". $rec[7] ."%' ) ";  }  
        if($rec[8] != ''){ $whereInvitado = " WHERE (invitado_nombre = '%". $rec[8] ."%' OR invitado_cargo = '%". $rec[8] ."%' ) ";  }  
        if ($rec[0] >  0 ){ $where .= " AND agenda_comiteId = ". $rec[0];}   
        
        $query = " SELECT agenda_id, agenda_Descripcion, agenda_fechaDesde, agenda_fechaHasta, agenda_enFirme, " .
                " agenda_conCitacion, agenda_acta, agenda_estado ,agenda_causal , comite_nombre , comite_id, 'Tema' as tp," .
                " CONCAT(tema_tipo, ': ', tema_titulo, ' ', tema_detalle) tema,  tema_desarrollo,  tema_responsable, " .
                " CONCAT(tema_fechaAsigna, ' ', tema_fechaCumple) fechaDesde_Hasta, tema_agendaId  " .
                " FROM mm_agendamiento  " . 
                " LEFT JOIN mm_agendatemas ON tema_agendaId = agenda_id  " .
                " LEFT JOIN mm_comites ON comite_id = agenda_comiteId" .
                $whereTema . 
                " UNION  " .
                " SELECT agenda_id, agenda_Descripcion, agenda_fechaDesde, agenda_fechaHasta, agenda_enFirme,   " .
                " agenda_conCitacion, agenda_acta, agenda_estado ,agenda_causal ,  comite_nombre ,invitado_comite, 'Invitado' as tp, invitado_nombre,  " .
                " invitado_cargo, invitado_celuar, invitado_asistio, invitado_agendaId  " .
                " FROM mm_agendamiento  " .
                " LEFT JOIN mm_agendainvitados ON invitado_agendaId = agenda_id  " . 
                " LEFT JOIN mm_comites ON comite_id = agenda_comiteId" .
                $whereInvitado ;
                if($rec[9] != 'N'){
                $query .= " UNION  " .
                " SELECT agenda_id, agenda_Descripcion, agenda_fechaDesde, agenda_fechaHasta, agenda_enFirme,   " .
                    " agenda_conCitacion, agenda_acta, agenda_estado ,agenda_causal , comite_nombre , anexos_comiteid, 'Anexo' as tp, anexos_anexo,  " .
                    " anexos_descripcion, '' as a, '' as b , anexos_agendaid  " .
                    " FROM mm_agendamiento  " .
                    " LEFT JOIN mm_agendaanexos ON anexos_agendaid = agenda_id  " . $whereAnexos .
                    " LEFT JOIN mm_comites ON comite_id = agenda_comiteId" ;
                }
        $query .=  " WHERE " . $where .                          
                "  ORDER BY comite_id desc, agenda_id, tp Desc ";       

        $result = mysqli_query($con, $query); 
        if($rec[10] === 'P'){
            $agenda=0;
            $arr = array(); 
            if(mysqli_num_rows($result) != 0)
            { 
                while($row = mysqli_fetch_assoc($result)) {
                    if ($agenda != $row['agenda_id']){
                    $arr[] = $row;
                    $agenda = $row['agenda_id'];
                 }
                }
            } 
            echo $json_info = json_encode($arr); 
        }  else {
            echo $result;
            return $result;
        }
    }
    
    function CierraActa($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        if($con ){
            $empresa = $data->empresa;
            $agenda = $data->agenda;
            $query = "UPDATE mm_agendamiento SET agenda_cierraActa = 'S'" .
                    " WHERE agenda_empresa = '" . $empresa . "' AND agenda_id = '" .
                    $agenda ."' ";    
            $result = mysqli_query($con, $query); 

                echo "Acta cerrada Ok";
                return;
          
        }
    }

 function convocatoria($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $dt = $data->datos; 
        $dato = explode('||',$dt) ;
        $acta=0;
        $agenda_revisa=0;
        $query = "SELECT agenda_acta, agenda_revisa FROM mm_agendamiento  WHERE agenda_id = " . $dato[1] . " AND agenda_empresa = " . $dato[2];     
        $result = mysqli_query($con, $query); 
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $acta=$row['agenda_acta'];
                $agenda_revisa = $row['agenda_revisa'];
           } 
        }
        
        if ($acta == 0){
            if ($agenda_revisa > 0){
                $acta = $agenda_revisa;
            }
            else{
                $query = "UPDATE  mm_comites SET comite_consecActa =  comite_consecActa + 1 WHERE comite_id = " . $dato[0] . 
                        "  AND comite_empresa = " . $dato[2];
                $result = mysqli_query($con, $query); 
                $query = "SELECT comite_consecActa FROM mm_comites WHERE comite_id = " . $dato[0] . " AND comite_empresa = " . $dato[2];
                $result = mysqli_query($con, $query); 
                while($row = mysqli_fetch_assoc($result)) { 
                    $acta=$row['comite_consecActa'];            
                    }
            }
        }
        
        $query = "UPDATE mm_agendamiento SET agenda_ProxCitacion = '" . $dato[3] . "', agenda_acta = " . $acta . ", agenda_revisa = 0" .
                 " WHERE agenda_id = " . $dato[1] . " AND agenda_empresa = " . $dato[2];
        $result = mysqli_query($con, $query);
        $info = 'Ok||Se ha Creado/Actualizado el acta '.$acta;
        echo $info;
 }   
 
 function reorganiza($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $dato = $data->datos; 
        $rec = explode('||',$dato) ;
        $arr = array(); 
        if($rec[0]=='T'){
            $query = "SELECT tema_id, tema_titulo, tema_orden FROM mm_agendatemas " .
                     " WHERE tema_empresa='" . $rec[2]. "' AND tema_agendaId= '".$rec[3]. "' ORDER BY tema_orden;";
            $result = mysqli_query($con, $query); 
            $nr=0;
            while($reg = mysqli_fetch_assoc($result)) 
            {
                $nr +=1;
                $id = $reg['tema_id'];
                $query = "UPDATE mm_agendatemas SET tema_orden = " . $nr . ' WHERE tema_id = '. $id;
                $resultado = mysqli_query($con, $query); 
            }
            $query="SELECT tema_id, tema_titulo, tema_detalle, tema_tipo, tema_responsable, ".
            " tema_desarrollo, tema_fechaAsigna, tema_fechaCumple, tema_estado, tema_orden, tema_agendaId, tema_comite " .
            " FROM mm_agendatemas ".
            " WHERE tema_agendaId = '".$rec[3]. "' AND tema_empresa = '" . $rec[2]. "'  ORDER BY tema_orden;";   
            $resultado = mysqli_query($con, $query);
            echo $query;
        }
        else{
            $query = "SELECT invitado_id, invitado_orden FROM mm_agendainvitados  " .
                     " WHERE invitado_empresaID = '" . $rec[2]. "' AND invitado_agendaId = '".$rec[3]. "' ORDER BY invitado_orden";
            $result = mysqli_query($con, $query); 
            $nr=0;
            while($reg = mysqli_fetch_assoc($result)) 
            {
                $nr +=1;
                $id = $reg['invitado_id'];
                $query = "UPDATE mm_agendainvitados SET invitado_orden = " . $nr . ' WHERE invitado_id = '. $id;
                $resultado = mysqli_query($con, $query); 
            }            
            
            $query=" SELECT invitado_id, invitado_orden, invitado_nombre, invitado_empresa, invitado_cargo, invitado_asistio , " . 
           " CASE invitado_titulo WHEN 'S' THEN 'Secretario' WHEN 'T' THEN 'Transcriptor' WHEN 'P' " . 
           " THEN 'Presidente' ELSE '' END AS  invitado_titulo, invitado_celuar, invitado_email, invitado_comite, invitado_empresaId ".
           " FROM mm_agendainvitados  WHERE invitado_agendaId = " . $agendaId . " AND invitado_empresaId = " .$empresa . 
           " ORDER BY invitado_orden " ;       
            $result = mysqli_query($con, $query);
//echo $query;        
        }
        if(mysqli_num_rows($resultado) != 0)  
          { 
              while($row = mysqli_fetch_assoc($resultado)) { 
                  $arr[] = $row; 
              } 
              $info = json_encode($arr); 
          }else{
              $info= 'No Hay';
        }
        echo $info;
        return $info;  
        // var datos =  'T||'+$scope.comite_id+'||'+empresa+'||'+$scope.agenda_id;
 }
 
 function exportaConsulta($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $dato = $data->dato; 
        $rec = explode('||',$dato) ;
        $fi = $rec[3] . " 00:00:00";
        $ff = $rec[4] . " 23:55:00";
    
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=  	"<th>DETALLE</th>";
        $expo .=  	"<th>FECHA</th>";
        $expo .=  	"<th>ACTA</th>";
        $expo .=  	"<th>ESTADO</th>";
        $expo .=  	"<th>TITULO</th>";
        $expo .=  	"<th>DETALLE</th>";
        $expo .=  "</tr> ";

           $query = "SELECT agenda_id, agenda_Descripcion, agenda_fechaDesde, agenda_enFirme,  ".
                 " agenda_conCitacion, agenda_acta, agenda_estado ,agenda_causal , tema_titulo, tema_detalle  ".
                 " FROM mm_agendamiento  ".
                 " LEFT JOIN mm_agendatemas ON tema_agendaId = agenda_id  ".
                 " WHERE agenda_empresa = ". $rec[6] . " AND agenda_comiteId = ". $rec[0] .
                 " AND agenda_fechaDesde > '". $fi . "'  AND agenda_fechaDesde < '". $ff . "'".
                 " AND agenda_acta >= ". $rec[1] . " AND  agenda_acta <= ". $rec[2] ; 
        if( $rec[5] != ''){
            $query .= "AND (tema_titulo LIKE '%".$rec[5]."%' OR  tema_detalle  LIKE '%".$rec[5]."%')" ;  
                }
                $result = mysqli_query($con, $query); 
            while($reg = mysqli_fetch_assoc($result)) 

        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".($reg["agenda_Descripcion"])."</td> ";
            $expo .=  	"<td>".$reg["agenda_fechaDesde"]."</td> ";
            $expo .=  	"<td>".$reg["agenda_acta"]."</td> ";            
            $expo .=  	"<td>".$reg["agenda_estado"]."</td> ";
            $expo .=  	"<td>".($reg["tema_titulo"])."</td> ";
            $expo .=  	"<td>".($reg["tema_detalle"])."</td> ";            
            $expo .=  "</tr> ";
        }        
         $expo .=  "</table> "; 
         echo $expo;
    return;
 }   
    
    
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Nov 27, 2017 9:41:16   <<<<<<< 

