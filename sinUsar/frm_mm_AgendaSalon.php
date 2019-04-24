
 <script type="text/JavaScript">
  var ol_width=280;
  var ol_delay=200;
  var ol_fgcolor="#FFFFFF";
  var ol_bgcolor="#AAAAAA";
  var ol_offsetx=2;
  var ol_offsety=2;
  var ol_border=1;
  var ol_sticky=1;
  var ol_vauto=1;
</script>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

            <!-- overLIB (c) Erik Bosrup -->
</script>    
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-32215009-1', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/JavaScript">
<!--
function popupEvent(ev, w, h) {
  var winl = (screen.width - w) / 2;
  var wint = (screen.height - h) / 2;
  win = window.open("/v7demo/functions/popup.php?ev=" + ev + "&showCat=&showGrp=&oc=1","Calendar","scrollbars=yes,status=no,location=no,toolbar=no,menubar=no,directories=no,resizable=yes,width=" + w + ",height=" + h + ",top=" + wint + ",left=" + winl + "");
  if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
  }
//-->
</script>

    <div class="container">
      <div class="row">
        <div class="col-md-12">

<form style="margin:0;" name="form3" method="post" action="">
    <table class="mainTableTOC" cellspacing="1" cellpadding="0" border="0">
 <tr>
  <td class="monthYearRowTOC" colspan="7" >  
    <table width="100%"><tr>
        <td class="monthYearTextTOC"><span id="fechaHoy"></span></td>  
  <td style="text-align: right;"><input name="awioufhaioeu" type="button" id="awioufhaioeu" value="Hoy" class="formButtons" onclick="fechaHoy();">
      <select name="mo" class="formElements" id="mo">
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
        <option value='12'>Diciembre</option></select>

  <input name="dateChange" type="submit" class="formButtons" id="dateChange" value="Ir" onclick="cambiaMes();" >
  <input name="epcprev" type="button" id="epcprev" value="<<" class="formButtons" onclick="sumaFecha(-1);" >
  <input name="next" type="button" id="next" value=">>" class="formButtons" onclick="sumaFecha(1);" >
  </td></tr></table></td>
 </tr>
 <div id="calendario"></div>
 <tr class="dayNamesTextTOC">
  <td class="horaNamesRowTOC">Hora</td>
  <td class="dayNamesRowTOC">Lun</td>
  <td class="dayNamesRowTOC">Mar</td>
  <td class="dayNamesRowTOC">Mié</td>
  <td class="dayNamesRowTOC">Jue</td>
  <td class="dayNamesRowTOC">Vie</td>
 </tr>
 
 <tr class="rowsTOC">
  <td class="horaNamesRowTOC">08:00-09:00</td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td> 
</tr>

 <tr class="rowsTOC">
  <td class="horaNamesRowTOC">09:00-10:00</td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
</tr>

 <tr class="rowsTOC">
  <td class="horaNamesRowTOC">10:00-11:00</td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
</tr>
 <tr class="rowsTOC">
  <td class="horaNamesRowTOC">11:00-12:00</td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
</tr>
 <tr class="rowsTOC">
  <td class="horaNamesRowTOC">12:00-01:00</td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
  <td class="daynumTOC"></td>
</tr>
<!-- <tr class="rowsTOC">
  <td class="s20TOC0"><div class='daynumTOC'>16</div></td>
  <td class="s20TOC"><div class='daynumTOC'>17</div><div class="titleTOC" onmouseover="return overlib('&lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;2&quot; cellspacing=&quot;0&quot; class=&quot;popupDateTable&quot;&gt;  &lt;tr&gt;&lt;td class=&quot;popupDate&quot;&gt;October 17, 2016&lt;/td&gt;&lt;td class=&quot;popupClose&quot;&gt;&lt;a href=&quot;javascript:void(0);&quot; onmouseover=&quot;javascript:cClick();&quot;&gt;&lt;span class=&quot;popupClose&quot;&gt;[X]&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;br /&gt;&lt;div class=&quot;popupEventTitle s23&quot;&gt;Third Monday&lt;/div&gt;&lt;div class=&quot;popupEventTime&quot;&gt;5:00 PM&lt;/div&gt;&lt;div class=&quot;popupEventDescription&quot;&gt;&lt;h3&gt;The quick brown fox jumped over the lazy dog.&lt;/div&gt;&lt;br /&gt;&lt;div align=&quot;center&quot;&gt;    &lt;span style=&quot;font-family: Geneva, Verdana, Arial, sans-serif; font-size: 10px; color: #CCCCCC;&quot;&gt;&amp;copy; 2016 Easy PHP Calendar&lt;/span&gt;  &lt;/div&gt;');" onmouseout="return nd();"><span class=s23>&nbsp;&nbsp;</span><strong> 5p</strong> Third Monday</div></td>
  <td class="s20TOC"><div class='daynumTOC'>18</div><div class="titleTOC" onmouseover="return overlib('&lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;2&quot; cellspacing=&quot;0&quot; class=&quot;popupDateTable&quot;&gt;  &lt;tr&gt;&lt;td class=&quot;popupDate&quot;&gt;October 18, 2016&lt;/td&gt;&lt;td class=&quot;popupClose&quot;&gt;&lt;a href=&quot;javascript:void(0);&quot; onmouseover=&quot;javascript:cClick();&quot;&gt;&lt;span class=&quot;popupClose&quot;&gt;[X]&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;br /&gt;&lt;div class=&quot;popupEventTitle s23&quot;&gt;Third Monday&lt;/div&gt;&lt;div class=&quot;popupEventTime&quot;&gt;5:00 PM&lt;/div&gt;&lt;div class=&quot;popupEventDescription&quot;&gt;&lt;h3&gt;The quick brown fox jumped over the lazy dog.&lt;/div&gt;&lt;br /&gt;&lt;div align=&quot;center&quot;&gt;    &lt;span style=&quot;font-family: Geneva, Verdana, Arial, sans-serif; font-size: 10px; color: #CCCCCC;&quot;&gt;&amp;copy; 2016 Easy PHP Calendar&lt;/span&gt;  &lt;/div&gt;');" onmouseout="return nd();"><span class=s23>&nbsp;&nbsp;</span><strong> 5p</strong> Third Monday</div></td>
  <td class="s20TOC"><div class='daynumTOC'>19</div><div class="titleTOC" onmouseover="return overlib('&lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;2&quot; cellspacing=&quot;0&quot; class=&quot;popupDateTable&quot;&gt;  &lt;tr&gt;&lt;td class=&quot;popupDate&quot;&gt;October 19, 2016&lt;/td&gt;&lt;td class=&quot;popupClose&quot;&gt;&lt;a href=&quot;javascript:void(0);&quot; onmouseover=&quot;javascript:cClick();&quot;&gt;&lt;span class=&quot;popupClose&quot;&gt;[X]&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;br /&gt;&lt;div class=&quot;popupEventTitle s23&quot;&gt;Third Monday&lt;/div&gt;&lt;div class=&quot;popupEventTime&quot;&gt;5:00 PM&lt;/div&gt;&lt;div class=&quot;popupEventDescription&quot;&gt;&lt;h3&gt;The quick brown fox jumped over the lazy dog.&lt;/div&gt;&lt;br /&gt;&lt;div align=&quot;center&quot;&gt;    &lt;span style=&quot;font-family: Geneva, Verdana, Arial, sans-serif; font-size: 10px; color: #CCCCCC;&quot;&gt;&amp;copy; 2016 Easy PHP Calendar&lt;/span&gt;  &lt;/div&gt;');" onmouseout="return nd();"><span class=s23>&nbsp;&nbsp;</span><strong> 5p</strong> Third Monday</div></td>
  <td class="s20TOC"><div class='daynumTOC'>20</div><div class="titleTOC" onmouseover="return overlib('&lt;table width=&quot;100%&quot; border=&quot;0&quot; cellpadding=&quot;2&quot; cellspacing=&quot;0&quot; class=&quot;popupDateTable&quot;&gt;  &lt;tr&gt;&lt;td class=&quot;popupDate&quot;&gt;October 20, 2016&lt;/td&gt;&lt;td class=&quot;popupClose&quot;&gt;&lt;a href=&quot;javascript:void(0);&quot; onmouseover=&quot;javascript:cClick();&quot;&gt;&lt;span class=&quot;popupClose&quot;&gt;[X]&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;br /&gt;&lt;div class=&quot;popupEventTitle s23&quot;&gt;Third Monday&lt;/div&gt;&lt;div class=&quot;popupEventTime&quot;&gt;5:00 PM&lt;/div&gt;&lt;div class=&quot;popupEventDescription&quot;&gt;&lt;h3&gt;The quick brown fox jumped over the lazy dog.&lt;/div&gt;&lt;br /&gt;&lt;div align=&quot;center&quot;&gt;    &lt;span style=&quot;font-family: Geneva, Verdana, Arial, sans-serif; font-size: 10px; color: #CCCCCC;&quot;&gt;&amp;copy; 2016 Easy PHP Calendar&lt;/span&gt;  &lt;/div&gt;');" onmouseout="return nd();"><span class=s23>&nbsp;&nbsp;</span><strong> 5p</strong> Third Monday</div></td>
  <td class="s20TOC"><div class='daynumTOC'>21</div></td>
  <td class="s20TOC0"><div class='daynumTOC'>22</div></td>-->
</tr>

</table>
</form>

</div>
</div>
</div>

<div style='display: block'>
<input type="text"  id ='fechaIni' value=""/>
<input type="text"  id ='fechaFin'  value=""/>
</div>
<div id="test"></div>

 


<script type="text/javascript">$(function() {$("#myModal").modal();});</script>  </body>

<script type="text/javascript">
$(document).ready(function(){
    var fechar = new Date();
    semanas(fechar);
}); 

function fechaHoy(){
    var fechar = new Date();
    semanas(fechar);
}

function adelante(){
    var topDiaMes = Array(31,28,31,30,31,30,31,31,30,31,30,31);
    if ( fechar % 4 == 0 || fechar % 400 == 0) {
        topDiaMes[1]=29;
    }
    
}

function cambiaMes(){
   mes = $('#mo option:selected').val();
   alert (mes);
   var fechar = new Date();
   ano = fechar.getFullYear();
   fecha = armaFecha(15,mes,ano);
   fechar= new Date(fecha);
   semanas(fechar);
}


sumaFecha = function(d)
{
   
    Fecha = $('#fechaFin').val();
    if (d < 0 ){Fecha = $('#fechaIni').val();}
//alert(Fecha);
    var aFecha = Fecha.split('-');
    var fecha = aFecha[0]+'/'+aFecha[1]+'/'+aFecha[2];
    fecha=Fecha.replace('-','/');
    fecha= new Date(fecha);
    fecha.setDate(fecha.getDate()+parseInt(d));
    semanas (fecha);

// var date = new Date();
//var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
//var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
 
 }
function semanas(fechar){
    ultimoDia = new Date(fechar.getFullYear(), fechar.getMonth() + 1, 0);
    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");    
    nDiaSem = fechar.getDay();
    diaUltimo = ultimoDia.getDate();
    diaIni = fechar.getDate();
    diaFin = fechar.getDate();
    mesIni = fechar.getMonth();
    mesFin = fechar.getMonth();
    anoIni = fechar.getFullYear();
    anoFin = fechar.getFullYear();    
    diaIni -= nDiaSem;
   
    diaFin = diaFin + 6 - nDiaSem;
    if (diaFin > diaUltimo ){diaFin = diaFin - diaUltimo; mesFin += 1; if (mesFin > 12){mesFin=1;anoFin +=1;}}
    if (diaFin >ultimoDia) {alert('ultimo dia'+ultimoDia);}
    hoy = "Semana del " + diaIni + " de " + meses[mesIni]+ " de " + anoIni +
            " al " + diaFin + " de " + meses[mesFin]+ " de " + anoFin;        
    $("#fechaHoy").text(hoy); 
    $("#fechaIni").val(armaFecha(diaIni,mesIni,anoIni));
    $("#fechaFin").val(armaFecha(diaFin,mesFin,anoFin));
    traeCalendario();
}
function armaFecha(dia,mes,ano){
    f=ano+'-';
    if(mes<10){f +='0';}
    f+=mes+'-';
    if(dia<10){f +='0';}
    f+=dia;
    return f;
}

   function traeCalendario(){
        parametros=$("#fechaIni").val()+'||'+$("#fechaFin").val();
        return;
        alert(parametros);
        $.post("controller/mm_calendario.php", {accion:'calendario', condicion:parametros}, function(data){
            alert(data);
        $('#test').html(data); 

    }); 
    }
</script> 


