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
    case '1':
        lista1($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    {
        $query = "SELECT  acuerdoid, acuerdoempresa, acuerdoinmueble, inmuebleCodigo, acuerdofecha, acuerdovalor, " .
                " acuerdoplazo, acuerdodetalle, acuerdopropietario, acuerdomora, acuerdocorriente, acuerdodescmora"
                . " FROM contaacuerdos INNER JOIN containmuebles ON acuerdoinmueble = inmuebleId  " .
                "ORDER BY acuerdofecha ";
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
    $query = "DELETE FROM contaacuerdos WHERE acuerdoid=$data->acuerdoid";
    mysqli_query($con, $query);
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $acuerdoid = $data->acuerdoid;
    $acuerdoempresa = $data->acuerdoempresa;
    $acuerdoinmueble = $data->acuerdoinmueble;
    $acuerdofecha = $data->acuerdofecha;
    $acuerdovalor = $data->acuerdovalor;
    $acuerdoplazo = $data->acuerdoplazo;
    $acuerdodetalle = $data->acuerdodetalle;
    $acuerdopropietario = $data->acuerdopropietario;
    $acuerdomora = $data->acuerdomora;
    $acuerdocorriente = $data->acuerdocorriente;
    $acuerdodescmora = $data->acuerdodescmora;
    if ($acuerdopropietario == 0) {
        $acuerdopropietario = traePropietario($acuerdoinmueble, $acuerdoempresa);
    }
    if ($acuerdoid == 0) {
        $query = "INSERT INTO contaacuerdos(acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario, acuerdomora, acuerdocorriente, acuerdodescmora)";
        $query .= "  VALUES ('" . $acuerdoempresa . "', '" . $acuerdoinmueble . "', '" . $acuerdofecha . "', '" . $acuerdovalor . "', '" . $acuerdoplazo . "', '" . $acuerdodetalle . "', '" . $acuerdopropietario . "', '" . $acuerdomora . "', '" . $acuerdocorriente . "', '" . $acuerdodescmora . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE contaacuerdos  SET acuerdoempresa = '" . $acuerdoempresa . "', acuerdoinmueble = '" . $acuerdoinmueble . "', acuerdofecha = '" . $acuerdofecha . "', acuerdovalor = '" . $acuerdovalor . "', acuerdoplazo = '" . $acuerdoplazo . "', acuerdodetalle = '" . $acuerdodetalle . "', acuerdopropietario = '" . $acuerdopropietario . "', acuerdomora = '" . $acuerdomora . "', acuerdocorriente = '" . $acuerdocorriente . "', acuerdodescmora = '" . $acuerdodescmora . "' WHERE acuerdoid = " . $acuerdoid;
        mysqli_query($con, $query);
        echo 'Ok';
    }
}

function traePropietario($acuerdoinmueble, $empresa) {
    global $objClase;
    $con = $objClase->conectar();
    $PropietarioId = 0;
    $query = "SELECT contaInmuPropietarioPropietarioId FROM containmueblepropietario " .
            " WHERE contaInmuPropietarioEmpresaId = " . $empresa .
            "  AND contaInmuPropietarioInmuebleId = " . $acuerdoinmueble;
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $PropietarioId = $row['contaInmuPropietarioPropietarioId'];
        }
    }
    //  echo $PropietarioId;
    return $PropietarioId;
}

function exportaXls($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $expo = '';
    $expo .= '<table border=1 class="table2Excel"> ';
    $expo .= '<tr> ';
//        $expo .=  '          <th>ID</th>';
//        $expo .=  '          <th>EMPRESA</th>';
    $expo .= '          <th>INMUEBLE</th>';
    $expo .= '          <th>FECHA</th>';
    $expo .= '          <th>VALOR</th>';
    $expo .= '          <th>PLAZO</th>';
    $expo .= '          <th>DETALLE</th>';
    $expo .= '          <th>PROPIETARIO</th>';
    $expo .= '          <th>MORA</th>';
    $expo .= '          <th>CORRIENTE</th>';
    $expo .= '          <th>DESCMORA</th>';
    $query = "SELECT  acuerdoid, acuerdoempresa, acuerdoinmueble, inmuebleCodigo, acuerdofecha, acuerdovalor, " .
            " acuerdoplazo, acuerdodetalle, acuerdopropietario, acuerdomora, acuerdocorriente, acuerdodescmora"
            . " FROM contaacuerdos INNER JOIN containmuebles ON acuerdoinmueble = inmuebleId  " .
            "ORDER BY acuerdofecha ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
//                $expo .=  	'<td>' .$row['acuerdoid']. '</td> ';
//                $expo .=  	'<td>' .$row['acuerdoempresa']. '</td> ';
            $expo .= '<td>' . $row['inmuebleCodigo'] . '</td> ';
            $expo .= '<td>' . $row['acuerdofecha'] . '</td> ';
            $expo .= '<td>' . $row['acuerdovalor'] . '</td> ';
            $expo .= '<td>' . $row['acuerdoplazo'] . '</td> ';
            $expo .= '<td>' . $row['acuerdodetalle'] . '</td> ';
            $expo .= '<td>' . $row['acuerdopropietario'] . '</td> ';
            $expo .= '<td>' . $row['acuerdomora'] . '</td> ';
            $expo .= '<td>' . $row['acuerdocorriente'] . '</td> ';
            $expo .= '<td>' . $row['acuerdodescmora'] . '</td> ';
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
    $query = "SELECT  MAX(acuerdoid) as id 
                    FROM contaacuerdos";
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
    $acuerdoid = $data->acuerdoid;
    $query = "SELECT  acuerdoid, acuerdoempresa, acuerdoinmueble, acuerdofecha, acuerdovalor, acuerdoplazo, acuerdodetalle, acuerdopropietario, acuerdomora, acuerdocorriente, acuerdodescmora  " .
            " FROM contaacuerdos  WHERE acuerdoid = " . $acuerdoid .
            " ORDER BY acuerdofecha ";
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
    $query = "SELECT inmuebleId,  inmuebleCodigo FROM containmuebles " .
            " WHERE inmueblePrincipal ='SI' AND inmuebleEmpresaId = " . $empresa .
            " ORDER BY  inmuebleCodigo";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista1($data) {
    global $objClase;
    $empresa = $data->empresa;
    $con = $objClase->conectar();
    $query = "SELECT propietarioId,  propietarioNombre FROM contapropietarios " .
            " WHERE propietarioEmpresaId = " . $empresa . " ORDER BY  propietarioNombre";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Dec 09, 2019 7:55:59   <<<<<<< 
