<html class="no-js"> <!--<![endif]-->
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MutiHouse</title>
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="app/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/AdminLTE.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/mm.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/icomoon.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/style.css" rel="stylesheet" type="text/css"/>        
        <script src="app/js/modernizr-2.6.2.min.js" type="text/javascript"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini"   ng-app="app" >
	<div id='inicio' class="box-wrap"  ng-controller="mainController">
            <header role="banner" id="fh5co-header">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fh5co-navbar-brand">
                                    <a class="fh5co-logo" href="http://www.aortizc.com">
                                   <img src="app/img/logo.png"  width="100" height="50" alt=""/></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav text-center">
                                    <li class="active"><a href="app/login.php"><span>{{form_mnu0}}</span></a></li>							
                                    <li><a href="#contacteme">{{form_title}}</a></li>
                                    <li><a href="#acercade">{{form_mnu1}}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="social">
                                    <li><a href="https://www.facebook.com/fb.me/multimeeting" alt="facebook" title="facebook"><i class="icon-facebook"></i></a></li>
                                    <li><a href="https://aortizc.blogspot.com/" alt="BlogSpot"  title="Blog"><i class="icon-bookmark"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
		<!-- END: header -->
            <div class="container">              
		<section id="intro">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                                <div class="intro animate-box text-center">
                                    <h2>{{tit01}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-lg-6 col-lg-offset-2 col-md-2 col-md-offset-2">
                             
                            </div>          
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 text-justify">
                                    <p>{{tit02}}</p>
                                    <p>{{tit03}}</p>
                                    <p>{{tit04}}</p>
                                    <p>{{tit05}}</p>
                                    <p>{{tit06}}</p>
                                    <p>{{tit07}}</p>
                                    <p>{{tit08}}</p>
                                    <p>{{tit09}}</p>
                                    <p>{{tit10}}</p>
                                    <p>{{tit11}}</p>
                                    <p>{{tit12}}</p>
                                    <p>{{tit03}}</p>						
                                </div>						
                            </div>
                        </div>	
                    </div>
                    <a href="#inicio"><i class="icon-level-up fa-refresh">{{alinicio}}</i></a>
                </section>

		<section id="contacteme">                    

                    <div class="container " >
                        <h3 class="text-left">{{form_title}}</h3>
                        <h4>{{form_subtitle}}</h4>
                    </div>
                    <section id="intro">
        
            <div class="container">
                <div class="col-md-8 col-md-offset-1 animate-box">
                    <form class="form-horizontal alert alert-mm color-palette-set" name="contactForm" id="contactForm"
                        ng-submit="insertInfo(registroMail);" >
                            <div class="form-group row">
                                <div class="col-md-6 field">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" ng-model="registroMail.nombre" required="">
                                </div>

                                <div class="col-md-6 field">
                                        <label for="tema">tema</label>
                                        <input type="text" name="tema" id="tema" class="form-control"  ng-model="registroMail.tema" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 field">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" ng-model="registroMail.email" required="">
                                </div>
                                <div class="col-md-6 field">
                                        <label for="phone">Celular</label>
                                        <input type="text" name="celular" id="celular" class="form-control"  ng-model="registroMail.celular" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 field">
                                        <label for="message">Mensaje</label>
                                        <textarea name="message" id="message" cols="30" rows="08" class="form-control"  ng-model="registroMail.message" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 field">                                           
                                        <input type="submit" id="submit_btn" class="btn btn-primary" ng-click="sendMail(registroMail)" value={{form_btnEnvia}}>
                                        <input type="button"class="btn btn-primary" ng-click="reset()" value={{form_btnBorra}}>
                                </div>                            
                                <div class="col-md-6 field" ng-show="retorno">
                                    <input type="text" name="retorno" id="retorno" class="form-control"  ng-model="registroMail.retorno" readonly="yes" value="{{registroMail.retorno}}">
                                </div>
                            </div>
                    </form>
                </div>

            </div>
      
    </section>


 
                    
        </section>

            <section id="acercade">
                    <div class="container">
                            <section id="intro">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                                                <div class="intro animate-box">
                                                    <h1>Acerca de nosotros</h1>
                                                    <h4>AORTIZC es una empresa dedicada al desarrollo y asesoria en procesos de informática</h4>

                                                </div>							

                                                <div class="col-md-12 section-heading text-center">
                                                    <h4>Sistemas de información disponibles para descarga y pruebas</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 col-md-offset-3 subtext">
                                                                <p></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-10">
                                                    <div class="post animate-box">
                                                            <a href="#"><img src="app/img/logoMM.jpg" alt="MultiMeeting"></a>
                                                            <div>									
                                                                <p><strong>Sistema que permite la agenda y seguimiento de reuniones</strong></p> 
                                                                <p>Permite llevar un inventario de comités o juntas y sitios donde se reunen, hacer el agendamiento de la reunión enviando la sitación con los temas a tratar y sus invitados. 
                                                                    Durante el desarrollo de la reunión se pueden llevar las anotaciones de los temas tratados, dejar pendientes, hacer seguimiento de éstos. Lleva la minuta o acta de la reunión y sus anexos </p>
                                                            </div>
                                                    </div>
                                            </div>	


                                            <div class="col-md-10">
                                                    <div class="post animate-box">
                                                            <a href="#"><img src="app/img/calibra.png" alt="Calibración"></a>
                                                            <div>									
                                                                <p><strong>Sistema de control y seguimiento para el mantenimiento de maquinaria y equipos</strong></p>
                                                            <p>Esta APP está diseñada para empresas que ofrecen mantenimiento de maquinaria o equipos, permite su ingreso, genera orden de servico, requerimeintos de repuestos, control de repuestos, facturación y entrega del elemento. Por medio del flujo de trabajo el cliente puede hacerle seguimiento al estado de su equipo. Puede integrar datos a la contabilidad <strong>
                                                            </stromg>. La APP está en desarrollo</p>
                                                            </div>
                                                    </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div><a href="#inicio"><i class="icon-level-up fa-refresh">{{alinicio}}</i></a></div>
                            </section>

                    </div>
            </section>
</div>
            <footer id="footer" role="contentinfo">
                    <div class="container">
                            <div class="row">
                                    <div class="col-md-12 text-center ">
                                            <div class="footer-widget border">
                                                    <p class="pull-left"><small>&copy; AortizC. 2018, 2020, 2022 - Derechos reservados</small></p>
                                                    <p class="pull-right"> 
                                                        <a class="fh5co-logo" href="https://www.aortizc.com"><img src="app/img/logoChiq.png"  width="80" height="30" alt=""/></a>

                                            </div>
                                    </div>
                            </div>
                    </div>
            </footer>
                
	</div>
	<!-- END: box-wrap -->
        
        <script src="app/js/jQuery-2.2.0.min.js" type="text/javascript"></script>
        <script src="app/js/angular.min.js" type="text/javascript"></script>
      
	<script src="app/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="app/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="app/js/jquery.waypoints.min.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="app/js/main.js"></script>
        
        <script src="app/controller/ctrls/contacontactoIni.ctrl.js" type="text/javascript"></script>
	</body>
</html>


