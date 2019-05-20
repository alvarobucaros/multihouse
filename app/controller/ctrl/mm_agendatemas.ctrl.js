var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de temas recurrentes';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo90 = 'INACTIVO';
    $scope.form_Activo91 = 'ACTIVO';

    $scope.form_tema_id = 'ID';
    $scope.form_tema_agendaId = 'AGENDAID';
    $scope.form_tema_empresa = 'EMPRESA';
    $scope.form_tema_comite = 'COMITE';
    $scope.form_tema_titulo = 'TITULO';
    $scope.form_tema_detalle = 'DETALLE';
    $scope.form_tema_tipo = 'TIPO';
    $scope.form_tema_responsable = 'RESPONSABLE';
    $scope.form_tema_fechaAsigna = 'FECHA ASIGNA';
    $scope.form_tema_estado = 'ESTADO';

    $scope.form_Phtema_id = 'Digite id';
    $scope.form_Phtema_agendaId = 'Digite agendaid';
    $scope.form_Phtema_empresa = 'Digite empresa';
    $scope.form_Phtema_comite = 'Digite comite';
    $scope.form_Phtema_titulo = 'Digite titulo';
    $scope.form_Phtema_detalle = 'Digite detalle';
    $scope.form_Phtema_tipo = 'Digite tipo';
    $scope.form_Phtema_responsable = 'Digite responsable';
    $scope.form_Phtema_fechaAsigna = 'Digite fechaasigna';
    $scope.form_Phtema_estado = 'Digite estado';
   
    $scope.tema_empresa=1;
    $scope.tema_tipo='GRAL';
    $scope.tema_id=0;
    $scope.tema_agendaId=0;
    $scope.tema_estado = '1';
    var hoy = new Date();
    var mes = hoy.getMonth() + 1;
    fechaHoy = hoy.getFullYear()+'-'+mes+'-'+ hoy.getDate();

    $scope.tema_fechaAsigna = fechaHoy;
    $scope.registro = {};    
    getCombos();
    
    $scope.empresa = $('#e').val();
    getInfo($scope.empresa);
    
    alert ($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_mm_agendatemas.php?op=r',{'op':'r','empresa':$scope.empresa}).success(function(data){
            alert(data);
        $scope.details = data;
        });       
    }

    function getCombos(){
          $http.post('modulos/mod_mm_agendatemas.php?op=0',{'op':'0'}).success(function(data){
         $scope.operators0 = data;
         });
} 
 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
//$scope.registro = '';
$scope.tema_id=0;
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

    $scope.registro = function(info){ 
        alert ('inserta');
    };


    $scope.registro =function(info){ 
            alert ('actualiza');   
            $http.post('modulos/mod_mm_agendatemas.php?op=a',{'op':'a', 'tema_id':tema_id, 'tema_agendaId':tema_agendaId, 'tema_empresa':tema_empresa, 'tema_comite':tema_comite, 'tema_titulo':tema_titulo, 'tema_detalle':tema_detalle, 'tema_tipo':tema_tipo, 'tema_responsable':tema_responsable, 'tema_fechaAsigna':tema_fechaAsigna, 'tema_estado':tema_estado}).success(function(data){

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
        if(registro.tema_estado=='A'){registro.tema_estado=true;}
        else{registro.tema_estado=true;}
    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.tema_comite+' ?')) {  
            $http.post('modulos/mod_mm_agendatemas.php?op=b',{'op':'b', 'tema_id':info.tema_id}).success(function(data){
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
        if($('#tema_id').val()===''){er+='falta id\n';}
        if($('#tema_agendaId').val()===''){er+='falta agendaid\n';}
        if($('#tema_empresa').val()===''){er+='falta empresa\n';}
        if($('#tema_comite').val()===''){er+='falta comite\n';}
        if($('#tema_titulo').val()===''){er+='falta titulo\n';}
        if($('#tema_detalle').val()===''){er+='falta detalle\n';}
        if($('#tema_tipo').val()===''){er+='falta tipo\n';}
        if($('#tema_responsable').val()===''){er+='falta responsable\n';}
        if($('#tema_fechaAsigna').val()===''){er+='falta fechaasigna\n';}
        if($('#tema_estado').val()===''){er+='falta estado\n';}
        if (er==''){
        $http.post('modulos/mod_mm_agendatemas.php?op=a',{'op':'a', 'tema_id':info.tema_id, 'tema_agendaId':info.tema_agendaId, 'tema_empresa':info.tema_empresa, 'tema_comite':info.tema_comite, 'tema_titulo':info.tema_titulo, 'tema_detalle':info.tema_detalle, 'tema_tipo':info.tema_tipo, 'tema_responsable':info.tema_responsable, 'tema_fechaAsigna':info.tema_fechaAsigna, 'tema_estado':info.tema_estado}).success(function(data){
        if (data === 'Ok') {
            getInfo($scope.empresa);
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 5:02:00   <<<<<<< 
