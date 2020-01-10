<?php
/*
* reporte  asistencia
* author alvaro ortiz
* fecha 9/8/2018 12:00 a. m.
*/

     require('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
 
        private $today;
        private $empresa;

     //Cabecera de página
 function Header(){
        $codigo =  $_GET['co'];
        $empresa = $_GET['em'];
        include_once("../bin/cls/clsConection.php");
        $obj = new  DBconexion();

        $resultado = $obj->cargaEmpresa($empresa);            
        
        $empre = explode('||', $resultado);
        $nomEmpre = $empre[1]; 
        $logo = $empre[7]; 
        $empr = $empre[1];
        $nit = 'NIT:        ' .$empre[2];
        $dir = 'DIRECCION : '.$empre[4].' '.$empre[6]; 
        $tel = 'TELEFONO  : '.$empre[5];           
        $logo = "images/".$logo;
        
        $this->Image( $logo ,25,15,20,10);
        $this->SetFont('Arial','B',12);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((310-$w)/2);

        $this->SetFont('Courier','B',12); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->Cell(100,6,utf8_decode($nomEmpre),0,1); 
        $this->Ln(1);
        $this->Cell(45,6,'',0,1,'C');; 
        $this->SetFont('Arial','',9); 
        $codigo = substr($codigo, 0, 4).'/'.substr($codigo, 4, 2).'/'.substr($codigo, 6, 2);
        $miTitulo = "LISTADO DE ASISTENTES A LA REUNION DEL ".$codigo;
              
        $w = $this->GetStringWidth($miTitulo)+6;
        $this->SetX((310-$w)/2);
        $this->Cell(100,6,utf8_decode($miTitulo),0,1); 
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
        $y=$this->GetY();
        $y+=4;
        $this->SetFont('Arial','',7); 
        $this->SetXY(8,$y);
        $this->Cell(0,10,'INMUEBLE',0,0,'L');$this->SetXY(42,$y);
        $this->Cell(0,10,'PROPIETARIO',0,0,'L');$this->SetXY(120,$y);
        $this->Cell(0,10,'AREA',0,0,'L');$this->SetXY(140,$y);
        $this->Cell(0,10,'COEFICIENTE',0,0,'L');$this->SetXY(160,$y);
        $this->Cell(0,10,'PRIMERA',0,0,'L');$this->SetXY(175,$y);
        $this->Cell(0,10,'SEGUNDA',0,0,'L');$this->SetXY(190,$y);
        $this->Cell(0,10,'TERCERA',0,0,'L');$this->SetXY(205,$y);
        $this->Cell(0,10,'CUARTA',0,0,'L');$this->SetXY(220,$y);
        $this->Cell(0,10,'QUINTA',0,0,'L');$this->SetXY(235,$y);
        $this->Cell(0,10,'SEXTA',0,0,'L');$this->SetXY(250,$y);
        $this->Cell(0,10,'OBSERVACIONES',0,0,'L');

        $y+=7; 
        $this->Line(8, $y, 280, $y); 
        $this->SetTextColor(0,0,0);
        
    }

     function Footer()
        {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Listado de asistentes.  Impreso en : '.$this->today,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
     }
  
    $codigo =  $_GET['co'];
    $empresa = $_GET['em'];
    $maxlin = 175;
    $pdf=new PDF('L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $ln=$pdf->GetY();
    $ln+=8;
    setlocale(LC_MONETARY, 'es_CO');

    include_once("../bin/cls/clsReportes.php");
    $obj = new  reportesCls();

    $result = $obj->llamaLista($empresa, $codigo);
     
    $pdf->SetXY(25,$ln);
    $sum1=0.0;
    $sum2=0.0;
    $sum3=0.0;
    $sum4=0.0;
    $sum5=0.0;
    $sum6=0.0;
    
    while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )  
    {         
        $pdf->SetXY(10,$ln); 
        $pdf->Cell(08,6,$reg['lista_inmueble'],0,0);$pdf->SetXY(25,$ln);
        $pdf->Cell(08,6,$reg['lista_cedula'],0,0);$pdf->SetXY(40,$ln);
        $pdf->Cell(25,6,  utf8_decode($reg['lista_propietario']),0,0);$pdf->SetXY(120,$ln);
        $pdf->Cell(80,6,$reg['lista_area'],0,0);$pdf->SetXY(140,$ln);
        $pdf->Cell(80,6,$reg['lista_coeficiente'],0,0);$pdf->SetXY(165,$ln);
        if( $reg['lista_asiste1']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum1 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(180,$ln);
        if( $reg['lista_asiste2']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum2 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(195,$ln);
        if( $reg['lista_asiste3']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum3 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(210,$ln);        
        if( $reg['lista_asiste4']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum4 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(225,$ln);
        if( $reg['lista_asiste5']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum5 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(240,$ln);
        if( $reg['lista_asiste6']==='1'){
            $pdf->Cell(15,6, 'Si' ,0,0);
            $sum6 += $reg['lista_coeficiente'];
        }
        $pdf->SetXY(258,$ln);           
        $pdf->Cell(80,6,utf8_decode($reg['lista_obervacion']),0,0);
        
         $ln+=5;
         if ($ln >= $maxlin){
            $pdf->AddPage();
            $ln=$pdf->GetY()+6; 
         }
    }
$ln+=5;
$pdf->SetXY(140,$ln);
$pdf->Cell(25,6, 'Cuorum:' ,0,0);
$pdf->SetXY(160,$ln); $pdf->Cell(15,6, number_format($sum1*100,2),0,0);
$pdf->SetXY(175,$ln); $pdf->Cell(15,6, number_format($sum2*100,2),0,0);
$pdf->SetXY(190,$ln); $pdf->Cell(15,6, number_format($sum3*100,2),0,0);
$pdf->SetXY(205,$ln); $pdf->Cell(15,6, number_format($sum4*100,2),0,0);
$pdf->SetXY(220,$ln); $pdf->Cell(15,6, number_format($sum5*100,2),0,0);
$pdf->SetXY(235,$ln); $pdf->Cell(15,6, number_format($sum6*100,2),0,0);
$fecha = date("Y/m/d ", $time);
$y=$pdf->GetY();
$y+=8; 
$pdf->SetXY(8,$y);
$pdf->Cell(40,10, 'FIN DEL INFORME...' ,'T',0,1);

$filename="listadoAsistencia".$codigo.".pdf";
$pdf->Output($filename,'D');
$pdf->close();
