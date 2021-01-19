<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin contanotascont</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
 <!-- <link href="../css/atom.css" rel="stylesheet" type="text/css"/> -->
</head>
<body class="hold-transition skin-blue sidebar-mini"   ng-app="app" >

    <div class="container "  ng-controller="mainController">
        <h3 class="text-left">{{form_title}}</h3>
        <nav class="navbar navbar-default navbar-mm col-md-8 col-md-offset-1">
            <div class="navbar-header">
                <div class="alert alert-default navbar-brand search-box">
                    <button class="btn btn-primary btn-xs" ng-show="show_form" 
                    ng-click="formToggle()">{{form_btnNuevo}}<span class="glyphicon" aria-hidden="true"></span></button>
                    <button class='btn btn-primary btn-xs'
                    ng-click='exporta()'>{{form_btnExcel}}</button>
                </div>
                <div class="alert alert-default input-group search-box">
                    <span class="input-group-btn">
                        <input type="text" class="form-control mitexto busca-mm" placeholder="{{form_Phbusca}}" ng-model="search_query" required>
                    </span>
                </div>
            </div>
        </nav>
        <div class="col-md-8 col-md-offset-1">

            <form class="form-horizontal alert alert-mm color-palette-set" name="formato" id="idForm"
                  ng-submit="insertInfo(registro);" hidden="">

   

                <div style='display: none'>
                    <label class="control-label milabel col-md-4" for="notaempresa">{{form_notaempresa}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="notaempresa" name="notaempresa"
                         ng-model="registro.notaempresa" required Placeholder="{{form_Phnotaempresa}}" 
                         value="{{registro.notaempresa}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="notareporte">{{form_notareporte}}</label>
                    <div class="col-md-6">
                    <select id='notareporte' name='notareporte' ng-model='registro.notareporte' >
                     <option ng-repeat='operator0 in operators0' value = " {{operator0.tipoCodigo}}">{{operator0.tipoDetalle}}</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="notacodigo">{{form_notacodigo}}</label>
                   <div class="col-md-6">
                    <input type="text" class="form-control mitexto" id="notacodigo" name="notacodigo"
                         ng-model="registro.notacodigo" required Placeholder="{{form_Phnotacodigo}}" 
                         value="{{registro.notacodigo}}" />
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label milabel col-md-4" for="notadetalle">{{form_notadetalle}}</label>
                   <div class="col-md-6">
                    <textarea  class="form-control mitexto"  cols="80" rows="6" id="notadetalle" name="notadetalle"
                         ng-model="registro.notadetalle" required Placeholder="{{form_Phnotadetalle}}" 
                         value="{{registro.notadetalle}}">
                    </textarea>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="col-md-5">
                        <button type="button" value="Actualizar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="updateInfo(registro)" id="send_btnAc">{{form_btnActualiza}}</button>
                     </div>  
                    <div class="col-md-1">
                        <button type="button" value="Cerrar" class="btn btn-custom pull-right btn-xs" 
                                 ng-click="clearInfo(registro)" 
                                 id="send_btnCe">{{form_btnAnula}}</button> 
                    </div>
                </div>       
                <div style='display: none'>
                <input type="text"	 ng-model="registro.notaid" id ='notaid'  name ='notaid' value="{{registro.notaid}}"/>

   
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
<!--                        <th>ID</th>
                        <th>EMPRESA</th>-->
                        <th>REPORTE</th>
                        <th>CODIGO</th>
                        <th>DETALLE</th>
                    </tr>
                   
                    <tr ng-repeat="detail in details | filter:search_query | startFromGrid: currentPage * pageSize | limitTo: pageSize">
<!--                    <td>{{detail.notaid}}</td>
                    <td>{{detail.notaempresa}}</td>-->
                    <td>{{detail.notareporte}}</td>
                    <td>{{detail.notacodigo}}</td>
                    <td>{{detail.notadetalle}}</td>
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
            </div>
        </div>
</div>

</body>

<script src="controller/ctrls/contanotascont.ctrl.js" type="text/javascript"></script>
	 

</html>
<!-- >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 05, 2021 12:29:20   <<<<<<< -->
