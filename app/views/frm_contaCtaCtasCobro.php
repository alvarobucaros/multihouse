<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_consultasCtaCobro}}</h3>
         
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >

                <div class="form-group">
                   <label class=" milabel col-md-4" for="Inmuebles">{{inmueble}}</label>
                   <div class="col-md-5">
                   <select id='Inmuebles' name='Inmuebles' ng-model='registro.Inmueble'>
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                   </select>
 
                   </div>
               </div>   

                <div class="form-group">
                   <label class=" milabel col-md-4" for="propietarios">{{propietario}}</label>
                   <div class="col-md-5">
                   <select id='propietarios' name='propietarios' ng-model='registro.propietario'>
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                   </div>
               </div> 

                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="consultaCtaCobro('C')" id="continua">{{form_btnContinua}}</button>
                        </div>  
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="consultaCtaCobro('I')" id="continua">{{form_btnImpreRc}}</button>
                        </div>                         
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control"
                         ng-model="control" 
                         value="A" />
                </div> 
            </form>
	</div>
          <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                       <th with="50">PERIODO</th>
                       <th with="150">INMUEBLE</th>
                       <th>DETALLE</th>
                       <th  with="50">VALOR</th>
                       <th  with="50">SALDO</th>                   
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.facturaperiodo}}</td>
                    <td>{{detail.inmuebleDescripcion}}</td>
                    <td>{{detail.facturadetalle}}</td>
                    <td  with="50" align="right">{{detail.facturasaldo.toLocaleString()}}</td>
                    <td  with="50" align="right">{{detail.saldo.toLocaleString()}}</td>
                    
                    
 <!--
 SELECT facturaid, facturaEmpresaid, facturaNumero, facturaInmuebleid, inmuebleDescripcion, ".
                 " facturaservicioid, facturaperiodo, facturasecuencia, facturavalor, facturadetalle,  ".
                 " facturafechafac, facturafechavence, facturafechacontrol, facturasaldo, facturaprioridad,  ".
                 " facturadescuento,  facturaMora, facturaNroReciboPago, facturaTipo, facturaPropietario,  ".
                 " propietarioNombre, facturaDiasMora, 0 As saldo  ".
 -->
  
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

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>