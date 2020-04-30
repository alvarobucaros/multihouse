<?php

$data = json_decode(file_get_contents("php://input")); 
$op =  $data->op;
switch ($op)

{
    case 'r':
        leeRegistros($data);
        break;
    case 'b':
        borra($data);
        break;
    case 'a2':
        actualiza2($data);
        break;    
    case 'a':
        actualiza($data);
        break; 
    case 'u':
        unRegistro($data);
        break;
    case 'm':
        maxRegistroId($data);
        break;
}
  

 
    function  leeRegistros($data) 
    { 
       global $objClase;
      $con = $objClase->conectar(); 
       { 
            $sql = "SELECT  id, servidor, basedatos, usuario, password, estado" 
                    . " FROM mm_instala ORDER BY servidor ";             
            $result = mysqli_query($con, $sql); 
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
       global $objClase;
        $con = $objClase->conectar(); 
        $sql = "DELETE FROM mm_instala WHERE id=$data->id"; 
        mysqli_query($con, $sql); 
        echo 'Ok'; 
    }
 
    function actualiza2($data)
    { 
 //       error_reporting(0);
        $dato = $data->dato;
        $rec = explode('~',$dato);
        $servername =  $rec[0]; 
        $BaseDatos =  $rec[1]; 
        $username =  $rec[2]; 
        $password =  $rec[3]; 
        $std =  $rec[4];
        $estado=0;
        $err=0;
        if ($std==='W'){$estado=1;}
        $txt = funde($servername).'~'.funde($BaseDatos).'~'.funde($username) .'~'.funde($password) .'~'. $estado;  
        $file = fopen("../bin/cls/mh.ctl", "w");
        fwrite($file, $txt . PHP_EOL);
        fclose($file);
        
        $nota2= ''; //<p>Ya se hizo una instalacion en este servidor con esta base de datos</p>';

//        $link = mysqli_connect($servername, $username, $password, $BaseDatos);
//       
//        $err =  mysqli_connect_errno(); 
        if ($err)
        {
            if ($err === 1045 ) {$nota2 .= '<p>Usuario no creado y/o password errado</p>';}
            if ($err === 1044 ) {$nota2 .= '<p>El usuario no está creado en la base de datos</p>';}
            if ($err === 2001 ) {$nota2 .= '<p>No existe este servidor de base de datos</p>';}
            if ($err === 2002 ) {$nota2 .= '<p>No existe el servidor o No se puede conectar al servidor MySQL loca, verificar los archivos de configuración.</p>';}
            if ($err === 1049 ) {
                $nota2.='<p>Debe crear la Base de Datos '.$BaseDatos .'</p>'.'<p>Vaya a la carpeta scripts y ejecute creaBaseDatos.sql</p>';   
                actualiza($servername,$BaseDatos,$username,$password,$estado);                
            }
        }
//        else
//        {
//            if ($err === 0) {$nota2 = '<p>Ya se hizo una instalación en este servidor con esta Base de Batos</p>';
//                          //   $nota2 .= '<p>Si no lo ha hecho, para crear la base de datos debe ejecutar el script instalaDb.sql que está en la carpeta multimeeting/scripts </p>';
//                             $nota2 .= '<p>Para reinstalar borre la base de datos del servidor y repita este proceso.</p>';}            
//        }
                $nota2.='<p>Debe crear la Base de Datos '.$BaseDatos .'</p>'.'<p>Vaya a la carpeta scripts y ejecute useDatabase.sql y creaBaseDatos.sql</p>';   
                actualiza($servername,$BaseDatos,$username,$password,$estado);          
        $nota = 'Importante:'; //Error : '.$err;
        if ($err==0){$nota  = '';}
        echo $nota.'  '.$nota2;  
    }
    
    function  actualiza($servername,$BaseDatos,$username,$password,$estado)
    { 
        $hoy = date("l,M d, Y g:i:s");

        $file = fopen("../../scripts/creaBaseDatos.sql", "w");

        graba($file,"-- MySQL dbcreate database for multihouse");
        graba($file,"--");
        graba($file,"-- Host: ".$servername);    
        graba($file,"-- Database:".$BaseDatos);
        graba($file,"-- Script date ".$hoy); 
        graba($file,"-- by AtomIngenieria sas");
        graba($file,"");
        graba($file,"--");
        graba($file,"-- Crea el usuario");
        graba($file,"--"); 
        graba($file,"CREATE USER IF NOT EXISTS  ".$username."@".$servername ." IDENTIFIED BY '".$password."' ;");
        graba($file,"--");
        graba($file,"-- Crea Base de datos");
        graba($file,"--");
        graba($file,"CREATE DATABASE ".$BaseDatos ." CHARACTER SET utf8 COLLATE utf8_spanish_ci;");
        graba($file,"USE ".$BaseDatos. "; ");   
        graba($file,"--");
        graba($file,"-- Le da privilegios sobre la base de datos ");
        graba($file,"--");
        graba($file,"GRANT ALL PRIVILEGES ON " . $BaseDatos.".* TO ".$username."@".$servername ."; ");

        fclose($file);
        
        $file = fopen("../../scripts/useDatabase.sql", "w");

        graba($file,"USE ".$BaseDatos."; "); 
        fclose($file);
        $file = file_get_contents('../../scripts/useDatabase.sql');
        $file .= file_get_contents('../../app/inc/BaseDatos.sql');
        file_put_contents('../../scripts/estructuraBaseDatos.sql', $file);
        unlink('../../scripts/useDatabase.sql');
        echo '          
                <a href="documentation/Presentacion.pdf" class="btn btn-primary btn-block btn-flat"> 
                Ver Folleto empresarial</a>

                <a href="documentation/instalacion.pdf" class="btn btn-primary btn-block btn-flat"> 
                Ver manual instalaciòn</a>
            ';           
        }
 
function grabar($ar,$ln){
    str_replace('|','"',$ln);
    fputs($ar,$ln);
    fputs($ar,"\n");
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
    function maxRegistroId($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id=0;
        $sql = "SELECT  MAX(id) as id 
                    FROM mm_instala"; 
        $result = mysqli_query($con, $sql); 
            while($row = mysqli_fetch_assoc($result)) { 
                $id = $row['id'];
                $id +=1;
           } 
        echo $id; 
        return $id; 
        } 
 
    function unRegistro($data) 
    { 
       global $objClase;
        $con = $objClase->conectar();	 
        $id = $data->id;      
        $sql = "SELECT  id, servidor, basedatos, usuario, password, estado  " . 
                    " FROM mm_instala  WHERE id = " . $id  . 
                    " ORDER BY servidor "; 
        $result = mysqli_query($con, $sql); 
        $arr = array(); 
        if(mysqli_num_rows($result) != 0)  
        { 
            while($row = mysqli_fetch_assoc($result)) { 
                $arr[] = $row;
           } 
        } 
        echo $json_info = json_encode($arr); 
 
    } 
 
 function graba($ar,$ln){
    str_replace('|','"',$ln);
    fputs($ar,$ln);
    fputs($ar,"\n");
}	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Nov 04, 2018 12:51:53   <<<<<<< 
