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
    case 'ni':
        reportesNif($data);
        break;
    case 'cm':
        cierreMensual($data);
        break;
    case 'ce':
        cierreEjercicio($data);
        break;
    case 'exp':
        exportaXls($data);
        break;
    case 'xl':
        informeaXls($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    {
        $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, " .
                " pucActivo, pucClase, pucValor " .
                " FROM contaplancontable WHERE pucEmpresaId = " . $empresa . " ORDER BY pucCuenta ";
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
    $pucEmpresaId = $data->empresa;
    $pucCuenta = $data->cuenta;
    $condi = "pucEmpresaId = " . $pucEmpresaId . " AND pucMayor = '" . $pucCuenta . "'";
    $query = "SELECT pucTipo FROM contaplancontable  WHERE " . $condi;
    $result = mysqli_query($con, $query);
    $count = 0;
    $count = mysqli_num_rows($result);
    if ($count === 0) {
        $query = "DELETE FROM contaplancontable WHERE pucId=$data->pucId";
        mysqli_query($con, $query);
        echo 'Ok Cuenta Borrada';
    } else {
        echo 'Error. No puede borrar la cuenta ' . $pucCuenta . ', de esta depende otra cuenta';
    }
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $resultado = "";
    $pucId = $data->pucId;
    $pucEmpresaId = $data->pucEmpresaId;
    $pucCuenta = $data->pucCuenta;
    $pucNombre = $data->pucNombre;
    $pucMayor = $data->pucMayor;
    $pucNivel = $data->pucNivel;
    $pucTipo = $data->pucTipo;
    $pucActivo = $data->pucActivo;
    $pucClase = $data->pucClase;
    $pucValor = $data->pucValor;
    $er = '';
    $pucTipoMy = '';
    $condi = "pucEmpresaId = " . $pucEmpresaId . " AND pucCuenta = '" . $pucMayor . "'";
    $query = "SELECT pucTipo FROM contaplancontable  WHERE " . $condi;
    $result = mysqli_query($con, $query);
    $count = 0;
    $count = mysqli_num_rows($result);

    if ($count === 0 && $pucMayor != '0') {
        $er = "Error: No existe cuenta mayor";
    } else {
        while ($rec = mysqli_fetch_assoc($result)) {
            $pucTipoMy = $rec['pucTipo'];
        }
    }

    if ($er === "") {
        if ($pucTipo === 'T') {
            if ($pucTipoMy == 'M') {
                $er = "Error: esta cuenta es de total y el mayor de movimiento";
            }
        } else {
            if ($pucTipoMy == 'M') {
                $er = "Error: esta cuenta es de movimiento y el mayor de movimiento";
            }
        }
    }

    if ($er == '') {
        if ($pucId != "0") {
            $resultado = "OK. Registro actualizado";
            $condi = "pucEmpresaId = " . $pucEmpresaId . " and pucMayor = '" . $pucCuenta . "' ";
            $query = "SELECT pucTipo FROM contaplancontable WHERE " . $condi;
            $result = mysqli_query($con, $query);

            $count = 0;
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $er = "Error: No puede cambiar el tipo de cuenta";
            } else {
                $sql = 'UPDATE contaplancontable SET pucEmpresaId = "' . trim($pucEmpresaId) . '",' .
                        'pucCuenta = "' . trim($pucCuenta) . '",' .
                        'pucMayor = "' . trim($pucMayor) . '",' .
                        'pucNombre = "' . utf8_decode(trim($pucNombre)) . '",' .
                        'pucNivel = "' . trim($pucNivel) . '",' .
                        'pucTipo = "' . $pucTipo . '",' . 'pucActivo = "' . $pucActivo . '",' .
                        'pucClase = "' . trim($pucClase) . '",' . 'pucValor = "' . trim($pucValor) .
                        '" WHERE pucId = ' . $pucId;
            }
        } else {
            $count = 0;
            $condi = "pucEmpresaId = " . $pucEmpresaId . " and pucCuenta = '" . $pucCuenta . "'";
            $query = "SELECT COUNT(*) AS Nr FROM contaplancontable WHERE " . $condi;
            $result = mysqli_query($con, $query);
            while ($rec = mysqli_fetch_assoc($result)) {
                $count = $rec['Nr'];
            }
            if ($count > 0) {
                $er = "Error: Ya existe un registro con esta cuenta";
            } else {
                $resultado = "Ok. Registro Creado";
                $sql = 'INSERT INTO contaplancontable ( pucEmpresaId, pucCuenta, pucNombre, ' .
                        'pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor) ' .
                        'VALUES ("' . $pucEmpresaId . '","' . $pucCuenta . '","' . $pucNombre . '","' .
                        $pucMayor . '","' . $pucNivel . '","' . $pucTipo . '","' .
                        $pucActivo . '","' . $pucClase . '","' . $pucValor . '")';
            }
        }
        if ($er === "") {
            $result = mysqli_query($con, $sql);
        }
    }
    if ($er > '') {
        echo $er;
    } else {
        echo $resultado;
    }
}

function informeaXls($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = explode(',', $data->dato);
    //dato=empresa+','+ultimoPeriodo+','+ultimoVsPeriodo+','+variaciones+','+notas+','+control+','+informe;
    $empresa = $dato[0];
    $informe = $dato[6];
    $PeriodoDer = $dato[1];
    $PeriodoIzq = $dato[2];
    include_once("mod_contaReportContable.php");
    $obj = new reportesNif();
    $result = $obj->traeInforme($empresa, $informe, $PeriodoDer, $PeriodoIzq);
    $expo = '';
    $expo .= '<table border=1 class="table2Excel"> ';
    $expo .= '<tr> ';
    $expo .= '          <th>CUENTA</th>';
    $expo .= '          <th>' . $PeriodoDer . '</th>';
    $expo .= '          <th>' . $PeriodoIzq . '</th>';
    $expo .= '          <th>VARIACION</th>';
    $expo .= '          <th>NOTAS</th>';
    if (mysqli_num_rows($result) != 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $i = strpos($row['tmpbalvalor03'], '.');
            $v = substr($row['tmpbalvalor03'], 0, $i + 4);
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['tmpbalnombre'] . '</td> ';
            $expo .= '<td>' . $row['tmpbalvalor01'] . '</td> ';
            $expo .= '<td>' . $row['tmpbalvalor02'] . '</td> ';
            $expo .= '<td>' . $v . '</td> ';
            $expo .= '<td>' . $row['tmpbalnotas'] . '</td> ';
            $expo .= '</tr> ';
        }
    }
    $expo .= '</table> ';
    echo $expo;
    return $expo;
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
    $expo .= '          <th>CUENTA</th>';
    $expo .= '          <th>NOMBRE CUENTA</th>';
    $expo .= '          <th>MAYOR</th>';
    $expo .= '          <th>NIVEL</th>';
    $expo .= '          <th>TIPO</th>';
    $expo .= '          <th>ACTIVO</th>';
    $expo .= '          <th>CLASE</th>';
    $expo .= '          <th>VALOR</th>';
    $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, " .
            " pucActivo, pucClase, pucValor " .
            " FROM contaplancontable WHERE pucEmpresaId = " . $empresa . " ORDER BY pucCuenta ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
            $expo .= '<td>' . $row['pucId'] . '</td> ';
            $expo .= '<td>' . $row['pucEmpresaId'] . '</td> ';
            $expo .= '<td>' . $row['pucCuenta'] . '</td> ';
            $expo .= '<td>' . $row['pucNombre'] . '</td> ';
            $expo .= '<td>' . $row['pucMayor'] . '</td> ';
            $expo .= '<td>' . $row['pucNivel'] . '</td> ';
            $expo .= '<td>' . $row['pucTipo'] . '</td> ';
            $expo .= '<td>' . $row['pucActivo'] . '</td> ';
            $expo .= '<td>' . $row['pucClase'] . '</td> ';
            $expo .= '<td>' . $row['pucValor'] . '</td> ';
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
    $query = "SELECT  MAX(pucId) as id 
                    FROM contaplancontable";
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
    $pucId = $data->pucId;
    $query = "SELECT  pucId, pucEmpresaId, pucCuenta, pucNombre, pucMayor, pucNivel, pucTipo, pucActivo, pucClase, pucValor  " .
            " FROM contaplancontable  WHERE pucId = " . $pucId .
            " ORDER BY pucCuenta ";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function cierreMensual($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = explode(',', $data->dato);
    $empresa = $dato[0];
    $periodo = $dato[1];
    $nuevoperiodo = $dato[2];

    // verifica que tenga al menos un comprobante
    $query = "SELECT count(*) as nro FROM contamovicabeza where movicaEmpresaId = " .
            $empresa . " AND movicaPeriodo='" . $periodo . "' ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) === 0) {
        $retorno = "No se puede hacer el Cierre, el periodo no tiene comprobantes  ";
        return;
    }
    // verifica que todos los comprobantes se hayan actualizado
    $query = "SELECT count(*) as nro FROM contamovicabeza where movicaEmpresaId = " .
            $empresa . " and movicaPeriodo='" . $periodo . "' AND movicaProcesado='N'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $nro = $row['nro'];
    }

    if ($nro != '0') {
        $retorno = "No se puede hacer el Cierre, Hay " . $nro . " comprobantes sin actualizar:  ";
    } else {

        // borra los saldos del periodo a crear con el cierre
        $query = " DELETE FROM  contasaldoscontables WHERE saldcontId > 0 AND saldcontEmpresaid = "
                . $empresa . " AND saldcontPeriodo = '" . $nuevoperiodo . "'";
        $result = mysqli_query($con, $query);
        ayudaCierrePeriodo($empresa, $periodo, $nuevoperiodo);
        $retorno = 'Cierre efectuado correctamente, nuevo periodo actual :  ' . $nuevoperiodo;
    }
    echo $retorno;
}

function ayudaCierrePeriodo($empresa, $periodo, $nuevoperiodo) {
    global $objClase;
    $con = $objClase->conectar();
    // calcula los nuevos saldos finales
    $query = " UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
            " saldconFinalCr = saldcontInicialCr + saldcontCreditos " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $periodo . "'";
    $result = mysqli_query($con, $query);

    // aclualiza en la empresa el nuevo periodo
    $query = " UPDATE contaempresas SET empresaPeriodoActual = '" . $nuevoperiodo .
            "' WHERE  empresaId = " . $empresa;
    $result = mysqli_query($con, $query);

    // inserta los saldos finales calculados de este periodo en los iniciales del nuevo periodo
    $query = "INSERT INTO contasaldoscontables (saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
            " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
            " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto) " .
            " SELECT saldcontEmpresaid, '" . $nuevoperiodo . "', saldcontTipo, saldcontCuenta, " .
            " saldcontCuentaContable , saldcontFinalDb , saldconFinalCr ,0 ,0 ,0 ,0, 0 " .
            " FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
            " AND saldcontPeriodo = '" . $periodo . "'  ORDER BY  saldcontCuenta ";
    $result = mysqli_query($con, $query);

    // calcula el saldo neto del periodo cerrado
    $query = "UPDATE contasaldoscontables SET saldconNeto  = saldcontFinalDb - saldconFinalCr  " .
            " WHERE saldcontEmpresaid = " . $empresa .
            " AND saldcontPeriodo = '" . $periodo . "' ";
    $result = mysqli_query($con, $query);
    return;
}

function cierreEjercicio($data) {
    global $objClase;
    set_time_limit(300);
    $con = $objClase->conectar();
    $dato = explode(',', $data->dato);
    $empresa = $dato[0];
    $empresaCompCierreMes = $dato[1];
    $empresaCompApertura = $dato[2];
    $empresaCuentaCierre = $dato[3];
    $periodo = $dato[4];
    $consecCierre = 0;
    $consecApertura = 0;
    $moviDocum1 = '';
    $moviDocum2 = '';
    $tercero = 0;
    $multiplicador = 0;
    $ano = substr($dato[4], 0, 4) + 1;
    $PeriodoInicio = $ano . '00';
    $empresaNuevoAnoFiscal = $ano . '01';
    $empresaAnoFiscal = substr($dato[4], 0, 4);

    // Hace el cierre mensual del mes 13 
    $query = "UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
            " saldconFinalCr = saldcontInicialCr + saldcontCreditos," .
            " saldconNeto = saldcontInicialDb + saldcontDebitos -  saldcontInicialCr  - saldcontCreditos " .
            " WHERE saldcontEmpresaid = " . $empresa .
            " AND saldcontPeriodo = '" . $periodo . "' AND saldcontId > 0 ";
    mysqli_query($con, $query);

    // trae el tercero para los comprobantes
    $query = "SELECT empresatercero FROM contaempresas WHERE empresaId = " . $empresa;
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $tercero = $row['empresatercero'];
    }

    // trae consecutivos de cierre y apertura
    $query = "SELECT compConsecutivo + 1 AS nro FROM contacomprobantes WHERE compEmpresaId = " .
            $empresa . " AND compCodigo = '" . $empresaCompCierreMes . "' ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $consecCierre = $row['nro'];
    }
    $query = "SELECT compConsecutivo + 1 AS nro FROM contacomprobantes WHERE compEmpresaId = " .
            $empresa . " AND compCodigo = '" . $empresaCompApertura . "' ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $consecApertura = $row['nro'];
    }

    // Actualiza el numero en los comprobantes de apertura y cierre
    $query = "UPDATE contacomprobantes SET compConsecutivo = " . $consecCierre . " WHERE compEmpresaId = " .
            $empresa . " AND compCodigo = '" . $empresaCompCierreMes . "' ";
    $result = mysqli_query($con, $query);

    $query = "UPDATE contacomprobantes SET compConsecutivo = " . $consecApertura . " WHERE compEmpresaId = " .
            $empresa . " AND compCodigo = '" . $empresaCompApertura . "' ";
    $result = mysqli_query($con, $query);

    // borra el comprobante de cierre anterior y su movimiento (si hay) 

    $cond = "";
    //-- trael el id 
    $query = "SELECT movicaId FROM contamovicabeza WHERE movicaEmpresaId= " . $empresa .
            " AND movicaComprId = '" . $empresaCompCierreMes .
            "' AND movicaDocumPpal = 'cierre' AND movicaId > 0 AND movicaPeriodo = '" . $periodo . "'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $cond = $row['movicaId'];
    }
    // borra detalles y encabezado
    $query = "DELETE FROM contamovidetalle WHERE moviConCabezaId IN (" .
            $cond . ") AND  moviConId>0 ";
    $result = mysqli_query($con, $query);

    $query = "DELETE FROM contamovicabeza WHERE movicaId IN (" .
            $cond . ") AND  movicaId>0 ";
    $result = mysqli_query($con, $query);

    // crea encabezado de cierre
    $query = "INSERT INTO contamovicabeza( movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, " .
            "movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec) " .
            " VALUES (" . $empresa . ", '" . $empresaCompCierreMes . "', " . $consecCierre . ", " .
            $tercero . ", " .
            "'Cierre fiscal de " . $empresaAnoFiscal . "', 'N', '" . substr($empresaAnoFiscal, 0, 4) . "-12-31','" .
            $periodo . "','cierre','')";
    $result = mysqli_query($con, $query);
    $query = "SELECT last_insert_id() AS id;";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $nroCabezaCierre = $row['id'];
    }

    //  Crea el movimiento de cierre y toma las cuentas 4,5,6,7 para el resultado
    $resultado = 0.0;
    $query = "SELECT saldcontId, saldcontEmpresaid, saldcontPeriodo, saldcontTipo, saldcontCuenta, " .
            " saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, saldcontDebitos, " .
            " saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto " .
            " FROM contasaldoscontables INNER JOIN contaplancontable ON saldcontCuentaContable = pucCuenta " .
            " WHERE left(saldcontCuentaContable,1) > '3'  AND left(saldcontCuentaContable,1) < '8' " .
            " AND pucTipo = 'M' AND  saldcontEmpresaid = pucEmpresaId AND saldcontTipo='cont' " .
            " AND saldcontEmpresaid = " .
            $empresa . " AND saldcontPeriodo = '" . $periodo . "' " .
            " ORDER BY saldcontCuentaContable;";
    $resultSal2 = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($resultSal2)) {
        $tp = '';
        $sqlValor = '';
        $resultado += $row['saldconNeto'];

        if (floatval($row['saldconNeto']) > 0) {
            $sqlValor .= "0.0," . "'" . abs($row['saldconNeto']) . "',";
            $tp = 'D';
        } else {
            $sqlValor .= abs($row['saldconNeto']) . "," . "0.0,";
            $tp = 'C';
        }

        $sqlValor .= "0.0,'" . $tp . "',0,0," . $tercero . ",'" . $moviDocum1 . "','" . $moviDocum2 . "','" . $tp . "')";
        $query = "INSERT INTO contamovidetalle(moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, " .
                " moviConCredito,  moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, " .
                " moviConIdTercero,  moviDocum1, moviDocum2, moviTipoCta) " .
                " VALUES(" . $nroCabezaCierre . ",'CIERRE EJERCICIO DEL " . substr($empresaAnoFiscal, 0, 4) .
                "','" . $row['saldcontCuentaContable'] . "'," . $sqlValor;

        $resultDet = mysqli_query($con, $query);
    }

    if ($resultado < 0) {
        $resultado = $resultado * (-1);
        $sqlValor = "0.0," . $resultado . ",";
        $tp = 'C';
    } else {
        $sqlValor = $resultado . ",0.0,";
        $tp = 'D';
    }

    $sqlValor .= "0.0,'" . $tp . "',0,0," . $tercero . ",'','','" . $tp . "')";

    // Registro de utilidades o perdidas
    $query = "INSERT INTO contamovidetalle(moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, " .
            " moviConCredito,  moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, " .
            " moviConIdTercero, moviDocum1, moviDocum2, moviTipoCta) " .
            " VALUES(" . $nroCabezaCierre . ",'CIERRE EJERCICIO DEL " . substr($empresaAnoFiscal, 0, 4) .
            "','" . $empresaCuentaCierre . "'," . $sqlValor;
    $resultDet = mysqli_query($con, $query);

    // actualiza comprobante contable de cierre creado 
    actualizaComprobante($empresa, $nroCabezaCierre, $periodo);

    $query = "UPDATE contamovicabeza SET movicaProcesado='S' where movicaId = " . $nroCabezaCierre;
    $result = mysqli_query($con, $query);

    // actualiza saldos finales
    $query = " UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
            " saldconFinalCr = saldcontInicialCr + saldcontCreditos " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $periodo . "'";
    $result = mysqli_query($con, $query);
    $query = " UPDATE contasaldoscontables SET saldcontNeto = saldcontFinalDb -  saldcontDebitos " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $periodo . "'";
    $result = mysqli_query($con, $query);

    // crea comprobante de apertura
    $nroCabezaInicio = 0;
    $query = "INSERT INTO contamovicabeza( movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, " .
            "movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec) " .
            " VALUES (" . $empresa . ", '" . $empresaCompApertura . "', " . $consecApertura . ", " .
            $tercero . ", " . "'Inicio fiscal de " . $empresaNuevoAnoFiscal .
            "', 'S', '" . substr($empresaNuevoAnoFiscal, 0, 4) . "-01-01','" .
            $PeriodoInicio . "','apertura','')";
    $result = mysqli_query($con, $query);
    $query = "SELECT last_insert_id() AS id;";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $nroCabezaInicio = $row['id'];
    }
    // Crea detalles de la apertura

    $query = "SELECT saldcontCuentaContable,  saldcontFinalDb, saldconFinalCr " .
            " FROM contasaldoscontables " .
            " INNER JOIN contaplancontable ON saldcontCuentaContable = pucCuenta  " .
            " AND  pucEmpresaId = saldcontEmpresaid WHERE saldcontTipo= 'cont' AND pucTipo = 'M' " .
            " AND saldcontCuentaContable < '4' AND saldcontEmpresaid = " .
            $empresa . " AND saldcontPeriodo = '" . $periodo . "' ORDER BY saldcontCuentaContable ";

    $resultac = mysqli_query($con, $query);
    while ($rec = mysqli_fetch_assoc($resultac)) {
        $valor = floatval($rec['saldcontFinalDb']) - floatval($rec['saldconFinalCr']);
        $tp = 'D';
        $db = $valor;
        $cr = 0.0;
        if ($valor < 0) {
            $tp = 'C';
            $db = 0.0;
            $cr = $valor * (-1);
        }
        $query = "INSERT INTO contamovidetalle(moviConCabezaId, moviConDetalle, moviConCuenta, moviConDebito, " .
                " moviConCredito,  moviConBase, moviConImpTipo, moviConImpPorc, moviConImpValor, " .
                " moviConIdTercero, moviDocum1,moviDocum2,moviTipoCta) " .
                " VALUES(" . $nroCabezaInicio . ",'INICIO EJERCICIO DEL " . substr($empresaNuevoAnoFiscal, 0, 4) .
                "','" . $rec['saldcontCuentaContable'] . "'," . $db . "," . $cr . ",0.0,'" . $tp . "',0,0," . $tercero . ",'','','" . $tp . "')";
        $resultDet = mysqli_query($con, $query);
    }

    // inserta los saldos finales calculados de este periodo en los iniciales del nuevo periodo

    $query = "INSERT INTO contasaldoscontables (saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
            " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
            " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto) " .
            " SELECT saldcontEmpresaid, '" . $ano . "00', saldcontTipo, saldcontCuenta, " .
            " saldcontCuentaContable , saldcontFinalDb , saldconFinalCr ,0 ,0 ,0 ,0 , 0 " .
            " FROM contasaldoscontables WHERE saldcontEmpresaid =  " . $empresa .
            " AND saldcontPeriodo = '" . $periodo . "' ORDER BY  saldcontCuentaContable ";
    $resultDet = mysqli_query($con, $query);
    // echo $query.'  ';      
    $query = "UPDATE contasaldoscontables SET saldcontInicialDb = 0.0, saldcontInicialCr = 0.0," .
            " saldcontDebitos = 0.0, saldcontCreditos = 0.0, saldcontFinalDb = 0.0," .
            " saldconFinalCr=0.0, saldconNeto=0.0 " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $ano . "00' " .
            " AND saldcontCuentaContable > '3999%'  AND saldcontId > 0";
    $resultDet = mysqli_query($con, $query);
    // saldos finales  
    $query = "UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
            " saldconFinalCr = saldcontInicialCr + saldcontCreditos " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $ano . "00' " .
            " AND saldcontId > 0";
    $resultDet = mysqli_query($con, $query);
    //  saldos netos
    $query = "UPDATE contasaldoscontables SET saldconNeto = saldcontFinalDb - saldconFinalCr  " .
            " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $ano . "00' " .
            " AND saldcontId > 0";
    $resultDet = mysqli_query($con, $query);
    //  saldos iniciales del nuevo ejercicio  
    $query = "DELETE FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
            " AND saldcontPeriodo = '" . $empresaNuevoAnoFiscal . "' AND saldcontId>0;";
    $resultDet = mysqli_query($con, $query);

    $query = "INSERT INTO contasaldoscontables (saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
            " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
            " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto) " .
            " SELECT saldcontEmpresaid, '" . $empresaNuevoAnoFiscal . "', saldcontTipo, saldcontCuenta, " .
            " saldcontCuentaContable , saldcontFinalDb , saldconFinalCr ,0 ,0 ,0 ,0 , 0 " .
            " FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
            " AND saldcontPeriodo = '" . $ano . "00' ORDER BY  saldcontCuentaContable  ";
    $resultDet = mysqli_query($con, $query);


    //  Actualiza la empresa cambiando el año fiscal y el periodo del nuevo año    
    $periodo = $dato[4];
    $ano = substr($periodo, 0, 4) + 1;
    $empresaNuevoAnoFiscal = $ano . '01';
    $empresaAnoFiscal = substr($dato[4], 0, 4);

    $query = " UPDATE contaempresas SET empresaPeriodoActual = '" . $empresaNuevoAnoFiscal .
            "',empresaAnoFiscal = " . $ano . "  WHERE  empresaId = " . $empresa;
    $result = mysqli_query($con, $query);
    echo "Cierre del ejercicio terminado Ok, Se pasa del periodo " . $periodo . ' al nuevo periodo ' .
    $empresaNuevoAnoFiscal . ' del año fiscal ' . $ano;
}

function actualizaComprobante($empresa, $nroCabezaCierre, $periodo) {
    global $objClase;
    $con = $objClase->conectar();
    $multiplicador = 1;
    $query = " SELECT moviConCuenta, moviConDebito, moviConCredito FROM contamovidetalle " .
            " WHERE moviConCabezaId = " . $nroCabezaCierre;
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $cuenta = $row['moviConCuenta'];
        $debito = $row['moviConDebito'];
        $credito = $row['moviConCredito'];
        $ok = true;
        while ($ok) {
            $query = "SELECT count(*) AS nrec FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
                    " AND saldcontPeriodo = '" . $periodo . "' AND saldcontTipo = 'cont' " .
                    " AND saldcontCuentaContable = '" . $cuenta . "' ";
            $resultac = mysqli_query($con, $query);
            while ($fila = mysqli_fetch_assoc($resultac)) {
                $nr = $fila['nrec'];
                if ($nr === '0') {
                    $query = "INSERT INTO contasaldoscontables(saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
                            " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
                            " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto) " .
                            " VALUES ( " . $empresa . ", '" . $periodo . "','cont', '', '" . $cuenta . "',0,0," .
                            $debito . "," . $credito . ",0,0,0)";
                    $resultag = mysqli_query($con, $query);
                } else {
                    $query = "UPDATE contasaldoscontables SET saldcontDebitos =  saldcontDebitos + " .
                            $debito * $multiplicador .
                            ", saldcontCreditos = saldcontCreditos + " . $credito * $multiplicador .
                            " WHERE saldcontEmpresaid = " . $empresa .
                            " AND saldcontPeriodo = '" . $periodo .
                            "' AND saldcontTipo = 'cont'   AND saldcontCuentaContable = '" . $cuenta .
                            "' AND saldcontId > 0 ";
                    $resultag = mysqli_query($con, $query);
                }
            }
            $query = " SELECT pucMayor FROM contaplancontable " .
                    " WHERE pucEmpresaId=" . $empresa . " AND pucCuenta = '" . $cuenta . "'";

            $resultag = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($resultag)) {
                $cuenta = $row['pucMayor'];
            }
            if ($cuenta === '0' || $cuenta === 0) {
                $ok = false;
            }
        }
    }
}

function reportesNif($data) {
    include_once("mod_contaReportContable.php");
    $obj = new reportesNif();
    $res = $obj->reportesNifObj($data);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Jan 13, 2020 11:54:47   <<<<<<< 
