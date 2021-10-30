
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
                ng-submit="insertInfo(registro);" hidden="false">

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="terceroEmpresaId">{{form_terceroEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroEmpresaId" name="terceroEmpresaId"
                         ng-model="registro.terceroEmpresaId" required Placeholder="{{form_PhterceroEmpresaId}}" 
                         value="{{registro.terceroEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroNombre">{{form_terceroNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroNombre" name="terceroNombre"
                         ng-model="registro.terceroNombre" required Placeholder="{{form_PhterceroNombre}}" 
                         value="{{registro.terceroNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="tercero_codigo">{{form_tercero_codigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="tercero_codigo" name="tercero_codigo"
                         ng-model="registro.tercero_codigo" required Placeholder="{{form_Phtercero_codigo}}" 
                         value="{{registro.tercero_codigo}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroIdenTipo">{{form_terceroIdenTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="terceroIdenTipo" ng-model="registro.terceroIdenTipo" value="N" >{{form_terceroIdenTipo30}}
                   </label>
                   <label>
                      <input type="radio" name ="terceroIdenTipo" ng-model="registro.terceroIdenTipo" value="C" >{{form_terceroIdenTipo31}}
                   </label>
                   <label>
                      <input type="radio" name ="terceroIdenTipo" ng-model="registro.terceroIdenTipo" value="X" >{{form_terceroIdenTipo32}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroIdenNumero">{{form_terceroIdenNumero}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroIdenNumero" name="terceroIdenNumero"
                         ng-model="registro.terceroIdenNumero" required Placeholder="{{form_PhterceroIdenNumero}}" 
                         value="{{registro.terceroIdenNumero}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroDireccion">{{form_terceroDireccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroDireccion" name="terceroDireccion"
                         ng-model="registro.terceroDireccion" required Placeholder="{{form_PhterceroDireccion}}" 
                         value="{{registro.terceroDireccion}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroCiudad">{{form_terceroCiudad}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroCiudad" name="terceroCiudad"
                         ng-model="registro.terceroCiudad" required Placeholder="{{form_PhterceroCiudad}}" 
                         value="{{registro.terceroCiudad}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroTelefonos">{{form_terceroTelefonos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroTelefonos" name="terceroTelefonos"
                         ng-model="registro.terceroTelefonos" required Placeholder="{{form_PhterceroTelefonos}}" 
                         value="{{registro.terceroTelefonos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroCorreo">{{form_terceroCorreo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroCorreo" name="terceroCorreo"
                         ng-model="registro.terceroCorreo" required Placeholder="{{form_PhterceroCorreo}}" 
                         value="{{registro.terceroCorreo}}" />
                    </div>
                </div> 
                <div  style='display: none'>
                        <div class="form-group">
                            <label class="control-label milabel col-md-4" for="terceroTwiter">{{form_terceroTwiter}}</label>
                           <div class="col-md-6">
                            <input type="text" class="form-control mitexto" id="terceroTwiter" name="terceroTwiter"
                                 ng-model="registro.terceroTwiter" required Placeholder="{{form_PhterceroTwiter}}" 
                                 value="{{registro.terceroTwiter}}" />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label milabel col-md-4" for="terceroFacebook">{{form_terceroFacebook}}</label>
                           <div class="col-md-6">
                            <input type="text" class="form-control mitexto" id="terceroFacebook" name="terceroFacebook"
                                 ng-model="registro.terceroFacebook" required Placeholder="{{form_PhterceroFacebook}}" 
                                 value="{{registro.terceroFacebook}}" />
                            </div>
                        </div> 
                </div>
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroComentario">{{form_terceroComentario}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="terceroComentario" name="terceroComentario"
                         ng-model="registro.terceroComentario" required Placeholder="{{form_PhterceroComentario}}" 
                         value="{{registro.terceroComentario}}" />
                    </div>
                </div> 


                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroActivo">{{form_terceroActivo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="terceroActivo" ng-model="registro.terceroActivo" value="A" >{{form_terceroActivo120}}
                   </label>
                   <label>
                      <input type="radio" name ="terceroActivo" ng-model="registro.terceroActivo" value="I" >{{form_terceroActivo121}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroRegimen">{{form_terceroRegimen}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="terceroRegimen" ng-model="registro.terceroRegimen" value="S" >{{form_terceroRegimen130}}
                   </label>
                   <label>
                      <input type="radio" name ="terceroRegimen" ng-model="registro.terceroRegimen" value="C" >{{form_terceroRegimen131}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="terceroContribuyente">{{form_terceroContribuyente}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="terceroContribuyente" ng-model="registro.terceroContribuyente" value="S" >{{form_terceroContribuyente140}}
                   </label>
                   <label>
                      <input type="radio" name ="terceroContribuyente" ng-model="registro.terceroContribuyente" value="N" >{{form_terceroContribuyente141}}
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
                <input type="text"	 ng-model="registro.terceroId" id ='terceroId'  name ='terceroId' value="{{registro.terceroId}}"/>

   
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
                        <th>NOMBRE</th>
                        <th>CODIGO</th>
                        <th>T.Doc</th>
                        <th>Nr.Doc</th>
                        <th>DIRECCION</th>
                        <th>CIUDAD</th>
                        <th>TELEFONOS</th>
                        <!--th>E-MAIL</th>
                        <th>CTA TWITER</th>
                        <th>CTA FACEBOOK</th-->
                        <th>COMENTARIOS</th>                        
                        <th>Activo</th>
                        <th>RGMEN</th>
                        <th>CONTRI BUYENTE</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.terceroId}}</td>
                    <td>{{detail.terceroEmpresaId}}</td-->
                    <td>{{detail.terceroNombre}}</td>
                    <td>{{detail.tercero_codigo}}</td>
                    <td>{{detail.terceroIdenTipo}}</td>
                    <td>{{detail.terceroIdenNumero}}</td>
                    <td>{{detail.terceroDireccion}}</td>
                    <td>{{detail.terceroCiudad}}</td>
                    
                    <td>{{detail.terceroTelefonos}}</td>
                    <!--td>{{detail.terceroCorreo}}</td>
                    <td>{{detail.terceroTwiter}}</td>
                    <td>{{detail.terceroFacebook}}</td-->
                    <td>{{detail.terceroComentario}}</td>                    
                    <td>{{detail.terceroActivo}}</td>
                    <td>{{detail.terceroRegimen}}</td>
                    <td>{{detail.terceroContribuyente}}</td>
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

<script src="controller/ctrls/contaterceros.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:47:34   <<<<<<< -->
