
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}</button>
                    <button class="btn btn-primary btn-xs"
                    ng-click="exporta()">{{form_btnEdita}}</button>
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
                    <label class="control-label milabel col-md-4" for="inmueble_codigo">{{form_inmueble_codigo}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="inmueble_codigo" name="inmueble_codigo"
                         ng-model="registro.inmueble_codigo" required Placeholder="{{form_Phinmueble_codigo}}" 
                         value="{{registro.inmueble_codigo}}"  />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_descripcion">{{form_inmueble_descripcion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_descripcion" name="inmueble_descripcion"
                         ng-model="registro.inmueble_descripcion" required Placeholder="{{form_Phinmueble_descripcion}}" 
                         value="{{registro.inmueble_descripcion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_area">{{form_inmueble_area}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="inmueble_area" name="inmueble_area"
                         ng-model="registro.inmueble_area" required Placeholder="{{form_Phinmueble_area}}" 
                         value="{{registro.inmueble_area}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_coeficiente">{{form_inmueble_coeficiente}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="inmueble_coeficiente" name="inmueble_coeficiente"
                         ng-model="registro.inmueble_coeficiente" required Placeholder="{{form_Phinmueble_coeficiente}}" 
                         value="{{registro.inmueble_coeficiente}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_ubicacion">{{form_inmueble_ubicacion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_ubicacion" name="inmueble_ubicacion"
                         ng-model="registro.inmueble_ubicacion" required Placeholder="{{form_Phinmueble_ubicacion}}" 
                         value="{{registro.inmueble_ubicacion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_propNombre">{{form_inmueble_propNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_propNombre" name="inmueble_propNombre"
                         ng-model="registro.inmueble_propNombre" required Placeholder="{{form_Phinmueble_propNombre}}" 
                         value="{{registro.inmueble_propNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_propCedula">{{form_inmueble_propCedula}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_propCedula" name="inmueble_propCedula"
                         ng-model="registro.inmueble_propCedula" required Placeholder="{{form_Phinmueble_propCedula}}" 
                         value="{{registro.inmueble_propCedula}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_propTelefonos">{{form_inmueble_propTelefonos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_propTelefonos" name="inmueble_propTelefonos"
                         ng-model="registro.inmueble_propTelefonos" required Placeholder="{{form_Phinmueble_propTelefonos}}" 
                         value="{{registro.inmueble_propTelefonos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_propDireccion">{{form_inmueble_propDireccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_propDireccion" name="inmueble_propDireccion"
                         ng-model="registro.inmueble_propDireccion" required Placeholder="{{form_Phinmueble_propDireccion}}" 
                         value="{{registro.inmueble_propDireccion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_propCorreo">{{form_inmueble_propCorreo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="inmueble_propCorreo" name="inmueble_propCorreo"
                         ng-model="registro.inmueble_propCorreo" required Placeholder="{{form_Phinmueble_propCorreo}}" 
                         value="{{registro.inmueble_propCorreo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_Activo">{{form_inmueble_Activo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="chkbox">
                   <label>
                      <input type="radio" id="inmueble_Activo0" ng-model="registro.inmueble_Activo" value="A" >{{form_Activo0}}
                   </label>
                   <label>
                      <input type="radio" id="inmueble_Activo1"  ng-model="registro.inmueble_Activo" value="I" >{{form_Activo1}}
                   </label>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueble_comite">{{form_inmueble_comite}}</label>
                    <div class="col-md-2">
                    <select id='inmueble_comite' name='inmueble_comite' ng-model='registro.inmueble_comite'   
                            ng-change="updateComite()">
                     <option ng-repeat='operator1 in operators1' value = " {{operator.comite_id}}">{{operator.comite_nombre}}</option>
                    </select>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnA">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btnC">{{form_btnAnula}}</button> 
                    </div>
                </div> 

                <div style='display: none'>
                <input type="text" ng-model="registro.inmueble_id" id ='inmueble_id'  name ='inmueble_id' value="{{registro.inmueble_id}}"/>
                <input type="text" ng-model="registro.inmueble_empresa"  id="inmueble_empresa" name="inmueble_empresa"
                         value="{{registro.inmueble_empresa}}" />
   
                </div>
                 <div id="miExcel" style='display: none'>
                </div>  
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
 
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>AREA</th>
                        <th>COEFICIENTE</th>
                        <th>UBICACION</th>
                        <th>NOMBRE</th>
                        <th>CEDULA</th>
                        <th>TELEFONOS</th>
<!--                        <th>DIRECCION</th>
                        <th>E-MAIL</th>-->
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat ="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">

                    <td>{{detail.inmueble_codigo}}</td>
                    <td>{{detail.inmueble_descripcion}}</td>
                    <td>{{detail.inmueble_area}}</td>
                    <td>{{detail.inmueble_coeficiente}}</td>
                    <td>{{detail.inmueble_ubicacion}}</td>
                    <td>{{detail.inmueble_propNombre}}</td>
                    <td>{{detail.inmueble_propCedula}}</td>
                    <td>{{detail.inmueble_propTelefonos}}</td>
<!--                    <td>{{detail.inmueble_propDireccion}}</td>
                    <td>{{detail.inmueble_propCorreo}}</td>-->
                    <td>{{detail.inmueble_Activo}}</td>
                
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                    
                </table>
                <!-- Navegar hacia atrás -->
                    <button type='button' ng-disabled='currentPage == 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
                    <!-- Navegar a una página especifica-->
                    <button type='button' ng-disabled='currentPage == page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                    <!-- Navegar hacia adelante -->
                     <button type='button' ng-disabled='currentPage >= details.length/pageSize - 1' ng-click='currentPage = currentPage + 1'>&raquo;</button>
            </div>
        </div> 
</div>

<script src="controller/min/mm_inmuebles.ctrl.min.js" type="text/javascript"></script>


<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,May 09, 2018 5:51:23   <<<<<<< -->
