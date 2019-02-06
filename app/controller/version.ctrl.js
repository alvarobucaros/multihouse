var app = angular.module('app', []);
app.controller("mainController",['$scope','$http', function($scope,$http){
    $scope.form_title1 = 'Multi';
    $scope.form_title2 = 'Meeting';
    $scope.form_subTitle ='Sistema de control y seguimiento de reuniones';
    $scope.form_btnRegresa = 'Al Menú';

    $scope.empresa_nombre='';
    $scope.empresa_versionPrd='';
    $scope.empresa_versionBd = '';
    $scope.empresa_clave = '';    
    
    $scope.form_version     = 'Versión de la APP y Base de Datos';
    $scope.form_empresa_nombre     = 'Concedida a';
    $scope.form_empresa_clave      = 'Código';    
    $scope.form_empresa_versionPrd = 'Versión Aplicación';
    $scope.form_empresa_versionBd   = 'Versión Base de datos';
    $scope.form_btnActualiza= 'Al menu';
    
//    $scope.registro.empresa_nombre='';
   // $scope.registro.empresa_clave='';
    
    getInfo();
 

    function getInfo(){
        empresa = $('#comite_empresa').val();
        $http.post('modulos/modVersion.php?op=r',{'op':'r', 'empresa_id':empresa}).success(function(data, textStatus){
        $scope.empresa_nombre = data[0].empresa_nombre; 
	$scope.empresa_clave = data[0].empresa_clave;  
	$scope.empresa_versionPrd = data[0].empresa_versionPrd;  
	$scope.empresa_versionBd = data[0].empresa_versionBd; 
        });       
    }        
//       
//
//
//
//
//    $scope.empresa_nombre='';
//    $scope.empresa_versionPrd='';
//    $scope.empresa_versionBd = '';
//    $scope.empresa_clave = '';    
//


}]);



