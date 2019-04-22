<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
else{
 $start="Location:login.php?err=e&s=no session";  
 header($start);  
}
 
 header('Content-Type: text/html; charset=utf-8');
 if(isset($_SESSION['mm'])) {
    $datos = explode('||',$_SESSION['mm']);
 } else {
    echo ('error en autenticacion');
    $start="Location:login.php?err=e&s=NoHay-Session_mm";
    header($start);  
} 

$op='ini';
$e=$datos[4];   // empresa Id
$u=$datos[3];   // usuario id
$pf=$datos[1];   // perfil
$tp=$datos[2];  // tipo acceso
$cr=$datos[7];  // conjunto residencial
$ctrl=$datos[9];  // conjunto residencial
$avatar = 'photo/'.$datos[6]; // avatar
$logo = 'reports/images/'.$datos[8]; // logo empresa
$idioma="lenguage".$datos[10].".php";
include_once 'inc/'.$idioma;

if (!isset($_GET['op'])){
    $op='ini';
 }
 else {
  $op=$_GET['op']; 
}

 $nodo = '';
 $subNodo='';

 function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>multiMeeting</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="css/AdminLTE.css" rel="stylesheet" type="text/css"/>
  <link href="css/_all-skins.min.css" rel="stylesheet" type="text/css"/>
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="css/mm.css" rel="stylesheet" type="text/css"/>
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>

<!-- para el tab -->  
    <link href="css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/angular.css" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition skin-blue sidebar-mini"   ng-app="app" >
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>enú</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Multi</b>Meeting</span>
      <img  src=<?php echo $logo ?> alt="Logo"/>
    </a>
    <!-- Header Navbar: style can be found in header.less  --> 
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
    
      <div id='titbar' class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="usuario();">
              <img id='my_image' src="<?php echo $avatar ?>" class="user-image" alt="User Image">  
              <span id='my-name' class="hidden-xs"><?php echo $datos[0] ?></span>
            </a>  
          </li>
      
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
        <div  id='titulito'  class="input-group">
          
       
        </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo $datos[5] ?></li>
        <?php if ($pf=='A' OR $pf=='C'  OR $pf=='S'){
       echo ' <li class="treeview">
          <a href="mm.php?op=comit">
            <i class="fa fa-users"></i> <span>Comités</span> 
          </a>
        </li>
        <li class="treeview">
          <a href="mm.php?op=salon">
            <i class="fa fa-building"></i> <span>Salones</span> 
          </a>
        </li> ' ;    
        }
        ?>
        <?php if ($pf=='A'  OR $pf=='S'){            
        echo '     
        <li class="treeview">
          <a href="#">
            <i class="fa fa-commenting"></i>
            <span>Agenda</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu"> 
              <li><a href="mm.php?op=agReu"><i class="fa fa-map-o"></i>Agenda Reunión</a></li>                      
              <li><a href="mm.php?op=agAsi"><i class="fa fa-user-plus"></i>Asistentes recurrentes</a></li>
              <li><a href="mm.php?op=agTma"><i class="fa fa-book"></i>Temas recurrentes</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Desarrollo de la reunión</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="mm.php?op=agSgmnto"><i class="fa fa-circle-o"></i>Agenda a seguir</a></li>
            <li><a href="mm.php?op=loadActa"><i class="fa fa-upload"></i>Carga documentos</a></li>
            <li><a href="mm.php?op=agActas"><i class="fa fa-pencil"></i>Acta de reunión</a></li>
           
          </ul>
        </li>
        ';
             }
        ?>
       
        <li class="treeview">
          <a href="mm.php?op=cnslta">
            <i class="fa fa-edit"></i> <span>Consultas</span> 
          </a>
        </li>
        
 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-institution"></i>
            <span>Administración</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="mm.php?op=empr"><i class="fa fa-crosshairs"></i> <span>La empresa</span></a></li>
            <li><a href="mm.php?op=users"><i class="fa fa-user"></i> <span>Usuarios</span></a></a></li>
            <li><a href="mm.php?op=logo"><i class="fa fa-child"></i> <span> Logo Avatar</span></a></li>
          </ul>
        </li>  
        
        <?php
        if($cr=='S'){
            echo '<li class="treeview">
                    <a href="#">
                        <i class="fa fa-building-o "></i>
            <span>Conjunto Residencial</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="mm.php?op=udr"><i class="fa fa-building"></i> <span>Unidades residenciales</span></a></li>
            <li><a href="mm.php?op=impo"><i class="fa fa-file-excel-o"></i> <span>Cragar desde Excel</span></a></li>
            <li><a href="mm.php?op=lst"><i class="fa fa-calculator"></i> <span>Lista de asistencia</span></a></a></li>
          </ul>
        </li> ';
     
        }
        ?>
   
        <li class="treeview">
          <a href="#">
            <i class="fa fa-coffee"></i>
            <span>Ayudas</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="mm.php?op=Docum"><i class="fa fa-circle-o text-red"></i> <span>Documentación</span></a></li>
            <li><a href="mm.php?op=Versi"><i class="fa fa-circle-o text-yellow"></i> <span>versión</span></a></li>
            <li><a href="mm.php?op=contc"><i class="fa fa-circle-o text-aqua"></i> <span>Contáctenos</span></a></li>
          </ul>
        </li> 
  
      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  <script src="js/jQuery-2.2.0.min.js" type="text/javascript"></script>
  
  <script src="js/angular.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div id="popup" style="display: none;">
            <div class="content-popup" style="width: 450px; height: 300px; border: 2px; border-color: greenyellow">
                
                <div id="dialog"  class="wrapp">
                    <h3 class="textos"><?php echo $ztmm01 ?></h3>
                    <form>
                        <table class="tablex">
                            <tr>
                                <td>Nombre</td>
                                <td><input type='text' readonly="yes" id='user_nombre' value='<?php echo $datos[0];?>'></td>
                            </tr>
                            <tr>
                                <td>Contraseña actual</td>
                                <td><input type='password' id='user_contraAhora' ></td> 
                            </tr> 
                                <td>Nueva contraseña</td>
                                <td><input type='password' id='user_contraNueva'></td>
                            </tr> 
                                <td>Repite nva Contraseña</td>
                                <td><input type='password' id='user_contraNuevaRep'></td>
                            </tr> 
                            <tr><td colspan="2"><a href="#" class="textos" id="close">Aceptar  <img src="img/aceptar.png" alt="Aceptar"/></a>
                            </td>
                            </tr>

                        </table>
                    </form>
                </div> 
            </div>
        </div>
  
        <?php

        
        if ($op ==  'agActas'){
            include_once 'views/frm_mm_actas.php';
        }
        
        if ($op ==  'agSgmnto'){
            include_once 'views/frm_mm_AgendaSegumiento.php';
        }
         if ($op ==  'emprnew'){
            include_once 'views/frm_mm_empresaNew.php';
        }       
        if ($op ==  'empr'){
            include_once 'views/frm_mm_empresa.php';
        }
        if ($op ==  'ini'){
            include_once 'views/frmInicio.php';
        }
        if ($op ==  'comit'){
            include_once 'views/frm_mm_comites.php';
        }
        if ($op ==  'contc'){
            include_once 'views/frm_mm_Contacto.php';
        }
        if ($op ==  'Versi'){
            include_once 'views/frm_mm_Version.php';
        }

        if ($op ==  'agTem'){
            include_once 'views/frm_mm_temasgrales.php';
        }
        		
        if ($op ==  'opagTem'){
            include_once 'views/frm_mm_temasgrales.php';
        }	

        if ($op == 'agSal'){
           include_once 'views/frm_mm_reservaSalon.php'; // Asigna salones views/frm_reservaSalon.php  
        }
        
        if ($op ==  'agAsi'){
            include_once 'views/frm_mm_asistentes.php';
        }	

        if ($op ==  'asiIn'){
            include_once 'views/frmPendiente.php';
        }
        
        if ($op ==  'agReu'){
            include_once 'views/frm_mm_Agendamiento.php';
        }			
	
        if ($op ==  'asiGr'){
            include_once 'views/frm_mm_asistentes.php';            // Agigna Grupos de invitados
        }
 
        if ($op ==  'agTma'){
            include_once 'views/frm_mm_temasgrales.php';            // Agigna Grupos de invitados
        }
        
        if ($op=='cnslta'){
            include_once 'views/frm_mm_consultas.php';
        }
        if ($op ==  'perfi'){
            include_once 'views/frm_datos.php';
        }
        if ($op ==  'salon'){
            include_once 'views/frm_mm_salones.php';
        }
        if ($op ==  'loadActa'){
            include_once 'views/frm_mm_agendaanexos.php';
        } 
        if ($op ==  'logo'){
            include_once 'views/frm_mm_loadLogos.php';
        }
        if ($op ==  'users'){
            include_once 'views/frm_mm_usuarios.php';
        }
        if ($op ==  'Docum'){
            include_once 'views/frm_mm_documentacion.php';
        } 
        
        if ($op ==  'udr'){
            include_once 'views/frm_mm_inmuebles.php';
        }
        if ($op ==  'impo'){
            include_once 'views/frm_mm_importaXls.php';
        }
        if ($op ==  'lst'){
            include_once 'views/frm_mm_llamalista.php';
        }
         if ($op ==  ''){
            include_once 'views/frm_mm_news.php';
        }      
        ?>
     

    </section>

  </div>
<div style='display: none'>
    <input type="text"  id ='e' value = '<?php echo $e ?> '>
    <input type="text"  id ='u' value = '<?php echo $u ?>' >
    <input type="text"  id ='p' value = '<?php echo $pf ?>' >
    <input type="text"  id ='ctrl' value = '<?php echo $ctrl ?>' >

</div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.2
    </div>
    <strong>Copyright &copy; 2016 <a href="http://atomingenieria.com">Atominge sas.</a> </strong> Derechos reservados
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->

<script src="js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="js/fastclick.js" type="text/javascript"></script>
<script src="js/app.min.js" type="text/javascript"></script>
<script src="js/demo.js" type="text/javascript"></script>
<script src="js/moment.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">        

function usuario(){
        $('#user_contraAhora').val('');
        $('#user_contraNueva').val('');  
        $('#user_contraNuevaRep').val('');
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        return false;
    }
   var err='';
    $('#close').click(function(){
        user_contraAhora  = $('#user_contraAhora').val();
        user_contraNueva  = $('#user_contraNueva').val();  
        user_contraNuevaRep  = $('#user_contraNuevaRep').val();
        user = $('#u').val();
     
        if(user_contraAhora!=''){
            if (user_contraNueva !='' && user_contraNuevaRep !=''){
                if(user_contraNueva!=user_contraNuevaRep)
                    {
                        err="Nuevas contraseñas no son iguales. Para salir deje en blanco la contraseña actual";
                    }
                    else
                    {
                        parametro = user_contraAhora+'||'+user_contraNueva+'||'+user_contraNuevaRep+'||'+user;
                           $.post("inc/opcGrales.php", {accion:'changePwd', condicion:parametro}, function(data){ 
                            
                            if (data.substr(0,5)=='Error'){
                                alert(data);
                                err=data; 
                            }
                           else
                            { 
                             alert('Contraseña cambiada exitosamente');
                             $('#popup').fadeOut('slow');
                             $('.popup-overlay').fadeOut('slow');
                            }
                         })                        
                    }
            }
        }
        else{
            $('#popup').fadeOut('slow');
            $('.popup-overlay').fadeOut('slow'); 
        }
        if (err!=""){
            alert(err);
        }

        return false;
    });
</script>




</body>
</html>

