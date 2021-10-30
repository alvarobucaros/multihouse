var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de terceros';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_terceroIdenTipo30 = 'Nit';
    $scope.form_terceroIdenTipo31 = 'C. Ciudadanía'
    $scope.form_terceroIdenTipo32 = 'C. Extrangería';
    $scope.form_terceroActivo120 = 'Si';
    $scope.form_terceroActivo121 = 'No';
    $scope.form_terceroRegimen130 = 'Simplificado';
    $scope.form_terceroRegimen131 = 'Común';
    $scope.form_terceroContribuyente140 = 'Si';
    $scope.form_terceroContribuyente141 = 'No';

    $scope.form_terceroId = 'ID';
    $scope.form_terceroEmpresaId = 'EMPRESA';
    $scope.form_terceroNombre = 'NOMBRE';
    $scope.form_terceroIdenTipo = 'TIPO DOC';
    $scope.form_terceroIdenNumero = 'NUMERO DOC';
    $scope.form_terceroDireccion = 'DIRECCION';
    $scope.form_terceroTelefonos = 'TELEFONOS';
    $scope.form_terceroCorreo = 'E-MAIL';
    $scope.form_terceroTwiter = 'CTA TWITER';
    $scope.form_terceroFacebook = 'CTA FACEBOOK';
    $scope.form_terceroComentario = 'COMENTARIOS';
    $scope.form_tercero_codigo = 'CODIGO';
    $scope.form_terceroActivo = 'ACTIVO';
    $scope.form_terceroRegimen = 'REGIMEN';
    $scope.form_terceroContribuyente = 'GRAN CONTRIBUYENTE';
    $scope.form_terceroCiudad = 'CIUDAD';
    
    $scope.form_PhterceroId = 'Digite id';
    $scope.form_PhterceroEmpresaId = 'Digite empresa';
    $scope.form_PhterceroNombre = 'Digite nombre';
    $scope.form_PhterceroIdenTipo = 'Digite tipo id';
    $scope.form_PhterceroIdenNumero = 'Digite idennumero';
    $scope.form_PhterceroDireccion = 'Digite direccion';
    $scope.form_PhterceroTelefonos = 'Digite telefonos';
    $scope.form_PhterceroCorreo = 'Digite e-mail';
    $scope.form_PhterceroTwiter = 'Digite cta twiter';
    $scope.form_PhterceroFacebook = 'Digite cta facebook';
    $scope.form_PhterceroComentario = 'Digite comentarios';
    $scope.form_Phtercero_codigo = 'Digite _codigo';
    $scope.form_PhterceroActivo = 'Digite activo';
    $scope.form_PhterceroRegimen = 'Digite regimen';
    $scope.form_PhterceroContribuyente = 'Digite contribuyente';
    $scope.form_PhterceroCiudad = 'Digite ciudad';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        terceroId:0,
        terceroEmpresaId:$scope.empresa,
        terceroNombre:'',
        terceroIdenTipo:'N',
        terceroIdenNumero:'',
        terceroDireccion:'',
        terceroTelefonos:'',
        terceroCorreo:'',
        terceroTwiter:'',
        terceroFacebook:'',
        terceroComentario:'',
        tercero_codigo:'',
        terceroActivo:'A',
        terceroRegimen:'C',
        terceroContribuyente:'N',
        terceroCiudad:''
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contaterceros.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
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
$scope.terceroId=0;
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
        $http.post('modulos/mod_contaterceros.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.terceroNombre+' ?')) {  
            $http.post('modulos/mod_contaterceros.php?op=b',{'op':'b', 'terceroId':info.terceroId}).success(function(data){
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
        if($('#terceroId').val()===''){er+='falta id\n';}
        if($('#terceroEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#terceroNombre').val()===''){er+='falta nombre\n';}
        if($('#terceroIdenTipo').val()===''){er+='falta tipo id\n';}
        if($('#terceroIdenNumero').val()===''){er+='falta idennumero\n';}
        if($('#terceroDireccion').val()===''){er+='falta direccion\n';}
        if($('#terceroTelefonos').val()===''){er+='falta telefonos\n';}
//        if($('#terceroCorreo').val()===''){er+='falta e-mail\n';}
//        if($('#terceroTwiter').val()===''){er+='falta cta twiter\n';}
//        if($('#terceroFacebook').val()===''){er+='falta cta facebook\n';}
        if($('#terceroCiudad').val()===''){er+='falta Ciudad\n';}
        if($('#tercero_codigo').val()===''){er+='falta _codigo\n';}
        if($('#terceroActivo').val()===''){er+='falta activo\n';}
        if($('#terceroRegimen').val()===''){er+='falta regimen\n';}
        if($('#terceroContribuyente').val()===''){er+='falta contribuyente\n';}
        if (er==''){
        $http.post('modulos/mod_contaterceros.php?op=a',{'op':'a', 'terceroId':info.terceroId, 
            'terceroEmpresaId':info.terceroEmpresaId, 'terceroNombre':info.terceroNombre, 
            'terceroIdenTipo':info.terceroIdenTipo, 'terceroIdenNumero':info.terceroIdenNumero,
            'terceroDireccion':info.terceroDireccion, 'terceroTelefonos':info.terceroTelefonos,
            'terceroCorreo':info.terceroCorreo, 'terceroTwiter':info.terceroTwiter, 
            'terceroFacebook':info.terceroFacebook, 'terceroComentario':info.terceroComentario, 
            'tercero_codigo':info.tercero_codigo, 'terceroActivo':info.terceroActivo, 
            'terceroRegimen':info.terceroRegimen, 'terceroContribuyente':info.terceroContribuyente,
            'terceroCiudad':info.terceroCiudad}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:47:34   <<<<<<< 
