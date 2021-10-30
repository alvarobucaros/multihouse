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
        $propietario = $_GET['prop'];
        $empresa = $_GET['em'];
        $inmueble = $_GET['in'];
        $op = $_GET['op'];
        $periodo=$_GET['pe'];;
        $cta = 0;
        $der=0;
        $this->periodo = $periodo;
 //op="+reimp+"&em="+empresa+"&prop="+prop+"&in="+inmueble;
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

        $result = $obj->traeAptoPropietario($inmueble, $empresa);
        while( $rec = mysqli_fetch_array($result, MYSQL_ASSOC) )
        {
            $propietario =  $rec['propietarioNombre'];
            $cedula =  $rec['propietarioCedula'];
            $telProp = $rec['propietarioTelefonos'];
            $direc = TRIM($rec['propietarioDireccion']);
            $emailProp = $rec['propietarioCorreo'];
            $codigo =  $rec['inmuebleCodigo'];
            $nomInmueble = $rec['inmuebleDescripcion'];  
        }
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'CtaCobro';
        $logo = "logos/".$this->logo;
        $yeyo=$periodo .'  '. $empresa  .'  '. $cta;
        $titulo="CUENTA DE COBRO";
 //       $this->Image($logo,$der+5,14,20,10);

        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);
        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+25, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($der+25, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($der+25, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C');   
        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+105,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+105,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+105,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->SetFont('Arial','',6);
        $this->Line($der+6, 30, $der+140, 30); 
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der+17,31);
        $this->Cell(100,4,'INMUEBLE    ',0, 0 , 'L' );
        $this->SetXY($der+35,31);
        $this->Cell(100,4,$codigo.' - '.$nomInmueble,0, 0 , 'L' );
        $this->SetXY($der+17,35);
        $this->Cell(100,4,'PROPIETARIO ',0, 0 , 'L' );
        $this->SetXY($der+35,35);
        $this->Cell(100,4,$cedula . ' - ' .utf8_decode($propietario),0, 0 , 'L' );
        $this->SetXY($der+35,39);
        $this->Cell(100,4,$direc. ' TELEFONO ' . $telProp,0, 0 , 'L' );          
        $this->SetXY($der+17,43);  
        $this->Cell(100,4,'E-MAIL        ',0, 1 , 'L' );
        $this->SetXY($der+35,43);  
        $this->Cell(100,4,$emailProp,0, 1 , 'L' );
        $y=$this->GetY();  
 
        $der +=5;
        $this->Line($der+6, $y, $der+140,$y);
        $this->SetFont('Arial','B',6);
        $this->SetXY($der+2,$y);
        $this->Cell(150,4,'PERIODO  FCH.FACTURA  FCH.VENCE  NR.FACT                DETALLE',0, 0 , 'L' );
        $this->SetXY($der+125,$y);
        $this->Cell(10,4,'SALDO',0, 0 , 'L' );
        $this->SetFont('Arial','',6);
        $y +=4;
    } 

        //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'REPORTE: CUENTA DE COBRO.  IMPRESA EL: '.$hoy,0,0,'L');
        }
    }
   
    // Detalle del Reporte     
     
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
    $izq=0;
    $desplaza = $izq; 
    $inmuebleCodigo = '';
    $inmueble = 0;
    $SaldoMora = 0;
    $descuentos=0;
    $InteresMora = 0;
    $Saldo = 0;
    $titulos=false;
    $y=$pdf->GetY();
    $periodo = $pdf->periodo;
    $empresa = $_GET['em'];
    $inmueble =$_GET['in'];
    $ln=0;
    $ny=0;
    $op = $_GET['op'];
    $propietario= $_GET['prop'];
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
    $y=$pdf->GetY();
    $ny=$y;
    $result = $obj->preparaReimpresionFactura($periodo, $empresa, $inmueble, $op, $propietario); 
     
    while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )
    {
        $valor = $reg['facturasaldo'];
        $line =  $reg['facturaperiodo'].'   '.$reg['facturafechafac'].'    '.$reg['facturafechavence'].'     '.
        $reg['facturaNumero'].' '.$reg['facturadetalle'];  
     
        $pdf->SetXY($der+0,$y);
        $pdf->Cell(20,4,  $ln,0, 0 , 'L' );
        $ln+=1;
        if ($ln > 55){
            $ln=0;
            $pdf->AddPage();
            $y=$ny;
        }
        $y +=4;
    
        $pdf->Cell(20,4,  $reg['facturaperiodo'],0, 0 , 'L' );
        $pdf->SetXY($der+20,$y);
        $pdf->Cell(20,4,  $reg['facturafechafac'],0, 0 , 'L' );
        $pdf->SetXY($der+36,$y);
        $pdf->Cell(20,4,  $reg['facturafechavence'],0, 0 , 'L' );
        $pdf->SetXY($der+49,$y);
        if ( $reg['facturaTipo'] === 'F'){ 
            $pdf->Cell(20,4, substr($reg['facturaNumero'],3,12),0, 0 , 'L' );
        }
        $pdf->SetXY($der+59,$y);
        $pdf->Cell(60,4,  $reg['facturadetalle'],0, 0 , 'L' );

        $pdf->SetXY($der+120,$y);
        if ( $reg['facturaTipo'] === 'T' || $reg['facturaTipo'] === 'C'){
             $pdf->Cell(20,4,number_format($valor*(-1), 2, '.', ','),0,0,'R');
        }else{
        $pdf->Cell(20,4,number_format($valor, 2, '.', ','),0,0,'R');
        }
        if ( $reg['facturaTipo'] === 'F' || $reg['facturaTipo'] === 'D'){
            $saldo = $saldo + (float)$reg['facturasaldo'];
        }else if ( $reg['facturaTipo'] === 'T' || $reg['facturaTipo'] === 'C'){
            $saldo = $saldo - (float)$reg['facturasaldo'];
        }
        if ($reg['facturadescuento']>0){$descuentos += (float)$reg['facturadescuento'];}
        if ($reg['facturaMora']>0){$SaldoMora += (float)$reg['facturaMora'];}
   } 
    $resultado = $obj->num2letras($saldo, false, true);  //num2letras($numero, $fem = false, $dec = true)
    $y +=4;
    $pdf->Line($der+6, $y, $der+140,$y);   
    $y +=4;
    $pdf->SetXY($der+7,$y);
    $pdf->SetFont('Arial','BU',6);
    $pdf->Cell(60,4,  'TOTAL A PAGAR' ,0, 0 , 'R' );
    $pdf->SetXY($der+120,$y);
    $pdf->Cell(20,4,number_format($saldo, 2, '.', ','),0,0,'R');
    $y +=5;
    $pdf->SetXY($der+7,$y);
    $pdf->MultiCell(132,4, utf8_decode( $resultado ) );
    $pdf->SetFont('Arial','',6);
    $y +=6;
    $pdf->SetXY($der+7,$y);
    $pdf->MultiCell(132,4, utf8_decode( $nota1 ) );
    $y +=4;
    $pdf->SetXY($der+7,$y);
    $pdf->MultiCell(132,4,  utf8_decode( $nota2 ) );
    $y +=4;
    $pdf->SetXY($der+7,$y);
    $pdf->MultiCell(132,4, utf8_decode( $nota3 ) );
 
$pdf->close();
$pdf->Output('CuentaDeCobro.pdf','D'); 
 ?> 

