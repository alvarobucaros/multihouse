        <?php
        $miFecha =  date("Y-m-d"); 
        setlocale(LC_TIME,"es_CO");
        include_once("bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $dias='';
        $horaIni='';
        $horaFin='';
        $rango='';
        if ($con){
            $query="SELECT param_diasTrabaja, param_horarioInicio, param_horarioTermina, param_intervaloCalendario ".
                    "FROM mm_parametros";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) != 0) 
            {
                while($row = mysqli_fetch_assoc($result)) {
                  //  print_r( $row);
                    $dias=$row['param_diasTrabaja'];
                    $horaIni=$row['param_horarioInicio'];
                    $rango=$row['param_intervaloCalendario'];
                    $data0 = explode(' ', $horaIni);
                    $data = explode(':',$data0[0]);
                    $hIni=$data[0];
                    $mIni=$data[1];
                    $ok=true;
                    $rng=true;
                    $hra='';
                    $min='';
                    $ampm='am';
                    $horaFin=$row['param_horarioTermina'];
                    $data0 = explode(' ', $horaFin);
                    $data = explode(':',$data0[0]);
                    $hFin=$data[0];
                    $mFin=$data[1];
                    $j=$hFin + 12 - $hIni;
                    if ($rango=='M'){$j *=2;}
                    
                    
                    $i=0;
               
                    while($ok){
                        if($rango=='H'){
                            $hra=$hIni+1;
                            $min='00';
                        }else
                        {
                            $hra=$hIni;
                            if($rng){$min='30';$rng=false;}else{ $hra=$hIni+1; $min='00';$rng=true;};
                        } 
//                        echo '<div class="col-md-12">'; 
//                        echo '<div class="col-md-3 dayTextTOC">'.$hIni.':'.$mIni.' '.$hra.':'.$min. $ampm .'</div>';
//                        echo '<div class="col-md-1 sOtherTOC"></div>';
//                        echo '</div>';
                        $hIni=$hra;
                        $mIni=$min;
                        if($hIni==12){$ampm='pm';}
                        $i+=1;
                        if ($i>  $j){$ok=false;}
                    }                    
                }
            }       
        }
     
        ?> 


    <link href="css/mm.css" rel="stylesheet" type="text/css" />


    <div class="container">
        <div class="row">
            <div class="col-md-12  mainTableTOC">
                <div class="col-md-7"> <span class="monthYearTextTOC" id="fechaHoy">October 2.016</span></div>
                <div class="col-md-1"><input name="diaHoy" type="button" id="diaHoy" value="Hoy" 
                                        class="formButtons" onclick="diaHoy();"></div>
                <div class="col-md-2">
                    <select name="mesHoy" class="formElements" id="mesHoy">
                        <option value='0'>Seleccione mes</option>
                        <option value='1'>Enero</option>
                        <option value='2'>Febrero</option>
                        <option value='3'>Marzo</option>
                        <option value='4'>Abril</option>
                        <option value='5'>Mayo</option>
                        <option value='6'>Junio</option>
                        <option value='7'>Julio</option>
                        <option value='8'>Agosto</option>
                        <option value='9'>Septiembre</option>
                        <option value='10'>Octubre</option>
                        <option value='11'>Noviembre</option>
                        <option value='12'>Diciembre</option>
                    </select>
                </div>
                <div class="col-md-1"><a href="#" onclick="cambiaDia(-1);"> <img src="img/page-prev.gif" alt="semana anterior"/></a></div>            
                <div class="col-md-1 col-md-1"><a href="#" onclick="cambiaDia(1);"> <img src="img/page-next.gif" alt="semana siguiente"/></a></div>            
            </div> 
        </div>
        <div id="test"></div>
        <div style='display: block'>
            <input type="text"  id ='fechaIni' value=""/>
            <input type="text"  id ='fechaFin' value=""/>
            <input type="text"  id ='fechaHoy' value="<?php echo $miFecha ?>"/>
        </div>     
    </div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Standard Demo</h4>
      </div>
      <div class="modal-body">
        <p>This style calendar is best displayed on desktops and large display devices.</p>
        <p>Hover over or touch an event to see more details.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
$(document).ready(function(){
   diaHoy();
}); 

$('#mesHoy').change(function(){
   mes = $('#mesHoy option:selected').val();
   if (mes==0){alert ('El mes no es válido'); return;}
   var fechar = new Date();
   ano = fechar.getFullYear();
   fecha = armaFecha(10,mes,ano);
 //  alert (fecha);
   fechar= new Date(fecha);
   semanas(fechar);
});

function diaHoy(){
    var fechar = new Date();
    semanas(fechar);
}


function cambiaDia(d){
    fechaAux = $('#fechaFin').val();
    if (d < 0 ){fechaAux = $('#fechaIni').val();}
    var res = fechaAux.split("-");
    val=fechaAux.split("-");
    miFecha = new Date(fechaAux);
    dia = res[2];
    mes = res[1];
    ano = res[0]; 
    dia = parseInt(dia)+parseInt(d*2);
    ultimoDiaIni = new Date(miFecha.getFullYear(), mes -1  , 0);
    ultimoDiaFin = new Date(miFecha.getFullYear(), mes  , 0);
   // alert(ultimoDiaIni+'  '+ultimoDiaFin+' =>  '+dia+'  '+mes+'  '+ano);
    if (dia <= 0){
        dia=ultimoDiaIni.getDate();
    mes-=1; if(mes==0){mes=12;ano-=1;}}
    fecha = armaFecha(parseInt(dia),parseInt(mes),parseInt(ano));
  //  alert(fecha);
    miFecha = new Date(fecha);
    semanas(miFecha);
}

function semanas(fechar){
    ultimoDia = new Date(fechar.getFullYear(), fechar.getMonth() , 0);
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");    
    nDiaSem = fechar.getDay();
    diaIni = fechar.getDate();
    diaFin = fechar.getDate();
    mesIni = fechar.getMonth();
    mesFin = fechar.getMonth();
    anoIni = fechar.getFullYear();
    anoFin = fechar.getFullYear();    
    diaIni2 = diaIni - nDiaSem;
  
    if (diaIni2<1){
        mesIni-=1;diaIni=ultimoDia.getDate()+diaIni2; if (mesIni == 0){mesIni=12;anoIni -=1;}
        diaFin = diaFin + 6 - nDiaSem;
        }  // cuando viene del mes anterior
        else
        {
            diaIni=diaIni2;
        }
    ultimoDia = new Date(fechar.getFullYear(), mesIni , 0);
    diaFin = diaFin + 6 - nDiaSem;
    if (diaFin > ultimoDia.getDate()){diaFin = diaFin - ultimoDia.getDate(); mesFin += 1; if (mesFin > 12){mesFin=1;anoFin +=1;}}
    if (diaFin > ultimoDia.getDate()) {alert('ultimo dia'+ultimoDia);}
    hoy = "Semana del " + diaIni + " de " + meses[mesIni]+ " de " + anoIni +
            " al " + diaFin + " de " + meses[mesFin]+ " de " + anoFin;        
    $("#fechaHoy").text(hoy);
    inif=armaFecha(diaIni,mesIni+1,anoIni);
    $("#fechaIni").val(inif);
     finf=armaFecha(diaFin,mesFin+1,anoFin);
    $("#fechaFin").val(finf);
    traeCalendario(inif,finf);
}
function armaFecha(dia,mes,ano){  
    f=ano+'-';
    if(mes<10){f +='0';}
    f+=mes+'-';
    if(dia<10){f +='0';}
    f+=dia;
    return f;
}

   function traeCalendario(inif,finf){
        parametros=inif+'||'+finf;           
        $.post("controller/mm_calendario.php", {accion:'calendario', condicion:parametros}, function(data){
        $('#test').html(data); 

    }); 
    }
</script> 


  
<script type="text/javascript">$(function() {$("#myModal").modal();});</script>  
      
    
    
</body>


