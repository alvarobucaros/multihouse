
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_nombre">{{form_empresa_nombre}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_nombre" name="empresa_nombre"
                         ng-model="registro.empresa_nombre" required Placeholder="{{form_Phempresa_nombre}}" 
                         value="{{registro.empresa_nombre}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_nit">{{form_empresa_nit}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_nit" name="empresa_nit"
                         ng-model="registro.empresa_nit" required Placeholder="{{form_Phempresa_nit}}" 
                         value="{{registro.empresa_nit}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_web">{{form_empresa_web}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_web" name="empresa_web"
                         ng-model="registro.empresa_web" required Placeholder="{{form_Phempresa_web}}" 
                         value="{{registro.empresa_web}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_direccion">{{form_empresa_direccion}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_direccion" name="empresa_direccion"
                         ng-model="registro.empresa_direccion" required Placeholder="{{form_Phempresa_direccion}}" 
                         value="{{registro.empresa_direccion}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_telefonos">{{form_empresa_telefonos}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_telefonos" name="empresa_telefonos"
                         ng-model="registro.empresa_telefonos" required Placeholder="{{form_Phempresa_telefonos}}" 
                         value="{{registro.empresa_telefonos}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_ciudad">{{form_empresa_ciudad}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_ciudad" name="empresa_ciudad"
                         ng-model="registro.empresa_ciudad" required Placeholder="{{form_Phempresa_ciudad}}" 
                         value="{{registro.empresa_ciudad}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_logo">{{form_empresa_logo}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_logo" name="empresa_logo"
                         ng-model="registro.empresa_logo" required Placeholder="{{form_Phempresa_logo}}" 
                         value="{{registro.empresa_logo}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_autentica">{{form_empresa_autentica}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_autentica" ng-model="registro.empresa_autentica" value="M" >{{form_Activo80}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_autentica" ng-model="registro.empresa_autentica" value="C" >{{form_Activo81}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_autentica" ng-model="registro.empresa_autentica" value="U" >{{form_Activo82}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_lenguaje">{{form_empresa_lenguaje}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_lenguaje" ng-model="registro.empresa_lenguaje" value="ESP" >{{form_Activo90}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_lenguaje" ng-model="registro.empresa_lenguaje" value="ING" >{{form_Activo91}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_lenguaje" ng-model="registro.empresa_lenguaje" value="OTR" >{{form_Activo92}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_versionPrd">{{form_empresa_versionPrd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_versionPrd" name="empresa_versionPrd"
                         ng-model="registro.empresa_versionPrd" required Placeholder="{{form_Phempresa_versionPrd}}" 
                         value="{{registro.empresa_versionPrd}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_versionBd">{{form_empresa_versionBd}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_versionBd" name="empresa_versionBd"
                         ng-model="registro.empresa_versionBd" required Placeholder="{{form_Phempresa_versionBd}}" 
                         value="{{registro.empresa_versionBd}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_clave">{{form_empresa_clave}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_clave" name="empresa_clave"
                         ng-model="registro.empresa_clave" required Placeholder="{{form_Phempresa_clave}}" 
                         value="{{registro.empresa_clave}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_email">{{form_empresa_email}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_email" name="empresa_email"
                         ng-model="registro.empresa_email" required Placeholder="{{form_Phempresa_email}}" 
                         value="{{registro.empresa_email}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_registrsoXpagina">{{form_empresa_registrsoXpagina}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_registrsoXpagina" name="empresa_registrsoXpagina"
                         ng-model="registro.empresa_registrsoXpagina" required Placeholder="{{form_Phempresa_registrsoXpagina}}" 
                         value="{{registro.empresa_registrsoXpagina}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_diasTrabaja">{{form_empresa_diasTrabaja}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_diasTrabaja" name="empresa_diasTrabaja"
                         ng-model="registro.empresa_diasTrabaja" required Placeholder="{{form_Phempresa_diasTrabaja}}" 
                         value="{{registro.empresa_diasTrabaja}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_horarioInicio">{{form_empresa_horarioInicio}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_horarioInicio" name="empresa_horarioInicio"
                         ng-model="registro.empresa_horarioInicio" required Placeholder="{{form_Phempresa_horarioInicio}}" 
                         value="{{registro.empresa_horarioInicio}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_horarioTermina">{{form_empresa_horarioTermina}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_horarioTermina" name="empresa_horarioTermina"
                         ng-model="registro.empresa_horarioTermina" required Placeholder="{{form_Phempresa_horarioTermina}}" 
                         value="{{registro.empresa_horarioTermina}}"/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_intervaloCalendario">{{form_empresa_intervaloCalendario}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_intervaloCalendario" ng-model="registro.empresa_intervaloCalendario" value="M" >{{form_Activo180}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_intervaloCalendario" ng-model="registro.empresa_intervaloCalendario" value="H" >{{form_Activo181}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_FormatoActa">{{form_empresa_FormatoActa}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresa_FormatoActa" name="empresa_FormatoActa"
                         ng-model="registro.empresa_FormatoActa" required Placeholder="{{form_Phempresa_FormatoActa}}" 
                         value="{{registro.empresa_FormatoActa}}"/>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresa_cresidencial">{{form_empresa_cresidencial}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_cresidencial" ng-model="registro.empresa_cresidencial" value="S" >{{form_cresidencialS}}
                   </label>
                   <label>
                      <input type="radio"  class=" milabel"  name ="empresa_cresidencial" ng-model="registro.empresa_cresidencial" value="N" >{{form_cresidencialN}}
                   </label>
                    </div>
                </div> 
                
                  <?php if($pf=='A'){
                echo '<div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btn">{{form_btnActualiza}}</button>
                     </div>  
                </div>  
                ';
                  }
                  ?>
                <div style='display: none'>
                <input type="text"	 ng-model="registro.empresa_id" id ='empresa_id'  name ='empresa_id' value="{{registro.empresa_id}}"/>

   
                </div>
            </form>
	</div>
</div>

<script src="controller/min/mm_empresa.ctrl.min.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 23, 2017 9:07:44   <<<<<<< -->
