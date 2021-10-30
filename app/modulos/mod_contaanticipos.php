<?php

include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input"));
$op = mysqli_real_escape_string($con, $data->op);

switch ($op) {
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
    case 'm':
        maxRegistroId($data);
        break;
    case 'exp':
        exportaXls($data);
        break;
    case '0':
        lista0($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    {
        $query = "SELECT  anticipoid, anticipoempresa, anticipoinmueble, anticipofecha, anticipovalor, anticiposaldo"
                . " FROM contaanticipos ORDER BY anticipoinmueble ";
        $result = mysqli_query($con, $query);
        $arr = array();
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }
        }
        echo $json_info = json_encode($arr);
    }
}

function borra($data) {
    global $objClase;
    $con = $objClase->conectar();
    $query = "DELETE FROM contaanticipos WHERE anticipoid=$data->anticipoid";
    mysqli_query($con, $query);
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $anticipoid = $data->anticipoid;
    $anticipoempresa = $data->anticipoempresa;
    $anticipoinmueble = $data->anticipoinmueble;
    $anticipofecha = $data->anticipofecha;
    $anticipovalor = $data->anticipovalor;
    $anticiposaldo = $data->anticiposaldo;

    if ($anticipoid == 0) {
        $query = "INSERT INTO contaanticipos(anticipoempresa, anticipoinmueble, anticipofecha, anticipovalor, anticiposaldo)";
        $query .= "  VALUES ('" . $anticipoempresa . "', '" . $anticipoinmueble . "', '" . $anticipofecha . "', '" . $anticipovalor . "', '" . $anticiposaldo . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE contaanticipos  SET anticipoempresa = '" . $anticipoempresa . "', anticipoinmueble = '" . $anticipoinmueble . "', anticipofecha = '" . $anticipofecha . "', anticipovalor = '" . $anticipovalor . "', anticiposaldo = '" . $anticiposaldo . "' WHERE anticipoid = " . $anticipoid;
        mysqli_query($con, $query);
        echo 'Ok';
    }
}

function exportaXls($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $expo = '';
    $expo .= '<table border=1 class="table2Excel"> ';
    $expo .= '<tr> ';
    $expo .= '          <th>ID</th>';
    $expo .= '          <th>EMPRESA</th>';
    $expo .= '          <th>INMUEBLE</th>';
    $expo .= '          <th>FECHA</th>';
    $expo .= '          <th>VALOR</th>';
    $expo .= '          <th>SALDO</th>';
    $query = "SELECT  anticipoid, anticipoempresa, anticipoinmueble, anticipofecha, anticipovalor, anticiposaldo"
            . " FROM contaanticipos ORDER BY anticipoinmueble ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['anticipoid'] . '</td> ';
            $expo .= '<td>' . $row['anticipoempresa'] . '</td> ';
            $expo .= '<td>' . $row['anticipoinmueble'] . '</td> ';
            $expo .= '<td>' . $row['anticipofecha'] . '</td> ';
            $expo .= '<td>' . $row['anticipovalor'] . '</td> ';
            $expo .= '<td>' . $row['anticiposaldo'] . '</td> ';
            $expo .= '</tr> ';
        }
    }
    $expo .= '</table> ';
    echo $expo;
    return $expo;
}

function maxRegistroId($data) {
    global $objClase;
    $con = $objClase->conectar();
    $id = 0;
    $query = "SELECT  MAX(anticipoid) as id 
                    FROM contaanticipos";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $id += 1;
    }
    echo $id;
    return $id;
}

function unRegistro($data) {
    global $objClase;
    $con = $objClase->conectar();
    $anticipoid = $data->anticipoid;
    $query = "SELECT  anticipoid, anticipoempresa, anticipoinmueble, anticipofecha, anticipovalor, anticiposaldo  " .
            " FROM contaanticipos  WHERE anticipoid = " . $anticipoid .
            " ORDER BY anticipoinmueble ";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista0() {
    global $objClase;
    $con = $objClase->conectar();
    $query = "SELECT inmuebleId,  inmuebleCodigo FROM containmuebles ORDER BY  inmuebleCodigo";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Saturday,Oct 19, 2019 11:56:12   <<<<<<< 
