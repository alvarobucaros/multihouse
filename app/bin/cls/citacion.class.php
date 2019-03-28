<?php  
     class mm_agendamiento{ 
        function traeComite($agenda_id){
            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();	
            $query = " SELECT  comite_nombre,  comite_consecActa, salon_nombre, agenda_Descripcion, " .
                     " salon_ubicacion, agenda_fechaDesde, agenda_fechaHasta, agenda_ProxCitacion, " .
                     " agenda_acta, comite_id " .
                     " FROM  mm_comites " .  
                     " INNER JOIN mm_agendamiento ON agenda_comiteId = comite_id " .
                     " INNER JOIN mm_salones  ON agenda_salonId = salon_id " .
                     " WHERE agenda_id = " . $agenda_id;
            $result = mysqli_query($con, $query); 
                      
            while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )
            {
                $retorno = $reg['comite_nombre'].'||'.$reg['comite_consecActa'].'||'.
                        $reg['salon_nombre'].'||'.$reg['agenda_Descripcion'].'||'.
                        $reg['salon_ubicacion'].'||'.
                        $reg['agenda_fechaDesde'].'||'.$reg['agenda_fechaHasta'].'||'.$reg['agenda_ProxCitacion'].'||'.
                        $reg['comite_id'];  
            }
            echo $retorno;
            return $retorno;   
        }
        
        function traeTemasComite($agenda_id){
            include_once("../modulos/mod_mm_llamalista.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            if($con==true)
            {
                $query = "SELECT tema_titulo, tema_detalle, tema_tipo, tema_responsable, tema_orden, " .
                        " tema_desarrollo, tema_fechaAsigna, tema_fechaCumple ".
                     " FROM mm_agendatemas WHERE tema_agendaId =  ". $agenda_id .
                     " ORDER BY tema_orden ";
                $result = mysqli_query($con, $query);
                return $result;                            
            }
            else{
                return 'No hay conexion a la BD. ';
            }
        }
        
        function traeInitadosComite($agenda_id){
            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            if($con==true)
            {
                $query = "SELECT invitado_id, invitado_agendaId, invitado_nombre, invitado_empresa,  " .
                     " invitado_cargo, invitado_celuar, invitado_email, invitado_asistio, invitado_titulo, invitado_orden, invitado_comite, invitado_empresaID  " .
                     " FROM mm_agendainvitados " .
                     " WHERE invitado_agendaId =  ". $agenda_id .
                     " ORDER BY invitado_orden  ";
                $result = mysqli_query($con, $query);
                return $result;                            
            }
            else{
                return 'No hay conexion a la BD. ';
            }
        }
        
        function traeAnexos($empresa,$comite, $agenda){
            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            if($con==true)
            {
                $query = "SELECT anexos_id, anexos_empresa, anexos_comiteid, anexos_agendaid, anexos_anexo, " .
                         " anexos_descripcion, anexos_ruta, anexos_usuario, anexos_fecha  FROM mm_agendaanexos  " .
                         " WHERE anexos_empresa =  ". $empresa . " AND anexos_comiteid = " . $comite ." AND anexos_agendaid = " . $agenda;  
                         " ORDER BY anexos_descripcion  ";
                $result = mysqli_query($con, $query);
                return $result;                            
            }
            else{
                return 'No hay conexion a la BD. ';
            }
        }
        
    function llamaLista($empresa, $codigo) 
    { 
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();	 
        $query = "SELECT lista_id,lista_empresa,lista_codigo,lista_inmueble,lista_propietario," .
                     " lista_asiste1,lista_asiste2,lista_asiste3,lista_asiste4," .
                     " lista_asiste5,lista_asiste6,lista_area,lista_coeficiente," .
                     " lista_cedula,lista_obervacion,lista_descripcion " .
                     " FROM mm_llamalista WHERE lista_codigo = " . $codigo .
                     " AND lista_empresa = '" . $empresa . " ORDER BY lista_inmueble";       
         $result = mysqli_query($con, $query); 
      echo $result; 
    }
    
     function consultaAgendas($data)
    {
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
     //   $dato = $data->dato; 
        $rec = explode('||',$data) ;
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
                " invitado_cargo, invitado_celuar, Concat(invitado_asistio,'|',invitado_causa), invitado_agendaId  " .
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
                 
                return $result;    

    }
    
        
    }

