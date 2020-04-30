

    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_titleCont}}</h3>

        <div class="col-md-8 col-md-offset-1">
    
            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" >

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaContador">{{form_empresaContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaContador" name="empresaContador"
                         ng-model="registro.empresaContador" required Placeholder="{{form_PhempresaContador}}" 
                         value="{{registro.empresaContador}}" readonly="yes" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdentifContador">{{form_empresaIdentifContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaIdentifContador" name="empresaIdentifContador"
                         ng-model="registro.empresaIdentifContador"  value="{{registro.empresaIdentifContador}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMatriculaContador">{{form_empresaMatriculaContador}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMatriculaContador" name="empresaMatriculaContador"
                         ng-model="registro.empresaMatriculaContador" value="{{registro.empresaMatriculaContador}}" />
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRevisor">{{form_empresaRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRevisor" name="empresaRevisor"
                         ng-model="registro.empresaRevisor"  value="{{registro.empresaRevisor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaIdentifRevisor">{{form_empresaIdentifRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaIdentifRevisor" name="empresaIdentifRevisor"
                         ng-model="registro.empresaIdentifRevisor"  value="{{registro.empresaIdentifRevisor}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaMatriculaRevisor">{{form_empresaMatriculaRevisor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMatriculaRevisor" name="empresaMatriculaRevisor"
                         ng-model="registro.empresaMatriculaRevisor"  value="{{registro.empresaMatriculaRevisor}}" />
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
                    <label class="control-label milabel col-md-4" for="empresaEstructura">{{form_empresaEstructura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaEstructura" name="empresaEstructura"
                         ng-model="registro.empresaEstructura"  value="{{registro.empresaEstructura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaAnoFiscal">{{form_empresaAnoFiscal}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaAnoFiscal" name="empresaAnoFiscal"
                         ng-model="registro.empresaAnoFiscal"  value="{{registro.empresaAnoFiscal}}" />
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaPeriodoActual">{{form_empresaPeriodoActual}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodoActual" name="empresaPeriodoActual"
                         ng-model="registro.empresaPeriodoActual"  value="{{registro.empresaPeriodoActual}}" />
                    </div>
                </div>                

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompCierreMes">{{form_empresaCompCierreMes}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompCierreMes" name="empresaCompCierreMes"
                         ng-model="registro.empresaCompCierreMes" value="{{registro.empresaCompCierreMes}}" />
                    </div>
                </div> 
   
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCompApertura">{{form_empresaCompApertura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompApertura" name="empresaCompApertura"
                         ng-model="registro.empresaCompApertura"  value="{{registro.empresaCompApertura}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaCuentaCierre">{{form_empresaCuentaCierre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCuentaCierre" name="empresaCuentaCierre"
                         ng-model="registro.empresaCuentaCierre"  value="{{registro.empresaCuentaCierre}}" />
                    </div>
                </div> 


                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaMensaje1">{{form_empresaMensaje1}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMensaje1" name="empresaMensaje1"
                         ng-model="registro.empresaMensaje1" required Placeholder="{{form_PhempresaMensaje1}}" 
                         value="{{registro.empresaMensaje1}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaMensaje2">{{form_empresaMensaje2}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaMensaje2" name="empresaMensaje2"
                         ng-model="registro.empresaMensaje2" required Placeholder="{{form_PhempresaMensaje2}}" 
                         value="{{registro.empresaMensaje2}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaPeriodoFactura">{{form_empresaPeriodoFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodoFactura" name="empresaPeriodoFactura"
                         ng-model="registro.empresaPeriodoFactura" required Placeholder="{{form_PhempresaPeriodoFactura}}" 
                         value="{{registro.empresaPeriodoFactura}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaPeriCierreFactura">{{form_empresaPeriCierreFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriCierreFactura" name="empresaPeriCierreFactura"
                         ng-model="registro.empresaPeriCierreFactura" required Placeholder="{{form_PhempresaPeriCierreFactura}}" 
                         value="{{registro.empresaPeriCierreFactura}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompFra">{{form_empresaCompFra}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompFra" name="empresaCompFra"
                         ng-model="registro.empresaCompFra" required Placeholder="{{form_PhempresaCompFra}}" 
                         value="{{registro.empresaCompFra}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompRcaja">{{form_empresaCompRcaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompRcaja" name="empresaCompRcaja"
                         ng-model="registro.empresaCompRcaja" required Placeholder="{{form_PhempresaCompRcaja}}" 
                         value="{{registro.empresaCompRcaja}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompAjustes">{{form_empresaCompAjustes}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompAjustes" name="empresaCompAjustes"
                         ng-model="registro.empresaCompAjustes" required Placeholder="{{form_PhempresaCompAjustes}}" 
                         value="{{registro.empresaCompAjustes}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompEgreso">{{form_empresaCompEgreso}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompEgreso" name="empresaCompEgreso"
                         ng-model="registro.empresaCompEgreso" required Placeholder="{{form_PhempresaCompEgreso}}" 
                         value="{{registro.empresaCompEgreso}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompCierreMes">{{form_empresaCompCierreMes}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompCierreMes" name="empresaCompCierreMes"
                         ng-model="registro.empresaCompCierreMes" required Placeholder="{{form_PhempresaCompCierreMes}}" 
                         value="{{registro.empresaCompCierreMes}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCompApertura">{{form_empresaCompApertura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCompApertura" name="empresaCompApertura"
                         ng-model="registro.empresaCompApertura" required Placeholder="{{form_PhempresaCompApertura}}" 
                         value="{{registro.empresaCompApertura}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCuentaCierre">{{form_empresaCuentaCierre}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCuentaCierre" name="empresaCuentaCierre"
                         ng-model="registro.empresaCuentaCierre" required Placeholder="{{form_PhempresaCuentaCierre}}" 
                         value="{{registro.empresaCuentaCierre}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaCuentaCaja">{{form_empresaCuentaCaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaCuentaCaja" name="empresaCuentaCaja"
                         ng-model="registro.empresaCuentaCaja" required Placeholder="{{form_PhempresaCuentaCaja}}" 
                         value="{{registro.empresaCuentaCaja}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaRecargoPorc">{{form_empresaRecargoPorc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoPorc" name="empresaRecargoPorc"
                         ng-model="registro.empresaRecargoPorc" required Placeholder="{{form_PhempresaRecargoPorc}}" 
                         value="{{registro.empresaRecargoPorc}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaRecargoPesos">{{form_empresaRecargoPesos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoPesos" name="empresaRecargoPesos"
                         ng-model="registro.empresaRecargoPesos" required Placeholder="{{form_PhempresaRecargoPesos}}" 
                         value="{{registro.empresaRecargoPesos}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaRecargoDias">{{form_empresaRecargoDias}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaRecargoDias" name="empresaRecargoDias"
                         ng-model="registro.empresaRecargoDias" required Placeholder="{{form_PhempresaRecargoDias}}" 
                         value="{{registro.empresaRecargoDias}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaDescPorc">{{form_empresaDescPorc}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescPorc" name="empresaDescPorc"
                         ng-model="registro.empresaDescPorc" required Placeholder="{{form_PhempresaDescPorc}}" 
                         value="{{registro.empresaDescPorc}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaDescPesos">{{form_empresaDescPesos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescPesos" name="empresaDescPesos"
                         ng-model="registro.empresaDescPesos" required Placeholder="{{form_PhempresaDescPesos}}" 
                         value="{{registro.empresaDescPesos}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaDescDias">{{form_empresaDescDias}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaDescDias" name="empresaDescDias"
                         ng-model="registro.empresaDescDias" required Placeholder="{{form_PhempresaDescDias}}" 
                         value="{{registro.empresaDescDias}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
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

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaPeriodosAnuales">{{form_empresaPeriodosAnuales}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaPeriodosAnuales" name="empresaPeriodosAnuales"
                         ng-model="registro.empresaPeriodosAnuales" required Placeholder="{{form_PhempresaPeriodosAnuales}}" 
                         value="{{registro.empresaPeriodosAnuales}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaFactorRedondeo">{{form_empresaFactorRedondeo}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                    <select id='redondeo' name='redondeo' ng-model='registro.ServicioPrioridad' >
                     <option ng-repeat='redondeo in redondeo.availableOptions' value = " {{redondeo.tipo}}">{{redondeo.detalle}}</option>
                    </select>                        
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaConsecRcaja">{{form_empresaConsecRcaja}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaConsecRcaja" name="empresaConsecRcaja"
                         ng-model="registro.empresaConsecRcaja" required Placeholder="{{form_PhempresaConsecRcaja}}" 
                         value="{{registro.empresaConsecRcaja}}" />
                    </div>
                </div> 

                <div class="form-group" style='display: none'>
                    <label class="control-label milabel col-md-4" for="empresaConsecFactura">{{form_empresaConsecFactura}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="empresaConsecFactura" name="empresaConsecFactura"
                         ng-model="registro.empresaConsecFactura" required Placeholder="{{form_PhempresaConsecFactura}}" 
                         value="{{registro.empresaConsecFactura}}" />
                    </div>
                </div> 

                
                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRegimen">{{form_empresaProformaCon}}</label>
                    <div class="btn-group  col-md-4"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="empresaProformaCon" ng-model="registro.empresaProformaCon" value="N" >{{form_empresaProformaCon0}}
                   </label>
                   <label>
                      <input type="radio" name ="empresaProformaCon" ng-model="registro.empresaProformaCon" value="S" >{{form_empresaProformaCon1}}
                   </label>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="empresaRegimen">{{empresaProformaLimite}}</label>
                    <div class="btn-group  col-md-8"  data-toggle="buttons">
                   <label>{{empresaProformaLimiteSup}}
                       <input type="text"  class="form-control mitexto" ng-model="registro.empresaProformaLimSup" id ='empresaProformaLimSup'  name ='empresaProformaLimSup' />
                   </label>
                   <label>{{empresaProformaLimiteInf}} 
                       <input type="text"  class="form-control mitexto" ng-model="registro.empresaProformaLimInf" id ='empresaProformaLimInf'  name ='empresaProformaLimInf' />
                   </label>
                    </div>
                </div>                
           
  

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
 
                </div>       
                <div style='display: none'>
                <input type="text" ng-model="registro.empresaId" id ='empresaId'  name ='empresaId' value="{{registro.empresaId}}"/>
                <input type="text" ng-model="tipo" id ='empresaId'  name ='tipo' value="G"/>
   
                </div>
                <div id='miExcel' style='display: none'>
                </div> 
            </form>
	</div>
	<div class="clearfix"></div>
        <div class="col-md-10">
 
        </div>
</div>


<script src="controller/ctrls/contaempresas.ctrl.js" type="text/javascript"></script>
	 
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 7:25:07   <<<<<<< -->


