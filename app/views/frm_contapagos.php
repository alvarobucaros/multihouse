
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

   

                <div class="form-group" ng-show="xa">
                    <label class="control-label milabel col-md-4" for="pagosempresa">{{form_pagosempresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosempresa" name="pagosempresa"
                         ng-model="registro.pagosempresa" required Placeholder="{{form_Phpagosempresa}}" 
                         value="{{registro.pagosempresa}}" />
                    </div>
                </div> 

                <div class="form-group" ng-show="xa">
                    <label class="control-label milabel col-md-4" for="pagosfacturaid">{{form_pagosfacturaid}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosfacturaid" name="pagosfacturaid"
                         ng-model="registro.pagosfacturaid" required Placeholder="{{form_Phpagosfacturaid}}" 
                         value="{{registro.pagosfacturaid}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosfecha">{{form_pagosfecha}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="pagosfecha" name="pagosfecha"
                         ng-model="registro.pagosfecha" required Placeholder="{{form_Phpagosfecha}}" 
                         value="{{registro.pagosfecha}}"   />
                    </div>
                </div> 

                <div class="form-group" ng-show="xa">
                    <label class="control-label milabel col-md-4" for="pagostipo">{{form_pagostipo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagostipo" name="pagostipo"
                         ng-model="registro.pagostipo" required Placeholder="{{form_Phpagostipo}}" 
                         value="{{registro.pagostipo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosvalor">{{form_pagosvalor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosvalor" name="pagosvalor"
                         ng-model="registro.pagosvalor" required Placeholder="{{form_Phpagosvalor}}" 
                         value="{{registro.pagosvalor}}" />
                    </div>
                </div> 


                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosNrReciCaja">{{form_pagosNrReciCaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosNrReciCaja" name="pagosNrReciCaja"
                         ng-model="registro.pagosNrReciCaja" required Placeholder="{{form_PhpagosNrReciCaja}}" 
                         value="{{registro.pagosNrReciCaja}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosinmueble">{{form_pagosinmueble}}</label>
                    <div class="col-md-6">
                    <select id='pagosinmueble' name='pagosinmueble' ng-model='registro.pagosinmueble' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosTipoPago">{{form_pagosTipoPago}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="pagosTipoPago" ng-checked="formaPago()" ng-model="registro.pagosTipoPago" value="E" >{{form_pagosTipoPago90}}
                   </label>
                   <label>
                      <input type="radio" name ="pagosTipoPago" ng-checked="formaPago()" ng-model="registro.pagosTipoPago" value="T" >{{form_pagosTipoPago91}}
                   </label>
                   <label>
                      <input type="radio" name ="pagosTipoPago" ng-checked="formaPago()" ng-model="registro.pagosTipoPago" value="C" >{{form_pagosTipoPago92}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosreferencia">{{form_pagosreferencia}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosreferencia" name="pagosreferencia"
                         ng-model="registro.pagosreferencia" required Placeholder="{{form_Phpagosreferencia}}" 
                         value="{{registro.pagosreferencia}}" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="pagosPeriodoPago">{{form_pagosPeriodoPago}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="pagosPeriodoPago" name="pagosPeriodoPago"
                         ng-model="registro.pagosPeriodoPago" required Placeholder="{{form_PhpagosPeriodoPago}}" 
                         value="{{registro.pagosPeriodoPago}}" />
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
                <input type="text" ng-model="registro.pagosid" id ='pagosid'  name ='pagosid' value="{{registro.pagosid}}"/>
                    <input type="text"  id="periodo" ng-model="periodo" value="R" />
                    <input type="text"  id="fchPago" ng-model="fchPago" value="01/01/2000" />
                    <input type="text"  id="consecRC" ng-model="consecRC" value="0" />
   
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
                        <th>FACTURAID</th-->
                        <th>INMUEBLE</th>
                        <th>FECHA</th>
                        <!--th>TIPO</th-->
                        <th>VALOR</th>
                        <th>REFERENCIA</th>
                        <th>RECIBO CAJA</th>
                        
                        <th>FORMA PAGO</th>
                        <th>PERIODO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.pagosid}}</td>
                    <td>{{detail.pagosempresa}}</td>
                    <td>{{detail.pagosfacturaid}}</td-->
                    <td>{{detail.pagosinmueble}}</td>
                    <td>{{detail.pagosfecha}}</td>
                    <!--td>{{detail.pagostipo}}</td-->
                    <td>{{detail.pagosvalor}}</td>
                    <td>{{detail.pagosreferencia}}</td>
                    <td>{{detail.pagosNrReciCaja}}</td>
                    
                    <td>{{detail.pagosTipoPago}}</td>
                    <td>{{detail.pagosPeriodoPago}}</td>
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
<script src="controller/ctrls/contapagos.ctrl.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Nov 22, 2019 7:28:35   <<<<<<< -->
