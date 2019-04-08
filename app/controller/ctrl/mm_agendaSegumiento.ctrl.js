var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Seguimiento de reunión (Desarrollo)';

    $scope.form_nuevaActa= ' Crea acta ';
    $scope.form_titleTerc='Adiciona participanteCambios en el tercero';
    $scope.form_titleTercero='Modifica datos del invitado';
    $scope.form_titleaddTema='Modifica tema ';
    $scope.form_titleTema='Adiciona tema';
    $scope.form_btnNuevoInv = 'Nuevo invitado';
    $scope.form_btnNuevoTema = 'Nuevo tema';
    $scope.form_btnAdd = 'Adiciona registro';
    $scope.form_btnEdita = 'Edita registro';
    $scope.form_btnElimina = 'Elimina registro';
    $scope.form_btnAcepta = 'Acepta';
    $scope.form_asistente_nombre = 'Nombre';
    $scope.form_asistente_empresa = 'Empresa';
    $scope.form_asistente_cargo = 'Cargo';
    $scope.form_agenda_comiteId = 'COMITE';
    $scope.form_asistente_celuar = 'Celular';
    $scope.form_asistente_email = 'Correo';
    $scope.form_asistente_orden = 'Orden secuencial';
    $scope.form_asistente_celular = 'Nro Celular';
    $scope.form_asistente_email='Correo electrónico';
    $scope.form_btnActualiza = 'Actualiza';
    $scope.form_btnAnula = 'Cierra';
    $scope.form_asistente_asiste='Asiste ? ';
    $scope.form_asistente_causa='Motivo inasistencia :';
    $scope.form_asisteS = 'Si';
    $scope.form_asisteN = 'No';
    $scope.form_tituloP = 'Presidente'; 
    $scope.form_tituloS = 'Secretario';
    $scope.form_tituloT = 'Transcriptor';
    $scope.form_temasTratar = 'Temas a tratar';
    $scope.form_tituloN = 'Ninguno'; 
    $scope.form_asistente_titulo = 'Título';
    $scope.form_tema_titulo="Tema";
    $scope.form_tema_detalle="Detalle";
    $scope.form_tema_responsable = 'Responsable';
    $scope.form_tema_tipo = 'Tipo tema';
    $scope.form_tema_fechaAsigna = 'Fecha asignado';
    $scope.form_tema_fechaCumple = 'Fecha cumplido';
    $scope.form_temag = 'Tema general';
    $scope.form_temap = 'Tema pendiente';
    $scope.form_tema_desarrollo='Desarrollo';
    $scope.form_tema_estado="Activo ?";
    $scope.form_convocatoria='Fecha y hora  próxima reunión';
    
    $scope.vista=false;
    $scope.registroTr = {};
    $scope.detailAsiste = {};
    $scope.registroTm = {};
    $scope.registroTema = {};
    $scope.registroTercero = {};
    $scope.registroAddTema = {};
    
    $scope.causal = false;
    $scope.invisible = false;
    $scope.addtemaTema = false;
    $scope.responseDiv = false;
    $scope.frmTercero1 = false;
    $scope.frmTemas = false;
    $scope.Convocatoria = false;
    $scope.comite_id=0;
    $scope.tema_id=0;
    $scope.agenda_id=0;
    $scope.empresa = $('#e').val();
    $scope.hoy = '';
    
    getCombos($scope.empresa);
       
    getIni();

    function getIni()
        {
            hoy = new Date();
            var mes = hoy.getMonth() + 1;
            fechaHoy = hoy.getFullYear()+'-';
            if (mes < 10) {fechaHoy +='0';}
            fechaHoy += mes+'-';
            if (hoy.getDate() < 10) {fechaHoy +='0';}
            fechaHoy +=  hoy.getDate();
            $scope.hoy = fechaHoy;
            $scope.responseDiv = 'false';
            $scope.tercForm = 'false';
        }

    function getCombos(empresa){
         $http.post('modulos/mod_mm_agendamiento.php?op=1',{'op':'1','empresa':empresa}).success(function(data){            
         $scope.operators1 = data;
         });    
    }
  

    $scope.focusfn = function () {
    $scope.focus = true;
    };

    $scope.blurfn = function () {
    $scope.focus = false;
    };
    $scope.focusfnTema = function () {
    $scope.focus = true;
    };

    $scope.blurfnTema = function () {
    $scope.focus = false;
    };        

        
    $scope.updateComite = function() {  // nc=nombre comite

          $http.post('modulos/mod_mm_agendamiento.php?op=dc',{'op':'dc', 'comiteId':'comite_id'}).success(function(data){
  
          if(data=='NO HAY'){
            alert ('No hay seguimiento para esta reunión pues el comité no tiene agendamiento pendiente');
            $scope.responseDiv = false;
            $scope.frmTercero1 = false;
            $scope.frmTemas = false;
            $scope.resultado = '';
          }
          else
          {
            res = data.split("||");
            $scope.resultado = res[0];
            $scope.comite_id=res[1];
            $scope.agenda_id = res[1];
            $scope.responseDiv = true;
            $scope.frmTercero1 = true;
            $scope.frmTemas = true;
            traeTemas(res[1]);
            traeInvitados(res[1]);
               $scope.vista=true;
          }
      }); 
    };    
    
    $scope.cualMotivoS = function(){
        $scope.causal = false;
    };
    
    $scope.cualMotivoN = function(){
        $scope.causal = true;
    };
    
    $scope.createDetailAsiste = function(){
       $scope.form_titleTercero='Adiciona datos de participante ';
       $http.post('modulos/mod_mm_agendamiento.php?op=sel',{'op':'sel','agenda_id': $scope.comite_id,'opc':'I'}).success(function(data){
       $scope.registroTr.asistente_orden = data; 
       $scope.registroTr.titulo = 'N';
       });   
       
       $scope.tercForm = 'true';
       
    };
    
    $scope.editDetailAsiste = function(detailAsiste){
       var str = detailAsiste.invitado_titulo;
        $scope.form_titleTercero='Modifica datos del participante : '+detailAsiste.invitado_nombre;
        $scope.registroTercero.asistente_nombre = detailAsiste.invitado_nombre;
        $scope.registroTercero.asistente_cargo = detailAsiste.invitado_cargo;  
        $scope.registroTercero.asistente_empresa = detailAsiste.invitado_empresa;  
        $scope.registroTercero.asistente_asiste = detailAsiste.invitado_asistio;
        $scope.registroTercero.asistente_titulo = str.substring(0, 1);
        $scope.registroTercero.asistente_causa = '';  
        $scope.registroTercero.asistente_orden = detailAsiste.invitado_orden;  
        $scope.registroTercero.asistente_id = detailAsiste.invitado_id;        
        $scope.registroTercero.asistente_celular = detailAsiste.invitado_celuar;
        $scope.registroTercero.asistente_email = detailAsiste.invitado_email;
        $scope.terceroForm = 'true';
    };
    
    
    $scope.deleteDetailAsiste = function(detailAsiste)
      { 
        if (confirm('Desea borrar el registro con nombre : '+detailAsiste.invitado_nombre+' ?')) {  
            var comiteId = $scope.sgmnto_comiteId;
            $http.post('modulos/mod_mm_agendamiento.php?op=dtl',{'op':'dtl', 'invitado_id':detailAsiste.invitado_id}).success(function(data){
            if (data === 'Ok') {
            traeInvitados($scope.comite_id);
            alert ('Registro con nombre '+detailAsiste.invitado_nombre+' Borrado ');
            }
            });
         }
    };  
    
    $scope.editDetailTema = function(detailTema){
    //    alert(JSON.stringify(detailTema)); 
        datos = detailTema.tema_id+'||'+detailTema.tema_agendaId+'||'+detailTema.tema_comite+'||'+detailTema.tema_tipo;
        datos += detailTema.tema_titulo+'||'+detailTema.tema_detalle+'||'+detailTema.tema_desarrollo+'||'+detailTema.tema_responsable+'||';
        datos += detailTema.tema_estado+'||'+detailTema.tema_orden+'||'+detailTema.tema_fechaAsigna+'||'+detailTema.tema_fechaCumple;
        $scope.comite_id=detailTema.tema_comite;
        $scope.tema_id=detailTema.tema_id;
        $scope.agenda_id= detailTema.tema_agendaId;
        var str = detailTema.tema_tipo;
        $scope.form_titleaddTema='Modifica tema : '+detailTema.tema_titulo; 
        $scope.registroAddTema.tema_titulo = detailTema.tema_titulo;
        $scope.registroAddTema.tema_detalle = detailTema.tema_detalle;
        $scope.registroAddTema.tema_desarrollo = detailTema.tema_desarrollo;
        $scope.registroAddTema.tema_responsable = detailTema.tema_responsable;
        $scope.registroAddTema.tema_estado = detailTema.tema_estado;
        $scope.registroAddTema.tema_orden = detailTema.tema_orden;
        $scope.registroAddTema.tema_tipo = str.substring(0, 1);
        $scope.registroAddTema.tema_fechaAsigna = detailTema.tema_fechaAsigna;
        $scope.registroAddTema.tema_fechaCumple = detailTema.tema_fechaCumple;
        if (detailTema.tema_fechaCumple.substr(0, 4)=='0000'){
            $scope.registroAddTema.tema_fechaCumple = $scope.hoy ; 
        }
        
        $scope.registroAddTema.tema_id = detailTema.tema_id;
        $scope.addtemaTema = 'true';
    };


    $scope.createDetailTema = function(){
        $scope.form_titleaddTema='Adiciona un nuevo tema';
        $scope.registroAddTema={};
        $scope.registroAddTema.tema_estado = 'A';
        $scope.registroAddTema.tema_tipo = 'G';
        $scope.registroAddTema.tema_id = 0;
        $http.post('modulos/mod_mm_agendamiento.php?op=sel',{'op':'sel','agenda_id': $scope.comite_id,'opc':'T'}).success(function(data){
       $scope.registroAddTema.tema_orden = data;   
       }); 
        var hoy = new Date();
        var mes = hoy.getMonth() + 1;
        var dia = hoy.getDate();
        fechaHoy = hoy.getFullYear()+'-';
        if(mes < 10){fechaHoy += '0';}
        fechaHoy += mes+'-';
        if(dia < 10){fechaHoy += '0';}
        fechaHoy += dia;
        $scope.registroAddTema.tema_fechaAsigna = fechaHoy; 
        $scope.registroAddTema.tema_fechaCumple = fechaHoy; 
        $('#addtemaForm').show();
        $scope.addtemaTema = 'true';
    };
    
    
    $scope.deleteDetailTema = function(detailTema)
      { 
        if (confirm('Desea borrar el registro de título : '+detailTema.tema_titulo+' ?')) {  
            var comiteId = $scope.sgmnto_comiteId;
            $http.post('modulos/mod_mm_agendamiento.php?op=dtm',{'op':'dtm', 'tema_id':detailTema.tema_id}).success(function(data){
            if (data === 'Ok') {
            traeTemas($scope.comite_id);
            alert ('Tema '+detailTema.tema_titulo+' Borrado ');
            }
            });
         }
    };
    
    $scope.clearInfoTr = function(){
         $scope.tercForm = 'false';
         $scope.registroTr = {};
    };
    
    

   
    
    $scope.clearInfoAddTema = function(){
        $scope.addtemaTema = 'false';
        $scope.registroTema = {};   
    };
    
    $scope.clearInfoTema = function(){
         $scope.temaTema = 'false';
         $scope.registroTema = {};
    };
    
    $scope.clearInfoTercero = function(){
         $scope.terceroForm = 'false';   
         $scope.registroTercero = {};
    };
    
    
    $scope.updateInfoTr = function (registroTr) {
        celular='';
        email='';
        titulo=$scope.registroTr.asistente_titulo;
        if(titulo===undefined){titulo='N'}
        empresa = $scope.empresa.trim();
        if($scope.registroTr.asistente_celuar !== undefined){celular=$scope.registroTr.asistente_celuar;} 
        if($scope.registroTr.asistente_email !== undefined){email=$scope.registroTr.asistente_email;}  
        
        var datos = $scope.sgmnto_comiteId+'||'+$scope.registroTr.asistente_nombre+'||'+$scope.registroTr.asistente_cargo +'||'+
                    $scope.registroTr.asistente_empresa+'||S||'+titulo+'||||0||0||'+$scope.agenda_id+'||'+
                    $scope.registroTr.asistente_celuar+'||'+ registroTr.asistente_email+'||0||'+empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=atl',{'op':'atl', 'datos':datos}).success(function(data){
//alert(data);            
        if (data === 'Ok') {
        traeInvitados($scope.comite_id);
        $scope.tercForm = false;
        alert ('Registro adcionado ');
        }
        });
  };
    
    $scope.updateInfoTercero = function(detailAsiste){     
        titulo = detailAsiste.asistente_titulo;
        if(titulo === undefined){titulo='N';};
        asistente_asiste =  $scope.registroTercero.asistente_asiste;
        if(asistente_asiste===undefined){asistente_asiste='';}
        var datos = $scope.sgmnto_comiteId+'||'+$scope.registroTercero.asistente_nombre+'||'+$scope.registroTercero.asistente_cargo;
        datos += '||'+ $scope.registroTercero.asistente_empresa + '||'+ asistente_asiste + '||';
        datos += titulo + '||'+  $scope.registroTercero.asistente_causa + '||';
        datos += $scope.registroTercero.asistente_id + '||'+  $scope.registroTercero.asistente_orden +'||'+$scope.comite_id + '||';
        datos += $scope.registroTercero.asistente_celular + '||'+  $scope.registroTercero.asistente_email +'||'+$scope.registroTercero.asistente_id;
//alert(datos);
        $http.post('modulos/mod_mm_agendamiento.php?op=ctl',{'op':'ctl', 'datos':datos}).success(function(data){
//alert(data);            
        if (data === 'Ok') {
            traeInvitados($scope.comite_id);
            $scope.terceroForm = false;
            alert ('Registro actualizado ');
        }
        });
    };

 
    
     $scope.updateInfoTema = function (registroTema) {
        desarrollo = $scope.registroAddTema.tema_desarrollo;
        if(desarrollo===undefined){desarrollo='';}
        if(titulo === undefined){titulo='N';};
        var datos = $scope.comite_id+'||'+$scope.sgmnto_comiteId+'||'+$scope.registroTema.tema_titulo+'||'+
                    $scope.registroTema.tema_detalle+'||'+$scope.registroTema.tema_responsable+'||'+registroTema.agenda_id + '||'+
                    desarrollo;
   //   alert(datos); return;
         $http.post('modulos/mod_mm_agendamiento.php?op=atm',{'op':'atm', 'datos':datos}).success(function(data){
        if (data === 'Ok') {
            traeTemas($scope.comite_id);
            alert ('tema creado ');
        }
        });
      };
      
      $scope.updateInfoAddTema= function (registroTema) {
        desarrollo = $scope.registroAddTema.tema_desarrollo;
        if(desarrollo===undefined){desarrollo='';}
        tema_responsable =  $scope.registroAddTema.tema_responsable;
        if(tema_responsable===undefined){tema_responsable='';}
           var datos = $scope.registroAddTema.tema_id+'||'+$scope.agenda_id +'||'+$scope.empresa+'||'+
                    $scope.comite_id+'||'+$scope.registroAddTema.tema_titulo+'||'+$scope.registroAddTema.tema_detalle+'||'+
                    $scope.registroAddTema.tema_tipo+'||'+tema_responsable+'||'+$scope.registroAddTema.tema_fechaCumple+'||'+
                    $scope.registroAddTema.tema_fechaAsigna+'||'+ desarrollo + '||'+
                    $scope.registroAddTema.tema_estado+'||'+ $scope.agenda_id+'||'+ $scope.registroAddTema.tema_orden; 
        $http.post('modulos/mod_mm_agendamiento.php?op=atm',{'op':'atm', 'datos':datos}).success(function(data){
        if (data === 'Ok') {
            traeTemas($scope.agenda_id);
            alert ('tema modificado ');
            $scope.addtemaTema = false;
        }
        });
      };
      
      $scope.createActa = function(registro){
           var datos =  $scope.sgmnto_comiteId+'||'+$scope.comite_id+'||'+$scope.empresa; // comite, agenda, empresa
           $scope.Convocatoria = true;
      };
      
      $scope.convocatoria = function(){
        empresa = $scope.empresa.trim();
        var datos =  $scope.sgmnto_comiteId+'||'+$scope.comite_id+'||'+empresa+'||'+$scope.registroTercero.convocatoria;
        $http.post('modulos/mod_mm_agendamiento.php?op=conv',{'op':'conv', 'datos':datos}).success(function(data){
//alert(data);            
        res = data.split("||");
        if (res[0] === 'Ok') {            
            alert (res[1]);
        }
         $scope.Convocatoria = false;
        });
      };
      
      
    function traeTemas(agendaId){
         empresa = $scope.empresa;
         $http.post('modulos/mod_mm_agendamiento.php?op=tt',{'op':'tt','agenda_id':agendaId,'empresa':empresa}).success(function(data){     
          if(data=='NO HAY'){
             alert ('No hay temas definidos');
          }
          else
            {
                $scope.detailTemas = data;
            }   
         });  
    }
    
    function traeInvitados(agendaId){
        empresa = $scope.empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=ti',{'op':'ti','agenda_id':agendaId,'empresa':empresa}).success(function(data){
//alert (data);        
            if(data=='NO HAY'){
             alert ('No hay invitados a la reunión definidos');
          }
          else
          {
         $scope.detailAsistes = data;
     }
         });  
    }
    }]);


// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Jan 6, 2018 9:41:16   <<<<<<< 


