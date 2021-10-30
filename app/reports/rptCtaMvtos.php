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
        $periIni = $dt[1];
        $periFin = $dt[2];
        $ctaIni = $dt[3];
        $ctaFin = $dt[4];

        $hoy= date("d-m-Y");
        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();
        $resultado = $obj->cargaEmpresa($empresa);
        while($empre = mysqli_fetch_assoc($resultado)){
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
        $logo = "logos/".$this->logo;

        $titulo="CUENTA Y SUS MOVIMIENTOS";
        $subtitulo="Periodo Desde: ". $periIni. " Hasta: ".$periFin;
  
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);
        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+55, 10);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($der+55, 14);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($der+55, 19);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 
        $this->SetFont('Arial','',8); 
        $this->SetXY($der+55, 23);
        $this->Cell(80,6,utf8_decode($subtitulo),0,1,'C');
   
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+155,10);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+155,13);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+155,17);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->Line($der+6, 28, 200, 28);        
        $y=$this->GetY();        
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'REPORTE: Cta y mvtos   Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }      
    }
  
    
    $dt =  explode(',',$_GET['dt']); 
    $empresa = $dt[0];
    $periIni = $dt[1];
    $periFin = $dt[2]; 
    $ctaIni = $dt[3];
    $ctaFin = $dt[4];
        
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
    $resultado = $obj->saldosCtaMvtos($empresa, $periIni, $periFin, $ctaIni, $ctaFin);
    $y=$pdf->GetY();
    $y+=2;
    $cuentaAux='';
    $cta='';
    $sumacr=0;
    $sumadb=0;
    $conSaldos=false;
    
    while($row = mysqli_fetch_assoc($resultado) )
    {
        if($cuentaAux != $row['moviConCuenta']){
            if($conSaldos){
                $y+=4;
                $pdf->SetXY(155,$y);
                $pdf->Cell(20,4,'------------',0,0,'R');
                $pdf->SetXY(180,$y);
                $pdf->Cell(20,4,'------------',0,0,'R');
                $y+=2;
                $pdf->SetXY(130,$y);
                $pdf->Cell(6,4,'Sub Total',0,0,'L');
                $pdf->SetXY(145,$y);
                $pdf->Cell(30,4,number_format($sumadb, 2, '.', ','),0,0,'R');
                $pdf->SetXY(170,$y);  
                $pdf->Cell(30,4,number_format($sumacr, 2, '.', ','),0,0,'R');
                $ln +=2;
                $sumacr=0;
                $sumadb=0;
            }
            $conSaldos=true;
            $y+=6;
            $cuentaAux = $row['moviConCuenta'];
            $cta = $row['pucNombre']; //$obj->nombreCuenta($empresa, $cuentaAux);
            $pdf->SetXY(12,$y);   
            $pdf->Cell(30,4,  utf8_decode($cuentaAux.'-'.$cta),0,0,'L');$pdf->SetXY(15,$y); 
            $y+=3;
            $pdf->SetXY(6,$y);
            $pdf->Cell(10,4,'Fecha',0,0,'L');$pdf->SetXY(14,$y);
            $pdf->Cell(16,4,'Comprobante',0,0,'L');$pdf->SetXY(70,$y);
            $pdf->Cell(16,4,'Tercero',0,0,'L');$pdf->SetXY(100,$y);
            $pdf->Cell(6,4,'Detalle',0,0,'L');$pdf->SetXY(145,$y);
            $pdf->Cell(30,4,'Debito',0,0,'R');$pdf->SetXY(170,$y);
            $pdf->Cell(30,4,'Credito',0,0,'R');
            $y+=4; 
            $ln+=3;
            $sumacr=0;
            $sumadb=0;
        }
        $pdf->SetXY(04,$y);
        if($ln > 55){
            $pdf->AliasNbPages();
            $pdf->AddPage(); 
            $ln=0;
            $y=$yin+2;
        }
  
       // $y+=4; 
        $t=$y;
        $pdf->SetXY(4,$y); 
        $pdf->Cell(10,4,$row['movicaFecha'],0,0,'L');
        $pdf->SetXY(17,$y);
        $pdf->Cell(16,4,  substr($row['compNombre'].' Nr.'.$row['movicaCompNro'] ,0,25),0,0,'L');
        $pdf->SetXY(55,$y);
        $pdf->MultiCell(50,4,utf8_decode($row['terceroNombre']),0,'L');
        $t=$pdf->GetY();
        $pdf->SetXY(100,$y);
        $pdf->MultiCell(50,4,utf8_decode($row['movicaDetalle']),0,'L');
        $t=$pdf->GetY();
        $pdf->SetXY(145,$y);
        $pdf->Cell(30,4,number_format($row['moviConDebito'], 2, '.', ','),0,0,'R');
        $pdf->SetXY(170,$y);
        $pdf->Cell(30,4,number_format($row['moviConCredito'], 2, '.', ','),0,0,'R');
        $sumacr += $row['moviConCredito'];
        $sumadb += $row['moviConDebito'];  
        $y=$t;
        $ln +=1;
        if($ln > 55){
            $pdf->AliasNbPages();
            $pdf->AddPage(); 
            $ln=0;
            $y=$yin;
            $y+=2;

            $pdf->SetXY(12,$y);   
            $pdf->Cell(30,4,$cuentaAux.'-'.$cta,0,0,'L');$pdf->SetXY(15,$y); 
            $y+=4;
            $pdf->SetXY(14,$y);
            $pdf->Cell(10,4,'Fecha',0,0,'L');$pdf->SetXY(27,$y);
            $pdf->Cell(16,4,'Comprobante',0,0,'L');$pdf->SetXY(75,$y);
            $pdf->Cell(6,4,'Detalle',0,0,'L');$pdf->SetXY(125,$y);
            $pdf->Cell(30,4,'Debito',0,0,'R');$pdf->SetXY(145,$y);
            $pdf->Cell(30,4,'Credito',0,0,'R');
            $y+=2; 
            $ln+=3;
        }
    }

    $y+=4;
    $pdf->SetXY(155,$y);
    $pdf->Cell(20,4,'------------',0,0,'R');
    $pdf->SetXY(180,$y);
    $pdf->Cell(20,4,'------------',0,0,'R');
    $y+=2;
    $pdf->SetXY(130,$y);
    $pdf->Cell(6,4,'Sub Total',0,0,'L');
    $pdf->SetXY(145,$y);
    $pdf->Cell(30,4,number_format($sumadb, 2, '.', ','),0,0,'R');
    $pdf->SetXY(170,$y);  
    $pdf->Cell(30,4,number_format($sumacr, 2, '.', ','),0,0,'R');
                
$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "CtaYmtos".$periIni.",".$periFin."-".$hoy.".pdf";
$pdf->Output($reporte,'D'); 


 ?> 


