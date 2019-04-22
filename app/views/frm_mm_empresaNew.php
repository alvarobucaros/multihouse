
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
                    <label class="control-label milabel col-md-4" for="empresa_nombre">{{form_empresa_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_nombre" name="empresa_nombre"
                         ng-model="registro.empresa_nombre" required Placeholder="{{form_Phempresa_nombre}}" 
                         value="{{registro.empresa_nombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_nit">{{form_empresa_nit}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_nit" name="empresa_nit"
                         ng-model="registro.empresa_nit" required Placeholder="{{form_Phempresa_nit}}" 
                         value="{{registro.empresa_nit}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_web">{{form_empresa_web}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_web" name="empresa_web"
                         ng-model="registro.empresa_web" required Placeholder="{{form_Phempresa_web}}" 
                         value="{{registro.empresa_web}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_direccion">{{form_empresa_direccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_direccion" name="empresa_direccion"
                         ng-model="registro.empresa_direccion" required Placeholder="{{form_Phempresa_direccion}}" 
                         value="{{registro.empresa_direccion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_telefonos">{{form_empresa_telefonos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_telefonos" name="empresa_telefonos"
                         ng-model="registro.empresa_telefonos" required Placeholder="{{form_Phempresa_telefonos}}" 
                         value="{{registro.empresa_telefonos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_ciudad">{{form_empresa_ciudad}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_ciudad" name="empresa_ciudad"
                         ng-model="registro.empresa_ciudad" required Placeholder="{{form_Phempresa_ciudad}}" 
                         value="{{registro.empresa_ciudad}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_logo">{{form_empresa_logo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_logo" name="empresa_logo"
                         ng-model="registro.empresa_logo" required Placeholder="{{form_Phempresa_logo}}" 
                         value="{{registro.empresa_logo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_autentica">{{form_empresa_autentica}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_autentica" name="empresa_autentica"
                         ng-model="registro.empresa_autentica" required Placeholder="{{form_Phempresa_autentica}}" 
                         value="{{registro.empresa_autentica}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_lenguaje">{{form_empresa_lenguaje}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_lenguaje" name="empresa_lenguaje"
                         ng-model="registro.empresa_lenguaje" required Placeholder="{{form_Phempresa_lenguaje}}" 
                         value="{{registro.empresa_lenguaje}}" />
                    </div>
                </div> 

                <div class="form-group" ng-show="oculto">
                    <label class="control-label milabel col-md-4" for="empresa_versionPrd">{{form_empresa_versionPrd}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_versionPrd" name="empresa_versionPrd"
                         ng-model="registro.empresa_versionPrd" required Placeholder="{{form_Phempresa_versionPrd}}" 
                         value="{{registro.empresa_versionPrd}}" />
                    </div>
                </div> 

                <div class="form-group" ng-show ="oculto">
                    <label class="control-label milabel col-md-4" for="empresa_versionBd">{{form_empresa_versionBd}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_versionBd" name="empresa_versionBd"
                         ng-model="registro.empresa_versionBd" required Placeholder="{{form_Phempresa_versionBd}}" 
                         value="{{registro.empresa_versionBd}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_clave">{{form_empresa_clave}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_clave" name="empresa_clave"
                         maxlength="6" width="10"  ng-model="registro.empresa_clave" required Placeholder="{{form_Phempresa_clave}}" 
                         value="{{registro.empresa_clave}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_email">{{form_empresa_email}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_email" name="empresa_email"
                         ng-model="registro.empresa_email" required Placeholder="{{form_Phempresa_email}}" 
                         value="{{registro.empresa_email}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_registrsoXpagina">{{form_empresa_registrsoXpagina}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_registrsoXpagina" name="empresa_registrsoXpagina"
                         ng-model="registro.empresa_registrsoXpagina" required Placeholder="{{form_Phempresa_registrsoXpagina}}" 
                         value="{{registro.empresa_registrsoXpagina}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_diasTrabaja">{{form_empresa_diasTrabaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_diasTrabaja" name="empresa_diasTrabaja"
                         ng-model="registro.empresa_diasTrabaja" required Placeholder="{{form_Phempresa_diasTrabaja}}" 
                         value="{{registro.empresa_diasTrabaja}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_horarioInicio">{{form_empresa_horarioInicio}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_horarioInicio" name="empresa_horarioInicio"
                         ng-model="registro.empresa_horarioInicio" required Placeholder="{{form_Phempresa_horarioInicio}}" 
                         value="{{registro.empresa_horarioInicio}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_horarioTermina">{{form_empresa_horarioTermina}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_horarioTermina" name="empresa_horarioTermina"
                         ng-model="registro.empresa_horarioTermina" required Placeholder="{{form_Phempresa_horarioTermina}}" 
                         value="{{registro.empresa_horarioTermina}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_intervaloCalendario">{{form_empresa_intervaloCalendario}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_intervaloCalendario" name="empresa_intervaloCalendario"
                         ng-model="registro.empresa_intervaloCalendario" required Placeholder="{{form_Phempresa_intervaloCalendario}}" 
                         value="{{registro.empresa_intervaloCalendario}}" />
                    </div>
                </div> 

                <div class="form-group"  ng-show="oculto">
                    <label class="control-label milabel col-md-4" for="empresa_FormatoActa">{{form_empresa_FormatoActa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_FormatoActa" name="empresa_FormatoActa"
                         ng-model="registro.empresa_FormatoActa" required Placeholder="{{form_Phempresa_FormatoActa}}" 
                         value="{{registro.empresa_FormatoActa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_cresidencial">{{form_empresa_cresidencial}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_cresidencial" name="empresa_cresidencial"
                         ng-model="registro.empresa_cresidencial" required Placeholder="{{form_Phempresa_cresidencial}}" 
                         value="{{registro.empresa_cresidencial}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_ctrl">{{form_empresa_ctrl}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_ctrl" name="empresa_ctrl"
                         ng-model="registro.empresa_ctrl" required Placeholder="{{form_Phempresa_ctrl}}" 
                         value="{{registro.empresa_ctrl}}" />
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
                <input type="text"	 ng-model="registro.empresa_id" id ='empresa_id'  name ='empresa_id' value="{{registro.empresa_id}}"/>

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
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>NIT</th>
                        <th>WEB</th>
                        <th>DIRECCION</th>
                        <th>TELEFONOS</th>
                        <th>CIUDAD</th>
                        <th>LOGO</th>
                        <th>AUTENTICA</th>
                        <th>LENGUAJE</th>
                        <th>VERSIONPRD</th>
                        <th>VERSIONBD</th>
                        <th>CLAVE</th>
                        <th>EMAIL</th>
                        <th>REGISTRSOXPAGINA</th>
                        <th>DIASTRABAJA</th>
                        <th>HORARIOINICIO</th>
                        <th>HORARIOTERMINA</th>
                        <th>INTERVALOCALENDARIO</th>
                        <th>FORMATOACTA</th>
                        <th>S ES UN CONJUNTO RESIDENCIAL N NO LO ES</th>
                        <th>CTRL</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.empresa_id}}</td>
                    <td>{{detail.empresa_nombre}}</td>
                    <td>{{detail.empresa_nit}}</td>
                    <td>{{detail.empresa_web}}</td>
                    <td>{{detail.empresa_direccion}}</td>
                    <td>{{detail.empresa_telefonos}}</td>
                    <td>{{detail.empresa_ciudad}}</td>
                    <td>{{detail.empresa_logo}}</td>
                    <td>{{detail.empresa_autentica}}</td>
                    <td>{{detail.empresa_lenguaje}}</td>
                    <td>{{detail.empresa_versionPrd}}</td>
                    <td>{{detail.empresa_versionBd}}</td>
                    <td>{{detail.empresa_clave}}</td>
                    <td>{{detail.empresa_email}}</td>
                    <td>{{detail.empresa_registrsoXpagina}}</td>
                    <td>{{detail.empresa_diasTrabaja}}</td>
                    <td>{{detail.empresa_horarioInicio}}</td>
                    <td>{{detail.empresa_horarioTermina}}</td>
                    <td>{{detail.empresa_intervaloCalendario}}</td>
                    <td>{{detail.empresa_FormatoActa}}</td>
                    <td>{{detail.empresa_cresidencial}}</td>
                    <td>{{detail.empresa_ctrl}}</td>
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

<script src="controller/ctrl/mm_empresaNew.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Apr 20, 2019 3:15:22   <<<<<<< -->
