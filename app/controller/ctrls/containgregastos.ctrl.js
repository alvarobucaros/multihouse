var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de containgregastos';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_ingastotipo40 = 0;
    $scope.form_ingastotipo41 = 1;
    $scope.form_ingastocontabiliza80 = 0;
    $scope.form_ingastocontabiliza81 = 1;

    $scope.form_ingastoid = 'ID';
    $scope.form_ingastoempresa = 'EMPRESA';
    $scope.form_ingastoFecha = 'FECHA';
    $scope.form_ingastoperiodo = 'PERIODO';
    $scope.form_ingastotipo = 'TIPO';
    $scope.form_ingastocomprobante = 'COMPROBANTE';
    $scope.form_ingastodetalle = 'DETALLE';
    $scope.form_ingastovalor = 'VALOR';
    $scope.form_ingastocontabiliza = 'CONTABILIZA';

    $scope.form_Phingastoid = 'Digite id';
    $scope.form_Phingastoempresa = 'Digite empresa';
    $scope.form_PhingastoFecha = 'Digite fecha';
    $scope.form_Phingastoperiodo = 'Digite periodo';
    $scope.form_Phingastotipo = 'Digite tipo';
    $scope.form_Phingastocomprobante = 'Digite comprobante';
    $scope.form_Phingastodetalle = 'Digite detalle';
    $scope.form_Phingastovalor = 'Digite valor';
    $scope.form_Phingastocontabiliza = 'Digite contabiliza';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        ingastoid:0,
        ingastoempresa:0,
        ingastoFecha:'',
        ingastoperiodo:'',
        ingastotipo:0,
        ingastocomprobante:0,
        ingastodetalle:'',
        ingastovalor:'',
        ingastocontabiliza:''
   };
    
    getCombos();
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_containgregastos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
          $http.post('modulos/mod_containgregastos.php?op=0',{'op':'0'}).success(function(data){
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
$scope.ingastoid=0;
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
        $http.post('modulos/mod_containgregastos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.ingastoFecha+' ?')) {  
            $http.post('modulos/mod_containgregastos.php?op=b',{'op':'b', 'ingastoid':info.ingastoid}).success(function(data){
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
        if($('#ingastoid').val()===''){er+='falta id\n';}
        if($('#ingastoempresa').val()===''){er+='falta empresa\n';}
        if($('#ingastoFecha').val()===''){er+='falta fecha\n';}
        if($('#ingastoperiodo').val()===''){er+='falta periodo\n';}
        if($('#ingastotipo').val()===''){er+='falta tipo\n';}
        if($('#ingastocomprobante').val()===''){er+='falta comprobante\n';}
        if($('#ingastodetalle').val()===''){er+='falta detalle\n';}
        if($('#ingastovalor').val()===''){er+='falta valor\n';}
        if($('#ingastocontabiliza').val()===''){er+='falta contabiliza\n';}
        if (er==''){
        $http.post('modulos/mod_containgregastos.php?op=a',{'op':'a', 'ingastoid':info.ingastoid, 'ingastoempresa':info.ingastoempresa, 'ingastoFecha':info.ingastoFecha, 'ingastoperiodo':info.ingastoperiodo, 'ingastotipo':info.ingastotipo, 'ingastocomprobante':info.ingastocomprobante, 'ingastodetalle':info.ingastodetalle, 'ingastovalor':info.ingastovalor, 'ingastocontabiliza':info.ingastocontabiliza}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Nov 27, 2019 1:57:50   <<<<<<< 
