    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_titleRCaja}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >

                <div class="form-group">
                   <label class=" milabel col-md-3" for="Inmuebles">{{inmueble}}</label>
                   <div class="col-md-5">
                   <select id='Inmuebles' name='Inmuebles' ng-model='registro.Inmueble'   
                           ng-change="buscaFacturas(registro)">
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                   </select>
 
                   </div>
               </div>   

                <div class="form-group">
                   <label class=" milabel col-md-3" for="propietarios">{{propietario}}</label>
                   <div class="col-md-5">
                   <select id='propietarios' name='propietarios' ng-model='registro.propietario'   
                           ng-change="buscaFacturas(registro)">
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                   </div>
               </div> 

                <div class="form-group">
                   <label class="milabel col-md-3" for="fechaAbono">{{form_fechaAbono}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaAbono" name="fechaAbono"
                         ng-model="registro.fechaAbono" value="{{fechaAbono}}"   />
                    </div>
                </div> 
                 <div class="form-group">
                    <label class="milabel col-md-3" for="comprobante">{{comprobanteRC}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comprobante" name="comprobante"
                         ng-model="valComprobante" readonly="yes" 
                         value="{{valComprobante}}" />
                    </div>
                </div>
                
                <div class="form-group">
                     <label class="milabel col-md-3" for="msg">{{titSaldo}}</label>
                        <div class="form-group" class="col-md-6">                   
                            <input type="text"  name="msg" id="msg" width="100" readonly="yes"
                             ng-model="Mensaje"/>
                        </div> 
                
                </div> 
                
                <div class="form-group">
                    <label class="milabel col-md-3" for="vlrPago">{{titvlrPago}}</label>
                   <div class="col-md-6">
                       <input type="text"  id="vlrPago" name="vlrPago" width="80"
                         ng-model="vlrPago"  value="{{vlrPago}}" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="milabel col-md-3" for="formaPago">{{titformaPago}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                       <input type="radio" name ="formaPago" ng-model="registro.formaPago" ng-checked="formaPago()"  ="formaPago(1)" value="E" > {{formaPagoE}}
                   </label>
                   <label>
                      <input type="radio" name ="formaPago" ng-model="registro.formaPago" ng-checked="formaPago()" value="T" > {{formaPagoT}}
                    </label>
                    <label>
                      <input type="radio" name ="formaPago" ng-model="registro.formaPago" ng-checked="formaPago()" value="C" > {{formaPagoB}}                  
                   </label>
                    </div>
                </div> 
                
               <div class="form-group">
                   <label class="milabel col-md-3" for="referencia">{{titreferencia}}</label>
                   <div class="col-md-8">
                       <input type="text"  id="referencia" name="referencia" width="600"
                         ng-model="referencia"  value="{{referencia}}" />
                    </div>
                </div>                
                <div>
                
                    <div class="form-group col-md-offset-1" >
                        <div class="col-md-4">
                            <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs col-md-4" 
                            ng-click="aplicar()" id="inprimir">{{form_btnAplicar}}</button>
                        </div>
                        <div class="col-md-6" ng-show="imprime">
                            <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs col-md-4" 
                            ng-click="imprimeRcaja()" id="inprimir">{{form_btnImpreRc}}</button>
                        </div>  
                    </div>               
                </div>
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control" value="R" />
                    <input type="text"  id="fchPago" ng-model="fchPago" value="01/01/2000" />
                    <input type="text"  id="consecRC" ng-model="consecRC" value="0" />
                </div> 
                
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>