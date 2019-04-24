   <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <h4 class="text-left">{{form_subTitle}}</h4>
        
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
            </div>
        </div>  
         
       <div class="form-group">
            <label class=" milabel col-md-2" for="agenda_actaDesde">{{form_agenda_actaDesde}}</label>
            <div class="col-md-3">
            <input type="text" width="12" class="form-control mitexto " id="agenda_actaDesde" name="agenda_actaDesde"
                ng-model="registro1.agenda_actaDesde"  
                ng-change="agenda_actaDesde()" value="{{registro1.agenda_actaDesde}}"/>
            </div>

        </div> 

        <div class="form-group">
           <label class=" milabel col-md-2" for="agenda_actaHasta">{{form_agenda_actaHasta}}</label>
           <div class="col-md-3">
           <input type="text" width="12" class="form-control mitexto" id="agenda_actaHasta" name="agenda_actaHasta"
                ng-model="registro1.agenda_actaHasta" required 
                 value="{{registro1.agenda_actaHasta}}"   />
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

        </div> 

        <div class="form-group">
           <label class=" milabel col-md-2" for="agenda_fechaHasta">{{form_agenda_fechaHasta}}</label>
           <div class="col-md-3">
           <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="agenda_fechaHasta" name="agenda_fechaHasta"
                ng-model="registro1.agenda_fechaHasta" required Placeholder="{{form_Phagenda_fechaHasta}}" 
                data-date-format="yyyy-mm-dd" value="{{registro1.agenda_fechaHasta}}"   />
           </div>

       </div>    
       
        <div class="form-group">
            <label class=" milabel col-md-2" for="tema">{{form_titTema}}</label>
            <div class="col-md-8">
            <input type="text" class="form-control mitexto" id="tema" name="tema"
                   ng-model="registro1.tema" value="{{registro1.tema}}" />
            </div>
        </div> 
        <div class="form-group">
            <label class=" milabel col-md-2" for="comite_activo">{{form_titAnexos}}</label>
            <div class="btn-group  col-md-2"  data-toggle="buttons">
            <label>
                <input type="radio" class=" milabel" name ="registro1.anexos" ng-model="registro1.anexos" value="S" ng-checked="chk">{{form_AnexoS}}
            </label>
            <label>
            <input type="radio" class="milabel" name ="registro1.anexos" ng-model="registro1.anexos" value="N" >{{form_AnexoN}}
            </label>
            </div>

            <label class=" milabel col-md-2" for="anexoDescripcion">{{form_titAnexoDescripcion}}</label>
            <div class="col-md-3">
            <input type="text" class="form-control mitexto" id="anexoDescripcion" name="anexoDescripcion"
                  ng-model="registro1.anexoDescripcion" required 
                  value="{{registro1.anexoDescripcion}}"/>
            </div>
        </div>
        <div class="form-group">
            <label class=" milabel col-md-2" for="asistente">{{form_titAsistente}}</label>
            <div class="col-md-8">
            <input type="text" class="form-control mitexto" id="asistente" name="asistente"
                   ng-model="registro1.asistente" value="{{registro1.asistente}}" />
            </div>
        </div>          
       <div class="form-group alert alert-default col-md-8">                    
            <button type="button" value="Actualizar" class="btn btn-custom pull-left btn-xs" 
                ng-click="creaSolicitud(registro1)" id="send_btn">{{form_btnConsulta}}  
            </button>  &nbsp; &nbsp; 
            <button class="btn btn-custom btn-xs" ng-click="exportToExcel(registro1)">
               <span class="btn btn-custom pull-left btn-xs" ></span> {{form_imprime}}
             </button>
        </div> 
         
        <div class="form-group col-md-8" id="tableToExport" >
            <div class="table-responsive" style="overflow-y: scroll;">         
        
                <table class="table table-hover tablex">
                    <tr>  
                      <th>COMITE</th>
                      <th>DETALLE</th>
                      <th>FECHA</th>
                      <th>ACTA</th>
                      <th>ESTADO</th>
                      <th></th>
                  </tr>

                   <tr ng-repeat="detailResponse in detailResponses| filter:search_query">
                       <td>{{detailResponse.comite_nombre}}</td>     
                       <td>{{detailResponse.agenda_Descripcion}}</td>
                       <td>{{detailResponse.agenda_fechaDesde}}</td>
                       <td>{{detailResponse.agenda_acta}}</td>
                       <td>{{detailResponse.agenda_estado}}</td>
              
                       <td> 
                           <button class="btn btn-warning btn-xs" ng-click="editDetailResponse(detailResponse)" title="{{form_btnConsulta}}">
                              <span class="glyphicon glyphicon-book"></span></button>
                      </td>

                  </tr>
               </table>
            </div>
        </div> 
      
   

     </form> 
    </div>
        <div id="miExcel" style='display: none'>
    </div> 
</div>

<script src="controller/min/mm_consultas.ctrl.min.js" type="text/javascript"></script>
