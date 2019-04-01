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
  
 function Header(){    
        include_once("../bin/cls/clsConection.php");
        $obj = new  DBconexion();
        $empresa=$_GET['em'];
        $resultado = $obj->cargaEmpresa($empresa);
        $empre = array();
        $empre = explode('||', $resultado);
        $nomEmpre = $empre[1];         
        $nit = 'NIT : ' .$empre[2];
        $dir = 'DIRECCION : '.$empre[4].' '.$empre[6];   
        $tel = 'TELEFONO : '.$empre[5]; 
        $this->pieTexto = $nomEmpre . '   '. trim($nit) . '   '. trim($dir) . '   '. trim($tel);
        $this->logo = 'images/'.$empre[7];
        $time = time();
        $this->today = date("Y/m/d H:i:s", $time);
        $this->ciudad = $empre[6];
        $this->lugar = $empre[4];
     
        include_once("../bin/cls/citacion.class.php");
        $obj = new mm_agendamiento();
        $comite_td=$_GET['op'];
        $resultado = $obj->traeComite($comite_td);
        $reg = array();
        $reg = explode('||', $resultado);
        $comite_nombre = $reg[0]; 
        $comite_consecActa = $reg[1];
       
        $this->archivo = 'Acta-'. $comite_nombre.'-'.$comite_consecActa;
        $this->SetFont('Courier','B',9); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);
        $this->SetXY(140, 12);
        $this->Cell(80,6,"ACTA Nro." . $comite_consecActa,0,1,'C'); 
    $y=$this->GetY();        
    }  
 
    //Pie de página
     function Footer()
        {
        $w = $this->GetStringWidth($this->pieTexto)+6;
        $this->SetX(100);
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(100,6,utf8_decode($this->pieTexto),0,1,'L'); 
        $this->SetY(-14);
        $this->Cell(0,10,'Impreso en: '.utf8_decode($this->today),0,0,'L');
        $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'R');
        }
     }
  
// Detalle del Reporte     
     
    $maxlin = 270;
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $ln=$pdf->GetY();
    $ln+=8;     
        include_once("../bin/cls/citacion.class.php");
        $obj = new mm_agendamiento();
        $comite_td=$_GET['op'];
        $resultado = $obj->traeComite($comite_td);
        $reg = array();         
        $reg = explode('||', $resultado);
        $comite_nombre = $reg[0]; 
        $comite_consecActa = $reg[1];  
        $salon_nombre = $reg[2]; 
        $agenda_Descripcion = $reg[3];  
        $salon_ubicacion = $reg[4];  
        $agenda_fechaDesde = $reg[5]; 
        $agenda_fechaHasta = $reg[6]; 
        $convocatoria= $reg[7];
        $comite_id=$reg[8];
        $agenda_id = $_GET['op'];
        $empresa=$_GET['em'];
        $desde = array();
        $fch=array();
        $desde = explode(' ',$agenda_fechaDesde);
        $fch=explode('-',$desde[0]);
        $mes = $fch[1] - 1;
        $nomMes=Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
            'Agosto','Septiembre','Otubre','Noviembre','Diciembre');
        $fechaAux = $fch[2]. ' de '. $nomMes[$mes]. ' de '. $fch[0];
        $hra=explode(':',$desde[1]);
        $am=" am";
        if ($hra[0]>11){$am = " pm";}
        $dsde = "De las ".$hra[0].':'.$hra[1].$am ;
        $desde = explode(' ',$agenda_fechaHasta);
        $fch=explode('-',$desde[0]);
        $hra=explode(':',$desde[1]);
        $am=" am";
        if ($hra[0]>11){$am = " pm";}
        $dsde .= " a las ".$hra[0].':'.$hra[1].$am ;

        $pdf->SetXY(123, 14);
        $pdf->Rect(10,20,186,15);
        $pdf->Line(70,20,70,35);
        $pdf->Image($pdf->logo ,25,21,28,13);
        $ln = 19;
        $w1=130;
        $subtit="ACTA DE REUNION" ;        
        $w = $pdf->GetStringWidth($subtit);        
        $pdf->SetXY($w1-$w/2,$ln);
        $pdf->Cell(80,6, $subtit,0,1,'L'); 
      
        $ln+=4;
        $subtit="COMITE: ".utf8_decode($comite_nombre);
        $w = $pdf->GetStringWidth($subtit);
        $pdf->SetXY($w1-$w/2,$ln);
        $pdf->Cell(120,6, $subtit,0,1,'L');
     
        $ln+=4;
        $subtit=utf8_decode($agenda_Descripcion);
        $w = $pdf->GetStringWidth($subtit);
        $pdf->SetXY($w1-$w/2,$ln);
        $pdf->Cell(200,6, $subtit,0,1,'L');   
        $ln=$pdf->GetY();
        $ln+=8;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'FECHA :',0,1,'L');
        $pdf->SetXY(65, $ln);
        $pdf->Cell(80,6,utf8_decode($pdf->ciudad).', '.$fechaAux,0,1,'L');
        
        $ln+=6;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'HORA :',0,1,'L');
        $pdf->SetXY(65, $ln);
        $pdf->Cell(80,6, $dsde,0,1,'L');
        $ln+=6;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'LUGAR :',0,1,'L');
        $pdf->SetXY(65, $ln);
        $pdf->Cell(80,6,utf8_decode('Salón : '.$salon_nombre),0,1,'L');
        $ln+=6;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'ASISTENTES :',0,1,'L');

        $trascriptor='';
        $preside='';
        $secretario='';
        $noAsistio=0;
        
        $resultado = $obj->traeInitadosComite($comite_td);
            
        while($row = mysqli_fetch_assoc($resultado))
        {    
            $ln=$pdf->GetY();

            if($row['invitado_asistio']  == 'N'){
                $noAsistio+=1;
            }
            else{
                if($row['invitado_titulo']  != ''){
                    if($row['invitado_titulo']  == 'T'){$trascriptor=trim($row['invitado_nombre']);}
                    if($row['invitado_titulo']  == 'P'){$preside=trim($row['invitado_nombre']);}
                    if($row['invitado_titulo']  == 'S'){$secretario=trim($row['invitado_nombre']);}
                }
                $deta = utf8_decode(trim($row['invitado_nombre'])). '  '.
                        utf8_decode(trim($row['invitado_cargo'])).'  '.
                        utf8_decode(trim($row['invitado_empresa']));
                $pdf->SetXY(35,$ln);
                $pdf->MultiCell(160, 6, $deta); 
                 $ln+=5;
                 if ($ln >= $maxlin){
                    $pdf->AddPage();
                    $ln=$pdf->GetY()+6; 
                 }                
            }

        }
        
        if($noAsistio > 0){
            $ln+=4;
            $pdf->SetXY(30, $ln);
            $pdf->Cell(88,6, 'AUSENTES:',0,1,'L'); 
            mysqli_data_seek($resultado, 0);
            while($row = mysqli_fetch_assoc($resultado))
            {    
                $ln=$pdf->GetY();
                if($row['invitado_asistio']  == 'N'){
                    $deta = utf8_decode(trim($row['invitado_nombre'])). '  '.
                    utf8_decode(trim($row['invitado_cargo'])).'  '.
                    utf8_decode(trim($row['invitado_empresa']));
                    $pdf->SetXY(35,$ln);
                    $pdf->MultiCell(160, 6, $deta); 
                    $ln+=5;
                    if ($ln >= $maxlin){
                       $pdf->AddPage();
                       $ln=$pdf->GetY()+6; 
                    }   
                }
            }            
        }
        
        $ln+=5;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'ORDEN DEL DIA :',0,1,'L');
        
        $resultado = $obj->traeTemasComite($comite_td);
       
        while($row = mysqli_fetch_assoc($resultado))
        {    
            $ln=$pdf->GetY();
      //      $ln+=7;
            $deta = trim($row['tema_orden']).'. '.utf8_decode(trim($row['tema_titulo'])). '  '.
                    utf8_decode(trim($row['tema_detalle']));
            if($row['tema_responsable'] != ''){ $deta .= ' Responsable '. utf8_decode(trim($row['tema_responsable']));}
            $pdf->SetXY(35,$ln);
            $pdf->MultiCell(160, 6, $deta); 
             $ln+=5;
             if ($ln >= $maxlin){
                $pdf->AddPage();
                $ln=$pdf->GetY()+6; 
             }
        }
         $ln=$pdf->GetY();
         $ln+=5;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(88,6, 'DESARROLLO :',0,1,'L');
        mysqli_data_seek($resultado, 0);
        while($row = mysqli_fetch_assoc($resultado))
        {    
            $ln=$pdf->GetY();   
            $deta = trim($row['tema_orden']).'. '.utf8_decode(trim($row['tema_titulo'])). '  '.
                    utf8_decode(trim($row['tema_detalle'])) . '  '.
                    utf8_decode(trim($row['tema_desarrollo']));
            $pdf->SetXY(35,$ln);
            $pdf->MultiCell(160, 6, $deta); 
             $ln+=5;
             if ($ln >= $maxlin){
                $pdf->AddPage();
                $ln=$pdf->GetY()+6; 
             }
        }
        if ($convocatoria != ''){
            $ln=$pdf->GetY();
            $ln+=5;
            $pdf->SetXY(30, $ln);
            $pdf->Cell(88,6, 'PROXIMA CONVOCATORIA :',0,1,'L'); 
            $ln+=5;
            $pdf->SetXY(35, $ln);
            $pdf->Cell(88,6, $convocatoria,0,1,'L'); 
        }
        $ln=$pdf->GetY()+5;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(80,6, utf8_decode(trim($preside)),0,1,'L'); 
        $pdf->SetXY(100, $ln);
        $pdf->Cell(80,6, utf8_decode(trim($secretario)),0,1,'L'); 
        
        $ln += 4;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(80,6, 'Presidente',0,1,'L'); 
        $pdf->SetXY(100, $ln);
        $pdf->Cell(80,6, 'Secretario(a)',0,1,'L');
        
        $ln += 8;
        $pdf->SetXY(30, $ln);
        $pdf->Cell(80,6, 'Transcriptor: '.utf8_decode(trim($trascriptor)),0,1,'L');
        $resultado = $obj->traeAnexos($empresa, $comite_id, $agenda_id);
        $row_cnt = 0;
        if ($ln >= $maxlin){
            $pdf->AddPage();
            $ln=$pdf->GetY()+6; 
         }
        while($row = mysqli_fetch_assoc($resultado))
        {
              $row_cnt = $resultado->num_rows;       
        }
        if ($row_cnt > 0){
            $ln += 8;
            $pdf->SetXY(30, $ln);
        //    $pdf->SetFont('Arial','B'); 
        //    $pdf->Cell(80,2, 'NOTA: ',0,1,'L');
        //    $pdf->SetFont('Arial','',8);
           // $pdf->SetXY(38, $ln);
            $pdf->Cell(80,6, 'NOTA :  Esta acta tiene '.$row_cnt. utf8_decode(' anexo(s) que puede consultar(los) en la Aplicación :'),0,1,'L');  
            mysqli_data_seek($resultado, 0);
            $anexos='';
            while($row = mysqli_fetch_assoc($resultado))
            {    
                $anexos .= trim($row['anexos_descripcion']).',  ';  
            }            
            $ln=$pdf->GetY();
            $pdf->SetXY(30,$ln);
            $pdf->MultiCell(160, 6, $anexos); 
            
            
        }
$pdf->close();
$pdf->Output($pdf->archivo.'.pdf','D'); 
$pdf->Output();


