   <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_titleFactura}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="ultiperfac">{{ultiperfac}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ultiperfac" name="ultiperfac"
                           ng-model="valUltiperfac"  readonly="yes"
                         value="{{valUltiperfac}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="periFact">{{periFact}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="periFact" name="periFact"
                         ng-model="valPreriFact" readonly="yes" 
                         value="{{valPreriFact}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="fchCorte">{{fchCorte}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="fchCorte" name="fchCorte"
                         ng-model="valFchCorte" 
                         value="{{valFchCorte}}" />
                    </div>
                </div> 

                 <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comprobante">{{comprobante}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comprobante" name="comprobante"
                         ng-model="valComprobante" readonly="yes" 
                         value="{{valComprobante}}" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-2"  ng-show="factura">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="facturar()" id="facturar">{{form_btnfactura}}</button>
                    </div> 
                    <div class="form-group" ng-show="imprime">
                        <div class="col-md-4">
                            <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                                     ng-click="imprimirFact()" id="inprimir">{{form_btnImprimir}}</button>
                        </div>  
                        <div class="form-group" class="col-md-6">                   
                            <input type="text"  id="msg" width="100" readonly="yes"
                             ng-model="Mensaje"/>
                        </div> 
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control"
                         ng-model="control" 
                         value="F" />
                </div> 
                
            </form>
	</div>
	<div class="clearfix"  ng-show="progreso">
        <img src="img/progress.gif" alt=""/>
        
        </div>

        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>INMUEBLE</th>
                        <th>PROPIETARIO</th>
                        <th>SALDO</th>
                        <th>Ver</th>
                        <th>Imprimir</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.inmuebleDescripcion}}</td>
                    <td>{{detail.propietarioNombre}}</td>
                    <td>{{detail.saldo}}</td>
                    <!--td>{{detail.facturaInmuebleid}}</td-->
                    <td>
                    <button class="btn btn-warning btn-xs"    ng-click="open(detail)"
                            title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-default btn-xs" ng-click="printInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnImprimir}}?" title="{{form_btnImprimir}}"><span class="glyphicon glyphicon-print"></span></button>
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

<div id="Modal">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">{{titulin}}</h3>
        </div>
        <div class="modal-body">
            <table class="table table-hover tablex">
                    <tr>
                        <th>PERIODO</th>
                        <th>DETALLE</th>
                        <th>VENCIMIENTO</th>
                        <th>SALDO</th>
                    </tr>

                <tr ng-repeat="item in items">
                    <td>{{item.facturaperiodo}}</td>
                    <td>{{item.facturadetalle}}</td>
                    <td>{{item.facturafechavence}}</td>                   
                    <td align="right">{{item.facturasaldo | currency}}</td>                       
                </tr>
            
     </table>
          
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>        
        </div>
    </script>

 
</div>
<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>