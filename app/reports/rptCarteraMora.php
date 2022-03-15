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
       
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);

        $this->archivo = 'CarteraDetalaldoEdades';
        if($op==='R'){$this->archivo = 'CarteraResumenEdades';}
        $logo = "logos/".$this->logo;
     
        $titulo="CARTERA POR EDADES CORTE A ".$fc;
        $this->Image($logo,$der+5,14,36,20);

        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);

        $this->SetFont('Courier','B',12); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+70, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 

        $this->SetXY($der+70, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 

        $this->SetXY($der+70, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 

   
        $this->SetFont('Arial','',8); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+200,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+200,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+200,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );

        $this->Line($der+6, 30, $der+260, 30);
        if($op==='D'){
            $this->SetFillColor(100,255,100);
            $this->SetTextColor(85,107,47); 

            $this->SetXY($der+7,31);
            $this->Cell(100,4,'    INMUEBLE             PROPIETARIO ',0, 0 , 'L' );       
            $y=31;
            $this->SetXY($der+90,$y);
            $this->Cell(20,4,'CORRIENTE',0,0,'R');
            $this->SetXY($der+117,$y);
            $this->Cell(20,4,'DE 1 A 30 DIAS',0,0,'R');
            $this->SetXY($der+139,$y);
            $this->Cell(20,4,'DE 31 A 60 ',0,0,'R');
            $this->SetXY($der+161,$y);
            $this->Cell(20,4,'DE 61 A 90 ',0,0,'R');
            $this->SetXY($der+183,$y);
            $this->Cell(20,4,'DE 91 A 120 ',0,0,'R');
            $this->SetXY($der+215,$y);
            $this->Cell(20,4,'MAS DE 120 ',0,0,'R');
            $this->SetXY($der+237,$y);
            $this->Cell(20,4,'SUB TOTAL',0,0,'R'); 
            $this->Line($der+6, 36, $der+260, 36);
        }
    $y=$this->GetY();        
    } 
    
        //Pie de página  90 117  139  161  183  215  237
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
        $izq=0;
        $pagoCrnte=0;
        $pago0130=0;
        $pago3160=0;
        $pago6190=0;
        $pago91120=0;
        $pago121mas=0;
        $sumSubtotal=0;
        $totpagoCrnte=0;
        $totpago0130=0;
        $totpago3160=0;
        $totpago6190=0;
        $totpago91120=0;
        $totpago121mas=0;
        $totsumSubtotal=0;
        $y=32; 
        $x=0;
        $inmueble=0;
        $nomInmueble='';
        $nomPropietario='';
        $op = $_GET['op'];
        $empresa = $_GET['em'];
        $hoy = $_GET['fc'];
        $pdf->SetFont('Arial','',6);
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();
        $resultado = $obj->carteraEdades($empresa, $op, $hoy);
        while($reg = mysqli_fetch_assoc($resultado))
        {
            if($op==='R'){
                $subtotal=(float)$reg['pagoCrnte']+(float)$reg['pago0130']+(float)$reg['pago6190']+
                (float)$reg['pago3160']+(float)$reg['pago91120']+(float)$reg['pago121mas'];
                $pagoCrnte+=(float)$reg['pagoCrnte'];
                $pago0130+=(float)$reg['pago0130'];
                $pago3160+=(float)$reg['pago3160'];
                $pago6190+=(float)$reg['pago6190'];
                $pago91120+=(float)$reg['pago91120'];
                $pago121mas+=(float)$reg['pago121mas'];
                $sumSubtotal +=(float)$subtotal;            
            }
            else{
            if($inmueble!=$reg['pagoinmuebleid']){
                if($inmueble>0){
                    $y +=4;
                    $pdf->SetXY($izq+7,$y);
                    $pdf->Cell(20,4, $nomInmueble,0, 0 , 'L' );
                    $pdf->SetXY($izq+35,$y);
                    $pdf->Cell(20,4,$nomPropietario ,0, 0 , 'L' );                   
                    $pdf->SetXY($izq+90,$y);
                    $pdf->Cell(20,4,number_format($pagoCrnte, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+117,$y);
                    $pdf->Cell(20,4,number_format($pago0130, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+139,$y);
                    $pdf->Cell(20,4,number_format($pago3160, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+161,$y);
                    $pdf->Cell(20,4,number_format($pago6190, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+183,$y);
                    $pdf->Cell(20,4,number_format($pago91120, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+215,$y);
                    $pdf->Cell(20,4,number_format($pago121mas, 2, '.', ','),0,0,'R');
                    $pdf->SetXY($izq+237,$y);
                    $pdf->Cell(20,4,number_format($sumSubtotal, 2, '.', ','),0,0,'R'); 
                    $pagoCrnte=0;
                    $pago0130=0;
                    $pago3160=0;   
                    $pago6190=0;
                    $pago91120=0;
                    $pago121mas=0;
                    $sumSubtotal=0;
                    $x +=1;
                    if($x >30){
                        $x=0;
                        $y=32;
                        $pdf->AddPage();
                    }
                }
            }
            $subtotal=(float)$reg['pagoCrnte']+(float)$reg['pago0130']+(float)$reg['pago6190']+
            (float)$reg['pago3160']+(float)$reg['pago91120']+(float)$reg['pago121mas'];
            $pagoCrnte+=(float)$reg['pagoCrnte'];
            $pago0130+=(float)$reg['pago0130'];
            $pago3160+=(float)$reg['pago3160'];
            $pago6190+=(float)$reg['pago6190'];
            $pago91120+=(float)$reg['pago91120'];
            $pago121mas+=(float)$reg['pago121mas'];
            $sumSubtotal +=(float)$subtotal;
            $totpagoCrnte+=(float)$reg['pagoCrnte'];
            $totpago0130+=(float)$reg['pago0130'];
            $totpago3160+=(float)$reg['pago3160'];
            $totpago6190+=(float)$reg['pago6190'];
            $totpago91120+=(float)$reg['pago91120'];
            $totpago121mas+=(float)$reg['pago121mas'];
            $totsumSubtotal +=$subtotal;
            $inmueble=$reg['pagoinmuebleid'];  
            $nomInmueble=$reg['pagoinmuebledesc'];
            $nomPropietario=utf8_decode($reg['pagonompropietario']);
        }
        }
        if($op==='D'){
            $y +=4;
            $pdf->SetXY($izq+7,$y);
            $pdf->Cell(20,4, $nomInmueble,0, 0 , 'L' );
            $pdf->SetXY($izq+35,$y);
            $pdf->Cell(20,4,$nomPropietario ,0, 0 , 'L' );                   
            $pdf->SetXY($izq+90,$y);
            $pdf->Cell(20,4,number_format($pagoCrnte, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+117,$y);
            $pdf->Cell(20,4,number_format($pago0130, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+139,$y);
            $pdf->Cell(20,4,number_format($pago3160, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+161,$y);
            $pdf->Cell(20,4,number_format($pago6190, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+183,$y);
            $pdf->Cell(20,4,number_format($pago91120, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+215,$y);
            $pdf->Cell(20,4,number_format($pago121mas, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+237,$y);
            $pdf->Cell(20,4,number_format($sumSubtotal, 2, '.', ','),0,0,'R'); 
            $x +=1;
            if($x >30){
                $x=0; 
                $y=32;
                $pdf->AddPage();
            }
            $y +=4;
            $raya='---------------';
            $pdf->SetXY($izq+90,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+117,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+139,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+161,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+183,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+215,$y);
            $pdf->Cell(20,4,$raya,0,0,'R');
            $pdf->SetXY($izq+237,$y);
            $pdf->Cell(20,4,$raya,0,0,'R'); 
            $y +=4;  
            $pdf->SetXY($izq+4,$y);
            $pdf->Cell(20,4, 'TOTALES :',0, 0 , 'R' );
            $pdf->SetXY($izq+90,$y);
            $pdf->Cell(20,4,number_format($totpagoCrnte, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+117,$y);
            $pdf->Cell(20,4,number_format($totpago0130, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+139,$y);
            $pdf->Cell(20,4,number_format($totpago3160, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+161,$y);
            $pdf->Cell(20,4,number_format($totpago6190, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+183,$y);
            $pdf->Cell(20,4,number_format($totpago91120, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+215,$y);
            $pdf->Cell(20,4,number_format($totpago121mas, 2, '.', ','),0,0,'R');
            $pdf->SetXY($izq+237,$y);
            $pdf->Cell(20,4,number_format($totsumSubtotal, 2, '.', ','),0,0,'R');
        }
        else{
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'CORRIENTE :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pagoCrnte, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'DE 1 A 30 DIAS :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pago0130, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'DE 31 A 60 DIAS :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pago3160, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'DE 61 A 90 DIAS :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pago6190, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'DE 91 A 120 DIAS :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pago91120, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'MAS DE 120 DIAS :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($pago121mas, 2, '.', ','),0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,'---------------',0,0,'R');
            $y +=4;  
            $pdf->SetXY($izq+100,$y);
            $pdf->Cell(20,4, 'TOTAL CARTERA :',0, 0 , 'R' );
            $pdf->SetXY($izq+150,$y);
            $pdf->Cell(20,4,number_format($sumSubtotal, 2, '.', ','),0,0,'R');
        }
//   
$file = $pdf->archivo.'a'.$pdf->today.'.pdf';

$pdf->Output($file,'D'); 
$pdf->close();


 ?> 

