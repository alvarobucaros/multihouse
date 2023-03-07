<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $id;
        public $empresa;
        public $propietarioId;
        public $inmueble;
        public $pieTexto;
        public $today;
        public $logo;
        public $archivo;
        public $desc = 0;

 function Header(){    
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();   
        $this->id = $_GET['id'];
        $this->empresa = $_GET['em'];
        $this->propietarioId = $_GET['pr'];
        $this->inmueble = $_GET['in'];
        $desc = 0;
        $der=0;

        $resultado = $obj->cargaEmpresa($this->empresa);
        while( $empre = mysqli_fetch_array($resultado) )
        {
            $nomEmpre = $empre['empresaNombre'];         
            $nit = 'NIT : ' .$empre['empresaNit'];
            $dir = 'DIRECCION : '.$empre['empresaDireccion'].' '.$empre['empresaCiudad'];   
            $tel = 'TELEFONO : '.$empre['empresaTelefonos']; 
            $mail = 'E-MAIL :' .$empre['empresaEmail'];  
            $this->logo = $empre['empresaLogo'];
        }
        $result = $obj->cabezaAcuerdoPago($this->id, $this->empresa);

        while( $rec = mysqli_fetch_array($result) )
        {
            $acuerdodetalle= $rec['acuerdodetalle'];
            $acuerdovalor = $rec['acuerdovalor'];
            $acuerdofecha = $rec['acuerdofecha'];
            $acuerdoplazo = $rec['acuerdoplazo'];
            $acuerdodetalle= $rec['acuerdodetalle'];
            $acuerdodescmora= $rec['acuerdodescmora'];              
        }
        $tit01 = "Acuerdo de pago Nr. " . $this->id . " de " . $acuerdofecha . "  por valor de $" . number_format($acuerdovalor, 2, '.', ',');
        $tit01 .= " para pagar en ". $acuerdoplazo . " Cuotas. Descuento en mora aplicado :  " .$acuerdodescmora;
        $this->desc = $acuerdodescmora;
        $result = $obj->traeAptoPropietario($this->inmueble, $this->empresa);
        while( $rec = mysqli_fetch_array($result) )
        {
            $propietario =  $rec['propietarioNombre'];
            $cedula =  $rec['propietarioCedula'];
            $telProp = $rec['propietarioTelefonos'];
            $direc = trim($rec['propietarioDireccion']);
            $emailProp = $rec['propietarioCorreo'];
            $codigo =  $rec['inmuebleCodigo'];
            $nomInmueble = $rec['inmuebleDescripcion'];  
        }
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'AcuerdoPago';
        $logo = "../img/".$this->logo;
     
        $titulo="ACUERDO DE PAGO";
//        $this->Image($logo,$der+5,14,20,10);

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
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
       // $this->SetFont('Arial','',6);
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der+17,31);
        $y=$this->GetY();  

        $der=12;
        $this->SetXY($der+28,$y);
        $this->Cell(150,4,'INMUEBLE : ',0, 0 , 'L' );
        $this->SetXY($der+50,$y);
        $this->Cell(150,4,$codigo.' '.$nomInmueble,0, 0 , 'L' );
        $y +=4;
        $this->SetXY($der+28,$y);
        $this->Cell(150,4,'PROPIETARIO : ',0, 0 , 'L' );
        $this->SetXY($der+50,$y);
        $this->Cell(150,4,$cedula.' '.utf8_decode($propietario),0, 0 , 'L' );     
        $y +=4;
        $this->SetXY($der+50,$y);
        $this->Cell(150,4,$direc.'  Tel: '. $telProp,0, 0 , 'L' ); 
        $y +=4;
        $der=20;
        $this->SetXY($der,$y);
        $this->Cell(150,4,$tit01,0, 0 , 'L' ); 
        $y +=4;
        $this->SetXY($der,$y);
        $this->Cell(150,4,$acuerdodetalle,0, 0 , 'L' ); 
        $y +=4;
        $this->SetXY($der,$y);
        $this->Cell(150,4,'RELACION DE LA DEUDA ACORDADA',0, 0 , 'L' );
        $y +=4;
        $der=10;

        $this->Line($der, $y, $der+140,$y); 
        $this->SetFont('Arial','B',6);
        $this->SetXY($der+2,$y);
        $this->Cell(150,4,'PERIODO     FACTURA             DETALLE',0, 0 , 'L' );
        $this->SetXY($der+95,$y);
        $this->Cell(10,4,'SALDO',0, 0 , 'L' );
        $this->SetXY($der+105,$y);
        $this->Cell(10,4,'DECUENTO',0, 0 , 'L' );
        $this->SetXY($der+120,$y);
        $this->Cell(10,4,'SUBTOTAL',0, 0 , 'L' );
        $this->SetFont('Arial','',6);
        $y +=4;
        $this->Line($der, $y, $der+140,$y); 
        $this->SetXY($der,$y);

    } 

        //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'REPORTE: INGRESOS Y GASTOS.  IMPRESA EL: '.$hoy,0,0,'L');
        }
    }
   
    
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
   
    $empresa = $pdf->empresa;
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls(); 
    $periodo='000000';
    $inmueble = $pdf->inmueble;
    $propietarioId = $pdf->propietarioId;
    $result = $obj->preparaReimpresionFactura($periodo, $empresa, $inmueble, 'A', $propietarioId);
  //  $pdf->MultiCell(132,4, utf8_decode( $result ) );
  
//    facturaid, facturaEmpresaid, facturaNumero, facturaInmuebleid, facturaservicioid, ".
//            " facturaperiodo, facturasecuencia, facturavalor, facturadetalle, facturafechafac,  ".
//            " facturafechavence, facturafechacontrol, facturasaldo, facturaprioridad, facturadescuento,  ".
//            " facturaMora,facturaNroReciboPago, facturaTipo, facturaPropietario, facturaDiasMora,  ".
//            " facturaMoraInmuebId
//        
        $y=59;
        $saldo=0;
        $izq=1;
        while( $rec = mysqli_fetch_array($result) )
        {
            $fecha =  $rec['facturafechafac'];
            $ref =  $rec['facturadetalle']; 
            $valor =  $rec['facturasaldo']; 
            $porc= $rec['facturasaldo']; 
            $menos=0;
            if($rec['facturaTipo']==='M'){$menos = $valor * $desc / 100; }
            $saldo = $saldo + $valor - $menos; 
            $pdf->SetXY($izq+12,$y);
            $pdf->Cell(60,4, $rec['facturaperiodo'],0, 0 , 'L' );
            $pdf->SetXY($izq+20,$y);
            $pdf->Cell(60,4, substr($rec['facturaNumero'],5,6),0, 0 , 'L' );
            $pdf->SetXY($izq+28,$y);
            $pdf->Cell(60,4, $ref,0, 0 , 'L' );
            $pdf->SetXY($izq+98,$y);
            $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+108,$y);
            $pdf->Cell(20,4,number_format($menos, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+130,$y);
            $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
            $y +=4;           
        }  
        $pdf->SetXY($izq+120,$y);
        $pdf->Cell(20,4,'----------------',0,0,'R');
//    }
//    else {
//        $pdf->SetXY($izq+9,$y);
//        $pdf->Cell(60,4, 'En este periodo No hay informacion a mostrar',0, 0 , 'L' ); 
//    }
// 
    $info = $pdf->archivo.$periIni.'-'.$periFin.'.pdf';
    $pdf->close();
$pdf->Output($info,'D'); 
 ?> 
 