<div>
    <div class="container"  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='cierre()'>{{form_btnCierre}}</button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='informe()'>{{form_btnInforme}}</button>
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
                    <label class="control-label milabel col-md-4" for="ingastoempresa">{{form_ingastoempresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ingastoempresa" name="ingastoempresa"
                         ng-model="registro.ingastoempresa" required Placeholder="{{form_Phingastoempresa}}" 
                         value="{{registro.ingastoempresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastoFecha">{{form_ingastoFecha}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="ingastoFecha" name="ingastoFecha"
                         ng-model="registro.ingastoFecha"  ng-blur="cambiaperi()" 
                         value="{{registro.ingastoFecha}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastoperiodo">{{form_ingastoperiodo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ingastoperiodo" name="ingastoperiodo"
                         ng-model="registro.ingastoperiodo" required Placeholder="{{form_Phingastoperiodo}}" 
                         value="{{registro.ingastoperiodo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastotipo">{{form_ingastotipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ingastotipo" ng-model="registro.ingastotipo" value="I" >{{form_ingastotipo40}}
                   </label>
                   <label>
                      <input type="radio" name ="ingastotipo" ng-model="registro.ingastotipo" value="G" >{{form_ingastotipo41}}
                   </label>
                   <label>
                      <input type="radio" name ="ingastotipo" ng-model="registro.ingastotipo" value="A" >{{form_ingastotipo42}}
                   </label>                        
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastocomprobante">{{form_ingastocomprobante}}</label>
                    <div class="col-md-6">
                    <select id='ingastocomprobante' name='ingastocomprobante' ng-model='registro.ingastocomprobante' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.compId}}">{{operator0.compNombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastodetalle">{{form_ingastodetalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto"  cols="60" rows="4" id="ingastodetalle" name="ingastodetalle"
                         ng-model="registro.ingastodetalle" required Placeholder="{{form_Phingastodetalle}}" 
                         value="{{registro.ingastodetalle}}">
                    </textarea>
                    </div>
                </div> 
   
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastoDocumento">{{form_ingastoDocumento}}</label>
                   <div class="col-md-6">
                     <input type="text" class="form-control mitexto"  id="ingastoDocumento" name="ingastoDocumento"
                         ng-model="registro.ingastoDocumento" required Placeholder="{{form_PhingastoDocumento}}" 
                         value="{{registro.ingastoDocumento}}">
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastovalor">{{form_ingastovalor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ingastovalor" name="ingastovalor"
                         ng-model="registro.ingastovalor" required Placeholder="{{form_Phingastovalor}}" 
                         value="{{registro.ingastovalor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ingastocontabiliza">{{form_ingastocontabiliza}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="ingastocontabiliza" ng-model="registro.ingastocontabiliza" value="S" >{{form_ingastocontabiliza80}}
                   </label>
                   <label>
                      <input type="radio" name ="ingastocontabiliza" ng-model="registro.ingastocontabiliza" value="N" >{{form_ingastocontabiliza81}}
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
                <input type="text"	 ng-model="registro.ingastoid" id ='ingastoid'  name ='ingastoid' value="{{registro.ingastoid}}"/>
  
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
        
<div class="col-md-12 container1">
  <div></div>
  <div ng-hide="modal" >
    <div class="modal-header">
        <h3 class="modal-title">{{titulin}}</h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
           <label class="control-label milabel col-md-7" for="peridesde">{{form_peridesde}}</label>
          <div class="col-md-5">
            <input type="text" class="form-control mitexto"  id="peridesde" name="peridesde"
                ng-model="peridesde" required 
                value="{{peridesde}}">
           </div>
       </div>           
    </div>
    <div class="modal-body">
        <div class="form-group">
           <label class="control-label milabel col-md-7" for="perihasta">{{form_perihasta}}</label>
          <div class="col-md-5">
            <input type="text" class="form-control mitexto"  id="perihasta" name="perihasta"
                ng-model="perihasta" required 
                value="{{perihasta}}">
           </div>
       </div>           
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" ng-click="ok()">Continua</button> 
        <button class="btn btn-primary" ng-click="regresa()">Regresa</button>        
    </div>
</div>
  <div></div>
</div>

	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <!--th>ID</th>
                        <th>EMPRESA</th-->
                        <th>FECHA</th>
                        <th>PERIODO</th>
                        <th>TIPO</th>
                        <th>COMPROBANTE</th>
                        <th>DETALLE</th>
                        <th>DOC</th>
                        <th>VALOR</th>
                        <th>SALDO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.ingastoid}}</td>
                    <td>{{detail.ingastoempresa}}</td-->
                    <td>{{detail.ingastoFecha}}</td>
                    <td>{{detail.ingastoperiodo}}</td>
                    <td>{{detail.ingastotipo}}</td>
                    <td>{{detail.ingastocomprobante}}</td>
                    <td>{{detail.ingastodetalle}}</td>
                    <td>{{detail.ingastoDocumento}}</td>
                    <td>{{detail.ingastovalor | currency}}</td>
                    <td>{{detail.saldo | currency}}</td>
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
    
    </div>
<script src="controller/ctrls/containgregastos.ctrl.js" type="text/javascript"></script>

<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Wednesday,Nov 27, 2019 1:57:50   <<<<<<< -->
