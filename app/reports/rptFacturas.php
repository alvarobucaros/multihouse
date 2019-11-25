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
        $cta = 0;
        $der=0;
        $izq=150;
     
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
       
      //  $this->lugar = $empre[];
        $this->archivo = 'CtaCobro';
        $logo = "logos/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  '. $cta;
        $titulo="CUENTA DE COBRO";
        $this->Image($logo,$der+5,14,20,10);
        $this->Image($logo,$izq+5,14,20,10);
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);


        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+25, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($izq+25, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C');
        $this->SetXY($der+25, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($izq+25, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C');
        $this->SetXY($der+25, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 
        $this->SetXY($izq+25, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C');
   
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        
        $this->SetXY($izq+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($izq+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($izq+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
       
        $this->SetFont('Arial','',6);

        $this->Line($der+6, 30, $der+140, 30);
        $this->Line($izq+6, 30, $izq+140, 30);
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(85,107,47); 

        $this->SetXY($der+7,31);
        $this->Cell(100,4,'    INMUEBLE                                     NOMBRE',0, 0 , 'L' );
        $this->SetXY($izq+7,31);
        $this->Cell(100,4,'    INMUEBLE                                     NOMBRE',0, 0 , 'L' );
        $this->SetXY($der+100,31);
        $this->Cell(100,4,'Nr.CUENTA               FECHA ',0, 1 , 'L' );
        $this->SetXY($izq+100,31);
        $this->Cell(100,4,'Nr.CUENTA               FECHA ',0, 1 , 'L' );

        $this->Line($der+6, 36, $der+140, 36);
        $this->Line($izq+6, 36, $izq+140, 36);  
        
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
       
        $this->Cell(0,160,'REPORTE: CUENTA DE COBRO.  IMPRESA EL: '.$hoy,0,0,'L');
       // $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
   
    // Detalle del Reporte     
     
    $pdf=new PDF('L');
    $pdf->AliasNbPages();
  //  $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
    
    $der=150;
    $izq=0;
    $desplaza = $izq; 
    $inmuebleCodigo = '';
    $saldo=0;     
    $lado =1;
    $inmueble = 0;
    $SaldoMora = 0;
    $descuentos=0;
    $InteresMora = 0;
    $SaldoCorriente = 0;
    $titulos=false;
    $y=40;

    $periodo = $_GET['pe'];
    $empresa = $_GET['em'];
    $cta = 0;
    $fecha = $_GET['fc'];
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();
    $resultado = $obj->cargaEmpresa($empresa);
    while( $empre = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
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
    }

    $pdf->SetXY($desplaza+7,$y);
    $pdf->Cell(60,4, 'nota 1'.$nota1,0, 0 , 'L' );

    $resultado=$obj->preparaImpresionFactura($periodo, $empresa,  $fecha, $empresaRecargoPorc, 
                    $empresaRecargoPesos, $empresaRecargoDias, $empresaDescPorc, $empresaDescPesos, 
                    $empresaFactorRedondeo,0);

    $resultado = $obj->preparaImpresionFacturaRep($periodo, $empresa, $inmueble); 
    while( $reg = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
    {
        if($inmuebleCodigo != $reg['inmuebleCodigo'])
        {
            if($inmuebleCodigo !='')
                {
                    if($SaldoMora > 0){
                        $y +=4;
                        $pdf->SetXY($desplaza+7,$y);
                        $pdf->Cell(60,4, 'Intereses saldos en mora',0, 0 , 'L' );
                        $pdf->SetXY($desplaza+115,$y);
                        $pdf->Cell(20,4,number_format($SaldoMora, 2, '.', ','),0,0,R);
                        $saldo += $SaldoMora; 
                    }
                    if($descuentos>0){
                        $y +=4;
                        $pdf->SetXY($desplaza+7,$y);
                        $pdf->Cell(60,4, 'Descuento PP aplicado',0, 0 , 'L' );
                        $pdf->SetXY($desplaza+115,$y);
                        $pdf->Cell(20,4,number_format($descuentos, 2, '.', ','),0,0,R); 
                        $saldo -= $descuentos;
                    }
                    $y +=4;
                    $pdf->Line($desplaza+6,$y, $desplaza+140, $y);
                    $y +=4;
                    $pdf->SetXY($desplaza+7,$y);
                    $pdf->SetFont('Arial','BU',6);
                    $pdf->Cell(60,4,  'TOTAL A PAGAR' ,0, 0 , 'R' );
                    $pdf->SetXY($desplaza+115,$y);
                    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,R);
                    $pdf->SetFont('Arial','',6);
                    $y +=6;
                    $pdf->SetXY($desplaza+7,$y);
                    $pdf->MultiCell(132,4, utf8_encode( $nota1 ) );
                    $y +=4;
                    $pdf->SetXY($desplaza+7,$y);
                    $pdf->MultiCell(132,4,  utf8_encode( $nota2 ) );
                    $y +=4;
                    $pdf->SetXY($desplaza+7,$y);
                    $pdf->MultiCell(132,4, utf8_decode( $nota3 ) );
                    $descuentos=0;
                    $SaldoMora = 0;
                }
                
            if ($lado == 1)
            {
                $lado=0;
                $pdf->AddPage();
                $desplaza =  $izq;
            }
            else 
            {
                $desplaza = $der; 
                $lado = 1;
            }
                
            $saldo = 0.0;            
            $y=38;

            $nomInmueble = $obj->traeNomApto($reg['inmuebleCodigo'], $empresa); 
            $fraNro = $reg['facturaNumero'];
            $recibo['detalle']=$reg['facturadetalle'];
            $inmueble =  $reg['facturaInmuebleid'];
            $propietario =  $reg['propietarioNombre'];
            $fecha = $reg['facturafechafac'] . ' - ' . $reg['facturafechavence']; 
            $pdf->SetXY($desplaza+7,$y);
            $pdf->Cell(100,4,$reg['inmuebleCodigo'].' '.$nomInmueble ,0, 0 , 'L' );  
            $pdf->SetXY($desplaza+40,$y);
            $pdf->Cell(100,4,  utf8_decode($propietario),0, 0 , 'L' );
            $pdf->SetXY($desplaza+104,$y);
            $pdf->Cell(40,4,$fraNro,0, 0 , 'L' ); 
            $pdf->SetXY($desplaza+115,$y);
            $pdf->Cell(150,4,$fecha,0, 0 , 'L' );
            $inmueble = $reg['facturaInmuebleid'];
            $inmuebleCodigo = $reg['inmuebleCodigo'];
            $y +=4;
            $pdf->Line($desplaza+6,$y, $desplaza+140, $y);
            $y +=2;
            $pdf->SetFont('Arial','BU',6);
            $pdf->SetXY($desplaza+20,$y);
            $pdf->Cell(150,4,'DESTALLES',0, 0 , 'L' );
            $pdf->SetXY($desplaza+125,$y);
            $pdf->Cell(10,4,'VALOR',0, 0 , 'L' );
            $pdf->SetFont('Arial','',6);
        }
        $y +=4;
        $pdf->SetXY($desplaza+7,$y);
        $valor = $reg['facturavalor'];
        $detalle =  $reg['facturadetalle'].' '.$reg['facturaperiodo'];

        $pdf->Cell(60,4, $detalle,0, 0 , 'L' );
        $pdf->SetXY($desplaza+115,$y);
  //      $pdf->Cell(15,4,$valor,0, 0 , 'R' );
        $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,R);
 //      $pdf->Cell(15,4,$reg['facturavalor'],0, 0 , 'R' );
        $saldo = $saldo + $reg['facturavalor'];
            if ($reg['facturadescuento']>0){$descuentos += (float)$reg['facturadescuento'];}
            if ($reg['facturaMora']>0){$SaldoMora += (float)$reg['facturaMora'];}
   } 
    $y +=4;
    $pdf->Line($desplaza+6,$y, $desplaza+140, $y);
    $y +=4;
    $pdf->SetXY($desplaza+7,$y);
    $pdf->Cell(60,4,  'TOTAL A PAGAR' ,0, 0 , 'R' );
    $pdf->SetXY($desplaza+115,$y);
    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,R); 
    $y+=4; 
    $pdf->SetXY(8,$y);
   
$pdf->close();
$pdf->Output('CuentaDeCobro.pdf','D'); 
$pdf->Output();


 ?> 
