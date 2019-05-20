
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="uploadimage"  method="post" enctype="multipart/form-data"
                  ng-submit="insertInfo(registro);" >

                <div id="message"></div>                
                
                
                <div class="form-group">
                    <label class=" milabel col-md-2" for="agenda_comiteId">{{form_agenda_comiteId}}</label>
                    <div class="col-md-5">
                        <select id='agenda_comiteId' name='agenda_comiteId' ng-model='registro.agenda_comiteId'   
                        ng-change="updateComite()">
                         <option ng-repeat='operator0 in operators0' value = " {{operator0.comite_id}}">{{operator0.comite_nombre}}</option>
                        </select> 
                    </div>
                </div>   

                <div class="form-group">
                    <label class="milabel col-md-2" for="agenda_id">{{form_anexos_acta_id}}</label>
                    <div class="col-md-5">
                        <select id='agenda_acta' name='agenda_id' ng-model='registro.agenda_id' 
                                ng-change="comiteSeleccionado()" >
                         <option ng-repeat='operator1 in operators1' value = " {{operator1.agenda_id}}">{{operator1.agenda_Descripcion}}</option>
                        </select>
                    </div>
                </div> 
                
                <div class="form-group">
                   <label class="milabel col-md-2" for="anexos_descripcion">{{form_anexos_descripcion}}</label>
                    <div class="col-md-7">
                    <input type="text" class="form-control mitexto" id="anexos_descripcion" name="anexos_descripcion"
                        ng-model="registro.anexos_descripcion" required Placeholder="{{form_Phanexos_descripcion}}" 
                        value="{{registro.anexos_descripcion}}" />
                   </div>          
               </div>                

                <div class="form-group" id="dropBox">
                    <label class="milabel col-md-2" for="anexos_anexo">{{form_anexos_anexo}}</label>
                    <div class="col-md-7">
                        <input type="file" name="file" id="file" required  accept="application/pdf"  ng-click="botonOk()">                       
                    </div> 
                    <div class="col-md-7" id = "btnCarga" ng-show="btnCarga">
                        <input type="submit" value='Carga Documento' class="submit" ng-click="recarga()">
                    </div>
                    <div class="col-md-7" id = "btnReCarga" ng-show="btnActualiza" >
                        <button class="btn btn-primary btn-xs" 
                        ng-click="actualizaLista()">{{form_btnRecarga}}<span class="glyphicon" aria-hidden="true"></span></button>               
                    </div>
                    <div id="divRuedita" ng-show="ruedita">
                        <img src="img/progress.gif" alt=""/>                   
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="col-md-10">
                    <!-- Table to show employee detalis -->
                    <div class="table-responsive">
                        <br/>
                        <table class="table table-hover tablex">
                            <tr>
                                <th>ANEXO</th>
                                <th>DESCRIPCION</th>
                                <th>BORRAR</th>
<!--                      >!--          <th>VER</th>-->
                            </tr>

                            <tr ng-repeat="detail in details| filter:search_query">
                            <td>{{detail.anexos_anexo}}</td>
                            <td>{{detail.anexos_descripcion}}</td>
                            <td>
                            <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                                    confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                            </button>
                            </td>
                      <!--       <td>
                            <button class="btn btn-danger btn-xs" ng-click="verPdf(detail)(detail)">
                                    <span class="glyphicon glyphicon-print"></span>
                            </button>
                            </td>  -->
                            </tr>
                        </table>
                        <div  id="divOcultos" ng-show="datosOcultos"> 
                            <input type="text" ng-model="registro.actaId" id ='actaId'  name ='actaId' value="{{registro.actaId}}"/>
                            <input type="text" ng-model="registro.comiteId" id ='anexos_id'  name ='anexos_id' value="{{registro.comiteId}}"/>
                            <input type="text" ng-model="registro.anno" id ='anno'  name ='' value="{{registro.anno}}"/>
                            <input type="text" ng-model="registro.dibujo" id ='Dibujo'  name ='' value="{{registro.dibujo}}"/>
                            <input type="text" id ='control'  name ='' value="" onchange="actualizaLista();"/>
                        </div>                        
                    </div>
                </div>
        </form>
    </div>
</div>
<!--
<script src="controller/min/mm_cargas.ctrl.min.js" type="text/javascript"></script>     
<script src="controller/min/mm_agendaanexos.ctrl.min.js" type="text/javascript"></script>  
-->
<script src="controller/ctrl/mm_agendaanexos.ctrl.js" type="text/javascript"></script>
<script src="controller/ctrl/mm_cargas.ctrl.js" type="text/javascript"></script>