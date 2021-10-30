<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $pieTexto;
        public $logo;
        public $archivo;
        public $nomEmpre;
        public $empresa;
        public $numero;
        public $observaciones;
        public $nota;
                
 function Header(){    
        include_once("../bin/cls/clsReportes.php");
        $obj = new  reportesCls();
        $empresa = $_GET['em'];
        $nro = $_GET['nr'];
        $this->numero = $nro;
        $this->empresa = $empresa;
        $cta = 0;
        $der=0;

        $resultado = $obj->cargaEmpresa($empresa);
         while($empre = mysqli_fetch_assoc($resultado)){{
            $nomEmpre = $empre['empresaNombre']; 
            $dir = $empre['empresaDireccion'];  
            $ciu = $empre['empresaCiudad'];
            $this->observaciones = $empre['empresaObservaciones'];
            $this->nota = $empre['empresafacturaNota'];
            $nit = 'Nit : ' .$empre['empresaNit'];
            $tel = 'Teléfono : '.$empre['empresaTelefonos']; 
            $mail = 'E-Mail :' .$empre['empresaEmail'];  
            $empresaActividad = $empre['empresaActividad'];
            $this->logo = $empre['empresaLogo'];
            $this->ciudad = $empre['empresaCiudad']; 
            $regimen = 'Simplificado';
            if ( $empre['empresaRegimen'] ==='C'){
                $regimen = 'Común';
            }
            $regimen = 'Regimen : ' .$regimen;
        }

        $resulClien = $obj->cargaTercero($empresa, $nro);
         while($ciente = mysqli_fetch_assoc($resulClien)){
            $terceroNombre = $ciente['terceroNombre'];
            $terceroIdenTipo = $ciente['terceroIdenTipo'];
            $terceroIdenNumero = $ciente['terceroIdenNumero'];
            $terceroDireccion  = $ciente['terceroDireccion']; 
            $terceroTelefonos = $ciente['terceroTelefonos'];
            $terceroCorreo = $ciente['terceroCorreo'];
            $factdeffechcrea = $ciente['factdeffechcrea'];
            $factdeffechvence = $ciente['factdeffechvence'];
            $terceroCiudad = $ciente['terceroCiudad'];
        }
        
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
     
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
       
        $this->archivo = 'CtaCobro';
        $logo = "logos/".$this->logo;
        $yeyo= $empresa;
        $titulo="FACTURA DE VENTA: MP ".$nro;
        $this->Image($logo,$der+25,24,35,38);
        $this->SetFont('Arial','B',10);        
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetFillColor(31,73,125);
        
        $this->SetXY(100, 25);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'L');   
        $this->SetXY(100, 33);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'L'); 
        $this->SetXY(100,38);
        $this->Cell(80,6, utf8_decode($dir),0, 1 , 'L' );   
        $this->SetXY(100,43);
        $this->Cell(80,6, utf8_decode($ciu),0, 1 , 'L' ); 
        $this->SetFont('Arial','',10);   
        $this->SetXY(100, 48);
        $this->Cell(90,6,utf8_decode($nit),0,1,'L'); 
        $this->SetXY(100,53);
        $this->Cell(48,6, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY(100,58);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->SetXY(100,63);
        $this->Cell(48,4, utf8_decode($regimen),0, 1 , 'L' );
        $this->SetFont('Arial','',8);  
        $this->SetXY(10,68);       
        $this->Cell(48,4, utf8_decode('Acitidad Económina : '),0, 1 , 'L' );
        $this->SetXY(10,72);
        $this->Cell(48,4, utf8_decode($empresaActividad),0, 1 , 'L' );
        $this->SetFont('Arial','B',10);
        $this->SetXY(10,78);
        $this->Cell(48,4, utf8_decode('Cliente:'),0, 1 , 'L' );
        $this->SetXY(120,78);
        $this->Cell(48,4, utf8_decode('Fecha Factura'),0, 1 , 'L' );
        $this->SetXY(10,83);
        $this->Cell(48,4, utf8_decode('Nit / CC:'),0, 1 , 'L' );
        $this->SetXY(120,83);
        $this->Cell(48,4, utf8_decode('Fecha Vencimiento'),0, 1 , 'L' );
        $this->SetXY(10,88);
        $this->Cell(48,4, utf8_decode('Dirección:'),0, 1 , 'L' );      
        $this->SetXY(10,93);
        $this->Cell(48,4, utf8_decode('Ciudad:'),0, 1 , 'L' );  
        $this->SetXY(10,98);
        $this->Cell(48,4, utf8_decode('Teléfono:'),0, 1 , 'L' );
        $this->SetXY(10,106);
        $this->Cell(48,4, utf8_decode('Observaciones:'),0, 1 , 'L' );  
        $this->SetFont('Arial','',10);
 
        $this->SetXY(35,78);
        $this->Cell(48,4, utf8_decode($terceroNombre),0, 1 , 'L' );  
        $this->SetXY(158,78);
        $this->Cell(48,4, utf8_decode($factdeffechcrea),0, 1 , 'L' );  
        $this->SetXY(35,83);
        $this->Cell(48,4, $terceroIdenTipo .' '.utf8_decode($terceroIdenNumero),0, 1 , 'L' ); 
        $this->SetXY(158,83);
        $this->Cell(48,4, utf8_decode($factdeffechvence),0, 1 , 'L' );  
        $this->SetXY(35,88);
        $this->Cell(48,4, utf8_decode($terceroDireccion),0, 1 , 'L' );  
        $this->SetXY(35,93);
        $this->Cell(48,4, utf8_decode($terceroCiudad),0, 1 , 'L' ); 
        $this->SetXY(35,98);
        $this->Cell(48,4, utf8_decode($terceroTelefonos),0, 1 , 'L' );      
        $this->SetXY(10,110);
        $this->SetFont('Arial','B',9);  
        $this->MultiCell(190,4, utf8_decode($empre['empresaObservaciones']),0, 'L' ); 

        $this->SetFont('Arial','B',10);        
        $this->Line(6, 120, 200, 120); 
        $this->SetXY(10,122);
        $this->Cell(48,4, utf8_decode('CONCEPTO'),0, 1 , 'L' );
        $this->SetXY(120,122);
        $this->Cell(48,4, utf8_decode('VALOR'),0, 1 , 'L' );
        $this->SetXY(150,122);
        $this->Cell(48,4, utf8_decode('IVA'),0, 1 , 'L' );      
        $this->SetXY(175,122);
        $this->Cell(48,4, utf8_decode('SUBTOTAL'),0, 1 , 'L' );           
        $this->Line(6, 128, 200, 128);         
        $this->SetFillColor(100,255,100);
        $this->SetTextColor(38, 34, 96 ); 
        $this->SetXY($der+17,31);
        $y=$this->GetY();  
    } 
 }
 
 
        //Pie de página
    function Footer()
        {
        date_default_timezone_set('America/Bogota');
        $hoy= date("d-m-Y h:i a");
        $this->SetY(-15);
        $this->SetFont('Arial','I',7);
        $this->Cell(0,10,'FACTURA DE VENTA.  IMPRESA EL: '.$hoy,0,0,'L');
        }
    }
   
    // Detalle del Reporte     
     
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);   

    $valor = 0;
    $descuentos=0;
    $retefuente = 0;
    $reteiva=0;
    $reteica=0;
    $Saldo = 0;
    $saldo=0;
    $neto=0;
    $y=$pdf->GetY()+96;
    $x=$pdf->GetX();
    $empresa = $pdf->empresa;
    $nro = $pdf->numero;
    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();
    $resultado = $obj->cargaFactura($empresa, $nro);
    while($factura = mysqli_fetch_assoc($resultado))
    
   // while( $factura = mysqli_fetch_array($resultado, MYSQL_ASSOC) )
    { 
        $valor+=$factura['factdefvalor'];
        $saldo+=$factura['factdefsaldo'];
        $neto+=$factura['factdefneto'];
    $y+=5;    
    $pdf->SetXY(5,$y);
        $pdf->SetXY(10,$y);  
//        $pdf->Cell(48,4, utf8_decode($factura['factdefconcepto']),0 , 'L' );
//        $pdf->SetXY(40,$y);
        $pdf->MultiCell(100,4, utf8_decode($factura['factdefcptodeta']),0, 'J' );
        $pdf->SetXY(110,$y);
        $pdf->Cell(24,4, number_format($factura['factdefvalor']),0, 1 , 'R' );
        $pdf->SetXY(128,$y);
        $pdf->Cell(24,4, number_format($factura['factdefiva']).' %',0, 1 , 'R' );   
        $pdf->SetXY(142,$y);
        $pdf->Cell(24,4, number_format($factura['factdefsaldo']),0, 1 , 'R' );         
        $pdf->SetXY(172,$y);
        $pdf->Cell(24,4, number_format($factura['factdefneto']),0, 1 , 'R' );
        $y=$pdf->GetY();
    }
    $y+=10;
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'SUBTOTAL',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($valor),0, 1 , 'R' );
    $y+=4;
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'DESCUENTO',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($descuentos),0, 1 , 'R' );
    $y+=4;    
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'IVA',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($saldo),0, 1 , 'R' ); 
    $y+=4;
    
    
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'RETE FUENTE',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($retefuente),0, 1 , 'R' ); 
    $y+=4;
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'RETE IVA',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($reteiva),0, 1 , 'R' ); 
    $y+=4;
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'RETE ICA',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($reteica),0, 1 , 'R' ); 
    $y+=4;    
    $pdf->SetXY(145,$y);
    $pdf->Cell(24,4, 'NETO',0, 1 , 'L' ); 
    $pdf->SetXY(172,$y);
    $pdf->Cell(24,4, number_format($neto),0, 1 , 'R' );   
    $y+=8;
    $pdf->SetFont('Arial','B',10);  
    
    $resultado = $obj->num2letras($neto, false, true);  //num2letras($numero, $fem = false, $dec = true)
    $pdf->SetXY(15,$y);

    $pdf->MultiCell(180,4, utf8_decode($resultado),0, 'L' );
    $y=240;
    $pdf->SetFont('Arial','',8);  
    $pdf->SetXY(40,$y);
    $pdf->Cell(30,2, '______________________________',0, 1 , 'L' ); 
    $pdf->SetXY(120,$y);
    $pdf->Cell(30,2, '______________________________',0, 1 , 'L' ); 
    $y+=4;
    $pdf->SetXY(45,$y);
    $pdf->Cell(30,2, 'AUTORIZADA',0, 1 , 'C' ); 
    $pdf->SetXY(125,$y);
    $pdf->Cell(30,2, 'ACEPTADA',0, 1 , 'C' ); 
    $y+=20;
    $pdf->SetXY(15,$y);
    $pdf->MultiCell(180,4, utf8_decode($pdf->nota),0, 'L' ); 
$pdf->close();
$pdf->Output('Factura'.$nro.'.pdf','D'); 
 ?> 
