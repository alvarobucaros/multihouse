
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='exporta()'>{{form_btnExcel}}</button>
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

   

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="compEmpresaId">{{form_compEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compEmpresaId" name="compEmpresaId"
                         ng-model="registro.compEmpresaId" required Placeholder="{{form_PhcompEmpresaId}}" 
                         value="{{registro.compEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compCodigo">{{form_compCodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compCodigo" name="compCodigo"
                         ng-model="registro.compCodigo" required Placeholder="{{form_PhcompCodigo}}" 
                         value="{{registro.compCodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compNombre">{{form_compNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compNombre" name="compNombre"
                         ng-model="registro.compNombre" required Placeholder="{{form_PhcompNombre}}" 
                         value="{{registro.compNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compConsecutivo">{{form_compConsecutivo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compConsecutivo" name="compConsecutivo"
                         ng-model="registro.compConsecutivo" required Placeholder="{{form_PhcompConsecutivo}}" 
                         value="{{registro.compConsecutivo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compActivo">{{form_compActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="compActivo" ng-model="registro.compActivo" value="I" >{{form_compActivo50}}
                   </label>
                   <label>
                      <input type="radio" name ="compActivo" ng-model="registro.compActivo" value="A" >{{form_compActivo51}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compDetalle">{{form_compDetalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compDetalle" name="compDetalle"
                         ng-model="registro.compDetalle" required Placeholder="{{form_PhcompDetalle}}" 
                         value="{{registro.compDetalle}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btnCe">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text"	 ng-model="registro.compId" id ='compId'  name ='compId' value="{{registro.compId}}"/>

   
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <!--th>ID</th>
                        <th>EMPRESA</th-->
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>SECUENCIA</th>
                        <th>ACTIVO</th>
                        <th>DETALLE</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.compId}}</td>
                    <td>{{detail.compEmpresaId}}</td-->
                    <td>{{detail.compCodigo}}</td>
                    <td>{{detail.compNombre}}</td>
                    <td>{{detail.compConsecutivo}}</td>
                    <td>{{detail.compActivo}}</td>
                    <td>{{detail.compDetalle}}</td>
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

<script src="controller/ctrls/contacomprobantes.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 10:33:12   <<<<<<< -->
