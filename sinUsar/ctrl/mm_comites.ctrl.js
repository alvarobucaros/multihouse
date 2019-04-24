var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope, $http){
    $scope.form_title = 'Lista de comités';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo40 = 'SI';
    $scope.form_Activo41 = 'NO';
    $scope.btnPaga = 'Hacer donación'
    $scope.btnNoPaga = 'Después'
    $scope.form_comite_id = 'ID';
    $scope.form_comite_empresa = 'EMPRESA';
    $scope.form_comite_nombre = 'NOMBRE';
    $scope.form_comite_descripcion = 'DESCRIPCION';
    $scope.form_comite_activo = 'ACTIVO';
    $scope.form_comite_lider = 'LIDER';
    $scope.form_comite_email = 'EMAIL';
    $scope.form_comite_consecActa = 'CONSECUTIVO ACTA';

    $scope.form_Phcomite_id = 'Digite id';
    $scope.form_Phcomite_empresa = 'Digite empresa';
    $scope.form_Phcomite_nombre = 'Digite nombre';
    $scope.form_Phcomite_descripcion = 'Digite descripcion';
    $scope.form_Phcomite_activo = 'Digite activo';
    $scope.form_Phcomite_lider = 'Digite lider';
    $scope.form_Phcomite_email = 'Digite email';
    $scope.form_Phcomite_consecActa = 'Digite consecacta';
   
    $scope.registro = [];
    
    $scope.empresa = $('#e').val();
    $scope.AsistenteForm = false;
    $scope.msg = false;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $scope.registro.comite_empresa = empresa;
        $http.post('modulos/mod_mm_comites.php?op=r',{'op':'r','empresa': empresa}).success(function(data){
        vira(Object.keys(data).length);
        $scope.details = data;
        $scope.configPages();
        });       
    }
    getCombos($scope.empresa);
    
    function getCombos(empresa)
    {
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
    
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = {};
        $scope.registro.comite_activo='A';
        $scope.registro.comite_consecActa=0;
        $scope.registro.comite_empresa = $scope.empresa;
        $scope.registro.comite_id=0;
    //    $scope.registro.empresa_id = $scope.empresa;

};

    $scope.registro = {};
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();
    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.comite_nombre+' ?')) {  
            $http.post('modulos/mod_mm_comites.php?op=b',{'op':'b', 'comite_id':info.comite_id}).success(function(data){
            if (data === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Borrado ');
            }else{
                alert('Comite '+info.comite_nombre+' '+data);
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        if($('#comite_id').val()===''){er+='falta id\n';}
        if($('#comite_empresa').val()===''){er+='falta empresa\n';}
        if($('#comite_nombre').val()===''){er+='falta nombre\n';}
        if($('#comite_descripcion').val()===''){er+='falta descripcion\n';}
        if($('#comite_activo').val()===''){er+='falta activo\n';}
        if($('#comite_lider').val()===''){er+='falta lider\n';}
        if($('#comite_email').val()===''){er+='falta email\n';}
        if($('#comite_consecActa').val()===''){er+='falta consecutivo\n';}
        if (er==''){
        $http.post('modulos/mod_mm_comites.php?op=a',{'op':'a', 'comite_id':info.comite_id, 'comite_empresa':info.comite_empresa, 
            'comite_nombre':info.comite_nombre, 'comite_descripcion':info.comite_descripcion, 'comite_activo':info.comite_activo,
            'comite_lider':info.comite_lider, 'comite_email':info.comite_email, 'comite_consecActa':info.comite_consecActa}).success(function(data){           
            if (data === 'Ok') {
                getInfo($scope.empresa); 
                alert ('Registro Actualizado ');
                $('#idForm').slideToggle();
            }
            else if(data === 'Lic'){
                $scope.msg = true; 
            }
            else {alert (data);}
        });
    }  
    else{
        alert (er);
    }
    };
    
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm').slideToggle();
    };
    
    $scope.paga =function()
    {  
        alert('payu');
        $scope.msg = false;
        alert('Nuevamente clic en Actualizar para guardar este comité ');
    };
    
    $scope.noPaga =function()
    {  
        $scope.msg = false;
    };
}]);

function vira(n){
    if($('#ctrl').val()===0 && n>=3){$('.ocul').hide();}
}
  app.filter('startFromGrid', function() {
        return function(input, start) {
            start =+ start;
            return input.slice(start);
        };
    });
    
     
 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 09, 2017 5:35:33   <<<<<<< 
 