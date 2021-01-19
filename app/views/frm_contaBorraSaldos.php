<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleBorra}}</h3>
    <div class="col-md-8 col-md-offset-1">

        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormActu"
              ng-submit="insertInfo(registro);">  
            <div class="form-group">
                <label class="milabel col-md-3" for="periodoCtble">{{form_periodo}}</label>
                <div class="col-md-2">
                <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                       ng-model="periodoCtble" value="{{periodoCtble}}" />
                </div>
                <div class="col-md-2">
                <button class="btn btn-default btn-primary" ng-click="continuaBorrado()" 
                 title="{{form_btnConti}}">{{form_btnConti}}</button>                   
                </div>

                <div ng-hide="ruedita">
                    <img src="img/progress.gif" alt=""/>
                </div>
            </div> 
            <div id='miExcel' style='display: none'>
                <input type="text"  id="control" ng-model="control" value="Z" />
            </div> 
        </form>
    </div>
    <div class="clearfix"></div>
</div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>