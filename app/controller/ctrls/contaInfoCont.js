var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_imprimeSaldos = 'Saldos del periodo';
    $scope.form_imprimeSitFin = 'Estados Financieros';
    $scope.form_imprimeCtaMov = 'Cuenta y sus movimientos';
    $scope.form_imprimeLibMay = 'Libro Mayor';
    $scope.form_imprimeLibDiario = 'Libro Diario';
    $scope.form_imprimelibAux = 'Libro Auxiliar';
    $scope.form_imprimeMovTer = 'Movimiento por terceros';
    $scope.form_tituloExcel = 'Consultas a Excel';
    $scope.form_infoReporte = "Reporte";
    $scope.form_imprimeCmpbnte = 'Comprobantes del mes';
    $scope.form_cierreMensual = 'Cierre mensual';
    $scope.form_cierrePeriodo = 'Cierre Ejercicio';
    $scope.form_compCierre = 'Comprobante de cierre';
    $scope.form_comprobantes = 'Comprobante';
    $scope.form_compAper = 'Comprobante de inicio';
    $scope.form_ctaCierre = 'Cuenta de cierre';
    $scope.form_fechaDesde="Fecha Desde";
    $scope.form_fechaHasta="Fecha Hasta";
    $scope.form_desdeCuenta = "Desde Cuenta";
    $scope.form_hastaCuenta = "Hasta Cuenta";
    $scope.form_desdePeriodo = "Desde Periodo";
    $scope.form_hastaPeriodo = "Hasta Periodo";
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.from_tercero  = 'Tercero';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnImprimir = 'Imprime ultimo período';
    $scope.form_btnImpreRc = 'Imprime Recibo';
    $scope.form_btnImpreAc = 'Imprime Acuerdo';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnContinua = 'Continuar';
    $scope.form_btnfactura = 'Facturar periodo';
    $scope.form_btnActualiza = 'Actualizar';  
    $scope.form_btnAplicar = 'Aplicar';  
    $scope.form_btnBuscar = 'Buscar';  
    $scope.Mensaje='El periodo ya se facturó';
    $scope.form_imprimeTodos='Imprime todas o una sola:';
    $scope.form_periodo='Periodo';
    $scope.form_anoFiscal = '';
    $scope.form_siguienteAnoFiscal = '';
    $scope.form_vsPeriodo='Contra el periodo';
    $scope.form_Nivel = 'Nivel';
    $scope.form_OrdenPor = 'Ordenado por';
    $scope.form_tipoCmprbnte = 'Comprobantes ';
    $scope.form_Aplicado = "Aplicados";
    $scope.form_Xaplicar = "Por Aplicar";
    $scope.form_fechaTC = "Fecha y Comprobante";
    $scope.form_fechaCT = "Comprobante y Fecha";
    $scope.form_ctaCompro = 'Fecha Comprobante';
    $scope.form_ComproCta = 'Comprobante Fecha';
    $scope.form_variaciones = 'Incluye variaciones';
    $scope.form_nota1Xls='Consulta de movimiento por periodo y conceptos ...';
    $scope.form_nota2Xls='Conceptos a incluir ...';
 
    $scope.variacionesS = 'Si';
    $scope.variacionesN = 'No';
    $scope.form_notas = 'Incluye Notas';
    $scope.notasS = 'Si';
    $scope.notasN = 'No';
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    $scope.nivel = 3;
    $scope.fechaCF = true;
    $scope.orden = 'CF';
    $scope.ruedita = true;
    $scope.aplicados = true;
    $scope.xAplicar = true;
    $scope.noVerBoton=false;
    $scope.empresa = $('#e').val().trim();
    $scope.control = $('#control').val();
    $scope.orden = '';
    $scope.ordenSort==='1'
    $scope.periodoNext='';
 
    var f = new Date();  
    $scope.fechaEdit=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+ ' 00:00:0000';
    $scope.fechaAbono=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
    
    procesa = $('#control').val();
 
    getInfo($scope.empresa);
    
    getCombos($scope.empresa,procesa);
   
    function getInfo(empresa){
       $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        control = $scope.control;
   
        $scope.factura = true; 
        $scope.imprime = false; 
      
        $scope.ultimoPeriodo = rec[15];
        if(control==='SF' || control === 'ER'){
            $scope.ultimoVsPeriodo = rec[15];
            $scope.notas='N';     
            $scope.variaciones='N'; 
            $scope.prepara = false;
            $scope.imprime  = true;
            $scope.imprimeXls = true;
            $scope.form_btnPrepara = 'Prepara información';
            $scope.form_btnImprime = 'Imprime informe';
            $scope.form_btnExporta = 'Exporta a Excel';
        }
        if(control==='TRC' || control === 'XLS'){
            meses=[31,28,31,30,31,30,31,31,30,31,30,31];
     //       $scope.fchDesde = rec[15].substr(0,4)+'-'+rec[15].substr(4,6)+'-01';
            $scope.fchDesde = rec[15].substr(0,4)+'-01-01';
            $scope.fchHasta = rec[15].substr(0,4)+'-'+rec[15].substr(4,6)+'-'+meses[rec[15].substr(4,6)-1]; 
            if(control === 'XLS'){
                $scope.registro.ultimoPeriodo = rec[15];
                $scope.registro.fechaDesde = $scope.fchDesde;
                $scope.registro.fechaHasta = $scope.fchHasta;
                $scope.registro.g1 = false; 
                $scope.registro.g2 = false;
                $scope.registro.g3 = false;
                $scope.registro.g4 = false;
                $scope.registro.g5 = false;
                $scope.registro.g6 = false;
                $scope.registro.g7 = false;
                $scope.registro.g8 = false;
            }
        }  

        if(control==='CEJ'){
            $scope.form_anoFiscal = rec[16];
            $scope.form_siguienteAnoFiscal = parseInt(rec[16])+1;
            $scope.compCierre= rec[17];
            $scope.compAper   = rec[18];
            $scope.ctaCierre = rec[19];
            $scope.periodo = rec[15];
            if ($scope.periodo.substring(4,6) != '13'){         
               $scope.error='El cierre del ejercicio se debe hacer en el periodo '+$scope.periodo.substring(0,4)+'13 únicamente';
               $scope.noVerBoton=true;
            }
        }  
        
        if(control === 'LMY' || control === 'LDI' || control === 'CIM')
        {
            $scope.periodo = rec[15];
        }
        if(control === 'LDI'){
            $scope.compFecha = true;  
            $http.post('modulos/mod_containformes.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
            $scope.operators1 = data;
            });
            $scope.comprobantes=00;
        }
        if(control === 'CIM')
        {
            $scope.periodoNext='';
            ano=$scope.periodo.substring(0, 4);
            mes=$scope.periodo.substring(4,6);
            if (mes >= '13'){
                $scope.periodoNext='...';
               $scope.error='El mes 13 es para el cierre del ejercicio, no tiene cierre mensual, debe usar el cierre de ejercicio';
                $scope.noVerBoton=true;
            }else
            {                
                $scope.noVerBoton=false;            
                mes = parseInt(mes)+1;
                $scope.periodoNext = ano;
                if(mes < 10) {$scope.periodoNext+='0';};
                $scope.periodoNext+=mes;
            }       
        }        
        if(control === 'CMV'){
            $scope.desdePeriodo = rec[15].substr(0,4)+'01';
            $scope.hastaPeriodo = rec[15];
        }
        if (control=== 'LAX'){
            $scope.desdePeriodo = rec[15];
        }

        });           
     }
     
  
    function getCombos(empresa,control){
        if (control==="SF"){
            $http.post('modulos/mod_containformes.php?op=3',{'op':'3','empresa':empresa}).success(function(data){
            $scope.operators1 = data;         
            });
            return;
        }
        if(control==='TRC'){
            $http.post('modulos/mod_containformes.php?op=4',{'op':'4','empresa':empresa}).success(function(data){
            $scope.operators0 = data;
             });    
             return; 
        } 
        
        if (control=== 'LAX' || control === 'CMV'){
            $http.post('modulos/mod_containformes.php?op=2m',{'op':'2m','empresa':empresa}).success(function(data){
            $scope.operators0 = data;  
            $scope.operators1 = data;
            $scope.desdeCuenta = data[0].pucCuenta;           
            n=data.length-1;
            $scope.hastaCuenta = data[n].pucCuenta; 
             });
            return;
        }
        if (control==="SL2"){
            $http.post('modulos/mod_contamovicabeza.php?op=2c',{'op':'2c','empresa':empresa}).success(function(data){
            $scope.operators0 = data;  
            $scope.operators1 = data;
            $scope.desdeCuenta = data[0].pucCuenta;         
            n=data.length-1;
            $scope.hastaCuenta = data[n].pucCuenta; 
            $scope.ultimoPeriodo = rec[15];
            $scope.primerPeriodo = rec[15];
             });            
        }
        else{
            $http.post('modulos/mod_contaprocesos.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
            $scope.operators0 = data;
             });
            $http.post('modulos/mod_contaprocesos.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
            $scope.operators1 = data;
            });
        }

    }
        
    $scope.imprimeSaldos = function(){
        ultimoPeriodo=$scope.ultimoPeriodo;
        nivel=$scope.nivel;
        desdeCuenta=$scope.desdeCuenta;
        hastaCuenta=$scope.hastaCuenta;
        empresa=$scope.empresa.trim(); 
        dato=ultimoPeriodo+','+nivel+','+desdeCuenta+','+hastaCuenta+','+empresa;
        location.href="reports/rptSaldosContables.php?dt="+dato;  
     };
    
    $("input[type='radio']").click(function(){
        var radioValue = $("input[name='orden']:checked").val();
        if(radioValue){
            $scope.orden= radioValue;
        }
    });
    
    function fechar(periodo,op){
        meses=[31,28,31,30,31,30,31,31,30,31,30,31];
        ano=periodo.substr(0, 4);
        mes=parseInt(periodo.substr(4,2)) ;
        if (mes<10){mes='0'+mes;}
        if ((ano % 4 == 0) && ((ano % 100 != 0) || (ano % 400 == 0)))
            {meses[1]=29;}
        fchini=  ano + '/' +  mes +'/01';
        fchfin=  ano + '/' +  mes +'/'+meses[mes-1] ;
        if(op==='I'){return fchini;}
        return fchfin;

    }
    
    $scope.imprimeComprobantes = function(){
        periodoI=$scope.primerPeriodo;
        periodo=$scope.ultimoPeriodo;
        meses=[31,28,31,30,31,30,31,31,30,31,30,31];
        ano=periodo.substring(0, 4);
        mes=periodo.substring(5,6) ;
        if (mes<10){mes='0'+mes;}
        if ((ano % 4 == 0) && ((ano % 100 != 0) || (ano % 400 == 0)))
            {meses[1]=29;}
        fchini=  ano + '/' +  mes +'/01';
        fchfin=  ano + '/' +  mes +'/'+meses[mes-1] ;   
        empresa=$scope.empresa.trim();
        er='';
        if($scope.orden===''){
           $scope.orden = 'FC';
        }
        if(!$scope.aplicados && !$scope.xAplicar){
            er+='Falta definir comprobantes \n';
        }
        if(er === ''){
            
            if($scope.aplicados){ proc = 'S';}
            if($scope.xAplicar){ proc = 'N';}
            if($scope.aplicados && $scope.xAplicar){
                proc = '';
            }
            dato=empresa+','+periodoI+','+periodo+','+fchini+','+fchfin+','+proc+','+$scope.orden;
            location.href="reports/rptComprobantesDelMes.php?dt="+dato;  
        }else{
            alert(er);
        }
     };
      
    $scope.imprimeInfoNif = function(){ 
        er='';
        empresa=$scope.empresa;
        notas = $scope.notas;     
        variaciones = $scope.variaciones;
        ultimoVsPeriodo = $scope.ultimoVsPeriodo;
        ultimoPeriodo  = $scope.ultimoPeriodo;
        informe = $scope.infoReporte;
        if(informe === undefined){
            er += 'Debe definir el informe \n';
        }
        er += valiPeriodo(ultimoPeriodo);
        er += valiPeriodo(ultimoVsPeriodo);
        control = $scope.control;
       
        if(ultimoPeriodo.substr(4,2)==='13' || ultimoVsPeriodo.substr(4,2)==='13' ){
            er += 'El periodo no debe ser 13, este es de solo de cierre del ejercicio \n';
        }
        if(ultimoVsPeriodo < ultimoPeriodo ){
            er += 'El periodo final es mayor al inicial \n';
        }
        if(variaciones==='S' && ultimoVsPeriodo === ultimoPeriodo){
           er += 'No puede haber variaciones en un mismo perido, asume N \n';  
           variaciones='N';
           $scope.variaciones='N';
        }
        if (er ===''){
            $scope.ruedita = false;
            fc=fechar(ultimoPeriodo,'F');
            fcIni = fc.split(",");
            fc=fechar(ultimoVsPeriodo,'F');
            fcFin= fc.split(",");
            dato=empresa+','+ultimoPeriodo+','+ultimoVsPeriodo+','+variaciones+','+notas+','+fcIni+','+fcFin+','+control+','+informe;
            $http.post('modulos/mod_contaplancontable.php?op=ni',{'op':'ni','dato':dato}).success(function(data){
 alert(dato);                
            $scope.ruedita = true;
            }); 
           location.href="reports/rptInformesNif.php?dt="+dato;  
        }else{
            alert(er);
        }
    };
    
    function valiPeriodo(per){
        er='';
        a = per.substr(0,2);
        m = per.substr(4,6);
        if (m <= '00'|| m>'13'){
            er += per+' mes errado \n';
        }
        if (a !== '20'){
            er += per+' fecha errada \n';
        }
        return er;
    }
    
    $scope.imprimeEdoReul = function(){  
        empresa=$scope.empresa;
        notas = $scope.notas;     
        variaciones = $scope.variaciones;
        ultimoVsPeriodo = $scope.ultimoVsPeriodo;
        ultimoPeriodo  = $scope.ultimoPeriodo;
        control = $scope.control;
      //  alert(ultimoPeriodo + ' ' +  ultimoVsPeriodo + ' ' +  variaciones + ' ' +  notas);
        er='';
        if(ultimoVsPeriodo < ultimoPeriodo ){
            er += 'El periodo final es mayor al inicial \n';
        }
        if (er ===''){
            fc=fechar(ultimoPeriodo,'F');
            fcIni = fc.split(",");
            fc=fechar(ultimoVsPeriodo,'F');
            fcFin= fc.split(",");
            dato=empresa+','+ultimoPeriodo+','+ultimoVsPeriodo+','+variaciones+','+notas+','+fcIni[1]+','+fcFin[1]+','+control;
            alert(dato);
            location.href="reports/rptInformesNif.php?dt="+dato;  
        }else{
            alert(er);
        }
    };
    
    $scope.imprimeLibMayor= function(){
        periodo=$scope.periodo;
        nivel = $scope.nivel;
        empresa=$scope.empresa; 
        dato=empresa+','+periodo+','+nivel;
        location.href="reports/rptLibroMayor.php?dt="+dato;     
    };

 
        
    $scope.imprimeLibDiario= function(){
        periodo=$scope.periodo;
        empresa=$scope.empresa; 
        comp=$scope.comprobantes;
        orden='fch';  
        if( $scope.ordenSort==='2'){orden = 'com';}
        dato=empresa+','+periodo+','+comp+','+orden;
        location.href="reports/rptLibroDiario.php?dt="+dato;     
    };
            
    $scope.imprimeLibAux= function(){

        periodo=$scope.desdePeriodo;
        empresa=$scope.empresa; 
        ctaIni=$scope.desdeCuenta;
        ctaFin=$scope.hastaCuenta;  
      
        dato=empresa+','+periodo+','+ctaIni+','+ctaFin;
        location.href="reports/rptLibroAuxiliar.php?dt="+dato;     
    };
    
    $scope.imprimeMovTerc = function(){
        fchDesde =$scope.fchDesde;
        fchHasta = $scope.fchHasta;
        tercero = $scope.terceros;
        empresa=$scope.empresa; 
        dato = empresa+','+fchDesde+','+fchHasta+','+tercero;
        location.href="reports/repMoviTerceros.php?dt="+dato; 
    }; 
    
    $scope.imprimeCtaMvtos= function(){
        periIni=$scope.desdePeriodo;
        periFin=$scope.hastaPeriodo;
        empresa=$scope.empresa; 
        ctaIni=$scope.desdeCuenta;
        ctaFin=$scope.hastaCuenta;        
        dato=empresa+','+periIni+','+periFin+','+ctaIni+','+ctaFin;
        location.href="reports/rptCtaMvtos.php?dt="+dato;     
    };
    
    $scope.configPages = function() {
        $scope.pages.length = 0;
        var ini = $scope.currentPage - 4;
        var fin = $scope.currentPage + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.details.length / $scope.pageSize) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.details.length / $scope.pageSize);
        }
        else {
            if (ini >= Math.ceil($scope.details.length / $scope.pageSize) - 10) {
                ini = Math.ceil($scope.details.length / $scope.pageSize) - 10;
                fin = Math.ceil($scope.details.length / $scope.pageSize);
            }
        }
        if (ini < 1) ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pages.push({no: i});
        }

        if ($scope.currentPage >= $scope.pages.length)
            $scope.currentPage = $scope.pages.length - 1;
    };

    $scope.setPage = function(index) {
        $scope.currentPage = index - 1;
    };
    
    $scope.cierreMensual = function(){
       $scope.ruedita = false;
       dato = $scope.empresa +','+$scope.periodo + ',' + $scope.periodoNext;
       $http.post('modulos/mod_contaplancontable.php?op=cm',{'op':'cm','dato':dato}).success(function(data){
       $scope.noVerBoton=true;
       $scope.error = data;
       $scope.ruedita = true;
       });
    };
    
    $scope.cierreEjercicio = function(){
        $scope.ruedita=false;
        dato = $scope.empresa +','+$scope.compCierre + ',' + $scope.compAper + ',' + $scope.ctaCierre+','+$scope.periodo;
        $http.post('modulos/mod_contaplancontable.php?op=ce',{'op':'ce','dato':dato}).success(function(data){
        $scope.noVerBoton=true;
        alert(data);
        $scope.error = data;
        $scope.ruedita=true;
        });       
    };

$scope.preparaInfoNif = function(){
    alert ('Va apreparar info');
}


    $scope.vaAexcel = function(info){
        valor = confirm('Exporta la información a Excel, continua?');
        if (valor === true) {
            empresa = $('#e').val();
            dato= info.ultimoPeriodo+'||'+info.fechaDesde+'||'+info.fechaHasta+'||'+info.g1+
                    '||'+info.g2+'||'+info.g3+'||'+info.g4+'||'+info.g5+'||'+info.g6+'||'+info.g7+'||'+info.g8
   //         alert(dato);
            $http.post('modulos/mod_containformes.php?op=exl',{'op':'exl','empresa':empresa,'dato':dato}).success(function(data){
   //        alert(data);
            $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        }); 
       } 
    };
    
    
    function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
            (j ? i.substr(0, j) + thouSep : "") +
            i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
            (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }

    empresa = $scope.empresa;
    $scope.items = [];
    $scope.titulin= '';
    

}


]);
 
app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
  


