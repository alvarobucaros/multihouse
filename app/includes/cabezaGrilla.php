
        <?php  
        /*
         *  botones de control en la parte superior de la grilla
         */
        echo " <div id='frmCabeza'><div class='Grilla' id='cabezaGrilla'>";
        if ($userRol<>'C'){?>
                 <a onClick='nuevoRegistro();' href="#"><img src="img/add.png" alt="Agregar registro" title="Agregar registro" /></a>&nbsp;&nbsp;&nbsp; 
		 <a onClick='exportaExcel();'  href="#"><img src="img/xls-dist.png" alt="Exporta a excel"  title="Exporta a excel" /></a>&nbsp;&nbsp;&nbsp;
		 <!--<a href="#"><img src="img/print.png" alt="Imprime tabla"   title="Imprime tabla"/></a>&nbsp;&nbsp;&nbsp;-->
                 <input type="text" name="txtBusca" id="txtBusca" value="" size="15" />
                 <a onClick='buscaRegistros();' href="#"><img src="img/buscar.png" alt="Buscar"  title="Buscar"/></a>&nbsp;&nbsp;&nbsp;
                    <?php }else{echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';} ?>
                 <a onClick='alMenu();' href=""><img src="img/escape.png" alt="Regresa al menu"  title="Regresa al menu"></a>        
<!-- coloca los titulos de la grilla --> 
    <?php 
//        echo "</div><div><table class='tabla'><tr>";
//            for($i=0;$i<count($header);$i++) {
//            echo '<th>'.$header[$i].'</th>';
//            }
//        echo "</tr></table>";
//        echo "</div> </div>";
   ?>
