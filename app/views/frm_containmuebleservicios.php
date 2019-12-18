
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                <?php  if ($pf != 'C' ) {
                    echo ' <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class="btn btn-primary btn-xs"
                    ng-click="exporta()">{{form_btnExcel}}</button>';}
                ?> 
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
                    <label class="control-label milabel col-md-4" for="InmuebleServicioEmpresaId">{{form_InmuebleServicioEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="InmuebleServicioEmpresaId" name="InmuebleServicioEmpresaId"
                         ng-model="registro.InmuebleServicioEmpresaId" required Placeholder="{{form_PhInmuebleServicioEmpresaId}}" 
                         value="{{registro.InmuebleServicioEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioInmuebleId">{{form_InmuebleServicioInmuebleId}}</label>
                    <div class="col-md-6">
                    <select id='InmuebleServicioInmuebleId' name='InmuebleServicioInmuebleId' ng-model='registro.InmuebleServicioInmuebleId' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleCodigo}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioServicioId">{{form_InmuebleServicioServicioId}}</label>
                    <div class="col-md-6">
                    <select id='InmuebleServicioServicioId' name='InmuebleServicioServicioId' ng-model='registro.InmuebleServicioServicioId' >
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.ServicioId}}">{{operator1.ServicioCodigo}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioMonto">{{form_InmuebleServicioMonto}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="InmuebleServicioMonto" name="InmuebleServicioMonto"
                         ng-model="registro.InmuebleServicioMonto" required Placeholder="{{form_PhInmuebleServicioMonto}}" 
                         ng-blur="vlrMonto()" value="{{registro.InmuebleServicioMonto}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioCuota">{{form_InmuebleServicioCuota}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="InmuebleServicioCuota" name="InmuebleServicioCuota"
                         ng-model="registro.InmuebleServicioCuota" required Placeholder="{{form_PhInmuebleServicioCuota}}" 
                         value="{{registro.InmuebleServicioCuota}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioSaldo">{{form_InmuebleServicioSaldo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="InmuebleServicioSaldo" name="InmuebleServicioSaldo"
                         ng-model="registro.InmuebleServicioSaldo" required Placeholder="{{form_PhInmuebleServicioSaldo}}" 
                         value="{{registro.InmuebleServicioSaldo}}" readonly="yes"  />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioFechaInicio">{{form_InmuebleServicioFechaInicio}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="InmuebleServicioFechaInicio" name="InmuebleServicioFechaInicio"
                         ng-model="registro.InmuebleServicioFechaInicio" required Placeholder="{{form_PhInmuebleServicioFechaInicio}}" 
                         value="{{registro.InmuebleServicioFechaInicio}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="InmuebleServicioActivo">{{form_InmuebleServicioActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="InmuebleServicioActivo" ng-model="registro.InmuebleServicioActivo" value="I" >{{form_InmuebleServicioActivo80}}
                   </label>
                   <label>
                      <input type="radio" name ="InmuebleServicioActivo" ng-model="registro.InmuebleServicioActivo" value="A" >{{form_InmuebleServicioActivo81}}
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
                <input type="text"	 ng-model="registro.InmuebleServicioId" id ='InmuebleServicioId'  name ='InmuebleServicioId' value="{{registro.InmuebleServicioId}}"/>

   
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
                        <!---th>ID</th>
                        <th>EMPRESA</th-->
                        <th>INMUEBLE</th>
                        <th>SERVICIO</th>
                        <th>MONTO</th>
                        <th>VALOR CUOTA</th>
                        <th>SALDO</th>
                        <th>FECHA INICIO</th>
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.InmuebleServicioId}}</td>
                    <td>{{detail.InmuebleServicioEmpresaId}}</td-->
                    <td>{{detail.inmuebleCodigo}}</td>
                    <td>{{detail.ServicioCodigo}}</td> 
                    <td>{{detail.InmuebleServicioMonto}}</td>
                    <td>{{detail.InmuebleServicioCuota}}</td>
                    <td>{{detail.InmuebleServicioSaldo}}</td>
                    <td>{{detail.InmuebleServicioFechaInicio}}</td>
                    <td>{{detail.InmuebleServicioActivo}}</td>
                    <td>
                    <?php  if ($pf != 'C' ) {
                    echo '  <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                        </td>
                        <td>
                        <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                                confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                        </td>';
                     }?>
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

<script src="controller/ctrls/containmuebleservicios.ctrl.js" type="text/javascript"></script>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 5:07:04   <<<<<<< -->
