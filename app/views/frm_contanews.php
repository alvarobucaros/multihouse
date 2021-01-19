
<!--FRMVERSION-->

    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title1}}<strong>{{form_title2}}</strong></h3>
        <h4 class="text-left">{{form_subTitle}}</h4>

        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="nameForm" id="idForm">
                <div class="form-group" ng-view="vista">
                    <label class="control-label col-md-4" for="empresa_nombre">{{form_empresa_nombre}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_nombre" name="empresa_nombre"
                           ng-model="empresa_nombre"  value="{{empresa_nombre}}" readonly="yes"/>
                    </div>
                </div>   

                <div class="form-group" ng-show="vista">
                    <label class="control-label col-md-4" for="empresa_clave">{{form_empresa_clave}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_clave" name="empresa_clave"
                        ng-model="empresa_clave"  value="{{empresa_clave}}" readonly="yes"/>
                    </div>
                </div> 

                <div class="form-group" ng-show="vista">
                    <label class="control-label col-md-4" for="empresa_versionPrd">{{form_empresa_versionPrd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_versionPrd" name="empresa_versionPrd"
                        ng-model="empresa_versionPrd"  value="{{empresa_versionPrd}}" readonly="yes"/>
                    </div>
                </div>                

                <div class="form-group" ng-show="vista">
                    <label class="control-label col-md-4" for="empresa_versionBd">{{form_empresa_versionBd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_versionBd" name="empresa_versionBd"
                        ng-model="empresa_versionBd"  value="{{empresa_versionBd}}" readonly="yes"/>
                    </div>
                </div> 

            </form>
        </div>
        <div ng-show="noticias">
            <div class="col-md-12 col-md-offset-1">
                <div class="navbar-header">
                    <div class="alert alert-default navbar-brand search-box">
                        {{form_version}}
                     </div>
                </div>
            </div>
                <div id='miExcel' class="col-md-12 col-md-offset-1" style='display: none'>
                    <input type="text" class="form-control" id="Bd" name="Bd"  ng-model="Bd"  />                    
                </div> 
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table table-hover tablex">
                        <tr>                           
                            <th>DESCRIPCION</th>
                            <th>FECHA</th>
                        </tr>
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.actu_texto}}</td>
                    <td>{{detail.actu_fechaopera}}</td>
                    </tr>
                    </table>  
                    <div class='btn-group'>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage === 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage === page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
                        <button type='button' class='btn btn-default' ng-disabled='currentPage >= details.length/pageSize - 1', ng-click='currentPage = currentPage + 1'>&raquo;</button>
                    </div> 
                </div>
            </div>
        </div>    

    </div>

<script src="controller/ctrls/contanews.ctrl.js" type="text/javascript"></script>
