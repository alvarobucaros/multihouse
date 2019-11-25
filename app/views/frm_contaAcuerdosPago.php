    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_contabiliza}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                
                <div>
                    <img src="img/enDesarrollo.png" width="313" height="68" alt="enDesarrollo"/>

                </div>

                <div class="form-group">
                   <label class=" milabel col-md-4" for="Inmuebles">{{inmueble}}</label>
                   <div class="col-md-5">
                   <select id='Inmuebles' name='Inmuebles' ng-model='registro.Inmueble'   
                           ng-change="buscaFacturas(registro)">
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                   </select>
 
                   </div>
               </div>   

                <div class="form-group">
                   <label class=" milabel col-md-4" for="propietarios">{{propietario}}</label>
                   <div class="col-md-5">
                   <select id='propietarios' name='propietarios' ng-model='registro.propietario'   
                           ng-change="buscaFacturas(registro)">
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                   </div>
               </div> 

              
                
                <div class="form-group">
                    <div class="form-group" ng-show="imprime">
                        <div class="col-md-2">
                            <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                            ng-click="aplicar()" id="inprimir">{{form_btnAplicar}}</button>
                        </div>  

                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control"
                         ng-model="control" 
                         value="A" />
                </div> 
                
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>
