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
    case 'b':
        borra($data);
        break;
    case 'a':
        actualiza($data);
        break; 
    case 'u':
        unRegistro($data);
        break;
}
   
    function  leeRegistros($data) 
    { 
      $objClase = new DBconexion(); 
      $con = $objClase->conectar(); 
      $empresa =  $data->empresa;
       { 
            $query = "SELECT comite_id, comite_empresa, comite_nombre, comite_descripcion, comite_activo, comite_lider, comite_email, comite_consecActa" 
                    . " FROM mm_comites  WHERE comite_empresa = " . $empresa . " ORDER BY comite_nombre";             
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
    } 
 
    function borra($data)
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $info ='Ok'; 
        $query = "DELETE FROM mm_comites WHERE comite_id=$data->comite_id"; 
        mysqli_query($con, $query); 
        $err = mysqli_errno($con);
        if($err == '1451'){$info='No se puede borrar, este se utiliza en una agenda, para no usuarlo se puede inhabilitar';}
        echo $info; 
    }
 
    function actualiza($data)
    {     
        $objClase = new DBconexion(); 
        $con = $objClase->conectar(); 
        $op =  $data->op;	 
        $comite_id =  $data->comite_id; 
        $comite_empresa =  $data->comite_empresa; 
        $comite_nombre =  $data->comite_nombre; 
        $comite_descripcion =  $data->comite_descripcion; 
        $comite_activo =  $data->comite_activo; 
        $comite_lider =  $data->comite_lider; 
        $comite_email =  $data->comite_email; 
        $comite_consecActa =  $data->comite_consecActa; 
   
        if($comite_id  == 0) 
        { 
            $nr = registroControl($comite_empresa);
            if ($nr==0 || $nr == 99){
                $condicion = "comite_empresa = '" . $comite_empresa . 
                        "' AND comite_nombre = '" .$comite_nombre."' ";
                $nr = $objClase->cuentaRegistros('mm_comites', $condicion);
                if($nr==0)
                {
                    $query = "INSERT INTO mm_comites(comite_empresa, comite_nombre, comite_descripcion, comite_activo, " .
                            " comite_lider, comite_email, comite_consecActa)";
                    $query .= "  VALUES ('" . $comite_empresa."', '".$comite_nombre."', '".$comite_descripcion."', '".
                            $comite_activo."', '".$comite_lider."', '".$comite_email."', '".$comite_consecActa."')";  
                    mysqli_query($con, $query);
                    echo 'Ok';              
                }else{ echo 'Ya existe este comité '.$comite_nombre;}
            }
            else
            {
                echo 'Lic';
            }
        } 
        else 
        { 
            $query = "UPDATE mm_comites  SET comite_empresa = '".$comite_empresa."', comite_nombre = '".
                    $comite_nombre."', comite_descripcion = '".$comite_descripcion."', comite_activo = '".
                    $comite_activo."', comite_lider = '".$comite_lider."', comite_email = '".
                    $comite_email."', comite_consecActa = '".$comite_consecActa.
                    "' WHERE comite_id = ".$comite_id;
            mysqli_query($con, $query); 
            echo 'Ok';
        } 
 
    } 
 
    function unRegistro($data) 
    { 
        $objClase = new DBconexion(); 
        $con = $objClase->conectar();	 
        $comite_id = $data->comite_id;      
        $query = "SELECT  comite_id, comite_empresa, comite_nombre, comite_descripcion, comite_activo, comite_lider, comite_email, comite_consecActa  " . 
                    " FROM mm_comites  WHERE comite_id = " . $comite_id  . 
                    " ORDER BY comite_nombre "; 
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
 
    function registroControl($empresa){
        $result='OK';
        $fd = fopen('../bin/cls/mm.ctl', 'r');
        $datos = fread($fd,100);
        fclose($fd);
        $data =explode('~',$datos);
//        $this->Servidor = $this->funde($data[0]);
//        $this->BaseDatos = $this->funde($data[1]);
//        $this->Usuario = $this->funde($data[2]);
        $arr = $data[3];
        if ($arr === 1){return 99;}
        if ($arr === 0){return 0;} 
        
//        $objClase = new DBconexion(); 
//        $con = $objClase->conectar();	      
//        $query = "SELECT empresa_ctrl FROM mm_empresa where empresa_id = " . $empresa; 
//        $result = mysqli_query($con, $query); 
//        if(mysqli_num_rows($result) != 0)  
//            { 
//            while($row = mysqli_fetch_assoc($result)) 
//                { 
//                    $arr = substr($row['empresa_ctrl'],15,1); //'wefB875s13846s112518refd8624A12'
//                    $condicion = "comite_empresa = '" . $empresa ."' ";
//                    $nr = $objClase->cuentaRegistros('mm_comites', $condicion);
//                    if ($arr==1){return 99;}
//                    if($nr==0 && $arr == 0)   {
//                        return 0;
//                    } else {
//                        return -1;
//                    }
//                }
//            }
    }
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Oct 09, 2017 5:35:33   <<<<<<< 
