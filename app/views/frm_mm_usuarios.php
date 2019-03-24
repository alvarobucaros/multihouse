
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                  <?php if($pf=='A'){
                      echo '
                  
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
                  ';}
                  ?>
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
                    <label class="control-label milabel col-md-4" for="usuario_nombre">{{form_usuario_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_nombre" name="usuario_nombre"
                         ng-model="registro.usuario_nombre" required Placeholder="{{form_Phusuario_nombre}}" 
                         value="{{registro.usuario_nombre}}" ng-change="cambiaNombre" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_empresa">{{form_usuario_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_empresa" name="usuario_empresa"
                         ng-model="registro.usuario_empresa" required Placeholder="{{form_Phusuario_empresa}}" 
                         value="{{registro.usuario_empresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_email">{{form_usuario_email}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_email" name="usuario_email"
                         ng-model="registro.usuario_email" required Placeholder="{{form_Phusuario_email}}" 
                         value="{{registro.usuario_email}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_tipo_acceso">{{form_usuario_tipo_acceso}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="A" >{{form_Activo50}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="C" >{{form_Activo51}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="D" >{{form_Activo52}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_fechaCreado">{{form_usuario_fechaCreado}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="usuario_fechaCreado" name="usuario_fechaCreado"
                         ng-model="registro.usuario_fechaCreado" required Placeholder="{{form_Phusuario_fechaCreado}}" 
                         value="{{registro.usuario_fechaCreado}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_fechaActualizado">{{form_usuario_fechaActualizado}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="usuario_fechaActualizado" name="usuario_fechaActualizado"
                         ng-model="registro.usuario_fechaActualizado" required Placeholder="{{form_Phusuario_fechaActualizado}}" 
                         value="{{registro.usuario_fechaActualizado}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_estado">{{form_usuario_estado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="usuario_estado" ng-model="registro.usuario_estado" value="A" >{{form_Activo80}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_estado" ng-model="registro.usuario_estado" value="I" >{{form_Activo81}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_perfil">{{form_usuario_perfil}}</label>
                    <div class="col-md-6">
                    <select id='usuario_perfil' name='usuario_perfil' ng-model='registro.usuario_perfil' >
                        <option ng-selected="Null">--Elige perfil--</option>
                        <option ng-repeat='operator0 in operators0' 
                             value = " {{operator0.perfil_codigo}}">{{operator0.perfil_nombre}}</option>
                     
                    </select>
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_avatar">{{form_usuario_avatar}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_avatar" name="usuario_avatar"
                         ng-model="registro.usuario_avatar" required Placeholder="{{form_Phusuario_avatar}}" 
                         value="{{registro.usuario_avatar}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_user">{{form_usuario_user}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_user" name="usuario_user"
                         ng-model="registro.usuario_user" required Placeholder="{{form_Phusuario_user}}" 
                         value="{{registro.usuario_user}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_celular">{{form_usuario_celular}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_celular" name="usuario_celular"
                         ng-model="registro.usuario_celular" required Placeholder="{{form_Phusuario_celular}}" 
                         value="{{registro.usuario_celular}}" />
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
                    <input type="text"	 ng-model="registro.usuario_id" id ='usuario_id'  name ='usuario_id' value="{{registro.usuario_id}}"/>
                    <input type="password" class="form-control mitexto" id="usuario_password" name="usuario_password"
                        ng-model="registro.usuario_password" required Placeholder="{{form_Phusuario_password}}" 
                        value="{{registro.usuario_password}}" />
   
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
<!--                        <th>ID</th>-->
                        <th>NOMBRE</th>
<!--                        <th>EMPRESA</th>-->
                        <th>LOGIN</th>
<!--                        <th>PASSWORD</th>-->
                        <th>ACCESO</th>
                        <th>FECHA CREADO</th>
                        <th>FECHA ACTUALIZADO</th>
                        <th>ESTADO</th>
                        <th>PERFIL</th>
                        <th>AVATAR</th>
                        <th>USER</th>
                        <th>CELULAR</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details| filter:search_query  | startFromGrid: currentPage * pageSize | limitTo: pageSize">
<!--                    <td>{{detail.usuario_id}}</td>-->
                    <td>{{detail.usuario_nombre}}</td>
<!--                    <td>{{detail.usuario_empresa}}</td>-->
                    <td>{{detail.usuario_email}}</td>
<!--                    <td>{{detail.usuario_password}}</td>-->
                    <td>{{detail.usuario_tipo_acceso}}</td>
                    <td>{{detail.usuario_fechaCreado}}</td>
                    <td>{{detail.usuario_fechaActualizado}}</td>
                    <td>{{detail.usuario_estado}}</td>
                    <td>{{detail.usuario_perfil}}</td>
                    <td>{{detail.usuario_avatar}}</td>
                    <td>{{detail.usuario_user}}</td>
                    <td>{{detail.usuario_celular}}</td>
                      <?php if($pf=='A'){
                          
                    echo '
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                      ';}
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



<script src="controller/min/mm_usuarios.ctrl.min.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Oct 24, 2017 11:30:34   <<<<<<< -->
