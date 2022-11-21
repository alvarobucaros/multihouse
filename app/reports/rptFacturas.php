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
        $periodo = $_GET['pe'];
        $empresa = $_GET['em'];
        $fecha = $_GET['fc'];
        $cta = 0;
        $izq=150;
     
        $resultado = $obj->cargaEmpresa($empresa);
   
        while( $empre = mysqli_fetch_assoc($resultado))
        {
            $nomEmpre = $empre['empresaNombre'];         
            $nit = 'NIT : ' .$empre['empresaNit'];
            $dir = 'DIRECCION : '.$empre['empresaDireccion'].' '.$empre['empresaCiudad'];   
            $tel = 'TELEFONO : '.$empre['empresaTelefonos']; 
            $mail = 'E-MAIL :' .$empre['empresaEmail'];  
            $corte = 'FECHA DE CORTE :' .$fecha;  
            $this->logo = $empre['empresaLogo'];
            $this->ciudad = $empre['empresaCiudad'];
        }

        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
       
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
        $this->archivo = 'CtaCobro';
        $logo = "../img/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  '. $cta;
        $titulo="CUENTA DE COBRO";
        $this->Image($logo,10,14,20,10);
//        $this->Image($logo,$izq+5,14,20,10);
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);


        $this->SetFont('Courier','B',11); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY(40, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY(40, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY(40, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C');   
        $this->SetFont('Arial','',7); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY(130,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY(130,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY(130,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );  
        $this->SetXY(130,25);
        $this->SetFont('Arial','B',8);
        $this->Cell(48,4, utf8_decode($corte),0, 1 , 'L' );                  
        $this->SetFont('Arial','',9);

        $this->Line(10, 30, 200, 30);
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(85,107,47); 
        $this->SetXY(10,31);
        $this->Cell(100,4,'INMUEBLE',0, 0 , 'L' );
        $this->SetXY(60,31);
        $this->Cell(100,4,'NOMBRE',0, 0 , 'L' );
        $this->SetXY(114,31);
        $this->Cell(102,4,'Nr.FACTURA',0, 1 , 'L' );
        $this->SetXY(140,31);
        $this->Cell(102,4,'FACTURACION  VENCIMIENTO ',0, 1 , 'L' );
        
    $y=$this->GetY();        
    } 
    
        //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',7);
        //Número de página  .$this->today;
        $this->Cell(0,10,'REPORTE: CUENTA DE COBRO.  IMPRESA EL: '.$hoy,0,0,'L');
        }
    }

    function fechar($fecha, $dias)
        {
            
        }   
    // Detalle del Reporte     
     
    $pdf=new PDF();
    $pdf->AliasNbPages();
  //  $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    
    $inmuebleCodigo = '';
    $saldo=0;     
    $lado =1;
   
    $SaldoMora = 0;
    $parcial=0;
    $descuentos=0;
    $InteresMora = 0;
    $SaldoCorriente = 0;
    $titulos=false;
    $y=40;
    $mes='EneFebMarAbrMayJunJulAgtSepOctNovDic';
    $periodo = $_GET['pe'];
    $empresa = $_GET['em'];
    $propietario = $_GET['prop'];
    $inmueble =  $_GET['inmu'];
    $cta = 0;
    $fecha = $_GET['fc'];
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();
    $resultado = $obj->cargaEmpresa($empresa);
  
    while( $empre = mysqli_fetch_assoc($resultado))
    {
        $nota1=utf8_decode($empre['empresaMensaje1']);
        $nota2=utf8_decode($empre['empresaMensaje2']);
        $nota3=utf8_decode($empre['empresafacturaNota']);
        $empresaRecargoPorc = $empre['empresaRecargoPorc'];
        $empresaRecargoPesos =$empre['empresaRecargoPesos'];
        $empresaRecargoDias =$empre['empresaRecargoDias'];
        $empresaDescPorc =$empre['empresaDescPorc'];
        $empresaDescPesos = $empre['empresaDescPesos'];
        $empresaFactorRedondeo = $empre['empresaFactorRedondeo']; 
        $dias = $empre['empresaDescDias'];
    }

    $pdf->SetXY(7,$y);
    $pdf->Cell(60,4, 'nota 1'.$nota1,0, 0 , 'L' );

    // $resultado=$obj->preparaImpresionFactura($periodo, $empresa,  $fecha, $empresaRecargoPorc, 
    //                 $empresaRecargoPesos, $empresaRecargoDias, $empresaDescPorc, $empresaDescPesos, 
    //                 $empresaFactorRedondeo,0);

    $resultado = $obj->preparaImpresionFacturaRep($periodo, $empresa, $inmueble, $propietario); 
   
    while( $reg = mysqli_fetch_assoc($resultado))
    {
        if($inmuebleCodigo != $reg['inmuebleCodigo'])
        {
            if($inmuebleCodigo !='')
                {
                    if($SaldoMora > 0){
                        $y +=7;
                        $pdf->SetXY(7,$y);
                        $pdf->Cell(100,4, 'SubTotal',0, 0 , 'L' );
                        $pdf->SetXY(155,$y);
                        $pdf->Cell(20,4,number_format($SaldoMora, 2, '.', ','),0,0,'R');
                        $saldo += $SaldoMora; 
                    }
                    $pdf->SetXY(135,$y);
                    $pdf->Cell(20,4,number_format($parcial, 2, '.', ','),0,0,'R');
                    $pdf->SetXY(175,$y);
                    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
                    if($descuentos>0){
                        $y +=4;
                        $pdf->SetXY(7,$y);
                        $pdf->Cell(60,4, 'Descuento PP aplicado',0, 0 , 'L' );
                        $pdf->SetXY(115,$y);
                        $pdf->Cell(20,4,number_format($descuentos, 2, '.', ','),0,0,'R'); 
                        $saldo2 = $saldo - $descuentos;
                    }

                    $y +=4;
                    $pdf->Line(10,$y, 200, $y);
                    $y +=4;
                    $pdf->SetXY(7,$y);
                    $pdf->SetFont('Arial','BU',8);
                    $pdf->Cell(60,4,  'TOTAL A PAGAR' ,0, 0 , 'R' );
                    $pdf->SetXY(115,$y);
                    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
                    $pdf->SetFont('Arial','',8);
                    $y +=4;
                    $pdf->SetXY(7,$y);
                    $pdf->SetFont('Arial','BU',8);
                    $pdf->Cell(60,4,  'PAGO ANTES DE ' ,0, 0 , 'R' );
                    $pdf->SetXY(115,$y);
                    $pdf->Cell(20,4,number_format($saldo2, 2, '.', ','),0,0,'R');
                    $pdf->SetFont('Arial','',8);
                    $y +=6;
                    $pdf->SetXY(7,$y);
                    $pdf->MultiCell(190,4, utf8_encode( $nota1 ) );
                    $y +=4;
                    $pdf->SetXY(7,$y);
                    $pdf->MultiCell(190,4,  utf8_decode( $nota2 ) );
                    $y +=4;
                    $pdf->SetXY(7,$y);
                    $pdf->MultiCell(190,4, utf8_decode( $nota3 ) );
                    $descuentos=0;
                    $SaldoMora = 0;
                    $parcial=0;
                }
                                
            $saldo = 0.0;            
            $y=34;

            $pdf->AddPage();
            $nomInmueble = $obj->traeNomApto($reg['inmuebleCodigo'], $empresa); 
            $fraNro = $reg['facturaNumero'];
            $recibo['detalle']=$reg['facturadetalle'];
            $inmueble =  $reg['facturaInmuebleid'];
            $propietario =  $reg['propietarioNombre'];
            fechar($reg['facturafechafac'],$dias);
            $pdf->SetXY(7,$y);
            $pdf->Cell(100,4,$reg['inmuebleCodigo'].' '.$nomInmueble ,0, 0 , 'L' );  
            $pdf->SetXY(60,$y);
            $pdf->Cell(100,4,  utf8_decode($propietario),0, 0 , 'L' );
            $pdf->SetXY(114,$y);
            $pdf->Cell(40,4,$fraNro,0, 0 , 'L' ); 
            $pdf->SetXY(144,$y);
            $pdf->Cell(150,4,$reg['facturafechafac'],0, 0 , 'L' );
            $pdf->SetXY(168,$y);
            $pdf->Cell(150,4,$reg['facturafechavence'],0, 0 , 'L' );
            $inmueble = $reg['facturaInmuebleid'];
            $inmuebleCodigo = $reg['inmuebleCodigo'];
            $y +=4;
            $pdf->Line(10,$y, 200, $y);
            $y +=2;
            $pdf->SetFont('Arial','BU',8);
            $pdf->SetXY(20,$y);
            $pdf->Cell(150,4,'DETALLES',0, 0 , 'L' );
            $pdf->SetXY(118,$y);
            $pdf->Cell(10,4,'FECHA',0, 0 , 'L' );
            $pdf->SetXY(140,$y);
            $pdf->Cell(10,4,'VALOR',0, 0 , 'L' );
            $pdf->SetXY(160,$y);
            $pdf->Cell(10,4,'MORA',0, 0 , 'L' );
            $pdf->SetXY(178,$y);
            $pdf->Cell(10,4,'SUBTOTAL',0, 0 , 'L' );
            $pdf->SetFont('Arial','',8);
        }
        $y +=4;
        $pdf->SetXY(7,$y);
        $valor = $reg['facturavalor'] + $reg['facturaMora'];

        $m = (substr($reg['facturaperiodo'],-2)-1) * 3;
        $peri= substr($mes,$m,3).' de '.substr($reg['facturaperiodo'],0,4);

        $detalle =  $reg['facturadetalle'].' '.$peri;
        $pdf->Cell(60,4, utf8_decode($detalle),0, 0 , 'L' );
        $pdf->SetXY(115,$y);
        $pdf->Cell(20,4,$reg['facturafechafac'],0,0,'R');   
        $pdf->SetXY(135,$y);
        $pdf->Cell(20,4,number_format( $reg['facturavalor'], 2, '.', ','),0,0,'R');
        if($reg['facturafechafac']>0){
            $pdf->SetXY(155,$y);
            $pdf->Cell(20,4,number_format( $reg['facturaMora'], 2, '.', ','),0,0,'R');
        }
        $pdf->SetXY(175,$y);
        $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,'R');
 //      $pdf->Cell(15,4,$reg['facturavalor'],0, 0 , 'R' );
        $saldo = $saldo + $reg['facturavalor'];
        $parcial+=$reg['facturavalor'];
            if ($reg['facturadescuento']>0){$descuentos += (float)$reg['facturadescuento'];}
            if ($reg['facturaMora']>0){$SaldoMora += (float)$reg['facturaMora'];}
   } 
    $y +=4;
    $pdf->Line(6,$y, 140, $y);
    $y +=4;
    $pdf->SetXY(7,$y);
    $pdf->Cell(60,4,  'TOTAL A PAGAR' ,0, 0 , 'R' );
    $pdf->SetXY(115,$y);
    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R'); 
    $y+=4; 
    $pdf->SetXY(8,$y);
   
$pdf->close();
$pdf->Output('CuentaDeCobro.pdf','D'); 
$pdf->Output();


 ?> 
