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
            $propietario =  $rec['propietarioNombre'];
            $cedula =  $rec['propietarioCedula'];
            $telProp = $rec['propietarioTelefonos'];
            $direc = TRIM($rec['propietarioDireccion']);
            $emailProp = $rec['propietarioCorreo'];
            $codigo =  $rec['inmuebleCodigo'];
            $nomInmueble = $rec['inmuebleDescripcion'];  
        }
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'CtaCobro';
        $logo = "logos/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  '. $cta;
        $titulo="RELACION DE INGESOS Y GASTOS PERIODO ".$periIni. " AL " .$periFin;
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
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->SetFont('Arial','',6);
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der+17,31);
        $y=$this->GetY();  
 
        $der +=5;
        $this->Line($der+6, $y, $der+140,$y);
        $this->SetFont('Arial','B',6);
        $this->SetXY($der+8,$y);
        $this->Cell(150,4,'FECHA                  DETALLE',0, 0 , 'L' );
        $this->SetXY($der+105,$y);
        $this->Cell(10,4,'VALOR',0, 0 , 'L' );
        $this->SetXY($der+125,$y);
        $this->Cell(10,4,'SALDO',0, 0 , 'L' );
        $this->SetFont('Arial','',6);
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
   
    
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
    $periIni = $_GET['pi'];
    $empresa = $_GET['em'];
    $periFin = $_GET['pf'];
    $y=36;
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();
    $result = $obj->reporteIngresosGastos($empresa, $periIni, $periFin);
    $saldo=0;
    if(mysqli_num_rows($result) != 0)  
    { 
        while( $rec = mysqli_fetch_assoc($resul) )
        {
            $fecha =  $rec['ingastoFecha'];
            $ref =  $rec['tipo'].' '.$rec['ingastodetalle'].' '.$rec['ingastoDocumento']; 
            $valor =  $rec['ingastovalor'];               
            if($rec['ingastotipo']==='G'){$valor = $valor * (-1); }
            $saldo = $saldo + $valor; 
            $pdf->SetXY($izq+9,$y);
            $pdf->Cell(60,4, $fecha,0, 0 , 'L' );
            $pdf->SetXY($izq+22,$y);
            $pdf->Cell(60,4, $ref,0, 0 , 'L' );
            $pdf->SetXY($izq+98,$y);
            $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+120,$y);
            $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
            $y +=4;           
        }  
        $pdf->SetXY($izq+120,$y);
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
 