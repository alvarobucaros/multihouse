<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleTrasf}}</h3>
    <div class="col-md-8 col-md-offset-1">

        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormActu"
              ng-submit="insertInfo(registro);">  
                <div class="form-group">
                    <label class="milabel col-md-5" for="periodoIni">{{form_periodoHoy}} {{periodoCont}}</label>
                </div>
                <div class="form-group">
                    <label class="milabel col-md-5" for="periodoIni">{{form_periodoAct}}</label>
                    <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="periodoIni" name="periodoIni"
                        ng-model="periodoIni" value="{{periodoIni}}" />
                    </div> 
                </div>
               <div class="form-group">
                    <label class="milabel col-md-5" for="periodoFin">{{form_periodoNext}}</label>
                    <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="periodoFin" name="periodoFin"
                        ng-model="periodoFin" value="{{periodoFin}}" />
                    </div> 
                </div>
               <div class="form-group">                    
                    <div class="col-md-2">
                    <button class="btn btn-default btn-primary" ng-click="trasfiere(detail)" 
                     title="{{form_btnConti}}">{{form_btnConti}}</button>                   
                    </div>

                </div> 
                <div ng-hide="ruedita">
                    <img src="img/progress.gif" alt=""/>
                </div>
            <div id='miExcel' style='display: none'>
                <input type="text"  id="control" ng-model="control" value="2"/>
                <input type="text"  id="periodoCont" ng-model="periodoCont" value="2"/>
            </div> 
        </form>
    </div>

</div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>


<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< -->

