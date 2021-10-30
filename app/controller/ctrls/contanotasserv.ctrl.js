var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Notas Cr / DB Servicios';
    $scope.form_notaCR = 'Nota Crédito';
    $scope.form_notaDB = 'Nota Débito';
    
    }]);
	 

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,sep 07, 2021 7:09:26   <<<<<<< 


