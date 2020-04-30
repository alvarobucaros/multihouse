<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_imprimeCmpbnte}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                  
                <div class="form-group">
                    <label class="milabel col-md-3" for="primerPeriodo">{{form_desdePeriodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="primerPeriodo" name="primerPeriodo"
                           ng-model="primerPeriodo"  />
                    </div>
                </div> 
                <div class="form-group"> 
                    <label class="milabel col-md-3" for="ultimoPeriodo">{{form_hastaPeriodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="ultimoPeriodo" name="ultimoPeriodo"
                           ng-model="ultimoPeriodo"  />
                    </div>  
                </div>                
                <div class="form-group">
                    <label class="milabel col-md-3" for="nivel">{{form_tipoCmprbnte}}</label>
                    <div class="col-md-3">
                        <label class="form-check-label" for="aplicados">{{form_Aplicado}}</label>
                        <input type="checkbox" name = "tipo" id="aplicados" ng-model="aplicados" class="form-check-input" >
                    </div>
                    <div class="col-md-3">
                        <label class="form-check-label" for="xAplicar">{{form_Xaplicar}}</label>
                        <input type="checkbox" name = "tipo" id="xAplicar" ng-model="xAplicar" class="form-check-input">
                    </div>                  
                    
                </div>  

                <div class="form-group">
                    <label class="milabel col-md-3" for="pagoestado">{{form_OrdenPor}}</label>
                    <div class="btn-group  col-md-4"  data-toggle="buttons">
                   <label>
                       <input type="radio" name ="orden"  ng-model="orden" value="FC" ng-checked="true"> {{form_fechaTC}}
                   </label>
                   <label>
                       <input type="radio" name ="orden"  ng-model="orden" value="CF"  > {{form_fechaCT}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="imprimeComprobantes()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="SL2" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>


