var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de usuarios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo50 = 'Administra';
    $scope.form_Activo51 = 'Consulta';
    $scope.form_Activo52 = 'Digita';
    $scope.form_Activo80 = 'Activo';
    $scope.form_Activo81 = 'Inactivo';

    $scope.form_usuario_id = 'ID';
    $scope.form_usuario_nombre = 'NOMBRE';
    $scope.form_usuario_empresa = 'EMPRESA';
    $scope.form_usuario_email = 'E.MAIL';
    $scope.form_usuario_password = 'PASSWORD';
    $scope.form_usuario_tipo_acceso = 'ACCESO';
    $scope.form_usuario_fechaCreado = 'FECHA CREADO';
    $scope.form_usuario_fechaActualizado = 'FECHA ACTUALIZADO';
    $scope.form_usuario_estado = 'ESTADO';
    $scope.form_usuario_perfil = 'PERFIL';
    $scope.form_usuario_avatar = 'AVATAR';
    $scope.form_usuario_user = 'USER';
    $scope.form_usuario_celular = 'CELULAR';

    $scope.form_Phusuario_id = 'Digite id';
    $scope.form_Phusuario_nombre = 'Digite nombre';
    $scope.form_Phusuario_empresa = 'Digite empresa';
    $scope.form_Phusuario_email = 'Digite login';
    $scope.form_Phusuario_password = 'Digite password';
    $scope.form_Phusuario_tipo_acceso = 'Digite acceso';
    $scope.form_Phusuario_fechaCreado = 'Digite fecha creado';
    $scope.form_Phusuario_fechaActualizado = 'Digite fecha actualizado';
    $scope.form_Phusuario_estado = 'Digite estado';
    $scope.form_Phusuario_perfil = 'Digite perfil';
    $scope.form_Phusuario_avatar = 'Digite avatar';
    $scope.form_Phusuario_user = 'Digite user';
    $scope.form_Phusuario_celular = 'Digite celular';
    
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    
    
    var defaultForm= {
        usuario_id:0,
        usuario_nombre:'',
        usuario_empresa:'',
        usuario_email:'',
        usuario_password:'',
        usuario_tipo_acceso:'',
        usuario_fechaCreado:'',
        usuario_fechaActualizado:'',
        usuario_estado:'A',
        usuario_perfil:'',
        usuario_avatar:'',
        usuario_user:'',
        usuario_celular:''
   };
    
    getCombos();
    
    getInfo();
    
    function getInfo(){
        empresa=$scope.empresa;
        $http.post('modulos/mod_mm_usuarios.php?op=r',{'op':'r', empresa:empresa}).success(function(data){        
        $scope.details = data;
        $scope.registro.usuario_perfil = data[0].usuario_perfil;  
        $scope.configPages();
        });       
    }

    function getCombos(){
        empresa=$scope.empresa;
         $http.post('modulos/mod_mm_usuarios.php?op=0',{'op':'0', empresa:empresa}).success(function(data){
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

    $scope.formToggle =function(){
    $('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = [];
        $scope.registro.usuario_estado='A';
        $scope.registro.usuario_tipo_acceso='A';
        $scope.registro.usuario_perfil=1;
        $scope.registro.usuario_email='';
        $scope.registro.usuario_id=0;
        var hoy = new Date();
        var mes = hoy.getMonth() + 1;
        fechaHoy = hoy.getFullYear()+'-'+mes+'-'+ hoy.getDate();
        $scope.registro.usuario_fechaCreado =  fechaHoy+' T00:00 ';
        $scope.registro.usuario_fechaActualizado =  fechaHoy+' T00:00 ';

    };


    $scope.registro =function(info){ 
        empresa =$scope.empresa;  
        $http.post('modulos/mod_mm_usuarios.php?op=a',{'op':'a', 'usuario_id':usuario_id, 
        'usuario_nombre':usuario_nombre, 'usuario_empresa':empresa, 'usuario_email':usuario_email, 
        'usuario_password':usuario_password, 'usuario_tipo_acceso':usuario_tipo_acceso, 
        'usuario_fechaCreado':usuario_fechaCreado, 'usuario_fechaActualizado':usuario_fechaActualizado, 
        'usuario_estado':usuario_estado, 'usuario_perfil':usuario_perfil, 'usuario_avatar':usuario_avatar, 
        'usuario_user':usuario_user, 'usuario_celular':usuario_celular}).success(function(data){
        $scope.show_form = true;
        if (data === true) {
            getInfo();
        }
        });
     };

    $scope.cambiaNombre = function(){
        nombre=$scope.registro.usuario_nombre;
        alert(nombre);
               
    };
    
    $scope.editInfo = function(info)
    {  
        $scope.registro =  info; 
        $scope.registro.usuario_perfil='2';
        $('#idForm').slideToggle();
    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.usuario_nombre+' ?')) {  
            $http.post('modulos/mod_mm_usuarios.php?op=b',{'op':'b', 'usuario_id':info.usuario_id}).success(function(data){
            if (data === 'Ok') {
            getInfo();
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo = function(info)
    {        
        er='';
        usr=$('#usuario_user').val();
        emp=$('#e').val();
        if($('#usuario_id').val()===''){er+='falta id\n';}
        if($('#usuario_nombre').val()===''){er+='falta nombre\n';}
        if($('#usuario_empresa').val()===''){er+='falta empresa\n';}
        if($('#usuario_email').val()===''){er+='falta login\n';}
        if($('#usuario_password').val()===''){$('#usuario_password').val(usr);}
        if($('#usuario_tipo_acceso').val()===''){er+='falta acceso\n';}
        if($('#usuario_fechaCreado').val()===''){er+='falta fecha creado\n';}
        if($('#usuario_fechaActualizado').val()===''){er+='falta fecha actualizado\n';}
        if($('#usuario_estado').val()===''){er+='falta estado\n';}
        if($('#usuario_perfil').val()===''){er+='falta perfil\n';}
        if($('#usuario_avatar').val()===''){er+='falta avatar\n';}
        if($('#usuario_user').val()===''){er+='falta user\n';}
        if($('#usuario_celular').val()===''){er+='falta celular\n';}
      //   alert('ooo');
        if (er==''){
  
        $http.post('modulos/mod_mm_usuarios.php?op=a',{'op':'a', 'usuario_id':info.usuario_id, 
            'usuario_nombre':info.usuario_nombre, 'usuario_empresa':emp, 'usuario_email':info.usuario_email, 
            'usuario_password':info.usuario_password, 'usuario_tipo_acceso':info.usuario_tipo_acceso, 
            'usuario_fechaCreado':info.usuario_fechaCreado, 'usuario_fechaActualizado':info.usuario_fechaActualizado, 
            'usuario_estado':info.usuario_estado, 'usuario_perfil':info.usuario_perfil, 
            'usuario_avatar':info.usuario_avatar, 'usuario_user':info.usuario_user, 
            'usuario_celular':info.usuario_celular}).success(function(data){
        if (data === 'Ok') {
            getInfo();
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }else{alert(data);}
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
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Oct 24, 2017 11:30:34   <<<<<<< 
