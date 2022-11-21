var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Factura Servicios';
    $scope.form_btnNuevo = 'Nueva Factura';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnMuestra = 'Muestra';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnConta = 'Contabiliza';
    $scope.form_btnImprime = 'Imprime';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Graba Movto';
    $scope.form_btnDetalles='Detalle Factura'
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_factdefcontabiliza100 = 'NO';
    $scope.form_factdefcontabiliza101 = 'SI';

    $scope.form_factdefid = 'ID'; 
    $scope.form_factdefempresa = 'EMPRESA';
    $scope.form_factdefnro = 'NRO';
    $scope.form_factdefcliente = 'CLIENTE';
    $scope.form_factdefconcepto = 'CONCEPTO';
    $scope.form_factdefdetalle='DETALLE';
    $scope.form_factdeffechcrea = 'FECHA CREA';
    $scope.form_factdeffechvence = 'FECHA VENCE';
    $scope.form_factdefvalor = 'VALOR';
    $scope.form_factdefiva = '% IVA';
    $scope.form_factdefsaldo = 'VLR IVA';
    $scope.form_factdefneto = 'SUB TOTAL';
    $scope.form_factdefcontabiliza = 'CONTABILIZA';
    
    $scope.form_factmvtDetalle = 'DETALLE';  
    $scope.form_factmvtIvaPorc = '% IVA';   
    $scope.form_factmvtValor = 'VALOR';  
    $scope.form_factmvtIvaValor = 'VALOR IVA';  
    $scope.form_factmvtDescPorc = '% DSCNTO'; 
    $scope.form_factmvtDescValor = 'DESCUENTO';  
    $scope.form_factmvtCptoId = 'CONCEPTO';  
    $scope.form_factmvtId = 'ID';  
    $scope.form_factmvtFacDef = 'NRO FACTURA';  
   
    $scope.form_Phfactdefid = 'Digite id';
    $scope.form_Phfactdefempresa = 'Digite empresa';
    $scope.form_Phfactdefnro = 'Digite nro';
    $scope.form_Phfactdefcliente = 'Digite cliente';
    $scope.form_Phfactdeffechcrea = 'Digite fechcrea';
    $scope.form_Phfactdeffechvence = 'Digite fechvence';
    $scope.form_Phfactdefvalor = 'Digite valor';
    $scope.form_Phfactdefiva = 'Digite iva';
    $scope.form_Phfactdefsaldo = 'Digite saldo';
    $scope.form_Phfactdefneto = 'Digite neto';
    $scope.form_Phfactdefcontabiliza = 'Digite contabiliza';
    $scope.IsVisible = false;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    $scope.miData = [{cptosCodigo:'', cptosValor:'', cptosIva:''}];
    $scope.empresa = $('#e').val();
    var defaultForm= {   
        factdefid:0,
        factdefempresa:$scope.empresa,
        factdefnro:0,
        factdefcliente:0,
        factdeffechcrea:'',
        factdeffechvence:'',
        factdefvalor:'',
        factdefiva:'',
        factdefsaldo:'',
        factdefneto:'',
        factdefcontabiliza:'N',
        factmvtDetalle:'',
        factmvtIvaPorc:'',  
        factmvtValor:'',  
        factmvtIvaValor:'',  
        factmvtDescPorc:'', 
        factmvtDescValor:'',  
        factmvtCptoId:'',  
        factmvtId:'', 
        factdefcptodeta:'',
        factmvtFacDef:'',
        factid:'0'
   };
    
    getCombos();
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contafactdef.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
        empresa = $scope.empresa;
        $http.post('modulos/mod_contafactdef.php?op=0',{'op':'0', 'empresa':empresa}).success(function(data){
        $scope.operators0 = data;
        });
        $http.post('modulos/mod_contafactdef.php?op=1',{'op':'1', 'empresa':empresa}).success(function(data){
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
    // $scope.formToggle =function(){
    //     $('#idForm').slideToggle();
    //     $scope.factdefid=0;
    //     $('#idForm').css('display', 'none');
    //     alert('toggle 1');
    // };

    $scope.show_form = true;

    $scope.formToggle =function(){
        $('#idForm').slideToggle();
        empresa = $scope.empresa;
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
        $http.post('modulos/mod_contafactdef.php?op=m',{'op':'m', 'empresa':empresa}).success(function(data){
        $scope.registro.factdefnro = data;
        numero =  $scope.registro.factdefnro
        $scope.detalles(numero);
        });
       
    };

    $scope.detalles = function(op){
        $scope.IsVisible = $scope.IsVisible ? false : true;
        empresa = $('#e').val();
        $http.post('modulos/mod_contafactdef.php?op=d',{'op':'d', 'empresa':empresa, 'numero':op}).success(function(data){
        $scope.details = data;  
        }); 
    };
    
    $scope.selConcepto = function (info){
        cp = info.factdefconcepto; 
        let indice = $scope.operators1.findIndex(ind => ind.cptosid === cp);
        $scope.registro.factdefdetalle = $scope.operators1[indice].cptosDetalle;
        empresa = info.factdefempresa; 
        $http.post('modulos/mod_contafactdef.php?op=tc',{'op':'tc', 'empresa':empresa,'concepto':cp}).success(function(data){
        $scope.miData = data[0];
        valor = parseFloat($scope.miData.cptosValor)
        iva = parseFloat($scope.miData.cptosIva);
        subTotal = parseFloat($scope.miData.cptosValor * iva / 100);
        $scope.registro.factdefvalor = valor ;
        $scope.registro.factdefiva = $scope.miData.cptosIva; 
        $scope.registro.factdefsaldo = subTotal; 
        $scope.registro.factdefneto = valor + subTotal;
         }); 
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
        $http.post('modulos/mod_contafactdef.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
        $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
},


    $scope.contaInfo = function(info){
        alert('Va a contabilizar');
    },
    $scope.imprimeInfo = function(info){
        nr = info.factdefnro;
        em = info.factdefempresa; 
        location.href="reports/rptFacturaSrvs.php?em="+em+"&nr="+nr; 
    }, 
      
    $scope.muestraInfo =function(info)
    { 
        empresa = $('\#e').val(); 
        alert('muestra la info de '+ empresa+' '+info.factdefid);  
    };

    $scope.updateInfo =function(info)
    {
        er='';
        empresa = $('\#e').val(); 
        if($('#factdefid').val()===''){er+='falta id\n';}
        if($('#factdefempresa').val()===''){er+='falta empresa\n';}
        if($('#factdefnro').val()===''){er+='falta nro\n';}
        if($('#factdefcliente').val()===''){er+='falta cliente\n';}
        if($('#factdeffechcrea').val()===''){er+='falta fecha crea\n';}
        if($('#factdeffechvence').val()===''){er+='falta fecha vence\n';}
        if($('#factdeffechcrea').val()>$('#factdeffechvence').val()){er+='fecha factura mayor a fecha vencimiento\n';}
        if($('#factdefvalor').val()===''){er+='falta valor\n';}
        if($('#factdefiva').val()===''){er+='falta % iva\n';}
        if($('#factdefsaldo').val()===''){er+='falta valor IVA\n';}
        if($('#factdefneto').val()===''){er+='falta neto\n';}
        
        cpto = info.factdefconcepto;
        terc = info.factdefcliente;
        if(cpto===undefined || cpto ===0){er+='falta concepto\n';}
        if(terc===undefined || terc ===0){er+='falta tercero\n';}
        if (er==''){
        $http.post('modulos/mod_contafactdef.php?op=a',{'op':'a', 'factdefid':info.factdefid, 
            'factdefempresa':info.factdefempresa, 'factdefnro':info.factdefnro, 
            'factdefcliente':terc, 'factdeffechcrea':info.factdeffechcrea, 
            'factdeffechvence':info.factdeffechvence, 'factdefvalor':info.factdefvalor, 
            'factdefiva':info.factdefiva, 'factdefsaldo':info.factdefsaldo, 'factdefneto':info.factdefneto, 
            'factdefcontabiliza':'N','factdefconcepto':cpto, 'factdefcptodeta':info.factdefdetalle}).success(function(data){
            var ret = data.split('||');
        if (ret[0] === 'Ok') {
            $scope.factid = (ret[1])
            $http.post('modulos/mod_contafactdef.php?op=am',{'op':'am', 'empresa':empresa, 'factmvtFacDef':ret[1],
                'factmvtCptoId':info.factdefconcepto, 
                'factmvtDetalle':info.factdefdetalle}).success(function(data){
            }); 
            getInfo(empresa);
            alert ('Registro Actualizado ');
            info.factdefconcepto = undefined;
            info.factdefvalor='';
            info.factdefsaldo='';
            info.factdefneto='';
            info.factdefiva='';
        }else{
            alert(data);
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 7:09:26   <<<<<<< 
