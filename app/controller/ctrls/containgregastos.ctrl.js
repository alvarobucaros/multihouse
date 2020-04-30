var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Ingresos y Gastos';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnCierre = 'Cierre del periodo';
    $scope.form_btnInforme = 'Informe cuentas';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_ingastotipo40 = 'Ingreso';
    $scope.form_ingastotipo41 = 'Gasto';
    $scope.form_ingastotipo42 = 'Apertura';
    $scope.form_ingastocontabiliza80 = 'Si';
    $scope.form_ingastocontabiliza81 = 'NO';
    $scope.form_ingastotercero = "TERCERO";
    $scope.form_ingastoid = 'ID';
    $scope.form_ingastoempresa = 'EMPRESA';
    $scope.form_ingastoFecha = 'FECHA';
    $scope.form_ingastoperiodo = 'PERIODO';
    $scope.form_ingastotipo = 'TIPO';
    $scope.form_ingastocomprobante = 'MOVIMIENTO';
    $scope.form_ingastodetalle = 'DETALLE';
    $scope.form_ingastovalor = 'VALOR';
    $scope.form_ingastocontabiliza = 'CONTABILIZADO';
    $scope.form_ingastoDocumento = 'DOCUMENTO',
    $scope.form_Phingastoid = 'Digite id';
    $scope.form_Phingastoempresa = 'Digite empresa';
    $scope.form_PhingastoFecha = 'Digite fecha';
    $scope.form_Phingastoperiodo = 'Digite periodo';
    $scope.form_Phingastotipo = 'Digite tipo';
    $scope.form_Phingastocomprobante = 'Digite comprobante';
    $scope.form_Phingastodetalle = 'Digite detalle';
    $scope.form_Phingastovalor = 'Digite valor';
    $scope.form_Phingastocontabiliza = 'Digite contabiliza';
   
    $scope.titulin= '';
    $scope.queOk='';
    $scope.modal = true;
    $scope.form_peridesde='Periodo desde';
    $scope.form_perihasta='Periodo hasta ';
    $scope.valUltiperfac = '';
    $scope.valPreriFact = '';
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.fecha='';
    $scope.periodo = '';
    var defaultForm= {   
        ingastoid:0,
        ingastoempresa:$scope.empresa,
        ingastoFecha:$scope.fecha,
        ingastoperiodo:$scope.periodo,
        ingastotipo:'',
        ingastocomprobante:0,
        ingastodetalle:'',
        ingastoDocumento:'',
        ingastovalor:'',
        ingastocontabiliza:'N'
   };
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        fi='';
        ff='';
        $http.post('modulos/mod_containgregastos.php?op=r',{'op':'r', 'empresa':empresa,'fi':fi,'ff':ff}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });  
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        
        $scope.fecha = rec[2];
        $scope.valUltiperfac = rec[12];
        $scope.periodo = rec[1];
        $scope.valPreriFact = rec[1];
       
        });      
    }

    function getCombos(empresa){
        $http.post('modulos/mod_containgregastos.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
            $scope.operators0 = data;
         });
         
        $http.post('modulos/mod_containgregastos.php?op=1',{'op':'1', 'empresa':empresa}).success(function(data){
            $scope.operators1 = data;
         });
    } 
 
    function avanzaPeriodo(per){
        a=per.substring(0,4);
        m=per.substring(4,6);
        m=parseInt(m)+1;
        if (m>12){a+=1; m=1;}
        np=a;
        if(m<10){np=np+'0';}
        np=np+m;
        return np;
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

    $scope.seleccion = function(){
        $http.post('modulos/mod_containgregastos.php?op=nc',{'op':'nc', 'empresa':$scope.empresa,'comp':$scope.registro.ingastocomprobante}).success(function(data){
            rec = data.split('||');
            $scope.registro.ingastoctadb = rec[0];
            $scope.registro.ingastoctacr = rec[1];
            $scope.registro.ingastocompro  = rec[2];
         });
    };
    
    $scope.cambiaperi = function(){;
        f=$scope.registro.ingastoFecha.substring(0, 4)+$scope.registro.ingastoFecha.substring(5, 7);
        $scope.registro.ingastoperiodo = f;
        $scope.registro.ingastocontabiliza = "N";
    }
 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.ingastoid=0;
$('#idForm').css('display', 'none');
$scope.registro = defaultForm;
};

$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
        $scope.registro.ingastoFecha= $scope.fecha;
        $scope.registro.ingastoperiodo= $scope.periodo;
        $scope.registro.ingastoid=0;
};

    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();

    };

    $scope.informe = function(detail){
        $scope.form_peridesde='Periodo desde';
        $scope.form_perihasta='Periodo hasta ';
        $scope.titulin= 'Informe de cuentas';
        $scope.peridesde = $scope.valPreriFact;
        $scope.perihasta = $scope.valPreriFact;
        $scope.queOk='I';
        $scope.modal = false;
    };

    $scope.cierre = function(detail){

        valor = confirm('Esto calcula el saldo del periodo y crea el saldo inicial del nuevo periodo');
        if (valor == true) { 
            $scope.form_peridesde='Periodo actual';
            $scope.form_perihasta='Nuevo Periodo ';
            $scope.titulin= 'Cierre de cuentas del periodo';
            $scope.peridesde = $scope.valPreriFact;
            $scope.perihasta = avanzaPeriodo($scope.peridesde)
            $scope.modal = false;  
            $scope.queOk='C';
        }
    };

    $scope.ok = function(){
        fi=$scope.peridesde;
        ff=$scope.perihasta;
        $scope.modal = true;
        empresa = $('#e').val();
        if( $scope.queOk==='C'){             
            $http.post('modulos/mod_containgregastos.php?op=ci',{'op':'ci','empresa':empresa,'fi':fi,'ff':ff}).success(function(data){
                alert(data);
        });            
        }
        if( $scope.queOk==='X'){             
            $http.post('modulos/mod_containgregastos.php?op=exp',{'op':'exp','empresa':empresa,'fi':fi,'ff':ff}).success(function(data){
            $('#miExcel').html(data); 
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        });            
        }
        if( $scope.queOk==='I'){   
            location.href="reports/rptIngGastos.php?pi="+fi+"&em="+empresa+"&pf="+ff;
        }
    }

    $scope.regresa = function(){
        $scope.modal = true;
    }


    $scope.exporta = function(){
        valor = confirm('Exporta la tabla de ingresos y gastos a Excel Cargue y renombre el documento..., continua?');
        if (valor == true) {
            $scope.form_peridesde='Periodo desde';
            $scope.form_perihasta='Periodo hasta ';
            $scope.titulin= 'Exporta a Excel';
            $scope.peridesde = $scope.valPreriFact;
            $scope.perihasta = $scope.valPreriFact;
            $scope.queOk='X';
            $scope.modal = false;
       }  
    }
        $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.ingastoFecha+' ?')) {  
            $http.post('modulos/mod_containgregastos.php?op=b',{'op':'b', 'ingastoid':info.ingastoid}).success(function(data){
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
        if($('#ingastoid').val()===''){er+='falta id\n';}
        if($('#ingastoempresa').val()===''){er+='falta empresa\n';}
        if($('#ingastoFecha').val()===''){er+='falta fecha\n';}
        if($('#ingastoperiodo').val()===''){er+='falta periodo\n';}
        if(info.ingastotipo===''){er+='falta tipo\n';}
        if($('#ingastocomprobante').val()===''){er+='falta movimiento\n';}
        if($('#ingastodetalle').val()===''){er+='falta detalle\n';}
      //  if($('#ingastoDocumento').val()===''){er+='falta Documento\n';}
        if($('#ingastovalor').val()===''){er+='falta valor\n';}
        if($('#ingastocontabiliza').val()===''){er+='falta contabiliza\n';}
        if(info.ingastotercero === null){er+='falta el tercero\n';}
        if (er===''){
        $http.post('modulos/mod_containgregastos.php?op=a',{'op':'a', 'ingastoid':info.ingastoid, 'ingastoempresa':info.ingastoempresa, 
            'ingastoFecha':info.ingastoFecha, 'ingastoperiodo':info.ingastoperiodo, 'ingastotipo':info.ingastotipo, 
            'ingastocomprobante':info.ingastocomprobante, 'ingastodetalle':info.ingastodetalle, 'ingastoDocumento':info.ingastoDocumento,
            'ingastovalor':info.ingastovalor, 'ingastocontabiliza':info.ingastocontabiliza,
            'ingastotercero':info.ingastotercero,'ingastoctadb':info.ingastoctadb,
            'ingastoctacr':info.ingastoctacr,'ingastocompro':info.ingastocompro}).success(function(data){  
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Nov 27, 2019 1:57:50   <<<<<<< 
