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
    case 'tc':
        traeCuentas($data);
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
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $control = $data->control;
    $qry = " CASE compTipo WHEN 'C' THEN 'Cbnte' ELSE 'Oper' END nonTipo";
    $wen = " AND compTipo IN ('C','O') ";
    if ($control == 'C2') {
        $qry = " CASE compTipo WHEN 'C' THEN 'Cbnte' ELSE 'In/Eg' END nonTipo";
        $wen = " AND compTipo = 'O' ";
    } {
        $query = "SELECT  compId, compEmpresaId, compCodigo, compTipo, " . $qry .
                ", compNombre, compDetalle, " .
                " compConsecutivo, compctadb0, compctadb1, compctadb2, compctacr0, compctacr1, compctacr2, " .
                " compActivo, compcpbnte " .
                " FROM contacomprobantes WHERE compEmpresaId = " . $empresa . $wen . " ORDER BY compTipo, compNombre ";
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
    $query = "DELETE FROM contacomprobantes WHERE compId=$data->compId";
    mysqli_query($con, $query);
    echo 'Ok';
}

function traeCuentas($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = $data->dato;
    $empresa = $data->empresa;
    $rec = explode('||', $dato);
    $ret = '';
    for ($i = 0; $i < count($rec); $i++) {
        $nombre = '';
        if ($rec[$i] != '') {
            $query = "SELECT pucNombre FROM contaplancontable WHERE pucEmpresaId = " . $empresa .
                    " AND pucCuenta='" . $rec[$i] . "' ";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $nombre = $row['pucNombre'];
            }
        }
        $ret .= $nombre . '||';
    }

    echo $ret;
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $compId = $data->compId;
    $compEmpresaId = $data->compEmpresaId;
    $compCodigo = $data->compCodigo;
    $compTipo = $data->compTipo;
    $compNombre = $data->compNombre;
    $compDetalle = $data->compDetalle;
    $compConsecutivo = $data->compConsecutivo;
    $compctadb0 = $data->compctadb0;
    $compctadb1 = $data->compctadb1;
    $compctadb2 = $data->compctadb2;
    $compctacr0 = $data->compctacr0;
    $compctacr1 = $data->compctacr1;
    $compctacr2 = $data->compctacr2;
    $compActivo = $data->compActivo;
    $compcpbnte = $data->compcpbnte;
    if ($compId == 0) {
        $query = "INSERT INTO contacomprobantes(compEmpresaId, compCodigo, compTipo, compNombre, compDetalle, " .
                " compConsecutivo, compctadb0, compctadb1, compctadb2, compctacr0, compctacr1, " .
                " compctacr2, compActivo, compcpbnte)";
        $query .= "  VALUES ('" . $compEmpresaId . "', '" . $compCodigo . "', '" . $compTipo . "', '" . $compNombre . "', '" .
                $compDetalle . "', '" . $compConsecutivo . "', '" . $compctadb0 . "', '" . $compctadb1 . "', '" .
                $compctadb2 . "', '" . $compctacr0 . "', '" . $compctacr1 . "', '" . $compctacr2 . "', '" . $compActivo .
                "', '" . $compcpbnte . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE contacomprobantes  SET compEmpresaId = '" . $compEmpresaId . "', compCodigo = '" . $compCodigo .
                "', compTipo = '" . $compTipo . "', compNombre = '" . $compNombre . "', compDetalle = '" . $compDetalle .
                "', compConsecutivo = '" . $compConsecutivo . "', compctadb0 = '" . $compctadb0 .
                "', compctadb1 = '" . $compctadb1 . "', compctadb2 = '" . $compctadb2 . "', compctacr0 = '" . $compctacr0 .
                "', compctacr1 = '" . $compctacr1 . "', compctacr2 = '" . $compctacr2 .
                "', compActivo = '" . $compActivo . "', compcpbnte = '" . $compcpbnte . "' WHERE compId = " . $compId;
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
    $expo .= '          <th>CODIGO</th>';
    $expo .= '          <th>TIPO</th>';
    $expo .= '          <th>NOMBRE</th>';
    $expo .= '          <th>DETALLE</th>';
    $expo .= '          <th>SECUENCIA</th>';
    $expo .= '          <th>CTA DB0</th>';
    $expo .= '          <th>CTA DB1</th>';
    $expo .= '          <th>CTA DB2</th>';
    $expo .= '          <th>CTA CR0</th>';
    $expo .= '          <th>CTA CR1</th>';
    $expo .= '          <th>CTA CR2</th>';
    $expo .= '          <th>COMPROBANTE CTBLE</th>';
    $expo .= '          <th>ACTIVO</th>';
    $query = "SELECT  compId, compEmpresaId, compCodigo, " .
            " CASE compTipo WHEN 'C' THEN 'Comprobante' ELSE 'Operacion' END compTipo, " .
            " compNombre, compDetalle, compConsecutivo, compctadb0, compctadb1, compctadb2, " .
            " compctacr0, compctacr1, compctacr2, compcpbnte, compActivo " .
            " FROM contacomprobantes WHERE compEmpresaId = " . $empresa .
            " ORDER BY compTipo desc, compNombre ";

    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['compId'] . '</td> ';
            $expo .= '<td>' . $row['compEmpresaId'] . '</td> ';
            $expo .= '<td>' . strval($row['compCodigo']) . '</td> ';
            $expo .= '<td>' . utf8_decode($row['compTipo']) . '</td> ';
            $expo .= '<td>' . utf8_decode($row['compNombre']) . '</td> ';
            $expo .= '<td>' . utf8_decode($row['compDetalle']) . '</td> ';
            $expo .= '<td>' . $row['compConsecutivo'] . '</td> ';
            $expo .= '<td>' . $row['compctadb0'] . '</td> ';
            $expo .= '<td>' . $row['compctadb1'] . '</td> ';
            $expo .= '<td>' . $row['compctadb2'] . '</td> ';
            $expo .= '<td>' . $row['compctacr0'] . '</td> ';
            $expo .= '<td>' . $row['compctacr1'] . '</td> ';
            $expo .= '<td>' . $row['compctacr2'] . '</td> ';
            $expo .= '<td>' . $row['compcpbnte'] . '</td> ';
            $expo .= '<td>' . $row['compActivo'] . '</td> ';
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
    $query = "SELECT  MAX(compId) as id 
                    FROM contacomprobantes";
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
    $compId = $data->compId;
    $query = "SELECT  compId, compEmpresaId, compCodigo, compTipo, compNombre, compDetalle, compConsecutivo, " .
            " compctadb0, compctadb1, compctadb2, compctacr0, compctacr1, compctacr2, compActivo, comcpbnte " .
            " FROM contacomprobantes  WHERE compId = " . $compId .
            " ORDER BY compNombre ";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Feb 10, 2020 8:53:04   <<<<<<< 
