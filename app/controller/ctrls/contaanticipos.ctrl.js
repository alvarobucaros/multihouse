var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de contaanticipos';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_anticipoid = 'ID';
    $scope.form_anticipoempresa = 'EMPRESA';
    $scope.form_anticipoinmueble = 'INMUEBLE';
    $scope.form_anticipofecha = 'FECHA';
    $scope.form_anticipovalor = 'VALOR';
    $scope.form_anticiposaldo = 'SALDO';

    $scope.form_Phanticipoid = 'Digite id';
    $scope.form_Phanticipoempresa = 'Digite empresa';
    $scope.form_Phanticipoinmueble = 'Digite inmueble';
    $scope.form_Phanticipofecha = 'Digite fecha';
    $scope.form_Phanticipovalor = 'Digite valor';
    $scope.form_Phanticiposaldo = 'Digite saldo';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {   
        anticipoid:0,
        anticipoempresa:$scope.empresa,
        anticipoinmueble:0,
        anticipofecha:'',
        anticipovalor:'',
        anticiposaldo:''
   };
    
    getCombos();
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contaanticipos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
          $http.post('modulos/mod_contaanticipos.php?op=0',{'op':'0'}).success(function(data){
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
$scope.anticipoid=0;
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
        $http.post('modulos/mod_contaanticipos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.anticipoinmueble+' ?')) {  
            $http.post('modulos/mod_contaanticipos.php?op=b',{'op':'b', 'anticipoid':info.anticipoid}).success(function(data){
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
        if($('#anticipoid').val()===''){er+='falta id\n';}
        if($('#anticipoempresa').val()===''){er+='falta empresa\n';}
        if($('#anticipoinmueble').val()===''){er+='falta inmueble\n';}
        if($('#anticipofecha').val()===''){er+='falta fecha\n';}
        if($('#anticipovalor').val()===''){er+='falta valor\n';}
        if($('#anticiposaldo').val()===''){er+='falta saldo\n';}
        if (er==''){
        $http.post('modulos/mod_contaanticipos.php?op=a',{'op':'a', 'anticipoid':info.anticipoid, 'anticipoempresa':info.anticipoempresa, 'anticipoinmueble':info.anticipoinmueble, 'anticipofecha':info.anticipofecha, 'anticipovalor':info.anticipovalor, 'anticiposaldo':info.anticiposaldo}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Oct 19, 2019 11:56:12   <<<<<<< 
