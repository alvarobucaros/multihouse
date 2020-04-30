
<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleActu}}</h3>
    <div class="col-md-8 col-md-offset-1">

        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormActu"
              ng-submit="insertInfo(registro);">  
                <div class="form-group">
                    <label class="milabel col-md-3" for="periodoCtble">{{form_periodo}}</label>
                    <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                           ng-blur="cambiaPeriodoCtble('ac')"  ng-model="periodoCtble" value="{{periodoCtble}}" />
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-default btn-primary" ng-click="continuaLista('ac')" 
                     title="{{form_btnConti}}">{{form_btnConti}}</button>                   
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-default btn-primary" ng-click="actualizaComprobante('ac')" 
                     title="{{form_btnActualiza}}">{{form_btnActualiza}}</button>                   
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
                    <th><input type="checkbox" id="actualiza" name="actualiza" ng-click="todoBoton()"
                               ng-mouseover="Para actualizar utilice el botón Actualiza">
                    </th> 
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
                    <td>
                    <button class="btn btn-info btn-xs" ng-click="verMmovimiento(detailActualizar)" 
                             title="{{form_btnMovi}}"><span class="glyphicon glyphicon-list-alt"></span></button>
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
<div id="Modal">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h4 class="modal-title">{{titulin}}</h4>
        </div>
        <div class="modal-body">

	<div class="clearfix"></div>
        <div class="col-md-12">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <div class="form-group"> 
                    <label class="milabel col-md-2" for="vrlDeb">{{form_vrlDeb}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlDeb" name="vrlDeb"
                             ng-model="vrlDeb" value="vrlDeb" />
                    </div>
                    <label class="milabel col-md-2" for="vrlCre">{{form_vrlCre}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlCre" name="vrlCre"
                             ng-model="vrlCre" value="vrlCre" />
                    </div>
                    <label class="milabel col-md-2" for="vrlTot">{{form_vrlTot}}</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control mitexto" id="vrlTot" name="vrlTot"
                             ng-model="vrlTot" value="vrlTot" />
                    </div>
                </div>
                <table class="table table-hover tablex" id="tabMvto">
                    <tr>
                        <!--th>ID</th>
                        <th>CABEZA</th-->
                        <th>CUENTA</th>
                        <th>NOM CTA</th>
                        <th>DEBITO</th>
                        <th>CREDITO</th>
                        <th>DETALLE</th>
                        <!--th>BASE</th-->
                        <th>TIPO IMP</th>
                        <th>IMPUESTO %</th>
                        <th>IMPUESTO VALOR</th>
                        <!--th>IDTERCERO</th>
                        <th>MOVIDOCUM1</th>
                        <th>MOVIDOCUM2</th-->
                    </tr>

                     <tr ng-repeat="detailMv in detailsMv">
  
                    <!--td>{{detailMv.moviConId}}</td>
                    <td>{{detailMv.moviConCabezaId}}</td-->                   
                    <td>{{detailMv.moviConCuenta}}</td>
                    <td>{{detailMv.pucNombre}}</td>
                    <td>{{detailMv.moviConDebito}}</td>
                    <td>{{detailMv.moviConCredito}}</td>
                    <td>{{detailMv.moviConDetalle}}</td>
                    <!--td>{{detailMv.moviConBase}}</td-->
                    <td>{{detailMv.moviConImpTipo}}</td>
                    <td>{{detailMv.moviConImpPorc}}</td>
                    <td>{{detailMv.moviConImpValor}}</td>
                    <!--td>{{detailMv.moviConIdTercero}}</td>
                    <td>{{detailMv.moviDocum1}}</td>
                    <td>{{detailMv.moviDocum2}}</td-->
                    </tr>
                </table>
                    <!--div class='btn-group'>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === 0' ng-click='currentPageMv = currentPageMv - 1'>&laquo;</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv === page.no - 1' ng-click='setPageMv(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPageMv >= detailMv.length/pageSizeMv - 1', ng-click='currentPageMv = currentPageMv + 1'>&raquo;</button>
                    </div--> 
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">Cierra formulario</button>        
        </div>
        <div style='display: none'>
            <input type="text"  id="kontrol" ng-model="kontrol" value="Z" />
        </div> 
</div>
    </script> 
</div>
<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>


<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< -->
