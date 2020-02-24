
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

   
                <div style='display: none'>
                    <div class="form-group">
                        <label class="control-label milabel col-md-4" for="pucEmpresaId">{{form_pucEmpresaId}}</label>
                       <div class="col-md-6">
                        <input type="text" class="form-control mitexto" id="pucEmpresaId" name="pucEmpresaId"
                             ng-model="registro.pucEmpresaId" required Placeholder="{{form_PhpucEmpresaId}}" 
                             value="{{registro.pucEmpresaId}}" />
                        </div>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucCuenta">{{form_pucCuenta}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pucCuenta" name="pucCuenta"
                         ng-model="registro.pucCuenta" required Placeholder="{{form_PhpucCuenta}}" 
                         value="{{registro.pucCuenta}}" ng-blur="miEstructura()" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucNombre">{{form_pucNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pucNombre" name="pucNombre"
                         ng-model="registro.pucNombre" required Placeholder="{{form_PhpucNombre}}" 
                         value="{{registro.pucNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucMayor">{{form_pucMayor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pucMayor" name="pucMayor"
                         ng-model="registro.pucMayor" required Placeholder="{{form_PhpucMayor}}" readonly="yes"
                         value="{{registro.pucMayor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucNivel">{{form_pucNivel}}</label>
                   <div class="col-md-6">
                       <input type="text" class="form-control mitexto" id="pucNivel" name="pucNivel" readonly="yes"
                         ng-model="registro.pucNivel" required Placeholder="{{form_PhpucNivel}}" 
                         value="{{registro.pucNivel}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucTipo">{{form_pucTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="pucTipo" ng-model="registro.pucTipo" value="M" >{{form_pucTipo60}}
                   </label>
                   <label>
                      <input type="radio" name ="pucTipo" ng-model="registro.pucTipo" value="T" >{{form_pucTipo61}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucActivo">{{form_pucActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="pucActivo" ng-model="registro.pucActivo" value="A" >{{form_pucActivo70}}
                   </label>
                   <label>
                      <input type="radio" name ="pucActivo" ng-model="registro.pucActivo" value="I" >{{form_pucActivo71}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucClase">{{form_pucClase}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="pucClase" ng-model="registro.pucClase" value="N" >{{form_pucClase80}}
                   </label>
                   <label>
                      <input type="radio" name ="pucClase" ng-model="registro.pucClase" value="I" >{{form_pucClase81}}
                   </label>
                   <label>
                      <input type="radio" name ="pucClase" ng-model="registro.pucClase" value="R" >{{form_pucClase82}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pucValor">{{form_pucValor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pucValor" name="pucValor"
                         ng-model="registro.pucValor" required Placeholder="{{form_PhpucValor}}" 
                         value="{{registro.pucValor}}" />
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
                <input type="text" ng-model="registro.pucId" id ='pucId'  name ='pucId' value="{{registro.pucId}}"/>
                <input type="text" ng-model="estructura" id ='estructura'  name ='estructura' value="{{estructura}}"/>
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
                        <th>CUENTA</th>
                        <th>NOMBRE CUENTA</th>
                        <th>MAYOR</th>
                        <th>NIVEL</th>
                        <th>TIPO</th>
                        <th>ACTIVO</th>
                        <th>CLASE</th>
                        <th>VALOR</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.pucId}}</td>
                    <td>{{detail.pucEmpresaId}}</td-->
                    <td>{{detail.pucCuenta}}</td>
                    <td>{{detail.pucNombre}}</td>
                    <td>{{detail.pucMayor}}</td>
                    <td>{{detail.pucNivel}}</td>
                    <td>{{detail.pucTipo}}</td>
                    <td>{{detail.pucActivo}}</td>
                    <td>{{detail.pucClase}}</td>
                    <td>{{detail.pucValor}}</td>
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

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Jan 13, 2020 11:54:47   <<<<<<< -->
