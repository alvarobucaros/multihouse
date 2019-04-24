<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mutimeeting</title>
        <link href="app/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/AdminLTE.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/mm.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/icomoon.css" rel="stylesheet" type="text/css"/>
        <link href="app/css/style.css" rel="stylesheet" type="text/css"/>        
        <script src="app/js/modernizr-2.6.2.min.js" type="text/javascript"></script>
	
	</head>
	<body class="hold-transition skin-blue sidebar-mini"   ng-app="app" >
	<div id='inicio' class="box-wrap">
            <header role="banner" id="fh5co-header">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fh5co-navbar-brand">
                                    <a class="fh5co-logo" href="http://www.atomingenieria.com">
                                    <img src="app/img/atomInv.PNG" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav text-center">
                                    <li class="active"><a href="app/login.php"><span>Mutimeeting</span></a></li>							
                                    <li><a href="#contacteme">Contáctenos</a></li>
                                    <li><a href="#acercade">Otros productos</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="social">
                                    <li><a href="https://www.facebook.com/fb.me/multimeeting"><i class="icon-facebook"></i></a></li>
                                    <li><a href="#"><i class="icon-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
		<!-- END: header -->
		<section id="intro">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
						<div class="intro animate-box text-center">
							<h2>Sistema para programación, control y seguimiento de reuniones</h2>
						</div>
					</div>
				</div>
                            <div class="container">
                                <div class="col-lg-6 col-lg-offset-2 col-md-2 col-md-offset-2">
                                    <img src="app/img/presentacion.png" alt=""/>
                                </div>          
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 text-justify">

                                                    <p>Para ingresar y probar la aplicación emplee</p><p> Usuario :   admin@com.co  Contraseña:  admin123</p>
<p>Con este sistema se puede llevar múltiples reuniones tales como: comités, juntas, contratos o cualquier tipo de reunión que amerite tener un seguimiento con su respectiva acta.</p>
<p>Incluye asistentes para la Programación de reuniones,  separación del salón donde se ha de llevar la reunión, preparación de los temas a tratar junto con los pendientes de reuniones anteriores,  agendamiento de asistente  e invitados especiales, a ellos  se les envía la notificación de invitación junto con  el temario vía correo electrónico y/o mensaje de texto al celular.</p>
                                           


<p>Durante el desarrollo de la reunión se puede llevar el acta de ésta, de tal manera que al final se puede revisar y aprobar, luego se imprime se firma por los asistentes y se carga por medio del asistente de administración de contenidos, todos los documentos soportes de la reunión tales como contratos, cotizaciones, cuadros, etc.  pueden ser digitalizados y cargados al sistema para luego ser consultados.</p>
<p>Con el asistente de seguimiento se puede hacer consulta a las actas, documentos digitalizados, realizar consultas temáticas y  el rastreo a las tareas que se han dejado para analizar su avance.</p>
<p>El sistema es seguro pues solo las personas autorizadas pueden acceder a la reunión que se les de este privilegio.</p>
<p>Por ser un ambiente de trabajo tipo WEB, la información estará disponible en cualquier sitio utilizando cualquier navegador, este es un sistema habilitado para ser utilizado en computadores o en dispositivos móviles.</p>
<p>El sistema viene en dos versiones: 123 que permite el trabajo de hasta tres reuniones de manera simultánea o el Plus que está habilitado para el uso de múltiples reuniones también de manera simultánea.</p>
<p>La APP 123 se puede descargar y utilizar solo debe incribirlo para tener acceso a las actualizaciones, se recomienda no olvidar su contribución económina para financiar sus desarrollos.</p>						
						
						
						
						</div>
						
					</div>
                            </div>	
			</div>
			<a href="#inicio"><i class="icon-level-up fa-refresh">{{alinicio}}</i></a>
		</section>

		<section id="contacteme">
                    <div class="container "  ng-controller="mainController">  
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
                                                        <label for="nombre">{{Nombre}}</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control" ng-model="registroMail.nombre" required="">
                                                </div>

                                                <div class="col-md-6 field">
                                                  
                                                        <label for="tema">{{tema}}</label>
                                                        <input type="text" name="tema" id="tema" class="form-control"  ng-model="registroMail.tema" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 field">
                                                        <label for="email">{{email}}</label>
                                                        <input type="text" name="email" id="email" class="form-control" ng-model="registroMail.email" required="">
                                                </div>
                                                <div class="col-md-6 field">
                                                        <label for="phone">{{celular}}</label>
                                                        <input type="text" name="celular" id="celular" class="form-control"  ng-model="registroMail.celular" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12 field">
                                                        <label for="message">{{mensaje}}</label>
                                                        <textarea name="message" id="message" cols="30" rows="08" class="form-control"  ng-model="registroMail.message" required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 field">                                           
                                                        <input type="submit" id="submit_btn" class="btn btn-primary" ng-click="sendMail(registroMail)" value={{form_btnEnvia}}>
                                                        <input type="button" class="btn btn-primary" ng-click="reset()" value={{form_btnBorra}}>
                                                </div>                            
                                                <div class="col-md-6 field" ng-show="retorno">
                                                    <input type="text" name="retorno" id="retorno" class="form-control"  ng-model="registroMail.retorno" readonly="yes" value="{{registroMail.retorno}}">
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div> 
                    <div><a href="#inicio"><i class="icon-level-up fa-refresh"></i></a></div>
		</section>

		<section id="acercade">
			<div class="container">
				<section id="intro">
					<div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                                                    <div class="intro animate-box">
                                                        <h1>Acerca de nosotros</h1>
                                                        <h4>Atomingenieria es una empresa dedicada al desarrollo y asesoria en procesos de informática</h4>
                                                       
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
                                                                <a href="#"><img src="app/img/conjunto.png" alt="Conjunto residencial"></a>
                                                                <div>									
                                                                    <p><strong>Administación de conjuntos residenciales, comerciales y de oficinas.</strong></p> 
                                                                    <p>Con esta App se puede llevar el inventario de las unidades residenciales de la propiedad horizontal, crear las expensas comunes,  genera cuentas de cobro, tener el control de las cuentas por cobrar, contabilizarlas y aplicar sus pagos, adewmàs tosa las demàs cuentas contables que genere el conjunto residencial, tambièn incluye un módulo para la creación y control del presupuesto.</p>
                                                                    
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

		<footer id="footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center ">
						<div class="footer-widget border">
							<p class="pull-left"><small>&copy; Atomingeniería sas. 2018 - Derechos reservados</small></p>
							<p class="pull-right"><small> Diseño de Atomingeniería sas</p>
							
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- END: box-wrap -->
        <script src="app/js/angular.min.js" type="text/javascript"></script>
	
	<!--  jQuery -->
        <script src="app/controller/min/mm_contacto.ctrl.min.js" type="text/javascript"></script>
        <script src="app/js/jQuery-2.2.0.min.js" type="text/javascript"></script>
	<!-- jQuery Easing -->
	<script src="app/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="app/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="app/js/jquery.waypoints.min.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="app/js/main.js"></script>
        
	</body>
</html>


