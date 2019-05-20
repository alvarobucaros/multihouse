var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Reserva de salones';
    $scope.form_btnNuevo = 'Nueva reserva';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo0 = 'Si';
    $scope.form_Activo1 = 'No';

    $scope.form_grupo_id = 'ID';
    $scope.form_grupo_empresa = 'EMPRESA';
    $scope.form_grupo_nombre = 'SALON';    
    $scope.form_grupo_comite = 'COMITE';
    $scope.form_grupo_detalle = 'DETALLE';
    $scope.form_grupo_activo = 'ACTIVO';

    $scope.form_Phgrupo_id = 'Digite id';
    $scope.form_Phgrupo_empresa = 'Digite empresa';
    $scope.form_Phgrupo_nombre = 'Digite nombre';
    $scope.form_Phgrupo_detalle = 'Digite detalle';
    $scope.form_Phgrupo_comite = 'Digite comite';
    $scope.form_Phgrupo_activo = 'Digite activo';
   
    
    var defaultForm= {
        grupo_id:0,
        grupo_empresa:0,
        grupo_nombre:'',
        grupo_detalle:'',
        grupo_comite:0,
        grupo_activo:''
   };
    
    getCombos();
    
    getInfo();
    
    function getInfo(){
        empresa = $('#grupo_empresa').val();
        $http.post('modulos/mod_mm_grupos.php?op=r',{'op':'r',  grupo_empresa:empresa}).success(function(data){
     //  alert(data);
        $scope.details = data;
        });       
    }

    function getCombos(){
      empresa=$('#grupo_empresa').val();
     // alert(empresa);
      $http.post('modulos/modCombos.php?op=co',{'op':'co', comite_empresa:empresa}).success(function(data){
//          alert(data);
      $scope.operators0 = data;
      });
    }
 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
//$scope.registro = '';
$scope.grupo_id=0;
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
            $http.post('modulos/mod_mm_grupos.php?op=a',{'op':'a', 'grupo_id':grupo_id, 'grupo_empresa':grupo_empresa, 'grupo_nombre':grupo_nombre, 'grupo_detalle':grupo_detalle, 'grupo_comite':grupo_comite, 'grupo_activo':grupo_activo}).success(function(data){

            $scope.show_form = true;
            alert(data);
            if (data === true) {
            getInfo();
            }
            });
     };

    $scope.registro = {};
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();
       // if(registro.grupo_activo='A'){registro.grupoactivo=true;}
       // else{registro.grupoinactivo=true;}

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.grupo_nombre+' ?')) {  
            $http.post('modulos/mod_mm_grupos.php?op=b',{'op':'b', 'grupo_id':info.grupo_id}).success(function(data){
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
        em=$('#e').val();
        $('#grupo_empresa').val(em);
        if($('#grupo_id').val()===''){er+='falta id\n';}
        if($('#grupo_empresa').val()===''){er+='falta empresa\n';}
        if($('#grupo_nombre').val()===''){er+='falta nombre\n';}
        if($('#grupo_detalle').val()===''){er+='falta detalle\n';}
        if($('#grupo_comite').val()===''){er+='falta comite\n';}
        if($('#grupo_activo').val()===''){er+='falta activo\n';}
        info.grupo_empresa= em;
        $('#grupo_empresa').val(em);
        if (er==''){
        $http.post('modulos/mod_mm_grupos.php?op=a',{'op':'a', 'grupo_id':info.grupo_id, 'grupo_empresa':info.grupo_empresa, 'grupo_nombre':info.grupo_nombre, 'grupo_detalle':info.grupo_detalle, 'grupo_comite':info.grupo_comite, 'grupo_activo':info.grupo_activo}).success(function(data){
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
	 
// >>>>>>>   Creado por:   Alvaro Ortiz Friday,Oct 28, 2016 8:47:23   <<<<<<< 
