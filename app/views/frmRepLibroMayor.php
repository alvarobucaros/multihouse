<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_imprimeLibMay}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                  
                <div class="form-group">
                    <label class="milabel col-md-3" for="periodo">{{form_periodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="periodo" name="periodo"
                           ng-model="periodo" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="nivel">{{form_Nivel}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="nivel" name="nivel"
                           ng-model="nivel"  />
                    </div>
                </div>  
  
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="imprimeLibMayor()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="LMY" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>



