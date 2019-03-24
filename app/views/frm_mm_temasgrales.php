
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
                    <label class="control-label milabel col-md-4" for="temasGrales_comiteId">{{form_temasGrales_comiteId}}</label>
                    <div class="col-md-6">
                    <select id='temasGrales_comiteId' name='temasGrales_comiteId' ng-model='registro.temasGrales_comiteId' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.comite_id}}">{{operator0.comite_nombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="temasGrales_titulo">{{form_temasGrales_titulo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="temasGrales_titulo" name="temasGrales_titulo"
                         ng-model="registro.temasGrales_titulo" required Placeholder="{{form_PhtemasGrales_titulo}}" 
                         value="{{registro.temasGrales_titulo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="temasGrales_detalle">{{form_temasGrales_detalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="temasGrales_detalle" name="temasGrales_detalle"
                         ng-model="registro.temasGrales_detalle" required Placeholder="{{form_PhtemasGrales_detalle}}" 
                         value="{{registro.temasGrales_detalle}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="temasGrales_estado">{{form_temasGrales_estado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="temasGrales_estado" ng-model="registro.temasGrales_estado" value="A" >{{form_Activo50}}
                   </label>
                   <label>
                      <input type="radio" name ="temasGrales_estado" ng-model="registro.temasGrales_estado" value="I" >{{form_Activo51}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send1_btn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send2_btn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                 <input type="text" ng-model="registro.temasGrales_id" id ='temasGrales_id'  name ='temasGrales_id' value="{{registro.temasGrales_id}}"/>
                 <input type="text" ng-model="registro.temasGrales_empresa" id="temasGrales_empresa" name="temasGrales_empresa" value="{{registro.temasGrales_empresa}}" />
   
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
                        <th>EMPRESA</th>-->
                        <th>COMITE</th>
                        <th>TITULO</th>
                        <th>DETALLE</th>
                        <th>ESTADO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details| filter:search_query  | startFromGrid: currentPage * pageSize | limitTo: pageSize">
<!--                    <td>{{detail.temasGrales_id}}</td>
                    <td>{{detail.temasGrales_empresa}}</td>-->
                    <td>{{detail.comite_nombre}}</td>
                    <td>{{detail.temasGrales_titulo}}</td>
                    <td>{{detail.temasGrales_detalle}}</td>
                    <td>{{detail.temasGrales_estado}}</td>
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

<script src="controller/min/mm_temasgrales.ctrl.min.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 26, 2017 10:19:17   <<<<<<< -->
