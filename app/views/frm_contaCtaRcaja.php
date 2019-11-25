<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_consultaRecibo}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                <div>
                    <img src="img/enDesarrollo.png" width="313" height="68" alt="enDesarrollo"/>

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
<script src="controller/ctrls/contareportes.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>