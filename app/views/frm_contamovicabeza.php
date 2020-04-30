
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <div class="col-md-8 col-md-offset-1" ng-show="ventanaSgnda">
            <div class="form-group">
                <label class="control-label milabel col-md-4" for="periodoCtble">{{form_periodo}}</label>
                <div class="col-md-3">
                <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                     ng-model="periodoCtble" value="{{periodoCtble}}" />
                </div>
                <div class="alert alert-default navbar-brand search-box">
                        <button class="btn btn-primary btn-xs" ng-show="show_form" 
                        ng-click="proceso()">{{form_btnConti}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
            </div> 
        </div>
        <div ng-show="ventanaPpal">
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
                    <label class="control-label milabel col-md-4" for="movicaEmpresaId">{{form_movicaEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="movicaEmpresaId" name="movicaEmpresaId"
                         ng-model="registro.movicaEmpresaId" required Placeholder="{{form_PhmovicaEmpresaId}}" 
                         value="{{registro.movicaEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaComprId">{{form_movicaComprId}}</label>
                    <div class="col-md-6">
                    <select id='movicaComprId' name='movicaComprId' ng-model='registro.movicaComprId' 
                            ng-change="buscaCompro(registro)">
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.compCodigo}}">{{operator0.compNombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaCompNro">{{form_movicaCompNro}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="movicaCompNro" name="movicaCompNro"
                         ng-model="registro.movicaCompNro" required Placeholder="{{form_PhmovicaCompNro}}" 
                         value="{{registro.movicaCompNro}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaTerceroId">{{form_movicaTerceroId}}</label>
                    <div class="col-md-6">
                    <select id='movicaTerceroId' name='movicaTerceroId' ng-model='registro.movicaTerceroId' >
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.terceroId}}">{{operator1.terceroNombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaDetalle">{{form_movicaDetalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto"  cols="60" rows="4" id="movicaDetalle" name="movicaDetalle"
                         ng-model="registro.movicaDetalle" required Placeholder="{{form_PhmovicaDetalle}}" 
                         value="{{registro.movicaDetalle}}">
                    </textarea>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaProcesado">{{form_movicaProcesado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="movicaProcesado" ng-model="registro.movicaProcesado" value="S" >{{form_movicaProcesado60}}
                   </label>
                   <label>
                      <input type="radio" name ="movicaProcesado" ng-model="registro.movicaProcesado" value="N" >{{form_movicaProcesado61}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaFecha">{{form_movicaFecha}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="movicaFecha" name="movicaFecha"
                         ng-model="registro.movicaFecha" required Placeholder="{{form_PhmovicaFecha}}" 
                         value="{{registro.movicaFecha}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaPeriodo">{{form_movicaPeriodo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="movicaPeriodo" name="movicaPeriodo"
                         ng-model="registro.movicaPeriodo" required Placeholder="{{form_PhmovicaPeriodo}}" 
                         value="{{registro.movicaPeriodo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaDocumPpal">{{form_movicaDocumPpal}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="movicaDocumPpal" name="movicaDocumPpal"
                         ng-model="registro.movicaDocumPpal" required Placeholder="{{form_PhmovicaDocumPpal}}" 
                         value="{{registro.movicaDocumPpal}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="movicaDocumSec">{{form_movicaDocumSec}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="movicaDocumSec" name="movicaDocumSec"
                         ng-model="registro.movicaDocumSec" required Placeholder="{{form_PhmovicaDocumSec}}" 
                         value="{{registro.movicaDocumSec}}" />
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
                <input type="text"	 ng-model="registro.movicaId" id ='movicaId'  name ='movicaId' value="{{registro.movicaId}}"/>

   
                </div>
                <div id='miExcel' style='display: none'>
                    <input type="text"  id="control" ng-model="control" value="C" />
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
                        <th>CPBNTE</th>
                        <th>NUMERO</th>
                        <th>TERCERO</th>
                        <th>DETALLE</th>
                        <th>PROCESADO</th>
                        <th>FECHA</th>
                        <th>PERIODO</th>
                        <th>DOCUM</th>
                        <th>DOCUM</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.movicaId}}</td>
                    <td>{{detail.movicaEmpresaId}}</td>
                    <td>{{detail.movicaTerceroId}}</td>
                    <td>{{detail.movicaComprId}}</td-->
                    <td>{{detail.compNombre}}</td>
                    <td>{{detail.movicaCompNro}}</td>
                    <td>{{detail.terceroNombre}}</td>
                    <td>{{detail.movicaDetalle}}</td>
                    <td>{{detail.movicaProcesado}}</td>
                    <td>{{detail.movicaFecha}}</td>
                    <td>{{detail.movicaPeriodo}}</td>
                    <td>{{detail.movicaDocumPpal}}</td>
                    <td>{{detail.movicaDocumSec}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-info btn-xs" ng-click="movimiento(detail)" 
                             title="{{form_btnMovi}}"><span class="glyphicon glyphicon-list-alt"></span></button>
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
</div>
<div id="Modal">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h4 class="modal-title">{{titulin}}</h4>
        </div>
        <div class="modal-body">
        <div class="alert alert-default navbar-brand search-box">
              <button class="btn btn-primary btn-xs" ng-show="show_formMov" 
              ng-click="formToggleMov()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
         </div>
        <div class="col-md-8 col-md-offset-1">
            <form class="form-horizontal alert alert-mm color-palette-set" name="formatoMov" id="idFormMov"
                  ng-submit="insertInfoMov(registroMov);" hidden=""> 

                <div class="form-group" style='display: none'>
                    <label class="milabel col-md-3" for="moviConCabezaId">{{form_moviConCabezaId}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConCabezaId" name="moviConCabezaId"
                         ng-model="registroMov.moviConCabezaId" 
                         value="{{registroMov.moviConCabezaId}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConCuenta">{{form_moviConCuenta}}</label>
                    <div class="col-md-6">
                    <select id='moviConCuenta' name='moviConCuenta' ng-model='registroMov.moviConCuenta' >
                     <option ng-repeat='operator2 in operators2' value = " {{operator2.pucCuenta}}">{{operator2.pucNombre}}</option>
                    </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConDebito">{{form_moviConDebito}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConDebito" name="moviConDebito"
                         ng-model="registroMov.moviConDebito" required Placeholder="{{form_PhmoviConDebito}}" 
                         value="{{registroMov.moviConDebito}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConCredito">{{form_moviConCredito}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConCredito" name="moviConCredito"
                         ng-model="registroMov.moviConCredito" required Placeholder="{{form_PhmoviConCredito}}" 
                         value="{{registroMov.moviConCredito}}" />
                    </div>
                </div>                
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConDetalle">{{form_moviConDetalle}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConDetalle" name="moviConDetalle"
                         ng-model="registroMov.moviConDetalle" required Placeholder="{{form_PhmoviConDetalle}}" 
                         value="{{registroMov.moviConDetalle}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConBase">{{form_moviConBase}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConBase" name="moviConBase"
                         ng-model="registroMov.moviConBase" required Placeholder="{{form_PhmoviConBase}}" 
                         value="{{registroMov.moviConBase}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConImpTipo">{{form_moviConImpTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMov.moviConImpTipo" value="V" >{{form_moviConImpTipo70}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMov.moviConImpTipo" value="C" >{{form_moviConImpTipo71}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMov.moviConImpTipo" value="R" >{{form_moviConImpTipo72}}
                   </label>
                   <label>
                      <input type="radio" name ="moviConImpTipo" ng-model="registroMov.moviConImpTipo" value="K" >{{form_moviConImpTipo73}}
                   </label>                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConImpPorc">{{form_moviConImpPorc}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="moviConImpPorc" name="moviConImpPorc"
                         ng-model="registroMov.moviConImpPorc" required Placeholder="{{form_PhmoviConImpPorc}}" 
                         value="{{registroMov.moviConImpPorc}}" />
                    </div>   
                   <label class="milabel col-md-2" for="moviConImpValor">{{form_moviConImpValor}}</label>
                   <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="moviConImpValor" name="moviConImpValor"
                         ng-model="registroMov.moviConImpValor" required Placeholder="{{form_PhmoviConImpValor}}" 
                         value="{{registroMov.moviConImpValor}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConIdTercero">{{form_moviConIdTercero}}</label>
                    <div class="col-md-6">
                    <select id='moviConIdTercero' name='moviConIdTercero' ng-model='registroMov.moviConIdTercero' >
                     <option ng-repeat='operator3 in operators3' value = " {{operator3.terceroId}}">{{operator3.terceroNombre}}</option>
                    </select>
                    </div>
                </div> 
                <div  style='display: none'> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviConId">{{form_moviConId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviConId" name="moviConId"
                         ng-model="registroMov.moviConId"  value="{{registroMov.moviConId}}" />
                    </div>
                    <div>
                        <input type="text"  id="controlMov" ng-model="controlMov" value="C" />
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviDocum1">{{form_moviDocum1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviDocum1" name="moviDocum1"
                         ng-model="registroMov.moviDocum1" required Placeholder="{{form_PhmoviDocum1}}" 
                         value="{{registroMov.moviDocum1}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="moviDocum2">{{form_moviDocum2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="moviDocum2" name="moviDocum2"
                         ng-model="registroMov.moviDocum2" required Placeholder="{{form_PhmoviDocum2}}" 
                         value="{{registroMov.moviDocum2}}" />
                    </div>
                </div> 
                    <div class="form-group">
                        <input type="text" class="form-control mitexto" id="moviTipoCta" name="moviTipoCta"
                        ng-model="registroMov.moviTipoCta" 
                        value="{{registroMov.moviTipoCta}}" />
                </div> 
            </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfoMov(registroMov)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfoMov()" 
                                 id="send_btnCe">{{form_btnAnula}}</button> 
                    </div>
                </div>        
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-12">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <div class="form-group"> 
                    <label class="milabel col-md-2" for="vrlDeb">{{form_vrlDeb}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlDeb" name="vrlDeb"
                             ng-model="vrlDeb" value="vrlDeb" />
                    </div>
                    <label class="milabel col-md-2" for="vrlCre">{{form_vrlCre}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlCre" name="vrlCre"
                             ng-model="vrlCre" value="vrlCre" />
                    </div>
                    <label class="milabel col-md-2" for="vrlTot">{{form_vrlTot}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlTot" name="vrlTot"
                             ng-model="vrlTot" value="vrlTot" />
                    </div>
                </div>
                <table class="table table-hover tablex" id="tabMvto">
                    <tr>
                        <!--th>ID</th>
                        <th>CABEZA</th-->
                        <th>CUENTA</th>
                        <th>NOM CTA</th>
                        <th>DEBITO</th>
                        <th>CREDITO</th>
                        <th>DETALLE</th>
                        <!--th>BASE</th-->
                        <th>TIPO IMP</th>
                        <th>IMPUESTO %</th>
                        <th>IMPUESTO VALOR</th>
                        <!--th>IDTERCERO</th>
                        <th>MOVIDOCUM1</th>
                        <th>MOVIDOCUM2</th-->
                    </tr>

                     <tr ng-repeat="detailMv in detailsMv">
  
                    <!--td>{{detailMv.moviConId}}</td>
                    <td>{{detailMv.moviConCabezaId}}</td-->                   
                    <td>{{detailMv.moviConCuenta}}</td>
                    <td>{{detailMv.pucNombre}}</td>
                    <td>{{detailMv.moviConDebito}}</td>
                    <td>{{detailMv.moviConCredito}}</td>
                    <td>{{detailMv.moviConDetalle}}</td>
                    <!--td>{{detailMv.moviConBase}}</td-->
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
                    <!--div class='btn-group'>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === 0' ng-click='currentPageMv = currentPageMv - 1'>&laquo;</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === page.no - 1' ng-click='setPageMv(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv >= detailMv.length/pageSizeMv - 1', ng-click='currentPageMv = currentPageMv + 1'>&raquo;</button>
                    </div--> 
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">Cierra formulario</button>        
        </div>
</div>
    </script> 
</div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< -->
