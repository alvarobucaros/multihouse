
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">
            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">  
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="factdefnro">{{form_factdefnro}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="factdefnro" name="factdefnro"
                         ng-model="registro.factdefnro" required Placeholder="{{form_Phfactdefnro}}" 
                         value="{{registro.factdefnro}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="factdefcliente">{{form_factdefcliente}}</label>
                    <div class="col-md-6">
                    <select id='factdefcliente' name='factdefcliente' ng-model='registro.factdefcliente' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.terceroId}}">{{operator0.terceroNombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="container1">
                    <div class="form-group">
                        <label class="control-label milabel col-md-5" for="factdeffechcrea">{{form_factdeffechcrea}}</label>
                       <div class="col-md-6">
                        <input type="date" width="16" class="form-control mitexto " id="factdeffechcrea" name="factdeffechcrea"
                             ng-model="registro.factdeffechcrea" required Placeholder="{{form_Phfactdeffechcrea}}" 
                             value="{{registro.factdeffechcrea}}"   />
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label milabel col-md-5" for="factdeffechvence">{{form_factdeffechvence}}</label>
                       <div class="col-md-6">
                        <input type="date" width="16" class="form-control mitexto " id="factdeffechvence" name="factdeffechvence"
                             ng-model="registro.factdeffechvence" required Placeholder="{{form_Phfactdeffechvence}}" 
                             value="{{registro.factdeffechvence}}"   />
                        </div>
                    </div> 
                </div>
                
                <div class="form-group  alto12">
                    <label class="control-label milabel col-md-4" for="factdefconcepto">{{form_factdefconcepto}}</label>
                    <div class="col-md-6">
                    <select id='factdefconcepto' name='factdefconcepto' ng-model='registro.factdefconcepto'
                            ng-change="selConcepto(registro)">
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.cptosid}}">{{operator1.cptosDetalle}}</option>
                    </select>
                    </div>
                </div> 
                
                <div class="form-group alto12">
                    <label class="control-label milabel col-md-4" for="factdefdetalle">{{form_factdefdetalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto" id="factdefdetalle" name="factdefdetalle"
                         ng-model="registro.factdefdetalle" rows="2" cols="150">
                         value="{{registro.factdefdetalle}}" </textarea> 
                    </div>
                </div> 
    
                <div class="form-group alto12">
                    <label class="control-label milabel col-md-4" for="factdefvalor">{{form_factdefvalor}}</label>
                   <div class="col-md-5">
                    <input type="text" width="16" class="form-control mitexto mivalor" id="factdefvalor" name="factdefvalor"
                         ng-model="registro.factdefvalor" readonly="yes" 
                         value="{{registro.factdefvalor|currency:'$' : 'symbol' : '1.0-0'}}" />
                    </div>
                </div> 

                <div class="form-group alto12">
                    <label class="control-label milabel col-md-4" for="factdefiva">{{form_factdefiva}}</label>
                   <div class="col-md-5">
                    <input type="text" class="form-control mitexto mivalor" id="factdefiva" name="factdefiva"
                           ng-model="registro.factdefiva" readonly="yes"
                         value="{{registro.factdefiva|currency:'$' : 'symbol' : '1.0-0'}}" />
                    </div>
                </div> 

                <div class="form-group alto12" >
                    <label class="control-label milabel col-md-4" for="factdefsaldo">{{form_factdefsaldo}}</label>
                   <div class="col-md-5">
                    <input type="text" width="16"  class="form-control mitexto mivalor" id="factdefsaldo" name="factdefsaldo"
                         ng-model="registro.factdefsaldo"  readonly="yes"
                         value="{{registro.factdefsaldo|currency:'$'}}" />
                    </div>
                </div> 

                <div class="form-group alto12">
                    <label class="control-label milabel col-md-4" for="factdefneto">{{form_factdefneto}}</label>
                   <div class="col-md-5">
                    <input type="text" class="form-control mitexto mivalor" id="factdefneto" name="factdefneto"
                         ng-model="registro.factdefneto" readonly="yes"
                         value="{{detail.factdefneto|currency:'$' : 'symbol' : '1.0-0'}}" />

                    </div>
                </div> 


                <div class="form-group alto12">
                    <div class="col-md-4">
                        <button type="button" value="Detalles" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="detalles(registro)" id="send_btnDet">{{form_btnDetalles}}</button>
                    </div>  
                    <div class="col-md-3">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                    </div>  

                    <div class="col-md-2">
                        <button type="button" value="Imprime" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="imprimeInfo(registro)" id="send_btnImp">{{form_btnImprime}}</button> 
                    </div>
                    <div class="col-md-2">
                        <button type="button" value="Contabiliza" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="contaInfo(registro)" id="send_btnCe">{{form_btnConta}}</button> 
                    </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" id="send_btnNull">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text" ng-model="registro.factdefid" id ='factdefid'  name ='factdefid' value="{{registro.factdefid}}"/>
                <input type="text"  id="factdefempresa" name="factdefempresa"
                         ng-model="registro.factdefempresa"  value="{{registro.factdefempresa}}" />
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
         <div id='movimiento' class="col-md-8 col-md-offset-1 alert-mm"  ng-show = "IsVisible">
           <table class="table table-hover tablex">
                <tr>
                    <th>CONCEPTO</th>
                    <th>VALOR</th>
                    <th>% IVA</th>
                    <th>VLR IVA</th>
                    <th>SUBTOTAL</th>
                </tr>
                <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td style="text-align:left;">{{detail.factdefcptodeta}}</td>
                    <td style="text-align:right;">{{detail.factdefvalor|currency:'$' : 'symbol' : '1.0-0'}}</td>  
                    <td style="text-align:right;">{{detail.factdefiva|currency:'%' : 'symbol' : '1.0-0'}}</td>
                    <td style="text-align:right;">{{detail.factdefsaldo|currency:'$' : 'symbol' : '1.0-0'}}</td>
                    <td style="text-align:right;">{{detail.factdefneto|currency:'$' : 'symbol' : '1.0-0'}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}">
                        <span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="imprimeInfo(detail)" title="{{form_btnElimina}}">
                         <span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>
            </table>
                        
            <div class="col-md-4">
                <button type="button" value="Detalles" class="btn btn-custom pull-right btn-xs" 
                         ng-click="detalles(registro)" id="send_btnDet">{{form_btnAnula}}</button>
            </div>
        </div>
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>FACTURA</th>
                        <th>CLIENTE</th>
                        <th>FECHCREA</th>
                        <th>FECHVENCE</th>
                        <th  style="text-align:right;">VALOR</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td style="text-align: center;">{{detail.factdefnro}}</td>
                    <td>{{detail.terceroNombre}}</td>  
                    <td>{{detail.factdeffechcrea}}</td>
                    <td>{{detail.factdeffechvence}}</td>
                    <td style="text-align:right;">{{detail.factdefneto|currency:'$' : 'symbol' : '1.0-0'}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}">
                        <span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="imprimeInfo(detail)" title="{{form_btnImprime}}">
                         <span class="glyphicon glyphicon-print"></span></button>
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

<script src="controller/ctrls/contafactdef.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Jul 07, 2021 7:09:26   <<<<<<< -->
