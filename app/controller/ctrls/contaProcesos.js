var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_titleFactura = 'Facturación del Mes';
    $scope.form_titleRCaja = 'Recibos de Caja (Abonos)';
    $scope.form_titleOtroIngreso = 'Otros Ingresos';
    $scope.form_anulaRCaja = 'Anula recibo de caja';
    $scope.form_contabiliza='Contabiliza movimiento de Ingresos y Egresos';
    $scope.form_consultasCtaCobro='Consulta de cuentas de cobro';
    $scope.form_impromeCtasCobro = 'Reimprime cuentas de cobro';
    $scope.form_consultasGral = 'Consultas Generales';
    $scope.form_acuerdosPago = 'Acuerdos de Pago';
    $scope.form_acuerdoCuotas='Número de cuotas';
    $scope.form_imprimeCtasCobro = 'Imprime Cuentas de Cobro';
    $scope.form_imprimeRecibo = 'Reimprime Recibo de caja';
    $scope.form_consultasCtaCobro = 'Consulta Cuenta de Cobro';
    $scope.form_consultaRecibo = 'Consulta Recibo de Caja';
    $scope.form_resumenDiario = 'Resume diario de Caja';
    $scope.form_estadoCuenta = 'Estado de cuenta';
    $scope.form_carteraEnMora = 'Cartera en Mora';
    $scope.form_detalle='Detalle anticipo';
    $scope.form_acuerdoValor='Valor acuerdo';
    $scope.form_fechaAbono = "Fecha Abono";
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnImprimir = 'Imprime ultimo período';
    $scope.form_btnImpreRc = 'Imprime Recibo';
    $scope.form_btnImpreAc = 'Imprime Acuerdo';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnContinua = 'Continuar';
    $scope.form_btnfactura = 'Facturar periodo';
    $scope.form_btnActualiza = 'Actualizar';  
    $scope.form_btnAplicar = 'Aplicar';  
    $scope.Mensaje='El periodo ya se facturó';
    $scope.form_imprimeTodos='Imprime todas o una sola:'
    
    $scope.ultiperfac = 'Ultimo perído facturado: ';
    $scope.periFact = 'Perído a Facturar:';
    $scope.form_periodo ='Ultimo período';
    $scope.fchCorte = 'Fecha de corte:';
    $scope.inmueble = 'Inmueble : ';
    $scope.nroRecibos = 'recibo Nro.';
    $scope.rCaja = 'Recibo de caja'; 
    $scope.propietario = 'Propietario : ';
    $scope.comprobante = 'Cmbante facturación:';
    $scope.comprobanteRC = 'Cmbante Ingresos:';
    $scope.titSaldo = 'Saldo a la fecha';
    $scope.titvlrPago = 'Valor pagado';
    $scope.titformaPago = 'Forma de pago';
    $scope.formaPagoE = 'Efectivo';
    $scope.formaPagoT = 'Trasferencia';
    $scope.formaPagoB = 'Banco';
    $scope.titreferencia = 'Referencia';
    $scope.form_todassi='Ultimo periodo: ';
    $scope.form_todasno='Una sola: ';
    $scope.form_enMora = 'Saldo en mora';
    $scope.form_corriente = 'Saldo corriente';
    $scope.form_vlrTotal = 'Total deuda';
    $scope.valUltiperfac='';
    $scope.valPreriFact = '';
    $scope.valFchCorte = '';
    $scope.valComprobante = '';
    $scope.factura = false;
    $scope.progreso = false;
    $scope.imprime = false;
    $scope.imprimeAc = false;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
    
    $scope.empresa = $('#e').val();
    $scope.nrComprobante = '';
    $scope.decDias = 0;
    $scope.consecFactura = 0;
    $scope.recargoPorc = 0;
    $scope.recargoPesos = 0;
    $scope.recargoDias = 0;
    $scope.factorRedondeo = 0;
    $scope.vlrPago = 0;
    $scope.enMora = 0;
    $scope.corriente = 0;
    $scope.vlrTotal = $scope.enMora + $scope.corriente;
    var f = new Date();  
    $scope.registro.fechaAbono=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+ ' 00:00:0000';
    $scope.fechaAbono=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
    procesa = $('#control').val();
    $scope.reimprime='N';
    if(procesa === 'F'){
       getInfoFac($scope.empresa);
    }
   
    if(procesa === 'A'){
        getCombos($scope.empresa);
        getInfoAnticipo($scope.empresa);
        $scope.reimprime='S';
        $scope.registro.reimprimeCtas='S';
    }   
    if(procesa === 'R'){
        $scope.Mensaje='';
        getInfoRcaja($scope.empresa);
        getCombos($scope.empresa);
    }
    
     function getInfoAnticipo(empresa){
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        $scope.periodo = rec[1];
        $scope.registro.ultimoPeriodo =  rec[1];
         }); 
     }
     function getInfoFac(empresa){
       $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 

        rec=data.split('||');
        $scope.valUltiperfac = rec[12];
        $scope.valPreriFact = rec[1];
        $scope.valFchCorte = rec[2];
        $scope.valComprobante = rec[3]+' - ' + rec[4];
        $scope.nrComprobante = rec[3];
        $scope.decDias = rec[5];
        $scope.consecFactura = rec[6];
        $scope.recargoPorc  = rec[8];
        $scope.recargoPesos = rec[9];
        $scope.recargoDias  = rec[10];
        $scope.factorRedondeo = rec[11];
        $scope.periCierreFactura = rec[12];
 //201801||201801||2018-01-31||01||FACTURACION (INGRESOS)||10||494||82||2.00||0.00||12||C||201712     
        $scope.factura = true; 
        $scope.imprime = false; 
        if (rec[7] > 0){
            $http.post('modulos/mod_contaprocesos.php?op=facRes',{'op':'facRes', 'empresa':empresa}).success(function(data){
            $scope.details = data;
            $scope.configPages();   
            });
            $scope.factura = false; 
            $scope.imprime = true; 
            }       
        });           
     }
     
    function getInfoRcaja(empresa){
        mes = ['31', '28', '31','30','31','30','31','31','30','31','30','31' ];
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 

        rec=data.split('||');
        $scope.valUltiperfac = rec[12];
        $scope.valPreriFact = rec[1];
        $scope.valFchCorte = rec[2];
        $scope.valComprobante = rec[3]+' - ' + rec[4];
        $scope.nrComprobante = rec[3];
        $scope.decDias = rec[5];
        $scope.consecFactura = rec[6];
        $scope.recargoPorc  = rec[8];
        $scope.recargoPesos = rec[9];
        $scope.recargoDias  = rec[10];
        $scope.factorRedondeo = rec[11];
        $scope.periCierreFactura = rec[12];
        m=rec[12].substring(4, 6)-1;
        $scope.fchPago = rec[12].substring(0, 4)+'-'+rec[12].substring(4, 6)+'-'+mes[m];
        $scope.registro.fechaAbono = $scope.fchPago;
        $scope.factura = true; 
        $scope.imprime = false; 
        if (rec[7] > 0){
            $http.post('modulos/mod_contaprocesos.php?op=facRes',{'op':'facRes', 'empresa':empresa}).success(function(data){
            $scope.details = data;
            $scope.configPages();   
            });
            $scope.factura = false; 
            $scope.imprime = true; 
            }       
        });       
    }
    
    function getCombos(empresa){
        $http.post('modulos/mod_contaprocesos.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
        $scope.operators0 = data;
         });
        $http.post('modulos/mod_contaprocesos.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators1 = data;
        }); 
         
    }
    
    $scope.facturar = function(){
        periodo=$scope.valPreriFact;
        var sino = confirm( 'Borra la cartera y si hay borra la contabilidad del periodo '+periodo+' y crea de nuevo su información. Desea continuar ?' );
        if (sino === true) 
        {
             vaAfacturar('F');
        }       
    };
    
    $scope.editInfo = function(){
          alert( 'desplegar en emergente la info de la factura');
      };
    
    
    $scope.printInfo = function(details){
        periodo=$scope.valPreriFact;
        fecha = perifactura(periodo);
        inmueble=details.facturaInmuebleid;
        empresa=$scope.empresa;   
        location.href="reports/rptUnaFactura.php?pe="+periodo+"&em="+empresa+"&fc="+fecha+"&in="+inmueble;  
      };
    
    $scope.leeRcaja = function(){
    inmu=$scope.registro.Inmueble;    
    empresa=$scope.empresa; 
    if (inmu === undefined){
        err+='Seleccione un inmueble \n';
    }
    $http.post('modulos/mod_contaprocesos.php?op=leeCaja',{'op':'leeCaja','empresa':empresa,'inmu':inmu}).success(function(data){
        $scope.operators1 = data;
    }); 
    };
    
    $scope.imprimeRcaja = function(){
      
        recibo=$scope.registro.Recibo;
        if ($scope.reimprime=='N'){recibo=$scope.consecRC;}        
        fecha = $scope.registro.fechaAbono;
        inmu=$scope.registro.Inmueble;
        empresa=$scope.empresa;
        location.href="reports/rptReciboCaja.php?op=A"+"&em="+empresa+"&recibo="+recibo+"&in="+inmu+'&fc='+fecha; 
    };
    
    $scope.imprimirFact= function(){
        periodo=$scope.valUltiperfac;
        fecha = perifactura(periodo);
        empresa=$scope.empresa;      
        location.href="reports/rptFacturas.php?pe="+periodo+"&em="+empresa+"&fc="+fecha;   
    };
    
    $scope.buscaFacturas = function(detail){
        empresa=$scope.empresa;
        inmueble = detail.Inmueble;
        propietario = detail.propietario;
        if (inmueble === undefined){inmueble=0;}
        if (propietario === undefined) {propietario=0;}
        $http.post('modulos/mod_contaprocesos.php?op=facSal2',{'op':'facSal2','empresa':empresa,'inmueble':inmueble,
        'propietario':propietario}).success(function(data){
            alert(data);
        $scope.Mensaje = data;
         });
    };
     
    $scope.buscanroRecibos = function(){
        empresa=$scope.empresa; 
        inmueble = detail.Inmueble;
        $http.post('modulos/mod_contaprocesos.php?op=busRc',{'op':'busRc','empresa':empresa,'inmueble':inmueble}).success(function(data){
            $scope.operators1 = data;
            }); 
    }

    $scope.buscaacuer2 = function(detail){
        empresa=$scope.empresa;
        inmueble = detail.Inmueble;
        propietario = detail.propietario;
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
     
    $scope.aplicar = function(){
        empresa=$scope.empresa;
        prop=$scope.registro.propietario;
        inmu=$scope.registro.Inmueble;
        forma=$scope.registro.formaPago;
        valor=$scope.vlrPago;
        referencia=$scope.referencia;
        fecha = $scope.registro.fechaAbono;
      
        err='';
        if (prop === undefined){prop=0;}
        if (inmu === undefined){inmu=0;}
        if(prop===0 && inmu===0){
            err+='Seleccione un inmueble o un propietario\n';
        }
        if(prop>0 && inmu>0){
            err+='Solamente seleccione o un inmueble o un propietario no los dos\n';
        }
        if(valor===0){
            err+='Falta el valor a pagar\n';
        }
        if(forma===undefined){
             err+='Falta Forma de pago\n';
        }
        if(referencia===undefined){
             err+='Falta Referencia de pago\n';
        }
       
       if (err ===''){
        datos=empresa+"||"+prop+"||"+inmu+"||"+forma+"||"+valor+"||"+referencia+"||"+fecha;

        $http.post('modulos/mod_contaprocesos.php?op=pagaFac',{'op':'pagaFac','datos':datos}).success(function(data){        
        $scope.consecRC = data;
        $scope.imprime = true;
         });
    }else{
        alert(err);
    }
    };
    
     $scope.aplicaAcuerdo = function(){
        empresa=$scope.empresa;
        inmueble = $scope.registro.Inmueble;
        propietario = $scope.registro.propietario;
        if (inmueble === undefined){inmueble=0;}
        if (propietario === undefined) {propietario=0;}
        er='';
        if(inmueble===0 && propietario===0){er +='Debe indicar un inmueble o un propietario \n'}
        if($scope.acuerdoValor === undefined){er +='Falta el valor \n';}
        if($scope.acuerdoCuotas === undefined){er +='Falta número de cuotas \n';}
        if($scope.detalle === undefined){er +='Falta detalles del acuerdo \n';}
        if (er===''){
            $http.post('modulos/mod_contaprocesos.php?op=apliAc',{'op':'apliAc','empresa':empresa,'inmueble':inmueble,
            'propietario':propietario}).success(function(data){
            if (data === 'Ok'){  $scope.imprimeAc = true;}
            });
        }else{
            alert(er)
        }
    };
     
    
    $scope.imprimeAcuerdo = function(){
        alert('imprime acuerdo');
    };
    
    $scope.formaPago = function(){
        forma=$scope.registro.formaPago;
        switch(forma) {
        case 'E':
          $scope.referencia='Pago en efectivo ';
          break;
        case 'T':
          $scope.referencia='Trasferencia de ';
          break;
        case 'C':
          $scope.referencia='Cheque Nr. ';
          break;
        default:
            $scope.referencia='';
        }
    };
    
    $scope.imprimeCtaCobro = function(){
        prop=$scope.registro.propietario;
        inmu=$scope.registro.Inmueble;
        reimp=$scope.registro.reimprimeCtas;
        peri=$scope.periodo;
        if (prop == undefined){prop=0;}
        if (inmu == undefined){inmu=0;}
        if (reimp == undefined){       
            alert('Seleccione todas o una sola');
            return; 
        }
        else{
        if(reimp==='N'){
            if(prop==0 && inmu==0){
                alert('Seleccione un inmueble o un propietario');
                return;
            }else  if(prop>0 && inmu>0){
                alert('Solamente seleccione o un inmueble o un propietario no los dos');
                return;
            }
         }
        }
        empresa=$scope.empresa;
        location.href="reports/rptCtaCbro.php?op="+reimp+"&em="+empresa+"&prop="+prop+"&in="+inmu+"&pe"+peri; 
    };
    
    $scope.consultaCtaCobro = function(){
        empresa=$scope.empresa;
        prop=$scope.registro.propietario;
        inmu=$scope.registro.Inmueble;
        if (prop === undefined){prop=0;}
        if (inmu === undefined){inmu=0;}
        if(prop==0 && inmu==0){
            alert('Seleccione un inmueble o un propietario');
        }else  if(prop>0 && inmu>0){
            alert('Solamente seleccione o un inmueble o un propietario no los dos');
        }
        else{
       
        $http.post('modulos/mod_contaprocesos.php?op=cnslta2',{'op':'cnslta2','empresa':empresa,'inmueble':inmu,
        'propietario':prop}).success(function(data){
       
        $scope.details = data;
         });
        
    }
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
    
    function perifactura(periodo){
        ano =  periodo.substr(0, 4);
        mes = periodo.substr(4, 2);
        if(ano >= '2000' && ano <= '2100' && mes >= '01' && mes <= '12'){
            $('#progreso').show();
            dia = '31';
            if(mes==='04' || mes==='06' || mes==='09' || mes==='09') 
                {dia = '30';}
            if (mes==='02'){
                if ((ano % 4 === 0) && ((ano % 100 !== 0) || (ano % 400 === 0)))
                    {dia = '29';} else {dia = '28';}
            }
            fecha = ano+'/'+mes+'/'+dia;
            return fecha;
         }else{
            return 'ERR: Revise el periodo, no es válido';
        }
    }
    
    function vaAfacturar(op){
        $scope.progreso = true;
        periodo=$scope.valPreriFact;
        empresa=$('#e').val();
        ano = periodo.substr(0,4);
        mes = periodo.substr(4,2);
        consecutivo=$scope.consecFactura;
        comprobante = $scope.nrComprobante;
        DescDias=$scope.decDias;
        meses=[31,28,31,30,31,30,31,31,30,31,30,31];
        if ((ano % 4 === 0) && ((ano % 100 !== 0) || (ano % 400 === 0)))
            {meses[1]=29;}
  
        dia = meses[mes -1];
        fchini= ano + '-' +  mes +'-01';
        fchfin= ano + '-' +  mes +'-'+dia ;
        condicion = empresa + '||'+periodo + '||'+consecutivo + '||'+comprobante+'||'+DescDias+'||'+fchini+'||'+fchfin+'||'+op+'||'+
        $scope.recargoPorc+'||'+$scope.recargoPesos+'||'+$scope.recargoDias+'||'+$scope.factorRedondeo+'||'+$scope.valUltiperfac;
        $scope.progreso = true;

        $http.post('modulos/mod_contaprocesos.php?op=fac',{'op':'fac', 'condicion':condicion}).success(function(data){
        alert(data);
        if (data.substring(0,2) === 'Ok'){ 
            $http.post('modulos/mod_contaprocesos.php?op=facRes',{'op':'facRes', 'empresa':empresa}).success(function(data){
            $scope.details = data;
            $scope.configPages();   
            });    
            $scope.progreso = false; //Ok.
            $scope.imprime = true; 
        }
        else
            alert(data);
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



    empresa = $scope.empresa;
    $scope.items = [];
    $scope.titulin= '';
    $scope.open = function (detail) {
    size='lg';
    inmueble=detail.facturaInmuebleid;
    $http.post('modulos/mod_contaprocesos.php?op=facDet',{'op':'facDet', 'empresa':empresa, 'inmueble':inmueble}).success(function(data){
    $scope.items = data;
    $scope.configPages();   
    }); 
    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: function ($scope, $modalInstance, items) {
        $scope.items = items;
        $scope.titulin=detail.inmuebleDescripcion;
        $scope.selected = {
          item: $scope.items[0]
        };
      
        $scope.ok = function () {
          $modalInstance.close($scope.selected.item);
        };
      
        $scope.cancel = function () {
          $modalInstance.dismiss('cancel');
        };
      },
      size: size,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };
}


]);
 
app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
  