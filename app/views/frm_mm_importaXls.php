<?php

 if (isset($_FILES['file'])){
    $tituloFormulario= ' IMPORTA ' . $_FILES['file']['name'];
    $nombre = $_FILES['file']['name'];
    $tipo = $_FILES['file']['type'];
    $tamano = $_FILES['file']['size'];
    $attachment = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];
    if ($error==0){
        $chk_ext = explode(".",$nombre);
        if($chk_ext[1] == 'csv'){
            echo '<br />'.$nombre. ' <br /> ' . $tipo. '<br />  ' .$tamano . '<br />  ' . $import;
        }else{
            echo 'Este no es un csv';
        }

        echo  "<br />".$attachment;

            echo '<table cellpadding="10">
            <tr><td valign="top">';

            echo '<h3>Importación ' . $nombre.'</h3>';

            echo '<table id="datos" border="1">';

            echo '</table>';

            echo '<tr><td>
            <a onClick="subeDatos(); return false" href="#" class="button"><img src="img/upload.png" alt="Cargar" texto = title="Cargar" />Carga datos</a>&nbsp;&nbsp;&nbsp;' .
            '<a onClick="CerrarRegistro(); return false" href="frmcontaImportar.php" class="button"><img src="img/escape.png" alt="Cancela" texto = title="Cancela" />Regresa</a> </td></tr>';
            echo '</td></tr></table></div>';

	}
     else 
         {     
        echo 'falta el nombre del archivo';
        }     
 }
?>
<div class="container "  ng-controller="mainController">
    <h3 class="text-left">{{form_titleImportar}}</h3>
    <br/>
    <div class="form-group">
        <div class="col-md-1"></div>
            <div class="col-md-8">
            <span> <p>{{nota1}}</p> </span>
            <span> <p>{{nota2}}</p> </span>
            <span> <p>{{nota3}}</p> </span>
            <br/>
        </div>

        <form name="importar" action='<?php echo $_SERVER["PHP_SELF"];?>' method="POST" enctype="multipart/form-data">

            <table name ="tabImport" id="tabImport" class="tablex">
                <tr>
                    <td colspan='2'>    
                </tr>

                <tr class="col-md-8">
                    <td style="text-align: center;">
                        <input type="file" name="file" id="fileUpload" value=""  accept=".csv" width="70"  /> 
                        <a href="mm.php" ><img src="img/escape.png" alt="Regresa al menu"  title="Regresa al menu"></a>
                    </td> 

                </tr>

            </table> 
            <div id='progreso' ng-show="progress">
                <img src="img/progress.gif" alt=""/>
            </div>
            <div id='datempresa' style='display: none'>  

                <?php echo "<input type='text' id='archivo' value='' </input>" ?>  
                <?php echo "<input type='text' id='tamano' value='' </input>" ?>  
                <?php echo "<input type='text' id='empresa' value='' </input>" ?>
                <?php echo "<input type='text' id='informe' value='' </input>" ?>
            </div> 
        </form>              
    </div>
</div>

<script src="bin/js/jquery.csv.min.js" type="text/javascript"></script>
<!--
<script src="controller/min/mm_importaXls.ctrl.min.js" type="text/javascript"></script>
-->
<script src="controller/ctrl/mm_importaXls.ctrl.js" type="text/javascript"></script>