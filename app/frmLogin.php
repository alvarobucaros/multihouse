<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--<script src="js/jquery.min.js"></script>-->
<!--<script src="js/bootstrap.min.js"></script>-->

<div class="col-sm-8 col-xs-12">
    <nav class="subNav">
        <div class="region region-products-nav">
            <section id="block-menu-menu-pdf-architect" class="block block-menu responsive-product-navigation clearfix">
                <section>
                    <div id="login_form">  
                        <label>Email:</label>  
                        <input type="text" id="email" name="email" class="required" value="alvaro@mi.com"/>
                        <br>
                        <label>Password:</label>  
                        <input type="password" id="password" name="password"  class="required" value="123"/> 
                        <label></label><br>   <br> 
                        <input type="button" id="login" value="Ingreso" />  
                        <input type="button" id="cancel_hide" value="Cancel" /> 
                    </div> 
                    
                </section>
            </section>
           
        </div>
        <seccion>
            <div id="add_err" class="popup"></div> <input type="hidden" id="hide" /> 
        </seccion>
    </nav>        
</div>  

<script type="text/javascript">  
 
$(document).on('ready',function(){
    $("#menu").fadeOut("normal");
    $("#pie").fadeOut("normal");
});      
    
$(document).ready(function(){  

    $("#cancel_hide").click(function(){  
       $(':input','#login_form')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    });  
   

    $("#login").click(function(){ 
       var err=0;
       var msg=''
        if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
            err +=1; msg +='El correo electrónico introducido no es correcto.\n'}
        if($("#password").val()==''){ 
            err +=1; msg +='Debe digitar una contraseña.\n'}
        if (err>0){
            alert(msg);return(false)
        }  
        else{
        var username=$("#email").val();  
        var password=$("#password").val();  
        var parametros=username +'||'+password;
            $.post("opciones.php", {modulo : 'ModUsuarios.php', accion:'validaUsuario', datos: parametros }, 
            function(data){
            var resultado = data;
            if (resultado.substring(0,5)==='ERROR') {alert (resultado);}
          else {
//            alert (resultado);
            var res = resultado.split('||'); //['usuario_nombre']||['usuario_tipo_acceso']$reg['usuario_perfil']$reg['usuario_id'];}
            var str = "<string>Usuario:"+ res[0]+ "  </string> ";
            $("#creditos").html( str );
            var str = res[3];
            $("#userId").val(str);
            var str = res[1];
            $("#userAcceso").val(str);
            change();}
            });
        }
      });
      
    function change(){
        $("#menu").fadeIn("fast"); 
        $("#login_form").fadeOut("slow");
        $("#pie").fadeIn("slow");
        var str = "Seleccione una opción";
        $("#idTitulo").html( str );
    };

});  

</script>  

