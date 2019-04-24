var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Instala MultiMeeting';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_estado50 = 'LITE';
    $scope.form_estado51 = 'ONLINE';

    $scope.form_id = 'ID';
    $scope.form_servidor = 'SERVIDOR';
    $scope.form_basedatos = 'BASEDATOS';
    $scope.form_usuario = 'USUARIO';
    $scope.form_password = 'PASSWORD';
    $scope.form_estado = 'ESTADO';

    $scope.form_Phid = 'Digite id';
    $scope.form_Phservidor = 'Servidor Base de Datos';
    $scope.form_Phbasedatos = 'Nombre Base de Datos';
    $scope.form_Phusuario = 'Usuario BD';
    $scope.form_Phpassword = 'Contraseña BD';
    $scope.form_Phestado = 'Versión';
   
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.procesa = false;
    $scope.pages = [];
    $scope.registro = [];
    $scope.registro.estado=0;
    $scope.registro.basedatos='mmeeting';
    $scope.registro.id=0;
    $scope.registro.password='admin123';
    $scope.registro.servidor='localhost';
    $scope.registro.usuario='root';  
    
    var defaultForm= {
        id:0,
        servidor:'',
        basedatos:'',
        usuario:'',
        password:'',
        estado:''
   };

    
 $('#idForm').slideToggle();

$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.id=0;
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


    $scope.updateInfo =function(info)
    {
        
    er='';
     $('#id').val(0);
     $scope.registro.id=0;
        if($('#id').val()===''){er+='falta id\n';}
        if($('#servidor').val()===''){er+='falta servidor\n';}
        if($('#basedatos').val()===''){er+='falta basedatos\n';}
        if($('#usuario').val()===''){er+='falta usuario\n';}
     //   if($('#password').val()===''){er+='falta password\n';}
        if($('#estado').val()===''){er+='falta estado\n';}
        if (er==''){
            $scope.procesa = true;
 //   Estaslineas las dejo pendientes mientras arreglo como crear la BD directamente           
 //           $http.post('app/modulos/mod_mm_instala.php?op=a',{'op':'a', 'id':info.id, 
 //               'servidor':info.servidor, 'basedatos':info.basedatos, 'usuario':info.usuario, 
 //               'password':info.password, 'estado':info.estado}).success(function(data){
 //           $('#nota').html(data);
            $http.post('app/modulos/mod_mm_instala.php?op=a2',{'op':'a2', 'id':info.id, 
                'servidor':info.servidor, 'basedatos':info.basedatos, 'usuario':info.usuario, 
                'password':info.password, 'estado':info.estado}).success(function(data){
            $('#nota').html(data);
            $scope.procesa = false;
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm').slideToggle();
    };

}]);
	 

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Nov 04, 2018 12:51:53   <<<<<<< 
