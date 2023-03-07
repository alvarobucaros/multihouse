

    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        
        <div class="col-md-8 col-md-offset-1">
    
            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaClave">{{form_empresaClave}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaClave" name="empresaClave"
                         ng-model="registro.empresaClave" required Placeholder="{{form_PhempresaClave}}" 
                         value="{{registro.empresaClave}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaNombre">{{form_empresaNombre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaNombre" name="empresaNombre"
                         ng-model="registro.empresaNombre" required Placeholder="{{form_PhempresaNombre}}" 
                         value="{{registro.empresaNombre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaNit">{{form_empresaNit}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaNit" name="empresaNit"
                         ng-model="registro.empresaNit" required Placeholder="{{form_PhempresaNit}}" 
                         value="{{registro.empresaNit}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaDigito">{{form_empresaDigito}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDigito" name="empresaDigito"
                         ng-model="registro.empresaDigito" required Placeholder="{{form_PhempresaDigito}}" 
                         value="{{registro.empresaDigito}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaDireccion">{{form_empresaDireccion}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDireccion" name="empresaDireccion"
                         ng-model="registro.empresaDireccion" required Placeholder="{{form_PhempresaDireccion}}" 
                         value="{{registro.empresaDireccion}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCiudad">{{form_empresaCiudad}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCiudad" name="empresaCiudad"
                         ng-model="registro.empresaCiudad" required Placeholder="{{form_PhempresaCiudad}}" 
                         value="{{registro.empresaCiudad}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaTelefonos">{{form_empresaTelefonos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaTelefonos" name="empresaTelefonos"
                         ng-model="registro.empresaTelefonos" required Placeholder="{{form_PhempresaTelefonos}}" 
                         value="{{registro.empresaTelefonos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaFchCreacion">{{form_empresaFchCreacion}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="empresaFchCreacion" name="empresaFchCreacion"
                         ng-model="registro.empresaFchCreacion" required Placeholder="{{form_PhempresaFchCreacion}}" 
                         value="{{registro.empresaFchCreacion}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaFchModificacion">{{form_empresaFchModificacion}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="empresaFchModificacion" name="empresaFchModificacion"
                         ng-model="registro.empresaFchModificacion" required Placeholder="{{form_PhempresaFchModificacion}}" 
                         value="{{registro.empresaFchModificacion}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaFchVigencia">{{form_empresaFchVigencia}}</label>
                   <div class="col-md-6">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="empresaFchVigencia" name="empresaFchVigencia"
                         ng-model="registro.empresaFchVigencia" required Placeholder="{{form_PhempresaFchVigencia}}" 
                         value="{{registro.empresaFchVigencia}}"   />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPeriodoActual">{{form_empresaPeriodoActual}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodoActual" name="empresaPeriodoActual"
                         ng-model="registro.empresaPeriodoActual" required Placeholder="{{form_PhempresaPeriodoActual}}" 
                         value="{{registro.empresaPeriodoActual}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaTwiter">{{form_empresaTwiter}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaTwiter" name="empresaTwiter"
                         ng-model="registro.empresaTwiter" required Placeholder="{{form_PhempresaTwiter}}" 
                         value="{{registro.empresaTwiter}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaFacebook">{{form_empresaFacebook}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaFacebook" name="empresaFacebook"
                         ng-model="registro.empresaFacebook" required Placeholder="{{form_PhempresaFacebook}}" 
                         value="{{registro.empresaFacebook}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaWeb">{{form_empresaWeb}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaWeb" name="empresaWeb"
                         ng-model="registro.empresaWeb" required Placeholder="{{form_PhempresaWeb}}" 
                         value="{{registro.empresaWeb}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaEmail">{{form_empresaEmail}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaEmail" name="empresaEmail"
                         ng-model="registro.empresaEmail" required Placeholder="{{form_PhempresaEmail}}" 
                         value="{{registro.empresaEmail}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaActiva">{{form_empresaActiva}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaActiva" ng-model="registro.empresaActiva" value="I" >{{form_empresaActiva160}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaActiva" ng-model="registro.empresaActiva" value="A" >{{form_empresaActiva161}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPuertoCorreo">{{form_empresaPuertoCorreo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPuertoCorreo" name="empresaPuertoCorreo"
                         ng-model="registro.empresaPuertoCorreo" required Placeholder="{{form_PhempresaPuertoCorreo}}" 
                         value="{{registro.empresaPuertoCorreo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRepresentante">{{form_empresaRepresentante}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRepresentante" name="empresaRepresentante"
                         ng-model="registro.empresaRepresentante" required Placeholder="{{form_PhempresaRepresentante}}" 
                         value="{{registro.empresaRepresentante}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdentifRepresentante">{{form_empresaIdentifRepresentante}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaIdentifRepresentante" name="empresaIdentifRepresentante"
                         ng-model="registro.empresaIdentifRepresentante" required Placeholder="{{form_PhempresaIdentifRepresentante}}" 
                         value="{{registro.empresaIdentifRepresentante}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaContador">{{form_empresaContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaContador" name="empresaContador"
                         ng-model="registro.empresaContador" required Placeholder="{{form_PhempresaContador}}" 
                         value="{{registro.empresaContador}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMatriculaContador">{{form_empresaMatriculaContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMatriculaContador" name="empresaMatriculaContador"
                         ng-model="registro.empresaMatriculaContador" required Placeholder="{{form_PhempresaMatriculaContador}}" 
                         value="{{registro.empresaMatriculaContador}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdentifContador">{{form_empresaIdentifContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaIdentifContador" name="empresaIdentifContador"
                         ng-model="registro.empresaIdentifContador" required Placeholder="{{form_PhempresaIdentifContador}}" 
                         value="{{registro.empresaIdentifContador}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRevisor">{{form_empresaRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRevisor" name="empresaRevisor"
                         ng-model="registro.empresaRevisor" required Placeholder="{{form_PhempresaRevisor}}" 
                         value="{{registro.empresaRevisor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMatriculaRevisor">{{form_empresaMatriculaRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMatriculaRevisor" name="empresaMatriculaRevisor"
                         ng-model="registro.empresaMatriculaRevisor" required Placeholder="{{form_PhempresaMatriculaRevisor}}" 
                         value="{{registro.empresaMatriculaRevisor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdentifRevisor">{{form_empresaIdentifRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaIdentifRevisor" name="empresaIdentifRevisor"
                         ng-model="registro.empresaIdentifRevisor" required Placeholder="{{form_PhempresaIdentifRevisor}}" 
                         value="{{registro.empresaIdentifRevisor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaAnoFiscal">{{form_empresaAnoFiscal}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaAnoFiscal" name="empresaAnoFiscal"
                         ng-model="registro.empresaAnoFiscal" required Placeholder="{{form_PhempresaAnoFiscal}}" 
                         value="{{registro.empresaAnoFiscal}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaEstructura">{{form_empresaEstructura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaEstructura" name="empresaEstructura"
                         ng-model="registro.empresaEstructura" required Placeholder="{{form_PhempresaEstructura}}" 
                         value="{{registro.empresaEstructura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaAdministrador">{{form_empresaAdministrador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaAdministrador" name="empresaAdministrador"
                         ng-model="registro.empresaAdministrador" required Placeholder="{{form_PhempresaAdministrador}}" 
                         value="{{registro.empresaAdministrador}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaAdministradorCed">{{form_empresaAdministradorCed}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaAdministradorCed" name="empresaAdministradorCed"
                         ng-model="registro.empresaAdministradorCed" required Placeholder="{{form_PhempresaAdministradorCed}}" 
                         value="{{registro.empresaAdministradorCed}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaSecretaria">{{form_empresaSecretaria}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaSecretaria" name="empresaSecretaria"
                         ng-model="registro.empresaSecretaria" required Placeholder="{{form_PhempresaSecretaria}}" 
                         value="{{registro.empresaSecretaria}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaSecretariaCedula">{{form_empresaSecretariaCedula}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaSecretariaCedula" name="empresaSecretariaCedula"
                         ng-model="registro.empresaSecretariaCedula" required Placeholder="{{form_PhempresaSecretariaCedula}}" 
                         value="{{registro.empresaSecretariaCedula}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMensaje1">{{form_empresaMensaje1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMensaje1" name="empresaMensaje1"
                         ng-model="registro.empresaMensaje1" required Placeholder="{{form_PhempresaMensaje1}}" 
                         value="{{registro.empresaMensaje1}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMensaje2">{{form_empresaMensaje2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMensaje2" name="empresaMensaje2"
                         ng-model="registro.empresaMensaje2" required Placeholder="{{form_PhempresaMensaje2}}" 
                         value="{{registro.empresaMensaje2}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPeriodoFactura">{{form_empresaPeriodoFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodoFactura" name="empresaPeriodoFactura"
                         ng-model="registro.empresaPeriodoFactura" required Placeholder="{{form_PhempresaPeriodoFactura}}" 
                         value="{{registro.empresaPeriodoFactura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPeriCierreFactura">{{form_empresaPeriCierreFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriCierreFactura" name="empresaPeriCierreFactura"
                         ng-model="registro.empresaPeriCierreFactura" required Placeholder="{{form_PhempresaPeriCierreFactura}}" 
                         value="{{registro.empresaPeriCierreFactura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompFra">{{form_empresaCompFra}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompFra" name="empresaCompFra"
                         ng-model="registro.empresaCompFra" required Placeholder="{{form_PhempresaCompFra}}" 
                         value="{{registro.empresaCompFra}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompRcaja">{{form_empresaCompRcaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompRcaja" name="empresaCompRcaja"
                         ng-model="registro.empresaCompRcaja" required Placeholder="{{form_PhempresaCompRcaja}}" 
                         value="{{registro.empresaCompRcaja}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompAjustes">{{form_empresaCompAjustes}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompAjustes" name="empresaCompAjustes"
                         ng-model="registro.empresaCompAjustes" required Placeholder="{{form_PhempresaCompAjustes}}" 
                         value="{{registro.empresaCompAjustes}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompEgreso">{{form_empresaCompEgreso}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompEgreso" name="empresaCompEgreso"
                         ng-model="registro.empresaCompEgreso" required Placeholder="{{form_PhempresaCompEgreso}}" 
                         value="{{registro.empresaCompEgreso}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompCierreMes">{{form_empresaCompCierreMes}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompCierreMes" name="empresaCompCierreMes"
                         ng-model="registro.empresaCompCierreMes" required Placeholder="{{form_PhempresaCompCierreMes}}" 
                         value="{{registro.empresaCompCierreMes}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompApertura">{{form_empresaCompApertura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompApertura" name="empresaCompApertura"
                         ng-model="registro.empresaCompApertura" required Placeholder="{{form_PhempresaCompApertura}}" 
                         value="{{registro.empresaCompApertura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCuentaCierre">{{form_empresaCuentaCierre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCuentaCierre" name="empresaCuentaCierre"
                         ng-model="registro.empresaCuentaCierre" required Placeholder="{{form_PhempresaCuentaCierre}}" 
                         value="{{registro.empresaCuentaCierre}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCuentaCaja">{{form_empresaCuentaCaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCuentaCaja" name="empresaCuentaCaja"
                         ng-model="registro.empresaCuentaCaja" required Placeholder="{{form_PhempresaCuentaCaja}}" 
                         value="{{registro.empresaCuentaCaja}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRecargoPorc">{{form_empresaRecargoPorc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoPorc" name="empresaRecargoPorc"
                         ng-model="registro.empresaRecargoPorc" required Placeholder="{{form_PhempresaRecargoPorc}}" 
                         value="{{registro.empresaRecargoPorc}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRecargoPesos">{{form_empresaRecargoPesos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoPesos" name="empresaRecargoPesos"
                         ng-model="registro.empresaRecargoPesos" required Placeholder="{{form_PhempresaRecargoPesos}}" 
                         value="{{registro.empresaRecargoPesos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRecargoDias">{{form_empresaRecargoDias}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoDias" name="empresaRecargoDias"
                         ng-model="registro.empresaRecargoDias" required Placeholder="{{form_PhempresaRecargoDias}}" 
                         value="{{registro.empresaRecargoDias}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaDescPorc">{{form_empresaDescPorc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescPorc" name="empresaDescPorc"
                         ng-model="registro.empresaDescPorc" required Placeholder="{{form_PhempresaDescPorc}}" 
                         value="{{registro.empresaDescPorc}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaDescPesos">{{form_empresaDescPesos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescPesos" name="empresaDescPesos"
                         ng-model="registro.empresaDescPesos" required Placeholder="{{form_PhempresaDescPesos}}" 
                         value="{{registro.empresaDescPesos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaDescDias">{{form_empresaDescDias}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescDias" name="empresaDescDias"
                         ng-model="registro.empresaDescDias" required Placeholder="{{form_PhempresaDescDias}}" 
                         value="{{registro.empresaDescDias}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPagosParciales">{{form_empresaPagosParciales}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaPagosParciales" ng-model="registro.empresaPagosParciales" value="N" >{{form_empresaPagosParciales500}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaPagosParciales" ng-model="registro.empresaPagosParciales" value="S" >{{form_empresaPagosParciales501}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPeriodosAnuales">{{form_empresaPeriodosAnuales}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodosAnuales" name="empresaPeriodosAnuales"
                         ng-model="registro.empresaPeriodosAnuales" required Placeholder="{{form_PhempresaPeriodosAnuales}}" 
                         value="{{registro.empresaPeriodosAnuales}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaFactorRedondeo">{{form_empresaFactorRedondeo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                    <select id='redondeo' name='redondeo' ng-model='registro.Redondeo' >
                     <option ng-repeat='redondeo in redondeo.availableOptions' value = " {{redondeo.tipo}}">{{redondeo.detalle}}</option>
                    </select>                        
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaConsecRcaja">{{form_empresaConsecRcaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaConsecRcaja" name="empresaConsecRcaja"
                         ng-model="registro.empresaConsecRcaja" required Placeholder="{{form_PhempresaConsecRcaja}}" 
                         value="{{registro.empresaConsecRcaja}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaConsecFactura">{{form_empresaConsecFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaConsecFactura" name="empresaConsecFactura"
                         ng-model="registro.empresaConsecFactura" required Placeholder="{{form_PhempresaConsecFactura}}" 
                         value="{{registro.empresaConsecFactura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdioma">{{form_empresaIdioma}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaIdioma" ng-model="registro.empresaIdioma" value="ES" >{{form_empresaIdioma550}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaIdioma" ng-model="registro.empresaIdioma" value="IN" >{{form_empresaIdioma551}}
                   </label>
                    <label>
                      <input type="radio" name ="empresaIdioma" ng-model="registro.empresaIdioma" value="OT" >{{form_empresaIdioma552}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaNroInmuebles">{{form_empresaNroInmuebles}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaNroInmuebles" name="empresaNroInmuebles"
                         ng-model="registro.empresaNroInmuebles" required Placeholder="{{form_PhempresaNroInmuebles}}" 
                         value="{{registro.empresaNroInmuebles}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaLogo">{{form_empresaLogo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaLogo" name="empresaLogo"
                         ng-model="registro.empresaLogo" required Placeholder="{{form_PhempresaLogo}}" 
                         value="{{registro.empresaLogo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaccosto">{{form_empresaccosto}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaccosto" ng-model="registro.empresaccosto" value="N" >{{form_empresaccosto580}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaccosto" ng-model="registro.empresaccosto" value="S" >{{form_empresaccosto581}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaservicios">{{form_empresaservicios}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaservicios" ng-model="registro.empresaservicios" value="N" >{{form_empresaservicios590}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaservicios" ng-model="registro.empresaservicios" value="S" >{{form_empresaservicios591}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturaNota">{{form_empresafacturaNota}}</label>
                   <div class="col-md-6">
                    <textarea rows="4" cols="50" class="form-control mitexto" 
                        id="empresafacturaNota" name="empresafacturaNota" 
                        ng-app=""ng-model="registro.empresafacturaNota" value="{{registro.empresafacturaNota}}">                           
                    </textarea>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturaresDIAN">{{form_empresafacturaresDIAN}}</label>
                   <div class="col-md-6">
                    <textarea rows="4" cols="50" class="form-control mitexto" 
                        id="empresafacturaresDIAN" name="empresafacturaresDIAN" 
                        ng-app=""ng-model="registro.empresafacturaresDIAN" value="{{registro.empresafacturaresDIAN}}">                           
                    </textarea>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturaNumeracion">{{form_empresafacturaNumeracion}}</label>
                   <div class="col-md-6">
                    <textarea rows="4" cols="50" class="form-control mitexto" 
                        id="empresafacturaNumeracion" name="empresafacturaNumeracion" 
                        ng-app=""ng-model="registro.empresafacturaNumeracion" value="{{registro.empresafacturaNumeracion}}">                           
                    </textarea>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturanotaiva">{{form_empresafacturanotaiva}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturanotaiva" name="empresafacturanotaiva"
                         ng-model="registro.empresafacturanotaiva" required Placeholder="{{form_Phempresafacturanotaiva}}" 
                         value="{{registro.empresafacturanotaiva}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturanotaica">{{form_empresafacturanotaica}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturanotaica" name="empresafacturanotaica"
                         ng-model="registro.empresafacturanotaica" required Placeholder="{{form_Phempresafacturanotaica}}" 
                         value="{{registro.empresafacturanotaica}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturactacxc">{{form_empresafacturactacxc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturactacxc" name="empresafacturactacxc"
                         ng-model="registro.empresafacturactacxc" required Placeholder="{{form_Phempresafacturactacxc}}" 
                         value="{{registro.empresafacturactacxc}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturactaivta">{{form_empresafacturactaivta}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturactaivta" name="empresafacturactaivta"
                         ng-model="registro.empresafacturactaivta" required Placeholder="{{form_Phempresafacturactaivta}}" 
                         value="{{registro.empresafacturactaivta}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturactaica">{{form_empresafacturactaica}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturactaica" name="empresafacturactaica"
                         ng-model="registro.empresafacturactaica" required Placeholder="{{form_Phempresafacturactaica}}" 
                         value="{{registro.empresafacturactaica}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresafacturactaiva">{{form_empresafacturactaiva}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresafacturactaiva" name="empresafacturactaiva"
                         ng-model="registro.empresafacturactaiva" required Placeholder="{{form_Phempresafacturactaiva}}" 
                         value="{{registro.empresafacturactaiva}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRegimen">{{form_empresaRegimen}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaRegimen" ng-model="registro.empresaRegimen" value="C" >{{form_empresaRegimen690}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaRegimen" ng-model="registro.empresaRegimen" value="S" >{{form_empresaRegimen691}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaporcentajeiva">{{form_empresaporcentajeiva}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaporcentajeiva" name="empresaporcentajeiva"
                         ng-model="registro.empresaporcentajeiva" required Placeholder="{{form_Phempresaporcentajeiva}}" 
                         value="{{registro.empresaporcentajeiva}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPrefijo">{{form_empresaPrefijo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPrefijo" name="empresaPrefijo"
                         ng-model="registro.empresaPrefijo" required Placeholder="" 
                         value="{{registro.empresaPrefijo}}" />
                    </div>
                </div>                 
                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
 
                </div>       
                <div style='display: none'>
                <input type="text"	 ng-model="registro.empresaId" id ='empresaId'  name ='empresaId' value="{{registro.empresaId}}"/>

   
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
            <!-- Table to show employee detalis -->
            <!--div class="table-responsive">
                <table class="table table-hover tablex">
                    <tr>
                        <th>ID</th>
                        <th>CLAVE</th>
                        <th>NOMBRE</th>
                        <th>NIT</th>
                        <th>DIGITO</th>
                        <th>DIRECCION</th>
                        <th>CIUDAD</th>
                        <th>TELEFONOS</th>
                        <th>FCH CREACION</th>
                        <th>FCH MODIFICA</th>
                        <th>FCH VIGENCIA</th>
                        <th>PERIODO</th>
                        <th>CUENTA TWITER</th>
                        <th>CUENTA FACEBOOK</th>
                        <th>PAGINA WEB</th>
                        <th>CUENTA CORREO</th>
                        <th>ACTIVA</th>
                        <th>PRTO_EMAIL</th>
                        <th>REPREENTANTE LEGAL</th>
                        <th>CEDULA REPREENTANTE</th>
                        <th>CONTADOR</th>
                        <th>MATRICULA CONTADOR</th>
                        <th>CEDULA CONTADOR</th>
                        <th>REVISOR FISCAL</th>
                        <th>MATRICULA REVISOR</th>
                        <th>CEDULA REVISOR</th>
                        <th>ANO FISCAL</th>
                        <th>ESTRUCTURA</th>
                        <th>ADMINISTRADOR</th>
                        <th>CEDULA ADMON</th>
                        <th>SECRETARIA</th>
                        <th>CEDULA SECRETARIA</th>
                        <th>MENSAJE 1</th>
                        <th>MENSAJE 2</th>
                        <th>PERIODO FACTURA</th>
                        <th>PERIODO CERRADO</th>
                        <th>COMPR FACTURA</th>
                        <th>COMPR RCAJA</th>
                        <th>COMPR AJUSTES</th>
                        <th>COMPEGRESO</th>
                        <th>COMPCIERREMES</th>
                        <th>COMPAPERTURA</th>
                        <th>CUENTACIERRE</th>
                        <th>CUENTA CAJA</th>
                        <th>MORA PORC</th>
                        <th>MORA EN PESOS</th>
                        <th>MORA DIAS</th>
                        <th>DESCNTO PORC</th>
                        <th>DESCNTO PESOS</th>
                        <th>DESCNTO DIAS</th>
                        <th>PAGOS PARCIALES</th>
                        <th>PERIODOS ANUALES</th>
                        <th>REDONDEO</th>
                        <th>CONSEC RCAJA</th>
                        <th>CONSEC FACTURA</th>
                        <th>IDIOMA</th>
                        <th>NROINMUEBLES</th>
                        <th>LOGO</th>
                        <th>CCOSTO</th>
                        <th>SERVICIOS</th>
                        <th>FACTURANOTA</th>
                        <th>FACTURARESDIAN</th>
                        <th>FACTURANUMERACION</th>
                        <th>FACTURANOTAIVA</th>
                        <th>FACTURANOTAICA</th>
                        <th>FACTURACTACXC</th>
                        <th>FACTURACTAIVTA</th>
                        <th>FACTURACTAICA</th>
                        <th>FACTURACTAIVA</th>
                        <th>REGIMEN</th>
                        <th>PORCENTAJEIVA</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                    <td>{{detail.empresaId}}</td>
                    <td>{{detail.empresaClave}}</td>
                    <td>{{detail.empresaNombre}}</td>
                    <td>{{detail.empresaNit}}</td>
                    <td>{{detail.empresaDigito}}</td>
                    <td>{{detail.empresaDireccion}}</td>
                    <td>{{detail.empresaCiudad}}</td>
                    <td>{{detail.empresaTelefonos}}</td>
                    <td>{{detail.empresaFchCreacion}}</td>
                    <td>{{detail.empresaFchModificacion}}</td>
                    <td>{{detail.empresaFchVigencia}}</td>
                    <td>{{detail.empresaPeriodoActual}}</td>
                    <td>{{detail.empresaTwiter}}</td>
                    <td>{{detail.empresaFacebook}}</td>
                    <td>{{detail.empresaWeb}}</td>
                    <td>{{detail.empresaEmail}}</td>
                    <td>{{detail.empresaActiva}}</td>
                    <td>{{detail.empresaPuertoCorreo}}</td>
                    <td>{{detail.empresaRepresentante}}</td>
                    <td>{{detail.empresaIdentifRepresentante}}</td>
                    <td>{{detail.empresaContador}}</td>
                    <td>{{detail.empresaMatriculaContador}}</td>
                    <td>{{detail.empresaIdentifContador}}</td>
                    <td>{{detail.empresaRevisor}}</td>
                    <td>{{detail.empresaMatriculaRevisor}}</td>
                    <td>{{detail.empresaIdentifRevisor}}</td>
                    <td>{{detail.empresaAnoFiscal}}</td>
                    <td>{{detail.empresaEstructura}}</td>
                    <td>{{detail.empresaAdministrador}}</td>
                    <td>{{detail.empresaAdministradorCed}}</td>
                    <td>{{detail.empresaSecretaria}}</td>
                    <td>{{detail.empresaSecretariaCedula}}</td>
                    <td>{{detail.empresaMensaje1}}</td>
                    <td>{{detail.empresaMensaje2}}</td>
                    <td>{{detail.empresaPeriodoFactura}}</td>
                    <td>{{detail.empresaPeriCierreFactura}}</td>
                    <td>{{detail.empresaCompFra}}</td>
                    <td>{{detail.empresaCompRcaja}}</td>
                    <td>{{detail.empresaCompAjustes}}</td>
                    <td>{{detail.empresaCompEgreso}}</td>
                    <td>{{detail.empresaCompCierreMes}}</td>
                    <td>{{detail.empresaCompApertura}}</td>
                    <td>{{detail.empresaCuentaCierre}}</td>
                    <td>{{detail.empresaCuentaCaja}}</td>
                    <td>{{detail.empresaRecargoPorc}}</td>
                    <td>{{detail.empresaRecargoPesos}}</td>
                    <td>{{detail.empresaRecargoDias}}</td>
                    <td>{{detail.empresaDescPorc}}</td>
                    <td>{{detail.empresaDescPesos}}</td>
                    <td>{{detail.empresaDescDias}}</td>
                    <td>{{detail.empresaPagosParciales}}</td>
                    <td>{{detail.empresaPeriodosAnuales}}</td>
                    <td>{{detail.empresaFactorRedondeo}}</td>
                    <td>{{detail.empresaConsecRcaja}}</td>
                    <td>{{detail.empresaConsecFactura}}</td>
                    <td>{{detail.empresaIdioma}}</td>
                    <td>{{detail.empresaNroInmuebles}}</td>
                    <td>{{detail.empresaLogo}}</td>
                    <td>{{detail.empresaccosto}}</td>
                    <td>{{detail.empresaservicios}}</td>
                    <td>{{detail.empresafacturaNota}}</td>
                    <td>{{detail.empresafacturaresDIAN}}</td>
                    <td>{{detail.empresafacturaNumeracion}}</td>
                    <td>{{detail.empresafacturanotaiva}}</td>
                    <td>{{detail.empresafacturanotaica}}</td>
                    <td>{{detail.empresafacturactacxc}}</td>
                    <td>{{detail.empresafacturactaivta}}</td>
                    <td>{{detail.empresafacturactaica}}</td>
                    <td>{{detail.empresafacturactaiva}}</td>
                    <td>{{detail.empresaRegimen}}</td>
                    <td>{{detail.empresaporcentajeiva}}</td>
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
            </div-->
        </div>
</div>


<script src="controller/ctrls/contaempresas.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 7:25:07   <<<<<<< -->
