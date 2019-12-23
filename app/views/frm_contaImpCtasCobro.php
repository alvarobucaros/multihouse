<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_impromeCtasCobro}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                
                <div class="form-group">
                    <label class=" milabel  col-md-4" for="reimprimeCtas">{{form_imprimeTodos}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="reimprimeCtas" id="reimprimeSi" ng-model="registro.reimprimeCtas" value="S" >{{form_todassi}}
                   </label>
                   <label>
                      <input type="radio" name ="reimprimeCtas" id="reimprimeNo" ng-model="registro.reimprimeCtas" value="N" >{{form_todasno}}
                   </label>
                    </div>
                </div>   
                <div class="form-group">
                    <label class=" milabel col-md-4" for="ultimoPeriodo">{{form_periodo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ultimoPeriodo" name="ultimoPeriodo"
                           ng-model="registro.ultimoPeriodo"  readonly="yes"/>
                    </div>
                </div>                 

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
                            ng-click="imprimeCtaCobro()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="A" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>