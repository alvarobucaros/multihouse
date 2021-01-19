var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Comprobantes y Operaciones';
    $scope.form_title2 = "Tipo de Ingresos y Gastos";
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnCta = 'Cta';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_compTipo30 = 'Comprobante';
    $scope.form_compTipo31 = 'Operaciones';
    $scope.form_compActivo130 = 'Activo';
    $scope.form_compActivo131 = 'Inactivo';

    $scope.form_compId = 'ID';
    $scope.form_compEmpresaId = 'EMPRESA';
    $scope.form_compCodigo = 'CODIGO';
    $scope.form_compTipo = 'TIPO';
    $scope.form_compNombre = 'NOMBRE';
    $scope.form_compDetalle = 'DETALLE';
    $scope.form_compcpbnte = 'COMPROBANTE';
    $scope.form_compConsecutivo = 'SECUENCIA';
    $scope.form_compctadb0 = 'CUENTA DB';
    $scope.form_compctadb1 = 'CUENTA DB';
    $scope.form_compctadb2 = 'CUENTA DB';
    $scope.form_compctacr0 = 'CUENTA CR';
    $scope.form_compctacr1 = 'CUENTA CR';
    $scope.form_compctacr2 = 'CUENTA CR';
    $scope.form_compActivo = 'ACTIVO';
    $scope.form_moviConCuenta = "CUAL CUENTA ?"
    $scope.form_PhcompId = 'Digite id';
    $scope.form_PhcompEmpresaId = 'Digite empresa';
    $scope.form_PhcompCodigo = 'Digite codigo';
    $scope.form_PhcompTipo = 'Digite tipo';
    $scope.form_PhcompNombre = 'Digite nombre';
    $scope.form_PhcompDetalle = 'Digite detalle';
    $scope.form_PhcompConsecutivo = 'Digite secuencia';
    $scope.form_Phcompctadb0 = 'Digite ctadb0';
    $scope.form_Phcompctadb1 = 'Digite ctadb1';
    $scope.form_Phcompctadb2 = 'Digite ctadb2';
    $scope.form_Phcompctacr0 = 'Digite ctacr0';
    $scope.form_Phcompctacr1 = 'Digite ctacr1';
    $scope.form_Phcompctacr2 = 'Digite ctacr2';
    $scope.form_PhcompActivo = 'Digite activo';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
     $scope.control =  $('#control').val();
     $scope.movto=false;
     $scope.cualCta=false;
     
    var defaultForm= {
   
        compId:0,
        compEmpresaId:$scope.empresa,
        compCodigo:'',
        compTipo:'C',
        compNombre:'',
        compDetalle:'',
        compConsecutivo:0,
        compctadb0:'',
        compctadb1:'',
        compctadb2:'',
        compctacr0:'',
        compctacr1:'',
        compctacr2:'',
        compActivo:'A'
   };
    
    control = $scope.control;
    
    getInfo($scope.empresa);
    
    getCombos($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contacomprobantes.php?op=r',{'op':'r', 'empresa':empresa,'control':control}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(empresa){
        ctrl=$scope.control;
        $http.post('modulos/mod_contamovicabeza.php?op=0',{'op':'0','empresa':empresa,'control':ctrl}).success(function(data){
        $scope.operators5 = data;
        });
        $http.post('modulos/mod_contamovicabeza.php?op=2',{'op':'2','empresa':empresa}).success(function(data){
        $scope.operators0 = data;
        });
        $http.post('modulos/mod_contamovicabeza.php?op=2',{'op':'2','empresa':empresa, 'control':ctrl}).success(function(data){
        $scope.operators2 = data;
        });
    }
    
    $scope.abreCta = function(cta){
        $scope.buscaCta = cta
        $scope.cualCta=true;
    };
 
    $scope.buscaCuenta = function(){
        i=$scope.buscaCta;
        resultado = $scope.operators2.find(plan => plan.pucCuenta === $scope.CuentaCtble);
    //    alert($scope.buscaCta+' '+resultado.pucCuenta);
        switch (i) {
            case 1:
                $scope.registro.compctadb0 = resultado.pucCuenta;
                $scope.nomCuentadb0 = resultado.pucNombre;
                break;
            case 2:
                $scope.registro.compctadb1 = resultado.pucCuenta;
                $scope.nomCuentadb1 = resultado.pucNombre;
                break;
            case 3:
                $scope.registro.compctadb2 = resultado.pucCuenta;
                $scope.nomCuentadb2 = resultado.pucNombre;
                break;
            case 4:
                $scope.registro.compctacr0 = resultado.pucCuenta;
                $scope.nomCuentacr0 = resultado.pucNombre;
                break; 
            case 5:
                $scope.registro.compctacr1 = resultado.pucCuenta;
                $scope.nomCuentacr1 = resultado.pucNombre;
                break;  
            case 6:
                $scope.registro.compctacr2 = resultado.pucCuenta;
                $scope.nomCuentacr2 = resultado.pucNombre;
                break;                 
        }
        $scope.cualCta=false;
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

    $scope.cambiaTipo = function(){
        if($scope.registro.compTipo==='O'){
            $scope.movto=true;
        }else{
            $scope.movto=false;
        };
    }
    
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.compId=0;
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
        $scope.movto=false;
        empresa = $('#e').val();
        if(info.compTipo==='O'){
            $scope.movto=true;
            dato=info.compctadb0+'||'+info.compctadb1+'||'+info.compctadb2+'||'+info.compctacr0+'||'+
                    info.compctacr1+'||'+info.compctacr2+' ';
            $http.post('modulos/mod_contacomprobantes.php?op=tc',{'op':'tc', 'empresa':empresa,'dato':dato}).success(function(data){
            $rec=data.split('||'); 
            $scope.nomCuentadb0 = $rec[0];  
            $scope.nomCuentadb1 = $rec[1];
            $scope.nomCuentadb2 = $rec[2];
            $scope.nomCuentacr0 = $rec[3];
            $scope.nomCuentacr1 = $rec[4];
            $scope.nomCuentacr2 = $rec[5];
            $scope.compcpbnte = info.compCodigo;
            });            
        }
    };

$scope.exporta = function(){
    valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
   if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_contacomprobantes.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.compNombre+' ?')) {  
            $http.post('modulos/mod_contacomprobantes.php?op=b',{'op':'b', 'compId':info.compId}).success(function(data){
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
        if($('#compId').val()===''){er+='falta id\n';}
        if($('#compEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#compCodigo').val()===''){er+='falta codigo\n';}
        if($('#compTipo').val()===''){er+='falta tipo\n';}
        if($('#compNombre').val()===''){er+='falta nombre\n';}
        if($('#compDetalle').val()===''){er+='falta detalle\n';}
        if($('#compConsecutivo').val()===''){er+='falta secuencia\n';}
        if(info.compTipo==='O'){
            if(info.compctacr0==='' && info.compctacr1 === '' & info.compctacr2 === '' && 
                    info.compctadb0==='' && info.compctadb1 === '' & info.compctadb2 === '' ){er+='falta cuenta\n';}
            if(info.compcpbnte === undefined){er+='falta comprobante\n';}
       }
        if($('#compActivo').val()===''){er+='falta activo\n';}
        if (er==''){
        $http.post('modulos/mod_contacomprobantes.php?op=a',{'op':'a', 'compId':info.compId, 
            'compEmpresaId':info.compEmpresaId, 'compCodigo':info.compCodigo, 'compTipo':info.compTipo, 
            'compNombre':info.compNombre, 'compDetalle':info.compDetalle, 'compConsecutivo':info.compConsecutivo, 
            'compctadb0':info.compctadb0, 'compctadb1':info.compctadb1, 'compctadb2':info.compctadb2, 
            'compctacr0':info.compctacr0, 'compctacr1':info.compctacr1, 'compctacr2':info.compctacr2, 
            'compActivo':info.compActivo, 'compcpbnte': info.compcpbnte}).success(function(data){

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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Feb 10, 2020 8:53:04   <<<<<<< 
