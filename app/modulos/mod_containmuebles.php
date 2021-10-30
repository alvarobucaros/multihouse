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
    case 'cal':
        recalculaCoeficientes($data);
        break;
    case '0':
        lista0($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = trim($data->empresa);
    {
        $query = "SELECT  inmuebleId, inmuebleEmpresaId, inmuebleCodigo, inmuebleDescripcion, " .
                " inmueblePrincipal, inmuebleArea, inmuebleCoeficiente, inmuebleUbicacion, " .
                " inmuebleClasificacionId, clasificacionCodigo,  inmuebleDepende" .
                " FROM containmuebles INNER JOIN contaclasificacion ON inmuebleClasificacionId = clasificacionId " .
                " WHERE inmuebleEmpresaId = '" . $empresa . "' ORDER BY inmuebleCodigo ";

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

function recalculaCoeficientes($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = trim($data->empresa);
    $area = 0.0;
    $retorno = 'Ok';
    {
        $query = "SELECT sum(inmuebleArea) as area FROM containmuebles WHERE inmuebleEmpresaId =  " . $empresa;
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $area = $row['area'];
        }

        if ($area > 0) {
            $query = "UPDATE  containmuebles SET inmuebleCoeficiente = inmuebleArea / " . $area .
                    " WHERE inmuebleEmpresaId =  " . $empresa . " AND inmuebleId > 0";
            $result = mysqli_query($con, $query);

            echo $retorno;
        }
    }
}

function borra($data) {
    global $objClase;
    $con = $objClase->conectar();
    $query = "DELETE FROM containmuebles WHERE inmuebleId=$data->inmuebleId";
    $resul = mysqli_query($con, $query);
    if (mysqli_errno($con) === 1451) {
        echo 'Err. Este Inmueble Tiene facturación asociada, No se puede borrar';
        return;
    }
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $inmuebleId = $data->inmuebleId;
    $inmuebleEmpresaId = $data->inmuebleEmpresaId;
    $inmuebleCodigo = $data->inmuebleCodigo;
    $inmuebleDescripcion = $data->inmuebleDescripcion;
    $inmueblePrincipal = $data->inmueblePrincipal;
    $inmuebleArea = $data->inmuebleArea;
    $inmuebleCoeficiente = $data->inmuebleCoeficiente;
    $inmuebleUbicacion = $data->inmuebleUbicacion;
    $inmuebleClasificacionId = $data->inmuebleClasificacionId;
    $inmuebleDepende = $data->inmuebleDepende;

    if ($inmuebleId == 0) {
        $query = "INSERT INTO containmuebles(inmuebleEmpresaId, inmuebleCodigo, inmuebleDescripcion, inmueblePrincipal, inmuebleArea, inmuebleCoeficiente, inmuebleUbicacion, inmuebleClasificacionId, inmuebleDepende)";
        $query .= "  VALUES ('" . $inmuebleEmpresaId . "', '" . $inmuebleCodigo . "', '" . $inmuebleDescripcion . "', '" . $inmueblePrincipal . "', '" . $inmuebleArea . "', '" . $inmuebleCoeficiente . "', '" . $inmuebleUbicacion . "', '" . $inmuebleClasificacionId . "', '" . $inmuebleDepende . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE containmuebles  SET inmuebleEmpresaId = '" . $inmuebleEmpresaId . "', inmuebleCodigo = '" . $inmuebleCodigo . "', inmuebleDescripcion = '" . $inmuebleDescripcion . "', inmueblePrincipal = '" . $inmueblePrincipal . "', inmuebleArea = '" . $inmuebleArea . "', inmuebleCoeficiente = '" . $inmuebleCoeficiente . "', inmuebleUbicacion = '" . $inmuebleUbicacion . "', inmuebleClasificacionId = '" . $inmuebleClasificacionId . "', inmuebleDepende = '" . $inmuebleDepende . "' WHERE inmuebleId = " . $inmuebleId;
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
    //      $expo .=  '          <th>ID</th>';
    //      $expo .=  '          <th>EMPRESA</th>';
    $expo .= '          <th>CODIGO</th>';
    $expo .= '          <th>DESCRIPCION</th>';
    $expo .= '          <th>PRINCIPAL</th>';
    $expo .= '          <th>AREA</th>';
    $expo .= '          <th>COEFICIENTE</th>';
    $expo .= '          <th>UBICACION</th>';
    $expo .= '          <th>CLASIFICACION</th>';
    $expo .= '          <th>DEPENDE</th>';
    $query = "SELECT  inmuebleId, inmuebleEmpresaId, inmuebleCodigo, inmuebleDescripcion, " .
            " inmueblePrincipal, inmuebleArea, inmuebleCoeficiente, inmuebleUbicacion, " .
            " inmuebleClasificacionId, clasificacionCodigo,  inmuebleDepende" .
            " FROM containmuebles INNER JOIN contaclasificacion ON inmuebleClasificacionId = clasificacionId " .
            " WHERE inmuebleEmpresaId = '" . $empresa . "' ORDER BY inmuebleCodigo ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            //               $expo .=  	'<td>' .$row['inmuebleId']. '</td> ';
            //               $expo .=  	'<td>' .$row['inmuebleEmpresaId']. '</td> ';
            $expo .= '<td>' . $row['inmuebleCodigo'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleDescripcion'] . '</td> ';
            $expo .= '<td>' . $row['inmueblePrincipal'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleArea'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleCoeficiente'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleUbicacion'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleClasificacionId'] . '</td> ';
            $expo .= '<td>' . $row['inmuebleDepende'] . '</td> ';
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
    $query = "SELECT  MAX(inmuebleId) as id 
                    FROM containmuebles";
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
    $inmuebleId = $data->inmuebleId;
    $query = "SELECT  inmuebleId, inmuebleEmpresaId, inmuebleCodigo, inmuebleDescripcion, inmueblePrincipal, inmuebleArea, inmuebleCoeficiente, inmuebleUbicacion, inmuebleClasificacionId, inmuebleDepende  " .
            " FROM containmuebles  WHERE inmuebleId = " . $inmuebleId .
            " ORDER BY inmuebleCodigo ";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista0($data) {
    global $objClase;
    $empresa = $data->empresa;
    $con = $objClase->conectar();
    $query = "SELECT clasificacionId,   clasificacionCodigo " .
            " FROM contaclasificacion " .
            " WHERE clasificacionEmpresaId = " . $empresa . " ORDER BY   clasificacionCodigo";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Sep 17, 2019 9:40:35   <<<<<<< 
