var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_consultasGral = 'Consultas Generales';

    $scope.form_impromeCtasCobro = 'Imprime Cuentas de Cobro';
    $scope.form_imnprimeRecobo = 'Reimprime Recibo de caja';
    $scope.form_consultasCtaCobro = 'Consulta Cuenta de Cobro';
    $scope.form_consultaRecibo = 'Consulta Recibo de Caja';
    $scope.form_resumenDiario = 'Resume diario de Caja';
    $scope.form_estadoCuenta = 'Estado de cuenta ';
    $scope.form_carteraEnMora = 'Cuentas por Cobrar';
    $scope.form_btnExcel = 'Ver en Excel';
    $scope.form_btnAplicar = 'Ir al reporte';
    $scope.form_tipoReporte = 'Tipo de reporte';
    $scope.form_tipoReporteD = 'Detallado';
    $scope.form_tipoReporteR = 'Resumido';
    $scope.form_fechaCorte = 'Fecha de corte';
    $scope.empresa = $('#e').val();
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        $scope.fechaCorte = yyyy + '-'+mm+'-'+dd;
        $scope.tipoReporte='D';
    }
    
    $scope.carteraEnMora = function(){
        op=$scope.tipoReporte;
        empresa = $scope.empresa;
        fc=$scope.fechaCorte
        location.href="reports/rptCarteraMora.php?em="+empresa+"&op="+op+"&fc="+fc;
    };
    
    $scope.carteraEnExcel = function(){
        op=$scope.tipoReporte;
        empresa = $scope.empresa;
        fc=$scope.fechaCorte
        valor = confirm('Exporta relación de cartera en mora a Excel, continua?');
        if (valor == true) {
             empresa = $('#e').val();
             $http.post('modulos/mod_contaprocesos.php?op=expKrt',{'op':'expKrt','empresa':empresa,'corte':fc,'opcion':op}).success(function(data){
             $('#miExcel').html(data); 
             alert('exporta a Excel. Cargue y renombre el documento... ');
             window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
         }); 
       }         
    };
    
}



]);
 
app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
 