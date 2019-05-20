var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de mm_empresa';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_empresa_id = 'ID';
    $scope.form_empresa_nombre = 'NOMBRE';
    $scope.form_empresa_nit = 'NIT';
    $scope.form_empresa_web = 'WEB';
    $scope.form_empresa_direccion = 'DIRECCION';
    $scope.form_empresa_telefonos = 'TELEFONOS';
    $scope.form_empresa_ciudad = 'CIUDAD';
    $scope.form_empresa_logo = 'LOGO';
    $scope.form_empresa_autentica = 'COMO AUTENTICA';
    $scope.form_empresa_lenguaje = 'LENGUAJE';
    $scope.form_empresa_versionPrd = 'VERSION PRD';
    $scope.form_empresa_versionBd = 'VERSION BD';
    $scope.form_empresa_clave = 'CLAVE';
    $scope.form_empresa_email = 'EMAIL';
    $scope.form_empresa_registrsoXpagina = 'REGISTRSO X PAGINA';
    $scope.form_empresa_diasTrabaja = 'DIAS QUE TRABAJA';
    $scope.form_empresa_horarioInicio = 'HORA INICIO';
    $scope.form_empresa_horarioTermina = 'HORA TERMINA';
    $scope.form_empresa_intervaloCalendario = 'INTERVALO';
    $scope.form_empresa_FormatoActa = 'FORMATO ACTA';
    $scope.form_empresa_cresidencial = 'CONJUNTO RESIDENCIAL';
    $scope.form_empresa_ctrl = 'CELULAR';

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
    $scope.form_Phempresa_versionPrd = 'Digite versionprd';
    $scope.form_Phempresa_versionBd = 'Digite versionbd';
    $scope.form_Phempresa_clave = 'Digite clave';
    $scope.form_Phempresa_email = 'Digite email';
    $scope.form_Phempresa_registrsoXpagina = 'Digite registrsoxpagina';
    $scope.form_Phempresa_diasTrabaja = 'Digite diastrabaja';
    $scope.form_Phempresa_horarioInicio = 'Digite horarioinicio';
    $scope.form_Phempresa_horarioTermina = 'Digite horariotermina';
    $scope.form_Phempresa_intervaloCalendario = 'Digite intervalocalendario';
    $scope.form_Phempresa_FormatoActa = 'Digite formatoacta';
    $scope.form_Phempresa_cresidencial = 'Digite s es un conjunto residencial n no lo es';
    $scope.form_Phempresa_ctrl = 'Nro Celular del usuario';
   
     $scope.oculto=false;
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.ctrl='wefB875s13846s12518refd8624A12';
    var defaultForm= {
        empresa_id:0,
        empresa_nombre:'',
        empresa_nit:'',
        empresa_web:'',
        empresa_direccion:'',
        empresa_telefonos:'',
        empresa_ciudad:'',
        empresa_logo:'logoEmpresa.png',
        empresa_autentica:'C',
        empresa_lenguaje:'ESP',
        empresa_versionPrd:'TEST-201806',
        empresa_versionBd:'TEST-201806',
        empresa_clave:'TEST',
        empresa_email:'',
        empresa_registrsoXpagina:10,
        empresa_diasTrabaja:'L-M-M-J-V',
        empresa_horarioInicio:'7:00',
        empresa_horarioTermina:'18:00',
        empresa_intervaloCalendario:'M',
        empresa_FormatoActa:'ESTANDARD',
        empresa_cresidencial:'N',
        empresa_ctrl:''
   };
    
    
    getInfo();
    
    function getInfo(){
        $http.post('modulos/mod_mm_empresa.php?op=r',{'op':'r'}).success(function(data){
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
$scope.empresa_id=0;
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
        $http.post('modulos/mod_mm_empresa.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
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
        if($('#empresa_versionPrd').val()===''){er+='falta versionprd\n';}
        if($('#empresa_versionBd').val()===''){er+='falta versionbd\n';}
        if($('#empresa_clave').val()===''){er+='falta clave\n';}
        if($('#empresa_email').val()===''){er+='falta email\n';}
        if($('#empresa_registrsoXpagina').val()===''){er+='falta registrsoxpagina\n';}
        if($('#empresa_diasTrabaja').val()===''){er+='falta diastrabaja\n';}
        if($('#empresa_horarioInicio').val()===''){er+='falta horarioinicio\n';}
        if($('#empresa_horarioTermina').val()===''){er+='falta horariotermina\n';}
        if($('#empresa_intervaloCalendario').val()===''){er+='falta intervalocalendario\n';}
        if($('#empresa_FormatoActa').val()===''){er+='falta formatoacta\n';}
        if($('#empresa_cresidencial').val()===''){er+='falta s es un conjunto residencial n no lo es\n';}
        if($('#empresa_ctrl').val()===''){er+='falta nro celular\n';}
        if (er==''){
        $http.post('modulos/mod_mm_empresa.php?op=a',{'op':'a', 'empresa_id':info.empresa_id, 'empresa_nombre':info.empresa_nombre, 'empresa_nit':info.empresa_nit, 'empresa_web':info.empresa_web, 'empresa_direccion':info.empresa_direccion, 'empresa_telefonos':info.empresa_telefonos, 'empresa_ciudad':info.empresa_ciudad, 'empresa_logo':info.empresa_logo, 'empresa_autentica':info.empresa_autentica, 'empresa_lenguaje':info.empresa_lenguaje, 'empresa_versionPrd':info.empresa_versionPrd, 'empresa_versionBd':info.empresa_versionBd, 'empresa_clave':info.empresa_clave, 'empresa_email':info.empresa_email, 'empresa_registrsoXpagina':info.empresa_registrsoXpagina, 'empresa_diasTrabaja':info.empresa_diasTrabaja, 'empresa_horarioInicio':info.empresa_horarioInicio, 'empresa_horarioTermina':info.empresa_horarioTermina, 'empresa_intervaloCalendario':info.empresa_intervaloCalendario, 'empresa_FormatoActa':info.empresa_FormatoActa, 'empresa_cresidencial':info.empresa_cresidencial, 'empresa_ctrl':info.empresa_ctrl}).success(function(data){
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
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Apr 20, 2019 3:15:22   <<<<<<< 
