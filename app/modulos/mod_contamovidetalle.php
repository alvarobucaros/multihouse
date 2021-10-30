<?php

include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion('atominge_ncr', '127,0,0,1', 'root', '');
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
    case '1':
        lista1($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    {
        $query = "SELECT  moviConId, moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2"
                . " FROM contamovidetalle ORDER BY moviConCuenta ";
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
    $query = "DELETE FROM contamovidetalle WHERE moviConId=$data->moviConId";
    mysqli_query($con, $query);
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $moviConId = $data->moviConId;
    $moviConCabezaId = $data->moviConCabezaId;
    $moviConDetalle = $data->moviConDetalle;
    $moviConCuenta = $data->moviConCuenta;
    $moviConDebito = $data->moviConDebito;
    $moviConCredito = $data->moviConCredito;
    $moviConBase = $data->moviConBase;
    $moviConImpTipo = $data->moviConImpTipo;
    $moviConImpPorc = $data->moviConImpPorc;
    $moviConImpValor = $data->moviConImpValor;
    $moviConIdTercero = $data->moviConIdTercero;
    $moviDocum1 = $data->moviDocum1;
    $moviDocum2 = $data->moviDocum2;

    if ($moviConId == 0) {
        $query = "INSERT INTO contamovidetalle(moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2)";
        $query .= "  VALUES ('" . $moviConCabezaId . "', '" . $moviConDetalle . "', '" . $moviConCuenta . "', '" . $moviConDebito . "', '" . $moviConCredito . "', '" . $moviConBase . "', '" . $moviConImpTipo . "', '" . $moviConImpPorc . "', '" . $moviConImpValor . "', '" . $moviConIdTercero . "', '" . $moviDocum1 . "', '" . $moviDocum2 . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE contamovidetalle  SET moviConCabezaId = '" . $moviConCabezaId . "', moviConDetalle = '" . $moviConDetalle . "', moviConCuenta = '" . $moviConCuenta . "', moviConDebito = '" . $moviConDebito . "', moviConCredito = '" . $moviConCredito . "', moviConBase = '" . $moviConBase . "', moviConImpTipo = '" . $moviConImpTipo . "', moviConImpPorc = '" . $moviConImpPorc . "', moviConImpValor = '" . $moviConImpValor . "', moviConIdTercero = '" . $moviConIdTercero . "', moviDocum1 = '" . $moviDocum1 . "', moviDocum2 = '" . $moviDocum2 . "' WHERE moviConId = " . $moviConId;
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
    $expo .= '          <th>CABEZA</th>';
    $expo .= '          <th>DETALLE</th>';
    $expo .= '          <th>CUENTA</th>';
    $expo .= '          <th>VALOR DEBITO</th>';
    $expo .= '          <th>VALOR CREDITO</th>';
    $expo .= '          <th>BASE</th>';
    $expo .= '          <th>TIPO IMPUESTO</th>';
    $expo .= '          <th>IMPUESTO %</th>';
    $expo .= '          <th>IMPUESTO VALOR</th>';
    $expo .= '          <th>IDTERCERO</th>';
    $expo .= '          <th>MOVIDOCUM1</th>';
    $expo .= '          <th>MOVIDOCUM2</th>';
    $query = "SELECT  moviConId, moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2"
            . " FROM contamovidetalle ORDER BY moviConCuenta ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['moviConId'] . '</td> ';
            $expo .= '<td>' . $row['moviConCabezaId'] . '</td> ';
            $expo .= '<td>' . $row['moviConDetalle'] . '</td> ';
            $expo .= '<td>' . $row['moviConCuenta'] . '</td> ';
            $expo .= '<td>' . $row['moviConDebito'] . '</td> ';
            $expo .= '<td>' . $row['moviConCredito'] . '</td> ';
            $expo .= '<td>' . $row['moviConBase'] . '</td> ';
            $expo .= '<td>' . $row['moviConImpTipo'] . '</td> ';
            $expo .= '<td>' . $row['moviConImpPorc'] . '</td> ';
            $expo .= '<td>' . $row['moviConImpValor'] . '</td> ';
            $expo .= '<td>' . $row['moviConIdTercero'] . '</td> ';
            $expo .= '<td>' . $row['moviDocum1'] . '</td> ';
            $expo .= '<td>' . $row['moviDocum2'] . '</td> ';
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
    $query = "SELECT  MAX(moviConId) as id 
                    FROM contamovidetalle";
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
    $moviConId = $data->moviConId;
    $query = "SELECT  moviConId, moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2  " .
            " FROM contamovidetalle  WHERE moviConId = " . $moviConId .
            " ORDER BY moviConCuenta ";
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
    $query = "SELECT pucCuenta,  pucNombre FROM contaplancontable ORDER BY  pucNombre";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista1() {
    global $objClase;
    $con = $objClase->conectar();
    $query = "SELECT terceroId,  terceroNombre FROM contaterceros ORDER BY  terceroNombre";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 10:35:06   <<<<<<< 
