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
    $scope.vista=true;
    $scope.noticias=false;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.Bd = '1213';
    getInfo();
    getNews();
 

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
        
    function getNews(){
        empresa = $('#e').val();      
        $http.post('modulos/mod_contaversion.php?op=n',{'op':'n', 'empresa':empresa}).success(function(data){
        if (data.length>0)  {
            $scope.details = data;
            $scope.configPages(); 
            $scope.noticias=true;
        }
        });
    }

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
}]);



