<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleMov}}</h3>

    
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idFormMv"
               ng-submit="insertInfo(registro);" >    
       
                <div class="form-group">
                    <label class="milabel col-md-3" for="periodoCtble">{{form_periodo}}</label>
                    <div class="col-md-2">
                    <input type="text" class="form-control mitexto" id="periodoCtble" name="periodoCtble"
                         ng-model="periodoCtble" value="{{periodoCtble}}" />
                    </div>
                </div> 
                <div class="form-group">            
                    <label class="milabel col-md-3" for="fechaCtble">{{form_movicaFecha}}</label>
                    <div class="col-md-4">
                    <input type="date" width="12" class="form-control mitexto fa fa-calendar fa-lg" id="movicaFecha" name="movicaFecha"
                         ng-model="movicaFecha" value="{{fechaCtble}}" />
                    </div>
                </div> 
           
 
            <div class="form-group" style='display: none'>
                <label class="milabel col-md-3" for="movicaEmpresaId">{{form_movicaEmpresaId}}</label>
               <div class="col-md-6">
                <input type="text" class="form-control mitexto" id="movicaEmpresaId" name="movicaEmpresaId"
                     ng-model="registro.movicaEmpresaId" required Placeholder="{{form_PhmovicaEmpresaId}}" 
                     value="{{registro.movicaEmpresaId}}" />
                </div>
            </div> 

            <div class="form-group">
                <label class="milabel col-md-3" for="movicaOperaId">{{form_movicaOperaId}}</label>
                <div class="col-md-6">
                <select id='movicaOperaId' name='movicaOperaId' ng-model='registro.movicaOperaId' 
                        ng-change="buscaComproTot(registro)">
                 <option ng-repeat='operator0 in operators0' value = " {{operator0.compCodigo}}">{{operator0.compNombre}}</option>
                </select>
                </div>
            </div>
            <div ng-show="ventanaPpal">
                <div class="form-group">
                     <label class="milabel col-md-2" for="movicaOperaId">{{form_movicaComprId}}</label>
                   <div class="col-md-10">
                    <input type="text" class="form-control mitexto" id="detalleComp2" name="detalleComp2"
                           readonly="yes" ng-model="detalleComp2"  />
                    </div>
                </div> 
                <div class="form-group"> 
                    <label class="milabel col-md-2" for="movicaOperaId">{{form_movicaDetalle}}</label>
                    <div class="col-md-10">
                    <input type="text" class="form-control mitexto" id="detalleComp1" name="detalleComp1"
                         ng-model="detalleComp1"  />
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="milabel col-md-2" for="movicaTerceroId">{{form_movicaTerceroId}}</label>
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
                    <!--input type="text" class="mitexto" id="nomCuenta1" style="width: 300" name="nomCuenta1"
                               readonly="yes" ng-model="nomCuenta1" /-->
                    <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta1}}</label>
                    </div>
                  
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb1" name="vlrDb1" align="right"
                        style="text-align:right;" ng-model="vlrDb1" ng-blur="sumaDbCr()" /> 
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr1" name="vlrCr1" align="right"
                        style="text-align:right;" ng-model="vlrCr1" ng-blur="sumaDbCr()"/>
                    </div>
                </div>  
                
                <div class="form-group" ng-show="cta2">
                    <div class="col-md-5">
                       <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta2}}</label>
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb2" name="vlrDb2" align="right"
                        style="text-align:right;" ng-model="vlrDb2" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr2" name="vlrCr2" align="right"
                        style="text-align:right;" ng-model="vlrCr2"  ng-blur="sumaDbCr()"/>
                    </div>                    
                </div> 
                <div class="form-group"  ng-show="cta3">
                    <div class="col-md-5">
                        <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta3}}</label>
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb3" name="vlrDb3" align="right"
                        style="text-align:right;"   ng-model="vlrDb3" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr3" name="vlrCr3" align="right"
                        style="text-align:right;" ng-model="vlrCr3"  ng-blur="sumaDbCr()"/>
                    </div>                     
                </div>  
                
                <div class="form-group" ng-show="cta4">
                    <div class="col-md-5">
                       <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta4}}</label>
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb4" name="vlrDb4" align="right"
                         style="text-align:right;"  ng-model="vlrDb4" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr4" name="vlrCr4" align="right"
                        style="text-align:right;" ng-model="vlrCr4"  ng-blur="sumaDbCr()"/>
                    </div>                     
                </div> 
                <div class="form-group" ng-show="cta5">
                    <div class="col-md-5">
                       <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta5}}</label>
                    </div> 
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb5" name="vlrDb5" align="right"
                         style="text-align:right;"  ng-model="vlrDb5" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr5" name="vlrCr5" align="right"
                        style="text-align:right;" ng-model="vlrCr5"  ng-blur="sumaDbCr()"/>
                    </div>                      
                </div>  
                <div class="form-group" ng-show="cta6">
                    <div class="col-md-5">
                    <label class="milabel2" style="width: 300" for="vlrDb1">{{nomCuenta6}}</label>
                    </div>
                    <div class="col-md-3"> 
                    <input type="text" class="form-control mitexto" id="vlrDb6" name="vlrDb6" align="right"
                        style="text-align:right;"   ng-model="vlrDb6" ng-blur="sumaDbCr()"/>
                    </div>
                    <div class="col-md-3">
                    <input type="text" class="form-control mitexto" id="vlrCr6" name="vlrCr6" align="right"
                        style="text-align:right;" ng-model="vlrCr6"  ng-blur="sumaDbCr()"/>
                    </div>                      
                </div>                  
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <div>
                        <label class="milabel col-md-6"  for="movicaTerceroId">{{titTotal}}</label>
                        <input type="text" class="mitexto" id="vlrTotal" name="vlrTotal"  align="right"
                               readonly="yes" ng-model="vlrTotal"  /> 
                        </div>
                        <div class="col-md-2">
                             <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                     ng-click="updateInfoDigi(registro)" id="send_btnAc">{{form_btnActualiza}}</button>                       
                        </div>
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

