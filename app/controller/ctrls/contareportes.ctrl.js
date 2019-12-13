var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_consultasGral = 'Consultas Generales';

    $scope.form_impromeCtasCobro = 'Imprime Cuentas de Cobro';
    $scope.form_imnprimeRecobo = 'Reimprime Recibo de caja';
    $scope.form_consultasCtaCobro = 'Consulta Cuenta de Cobro';
    $scope.form_consultaRecibo = 'Consulta Recibo de Caja';
    $scope.form_resumenDiario = 'Resume diario de Caja';
    $scope.form_estadoCuenta = 'Estado de cuenta';
    $scope.form_carteraEnMora = 'Cartera en Mora';
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
        $scope.tipoReporte='R';
    }
    
    $scope.carteraEnMora = function(){
        op=$scope.tipoReporte;
        empresa = $scope.empresa;
        fc=$scope.fechaCorte
        location.href="reports/rptCarteraMora.php?em="+empresa+"&op="+op+"&fc="+fc;
    };
    
    $scope.carteraEnExcel = function(){
        op=$scope.tipoReporte;
        alert(op);
    };
}

]);
 
app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
 