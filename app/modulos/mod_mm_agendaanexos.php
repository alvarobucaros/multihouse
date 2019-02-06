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
    case 'fch':
        traeAnno($data);
        break;
    
    case 'lo':
        loadLogo($data);
        break;
    
    case 'av':
        loadAvatar($data);
        break;
}
  
    function  leeRegistros($data) 
    { 
        $empresa = $data->empresa;
        $comite = $data->comite;
        $agenda = $data->agenda;
        
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
       { 
            $query = "SELECT anexos_id,anexos_empresa, anexos_comiteid, anexos_agendaid, anexos_usuario, anexos_anno," .
                    " anexos_anexo, anexos_ruta, anexos_fecha, anexos_descripcion ".
                    " FROM mm_agendaanexos WHERE anexos_empresa = " .$empresa . 
                    "  AND anexos_comiteid = " . $comite . " AND  anexos_agendaid = " . $agenda .
                    "  ORDER BY anexos_anexo ";   
//echo $query;
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
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $anexos_id = 0; 
        $query = "DELETE FROM mm_agendaanexos WHERE anexos_id=$data->anexos_id"; 
        mysqli_query($con, $query); 
        echo 'Ok'; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $anexos_id =  $data->anexos_id; 
        $anexos_comiteid =  $data->anexos_comiteid; 
        $anexos_agendaid =  $data->anexos_agendaid; 
        $anexos_anexo =  $data->anexos_anexo; 
        $anexos_descripcion =  $data->anexos_descripcion; 
        $anexos_empresa = $data->anexos_empresa;
        $anexos_usuario = $data->anexos_usuario;
        $anexos_anno = $data->anexos_anno;
        $anexos_ruta = $data->anexos_ruta;
        $anexos_fecha = $data->anexos_fecha;
        
        if($anexos_id  == 0) 
        { 
           $query = "INSERT INTO mm_agendaanexos(anexos_empresa, anexos_comiteid, anexos_agendaid, anexos_usuario," .
                    "  anexos_anno, anexos_anexo, anexos_ruta, anexos_fecha, anexos_descripcion )";
           $query .= "  VALUES ('" .$anexos_empresa . "', '" . $anexos_comiteid."', '".$anexos_agendaid."', '".anexos_usuario.
                     "', '".$anexos_anno. "', '" . $anexos_anexo."', '". $anexos_ruta. "', '" . anexos_fecha.
                     "', '". anexos_descripcion."')";  
//SELECT anexos_id,anexos_empresa, anexos_comiteid, anexos_agendaid, anexos_usuario, anexos_anno, anexos_anexo, anexos_usuario, anexos_anno, FROM mm_agendaanexos;        
            mysqli_query($con, $query);
            echo 'Ok';
        } 
        else 
        { 
            $query = "UPDATE mm_agendaanexos  SET anexos_comiteid = '".$anexos_comiteid."', anexos_agendaid = '".$anexos_agendaid."', anexos_anexo = '".$anexos_anexo."', anexos_descripcion = '".$anexos_descripcion."' WHERE anexos_id = ".$anexos_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $anexos_id = $data->anexos_id;      
        $query = "SELECT  anexos_id, anexos_comiteid, anexos_agendaid, anexos_anexo, anexos_descripcion  " . 
                    " FROM mm_agendaanexos  WHERE anexos_id = " . $anexos_id  . 
                    " ORDER BY anexos_anexo "; 
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
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
         $empresa = $data->empresa;
         $query = "SELECT comite_id, comite_nombre FROM mm_comites WHERE comite_empresa = " . $empresa ." ORDER BY comite_nombre";
//echo $query;
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
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $empresa = $data->empresa;
        $comite = $data->comite;
        $query = "SELECT agenda_id, " .
                 " concat('Acta : ',  agenda_acta , ' Detalle : ', agenda_Descripcion, ' Del : ',agenda_fechaDesde) as agenda_Descripcion " .
                 " FROM mm_agendamiento WHERE agenda_empresa = " . $empresa .
                 " AND agenda_conCitacion = 'S' AND agenda_enFirme = 'S' AND agenda_comiteId = ". $comite . 
                 " ORDER BY agenda_acta DESC ";
//      echo $query;
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
 
    function traeAnno($data){
        $agenda = $data->agenda;
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $query = "SELECT YEAR(agenda_fechaDesde) AS anno FROM mm_agendamiento WHERE agenda_id = " . $agenda;
        $result = mysqli_query($con, $query);
        $anno='';
        while ($row = mysqli_fetch_assoc($result)) {
            $anno = $row['anno'];
        }
        echo $anno;
        return $anno;
    }
    
    function loadLogo($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $empresa = $data->empresa;
        $query = "SELECT empresa_logo  FROM mm_empresa  WHERE empresa_id = ".$empresa;
                $result = mysqli_query($con, $query);
        $logo='';
        while ($row = mysqli_fetch_assoc($result)) {
            $logo = $row['empresa_logo'];
        }
        echo $logo;
        return $logo;
    }
 
    function loadAvatar($data){
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
        $empresa = $data->empresa;
        $usuario = $data->usuario;
        $query = " SELECT usuario_avatar  FROM mm_usuarios  WHERE usuario_id = ".$usuario . "  AND usuario_empresa = " . $empresa ;
                $result = mysqli_query($con, $query);
        $avatar='';
        while ($row = mysqli_fetch_assoc($result)) {
            $avatar = $row['usuario_avatar'];
        }
        echo $avatar;
        return $avatar;
    }
  
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 23, 2018 5:18:20   <<<<<<< 
