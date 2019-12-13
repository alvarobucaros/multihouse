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
        $empresa = $_GET['em'];
        $op = $_GET['op'];
        $fc = $_GET['fc'];
        $cta = 0;
        $der=0;
    
        $resultado = $obj->cargaEmpresa($empresa);

        while( $empre = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
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
       
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);

        $this->archivo = 'CarteraPorEdades';
        $logo = "logos/".$this->logo;
     
        $titulo="CARTERA POR EDADES CORTE A ".$fc;
        $this->Image($logo,$der+5,14,36,20);

        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);

        $this->SetFont('Courier','B',12); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+60, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 

        $this->SetXY($der+60, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 

        $this->SetXY($der+60, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 

   
        $this->SetFont('Arial','',8); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+195,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+195,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+195,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );

        $this->Line($der+6, 30, $der+240, 30);

        $this->SetFillColor(100,255,100);
        $this->SetTextColor(85,107,47); 

        $this->SetXY($der+7,31);
        $this->Cell(100,4,'    INMUEBLE             PROPIETARIO / FACTURA DETALLE',0, 0 , 'L' );       
        $this->SetXY($der+7,31);
        $this->Cell(100,64,'DETALLE',0, 0 , 'L' );
         $this->SetXY($der+100,31);
        $this->Cell(100,4,'CORRIENTE    DE 1 A 30   DE 31 A 60   DE 61 A 90   DE 91 A 120  MAS DE 120    TOTAL '.$op,0, 1 , 'L' );

        $this->Line($der+6, 36, $der+240, 36);

        
    $y=$this->GetY();        
    } 
    
        //Pie de página
    function Footer()
        {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $pie = $this->archivo. ' Impresa el '.$this->today;
        $this->Cell(0,10,$pie,0,0,'L');
        }
    }
   
    // Detalle del Reporte     
     
        $pdf=new PDF('L');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $op = $_GET['op'];
        $empresa = $_GET['em'];
        $hoy = $_GET['fc'];
        $pdf->SetFont('Arial','',6);
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();
        $resultado = $obj->carteraEdades($empresa, $op, $hoy);
        $izq=0;
        $pagoCrnte=0;
        $pago0130=0;
        $pago3160=0;
        $pago6190=0;
        $pago91120=0;
        $pago121mas=0;
        $y=32; $x=0;
        $inmueble='';
        while( $reg = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
        {
            $y +=4;
            if($inmueble===$reg['pagonompropietario']){
                $pdf->SetXY($der+12,$y);
                $pdf->Cell(20,4,  $reg['pagodetalle'],0, 0 , 'L' );
            }else{
                $pdf->SetXY($der+6,$y);
                $pdf->Cell(20,4,  $reg['pagonompropietario'],0, 0 , 'L' );
                $pdf->SetXY($der+32,$y);
                $pdf->Cell(20,4, utf8_decode($reg['pagoinmuebledesc']),0, 0 , 'L' );
                $pdf->SetXY($der+80,$y);
                $pdf->Cell(20,4,  $x,0, 0 , 'L' );
                $inmueble=$reg['pagonompropietario'];
             }
            $x +=1;
            if($x >30){
                $x=0;
                $y=32;
                $pdf->AddPage();
            }
        }
//        while( $reg = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
//        {
//            $pdf->SetXY($izq+7,$y);
//            $pdf->Cell(60,4, 'mi niña',0, 0 , 'L' );
////            $pdf->SetXY($izq+115,$y);
////            $pdf->Cell(20,4,number_format($rec['pagoCrnte'], 2, '.', ','),0,0,R);
////            $pdf->SetXY($izq+135,$y);
////            $pdf->Cell(20,4,number_format($rec['pago0130'], 2, '.', ','),0,0,R);
////            $pdf->SetXY($izq+155,$y);
////            $pdf->Cell(20,4,number_format($rec['pago3160'], 2, '.', ','),0,0,R);
////            $pdf->SetXY($izq+175,$y);
////            $pdf->Cell(20,4,number_format($rec['pago6190'], 2, '.', ','),0,0,R);
////            $pdf->SetXY($izq+195,$y);
////            $pdf->Cell(20,4,number_format($rec['pago91120'], 2, '.', ','),0,0,R);
////            $pdf->SetXY($izq+215,$y);
////            $pdf->Cell(20,4,number_format($rec['pago121mas'], 2, '.', ','),0,0,R);
////            $pagoCrnte+=$rec['pagoCrnte'];
////            $pago0130+=$rec['pago0130'];
////            $pago3160+=$rec['pago6190'];
////            $pago6190+=$rec['pagoCrnte'];
////            $pago91120+=$rec['pago91120'];
////            $pago121mas+=$rec['pago121mas'];
////            $y +=4;
//        }

 

//pagoempresa, pagofchfac ,pagofchvnc, pagovalor, pagodias, ".
//            " pagoinmuebleid, pagopropietarioid, pagoCrnte,pago0130,pago3160,pago6190,pago91120,pago121mas, ".
//            " pagodetalle ,pagonompropietario ,pagoinmuebledesc
//


//   
$file = $pdf->archivo.'a'.$pdf->today.'.pdf';

$pdf->Output($file,'D'); 
$pdf->close();


 ?> 

