
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
                        <input type="text" class="form-control mitexto busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query" required>
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="perfil_empresa">{{form_perfil_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="perfil_empresa" name="perfil_empresa"
                         ng-model="registro.perfil_empresa" required Placeholder="{{form_Phperfil_empresa}}" 
                         value="{{registro.perfil_empresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="perfil_numero">{{form_perfil_numero}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="perfil_numero" name="perfil_numero"
                         ng-model="registro.perfil_numero" required Placeholder="{{form_Phperfil_numero}}" 
                         value="{{registro.perfil_numero}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="perfil_codigo">{{form_perfil_codigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="perfil_codigo" name="perfil_codigo"
                         ng-model="registro.perfil_codigo" required Placeholder="{{form_Phperfil_codigo}}" 
                         value="{{registro.perfil_codigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="perfil_nombre">{{form_perfil_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="perfil_nombre" name="perfil_nombre"
                         ng-model="registro.perfil_nombre" required Placeholder="{{form_Phperfil_nombre}}" 
                         value="{{registro.perfil_nombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="perfil_activo">{{form_perfil_activo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="perfil_activo" ng-model="registro.perfil_activo" value="0" >{{form_Activo50}}
                   </label>
                   <label>
                      <input type="radio" name ="perfil_activo" ng-model="registro.perfil_activo" value="1" >{{form_Activo51}}
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
                <input type="text"	 ng-model="registro.perfil_id" id ='perfil_id'  name ='perfil_id' value="{{registro.perfil_id}}"/>

   
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>ID</th>
                        <th>EMPRESA</th>
                        <th>NUMERO</th>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>ACTIVO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.perfil_id}}</td>
                    <td>{{detail.perfil_empresa}}</td>
                    <td>{{detail.perfil_numero}}</td>
                    <td>{{detail.perfil_codigo}}</td>
                    <td>{{detail.perfil_nombre}}</td>
                    <td>{{detail.perfil_activo}}</td>
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

<script src="controller/mm_perfiles.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,May 17, 2018 12:00:26   <<<<<<< -->
