var app = angular.module('app', []);
app.controller("mainController",['$scope','$http', function($scope,$http){
    $scope.form_title1 = 'Multi';
    $scope.form_title2 = 'House';
    $scope.form_subTitle ='Sistema Administrativo de Conjuntos';
    $scope.form_btnRegresa = 'Al Menú';

    $scope.empresa_nombre='';
    $scope.empresa_nit='';
    $scope.empresa_versionPrd='';
    $scope.empresa_versionBd = '';
    $scope.empresa_clave = ''; 
    $scope.empresa_servidor = '';
    $scope.empresa_BaseDatos = '';
    $scope.empresa_version ='';
    
    $scope.form_version     = 'Noticias...';
    $scope.form_empresa_nombre     = 'Concedida a';
    $scope.form_empresa_clave      = 'Código';    
    $scope.form_empresa_versionPrd = 'Versión Aplicación';
    $scope.form_empresa_versionBd   = 'Versión Base de datos';
    $scope.form_empresa_servidor = 'Servidor';
    $scope.form_empresa_baseDatos = 'Nombre Base de Datos';
    $scope.form_empresa_version = 'Versión';
    $scope.form_btnActualiza= 'Al menu';
    $scope.vista=false;
    getInfo();
 

    function getInfo(){
        empresa = $('#e').val();
        $http.post('modulos/mod_contaversion.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        dato=data.split('||'); 
    $scope.empresa_nombre=dato[3];
    $scope.empresa_versionPrd=dato[0]; 
    $scope.empresa_versionBd = dato[1]; 
    $scope.empresa_clave = dato[2]; 
    $scope.empresa_nit=dato[4]; 
    $scope.empresa_servidor = dato[5]; 
    $scope.empresa_baseDatos = dato[6]; 
    $scope.empresa_version =dato[9];       
        });       
    }        
}]);



