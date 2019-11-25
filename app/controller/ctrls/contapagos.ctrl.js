var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Anticipos (Abonos anticipados)';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_pagosTipoPago90 = 'En Efectivo';
    $scope.form_pagosTipoPago91 = 'Transferencia';
    $scope.form_pagosTipoPago92 = 'Consignación';

    $scope.form_pagosid = 'ID';
    $scope.form_pagosempresa = 'EMPRESA';
    $scope.form_pagosfacturaid = 'FACTURAID';
    $scope.form_pagosfecha = 'FECHA';
    $scope.form_pagostipo = 'TIPO';
    $scope.form_pagosvalor = 'VALOR';
    $scope.form_pagosreferencia = 'REFERENCIA';
    $scope.form_pagosNrReciCaja = 'RECIBO CAJA';
    $scope.form_pagosinmueble = 'INMUEBLE';
    $scope.form_pagosTipoPago = 'FORMA PAGO';
    $scope.form_pagosPeriodoPago = 'PERIODO';

    $scope.form_Phpagosid = 'Digite id';
    $scope.form_Phpagosempresa = 'Digite empresa';
    $scope.form_Phpagosfacturaid = 'Digite facturaid';
    $scope.form_Phpagosfecha = 'Digite fecha';
    $scope.form_Phpagostipo = 'Digite tipo';
    $scope.form_Phpagosvalor = 'Digite valor';
    $scope.form_Phpagosreferencia = 'Digite referencia';
    $scope.form_PhpagosNrReciCaja = 'Digite Nro Recibo';
    $scope.form_Phpagosinmueble = 'Digite inmueble';
    $scope.form_PhpagosTipoPago = 'Digite tipopago';
    $scope.form_PhpagosPeriodoPago = 'periodo anticipo';
   
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    var defaultForm= {   
        pagosid:0,
        pagosempresa:$scope.empresa,
        pagosfacturaid:0,
        pagosfecha:'',
        pagostipo:'T',
        pagosvalor:'',
        pagosreferencia:'',
        pagosNrReciCaja:'',
        pagosinmueble:0,
        pagosTipoPago:'',
        pagosPeriodoPago:''
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contapagos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
        $http.post('modulos/mod_contapagos.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
            alert(data);
        $scope.operators0 = data;
        });
        getInfoRcaja(empresa)
    } 
    
    $scope.formaPago = function(){
        forma=$scope.registro.pagosTipoPago;
        switch(forma) {
        case 'E':
          $scope.registro.pagosreferencia='Pago en efectivo ';
          break;
        case 'T':
          $scope.registro.pagosreferencia='Trasferencia de ';
          break;
        case 'C':
          $scope.registro.pagosreferencia='Cheque Nr. ';
          break;
        default:
            $scope.registro.pagosreferencia='';
        }
    };
    
    function getInfoRcaja(empresa){
        mes = ['31', '28', '31','30','31','30','31','31','30','31','30','31' ];
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        $scope.periodo = rec[12];
        $scope.consecRC = rec[13];
        m=rec[12].substring(4, 6)-1;
        $scope.fchPago = rec[12].substring(0, 4)+'-'+rec[12].substring(4, 6)+'-'+mes[m];
        $scope.registro.fechaAbono = $scope.fchPago;   
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
    $scope.pagosid=0;
    $('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
    $('#idForm').slideToggle();
    $scope.formato.$setPristine();
    $scope.registro = angular.copy(defaultForm);
    $scope.registro.pagosfecha = $scope.fchPago;
    $scope.registro.pagosNrReciCaja = $scope.consecRC+1;
    $scope.registro.pagosPeriodoPago = $scope.periodo;

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
        $http.post('modulos/mod_contapagos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.pagosPeriodoPago+' ?')) {  
            $http.post('modulos/mod_contapagos.php?op=b',{'op':'b', 'pagosid':info.pagosid}).success(function(data){
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
        if($('#pagosid').val()===''){er+='falta id\n';}
        if($('#pagosempresa').val()===''){er+='falta empresa\n';}
        if($('#pagosfacturaid').val()===''){er+='falta facturaid\n';}
        if($('#pagosfecha').val()===''){er+='falta fecha\n';}
        if($('#pagostipo').val()===''){er+='falta tipo\n';}
        if($('#pagosvalor').val()===''){er+='falta valor\n';}
        if($('#pagosreferencia').val()===''){er+='falta referencia\n';}
        if($('#pagosNrReciCaja').val()===''){er+='falta nrrecicaja\n';}
        if($('#pagosinmueble').val()===''){er+='falta inmueble\n';}
        if($('#pagosTipoPago').val()===''){er+='falta tipopago\n';}
        if($('#pagosPeriodoPago').val()===''){er+='falta periodopago\n';}
        if (er==''){
        $http.post('modulos/mod_contapagos.php?op=a',{'op':'a', 'pagosid':info.pagosid, 'pagosempresa':info.pagosempresa, 'pagosfacturaid':info.pagosfacturaid, 'pagosfecha':info.pagosfecha, 'pagostipo':info.pagostipo, 'pagosvalor':info.pagosvalor, 'pagosreferencia':info.pagosreferencia, 'pagosNrReciCaja':info.pagosNrReciCaja, 'pagosinmueble':info.pagosinmueble, 'pagosTipoPago':info.pagosTipoPago, 'pagosPeriodoPago':info.pagosPeriodoPago}).success(function(data){
        if (data === 'Ok') {
            getInfo(empresa);
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }
        });
        $scope.info = $scope.defaultForm;
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Nov 22, 2019 7:28:35   <<<<<<< 
