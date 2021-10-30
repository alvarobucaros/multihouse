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
    case '1':
        lista1($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    {
        $query = "SELECT  ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, 
		 ServicioPeriodo, ServicioFechaDesde, ServicioFechaHasta, ServicioValor, 
		 ServicioPrioridad, ServicioTipo, ServicioMora, ServicioMoraPorcentaje, 
		 servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, ServicioPPporcentaje, 
		 ServicioPPvalor, ServicioActivo, ServicioAmbito, servicioClasificacionId,
                 CASE ServicioAmbito WHEN 'G' THEN 'Grupo' ELSE 'Todos' END nomcase, clasificacionCodigo AS ServicioAmbitoNom
		 FROM contaservicios 
		 INNER JOIN  contaclasificacion ON  servicioClasificacionId = clasificacionId  
		 WHERE servicioClasificacionId > 0 AND servicioEmpresaId = " . $empresa . " AND clasificacionEmpresaId = servicioEmpresaId
UNION
SELECT  ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, 
		 ServicioPeriodo, ServicioFechaDesde, ServicioFechaHasta, ServicioValor, 
		 ServicioPrioridad, ServicioTipo, ServicioMora, ServicioMoraPorcentaje, 
		 servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, ServicioPPporcentaje, 
		 ServicioPPvalor, ServicioActivo, ServicioAmbito, servicioClasificacionId,
                 CASE ServicioAmbito WHEN 'G' THEN 'Grupo' ELSE 'Todos' END nomcase, '' AS ServicioAmbitoNom
		 FROM contaservicios 		 
		 WHERE servicioClasificacionId = 0  AND servicioEmpresaId = " . $empresa .
                " ORDER BY ServicioDetalle";

//            $query = "SELECT  ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, " .
//                    " ServicioPeriodo, ServicioFechaDesde, ServicioFechaHasta, ServicioValor, " .
//                    " ServicioPrioridad, ServicioTipo, ServicioMora, ServicioMoraPorcentaje, ".
//                    " servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, ServicioPPporcentaje, " .
//                    " ServicioPPvalor, ServicioActivo, ServicioAmbito, clasificacionCodigo AS servicioClasificacionId" .
//                    " FROM contaservicios ".
//                    " INNER JOIN  contaclasificacion ON  servicioClasificacionId = clasificacionId " . 
//                    " WHERE servicioEmpresaId = " . $empresa .
//                    " ORDER BY ServicioDetalle ";             
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
    $query = "DELETE FROM contaservicios WHERE ServicioId=$data->ServicioId";
    $resul = mysqli_query($con, $query);
    if ($resul != 0) {
        echo mysqli_errno($con);
    } else {
        if (mysqli_errno($con) === 1451) {
            echo 'Err. Este Servicio Tiene facturación asociada, No se puede borrar';
            return;
        }
    }
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $ServicioId = $data->ServicioId;
    $servicioEmpresaId = $data->servicioEmpresaId;
    $ServicioCodigo = $data->ServicioCodigo;
    $ServicioDetalle = $data->ServicioDetalle;
    $ServicioPeriodo = $data->ServicioPeriodo;
    $ServicioFechaDesde = $data->ServicioFechaDesde;
    $ServicioFechaHasta = $data->ServicioFechaHasta;
    $ServicioValor = $data->ServicioValor;
    $ServicioPrioridad = $data->ServicioPrioridad;
    $ServicioTipo = $data->ServicioTipo;
    $ServicioMora = $data->ServicioMora;
    $ServicioMoraPorcentaje = $data->ServicioMoraPorcentaje;
    $servicioMoraValor = $data->servicioMoraValor;
    $ServicioCuentaDB = $data->ServicioCuentaDB;
    $ServicioCuentaCR = $data->ServicioCuentaCR;
    $ServicioPPporcentaje = $data->ServicioPPporcentaje;
    $ServicioPPvalor = $data->ServicioPPvalor;
    $ServicioActivo = $data->ServicioActivo;
    $ServicioAmbito = $data->ServicioAmbito;
    $servicioClasificacionId = $data->servicioClasificacionId;

    if ($ServicioId == 0) {
        $query = "INSERT INTO contaservicios(servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, ServicioMora, ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioActivo, ServicioAmbito, servicioClasificacionId)";
        $query .= "  VALUES ('" . $servicioEmpresaId . "', '" . $ServicioCodigo . "', '" . $ServicioDetalle . "', '" . $ServicioPeriodo . "', '" . $ServicioFechaDesde . "', '" . $ServicioFechaHasta . "', '" . $ServicioValor . "', '" . $ServicioPrioridad . "', '" . $ServicioTipo . "', '" . $ServicioMora . "', '" . $ServicioMoraPorcentaje . "', '" . $servicioMoraValor . "', '" . $ServicioCuentaDB . "', '" . $ServicioCuentaCR . "', '" . $ServicioPPporcentaje . "', '" . $ServicioPPvalor . "', '" . $ServicioActivo . "', '" . $ServicioAmbito . "', '" . $servicioClasificacionId . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE contaservicios  SET servicioEmpresaId = '" . $servicioEmpresaId . "', ServicioCodigo = '" . $ServicioCodigo . "', ServicioDetalle = '" . $ServicioDetalle . "', ServicioPeriodo = '" . $ServicioPeriodo . "', ServicioFechaDesde = '" . $ServicioFechaDesde . "', ServicioFechaHasta = '" . $ServicioFechaHasta . "', ServicioValor = '" . $ServicioValor . "', ServicioPrioridad = '" . $ServicioPrioridad . "', ServicioTipo = '" . $ServicioTipo . "', ServicioMora = '" . $ServicioMora . "', ServicioMoraPorcentaje = '" . $ServicioMoraPorcentaje . "', servicioMoraValor = '" . $servicioMoraValor . "', ServicioCuentaDB = '" . $ServicioCuentaDB . "', ServicioCuentaCR = '" . $ServicioCuentaCR . "', ServicioPPporcentaje = '" . $ServicioPPporcentaje . "', ServicioPPvalor = '" . $ServicioPPvalor . "', ServicioActivo = '" . $ServicioActivo . "', ServicioAmbito = '" . $ServicioAmbito . "', servicioClasificacionId = '" . $servicioClasificacionId . "' WHERE ServicioId = " . $ServicioId;
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
    $expo .= '          <th>DETALLE</th>';
    $expo .= '          <th>PERIODO</th>';
    $expo .= '          <th>FECHA DESDE</th>';
    $expo .= '          <th>FECHA HASTA</th>';
    $expo .= '          <th>VALOR</th>';
    $expo .= '          <th>PRIORIDAD</th>';
    $expo .= '          <th>TIPO</th>';
    $expo .= '          <th>MORA</th>';
    $expo .= '          <th>% MORA</th>';
    $expo .= '          <th>VALOR MORA</th>';
    $expo .= '          <th>CUENTA DB</th>';
    $expo .= '          <th>CUENTA CR</th>';
    $expo .= '          <th>% PRONTO PAGO</th>';
    $expo .= '          <th>$ PRONTO PAGO</th>';
    $expo .= '          <th>ACTIVO</th>';
    $expo .= '          <th>AMBITO</th>';
    $expo .= '          <th>CLASIFICACION</th>';
    $query = "SELECT  ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, " .
            " ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, " .
            " ServicioMora, ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, " .
            " ServicioCuentaCR, ServicioPPporcentaje, ServicioPPvalor, ServicioActivo, ServicioAmbito, " .
            " servicioClasificacionId FROM contaservicios " .
            " WHERE servicioEmpresaId = " . $empresa .
            " ORDER BY ServicioDetalle ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['ServicioId'] . '</td> ';
            $expo .= '<td>' . $row['servicioEmpresaId'] . '</td> ';
            $expo .= '<td>' . $row['ServicioCodigo'] . '</td> ';
            $expo .= '<td>' . $row['ServicioDetalle'] . '</td> ';
            $expo .= '<td>' . $row['ServicioPeriodo'] . '</td> ';
            $expo .= '<td>' . $row['ServicioFechaDesde'] . '</td> ';
            $expo .= '<td>' . $row['ServicioFechaHasta'] . '</td> ';
            $expo .= '<td>' . $row['ServicioValor'] . '</td> ';
            $expo .= '<td>' . $row['ServicioPrioridad'] . '</td> ';
            $expo .= '<td>' . $row['ServicioTipo'] . '</td> ';
            $expo .= '<td>' . $row['ServicioMora'] . '</td> ';
            $expo .= '<td>' . $row['ServicioMoraPorcentaje'] . '</td> ';
            $expo .= '<td>' . $row['servicioMoraValor'] . '</td> ';
            $expo .= '<td>' . $row['ServicioCuentaDB'] . '</td> ';
            $expo .= '<td>' . $row['ServicioCuentaCR'] . '</td> ';
            $expo .= '<td>' . $row['ServicioPPporcentaje'] . '</td> ';
            $expo .= '<td>' . $row['ServicioPPvalor'] . '</td> ';
            $expo .= '<td>' . $row['ServicioActivo'] . '</td> ';
            $expo .= '<td>' . $row['ServicioAmbito'] . '</td> ';
            $expo .= '<td>' . $row['servicioClasificacionId'] . '</td> ';
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
    $query = "SELECT  MAX(ServicioId) as id 
                    FROM contaservicios";
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
    $ServicioId = $data->ServicioId;
    $empresa = $data->empresa;
    $query = "SELECT  ServicioId, servicioEmpresaId, ServicioCodigo, ServicioDetalle, ServicioPeriodo, " .
            " ServicioFechaDesde, ServicioFechaHasta, ServicioValor, ServicioPrioridad, ServicioTipo, " .
            " ServicioMora, ServicioMoraPorcentaje, servicioMoraValor, ServicioCuentaDB, ServicioCuentaCR, " .
            " ServicioPPporcentaje, ServicioPPvalor, ServicioActivo, ServicioAmbito, servicioClasificacionId  " .
            " FROM contaservicios  WHERE ServicioId = " . $ServicioId .
            " WHERE servicioEmpresaId = " . $empresa .
            " ORDER BY ServicioDetalle ";
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
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT clasificacionId,  clasificacionCodigo " .
            " FROM contaclasificacion " .
            " WHERE clasificacionEmpresaId = " . $empresa .
            " ORDER BY  clasificacionCodigo";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Thursday,Sep 05, 2019 8:27:23   <<<<<<< 
