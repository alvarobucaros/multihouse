
<?php
        include_once ('templateHeader.php');
?> 
    <div id='content'>
 <?php
    $op='ini';
    $clasesConn="classes/conexion.class.php";
 
    include_once ($clasesConn);
    $objConn = new DBconexion();
    $conn = $objConn->conectar();
    
    

    if(isset($usuId)){   echo 'yo soy   '.$usuId;}
 
    if($conn==true){
        $query = "SELECT menu_descripcion,menu_modulo,menu_nodo,menu_nodoPadre FROM mm_menu
                INNER JOIN mm_usuariomenu ON usuarioMenu_menu = menu_id
                INNER JOIN mm_usuarios ON usuarioMenu_perfil = usuario_perfil
                WHERE usuario_id = 4"  ;
        $result = mysqli_query($conn,  $query);
        $conn = $objConn->desConectar();
    }
//        $reg = mysqli_fetch_array($result);
 ?>
    </div>
<div class="row ">
    <div class="productDisplays">    
        <div class="container ">
            <div class="row">
                <aside class="col-md-3">
                    <div id="menu" class="bs-docs-sidebar hidden-print " role="complementary"><br>
                        <ul class="nav">
                            <?php
                            while( $reg = mysqli_fetch_assoc($result) ) {
                                echo '<li class="first leaf"><a href="' . $reg['menu_modulo'].
                                        '">' . $reg['menu_descripcion'].'</a></li>';
                            }
                            ?>

                        </ul>
                    </div>
                </aside>
                <div class="col-md-9">
 
                        <div id="contentModulos">
                        <?php
                            $op='ini';
                            if (isset($_REQUEST['op'])){
                                $op = $_REQUEST['op'];

                            }

switch ($op) {

   case 'ini':
    echo '<h1 class="page-header">Gracias por usar MultiMeeting</h1>
    <p id="idTitulo">Ingrese su direccion de correo y contraseña</p>';
       include_once 'frmLogin.php';
    break;
   case 'com':
    echo '<h1 class="page-header">Comités o reuniones</h1>';
       include_once 'frmComites.php';
    break;
   case 'asi':
    echo '<h1 class="page-header">Asistentes a reunión</h1>
    <p>Relación de personas, o grupos que asisten a una reunión</p>';
       include_once 'frmAsistentes.php';
    break;

   case 'grp':
    echo '<h1 class="page-header">Grupos de asistentes</h1>
    <p>Define los grupos de personas que asisten regularmente a una reunión</p>';
        include_once 'frmGrupos.php';
    break;
   case 'per':
    echo '<h1 class="page-header">Perfiles de asistentes</h1>
    <p>Asignacion de perfiles a los asistentes a las reuniones</p>';
    break;
   case 'sal':
    echo '<h1 class="page-header">Salones</h1>
    <p>Administración de salones y auditorios</p>';
       include_once 'frmSalones.php';
   break;

   case 'reu':
    echo '<h1 class="page-header">Desarrollo de la reunión</h1>
    <p>Seguimiento a la agenda, compromisos y tareas</p>';
    break;
   case 'inv':
    echo '<h1 class="page-header">Invidatos a la reunión</h1>
    <p>Definiciones y parámetros de la aplicación</p>';
    break;
   case 'tem':
    echo '<h1 class="page-header">Temario</h1>
    <p>Temas nuevos y pendientes por tratar</p>';
       break;
   case 'des':
    echo '<h1 class="page-header">Desarrollo de la reunión</h1>
    <p>Seguimiento a la agenda, compromisos y tareas</p>';
    break;
   case 'adm':
    echo '<h1 class="page-header">Parámetros del sistema</h1>
    <p>Definiciones y parámetros de la aplicación</p>';
    break;
   case 'ayu':
    echo '<h1 class="page-header">Ayudas de memoria</h1>
    <p>Mis apuntes de la reunión</p>';
    break;    
}
?>			
  
            </div><!-- container -->
		</div><!-- productDisplays -->
	

                </div><!-- ROW -->
                <div id="pie">
<?php 
        include_once 'templateFooter.php';
?>
                </div>
        </div>
    </div>

</div>

</body>



</html>
