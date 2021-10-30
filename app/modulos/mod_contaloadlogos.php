<?php

include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input"));
$op = mysqli_real_escape_string($con, $data->op);

switch ($op) {


    case 'lo':
        loadLogo($data);
        break;


    case 'av':
        loadAvatar($data);
        break;
}

function loadLogo($data) {
    $objClase = new DBconexion();
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT empresaLogo  FROM contaempresas  WHERE empresaId = " . $empresa;
    $result = mysqli_query($con, $query);
    $logo = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $logo = $row['empresaLogo'];
    }
    echo $logo;
    return $logo;
}

function loadAvatar($data) {
    $objClase = new DBconexion();
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $usuario = $data->usuario;
    $query = " SELECT usuario_avatar  FROM mm_usuarios  WHERE usuario_id = " . $usuario . "  AND usuario_empresa = " . $empresa;
    $result = mysqli_query($con, $query);
    $avatar = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $avatar = $row['usuario_avatar'];
    }
    echo $avatar;
    return $avatar;
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 23, 2018 5:18:20   <<<<<<< 
