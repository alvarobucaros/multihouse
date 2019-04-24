var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Carga logo empresarial y Avatar usuario';
    $scope.form_asistente_titulo = 'Imagen a cargar'      
    $scope.form_miLogo = 'Logo empresa';
    $scope.form_miAvatar = 'Avatar usuario'; 
    $scope.nota=' Seleccione imagen png, jpg o jpeg';
    $scope.registro = {};
    $scope.empresa = $('#e').val();
    $scope.usuario = $('#u').val();
    $scope.dibujo = 'L';    
    $scope.datosOcultos = false;
    $scope.btnCarga = false;
    $scope.ruedita = false;
    
    getInfo();
    
    function getInfo(){
        usuario=$scope.usuario = $('#u').val();
        empresa=$scope.empresa = $('#e').val(); 
        $http.post('modulos/mod_mm_agendaanexos.php?op=lo',{'op':'lo','empresa':empresa}).success(function(data){
        data = 'reports/images/'+data;
        $scope.imgLogo = data;
        });
        $http.post('modulos/mod_mm_agendaanexos.php?op=av',{'op':'av','empresa':empresa, 'usuario':usuario}).success(function(data){
        data = 'photo/'+data;
        $scope.imgAvatar = data;
        });
    }
    
 $scope.botonOk = function(){
    img = $scope.registro.logoAvatar;
    $scope.dibujo = img;
    $('#dibujo').val(img);
    $scope.btnCarga = true;
 }
 
}]);
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos  Saturday, Jul 6, 2018 5:18:20   <<<<<<< 


