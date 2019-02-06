
    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="uploadimage"  method="post" enctype="multipart/form-data"
                  ng-submit="insertInfo(registro);" >

                <div id="message"></div> 
                
                <div class="form-group">
                    <!--label class="control-label milabel col-md-4" for="asistente_titulo">{{form_asistente_titulo}}</label--> 
                    <div class="form-group">
                        <div class="btn-group  col-md-8">
                       <label>
                          <input type="radio" name ="logoAvatar" ng-model="registro.logoAvatar" 
                                  class="btn media-bottom" value="L" > {{form_miLogo}}
                       </label>
                       <img id='my_image' src="{{imgLogo}}" class="user-image" alt="Logo Empresa"> 
                        </div>
                    </div>  
                </div>
    
                 <div class="form-group">
                    <div class="form-group">
                        <div class="btn-group  col-md-8">
                       <label>
                          <input type="radio" name ="logoAvatar" ng-model="registro.logoAvatar" 
                                  class="btn media-bottom" value="A" > {{form_miAvatar}}
                       </label>
                         <img id='my_image' src="{{imgAvatar}}" class="user-image" alt="Avatar">   
                        </div>
                    </div> 
                </div>
                                 
                
                <div class="col-md-7">
                    <input type="file" name="file" id="file" accept=".jpg,.png" required ng-click="botonOk()">                       
                </div> 
                <div class="col-md-7" id = "btnCarga" ng-show="btnCarga">
                    <input type="submit" value='Carga Imágen' class="submit" ng-click="recarga()">
                </div>
                
                <div class="col-md-7">
<!--                    <input type="file" name="file" id="file" accept=".jpg,.png" required /> 
                    <input type="submit" value="Carga Imágen" class="submit" />-->
                    <div class="col-md-5"></div>
                </div> 
                <div id="divRuedita" ng-show="ruedita">                    
                       <img src="img/progress.gif" alt="">                   
                </div>
                     
                <div>
                     <p>{{nota}}</p>
                </div>    
                <div  ng-show="datosOcultos">
                    <input type="text" ng-model="dibujo" id ='dibujo'  name ='dibujo' value='{{dibujo}}'/>
                    <input type="text" ng-model="anno" id ='anno'  name ='anno' value='{{anno}}'/>
                </div> 
        </form>
    </div>
</div>


<script src="controller/mm_loadlogos.ctrl.js" type="text/javascript"></script>
<script src="controller/mm_cargas.ctrl.js" type="text/javascript"></script>



