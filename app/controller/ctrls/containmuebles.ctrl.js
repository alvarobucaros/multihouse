var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de Inmuebles';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnCalculo = 'Cálculos';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_inmueblePrincipal40 = 'NO';
    $scope.form_inmueblePrincipal41 = 'SI';

    $scope.form_inmuebleId = 'ID';
    $scope.form_inmuebleEmpresaId = 'EMPRESA';
    $scope.form_inmuebleCodigo = 'CODIGO';
    $scope.form_inmuebleDescripcion = 'DESCRIPCION';
    $scope.form_inmueblePrincipal = 'PRINCIPAL';
    $scope.form_inmuebleArea = 'AREA';
    $scope.form_inmuebleCoeficiente = 'COEFICIENTE';
    $scope.form_inmuebleUbicacion = 'UBICACION';
    $scope.form_inmuebleClasificacionId = 'CLASIFICACION';
    $scope.form_inmuebleDepende = 'DEPENDE';

    $scope.form_PhinmuebleId = 'Digite id';
    $scope.form_PhinmuebleEmpresaId = 'Digite empresa';
    $scope.form_PhinmuebleCodigo = 'Digite codigo';
    $scope.form_PhinmuebleDescripcion = 'Digite descripcion';
    $scope.form_PhinmueblePrincipal = 'Digite principal';
    $scope.form_PhinmuebleArea = 'Digite area';
    $scope.form_PhinmuebleCoeficiente = 'Digite coeficiente';
    $scope.form_PhinmuebleUbicacion = 'Digite ubicacion';
    $scope.form_PhinmuebleClasificacionId = 'Digite clasificacion';
    $scope.form_PhinmuebleDepende = 'Digite depende';
    $scope.v1=false;
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        inmuebleId:0,
        inmuebleEmpresaId: $scope.empresa ,
        inmuebleCodigo:'',
        inmuebleDescripcion:'',
        inmueblePrincipal:'',
        inmuebleArea:'',
        inmuebleCoeficiente:'',
        inmuebleUbicacion:'',
        inmuebleClasificacionId:0,
        inmuebleDepende:''
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_containmuebles.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
          $http.post('modulos/mod_containmuebles.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
         $scope.operators0 = data;
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

 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.inmuebleId=0;
$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);

};

$scope.calculos = function(){
    valor = confirm('Recalcula el valor de los coeficientes, continua?');
    if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_containmuebles.php?op=cal',{'op':'cal','empresa':empresa}).success(function(data){
        if (data === 'Ok') {
            getInfo(empresa);
            alert ('Recalculos Ok. ');
        }
    }); 
   }
};

    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();

    };

$scope.exporta = function(){
    valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
   if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_containmuebles.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
        $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.inmuebleCodigo+' ?')) {  
            $http.post('modulos/mod_containmuebles.php?op=b',{'op':'b', 'inmuebleId':info.inmuebleId}).success(function(data){
            if (data === 'Ok') {
            getInfo(empresa);
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        empresa = $('\#e').val(); 
        if($('#inmuebleId').val()===''){er+='falta id\n';}
        if($('#inmuebleEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#inmuebleCodigo').val()===''){er+='falta codigo\n';}
        if($('#inmuebleDescripcion').val()===''){er+='falta descripcion\n';}
        if($('#inmueblePrincipal').val()===''){er+='falta principal\n';}
        if($('#inmuebleArea').val()===''){er+='falta area\n';}
        if($('#inmuebleCoeficiente').val()===''){er+='falta coeficiente\n';}
        if($('#inmuebleUbicacion').val()===''){er+='falta ubicacion\n';}
        if($('#inmuebleClasificacionId').val()===''){er+='falta clasificacion\n';}
       // if($('#inmuebleDepende').val()===''){er+='falta depende\n';}
        if (er==''){
        $http.post('modulos/mod_containmuebles.php?op=a',{'op':'a', 'inmuebleId':info.inmuebleId, 'inmuebleEmpresaId':info.inmuebleEmpresaId, 'inmuebleCodigo':info.inmuebleCodigo, 'inmuebleDescripcion':info.inmuebleDescripcion, 'inmueblePrincipal':info.inmueblePrincipal, 'inmuebleArea':info.inmuebleArea, 'inmuebleCoeficiente':info.inmuebleCoeficiente, 'inmuebleUbicacion':info.inmuebleUbicacion, 'inmuebleClasificacionId':info.inmuebleClasificacionId, 'inmuebleDepende':info.inmuebleDepende}).success(function(data){
        if (data === 'Ok') {
            getInfo(empresa);
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm').slideToggle();
    };

}]);
	 

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 17, 2019 9:40:35   <<<<<<< 
