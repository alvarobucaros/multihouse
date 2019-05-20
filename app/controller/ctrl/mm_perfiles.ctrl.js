var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de mm_perfiles';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo50 = 0;
    $scope.form_Activo51 = 1;

    $scope.form_perfil_id = 'ID';
    $scope.form_perfil_empresa = 'EMPRESA';
    $scope.form_perfil_numero = 'NUMERO';
    $scope.form_perfil_codigo = 'CODIGO';
    $scope.form_perfil_nombre = 'NOMBRE';
    $scope.form_perfil_activo = 'ACTIVO';

    $scope.form_Phperfil_id = 'Digite id';
    $scope.form_Phperfil_empresa = 'Digite empresa';
    $scope.form_Phperfil_numero = 'Digite numero';
    $scope.form_Phperfil_codigo = 'Digite codigo';
    $scope.form_Phperfil_nombre = 'Digite nombre';
    $scope.form_Phperfil_activo = 'Digite activo';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
    
    var defaultForm= {
        perfil_id:0,
        perfil_empresa:0,
        perfil_numero:0,
        perfil_codigo:'',
        perfil_nombre:'',
        perfil_activo:''
   };
    
    
    getInfo();
    
    function getInfo(){
        $http.post('modulos/mod_mm_perfiles.php?op=r',{'op':'r'}).success(function(data){
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

 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
//$scope.registro = '';
$scope.perfil_id=0;
// $scope.grupo_activo='A';
// $scope.grupoactivo = true;
$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);

};

$scope.registro = function(info){ alert ('inserta');};


    $scope.registro =function(info){ 
            alert ('actualiza');   
            $http.post('modulos/mod_mm_perfiles.php?op=a',{'op':'a', 'perfil_id':perfil_id, 'perfil_empresa':perfil_empresa, 'perfil_numero':perfil_numero, 'perfil_codigo':perfil_codigo, 'perfil_nombre':perfil_nombre, 'perfil_activo':perfil_activo}).success(function(data){

            $scope.show_form = true;
            alert(data);
            if (data === true) {
            getInfo();
            }
            });
     };

    $scope.registro = [];
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();
       // if(registro.grupo_activo=='A'){registro.grupoactivo=true;}
       // else{registro.grupoinactivo=true;}

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.perfil_codigo+' ?')) {  
            $http.post('modulos/mod_mm_perfiles.php?op=b',{'op':'b', 'perfil_id':info.perfil_id}).success(function(data){
            if (data === 'Ok') {
            getInfo();
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        if($('#perfil_id').val()===''){er+='falta id\n';}
        if($('#perfil_empresa').val()===''){er+='falta empresa\n';}
        if($('#perfil_numero').val()===''){er+='falta numero\n';}
        if($('#perfil_codigo').val()===''){er+='falta codigo\n';}
        if($('#perfil_nombre').val()===''){er+='falta nombre\n';}
        if($('#perfil_activo').val()===''){er+='falta activo\n';}
        if (er==''){
        $http.post('modulos/mod_mm_perfiles.php?op=a',{'op':'a', 'perfil_id':info.perfil_id, 'perfil_empresa':info.perfil_empresa, 'perfil_numero':info.perfil_numero, 'perfil_codigo':info.perfil_codigo, 'perfil_nombre':info.perfil_nombre, 'perfil_activo':info.perfil_activo}).success(function(data){
        if (data === 'Ok') {
            getInfo();
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
         }
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,May 17, 2018 12:00:26   <<<<<<< 
