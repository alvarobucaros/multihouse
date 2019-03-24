
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default  col-md-10 col-md-offset-1 navbar-mm">
            <div class="form-group">
                <label class="control-label milabel col-md-1" for="lista_codigo">{{form_lista_codigo}}</label>
                <div class="col-md-2">
                <select id='lista_codigo' name='lista_codigo' ng-model='registro.lista_codigo' ng-change="selecCodigo()" >
                 <option ng-repeat='operator0 in operators0' value = " {{operator0.listactrl_id}}">{{operator0.listactrl_codigo}}
                 </option>
                </select>
                </div>
                <div class="col-sm-2" ng-show="verNueva">
                    <button class="btn btn-primary btn-xs"  
                    ng-click="nueva()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                </div>
                <div class="col-sm-2">
                    <button class='btn btn-primary btn-xs'
                    ng-click='guarda()'>{{form_btnGuarda}}</button>                             
                </div> 
                <div class="col-sm-2">
                    <button class='btn btn-primary btn-xs'
                    ng-click='exporta()'>{{form_btnExcel}}</button>                  
                </div>
                <div class="col-sm-2">
                    <button class='btn btn-primary btn-xs'
                    ng-click='imprime()'>{{form_btnImprime}}</button>                  
                </div>
            </div> 
        </nav>
        <nav class="navbar navbar-default  col-md-10 col-md-offset-1 navbar-mm">
            <div class="form-group">
                <div class="col-md-1">                    
                    <label for="lista_quorum"> {{form_lista_quorum}}   </label>
                </div>
                <div class="col-md-1"> 
                    <input type="text" style="width: 50px; background-color:  gainsboro "  
                           id='lista_quorum' readonly="yes" ng-model="nroQuorum"> 
                </div>

                <div class="col-md-2"> 
                    <input type="text" style="width: 50px;"  id='porcQuorum' ng-model="porcQuorum">
                </div>
                <div class="col-md-1">                    
                    <label for="semaforo"> {{form_lista_asisten}}   </label>
                </div>
                <div class="col-md-1">                    
                    <label for="lista_quorum"> {{form_numeroLlamado}}   </label>
                </div>
                <div class="col-md-2"> 
                    <input type="text" style="width: 20px;"  id='numeroLlamado'  ng-model="numeroLlamado"
                           ng-change="nuevaLista()">
                    <input type="text" style="width: 60px;  background-color: gainsboro"  
                           id='nombreLlamado' readonly="yes"  ng-model="nombreLlamado">
                </div>
                <div class="col-md-1"> 
                    <input type="text" style="width: 50px; background-color: gainsboro; text-align: left"  id='nroAsisten' 
                     ng-model="nroAsisten"  > 
                </div>
                <div class="col-md-2"> 
                    <input type="text" style="width: 80px;"  id='semaforo' ng-model="semaforo" 
                           ng-style="{color:  {red: 'red', green: 'green'}[ color ]}">
                    
                    
                </div>
            </div>
        </nav>
        <div>

        <form>
             <div style='display: none'>
             <input type="text"	 ng-model="registro.lista_id" id ='lista_id'  
                    name ='lista_id' value="{{registro.lista_id}}"/>
             <input type="text"	 ng-model="registro.lista_empresa" id ='lista_empresa'  
                    name ='lista_empresa' value="{{registro.lista_empresa}}"/> 
             <input type="text"	 ng-model="registro.codigo" id ='codigo'  
                    name ='lista_codigo' value="{{registro.codigo}}"/> 
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
                         <th>INMUEBLE</th>
                        <th>PROPIETARIO</th>
                        <th  id="th1"  ng-show="td1" style=" display: block">Primero</th>
                        <th  id="th2"  ng-show="td2" style=" display: block">Segundo</th>
                        <th  id="th3"  ng-show="td3" style=" display: block">Tercero</th>
                        <th  id="th4"  ng-show="td4" style=" display: block">Cuarto</th>
                        <th  id="th5"  ng-show="td5" style=" display: block">Quinto</th>
                        <th  id="th6"  ng-show="td6" style=" display: block">Sexto</th>
                        <th>AREA</th>
                        <th>COEFICIENTE</th>
                        <th>OBERVACION</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.lista_inmueble}}</td>
                    <td>{{detail.lista_propietario}}</td>
                    <td id="td1" ng-show="td1"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste1" ng-true-value="1" ng-false-value="0"></td>
                    <td id="td2" ng-show="td2"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste2" ng-true-value="1" ng-false-value="0"></td>
                    <td id="td3" ng-show="td3"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste3" ng-true-value="1" ng-false-value="0"></td>
                    <td id="td4" ng-show="td4"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste4" ng-true-value="1" ng-false-value="0"></td>
                    <td id="td5" ng-show="td5"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste5" ng-true-value="1" ng-false-value="0"></td>
                    <td id="td6" ng-show="td6"> <input type="checkbox" ng-change="cuentaLista($index)" ng-model="detail.lista_asiste6" ng-true-value="1" ng-false-value="0"></td>
                    <td>{{detail.lista_area}}</td>
                    <td>{{detail.lista_coeficiente}}</td>
                    <td>
                    <input type="text"	 ng-model="detail.lista_obervacion" id ='lista_obervacion'  
                       name ='lista_obervacion' value="{{detail.lista_obervacion}}"/></td>
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

<script src="controller/min/mm_llamalista.ctrl.min.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Aug 26, 2018 10:18:56   <<<<<<< -->
