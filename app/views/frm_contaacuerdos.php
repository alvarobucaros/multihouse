
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

   

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="acuerdoempresa">{{form_acuerdoempresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdoempresa" name="acuerdoempresa"
                         ng-model="registro.acuerdoempresa" required Placeholder="{{form_Phacuerdoempresa}}" 
                         value="{{registro.acuerdoempresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdoinmueble">{{form_acuerdoinmueble}}</label>
                    <div class="col-md-6">
                    <select id='acuerdoinmueble' name='acuerdoinmueble' ng-model='registro.acuerdoinmueble' 
                             ng-change="buscaacuer2(registro)">
                     <option ng-repeat='operator0 in operators0' 
                             value = " {{operator0.inmuebleId}}">{{operator0.inmuebleCodigo}}</option>
                    </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdopropietario">{{form_acuerdopropietario}}</label>
                    <div class="col-md-6">
                    <select id='acuerdopropietario' name='acuerdopropietario' ng-model='registro.acuerdopropietario' 
                             ng-change="buscaacuer2(registro)">
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                    </div>
                </div>                 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdomora">{{form_acuerdomora}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdomora" name="acuerdomora"
                           ng-model="registro.acuerdomora"  value="{{registro.acuerdomora}}" readonly="yes" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdocorriente">{{form_acuerdocorriente}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdocorriente" name="acuerdocorriente"
                         ng-model="registro.acuerdocorriente"  value="{{registro.acuerdocorriente}}" readonly="yes" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdofecha">{{form_acuerdofecha}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="acuerdofecha" name="acuerdofecha"
                         ng-model="registro.acuerdofecha" required Placeholder="{{form_Phacuerdofecha}}" 
                         value="{{registro.acuerdofecha}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdovalor">{{form_acuerdovalor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdovalor" name="acuerdovalor"
                         ng-model="registro.acuerdovalor" required Placeholder="{{form_Phacuerdovalor}}" 
                         value="{{registro.acuerdovalor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdodescmora">{{form_acuerdodescmora}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdodescmora" name="acuerdodescmora"
                         ng-model="registro.acuerdodescmora" required Placeholder="{{form_Phacuerdodescmora}}" 
                         value="{{registro.acuerdodescmora}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdoplazo">{{form_acuerdoplazo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="acuerdoplazo" name="acuerdoplazo"
                         ng-model="registro.acuerdoplazo" required Placeholder="{{form_Phacuerdoplazo}}" 
                         value="{{registro.acuerdoplazo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="acuerdodetalle">{{form_acuerdodetalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto"  cols="60" rows="4" id="acuerdodetalle" name="acuerdodetalle"
                         ng-model="registro.acuerdodetalle" required Placeholder="{{form_Phacuerdodetalle}}" 
                         value="{{registro.acuerdodetalle}}">
                    </textarea>
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
                <input type="text"	 ng-model="registro.acuerdoid" id ='acuerdoid'  name ='acuerdoid' value="{{registro.acuerdoid}}"/>

   
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
                        <th>INMUEBLE</th>
                        <th>FECHA</th>
                        <th>VALOR</th>
                        <th>PLAZO</th>
                        <th>DETALLE</th>
                        <th>PROPIETARIO</th>
                        <th>MORA</th>
                        <th>CORRIENTE</th>
                        <th>DESCMORA</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.acuerdoid}}</td>
                    <td>{{detail.acuerdoempresa}}</td> 
                    <td>{{detail.acuerdoinmueble}}</td-->
                    <td>{{detail.inmuebleCodigo}}</td>
                    <td>{{detail.acuerdofecha}}</td>
                    <td>{{detail.acuerdovalor}}</td>
                    <td>{{detail.acuerdoplazo}}</td>
                    <td>{{detail.acuerdodetalle}}</td>
                    <td>{{detail.acuerdopropietario}}</td>
                    <td>{{detail.acuerdomora}}</td>
                    <td>{{detail.acuerdocorriente}}</td>
                    <td>{{detail.acuerdodescmora}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" 
                            title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="vistaPrevia(detail)" 
                            title="{{form_btnImprime}}"><span class="glyphicon glyphicon-print"></span></button>
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

<script src="controller/ctrls/contaacuerdos.ctrl.js" type="text/javascript"></script>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Dec 09, 2019 7:55:59   <<<<<<< -->
