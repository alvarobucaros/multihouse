<?php

require_once 'clsConection.php';
$obj = new DBconexion;
$con = $obj->conect();

function leeMenu($empresa, $usuario)
{
    $strSql = "SELECT  menu_descripcion, menu_nodo, menu_nodoPadre, menu_modulo, menu_orden , " .
        " concat( menu_nodoPadre, menu_orden ) AS op " .
        " FROM mmeeting.mm_menu ".
        " INNER JOIN mn_privilegios ON  menu_codigo = privilegio_menu ".
        " INNER JOIN mm_usuarios ON usuario_perfil = privilegio_perfil ".
        " WHERE menu_empresa = " . $empresa . "  AND usuario_id = " . $usuario .
        " order by  menu_nodoPadre, menu_orden ";
      
    if($con==true)
    {
        $resultado =  mysqli_query($con, $strSql);
        while( $reg = mysqli_fetch_array($result, MYSQLI_NUM) ){
            $cod=$reg[0]; 
            $des=$reg[1];  
            if ($sel==$cod){
                $respuesta .= "<option value='".$cod."' selected>$des</option>";
            }else{
                $respuesta .= "<option value='".$cod."'>$des</option>";
            }                    
        }
    }
}