var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de temas generales por comité';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo50 = 'Activo';
    $scope.form_Activo51 = 'Inactivo';

    $scope.form_temasGrales_id = 'ID';
    $scope.form_temasGrales_empresa = 'EMPRESA';
    $scope.form_temasGrales_comiteId = 'COMITE';
    $scope.form_temasGrales_titulo = 'TITULO';
    $scope.form_temasGrales_detalle = 'DETALLE';
    $scope.form_temasGrales_estado = 'ESTADO';

    $scope.form_PhtemasGrales_id = 'Digite temasgrales_id';
    $scope.form_PhtemasGrales_empresa = 'Digite temasgrales_empresa';
    $scope.form_PhtemasGrales_comiteId = 'Digite temasgrales_comiteid';
    $scope.form_PhtemasGrales_titulo = 'Digite temasgrales_titulo';
    $scope.form_PhtemasGrales_detalle = 'Digite temasgrales_detalle';
    $scope.form_PhtemasGrales_estado = 'Digite temasgrales_estado';
   
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
            
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_mm_temasgrales.php?op=r',{'op':'r','empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();
        });       
    }

    function getCombos(empresa){
          $http.post('modulos/mod_mm_temasgrales.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
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
     
 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();

$('#idForm').css('display', 'none');

};


$scope.formToggle =function(){
    e = $('#e').val();
    $('#idForm').slideToggle();
    $scope.formato.$setPristine();
    $scope.registro = {};
    $scope.registro.temasGrales_estado = 'A';
    $scope.registro.temasGrales_id = 0;
    $scope.registro.temasGrales_empresa = e;

};

    $scope.registro =function(info){ 
 
            $http.post('modulos/mod_mm_temasgrales.php?op=a',{'op':'a', 'temasGrales_id':temasGrales_id, 
                'temasGrales_empresa':temasGrales_empresa, 'temasGrales_comiteId':temasGrales_comiteId, 
                'temasGrales_titulo':temasGrales_titulo, 'temasGrales_detalle':temasGrales_detalle, 'temasGrales_estado':temasGrales_estado}).success(function(data){
            $scope.show_form = true;
            alert(data);
            if (data === true) {
            getInfo($scope.empresa);
            }
            });
     };

    $scope.registro = {};
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();
       // if(registro.grupo_activo=='A'){registro.grupoactivo=true;}
       // else{registro.grupoinactivo=true;}

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.temasGrales_titulo+' ?')) {  
            $http.post('modulos/mod_mm_temasgrales.php?op=b',{'op':'b', 'temasGrales_id':info.temasGrales_id}).success(function(data){
            if (data === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        if($('#temasGrales_id').val()===''){er+='falta temasgrales_id\n';}
        if($('#temasGrales_empresa').val()===''){er+='falta temasgrales_empresa\n';}
        if($('#temasGrales_comiteId').val()===''){er+='falta temasgrales_comiteid\n';}
        if($('#temasGrales_titulo').val()===''){er+='falta temasgrales_titulo\n';}
        if($('#temasGrales_detalle').val()===''){er+='falta temasgrales_detalle\n';}
        if($('#temasGrales_estado').val()===''){er+='falta temasgrales_estado\n';}
        if (er==''){
        $http.post('modulos/mod_mm_temasgrales.php?op=a',{'op':'a', 'temasGrales_id':info.temasGrales_id, 'temasGrales_empresa':info.temasGrales_empresa, 'temasGrales_comiteId':info.temasGrales_comiteId, 'temasGrales_titulo':info.temasGrales_titulo, 'temasGrales_detalle':info.temasGrales_detalle, 'temasGrales_estado':info.temasGrales_estado}).success(function(data){
        if (data === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Actualizado ');
            $scope.registro = {};
            $('#idForm').slideToggle();
            
        }else{
            alert(data);
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
        }
    });         
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 10:19:17   <<<<<<< 
