
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
                    <label class="control-label milabel col-md-4" for="usuario_nombre">{{form_usuario_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_nombre" name="usuario_nombre"
                         ng-model="registro.usuario_nombre" required Placeholder="{{form_Phusuario_nombre}}" 
                         value="{{registro.usuario_nombre}}" />
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
                    <label class="control-label milabel col-md-4" for="usuario_celular">{{form_usuario_celular}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_celular" name="usuario_celular"
                         ng-model="registro.usuario_celular" required Placeholder="{{form_Phusuario_celular}}" 
                         value="{{registro.usuario_celular}}" />
                    </div>
                </div> 



                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_tipo_acceso">{{form_usuario_tipo_acceso}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="S" >{{form_usuario_tipo_acceso60}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="A" >{{form_usuario_tipo_acceso61}}
                   </label>
                    <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="K" >{{form_usuario_tipo_acceso63}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipo_acceso" ng-model="registro.usuario_tipo_acceso" value="C" >{{form_usuario_tipo_acceso62}}
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
                    <label class="control-label milabel col-md-4" for="usuario_avatar">{{form_usuario_avatar}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_avatar" name="usuario_avatar"
                         ng-model="registro.usuario_avatar" required Placeholder="{{form_Phusuario_avatar}}" 
                         value="{{registro.usuario_avatar}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_estado">{{form_usuario_estado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="usuario_estado" ng-model="registro.usuario_estado" value="A" >{{form_usuario_estado110}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_estado" ng-model="registro.usuario_estado" value="I" >{{form_usuario_estado111}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_tipodoc">{{form_usuario_tipodoc}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="usuario_tipodoc" ng-model="registro.usuario_tipodoc" value="C" >{{form_usuario_tipodoc120}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipodoc" ng-model="registro.usuario_tipodoc" value="E" >{{form_usuario_tipodoc121}}
                   </label>
                   <label>
                      <input type="radio" name ="usuario_tipodoc" ng-model="registro.usuario_tipodoc" value="O" >{{form_usuario_tipodoc122}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_nrodoc">{{form_usuario_nrodoc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_nrodoc" name="usuario_nrodoc"
                         ng-model="registro.usuario_nrodoc" required Placeholder="{{form_Phusuario_nrodoc}}" 
                         value="{{registro.usuario_nrodoc}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_direccion">{{form_usuario_direccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_direccion" name="usuario_direccion"
                         ng-model="registro.usuario_direccion" required Placeholder="{{form_Phusuario_direccion}}" 
                         value="{{registro.usuario_direccion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_ciudad">{{form_usuario_ciudad}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_ciudad" name="usuario_ciudad"
                         ng-model="registro.usuario_ciudad" required Placeholder="{{form_Phusuario_ciudad}}" 
                         value="{{registro.usuario_ciudad}}" />
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
                <input type="text ng-model="registro.usuario_id" id ='usuario_id'  name ='usuario_id' value="{{registro.usuario_id}}"/>
               <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_empresa">{{form_usuario_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_empresa" name="usuario_empresa"
                         ng-model="registro.usuario_empresa" required Placeholder="{{form_Phusuario_empresa}}" 
                         value="{{registro.usuario_empresa}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_password">{{form_usuario_password}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_password" name="usuario_password"
                         ng-model="registro.usuario_password" required Placeholder="{{form_Phusuario_password}}" 
                         value="{{registro.usuario_password}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario_perfil">{{form_usuario_perfil}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario_perfil" name="usuario_perfil"
                         ng-model="registro.usuario_perfil" required Placeholder="{{form_Phusuario_perfil}}" 
                         value="{{registro.usuario_perfil}}" />
                    </div>
                </div>                 
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
                        <th>EMPRESA</th>
                         <th>PERFIL</th>
                        <th>PASSWORD</th-->
                        <th>NOMBRE</th>
                        <th>LOGIN</th>
                        <th>CELULAR</th>                    
                        <th>ACCESO</th>
                        <th>FCH CREADO</th>
                        <th>FCH VALIDO</th>                       
                        <th>AVATAR</th>
                        <th>ESTADO</th>
                        <th>TIPODOC</th>
                        <th>NRODOC</th>
                        <th>DIRECCION</th>
                        <th>CIUDAD</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.usuario_id}}</td>
                    <td>{{detail.usuario_empresa}}</td>
                     <td>{{detail.usuario_perfil}}</td>
                    <td>{{detail.usuario_password}}</td-->
                    <td>{{detail.usuario_nombre}}</td>
                    <td>{{detail.usuario_email}}</td>
                    <td>{{detail.usuario_celular}}</td>                    
                    <td>{{detail.usuario_tipo_acceso}}</td>
                    <td>{{detail.usuario_fechaCreado}}</td>
                    <td>{{detail.usuario_fechaActualizado}}</td>                   
                    <td>{{detail.usuario_avatar}}</td>
                    <td>{{detail.usuario_estado}}</td>
                    <td>{{detail.usuario_tipodoc}}</td>
                    <td>{{detail.usuario_nrodoc}}</td>
                    <td>{{detail.usuario_direccion}}</td>
                    <td>{{detail.usuario_ciudad}}</td>
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

<script src="controller/ctrls/mm_usuarios.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Dec 17, 2019 7:59:58   <<<<<<< -->
