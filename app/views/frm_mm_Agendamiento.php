 <div class="container "  ng-controller="mainController">  
    <div class="container " >
        <h3 class="text-left">{{form_title}}</h3>
    </div>

<ul class='tabs' >
  <li><a href='#tab1'> Comité y salón </a></li>
  <li><a href='#tab3'> Invitados </a></li>
  <li><a href='#tab4'> Temas a tratar </a></li>
  <li><a href='#tab5'> Confirmar </a></li>
</ul>
  
     <!--  Modifica datos del invitado  -->
     
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal alert alert-mm color-palette-set" name="tercero2Form" id="terceroForm"
             ng-submit="insertInfoTr(registroTercero);" ng-show="terceroForm">
            <h4 class="text-left">{{form_titleTercero}}</h4> 

            <div class="form-group">
                <label class="control-label milabel col-md-4" for="asistente_nombre">{{form_asistente_nombre}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="asistente_nombre" name="asistente_nombre"
                     ng-model="registroTercero.asistente_nombre" required  value="{{registroTercero.asistente_nombre}}" 
                     ng-class="{ error: tercero2Form.asistente_nombre.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_nombre.$error.asistente_nombre }"/>            </div>
            </div> 

            <div class="form-group">
                <label class="control-label milabel col-md-4" for="asistente_empresa">{{form_asistente_empresa}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="asistente_empresa" name="asistente_empresa"
                     ng-model="registroTercero.asistente_empresa" required value="{{registroTercero.asistente_empresa}}" 
                    ng-class="{ error: tercero2Form.asistente_empresa.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_empresa.$error.asistente_empresa }"/>
                </div>
            </div> 

            <div class="form-group">
                <label class="control-label milabel col-md-4" for="asistente_cargo">{{form_asistente_cargo}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="asistente_cargo" name="asistente_cargo"
                     ng-model="registroTercero.asistente_cargo" required  value="{{registroTercero.asistente_cargo}}"  
                    ng-class="{ error: tercero2Form.asistente_cargo.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_cargo.$error.asistente_cargo }"/>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label milabel col-md-4" for="asistente_causa">{{form_asistente_celular}}</label>
                <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_celular" name="asistente_celular"
                         ng-model="registroTercero.asistente_celular"   value="{{registroTercero.asistente_celular}}" 
                </div>
                </div>
            </div>
            <div class="form-group" >
                <label class="control-label milabel col-md-4" for="asistente_causa">{{form_asistente_email}}</label>
                <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_email" name="asistente_email"
                         ng-model="registroTercero.asistente_email"   value="{{registroTercero.asistente_email}}" 
                </div>
                </div>
            </div>                


           <div class="form-group">
                <label class="control-label milabel col-md-4" for="asistente_titulo">{{form_asistente_titulo}}</label>
                <div class="btn-group  col-md-8"  data-toggle="buttons">
               <label>
                  <input type="radio" name ="asistente_titulo" ng-model="registroTercero.asistente_titulo" 
                          class="btn media-bottom" value="P" >{{form_tituloP}}
               </label>
               <label>
                  <input type="radio" name ="asistente_titulo" ng-model="registroTercero.asistente_titulo" 
                          class="btn media-bottom" value="S" >{{form_tituloS}}
               </label>
               <label>
                  <input type="radio" name ="asistente_titulo" ng-model="registroTercero.asistente_titulo"  
                          class="btn media-bottom" value="T" >{{form_tituloT}}
               </label>
               <label>
                  <input type="radio" name ="asistente_titulo" ng-checked="chkTitulo" ng-model="registroTercero.asistente_titulo" 
                         ng-checked="true"  class="btn media-bottom" value=" " >{{form_tituloN}}
               </label>                        
                </div>
            </div>      

            <div class="form-group">
                <label class="control-label milabel col-md-4" for="asistente_orden">{{form_asistente_orden}}</label>
                <div class="col-md-2">
                    <input type="text"  width="2" class="form-control mitexto" id="asistente_orden" name="asistente_orden"
                         ng-model="registroTercero.asistente_orden"   value="{{registroTercero.asistente_orden}}"                            
                </div>
                </div>
            </div>     

            <div class="form-group">
                <div class="col-md-5">
                    <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                             ng-click="updateInfoTercero(registroTercero)" id="send_btnupd"  ng-disabled="!tercero2Form.$valid">{{form_btnActualiza}}
                   </button>
                 </div>  
                <div class="col-md-1">
                    <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                             ng-click="clearInfoTercero()" 
                             id="send_btndel">{{form_btnAnula}}</button> 
                </div>
            </div>                 

        </form>
    </div>      
     
        <!--    Formulario principal      -->
     
<div id='tab1' class="col-md-11 col-md-offset-1">
     <form class="form-horizontal alert alert-mm color-palette-set" name="formato1" id="idForm1"
                ng-submit="insertInfo(registro1);" >
        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_comiteId">{{form_agenda_comiteId}}</label>
            <div class="col-md-5">
            <select id='agenda_comiteId' name='agenda_comiteId' ng-model='registro1.agenda_comiteId'   
                    ng-change="updateComite()">
             <option ng-repeat='operator1 in operators1' value = " {{operator1.comite_id}}">{{operator1.comite_nombre}}</option>
            </select>
                <button type="button" value="Busca" class="btn btn-sm btn-custom pull-right btn"  ng-show="btnBuscaReg"
                ng-click="buscaRegistros()" id="scan_btn" >{{form_btnBuscar}}
            </button>   
            </div>
        </div> 
         
         <div class="form-group" ng-show="listaComite">
            <label class=" milabel col-md-2" for="traeComiteLista">{{form_agenda_reunionId}}</label>
             <div class="col-md-5">
            <select id='traeComiteLista' name='traeComiteLista' ng-model='registro1.agenda_agendaId'   
                    ng-change="traeComiteLista()">
             <option ng-repeat='operator2 in operators2' value = " {{operator2.agenda_id}}">{{operator2.detalle}}</option>
            </select>
             </div>
        </div>
         
        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_Descripcion">{{form_agenda_Descripcion}}</label>
            <div class="col-md-8">
            <input type="text" class="form-control mitexto" id="agenda_Descripcion" name="agenda_Descripcion"
                   ng-model="registro1.agenda_Descripcion" required  
                   value="{{registro1.agenda_Descripcion}}" />
            </div>
        </div> 

        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_salonId">{{form_agenda_salonId}}</label>
            <div class="col-md-8">
            <select id='agenda_salonId' name='agenda_salonId' ng-model='registro1.agenda_salonId'  
                    ng-change="updateSalon()">
             <option ng-repeat='operator0 in operators0' value = " {{operator0.salon_id}}">{{operator0.salon_nombre}}</option>
            </select>
            </div>
        </div>
        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_fechaDesde">{{form_agenda_fechaDesde}}</label>
            <div class="col-md-3">
            <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="agenda_fechaDesde" name="agenda_fechaDesde"
                ng-model="registro1.agenda_fechaDesde"  placeholder="yyyy-MM-dd" 
                ng-change="agenda_fechaDesde()" value="{{registro1.agenda_fechaDesde}}"    
                ng-class="{ error: formato2.agenda_fechaDesde.$error.required && !formato2.$pristine, warning: formato2.agenda_fechaDesde.$error.agenda_fechaDesde }"/>
            </div>
            <label class=" milabel col-md-2" for="agenda_horaDesde">{{form_agenda_hora}}</label>
            <div class="col-md-3">
            <select id='agenda_horaDesde' name='agenda_horaDesde' ng-model='registro1.agenda_horaDesde'  
                ng-change="agenda_horaDesde()">
             <option ng-repeat='operatorhd in operatorshd' value = "{{operatorhd.hora}}">{{operatorhd.detalle}}</option>
            </select>
            </div>
        </div> 

        <div class="form-group">
           <label class=" milabel col-md-2" for="agenda_fechaHasta">{{form_agenda_fechaHasta}}</label>
           <div class="col-md-3">
           <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="agenda_fechaHasta" name="agenda_fechaHasta"
                ng-model="registro1.agenda_fechaHasta" required Placeholder="{{form_Phagenda_fechaHasta}}" 
                data-date-format="yyyy-mm-dd" value="{{registro1.agenda_fechaHasta}}"   />
           </div>
           <label class=" milabel col-md-2" for="agenda_horaHasta">{{form_agenda_hora}}</label>
            <div class="col-md-3">
            <select id='agenda_horaHasta' name='agenda_horaHasta' ng-model='registro1.agenda_horaHasta'  
                ng-change="agenda_horaHasta()">
             <option ng-repeat='operatorhd in operatorshd' value = "{{operatorhd.hora}}">{{operatorhd.detalle}}</option>
            </select>
            </div>
       </div>    
    
        <div class="form-group">
           <label class=" milabel col-md-2" for="agenda_fechaReserva">{{form_agenda_fechaReserva}}</label>
           <div class="col-md-3">
               <input type="datetime" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="agenda_fechaReserva" name="agenda_fechaReserva"
                ng-model="registro1.agenda_fechaReserva" required Placeholder="{{form_Phagenda_fechaReserva}}" 
                value="<?php echo date("Y-m-d\TH-i");?>"   />
            </div>

        </div>  

        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_reservadoPor">{{form_agenda_reservadoPor}}</label>
           <div class="col-md-5">
            <input type="text" width="45" class="form-control mitexto fa fa-calendar fa-lg" id="agenda_reservadoPor" name="agenda_reservadoPor"
                 ng-model="registro1.agenda_reservadoPor" required Placeholder="{{form_Phagenda_reservadoPor}}" 
                 value="registro1.agenda_reservadoPor"   />
            </div>
        </div> 

        <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_comiteAnteriorId">{{form_agenda_comiteAnteriorId}}</label>
           <div class="col-md-2">
            <input type="text" class="form-control mitexto" id="agenda_comiteAnteriorId" name="agenda_comiteAnteriorId"
                 ng-model="registro1.agenda_comiteAnteriorId" required Placeholder="{{form_Phagenda_comiteAnteriorId}}" 
                 value="{{registro1.agenda_comiteAnteriorId}}" />
            </div>
        </div>    
   
         <div ng-show="ppal"> 
        <input type="text" ng-model="registro1.invitado_id" id ='invitado_id'  name ='invitado_id' value="{{registro1.invitado_id}}"/> 
        <input type="text" ng-model="registro1.agenda_empresa" id ='empresa_id'  name ='empresa_id' value="<?php $e ?>"/> 
        <input type="text" ng-model="registro1.comite_id" id ='comite_id'  name ='comite_id' value="{{registro1.comite_id}}"/> 
        <input type="text" ng-model="registro1.salon_id" id ='salon_id'  name ='salon_id' value="{{registro1.salon_id}}"/> 
        <input type="text" ng-model="registro1.agenda_id" id ='agenda_id' ng-model="{{registro1.agenda_id}}" name ='agenda_id' value="{{registro1.agenda_id}}"/> 
        <input type="text" ng-model="registro1.agenda_conCitacion" id ='agenda_conCitacion'  name ='agenda_conCitacion' value="{{registro1.agenda_conCitacion}}"/>
        <input type="text" ng-model="registro1.agenda_usuario" id ='agenda_usuario'  name ='agenda_usuario' value="{{registro1.agenda_usuario}}"/>
        <input type="text" ng-model="registro1.agenda_enFirme" id ='agenda_enFirme'  name ='agenda_enFirme' value="{{registro1.agenda_enFirme}}"/>
    </div>
        
    <nav class="">
        <div class="" ng-show="btnBusca">
            <div class="alert alert-default navbar-brand search-box">                    
                <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                    ng-click="creaSolicitud(registro1)" id="send_btn"  ng-disabled="!formato1.$valid">{{form_btnCrear}}
                </button>

            </div>                
        </div>
         <div class="" ng-show="btnActualizar">
            <div class="alert alert-default navbar-brand search-box">                    
                <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                    ng-click="creaSolicitud(registro1)" id="send_btn"  ng-disabled="!formato1.$valid">{{form_btnActualiza}}
                </button>

            </div>                
        </div>       
       
    </nav>

    </form>
</div>
     
     
<div id='tab3' class="col-md-10">
    <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm3"
    ng-submit="insertInfo(registro3);"  ng-show="modelTab3">
        <p>{{form_agenda_comiteId}} : {{comite_nombreResul}}</p>
        <p>{{form_agenda_Descripcion}} : {{agenda_Descripcion}}</p>
        <p>{{form_agenda_salonId}} : {{salon_nombreResul}}</p>
       
        <button class="btn btn-primary btn-xs mibottom" ng-click="createNuevoInvitado(registro3)" title="{{form_btnAdd}}"  > {{form_nuevoinvitado}}</button>
        <br/> 
        <div class="table-responsive" style="overflow-y: scroll;">         
        
            <table class="table table-hover tablex">
           <tr>    
               <th>ORDEN</th>
               <th>NOMBRE</th>
               <th>EMPRESA</th>
               <th>CARGO</th>
               <th>CELULAR</th>
               <th>CORREO</th>
               <th>TITULO</th>
           </tr>

            <tr ng-repeat="detailAsiste in detailAsistes| filter:search_query">
                
                <td>{{detailAsiste.invitado_orden}}</td>
                <td>{{detailAsiste.invitado_nombre}}</td>
                <td>{{detailAsiste.invitado_empresa}}</td>
                <td>{{detailAsiste.invitado_cargo}}</td>
                <td>{{detailAsiste.invitado_celuar}}</td>
                <td>{{detailAsiste.invitado_email}}</td>
                <td>{{detailAsiste.invitado_titulo}}</td>
                <td> 
                    <button class="btn btn-warning btn-xs" ng-click="editDetailAsiste(detailAsiste)" title="{{form_btnEdita}}">
                       <span class="glyphicon glyphicon-edit"></span></button>
               </td>
               <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteDetailAsiste(detailAsiste)" 
                       confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
               </td>
           </tr>
           </table>
       </div>  
    </form>
</div>
   
            
     <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal alert alert-mm color-palette-set" name="tema2Form" id="tema2Form">
        <div class="table-responsive"  ng-show="temaNuevo"  >
            <div class="form-group" >
                <label class=" milabel col-md-2" for="tema_titulo">{{form_tema_titulo}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="tema_titulo" name="tema_titulo"
                     ng-model="registro4.tema_titulo" required Placeholder="{{form_Phtema_titulo}}" 
                     value="{{registro4.tema_titulo}}" />
                </div>
            </div> 

            <div class="form-group">
                <label class=" milabel col-md-2" for="tema_detalle">{{form_tema_detalle}}</label>
               <div class="col-md-6">
                <textarea rows="4" cols="50" class="form-control mitexto" id="tema_detalle" name="tema_detalle"
                     ng-model="registro4.tema_detalle" required Placeholder="{{form_Phtema_detalle}}" 
                     value="{{registro4.tema_detalle}}" >            
                </textarea>
                </div>
            </div> 

            <div class="form-group">
                <label class="milabel col-md-4" for="tema_tipo">{{form_tema_tipo}}</label>
                <div class="btn-group  col-md-8"  data-toggle="buttons">
               <label>
                  <input type="radio" name ="tema_tipo" ng-model="registro4.tema_tipo" 
                        class="btn media-bottom"  value="G" >{{form_temag}}
               </label>
               <label>
                  <input type="radio" name ="tema_tipo" ng-model="registro4.tema_tipo" 
                        class="btn media-bottom"  value="P" >{{form_temap}}
               </label>
                </div>
            </div>  

            <div class="form-group">
                <label class=" milabel col-md-2" for="tema_responsable">{{form_tema_responsable}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="tema_responsable" name="tema_responsable"
                     ng-model="registro4.tema_responsable" required Placeholder="{{form_Phtema_responsable}}" 
                     value="{{registro4.tema_responsable}}" />
                </div>
            </div> 

            <div class="form-group">
                <label class=" milabel col-md-2" for="tema_fechaAsigna">{{form_tema_fechaAsigna}}</label>
               <div class="col-md-3">
                <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="tema_fechaAsigna" name="tema_fechaAsigna"
                     ng-model="registro4.tema_fechaAsigna" required Placeholder="{{form_Phtema_fechaAsigna}}" 
                     value="{{registro4.tema_fechaAsigna}}"   />
                </div>
            </div> 

            <div class="form-group">
                <label class=" milabel col-md-2" for="tema_estado">{{form_tema_estado}}</label>
                <div class="btn-group  col-md-6"  data-toggle="buttons">
               <label>
                  <input type="radio" name ="tema_estado" ng-model="registro4.tema_estado" value="I" >{{form_Activo90}}
               </label>
               <label>
                  <input type="radio" name ="tema_estado" ng-model="registro4.tema_estado" value="A" >{{form_Activo91}}
               </label>
                </div>
            </div> 

            <div class="form-group">
                <label class=" milabel col-md-4" for="tema_orden">{{form_asistente_orden}}</label>
                <div class="col-md-2">
                    <input type="text"  width="2" class="form-control mitexto" id="tema_orden" name="tema_orden"
                         ng-model="registro4.tema_orden"   value="{{registro4.tema_orden}}"                            
                </div>
                </div>
            </div>             
            
            <div class="form-group">
                <div class="col-md-5">
                    <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                             ng-click="updateTema(registro4)" id="btnActualiza">{{form_btnActualiza}}</button>
                 </div>  
                <div class="col-md-1">
                    <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                             ng-click="cierraTema(registro4)" 
                             id="btnAnula">{{form_btnAnula}}</button> 
                </div>
            </div> 
            
            <div style='display: none'>
                <input type="text" ng-model="registro4.tema_id" id ='tema_id'  name ='tema_id' value="{{registro4.tema_id}}"/>
                <input type="text" ng-model="registro4.tema_agendaId" id="tema_agendaId" name="tema_agendaId"  value="{{registro4.tema_agendaId}}" />
                <input type="text" ng-model="registro4.tema_empresa"   id="tema_empresa" name="tema_empresa"   value="{{registro4.tema_empresa}}" />
                <input type="text" ng-model="registro4.tema_comite" id ='tema_comite'  name ='tema_comite' value="{{registro4.tema_comite}}"/>
            </div>
            
    </div>  
    </form>
    </div>
  
<!-- crea nuevos temas -->       
<div id='tab4' class="col-md-10"  ng-show="modelTab4" > 
    <form class="form-horizontal alert alert-mm color-palette-set" name="formato4" id="idForm4d"
              ng-submit="insertInfo(registro4);" >
        <p>{{form_agenda_comiteId}} : {{comite_nombreResul}}</p>
        <p>{{form_agenda_Descripcion}} : {{agenda_Descripcion}}</p>
        <p>{{form_agenda_salonId}} : {{salon_nombreResul}}</p>
        
        <button class="btn btn-primary btn-xs mibottom" ng-click="createNuevoTema(registro4)" title="{{form_btnAdd}}">{{form_nuevotema}}</button>
        <br/>         
        <div class="col-md-10">
            <div class="table-responsive">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form4" 
                    ng-click="createNuevoTema()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
                
                <table class="table table-hover tablex">                    
                    <tr>
                        <th>ORDEN</th>
                        <th>TITULO</th>
                        <th>DETALLE</th>
                        <th>TIPO</th>
                        <th>RESPONSABLE</th>
                        <th>FECHA ASIGNA</th>
                        <th>ESTADO</th>
                    </tr>
                   
                    <tr ng-repeat="detail4 in detail4s| filter:search_query">
                    <td>{{detail4.tema_orden}}</td>
                    <td>{{detail4.tema_titulo}}</td>
                    <td>{{detail4.tema_detalle}}</td>
                    <td>{{detail4.tema_tipo}}</td>
                    <td>{{detail4.tema_responsable}}</td>
                    <td>{{detail4.tema_fechaAsigna}}</td>
                    <td>{{detail4.tema_estado}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editTema(detail4)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail4)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                </table>
            </div>
       
        </div>
 
    </form>
  
</div>    
<!-- Cita o anula registro -->   
<div id='tab5' class="col-md-12 col-md-offset-1">
    <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm5"
        ng-submit="insertInfo(registro5);"  ng-show="modelTab5">
        <h3>Actualiza, cierra y agenda reunión</h3>
        <p>{{form_agenda_comiteId}} : {{comite_nombreResul}}</p>
        <p>{{form_agenda_Descripcion}} : {{registro1.agenda_Descripcion}}</p>
        <p>{{form_agenda_salonId}} : {{salon_nombreResul}}</p>
        <p>{{form_agenda_fechaDesde}} : {{registro1.agenda_fechaDesde}}  {{form_agenda_hora}} : {{registro1.agenda_horaDesde}}</p>
        <p>{{form_agenda_fechaHasta}} : {{registro1.agenda_fechaHasta}}  {{form_agenda_hora}} : {{registro1.agenda_horaHasta}}</p>
        <p>{{form_agenda_reservadoPor}} : {{registro1.agenda_reservadoPor}}</p>      
     
        <nav class="">
            <div class="">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs"
                    ng-click="haceCitacion()">{{form_btnCitacion}}</button>

                    <button class="btn btn-primary btn-xs"
                    ng-click="anulaRegistro()">{{form_btnAnulaRegistro}}</button>                    
                   
                </div>  

            </div>
         </nav>
            <div style='display: none'>
                <input type="text" ng-model="registro5.agenda_Id" id="registro5agenda_Id" name="registro5agenda_Id"  value="{{registro5.agenda_Id}}" />
            </div>
        <div class="form-group" ng-show="anula">
           <label class=" milabel col-md-4" for="comiteCausaAnulacion">{{form_agenda_comiteCausaAnulacion}}</label>
           <div class="col-md-6">

                <textarea rows="4"  class="form-control mitexto" id="comiteCausaAnulacion" name="comiteCausaAnulacion"
                     ng-model="registro5.agenda_comiteCausaAnulacion"  value="{{registro5.agenda_comiteCausaAnulacion}}" >            
                </textarea>             
            </div>
           <button class="btn btn-primary btn-xs"
                    ng-click="vaAnularRegistro(registro5)">{{form_btnConfirmar}}</button> 
        </div>            
            
  
        <div class="form-group" ng-show="enviaMail">
           <label class=" milabel col-md-4" for="comiteEnviaCitacion">{{form_agenda_comiteEnviaCitacion}}</label>
           <div class="col-md-6">
                <textarea rows="4"  class="form-control mitexto" id="comiteEnviaCitacion" name="comiteEnviaCitacion"
                     ng-model="registro5.agenda_comiteNotaCitacion"  value="{{registro5.agenda_comiteNotaCitacion}}" >            
                </textarea>  
            </div>
                   <button class="btn btn-primary btn-xs"
                ng-click="vaAcitarRegistro(registro5)">{{form_btnConfirmar}}</button> 
           <div class="col-md-8" >
               <span> {{registro5.respuestaMail}}</span>
           </div>
           <div class="col-md-2" ng-show="enviaImg" >
               <img src="img/loader.gif" alt=""/>
           </div>
        </div>            
    </form>
</div>
 </div>
 <script src="controller/min/mm_agendamiento.ctrl.min.js" type="text/javascript"></script>
<script>
$('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');

  $content = $($active[0].hash);

  // Hide the remaining content
  $links.not($active).each(function () {
    $(this.hash).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $(this.hash);

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});
</script>

<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Nov 27, 2017 9:41:16   <<<<<<< -->
