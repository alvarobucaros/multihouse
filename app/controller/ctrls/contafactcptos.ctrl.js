var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Conceptos de otros servicios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_cptosEstado60 = 'Inactivo';
    $scope.form_cptosEstado61 = 'Activo';

    $scope.form_cptosid = 'ID';
    $scope.form_cptosEmpresa = 'EMPRESA';
    $scope.form_cptosCodigo = 'CODIGO';
    $scope.form_cptosDetalle = 'DETALLE';
    $scope.form_cptosValor = 'VALOR';
    $scope.form_cptosIva = 'IVA';
    $scope.form_cptosEstado = 'ESTADO';

    $scope.form_Phcptosid = 'Digite id';
    $scope.form_PhcptosEmpresa = 'Digite empresa';
    $scope.form_PhcptosCodigo = 'Digite codigo';
    $scope.form_PhcptosDetalle = 'Digite detalle';
    $scope.form_PhcptosValor = 'Digite valor';
    $scope.form_PhcptosIva = 'Digite iva';
    $scope.form_PhcptosEstado = 'Digite estado';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        cptosid:0,
        cptosEmpresa:$scope.empresa,
        cptosCodigo:'',
        cptosDetalle:'',
        cptosValor:'',
        cptosIva:'',
        cptosEstado:'A'
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contafactcptos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
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
$scope.cptosid=0;
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
        $http.post('modulos/mod_contafactcptos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.cptosCodigo+' ?')) {  
            $http.post('modulos/mod_contafactcptos.php?op=b',{'op':'b', 'cptosid':info.cptosid}).success(function(data){
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
        if($('#cptosid').val()===''){er+='falta id\n';}
        if($('#cptosEmpresa').val()===''){er+='falta empresa\n';}
        if($('#cptosCodigo').val()===''){er+='falta codigo\n';}
        if($('#cptosDetalle').val()===''){er+='falta detalle\n';}
        if($('#cptosValor').val()===''){er+='falta valor\n';}
        if($('#cptosIva').val()===''){er+='falta iva\n';}
        if($('#cptosEstado').val()===''){er+='falta estado\n';}
        if (er==''){
        $http.post('modulos/mod_contafactcptos.php?op=a',{'op':'a', 'cptosid':info.cptosid, 'cptosEmpresa':info.cptosEmpresa, 'cptosCodigo':info.cptosCodigo, 'cptosDetalle':info.cptosDetalle, 'cptosValor':info.cptosValor, 'cptosIva':info.cptosIva, 'cptosEstado':info.cptosEstado}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 9:05:47   <<<<<<< 
