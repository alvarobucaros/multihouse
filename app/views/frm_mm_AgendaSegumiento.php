 <div class="container "  ng-controller="mainController" id='divPpal'>  
    <div class="container " >
        <h3 class="text-left">{{form_title}}</h3>
    </div>


       <div class="col-md-8 col-md-offset-1">
<!--  Crea un nuevo invitado  -->
            <form class="form-horizontal alert alert-mm color-palette-set" name="terForm" id="idForm"
                  ng-submit="insertInfoTr(registroTr);" ng-show="tercForm">
                <h4 class="text-left">{{form_titleTerc}}</h4>
 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_nombre">{{form_asistente_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_nombre" name="asistente_nombre"
                         ng-model="registroTr.asistente_nombre" required  value="{{registroTr.asistente_nombre}}" 
                         ng-class="{ error: terForm.asistente_nombre.$error.required && !terForm.$pristine, warning: terForm.asistente_nombre.$error.asistente_nombre }"/>            </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_empresa">{{form_asistente_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_empresa" name="asistente_empresa"
                         ng-model="registroTr.asistente_empresa" required value="{{registroTr.asistente_empresa}}" 
                        ng-class="{ error: terForm.asistente_empresa.$error.required && !terForm.$pristine, warning: terForm.asistente_empresa.$error.asistente_empresa }"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_cargo">{{form_asistente_cargo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_cargo" name="asistente_cargo"
                         ng-model="registroTr.asistente_cargo" required  value="{{registroTr.asistente_cargo}}"  
                        ng-class="{ error: terForm.asistente_cargo.$error.required && !terForm.$pristine, warning: terForm.asistente_cargo.$error.asistente_cargo }"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_celuar">{{form_asistente_celuar}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_celuar" name="asistente_celuar"
                         ng-model="registroTr.asistente_celuar"   value="{{registroTr.asistente_celuar}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_email2">{{form_asistente_email}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_email2" name="asistente_email2"
                         ng-model="registroTr.asistente_email"   value="{{registroTr.asistente_email}}" />
                    </div>
                </div> 

                <div class="form-group">
                     <label class="control-label milabel col-md-4" for="asistente_titulo">{{form_asistente_titulo}}</label>
                     <div class="btn-group  col-md-8"  data-toggle="buttons">
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registroTr.asistente_titulo" 
                               class="btn media-bottom" value="P" >{{form_tituloP}}
                    </label>
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registroTr.asistente_titulo" 
                               class="btn media-bottom" value="S" >{{form_tituloS}}
                    </label>
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registroTr.asistente_titulo"  
                               class="btn media-bottom" value="T" >{{form_tituloT}}
                    </label>
                    <label>
                        <input type="radio" name ="asistente_titulo"  ng-checked="chkTitulo"  ng-model="registroTr.asistente_titulo" 
                               class="btn media-bottom" value=" " >{{form_tituloN}}
                    </label>                        
                     </div>
                 </div>      

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_orden">{{form_asistente_orden}}</label>
                    <div class="col-md-2">
                        <input type="text"  width="2" class="form-control mitexto" id="asistente_orden1" name="asistente_orden"
                             ng-model="registroTr.asistente_orden"   value="{{registroTercero.asistente_orden}}"                            
                    </div>
                </div>
                </div>     
        
                
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoTr(registroTr)" id="send_btn"  ng-disabled="!terForm.$valid">{{form_btnActualiza}}
                       </button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoTr()" 
                                 id="send_btnCle">{{form_btnAnula}}</button> 
                    </div>
                </div>       
            </form>
	</div>
    
     <!--  Modifica datos del invitado  -->
        <div class="col-md-8 col-md-offset-1">
            <form class="form-horizontal alert alert-mm color-palette-set" name="tercero2Form" id="terceroForm"
                 ng-submit="insertInfoTr(registroTercero);" ng-show="terceroForm">
                <h4 class="text-left">{{form_titleTercero}}</h4> 
                  
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_nombre2">{{form_asistente_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_nombre2" name="asistente_nombre2"
                         ng-model="registroTercero.asistente_nombre" required  value="{{registroTercero.asistente_nombre}}" 
                         ng-class="{ error: tercero2Form.asistente_nombre.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_nombre.$error.asistente_nombre }"/>            </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_empresa2">{{form_asistente_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_empresa2" name="asistente_empresa2"
                         ng-model="registroTercero.asistente_empresa" required value="{{registroTercero.asistente_empresa}}" 
                        ng-class="{ error: tercero2Form.asistente_empresa.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_empresa.$error.asistente_empresa }"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_cargo2">{{form_asistente_cargo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_cargo2" name="asistente_cargo2"
                         ng-model="registroTercero.asistente_cargo" required  value="{{registroTercero.asistente_cargo}}"  
                        ng-class="{ error: tercero2Form.asistente_cargo.$error.required && !tercero2Form.$pristine, warning: tercero2Form.asistente_cargo.$error.asistente_cargo }"/>
                    </div>
                </div> 
   
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_asiste">{{form_asistente_asiste}}</label>
                    <div class="btn-group  col-md-8"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="asistente_asiste" ng-model="registroTercero.asistente_asiste" 
                            class="btn media-bottom" ng-click="cualMotivoS()" value="S" >{{form_asisteS}}
                   </label>
                   <label>
                      <input type="radio" name ="asistente_asiste" ng-model="registroTercero.asistente_asiste" 
                            class="btn media-bottom"  ng-click="cualMotivoN()" value="N" >{{form_asisteN}}
                   </label>
                    </div>
                </div> 
                
                <div class="form-group" ng-show="causal">
                    <label class="control-label milabel col-md-4" for="asistente_causa">{{form_asistente_causa}}</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control mitexto" id="asistente_causa" name="asistente_causa"
                             ng-model="registroTercero.asistente_causa"   value="{{registroTercero.asistente_causa}}" 
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
                      <input type="radio" name ="asistente_titulo" ng-model="registroTercero.asistente_titulo" 
                              class="btn media-bottom" value=" " >{{form_tituloN}}
                   </label>                        
                    </div>
                </div>      
    
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_celular">{{form_asistente_celular}}</label>
                    <div class="col-md-4">
                        <input type="text"  width="20" class="form-control mitexto" id="asistente_celular" name="asistente_celular"
                             ng-model="registroTercero.asistente_celular"   value="{{registroTercero.asistente_celular}}"                            
                    </div>
                    </div>
                </div>   

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_email">{{form_asistente_email}}</label>
                    <div class="col-md-4">
                        <input type="text"  width="20" class="form-control mitexto" id="asistente_email" name="asistente_email"
                             ng-model="registroTercero.asistente_email"   value="{{registroTercero.asistente_email}}"                            
                    </div>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_orden">{{form_asistente_orden}}</label>
                    <div class="col-md-2">
                        <input type="text"  width="2" class="form-control mitexto" id="asistente_orden2" name="asistente_orden"
                             ng-model="registroTercero.asistente_orden"   value="{{registroTercero.asistente_orden}}"                            
                    </div>
                    </div>
                </div>     
                <div class="form-group" ng-show="invisible">    
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_id" name="asistente_id"
                         ng-model="registroTercero.asistente_id"   value="{{registroTercero.asistente_id}}"  
                    </div>              
                </div>
                </div>
     
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoTercero(registroTercero)" id="send_btn2UpdTer"  ng-disabled="!tercero2Form.$valid">{{form_btnActualiza}}
                       </button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoTercero()" 
                                 id="send_btnCle2">{{form_btnAnula}}</button> 
                    </div>
                </div>                 
                
            </form>
	</div> 
         

       <!--  Formulario principal  -->
    <div id='sgmnto' class="col-md-12 ">
         <form  name="formSgmnto" id="formSgmnto"  ng-submit="insertInfo(registroTercero);" name="ppalForm">

            <div class="form-group col-md-10">
                <label class=" milabel col-md-3" for="agenda_comiteId">{{form_agenda_comiteId}}</label>
                <div class="col-md-6">
                <select id='sgmnto_comiteId' name='sgmnto_comiteId' ng-model='sgmnto_comiteId'   
                        ng-change="updateComite()">
                 <option ng-repeat='operator1 in operators1' value = " {{operator1.comite_id}}">{{operator1.comite_nombre}}</option>
                </select>
               </div>
                <div class="col-md-2" ng-show="vista">
                    
                    <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                              ng-click="createActa(registroTercero)" title="{{form_nuevaActa}}"  
                              id="send_btnupd"  ng-disabled="!tercero2Form.$valid">{{form_nuevaActa}}
                   </button>                    
                    
                </div>
            </div>     
            <div class="form-group col-md-12"  ng-show="resultado">
                <div class="col-md-10">
                <p>{{resultado}}</p>      
                </div>
            </div>

            <div class="form-group col-md-10 miDiv"  ng-show="Convocatoria">
                
                <div class="col-md-10">                
                    <label class="control-label milabel col-md-4" for="convocatoria">{{form_convocatoria}}</label>
                    <div class="col-md-7 ">
                        <input type="text"  width="2" class="form-control mitexto" id="convocatoria" name="convocatoria"
                             ng-model="registroTercero.convocatoria"   value="{{registroTercero.convocatoria}}"                            
                    
                                <button class="btn btn-warning btn-xs" title="{{form_btnAdd}}"></button>                        
                                <button class="btn btn-warning btn-xs mibottom" ng-click="convocatoria(registroTercero)" title="{{form_btnAcepta}}">
                                    
                        <span class="glyphicon glyphicon-certificate">{{form_btnAcepta}}</span></button>
                    </div>
                                 
                </div>
            </div>             
             
             <div class="form-group col-md-10"  ng-show="responseDiv">
                 
                 <div class="table-responsive" style="overflow-y: scroll;">
                     <u>
                        <strong>Participantes</strong>                      
                    </u>&nbsp;&nbsp;         

                <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                    ng-click="createDetailAsiste()" title="{{form_btnAdd}}"  
                    id="send_btnCreaTer"  ng-disabled="!tercero2Form.$valid">{{form_btnNuevoInv}}
                </button>             
                    
         
                     <table class="table table-hover tablex">
                    <tr>    
                      
                        <th>ORDEN</th>
                        <th>NOMBRE</th>
                        <th>EMPRESA</th>
                        <th>CARGO</th>
                        <th>ASISTE</th>
                        <th>TITULO</th>
                        <th>Nr.CELULAR</th>
                        <th>E-MAIL</th>
                    </tr>
           
                    <tr ng-repeat="detailAsiste in detailAsistes| filter:search_query">
                    
                    <td>{{detailAsiste.invitado_orden}}</td>
                    <td>{{detailAsiste.invitado_nombre}}</td>
                    <td>{{detailAsiste.invitado_empresa}}</td>
                    <td>{{detailAsiste.invitado_cargo}}</td>
                    <td>{{detailAsiste.invitado_asistio}}</td>
                    <td>{{detailAsiste.invitado_titulo}}</td>
                    <td>{{detailAsiste.invitado_celuar}}</td>
                    <td>{{detailAsiste.invitado_email}}</td>
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
                <br/>
             </div>
         </form>
        </div> 
       
       
            <div class="col-md-8 col-md-offset-1"  ng-focus="focusfn()" ng-blur="blurfn()" >

            <form class="form-horizontal alert alert-mm color-palette-set" name="temaForm" id="temaForm"
                  ng-submit="insertInfoTr(registroTema);" ng-show="temaTema">
                <h4 class="text-left">{{form_titleTema}}</h4> 
                
                 <div class="form-group">
                   <label class=" milabel col-md-4" for="tema_titulo">{{form_tema_titulo}}</label>
                   <div class="col-md-6">
                    <input type="text" class=" mitexto" id="tema_titulo" name="tema_titulo"
                        ng-model="registroTema.tema_titulo" required  value="{{registroTema.tema_titulo}}"  
                        ng-class="{ error: temaForm.tema_titulo.$error.required && !temaForm.$pristine, warning: temaForm.tema_titulo.$error.tema_titulo }"/>
                    </div>
                </div>                 
                
                <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_detalle">{{form_tema_detalle}}</label>
                   <div class="col-md-6">
                       <textarea rows="4"  class=" mitexto" id="tema_detalle" name="tema_detalle"
                         ng-model="registroTema.tema_detalle"  value="{{registroTema.tema_detalle}}"
                       ng-class="{ error: tema_detalle.tema_detalle.$error.required && !tema_detalle.$pristine, warning: tema_detalle.tema_detalle.$error.tema_detalle }"/>
                       </textarea>
                    </div>
                </div> 
                
                 <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_responsable">{{form_tema_responsable}}</label>
                   <div class="col-md-6">
                    <input type="text" class=" mitexto" id="tema_responsable" name="tema_responsable"
                         ng-model="registroTema.tema_responsable" value="{{registroTema.tema_responsable}}" />
                    </div>
                </div>   

                <div class="form-group" ng-show="invisible">  
                    
                    <input type="text"  id="agenda_id" name="agenda_id"
                         ng-model="registroTema.agenda_id"   value="{{registroTema.temagenda_ida_id}}" />             
                </div>
                
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoTema(registroTema)" id="send_btn2Upd"  ng-disabled="!temaForm.$valid">{{form_btnActualiza}}
                       </button>
                        
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoTema()" 
                                 id="send_btn2">{{form_btnAnula}}</button> 
                    </div>
                </div>                 
                
            </form>
	</div>        
       
               
<!--  Temas  Temas    -->
       
       
            <div class="col-md-8 col-md-offset-1"  ng-focus="focusfnTema()" ng-blur="blurfnTema()" >

            <form class="form-horizontal alert alert-mm color-palette-set" name="addtemaForm" id="addtemaForm"
                  ng-submit="insertInfoTr(registroAddTema);" ng-show="addtemaTema">
                <h4 class="text-left">{{form_titleaddTema}}</h4> 
                
                 <div class="form-group">
                   <label class=" milabel col-md-4" for="tema_titulo2">{{form_tema_titulo}}</label>
                   <div class="col-md-6">
                    <input type="text" class=" mitexto" id="tema_titulo2" name="tema_titulo2"
                        ng-model="registroAddTema.tema_titulo" required  value="{{registroAddTema.tema_titulo}}"  
                        ng-class="{ error: addtemaForm.tema_titulo.$error.required && !addtemaForm.$pristine, warning: addtemaForm.tema_titulo.$error.tema_titulo }"/>
                    </div>
                </div>                 
                
                <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_detalle2">{{form_tema_detalle}}</label>
                   <div class="col-md-8">
                       <textarea rows="4"  cols="60" id="tema_detalle2" name="tema_detalle2"
                         ng-model="registroAddTema.tema_detalle"  value="{{registroAddTema.tema_detalle}}"
                        ng-class="{ error: addtemaForm.tema_detalle.$error.required && !addtemaForm.$pristine, warning: addtemaForm.tema_detalle.$error.tema_detalle }"/>
                       </textarea>
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_detalle">{{form_tema_desarrollo}}</label>
                   <div class="col-md-8">
                       <textarea rows="4"  cols="60" id="tema_desarrollo" name="tema_desarrollo"
                         ng-model="registroAddTema.tema_desarrollo"  value="{{registroAddTema.tema_desarrollo}}"
                        ng-class="{ error: addtemaForm.tema_desarrollo.$error.required && !addtemaForm.$pristine, warning: addtemaForm.tema_desarrollo.$error.tema_detalle }"/>
                       </textarea>
                    </div>
                </div> 
                
                 <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_responsable2">{{form_tema_responsable}}</label>
                   <div class="col-md-6">
                    <input type="text" class=" mitexto" id="tema_responsable2" name="tema_responsable2"
                         ng-model="registroAddTema.tema_responsable" value="{{registroAddTema.tema_responsable}}" />
                    </div>
                </div>   
                                
                 <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_fechaAsigna">{{form_tema_fechaAsigna}}</label>
                   <div class="col-md-4">
                    <input type="date" class="mitexto fa fa-calendar fa-lg" id="tema_fechaAsigna" name="tema_fechaAsigna"
                         ng-model="registroAddTema.tema_fechaAsigna" value="{{registroAddTema.tema_fechaAsigna}}" />
                    </div>
                </div>                 
                
                  <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_fechaCumple">{{form_tema_fechaCumple}}</label>
                   <div class="col-md-4">
                    <input type="date" class="mitexto fa fa-calendar fa-lg" id="tema_fechaCumple" name="tema_fechaCumple"
                         ng-model="registroAddTema.tema_fechaCumple" value="{{registroAddTema.tema_fechaCumple}}" />
                    </div>
                </div>       
                
                 <div class="form-group">
                    <label class=" milabel col-md-4" for="tema_orden">{{form_asistente_orden}}</label>
                   <div class="col-md-4">
                    <input type="text" class=" mitexto" id="tema_orden" name="tema_orden"
                         ng-model="registroAddTema.tema_orden" value="{{registroAddTema.tema_orden}}" />
                    </div>
                </div>                 
                
                <div class="form-group">
                    <label class="milabel col-md-4" for="tema_tipo">{{form_tema_tipo}}</label>
                    <div class="btn-group  col-md-8"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tema_tipo" ng-model="registroAddTema.tema_tipo" 
                            class="btn media-bottom"  value="G" >{{form_temag}}
                   </label>
                   <label>
                      <input type="radio" name ="tema_tipo" ng-model="registroAddTema.tema_tipo" 
                            class="btn media-bottom"  value="P" >{{form_temap}}
                   </label>
                    </div>
                </div>                 
    
                <div class="form-group">
                    <label class="milabel col-md-4" for="tema_estado">{{form_tema_estado}}</label>
                    <div class="btn-group  col-md-8"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tema_estado" ng-model="registroAddTema.tema_estado" 
                            class="btn media-bottom"  value="A" >{{form_asisteS}}
                   </label>
                   <label>
                      <input type="radio" name ="tema_estado" ng-model="registroAddTema.tema_estado" 
                            class="btn media-bottom"  value="I" >{{form_asisteN}}
                   </label>
                    </div>
                </div> 
                
                <div class="form-group" ng-show="invisible">    
                    <input type="text"  id="tema_id" name="tema_id"
                         ng-model="registroAddTema.tema_id"   value="{{registroAddTema.tema_id}}"              
                </div>
                </div>                
                 <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoAddTema(registroAddTema)" id="send_btnu"  
                                 ng-disabled="!addtemaForm.$valid">{{form_btnActualiza}}
                       </button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoAddTema()" 
                                 id="send_btna">{{form_btnAnula}}</button> 
                    </div>
                </div>                
                
            </form>
	</div> 

    <div id='sgmnto' class="col-md-12 ">    
        <form  name="tercero2Form" id="terceroForm2"
                 ng-submit="insertInfoTr(registroTercero);" ng-show="frmTemas">     
                <div class="table-responsive">
                    <u>
                        <strong>Temas a tratar</strong>                      
                    </u>&nbsp;&nbsp;         
                        <button class="btn btn-warning btn-xs" ng-click="createDetailTema(detailTema)" title="{{form_btnAdd}}">
                        <span class="glyphicon glyphicon-plus">Nuevo</span></button>
                    <table class="table table-hover tablex">
                    <tr>    
                       
                        <th>#</th>
                        <th>TITULO</th>
                        <th>DETALLE</th>
                        <th>DESARROLLO</th>
                        <th>TIPO</th>
                        <th>RESPONSABLE</th>
                        <th>ESTADO</th>
                    </tr>

                    <tr ng-repeat="detailTema in detailTemas">
                    
                    <td>{{detailTema.tema_orden}}</td>
                    <td>{{detailTema.tema_titulo}}</td>
                    <td>{{detailTema.tema_detalle}}</td>
                    <td>{{detailTema.tema_desarrollo}}</td>
                    <td>{{detailTema.tema_tipo}}</td>
                    <td>{{detailTema.tema_responsable}}</td>
                    <td>{{detailTema.tema_estado}}</td>
                    <td> 
                    <button class="btn btn-warning btn-xs" ng-click="editDetailTema(detailTema)" title="{{form_btnEdita}}">
                            <span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    </tr>
                    </table>
                </div>            
        </form>
  </div>

</div>

     <script src="controller/mm_agendaSegumiento.ctrl.js" type="text/javascript"></script>



 

