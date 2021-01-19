<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);

  
switch ($op)
{
    case 'r':
        leeRegistros($data);
        break;
    case 'n':
        leeNoticias($data);
        break;

}

function  leeRegistros($data){
    $objClase = new DBconexion(); 
    $con = $objClase->conectar(); 
    $empresa = $data->empresa;
    $fd = fopen('../bin/cls/mh.ctl', 'r');

    $datos=fread($fd,filesize('../bin/cls/mh.ctl')); 
    $data =explode('~',$datos);
    fclose($fd);
    
    $ctrl=$data[0] . '||' . $data[1] . '||' . $data[2] . '||' . $data[3];

    $servidor = funde($data[0]);
    $baseDatos = funde($data[1]);
    $usuario = funde($data[2]);
    $clave = funde($data[3]); 
    $version = $data[4]; 
    
    $ctrl=$servidor . '||' . $baseDatos . '||' . $usuario . '||' . $clave;
    if ($version == 0 ) {$ctrl .= '||LITE';} else {$ctrl .= '||ONLINE';};
      if ($con){
       {
            $query = "SELECT empresaVersionPrd, empresaVersionBd, empresaClave, empresaNombre, " .
                      " empresaNit FROM contaempresas WHERE empresaId = '" . $empresa ."'"; 
            

            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0) 
                {
                    while($row = mysqli_fetch_assoc($result)) {
                        $ctrl = $row['empresaVersionPrd'] . '||' . $row['empresaVersionBd'] . '||' .  
                        $row['empresaClave'] . '||' . $row['empresaNombre'] . '||' .  $row['empresaNit'] . '||' .
                        $servidor . '||' . $baseDatos . '||' . $usuario . '||' . $clave;
                        if ($version == 0 ) {$ctrl .= '||LITE';} else {$ctrl .= '||ONLINE';};
                    }
                }              
            echo $ctrl;
       }
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

    function  leeNoticias($data){
        $empresa = $data->empresa;

        $fd = fopen('../bin/cls/atm.ctl', 'r');
        $datos=fread($fd,filesize('../bin/cls/atm.ctl')); 
        $data =explode('~',$datos);
        fclose($fd);

        $servidor = funde($data[0]);
        $baseDatos = funde($data[1]);
        $usuario = funde($data[2]);
        $clave = funde($data[3]); 
        $version = $data[4]; 

        $con = new mysqli($servidor,$usuario,$clave, $baseDatos);

        if (mysqli_connect_errno()) {
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            return false;
            }  
        else { 
            mysqli_set_charset($con,"utf8"); 
        }
 
        $query = "SELECT  actu_id, actu_empresa, actu_tipo, actu_texto, actu_fechacrea, actu_fechaopera, actu_fechavence, actu_estado, actu_app" 
                . " FROM actualizaciones ORDER BY actu_empresa ";             
        $result = mysqli_query($con, $query); 
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)  
            { 
                while($row = mysqli_fetch_assoc($result)) { 
                    $arr[] = $row; 
                } 
            } 
        echo $json_info = json_encode($arr);

    }
    