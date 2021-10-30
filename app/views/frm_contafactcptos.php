
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
                    <label class="control-label milabel col-md-4" for="cptosCodigo">{{form_cptosCodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="cptosCodigo" name="cptosCodigo"
                         ng-model="registro.cptosCodigo" required Placeholder="{{form_PhcptosCodigo}}" 
                         value="{{registro.cptosCodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="cptosDetalle">{{form_cptosDetalle}}</label>
                   <div class="col-md-6">
                    <textarea class="form-control mitexto" id="cptosDetalle" name="cptosDetalle"
                         ng-model="registro.cptosDetalle" required Placeholder="{{form_PhcptosDetalle}}" 
                         rows="3" cols="90" value="{{registro.cptosDetalle}}"> </textarea>
                      </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="cptosValor">{{form_cptosValor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="cptosValor" name="cptosValor"
                         ng-model="registro.cptosValor" required Placeholder="{{form_PhcptosValor}}" 
                         value="{{registro.cptosValor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="cptosIva">{{form_cptosIva}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="cptosIva" name="cptosIva"
                         ng-model="registro.cptosIva" required Placeholder="{{form_PhcptosIva}}" 
                         value="{{registro.cptosIva}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="cptosEstado">{{form_cptosEstado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="cptosEstado" ng-model="registro.cptosEstado" value="I" >{{form_cptosEstado60}}
                   </label>
                   <label>
                      <input type="radio" name ="cptosEstado" ng-model="registro.cptosEstado" value="A" >{{form_cptosEstado61}}
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
                <input type="text"	 ng-model="registro.cptosid" id ='cptosid'  name ='cptosid' value="{{registro.cptosid}}"/>
                <input type="text"  id="cptosEmpresa" name="cptosEmpresa"
                         ng-model="registro.cptosEmpresa"  value="{{registro.cptosEmpresa}}" />
   
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
<!--                        <th>ID</th>
                        <th>EMPRESA</th>-->
                        <th>CODIGO</th>
                        <th>DETALLE</th>
                        <th>VALOR</th>
                        <th>IVA</th>
                        <th>ESTADO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
<!--                    <td>{{detail.cptosid}}</td>
                    <td>{{detail.cptosEmpresa}}</td>-->
                    <td>{{detail.cptosCodigo}}</td>
                    <td>{{detail.cptosDetalle}}</td>
                    <td>{{detail.cptosValor}}</td>
                    <td>{{detail.cptosIva}}</td>
                    <td>{{detail.cptosEstado}}</td>
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

<script src="controller/ctrls/contafactcptos.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 9:05:47   <<<<<<< -->
