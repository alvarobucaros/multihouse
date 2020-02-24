
    <div class="container "  ng-controller="mainController">
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggleMv()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>

                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfoMv(registroMv);" hidden=""> 

                <div class="form-group" style='display: none'>
                    <label class="milabel col-md-3" for="moviConCabezaId">{{form_moviConCabezaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConCabezaId" name="moviConCabezaId"
                         ng-model="registroMv.moviConCabezaId" required Placeholder="{{form_PhmoviConCabezaId}}" 
                         value="{{registroMv.moviConCabezaId}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConCuenta">{{form_moviConCuenta}}</label>
                    <div class="col-md-6">
                    <select id='moviConCuenta' name='moviConCuenta' ng-model='registroMv.moviConCuenta' >
                     <option ng-repeat='operator2 in operators2' value = " {{operator2.pucCuenta}}">{{operator2.pucNombre}}</option>
                    </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConDebito">{{form_moviConDebito}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConDebito" name="moviConDebito"
                         ng-model="registroMv.moviConDebito" required Placeholder="{{form_PhmoviConDebito}}" 
                         value="{{registroMv.moviConDebito}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConCredito">{{form_moviConCredito}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConCredito" name="moviConCredito"
                         ng-model="registroMv.moviConCredito" required Placeholder="{{form_PhmoviConCredito}}" 
                         value="{{registroMv.moviConCredito}}" />
                    </div>
                </div>                
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConDetalle">{{form_moviConDetalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConDetalle" name="moviConDetalle"
                         ng-model="registroMv.moviConDetalle" required Placeholder="{{form_PhmoviConDetalle}}" 
                         value="{{registroMv.moviConDetalle}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConBase">{{form_moviConBase}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConBase" name="moviConBase"
                         ng-model="registroMv.moviConBase" required Placeholder="{{form_PhmoviConBase}}" 
                         value="{{registroMv.moviConBase}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConImpTipo">{{form_moviConImpTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMv.moviConImpTipo" value="V" >{{form_moviConImpTipo70}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMv.moviConImpTipo" value="C" >{{form_moviConImpTipo71}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMv.moviConImpTipo" value="R" >{{form_moviConImpTipo72}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMv.moviConImpTipo" value="K" >{{form_moviConImpTipo73}}
                   </label>                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConImpPorc">{{form_moviConImpPorc}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="moviConImpPorc" name="moviConImpPorc"
                         ng-model="registroMv.moviConImpPorc" required Placeholder="{{form_PhmoviConImpPorc}}" 
                         value="{{registroMv.moviConImpPorc}}" />
                    </div>   
                   <label class="milabel col-md-2" for="moviConImpValor">{{form_moviConImpValor}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="moviConImpValor" name="moviConImpValor"
                         ng-model="registroMv.moviConImpValor" required Placeholder="{{form_PhmoviConImpValor}}" 
                         value="{{registroMv.moviConImpValor}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConIdTercero">{{form_moviConIdTercero}}</label>
                    <div class="col-md-6">
                    <select id='moviConIdTercero' name='moviConIdTercero' ng-model='registroMv.moviConIdTercero' >
                     <option ng-repeat='operator3 in operators3' value = " {{operator3.terceroId}}">{{operator3.terceroNombre}}</option>
                    </select>
                    </div>
                </div> 
<div  style='display: none'>
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviDocum1">{{form_moviDocum1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviDocum1" name="moviDocum1"
                         ng-model="registroMv.moviDocum1" required Placeholder="{{form_PhmoviDocum1}}" 
                         value="{{registroMv.moviDocum1}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviDocum2">{{form_moviDocum2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviDocum2" name="moviDocum2"
                         ng-model="registroMv.moviDocum2" required Placeholder="{{form_PhmoviDocum2}}" 
                         value="{{registroMv.moviDocum2}}" />
                    </div>
                </div> 
</div>
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoMv(registroMv)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoMv(registroMv)" id="send_btnCe">{{form_btnAnula}}</button> 
                    </div>
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
                        <th>CABEZA</th-->
                        
                        <th>CUENTA</th>
                        <th>VALOR DEBITO</th>
                        <th>VALOR CREDITO</th>
                        <th>DETALLE</th>
                        <th>BASE</th>
                        <th>TIPO IMP</th>
                        <th>IMPUESTO %</th>
                        <th>IMPUESTO VALOR</th>
                        <!--th>IDTERCERO</th>
                        <th>MOVIDOCUM1</th>
                        <th>MOVIDOCUM2</th-->
                    </tr>
                   
                    <tr ng-repeat="detailMv in detailsMv | filter:search_query | startFromGrid: currentPageMv * pageSizeMv | limitTo: pageSizeMv">
                    <!--td>{{detailMv.moviConId}}</td>
                    <td>{{detailMv.moviConCabezaId}}</td-->
                   
                    <td>{{detailMv.moviConCuenta}}</td>
                    <td>{{detailMv.moviConDebito}}</td>
                    <td>{{detailMv.moviConCredito}}</td>
                    <td>{{detailMv.moviConDetalle}}</td>
                    <td>{{detailMv.moviConBase}}</td>
                    <td>{{detailMv.moviConImpTipo}}</td>
                    <td>{{detailMv.moviConImpPorc}}</td>
                    <td>{{detailMv.moviConImpValor}}</td>
                    <!--td>{{detailMv.moviConIdTercero}}</td>
                    <td>{{detailMv.moviDocum1}}</td>
                    <td>{{detailMv.moviDocum2}}</td-->
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfoMv(detailMv)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfoMv(detailMv)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                </table>
                    <div class='btn-group'>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === 0' ng-click='currentPageMv = currentPageMv - 1'>&laquo;</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv >= detailMvs.length/pageSizeMv - 1', ng-click='currentPageMv = currentPageMv + 1'>&raquo;</button>
                    </div> 
            </div>
        </div>
</div>
<script src="controller/ctrls/contamovidetalle.ctrl.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 10:35:06   <<<<<<< -->
