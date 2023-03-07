<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $periodo;
        public $logo;
        public $ciudad;
        
     function Header()
    { 
        $dt =  explode(',',$_GET['dt']);   
            
        $empresa = $dt[0];
        $periodo = $dt[1];
        $this->periodo = $dt[1];
        $ctaIni = $dt[2];
        $ctaFin = $dt[3];

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

//        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
        $der=0;

        $time = time();
//        $this->today = date("Y/m/d H:i:s", $time);

//        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  ';
        $titulo="LIBRO AUXILIAR";
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
        $this->Line($der+6, 33, 200, 33);        
        $y=$this->GetY();        
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'REPORTE: Libro Auxiliar, periodo '.$this->periodo.'  Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
  
    
    $dt =  explode(',',$_GET['dt']); 
    $empresa = $dt[0];
    $periodo = $dt[1];
    $ctaIni = $dt[2];
    $ctaFin = $dt[3];
    $hoy= date("Y-m-d");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',7);
 
    $ln=0;
    $y=$pdf->GetY(); 
    
    $y+=4;
    $yin=$y+4;
    $pdf->SetXY(6,$y);
    
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->saldosContablesLM($empresa, $periodo, $ctaIni, $ctaFin);
    $y=$pdf->GetY();
    $y+=6;
    $cuentaAux='';
    $saldo=0.0;
    $primero=true;
    // $pdf->MultiCell(120,6,$resultado,0,'L');$pdf->SetXY(105,$ln);
    // return;
    while($row = mysqli_fetch_assoc($resultado) )
    {
        if($cuentaAux != $row['moviConCuenta']){
            $cuentaAux = $row['moviConCuenta'];
            $cta = $obj->nombreCuentaLM ($empresa, $cuentaAux, $periodo);
            for($i=count($cta); $i>-1; $i--){
                if ($i===0){
                    $saldo=$cta[$i]; 
                    $primero=true;
                }else{
                    $pdf->SetXY(12,$y);   
                    $pdf->Cell(30,4,  utf8_decode($cta[$i]),0,0,'L');$pdf->SetXY(15,$y);
                    $y+=4;                    
                }
            }
            $y+=2; 
            $ln+=3;
        } 
        $pdf->SetXY(04,$y);
        if($ln > 40){
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $ln=0;
            $y=$yin;
        }
        if($primero){            
            $primero=false;
            $pdf->SetXY(24,$y);
            $pdf->Cell(10,4,'Fecha',0,0,'L');$pdf->SetXY(43,$y);
            $pdf->Cell(16,4,'Comprobante',0,0,'L');$pdf->SetXY(82,$y);
            $pdf->Cell(6,4,'Detalle',0,0,'L');$pdf->SetXY(125,$y);
            $pdf->Cell(30,4,'Debito',0,0,'R');$pdf->SetXY(145,$y);
            $pdf->Cell(30,4,'Credito',0,0,'R');$pdf->SetXY(170,$y);
            $pdf->Cell(30,4,'Saldo',0,0,'R');
            $pdf->SetXY(100,$y);
            $y+=4; 
            $pdf->SetXY(120,$y); 
            $pdf->Cell(6,4,utf8_decode('Saldo inicial'),0,0,'L');$pdf->SetXY(170,$y);
            $pdf->Cell(30,4,number_format($saldo, 2, '.', ','),0,0,'R');
            $ln+=2;
        }
        $y+=4; 
        $pdf->SetXY(24,$y); 
        $saldo += ($row['moviConDebito'] - $row['moviConCredito']);
        $pdf->Cell(10,4,$row['movicaFecha'],0,0,'L');$pdf->SetXY(37,$y);
        $pdf->Cell(16,4,utf8_decode($row['compNombre']). ' Nr.'.$row['movicaCompNro'],0,0,'L');$pdf->SetXY(72,$y);
      //  $pdf->Cell(6,4,$row['movicaCompNro'],0,0,'L');$pdf->SetXY(75,$y);
        $pdf->Cell(6,4,utf8_decode($row['movicaDetalle']),0,0,'L');$pdf->SetXY(125,$y);
        $pdf->Cell(30,4,number_format($row['moviConDebito'], 2, '.', ','),0,0,'R');$pdf->SetXY(145,$y);
        $pdf->Cell(30,4,number_format($row['moviConCredito'], 2, '.', ','),0,0,'R');$pdf->SetXY(170,$y);
        $pdf->Cell(30,4,number_format($saldo, 2, '.', ','),0,0,'R');
        $ln +=1;
        if($ln > 42){
            $pdf->AliasNbPages();
            $pdf->AddPage(); 
            $ln=0;
            $y=$yin;
        }
    }     
$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "LibAuxiliar".$periodo.'-'.$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
 ?> 


