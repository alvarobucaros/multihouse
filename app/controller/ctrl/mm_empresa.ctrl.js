var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Parámetros Empresa';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_Activo80 = 'E Mail';
    $scope.form_Activo81 = 'Celular';
    $scope.form_Activo82 = 'Usuario';
    $scope.form_Activo90 = 'Español';
    $scope.form_Activo91 = 'Inglés';
    $scope.form_Activo92 = 'Otro';
    $scope.form_Activo180 = 'Media Hora';
    $scope.form_Activo181 = 'Una Hora';
    $scope.form_cresidencialS='Si';
    $scope.form_cresidencialN='No';
    $scope.form_empresa_id = 'ID';
    $scope.form_empresa_nombre = 'NOMBRE';
    $scope.form_empresa_nit = 'NIT';
    $scope.form_empresa_web = 'WEB';
    $scope.form_empresa_direccion = 'DIRECCION';
    $scope.form_empresa_telefonos = 'TELEFONOS';
    $scope.form_empresa_ciudad = 'CIUDAD';
    $scope.form_empresa_logo = 'LOGO';
    $scope.form_empresa_autentica = 'AUTENTICA';
    $scope.form_empresa_lenguaje = 'LENGUAJE';
    $scope.form_empresa_versionPrd = 'VERSION APP';
    $scope.form_empresa_versionBd = 'VERSION BD';
    $scope.form_empresa_clave = 'CLAVE';
    $scope.form_empresa_email = 'EMAIL';
    $scope.form_empresa_registrsoXpagina = 'REGISTRSO PAGINA';
    $scope.form_empresa_diasTrabaja = 'DIAS TRABAJA';
    $scope.form_empresa_horarioInicio = 'HORARIO INICIO';
    $scope.form_empresa_horarioTermina = 'HORARIO TERMINA';
    $scope.form_empresa_intervaloCalendario = 'INTERVALO CALENDARIO';
    $scope.form_empresa_FormatoActa = 'FORMATO ACTA';
    $scope.form_empresa_cresidencial = "ES CONJUNTO RESIDENCIAL";

    $scope.form_Phempresa_id = 'Digite id';
    $scope.form_Phempresa_nombre = 'Digite nombre';
    $scope.form_Phempresa_nit = 'Digite nit';
    $scope.form_Phempresa_web = 'Digite web';
    $scope.form_Phempresa_direccion = 'Digite direccion';
    $scope.form_Phempresa_telefonos = 'Digite telefonos';
    $scope.form_Phempresa_ciudad = 'Digite ciudad';
    $scope.form_Phempresa_logo = 'Digite logo';
    $scope.form_Phempresa_autentica = 'Digite autentica';
    $scope.form_Phempresa_lenguaje = 'Digite lenguaje';
    $scope.form_Phempresa_versionPrd = 'Digite version app';
    $scope.form_Phempresa_versionBd = 'Digite version bd';
    $scope.form_Phempresa_clave = 'Digite clave';
    $scope.form_Phempresa_email = 'Digite email';
    $scope.form_Phempresa_registrsoXpagina = 'Digite registrso pagina';
    $scope.form_Phempresa_diasTrabaja = 'Digite dias trabaja';
    $scope.form_Phempresa_horarioInicio = 'Digite horario inicio';
    $scope.form_Phempresa_horarioTermina = 'Digite horario termina';
    $scope.form_Phempresa_intervaloCalendario = 'Digite intervalo calendario';
    $scope.form_Phempresa_FormatoActa = 'Digite formato acta';
   
    
    var defaultForm= {
        empresa_id:0,
        empresa_nombre:'',
        empresa_nit:'',
        empresa_web:'',
        empresa_direccion:'',
        empresa_telefonos:'',
        empresa_ciudad:'',
        empresa_logo:'',
        empresa_autentica:'',
        empresa_lenguaje:'',
        empresa_versionPrd:'',
        empresa_versionBd:'',
        empresa_clave:'',
        empresa_email:'',
        empresa_registrsoXpagina:0,
        empresa_diasTrabaja:'',
        empresa_horarioInicio:'',
        empresa_horarioTermina:'',
        empresa_intervaloCalendario:'',
        empresa_FormatoActa:'',
        empresa_cresidencial:'N'
   };
    
    
    getInfo();
    
 $('#idForm').slideToggle();

    function getInfo(){
        empresa = $('#e').val();
        $http.post('modulos/mod_mm_empresa.php?op=r',{'op':'r','empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.registro.empresa_id = data[0].empresa_id; 
        $scope.registro.empresa_nombre = data[0].empresa_nombre; 
        $scope.registro.empresa_nit = data[0].empresa_nit; 
        $scope.registro.empresa_web = data[0].empresa_web; 
        $scope.registro.empresa_direccion = data[0].empresa_direccion; 
        $scope.registro.empresa_telefonos = data[0].empresa_telefonos; 
        $scope.registro.empresa_ciudad = data[0].empresa_ciudad; 
        $scope.registro.empresa_logo = data[0].empresa_logo; 
        $scope.registro.empresa_autentica = data[0].empresa_autentica; 
        $scope.registro.empresa_lenguaje = data[0].empresa_lenguaje; 
        $scope.registro.empresa_versionPrd = data[0].empresa_versionPrd; 
        $scope.registro.empresa_versionBd = data[0].empresa_versionBd; 
        $scope.registro.empresa_clave = data[0].empresa_clave; 
        $scope.registro.empresa_email = data[0].empresa_email; 
        $scope.registro.empresa_registrsoXpagina = data[0].empresa_registrsoXpagina; 
        $scope.registro.empresa_diasTrabaja = data[0].empresa_diasTrabaja; 
        $scope.registro.empresa_horarioInicio = data[0].empresa_horarioInicio; 
        $scope.registro.empresa_horarioTermina = data[0].empresa_horarioTermina; 
        $scope.registro.empresa_intervaloCalendario = data[0].empresa_intervaloCalendario; 
        $scope.registro.empresa_FormatoActa = data[0].empresa_FormatoActa; 
        $scope.registro.empresa_cresidencial = data[0].empresa_cresidencial;
        });   
    }

    function getCombos(){
} 
 
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
//$scope.registro = '';
$scope.empresa_id=0;
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


    $scope.registro = function(info){ 
    alert ('actualiza');   
            $http.post('modulos/mod_mm_empresa.php?op=a',{'op':'a', 'empresa_id':empresa_id, 'empresa_nombre':empresa_nombre, 'empresa_nit':empresa_nit,
                'empresa_web':empresa_web, 'empresa_direccion':empresa_direccion, 'empresa_telefonos':empresa_telefonos, 'empresa_ciudad':empresa_ciudad,
                'empresa_logo':empresa_logo, 'empresa_autentica':empresa_autentica, 'empresa_lenguaje':empresa_lenguaje, 
                'empresa_versionPrd':empresa_versionPrd, 'empresa_versionBd':empresa_versionBd, 'empresa_clave':empresa_clave, 
                'empresa_email':empresa_email, 'empresa_registrsoXpagina':empresa_registrsoXpagina, 'empresa_diasTrabaja':empresa_diasTrabaja, 
                'empresa_horarioInicio':empresa_horarioInicio, 'empresa_horarioTermina':empresa_horarioTermina, 
                'empresa_intervaloCalendario':empresa_intervaloCalendario, 'empresa_FormatoActa':empresa_FormatoActa, 
                'empresa_cresidencial':empresa_cresidencial}).success(function(data){
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
        if (confirm('Desea borrar el registro con nombre : '+info.empresa_nombre+' ?')) {  
            $http.post('modulos/mod_mm_empresa.php?op=b',{'op':'b', 'empresa_id':info.empresa_id}).success(function(data){
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
        if($('#empresa_id').val()===''){er+='falta id\n';}
        if($('#empresa_nombre').val()===''){er+='falta nombre\n';}
        if($('#empresa_nit').val()===''){er+='falta nit\n';}
        if($('#empresa_web').val()===''){er+='falta web\n';}
        if($('#empresa_direccion').val()===''){er+='falta direccion\n';}
        if($('#empresa_telefonos').val()===''){er+='falta telefonos\n';}
        if($('#empresa_ciudad').val()===''){er+='falta ciudad\n';}
        if($('#empresa_logo').val()===''){er+='falta logo\n';}
        if($('#empresa_autentica').val()===''){er+='falta autentica\n';}
        if($('#empresa_lenguaje').val()===''){er+='falta lenguaje\n';}
        if($('#empresa_versionPrd').val()===''){er+='falta version app\n';}
        if($('#empresa_versionBd').val()===''){er+='falta version bd\n';}
        if($('#empresa_clave').val()===''){er+='falta clave\n';}
        if($('#empresa_email').val()===''){er+='falta email\n';}
        if($('#empresa_registrsoXpagina').val()===''){er+='falta registrso pagina\n';}
        if($('#empresa_diasTrabaja').val()===''){er+='falta dias trabaja\n';}
        if($('#empresa_horarioInicio').val()===''){er+='falta horario inicio\n';}
        if($('#empresa_horarioTermina').val()===''){er+='falta horario termina\n';}
        if($('#empresa_intervaloCalendario').val()===''){er+='falta intervalo calendario\n';}
        if($('#empresa_FormatoActa').val()===''){er+='falta formato acta\n';}
        
        if (er==''){
        $http.post('modulos/mod_mm_empresa.php?op=a',{'op':'a', 'empresa_id':info.empresa_id, 'empresa_nombre':info.empresa_nombre, 
            'empresa_nit':info.empresa_nit, 'empresa_web':info.empresa_web, 'empresa_direccion':info.empresa_direccion,
            'empresa_telefonos':info.empresa_telefonos, 'empresa_ciudad':info.empresa_ciudad, 'empresa_logo':info.empresa_logo, 
            'empresa_autentica':info.empresa_autentica, 'empresa_lenguaje':info.empresa_lenguaje, 'empresa_versionPrd':info.empresa_versionPrd,
            'empresa_versionBd':info.empresa_versionBd, 'empresa_clave':info.empresa_clave, 'empresa_email':info.empresa_email, 
            'empresa_registrsoXpagina':info.empresa_registrsoXpagina, 'empresa_diasTrabaja':info.empresa_diasTrabaja, 
            'empresa_horarioInicio':info.empresa_horarioInicio, 'empresa_horarioTermina':info.empresa_horarioTermina, 
            'empresa_intervaloCalendario':info.empresa_intervaloCalendario, 'empresa_FormatoActa':info.empresa_FormatoActa,
            'empresa_cresidencial':info.empresa_cresidencial}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 23, 2017 9:07:44   <<<<<<< 
