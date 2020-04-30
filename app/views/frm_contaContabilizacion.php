    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_contabiliza}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                 ng-submit="insertInfo(registro);" >

                <div class="form-group">
                   <label class="milabel col-md-8" for="fechaHasta">{{nota}}</label>

                </div>
                <div class="form-group">
                   <label class="milabel col-md-3" for="fechaCorte">{{form_fechaCorte}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaCorte" name="fechaCorte"
                         ng-model="fechaCorte"  />
                    </div>
                </div>
                <div class="form-group" ng-show="boton">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                            ng-click="contabilizar()" id="inprimir">{{form_btnContinua}}</button>
                        </div>  

                    </div>
                </div> 
                    <div id="divRuedita" ng-show="ruedita">
                        <img src="img/progress.gif" alt=""/>                   
                    </div>
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control" value="CN" />
                    <input type="text"  id="valUltiperfac" ng-model="valUltiperfac" value="" />
                    <input type="text"  id="valPreriFact" ng-model="valPreriFact" value="" />
                </div> 
                
            </form>
	</div>
 
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>
