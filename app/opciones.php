<?php
//print_r($_REQUEST);
if(isset($_POST["modulo"])){
    $modulo = $_POST["modulo"];
    $accion = $_POST["accion"];
    $datos=$_POST["datos"];
    if ($modulo=='includes.php'){
        $clasesIncludes="classes/".$modulo;
        include_once ($clasesIncludes);
        $objInc = new includes;
        if ($accion=='municipios'){
            $Condicion=$_POST["datos"];
            $query_mpios = $objInc->getMunicipios($Condicion);
            echo ' <span>Ubicación: Municipio/ciudad</span><select name="mpios" id="mpios">';
             while($row = mysqli_fetch_array($query_mpios)){
                echo '<option value=' . $row['CodMpio'] .'>'. $row['NomMpio'].'</option>';
             }
            echo '</select>';
        }
        else if ($accion=='grabar'){
   
            $dat=$_POST["datos"];
            $rec=explode('&',$dat);          
            $response = $objInc->grabaClasificado($rec);
        }
    }
    else if ($modulo=='ModUsuarios.php')
        {
            $clasesIncludes="../models/".$modulo;
            include_once ($clasesIncludes);
            $objInc = new usuarios;
            $accion = $_POST["accion"];
            $Condicion=explode('||',$_POST["datos"]);
            $response=$objInc->validaUnUsuario($Condicion[0],$Condicion[1]);
            echo $response;
        }
    else if ($modulo=='ModComites.php')
        {
            $clasesIncludes="../models/".$modulo;
            include_once ($clasesIncludes);
            $objInc = new comites;
            $accion = $_POST["accion"];
            $Condicion=explode('||',$datos);
            $response=$objInc->recuperaVariosRegistros($Condicion);
            return $response;
        }        
}
else
{
    echo ('No hay accion para ejecutar');
}
        
          
    
     
