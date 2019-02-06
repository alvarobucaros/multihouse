<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
    $fd = fopen('../bin/cls/mm.ctl', 'r');

    $datos=fread($fd,filesize('../bin/cls/mm.ctl')); 
    $data =explode('~',$datos);
    fclose($fd);
    
    $ctrl=$data[0] . '||' . $data[1] . '||' . $data[2] . '||' . $data[3];
   // echo $ctrl;
    $servidor = funde($data[0]);
    $baseDatos = funde($data[1]);
    $usuario = funde($data[2]);
    $clave = funde($data[3]); 
    $version = $data[4]; 
    
    $ctrl=$servidor . '||' . $baseDatos . '||' . $usuario . '||' . $clave;
    if ($version == 0 ) {$ctrl .= '||LITE';} else {$ctrl .= '||ONLINE';};
      if ($con){
       {
            $query = "SELECT empresa_versionPrd, empresa_versionBd, empresa_clave, " . 
                     "empresa_nombre, empresa_nit FROM mm_empresa LIMIT 1;";                 
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0) 
                {
                    while($row = mysqli_fetch_assoc($result)) {
                        $ctrl = $row['empresa_versionPrd'] . '||' . $row['empresa_versionBd'] . '||' .  
                        $row['empresa_clave'] . '||' . $row['empresa_nombre'] . '||' .  $row['empresa_nit'] . '||' .
                        $servidor . '||' . $baseDatos . '||' . $usuario . '||' . $clave;
                        if ($version == 0 ) {$ctrl .= '||LITE';} else {$ctrl .= '||ONLINE';};
                    }
                }              
            echo $ctrl;
       }
    }
    
    function funde($txt){
        $n= strlen($txt);
        $ret='';
        for ($i=0;$i<=$n;$i++)
        {
            $ret.= substr($txt,$n - $i,1);
        }
        return $ret;
    }
