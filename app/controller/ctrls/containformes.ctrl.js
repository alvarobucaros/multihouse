var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Estructura de Informes';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnContinua = 'Continuar';
    $scope.form_btnRenumera = 'Renumera';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
    $scope.form_periodo ='Ultimo período';
    $scope.form_intoTipo40 = 'Título';
    $scope.form_intoTipo41 = 'Cuenta Contable';
    $scope.form_intoTipo42 = 'Resumen';
    $scope.form_intoTipo43 = 'Cambio Pag';
    $scope.form_infoIndenta120 = 2;
    $scope.form_infoIndenta121 = 4;
    $scope.form_infoIndenta122 = 6;
    $scope.form_infoIndenta123 = 8;
    $scope.form_infoNuevaPagina130 = 'Si';
    $scope.form_infoNuevaPagina131 = 'No';
    $scope.form_infoMultiplicador140 = 'Suma';
    $scope.form_infoMultiplicador141 = 'Resta';

    $scope.form_infoId = 'ID';
    $scope.form_infoEmpresa = 'EMPRESA';
    $scope.form_infoReporte = 'REPORTE';
    $scope.form_infoLinea = 'SECUENCIA LINEA';
    $scope.form_intoTipo = 'TIPO LINEA';
    $scope.form_infoCodigo = 'CODIGO';
    $scope.form_infoNombre = 'NOMBRE';
    $scope.form_infoCuentasIN = 'CUENTAS INCLUYE';
    $scope.form_infoCuentasOUT = 'CUENTAS EXCLUYE';
    $scope.form_infoFormula = 'FORMULA';
    $scope.form_infoNro = 'NRO';
    $scope.form_infoNotas = 'NRO NOTA CONTABLE';
    $scope.form_infoIndenta = 'INDENTA';
    $scope.form_infoNuevaPagina = 'NUEVA PAGINA';
    $scope.form_infoMultiplicador = 'MULTIPLICADOR';

    $scope.form_PhinfoId = 'Digite id';
    $scope.form_PhinfoEmpresa = 'Digite empresa';
    $scope.form_PhinfoReporte = 'Digite reporte';
    $scope.form_PhinfoLinea = 'Digite linea';
    $scope.form_PhintoTipo = 'Digite intotipo';
    $scope.form_PhinfoCodigo = 'Digite codigo';
    $scope.form_PhinfoNombre = 'Digite nombre';
    $scope.form_PhinfoCuentasIN = 'Digite cuentasin';
    $scope.form_PhinfoCuentasOUT = 'Digite cuentasout';
    $scope.form_PhinfoFormula = 'Digite formula';
    $scope.form_PhinfoNro = 'Digite nro';
    $scope.form_PhinfoNotas = 'Digite notas';
    $scope.form_PhinfoIndenta = 'Digite indenta';
    $scope.form_PhinfoNuevaPagina = 'Digite nuevapagina';
    $scope.form_PhinfoMultiplicador = 'Digite multiplicador';

     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
     $scope.rueda = true;
     $scope.toma = true;
     $scope.lista = '';
     
    var defaultForm= {   
        infoId:0,
        infoEmpresa: $scope.empresa,
        infoReporte: $scope.lista,
        infoLinea:'',
        intoTipo:'T',
        infoCodigo:'',
        infoNombre:'',
        infoCuentasIN:'',
        infoCuentasOUT:'',
        infoFormula:'',
        infoNro:0,
        infoNotas:'',
        infoIndenta:2,
        infoNuevaPagina:'N',
        infoMultiplicador:0
   };
    
    getCombos($scope.empresa);
        
    function getInfo(empresa, lista){
        $http.post('modulos/mod_containformes.php?op=r',{'op':'r', 'empresa':empresa,'lista':lista}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
        $http.post('modulos/mod_containformes.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
        $scope.operators0 = data;
        $scope.operators1 = data;
        });
    } 
    
       
    $scope.tomaLaLista = function(){
        lista = $scope.listaPpal;
        $scope.lista = lista;
        getInfo($scope.empresa, lista);
        $scope.toma = false;
        $scope.registro.infoReporte = lista;
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
$scope.infoId=0;
$('#idForm').css('display', 'none');

};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.formato.$setPristine();
$scope.registro = angular.copy(defaultForm);

$scope.registro.infoReporte = $scope.lista

};

    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();

    };

    $scope.renumera = function(){
        $scope.rueda = false;
        empresa = $('#e').val();        
        dato = empresa+','+$scope.lista;
        valor = confirm("La renumeración altera los campos de línea, código y fórmula, Realmente desea ejecutar este cambio ?");
        if (valor == true) {
            $('#rueda').show();
            $http.post('modulos/mod_containformes.php?op=rn',{'op':'rn','dato':dato}).success(function(data){
            getInfo(empresa, $scope.lista);
            alert (data);
            });       
        } 
        $scope.rueda = true;
    };

    $scope.exporta = function(){
        valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
       if (valor === true) {
            empresa = $('#e').val();
            $http.post('modulos/mod_containformes.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
           $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        }); 
       }  
    };
    

    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        lista = $scope.listaPpal;
        if (confirm('Desea borrar el registro con nombre : '+info.infoNombre+' En la linea ' + info.infoLinea+' ?')) {  
            $http.post('modulos/mod_containformes.php?op=b',{'op':'b', 'infoId':info.infoId}).success(function(data){
            if (data === 'Ok') {
            getInfo(empresa, lista);
            alert ('Registro Borrado ');
            }
            });
         }
    };
    

    
    $scope.updateInfo =function(info)
    {
        er='';
        empresa = $('\#e').val(); 
        lista = info.infoReporte;
        if($('#infoId').val()===''){er+='falta id\n';}
        if($('#infoEmpresa').val()===''){er+='falta empresa\n';}
        if($('#infoReporte').val()===''){er+='falta reporte\n';}
        if($('#infoLinea').val()===''){er+='falta linea\n';}
        if($('#intoTipo').val()===''){er+='falta intotipo\n';}
      //  if($('#infoCodigo').val()===''){er+='falta codigo\n';}
        if($('#infoNombre').val()===''){er+='falta nombre\n';}
        if(info.intoTipo === 'C'){
            if(info.infoCuentasIN ==='' && info.infoCuentasOUT === ''){er+='falta cuenta incluye y/o excluye\n';}
        }
        if(info.intoTipo === 'R'){
            if($('#infoFormula').val()===''){er+='falta formula\n';}
        }
       // if($('#infoNro').val()===''){er+='falta nro\n';}
       // if($('#infoNotas').val()===''){er+='falta notas\n';}
        if($('#infoIndenta').val()===''){er+='falta indenta\n';}
        if($('#infoNuevaPagina').val()===''){er+='falta nuevapagina\n';}
        if($('#infoMultiplicador').val()===''){er+='falta multiplicador\n';}
        if (er===''){
            if (er===''){
                info.infoCodigo = 'L'+info.infoLinea; 
                $http.post('modulos/mod_containformes.php?op=a',{'op':'a', 'infoId':info.infoId, 'infoEmpresa':info.infoEmpresa, 'infoReporte':info.infoReporte, 'infoLinea':info.infoLinea, 'intoTipo':info.intoTipo, 'infoCodigo':info.infoCodigo, 'infoNombre':info.infoNombre, 'infoCuentasIN':info.infoCuentasIN, 'infoCuentasOUT':info.infoCuentasOUT, 'infoFormula':info.infoFormula, 'infoNro':info.infoNro, 'infoNotas':info.infoNotas, 'infoIndenta':info.infoIndenta, 'infoNuevaPagina':info.infoNuevaPagina, 'infoMultiplicador':info.infoMultiplicador}).success(function(data){
                if (data === 'Ok') {
                    getInfo(empresa,lista);
                    alert ('Registro Actualizado ');
                    $('#idForm').slideToggle();
                }
                });
            }else{alert (er);} 
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Mar 09, 2020 8:33:07   <<<<<<< 
