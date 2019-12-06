var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Acuerdos de pago';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 

    $scope.form_acuerdoid = 'ID';
    $scope.form_acuerdoempresa = 'EMPRESA';
    $scope.form_acuerdoinmueble = 'INMUEBLE';
    $scope.form_acuerdofecha = 'FECHA';
    $scope.form_acuerdovalor = 'VALOR';
    $scope.form_acuerdoplazo = 'PLAZO';
    $scope.form_acuerdodetalle = 'DETALLE';
    $scope.form_acuerdopropietario = 'PROPIETARIO';

    $scope.form_Phacuerdoid = 'Digite id';
    $scope.form_Phacuerdoempresa = 'Digite empresa';
    $scope.form_Phacuerdoinmueble = 'Digite inmueble';
    $scope.form_Phacuerdofecha = 'Digite fecha';
    $scope.form_Phacuerdovalor = 'Digite valor';
    $scope.form_Phacuerdoplazo = 'Digite plazo';
    $scope.form_Phacuerdodetalle = 'Digite detalle';
    $scope.form_Phacuerdopropietario = 'Digite propietario';
    $scope.form_enMora = 'Saldo en mora';
    $scope.form_corriente = 'Saldo corriente';
    $scope.form_vlrTotal = 'Total deuda';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
     
    var defaultForm= {
   
        acuerdoid:0,
        acuerdoempresa:$scope.empresa,
        acuerdoinmueble:0,
        acuerdofecha:'',
        acuerdovalor:'',
        acuerdoplazo:0,
        acuerdodetalle:'',
        acuerdopropietario:0
   };
    
    getCombos();
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contaacuerdos.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
          $http.post('modulos/mod_contaacuerdos.php?op=0',{'op':'0'}).success(function(data){
         $scope.operators0 = data;
         });
          $http.post('modulos/mod_contaacuerdos.php?op=1',{'op':'1'}).success(function(data){
         $scope.operators1 = data;
         });
    } 
    
    function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
            (j ? i.substr(0, j) + thouSep : "") +
            i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
            (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }
    
    $scope.buscaacuer2 = function(detail){
        empresa=$scope.empresa;
        inmueble = $scope.registro.acuerdoinmueble;
        propietario = $scope.registro.acuerdopropietario;
        if (inmueble === undefined){inmueble=0;}
        if (propietario === undefined) {propietario=0;}
        $http.post('modulos/mod_contaprocesos.php?op=acuer2',{'op':'acuer2','empresa':empresa,'inmueble':inmueble,
        'propietario':propietario}).success(function(data){
        rec=data.split('||');
        mo=0;
        co=0;
        an=0;
        if(rec[0]!==''){mo=rec[0];}
        $scope.enMora = formatMoney(mo, 2, '.', ','); 
        if(rec[1]!==''){co=rec[1];}
        if(rec[2]!==''){an=rec[2];}
        co = co - an;
        t = parseInt(mo)+parseInt(co);
       
        $scope.corriente = formatMoney(co, 2, '.', ',');
        $scope.vlrTotal = formatMoney(t, 2, '.', ',');
         });
    };
     
    
 
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
$scope.acuerdoid=0;
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
        $http.post('modulos/mod_contaacuerdos.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.acuerdofecha+' ?')) {  
            $http.post('modulos/mod_contaacuerdos.php?op=b',{'op':'b', 'acuerdoid':info.acuerdoid}).success(function(data){
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
        if($('#acuerdoid').val()===''){er+='falta id\n';}
        if($('#acuerdoempresa').val()===''){er+='falta empresa\n';}
        if($('#acuerdoinmueble').val()===''){er+='falta inmueble\n';}
        if($('#acuerdofecha').val()===''){er+='falta fecha\n';}
        if($('#acuerdovalor').val()===''){er+='falta valor\n';}
        if($('#acuerdoplazo').val()===''){er+='falta plazo\n';}
        if($('#acuerdoplazo').val()<=0){er+='El plazo debe ser mayor a 0\n';}
        if($('#acuerdodetalle').val()===''){er+='falta detalle\n';}
        if($('#acuerdopropietario').val()===''){er+='falta propietario\n';}
        if (er==''){
        $http.post('modulos/mod_contaacuerdos.php?op=a',{'op':'a', 'acuerdoid':info.acuerdoid, 'acuerdoempresa':info.acuerdoempresa, 'acuerdoinmueble':info.acuerdoinmueble, 'acuerdofecha':info.acuerdofecha, 'acuerdovalor':info.acuerdovalor, 'acuerdoplazo':info.acuerdoplazo, 'acuerdodetalle':info.acuerdodetalle, 'acuerdopropietario':info.acuerdopropietario}).success(function(data){
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Dec 06, 2019 12:48:39   <<<<<<< 
