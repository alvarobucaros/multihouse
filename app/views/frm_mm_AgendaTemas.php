
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control mitexto busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query" required>
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">


                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_comite">{{form_tema_comite}}</label>
                    <div class="col-md-6">
                    <select id='tema_comite' name='tema_comite' ng-model='registro.tema_comite' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.comite_id}}">{{operator0.comite_nombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_titulo">{{form_tema_titulo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="tema_titulo" name="tema_titulo"
                         ng-model="registro.tema_titulo" required Placeholder="{{form_Phtema_titulo}}" 
                         value="{{registro.tema_titulo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_detalle">{{form_tema_detalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="tema_detalle" name="tema_detalle"
                         ng-model="registro.tema_detalle" required Placeholder="{{form_Phtema_detalle}}" 
                         value="{{registro.tema_detalle}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_tipo">{{form_tema_tipo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="tema_tipo" name="tema_tipo"
                         ng-model="registro.tema_tipo" required Placeholder="{{form_Phtema_tipo}}" 
                         value="{{registro.tema_tipo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_responsable">{{form_tema_responsable}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="tema_responsable" name="tema_responsable"
                         ng-model="registro.tema_responsable" required Placeholder="{{form_Phtema_responsable}}" 
                         value="{{registro.tema_responsable}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_fechaAsigna">{{form_tema_fechaAsigna}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="tema_fechaAsigna" name="tema_fechaAsigna"
                         ng-model="registro.tema_fechaAsigna" required Placeholder="{{form_Phtema_fechaAsigna}}" 
                         value="{{registro.tema_fechaAsigna}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tema_estado">{{form_tema_estado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tema_estado" ng-model="registro.tema_estado" value="I" >{{form_Activo90}}
                   </label>
                   <label>
                      <input type="radio" name ="tema_estado" ng-model="registro.tema_estado" value="A" >{{form_Activo91}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                    <input type="text" ng-model="registro.tema_id" id ='tema_id'  name ='tema_id' value="{{registro.tema_id}}"/>
                    <input type="text" class="form-control mitexto" id="tema_agendaId" name="tema_agendaId"
                    ng-model="registro.tema_agendaId" value="{{registro.tema_agendaId}}" />
                    <input type="text" class="form-control mitexto" id="tema_empresa" name="tema_empresa"
                     ng-model="registro.tema_empresa"  value="{{registro.tema_empresa}}" />
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
<!--                        <th>ID</th>
                        <th>AGENDAID</th>
                        <th>EMPRESA</th>-->
                        <th>COMITE</th>
                        <th>TITULO</th>
                        <th>DETALLE</th>
                        <th>TIPO</th>
                        <th>RESPONSABLE</th>
                        <th>FECHAASIGNA</th>
                        <th>ESTADO</th>
                    </tr>
                   
                     <tr ng-repeat="detail in details| filter:search_query  | startFromGrid: currentPage * pageSize | limitTo: pageSize">

                    <td>{{detail.comite_nombre}}</td>
                    <td>{{detail.tema_titulo}}</td>
                    <td>{{detail.tema_detalle}}</td>
                    <td>{{detail.tema_tipo}}</td>
                    <td>{{detail.tema_responsable}}</td>
                    <td>{{detail.tema_fechaAsigna}}</td>
                    <td>{{detail.tema_estado}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                </table>
                    <div class='btn-group'>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage === 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage === page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage >= details.length/pageSize - 1', ng-click='currentPage = currentPage + 1'>&raquo;</button>
                    </div>                 
            </div>
        </div>
</div>

<script src="controller/min/mm_agendatemas.ctrl.min.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 5:02:00   <<<<<<< -->
