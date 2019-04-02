<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulario mm_instala</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="app/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="app/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
 <!-- <link href="../css/atom.css" rel="stylesheet" type="text/css"/> -->
</head>
<body class="hold-transition skin-blue sidebar-mini"   ng-app="app" >

    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="servidor">{{form_servidor}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="servidor" name="servidor"
                         ng-model="registro.servidor" required Placeholder="{{form_Phservidor}}" 
                         value="{{registro.servidor}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="basedatos">{{form_basedatos}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="basedatos" name="basedatos"
                         ng-model="registro.basedatos" required Placeholder="{{form_Phbasedatos}}" 
                         value="{{registro.basedatos}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="usuario">{{form_usuario}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="usuario" name="usuario"
                         ng-model="registro.usuario" required Placeholder="{{form_Phusuario}}" 
                         value="{{registro.usuario}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="password">{{form_password}}</label>
                   <div class="col-md-6">
                       <input type="password" class="form-control mitexto" id="password" name="password"
                         ng-model="registro.password" required Placeholder="{{form_Phpassword}}" 
                         value="{{registro.password}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="estado">{{form_estado}}</label>
                    <div class="btn-group  col-md-6"  data-toggle="buttons">
                   <label>
                      <input type="radio" name ="estado" ng-model="registro.estado" value="0" >{{form_estado50}}
                   </label>
                   <label>
                      <input type="radio" name ="estado" ng-model="registro.estado" value="1" >{{form_estado51}}
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
                <input type="text"	 ng-model="registro.id" id ='id'  name ='id' value="{{registro.id}}"/>

   
                </div>
                <div id='procesa' ng-show="procesa">
                    
                    <img src="app/img/progress.gif" alt=""/>
                </div> 
                <div id='nota' style='display: block'>
                </div> 
            </form>
	</div>
</div>

</body>
<script src="app/js/jQuery-2.2.0.min.js" type="text/javascript"></script>
<script src="app/js/bootstrap.js" type="text/javascript"></script>
<script src="app/js/angular-script.js" type="text/javascript"></script>

<script src="app/js/angular.min.js" type="text/javascript"></script>
<script src="app/controller/ctrl/mm_instala.ctrl.js" type="text/javascript"></script>
</html>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Nov 04, 2018 12:51:53   <<<<<<< -->
