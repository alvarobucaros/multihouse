<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

switch ($op)
{
    case 'cnt':   //  contactenos
        enviaCorreo($data);
        break;
    case 'eic':      // envia initacion comite
        enviaInvitacionComite($data);
        break;
}
   
function enviaCorreo($data){ 
    
    $objClase = new DBconexion(); 
    $con = $objClase->conectar(); 

    $query = "SELECT  empresa_nombre, empresa_nit, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo, "
            . " empresa_versionPrd,  empresa_versionBd, empresa_clave, empresa_email "
            . " FROM mm_empresa ";    
    $result = mysqli_query($con, $query); 
    while($row = mysqli_fetch_assoc($result)) { 
        $empresa=$row['empresa_nombre'].'||'. $row['empresa_nit'].'||'.
        $row['empresa_direccion'].'||'.$row['empresa_telefonos'].'||'.
        $row['empresa_ciudad'].'||'.$row['empresa_logo'].'||'.
        $row['empresa_versionPrd'].'||'.$row['empresa_versionBd'].'||'.
        $row['empresa_clave'].'||'.$row['empresa_email'];
    } 

    
    require_once( '../classes/Exception.php');
    require_once( '../classes/PHPMailer.php');
    require_once( '../classes/SMTP.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $dato = $data->dato; 
    $rec = explode("||",$dato);
    $mpre = explode("||",$empresa);
    $nombre = 'MMeeting'; //$rec[0];
    $tema = $rec[1];
    $address = $rec[2];
    $celular = $rec[3];

    $cuerpo= '<p>'.'Empresa: '.$mpre[0]. ' Nit: ' . $mpre[1]. ' Dirección: ' .$mpre[2]. ' Teléfono: ' . $mpre[3]. 
                ' Ciudad: ' .$mpre[4].'</p>';
     $cuerpo .= '<p>'.' APP: ' . $mpre[6]. ' DB: ' .$mpre[7]. '</p>';
     $cuerpo .= '<p>'.' Mensage: '. $rec[4]. '</p>'; 
    $emailFrom = $mpre[9];
    $nombreFrom=$mpre[0];
 //echo $emailFrom;    
    $mail->SMTPDebug = 2;
    
    $mail->setFrom($emailFrom, $nombre );
    $mail->addAddress($address, $nombreFrom );
    $mail->Subject  = $tema;
   // $mail->Body     = $message;
     $mail->MsgHTML($cuerpo);
    $mail->IsHTML(true); 
    $mail->CharSet="utf-8";
    $info='El mensaje se ha enviado';
    if(!$mail->send()) {
      $info = 'El mesaje no se pudo enviar: ';
      $info .= 'Error: ' . $mail->ErrorInfo;
    } 
    
    echo $info;
    return $info;
}

function enviaInvitacionComite($data){ 

    require_once( '../classes/Exception.php');
    require_once( '../classes/PHPMailer.php');
    require_once( '../classes/SMTP.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $dato = $data->dato; 
    $rec = explode("||",$dato);
 
    include_once("../bin/cls/citacion.class.php");
    $obj = new mm_agendamiento();
    $comite_td=$rec[0];
    $resultado = $obj->traeComite($comite_td);
   
    $reg = explode('||', $resultado);
    $comite_nombre = $reg[0]; 
    $comite_consecActa = $reg[1];  
    $salon_nombre = $reg[2]; 
    $agenda_Descripcion = $reg[3];  
    $salon_ubicacion = $reg[4];  
    $agenda_fechaDesde = $reg[5]; 
    $agenda_fechaHasta = $reg[6];
     
    $headMio= '<p><strong>Citaciòn a comité</strong></p><p>COMITE :  ' . $comite_nombre . ',  Tema :  ' . $agenda_Descripcion .'</p>';
    $headMio.= '<p>UBICACION :  ' . $salon_nombre . ' En : ' . $salon_ubicacion . '</p>';
    $headMio.= '<p>FECHA :  Desde' . $agenda_fechaDesde . ' Hasta : ' . $agenda_fechaHasta . '</p>';
    $headMio.= '<p><strong>Puntos a tratar</strong></p>';
 
    $objClase = new DBconexion(); 
    $con = $objClase->conectar(); 
    $dato = $data->dato; 
    $rec = explode('||',$dato) ;  
    $query = "SELECT  empresa_nombre, empresa_nit, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_email " .
             " FROM mm_empresa ";    
    $result = mysqli_query($con, $query); 
    while($row = mysqli_fetch_assoc($result)) { 
        $empresaNom=$row['empresa_nombre'].'||'. $row['empresa_nit'];
        $empresaDir = $row['empresa_direccion'].'||'.$row['empresa_telefonos'].'||'. $row['empresa_ciudad'];
        $mailRemite = $row['empresa_email'];
    } 
    $cuerpo= '<p>'.$empresaNom. '</p>';
    $cuerpo .= '<p>'.$empresaDir. '</p>';
    $invitado_id=0;
    $info='';
    $enviados=0;
    $mensaje='';
    $nombre = 'MMeeting';
    $tema = 'Citación Comité';
    
    $query = "SELECT invitado_id, invitado_nombre, invitado_empresa, invitado_cargo, invitado_celuar, invitado_email,  " .
             " tema_orden , tema_titulo, tema_detalle, tema_tipo, tema_responsable  " .
             " FROM mm_agendainvitados INNER JOIN mm_agendatemas ON invitado_agendaId = tema_agendaId   " .
             " WHERE invitado_agendaId = " .$rec[0] .
             " ORDER BY invitado_id, tema_orden ";
    $result = mysqli_query($con, $query); 

    while($row = mysqli_fetch_assoc($result)) {

        if($invitado_id != $row['invitado_id']){
            if($invitado_id != 0){
                $mail->SMTPDebug = 2;
                $mail->setFrom($mailRemite, $nombre );
                $mail->addAddress($address, $nombreFrom );
                $mail->Subject  = $tema;
                $mensaje .= '<br/>' . $cuerpo;
                $mail->MsgHTML($mensaje);
                $mail->IsHTML(true); 
                $mail->CharSet="utf-8";
                if(!$mail->send()) {
                    $info .= 'Error: ' . $mail->ErrorInfo;
                }else{$enviados +=1;} 
            }
            $address=  $row['invitado_email'];
            $nombreFrom = $row['invitado_nombre'];
            $invitado_id = $row['invitado_id'];
            $mensaje = '<p>Para : '.  $row['invitado_nombre'] . ' - ' .  $row['invitado_cargo'] . ' de  ' . $row['invitado_empresa'] . '</p><br/>' .  $headMio;
            //echo $mensaje . ' '. $address.' ' .$nombreFrom . '  '. $invitado_id;
        }
        $mensaje .= '<p><strong>'. $row['tema_orden'] . ' - ' .  $row['tema_titulo'] . '</strong> ' . $row['tema_detalle']; 
        if($row['tema_tipo'] != 'GRAL'){$mensaje .= '(tema pendiente)';}
        $mensaje .= '</p>';
        
    }   
    if ($mensaje != ''){
        $address=  $row['invitado_email'];
        $nombreFrom = $row['invitado_nombre'];
        $mail->SMTPDebug = 2;
        $mail->setFrom($mailRemite, $nombre );
        $mail->addAddress($address, $nombreFrom );
        $mail->Subject  = $tema;
        $mensaje .= '<br/>' . $cuerpo;
        $mail->MsgHTML($mensaje);
        $mail->IsHTML(true); 
        $mail->CharSet="utf-8";
        if(!$mail->send()) {
            $info .= 'Error: ' . $mail->ErrorInfo . '  ; ';
        }else{$enviados +=1;}  
    }
    if ($info == ''){
        $info= 'Ok||' . $enviados;
    }
    //  Actuaiza citacion y lo deja en firme
    $objClase = new DBconexion(); 
    $con = $objClase->conectar(); 
    $query = "UPDATE mm_agendamiento  SET agenda_enFirme = 'S', agenda_conCitacion = 'S'  WHERE agenda_id = "  .$comite_td;
    $result = mysqli_query($con, $query); 
    
    echo $info;
    return $info;
 
}