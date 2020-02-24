var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_titleMov = 'Digita Operaciones contables';
    $scope.form_title = 'Digita Comprobantes de contabilidad';
    $scope.form_titleActu ='Actualiza comprobantes contables';
    $scope.form_btnNuevo = 'Nuevo registro';
    
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnMovi='Movimiento';
    $scope.form_btnConti='Continua';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_movicaProcesado60 = 'Si';
    $scope.form_movicaProcesado61 = 'No';

    $scope.form_movicaId = 'ID';
    $scope.form_movicaEmpresaId = 'EMPRESA';
    $scope.form_movicaComprId = 'COMPROBANTE';
    $scope.form_movicaOperaId = 'OPERADOR';
    $scope.form_movicaCompNro = 'NUMERO';
    $scope.form_movicaTerceroId = 'TERCERO';
    $scope.form_movicaDetalle = 'DETALLE';
    $scope.form_movicaProcesado = 'PROCESADO';
    $scope.form_movicaFecha = 'FECHA';
    $scope.form_movicaPeriodo = 'PERIODO';
    $scope.form_movicaDocumPpal = 'DOC. PRINCIPAL';
    $scope.form_movicaDocumSec = 'DOC. OTRO';

    $scope.form_PhmovicaId = 'Digite id';
    $scope.form_PhmovicaEmpresaId = 'Digite empresa';
    $scope.form_PhmovicaComprId = 'Digite comprobante';
    $scope.form_PhmovicaCompNro = 'Digite numero';
    $scope.form_PhmovicaTerceroId = 'Digite tercero';
    $scope.form_PhmovicaDetalle = 'Digite detalle';
    $scope.form_PhmovicaProcesado = 'Digite procesado';
    $scope.form_PhmovicaFecha = 'Digite fecha';
    $scope.form_PhmovicaPeriodo = 'Digite periodo';
    $scope.form_PhmovicaDocumPpal = 'Documento principal';
    $scope.form_PhmovicaDocumSec = 'Otro documento';
    $scope.form_periodo = 'Periodo contable';
    $scope.ventanaPpal=false;
    $scope.ventanaSgnda=true;
    $scope.cta1 = false;
    $scope.cta2 = false;
    $scope.cta3 = false;
    $scope.cta4 = false;
    $scope.cta5 = false;
    $scope.cta6 = false;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.cabeza=0;
    $scope.pages = [];
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.control= $('#control').val();

    var f = new Date();  
   // var fecha=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+ ' 00:00:0000';
    var periodo = f.getFullYear();
    if (f.getMonth() +1 < 10){periodo+='0'}
    periodo += (f.getMonth() +1);
    
    $scope.show_form = true;
    
    var defaultForm= {   
        movicaId: $scope.cabeza,
        movicaEmpresaId:$scope.empresa,
        movicaComprId:'',
        movicaCompNro:0,
        movicaTerceroId:0,
        movicaDetalle:'',
        movicaProcesado:'N',
        movicaFecha:'',
        movicaPeriodo:$scope.periodoCtble,
        movicaDocumPpal:'',
        movicaDocumSec:''
    };
 
        control = $scope.control;
        if (control === 'A') // actualiza comprobantes 
        {
            empresa = $('\#e').val();
            periodo = $scope.periodoCtble; 
            $http.post('modulos/mod_contamovicabeza.php?op=te',{'op':'te', 'empresa':empresa,'periodo':periodo}).success(function(data){
            $scope.detailsAct = data;
            $scope.configPages();   
            });            
        }
    
    getCombos($scope.empresa, control);
    
    getParam($scope.empresa);
    
    function getParam(empresa){
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        $scope.periodoCtble=rec[1];        
        defaultForm.movicaFecha= rec[2];
        $scope.registro.movicaPeriodo = rec[1];
        $scope.registro.movicaFecha = rec[2];
        });
    }
    
    function getInfo(){
        control = $scope.control;
        if (control === 'C'){
            empresa = $('\#e').val();
            periodo = $scope.periodoCtble; 
            $http.post('modulos/mod_contamovicabeza.php?op=r',{'op':'r', 'empresa':empresa,'periodo':periodo}).success(function(data){
            $scope.details = data;
            $scope.configPages();   
            });
        }
    }

    function getCombos(empresa, control){
        $http.post('modulos/mod_contamovicabeza.php?op=0',{'op':'0','empresa':empresa,'control':control}).success(function(data){
        $scope.operators0 = data
        });
        $http.post('modulos/mod_contamovicabeza.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators1 = data;
        });
    } 
    
    $scope.buscaCompro = function(info){
        cp= info.movicaComprId;
        empresa = $('#e').val();
        $http.post('modulos/mod_contamovicabeza.php?op=cp',{'op':'cp','empresa':empresa,'cp':cp}).success(function(data){
        info.movicaCompNro=data;
    }); 
    };
 
    $scope.buscaComproTot = function(info){
        cp= info.movicaOperaId;
        empresa = $('#e').val();
        $http.post('modulos/mod_contamovicabeza.php?op=bo',{'op':'bo','empresa':empresa,'cp':cp}).success(function(data){
        info.movicaCompNro=data;
       
        rec=data.split('||');       
        $scope.vlrDb1=0;
        $scope.vlrDb2=0;
        $scope.vlrDb3=0;
        $scope.vlrDb4=0;
        $scope.vlrDb5=0;
        $scope.vlrDb6=0;
        $scope.vlrCr1=0;
        $scope.vlrCr2=0;
        $scope.vlrCr3=0;
        $scope.vlrCr4=0;
        $scope.vlrCr5=0;
        $scope.vlrCr6=0;
        $scope.nomCuenta1='';
        $scope.nomCuenta2='';
        $scope.nomCuenta3='';
        $scope.nomCuenta4='';
        $scope.nomCuenta5='';
        $scope.nomCuenta6='';
        $scope.cta1 = false;
        $scope.cta2 = false;
        $scope.cta3 = false;
        $scope.cta4 = false;
        $scope.cta5 = false;
        $scope.cta6 = false;
        $scope.comprobante = rec[2];
        $scope.secuencia = rec[4];
        $scope.detalleComp1 = rec[1];
        $scope.detalleComp2 = 'Comprobante: ' + rec[2] + ' ' + rec[3]  + ' Numero :' + rec[4];
        $scope.ventanaPpal=true;
        if(rec[5]!='&'){
            $scope.cta1 = true;
            $scope.nomCuenta1 = rec[5].replace('&',' - ');
        }
        if(rec[6]!='&'){
            $scope.cta2 = true;
            $scope.nomCuenta2 = rec[6].replace('&',' - ');
        }
        if(rec[7]!='&'){
            $scope.cta3 = true;
            $scope.nomCuenta3 = rec[7].replace('&',' - ');
        }
        if(rec[8]!='&'){
            $scope.cta4 = true;
            $scope.nomCuenta4 = rec[8].replace('&',' - ');
        }
        
        if(rec[9]!='&'){
            $scope.cta5 = true;
            $scope.nomCuenta5 = rec[9].replace('&',' - ');
        }
        if(rec[10]!='&'){
            $scope.cta6 = true;
            $scope.nomCuenta6 = rec[10].replace('&',' - ');
        }        
    });  
    };
 //   $scope.cta1 = false;
    $scope.proceso = function(){
        $scope.ventanaPpal=true;
        $scope.ventanaSgnda=false;
        $scope.form_title = 'Digita Comprobantes de contabilidad, periodo : ' + $scope.periodoCtble;
        defaultForm.movicaPeriodo = $scope.periodoCtble;
        defaultForm.movicaFecha = $scope.periodoCtble.substring(0, 4)+'/'+$scope.periodoCtble.substring(4, 6)+'/01';
        $scope.registro.movicaPeriodo = $scope.periodoCtble;
        getInfo();
    }
       
    $scope.open = function (detail) {  
       alert('detalles');
    }
          
    $scope.items = [];
     
    $scope.movimiento = function(info){
        cp = info.movicaComprId;
        empresa = $('#e').val();
        size='lg';
        $scope.currentPageMv = 0;
        $scope.pageSizeMv = 10;
        $scope.pagesMv = [];
        $scope.registroMov = [];
        cabeza = info.movicaId;
        $scope.cabeza=cabeza;
        
        var defaultFormMov= {   
            moviConId:0,
            moviConCabezaId:info.movicaId,
            moviConDetalle:info.movicaDetalle,
            moviConCuenta:'',
            moviConDebito:0,
            moviConCredito:0,
            moviConBase:0,
            moviConImpTipo:'',
            moviConImpPorc:0,
            moviConImpValor:0,
            moviConIdTercero:info.movicaTerceroId,
            moviDocum1:'',
            moviDocum2:''
        };
        
        var modalInstance = $modal.open({
        templateUrl: 'myModalContent.html',
        controller: function ($scope, $modalInstance, items) {
        $scope.items = items;
        $scope.titulin= info.compNombre + ' Nr. ' +info.movicaCompNro + ' ' + info.movicaDetalle;
        $scope.form_moviConCuenta="Cuenta:";
        $scope.form_moviConImpTipo70 = 'IVA';
        $scope.form_moviConImpTipo71 = 'ICA';
        $scope.form_moviConImpTipo72 = 'RETE IVA';
        $scope.form_moviConImpTipo73 = 'RETE ICA';
        $scope.form_moviConId = 'ID';
        $scope.form_moviConCabezaId = 'CABEZA';
        $scope.form_moviConDetalle = 'Detalle:'; 
        $scope.form_moviConDebito = 'Valor Débito:';
        $scope.form_moviConCredito = 'Valor Crédito:';
        $scope.form_moviConBase = 'Base:';
        $scope.form_moviConImpTipo = 'Impuesto/Retención:';
        $scope.form_moviConImpPorc = ' Porcentaje ';
        $scope.form_moviConImpValor = ' Valor:';
        $scope.form_moviConIdTercero = 'Tercero:';
        $scope.form_btnAnula = 'Cerrar';
        $scope.form_btnActualiza = 'Actualizar';
        $scope.form_vrlDeb = 'Tot débitos';
        $scope.form_vrlCre = 'Tot créditos';
        $scope.form_vrlTot = 'Diferencia';
        $scope.vrlDeb = 0;
        $scope.vrlCre = 0;
        $scope.vrlTot = 0;

        sumaSaldos(empresa,cabeza);
        muestraMvto(empresa,cabeza);
        
        function sumaSaldos(empresa,cabeza){        
        $http.post('modulos/mod_contamovicabeza.php?op=sm',{'op':'sm','empresa':empresa,'cabeza':cabeza}).success(function(data){
            rec=data.split('||');
            $scope.vrlDeb = rec[0];
            $scope.vrlCre = rec[1];
            $scope.vrlTot = rec[0] -  rec[1];
        });
        };       
       
        function muestraMvto(empresa,cabeza){
            $http.post('modulos/mod_contamovicabeza.php?op=rm',{'op':'rm','empresa':empresa,'cabeza':cabeza}).success(function(data){
                $scope.detailsMv = data;
              //  $scope.configPagesMv();   
            });
        }

        $scope.sumaDbCr = function(){
            alert('ooo');
            $script.vlrTotal = $scope.vlrDb1 + $scope.vlrDb2 + $scope.vlrDb3 + $scope.vlrDb4 + $scope.vlrDb5 + $scope.vlrDb6;
            $script.vlrTotal -= ($scope.vlrCr1 + $scope.vlrCr2 + $scope.vlrCr3 + $scope.vlrCr4 + $scope.vlrCr5 + $scope.vlrCr6);
        }    
        $http.post('modulos/mod_contamovicabeza.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators3 = data;
        });
        $http.post('modulos/mod_contamovicabeza.php?op=2',{'op':'2','empresa':empresa}).success(function(data){
        $scope.operators2 = data;
        });

        $scope.form_btnNuevo = 'Nuevo Movimiento';
        $scope.show_formMov = true;
        $scope.selected = {
          item: $scope.items[0]
        };

        $scope.ok = function () {
          $modalInstance.close($scope.selected.item);
        };
          
    
        $scope.updateInfoMov = function(registroMov){
            er='';
            empresa = $('\#e').val();
            cabeza = info.movicaId;
          //  $scope.registroMov.moviConCabezaId = $scope.cabeza;
            if($scope.registroMov.moviConId===''){er+='falta id\n';}
            if($scope.registroMov.moviConCabezaId===''){er+='falta cabeza\n';}
            if($scope.registroMov.moviConDetalle===''){er+='falta detalle\n';}
            if($scope.registroMov.moviConCuenta===''){er+='falta cuenta\n';}
            if($scope.registroMov.moviConDebito===''){er+='falta valor debito\n';}
            if($scope.registroMov.moviConCredito===''){er+='falta valor credito\n';}
            if($scope.registroMov.moviConBase===''){er+='falta base\n';}
            if(($scope.registroMov.moviConImpPorc > 0 || $scope.registroMov.moviConImpValor > 0)
                && $scope.registroMov.moviConImpTipo===''){er+='falta tipo impuesto o retención\n';}
            if ($scope.registroMov.moviConImpTipo != '' && 
                    ($scope.registroMov.moviConImpPorc === 0 && $scope.registroMov.moviConImpValor === 0)){
                        er+='falta porcentaje o valor de imp o retención\n';
                    }
            if($scope.registroMov.moviConImpPorc===''){er+='falta impuesto %\n';}
            if($scope.registroMov.moviConImpValor===''){er+='falta impuesto valor\n';}
            if($scope.registroMov.moviConDebito === 0 && $scope.registroMov.moviConCredito === 0 ){er+='El valor Cr y el valor Db es cero\n';}
            if($scope.registroMov.moviConDebito != 0 && $scope.registroMov.moviConCredito != 0 ){er+='El valor Cr o el valor Db debe ser mayor a cero\n';}
            
            if (er===''){
               $scope.registroMov.moviTipoCta = 'C';
               if($scope.registroMov.moviConDebito != 0 ){$scope.registroMov.moviTipoCta = 'D';}
                dato=$scope.registroMov.moviConId+'||'+$scope.registroMov.moviConCabezaId+'||'+$scope.registroMov.moviConDetalle+'||'
                dato+=$scope.registroMov.moviConCuenta+'||'+$scope.registroMov.moviConDebito+'||'+$scope.registroMov.moviConCredito+'||'
                dato+=$scope.registroMov.moviConBase+'||'+$scope.registroMov.moviConImpTipo+'||'+$scope.registroMov.moviConImpPorc+'||'
                dato+=$scope.registroMov.moviConImpValor+'||'+$scope.registroMov.moviConIdTercero+'||';
                dato+=$scope.registroMov.moviDocum1+'||'+$scope.registroMov.moviDocum2+'||'+$scope.registroMov.moviTipoCta;
                $http.post('modulos/mod_contamovicabeza.php?op=am',{'op':'am','dato':dato}).success(function(data){
                info.detailsMv = data;
                if(data === 'Ok'){
                    sumaSaldos(empresa,cabeza);
                    $('#idFormMov').slideToggle();
                    muestraMvto(empresa,cabeza);
                    alert('Registro actualizado');}
                else{
                    alert(data);
                }    
                
                });
            }else{
                alert(er);
            }
        }

        $scope.editInfoMv =function(info)
        {  
            $scope.registroMov =  info;  
            $('#idFormMov').slideToggle();

        };
        
        $scope.clearInfoMov = function(){
            $('#idFormMov').slideToggle();
        }
        
            $scope.deleteInfoMv =function(info)
        { 
            empresa = $('\#e').val(); 
            if (confirm('Desea borrar el registro con nombre : '+info.moviConCuenta+' ?')) {  
                $http.post('modulos/mod_contamovicabeza.php?op=b',{'op':'b', 'movicaId':info.movicaId}).success(function(data){
                if (data === 'Ok') {
                getInfo();
                alert ('Registro Borrado ');
                }
                });
             }
        };
    
        $scope.formToggleMov =function(){
            $('#idFormMov').slideToggle(); 
            $scope.moviConId=0;
            $('#idFormMov').css('display', 'none');
        };
        $scope.formToggleMov =function(){
        $('#idFormMov').slideToggle();
//        $scope.formato.$setPristine();
        $scope.registroMov = angular.copy(defaultFormMov);
        
    };


//          $scope.cancel = function () {
//            $modalInstance.dismiss('cancel');
//          };
        },
        size: size,
        resolve: {
          items: function () {
            return $scope.items;
          }
        }
      });
      
    $scope.configPagesMv = function() {
        $scope.pagesMv.length = 0;
        var ini = $scope.currentPageMv - 4;
        var fin = $scope.currentPageMv + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.detailsMv.length / $scope.pageSizeMv) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.detailsMv.length / $scope.pageSizeMv);
        }
        else {
            if (ini >= Math.ceil($scope.detailsMv.length / $scope.pageSizeMv) - 10) {
                ini = Math.ceil($scope.detailsMv.length / $scope.pageSizeMv) - 10;
                fin = Math.ceil($scope.detailsMv.length / $scope.pageSizeMv);
            }
        }
        if (ini < 1) ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pagesMv.push({no: i});
        }

        if ($scope.currentPageMv >= $scope.pagesMv.length)
            $scope.currentPageMv = $scope.pagesMv.length - 1;
    };

    $scope.setPageMv = function(index) {
        $scope.currentPageMv = index - 1;
    };
        
    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
    };
    
//  hasta aqui va la modal    
    
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
    $scope.movicaId=0;
    $('#idForm').css('display', 'none');
    };
    
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
        $http.post('modulos/mod_contamovicabeza.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        if (confirm('Desea borrar el registro con nombre : '+info.movicaPeriodo+' ?')) {  
            $http.post('modulos/mod_contamovicabeza.php?op=b',{'op':'b', 'movicaId':info.movicaId}).success(function(data){
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
        empresa = $('\#e').val(); 
        if($('#movicaId').val()===''){er+='falta id\n';}
        if($('#movicaEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#movicaComprId').val()===''){er+='falta comprobante\n';}
        if($('#movicaCompNro').val()===''){er+='falta numero\n';}
        if($('#movicaTerceroId').val()===''){er+='falta tercero\n';}
        if($('#movicaDetalle').val()===''){er+='falta detalle\n';}
        if($('#movicaProcesado').val()===''){er+='falta procesado\n';}
        if($('#movicaFecha').val()===''){er+='falta fecha\n';}
        if($('#movicaPeriodo').val()===''){er+='falta periodo\n';}
//        if($('#movicaDocumPpal').val()===''){er+='falta documppal\n';}
//        if($('#movicaDocumSec').val()===''){er+='falta documsec\n';}
        if (er==''){
        $http.post('modulos/mod_contamovicabeza.php?op=a',{'op':'a', 'movicaId':info.movicaId, 'movicaEmpresaId':info.movicaEmpresaId, 'movicaComprId':info.movicaComprId, 'movicaCompNro':info.movicaCompNro, 'movicaTerceroId':info.movicaTerceroId, 'movicaDetalle':info.movicaDetalle, 'movicaProcesado':info.movicaProcesado, 'movicaFecha':info.movicaFecha, 'movicaPeriodo':info.movicaPeriodo, 'movicaDocumPpal':info.movicaDocumPpal, 'movicaDocumSec':info.movicaDocumSec}).success(function(data){
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
             start =+ start;
             return input.slice(start);
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< 
