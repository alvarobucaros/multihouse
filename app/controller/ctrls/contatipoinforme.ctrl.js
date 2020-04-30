var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de contatipoinforme';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_tipoEstado40 = 'Activo';
    $scope.form_tipoEstado41 = 'Inactivo';

    $scope.form_tipoId = 'ID';
    $scope.form_tipoEmpresa = 'EMPRESA';
    $scope.form_tipoCodigo = 'CODIGO';
    $scope.form_tipoDetalle = 'DETALLE';
    $scope.form_tipoEstado = 'ESTADO';

    $scope.form_PhtipoId = 'Digite id';
    $scope.form_PhtipoEmpresa = 'Digite empresa';
    $scope.form_PhtipoCodigo = 'Digite codigo';
    $scope.form_PhtipoDetalle = 'Digite detalle';
    $scope.form_PhtipoEstado = 'Digite estado';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
     
    var defaultForm= {   
        tipoId:0,
        tipoEmpresa:$scope.empresa,
        tipoCodigo:'',
        tipoDetalle:'',
        tipoEstado:'A'
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contatipoinforme.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
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
$scope.tipoId=0;
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
            $http.post('modulos/mod_contatipoinforme.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
           $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        }); 
       }  
    }
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.tipoDetalle+' ?')) {  
            $http.post('modulos/mod_contatipoinforme.php?op=b',{'op':'b', 'tipoId':info.tipoId}).success(function(data){
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
        if($('#tipoId').val()===''){er+='falta id\n';}
        if($('#tipoEmpresa').val()===''){er+='falta empresa\n';}
        if($('#tipoCodigo').val()===''){er+='falta codigo\n';}
        if($('#tipoDetalle').val()===''){er+='falta detalle\n';}
        if($('#tipoEstado').val()===''){er+='falta estado\n';}
        if (er==''){
        $http.post('modulos/mod_contatipoinforme.php?op=a',{'op':'a', 'tipoId':info.tipoId, 'tipoEmpresa':info.tipoEmpresa, 'tipoCodigo':info.tipoCodigo, 'tipoDetalle':info.tipoDetalle, 'tipoEstado':info.tipoEstado}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Mar 09, 2020 8:14:22   <<<<<<< 
