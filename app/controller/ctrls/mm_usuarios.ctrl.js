var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Usuarios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_usuario_tipo_acceso60 = 'Superior';
    $scope.form_usuario_tipo_acceso61 = 'Administra';
    $scope.form_usuario_tipo_acceso62 = 'Consultas';
    $scope.form_usuario_estado110 = 'Activo';
    $scope.form_usuario_estado111 = 'Inactivo';
    $scope.form_usuario_tipodoc120 = 'Cédula';
    $scope.form_usuario_tipodoc121 = 'Extrangería';
    $scope.form_usuario_tipodoc122 = 'Otro';

    $scope.form_usuario_id = 'ID';
    $scope.form_usuario_empresa = 'EMPRESA';
    $scope.form_usuario_nombre = 'NOMBRE';
    $scope.form_usuario_email = 'LOGIN';
    $scope.form_usuario_celular = 'CELULAR';
    $scope.form_usuario_password = 'PASSWORD';
    $scope.form_usuario_tipo_acceso = 'ACCESO';
    $scope.form_usuario_fechaCreado = 'CREADO';
    $scope.form_usuario_fechaActualizado = 'ACTIVADO';
    $scope.form_usuario_perfil = 'PERFIL';
    $scope.form_usuario_avatar = 'AVATAR';
    $scope.form_usuario_estado = 'ESTADO';
    $scope.form_usuario_tipodoc = 'TIPO DOC';
    $scope.form_usuario_nrodoc = 'NRO DOC';
    $scope.form_usuario_direccion = 'DIRECCION';
    $scope.form_usuario_ciudad = 'CIUDAD';

    $scope.form_Phusuario_id = 'Digite id';
    $scope.form_Phusuario_empresa = 'Digite empresa';
    $scope.form_Phusuario_nombre = 'Digite nombre';
    $scope.form_Phusuario_email = 'Digite login';
    $scope.form_Phusuario_celular = 'Digite celular';
    $scope.form_Phusuario_password = 'Digite password';
    $scope.form_Phusuario_tipo_acceso = 'Digite acceso';
    $scope.form_Phusuario_fechaCreado = 'Digite fechacreado';
    $scope.form_Phusuario_fechaActualizado = 'Digite fechaactualizado';
    $scope.form_Phusuario_perfil = 'Digite perfil';
    $scope.form_Phusuario_avatar = 'Digite avatar';
    $scope.form_Phusuario_estado = 'Digite estado';
    $scope.form_Phusuario_tipodoc = 'Digite tipodoc';
    $scope.form_Phusuario_nrodoc = 'Digite nrodoc';
    $scope.form_Phusuario_direccion = 'Digite direccion';
    $scope.form_Phusuario_ciudad = 'Digite ciudad';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        usuario_id:0,
        usuario_empresa:$scope.empresa,
        usuario_nombre:'',
        usuario_email:'',
        usuario_celular:'',
        usuario_password:'',
        usuario_tipo_acceso:'C',
        usuario_fechaCreado:'',
        usuario_fechaActualizado:'',
        usuario_perfil:'1',
        usuario_avatar:'avatar.png',
        usuario_estado:'A',
        usuario_tipodoc:'C',
        usuario_nrodoc:'',
        usuario_direccion:'',
        usuario_ciudad:''
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_mm_usuarios.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
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
$scope.usuario_id=0;
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
        $http.post('modulos/mod_mm_usuarios.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.usuario_nombre+' ?')) {  
            $http.post('modulos/mod_mm_usuarios.php?op=b',{'op':'b', 'usuario_id':info.usuario_id}).success(function(data){
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
        $('#usuario_password').val($('#usuario_celular').val());
        if($('#usuario_id').val()===''){er+='falta id\n';}
        if($('#usuario_empresa').val()===''){er+='falta empresa\n';}
        if($('#usuario_nombre').val()===''){er+='falta nombre\n';}
        if($('#usuario_email').val()===''){er+='falta login\n';}
        if($('#usuario_celular').val()===''){er+='falta celular\n';}
        if($('#usuario_password').val()===''){er+='falta password\n';}
        if($('#usuario_tipo_acceso').val()===''){er+='falta acceso\n';}
        if($('#usuario_fechaCreado').val()===''){er+='falta fechacreado\n';}
        if($('#usuario_fechaActualizado').val()===''){er+='falta fechaactualizado\n';}
        if($('#usuario_perfil').val()===''){er+='falta perfil\n';}
        if($('#usuario_avatar').val()===''){er+='falta avatar\n';}
        if($('#usuario_estado').val()===''){er+='falta estado\n';}
        if($('#usuario_tipodoc').val()===''){er+='falta tipodoc\n';}
        if($('#usuario_nrodoc').val()===''){er+='falta nrodoc\n';}
        if($('#usuario_direccion').val()===''){er+='falta direccion\n';}
        if($('#usuario_ciudad').val()===''){er+='falta ciudad\n';}
        if (er==''){
        $http.post('modulos/mod_mm_usuarios.php?op=a',{'op':'a', 'usuario_id':info.usuario_id, 'usuario_empresa':info.usuario_empresa, 'usuario_nombre':info.usuario_nombre, 'usuario_email':info.usuario_email, 'usuario_celular':info.usuario_celular, 'usuario_password':info.usuario_password, 'usuario_tipo_acceso':info.usuario_tipo_acceso, 'usuario_fechaCreado':info.usuario_fechaCreado, 'usuario_fechaActualizado':info.usuario_fechaActualizado, 'usuario_perfil':info.usuario_perfil, 'usuario_avatar':info.usuario_avatar, 'usuario_estado':info.usuario_estado, 'usuario_tipodoc':info.usuario_tipodoc, 'usuario_nrodoc':info.usuario_nrodoc, 'usuario_direccion':info.usuario_direccion, 'usuario_ciudad':info.usuario_ciudad}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 17, 2019 7:59:58   <<<<<<< 
