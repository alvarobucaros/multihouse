var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_titleGen = 'Parámetros Generales';


}]);
	 

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
         
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 7:25:07   <<<<<<< 
