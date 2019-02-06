
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <?php if($pf=='A'){
                echo '<div class="alert alert-default navbar-brand search-box">';
                echo '    <button class="btn btn-primary btn-xs" ng-show="show_form" ';
                echo '    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>';
                echo '    </div>';}
                ?>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control milabel busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query">
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_nombre">{{form_salon_nombre}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="salon_nombre" name="salon_nombre"
			ng-model="registro.salon_nombre" required Placeholder="{{form_Phsalon_nombre}}" 
                        value="{{registro.salon_nombre}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_ubicacion">{{form_salon_ubicacion}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control milabel" id="salon_ubicacion" name="salon_ubicacion"
			ng-model="registro.salon_ubicacion" required Placeholder="{{form_Phsalon_ubicacion}}" 
                        value="{{registro.salon_ubicacion}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_capacidad">{{form_salon_capacidad}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control milabel" id="salon_capacidad" name="salon_capacidad"
			ng-model="registro.salon_capacidad" required Placeholder="{{form_Phsalon_capacidad}}" 
                        value="{{registro.salon_capacidad}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_apoyovisual">{{form_salon_apoyovisual}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control milabel" id="salon_apoyovisual" name="salon_apoyovisual"
			ng-model="registro.salon_apoyovisual" required Placeholder="{{form_Phsalon_apoyovisual}}" 
                        value="{{registro.salon_apoyovisual}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_responsable">{{form_salon_responsable}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control milabel" id="salon_responsable" name="salon_responsable"
			ng-model="registro.salon_responsable" required Placeholder="{{form_Phsalon_responsable}}" 
                        value="{{registro.salon_responsable}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_activo">{{form_salon_activo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" id="salon_activo0" ng-model="registro.salon_activo" value="A" >{{form_Activo0}}
                   </label>
                   <label>
                      <input type="radio" id="salon_activo1" ng-model="registro.salon_activo" value="I" >{{form_Activo1}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="salon_observaciones">{{form_salon_observaciones}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control milabel" id="salon_observaciones" name="salon_observaciones"
			ng-model="registro.salon_observaciones" required Placeholder="{{form_Phsalon_observaciones}}" 
                        value="{{registro.salon_observaciones}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send1_btn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send2_btn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text"  ng-model="registro.salon_id" id ='salon_id'  name ='salon_id' value="{{registro.salon_id}}"/>
                <input type="text"  ng-model="registro.salon_empresa" id ='salon_empresa'  value="{{registro.salon_empresa}}"/>
                <input type="text" ng-model="registro.salon_activo" id ='salon_activo'  value="{{registro.salon_activo}}"/>
  
   
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>NOMBRE</th>
                        <th>UBICACION </th>
                        <th>CAPACIDAD</th>
                        <th>APOYOS</th>
                        <th>RESPONSABLE</th>
                        <th>ACTIVO</th>
                        <th>OBSERVACIONES</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details| filter:search_query  | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.salon_nombre}}</td>
                    <td>{{detail.salon_ubicacion}}</td>
                    <td>{{detail.salon_capacidad}}</td>
                    <td>{{detail.salon_apoyovisual}}</td>
                    <td>{{detail.salon_responsable}}</td>
                    <td>{{detail.salon_activo}}</td>
                    <td>{{detail.salon_observaciones}}</td>
                    <?php if($pf=='A'){
                        echo '<td>';                       
                        echo '<button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>';
                        echo '</td><td>';
                        echo '<button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" ';
                        echo 'confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>';
                        echo '</td>';
                                 };
                     ?> 
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


<script src="controller/mm_salones.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por:   Alvaro Ortiz Wednesday,Oct 26, 2016 3:38:47   <<<<<<< -->
