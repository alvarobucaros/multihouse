<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {

        
     function Header()
    { 
        $dt =  explode(',',$_GET['dt']);   
        $periodo =  $dt[1];       
        $empresa = $dt[0];
        $nivel = $dt[2];

        $hoy= date("d-m-Y");
        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();
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
        }

        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
        $der=0;

        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);

        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  ';
        $titulo="LIBRO MAYOR";
        $subtitulo="Periodo ".$periodo;
        $this->Image($logo,$der+5,14,20,10,'png');    
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
        $this->SetXY(40,34);
        $this->Cell(55,6, "CUENTA  "); $this->SetXY(70,34);
        $this->Cell(30,6,'INICIAL DB',0,0,'R');$this->SetXY(90,34);
        $this->Cell(30,6,'INICIAL CR',0,0,'R');$this->SetXY(110,34);
        $this->Cell(30,6,'DEBITOS',0,0,'R');$this->SetXY(130,34);
        $this->Cell(30,6,'CREDITOS',0,0,'R');$this->SetXY(150,34);
        $this->Cell(30,6,'FINAL DB',0,0,'R');$this->SetXY(170,34);
        $this->Cell(30,6,'FINAL CR',0,0,'R');
        $this->Line(6, 39, 200, 39);
        $y=$this->GetY();        
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',6);
        //Número de página  .$this->today;
        $this->Cell(0,10,'REPORTE: Libro Mayor.  Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
  
    $dt =  explode(',',$_GET['dt']);   
    $periodo =  $dt[1];       
    $empresa = $dt[0];
    $nivel = $dt[2];
    $hoy= date("Y-m-d");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
 
    $ln=0;
    $y=$pdf->GetY();  //saldosContables($empresa,$nivel,$periodo, $ctaini, $ctafin  )
    $y+=4;
    $pdf->SetXY(6,$y);
    
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->saldosContables($empresa, $nivel, $periodo, '1', '999999');
    $y=$pdf->GetY();
    $y+=4;
    $InicialDb = 0;
    $InicialCr = 0;
    $Debitos = 0;
    $Creditos = 0;
    $FinalDb = 0;
    $FinalCr = 0;

    while($row = mysqli_fetch_assoc($resultado) )
    {
        $pdf->SetXY(04,$y);   
        $pdf->Cell(16,4,$row['saldcontCuentaContable'],0,0,'L');$pdf->SetXY(16,$y);
        $pdf->Cell(16,4,$row['pucNombre'],0,0,'L');$pdf->SetXY(70,$y);
        $pdf->Cell(30,4,number_format($row['saldcontInicialDb'], 2, '.', ','),0,0,'R');$pdf->SetXY(90,$y);
        $pdf->Cell(30,4,number_format($row['saldcontInicialCr'], 2, '.', ','),0,0,'R');$pdf->SetXY(110,$y);
        $pdf->Cell(30,4,number_format($row['saldcontDebitos'], 2, '.', ','),0,0,'R');$pdf->SetXY(130,$y);
        $pdf->Cell(30,4,number_format($row['saldcontCreditos'], 2, '.', ','),0,0,'R');$pdf->SetXY(150,$y);
        $pdf->Cell(30,4,number_format($row['saldcontFinalDb'], 2, '.', ','),0,0,'R');$pdf->SetXY(170,$y);
        $pdf->Cell(30,4,number_format($row['saldconFinalCr'], 2, '.', ','),0,0,'R');
        $InicialDb += $row['saldcontInicialDb'];
        $InicialCr += $row['saldcontInicialCr'];
        $Debitos += $row['saldcontDebitos'];
        $Creditos += $row['saldcontCreditos'];
        $FinalDb += $row['saldcontFinalDb'];
        $FinalCr += $row['saldconFinalCr'];
        $y+=4; 
    } 
$pdf->SetXY(70,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(90,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(110,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(130,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(150,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');$pdf->SetXY(170,$y);
$pdf->Cell(30,4,'-----------',0,0,'R');
$y+=4; 
$pdf->SetXY(16,$y);
$pdf->Cell(16,4,'Sub Total:',0,0,'C');$pdf->SetXY(70,$y);
$pdf->Cell(30,4,number_format($InicialDb, 2, '.', ','),0,0,'R');$pdf->SetXY(90,$y);
$pdf->Cell(30,4,number_format($InicialCr, 2, '.', ','),0,0,'R');$pdf->SetXY(110,$y);
$pdf->Cell(30,4,number_format($Debitos, 2, '.', ','),0,0,'R');$pdf->SetXY(130,$y);
$pdf->Cell(30,4,number_format($Creditos, 2, '.', ','),0,0,'R');$pdf->SetXY(150,$y);
$pdf->Cell(30,4,number_format($FinalDb, 2, '.', ','),0,0,'R');$pdf->SetXY(170,$y);
$pdf->Cell(30,4,number_format($FinalCr, 2, '.', ','),0,0,'R');        
$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "LibMayor".$periodo.'-'.$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
 ?> 

