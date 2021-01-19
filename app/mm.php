<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
else{
 $start="Location:login.php?err=e&s=no session";  
 header($start);  
}
 
 header('Content-Type: text/html; charset=utf-8');
 if(isset($_SESSION['mh'])) {
    $datos = explode('||',$_SESSION['mh']);
 } else {
    echo ('error en autenticacion');
    $start="Location:login.php?err=e&s=NoHay-Session_mh";
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
$idioma="lenguage".trim($datos[10]).".php";

include_once 'inc/'.$idioma;
$ztmh01=$ztmm01;
if (!isset($_GET['op'])){
    $op='ini';
 }
 else {
  $op=$_GET['op']; 
}
$nodo = '';
$subNodo='';
$app='House';
$titApp='Administración de copropiedades';
if($pf=='K'){$app='Accounting';$titApp='Contabilidad General';} 

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
  <title><?PHP echo $titApp ?></title>
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
<body class="hold-transition skin-black sidebar-mini"   ng-app="app" >
<!-- Site wrapper -->
<div class="wrapper">
 
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo logito">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>enú</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Multi</b><?php echo $app ?></span>
      <img  src=<?php echo $logo ?> alt="Logo"/>
    </a>
    <!-- Header Navbar: style can be found in header.less  --> 
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
      <span class="logo-lg"><?php echo $titApp ?></span>
      <div id='titbar' class="navbar-custom-menu">
        <ul class="nav navbar-nav">
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
        <li class="logito header list-inline"><?php echo $datos[5] ?></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
             <?php if ($pf=='K'){ 
                 echo '
                 <span>Tablas Generales</span>';
             }else{
                 echo '<span>Tablas Administración</span>';
             };
             ?>
           
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu"> 
        <?php if ($pf=='A' OR $pf=='S' OR $pf=='C'){            
        echo '     
              <li><a href="mm.php?op=clin"><i class=""></i>Clasificación de inmuebles</a></li>                      
              <li><a href="mm.php?op=inmu"><i class=""></i>Inmuebles</a></li>
              <li><a href="mm.php?op=prop"><i class=""></i>Propietarios</a></li>
              <li><a href="mm.php?op=serv"><i class=""></i>Servicios</a></li>
              <li><a href="mm.php?op=proInm"><i class=""></i>Inmueble y su Propietario</a></li>
              <li><a href="mm.php?op=inmServ"><i class=""></i>Inmueble y Servicio Especial</a></li>
              <li><a href="mm.php?op=cbnte2"><i class=""></i>Tipo Ingresos Gastos</a></li>
              <li><a href="mm.php?op=terc"><i class=""></i>Lista de terceros</a></li>
              <li><a href="mm.php?op=users"><i class=""></i> <span>Usuarios</span></a></a></li>';
       }else{
        echo '<li><a href="mm.php?op=puuc"><i class=""></i>Plan único contable</a></li>
              <li><a href="mm.php?op=cbnte"><i class=""></i>Comprobantes y Operaciones</a></li>
              <li><a href="mm.php?op=tpInf"><i class=""></i>Tipos de Informe</a></li>
              <li><a href="mm.php?op=esInf"><i class=""></i>Estructura de Informe</a></li>
              <li><a href="mm.php?op=nts"><i class=""></i>Notas contables</a></li>
              <li><a href="mm.php?op=terc"><i class=""></i>Lista de terceros</a></li>';
        }; 
        ?>
              </ul>
        </li>
 
        <?php if ($pf=='A' OR $pf=='S' ){            
        echo ' 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-paste"></i>
            <span>Procesos</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="mm.php?op=creaFac"><i class=""></i>Genera Cuentas de Cobro</a></li>
            <li><a href="mm.php?op=recCaja"><i class=""></i>Recibos de caja (abonos)</a></li>
            <li><a href="mm.php?op=pagos"><i class=""></i>Aplica Pagos Pendientes</a></li>
            <li><a href="mm.php?op=anuRC"><i class=""></i>Anula Recibo de Caja</a></li>
            <li><a href="mm.php?op=otrIngr"><i class=""></i>Otros Ingresos y gastos</a></li>
            <li><a href="mm.php?op=acuPago"><i class=""></i>Acuerdos de Pago</a></li>
            <li><a href="mm.php?op=anticip"><i class=""></i>Anticipos (Abonos)</a></li> 
          </ul>
        </li>' ;
        }?> 
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file"></i>
                    <span>Contabilidad</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">'
            <?php if ($pf=='K'  ){            
            echo ' 
                <li><a href="mm.php?op=digCpbnt"><i class=""></i>Digita Comprobante Contable</a></li>
                <li><a href="mm.php?op=digMvto"><i class=""></i>Digita Operación Contable</a></li>
                <li><a href="mm.php?op=actMvto"><i class=""></i>Actualiza Comprobante Contable</a></li>
                <li><a href="mm.php?op=revMvto"><i class=""></i>Reversa Comprobante Contable</a></li>
                <li><a href="mm.php?op=dupComp"><i class=""></i>Duplica Comprobante</a></li> 
                <li><a href="mm.php?op=trSal2"><i class=""></i>Transfiere saldos</a></li>                     
                <li><a href="mm.php?op=cieMes"><i class=""></i>Cierre mensual</a></li>   
                <li><a href="mm.php?op=cieEje"><i class=""></i>Cierre Ejercicio</a></li>  ';
                 }
             else {
        echo '<li><a href="mm.php?op=conta"><i class=""></i>Contabiliza Movimiento Mensual</a></li> ';         
             }?>    
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Informes / Consultas</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu"> 
              
        <?php if ($pf=='A' OR $pf=='S' OR $pf=='C' ){            
        echo ' 
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-eye"></i>
                  <span>Informes Admistración</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu">
                    <li><a href="mm.php?op=rCtaCob"><i class=""></i>Reimprime Cuentas de Cobro</a></li>
                    <li><a href="mm.php?op=rRcaja"><i class=""></i>Reimprime Recibo de caja</a></li>
                    <li><a href="mm.php?op=rCtaCC"><i class=""></i>Consulta Cuenta de Cobro</a></li>
                    <li><a href="mm.php?op=rCtaRcaj"><i class=""></i>Consulta Recibo de Caja</a></li>
                    <li><a href="mm.php?op=rResDia"><i class=""></i>Resume Ingresos y gastos</a></li>
                    <li><a href="mm.php?op=rStado"><i class=""></i>Estado de cuenta Inmueble</a></li>
                    <li><a href="mm.php?op=rMora"><i class=""></i>Informe Cuentas por cobrar</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-clipboard"></i>
                  <span>Informes Reuniones</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu">
                    <li><a href="mm.php?op=lst"><i class=""></i>Lista de asistencia</a></li>
                    <li><a href="mm.php?op=porep"><i class=""></i>Poder Representación</a></li>
                </ul>
            </li>'
            ; }        
        else{
            echo  '        
            <li class="treeview">
                <a href="#">
                     <li><a href="mm.php?op=rCompr"><i class=""></i>Comprobantes por periodo</a></li>
                    <li><a href="mm.php?op=rBalpr"><i class=""></i>Estados Financieros</a></li>
                    <li><a href="mm.php?op=rLibDia"><i class=""></i>Libro Diario</a></li>
                    <li><a href="mm.php?op=rLibMa"><i class=""></i>Libro Mayor</a></li>
                    <li><a href="mm.php?op=rLibAux"><i class=""></i>Libro auxiliar</a></li>
                    <li><a href="mm.php?op=rCtaMov"><i class=""></i>Cuentas y su movimiento</a></li>
                    <li><a href="mm.php?op=rMovTer"><i class=""></i>Movimiento por terceros</a></li>                                
                    <li><a href="mm.php?op=rSal2"><i class=""></i>Saldos contables</a></li> 
                    <li><a href="mm.php?op=rXls"><i class=""></i>Consultas a Excel</a></li>
                    </li-->
                  <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu">  

                </ul>
            </li>

            ';}
           echo ' 
          </ul>
        </li>
        ';       
        ?>
  
        
       <?php            
        echo '
        <li class="treeview">
          <a href="#">
            <i class="fa fa-institution"></i>
            <span>Administración</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">';
        if ($pf=='A'  OR $pf=='C'  OR $pf=='S' ) {   
           echo '         
            <li><a href="mm.php?op=parGen"><i class=""></i> <span>Parámetros Generales</span></a></li>
            <li><a href="mm.php?op=parFac"><i class=""></i> <span>Parámetros Facturación</span></a></li>
            <li><a href="mm.php?op=logo"><i class=""></i> <span> Logo Avatar</span></a></li>;';
        }
        if ($pf == 'K'){   
           echo ' <li><a href="mm.php?op=parCont"><i class=""></i> <span>Parámetros Contabilidad</span></a></li>
                  <li><a href="mm.php?op=logo"><i class=""></i> <span> Logo Avatar</span></a></li>
                  <li><a href="mm.php?op=imppucc"><i class=""></i> <span>Importa plan contable</span></a></li>
                  <li><a href="mm.php?op=borsl2"><i class=""></i> <span>Borra Saldos,habilita Cbntes</span></a></li>';
           }
        if ($pf=='XXXX'){            
           echo '<li><a href="mm.php?op=empr"><i class=""></i> <span>La empresa</span></a></li>  
                 <li><a href="mm.php?op=logo"><i class=""></i> <span> Logo Avatar</span></a></li>;';        
        }
         if ($pf=='A' OR $pf=='S' ) { 
             echo '   <li><a href="mm.php?op=impor"><i class="fa fa-circle-o"></i>Importa Tablas</a></li>
                <li><a href="mm.php?op=impPag"><i class="fa fa-circle-o"></i><span>Importa Pagos</span></a></li>     
                <li><a href="mm.php?op=impsal2"><i class="fa fa-circle-o"></i>Importa Saldos</a></li> ';
               
           };
           ?>
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
                    <h3 class="textos"><?php echo $ztmh01 ?></h3>
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

        if ($op ==  'anuRC'){
            include_once 'views/frm_contaAnulaRcaja.php';
        }  
        if ($op ==  'acuPago'){
            include_once 'views/frm_contaacuerdos.php';
        } 
        
        if ($op ==  'actMvto'){
            include_once 'views/frm_contaActualizaMvto.php';
        }
        if ($op ==  'anticip'){
            include_once 'views/frm_contapagos.php';
        }        
        if ($op ==  'clin'){
            include_once 'views/frm_contaclasificacion.php';
        }
        
        if ($op == 'digCpbnt'){
            include_once 'views/frm_contamovicabeza.php';
        }
        if ($op == 'digMvto'){
            include_once 'views/frm_contadigitamvto.php';
        }
        if ($op ==  'dupComp'){
            include_once 'views/frm_contaDuplicaCpbnte.php';
        }
        if ($op ==  'empr'){
            include_once 'views/frm_contaempresas.php';
        }
        
        if ($op ==  'inmu'){
            include_once 'views/frm_containmuebles.php';
        }
        if ($op ==  'inmServ'){
            include_once 'views/frm_containmuebleservicios.php';
        } 
        if ($op ==  'impor'){
            include_once 'views/frm_contaimportaXls.php';
        }  
        if ($op ==  'impPag'){
            include_once 'views/frm_contaimportaPagos.php';
        } 
        
        if ($op ==  'impsal2'){
            include_once 'views/frm_contaimportaSaldos.php';
        } 
        if ($op ==  'imppucc'){
            include_once 'views/frm_contaimportaPuuc.php';
        } 
        
        if ($op ==  'parGen'){
            include_once 'views/frm_contaParamGral.php';
        }
        if ($op ==  'parFac'){
            include_once 'views/frm_contaParamFac.php';
        }
        if ($op ==  'parCont'){
            include_once 'views/frm_contaParamConta.php';
        }  
        if ($op ==  'borsl2'){
            include_once 'views/frm_contaBorraSaldos.php';
        }      
        if ($op ==  'proInm'){
            include_once 'views/frm_containmueblepropietario.php';
        }        
        if ($op ==  'prop'){
            include_once 'views/frm_contapropietarios.php';
        }     
        if ($op ==  'serv'){
            include_once 'views/frm_contaservicios.php';
        }  
       
        if ($op ==  'terc'){
            include_once 'views/frm_contaterceros.php';
        }
        if ($op ==  'users'){
            include_once 'views/frm_mm_usuarios.php';
        }
         if ($op ==  'creaFac'){
            include_once 'views/frmContaFacturacion.php';
        }       
         if ($op ==  'recCaja'){
            include_once 'views/frmContaRecibosCaja.php';
        }        
        if ($op ==  'pagos'){
            include_once 'views/frm_contatmpagos.php';
        }                
        if ($op ==  'otrIngr'){
            include_once 'views/frm_containgregastos.php';
        }
        if ($op ==  'cbnte'){
            include_once 'views/frm_contacomprobantes.php';
        }
         if ($op ==  'cbnte2'){
            include_once 'views/frm_contacomprobantes2.php';
        }       
        if ($op ==  'contc'){
            include_once 'views/frm_contacontacto.php';
        }
        if ($op ==  'Versi'){
            include_once 'views/frm_contaversion.php';
        }        
        if ($op ==  'conta'){
            include_once 'views/frm_contaContabilizacion.php';
        }  
        if ($op ==  'rCtaCob'){
            include_once 'views/frm_contaImpCtasCobro.php';
        }
        if ($op ==  'rRcaja'){
            include_once 'views/frm_contaImpReciboCaja.php';
        }
        if ($op ==  'rCtaCC'){
            include_once 'views/frm_contaCtaCtasCobro.php';
        }
        if ($op ==  'rCtaRcaj'){
            include_once 'views/frm_contaCtaRcaja.php';
        }
        if ($op ==  'rResDia'){
            include_once 'views/frm_contaResumenDiarioCaja.php';
        }  
 
        if ($op ==  'rStado'){
            include_once 'views/frm_contaEstadoCuenta.php';
        } 

        if ($op ==  'rMora'){
            include_once 'views/frm_contaCarteraMora.php';
        }  

        if ($op ==  'rCtas'){
            include_once 'views/frm_contaConsultas.php';
        } 
        if ($op ==  'revMvto'){
            include_once 'views/frm_contaReversaCpbnte.php';
        }
        if ($op ==  'gast'){
            include_once 'views/frm_contaGastos.php';
        } 

        if ($op ==  'lst'){
            include_once 'views/frm_contaLlamalista.php';
        }
        if ($op ==  'porep'){
            include_once 'views/frm_contaPoderPrepresentacion.php';
        }
        if ($op ==  'trSal2'){
            include_once 'views/frm_contaTrasfiereSaldos.php';
        }
         if ($op ==  'cieMes'){
            include_once 'views/frmContaCierreMes.php';
         }
         if ($op ==  'cieEje'){
            include_once 'views/frmContaCierreEjercicio.php';
         }         

        if ($op ==  'tpInf'){
            include_once 'views/frm_contatipoinforme.php';
        }
        if ($op ==  'rSal2'){
            include_once 'views/frm_contaImpSaldos.php';
        }
        if ($op ==  'rCompr'){
            include_once 'views/frm_contaImpCmpbntes.php';
        }
        if ($op ==  'rXls'){
            include_once 'views/frm_contaImpExcel.php';
        }      
        
        if ($op ==  'rCtaMov'){
            include_once 'views/frmRepMayorMvts.php';
        }
        if ($op ==  'rMovTer'){
            include_once 'views/frmRepMoviTerceros.php';
        }
        
        if ($op ==  'rLibMa'){
            include_once 'views/frmRepLibroMayor.php';
        }        
        if ($op ==  'rLibDia'){
            include_once 'views/frmRepLibroDiario.php';
        } 
        if ($op ==  'rLibAux'){
            include_once 'views/frmRepLibroAuxi.php';
        }         
        if ($op ==  'rBalpr'){
            include_once 'views/frm_contaRepInfoNif.php';
        }  
        if ($op ==  'rEdoRes'){
            include_once 'views/frm_contaRepInfoNif.php';
        }       
        if ($op ==  'esInf'){
            include_once 'views/frm_containformes.php';
        } 
        if ($op ==  'nts'){
            include_once 'views/frm_contanotascont.php';
        } 
        if ($op ==  'logo'){
            include_once 'views/frm_contaloadLogos.php';
        }

        if ($op ==  'Docum'){
            include_once 'views/frm_contadocumentacion.php';
        } 
        
        if ($op ==  'puuc'){
            include_once 'views/frm_contaplancontable.php';
        }
 
        if ($op ==  'impo'){
            include_once 'views/frm_contaimportaXls.php';
        }
        if ($op ==  'xxxx'){
            include_once 'views/frm_contamovidetalle.php';
        } 
        if ($op ==  ''){
            include_once 'views/frm_contanews.php';
        } 
        
        
        
        ?>
      </section>

  </div>
<div style='display: none'>
    <input type="text"  id ='e' value = '<?php echo $e ?> '>
    <input type="text"  id ='u' value = '<?php echo $u ?>' >
    <input type="text"  id ='p' value = '<?php echo $pf ?>' >
    <input type="text"  id ='ctrl' value = '<?php echo $ctrl ?>' >
    <input type="text"  id ='idioma' value = '<?php echo $idioma ?>' >
    <input type="text"  id ='app' value = '<?php echo $app ?>' >
    <input type="text"  id ='titApp' value = '<?php echo $titApp ?>' >
    
</div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.2
    </div>
    <strong>Copyright &copy; 2016, 2018, 2020 <a href="http://atomingenieria.com">Atominge sas.</a> </strong> Derechos reservados
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       imhediately after the control sidebar -->
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
                        err="Nuevas contraseÃ±as no son iguales. Para salir deje en blanco la contraseÃ±a actual";
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
                             alert('ContraseÃ±a cambiada exitosamente');
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

