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
        public $maxlines;
  
 function Header(){    
        include_once("../bin/cls/clsConection.php");
        $dato = $_GET['dt'];
        $rec = explode('||',$dato) ;
        $obj = new  DBconexion();
        $empresa=$rec[6];
       
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
        $w1=280;
        $this->SetXY(123, 14);
        $this->Rect(10,20,$w1,15);
        $this->Line(70,20,70,35);
        $this->Image($this->logo ,25,21,28,13);
        $ln = 20;

        $this->archivo = 'Consulta-';
        $this->SetFont('Courier','B',9); //Fuente, Negrita, tamaño
        $this->SetTextColor(31,73,125); 
        $this->SetFillColor(31,73,125);

        $w = $this->GetStringWidth($nomEmpre);
        $this->SetXY(($w1-$w)/2,$ln);
        $this->Cell(80,6,$nomEmpre , 0,1,'C'); 
//        $ln += 4;
//        $nomEmpre=' Nit ' . $nit .' Dirección' . $dir .' Tel:' . $tel;
//        $w = $this->GetStringWidth($subtit);
//        $this->SetXY(($w1-$w)/2,$ln);
//        $this->Cell(80,6,$subtit,0,1,'C');
        $ln += 6;
        $subtit="CONSULTA DE ACTAS" ;        
        $w = $this->GetStringWidth($subtit);        
        $this->SetXY(($w1-$w)/2,$ln);
        $this->Cell(80,6, $subtit,0,1,'C'); 
        
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
     
    $maxlines = 180;
    $pdf=new PDF('L');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',8);
    $ln=$pdf->GetY();
    $today= getdate();
    $ln+=8; 
    $dato = $_GET['dt'];
    $rec = explode('||',$dato) ;
    //dato=actaDesde actaHasta fechaDesde fechaHasta tema empresa Descripcion asistente anexos P';
    //4||0||9999||2019-01-01||2019-12-31||||1 ||||||S||P
//     SELECT agenda_id, agenda_Descripcion, agenda_fechaDesde, agenda_fechaHasta, agenda_enFirme,  
//             agenda_conCitacion, agenda_acta, agenda_estado , agenda_causal , comite_nombre , 
//             comite_id, 'Tema' as tp, CONCAT(tema_tipo, ': ', tema_titulo, ' ', tema_detalle) tema,  
//             tema_desarrollo,  tema_responsable, CONCAT(tema_fechaAsigna, ' ', tema_fechaCumple) 
//             fechaDesde_Hasta, tema_agendaId  
        include_once("../bin/cls/citacion.class.php");
        $obj = new mm_agendamiento();

        $resultado = $obj->consultaAgendas($dato);
        $agenda=0;
        $tipo='';
        $ln = linea($ln);

        while($row = mysqli_fetch_assoc($resultado))
        { 
            if($row['agenda_id'] != $agenda){
                $agenda = $row['agenda_id'] ;
                $tema=0;
                $anexo=0;
                $invitados=0;
                $fecha = fechar($row['agenda_fechaDesde'] .$row['agenda_fechaHasta']);
                $ln=$pdf->GetY();
                $ln = linea($ln);
                $pdf->SetXY(12, $ln);
                $pdf->Cell(180,6, 'COMITE : '.utf8_decode($row['comite_nombre']) .' ' . utf8_decode($row['agenda_Descripcion']) .' - '. $fecha  ,0,1,'L');
            }
            if($row['tp'] == 'Tema'){
                $ln = linea($ln);
                if ($tema==0){
                    $pdf->SetXY(12, $ln);
                    $pdf->Cell(10,8,'Temas');
                }
                    $tema+=1;
                    $pdf->SetXY(22, $ln);
                    $pdf->Cell(180,8, utf8_decode($row['tema']) . ' -> Responsable: ' . utf8_decode($row['tema_responsable']) .' - Fecha asigna, cumple: '. $row['fechaDesde_Hasta']  ,0,1,'L');
                    $ln = linea($ln);
                    $pdf->SetXY(22, $ln);
                    $pdf->MultiCell(210, 6, utf8_decode($row['tema_desarrollo'])); 
                    
                }            
             if($row['tp'] == 'Anexo'){
                $ln = linea($ln);
                if ($anexo==0){
                    $pdf->SetXY(12, $ln);
                    $pdf->Cell(10,6,'Anexos');
                }
                    $anexo+=1;
                    $pdf->SetXY(22, $ln);
                    $pdf->Cell(180,6, utf8_decode($row['tema_desarrollo']) . ' -> Archivo: ' . utf8_decode($row['tema']) ,0,1,'L');
                } 
             if($row['tp'] == 'Invitado'){
                $ln = linea($ln);
                if ($invitados==0){
                    $pdf->SetXY(12, $ln);
                    $pdf->Cell(10,6,'Invitados');
                }
                    $invitados+=1;
                    $pdf->SetXY(30, $ln);
                    $pdf->Cell(180,6, utf8_decode($row['tema']) . ' -> Cargo: ' . utf8_decode($row['tema_desarrollo']) ,0,1,'L');
                }                 
        }
        
$pdf->Output($pdf->archivo.'.pdf',''); 
$pdf->Output();

function fechar($desde, $hasta){
    $fch1 = explode(' ', $desde);
    $fch2 = explode(' ',$fch1[0]);
    $fch3 = explode(' ', $hasta);
    $fch=explode('-',$fch2[0]);
//    $hraD = substr($desde, 11,5);
//    $hraH = substr($hasta, 11,5);
    $mes = $fch[1] - 1;
    $nomMes=Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
        'Agosto','Septiembre','Otubre','Noviembre','Diciembre');
    $return = utf8_decode('Reunión del ') . $fch[2]. ' de '. $nomMes[$mes]. ' de '. $fch[0] . 
            ' desde las ' . substr($desde, 11,5) . '  hasta las  ' . substr($hasta, 11,5);
    return $return;
}

    function linea($ln){
        $ln+=5;
        if ($ln >= 180){
         $pdf->AddPage();
         $ln=$pdf->GetY()+15; 
        } 
        return $ln;
    }
