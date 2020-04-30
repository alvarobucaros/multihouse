<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_imprimeMovTer}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                  
  
                <div class="form-group"> 
                    <label class="milabel col-md-2" for="terceros">{{from_tercero}}</label>
                    <div class="col-md-3">
                   <select id='propietarios' name='terceros' ng-model='terceros'>
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.terceroId}}">{{operator0.terceroNombre}}</option>
                    </select>
                   </div>  
                </div>
                <div class="form-group">
                    <label class=" milabel col-md-2" for="fchDesde">{{form_fechaDesde}}</label>
                   <div class="col-md-5">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fchDesde" name="fchDesde"
                         ng-model="fchDesde"  value="{{fchDesde}}"   />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-2" for="fchHasta">{{form_fechaHasta}}</label>
                   <div class="col-md-5">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fchHasta" name="fchHasta"
                         ng-model="fchHasta" value="{{fchHasta}}"   />
                    </div>
                </div>                     

                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="imprimeMovTerc()" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="TRC" />
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>





