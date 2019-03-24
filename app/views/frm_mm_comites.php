
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <?php if($pf=='A'){
                echo '<div class="ocul alert alert-default navbar-brand search-box">';
                echo '    <button class="btn btn-primary btn-xs" ng-show="show_form" ';
                echo '    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>';
                echo '</div>';}
                ?>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query">
                    </span>
                </div>
            </div>
        </nav>
        
        <div id="msg" class="col-md-6 col-md-offset-1" >
            <div class='ng-modal'  ng-show='msg'>
                <div class='ng-modal-overlay2'></div>
                <div>
                    <div class='ng-modal-dialog-content'>Esta version es  <strong>LITE</strong> permite solo un comité
                    <p> haga su donación para tenere acceso a múltiples comités</p>
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                            ng-click="paga()" id="send1_btn"> {{btnPaga}} </button>
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                            ng-click="noPaga()" id="send2_btn"> {{btnNoPaga}} </button>
                    </div>
                </div>
            </div>                  
        </div>
        
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden=""> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_nombre">{{form_comite_nombre}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comite_nombre" name="comite_nombre"
                         ng-model="registro.comite_nombre" required Placeholder="{{form_Phcomite_nombre}}" 
                         value="{{registro.comite_nombre}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_descripcion">{{form_comite_descripcion}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comite_descripcion" name="comite_descripcion"
                         ng-model="registro.comite_descripcion" required Placeholder="{{form_Phcomite_descripcion}}" 
                         value="{{registro.comite_descripcion}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_activo">{{form_comite_activo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" class=" milabel" name ="comite_activo" ng-model="registro.comite_activo" value="A" >{{form_Activo40}}
                   </label>
                   <label>
                      <input type="radio" class="milabel" name ="comite_activo" ng-model="registro.comite_activo" value="I" >{{form_Activo41}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_lider">{{form_comite_lider}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comite_lider" name="comite_lider"
                         ng-model="registro.comite_lider" required Placeholder="{{form_Phcomite_lider}}" 
                         value="{{registro.comite_lider}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_email">{{form_comite_email}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comite_email" name="comite_email"
                         ng-model="registro.comite_email" required Placeholder="{{form_Phcomite_email}}" 
                         value="{{registro.comite_email}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="comite_consecActa">{{form_comite_consecActa}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="comite_consecActa" name="comite_consecActa"
                         ng-model="registro.comite_consecActa" required Placeholder="{{form_Phcomite_consecActa}}" 
                         value="{{registro.comite_consecActa}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send1_btn">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send2_btn">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                    <input type="text" ng-model="registro.comite_id" id ='comite_id'  name ='comite_id' value="{{registro.comite_id}}"/>
                    <input type="text" ng-model="registro.comite_empresa" id="comite_empresa" name="comite_empresa" value="{{registro.comite_empresa}}"/>
                </div>
            </form>
	</div>
	
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>ACTIVO</th>
                        <th>LIDER</th>
                        <th>EMAIL</th>
                        <th>CONSEC.ACTA</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details| filter:search_query  | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.comite_nombre}}</td>
                    <td>{{detail.comite_descripcion}}</td>
                    <td>{{detail.comite_activo}}</td>
                    <td>{{detail.comite_lider}}</td>
                    <td>{{detail.comite_email}}</td>
                    <td>{{detail.comite_consecActa}}</td>
                    
                    <?php if($pf=='A'){
                        echo '<td>';                       
                        echo '<button class="btn btn-warning btn-xs" ng-click="editInfo(detail)" title="{{form_btnEdita}}"><span class="glyphicon glyphicon-edit"></span></button>';
                        echo '</td><td>';
                        echo '<button class="btn btn-danger btn-xs" ng-click="deleteInfo(detail)" ';
                        echo 'confirm="Está seguro ?, {{form_btnElimina}}?" title="{{form_btnElimina}}"><span class="glyphicon glyphicon-trash"></span></button>';
                        echo '</td>';
                                 };
                     ?>                
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


<script src="controller/min/mm_comites.ctrl.min.js" type="text/javascript"></script>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 09, 2017 5:35:33   <<<<<<< -->
