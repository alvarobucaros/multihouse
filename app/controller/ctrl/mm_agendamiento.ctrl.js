var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Agenda reunión';
    $scope.form_titleTercero='Actualiza datos del invitado';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnEnFirme='Dejar en Firme';
    $scope.form_btnAnulaRegistro = 'Cancelar reunión';
    $scope.form_btnConfirmar = 'Confirmar';
    $scope.form_btnBuscar = 'Busca reuniones';     
    $scope.form_btnCrear='Crea solicitud';    
    $scope.form_btnCitacion='Enviar citaciones';
    $scope.form_tituloP = 'Presidente'; 
    $scope.form_tituloS = 'Secretario';
    $scope.form_tituloT = 'Transcriptor';
    $scope.form_tituloN = 'Ninguno'; 
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_asistente_orden = 'Orden secuencial';
    $scope.form_asistente_nombre = 'Nombre';
    $scope.form_asistente_empresa = 'Empresa';
    $scope.form_asistente_cargo = 'Cargo';
    $scope.form_asistente_celular="Tel. celular";
    $scope.form_asistente_email = 'Correo electrónico';
    $scope.form_asistente_titulo='Título';
    $scope.form_agenda_id = 'ID';
    $scope.form_agenda_empresa = 'EMPRESA';
    $scope.form_agenda_salonId = 'SALON';
    $scope.form_agenda_Descripcion = 'DETALLE COMITE';
    $scope.form_agenda_comiteId = 'COMITE';
    $scope.form_agenda_reunionId = 'REUNION';
    $scope.form_agenda_fechaDesde = 'FECHA DESDE';
    $scope.form_agenda_fechaHasta = 'FECHA HASTA';
    $scope.form_agenda_fechaReserva = 'FECHA RESERVA';
    $scope.form_agenda_hora = 'HORA';
    $scope.form_agenda_reservadoPor = 'RESERVADO POR';
    $scope.form_agenda_comiteAnteriorId = 'COMITE ANTERIOR';
    $scope.form_agenda_comiteCausaAnulacion = 'CAUSA CANCELACION';
    $scope.form_agenda_comiteEnviaCitacion = 'NOTA AL CORREO DE CITACION';
    $scope.form_tema_titulo = 'TITULO';
    $scope.form_tema_detalle = 'DETALLE';
    $scope.form_tema_tipo = 'TIPO';
    $scope.form_tema_responsable = 'RESPONSABLE';
    $scope.form_tema_fechaAsigna = 'FECHA ASIGNA';
    $scope.form_tema_estado = 'ESTADO';

    $scope.form_Activo90 = 'INACTIVO';
    $scope.form_Activo91 = 'ACTIVO';

    $scope.form_Phagenda_id = 'Digite id';
    $scope.form_Phagenda_empresa = 'Digite empresa';
    $scope.form_Phagenda_salonId = 'Digite salon';
    $scope.form_Phagenda_Descripcion = 'Digite descripcion';
    $scope.form_Phagenda_comiteId = 'Digite comite';
    $scope.form_Phagenda_fechaDesde = 'Digite fch desde';
    $scope.form_Phagenda_fechaHasta = 'Digite fch hasta';
    $scope.form_Phagenda_fechaReserva = 'Digite fch reserva';
    $scope.form_Phagenda_comiteAnteriorId = 'Digite comite_anterior';
    $scope.form_Phagenda_reservadoPor="Quien hace la reserva";
    $scope.form_PhcomiteCausaAnulacion="Causa para anular agendamiento";
    $scope.form_nuevotema= ' Crea nuevo tema ';
    $scope.form_nuevoinvitado= ' Crea nuevo invitado ';
    $scope.form_tema_titulo="Tema";
    $scope.form_temag = 'Tema general';
    $scope.form_temap = 'Tema pendiente';
    
    $scope.modelTab2 = false;
    $scope.modelTab3 = false;
    $scope.modelTab4 = false;
    $scope.modelTab5 = false;
    $scope.datosOcultos = false;
    $scope.temaNuevo= false;
    $scope.listaComite = false;
    $scope.btnBusca = true;
    $scope.btnActualizar=false;
    $scope.agenda_salonIdtmp=0;
    $scope.agenda_comiteIdtmp=0;
    $scope.agenda_agendaIdtmp=0;
    $scope.comite_id =0;
    $scope.agenda_id =0;
    
    $scope.registro1 = {};
    $scope.registro1 = {};
    $scope.registro3 = {};
    $scope.registro4 = {};
    $scope.registro5 = {};
    $scope.registroTercero = {};
    
    $scope.empresa = $('#e').val();

    var hoy = new Date();
    var mes = hoy.getMonth() + 1;
    fechaHoy = hoy.getFullYear()+'-'+mes+'-'+ hoy.getDate();

    $scope.agenda_fechaDesde = fechaHoy+'T00:00 ';
    $scope.agenda_fechaHasta = fechaHoy+'T00:00 ';
    
    fechaHoy += 'T'+hoy.getHours()+':'+ hoy.getMinutes()+' ';
    $scope.fechaHoy = fechaHoy;
    var hoy = new Date();
    $scope.registro1.agenda_fechaReserva=fechaHoy;
   
    getCombos($scope.empresa);
       
    getIni();

function getIni()
{
    hoy = new Date();
    d='';    if (hoy.getDate()<'10'){d='0';}    d+=hoy.getDate();
    m='';    if ((hoy.getMonth()+1)<'10'){m='0';}    m+=(hoy.getMonth()+1);
    var miDia = d+'/'+m+'/'+hoy.getFullYear();

    var myname = $('#my-name').text();
    var myempre = $('#e').val();
    var myuser = $('#u').val();
    $scope.registro1.agenda_reservadoPor = myname;
    $scope.registro1.agenda_fechaDesde=miDia;
    $scope.registro1.agenda_fechaHasta=miDia;
    $scope.registro1.agenda_empresa=myempre;
    $scope.registro4.tema_empresa =myempre;
    $scope.registro1.agenda_usuario=myuser;
    $('#agenda_fechaDesde').val(hoy);

}

    function getCombos(empresa){
        $http.post('modulos/mod_mm_agendamiento.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
         $scope.operators0 = data;
         });  
 
        $http.post('modulos/mod_mm_agendamiento.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
         $scope.operators1 = data;
         });
         
        $http.post('modulos/mod_mm_agendamiento.php?op=hr',{'op':'hr','empresaId':empresa}).success(function(data){
         $scope.operatorshd = data;
         }); 
} 


   function getInfo(){
      
    }

    $scope.buscaRegistros = function(){
        $scope.listaComite = false;
        $http.post('modulos/mod_mm_agendamiento.php?op=2',{'op':'2','comite_id':$scope.agenda_comiteIdtmp}).success(function(data){
            $scope.operators2 = data;
            $scope.listaComite = true;
        });   
    };
 
    $scope.traeComiteLista = function(){
        $scope.agendaId=$scope.registro1.agenda_agendaId;
        empresa =   $('#e').val();
        $http.post('modulos/mod_mm_agendamiento.php?op=lur',{'op':'lur','agenda_id':$scope.registro1.agenda_agendaId,
            'empresa':empresa}).success(function(data){
 //    alert(data);       
            
        rec = data.split('||');  
        $scope.registro1.agenda_empresa = rec[0];
        $scope.registro1.agenda_salonId = rec[1];
        $scope.registro1.agenda_Descripcion = rec[2];
        $scope.registro1.agenda_comiteId = rec[3]; 
        $scope.comite_id = rec[3];
        tm=rec[4].split(' ');        
        $scope.registro1.agenda_fechaDesde = tm[0];
        $scope.registro1.agenda_horaDesde = tm[1].substr(0, 5);
        tm=rec[5].split(' ');       
        $scope.registro1.agenda_fechaHasta = tm[0];
        $scope.registro1.agenda_horaHasta = tm[1].substr(0, 5);
        $scope.registro1.agenda_comiteAnteriorId= rec[6];
        $scope.registro1.agenda_usuario= rec[7];
        $scope.registro1.agenda_enFirme= rec[8];
        $scope.registro1.agenda_conCitacion= rec[9];
        $scope.registro1.comite_id = rec[13];
        $scope.agenda_id =   rec[13];
        $scope.agenda_Descripcion=rec[2];
        $scope.comite_nombreResul=rec[12]; 
        $scope.salon_nombreResul=rec[11];
        $scope.agenda_id=  rec[13]; //$scope.registro1.agenda_id;
        $scope.modelTab3 = true;  
        $scope.modelTab4 = true;  
        $scope.modelTab5 = true;
        $scope.btnBusca = false; 
        $scope.btnActualizar=true;
        $scope.registro5.agenda_Id=$scope.registro1.agenda_agendaId;
   
        traeInvitados($scope.agendaId);
        traeTemas($scope.agendaId);
     });
    };
    
    $scope.deleteDetailAsiste = function(detailAsiste)
      { 
        if (confirm('Desea borrar el registro con nombre : '+detailAsiste.invitado_nombre+' ?')) {  
            var invitado_id = detailAsiste.invitado_id;
            $http.post('modulos/mod_mm_agendamiento.php?op=dtl',{'op':'dtl', 'invitado_id':invitado_id}).success(function(data){
            if (data === 'Ok') {
                traeInvitados($scope.registro1.agenda_agendaId);
            alert ('Registro Borrado ');
            }
            });
         }
    };  
    
    $scope.editDetailAsiste = function(detailAsiste){
        $scope.terceroForm = true;
        var str = detailAsiste.invitado_titulo;
        $scope.form_titleTercero='Modifica datos del participante : '+detailAsiste.invitado_nombre;
        $scope.registroTercero.asistente_nombre = detailAsiste.invitado_nombre;
        $scope.registroTercero.asistente_cargo = detailAsiste.invitado_cargo;  
        $scope.registroTercero.asistente_empresa = detailAsiste.invitado_empresa;  
        $scope.registroTercero.asistente_celular = detailAsiste.invitado_celuar;
        $scope.registroTercero.asistente_email = detailAsiste.invitado_email;
        $scope.registroTercero.asistente_titulo = str.substring(0, 1);
        $scope.registroTercero.asistente_orden = detailAsiste.invitado_orden;  
        $scope.registroTercero.asistente_id = detailAsiste.invitado_id;
        $scope.registro1.invitado_id = detailAsiste.invitado_id;
    };
 
     $scope.updateInfoTercero = function(detailAsiste){
        empresa= $scope.empresa; 
        var datos = $scope.registro1.agenda_comiteId+'||'+$scope.registroTercero.asistente_nombre+'||'+$scope.registroTercero.asistente_cargo
        datos += '||'+ $scope.registroTercero.asistente_empresa + '||N||'
        datos += $scope.registroTercero.asistente_titulo + '|| ||'
        datos += $scope.registroTercero.asistente_id + '||'+  $scope.registroTercero.asistente_orden +'||'+$scope.agenda_id+'||';
        datos += $scope.registroTercero.asistente_celular + '||'+  $scope.registroTercero.asistente_email+ '||'
        datos += $scope.registro1.invitado_id  + '||'+  $scope.registroTercero.asistente_titulo+ '||'+   empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=ctl',{'op':'ctl', 'datos':datos}).success(function(data){    
        if (data === 'Ok') {
           traeInvitados($scope.agenda_id);
            $scope.registroTercero={};
            $scope.terceroForm = false;
            $scope.registro1.invitado_id = 0;
            $scope.registroTercero.asistente_titulo = ' ';
            alert ('Registro actualizado ');
        }
        });
    };   
   
  
   
   $scope.createNuevoInvitado = function(detailAsiste){
   
       $scope.registroTercero={};
       $scope.terceroForm = true;
       $scope.registro1.invitado_id = 0;
       $scope.registroTercero.asistente_titulo = ' ';
       $scope.form_titleTercero='Adiciona datos de participante ';
       $http.post('modulos/mod_mm_agendamiento.php?op=sel',{'op':'sel','agenda_id': $scope.agenda_id,'opc':'I'}).success(function(data){
//alert(data);
       $scope.registroTercero.asistente_orden = data;   
       });        
   };
   
    
    $scope.clearInfoTercero = function(){
        $scope.terceroForm = false;
        $scope.registroTercero = {};
    };
    
    function traeInvitados(agendaId){
        $http.post('modulos/mod_mm_agendamiento.php?op=ti',{'op':'ti','agenda_id':agendaId,'empresa':$scope.empresa}).success(function(data){ 
            if(data !== 'No Hay'){          
            $scope.detailAsistes = data;
            }
         });  
    }
    
    function traeTemas(agendaId){
        $http.post('modulos/mod_mm_agendamiento.php?op=tt',{'op':'tt','agenda_id':agendaId,'empresa':$scope.empresa}).success(function(data){  
        if(data !== 'No Hay'){   
            $scope.detail4s = data;
        }
        });  
    }
    
    $scope.creaSolicitud = function(info){
        er='';
        if($('#agenda_comiteId').val()===''){er+='falta comite\n';}
        if($('#agenda_Descripcion').val()===''){er+='falta detalle de comité (tab Comité)\n';}
        var agenda_salonId = $scope.agenda_salonId;
        var agenda_horaDesde = $scope.agenda_horaDesde;
        var agenda_horaHasta = $scope.agenda_horaHasta;
        if(isNaN($scope.registro1.agenda_salonId)){er+='falta salón\n';}
        if($('#agenda_fechaDesde').val()===''){er+='falta fecha desde\n';}
        if(agenda_horaDesde === '') {er+='falta hora desde\n';}
        if($('#agenda_fechaHasta').val()===''){er+='falta fecha hasta\n';}
        if(agenda_horaHasta === ''){er+='falta hora hasta\n';}
        if($('#agenda_fechaReserva').val()===''){er+='falta fecha reservación\n';}
        if($('#agenda_reservadoPor').val()===''){er+='falta quien reserva\n';}
        if($('#agenda_comiteAnteriorId').val()===''){er+='falta número comité anterior\n';}
        if (typeof $scope.registro1.agenda_horaDesde == 'undefined' ||typeof $scope.registro1.agenda_horaHasta == 'undefined'){
          er+='Revizar hora desde y hora hasta\n';  
        }
        if (er !==''){
            alert(er);
            return;
        }
        
        dato= $scope.agenda_comiteIdtmp+'||'+$scope.registro1.agenda_Descripcion+'||';
        dato+=$scope.registro1.agenda_comiteAnteriorId+'||';
        dato+=$scope.registro1.agenda_empresa+'||'+$scope.agenda_agendaIdtmp+'||';
        dato+=$scope.registro1.agenda_fechaDesde+'||'+$scope.registro1.agenda_fechaHasta+'||';
        dato+=$scope.registro1.agenda_horaDesde+'||'+$scope.registro1.agenda_horaHasta+'||';
        dato+=$scope.registro1.agenda_salonId+'||'+ $scope.registro1.agenda_usuario;  
        dato+='||'+$scope.agenda_id  
        $http.post('modulos/mod_mm_agendamiento.php?op=a',{'op':'a', 'dato':dato}).success(function(data){  
//alert(data);
        rec = data.split('||');
        if (rec[0] === 'Ok') {
            $scope.agenda_agendaIdtmp=rec[1];
            $scope.agenda_id=rec[1]; 
            $scope.registro1.agenda_id=rec[1]; 
            traeTemas($scope.agenda_id);          
            traeInvitados($scope.agenda_id);
            if(rec[2] === 'C'){
                alert ('Solicitud creada. Incluya invitados y temas a tratar, actualice en confirmar ');
            }
            else{
                alert ('Solicitud modificada. Revise invitados y temas a tratar, actualice en confirmar ');   
            }
            $scope.modelTab3 = true;
            $scope.modelTab4 = true;
            $scope.modelTab5 = true;
        }
        });
      };

    $scope.createNuevoTema = function(){
        $scope.temaNuevo = true;
        $scope.registro4 = {};
        $scope.registro4.tema_tipo = 'G';
        $scope.registro4.tema_estado = 'A';
        $scope.registro4.tema_id=0;
        $scope.registro4.tema_empresa = $('#e').val();
        $scope.registro4.tema_comite=$scope.comite_id;
        $scope.registro4.tema_agendaId =  $scope.registro1.agenda_id;
        $scope.registro5.agenda_Id =  $scope.registro1.agenda_id;  
        $http.post('modulos/mod_mm_agendamiento.php?op=sel',{'op':'sel','agenda_id': $scope.agenda_id,'opc':'T'}).success(function(data){
        $scope.registro4.tema_orden = data; 
          });
    };


    $scope.cierraTema =function()
    {
        $scope.temaNuevo = false;
        $scope.registro4 = {};
    };
          
    $scope.editTema =function(detail4)
    {  
        var str = detail4.tema_tipo;
        $scope.registro4.tema_titulo = detail4.tema_titulo;
        $scope.registro4.tema_detalle = detail4.tema_detalle;
        $scope.registro4.tema_responsable = detail4.tema_responsable;
        $scope.registro4.tema_tipo = str.substring(0, 1);
        $scope.registro4.tema_fechaAsigna = detail4.tema_fechaAsigna;
        $scope.registro4.tema_estado = detail4.tema_estado;
        $scope.registro4.tema_id = detail4.tema_id;
        $scope.registro4.tema_agendaId = detail4.tema_agendaId;
        $scope.registro4.tema_empresa= detail4.tema_empresa;
        $scope.registro4.tema_comite= detail4.tema_comite;
        $scope.registro4.tema_orden= detail4.tema_orden;
        $scope.temaNuevo = true;
    };

    $scope.updateTema = function (registro4) {
        tema_responsable = $scope.registro4.tema_responsable;
        if(tema_responsable===undefined){tema_responsable='';}
        tema_fechaAsigna = $scope.registro4.tema_fechaAsigna;
        if(tema_fechaAsigna===undefined){tema_fechaAsigna=$scope.fechaHoy}
        var n = tema_fechaAsigna.indexOf("T");
        tema_fechaAsigna = tema_fechaAsigna.substr(0, n);
        var datos = $scope.registro4.tema_id+'||'+$scope.agenda_id+'||'+ $scope.empresa+'||'+
                    $scope.registro1.agenda_comiteId+'||'+$scope.registro4.tema_titulo+'||'+$scope.registro4.tema_detalle+'||'+
                    $scope.registro4.tema_tipo+'||'+tema_responsable+'|| ||'+
                    tema_fechaAsigna+'|| ||'+$scope.registro4.tema_estado+'||0||'+$scope.registro4.tema_orden;  
        $http.post('modulos/mod_mm_agendamiento.php?op=atm',{'op':'atm', 'datos':datos}).success(function(data){
        if (data === 'Ok') {
            traeTemas($scope.agenda_id);
            $scope.temaNuevo = false;
            alert ('tema actualizado ');
        }
        });
      };
        
        
    $scope.updateComite = function() {  
      empresa=$scope.empresa
      $scope.btnBuscaReg=false;
      $scope.btnActualizar=true;
      $scope.listaComite=false;
      $http.post('modulos/mod_mm_agendamiento.php?op=nc',{'op':'nc', 'comiteId':$scope.registro1.agenda_comiteId,empresa:empresa}).success(function(data){
          $rec = data.split("||");
          $scope.comite_nombreResul=$rec[0];
          $scope.registro1.agenda_comiteAnteriorId=$rec[1];
          $scope.agenda_comiteIdtmp =$rec[2]; 
          $scope.comite_id =$rec[2]; 
          if($rec[3]!=0){$scope.btnBuscaReg=true; $scope.listaComite=true;$scope.btnActualizar=false;}
      });
       $scope.modelTab2 = true;  
      $scope.tema_comite=$scope.comite_nombreResul;
      getInfo();     
    };

    $scope.updateComiteDescri = function(){
        detalle = $scope.registro1.agenda_Descripcion;
        $scope.agenda_Descripcion = detalle;        
        $scope.modelTab2 = true;
    };


    $scope.updateSalon = function() { 
       $scope.agenda_salonIdtmp = $scope.registro1.agenda_salonId;
   //    alert('salon  '.$scope.agenda_salonIdtmp);
       $http.post('modulos/mod_mm_agendamiento.php?op=ns',{'op':'ns', 'salonId':$scope.registro1.agenda_salonId}).success(function(data){
       $scope.salon_nombreResul=data;
       });
     };
 

    $scope.formAnula = function(){
        alert('anula');
    };
        
    $scope.anulaRegistro = function(){
        nota = $scope.comite_nombreResul +' - ' +$scope.agenda_Descripcion; 
        if (confirm('Esto anulará el agendamiento del comité : '+ nota +' continúa ?')) {  
            $scope.anula = true;
         }        
    };
    
    $scope.vaAnularRegistro = function(registro5){
        nota = 'Va a dejar Inactivo el comité: ' +$scope.agenda_Descripcion;
        if (confirm( nota +' continúa ?')) { 
            datos = $scope.registro5.agenda_Id +'||'+ $scope.registro5.agenda_comiteCausaAnulacion+'||I||Anula';       
            $http.post('modulos/mod_mm_agendamiento.php?op=ara',{'op':'ara', 'datos':datos}).success(function(data){           
                rec = data.split('||');
                if (rec[0] === 'Ok') {
                    $scope.modelTab3 = false;
                    $scope.modelTab4 = false;
                    $scope.modelTab5 = false;
                    $scope.listaComite = false;
                    $scope.registro1 ={};
                    alert (rec[1]);                
                }
            });
        }
    };
    
    $scope.vaAcitarRegistro = function(registro5){
        $scope.enviaImg = true;
        datos = $scope.registro5.agenda_Id +'||'+ $scope.registro5.agenda_comiteNotaCitacion;  
        $http.post('modulos/mod_mm_contacto.php?op=eic',{'op':'eic','dato':datos}).success(function(data){            
            rec = data.split('||');
            if (rec[0] === 'Ok') {
              $scope.registro5.respuestaMail = "Se han enviado " + rec[1] + "citaciones";
          }else 
              alert(data);
         });  
         $scope.enviaImg = false;
         $scope.enviaMail = false;
    };
    
    $scope.haceCitacion = function(){
       $scope.anula = false;  
        if (confirm('Deja en firme esta invitación, Envia citaciones a las personas invitadas, al mensaje del correo se le puede adicionar un mensaje ')) {  
            $scope.enviaMail = true;
            $scope.registro5.agenda_comiteNotaCitacion='Citación comité '+$scope.registro1.agenda_Descripcion;
        }   
    };
    
    $scope.quedaEnFirme = function(){
       $scope.anula = false;  
    };

    $scope.registro = function(info){ alert ('inserta');};


    $scope.registro =function(info){ 
    //        alert ('actualiza');   
            $http.post('modulos/mod_mm_agendamiento.php?op=a',{'op':'a', 'agenda_id':agenda_id, 'agenda_empresa':$scope.agenda_empresa, 
                'agenda_salonId':agenda_salonId, 'agenda_Descripcion':$scope.agenda_Descripcion, 'agenda_comiteId':agenda_comiteId, 
                'agenda_fechaDesde':agenda_fechaDesde, 'agenda_fechaHasta':agenda_fechaHasta, 
                'agenda_comiteAnteriorId':$scope.agenda_comiteAnteriorId}).success(function(data){
            $scope.show_form = true;
            alert(data);
            if (data === true) {
            getInfo();
            }
            });
     };

    $scope.registro = {};
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm1').slideToggle();
    };


    
    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.agenda_empresa+' ?')) {  
            $http.post('modulos/mod_mm_agendamiento.php?op=b',{'op':'b', 'agenda_id':info.agenda_id}).success(function(data){
            if (data === 'Ok') {
            getInfo();
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.agenda_fechaDesde = function()
    {
        $scope.registro1.agenda_fechaHasta = $scope.registro1.agenda_fechaDesde;
    };
    
    $scope.updateInfo =function(info)
    {
        er='';
        if($('#agenda_id').val()===''){er+='falta id\n';}
        if($('#agenda_empresa').val()===''){er+='falta empresa\n';}
        if($('#agenda_salonId').val()===''){er+='falta salon\n';}
        if($('#agenda_Descripcion').val()===''){er+='falta descripcion\n';}
        if($('#agenda_comiteId').val()===''){er+='falta comite\n';}
        if($('#agenda_fechaDesde').val()===''){er+='falta fch_desde\n';}
        if($('#agenda_fechaHasta').val()===''){er+='falta fch_hasta\n';}
        if($('#agenda_comiteAnteriorId').val()===''){er+='falta comite_anterior\n';}

        if (er===''){
        $http.post('modulos/mod_mm_agendamiento.php?op=a',{'op':'a', 'agenda_id':info.agenda_id, 'agenda_empresa':info.agenda_empresa, 'agenda_salonId':info.agenda_salonId, 'agenda_Descripcion':info.agenda_Descripcion, 'agenda_comiteId':info.agenda_comiteId, 'agenda_fechaDesde':info.agenda_fechaDesde, 'agenda_fechaHasta':info.agenda_fechaHasta, 'agenda_comiteAnteriorId':info.agenda_comiteAnteriorId}).success(function(data){
        if (data === 'Ok') {
            getInfo();
            alert ('Registro Actualizado ');
            $('#idForm1').slideToggle();
            }
            });
        }else{alert (er);}  
    };
    
   
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm1').slideToggle();
    };
    
}]);
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Nov 27, 2017 9:41:16   <<<<<<< 
