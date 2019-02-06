<?php

if(isset($_POST["accion"])){
   $accion = $_POST["accion"];
   $condicion = $_POST["condicion"];

    if($accion == "inicio"){
        $clasesIncludes = "../bin/cls/clsConection.php";
        include_once ($clasesIncludes);
        $obj = new DBconexion();
        $result = $obj->cargaEmpresa();
        return $result;
    }
    if($accion == "valiUser"){
      //  print_r($_POST);
        $clasesIncludes = "../bin/cls/clsConection.php";
        include_once ($clasesIncludes);
        $obj = new DBconexion();
        $dat=  explode('||', $condicion);
        $result = $obj->autenticaUsuario($dat);
        echo $result;
        return $result;
    }
    if($accion == "changePwd"){
        $clasesIncludes = "../bin/cls/clsConection.php";
        include_once ($clasesIncludes);
        $obj = new DBconexion();
        $dat=  explode('||', $condicion);
        $result = $obj->changePwd($dat);
        echo $result;
        return $result;
    }
  
    if ($accion=='importaDatos')
    {
        $data = explode('||', $condicion);
        $empresa = $data[0];
        $file = $data[1];
        $datos = $data[2];
        include_once ("../modulos/mod_mm_CargaData.php");
        $obj = new opcCargaData();
        $result = $obj->importaDatos($empresa, $file, $datos);
        echo $result;  
    }     
    
}else{
    echo 'No hay una accion a ejecutar';
}