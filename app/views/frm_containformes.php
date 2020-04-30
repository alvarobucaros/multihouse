
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header" style="height: 60">
                <div class="form-group">
                    <label class="control-label milabel col-md-2" for="infoReporte">{{form_infoReporte}}</label>
                    <div class="col-md-6">
                    <select id='infoReporte' name='infoReporte' ng-model='listaPpal' ng-change="tomaLaLista()">
                        <option  ng-repeat='operator1 in operators1' value = " {{operator1.tipoCodigo}}">{{operator1.tipoDetalle}}</option>
                    </select>
                    </div>
                </div> 
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='exporta()'>{{form_btnExcel}}</button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='renumera()'>{{form_btnRenumera}}</button>
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

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="infoEmpresa">{{form_infoEmpresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoEmpresa" name="infoEmpresa"
                         ng-model="registro.infoEmpresa" required Placeholder="{{form_PhinfoEmpresa}}" 
                         value="{{registro.infoEmpresa}}" />
                    </div>
                </div> 
                <div id='rueda' ng-hide="rueda">
                    <img src="img/progress.gif" alt=""/>Rueda
                </div>
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoReporte">{{form_infoReporte}}</label>
                    <div class="col-md-6">
                    <select id='infoReporte' name='infoReporte' ng-model='registro.infoReporte' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.tipoCodigo}}">{{operator0.tipoDetalle}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                   <label class="control-label milabel col-md-4" for="infoLinea">{{form_infoLinea}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoLinea" name="infoLinea"
                         ng-model="registro.infoLinea" required Placeholder="{{form_PhinfoLinea}}" 
                         value="{{registro.infoLinea}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="intoTipo">{{form_intoTipo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="intoTipo" ng-model="registro.intoTipo" value="T" >{{form_intoTipo40}}
                   </label>
                   <label>
                      <input type="radio" name ="intoTipo" ng-model="registro.intoTipo" value="C" >{{form_intoTipo41}}
                   </label>
                   <label>
                      <input type="radio" name ="intoTipo" ng-model="registro.intoTipo" value="R" >{{form_intoTipo42}}
                   </label>
                   <label>
                      <input type="radio" name ="intoTipo" ng-model="registro.intoTipo" value="S" >{{form_intoTipo43}}
                   </label>
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="infoCodigo">{{form_infoCodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoCodigo" name="infoCodigo"
                         ng-model="registro.infoCodigo" required Placeholder="{{form_PhinfoCodigo}}" 
                         value="{{registro.infoCodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoNombre">{{form_infoNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoNombre" name="infoNombre"
                         ng-model="registro.infoNombre" required Placeholder="{{form_PhinfoNombre}}" 
                         value="{{registro.infoNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoCuentasIN">{{form_infoCuentasIN}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoCuentasIN" name="infoCuentasIN"
                         ng-model="registro.infoCuentasIN" required Placeholder="{{form_PhinfoCuentasIN}}" 
                         value="{{registro.infoCuentasIN}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoCuentasOUT">{{form_infoCuentasOUT}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoCuentasOUT" name="infoCuentasOUT"
                         ng-model="registro.infoCuentasOUT" required Placeholder="{{form_PhinfoCuentasOUT}}" 
                         value="{{registro.infoCuentasOUT}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoFormula">{{form_infoFormula}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoFormula" name="infoFormula"
                         ng-model="registro.infoFormula" required Placeholder="{{form_PhinfoFormula}}" 
                         value="{{registro.infoFormula}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="infoNro">{{form_infoNro}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoNro" name="infoNro"
                         ng-model="registro.infoNro" required Placeholder="{{form_PhinfoNro}}" 
                         value="{{registro.infoNro}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoNotas">{{form_infoNotas}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="infoNotas" name="infoNotas"
                         ng-model="registro.infoNotas" required Placeholder="{{form_PhinfoNotas}}" 
                         value="{{registro.infoNotas}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoIndenta">{{form_infoIndenta}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="infoIndenta" ng-model="registro.infoIndenta" value="2" >{{form_infoIndenta120}}
                   </label>
                   <label>
                      <input type="radio" name ="infoIndenta" ng-model="registro.infoIndenta" value="4" >{{form_infoIndenta121}}
                   </label>
                   <label>
                      <input type="radio" name ="infoIndenta" ng-model="registro.infoIndenta" value="6" >{{form_infoIndenta122}}
                   </label>
                   <label>
                      <input type="radio" name ="infoIndenta" ng-model="registro.infoIndenta" value="8" >{{form_infoIndenta123}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoNuevaPagina">{{form_infoNuevaPagina}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="infoNuevaPagina" ng-model="registro.infoNuevaPagina" value="S" >{{form_infoNuevaPagina130}}
                   </label>
                   <label>
                      <input type="radio" name ="infoNuevaPagina" ng-model="registro.infoNuevaPagina" value="N" >{{form_infoNuevaPagina131}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="infoMultiplicador">{{form_infoMultiplicador}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="infoMultiplicador" ng-model="registro.infoMultiplicador" value="1" >{{form_infoMultiplicador140}}
                   </label>
                   <label>
                      <input type="radio" name ="infoMultiplicador" ng-model="registro.infoMultiplicador" value="-1" >{{form_infoMultiplicador141}}
                   </label>
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
                <input type="text"	 ng-model="registro.infoId" id ='infoId'  name ='infoId' value="{{registro.infoId}}"/> 
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10" ng-hide='toma'>
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <!--th>ID</th>
                        <th>EMPRESA</th>
                        <th>REPORTE</th-->
                        <th>LINEA</th>
                        <th>TIPO</th>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>INCLUYE</th>
                        <th>EXCLUYE</th>
                        <th>FORMULA</th>
                        <!--th>NRO</th-->
                        <th>NOTAS</th>
                        <th>INDENTA</th>
                        <th>PAGINA</th>
                        <th>MULT</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <!--td>{{detail.infoId}}</td>
                    <td>{{detail.infoEmpresa}}</td>
                    <td>{{detail.infoReporte}}</td-->
                    <td>{{detail.infoLinea}}</td>
                    <!--td>{{detail.intoTipo}}</td--> 
                    <td>{{detail.intoNomTipo}}</td> 
                    <td>{{detail.infoCodigo}}</td>
                    <td>{{detail.infoNombre}}</td>
                    <td>{{detail.infoCuentasIN}}</td>
                    <td>{{detail.infoCuentasOUT}}</td>
                    <td>{{detail.infoFormula}}</td>
                    <!--td>{{detail.infoNro}}</td-->
                    <td>{{detail.infoNotas}}</td>
                    <td>{{detail.infoIndenta}}</td>
                    <td>{{detail.infoNuevaPagina}}</td>
                    <td>{{detail.infoMultiplicador}}</td>
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
<script src="controller/ctrls/containformes.ctrl.js" type="text/javascript"></script>

	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Mar 09, 2020 8:33:07   <<<<<<< -->
