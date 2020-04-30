<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_imprimeSitFin}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                  <div class="form-group">
                    <label class=" milabel col-md-3" for="infoReporte">{{form_infoReporte}}</label>
                    <div class="col-md-6">
                    <select id='infoReporte' name='infoReporte' ng-model='infoReporte' ng-change='cambiaInfo();' >
                        <option ng-repeat='operator1 in operators1' value = " {{operator1.tipoCodigo}}">{{operator1.tipoDetalle}}</option>
                    </select>
                    </div>
                </div>                   
                <div class="form-group">
                    <label class="milabel col-md-3" for="ultimoPeriodo">{{form_periodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="ultimoPeriodo" name="ultimoPeriodo"
                           ng-model="ultimoPeriodo"  />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="ultimoVsPeriodo">{{form_vsPeriodo}}</label>
                    <div class="col-md-2">
                        <input type="text" class="mitexto" id="ultimoVsPeriodo" name="ultimoVsPeriodo"
                           ng-model="ultimoVsPeriodo"  />
                    </div>
                </div>  
                <div class="form-group">
                    <label class="milabel col-md-3" for="variaciones">{{form_variaciones}}</label>
                    <div class="btn-group  col-md-4"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="variaciones" ng-model="variaciones" value="S" >{{variacionesS}}
                   </label>
                   <label>
                      <input type="radio" name ="variaciones" ng-model="variaciones" value="N" >{{variacionesN}}
                   </label>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="milabel col-md-3" for="notas">{{form_notas}}</label>
                    <div class="btn-group  col-md-4"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="notas" ng-model="notas" value="S" >{{notasS}}
                   </label>
                   <label>
                      <input type="radio" name ="notas" ng-model="notas" value="N" >{{notasN}}
                   </label>
                    </div>
                </div> 
                <div ng-hide="ruedita">
                    <img src="img/progress.gif" alt=""/>
                </div>
                <div class="form-group">
                    <div class="btn-group  col-md-8">
                        <div class="col-md-2" ></div>
                        <div class="col-md-2" ng-show="prepara">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="preparaInfoNif()" id="continua">{{form_btnPretara}}</button>
                        </div>  
                   
                        <div class="col-md-3" ng-show="imprime">  
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="imprimeInfoNif()" id="continua">{{form_btnImprime}}</button>
                        </div>  
                        <div class="col-md-3" ng-show="imprime">  
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="exportaNif()" id="continua">{{form_btnExporta}}</button>
                        </div>                         
                    </div>
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="SF" />
                    <input type="text"  id="reimprime" ng-model="reimprime" /> 
                    <input type="text"  id="periodo" ng-model="periodo" /> 
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>



