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
        $file  = $data[1];
        $datos = $data[2];
        $tipo  = $data[3];
        include_once ("../modulos/mod_contacargaData.php");
        $obj = new opcCargaData();
        if ($tipo === 'T'){$result = $obj->importaDatos($empresa, $file, $datos);}
        if ($tipo === 'P'){$result = $obj->importaPagos($empresa, $file, $datos);}
        if ($tipo === 'S'){$result = $obj->importaSaldos($empresa, $file, $datos);}
        if ($tipo === 'U'){$result = $obj->importaPUCC($empresa, $file, $datos);}
        echo $result;  
    }     
    
    if ( $accion=='importaPagos'){
        
    }
    
    if (  $accion== 'borrapucc'){
        $data = explode('||', $condicion);
        $empresa = $condicion;
        include_once ("../modulos/mod_contacargaData.php");
        $obj = new opcCargaData();
        $result = $obj->borrapucc($empresa);
        echo $result;         
    }
    if (  $accion== 'borraSaldos'){
        $data = explode('||', $condicion);
        $empresa = $condicion;
        include_once ("../modulos/mod_contacargaData.php");
        $obj = new opcCargaData();
        $result = $obj->borraSaldos($empresa);
        echo $result;         
    }
    
    if ($accion=='borraTablas')
    {
        $data = explode('||', $condicion);
        $empresa = $condicion;
        include_once ("../modulos/mod_contacargaData.php");
        $obj = new opcCargaData();
        $result = $obj->borraTablas($empresa);
        echo $result;  
    }  
}else{
    echo 'No hay una accion a ejecutar';
}