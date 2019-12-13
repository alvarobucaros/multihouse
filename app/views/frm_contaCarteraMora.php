<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_carteraEnMora}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="fechaCorte">{{form_fechaCorte}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaCorte" name="fechaCorte"
                         ng-model="fechaCorte"  value="{{fechaCorte}}"   />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="inmueblePrincipal">{{form_tipoReporte}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tipoReporte" ng-model="tipoReporte" value="D" >{{form_tipoReporteD}}
                   </label>
                   <label>
                       <input type="radio" name ="tipoReporte" ng-model="tipoReporte" value="R"  >{{form_tipoReporteR}}
                   </label>
                    </div>
                </div> 
          
                <div class="form-group" >
                    <div class="col-md-2">
                        <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                        ng-click="carteraEnExcel()" id="inprimir">{{form_btnExcel}}</button>
                    </div>  
                    <div class="col-md-2">
   
                        <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                        ng-click="carteraEnMora()" id="inprimir">{{form_btnAplicar}}</button>
                    </div>  
                </div>

                
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contareportes.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>