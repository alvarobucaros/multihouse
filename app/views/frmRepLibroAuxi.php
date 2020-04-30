<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_imprimelibAux}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                  
                <div class="form-group">
                    <label class="milabel col-md-3" for="desdePeriodo">{{form_desdePeriodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="desdePeriodo" name="desdePeriodo"
                           ng-model="desdePeriodo" />
                    </div>
                </div> 
  
                <div class="form-group"> 
                    <label class="milabel col-md-3" for="desdeCuenta">{{form_desdeCuenta}}</label>
                    <div class="col-md-3">
                   <select id='propietarios' name='desdeCuenta' ng-model='desdeCuenta'>
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.pucCuenta}}">{{operator0.pucNombre}}</option>
                    </select>
                   </div>
                  
                </div> 
                 <div class="form-group">
                    <label class="milabel col-md-3" for="hastaCuenta">{{form_hastaCuenta}}</label>
                   <div class="col-md-3">
                   <select id='propietarios' name='hastaCuenta' ng-model='hastaCuenta'>
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.pucCuenta}}">{{operator1.pucNombre}}</option>
                   </select>
                   </div>                    
                </div> 

                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="imprimeLibAux()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="LAX" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>



