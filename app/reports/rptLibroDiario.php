<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {

     function Header()
    { 
        $dt =  explode(',',$_GET['dt']);  

        $empresa = $dt[0];
        $periodo =  $dt[1]; 
        $comprobante = $dt[2];
        $orden = $dt[3];

        $hoy= date("d-m-Y");
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
        $der=5;

        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);

        $this->archivo = 'CtaCobro';
        $logo = "logos/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  ';
        $titulo="LIBRO DIARIO";
        $subtitulo="Periodo ".$periodo;
 //       $this->Image($logo,$der,14,20,10);    
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
        $this->SetXY($der+55, 22);
        $this->Cell(80,6,utf8_decode($subtitulo),0,1,'C');
   
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+145,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+145,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+145,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $y=$this->GetY();
        $y+=6;
        $this->SetXY(108,$y);  
        $this->Cell(100,4,'DEBITOS ',0,0,'L'); $this->SetXY(128,$y); 
        $this->Cell(100,4,'CREDIDOS ',0,0,'L'); $this->SetXY(158,$y);
        $this->Cell(100,4,'REFREENCIAS ',0,0,'L'); 
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'REPORTE: Libro Diario.  Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
  
    $dt =  explode(',',$_GET['dt']);  
    $empresa = $dt[0];
    $periodo =  $dt[1]; 
    $comprobante = $dt[2];
    $orden = $dt[3];        

    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
   
    $mes= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    $ln=0;
    $y=$pdf->GetY(); 
    $pdf->SetXY(6,$y);
    $ye=$y;
    $lin=0;
    $cr=0;
    $db=0;
    $totcr=0;
    $totdb=0;
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->comprobantesPeriodo($empresa, $periodo, $comprobante,$orden);

    $fchCtrl='';
    $compCtrl='';
    $y=$pdf->GetY();
    while($row = mysqli_fetch_assoc($resultado) )
    {
        $movicaId = $row['movicaId']; 
        $compr=$row['movicaComprId'] .' - ' . $row['compNombre'] . ' Nr. ' . $row['movicaCompNro'];
        $comprF=$row['movicaFecha'] .' - ' . $row['compNombre'] . ' Nr. ' . $row['movicaCompNro'];
        $tercero = utf8_decode($row['tercero']);
        $detalle = utf8_decode($row['movicaDetalle']);
        $procesado = '';

        if($row['movicaProcesado'] === 'N'){$procesado = 'NO Actualizado';};
        $fecha = $row['movicaFecha'];
        $DocumPpal = $row['movicaDocumPpal'];
        $DocumSec = $row['movicaDocumSec'];
        $pdf->SetXY(04,$y);
        if($orden === 'fch'){
           if($fchCtrl != $fecha){ 
                $m =  substr($fecha,5,2);
                $y+=4;
                $pdf->SetXY(04,$y);
                $pdf->SetFont('Arial','B',6);
                $pdf->Cell(100,4,substr($fecha,0,4).' '.$mes[$m-1].' '.substr($fecha,8,2),0,0,'L');  
                      
                $lin+=1;
                $fchCtrl = $fecha;
                $y+=4;
                $pdf->SetXY(04,$y);
//                $pdf->SetFont('Arial','',6);
            }      
        }        
        else{
            if($row['movicaComprId']!=$compCtrl){
                $y+=4;
                $pdf->SetXY(04,$y);
                $pdf->SetFont('Arial','B',6);
                $pdf->Cell(100,4,$row['compNombre'],0,0,'L'); 
                $lin+=1;
                $pdf->SetFont('Arial','',6);
                $compCtrl=$row['movicaComprId'];
                $y+=4;
                $pdf->SetXY(04,$y);
            } 
        }

        $pdf->SetFont('Arial','',6);
        $cr=0;
        $db=0;  
        $y+=4;
        $pdf->SetXY(04,$y);
        if($orden === 'fch'){
            $pdf->Cell(100,4,$compr.'   '.$tercero .' '.$detalle.'   '.$procesado,0,0,'L');   
        }else{
             $pdf->Cell(100,4,$comprF.'   '.$tercero .' '.$detalle.'   '.$procesado,0,0,'L');  
        }
       
        $lin+=1;
        $y+=4; 
        $result = $obj->detalleSaldo($empresa, $movicaId);

        while($rec = mysqli_fetch_assoc($result) )
        {
            $pdf->SetXY(20,$y);
            $pdf->Cell(30,4,$rec['moviConCuenta']. ' - '.utf8_decode($rec['pucNombre']),0,0,'L');$pdf->SetXY(90,$y);
            $pdf->Cell(30,4,number_format($rec['moviConDebito'], 2, '.', ','),0,0,'R');$pdf->SetXY(110,$y);
            $pdf->Cell(30,4,number_format($rec['moviConCredito'], 2, '.', ','),0,0,'R');$pdf->SetXY(132,$y);
            $pdf->Cell(30,4,$rec['moviDocum1'],0,0,'R');$pdf->SetXY(152,$y);
            $pdf->Cell(30,4,$rec['moviDocum2'],0,0,'R');$pdf->SetXY(172,$y);
//            $pdf->Cell(30,4,$lin,0,0,'R');
            $cr +=$rec['moviConCredito'];
            $db +=$rec['moviConDebito'];
            $totcr+=$rec['moviConCredito'];
            $totdb+=$rec['moviConDebito'];
            $lin+=1;
            $y+=4; 
             
            if($lin>35){
                $lin=0;
                $pdf->AddPage();
                $y=$ye+3;
            }
        }
        $y-=1;
        $pdf->SetXY(90,$y);
        $pdf->Cell(30,4,'------------',0,0,'R');$pdf->SetXY(110,$y);
        $pdf->Cell(30,4,'------------',0,0,'R');
        $y+=2;
        $pdf->SetXY(90,$y);
        $pdf->Cell(30,4,number_format($db, 2, '.', ','),0,0,'R');$pdf->SetXY(110,$y);
        $pdf->Cell(30,4,number_format($cr, 2, '.', ','),0,0,'R');
           
        if($lin>35){
            $lin=0;
            $pdf->AddPage();
            $y=$ye+3;
        }
    }
    $y+=4;
    $pdf->SetXY(60,$y);
    $pdf->Cell(30,4,'TOTAL DEL PERIODO',0,0,'L');$pdf->SetXY(90,$y);
    $pdf->SetXY(90,$y);
    $pdf->Cell(30,4,'------------',0,0,'R');$pdf->SetXY(110,$y);
    $pdf->Cell(30,4,'------------',0,0,'R');
    $y+=2;
    
    $pdf->SetXY(90,$y);
    $pdf->Cell(30,4,number_format($totdb, 2, '.', ','),0,0,'R');$pdf->SetXY(110,$y);
    $pdf->Cell(30,4,number_format($totcr, 2, '.', ','),0,0,'R');
    
$y+=8; 
$pdf->SetXY(8,$y);
$hoy= date("Y-m-d");
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "LibDiario".$periodo.'-'.$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
?> 

