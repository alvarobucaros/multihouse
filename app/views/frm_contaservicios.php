
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
                    <label class="control-label milabel col-md-4" for="servicioEmpresaId">{{form_servicioEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="servicioEmpresaId" name="servicioEmpresaId"
                         ng-model="registro.servicioEmpresaId" required Placeholder="{{form_PhservicioEmpresaId}}" 
                         value="{{registro.servicioEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioCodigo">{{form_ServicioCodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioCodigo" name="ServicioCodigo"
                         ng-model="registro.ServicioCodigo" required Placeholder="{{form_PhServicioCodigo}}" 
                         value="{{registro.ServicioCodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioDetalle">{{form_ServicioDetalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioDetalle" name="ServicioDetalle"
                         ng-model="registro.ServicioDetalle" required Placeholder="{{form_PhServicioDetalle}}" 
                         value="{{registro.ServicioDetalle}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="ServicioPeriodo">{{form_ServicioPeriodo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioPeriodo" name="ServicioPeriodo"
                         ng-model="registro.ServicioPeriodo" required Placeholder="{{form_PhServicioPeriodo}}" 
                         value="{{registro.ServicioPeriodo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioFechaDesde">{{form_ServicioFechaDesde}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="ServicioFechaDesde" name="ServicioFechaDesde"
                         ng-model="registro.ServicioFechaDesde" 
                         value="{{registro.ServicioFechaDesde}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioFechaHasta">{{form_ServicioFechaHasta}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="ServicioFechaHasta" name="ServicioFechaHasta"
                         ng-model="registro.ServicioFechaHasta" required Placeholder="{{form_PhServicioFechaHasta}}" 
                         value="{{registro.ServicioFechaHasta}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioValor">{{form_ServicioValor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioValor" name="ServicioValor"
                         ng-model="registro.ServicioValor" required Placeholder="{{form_PhServicioValor}}" 
                         value="{{registro.ServicioValor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioPrioridad">{{form_ServicioPrioridad}}</label>
                    <div class="col-md-6">
                    <select id='prioridad' name='prioridad' ng-model='registro.ServicioPrioridad' >
                     <option ng-repeat='prioridad in prioridad.availableOptions' value = " {{prioridad.prioridad}}">{{prioridad.detalle}}</option>
                      <option ng-repeat='redondeo in redondeo.availableOptions' value = " {{redondeo.tipo}}">{{redondeo.detalle}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioTipo">{{form_ServicioTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ServicioTipo" ng-model="registro.ServicioTipo" value="C" >{{form_ServicioTipo90}}
                   </label>
                   <label>
                      <input type="radio" name ="ServicioTipo" ng-model="registro.ServicioTipo" value="P" >{{form_ServicioTipo91}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioMora">{{form_ServicioMora}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ServicioMora" ng-model="registro.ServicioMora" value="S" >{{form_ServicioMora100}}
                   </label>
                   <label>
                      <input type="radio" name ="ServicioMora" ng-model="registro.ServicioMora" value="N" >{{form_ServicioMora101}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioMoraPorcentaje">{{form_ServicioMoraPorcentaje}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioMoraPorcentaje" name="ServicioMoraPorcentaje"
                         ng-model="registro.ServicioMoraPorcentaje" required Placeholder="{{form_PhServicioMoraPorcentaje}}" 
                         value="{{registro.ServicioMoraPorcentaje}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="servicioMoraValor">{{form_servicioMoraValor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="servicioMoraValor" name="servicioMoraValor"
                         ng-model="registro.servicioMoraValor" required Placeholder="{{form_PhservicioMoraValor}}" 
                         value="{{registro.servicioMoraValor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioCuentaDB">{{form_ServicioCuentaDB}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioCuentaDB" name="ServicioCuentaDB"
                         ng-model="registro.ServicioCuentaDB" required Placeholder="{{form_PhServicioCuentaDB}}" 
                         value="{{registro.ServicioCuentaDB}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioCuentaCR">{{form_ServicioCuentaCR}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioCuentaCR" name="ServicioCuentaCR"
                         ng-model="registro.ServicioCuentaCR" required Placeholder="{{form_PhServicioCuentaCR}}" 
                         value="{{registro.ServicioCuentaCR}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioPPporcentaje">{{form_ServicioPPporcentaje}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioPPporcentaje" name="ServicioPPporcentaje"
                         ng-model="registro.ServicioPPporcentaje" required Placeholder="{{form_PhServicioPPporcentaje}}" 
                         value="{{registro.ServicioPPporcentaje}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioPPvalor">{{form_ServicioPPvalor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ServicioPPvalor" name="ServicioPPvalor"
                         ng-model="registro.ServicioPPvalor" required Placeholder="{{form_PhServicioPPvalor}}" 
                         value="{{registro.ServicioPPvalor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioActivo">{{form_ServicioActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ServicioActivo" ng-model="registro.ServicioActivo" value="S" >{{form_ServicioActivo170}}
                   </label>
                   <label>
                      <input type="radio" name ="ServicioActivo" ng-model="registro.ServicioActivo" value="N" >{{form_ServicioActivo171}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ServicioAmbito">{{form_ServicioAmbito}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ServicioAmbito" ng-model="registro.ServicioAmbito" value="T" >{{form_ServicioAmbito180}}
                   </label>
                   <label>
                      <input type="radio" name ="ServicioAmbito" ng-model="registro.ServicioAmbito" value="G" >{{form_ServicioAmbito181}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="servicioClasificacionId">{{form_servicioClasificacionId}}</label>
                    <div class="col-md-6">
                    <select id='servicioClasificacionId' name='servicioClasificacionId' ng-model='registro.servicioClasificacionId' >
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.clasificacionId}}">{{operator1.clasificacionCodigo}}</option>
                    </select>
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
                <input type="text"	 ng-model="registro.ServicioId" id ='ServicioId'  name ='ServicioId' value="{{registro.ServicioId}}"/>

   
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-11">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <!--th>ID</th>
                        <th>EMPRESA</th-->
                        <th>CODIGO</th>
                        <th>DETALLE</th>
                        <!--th>PERIODO</th-->
                        <th>FECHA DESDE</th>
                        <th>FECHA HASTA</th>
                        <th>VALOR</th>
                        <th>PRIO- RIDAD</th>
                        <th>TIPO</th>
                        <th>MORA</th>
                        <th>% MORA</th>
                        <th>VALOR MORA</th>
                        <th>CUENTA DB</th>
                        <th>CUENTA CR</th>
                        <th>% PRONTO PAGO</th>
                        <th>VALOR PRONTO PAGO</th>
                        <th>ACTIVO</th>
                        <th>AMBITO</th>
                        <th>CLASIFI- CACION</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.ServicioId}}</td>
                    <td>{{detail.servicioEmpresaId}}</td-->
                    <td>{{detail.ServicioCodigo}}</td>
                    <td>{{detail.ServicioDetalle}}</td>
                    <!--td>{{detail.ServicioPeriodo}}</td-->
                    <td>{{detail.ServicioFechaDesde}}</td>
                    <td>{{detail.ServicioFechaHasta}}</td>
                    <td>{{detail.ServicioValor}}</td>
                    <td>{{detail.ServicioPrioridad}}</td>
                    <td>{{detail.ServicioTipo}}</td>
                    <td>{{detail.ServicioMora}}</td>
                    <td>{{detail.ServicioMoraPorcentaje}}</td>
                    <td>{{detail.servicioMoraValor}}</td>
                    <td>{{detail.ServicioCuentaDB}}</td>
                    <td>{{detail.ServicioCuentaCR}}</td>
                    <td>{{detail.ServicioPPporcentaje}}</td>
                    <td>{{detail.ServicioPPvalor}}</td>
                    <td>{{detail.ServicioActivo}}</td>
                    <td>{{detail.nomcase}}</td>
                    <!--td>{{detail.ServicioAmbito}}</td-->
                    <td>{{detail.servicioClasificacionId}}</td>
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

<script src="controller/ctrls/contaservicios.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,Sep 05, 2019 8:27:23   <<<<<<< -->
