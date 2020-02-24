var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Lista de contamovidetalle';
    $scope.form_btnNuevo = 'Nuevo registroMv';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registroMvs';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_moviConImpTipo70 = 'IVA';
    $scope.form_moviConImpTipo71 = 'ICA';
    $scope.form_moviConImpTipo72 = 'RETE IVA';
    $scope.form_moviConImpTipo73 = 'RETE ICA';

    $scope.form_moviConId = 'ID';
    $scope.form_moviConCabezaId = 'CABEZA';
    $scope.form_moviConDetalle = 'DETALLE';
    $scope.form_moviConCuenta = 'CUENTA';
    $scope.form_moviConDebito = 'VALOR DEBITO';
    $scope.form_moviConCredito = 'VALOR CREDITO';
    $scope.form_moviConBase = 'BASE';
    $scope.form_moviConImpTipo = 'IMPUESTO/RETENCION';
    $scope.form_moviConImpPorc = ' PORCENTAJE ';
    $scope.form_moviConImpValor = ' VALOR ';
    $scope.form_moviConIdTercero = 'IDTERCERO';
    $scope.form_moviDocum1 = 'MOVIDOCUM1';
    $scope.form_moviDocum2 = 'MOVIDOCUM2';

    $scope.form_PhmoviConId = 'Digite id';
    $scope.form_PhmoviConCabezaId = 'Digite cabeza';
    $scope.form_PhmoviConDetalle = 'Digite detalle';
    $scope.form_PhmoviConCuenta = 'Digite cuenta';
    $scope.form_PhmoviConDebito = 'Digite valor debito';
    $scope.form_PhmoviConCredito = 'Digite valor credito';
    $scope.form_PhmoviConBase = 'Digite base';
    $scope.form_PhmoviConImpTipo = 'Digite tipo impuesto';
    $scope.form_PhmoviConImpPorc = 'Digite impuesto %';
    $scope.form_PhmoviConImpValor = 'Digite impuesto valor';
    $scope.form_PhmoviConIdTercero = 'Digite idtercero';
    $scope.form_PhmoviDocum1 = 'Digite movidocum1';
    $scope.form_PhmoviDocum2 = 'Digite movidocum2';
   
    $scope.currentPageMv = 0;
    $scope.pageSizeMv = 10;
    $scope.pages = [];
    $scope.registroMv = [];
    $scope.empresa = $('#e').val();
    var defaultForm= {   
        moviConId:0,
        moviConCabezaId:0,
        moviConDetalle:' ',
        moviConCuenta:'',
        moviConDebito:'',
        moviConCredito:'',
        moviConBase:0,
        moviConImpTipo:'',
        moviConImpPorc:0,
        moviConImpValor:0,
        moviConIdTercero:0,
        moviDocum1:'',
        moviDocum2:''
   };
    
    getCombos($scope.empresa);
    
    getInfoMv($scope.empresa);
    
    function getInfoMv(empresa){
        $http.post('modulos/mod_contamovidetalle.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.detailsMv = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
          $http.post('modulos/mod_contamovidetalle.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
         $scope.operators2 = data;
         });
          $http.post('modulos/mod_contamovidetalle.php?op=1',{'op':'1', 'empresa':empresa}).success(function(data){
         $scope.operators3 = data;
         });
    } 
 
    $scope.configPages = function() {
        $scope.pages.length = 0;
        var ini = $scope.currentPageMv - 4;
        var fin = $scope.currentPageMv + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.detailMvMvs.length / $scope.pageSizeMv) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.detailMvMvs.length / $scope.pageSizeMv);
        }
        else {
            if (ini >= Math.ceil($scope.detailMvMvs.length / $scope.pageSizeMv) - 10) {
                ini = Math.ceil($scope.detailMvMvs.length / $scope.pageSizeMv) - 10;
                fin = Math.ceil($scope.detailMvMvs.length / $scope.pageSizeMv);
            }
        }
        if (ini < 1) ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pages.push({no: i});
        }

        if ($scope.currentPageMv >= $scope.pages.length)
            $scope.currentPageMv = $scope.pages.length - 1;
    };

    $scope.setPage = function(index) {
        $scope.currentPageMv = index - 1;
    };

 
// Function to add toggle behaviour to form
$scope.formToggleMv =function(){
$('#idForm').slideToggle();
$scope.moviConId=0;
$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggleMv =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registroMv = angular.copy(defaultForm);

};

    
    $scope.editInfoMv =function(info)
    {  
        $scope.registroMv =  info;  
        $('#idForm').slideToggle();

    };

$scope.exporta = function(){
    valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
   if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_contamovidetalle.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfoMv =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registroMv con nombre : '+info.moviConCuenta+' ?')) {  
            $http.post('modulos/mod_contamovidetalle.php?op=b',{'op':'b', 'moviConId':info.moviConId}).success(function(data){
            if (data === 'Ok') {
            getInfoMv(empresa);
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfoMv =function(info)
    {
        er='';
        empresa = $('\#e').val(); 
        if($('#moviConId').val()===''){er+='falta id\n';}
        if($('#moviConCabezaId').val()===''){er+='falta cabeza\n';}
        if($('#moviConDetalle').val()===''){er+='falta detalle\n';}
        if($('#moviConCuenta').val()===''){er+='falta cuenta\n';}
        if($('#moviConDebito').val()===''){er+='falta valor debito\n';}
        if($('#moviConCredito').val()===''){er+='falta valor credito\n';}
        if($('#moviConBase').val()===''){er+='falta base\n';}
        if($('#moviConImpTipo').val()===''){er+='falta tipo impuesto\n';}
        if($('#moviConImpPorc').val()===''){er+='falta impuesto %\n';}
        if($('#moviConImpValor').val()===''){er+='falta impuesto valor\n';}

        if (er==''){
        $http.post('modulos/mod_contamovidetalle.php?op=a',{'op':'a', 'moviConId':info.moviConId, 'moviConCabezaId':info.moviConCabezaId, 'moviConDetalle':info.moviConDetalle, 'moviConCuenta':info.moviConCuenta, 'moviConDebito':info.moviConDebito, 'moviConCredito':info.moviConCredito, 'moviConBase':info.moviConBase, 'moviConImpTipo':info.moviConImpTipo, 'moviConImpPorc':info.moviConImpPorc, 'moviConImpValor':info.moviConImpValor, 'moviConIdTercero':info.moviConIdTercero, 'moviDocum1':info.moviDocum1, 'moviDocum2':info.moviDocum2}).success(function(data){
        if (data === 'Ok') {
            getInfoMv(empresa);
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfoMv =function(info)
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 10:35:06   <<<<<<< 
