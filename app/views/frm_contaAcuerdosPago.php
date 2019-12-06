    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_acuerdosPago}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                
                <div class="form-group">
                   <label class=" milabel col-md-3" for="Inmuebles">{{inmueble}}</label>
                   <div class="col-md-5">
                   <select id='Inmuebles' name='Inmuebles' ng-model='registro.Inmueble'   
                           ng-change="buscaacuer2(registro)">
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                   </select>
 
                   </div>
               </div>   

                <div class="form-group">
                   <label class=" milabel col-md-3" for="propietarios">{{propietario}}</label>
                   <div class="col-md-5">
                   <select id='propietarios' name='propietarios' ng-model='registro.propietario'   
                           ng-change="buscaacuer2(registro)">
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                   </div>
               </div> 
                  
                <div>
                    <div class="form-group">
                        <label class="milabel col-md-4" for="enMora">{{form_enMora}}</label>
                        <label class="milabel col-md-4" for="corriente">{{form_corriente}}</label>
                        <label class="milabel col-md-4" for="vlrTotal">{{form_vlrTotal}}</label>
                        <div class="col-md-4">
                         <input type="text" class="form-control mitexto" id="enMora" name="enMora"
                                ng-model="enMora" readonly="yes"  value="{{enMora}}" />
                         </div>

                        <div class="col-md-4">
                         <input type="text" class="form-control mitexto" id="corriente" name="corriente"
                                ng-model="corriente" readonly="yes"  value="{{corriente}}" />
                         </div>
  
                        <div class="col-md-4">
                         <input type="text" class="form-control mitexto" id="vlrTotal" name="vlrTotal"
                                ng-model="vlrTotal" readonly="yes" value="{{vlrTotal}}" />
                         </div>
                     </div>               
                </div>

                <div class="form-group">
                    <label class=" milabel col-md-4" for="acuerdoValor">{{form_acuerdoValor}}</label>
                   <div class="col-md-6">
                     <input type="text" class="form-control mitexto"  id="acuerdoValor" name="acuerdoValor"
                         ng-model="acuerdoValor"    value="{{acuerdoValor}}">
                    </div>
                </div>                
  
                <div class="form-group">
                    <label class=" milabel col-md-4" for="acuerdoCuotas">{{form_acuerdoCuotas}}</label>
                   <div class="col-md-6">
                     <input type="text" class="form-control mitexto"  id="acuerdoCuotas" name="acuerdoCuotas"
                         ng-model="acuerdoCuotas"    value="{{acuerdoCuotas}}">
                    </div>
                </div>                  
                
                <div class="form-group">
                    <label class=" milabel col-md-4" for="detalle">{{form_detalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto"  cols="60" rows="4" id="detalle" name="detalle"
                         ng-model="detalle"   value="{{detalle}}">
                    </textarea>
                    </div>
                </div> 
                <div>                
                <div class="form-group col-md-offset-1" >
                    <div class="col-md-4">
                        <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs col-md-4" 
                        ng-click="aplicaAcuerdo()" id="inprimir">{{form_btnAplicar}}</button>
                    </div>
                    <div class="col-md-6" ng-show="imprimeAc">
                        <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs col-md-4" 
                        ng-click="imprimeAcuerdo()" id="inprimir">{{form_btnImpreAc}}</button>
                    </div>  
                </div>               
                </div>
                <div class="form-group" style='display: block'>                   
                    <input type="text"  id="control" ng-model="control" value="A" />
                    <input type="text"  id="periodo" ng-model="periodo"  />
                </div> 
                
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>
