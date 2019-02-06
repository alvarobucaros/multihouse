
    <div class="container "  ng-controller="mainController" >
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
                  ng-submit="insertInfo(registro);" ng-show="AsistenteForm">

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_comiteId">{{form_asistente_comiteId}}</label>
                    <div class="col-md-6">
                    <select id='asistente_comiteId' name='asistente_comiteId' ng-model='registro.asistente_comite' >
                     <option value='0'>{{titSelComi}}</option>   
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.comite_id}}">{{operator0.comite_nombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_usuarioId">{{form_asistente_usuarioId}}</label>
                    <div class="col-md-6">
                    <select id='asistente_usuarioId' name='asistente_usuarioId' ng-model='registro.asistente_usuarioId'
                             ng-change="changeUser()">
                         <option value='0'>{{titSelUsu}}</option>                          
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.usuario_id}}">{{operator1.usuario_nombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_nombre">{{form_asistente_nombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_nombre" name="asistente_nombre"
                         ng-model="registro.asistente_nombre" required Placeholder="{{form_Phasistente_nombre}}" 
                         value="{{registro.asistente_nombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_empresa">{{form_asistente_empresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_empresa" name="asistente_empresa"
                         ng-model="registro.asistente_empresa" required Placeholder="{{form_Phasistente_empresa}}" 
                         value="{{registro.asistente_empresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_cargo">{{form_asistente_cargo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_cargo" name="asistente_cargo"
                         ng-model="registro.asistente_cargo" required Placeholder="{{form_Phasistente_cargo}}" 
                         value="{{registro.asistente_cargo}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                     <label class="control-label milabel col-md-4" for="asistente_titulo">{{form_asistente_titulo}}</label>
                     <div class="btn-group  col-md-8"  data-toggle="buttons">
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registro.asistente_titulo" 
                               class="btn media-bottom" value="P" >{{form_tituloP}}
                    </label>
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registro.asistente_titulo" 
                               class="btn media-bottom" value="S" >{{form_tituloS}}
                    </label>
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-model="registro.asistente_titulo"  
                               class="btn media-bottom" value="T" >{{form_tituloT}}
                    </label>
                    <label>
                       <input type="radio" name ="asistente_titulo" ng-checked="true" ng-model="registro.asistente_titulo" 
                               class="btn media-bottom" value=" " >{{form_tituloN}}
                    </label>                        
                     </div>
                 </div>      

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_celuar">{{form_asistente_celuar}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_celuar" name="asistente_celuar"
                         ng-model="registro.asistente_celuar" required Placeholder="{{form_Phasistente_celuar}}" 
                         value="{{registro.asistente_celuar}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="asistente_email">{{form_asistente_email}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="asistente_email" name="asistente_email"
                         ng-model="registro.asistente_email" required Placeholder="{{form_Phasistente_email}}" 
                         value="{{registro.asistente_email}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="actualizabtn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="cierrabtn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text" ng-model="registro.asistente_id" id ='asistente_id'  name ='asistente_id' value="{{registro.asistente_id}}"/>

   
                </div>
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>

                        <th>COMITE</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                        <th>EMPRESA</th>
                        <th>CARGO</th>
                        <th>TITULO</th>
                        <th>CELULAR</th>
                        <th>E_MAIL</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details| filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
	
                    <td>{{detail.comite_nombre}}</td> 
                    <td>{{detail.usuario_nombre}}</td>
                    <td>{{detail.asistente_nombre}}</td>
                    <td>{{detail.asistente_empresa}}</td>
                    <td>{{detail.asistente_cargo}}</td>
                    <td>{{detail.asistente_titulo}}</td>
                    <td>{{detail.asistente_celuar}}</td>
                    <td>{{detail.asistente_email}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    <td style="display: none">{{detail.asistente_id}}</td>
                    <td style="display: none">{{detail.asistente_comite}}</td>
                    <td style="display: none">{{detail.asistente_usuarioId}}</td>
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
<script src="js/angular-resources.js" type="text/javascript"></script>
<script src="controller/mm_asistentes.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Oct 27, 2017 7:40:45   <<<<<<< -->
