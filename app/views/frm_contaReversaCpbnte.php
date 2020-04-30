
<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleRev}}</h3>
    <div class="col-md-8 col-md-offset-1">

        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormActu"
              ng-submit="insertInfo(registro);">  
                <div class="form-group">
                    <label class="milabel col-md-3" for="periodoCtble">{{form_periodo}}</label>
                    <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                           ng-blur="cambiaPeriodoCtble('rc')"  ng-model="periodoCtble" value="{{periodoCtble}}" />
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-default btn-primary" ng-click="continuaLista('rc')" 
                     title="{{form_btnConti}}">{{form_btnConti}}</button>                   
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-default btn-primary" ng-click="actualizaComprobante('rc')" 
                     title="{{form_btnReversa}}">{{form_btnReversa}}</button>                   
                    </div>
                    <div ng-hide="ruedita">
                        <img src="img/progress.gif" alt=""/>
                    </div>
                </div> 
            <div id='miExcel' style='display: none'>
                <input type="text"  id="control" ng-model="control" value="R" />
            </div> 
        </form>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-10">
        <!-- Table to show employee detalis -->
        <div class="table-responsive">
            <table id="idtabla" class="table table-hover tablex">
                <tr>
                    <th>CPBNTE</th>
                    <th>NOMBRE</th>
                    <th>NUMERO</th>
                    <th>TERCERO</th>
                    <th>DETALLE</th>
                    <th>PERIODO</th>
                    <th>FECHA</th> 
                    <th style="alignment-adjust: center; text-align: center" >ACTUALIZA</th> 
                   <th><input type="checkbox" id="actualiza" name="actualiza" ng-click="todoBoton()">
                </tr>

                <tr ng-repeat="detailActualizar in detailsActualizar | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detailActualizar.movicaId}}</td-->
                    <td>{{detailActualizar.movicaComprId}}</td>
                    <td>{{detailActualizar.compNombre}}</td>
                    <td>{{detailActualizar.movicaCompNro}}</td>
                    <td>{{detailActualizar.terceroNombre}}</td>
                    <td>{{detailActualizar.movicaDetalle}}</td>
                    <td>{{detailActualizar.movicaPeriodo}}</td>
                    <td>{{detailActualizar.movicaFecha}}</td>
                    <td style="alignment-adjust: center; text-align: center">
                     <input type="checkbox" id="actualiza" name="actualiza" value="{{detailActualizar.movicaId}}">
                    </td>
                </tr>
            </table>
                <div class='btn-group'>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage === 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage === page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                    <button type='button' class='btn btn-default' ng-disabled='currentPage >= detailActualizar.length/pageSize - 1', ng-click='currentPage = currentPage + 1'>&raquo;</button>
                </div> 
        </div>
    </div>
</div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>


<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< -->

