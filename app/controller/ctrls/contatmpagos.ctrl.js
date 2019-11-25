var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Pagos Pendientes';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnAplica = 'Aplica Pagos';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_pagoestado60 = 'Pendiente';
    $scope.form_pagoestado61 = 'Aplicado';

    $scope.form_pagoid = 'ID';
    $scope.form_pagoempresa = 'EMPRESA';
    $scope.form_pagocedula = 'CEDULA';
    $scope.form_pagoinmueble = 'INMUEBLE';
    $scope.form_pagofecha = 'FECHA';
    $scope.form_pagovalor = 'VALOR';
    $scope.form_pagoestado = 'ESTADO';
    $scope.form_pagopropietarioid = 'PROPIETARIOID';
    $scope.form_pagoinmuebleid = 'INMUEBLEID';

    $scope.form_Phpagoid = 'Digite id';
    $scope.form_Phpagoempresa = 'Digite empresa';
    $scope.form_Phpagocedula = 'Digite cedula';
    $scope.form_Phpagoinmueble = 'Digite inmueble';
    $scope.form_Phpagofecha = 'Digite fecha';
    $scope.form_Phpagovalor = 'Digite valor';
    $scope.form_Phpagoestado = 'Digite estado';
    $scope.form_Phpagopropietarioid = 'Digite propietarioid';
    $scope.form_Phpagoinmuebleid = 'Digite inmuebleid';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        pagoid:0,
        pagoempresa:$scope.empresa,
        pagocedula:'',
        pagoinmueble:'',
        pagofecha:'',
        pagovalor:0,
        pagoestado:'P',
        pagopropietarioid:0,
        pagoinmuebleid:0
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contatmpagos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
          $http.post('modulos/mod_contatmpagos.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
alert(data);
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

 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.pagoid=0;
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
       if (valor === true) {
            empresa = $('#e').val();
            $http.post('modulos/mod_contatmpagos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
           $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        }); 
       }  
    };

    $scope.aplica = function(){
        alert('aplicar pagos');
    };
    
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.pagocedula+' ?')) {  
            $http.post('modulos/mod_contatmpagos.php?op=b',{'op':'b', 'pagoid':info.pagoid}).success(function(data){
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
        if($('#pagoid').val()===''){er+='falta id\n';}
        if($('#pagoempresa').val()===''){er+='falta empresa\n';}
        if($('#pagocedula').val()===''){er+='falta cedula\n';}
        if($('#pagoinmueble').val()===''){er+='falta inmueble\n';}
        if($('#pagofecha').val()===''){er+='falta fecha\n';}
        if($('#pagovalor').val()===''){er+='falta valor\n';}
        if($('#pagoestado').val()===''){er+='falta estado\n';}
        if($('#pagopropietarioid').val()===''){er+='falta propietarioid\n';}
        if($('#pagoinmuebleid').val()===''){er+='falta inmuebleid\n';}
        if (er===''){
        $http.post('modulos/mod_contatmpagos.php?op=a',{'op':'a', 'pagoid':info.pagoid, 'pagoempresa':info.pagoempresa, 'pagocedula':info.pagocedula, 'pagoinmueble':info.pagoinmueble, 'pagofecha':info.pagofecha, 'pagovalor':info.pagovalor, 'pagoestado':info.pagoestado, 'pagopropietarioid':info.pagopropietarioid, 'pagoinmuebleid':info.pagoinmuebleid}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,Oct 10, 2019 8:48:35   <<<<<<< 
