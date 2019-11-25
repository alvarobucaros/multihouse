var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Comprobantes Contables';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_compActivo50 = 'Inactivo';
    $scope.form_compActivo51 = 'Activo';

    $scope.form_compId = 'ID';
    $scope.form_compEmpresaId = 'EMPRESA';
    $scope.form_compCodigo = 'CODIGO';
    $scope.form_compNombre = 'NOMBRE';
    $scope.form_compConsecutivo = 'SECUENCIA';
    $scope.form_compActivo = 'ACTIVO';
    $scope.form_compDetalle = 'DETALLE';

    $scope.form_PhcompId = 'Digite id';
    $scope.form_PhcompEmpresaId = 'Digite empresa';
    $scope.form_PhcompCodigo = 'Digite codigo';
    $scope.form_PhcompNombre = 'Digite nombre';
    $scope.form_PhcompConsecutivo = 'Digite secuencia';
    $scope.form_PhcompActivo = 'Digite activo';
    $scope.form_PhcompDetalle = 'Digite detalle';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        compId:0,
        compEmpresaId:$scope.empresa,
        compCodigo:'',
        compNombre:'',
        compConsecutivo:0,
        compActivo:'A',
        compDetalle:''
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contacomprobantes.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
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
$scope.compId=0;
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
        $http.post('modulos/mod_contacomprobantes.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.compNombre+' ?')) {  
            $http.post('modulos/mod_contacomprobantes.php?op=b',{'op':'b', 'compId':info.compId}).success(function(data){
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
        if($('#compId').val()===''){er+='falta id\n';}
        if($('#compEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#compCodigo').val()===''){er+='falta codigo\n';}
        if($('#compNombre').val()===''){er+='falta nombre\n';}
        if($('#compConsecutivo').val()===''){er+='falta secuencia\n';}
        if($('#compActivo').val()===''){er+='falta activo\n';}
        if($('#compDetalle').val()===''){er+='falta detalle\n';}
        if (er==''){
        $http.post('modulos/mod_contacomprobantes.php?op=a',{'op':'a', 'compId':info.compId, 'compEmpresaId':info.compEmpresaId, 'compCodigo':info.compCodigo, 'compNombre':info.compNombre, 'compConsecutivo':info.compConsecutivo, 'compActivo':info.compActivo, 'compDetalle':info.compDetalle}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 10:33:12   <<<<<<< 
