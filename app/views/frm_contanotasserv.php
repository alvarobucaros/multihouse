<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_title}}</h3>
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
              ng-submit="insertInfo(registro);" >

                <div class="form-group alto12">
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="notaTipo" ng-model="registro.factdefcontabiliza" value="DB" >{{form_notaDB}}
                   </label>
                   <label>
                      <input type="radio" name ="notaTipo" ng-model="registro.factdefcontabiliza" value="CR" >{{form_notaCR}}
                   </label>
                    </div>
                </div>             

        </form>
    </div>
</div>


<script src="controller/ctrls/contanotasserv.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2021 7:25:07   <<<<<<< -->
                
        
