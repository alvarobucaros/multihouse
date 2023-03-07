<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {

    function Header()
    { 
        $dt =  explode(',',$_GET['dt']);   
        $periodo =  $dt[0];       
        $empresa = $dt[4];
        $nivel = $dt[1];
        $ctaIni = $dt[2];
        $ctaFin = $dt[3];
        $hoy= date("d-m-Y");
//        include_once("../modulos/mod_contaReportContable.php");
//        $obj = new  reportesContCls();
//        $resultado = $obj->cargaEmpresa($empresa);
//        while( $empre = mysqli_fetch_array($resultado) )
//        {
//            $nomEmpre = $empre['empresaNombre'];         
//            $nit = 'NIT : ' .$empre['empresaNit'];
//            $dir = 'DIRECCION : '.$empre['empresaDireccion'].' '.$empre['empresaCiudad'];   
//            $tel = 'TELEFONO : '.$empre['empresaTelefonos']; 
//            $mail = 'E-MAIL :' .$empre['empresaEmail'];  
//            $this->logo = $empre['empresaLogo'];
//            $this->ciudad = $empre['empresaCiudad'];
//        }

        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();   
        $resultado = $obj->cargaEmpresa($empresa);
         while($empre = mysqli_fetch_assoc($resultado))
         {
            $nomEmpre = $empre['empresaNombre'];         
            $nit = 'NIT : ' .$empre['empresaNit'];
            $dir = 'DIRECCION : '.$empre['empresaDireccion'].' '.$empre['empresaCiudad'];   
            $tel = 'TELEFONO : '.$empre['empresaTelefonos']; 
            $mail = 'E-MAIL :' .$empre['empresaEmail'];  
            $this->logo = $empre['empresaLogo'];
            $this->ciudad = $empre['empresaCiudad'];           
        }         
        
        
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
        $der=0;

        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);

        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  ';
        $titulo="SALDOS CONTABLES";
        $subtitulo="Periodo ".$periodo. " Desde cuenta: ". $ctaIni . " Hasta cuenta : " . $ctaFin ;
         $this->Image($logo,15,14,20,10);
 //       $this->Image($logo,$der+5,14,20,10);    
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);
        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+55, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($der+55, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($der+55, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 
        $this->SetFont('Arial','',8); 
        $this->SetXY($der+55, 27);
        $this->Cell(80,6,utf8_decode($subtitulo),0,1,'C');
   
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+155,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+155,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+155,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->Line($der+6, 35, 200, 35);        
        $y=$this->GetY();  
        $this->SetXY(60,34);
        $this->Cell(55,6, "CUENTA  "); $this->SetXY(110,34);
        $this->Cell(30,6,'INICIO PERIODO',0,0,'R');$this->SetXY(135,34);
        $this->Cell(30,6,'MOVIMIENTO',0,0,'R');$this->SetXY(160,34);
        $this->Cell(30,6,'FINAL PERIODO',0,0,'R');
        $this->Line(6, 39, 200, 39);
        $y=$this->GetY();        
    }

    //Pie de página  
    function Footer()
        {
        date_default_timezone_set('America/Bogota');
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'REPORTE: Saldos contables.  Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }

    $dt =  explode(',',$_GET['dt']);   
    $periodo =  $dt[0];       
    $empresa = $dt[4];
    $nivel = $dt[1];
    $ctaIni = $dt[2];
    $ctaFin = $dt[3];
    $hoy= date("Y-m-d");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
 
    $ln=0;
    $y=$pdf->GetY();  
    $y+=4;
    $pdf->SetXY(6,$y);
    
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->saldosContables($empresa, $nivel, $periodo, $ctaIni, $ctaFin);
    $y=$pdf->GetY();
    $y+=4;
    $sumIni=0.0;
    $sumMvto=0.0;
    $sumFin=0.0;
    while($row = mysqli_fetch_assoc($resultado) )
    {
        $saldoIni=$row['saldcontInicialDb']  - $row['saldcontInicialCr']  ;
        $movimiento= $row['saldcontDebitos']  - $row['saldcontCreditos'];
        $saldoFin = $saldoIni + $movimiento;    
        $sumIni+=$saldoIni;
        $sumMvto+=$movimiento;
        $sumFin+=$saldoFin;          
        $pdf->SetXY(40,$y);   
        $pdf->Cell(16,4,$row['saldcontCuentaContable'],0,0,'L');$pdf->SetXY(50,$y);
        $pdf->Cell(16,4,$row['pucNombre'],0,0,'L');$pdf->SetXY(110,$y);
        $pdf->Cell(30,4,number_format($saldoIni, 2, '.', ','),0,0,'R');$pdf->SetXY(135,$y);    
        $pdf->Cell(30,4,number_format($movimiento, 2, '.', ','),0,0,'R');$pdf->SetXY(160,$y);
        $pdf->Cell(30,4,number_format($saldoFin, 2, '.', ','),0,0,'R');
        $y+=4; 
    } 
$y-=2;
$pdf->SetXY(110,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(135,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(160,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');
$y+=2;
$pdf->SetXY(80,$y);
$pdf->Cell(12,4,'Totales:',0,0,'R');
$pdf->SetXY(110,$y);
$pdf->Cell(30,4,number_format($sumIni, 2, '.', ','),0,0,'R');$pdf->SetXY(135,$y);    
$pdf->Cell(30,4,number_format($sumMvto, 2, '.', ','),0,0,'R');$pdf->SetXY(160,$y);
$pdf->Cell(30,4,number_format($sumFin, 2, '.', ','),0,0,'R');

$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "Saldos".$periodo.'-'.$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
 ?> 

