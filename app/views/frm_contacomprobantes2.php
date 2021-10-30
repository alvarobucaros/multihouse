
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title2}}</h3>
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
                    <label class="milabel col-md-3" for="compEmpresaId">{{form_compEmpresaId}}</label>
                   <div class="col-md-7">
                    <input type="text" class="form-control mitexto" id="compEmpresaId" name="compEmpresaId"
                         ng-model="registro.compEmpresaId" required Placeholder="{{form_PhcompEmpresaId}}" 
                         value="{{registro.compEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="milabel col-md-3" for="compCodigo">{{form_compCodigo}}</label>
                   <div class="col-md-7">
                    <input type="text" class="form-control mitexto" id="compCodigo" name="compCodigo"
                         ng-model="registro.compCodigo" required Placeholder="{{form_PhcompCodigo2}}" 
                         value="{{registro.compCodigo}}" />
                    </div>
                </div> 

                <div class="form-group" ng-show="tipoCO">
                    <label class="milabel col-md-3" for="compTipo">{{form_compTipo}}</label>
                    <div class="btn-group  col-md-7"  data-toggle="buttons">
                   <label>
                       <input type="radio" name ="compTipo" ng-model="registro.compTipo" ng-change="cambiaTipo()" value="C" >{{form_compTipo30}}
                   </label>
                   <label>
                      <input type="radio" name ="compTipo" ng-model="registro.compTipo" ng-change="cambiaTipo()" value="O" >{{form_compTipo31}}
                   </label>
                    </div>
                </div> 

                <div class="form-group" ng-show="tipoCO">
                    <label class="milabel col-md-3" for="compTipo">{{form_compTipo}}</label>
                    <div class="btn-group  col-md-7"  data-toggle="buttons">
                   <label>
                        <input type="radio" name ="compTipo" ng-model="registro.compTipo" value="I" >{{form_compTipo32}}
                   </label>
                   <label>
                        <input type="radio" name ="compTipo" ng-model="registro.compTipo"  value="G" >{{form_compTipo33}}
                   </label>
                    </div>
                </div>
                <div class="form-group">
                   <label class="milabel col-md-3" for="compNombre">{{form_compNombre}}</label>
                   <div class="col-md-7">
                    <input type="text" class="form-control mitexto" id="compNombre" name="compNombre"
                         ng-model="registro.compNombre" required Placeholder="{{form_PhcompNombre}}" 
                         value="{{registro.compNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="milabel col-md-3" for="compDetalle">{{form_compDetalle}}</label>
                   <div class="col-md-7">
                    <input type="text" class="form-control mitexto" id="compDetalle" name="compDetalle"
                         ng-model="registro.compDetalle" required Placeholder="{{form_PhcompDetalle}}" 
                         value="{{registro.compDetalle}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="milabel col-md-3" for="compConsecutivo">{{form_compConsecutivo}}</label>
                   <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="compConsecutivo" name="compConsecutivo"
                         ng-model="registro.compConsecutivo" required Placeholder="{{form_PhcompConsecutivo}}" 
                         value="{{registro.compConsecutivo}}" />
                    </div>
                </div> 
                <div ng-show="movto" class="sombra">
                    <div class="form-group">
                        <label class="milabel col-md-4" for="compcpbnte">{{form_compcpbnte}}</label>
                        <div class="col-md-6">
                        <select id='compcpbnte' name='compcpbnte' ng-model='registro.compcpbnte'>
                         <option ng-repeat='operator0 in operators5' value = " {{operator0.compCodigo}}">{{operator0.compNombre}}</option>
                        </select>
                        </div>
                    </div> 
                    <div class="form-group" ng-show="cualCta">
                        <label class="milabel col-md-3" for="moviConCuenta">{{form_moviConCuenta}}</label>
                        <div class="col-md-7">
                        <select id='moviConCuenta' name='moviConCuenta' ng-model='CuentaCtble' 
                                ng-change="buscaCuenta()">
                         <option ng-repeat='operator2 in operators2' value = " {{operator2.pucCuenta}}">{{operator2.pucNombre}}</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="milabel col-md-3" for="compctadb0">{{form_compctadb0}}</label>
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(1)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctadb0" name="compctadb0"
                               ng-model="registro.compctadb0" readonly="yes" value="{{registro.compctadb0}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle0" name="compDetalle0"
                        readonly="yes" ng-model="nomCuentadb0" />
                        </div>zz
                    </div> 

                    <div class="form-group" ng-show="tipoCO">
                        <label class="milabel col-md-3" for="compctadb1">{{form_compctadb1}}</label>                        
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(2)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctadb1" name="compctadb1"
                               ng-model="registro.compctadb1" readonly="yes" value="{{registro.compctadb1}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle1" name="compDetalle1"
                        readonly="yes" ng-model="nomCuentadb1" />
                        </div>                        
                    </div> 

                    <div class="form-group" ng-show="tipoCO">
                        <label class="milabel col-md-3" for="compctadb2">{{form_compctadb2}}</label>
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(3)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctadb2" name="compctadb2"
                               ng-model="registro.compctadb2" readonly="yes" value="{{registro.compctadb2}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle2" name="compDetalle2"
                        readonly="yes" ng-model="nomCuentadb2" />
                        </div>  
                    </div> 

                    <div class="form-group">
                        <label class="milabel col-md-3" for="compctacr0">{{form_compctacr0}}</label>
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(4)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctacr0" name="compctacr0"
                               ng-model="registro.compctacr0" readonly="yes" value="{{registro.compctacr0}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle4" name="compDetalle4"
                        readonly="yes" ng-model="nomCuentacr0" />
                        </div>                          
                    </div> 

                    <div class="form-group" ng-show="tipoCO">
                        <label class="milabel col-md-3" for="compctacr1">{{form_compctacr1}}</label>
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(5)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctacr1" name="compctacr1"
                               ng-model="registro.compctacr1" readonly="yes" value="{{registro.compctacr1}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle5" name="compDetalle5"
                        readonly="yes" ng-model="nomCuentacr1" />
                        </div>
                    </div> 

                    <div class="form-group" ng-show="tipoCO">
                        <label class="milabel col-md-3" for="compctacr2">{{form_compctacr2}}</label>
                       <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="abreCta(6)" >{{form_btnCta}}</button> 
                       </div>
                        <div class="col-md-2">                               
                        <input type="text" class="form-control mitexto" id="compctacr2" name="compctacr2"
                               ng-model="registro.compctacr2" readonly="yes" value="{{registro.compctacr2}}" /> 
                        </div>
                        <div class="col-md-4">  
                        <input type="text" class="form-control mitexto" id="compDetalle6" name="compDetalle6"
                        readonly="yes" ng-model="nomCuentacr2" />
                        </div>
                    </div> 

                </div>
                <div class="form-group">
                    <label class="milabel col-md-3" for="compActivo">{{form_compActivo}}</label>
                    <div class="btn-group  col-md-7"  data-toggle="buttons">
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
                <input type="text" ng-model="registro.compId" id ='compId'  name ='compId' value="{{registro.compId}}"/>
                <input type="text" ng-model="buscaCta" id ='buscaCta'  name ='buscaCta' />
                <input type="text" ng-model="control" id ='control'  name ='control'  value ="C2"/>
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
                         <th>TIPO</th>
                        <!--th>CTADB0</th>
                        <th>CTADB1</th>
                        <th>CTADB2</th>
                        <th>CTACR0</th>
                        <th>CTACR1</th>
                        <th>CTACR2</th-->
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.compId}}</td>
                    <td>{{detail.compEmpresaId}}</td-->
                    <td>{{detail.compCodigo}}</td>
                   
                    <td>{{detail.compNombre}}</td>
                    <td>{{detail.compDetalle}}</td>
                    <td>{{detail.compConsecutivo}}</td>
                    <td>{{detail.nonTipo}}</td>
                    <!--td>{{detail.compctadb0}}</td>
                    <td>{{detail.compctadb1}}</td>
                    <td>{{detail.compctadb2}}</td>
                    <td>{{detail.compctacr0}}</td>
                    <td>{{detail.compctacr1}}</td>
                    <td>{{detail.compctacr2}}</td-->
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

<script src="controller/ctrls/contacomprobantes.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Feb 10, 2020 8:53:04   <<<<<<< -->
