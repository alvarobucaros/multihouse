    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title1}}<strong>{{form_title2}}</strong></h3>
        <h4 class="text-left">{{form_subTitle}}</h4>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    {{form_version}}
                 </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="nameForm" id="idForm">
            <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_nombre">{{form_empresa_nombre}}</label>
                    <div class="col-md-8">
                    <input type="text" class="form-control" id="empresa_nombre" name="empresa_nombre"
                           ng-model="empresa_nombre"  value="{{empresa_nombre}}" readonly="yes"/>
                    </div>
                </div>   
<!--SELECT , empresa_nit, , ,    FROM mm_empresa-->
                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_clave">{{form_empresa_clave}}</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control" id="empresa_clave" name="empresa_clave"
                        ng-model="empresa_clave"  value="{{empresa_clave}}" readonly="yes"/>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_versionPrd">{{form_empresa_versionPrd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_versionPrd" name="empresa_versionPrd"
                        ng-model="empresa_versionPrd"  value="{{empresa_versionPrd}}" readonly="yes"/>
                    </div>
                </div>                

                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_versionBd">{{form_empresa_versionBd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_versionBd" name="empresa_versionBd"
                        ng-model="empresa_versionBd"  value="{{empresa_versionBd}}" readonly="yes"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_servidor">{{form_empresa_servidor}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_servidor" name="empresa_servidor"
                        ng-model="empresa_servidor"  value="{{empresa_servidor}}" readonly="yes"/>
                    </div>
                </div>              

                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_baseDatos">{{form_empresa_baseDatos}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="empresa_baseDatos" name="empresa_baseDatos"
                        ng-model="empresa_baseDatos"  value="{{empresa_baseDatos}}" readonly="yes"/>
                    </div>
                </div>   

                <div class="form-group">
                    <label class="control-label col-md-4" for="empresa_version">{{form_empresa_version}}</label>
                    <div class="col-md-4">
                    <input type="text" class="form-control" id="empresa_version" name="empresa_version"
                        ng-model="empresa_version"  value="{{empresa_version}}" readonly="yes"/>
                    </div>
                </div>   
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 col-md-offset-2">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover">

                    <tr ng-repeat="detail in details| filter:search_query">
                    <td>{{detail.grupo_id}}</td>                   
                    <td>{{detail.empresa_nombre}}</td>
                    <td>{{detail.empresa_clave}}</td>
                    <td>{{detail.grupo_comite}}</td>
                    <td>{{detail.grupo_activo}}</td>
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>



<script src="controller/min/mm_version.ctrl.min.js" type="text/javascript"></script>

