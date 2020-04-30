<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_cierreMensual}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                
                <div class="form-group">
                    <h4 style="text-align: center"> El cierre mensual calcula saldos finales  para el periodo {{periodo}}</h4>
                    <h4  style="text-align: center">y crea los saldos iniciales para el periodo {{periodoNext}} </h4> 
                </div>   
                <div class="form-group">
                    <h4 style="text-align: center">  {{error}}</h4> 
                    <div ng-hide="ruedita">
                        <img src="img/progress.gif" alt=""/>
                    </div>
                </div>
                <div class="form-group" ng-hide="noVerBoton">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="cierreMensual()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="CIM" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>



