
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                <?php  if ($pf != 'C' ) {
                    echo ' <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class="btn btn-primary btn-xs"
                    ng-click="exporta()">{{form_btnExcel}}</button>
                    <button class="btn btn-primary btn-xs"
                    ng-click="calculos()">{{form_btnCalculo}}</button>';}
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

                <div class="form-group" ng-show='v1'>
                    <label class="control-label milabel col-md-4" for="inmuebleEmpresaId">{{form_inmuebleEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleEmpresaId" name="inmuebleEmpresaId"
                         ng-model="registro.inmuebleEmpresaId" required Placeholder="{{form_PhinmuebleEmpresaId}}" 
                         value="{{registro.inmuebleEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleCodigo">{{form_inmuebleCodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleCodigo" name="inmuebleCodigo"
                         ng-model="registro.inmuebleCodigo" required Placeholder="{{form_PhinmuebleCodigo}}" 
                         value="{{registro.inmuebleCodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleDescripcion">{{form_inmuebleDescripcion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleDescripcion" name="inmuebleDescripcion"
                         ng-model="registro.inmuebleDescripcion" required Placeholder="{{form_PhinmuebleDescripcion}}" 
                         value="{{registro.inmuebleDescripcion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueblePrincipal">{{form_inmueblePrincipal}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="inmueblePrincipal" ng-model="registro.inmueblePrincipal" value="NO" >{{form_inmueblePrincipal40}}
                   </label>
                   <label>
                      <input type="radio" name ="inmueblePrincipal" ng-model="registro.inmueblePrincipal" value="SI" >{{form_inmueblePrincipal41}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleDepende">{{form_inmuebleDepende}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleDepende" name="inmuebleDepende"
                         ng-model="registro.inmuebleDepende" required Placeholder="{{form_PhinmuebleDepende}}" 
                         value="{{registro.inmuebleDepende}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleArea">{{form_inmuebleArea}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleArea" name="inmuebleArea"
                         ng-model="registro.inmuebleArea" required Placeholder="{{form_PhinmuebleArea}}" 
                         value="{{registro.inmuebleArea}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleCoeficiente">{{form_inmuebleCoeficiente}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleCoeficiente" name="inmuebleCoeficiente"
                         ng-model="registro.inmuebleCoeficiente" required Placeholder="{{form_PhinmuebleCoeficiente}}" 
                         value="{{registro.inmuebleCoeficiente}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleUbicacion">{{form_inmuebleUbicacion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmuebleUbicacion" name="inmuebleUbicacion"
                         ng-model="registro.inmuebleUbicacion" required Placeholder="{{form_PhinmuebleUbicacion}}" 
                         value="{{registro.inmuebleUbicacion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmuebleClasificacionId">{{form_inmuebleClasificacionId}}</label>
                    <div class="col-md-6">
                    <select id='inmuebleClasificacionId' name='inmuebleClasificacionId' ng-model='registro.inmuebleClasificacionId' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.clasificacionId}}">{{operator0.clasificacionCodigo}}</option>
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
                <input type="text"	 ng-model="registro.inmuebleId" id ='inmuebleId'  name ='inmuebleId' value="{{registro.inmuebleId}}"/>

   
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
                        <th>DESCRIPCION</th>
                        <th>PRINCIPAL</th>
                        <th>DEPENDE</th>
                        <th>AREA</th>
                        <th>COEFICIENTE</th>
                        <th>UBICACION</th>
                        <th>CLASIFICACION</th>
                       
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.inmuebleId}}</td>
                    <td>{{detail.inmuebleEmpresaId}}</td-->
                    <td>{{detail.inmuebleCodigo}}</td>
                    <td>{{detail.inmuebleDescripcion}}</td>
                    <td>{{detail.inmueblePrincipal}}</td>
                    <td>{{detail.inmuebleDepende}}</td>
                    <td>{{detail.inmuebleArea}}</td>
                    <td>{{detail.inmuebleCoeficiente}}</td>
                    <td>{{detail.inmuebleUbicacion}}</td>
                    <!--td>{{detail.inmuebleClasificacionId}}</td-->
                    <td>{{detail.clasificacionCodigo}}</td>
                    
                    <?php  if ($pf != 'C' ) {
                    echo '  <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
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

<script src="controller/ctrls/containmuebles.ctrl.js" type="text/javascript"></script>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 17, 2019 9:40:35   <<<<<<< -->
