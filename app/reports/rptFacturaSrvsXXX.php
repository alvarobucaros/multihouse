<?php 
if( isset( $_COOKIE['mcrCookie'] ) ) {
    $sesion = explode('|',$_COOKIE['mcrCookie']);
 }
 else
 {
 header("location:index.php");   
 }

   require('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
    {
 
  
        private $empresa;
     

     //Cabecera de página
     function Header()
    { 
        $nr =  $_GET['nr'];
        $em = $_GET['em'];
        include_once("../clases/conexion.class.php");
        $obj = new  DBManager();
        $resultado = $obj->leeParametros($em);
        $empre = mysql_fetch_assoc($resultado);
        $nomEmpre = utf8_decode($empre['empresaNombre']);
        $logo = $empre['empresaLogo']; 
        $nit = 'NIT:        ' .$empre['empresaNit'].'-'.$empre['empresaDigito'];
        $dir = 'DIRECCION : '.$empre['empresaDireccion']; 
        $tel = 'TELEFONO  : '.$empre['empresaTelefonos'];        
        $logo = "logos/".$logo;
 
        $this->Image($logo,25,14,20,10);
       
  
        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($this->empresa)+6;
        $this->SetX((210-$w)/2);

//        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY(55, 14);
        $this->Cell(80,6,utf8_encode($nomEmpre),0,1,'C'); 
        $this->Ln(1);$this->SetXY(123, 18);
        $this->Cell(45,6,'',0,1,'C');
        $this->SetTextColor(247,68,36);        

        $this->SetXY(30, 8);
        $this->SetTextColor(31,73,125); 
        $this->Ln(20);
        $this->SetFont('Arial','',8); 
        $this->SetFillColor(31,73,200, 12);
        $this->Ln(1);$this->SetXY(160,12);
        $this->Cell(45,4, utf8_decode($dir),0, 1 , 'L' );
        $this->Ln(1);$this->SetXY(160,15);
        $this->Cell(45,4, utf8_decode($tel),0, 1 , 'L' );
        $this->Ln(1);$this->SetXY(160,18);
        $this->Cell(45,4, utf8_decode($nit),0, 1 , 'L' );
        $this->SetFont('Arial','',8);       
       // $this->Line(6, 28, 200, 28);       
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
        $this->Cell(0,10,'FACURA IMPRESA POR COMPUTADOR.  IMPRESO EN: '.$hoy,0,0,'L');
        }
    }
  

 
    $pdf=new PDF();
    $pdf->AliasNbPages();
    //Primera página
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);

$nro =  $_GET['nr'];
$nr=$nro;
if($nro<10){$nr='00'.$nro;}
else if($nro<100){$nr='0'.$nro;}

$em = $_GET['em'];
$pdf->SetFillColor(243,243,180);
$pdf->Rect(15, 33, 180, 10,'DF');
$pdf->SetXY(20,35);
$pdf->SetFont('Arial','B',12);
$miTitulo = "FACTURA DE VENTA     No. " . $nr;
$pdf->Cell(150,6,utf8_decode($miTitulo),0,1,'R'); 
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(243,243,200);
include_once("../clases/clscontafactura.php");
$objClase = new contafactura();
$resultado = $objClase->recuperaFactura($em, $nro, 1);
$row = explode('||', $resultado);
    $cli = $row[2];
    $fch = $row[3];
    $fchV = $row[4];
    $det = utf8_decode($row[5]);
    $val = number_format($row[6]);
    $porc = $row[7].'%';  // number_format("1000000")
    $iva =  number_format($row[8]);
    $net =  number_format($row[9]);
    $hoy = date("Y-m-d");
    $city= utf8_decode("Bogotá, ") . $hoy;
$resultado = $objClase->traeTercero($em, $cli);   
$row = explode('||', $resultado);
    $nom = $row[0]; 
    $nit = $row[1];     
    $dir = $row[2];  
    $tel = $row[3];  
    $mail = $row[4];  
 $letras = $objClase->num2letras($net);      

$pdf->Rect(15, 46, 180, 36, 'DF');
$pdf->SetXY(24,47); $pdf->Cell(150,6,utf8_decode('CLIENTE:'),0,1); $pdf->SetXY(64,47); $pdf->Cell(70,6, ($nom) ,0,1);
$pdf->SetXY(24,52); $pdf->Cell(150,6,utf8_decode('NIT:'),0,1); $pdf->SetXY(64,52); $pdf->Cell(70,6,  ($nit) ,0,1);   
$pdf->SetXY(24,57); $pdf->Cell(150,6,utf8_decode('DIRECCION:'),0,1);$pdf->SetXY(64,57); $pdf->Cell(70,6,  ($dir) ,0,1);
$pdf->SetXY(24,62); $pdf->Cell(150,6,utf8_decode('TELEFONO:'),0,1); $pdf->SetXY(64,62); $pdf->Cell(70,6,  ($tel) ,0,1);
$pdf->SetXY(24,70); $pdf->Cell(150,6,utf8_decode('CIUDAD Y FECHA:'),0,1); $pdf->SetXY(64,70); $pdf->Cell(70,6,  ($city) ,0,1);
$pdf->SetXY(24,75); $pdf->Cell(150,6,utf8_decode('FECHA FACTURA:'),0,1); $pdf->SetXY(64,75); $pdf->Cell(70,6,$fch,0,1);
$pdf->SetXY(104,75); $pdf->Cell(150,6,utf8_decode('FECHA VENCIMIENTO:'),0,1);$pdf->SetXY(154,75); $pdf->Cell(70,6,$fchV,0,1);
// 
$pdf->Rect(15, 85, 180, 100, 'DF');
$pdf->SetXY(24,88); $pdf->MultiCell(150, 5, $det);                                  //$pdf->Cell(20,10,'Title',1,1,'C'); 
$y = $pdf->GetY()+5;
$pdf->SetXY(120,$y);$pdf->Cell(150,6,utf8_decode('VALOR:'),0,1);$pdf->SetXY(154,$y); $pdf->Cell(20,6,$val,0,0,'R');
$y+=6;                                                                                      //Cell( [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
$pdf->SetXY(120,$y);$pdf->Cell(150,6,utf8_decode('IVA:'),0,1);$pdf->SetXY(130,$y); $pdf->Cell(10,6,$porc,0,1);$pdf->SetXY(154,$y); $pdf->Cell(20,6,$iva,0,0,'R');
$y+=6;
$pdf->SetXY(154,$y); $pdf->Cell(70,6,'-------------------',0,1);
$y+=4;
$pdf->SetXY(120,$y);$pdf->Cell(150,6,utf8_decode('TOTAL:'),0,1);$pdf->SetXY(154,$y); $pdf->Cell(20,6,$net,0,0,'R');
$y+=10;
$pdf->SetXY(24,$y);$pdf->MultiCell(150, 5, $letras);
$y+=35;
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(24,$y); $pdf->Cell(70,6,'ATENTAMENTE: ________________________',0,1);
$pdf->SetXY(110,$y); $pdf->Cell(70,6,'RECIBI: ________________________',0,1);
include_once("../clases/conexion.class.php");
$obj = new  DBManager();
$resultado = $obj->leeParametros($em);
$empre = mysql_fetch_assoc($resultado);
$nomEmpre = $empre['empresaNombre'] . '  NIT: '. $nit = $empre['empresaNit'].'-'.$empre['empresaDigito'].'   IVA: REGIMEN COMUN' ;
$nota = $empre['empresafacturaNota'];
$reso = $empre['empresafacturaresDIAN'];  
$nume = $empre['empresafacturaNumeracion'];
$notaF = $empre['empresaMensaje1']; 
$reporte='Factura'.$empre['empresaClave'].$nr.'.pdf';
$y = 188;

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(24,$y); $pdf->Cell(150,6,utf8_decode($nomEmpre),0,1);
$y+=5;
$pdf->SetFont('Arial','',8);
$pdf->SetXY(24,$y); $pdf->MultiCell(150, 5, $reso);
$y+=5;
$pdf->SetXY(24,$y); $pdf->MultiCell(150, 5, $nume);
$y+=5;
$pdf->SetXY(24,$y);$pdf->MultiCell(150, 5, $nota);
$y=$pdf->GetY();
$y+=5;
$pdf->SetXY(24,$y);$pdf->MultiCell(150, 5, $notaF); 



$pdf->Output($reporte,'I'); 
//$pdf->Output();
 ?> 
