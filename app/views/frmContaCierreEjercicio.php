<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_cierrePeriodo}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                
                <div class="form-group">
                    <h4 style="text-align: center"> El cierre del ejercicio o cierre anual, crea dos comprobantes:</h4>
                    <h4  style="text-align: center">Uno de cierre para el año {{form_anoFiscal}} y otro de apertura para el año {{form_siguienteAnoFiscal}}</h4> 
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-4" for="periodo">{{form_periodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="periodo" name="periodo" readonly="yes"
                           ng-model="periodo" />
                    </div>
                </div>                 
                <div class="form-group">
                    <label class="milabel col-md-4" for="compCierre">{{form_compCierre}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="compCierre" name="compCierre"
                           ng-model="compCierre" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-4" for="compAper">{{form_compAper}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="compAper" name="compAper"
                           ng-model="compAper"  />
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-4" for="ctaCierre">{{form_ctaCierre}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="ctaCierre" name="v"
                           ng-model="ctaCierre"  />
                    </div>
                </div>                 
                <div class="form-group" ng-hide="noVerBoton">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="cierreEjercicio()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group">
                    <div ng-hide="ruedita">
                        <img src="img/progress.gif" alt=""/>
                    </div>
                    <h4 style="text-align: center">  {{error}}</h4>                
                </div>
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="CEJ" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>




