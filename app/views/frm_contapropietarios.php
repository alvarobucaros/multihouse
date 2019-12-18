
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
                    <label class="control-label milabel col-md-4" for="propietarioEmpresaId">{{form_propietarioEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="propietarioEmpresaId" name="propietarioEmpresaId"
                         ng-model="registro.propietarioEmpresaId" required Placeholder="{{form_PhpropietarioEmpresaId}}" 
                         value="{{registro.propietarioEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioNombre">{{form_propietarioNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="propietarioNombre" name="propietarioNombre"
                         ng-model="registro.propietarioNombre" required Placeholder="{{form_PhpropietarioNombre}}" 
                         value="{{registro.propietarioNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioCedula">{{form_propietarioCedula}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="propietarioCedula" name="propietarioCedula"
                         ng-model="registro.propietarioCedula" required Placeholder="{{form_PhpropietarioCedula}}" 
                         value="{{registro.propietarioCedula}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioTelefonos">{{form_propietarioTelefonos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="propietarioTelefonos" name="propietarioTelefonos"
                         ng-model="registro.propietarioTelefonos" required Placeholder="{{form_PhpropietarioTelefonos}}" 
                         value="{{registro.propietarioTelefonos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioDireccion">{{form_propietarioDireccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="propietarioDireccion" name="propietarioDireccion"
                         ng-model="registro.propietarioDireccion" required Placeholder="{{form_PhpropietarioDireccion}}" 
                         value="{{registro.propietarioDireccion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioCorreo">{{form_propietarioCorreo}}</label>
                   <div class="col-md-6">
                    <input type="email" class="form-control mitexto" id="propietarioCorreo" name="propietarioCorreo"
                         ng-model="registro.propietarioCorreo" required Placeholder="{{form_PhpropietarioCorreo}}" 
                         pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"  value="{{registro.propietarioCorreo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="propietarioActivo">{{form_propietarioActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="propietarioActivo" ng-model="registro.propietarioActivo" 
                      value="I" >{{form_propietarioActivo70}}
                   </label>
                   <label>
                      <input type="radio" name ="propietarioActivo" ng-model="registro.propietarioActivo" 
                      value="A" >{{form_propietarioActivo71}}
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
                <input type="text"	 ng-model="registro.propietarioId" id ='propietarioId'  name ='propietarioId' value="{{registro.propietarioId}}"/>

   
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
                        <!-- th>ID</th>
                        <th>EMPRESA</th -->
                        <th>NOMBRE</th>
                        <th>CEDULA</th>
                        <th>TELEFONOS</th>
                        <th>DIRECCION</th>
                        <th>E-MAIL</th>
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.propietarioId}}</td>
                    <td>{{detail.propietarioEmpresaId}}</td -->
                    <td>{{detail.propietarioNombre}}</td>
                    <td>{{detail.propietarioCedula}}</td>
                    <td>{{detail.propietarioTelefonos}}</td>
                    <td>{{detail.propietarioDireccion}}</td>
                    <td>{{detail.propietarioCorreo}}</td>
                    <td>{{detail.propietarioActivo}}</td>
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
<script src="controller/ctrls/contapropietarios.ctrl.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 03, 2019 8:17:09   <<<<<<< -->
