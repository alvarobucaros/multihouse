var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Inmueble y su Propietario';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_contaInmuPropietarioId = 'ID';
    $scope.form_contaInmuPropietarioEmpresaId = 'EMPRESA';
    $scope.form_contaInmuPropietarioInmuebleId = 'INMUEBLE';
    $scope.form_contaInmuPropietarioPropietarioId = 'PROPIETARIO';

    $scope.form_PhcontaInmuPropietarioId = 'Digite id';
    $scope.form_PhcontaInmuPropietarioEmpresaId = 'Digite empresa';
    $scope.form_PhcontaInmuPropietarioInmuebleId = 'Digite inmueble';
    $scope.form_PhcontaInmuPropietarioPropietarioId = 'Digite propietario';
   
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    $scope.empresa = $('#e').val();
   
    
    var defaultForm= {   
        contaInmuPropietarioId:0,
        contaInmuPropietarioEmpresaId:$scope.empresa,
        contaInmuPropietarioInmuebleId:0,
        contaInmuPropietarioPropietarioId:0
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_containmueblepropietario.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
        $http.post('modulos/mod_containmueblepropietario.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
            $scope.operators0 = data;
        });
        $http.post('modulos/mod_containmueblepropietario.php?op=1',{'op':'1', 'empresa':empresa}).success(function(data){
            $scope.operators1 = data;
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
$scope.contaInmuPropietarioId=0;
$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);

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
        $http.post('modulos/mod_containmueblepropietario.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.contaInmuPropietarioInmuebleId+' ?')) {  
            $http.post('modulos/mod_containmueblepropietario.php?op=b',{'op':'b', 'contaInmuPropietarioId':info.contaInmuPropietarioId}).success(function(data){
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
        if($('#contaInmuPropietarioId').val()===''){er+='falta id\n';}
        if($('#contaInmuPropietarioEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#contaInmuPropietarioInmuebleId').val()===''){er+='falta inmueble\n';}
        if($('#contaInmuPropietarioPropietarioId').val()===''){er+='falta propietario\n';}
        if (er==''){
        $http.post('modulos/mod_containmueblepropietario.php?op=a',{'op':'a', 'contaInmuPropietarioId':info.contaInmuPropietarioId, 'contaInmuPropietarioEmpresaId':info.contaInmuPropietarioEmpresaId, 'contaInmuPropietarioInmuebleId':info.contaInmuPropietarioInmuebleId, 'contaInmuPropietarioPropietarioId':info.contaInmuPropietarioPropietarioId}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 4:11:22   <<<<<<< 
