<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $ciudad;
        public $today;
        public $pieTexto;
        public $logo;
        public $lugar;
        public $archivo;
        public $nomEmpre;
        public $nit;
        public $nomInmueble;
        public $propietario;
        
 function Header(){    
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();
        $pa = $_GET['pa'];
        $rec=  explode('|', $pa);
        $empresa = $rec[6];
        $reunion = $rec[7];
        $inmueble=$rec[0];
        $cta = 0;
        $der=0;

        $resultado = $obj->cargaEmpresa($empresa);
        while( $empre = mysqli_fetch_assoc($resultado) )
        {
            $nomEmpre = $empre['empresaNombre'];         
            $nit = 'NIT : ' .$empre['empresaNit'];
            $dir = 'DIRECCION : '.$empre['empresaDireccion'].' '.$empre['empresaCiudad'];   
            $tel = 'TELEFONO : '.$empre['empresaTelefonos']; 
            $mail = 'E-MAIL :' .$empre['empresaEmail'];  
            $this->logo = $empre['empresaLogo'];
            $this->ciudad = $empre['empresaCiudad'];
            $this->periodo = $empre['empresaPeriCierreFactura'];
        }

        $result = $obj->traeAptoPropietario($inmueble, $empresa);
        while( $rec = mysqli_fetch_assoc($result) )
        {
            $this->propietario =  $rec['propietarioNombre'];
            $cedula =  $rec['propietarioCedula'];
            $telProp = $rec['propietarioTelefonos'];
            $direc = TRIM($rec['propietarioDireccion']);
            $emailProp = $rec['propietarioCorreo'];
            $codigo =  $rec['inmuebleCodigo'];
            $this->nomInmueble = $rec['inmuebleDescripcion'];  
        }
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
        
        $titulo="PODER ";
        $this->Image($logo,$der+5,14,20,10,'png');

        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);
        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+25, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($der+25, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($der+25, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C');   
        $this->SetXY($der+25, 27);
        $this->Cell(80,6,utf8_decode($reunion),0,1,'C');  
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der+17,31);         
        $this->SetFont('Arial','',6);
    } 

        //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'PODER ESPECIAL PARA ASISTIR A REUNION.  IMPRESO EL: '.$hoy,0,0,'L');
        }
    }
   
  
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $pa = $_GET['pa'];
    $rec=  explode('|', $pa);
    $empresa = $rec[6];
    $reunion = $rec[7];
    $y=$pdf->GetY()+10; 
   
    $tit='PRESIDENTE(A) REUNION '.strtoupper($reunion);
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, utf8_decode('SEÑOR(A)'),0, 0 , 'L' );
    $y +=4;
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, utf8_decode($tit),0, 0 , 'L' );
    $y +=4;
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, 'CIUDAD',0, 0 , 'L' );
    $mes=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
        'Septiembre','Octubre','Noviembre','Diciembre');
    $y +=8;
    $pdf->SetXY(10,$y);
    $ce= explode('$',$rec[2]);
    $c1=$ce[1];
    $t1='ciudadanía';
    if($ce[0]==='X'){$t1='extrangería';}
    $ce = explode('$',$rec[4]);
    $c2=$ce[1];
    $t2='ciudadanía';
    if($ce[0]==='X'){$t2='extrangería';}

    $fe=explode('/',$rec[5]);
    $m = number_format($fe[1]);
    $hoy=  $fe[2] . ' de ' .$mes[$m]. ' de '.$fe[0].'.' ;
    $tit= 'Yo, '. utf8_decode($pdf->propietario).', mayor de edad, vecino de esta ciudad, identificado(a) con la cédula de '.$t1.
            ' número '. $c1.', en mi calidad de propietario del inmueble '. utf8_decode($pdf->nomInmueble).
            ', manifiesto que confiero poder amplio y suficiente al señor(a) '.$rec[3] .
            ', identificado(a) con la cédula de '.$t2.
            ' número '. $c2.', para que en mi nombre y representación asista a la reunión indicada, convocada para el día '.
            $hoy.
            ' Mi delegado(a) tiene facultades con voz y voto, de proponer, de decidir, de aprobar, de elegir '.
            'y proponer mi nombre para elección. '.
            'En caso de resultar elegido(a) también tiene facultades para representarme en las reuniones '.
            'que se convoquen y a las que yo no pueda asistir.';
    $pdf->SetXY(10,$y);
    $pdf->Multicell(128,4, utf8_decode($tit),0, 'L' );
    $y=$pdf->GetY()+6; 
    $pdf->SetXY(10,$y);
    $tit = 'Este poder será suficiente para una nueva fecha si la reunión es suspendida o para el caso de requerirse '.
            'una eventual segunda convocatoria o citación a la reunión, si no se logra realizar en la primera '.
            'por falta de quórum';
    $pdf->Multicell(128,4, utf8_decode($tit),0,'L' );
    $y=$pdf->GetY()+6; 
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, 'Atentamente,',0, 0 , 'L' );
    $y=$pdf->GetY()+8; 
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, 'Firma del poderdante:  ______________________________________________ ,',0, 0 , 'L' );
    $y+=4;
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4,  utf8_decode('Cédula Nro.'),0, 0 , 'L' );
    $y=$pdf->GetY()+8; 
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4, 'Firma del apoderado:  ______________________________________________ ,',0, 0 , 'L' );
    $y+=4;
    $pdf->SetXY(10,$y);
    $pdf->Cell(60,4,  utf8_decode('Cédula Nro.'),0, 0 , 'L' );

    $info = 'PoderEspecial'.'.pdf';
    $pdf->close();
$pdf->Output($info,'D'); 
 ?> 
 
