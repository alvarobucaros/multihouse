var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.details=[];    
    $scope.form_title = 'Inmuebles y propietarios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Exporta';
    $scope.form_btnExpo = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';    
    $scope.form_Activo0 = 'SI';
    $scope.form_Activo1 = 'NO';
    $scope.form_inmueble_id = 'ID';
    $scope.form_inmueble_empresa = 'EMPRESA';
    $scope.form_inmueble_codigo = 'INMUEBLE CODIGO';
    $scope.form_inmueble_descripcion = 'DESCRIPCION';
    $scope.form_inmueble_area = 'AREA';
    $scope.form_inmueble_coeficiente = 'COEFICIENTE';
    $scope.form_inmueble_ubicacion = 'UBICACION';
    $scope.form_inmueble_propNombre = 'PROPIETARIO NOMBRE';
    $scope.form_inmueble_propCedula = 'CEDULA';
    $scope.form_inmueble_propTelefonos = 'TELEFONOS';
    $scope.form_inmueble_propDireccion = 'DIRECCION';
    $scope.form_inmueble_propCorreo = 'E-MAIL';
    $scope.form_inmueble_Activo = 'ACTIVO';
    $scope.form_inmueble_comite = 'ASISTE AL COMITE';

    $scope.form_Phinmueble_id = 'Digite id';
    $scope.form_Phinmueble_empresa = 'Digite empresa';
    $scope.form_Phinmueble_codigo = 'Digite codigo';
    $scope.form_Phinmueble_descripcion = 'Digite descripcion';
    $scope.form_Phinmueble_area = 'Digite area';
    $scope.form_Phinmueble_coeficiente = 'Digite coeficiente';
    $scope.form_Phinmueble_ubicacion = 'Digite ubicacion';
    $scope.form_Phinmueble_propNombre = 'Digite nombre';
    $scope.form_Phinmueble_propCedula = 'Digite cedula';
    $scope.form_Phinmueble_propTelefonos = 'Digite telefonos';
    $scope.form_Phinmueble_propDireccion = 'Digite direccion';
    $scope.form_Phinmueble_propCorreo = 'Digite e-mail';
    $scope.form_Phinmueble_Activo = 'Digite activo';
   
    $scope.empresa = $('#e').val();
    var defaultForm= {
        inmueble_id:0,
        inmueble_empresa:0,
        inmueble_codigo:'',
        inmueble_descripcion:'',
        inmueble_area:'',
        inmueble_coeficiente:'',
        inmueble_ubicacion:'',
        inmueble_propNombre:'',
        inmueble_propCedula:'',
        inmueble_propTelefonos:'',
        inmueble_propDireccion:'',
        inmueble_propCorreo:'',
        inmueble_Activo:'A'
   };

    $scope.currentPage = 0;
    $scope.pageSize = 10; // Esta la cantidad de registros que deseamos mostrar por página
    $scope.pages = [];
    
    getIni();
    getInfo();
   
    
    function getInfo(){
        cadena = $('#e').val();
        $http.post('modulos/mod_mm_inmuebles.php?op=r',{'op':'r','cadena':cadena}).success(function(data){
     //       alert(data);
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
      if (Math.ceil($scope.details.length / $scope.pageSize) > 10) fin = 10;
      else fin = Math.ceil($scope.details.length / $scope.pageSize);
   } else {
      if (ini >= Math.ceil($scope.details.length / $scope.pageSize) - 10) {
         ini = Math.ceil($scope.details.length / $scope.pageSize) - 10;
         fin = Math.ceil($scope.details.length / $scope.pageSize);
      }
   }
   if (ini < 1) ini = 1;
   for (var i = ini; i <= fin; i++) {
      $scope.pages.push({ no: i });
   }
   if ($scope.currentPage >= $scope.pages.length)
      $scope.currentPage = $scope.pages.length - 1;
};

$scope.setPage = function(index) {
   $scope.currentPage = index - 1;
};

$scope.exporta = function(){
    valor = confirm("Exporta la tabla de inmuebles y propietarios a Excel, continua?");
    if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_mm_inmuebles.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}

 function getIni(){
   // inicia el formulario
} 
 
$scope.show_form = true;

$scope.formToggle =function(){
$('#idForm').slideToggle();
    e=$('#e').val();
    $scope.registro = {};
    $scope.registro.inmueble_Activo120=true;
    getIni();
    $scope.registro.inmueble_id=9;
    $('#idForm').css('display', 'none');
};

$scope.formToggle =function(){
    $('#idForm').slideToggle();
    $scope.formato.$setPristine();
    $scope.registro = angular.copy(defaultForm);
    $scope.registro.inmueble_id=0;
    myempre = $('#e').val();
    $scope.registro.inmueble_empresa=myempre;
    $scope.registro.inmueble_Activo='A';
};

//$scope.registro = function(info){ alert ('inserta');};

//$scope.seleccionarInmueble = function(inmueble_id){
//    alert(inmueble_id);
//}


    $scope.registro =function(info){ 
            //alert ('actualiza');   
            $http.post('modulos/mod_mm_inmuebles.php?op=a',{'op':'a', 'inmueble_id':inmueble_id, 'inmueble_empresa':inmueble_empresa, 
                'inmueble_codigo':inmueble_codigo, 'inmueble_descripcion':inmueble_descripcion, 'inmueble_area':inmueble_area, 
                'inmueble_coeficiente':inmueble_coeficiente, 'inmueble_ubicacion':inmueble_ubicacion, 'inmueble_propNombre':inmueble_propNombre,
                'inmueble_propCedula':inmueble_propCedula, 'inmueble_propTelefonos':inmueble_propTelefonos, 
                'inmueble_propDireccion':inmueble_propDireccion, 'inmueble_propCorreo':inmueble_propCorreo, 
                'inmueble_Activo':inmueble_Activo}).success(function(data){
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
//        if(registro.inmueble_Activo =='A'){registro.  .grupoactivo=true;}
//        else{registro.grupoinactivo=true;}

    };

    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.inmueble_codigo+' ?')) {  
            $http.post('modulos/mod_mm_inmuebles.php?op=b',{'op':'b', 'inmueble_id':info.inmueble_id}).success(function(data){
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
        if($('#inmueble_id').val()===''){er+='falta id\n';}
        if($('#inmueble_empresa').val()===''){er+='falta empresa\n';}
        if($('#inmueble_codigo').val()===''){er+='falta codigo\n';}
        if($('#inmueble_descripcion').val()===''){er+='falta descripcion\n';}
        if($('#inmueble_area').val()===''){er+='falta area\n';}
        if($('#inmueble_coeficiente').val()===''){er+='falta coeficiente\n';}
        if($('#inmueble_ubicacion').val()===''){er+='falta ubicacion\n';}
        if($('#inmueble_propNombre').val()===''){er+='falta nombre\n';}
        if($('#inmueble_propCedula').val()===''){er+='falta cedula\n';}
        if($('#inmueble_propTelefonos').val()===''){er+='falta telefonos\n';}
        if($('#inmueble_propDireccion').val()===''){er+='falta direccion\n';}
        if($('#inmueble_propCorreo').val()===''){er+='falta e-mail\n';}
        if($('#inmueble_Activo').val()===''){er+='falta activo\n';}
        if (er==''){
        $http.post('modulos/mod_mm_inmuebles.php?op=a',{'op':'a', 'inmueble_id':info.inmueble_id, 'inmueble_empresa':info.inmueble_empresa,
            'inmueble_codigo':info.inmueble_codigo, 'inmueble_descripcion':info.inmueble_descripcion, 'inmueble_area':info.inmueble_area, 
            'inmueble_coeficiente':info.inmueble_coeficiente, 'inmueble_ubicacion':info.inmueble_ubicacion, 
            'inmueble_propNombre':info.inmueble_propNombre, 'inmueble_propCedula':info.inmueble_propCedula, 
            'inmueble_propTelefonos':info.inmueble_propTelefonos, 'inmueble_propDireccion':info.inmueble_propDireccion, 
            'inmueble_propCorreo':info.inmueble_propCorreo, 'inmueble_Activo':info.inmueble_Activo}).success(function(data){
 //alert(data);           
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
      start = +start;
      return input.slice(start);
   };
});
 	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,May 09, 2018 5:51:23   <<<<<<< 
