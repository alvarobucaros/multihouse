var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de Propietarios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_propietarioActivo70 = 'Inactivo';
    $scope.form_propietarioActivo71 = 'Activo';

    $scope.form_propietarioId = 'ID';
    $scope.form_propietarioEmpresaId = 'EMPRESA';
    $scope.form_propietarioNombre = 'NOMBRE';
    $scope.form_propietarioCedula = 'CEDULA';
    $scope.form_propietarioTelefonos = 'TELEFONOS';
    $scope.form_propietarioDireccion = 'DIRECCION';
    $scope.form_propietarioCorreo = 'E-MAIL';
    $scope.form_propietarioActivo = 'ACTIVO';

    $scope.form_PhpropietarioId = 'Digite id';
    $scope.form_PhpropietarioEmpresaId = 'Digite empresa';
    $scope.form_PhpropietarioNombre = 'Digite nombre';
    $scope.form_PhpropietarioCedula = 'Digite cedula';
    $scope.form_PhpropietarioTelefonos = 'Digite telefonos';
    $scope.form_PhpropietarioDireccion = 'Digite direccion';
    $scope.form_PhpropietarioCorreo = 'Digite e-mail';
    $scope.form_PhpropietarioActivo = 'Digite activo';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        propietarioId:0,
        propietarioEmpresaId: $scope.empresa,
        propietarioNombre:'',
        propietarioCedula:'',
        propietarioTelefonos:'',
        propietarioDireccion:'',
        propietarioCorreo:'',
        propietarioActivo:'A'
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contapropietarios.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
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
$scope.propietarioId=0;
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
        $http.post('modulos/mod_contapropietarios.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.propietarioNombre+' ?')) {  
            $http.post('modulos/mod_contapropietarios.php?op=b',{'op':'b', 'propietarioId':info.propietarioId}).success(function(data){
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
        if($('#propietarioId').val()===''){er+='falta id\n';}
        if($('#propietarioEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#propietarioNombre').val()===''){er+='falta nombre\n';}
        if($('#propietarioCedula').val()===''){er+='falta cedula\n';}
        if($('#propietarioTelefonos').val()===''){er+='falta telefonos\n';}
        if($('#propietarioDireccion').val()===''){er+='falta direccion\n';}
        if($('#propietarioCorreo').val()===''){er+='falta e-mail\n';}
        if($('#propietarioActivo').val()===''){er+='falta activo\n';}
        if (er==''){
        $http.post('modulos/mod_contapropietarios.php?op=a',{'op':'a', 'propietarioId':info.propietarioId, 
            'propietarioEmpresaId':info.propietarioEmpresaId, 'propietarioNombre':info.propietarioNombre,
            'propietarioCedula':info.propietarioCedula, 'propietarioTelefonos':info.propietarioTelefonos, 
            'propietarioDireccion':info.propietarioDireccion, 'propietarioCorreo':info.propietarioCorreo, 
            'propietarioActivo':info.propietarioActivo}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 03, 2019 8:17:09   <<<<<<< 
