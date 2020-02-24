
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

   

                <div class="form-group">
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
                    <label class="control-label milabel col-md-4" for="compDetalle">{{form_compDetalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compDetalle" name="compDetalle"
                         ng-model="registro.compDetalle" required Placeholder="{{form_PhcompDetalle}}" 
                         value="{{registro.compDetalle}}" />
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
                    <label class="control-label milabel col-md-4" for="compctadb0">{{form_compctadb0}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctadb0" name="compctadb0"
                         ng-model="registro.compctadb0" required Placeholder="{{form_Phcompctadb0}}" 
                         value="{{registro.compctadb0}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compctadb1">{{form_compctadb1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctadb1" name="compctadb1"
                         ng-model="registro.compctadb1" required Placeholder="{{form_Phcompctadb1}}" 
                         value="{{registro.compctadb1}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compctadb2">{{form_compctadb2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctadb2" name="compctadb2"
                         ng-model="registro.compctadb2" required Placeholder="{{form_Phcompctadb2}}" 
                         value="{{registro.compctadb2}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compctacr0">{{form_compctacr0}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctacr0" name="compctacr0"
                         ng-model="registro.compctacr0" required Placeholder="{{form_Phcompctacr0}}" 
                         value="{{registro.compctacr0}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compctacr1">{{form_compctacr1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctacr1" name="compctacr1"
                         ng-model="registro.compctacr1" required Placeholder="{{form_Phcompctacr1}}" 
                         value="{{registro.compctacr1}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compctacr2">{{form_compctacr2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="compctacr2" name="compctacr2"
                         ng-model="registro.compctacr2" required Placeholder="{{form_Phcompctacr2}}" 
                         value="{{registro.compctacr2}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compTipo">{{form_compTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="compTipo" ng-model="registro.compTipo" value="I" >{{form_compTipo120}}
                   </label>
                   <label>
                      <input type="radio" name ="compTipo" ng-model="registro.compTipo" value="E" >{{form_compTipo121}}
                   </label>
                   <label>
                      <input type="radio" name ="compTipo" ng-model="registro.compTipo" value="C" >{{form_compTipo122}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="compActivo">{{form_compActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="compActivo" ng-model="registro.compActivo" value="A" >{{form_compActivo130}}
                   </label>
                   <label>
                      <input type="radio" name ="compActivo" ng-model="registro.compActivo" value="I" >{{form_compActivo131}}
                   </label>
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
                        <th>DETALLE</th>
                        <th>SECUENCIA</th>
                        <th>CTADB0</th>
                        <th>CTADB1</th>
                        <th>CTADB2</th>
                        <th>CTACR0</th>
                        <th>CTACR1</th>
                        <th>CTACR2</th>
                        <th>TIPO</th>
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.compId}}</td>
                    <td>{{detail.compEmpresaId}}</td-->
                    <td>{{detail.compCodigo}}</td>
                    <td>{{detail.compNombre}}</td>
                    <td>{{detail.compDetalle}}</td>
                    <td>{{detail.compConsecutivo}}</td>
                    <td>{{detail.compctadb0}}</td>
                    <td>{{detail.compctadb1}}</td>
                    <td>{{detail.compctadb2}}</td>
                    <td>{{detail.compctacr0}}</td>
                    <td>{{detail.compctacr1}}</td>
                    <td>{{detail.compctacr2}}</td>
                    <td>{{detail.compTipo}}</td>
                    <td>{{detail.compActivo}}</td>
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

<script src="controller/ctrls/contaplancontable.ctrl.js" type="text/javascript"></script>

<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Jan 13, 2020 10:59:05   <<<<<<< -->
