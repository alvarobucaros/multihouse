<div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_poderRep}}</h3>
       
       <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >
                 <div class="form-group">
                    <label class=" milabel col-md-4" for="reunion">{{form_reunion}}</label>
                   <div class="col-md-5">
                     <input type="text" class="form-control mitexto"  id="reunion" name="reunion"
                         ng-model="reunion"    value="{{reunion}}">
                    </div>
                </div>
                <div class="form-group">
                   <label class=" milabel col-md-4" for="Inmuebles">{{inmueble}}</label>
                   <div class="col-md-5">
                   <select id='Inmuebles' name='Inmuebles' ng-model='registro.Inmueble'   
                           ng-change="buscaacuer2(registro)">
                   <option ng-repeat='operator0 in operators0' value = " {{operator0.inmuebleId}}">{{operator0.inmuebleDescripcion}}</option>
                   </select>
 
                   </div>
               </div>   

                <div class="form-group">
                   <label class=" milabel col-md-4" for="propietarios">{{propietario}}</label>
                   <div class="col-md-5">
                   <select id='propietarios' name='propietarios' ng-model='registro.propietario'   
                           ng-change="buscaacuer2(registro)">
                   <option ng-repeat='operator1 in operators1' value = " {{operator1.propietarioId}}">{{operator1.propietarioNombre}}</option>
                    </select>
                   </div>
               </div>
                <div class="form-group">
                    <label class="milabel col-md-4" for="tipoDocPropi">{{form_tipoDocPropi}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tipoDocPropi" ng-model="tipoDocPropi" value="C" >{{form_tipoDocPropiC}}
                   </label>
                   <label>
                      <input type="radio" name ="tipoDocPropi" ng-model="tipoDocPropi" value="X" >{{form_tipoDocPropiX}}
                   </label>
                    </div>
                </div> 
                <div class="form-group">
                    <label class=" milabel col-md-4" for="documentoPorpietario">{{form_documentoPorpietario}}</label>
                   <div class="col-md-5">
                     <input type="text" class="form-control mitexto"  id="documentoPorpietario" name="documentoPorpietario"
                         ng-model="documentoPorpietario"    value="{{documentoPorpietario}}">
                    </div>
                </div>   
                <div class="form-group">
                    <label class=" milabel col-md-4" for="nomRepresentante">{{form_nomRepresentante}}</label>
                   <div class="col-md-5">
                     <input type="text" class="form-control mitexto"  id="nomRepresentante" name="nomRepresentante"
                         ng-model="nomRepresentante"    value="{{nomRepresentante}}">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-4" for="tipoDocRep">{{form_tipoDocRep}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="tipoDocRep" ng-model="tipoDocRep" value="C" >{{form_tipoDocPropiC}}
                   </label>
                   <label>
                      <input type="radio" name ="tipoDocRep" ng-model="tipoDocRep" value="X" >{{form_tipoDocPropiX}}
                   </label>
                    </div>
                </div> 
                <div class="form-group">
                    <label class=" milabel col-md-4" for="documentoRepre">{{form_documentoRepre}}</label>
                   <div class="col-md-5">
                     <input type="text" class="form-control mitexto"  id="documentoRepre" name="documentoRepre"
                         ng-model="documentoRepre"    value="{{documentoRepre}}">
                    </div>
                </div>                 
                <div class="form-group">
                   <label class=" milabel col-md-4"  for="fechaReunion">{{form_fechaReunion}}</label>
                   <div class="col-md-5">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="fechaReunion" name="fechaReunion"
                         ng-model="fechaReunion"  value="{{fechaReunion}}"   />
                    </div>
                </div> 
          
                <div class="form-group" > 
                    <div class="col-md-2">
                        <button type="button" value="Imprimir" class="btn btn-custom pull-right btn-xs" 
                        ng-click="formularioRepre()" id="inprimir">{{form_btnAplicar}}</button>
                    </div>  
                </div>

                <div class="form-group" style='display: none'>                   
                    <input type="text"  id="control" ng-model="control" value="A" />
                    <input type="text"  id="periodo" ng-model="periodo"  />
                </div> 
            </form>
	</div>

     
   </div>

<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contaProcesos.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>
