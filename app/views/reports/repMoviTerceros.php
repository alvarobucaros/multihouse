<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $periodo;
        
     function Header()
    { 
        $dt =  explode(',',$_GET['dt']);   
     
        $empresa = $dt[0];
        $fchIni = $dt[1];
        $fchFin = $dt[2];
        $tercero = $dt[3];
       
        $hoy= date("d-m-Y");
        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();
        $resultado = $obj->cargaEmpresa($empresa);
        while( $empre =  mysqli_fetch_assoc($resultado) )
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
        $titulo="MOVIMIENTOS POR TERCERO";
        $subtitulo=" ";
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
        $this->Line($der+6, 30, 200, 30);        
        $y=$this->GetY();        
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'REPORTE: mvtoTercero   Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
  
    
    $dt =  explode(',',$_GET['dt']); 
    
    $empresa = $dt[0];
    $fchIni = $dt[1];
    $fchFin = $dt[2];
    $tercero = $dt[3];

    $hoy= date("Y-m-d (H:i)");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',7);
 
    $ln=0;
    $y=$pdf->GetY(); 
    
    $yin=$y+4;
    $pdf->SetXY(6,$y);
    
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->movimientoTerceros ($empresa, $tercero, $fchIni, $fchFin);
    $y=$pdf->GetY();
    $y+=7;
    $primero=true;

// $pdf->MultiCell(120,6,$resultado,0,L);$pdf->SetXY(105,$ln);  terceroIdenTipo, terceroIdenNumero 

    while($row = mysqli_fetch_assoc($resultado) )
    {
        if($primero){
            $pdf->SetXY(6,$y);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(30,4,$row['terceroIdenTipo'].'-'.$row['terceroIdenNumero'].'  '.$row['terceroNombre'],0,0,'L');$pdf->SetXY(15,$y); 
            $pdf->SetFont('Arial','',7);
            $y+=4;
            $primero=false;
            $pdf->SetXY(10,$y);
            $pdf->Cell(10,4,'Fecha',0,0,'L');$pdf->SetXY(27,$y);
            $pdf->Cell(16,4,'Comprobante',0,0,'L');$pdf->SetXY(80,$y);
            $pdf->Cell(6,4,'Detalle',0,0,'L');$pdf->SetXY(116,$y);
            $pdf->Cell(30,4,'Cuenta',0,0,'R');$pdf->SetXY(151,$y);
            $pdf->Cell(30,4,'Debito',0,0,'R');$pdf->SetXY(166,$y);
            $pdf->Cell(15,4,'Credito',0,0,'R');
            $y+=2; 
        }

        $y+=4; 
        $pdt="";
        if($row['movicaProcesado']=='N'){$pdt="Pte";} 
        $pdf->SetXY(6,$y); 
        $pdf->Cell(10,4,pdt.' '.$row['movicaFecha'],0,0,'L');$pdf->SetXY(25,$y);
        $pdf->Cell(16,4,  substr($row['compNombre'],0,25),0,0,'L');$pdf->SetXY(65,$y);
        $pdf->Cell(6,4,$row['movicaCompNro'],0,0,'R');$pdf->SetXY(74,$y);
        $pdf->Cell(6,4,utf8_decode($row['movicaDetalle']),0,0,'L');$pdf->SetXY(125,$y);
        $pdf->Cell(6,4,utf8_decode($row['moviConCuenta'].' '. $row['pucNombre']),0,0,'L');$pdf->SetXY(151,$y);
        $pdf->Cell(30,4,number_format($row['moviConDebito'], 2, '.', ','),0,0,'R');$pdf->SetXY(170,$y);
        $pdf->Cell(30,4,number_format($row['moviConCredito'], 2, '.', ','),0,0,'R');
        $ln +=1;
        if($ln > 58){
            $pdf->AliasNbPages();
            $pdf->AddPage(); 
            $ln=0;
            $y=$yin;
            $y+=4;
            $primero=false;
            $pdf->SetXY(10,$y);
            $pdf->Cell(10,4,'Fecha',0,0,'L');$pdf->SetXY(27,$y);
            $pdf->Cell(16,4,'Comprobante',0,0,'L');$pdf->SetXY(80,$y);
            $pdf->Cell(6,4,'Detalle',0,0,'L');$pdf->SetXY(116,$y);
            $pdf->Cell(30,4,'Cuenta',0,0,'R');$pdf->SetXY(151,$y);
            $pdf->Cell(30,4,'Debito',0,0,'R');$pdf->SetXY(170,$y);
            $pdf->Cell(30,4,'Credito',0,0,'R');
            $y+=2 ;
            $ln+=3;
        }
    }     
$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "mtoTerceros".$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
 ?> 



