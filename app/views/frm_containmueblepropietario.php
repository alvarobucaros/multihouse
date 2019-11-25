
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='exporta()'>{{form_btnExcel}}</button>
                </div>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control mitexto busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query" required>
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div class="form-group" ng-show="v1">
                    <label class="control-label milabel col-md-4" for="contaInmuPropietarioEmpresaId">{{form_contaInmuPropietarioEmpresaId}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="contaInmuPropietarioEmpresaId" name="contaInmuPropietarioEmpresaId"
                         ng-model="registro.contaInmuPropietarioEmpresaId" required Placeholder="{{form_PhcontaInmuPropietarioEmpresaId}}" 
                         value="{{registro.contaInmuPropietarioEmpresaId}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="contaInmuPropietarioInmuebleId">{{form_contaInmuPropietarioInmuebleId}}</label>
                    <div class="col-md-6">
                    <select id='contaInmuPropietarioInmuebleId' name='contaInmuPropietarioInmuebleId' ng-model='registro.contaInmuPropietarioInmuebleId' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleCodigo}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="contaInmuPropietarioPropietarioId">{{form_contaInmuPropietarioPropietarioId}}</label>
                    <div class="col-md-6">
                    <select id='contaInmuPropietarioPropietarioId' name='contaInmuPropietarioPropietarioId' ng-model='registro.contaInmuPropietarioPropietarioId' >
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btnCe">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text"	 ng-model="registro.contaInmuPropietarioId" id ='contaInmuPropietarioId'  name ='contaInmuPropietarioId' value="{{registro.contaInmuPropietarioId}}"/>

   
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <!--th>ID</th>
                        <th>EMPRESA</th-->
                        <th>INMUEBLE</th>
                        <th>PROPIETARIO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.contaInmuPropietarioId}}</td>
                    <td>{{detail.contaInmuPropietarioEmpresaId}}</td>
                    <td>{{detail.contaInmuPropietarioInmuebleId}}</td>
                    <td>{{detail.contaInmuPropietarioPropietarioId}}</td-->
                    <td>{{detail.inmuebleCodigo}}</td>
                    <td>{{detail.propietarioNombre}}</td>
                      
                    <td>
                    <button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                    <button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" 
                            confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
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
<script src="controller/ctrls/containmueblepropietario.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Sep 07, 2019 4:11:22   <<<<<<< -->
