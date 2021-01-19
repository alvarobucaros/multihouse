var app = angular.module('app', ['ui.bootstrap']);

app.controller('mainController',['$scope','$http','$modal', function($scope,$http, $modal, $log){
    $scope.form_titleMov = 'Digita Operaciones contables';
    $scope.form_title = 'Digita Comprobantes de contabilidad';
    $scope.form_titleActu ='Actualiza Comprobantes pendientes';
    $scope.form_titleRev = 'Reversa Comprobantes Contables';
    $scope.form_titleDupl = 'Duplica comprobante existente';
    $scope.form_titleTrasf = 'Transfiere saldos desde un periodo'
    $scope.form_titleBorra = 'Borra Saldos y activa comprobantes'
    $scope.form_btnNuevo = 'Nuevo registro';
    
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualiza';
    $scope.form_btnDuplica = 'Duplica';
    $scope.form_btnReversa = 'Reversa';
    $scope.form_btnMovi='Ver movimiento';
    $scope.form_btnDupli='Duplica este comprobante';
    $scope.form_btnConti='Trae lista';
    $scope.form_btnProcesa='Procesar';
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
    $scope.form_movicaFecha = 'FECHA';
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
    $scope.form_periodo = 'PERIODO CONTABLE';
    $scope.form_periodoHoy = 'ULTIMO PERIODO CERRADO  ';
    $scope.form_periodoAct = 'PERIODO CONTABLE DESDE';
    $scope.form_periodoNext = 'PERIODO CONTABLE HASTA';
    $scope.titTotal = 'Neto Total:'
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
    $scope.periodo='';
    $scope.fecha='';
    $scope.pages = [];
    $scope.registro = [];
    $scope.empresa = $('#e').val();
    $scope.control= $('#control').val();
    $scope.registro.movicaEmpresaId = $scope.empresa;

    var f = new Date();  
    var fecha= ediFecha(f)
    var periodo = f.getFullYear();
    if (f.getMonth() +1 < 10){periodo+='0'}
    periodo += (f.getMonth() +1);
    $scope.periodoCtble = periodo;
    $scope.show_form = true;
    
    var defaultForm= {   
        movicaId: 0,
        movicaEmpresaId:$scope.empresa,
        movicaComprId:'',
        movicaCompNro:0,
        movicaTerceroId:0,
        movicaDetalle:'',
        movicaProcesado:'N',
        movicaFecha:fecha,
        movicaPeriodo:$scope.periodoCtble,
        movicaDocumPpal:'',
        movicaDocumSec:''
    };
 
    getParam($scope.empresa);
    
    function getParam(empresa){
        control = $scope.control;
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
            $scope.fecha = '01/'+rec[15].substring(4, 6)+'/'+rec[15].substring(0, 4);
            $scope.movicaFecha=$scope.fecha;
            defaultForm.movicaFecha = $scope.fecha;
            $scope.periodoCtble =rec[15]; 
            $scope.movicaFecha = rec[2];
            
            $scope.registro.movicaPeriodo = rec[1];
         
            $scope.periodo = rec[1];
        if(control === '2'){
            $scope.periodoIni = rec[15]; 
            $scope.periodoCont = rec[15];
            $scope.ruedita = true;
            $scope.periodoFin = $scope.periodoCont;
        }
        if(control === 'Z'){
            $scope.periodoCtble =  rec[15];
            $scope.ruedita = true;
        }        
        if(control === 'R'){
            $scope.ruedita = true;
        }
        });
    }

    function ediFecha(f){
        var fecha='';
        if (f.getDate() < 10){fecha='0'}
        fecha += f.getDate() + "/";
        if (f.getMonth() +1<10){fecha +='0'}
        fecha +=  (f.getMonth() +1) + "/" + f.getFullYear()+ ' 00:00:0000';
        return fecha;
    }
        
    if ($scope.control === 'A') // actualiza comprobantes 
    {
        empresa = $('#e').val();
        periodo =  $scope.periodoCtble;
        ope='rc';
        if(control != 'R'){ope='ac';}
        $http.post('modulos/mod_contamovicabeza.php?op=te',{'op':'te', 'empresa':empresa,'periodo':periodo,'ope':ope}).success(function(data){
        $scope.detailsAct = data;
        $scope.configPages();   
        });            
    }
     if ($scope.control === 'Z'  ) // actualiza comprobantes 
     {
        traeMvtoPeriodo('ac');
       
     }

     if ($scope.control === 'R'||$scope.control === 'D' ) // actualiza comprobantes 
     {
         traeMvtoPeriodo('rc');
        //reversaMvtoPeriodo('rc');
     }
     
    $scope.continuaBorrado = function(){
        $scope.ruedita = false;
        empresa = $('#e').val();
        periodo = $scope.periodoCtble;
        $http.post('modulos/mod_contamovicabeza.php?op=bs',{'op':'bs', 'empresa':empresa,'periodo': periodo}).success(function(data){
        if (data === 'Ok'){
            alert ("Saldos del periodo " + periodo + " borrados y sus comprobantes habilitados " 
                    + 'Actualice el priodo en Parámetros contabilidad y ' + 'Ejecute cierre mensual para iniciar de nuevo este periodo');
        }else{
            alert('Error: '+ data);
        };
        $scope.ruedita = true;
        });  
    };
     
     
     function reversaMvtoPeriodo(ope){
        empresa = $('#e').val();
        periodo = $scope.periodoCtble;
        $http.post('modulos/mod_contamovicabeza.php?op=tc',{'op':'tc', 'empresa':empresa,'periodo': periodo,'ope':ope}).success(function(data){
        $scope.detailsActualizar = data;
        $scope.periodoCtble = periodo;
        $scope.configPages();   
        });  
     }  
     
     function traeMvtoPeriodo(ope){
        empresa = $('#e').val();
        periodo = $scope.periodoCtble;
        $http.post('modulos/mod_contamovicabeza.php?op=tc',{'op':'tc', 'empresa':empresa,'periodo': periodo,'ope':ope}).success(function(data){
        $scope.detailsActualizar = data;
 //       $scope.periodoCtble = periodo;
        $scope.configPages();   
        });  
     }
     
    getCombos($scope.empresa, control);
    
    
    function getInfo(){
        control = $scope.control;
        if (control === 'C'){
            empresa = $('#e').val();
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
    
    $scope.sumaDbCr = function (){
     
        $scope.vlrTotal = parseFloat($scope.vlrDb1.replace('',0)) + parseFloat($scope.vlrDb2.replace('',0)) + parseFloat($scope.vlrDb3.replace('',0)) + 
            parseFloat($scope.vlrDb4.replace('',0)) + parseFloat($scope.vlrDb5.replace('',0)) + parseFloat($scope.vlrDb6.replace('',0)) -
            parseFloat($scope.vlrCr1.replace('',0)) - parseFloat($scope.vlrCr2.replace('',0)) - parseFloat($scope.vlrCr3.replace('',0))  -
            parseFloat($scope.vlrCr4.replace('',0)) - parseFloat($scope.vlrCr5.replace('',0)) - parseFloat($scope.vlrCr6.replace('',0));
    $scope.vlrTotal = "$ " + $scope.vlrTotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})
    }; 

    $scope.trasfiere = function(){
        
        perIni = $scope.periodoIni;
        perFin = $scope.periodoFin;
        periodo = $scope.periodoCont;
        er='';
        if(perIni === perFin){
            er="El periodo inicial es igual al final \n";
        }
        if(perIni>perFin){
            er="El periodo inicial es mayor al final \n";
        }
        if(perFin>periodo){
            er="El periodo final es mayor al último cierre \n";
        }
        if(perIni.substring(0, 4) !== perFin.substring(0, 4)){
              er="El periodo inicial es diferente al final. sugerencia: trasfiera hasta el periodo 23 y haga el cierre del ejercicio para pasar al siguiente periodo \n";
        }
        if(er==='')
        { if (confirm('Transfiere saldos desde el periodo : '+perIni+ ' hasta el periodo ' +perFin+' ?')) { 
            $scope.ruedita = false;
            empresa = $('#e').val();
            $http.post('modulos/mod_contamovicabeza.php?op=ts',{'op':'ts', 'empresa':empresa,'perIni': perIni,'perFin': perFin}).success(function(data){
            alert(data);
            $scope.ruedita = true;
            }); 
        }
        }else{
            alert(er);
        }
    };
    
    $scope.actualizaLista = function(){
        empresa = $('#e').val();
        periodo = $scope.periodoCtble;
        $http.post('modulos/mod_contamovicabeza.php?op=tc',{'op':'tc', 'empresa':empresa,'periodo': periodo,'ope':'rc'}).success(function(data){
        $scope.detailsActualizar = data;
        });       
    };

    $scope.continuaLista = function(op){
        traeMvtoPeriodo(op);
    };
    
    $scope.todoBoton = function(){
        $('#idtabla input[type=checkbox]').each(function(){
            if (this.checked) {
                this.checked=false;
            }else{
                this.checked=true;
            }
        });
    };
    
    $scope.buscaCompro = function(info){
        cp= info.movicaComprId;
        empresa = $('#e').val();
        $http.post('modulos/mod_contamovicabeza.php?op=cp',{'op':'cp','empresa':empresa,'cp':cp}).success(function(data){
        rec=data.split(',');
            info.movicaCompNro=rec[0];
            info.compNombre=rec[1];
            
    }); 
    };
 
    $scope.buscaComproTot = function(info){
        cp= info.movicaOperaId;
        empresa = $('#e').val();
        $http.post('modulos/mod_contamovicabeza.php?op=bo',{'op':'bo','empresa':empresa,'cp':cp}).success(function(data){
        info.movicaCompNro=data;
       
        rec=data.split('||');       
        $scope.vlrDb1='';
        $scope.vlrDb2='';
        $scope.vlrDb3='';
        $scope.vlrDb4='';
        $scope.vlrDb5='';
        $scope.vlrDb6='';
        $scope.vlrCr1='';
        $scope.vlrCr2='';
        $scope.vlrCr3='';
        $scope.vlrCr4='';
        $scope.vlrCr5='';
        $scope.vlrCr6='';
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
        $scope.registro.movicaId=0;
        $scope.comprobante = rec[2];
        $scope.secuencia = rec[4];
        $scope.detalleComp1 = rec[1];  

        $scope.detalleComp2 = 'Comprobante: ' + rec[2] + ' ' + rec[3]  + ' Numero :' + rec[4];
        $scope.ventanaPpal=true;
        if(rec[5]!=='&'){
            $scope.cta1 = true;
            $scope.nomCuenta1 = rec[5].replace('&',' - ');
        }
        if(rec[6]!=='&'){
            $scope.cta2 = true;
            $scope.nomCuenta2 = rec[6].replace('&',' - ');
        }
        if(rec[7]!=='&'){
            $scope.cta3 = true;
            $scope.nomCuenta3 = rec[7].replace('&',' - ');
        }
        if(rec[8]!=='&'){
            $scope.cta4 = true;
            $scope.nomCuenta4 = rec[8].replace('&',' - ');
        }
        
        if(rec[9]!=='&'){
            $scope.cta5 = true;
            $scope.nomCuenta5 = rec[9].replace('&',' - ');
        }
        if(rec[10]!=='&'){
            $scope.cta6 = true;
            $scope.nomCuenta6 = rec[10].replace('&',' - ');
        }        
    });  
    };

    $scope.cambiaPeriodoCtble = function(op){
        $scope.periodo = $scope.periodoCtble;    
        traeMvtoPeriodo(op);
    };
    
 
    $scope.proceso = function(){
        $scope.ventanaPpal=true;
        $scope.ventanaSgnda=false;
        $scope.form_title = 'Digita Comprobantes de contabilidad, periodo : ' + $scope.periodoCtble;
        defaultForm.movicaPeriodo = $scope.periodoCtble;
        defaultForm.movicaFecha = '01/'+$scope.periodoCtble.substring(4, 6)+'/'+$scope.periodoCtble.substring(0, 4);
        $scope.registro.movicaPeriodo = $scope.periodoCtble;
        getInfo();
    };
       
    $scope.open = function (detail) {  
       alert('detalles');
    };
          
    $scope.items = [];
     
    $scope.dupMmovimiento = function(info){
        cp = info.movicaComprId;
        empresa = $('#e').val();
        size='lg';
        $scope.currentPageMv = 0;
        $scope.pageSizeMv = 10;
        $scope.pagesMv = [];

        $http.post('modulos/mod_contamovicabeza.php?op=tn',{'op':'tn','empresa':empresa,'cmpbnte':cp}).success(function(data){
            $scope.NrCompro = data; 
        });
        cabeza = info.movicaId;
        $scope.cabeza=cabeza;
        $scope.nrCpbnte=9999;
        $scope.NrCompro=0;
  
        $scope.empresaFchecha = info.movicaFecha;
        $scope.movicaTerceroId = info.movicaTerceroId;    
        $scope.operators1.terceroId = info.movicaTerceroId;
        $scope.detCpbnte = info.movicaDetalle;
        
        var modalInstance = $modal.open({
        templateUrl: 'myModalContentDp.html',
        controller: function ($scope, $modalInstance, items) {
        $scope.items = items;
        $scope.titulin= 'DUPLICA: '+info.compNombre + ' Nr. ' +info.movicaCompNro + ' ' + info.terceroNombre  + ' ' + info.movicaDetalle;
        $scope.titulon = "TERCERO: "+info.terceroNombre;
        $scope.empresaFchecha = info.movicaFecha + '- 00:0:00';
        $scope.form_comprobante = 'Nro comprobante';
        $scope.form_detalle = 'Detalle';
        $scope.form_btnDuplica = 'Duplica';
        $scope.btnCierra = 'Cierra formulario';
        $scope.form_movicaTerceroId = 'Tercero:';
        $scope.form_empresaFchecha = 'Fecha:';
        $scope.comprobante = info.movicaComprId;
        $scope.registroDup=[];

        traeNroComp(empresa,info.movicaComprId);
        muestraMvto(empresa,cabeza);
        $scope.registroDup.nrCpbnte = $scope.NrCompro
        $scope.registroDup.detCpbnte = info.movicaDetalle;
        $scope.registroDup.movicaTerceroId = $scope.movicaTerceroId;
        $scope.registroDup.empresaFchecha = info.movicaFecha;

        function traeNroComp(empresa,cmpbnte){ 
        $http.post('modulos/mod_contamovicabeza.php?op=tn',{'op':'tn','empresa':empresa,'cmpbnte':cmpbnte}).success(function(data){
            $scope.NrCompro = data; 
            $scope.registroDup.nrCpbnte = data;
        });
        };   
        
        function muestraMvto(empresa,cabeza){
            $http.post('modulos/mod_contamovicabeza.php?op=rm',{'op':'rm','empresa':empresa,'cabeza':cabeza}).success(function(data){
                $scope.detailsMv = data;
              //  $scope.configPagesMv();   
            });
        }

        $scope.duplicaComprobante = function(registroDup){
        er='';
        if($scope.registroDup.empresaFchecha===''){er+='falta fecha\n';}
        if($scope.registroDup.detCpbnte===''){er+='falta Detalle\n';}
         if($scope.registroDup.movicaTerceroId==='' || $scope.registroDup.movicaTerceroId === undefined){er+='falta Tercero\n';}
        if(er===''){
            id=info.movicaId;
            cpr=$scope.comprobante ;
            ter=registroDup.movicaTerceroId;//operator1.terceroId
            det=registroDup.detCpbnte;
            nro=$scope.NrCompro;
            fch=registroDup.empresaFchecha;
            em = $('#e').val().trim();
            dato = ter+ '||' + det+ '||'+cpr+'||' + nro+ '||' + fch+ '||' + em+ '||' + id;
            $http.post('modulos/mod_contamovicabeza.php?op=dp',{'op':'dp','dato':dato}).success(function(data){
            alert(data);
            $('#idFormDup').slideToggle();
            $('#idFormDup').css('display', 'none');
            });
        }
        else{
            alert(er);
        }

        } ;
    
        $scope.cierraForm = function (){
            $('#idFormDup').slideToggle();
            $('#idFormDup').css('display', 'none');
        };
        $scope.formToggleDup = function(){
            $scope.registro.movicaFecha = $scope.fecha;
            $('#idFormDup').slideToggle(); 
            $('#idFormDup').css('display', 'none');
        };
   
        $http.post('modulos/mod_contamovicabeza.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators1 = data;
        });
         
        $scope.movicaTerceroId =  info.movicaTerceroId;
        //$scope.registroDup.movicaTerceroId = $scope.movicaTerceroId;
        },
        size: size,
        resolve: {
          items: function () {
            return $scope.items;
          }
        }
      });
         
    } ;
          
     
    $scope.verMmovimiento = function(info){
        cp = info.movicaComprId;
        empresa = $('#e').val();
        size='lg';
        $scope.currentPageMv = 0;
        $scope.pageSizeMv = 10;
        $scope.pagesMv = [];
      
        cabeza = info.movicaId;
        $scope.cabeza=cabeza;
        
        var modalInstance = $modal.open({
        templateUrl: 'myModalContent.html',
        controller: function ($scope, $modalInstance, items) {
        $scope.items = items;
        $scope.titulin= info.compNombre + ' Nr. ' +info.movicaCompNro + ' ' + info.terceroNombre  + ' ' + info.movicaDetalle;
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
        $scope.form_vrlDeb = 'Débitos';
        $scope.form_vrlCre = 'Créditos';
        $scope.form_vrlTot = 'Diferencia';
        $scope.form_comprobante = 'Nro comprobante';
        $scope.form_detalle = 'Detalle';
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

        $scope.duplicaComprobante = function(){
            alert('Duplica');
        }; 
        
        $scope.sumaDbCr = function(){
       //     alert('HOLA');
            $script.vlrTotal = $scope.vlrDb1 + $scope.vlrDb2 + $scope.vlrDb3 + $scope.vlrDb4 + $scope.vlrDb5 + $scope.vlrDb6;
            $script.vlrTotal -= ($scope.vlrCr1 + $scope.vlrCr2 + $scope.vlrCr3 + $scope.vlrCr4 + $scope.vlrCr5 + $scope.vlrCr6);
        }; 
        
        $http.post('modulos/mod_contamovicabeza.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators3 = data;
        });
        $http.post('modulos/mod_contamovicabeza.php?op=2',{'op':'2','empresa':empresa, 'control':'C'}).success(function(data){
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
            empresa = $('#e').val();
            cabeza = info.movicaId;
          //  $scope.registroMov.movicaTerceroId = $scope.cabeza;
          //  if($scope.registroMov.moviConId===''){er+='falta id\n';}
            if($scope.registroMov.moviConCabezaId===''){er+='falta cabeza\n';}
            if($scope.registroMov.moviConDetalle===''){er+='falta detalle\n';}
            if($scope.registroMov.moviConCuenta===''){er+='falta cuenta\n';}
            if($scope.registroMov.moviConDebito===''){$scope.registroMov.moviConDebito=0;}
            if($scope.registroMov.moviConCredito===''){$scope.registroMov.moviConCredito=0;}
            if($scope.registroMov.moviConBase===''){er+='falta base\n';}
            if(($scope.registroMov.moviConImpPorc > 0 || $scope.registroMov.moviConImpValor > 0)
                && $scope.registroMov.moviConImpTipo===''){er+='falta tipo impuesto o retención\n';}
            if ($scope.registroMov.moviConImpTipo !== '' && 
                ($scope.registroMov.moviConImpPorc === 0 && $scope.registroMov.moviConImpValor === 0)){
                    er+='falta porcentaje o valor de imp o retención\n';
                }
            db=parseInt($scope.registroMov.moviConDebito);
            cr=parseInt($scope.registroMov.moviConCredito);
            if($scope.registroMov.moviConImpPorc===''){er+='falta impuesto %\n';}
            if($scope.registroMov.moviConImpValor===''){er+='falta impuesto valor\n';}
            if(db === 0 && cr === 0 ){er+='El valor Cr y el valor Db es cero\n';}
            if(db !== 0 && cr !== 0 ){er+='El valor Cr o el valor Db debe ser mayor a cero\n';}
            if($scope.vlrTotal !== 0){er+='El neto total debe ser cero\n';}
            if (er===''){
               $scope.registroMov.moviTipoCta = 'C';
               if($scope.registroMov.moviConDebito !== 0 ){$scope.registroMov.moviTipoCta = 'D';}
                dato=$scope.registroMov.moviConId+'||'+$scope.registroMov.moviConCabezaId+'||'+$scope.registroMov.moviConDetalle+'||'
                dato+=$scope.registroMov.moviConCuenta+'||'+$scope.registroMov.moviConDebito+'||'+$scope.registroMov.moviConCredito+'||'
                dato+=$scope.registroMov.moviConBase+'||'+$scope.registroMov.moviConImpTipo+'||'+$scope.registroMov.moviConImpPorc+'||'
                dato+=$scope.registroMov.moviConImpValor+'||'+$scope.registroMov.moviConIdTercero+'||';
                dato+=$scope.registroMov.moviDocum1+'||'+$scope.registroMov.moviDocum2+'||'+$scope.registroMov.moviTipoCta;
                $http.post('modulos/mod_contamovicabeza.php?op=am',{'op':'am','dato':dato}).success(function(data){
                alert(data);
                    info.detailsMv = data;
                if(data === 'Ok'){
                    sumaSaldos(empresa,cabeza);
                    $('#idFormMov').slideToggle();
                    muestraMvto(empresa,cabeza);
                    alert('Registro Mvto Actualizado');}
                else{
                    alert(data);
                }    
                
                });
            }else{
                alert(er);
            }
        };

        $scope.editInfoMv =function(info)
        {  
            $scope.registroMov =  info;  
            $('#idFormMov').slideToggle();

        };
        
        
        $scope.clearInfoMov = function(){
        $('#idFormMov').slideToggle();
        };
        
            $scope.deleteInfoMv =function(info)
        { 
            empresa = $('#e').val(); 
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
            $scope.registroMov.moviConId = 0;
            $('#idFormMov').css('display', 'none');
        };
        
        $scope.formToggleMov =function(){
        $('#idFormMov').slideToggle();
//        $scope.formato.$setPristine();
        $scope.registroMov = angular.copy(defaultFormMov);
        $scope.registroMov.moviConId = 0;
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
         
    } ;
     
    $scope.movimiento = function(info){
        cp = info.movicaComprId;
        empresa = $('#e').val();
        size='lg';
        $scope.currentPageMv = 0;
        $scope.pageSizeMv = 10;
        $scope.pagesMv = [];
        $scope.registroMov = [];
        $scope.cabeza = info.movicaId;
        cabeza = info.movicaId;
        $scope.cabeza=cabeza;
        
        var defaultFormMov= {   
            moviConId:0,
            moviConCabezaId:info.movicaId,
            moviConDetalle:info.movicaDetalle,
            moviConCuenta:'',
            moviConDebito:'',
            moviConCredito:'',
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
        $scope.form_vrlDeb = 'Débitos';
        $scope.form_vrlCre = 'Créditos';
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
            $script.vlrTotal = $scope.vlrDb1 + $scope.vlrDb2 + $scope.vlrDb3 + $scope.vlrDb4 + $scope.vlrDb5 + $scope.vlrDb6;
            $script.vlrTotal -= ($scope.vlrCr1 + $scope.vlrCr2 + $scope.vlrCr3 + $scope.vlrCr4 + $scope.vlrCr5 + $scope.vlrCr6);
        };   
        
        $http.post('modulos/mod_contamovicabeza.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators3 = data;
        });
        
        $http.post('modulos/mod_contamovicabeza.php?op=2',{'op':'2','empresa':empresa, 'control':'C'}).success(function(data){
        $scope.operators2 = data;
        });

        $scope.form_btnNuevo = 'Nuevo Movimiento';
        $scope.show_formMov = true;
        $scope.selected = {
          item: $scope.items[0]
        };

        $scope.ok = function () {
          $modalInstance.close($scope.selected.item);
           $('#idForm').slideToggle(); 
        };
          
    
        $scope.updateInfoMov = function(registroMov){
            er='';
            empresa = $('#e').val();
            cabeza = info.movicaId;
            $scope.vlrTotal=0;
            if($scope.registroMov.moviConCabezaId===''){er+='falta cabeza\n';}
            if($scope.registroMov.moviConDetalle===''){er+='falta detalle\n';}
            if($scope.registroMov.moviConCuenta===''){er+='falta cuenta\n';}
            if($scope.registroMov.moviConDebito===''){$scope.registroMov.moviConDebito='0';}
            if($scope.registroMov.moviConCredito===''){$scope.registroMov.moviConCredito='0';}
            if($scope.registroMov.moviConBase===''){er+='falta base\n';}
            if(($scope.registroMov.moviConImpPorc > 0 || $scope.registroMov.moviConImpValor > 0)
                && $scope.registroMov.moviConImpTipo===''){er+='falta tipo impuesto o retención\n';}
            if ($scope.registroMov.moviConImpTipo !== '' && 
                    ($scope.registroMov.moviConImpPorc === 0 && $scope.registroMov.moviConImpValor === 0)){
                        er+='falta porcentaje o valor de imp o retención\n';
                    }
            if($scope.registroMov.moviConImpPorc===''){er+='falta impuesto %\n';}
            if($scope.registroMov.moviConImpValor===''){er+='falta impuesto valor\n';}
            if($scope.registroMov.moviConDebito === 0 && $scope.registroMov.moviConCredito === 0 ){er+='El valor Cr y el valor Db es cero\n';}
            if($scope.registroMov.moviConDebito !== '0' && $scope.registroMov.moviConCredito !== '0' ){er+='El valor Cr o el valor Db debe ser mayor a cero\n';}
            if($scope.vlrTotal !== 0){er+='El neto total debe ser cero\n';}
            if (er===''){
               $scope.registroMov.moviTipoCta = 'C';
               if($scope.registroMov.moviConDebito !== 0 ){$scope.registroMov.moviTipoCta = 'D';}
                dato=$scope.registroMov.moviConId+'||'+$scope.registroMov.moviConCabezaId+'||'+$scope.registroMov.moviConDetalle+'||'
                dato+=$scope.registroMov.moviConCuenta+'||'+$scope.registroMov.moviConDebito+'||'+$scope.registroMov.moviConCredito+'||'
                dato+=$scope.registroMov.moviConBase+'||'+$scope.registroMov.moviConImpTipo+'||'+$scope.registroMov.moviConImpPorc+'||'
                dato+=$scope.registroMov.moviConImpValor+'||'+$scope.registroMov.moviConIdTercero+'||';
                dato+=$scope.registroMov.moviDocum1+'||'+$scope.registroMov.moviDocum2+'||'+$scope.registroMov.moviTipoCta;
                $http.post('modulos/mod_contamovicabeza.php?op=am',{'op':'am','dato':dato}).success(function(data){
                info.detailsMv = data;
  //              alert(data);
                if(data === 'Ok'){
                    sumaSaldos(empresa,cabeza);
                    $('#idFormMov').slideToggle();
                    muestraMvto(empresa,cabeza);
                    alert('Registro Actualizado');}
                else{
                    alert(data);
                }    
                
                });
            }else{
                alert(er);
            }
        };

        $scope.editInfoMv =function(info)
        {  
            $scope.registroMov =  info;  
            $('#idFormMov').slideToggle();

        };
        
        $scope.clearInfoMov = function(){
            $('#idFormMov').slideToggle();
        };
        
        $scope.deleteInfoMv =function(info)
        { 
            empresa = $('#e').val(); 
            cabeza = info.moviConCabezaId;
            if (confirm('Desea borrar el registro con cuenta : '+info.moviConCuenta+ ' ?')) {  
                $http.post('modulos/mod_contamovicabeza.php?op=b',{'op':'b', 'moviConId':info.moviConId}).success(function(data){
                if (data === 'Ok') {
                     sumaSaldos(empresa,cabeza);
                     muestraMvto(empresa, cabeza);//getInfo();
                alert ('Registro Borrado ');
                for(i=0;i<=$scope.detailsMv;i++)
                    {

                    }
                }
                });
             }
        };
    
        $scope.formToggleMov =function(){
            $('#idFormMov').slideToggle(); 
            $scope.moviConId=0;
            $scope.registroMov.moviConId = 0;
            $('#idFormMov').css('display', 'none');
        };
        $scope.formToggleMov =function(){
        $('#idFormMov').slideToggle();
//        $scope.formato.$setPristine();
        $scope.registroMov = angular.copy(defaultFormMov);
        $scope.registroMov.moviConId = 0;
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
   
    $scope.actualizaComprobante = function(caso){
     
        empresa = $('#e').val();
        periodo = $scope.periodoCtble;
        $scope.periodo = periodo;
        var multi=1;
        if (caso === 'rc'){multi=-1;}
        var selected = '';    
        $('#idtabla input[type=checkbox]').each(function(){
            if (this.checked) {
                selected += $(this).val()+',';
            }
        });
        ln = selected.length;
        if(ln===0){
            alert('Debe marcar al menos un comprobante, Botón Continuar');
            return;
        }
        selected = selected.substr(0,ln-1);
    $scope.ruedita = false;
        $http.post('modulos/mod_contamovicabeza.php?op=ac',{'op':'ac','empresa':empresa,'ids':selected,'periodo':periodo,'multi':multi}).success(function(data){
        traeMvtoPeriodo(caso);
        alert(data);
        $scope.ruedita = true;
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
    $scope.movicaId=0;
    $('#idForm').css('display', 'none');
    };
    
// Function to add toggle behaviour to form
    $scope.formToggle =function(){
        $('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
        $('#movicaFecha').val($scope.fecha);
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
        periodo = $scope.periodoCtble;
        $http.post('modulos/mod_contamovicabeza.php?op=exp',{'op':'exp','empresa':empresa,'periodo':periodo}).success(function(data){
        $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
};

    $scope.deleteInfo =function(info)
    { 
        empresa = $('#e').val(); 
        if (confirm('Desea borrar el comprobante con nombre : '+info.compNombre+' '+info.terceroNombre+' junto con todo su movimiento ?')) {  
            $http.post('modulos/mod_contamovicabeza.php?op=bc',{'op':'bc', 'movicaId':info.movicaId,'empresa':empresa}).success(function(data){
            if (data === 'Ok') {
            getInfo();
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfoDigi =function(info)
    {
        er='';
        empresa = $('#e').val(); 
        periodo = $scope.periodoCtble;
        fecha=$scope.movicaFecha;
       // if($('#movicaId').val()===''){er+='falta id\n';}
        if($('#movicaEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#movicaComprId').val()===''){er+='falta comprobante\n';}
        if($('#movicaCompNro').val()===''){er+='falta numero\n';}
        if($('#movicaTerceroId').val()===''){er+='falta tercero\n';}
        if($('#movicaDetalle').val()===''){er+='falta detalle\n';}
        if($('#movicaProcesado').val()===''){er+='falta procesado\n';}
        if($('#movicaFecha').val()===''){er+='falta fecha\n';}
        if($('#movicaPeriodo').val()===''){er+='falta periodo\n';}
        if($scope.vlrTotal !=="$ 0,00"){er+='El neto total debe ser cero\n';}
        if($scope.vlrTotal === undefined){er+='No hay valores registrados\n';}
        if($scope.registro.movicaTerceroId === undefined){er+='falta tercero\n';}
        if(info.movicaTerceroId === 0){er+='falta tercero\n';}
        vlrTotal = parseFloat($scope.vlrDb1.replace('',0)) + parseFloat($scope.vlrDb2.replace('',0)) + parseFloat($scope.vlrDb3.replace('',0)) + 
            parseFloat($scope.vlrDb4.replace('',0)) + parseFloat($scope.vlrDb5.replace('',0)) + parseFloat($scope.vlrDb6.replace('',0)) +
            parseFloat($scope.vlrCr1.replace('',0)) + parseFloat($scope.vlrCr2.replace('',0)) + parseFloat($scope.vlrCr3.replace('',0)) +
            parseFloat($scope.vlrCr4.replace('',0)) + parseFloat($scope.vlrCr5.replace('',0)) + parseFloat($scope.vlrCr6.replace('',0));       
        if(vlrTotal === 0){er+='No hay valores registrados\n';}
        if (er===''){
        dto = info.movicaCompNro.split("||");
        dato = info.movicaOperaId + '||' + info.movicaEmpresaId.trim() + '||' + periodo+ '||' + $scope.movicaFecha + '||' + 
               info.movicaTerceroId + '||' + $scope.detalleComp1 + '||' + info.movicaFecha+ '||' + 
               info.movicaPeriodo + '||' + info.movicaDocumPpal+ '||' + info.movicaDocumSec+ '||' + 
               $scope.comprobante + '||' +  $scope.secuencia  + '||' + dto[0]  + '||' + 
               $scope.vlrDb1 + '||' + $scope.vlrCr1 + '||' + $scope.vlrDb2 + '||' + $scope.vlrCr2 + '||' + 
               $scope.vlrDb3 + '||' + $scope.vlrCr3 + '||' + $scope.vlrDb4 + '||' + $scope.vlrCr4 + '||' + 
               $scope.vlrDb5 + '||' + $scope.vlrCr5 + '||' + $scope.vlrDb6 + '||' + $scope.vlrCr6 + '||' +
               Cta($scope.nomCuenta1) + '||' + Cta($scope.nomCuenta2) + '||' + Cta($scope.nomCuenta3) + '||' +
               Cta($scope.nomCuenta4) + '||' + Cta($scope.nomCuenta5) + '||' + Cta($scope.nomCuenta6) ;
   
        $http.post('modulos/mod_contamovicabeza.php?op=ao',{'op':'ao', 'dato':dato}).success(function(data){
//alert(data);
        if (data === 'Ok') {
            $scope.vlrDb1 =''; 
            $scope.vlrCr1 =''; 
            $scope.vlrDb2 =''; 
            $scope.vlrCr2 =''; 
            $scope.vlrDb3 =''; 
            $scope.vlrCr3 =''; 
            $scope.vlrDb4 =''; 
            $scope.vlrCr4 =''; 
            $scope.vlrDb5 =''; 
            $scope.vlrCr5 =''; 
            $scope.vlrDb6 =''; 
            $scope.vlrCr6 =''; 
            info.movicaTerceroId='';
            info.movicaOperaId = '';
            $scope.ventanaPpal = false;
            alert ('Movimiento actualizado Ok ');
    //        $('#idFormMv').slideToggle();
        }
        });
   }else{alert (er);}  
    };

    function Cta(cta){
        var n = cta.indexOf("-");
        return cta.substr(0, n-1).trim();
    }
    
    $scope.updateInfo =function(info)
    {
        er='';
        empresa = $('#e').val(); 
        if($('#movicaId').val()===''){er+='falta id\n';}
        if($('#movicaEmpresaId').val()===''){er+='falta empresa\n';}
        if(info.movicaComprId===''){er+='falta comprobante\n';}
        if(info.movicaCompNro===0){er+='falta numero de comprobante\n';}
        if(info.movicaTerceroId===0){er+='falta tercero\n';}
        if($('#movicaDetalle').val()===''){er+='falta detalle\n';}
        if($('#movicaProcesado').val()===''){er+='falta procesado\n';}
        if($('#movicaFecha').val()===''){er+='falta fecha\n';}
        if($('#movicaPeriodo').val()===''){er+='falta periodo\n';}
//        if($('#movicaDocumPpal').val()===''){er+='falta documppal\n';}
//        if($('#movicaDocumSec').val()===''){er+='falta documsec\n';}
        if (er===''){
        $http.post('modulos/mod_contamovicabeza.php?op=a',{'op':'a', 'movicaId':info.movicaId, 'movicaEmpresaId':info.movicaEmpresaId, 'movicaComprId':info.movicaComprId, 'movicaCompNro':info.movicaCompNro, 'movicaTerceroId':info.movicaTerceroId, 'movicaDetalle':info.movicaDetalle, 'movicaProcesado':info.movicaProcesado, 'movicaFecha':info.movicaFecha, 'movicaPeriodo':info.movicaPeriodo, 'movicaDocumPpal':info.movicaDocumPpal, 'movicaDocumSec':info.movicaDocumSec}).success(function(data){
            rec=data.split(',');
            if (rec[0] === 'Ok') {
                $scope.registro.movicaId  = rec[1];
                getInfo();
                alert ('Registro Actualizado ');
                $scope.movimiento(info); 
        }
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfo =function(info)
    {
        $('#idForm').slideToggle();
        $scope.formato.$setPristine();
//        console.log('empty');
//        $('#idFormMv').slideToggle();
    };

}]);

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< 
