<?php

class opcCargaData {

function importaDatos($empresa, $file, $data){
    
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();
    
        $array =  explode(';',  $data);
        $retorno='Importacion Correcta';
        $respuesta=" proceso ";
        $j=0;
        $n=0;
        $sql="";
        $array[2] = str_replace(",",".",$array[2]);
        $array[3] = str_replace(",",".",$array[3]);
        $inmueble_id=0;
        $inmueble_empresa=$empresa;
        $inmueble_codigo=$array[0];
        $inmueble_descripcion=$array[1];
        $inmueble_area=$array[2];
        $inmueble_coeficiente=floatval($array[3]);
        $inmueble_ubicacion=$array[4];
        $inmueble_propNombre= $array[5]; // utf8_decode($array[5]);
        $inmueble_propCedula=$array[6];
        $inmueble_propTelefonos=$array[7];
        $inmueble_propDireccion=$array[8];
        $inmueble_propCorreo=$array[9];
        $inmueble_Activo='A';
        $inmueble_comite=0;
        $inmueble_prinipal='';

        $query = "SELECT inmueble_id FROM mm_inmuebles WHERE inmueble_codigo = '" . $inmueble_codigo .
                "' AND inmueble_empresa = '" . $empresa ."' ";
        $resultado =  mysqli_query($con, $query);
        $totRec =   $resultado->num_rows;  ///$número_filas = mysql_num_rows($resultado);  
        if ($totRec > 0) {
            
        $query="UPDATE mm_inmuebles SET ".
            "inmueble_descripcion = '" . $inmueble_descripcion . "', inmueble_area = '".
            $array[2] . "', inmueble_coeficiente =  '". $array[3] .
            "', inmueble_ubicacion = '" .$inmueble_ubicacion . "', inmueble_propNombre = '".
            $inmueble_propNombre . "', inmueble_propCedula = '". $inmueble_propCedula . 
            "', inmueble_propTelefonos = '" . $inmueble_propTelefonos . 
            "', inmueble_propDireccion = '" . $inmueble_propDireccion . "' , inmueble_propCorreo = '".
            $inmueble_propCorreo . "', inmueble_Activo = ' " . $inmueble_Activo . 
            "',  inmueble_comite = '" . $inmueble_comite . "', inmueble_prinipal=''" .
            " WHERE inmueble_empresa = '" . $inmueble_empresa. "' AND inmueble_codigo = '". 
            $inmueble_codigo . "' ";
        }
        else{
        $query="INSERT INTO mm_inmuebles(inmueble_empresa, inmueble_codigo, ".
                "inmueble_descripcion, inmueble_area, inmueble_coeficiente, ".
                "inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula,".
                "inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo,".
                "inmueble_Activo, inmueble_comite, inmueble_prinipal) VALUES ('" .
                $inmueble_empresa . "','" . $inmueble_codigo  . "','" .
        $inmueble_descripcion. "','" .  $array[2] . "','" .
         $array[3] . "','" . $inmueble_ubicacion . "','" .
        $inmueble_propNombre . "','" .  $inmueble_propCedula . "','" .
        $inmueble_propTelefonos . "','" . $inmueble_propDireccion . "','" .
        $inmueble_propCorreo . "','" . $inmueble_Activo . "','" .
        $inmueble_comite . "','" . $inmueble_prinipal  . "')";      
        }
       $resultado =  mysqli_query($con, $query);

        return $resultado;
    }

    
    function nroRegistros($sql){ 
// echo $sql;      
        $obj = new DBManager();
        $con = $obj->conectar();
        $retorno = Array('nro'=>0, 'id'=>0); 
        if($con==true){     
            $result =  mysql_query($sql);
            while( $reg = mysql_fetch_assoc($result) )
            {
                 $retorno['nro'] =  $reg['nr']; 
                 $retorno['id'] =  $reg['id'];
            }      
          return $retorno;
       }
    }  
  

    function grabar($sql){ 
        $result = 0;
   //     echo $sql;        
        $obj = new DBManager();
        $con = $obj->conectar();
        if($con==true){     
          $result =  mysql_query($sql);
        }
        $con = $obj->desConectar();
        return $result;
    } 

}   