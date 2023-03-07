<?php
require_once ('fpdf.php');
     date_default_timezone_set('America/New_York');
 
     class PDF extends FPDF
     {
        public $tit;
        public $pieTexto;
        public $aviso = true;
      
     function Header()
    { 
        $dt =  explode(',',$_GET['dt']);         
        $empresa = $dt[0];
        $PeriodoDer =  $dt[1];
        $PeriodoIzq =  $dt[2];    
        $variaciones =  $dt[3];    
        $notas =  $dt[4];  
        $control = $dt[7];
        $informe = $dt[8];
        $hoy= date("d-m-Y");
     
        $ms = array(31,28,31,30,31,30,31,31,30,31,30,31);
        $d=$ms[substr($PeriodoDer,4, 2) - 1];
        $fchini = substr($PeriodoDer,0, 4).'/'.substr($PeriodoDer,4, 2).'/'.$d;
        $d=$ms[substr($PeriodoIzq,4, 2) - 1];
        $fchfin = substr($PeriodoIzq,0, 4).'/'.substr($PeriodoIzq,4, 2).'/'.$d;
        include_once("../modulos/mod_contaReportContable.php");
        $obj = new  reportesContCls();
        $nombre = $obj->nombreLista($empresa, $informe );
        $resultado = $obj->cargaEmpresa($empresa);
        while( $empre = mysqli_fetch_assoc($resultado) )
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
        $der=0;
//        if($control === 'SF'){           
//            $this->tit='EtdoSitFin';
//        }
//        if($control === 'ER'){
//            $this->tit='EtdoResul';
//        }  
        $this->tit = strtolower($informe);
        $this->tit = $this->tit.$PeriodoDer;
        $logo = "../img/".$this->logo;
        $titulo=strtoupper($nombre) .' Al '. $fchini;
        
        if($PeriodoDer <> $PeriodoIzq){
            $titulo = $titulo . " Y AL " . $fchfin;
            $this->tit = $this->tit.'-'.$PeriodoIzq;
        }
        
        $this->Image($logo,$der+5,14,20,10,'png');    
        $this->SetFont('Arial','B',10);
        $w = $this->GetStringWidth($nomEmpre)+6;
        $this->SetX((210-$w)/2);
        $this->SetFont('Courier','B',10); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY($der+55, 14);
        $this->Cell(80,6,utf8_decode($nomEmpre),0,1,'C'); 
        $this->SetXY($der+55, 18);
        $this->Cell(80,6,utf8_decode($nit),0,1,'C'); 
        $this->SetXY($der+55, 23);
        $this->Cell(80,6,utf8_decode($titulo),0,1,'C'); 

        $this->SetFont('Arial','',6); 
        $this->SetFillColor(31,73,200, 12);
        $this->SetXY($der+155,14);
        $this->Cell(48,4, utf8_decode($dir),0, 1 , 'L' );
        $this->SetXY($der+155,17);
        $this->Cell(48,4, utf8_decode($tel),0, 1 , 'L' );
        $this->SetXY($der+155,20);
        $this->Cell(48,4, utf8_decode($mail),0, 1 , 'L' );
        $this->Line($der+26, 30, 180, 30); 
        $this->SetFont('Arial','',7); 
        if ($this->aviso){
            if($PeriodoDer===$PeriodoIzq){
                if($notas==='S'){
                    $this->SetXY($der+95,29);
                    $this->Cell(20,6, 'Notas',0,1,'R');
                }
                $this->SetXY($der+95,29);
                $this->Cell(70,6,$fchini,0,1,'C'); 
                if($variaciones==='S'){
                    $this->SetXY($der+115,29);
                    $this->Cell(80,6, utf8_decode('Variación'),0,1,'C');                 
                }
            }else{
                if($notas==='S'){
                    $this->SetXY($der+102,29);
                    $this->Cell(10,6, 'Notas',0,1,'C');
                }
                $this->SetXY($der+122,29);
                $this->Cell(20,6,$fchini,0,1,'C'); 
                $this->SetXY($der+149,29);
                $this->Cell(20,6,$fchfin,0,1,'C');   
                if($variaciones==='S'){
                    $this->SetXY($der+170,29);
                    $this->Cell(14,6, utf8_decode('Variación'),0,1,'C');                 
                }
            }
        }
        else
        {
            $this->SetXY(12,31);
            $w = $this->GetStringWidth('NOTAS AL INFORME')+6;
            $this->SetX((200-$w)/2);
            $this->SetFont('Courier','B',10); 
            $this->Cell(80,4, 'NOTAS AL INFORME' ,0,1);
            $this->SetFont('Arial','',8);
        }
        $this->SetFont('Arial','',6); 
    }

    //Pie de página
    function Footer()
        {
        $hoy= date("d-m-Y h:i a");
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',6);
        //Número de página  .$this->today;
        $this->Cell(0,10,'REPORTE: '. $this->tit. '.  Impreso en : '.$hoy,0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
    }
  

    $dt =  explode(',',$_GET['dt']);         
    $empresa = $dt[0];
    $PeriodoDer =  $dt[1];
    $PeriodoIzq =  $dt[2];    
    $variaciones =  $dt[3];    
    $notas =  $dt[4];  
    $control = $dt[7];
    $informe = $dt[8];
    $notes = array();  
    $yin=5;
    if($PeriodoDer === $PeriodoIzq){$yin=15;}
    $hoy= date("Y-m-d");
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',6);
    $ln=0;
    $y=$pdf->GetY();  
    $ynew=$y;
    include_once("../modulos/mod_contaReportContable.php");
    $obj = new  reportesNif();

    $resultado = $obj->traeInforme($empresa, $informe, $PeriodoDer, $PeriodoIzq);
 
    $pdf->SetXY(04,$y);  
    while($row = mysqli_fetch_assoc($resultado) )
    {
        $spc=$row['tmpbalIndenta']+$yin;
        $tipo=$row['tmptipo'];
        $sumaDer=$row['tmpbalvalor01'];
        $sumaIzq=$row['tmpbalvalor02'];
        $varia=0.0;
        if($tipo!='S'){
            if($PeriodoDer===$PeriodoIzq){
                if($tipo==='R'){                    
                    $pdf->SetXY(92+$yin,$y); 
                    $pdf->Cell(30,4,'------------',0,0,'R');
                    $y+=2;
                    $pdf->SetXY(92+$yin,$y); 
                    $pdf->Cell(30,4,number_format($sumaDer, 2, '.', ','),0,0,'R');
                }
                $pdf->SetXY(26+$spc,$y); 
                $pdf->Cell(200,4,utf8_decode($row['tmpbalnombre']),0,0,'L');
                if($notas==='S'){
                    if($row['tmpbalnotas'] != ''){
                        $tex  = explode(',',$row['tmpbalnotas']);
                        for ($i=0; $i<count($tex); $i++){
                            array_push($notes, $tex[$i]);
                        }
                    }
                    $pdf->SetXY(90+$yin,$y);
                    $pdf->Cell(8,4,$row['tmpbalnotas'],0,0,'R');
                    
                } 
                if($tipo==='C'){                               
                    $pdf->SetXY(92+$yin,$y); 
                    $pdf->Cell(30,4,number_format($sumaDer, 2, '.', ','),0,0,'R');                   
                } 

       } else
       {         
                if($tipo==='R'){
                    $pdf->SetXY(112+$yin,$y); 
                    $pdf->Cell(20,4,'----------------',0,0,'R');
                    $pdf->SetXY(140+$yin,$y); 
                    $pdf->Cell(20,4,'----------------',0,0,'R'); 
                    $y+=2;
                    $pdf->SetXY(112+$yin,$y); 
                    $pdf->Cell(20,4,number_format($sumaDer, 2, '.', ','),0,0,'R');
                    $pdf->SetXY(140+$yin,$y); 
                    $pdf->Cell(20,4,number_format($sumaIzq, 2, '.', ','),0,0,'R'); 
                }
                if($tipo==='C'){
                    $pdf->SetXY(112+$yin,$y); 
                    $pdf->Cell(20,4,number_format($sumaDer, 2, '.', ','),0,0,'R');  
                    $pdf->SetXY(140+$yin,$y); 
                    $pdf->Cell(20,4,number_format($sumaIzq, 2, '.', ','),0,0,'R');   
                }

            $varia=0.0;
            if ($sumaDer <> 0){
                $varia=abs(($sumaDer - $sumaIzq))/$sumaDer * 100;
            }
            if($variaciones==='S' && ($tipo==='C' || $tipo==='R')){
                $pdf->SetXY(155+$yin,$y);
                $pdf->Cell(20,4, number_format($varia, 2, '.', ',').' %',0,0,'R'); 
            }
            if($notas==='S' && ($tipo==='C' || $tipo==='R')){
                if($row['tmpbalnotas'] != ''){
                    $tex  = explode(',',$row['tmpbalnotas']);
                    for ($i=0; $i<count($tex); $i++){
                        array_push($notes, $tex[$i]);
                    }
                }
                $pdf->SetXY($yin+95,$y);
                $pdf->Cell(10,4, $row['tmpbalnotas'],0,1,'C');
            }                        
            $pdf->SetXY(26+$spc,$y); 
            $pdf->Cell(200,4,$row['tmpbalnombre'],0,0,'L'); 
      }       
    }
     $y+=4;
    }
    $resultado = $obj->  traeContador($empresa);
    while($row = mysqli_fetch_assoc($resultado) )
    {
        $lin1r='';
        $lin2r='';
        $lin3r='';
        $lin1c='';
        $lin2c='';
        $lin3c='';
        $lin1f='';
        $lin2f='';
        $lin3f='';
        if($row['empresaRepresentante'] != ''){
            $lin1r = "REPRESENTANTE LEGAL";
            $lin2r = utf8_decode($row['empresaRepresentante']);
            $lin3r = ' CC.'. $row['empresaIdentifRepresentante'];
     
        } 
        if($row['empresaContador'] != ''){
             $lin1c = "CONTADOR";
             $lin2c = utf8_decode($row['empresaContador']);
             $lin3c =' CC.'. $row['empresaIdentifContador']. ' Mat. '.$row['empresaMatriculaContador'];
      
        }      
        if($row['empresaRevisor'] !== ''){ 
            $lin1f = "REVISOR FISCAL";
            $lin2f = utf8_decode($row['empresaRevisor']);
            $lin3f =' CC.'. $row['empresaIdentifRevisor']. ' Mat. '.$row['empresaMatriculaRevisor'];
         }
     
        $y=$pdf->GetY()+12; 
        $pdf->SetXY(10,$y);   
        $pdf->Line($der+26, $y, 180, $y);  
  
        $y += 2; 
        $y=$pdf->GetY()+10; 
        $pdf->SetXY(40,$y);   
        $pdf->Cell(20,4, $lin1r ,0,1);
        $pdf->SetXY(100,$y);   
        $pdf->Cell(20,4, $lin1c ,0,1);
        $pdf->SetXY(160,$y);   
        $pdf->Cell(20,4,$lin1f ,0,1);
        $y += 4; 
        $pdf->SetXY(40,$y);   
        $pdf->Cell(20,4, $lin2r ,0,1);  
        $pdf->SetXY(100,$y);  
        $pdf->Cell(20,4, $lin2r ,0,1); 
        $pdf->SetXY(160,$y); 
        $pdf->Cell(20,4, $lin2f ,0,1); 
        $y += 4; 
        $pdf->SetXY(40,$y);   
        $pdf->Cell(20,4, $lin3r ,0,1); 
         $pdf->SetXY(100,$y);  
        $pdf->Cell(20,4, $lin3c ,0,1); 
        $pdf->SetXY(160,$y); 
        $pdf->Cell(20,4, $lin3f ,0,1);  
    }
    if ($notas==='S'){
        $ptos='';
        $pdf->aviso=false;       
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $y=$ynew;        
        $pdf->SetFont('Arial','',8);
        for ($i=0; $i<count($notes);$i++){
            $ptos.=$notes[$i].','; 
        }
        $ptos=  substr($ptos, 0, strlen($ptos)-1);
        $resultado = $obj->traeNotas($empresa, $informe, $ptos);
        while($row = mysqli_fetch_assoc($resultado) )
        { 
            $y+=6;
            if($y > 250){
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $y=$ynew;              
            }
            $pdf->SetXY(10,$y);
            $pdf->Cell(10,5, 'Nota '.$row['notacodigo'] ,0,1);
            $pdf->SetXY(24,$y);
            $pdf->MultiCell(160,5,  utf8_decode($row['notadetalle']),0,'L');
            $y=$pdf->GetY();
        }
    }
    $pdf->SetFont('Arial','',6);
    $y+=8; 
    $pdf->SetXY(8,$y);
    $pdf->Cell(80,4, 'FIN DEL INFORME ' ,0,1);
    $reporte = $pdf->tit.' '.$hoy.'.pdf';
    $pdf->Output($reporte,'D'); 
 ?> 

