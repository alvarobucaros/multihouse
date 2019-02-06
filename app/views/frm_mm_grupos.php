
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query">
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div class="form-group">
                    <label class="control-label col-md-4" for="grupo_nombre">{{form_grupo_nombre}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="grupo_nombre" name="grupo_nombre"
			ng-model="registro.grupo_nombre" required Placeholder="{{form_Phgrupo_nombre}}" 
                        value="{{registro.grupo_nombre}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-md-4" for="grupo_detalle">{{form_grupo_detalle}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="grupo_detalle" name="grupo_detalle"
			ng-model="registro.grupo_detalle" required Placeholder="{{form_Phgrupo_detalle}}" 
                        value="{{registro.grupo_detalle}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-md-4" for="grupo_comite">{{form_grupo_comite}}</label>
                    <div class="col-md-6">
                    <select id="grupo_comite" name="grupo_comite" ng-model="grupo_comite" >
                     <option ng-repeat="operator0 in operators0" value="{{operator0.comite_id}}">{{operator0.comite_nombre}}</option>
                     
                    </select>
                    </div>
                </div> 

                 
                <div class="form-group">
                    <label class="control-label col-md-4" for="grupo_activo">{{form_grupo_activo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" id="grupo_activo0" ng-model="registro.grupo_activo" value="A" >{{form_Activo0}}
                   </label>
                   <label>
                      <input type="radio" id="grupo_activo1" ng-model="registro.grupo_activo" value="I" >{{form_Activo1}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text"  ng-model="registro.grupo_id" id ='grupo_id'  name ='grupo_id' value="{{registro.grupo_id}}"/>
                <input type="text"  ng-model="registro.grupo_empresa" id ='grupo_empresa' value="<?php echo $e ?>"/>
                <input type="text" ng-model="registro.grupo_activo" id ='grupo_activo'  value="{{registro.grupo_activo}}"/>
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DETALLE</th>
                        <th>COMITE</th>
                        <th>ACTIVO</th>
                    </tr>
                    <tr ng-repeat="detail in details| filter:search_query">
                    <td>{{detail.grupo_id}}</td>
                    <td>{{detail.grupo_nombre}}</td>
                    <td>{{detail.grupo_detalle}}</td>
                    <td>{{detail.comite_nombre}}</td>
                    <td>{{detail.grupo_activo}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                </table>
            </div>
        </div>
</div>


<script src="controller/mm_grupos.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por:   Alvaro Ortiz Friday,Oct 28, 2016 8:47:23   <<<<<<< -->
