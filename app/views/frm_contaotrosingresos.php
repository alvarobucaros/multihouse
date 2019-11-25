   <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_titleOtroIngreso}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                ng-submit="insertInfo(registro);" >
                <div>
                    <img src="img/enDesarrollo.png" width="313" height="68" alt="enDesarrollo"/>

                </div>                      
            </form>
	</div>
	<div class="clearfix"></div>
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control"
                         ng-model="control" 
                         value="O" />
                </div> 
        
   </div>

<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>