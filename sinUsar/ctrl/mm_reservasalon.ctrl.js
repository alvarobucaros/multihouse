var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'reserva salón';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_reservaSal_id = 'ID';
    $scope.form_reservaSal_idEmpresa = 'EMPRESA';
    $scope.form_reservaSal_idSalon = 'SALON';
    $scope.form_reservaSal_idComite = 'COMITE';
    $scope.form_reservaSal_FechaDesde = 'FECHA DESDE';
    $scope.form_reservaSal_FechaHasta = 'FECHA HASTA';
    $scope.form_reservaSal_reservadoPor = 'RESERVADO POR';
    $scope.form_reservaSal_FechaReserva = 'FECHA RESERVA';
    $scope.form_reservaSal_Confirmado = 'CONFIRMADO';
    $scope.form_reservaSal_Observaciones = 'OBSERVACIONES';

    $scope.form_PhreservaSal_id = 'Digite id';
    $scope.form_PhreservaSal_idEmpresa = 'Digite empresa';
    $scope.form_PhreservaSal_idSalon = 'Digite salon';
    $scope.form_PhreservaSal_idComite = 'Digite comite';
    $scope.form_PhreservaSal_FechaDesde = 'Digite fecha desde';
    $scope.form_PhreservaSal_FechaHasta = 'Digite fecha hasta';
    $scope.form_PhreservaSal_reservadoPor = 'Digite reservado por';
    $scope.form_PhreservaSal_FechaReserva = 'Digite fecha reserva';
    $scope.form_PhreservaSal_Confirmado = 'Digite confirmado';
    $scope.form_PhreservaSal_Observaciones = 'Digite observaciones';
   
    
    var defaultForm= {
        reservaSal_id:0,
        reservaSal_idEmpresa:0,
        reservaSal_idSalon:0,
        reservaSal_idComite:0,
        reservaSal_FechaDesde:'',
        reservaSal_FechaHasta:'',
        reservaSal_reservadoPor:'',
        reservaSal_FechaReserva:'',
        reservaSal_Confirmado:'',
        reservaSal_Observaciones:''
   };
    
    getCombos();
    
    getInfo();
    
    function getInfo(){
        $http.post('modulos/mod_mm_reservasalon.php?op=r',{'op':'r'}).success(function(data){
        $scope.details = data;
        });       
    }

    function getCombos(){
          $http.post('modulos/mod_mm_reservasalon.php?op=0',{'op':'0'}).success(function(data){
         $scope.operators0 = data;
         });
          $http.post('modulos/mod_mm_reservasalon.php?op=1',{'op':'1'}).success(function(data){
         $scope.operators1 = data;
         });
} 
 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggleUUUU =function(){
$('#idForm').slideToggle();
$scope.registro.reservaSal_idEmpresa=99;
$scope.reservaSal_id=0;
        $scope.registro.reservaSal_idEmpresa = 1;

$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();

        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
        $scope.registro.reservaSal_idEmpresa=88;
        $http.post('modulos/mod_mm_empresa.php?op=l',{'op':'l'}).success(function(data){
            var n = data.length;
            var res = data.substring(1,n-2);
            var obj = JSON.parse(res, function (key, value) {
            if (key == "fecha") {
                return new Date(value);
                } else {
                    return value;
                }});
            $scope.registro.reservaSal_idEmpresa=obj.empresa_id;
            $scape.registro.reservaSal_FechaReserva = new Date();
         });
};

$scope.registro = function(info){ alert ('inserta');};


    $scope.registro =function(info){ 
            alert ('actualiza');   
            $http.post('modulos/mod_mm_reservasalon.php?op=a',{'op':'a', 'reservaSal_id':reservaSal_id, 'reservaSal_idEmpresa':reservaSal_idEmpresa, 'reservaSal_idSalon':reservaSal_idSalon, 'reservaSal_idComite':reservaSal_idComite, 'reservaSal_FechaDesde':reservaSal_FechaDesde, 'reservaSal_FechaHasta':reservaSal_FechaHasta, 'reservaSal_reservadoPor':reservaSal_reservadoPor, 'reservaSal_FechaReserva':reservaSal_FechaReserva, 'reservaSal_Confirmado':reservaSal_Confirmado, 'reservaSal_Observaciones':reservaSal_Observaciones}).success(function(data){

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
       // if(registro.grupo_activo=='A'){registro.grupoactivo=true;}
       // else{registro.grupoinactivo=true;}

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.reservaSal_idSalon+' ?')) {  
            $http.post('modulos/mod_mm_reservasalon.php?op=b',{'op':'b', 'reservaSal_id':info.reservaSal_id}).success(function(data){
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
        if($('#reservaSal_id').val()===''){er+='falta id\n';}
        if($('#reservaSal_idEmpresa').val()===''){er+='falta empresa\n';}
        if($('#reservaSal_idSalon').val()===''){er+='falta salon\n';}
        if($('#reservaSal_idComite').val()===''){er+='falta comite\n';}
        if($('#reservaSal_FechaDesde').val()===''){er+='falta fecha desde\n';}
        if($('#reservaSal_FechaHasta').val()===''){er+='falta fecha hasta\n';}
        if($('#reservaSal_reservadoPor').val()===''){er+='falta reservado por\n';}
        if($('#reservaSal_FechaReserva').val()===''){er+='falta fecha reserva\n';}
        if($('#reservaSal_Confirmado').val()===''){er+='falta confirmado\n';}
        if($('#reservaSal_Observaciones').val()===''){er+='falta observaciones\n';}
        if (er==''){
        $http.post('modulos/mod_mm_reservasalon.php?op=a',{'op':'a', 'reservaSal_id':info.reservaSal_id, 'reservaSal_idEmpresa':info.reservaSal_idEmpresa, 'reservaSal_idSalon':info.reservaSal_idSalon, 'reservaSal_idComite':info.reservaSal_idComite, 'reservaSal_FechaDesde':info.reservaSal_FechaDesde, 'reservaSal_FechaHasta':info.reservaSal_FechaHasta, 'reservaSal_reservadoPor':info.reservaSal_reservadoPor, 'reservaSal_FechaReserva':info.reservaSal_FechaReserva, 'reservaSal_Confirmado':info.reservaSal_Confirmado, 'reservaSal_Observaciones':info.reservaSal_Observaciones}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Oct 28, 2017 6:17:44   <<<<<<< 
