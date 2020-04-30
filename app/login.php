<?php
session_start();
$version = phpversion();
 if(isset($_SESSION['mh'])) {
    $datos = explode('||',$_SESSION['mh']);
    $id=$datos[10];
    $idioma="lenguage".$id.".php";
 } else{
     $idioma="lenguageES.php";
 }

include_once 'inc/'.$idioma;
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Multi House</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->

  
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="css/AdminLTE.css" rel="stylesheet" type="text/css"/>
  <link href="css/mm.css" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">      
      <a href="#"><b>Multi</b>House</a><br/>
    </div>
      <div class="login-box-msg" id='ini'><span></span></div>  
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo $inicioTitulo ?></p>
        <span class="textos" id="subtit"></span>
        <form>
            <div class="form-group has-feedback">
              <input type="text" id='mail' class="form-control" placeholder=<?php echo $inicioCorreo ?>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" id='pwd' class="form-control" placeholder=<?php echo $inicioPwd ?>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                  <button type="button"  id = 'btnIngreso' class="btn btn-primary btn-block btn-flat"><?php echo $btntitIngresa ?></button>
              </div>
              <!-- /.col -->
            </div>
        </form>
        <div id="ocultos" style="display: none">
            <input id="autentica" type="text" value="" />
            <input id="erini01" type="text" value="<?php echo $errini0 ?>" />
            <input id="erini02" type="text" value="<?php echo $errini1 ?>" />
            <input id="notaIni1" type="text" value="<?php echo $notaIni1 ?>" />
            <input id="notaIni2" type="text" value="<?php echo $notaIni2 ?>" />
            <input id="notaIni3" type="text" value="<?php echo $notaIni3 ?>" />
              
        </div>
    </div>

</div>

<script src="js/jQuery-2.2.0.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/icheck.min.js" type="text/javascript"></script>

<script type="text/javascript">
      
    $('#btnIngreso').click(function()
    {
        msg='';
        if ($('#mail').val() === '') { msg += $('#erini01').val()+'\n';
        }
        if ($('#pwd').val() === '') {  msg += $('#erini02').val()+'\n';
        }
        if (msg===''){
         
            ant=$('#autentica').val();
            parametro= $('#mail').val()+'||'+ $('#pwd').val()+'||'+ ant ;
            
            $.post("inc/opcGrales.php", {accion:'valiUser', condicion:parametro}, function(data){  
                if (data.substr(0,5)==='Error'){
                     alert(data);        
                }
               else
                { 
                 var dat = data.split('||');
                 location.href="mm.php?w="+dat[3]+"&z="+dat[4]+"&op=";
                }
             });
     }
     else
     {
         alert(msg);
     }    
     })  ;
</script>
</body>
</html>
