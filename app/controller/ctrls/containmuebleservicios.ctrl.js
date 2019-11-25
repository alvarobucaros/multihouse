var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Inmueble y sus Servicios Especiales';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_InmuebleServicioActivo80 = 'Inactivo';
    $scope.form_InmuebleServicioActivo81 = 'Activo';

    $scope.form_InmuebleServicioId = 'ID';
    $scope.form_InmuebleServicioEmpresaId = 'EMPRESA';
    $scope.form_InmuebleServicioInmuebleId = 'INMUEBLE';
    $scope.form_InmuebleServicioServicioId = 'SERVICIO';
    $scope.form_InmuebleServicioMonto = 'MONTO';
    $scope.form_InmuebleServicioCuota = 'VALOR CUOTA';
    $scope.form_InmuebleServicioSaldo = 'SALDO';
    $scope.form_InmuebleServicioFechaInicio = 'FECHA INICIO';
    $scope.form_InmuebleServicioActivo = 'ACTIVO';

    $scope.form_PhInmuebleServicioId = 'Digite id';
    $scope.form_PhInmuebleServicioEmpresaId = 'Digite empresa';
    $scope.form_PhInmuebleServicioInmuebleId = 'Digite inmueble';
    $scope.form_PhInmuebleServicioServicioId = 'Digite servicio';
    $scope.form_PhInmuebleServicioMonto = 'Digite monto';
    $scope.form_PhInmuebleServicioCuota = 'Digite valor cuota';
    $scope.form_PhInmuebleServicioSaldo = 'Digite saldo';
    $scope.form_PhInmuebleServicioFechaInicio = 'Digite fecha inicio';
    $scope.form_PhInmuebleServicioActivo = 'Digite activo';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
    $scope.empresa = $('#e').val();
    var defaultForm= {
   
        InmuebleServicioId:0,
        InmuebleServicioEmpresaId:$scope.empresa,
        InmuebleServicioInmuebleId:0,
        InmuebleServicioServicioId:0,
        InmuebleServicioMonto:'0',
        InmuebleServicioCuota:'0',
        InmuebleServicioSaldo:'0',
        InmuebleServicioFechaInicio:'',
        InmuebleServicioActivo:'A'
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_containmuebleservicios.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
         $http.post('modulos/mod_containmuebleservicios.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
      
         $scope.operators0 = data;
         });
         $http.post('modulos/mod_containmuebleservicios.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
         $scope.operators1 = data;
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

 $scope.vlrMonto = function(){
    // if($scope.registro.InmuebleServicioSaldo == 0){
        var n = $scope.registro.InmuebleServicioMonto; // numberWithCommas($scope.registro.InmuebleServicioMonto);
        $scope.registro.InmuebleServicioSaldo =  n; 
        $scope.registro.InmuebleServicioMonto = n;
    // }
    
 }
 function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.InmuebleServicioId=0;
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
        $http.post('modulos/mod_containmuebleservicios.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.InmuebleServicioServicioId+' ?')) {  
            $http.post('modulos/mod_containmuebleservicios.php?op=b',{'op':'b', 'InmuebleServicioId':info.InmuebleServicioId}).success(function(data){
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
        if($('#InmuebleServicioId').val()===''){er+='falta id\n';}
        if($('#InmuebleServicioEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#InmuebleServicioInmuebleId').val()===''){er+='falta inmueble\n';}
        if($('#InmuebleServicioServicioId').val()===''){er+='falta servicio\n';}
        if($('#InmuebleServicioMonto').val()===''){er+='falta monto\n';}
        if($('#InmuebleServicioCuota').val()===''){er+='falta valor cuota\n';}
        if($('#InmuebleServicioSaldo').val()===''){er+='falta saldo\n';}
        if($('#InmuebleServicioFechaInicio').val()===''){er+='falta fecha inicio\n';}
        if($('#InmuebleServicioActivo').val()===''){er+='falta activo\n';}
        if (er==''){
        $http.post('modulos/mod_containmuebleservicios.php?op=a',{'op':'a', 'InmuebleServicioId':info.InmuebleServicioId, 'InmuebleServicioEmpresaId':info.InmuebleServicioEmpresaId, 'InmuebleServicioInmuebleId':info.InmuebleServicioInmuebleId, 'InmuebleServicioServicioId':info.InmuebleServicioServicioId, 'InmuebleServicioMonto':info.InmuebleServicioMonto, 'InmuebleServicioCuota':info.InmuebleServicioCuota, 'InmuebleServicioSaldo':info.InmuebleServicioSaldo, 'InmuebleServicioFechaInicio':info.InmuebleServicioFechaInicio, 'InmuebleServicioActivo':info.InmuebleServicioActivo}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 5:07:04   <<<<<<< 
