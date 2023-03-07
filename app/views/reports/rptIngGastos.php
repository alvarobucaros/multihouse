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
        
 function Header(){    
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();
        $periIni = $_GET['pi'];
        $empresa = $_GET['em'];
        $periFin = $_GET['pf'];
   
        $me= array('31','28','31','30','31','30','31','31','30','31','30','31');
        $m = ( int ) substr($periFin,4,2) -1;
        $periFin=substr($periFin,0,4).$me[$m];
        $cta = 0;
        $der=80;

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

//        $result = $obj->traeAptoPropietario($inmueble, $empresa);
//        while( $rec = mysqli_fetch_assoc($result) )
//        {
//            $propietario =  $rec['propietarioNombre'];
//            $cedula =  $rec['propietarioCedula'];
//            $telProp = $rec['propietarioTelefonos'];
//            $direc = TRIM($rec['propietarioDireccion']);
//            $emailProp = $rec['propietarioCorreo'];
//            $codigo =  $rec['inmuebleCodigo'];
//            $nomInmueble = $rec['inmuebleDescripcion'];  
//        }
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
     //   $yeyo=$periodo .'  '. $empresa  .'  '. $cta;
        $titulo="RELACION DE INGESOS Y GASTOS PERIODO ".$periIni. " AL " .$periFin;
        $this->Image($logo,25,14,20,10,'png');

        $this->SetFont('Arial','B',12);

        $this->SetFont('Courier','B',12); //Fuente, Negrita, tamaño
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetFillColor(31,73,125);
        $this->SetXY(90, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C');
 
        $this->SetXY(100, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        
        $this->SetXY(100, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C');   
        $this->SetFont('Arial','',8); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+140,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+140,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+140,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->SetFont('Arial','',8);
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der,31);
        $y=$this->GetY();  
 
        $der +=5;
        $this->Line(10, $y, $der+200,$y);
        $this->SetFont('Arial','B',8);
        $this->SetXY(15,$y);
        $this->Cell(50,4,'FECHA         TIPO  COMPNTE DOCMNTO	              DETALLE',0, 0 , 'L' );
        $this->SetXY($der+55,$y);
        $this->Cell(150,4,'TERCERO',0, 0 , 'L' );
        $this->SetXY($der+158,$y);
        $this->Cell(10,4,'VALOR',0, 0 , 'L' );
        $this->SetXY($der+180,$y);
        $this->Cell(10,4,'SALDO',0, 0 , 'L' );
        $y +=4;
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
 
    $pdf = new PDF('L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $periIni = $_GET['pi'];
    $empresa = $_GET['em'];
    $periFin = $_GET['pf'];
    $y=36;
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();
    $result = $obj->reporteIngresosGastos($empresa, $periIni, $periFin);
    $saldo=0;
    $izq=15;
    if(mysqli_num_rows($result) != 0)  
    { 
        while( $rec = mysqli_fetch_assoc($result) )
        {
            $fecha =  $rec['ingastoFecha'];
            $tercero = $rec['terceroIdenTipo'].'-'.$rec['terceroIdenNumero'].' '.$rec['terceroNombre'];
            $ref = $rec['ingastodetalle'];
            $valor =  $rec['ingastovalor'];               
            if($rec['ingastotipo']==='G'){$valor = $valor * (-1); }
            $saldo = $saldo + $valor; 
            $pdf->SetXY($izq,$y);
            $pdf->Cell(60,4, $fecha,0, 0 , 'L' );
            $pdf->SetXY($izq+17,$y);
            $pdf->Cell(60,4, $rec['tipo'],0, 0 , 'L' );
            $pdf->SetXY($izq+30,$y);
            $pdf->Cell(60,4, $rec['ingastocomprobante'],0, 0 , 'L' );
            $pdf->SetXY($izq+50,$y);
            $pdf->Cell(60,4, $rec['ingastoDocumento'],0, 0 , 'L' );
            $pdf->SetXY($izq+65,$y);       
            $pdf->Cell(60,4, $ref,0, 0 , 'L' );
            $pdf->SetXY($izq+120,$y);             
            $pdf->Cell(60,4, $tercero,0, 0 , 'L' );
            $pdf->SetXY($izq+225,$y);
            $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+245,$y);
            $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
            $y +=4;           
        }  
        $pdf->SetXY($izq+245,$y);
        $pdf->Cell(20,4,'----------------',0,0,'R');
    }
    else {
        $pdf->SetXY($izq+9,$y);
        $pdf->Cell(60,4, 'En este periodo No hay informacion a mostrar',0, 0 , 'L' ); 
    }
 
    $info = 'ingresosGastos'.$periIni.'-'.$periFin.'.pdf';
    $pdf->close();
$pdf->Output($info,'D'); 
 ?> 
 