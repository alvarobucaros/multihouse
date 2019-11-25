var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de Servicios';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta'; 
    $scope.form_ServicioTipo90 = 'Cobro';
    $scope.form_ServicioTipo91 = 'Pago';
    $scope.form_ServicioMora100 = 'Si';
    $scope.form_ServicioMora101 = 'No';
    $scope.form_ServicioActivo170 = 'SI';
    $scope.form_ServicioActivo171 = 'NO';
    $scope.form_ServicioAmbito180 = 'A Todos';
    $scope.form_ServicioAmbito181 = 'A un Grupo';
    $scope.prioridad = {model: null,
    availableOptions: [
            {prioridad:'1', detalle:'Alta'},
            {prioridad:'2', detalle:'Media'},
            {prioridad:'3', detalle:'Baja'}]}
    $scope.form_ServicioId = 'ID';
    $scope.form_servicioEmpresaId = 'EMPRESA';
    $scope.form_ServicioCodigo = 'CODIGO';
    $scope.form_ServicioDetalle = 'DETALLE';
    $scope.form_ServicioPeriodo = 'PERIODO';
    $scope.form_ServicioFechaDesde = 'FECHA DESDE';
    $scope.form_ServicioFechaHasta = 'FECHA HASTA';
    $scope.form_ServicioValor = 'VALOR';
    $scope.form_ServicioPrioridad = 'PRIORIDAD';
    $scope.form_ServicioTipo = 'TIPO';
    $scope.form_ServicioMora = 'MORA';
    $scope.form_ServicioMoraPorcentaje = '% MORA';
    $scope.form_servicioMoraValor = 'VALOR MORA';
    $scope.form_ServicioCuentaDB = 'CUENTA DB';
    $scope.form_ServicioCuentaCR = 'CUENTA CR';
    $scope.form_ServicioPPporcentaje = '% PRONTO PAGO';
    $scope.form_ServicioPPvalor = '$ PRONTO PAGO';
    $scope.form_ServicioActivo = 'ACTIVO';
    $scope.form_ServicioAmbito = 'AMBITO';
    $scope.form_servicioClasificacionId = 'CLASIFICACION';

    $scope.form_PhServicioId = 'Digite id';
    $scope.form_PhservicioEmpresaId = 'Digite empresa';
    $scope.form_PhServicioCodigo = 'Digite codigo';
    $scope.form_PhServicioDetalle = 'Digite detalle';
    $scope.form_PhServicioPeriodo = 'Digite periodo';
    $scope.form_PhServicioFechaDesde = 'Digite fecha desde';
    $scope.form_PhServicioFechaHasta = 'Digite fecha hasta';
    $scope.form_PhServicioValor = 'Digite valor';
    $scope.form_PhServicioPrioridad = 'Digite prioridad';
    $scope.form_PhServicioTipo = 'Digite tipo';
    $scope.form_PhServicioMora = 'Digite mora';
    $scope.form_PhServicioMoraPorcentaje = 'Digite % mora';
    $scope.form_PhservicioMoraValor = 'Digite valor mora';
    $scope.form_PhServicioCuentaDB = 'Digite cuenta db';
    $scope.form_PhServicioCuentaCR = 'Digite cuenta cr';
    $scope.form_PhServicioPPporcentaje = 'Digite % pronto pago';
    $scope.form_PhServicioPPvalor = 'Digite $ pronto pago';
    $scope.form_PhServicioActivo = 'Digite activo';
    $scope.form_PhServicioAmbito = 'Digite ambito';
    $scope.form_PhservicioClasificacionId = 'Digite clasificacion';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        ServicioId:0,
        servicioEmpresaId:$scope.empresa,
        ServicioCodigo:'',
        ServicioDetalle:'',
        ServicioPeriodo:'',
        ServicioFechaDesde:'',
        ServicioFechaHasta:'',
        ServicioValor:'',
        ServicioPrioridad: 1,
        ServicioTipo:'C',
        ServicioMora:'S',
        ServicioMoraPorcentaje:'0.0',
        servicioMoraValor:'0',
        ServicioCuentaDB:'',
        ServicioCuentaCR:'',
        ServicioPPporcentaje:'0.0',
        ServicioPPvalor:'0',
        ServicioActivo:'A',
        ServicioAmbito:'T',
        servicioClasificacionId:0
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contaservicios.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
        $http.post('modulos/mod_contaservicios.php?op=1',{'op':'1', 'empresa':empresa}).success(function(data){
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

 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.ServicioId=0;
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
        $http.post('modulos/mod_contaservicios.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}

$scope.deleteInfo =function(info)
{ 
    empresa = $('\#e').val(); 
    if (confirm('Desea borrar el registro con nombre : '+info.ServicioDetalle+' ?')) {  
        $http.post('modulos/mod_contaservicios.php?op=b',{'op':'b', 'ServicioId':info.ServicioId}).success(function(data){
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
        periodo=$('#ServicioFechaDesde').val().substring(0, 4);
        $('#ServicioPeriodo').val(periodo)
        if($('#ServicioId').val()===''){er+='falta id\n';}
        if($('#servicioEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#ServicioCodigo').val()===''){er+='falta codigo\n';}
        if($('#ServicioDetalle').val()===''){er+='falta detalle\n';}
        if($('#ServicioPeriodo').val()===''){er+='falta periodo\n';}
        if($('#ServicioFechaDesde').val()===''){er+='falta fecha desde\n';}
        if($('#ServicioFechaHasta').val()===''){er+='falta fecha hasta\n';}
        if($('#ServicioValor').val()===''){er+='falta valor\n';}
        if($('#ServicioPrioridad').val()===''){er+='falta prioridad\n';}
        if($('#ServicioTipo').val()===''){er+='falta tipo\n';}
        if($('#ServicioMora').val()===''){er+='falta mora\n';}
        if($('#ServicioMoraPorcentaje').val()===''){er+='falta % mora\n';}
        if($('#servicioMoraValor').val()===''){er+='falta valor mora\n';}
        if($('#ServicioCuentaDB').val()===''){er+='falta cuenta db\n';}
        if($('#ServicioCuentaCR').val()===''){er+='falta cuenta cr\n';}
        if($('#ServicioPPporcentaje').val()===''){er+='falta % pronto pago\n';}
        if($('#ServicioPPvalor').val()===''){er+='falta $ pronto pago\n';}
        if($('#ServicioActivo').val()===''){er+='falta activo\n';}
        if($('#ServicioAmbito').val()===''){er+='falta ambito\n';}
        if($('#servicioClasificacionId').val()===''){er+='falta clasificacion\n';}
        if (er==''){
        $http.post('modulos/mod_contaservicios.php?op=a',{'op':'a', 'ServicioId':info.ServicioId, 'servicioEmpresaId':info.servicioEmpresaId, 'ServicioCodigo':info.ServicioCodigo, 'ServicioDetalle':info.ServicioDetalle, 'ServicioPeriodo':periodo, 'ServicioFechaDesde':info.ServicioFechaDesde, 'ServicioFechaHasta':info.ServicioFechaHasta, 'ServicioValor':info.ServicioValor, 'ServicioPrioridad':info.ServicioPrioridad, 'ServicioTipo':info.ServicioTipo, 'ServicioMora':info.ServicioMora, 'ServicioMoraPorcentaje':info.ServicioMoraPorcentaje, 'servicioMoraValor':info.servicioMoraValor, 'ServicioCuentaDB':info.ServicioCuentaDB, 'ServicioCuentaCR':info.ServicioCuentaCR, 'ServicioPPporcentaje':info.ServicioPPporcentaje, 'ServicioPPvalor':info.ServicioPPvalor, 'ServicioActivo':info.ServicioActivo, 'ServicioAmbito':info.ServicioAmbito, 'servicioClasificacionId':info.servicioClasificacionId}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,Sep 05, 2019 8:27:23   <<<<<<< 
