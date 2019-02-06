<?php  
     class mm_agendamiento{ 
        function traeComite($comite_td){
            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();	
            $query = " SELECT  comite_nombre,  comite_consecActa, salon_nombre, agenda_Descripcion, " .
                     " salon_ubicacion, agenda_fechaDesde, agenda_fechaHasta, agenda_ProxCitacion, " .
                     " agenda_acta, comite_id " .
                     " FROM  mm_comites " .  
                     " INNER JOIN mm_agendamiento ON agenda_comiteId = comite_id " .
                     " INNER JOIN mm_salones  ON agenda_salonId = salon_id " .
                     " WHERE agenda_id = " . $comite_td;
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
        
        function traeTemasComite($comite_td){
            include_once("../modulos/mod_mm_llamalista.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            if($con==true)
            {
                $query = "SELECT tema_titulo, tema_detalle, tema_tipo, tema_responsable, tema_orden, " .
                        " tema_desarrollo, tema_fechaAsigna, tema_fechaCumple ".
                     " FROM mm_agendatemas WHERE tema_agendaId =  ". $comite_td .
                     " ORDER BY tema_orden ";
                $result = mysqli_query($con, $query);
                return $result;                            
            }
            else{
                return 'No hay conexion a la BD. ';
            }
        }
        
        function traeInitadosComite($comite_td){
            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            if($con==true)
            {
                $query = "SELECT invitado_id, invitado_agendaId, invitado_nombre, invitado_empresa,  " .
                     " invitado_cargo, invitado_celuar, invitado_email, invitado_asistio, invitado_titulo, invitado_orden  " .
                     " FROM mm_agendainvitados " .
                     " WHERE invitado_agendaId =  ". $comite_td .
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
        
    }

