var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Notas a estados financieros';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_notaid = 'ID';
    $scope.form_notaempresa = 'EMPRESA';
    $scope.form_notareporte = 'REPORTE';
    $scope.form_notacodigo = 'CODIGO';
    $scope.form_notadetalle = 'DETALLE';

    $scope.form_Phnotaid = 'Digite id';
    $scope.form_Phnotaempresa = 'Digite empresa';
    $scope.form_Phnotareporte = 'Digite reporte';
    $scope.form_Phnotacodigo = 'Digite codigo';
    $scope.form_Phnotadetalle = 'Digite detalle';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        notaid:0,
        notaempresa:0,
        notareporte:'',
        notacodigo:'',
        notadetalle:''
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contanotascont.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
          $http.post('modulos/mod_contanotascont.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
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
$scope.notaid=0;
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
        $http.post('modulos/mod_contanotascont.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.notareporte+' ?')) {  
            $http.post('modulos/mod_contanotascont.php?op=b',{'op':'b', 'notaid':info.notaid}).success(function(data){
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
        if($('#notaid').val()===''){er+='falta id\n';}
        if($('#notaempresa').val()===''){er+='falta empresa\n';}
        if($('#notareporte').val()===''){er+='falta reporte\n';}
        if($('#notacodigo').val()===''){er+='falta codigo\n';}
        if($('#notadetalle').val()===''){er+='falta detalle\n';}
        if (er==''){
        a=info.notaid+'||'+empresa+'||'+info.notareporte+'||'+info.notacodigo+'||'+info.notadetalle;
alert(a);
            $http.post('modulos/mod_contanotascont.php?op=a',{'op':'a', 'notaid':info.notaid, 'notaempresa':empresa, 'notareporte':info.notareporte, 'notacodigo':info.notacodigo, 'notadetalle':info.notadetalle}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 05, 2021 12:29:20   <<<<<<< 
