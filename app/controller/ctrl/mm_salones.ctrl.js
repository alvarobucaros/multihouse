var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de salones';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo0 = 'Si';
    $scope.form_Activo1 = 'No';

    $scope.form_salon_id = 'ID			';
    $scope.form_salon_empresa = 'EMPRESA';
    $scope.form_salon_nombre = 'NOMBRE';
    $scope.form_salon_ubicacion = 'UBICACION ';
    $scope.form_salon_capacidad = 'CAPACIDAD';
    $scope.form_salon_apoyovisual = 'APOYOS';
    $scope.form_salon_responsable = 'RESPONSABLE';
    $scope.form_salon_activo = 'ACTIVO';
    $scope.form_salon_observaciones = 'OBSERVACIONES';

    $scope.form_Phsalon_id = 'Digite id			';
    $scope.form_Phsalon_empresa = 'Digite empresa';
    $scope.form_Phsalon_nombre = 'Digite nombre';
    $scope.form_Phsalon_ubicacion = 'Digite ubicacion ';
    $scope.form_Phsalon_capacidad = 'Digite capacidad';
    $scope.form_Phsalon_apoyovisual = 'Digite apoyos';
    $scope.form_Phsalon_responsable = 'Digite responsable';
    $scope.form_Phsalon_activo = 'Digite activo';
    $scope.form_Phsalon_observaciones = 'Digite observaciones';
   
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_mm_salones.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();
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
        $scope.formato.$setPristine();
        $scope.registro = {};
        $scope.registro.salon_activo='A';
        $scope.registro.salon_empresa = $scope.empresa;
        $scope.registro.salon_id=0;
 
};

$scope.registro = function(info){ alert ('inserta');};


    $scope.registro =function(info){ 
            alert ('actualiza');   
            $http.post('modulos/mod_mm_salones.php?op=a',{'op':'a', 'salon_id':salon_id, 'salon_empresa':salon_empresa, 'salon_nombre':salon_nombre, 'salon_ubicacion':salon_ubicacion, 'salon_capacidad':salon_capacidad, 'salon_apoyovisual':salon_apoyovisual, 'salon_responsable':salon_responsable, 'salon_activo':salon_activo, 'salon_observaciones':salon_observaciones}).success(function(data){
            $scope.show_form = true;
            alert(data);
            if (data === true) {
            getInfo($scope.empresa);
            }
        });
     };

    $scope.registro = [];
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.salon_nombre+' ?')) {  
            $http.post('modulos/mod_mm_salones.php?op=b',{'op':'b', 'salon_id':info.salon_id}).success(function(data){
            if (data === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Borrado ');
            }else{
                alert('Salón '+info.salon_nombre+' '+data);
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        em=$('#e').val();
        ob = $('#salon_observaciones').val();
        if(ob===undefined){ob='No hay';}
        $('#salon_empresa').val(em);
        if($('#salon_id').val()===''){er+='falta id			\n';}
        if($('#salon_empresa').val()===''){er+='falta empresa\n';}
        if($('#salon_nombre').val()===''){er+='falta nombre\n';}
        if($('#salon_ubicacion').val()===''){er+='falta ubicacion \n';}
        if($('#salon_capacidad').val()===''){er+='falta capacidad\n';}
        if($('#salon_apoyovisual').val()===''){er+='falta apoyos\n';}
        if($('#salon_responsable').val()===''){er+='falta responsable\n';}
        if($('#salon_activo').val()===''){er+='falta activo\n';}
      
       
// alert(ob); return;
        info.salon_empresa= em;
        $('#salon_empresa').val(em);
        if (er==''){
        $http.post('modulos/mod_mm_salones.php?op=a',{'op':'a', 'salon_id':info.salon_id, 'salon_empresa':info.salon_empresa, 
            'salon_nombre':info.salon_nombre, 'salon_ubicacion':info.salon_ubicacion, 'salon_capacidad':info.salon_capacidad, 
            'salon_apoyovisual':info.salon_apoyovisual, 'salon_responsable':info.salon_responsable, 'salon_activo':info.salon_activo, 
            'salon_observaciones':ob}).success(function(data){
        if (data === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }else {alert (data);}
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfo =function(info)
    {
        $scope.registro = {};
        $('#idForm').slideToggle();
    };

}]);
	
  app.filter('startFromGrid', function() {
        return function(input, start) {
            start =+ start;
            return input.slice(start);
        }
    });        
        
// >>>>>>>   Creado por:   Alvaro Ortiz Wednesday,Oct 26, 2016 3:38:47   <<<<<<< 
