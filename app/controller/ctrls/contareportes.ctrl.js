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
}

]);
 
app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
 