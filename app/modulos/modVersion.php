<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();

      if ($con){
       {
            $query = "SELECT empresa_versionPrd, empresa_versionBd, empresa_clave, " . 
                     "empresa_nombre, empresa_nit  FROM mm_empresa ";                 
            $result = mysqli_query($con, $query);
            $arr = array();
            if(mysqli_num_rows($result) != 0) 
                {
                    while($row = mysqli_fetch_assoc($result)) {
                        $arr[] = $row;
                    }
                }              
            $json_info = json_encode($arr);
            echo $json_info;
       }
    }
