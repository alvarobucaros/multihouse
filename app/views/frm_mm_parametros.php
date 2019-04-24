<div>
    <div class="container"  ng-controller="MainController">
        <nav class="navbar navbar-default navbar-mm col-md-6 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    {{from_title}}
                 </div>
            </div>
        </nav>
 
    <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm">            
        <div class="col-md-8 col-md-offset-1">
            
        <div class="form-group">
            <label class="control-label col-md-4" for="registrsoXpagina">{{form_registrsoXpagina}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" id="registrsoXpagina" name="registrsoXpagina"
                ng-model="registrsoXpagina" Placeholder="{{form_PhregistrsoXpagina}}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-4" for="diasTrabaja">{{form_diasTrabaja}}</label>
            <div class="col-md-6">
            <input type="text"  class="form-control" id="diasTrabaja" name="diasTrabaja" 
                ng-model="diasTrabaja" placeholder="{{form_PhdiasTrabaja}}"/>
            </div>                    
        </div>
         
        <div class="form-group">
            <label class="control-label col-md-4" for="horarioInicio">{{form_horarioInicio}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" id="horarioInicio" name="horarioInicio"
                ng-model="horarioInicio" Placeholder="{{form_PhhorarioInicio}}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-4" for="horarioTermina">{{form_horarioTermina}}</label>
            <div class="col-md-6">
            <input type="text"  class="form-control" id="horarioTermina" name="horarioTermina" 
                ng-model="horarioTermina" placeholder="{{form_PhhorarioTermina}}"/>
            </div>                    
        </div>				

        <div class="form-group">
            <label class="control-label col-md-4" for="intervaloCalendario">{{form_intervaloCalendario}}</label>
            <div class="col-md-6">
            <input type="text" class="form-control" id="intervaloCalendario" name="intervaloCalendario"
                 ng-model="intervaloCalendario" Placeholder="{{form_PhintervaloCalendario}}"/>
            </div>
        </div>

    
	 </div>			
        <div class="form-group">
            <div class="col-md-6">
                <button type="button" value="Actualizar" class="btn btn-custom pull-right" 
                        id="send_btn" ng-click="btnSend()">{{form_btnActualiza}}</button>
            </div>
        </div>

        <div style='display:none'>
                 <input type="text"  id ='empresa_id' ng-model="empresa_id">
                 <input type="text"  id ='empresa_autentica' ng-model="empresa_autentica" value = "<?php echo $e ?>" >
                 <input type="text"  id ='empresa_lenguaje' ng-model="empresa_lenguaje">
        </div> 
    </form>    
    </div><!-- End of Modal body -->           
</div>


<script src="controller/mm_parametros.ctrl.js" type="text/javascript"></script>

