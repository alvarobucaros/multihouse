
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

   

                <!--div class="form-group">
                    <label class="control-label milabel col-md-4" for="anticipoempresa">{{form_anticipoempresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="anticipoempresa" name="anticipoempresa"
                         ng-model="registro.anticipoempresa" required Placeholder="{{form_Phanticipoempresa}}" 
                         value="{{registro.anticipoempresa}}" />
                    </div>
                </div--> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="anticipoinmueble">{{form_anticipoinmueble}}</label>
                    <div class="col-md-6">
                    <select id='anticipoinmueble' name='anticipoinmueble' ng-model='registro.anticipoinmueble' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleCodigo}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="anticipofecha">{{form_anticipofecha}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="anticipofecha" name="anticipofecha"
                         ng-model="registro.anticipofecha" required Placeholder="{{form_Phanticipofecha}}" 
                         value="{{registro.anticipofecha}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="anticipovalor">{{form_anticipovalor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="anticipovalor" name="anticipovalor"
                         ng-model="registro.anticipovalor" required Placeholder="{{form_Phanticipovalor}}" 
                         value="{{registro.anticipovalor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="anticiposaldo">{{form_anticiposaldo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="anticiposaldo" name="anticiposaldo"
                         ng-model="registro.anticiposaldo" required Placeholder="{{form_Phanticiposaldo}}" 
                         value="{{registro.anticiposaldo}}" />
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
                <input type="text"	 ng-model="registro.anticipoid" id ='anticipoid'  name ='anticipoid' value="{{registro.anticipoid}}"/>

   
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
                        <th>FECHA</th>
                        <th>VALOR</th>
                        <th>SALDO</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.anticipoid}}</td>
                    <td>{{detail.anticipoempresa}}</td-->
                    <td>{{detail.anticipoinmueble}}</td>
                    <td>{{detail.anticipofecha}}</td>
                    <td>{{detail.anticipovalor}}</td>
                    <td>{{detail.anticiposaldo}}</td>
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
<script src="controller/ctrls/contaanticipos.ctrl.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Oct 19, 2019 11:56:12   <<<<<<< -->
