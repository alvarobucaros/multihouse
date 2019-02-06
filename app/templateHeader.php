<html>
    <head>
        <title>MultiMeeting</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="language" content="es" />
            <meta name="keywords" content="reuniones,comtes,meeting"/>
            <meta name="description" content="Seguimiento y control de reuniones">
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="../views/css/screen.css">
            <link rel="stylesheet" href="../views/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../views/css/style.css" rel="stylesheet">
            <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
            <script src="js/jquery-ui.js" type="text/javascript"></script>
            <script src="js/jquery.bgiframe.js" type="text/javascript"></script>
            
    </head>
      
<body style="">
        <?php
                
$clasesConn="classes\conexion.class.php";
include_once ($clasesConn);
$objConn = new DBconexion;

$clasesDb="classes\baseDatos.class.php";
include_once ($clasesDb);
$objDb = new DBclases;

$proyecto = '';
$id=0;
$resultado = $objDb->leeParametros($id);
if (isset($resultado)){
   $result = mysqli_fetch_array($resultado); 
}else{echo '<br> problemas';}

?> 
    <div id="mainWrapper">
        <div class="row">
            <div class="productRow">
                <div class="container">
                    <div  class="row product_nav">
                        <div class="col-sm-4 col-xs-12">
                            <a href="inicio.php?op=ini"><h2><?php echo $result['empresa_nombre'] ?></h2></a>
                            <h1 class="productRow-Title">MULTI MEETING</h1>
       
                            <div class="field field-name-field-slogan field-type-text field-label-hidden">
                                <div class="field-items">
                                    <div class="field-item even">Sistema de control y seguimiento de reuniones</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-xs-12">
                            <nav class="subNav">
                                <div class="region region-products-nav">
                                    <section id="block-menu-menu-pdf-architect" class="block block-menu responsive-product-navigation clearfix">
                                        <section>
                                            <img src="../views/images/logo.png" alt="logo" class="logo">
                                        </section>
                                    </section>                          
                                </div>
                            </nav>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>

