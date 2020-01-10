<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_estadoCuenta}}</h3>
       
       <div class="col-md-10 col-md-offset-1">

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
                    <div class="form-group" >
                        <div class="col-md-2">
                            <button type="button" value="buscar" class="btn btn-custom pull-right btn-xs" 
                            ng-click="buscaSaldoInmueble()" id="buscar">{{form_btnBuscar}}</button>
                        </div> 
                    </div>
                </div> 

  
        <div class="col-md-12">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>PERIODO</th>
                        <th>DETALLE</th>
                        <th>FCH FACT</th>
                        <th>FCH VENCE</th>
                        <th>SALDO</th>
                        <th>SUB TOTAL</th>
                    </tr>
              
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.facturaperiodo}}</td>
                    <td>{{detail.facturadetalle}}</td>
                    <td>{{detail.facturafechafac}}</td>
                    <td>{{detail.facturafechavence}}</td>
                    <td>{{detail.facturasaldo}}</td>   
                    <td>{{detail.saldo}}</td>  
                    </tr>
                </table>
                <div class='btn-group'>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage === 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage === page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage >= details.length/pageSize - 1', ng-click='currentPage = currentPage + 1'>&raquo;</button>
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

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>