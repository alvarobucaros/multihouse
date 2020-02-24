<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleMov}}</h3>

    
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormMv"
               ng-submit="insertInfo(registro);" >    
            <div class="col-md-8 col-md-offset-1" >
                <div class="form-group">
                    <label class="milabel col-md-4" for="periodoCtble">{{form_periodo}}</label>
                    <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                         ng-model="periodoCtble" value="{{periodoCtble}}" />
                    </div>
                </div> 
            </div>
 
            <div class="form-group" style='display: none'>
                <label class="milabel col-md-4" for="movicaEmpresaId">{{form_movicaEmpresaId}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="movicaEmpresaId" name="movicaEmpresaId"
                     ng-model="registro.movicaEmpresaId" required Placeholder="{{form_PhmovicaEmpresaId}}" 
                     value="{{registro.movicaEmpresaId}}" />
                </div>
            </div> 

            <div class="form-group">
                <label class="milabel col-md-4" for="movicaOperaId">{{form_movicaOperaId}}</label>
                <div class="col-md-6">
                <select id='movicaOperaId' name='movicaOperaId' ng-model='registro.movicaOperaId' 
                        ng-change="buscaComproTot(registro)">
                 <option ng-repeat='operator0 in operators0' value = " {{operator0.compId}}">{{operator0.compNombre}}</option>
                </select>
                </div>
            </div>
            <div ng-show="ventanaPpal">
                <div class="form-group">               
                   <div class="col-md-12">
                    <input type="text" class="form-control mitexto" id="detalleComp1" name="detalleComp1"
                         ng-model="detalleComp1"  />
                    </div>
                </div> 
                <div class="form-group">               
                   <div class="col-md-12">
                    <input type="text" class="form-control mitexto" id="detalleComp2" name="detalleComp2"
                         ng-model="detalleComp2"  />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="milabel col-md-3" for="movicaTerceroId">{{form_movicaTerceroId}}</label>
                    <div class="col-md-6">
                    <select id='movicaTerceroId' name='movicaTerceroId' ng-model='registro.movicaTerceroId' >
                     <option ng-repeat='operator1 in operators1' value = " {{operator1.terceroId}}">{{operator1.terceroNombre}}</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">               
                   <div class="col-md-12">
                    <label class="milabel col-md-6" for="movicaTerceroId">Cuenta</label>
                    <label class="milabel col-md-3" for="movicaTerceroId">Debitos</label>
                    <label class="milabel col-md-3" for="movicaTerceroId">Creditos</label>
                    </div> 
                </div>
                <div class="form-group" ng-show="cta1">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta1" style="width: 300" name="nomCuenta1"
                               readonly="yes" ng-model="nomCuenta1" />
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb1" name="vlrDb1" align="right"
                           ng-model="vlrDb1" value="" ng-blur="sumaDbCr()" /> 
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr1" name="vlrCr1" align="right"
                         ng-model="vlrCr1"  value="" ng-blur="sumaDbCr()"/>
                    </div>
                </div>  
                
                <div class="form-group" ng-show="cta2">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta2" style="width: 300" name="nomCuenta2" 
                         readonly="yes"  ng-model="nomCuenta2" />
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb2" name="vlrDb2" align="right"
                           ng-model="vlrDb2" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr2" name="vlrCr2" align="right"
                         ng-model="vlrCr2"  ng-blur="sumaDbCr()"/>
                    </div>                    
                </div> 
                <div class="form-group"  ng-show="cta3">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta3" style="width: 300" name="nomCuenta3" 
                               readonly="yes"  ng-model="nomCuenta3"  />
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb3" name="vlrDb3" align="right"
                           ng-model="vlrDb3" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr3" name="vlrCr3" align="right"
                         ng-model="vlrCr3"  ng-blur="sumaDbCr()"/>
                    </div>                     
                </div>  
                
                <div class="form-group" ng-show="cta4">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta4" style="width: 300" name="nomCuenta4"
                              readonly="yes"  ng-model="nomCuenta4"  />
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb4" name="vlrDb4" align="right"
                           ng-model="vlrDb4" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr4" name="vlrCr4" align="right"
                         ng-model="vlrCr4"  ng-blur="sumaDbCr()"/>
                    </div>                     
                </div> 
                <div class="form-group" ng-show="cta5">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta5" style="width: 300" name="nomCuenta5" 
                             readonly="yes"   ng-model="nomCuenta5"  />
                    </div> 
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb5" name="vlrDb5" align="right"
                           ng-model="vlrDb5" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr5" name="vlrCr5" align="right"
                         ng-model="vlrCr5"  ng-blur="sumaDbCr()"/>
                    </div>                      
                </div>  
                <div class="form-group" ng-show="cta6">
                    <div class="col-md-5">
                        <input type="text" class="mitexto" id="nomCuenta6" style="width: 300" name="nomCuenta6" 
                             readonly="yes"   ng-model="nomCuenta6"   />
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb6" name="vlrDb6" align="right"
                           ng-model="vlrDb6" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr6" name="vlrCr6" align="right"
                         ng-model="vlrCr6"  ng-blur="sumaDbCr()"/>
                    </div>                      
                </div>                  
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <label class="milabel col-md-6"  for="movicaTerceroId">Total</label>
                        <input type="text" class="mitexto" id="vlrTotal" name="vlrTotal"  align="right"
                         ng-model="vlrTotal"  />

                    </div> 
                    <div class="col-md-2">
                         <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>                       
                    </div>
                </div> 
            </div>
            
        </form>
        <div style='display: none'
            <input type="text" ng-model="registro.movicaId" id ='movicaId'  name ='movicaId' value="{{registro.movicaId}}"/>
            <input type="text" ng-model="control" id ='control'  name ='control' value="M"/>
            <input type="text" ng-model="comprobante" id ='comprobante'  name ='comprobante' />
            <input type="text" ng-model="secuencia" id ='secuencia'  name ='secuencia' />
        </div>
    </div>

</div>


<script src="js/ui-bootstrap-tpls-0.11.0.js" type="text/javascript"></script>
<script src="controller/ctrls/contamovicabeza.ctrl.js" type="text/javascript"></script>
<script src="controller/script.js" type="text/javascript"></script>

