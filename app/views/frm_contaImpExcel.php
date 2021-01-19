<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_tituloExcel}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                 <div class="form-group">
                    <label class=" milabel col-md-8" >{{form_nota1Xls}}</label>
                 </div>
                <div class="form-group" style='display: none'>
                    <label class=" milabel col-md-3" for="ultimoPeriodo">{{form_periodo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="ultimoPeriodo" name="ultimoPeriodo"
                           ng-model="registro.ultimoPeriodo"  readonly="yes"/>
                    </div>
                </div>
                <div class="form-group">
                   <label class="milabel col-md-3" for="fechaDesde">{{form_fechaDesde}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaDesde" name="fechaDesde"
                         ng-model="registro.fechaDesde" value="{{fechaDesde}}"   />
                    </div>
                </div> 
                <div class="form-group">
                   <label class="milabel col-md-3" for="fechaHasta">{{form_fechaHasta}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaHasta" name="fechaHasta"
                         ng-model="registro.fechaHasta" value="{{fechaHasta}}"   />
                    </div>
                </div>   
                 <div class="form-group">
                    <label class=" milabel col-md-8" >{{form_nota2Xls}}</label>
                 </div>                
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-2" style='display: none'><input type="checkbox" ng-model = "registro.g1"> Comprobante </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g2"> Nombre Tercero </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g3"> Documento tercero </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g4"> Detalle movimiento</div>                  
                </div>   
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-2" style='display: none'><input type="checkbox" ng-model = "registro.g5"> Cuenta contable </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g6"> Documento soporte </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g7"> Bases importe </div>
                    <div class="col-md-2"><input type="checkbox" ng-model = "registro.g8"> Porcentaje</div>                  
                </div>                  
                
                <div class="form-group">
                    <div class="form-group">
                        <div class="col-md-2">
                            <button type="button" value="continua" class="btn btn-custom pull-right btn-xs" 
                            ng-click="vaAexcel(registro)" id="continua">{{form_btnContinua}}</button>
                        </div>  
                    </div>
                </div> 
                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control"  value="XLS" />
                </div> 
                </div>
                <div id='miExcel' style='display: none'>
                </div>                 
            </form>
	</div>
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaInfoCont.js" type="text/javascript"></script>

<script src="controller/script.js" type="text/javascript"></script>