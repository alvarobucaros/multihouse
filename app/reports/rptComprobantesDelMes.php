<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $hayComprobante;
        public $empresa;
        public $codTercero;
    

    function Header()
    { 
        $dt =  explode(',',$_GET['dt']);  
        $empresa =  $dt[0];        
        $periodoIni =  $dt[1];
        $periodoFin =  $dt[2];
        $fchIni  =  $dt[3];
        $fchFin  =  $dt[4];
        $comprob =  $dt[5];
        $orden   =  $dt[6];      
  // 
        $subtitulo = "Periodo del " . $fchIni . ' al ' . $fchFin;
        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();
        $resultado = $obj->cargaEmpresa($empresa);
        $empre = mysqli_fetch_array($resultado, MYSQL_ASSOC);
        $nomEmpre = $empre['empresaNombre']; 
        $this->codTercero = $empre['empresatercero'];

        $logo = $empre['empresaLogo']; 
        $nit = 'NIT:        ' .$empre['empresaNit'].'-'.$empre['empresaDigito'];
        $dir = 'DIRECCION : '.$empre['empresaDireccion']; 
        $tel = 'TELEFONO  : '.$empre['empresaTelefonos'];      
        $logo = "logos/".$logo;
        
//        $this->Image( $logo ,25,15,20,10);
 
        $miTitulo = "Informe de comprobantes del mes";
        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($this->empresa)+6;
        $this->SetX((210-$w)/2);

        $this->SetFont('Courier','B',12); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY(123, 13);
        $this->Cell(45,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->Ln(1);$this->SetXY(123, 18);
        $this->Cell(45,6,'',0,1,'C');
      //  $this->SetTextColor(247,68,36); 
        $this->SetXY(123, 20);
        $this->Cell(45,6,utf8_decode('Comprobantes contables del mes'),0,1,'C'); $this->SetXY(123, 24);  
        $this->Cell(45,6,utf8_decode($subtitulo),0,1,'C'); 
        $this->SetXY(30, 8);
        $this->SetTextColor(31,73,125); 
        $this->Ln(20);
        $this->SetFont('Arial','',8); 
        $this->SetFillColor(31,73,200, 12);
        $this->Ln(1);$this->SetXY(220,12);
        $this->Cell(48,6, utf8_decode($dir),0, 1 , 'L' );
        $this->Ln(1);$this->SetXY(220,16);
        $this->Cell(48,6, utf8_decode($tel),0, 1 , 'L' );
        $this->Ln(1);$this->SetXY(220,20);
        $this->Cell(48,6, utf8_decode($nit),0, 1 , 'L' );
        $this->Ln(1);$this->SetXY(200,24);
        $this->Line(8, 30, 280, 30);        
        $this->SetTextColor(0,0,0);      
    }

    //Pie de página
    function Footer()
        {
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
        $hoy= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $hoy= date("d-m-Y h:i a");
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',7);
        //Número de página  .$this->today;
        $this->Cell(0,10,'REPORTE: COMPROBANTE CONTABLE DEL PERIODO.  IMPRESO EL: '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }

    $hoy= date("Y-m-d (H:i)");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $lnMax = 160;
    $dt =  explode(',',$_GET['dt']);  
    $empresa =  $dt[0];        
    $periodoIni =  $dt[1];
    $periodoFin =  $dt[2];
    $fchIni  =  $dt[3];
    $fchFin  =  $dt[4];
    $comprob =  $dt[5];
    $orden   =  $dt[6];           
    $pdf = new PDF('L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',7);
    $pdf->SetY(54);
    $pdf->SetXY(10,32);
    $ln=$pdf->GetY()-5;
    $tercero =  $pdf->codTercero;
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesContCls();
    $resultado = $obj->comprobantesDelMes($periodoIni, $periodoFin, $empresa, $orden, $comprob, $tercero);
    $comprobante='';
    $fecha='';
//$pdf->MultiCell(120,6,$resultado,0,'L');$pdf->SetXY(105,$ln);
//return;    
    while($reg = mysqli_fetch_assoc($resultado) )
    {
        if($orden==='CF' and $comprobante <> $reg['movicaComprId'] ){
            $ln+=4;
            $pdf->SetXY(15,$ln);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(0,6, utf8_decode($reg['movicaComprId']. '_'.$reg['compNombre'])  ,0, 0) ;  
            $pdf->SetFont('Arial','',7);
            $ln+=5;
            $comprobante = $reg['movicaComprId'];
        }
        $procesado = 'NO';
        if ($reg['movicaProcesado'] == 'S'){ $procesado = 'SI';}
        $compro=$reg['movicaId'];
        $pdf->SetXY(15,$ln);
        $pdf->Cell(0,6, 'COMPROBANTE :', 0, 0 ); $pdf->SetXY(40,$ln);
        $pdf->Cell(0,6, utf8_decode($reg['movicaComprId']. '_'.$reg['compNombre'] . '  Número :'.$reg['movicaCompNro'])  ,0, 0) ;
        $pdf->SetXY(110,$ln);
        $pdf->Cell(0,6, 'FECHA :', 0, 0 ) ; $pdf->SetXY(120,$ln); 
        $pdf->Cell(0,6, $reg['movicafecha']. '    PROCESADO: ' . $procesado ) ;
        $ln+=3;
        $pdf->SetXY(15,$ln);
        $pdf->Cell(10,6, 'DETALLE :', 0, 0 ); $pdf->SetXY(40,$ln);
        $pdf->Cell(0,6, utf8_decode($reg['movicaDetalle'])  ,0, 0 );$pdf->SetXY(90,$ln);
        $ln+=5;
        $pdf->Line(8,$ln, 280, $ln);
         
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY(10,$ln);
        $pdf->Cell(0,6, "CUENTA       NOMBRE CUENTA"); $pdf->SetXY(85,$ln);
        $pdf->Cell(0,6, "DOC.IDENTIDAD"); $pdf->SetXY(130,$ln);
        $pdf->Cell(0,6, "TERCERO"); $pdf->SetXY(178,$ln);
        $pdf->Cell(0,6, "DOCUMENTO SOPORTE"); $pdf->SetXY(246,$ln);
        $pdf->Cell(0,6, "DEBITOS           CREDITOS");
        $ln+=5;
        $pdf->Line(8,$ln, 280, $ln);
        $totDb=0.0;
        $totCr=0.0;
        $resulMvt = $obj->listamoviConCuentaRep($empresa, $compro);  
        $y=array(0,0,0,0,0,0);

        while($regMv = mysqli_fetch_assoc($resulMvt) )
        {    
            $pdf->SetXY(6,$ln);   
            $pdf->MultiCell(70,4,$regMv['moviConCuenta'].' '.$regMv['pucNombre']);$y[0]=$pdf->GetY();$pdf->SetXY(85,$ln);
            $pdf->multiCell(50,4,utf8_decode($regMv['moviConTerceroId']));$y[1]=$pdf->GetY();$pdf->SetXY(115,$ln);
            $pdf->multiCell(60,4,utf8_decode($regMv['moviConTercero']));$y[2]=$pdf->GetY();$pdf->SetXY(177,$ln);

            $pdf->multiCell(28,4,$regMv['moviDocum1'].'  '.$regMv['moviDocum2']);$y[5]=$pdf->GetY();
            $pdf->SetXY(230,$ln);
            $pdf->Cell(30,4,number_format($regMv['moviConDebito'], 2, '.', ','),0,0,'R');$pdf->SetXY(250,$ln);
            $pdf->Cell(30,4,number_format($regMv['moviConCredito'], 2, '.', ','),0,0,'R');
            $totDb+=$regMv['moviConDebito'];
            $totCr+=$regMv['moviConCredito'];
            $n=0;
            $max1 = $y[0];
            $ln+=3+$n; 
            if ($ln>$lnMax){ 
                $pdf->AddPage(); 
                $ln=40;
                $pdf->SetXY(10,$ln);
                $pdf->Cell(0,6, "CUENTA       NOMBRE CUENTA"); $pdf->SetXY(85,$ln);
                $pdf->Cell(0,6, "DOC.IDENTIDAD"); $pdf->SetXY(130,$ln);
                $pdf->Cell(0,6, "TERCERO"); $pdf->SetXY(178,$ln);
                $pdf->Cell(0,6, "DOCUMENTO SOPORTE"); $pdf->SetXY(246,$ln);
                $pdf->Cell(0,6, "DEBITOS           CREDITOS");
                $ln+=5;
                $pdf->Line(8,$ln, 280, $ln);
            }
        } 
        $ln-=3;
        $pdf->SetFont('Arial','',7);$pdf->SetXY(230,$ln);
        $pdf->Cell(30,10,"-----------------",0,0,'R');$pdf->SetXY(250,$ln);
        $pdf->Cell(30,10,"-----------------",0,0,'R');
        $ln+=5;   
        $pdf->SetXY(205,$ln);
        $pdf->Cell(20,4,'TOTAL COMPROBANTE');$pdf->SetXY(230,$ln);
        $pdf->Cell(30,4,number_format($totDb, 2, '.', ','),0,0,'R');$pdf->SetXY(250,$ln);
        $pdf->Cell(30,4,number_format($totCr, 2, '.', ','),0,0,'R');
        $ln+=4;
        if($totDb<>$totCr){
            $pdf->SetXY(205,$ln);
            $pdf->SetTextColor(247,68,36); 
            $pdf->Cell(20,4,'COMPROBANTE DESCUADRADO');
            $pdf->SetTextColor(0,0,0);
            $ln+=4;
        }
        $pdf->Line(8,$ln, 280, $ln);
        if ($ln>$lnMax){ $pdf->AddPage(); $ln=40;}
    }
     
$ln+=4; 
$pdf->SetXY(8,$ln);
$pdf->Cell(80,4, 'FIN DEL INFORME' ,0,1);
$reporte = "Comprob".$periodoIni.','.$periodoFin.'-'.$hoy.'.pdf';
$pdf->Output($reporte,'D'); 
 ?> 
