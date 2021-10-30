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
    case 'a':
        actualiza($data);
        break;
    case 'ac':
        actualizaComprobantes($data);
        break;
    case 'ao':
        actualizaOper($data);
        break;
    case 'am':
        actualizaMov($data);
        break;

    case 'b':
        borra($data);
        break;
    case 'bc':
        borraComprobante($data);
        break;
    case 'bo':
        buscaComprobante($data);
        break;
    case 'bs':
        borraSaldos($data);
        break;
    case 'cp':
        comprobante($data);
        break;
    case 'dp':
        duplicaComprobante($data);
        break;
    case 'rm':
        leeRegistrosMov($data);
        break;
    case 'sm':
        sumaDbyCr($data);
        break;
    case 'te':
        traeEncabezados($data);
        break;
    case 'ts':
        transfiereSaldos($data);
        break;
    case 'tc':
        traeCabezas($data);
        break;
    case 'tn':
        traeNroCpbnte($data);
        break;
    case 'to':
        traeNombreCpbnte($data);
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
    case '2':
        lista2($data);
        break;
    case '2c':
        lista2c($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $periodo = $data->periodo;
    {
        $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, compNombre,  movicaCompNro, movicaTerceroId, " .
                " terceroNombre, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec" .
                " FROM contamovicabeza  " .
                " INNER JOIN contacomprobantes ON movicaComprId=compCodigo AND movicaEmpresaId = compEmpresaId " .
                " INNER JOIN contaterceros ON movicaTerceroId = terceroId " .
                " WHERE movicaEmpresaId = " . $empresa . " AND movicaPeriodo = '" . $periodo . "' " .
                " AND movicaProcesado = 'N' ORDER BY movicaPeriodo ";
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

function leeRegistrosMov($data) {
    global $objClase;
    $con = $objClase->conectar();
    $cabeza = $data->cabeza;
    $empresa = $data->empresa;

    $query = "SELECT moviConId ,moviConCabezaId ,moviConDetalle ,moviConCuenta, pucNombre ," .
            " moviConDebito , moviConCredito ,moviConBase ,moviConImpTipo ,moviConImpPorc ," .
            " moviConImpValor , moviConIdTercero ,moviDocum1 ,moviDocum2, moviTipoCta " .
            " FROM contamovidetalle INNER JOIN contaplancontable ON moviConCuenta = pucCuenta " .
            " WHERE moviConCabezaId = " . $cabeza . " AND pucEmpresaId = " . $empresa .
            " ORDER BY moviTipoCta DESC, moviConCuenta";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function traeCabezas($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $periodo = $data->periodo;
    $op = $data->ope;
    $query = "SELECT movicaId, movicaComprId, compNombre, movicaCompNro, movicaTerceroId, terceroNombre, " .
            " movicaDetalle, movicaPeriodo, movicaFecha " .
            " FROM contamovicabeza " .
            " INNER JOIN contacomprobantes ON movicaComprId = compCodigo " .
            " INNER JOIN contaterceros ON movicaTerceroId = terceroId " .
            " WHERE movicaEmpresaId = " . $empresa . " AND compEmpresaId = movicaEmpresaId " .
            " AND terceroEmpresaId = movicaEmpresaId  " . " AND movicaPeriodo = '" . $periodo;
    if ($op === 'ac') {
        $query .= "' AND movicaProcesado = 'N' ";
    } else if ($op === 'rc') {
        $query .= "' AND movicaProcesado = 'S' ";
    } else {
        $query .= "' ";
    }
    $query .= " ORDER BY movicaPeriodo, movicaCompNro";

    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function traeEncabezados($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $periodo = $data->periodo;
    $op = $data->ope;
    $query = " SELECT movicaId,  movicaEmpresaId, movicaComprId, compNombre, movicaCompNro, movicaTerceroId, " .
            " terceroNombre, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal,  " .
            " movicaDocumSec   " .
            " FROM contamovicabeza  " .
            " INNER JOIN contacomprobantes ON compCodigo = movicaComprId  " .
            " INNER JOIN contaterceros ON terceroId = movicaTerceroId  " .
            " WHERE movicaEmpresaId = " . $empresa . " AND movicaPeriodo = '" . $periodo .
            "' AND compEmpresaId = movicaEmpresaId AND terceroEmpresaId = movicaEmpresaId AND ";
    if ($op === 'ac') {
        $query .= " movicaProcesado = 'N' ";
    } else {
        $query .= " movicaProcesado = 'S' ";
    }
    //echo $query;                
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function traeNombreCpbnte($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $cmpbnte = $data->cmpbnte;
    $compNombre = '';
    $query = " SELECT compNombre  FROM contacomprobantes " .
            " WHERE compEmpresaId = " . $empresa . " AND compCodigo = '" . $cmpbnte . "'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $compNombre = $row['compNombre'];
    }
    echo $compNombre;
}

function traeNroCpbnte($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $cmpbnte = $data->cmpbnte;
    $nro = 0;
    $query = " SELECT compConsecutivo + 1 As nro FROM contacomprobantes " .
            " WHERE compEmpresaId = " . $empresa . " AND compCodigo = '" . $cmpbnte . "'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $nro = $row['nro'];
    }
    echo $nro;
}

function sumaDbyCr($data) {
    global $objClase;
    $con = $objClase->conectar();
    $cabeza = $data->cabeza;
    $empresa = $data->empresa;
    $debitos = 0;
    $creditos = 0;
    $query = " SELECT SUM(moviConDebito) AS debito, sum(moviConCredito) AS credito " .
            " FROM contamovidetalle, contamovicabeza " .
            " WHERE moviConCabezaId = movicaId AND  movicaId = " . $cabeza .
            " AND movicaEmpresaId = " . $empresa;
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $debitos = $row['debito'];
        $creditos = $row['credito'];
    }
    echo $debitos . '||' . $creditos;
}

function borra($data) {
    global $objClase;
    $con = $objClase->conectar();
    $moviConId = $data->moviConId;
    $query = "DELETE FROM contamovidetalle WHERE moviConId = " . $moviConId;
    $result = mysqli_query($con, $query);
    echo 'Ok';
}

function borraSaldos($data) {
    global $objClase;
    $con = $objClase->conectar();
    $periodo = $data->periodo;
    $empresa = $data->empresa;

    $query = "SELECT empresaPeriodoActual FROM contaempresas WHERE empresaId = " . $empresa;

    $resulta = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($resulta)) {
        if ($row['empresaPeriodoActual'] <> $periodo) {
            echo 'El periodo ' . $periodo . ' No es el último, verifique en parámetros contabilidad';
        } else {
            $query = "DELETE FROM contasaldoscontables WHERE saldcontEmpresaid = " .
                    $empresa . " AND saldcontPeriodo = '" . $periodo . "' AND saldcontId > 0 ";
            $result = mysqli_query($con, $query);
            $query = " UPDATE  contamovicabeza SET movicaProcesado = 'N' " .
                    " WHERE movicaEmpresaId = " . $empresa . " AND movicaPeriodo = '" . $periodo . "' AND movicaId > 0 ";
            $result = mysqli_query($con, $query);
            echo 'Ok';
        }
    }
}

function borraComprobante($data) {
    global $objClase;
    $con = $objClase->conectar();
    $movicaId = $data->movicaId;
    $empresa = $data->empresa;

    $query = "DELETE FROM contamovidetalle WHERE moviConCabezaId = " . $movicaId;
    $result = mysqli_query($con, $query);

    $query = "DELETE FROM contamovicabeza WHERE movicaId = " . $movicaId .
            "  AND movicaEmpresaId = " . $empresa;
    $result = mysqli_query($con, $query);
    echo 'Ok';
}

function duplicaComprobante($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = explode('||', $data->dato);

    $cpr = $dato[2];
    $ter = $dato[0];
    $det = $dato[1];
    $nro = $dato[3];
    $fch = $dato[4];
    $per = substr($fch, 0, 4) . substr($fch, 5, 2);
    $empresa = $dato[5];
    $id = $dato[6];
    $query = "INSERT INTO contamovicabeza(movicaEmpresaId, movicaComprId, movicaCompNro, " .
            " movicaTerceroId, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, " .
            " movicaDocumPpal, movicaDocumSec)";
    $query .= "  VALUES ('" . $empresa . "', '" . $cpr . "', '" . $nro . "', '" . $ter . "', '" . $det . "', 'N', '" .
            $fch . "', '" . $per . "', '', '')";
    mysqli_query($con, $query);
    $nroCabeza = mysqli_insert_id($con);

    $query = "INSERT INTO contamovidetalle (moviConCabezaId ,moviConDetalle, moviConCuenta, " .
            " moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, " .
            " moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2, moviTipoCta) SELECT '" .
            $nroCabeza . "','" . $det . "', moviConCuenta, moviConDebito, moviConCredito, moviConBase," .
            " moviConImpTipo, moviConImpPorc, moviConImpValor,'" . $ter . "', moviDocum1, moviDocum2, " .
            "  moviTipoCta FROM contamovidetalle where moviConCabezaId = " . $id;
    mysqli_query($con, $query);
    $query = "UPDATE contacomprobantes set compConsecutivo = compConsecutivo + 1 " .
            " WHERE compCodigo = '" . $cpr . "' AND compEmpresaId = " . $empresa . "  AND compId > 0";
    mysqli_query($con, $query);
    echo 'Ok Creado el comprobante ' . $cpr . "  Nro:  " . $nro . ' en el periodo ' . $per;
}

function comprobante($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $cpbnte = $data->cp;
    $consec = 0;
    $query = "SELECT compConsecutivo, compNombre FROM contacomprobantes WHERE compCodigo = '" . $cpbnte .
            "' AND compEmpresaId = " . $empresa;
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $consec = $row['compConsecutivo'] + 1;
        $consec .= ',' . $row['compNombre'];
    }
    echo $consec;
}

function buscaComprobante($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $cpbnte = $data->cp;
    $res = array();
    $response = '';
    $query = "SELECT compConsecutivo, compctadb0, compctadb1, compctadb2, compctacr0, compctacr1, compctacr2,  " .
            " compDetalle, compcpbnte FROM contacomprobantes " .
            " WHERE compEmpresaId = " . $empresa . " AND compCodigo = '" . $cpbnte . "' ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($res, $row['compcpbnte'], $row['compDetalle'], $row['compctadb0'], $row['compctadb1'],
                $row['compctadb2'], $row['compctacr0'], $row['compctacr1'], $row['compctacr2']);
    }
    $response = $res[0] . '||' . $res[1] . '||';
    $query = "SELECT compCodigo, compNombre, compConsecutivo FROM contacomprobantes  " .
            " WHERE compEmpresaId = " . $empresa . " AND compCodigo = '" . $res[0] . "' ";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $response .= $row['compCodigo'] . '||' . $row['compNombre'] . '||' . ($row['compConsecutivo'] + 1) . '||';
    }
    for ($i = 2; $i < count($res); $i++) {
        $nombre = '';
        if ($res[$i] != '') {
            $query = "SELECT pucNombre FROM contaplancontable WHERE pucEmpresaId = " . $empresa .
                    " AND pucCuenta='" . $res[$i] . "' ";
            $result = mysqli_query($con, $query);
            while ($r = mysqli_fetch_assoc($result)) {
                $nombre = $r['pucNombre'];
            }
        }
        $response .= $res[$i] . '&' . $nombre . '||';
    }

    echo $response;
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $movicaId = $data->movicaId;
    $movicaEmpresaId = $data->movicaEmpresaId;
    $movicaComprId = $data->movicaComprId;
    $movicaCompNro = $data->movicaCompNro;
    $movicaTerceroId = $data->movicaTerceroId;
    $movicaDetalle = $data->movicaDetalle;
    $movicaProcesado = $data->movicaProcesado;
    $movicaFecha = $data->movicaFecha;
    $movicaPeriodo = $data->movicaPeriodo;
    $movicaDocumPpal = $data->movicaDocumPpal;
    $movicaDocumSec = $data->movicaDocumSec;

    if ($movicaId == 0) {
        $query = "INSERT INTO contamovicabeza(movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, " .
                " movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec)";
        $query .= "  VALUES ('" . $movicaEmpresaId . "', '" . $movicaComprId . "', '" . $movicaCompNro . "', '" .
                $movicaTerceroId . "', '" . $movicaDetalle . "', '" . $movicaProcesado . "', '" . $movicaFecha . "', '" .
                $movicaPeriodo . "', '" . $movicaDocumPpal . "', '" . $movicaDocumSec . "')";
        mysqli_query($con, $query);
        $nroCabeza = mysqli_insert_id($con);
        $query = "UPDATE contacomprobantes  SET compConsecutivo = compConsecutivo + 1  " .
                " WHERE compEmpresaId = " . $movicaEmpresaId . " AND compCodigo = '" . $movicaComprId . "' ";
        mysqli_query($con, $query);
        echo 'Ok,' . $nroCabeza;
    } else {
        $query = "UPDATE contamovicabeza  SET movicaEmpresaId = '" . $movicaEmpresaId .
                "', movicaComprId = '" . $movicaComprId . "', movicaCompNro = '" . $movicaCompNro .
                "', movicaTerceroId = '" . $movicaTerceroId . "', movicaDetalle = '" . $movicaDetalle .
                "', movicaProcesado = '" . $movicaProcesado . "', movicaFecha = '" . $movicaFecha .
                "', movicaPeriodo = '" . $movicaPeriodo . "', movicaDocumPpal = '" . $movicaDocumPpal .
                "', movicaDocumSec = '" . $movicaDocumSec . "' WHERE movicaId = " . $movicaId;
        mysqli_query($con, $query);
        echo 'Ok';
    }
}

function actualizaComprobantes($data) {
    $empresa = $data->empresa;
    $periodo = $data->periodo;
    $ids = $data->ids;
    $op = $data->op;
    $multiplicador = $data->multi;
    actualizaCp($empresa, $periodo, $ids, $op, $multiplicador);
}

function actualizaCp($empresa, $periodo, $ids, $op, $multiplicador) {
    global $objClase;
    $con = $objClase->conectar();
    $tit = 'Reversados';
    if ($multiplicador === 1) {
        $tit = 'Actualizados';
    }
    $id = explode(',', $ids);
    $tit = count($id) . " Comprobantes " . $tit . ". Saldos contables actualizados \n";
    $errados = 0;
    for ($i = 0; $i < count($id); $i++) {
        $er = '';
        // valida que este cuadrado y que sus cuentas existan
        $er .= validaComp($empresa, $id[$i]);

        if ($er === '') {
            $query = " SELECT moviConCuenta, moviConDebito, moviConCredito FROM contamovidetalle " .
                    " WHERE moviConCabezaId = " . $id[$i];
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
                        if ($nr == 0) {
                            $query = "INSERT INTO contasaldoscontables(saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
                                    " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
                                    " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr) VALUES ( " .
                                    $empresa . ", '" . $periodo . "','cont', '', '" . $cuenta . "',0,0," . $debito . "," . $credito . ",0,0)";
                            $resultag = mysqli_query($con, $query);
                        } else {
                            $query = "UPDATE contasaldoscontables SET saldcontDebitos =  saldcontDebitos + " .
                                    $debito * $multiplicador .
                                    ", saldcontCreditos = saldcontCreditos + " . $credito * $multiplicador .
                                    " WHERE saldcontEmpresaid = " . $empresa .
                                    " AND saldcontPeriodo = '" . $periodo .
                                    "' AND saldcontTipo = 'cont'   AND saldcontCuentaContable = '" . $cuenta .
                                    "'  AND saldcontId > 0 ";
                            $resultag = mysqli_query($con, $query);
                        }
                    }
                    $query = " SELECT pucMayor FROM contaplancontable " .
                            " WHERE pucEmpresaId=" . $empresa . " AND pucCuenta = '" . $cuenta . "'";

                    $resultag = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($resultag)) {
                        $cuenta = $row['pucMayor'];
                    }
                    if ($cuenta === '0') {
                        $ok = false;
                    }
                }
            }

            if ($multiplicador === 1) {
                $query = "UPDATE contamovicabeza SET movicaProcesado = 'S' WHERE movicaId = " . $id[$i];
            } else {
                $query = "UPDATE contamovicabeza SET movicaProcesado = 'N' WHERE movicaId = " . $id[$i];
            }
            $resultag = mysqli_query($con, $query);
        } else {
            $errados += 1;
        }
    }
    if ($er != '') {
        $tit .= " Hay " . $errados . " comprobantes errados y no se actualizaron : \n" . $er;
    }
    echo $tit;
}

function validaComp($empresa, $id) {
    $er = '';
    global $objClase;
    $con = $objClase->conectar();
    $query = "SELECT  sum(moviConDebito - moviConCredito) sl2 FROM contamovidetalle " .
            " WHERE moviConCabezaId = " . $id;
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $sl2 = $row['sl2'];
    }
    if ($sl2 != 0) {
        $comp = xErr($id, $empresa);
        $er .= $comp . " descuadrado en " . $sl2 . "\n";
    }
    $query = "SELECT moviConCuenta FROM contamovidetalle where moviConCabezaId = " . $id;
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $query = "SELECT COUNT(*) Nr FROM contaplancontable WHERE pucEmpresaId = " . $empresa .
                " AND pucCuenta = '" . $row['moviConCuenta'] . "' ";

        $resultado = mysqli_query($con, $query);
        while ($rec = mysqli_fetch_assoc($resultado)) {

            if ($rec['Nr'] === '0') {
                $comp = xErr($id, $empresa);
                $er .= ' comprobante ' . $comp . ' No existe la cuenta ' . $row['moviConCuenta'] . ' Revise el PUC ';
            }
        }
    }
    return $er;
}

function xErr($id, $empresa) {
    global $objClase;
    $con = $objClase->conectar();
    $comp = '';
    $query = "SELECT concat(movicaComprId,'-', movicaCompNro) comp FROM contamovicabeza " .
            " WHERE movicaId = " . $id . " AND movicaEmpresaId = " . $empresa;
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $comp = $row['comp'];
    }
    return $comp;
}

function actualizaMoviContamovidetalle($empresa, $periodo, $tipo, $cuenta, $cuentaContable, $multiplicador, $ValorDb, $valorCr) {
    $miObjeto = new contamovicabeza();
    $objClase = new DBManager;
    if ($objClase->conectar() == true) {
        $sql = "SELECT count(*) AS nrec FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
                " AND saldcontPeriodo = '" . $periodo . "' AND saldcontTipo = '" . $tipo .
                "'  AND saldcontCuenta = '" . $cuenta . "' AND saldcontCuentaContable = '" . $cuentaContable . "' ";
        $resultac = mysql_query($sql);
        while ($fila = mysql_fetch_array($resultac)) {
            $nr = $fila['nrec'];
            if ($nr == 0) {

                $sql = "INSERT INTO contasaldoscontables(saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
                        " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, saldcontDebitos, " .
                        "saldcontCreditos, saldcontFinalDb, saldconFinalCr) VALUES ( " .
                        $empresa . ", '" . $periodo . "','" . $tipo . "', '" . $cuenta . "', '" . $cuentaContable . "',0,0," . $ValorDb . "," . $valorCr . ",0,0)";
                $resultag = mysql_query($sql);
            } else {
                $sql = "UPDATE contasaldoscontables SET saldcontDebitos =  saldcontDebitos + " . $ValorDb * $multiplicador .
                        ", saldcontCreditos = saldcontCreditos + " . $valorCr * $multiplicador . " WHERE saldcontEmpresaid = " . $empresa .
                        " AND saldcontPeriodo = '" . $periodo . "' AND saldcontTipo = '" . $tipo .
                        "'  AND saldcontCuenta = '" . $cuenta . "' AND saldcontCuentaContable = '" . $cuentaContable . "'  AND saldcontId > 0 ";
                $resultag = mysql_query($sql);
            }
        }
    }
}

function actualizaMov($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = $data->dato;
    $rec = explode('||', $dato);
    $nr = 0;
    $query = "SELECT count(*) as nr FROM contamovidetalle WHERE moviConCabezaId = " . $rec[1];
    $resultac = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($resultac))
//        {
//            $nr = $row['nr'];
//        }
        if ($rec[0] === '0') {
            $query = "INSERT INTO contamovidetalle (moviConCabezaId ,moviConDetalle, moviConCuenta, " .
                    " moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, " .
                    " moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2, moviTipoCta) VALUES (" .
                    $rec[1] . ",'" . $rec[2] . "','" . $rec[3] . "','" . $rec[4] . "','" . $rec[5] . "','" . $rec[6] . "','" .
                    $rec[7] . "','" . $rec[8] . "','" . $rec[9] . "','" . $rec[10] . "','" . $rec[11] . "','" .
                    $rec[12] . "','" . $rec[13] . "')";
            mysqli_query($con, $query);
            echo 'Ok';
        } else {
            $query = " UPDATE contamovidetalle SET " .
                    " moviConDetalle = '" . $rec[2] . "'," .
                    " moviConCuenta = '" . $rec[3] . "'," .
                    " moviConDebito = '" . $rec[4] . "'," .
                    " moviConCredito = '" . $rec[5] . "'," .
                    " moviConBase = '" . $rec[6] . "'," .
                    " moviConImpTipo = '" . $rec[7] . "'," .
                    " moviConImpPorc = '" . $rec[8] . "'," .
                    " moviConImpValor = '" . $rec[9] . "'," .
                    " moviConIdTercero = '" . $rec[10] . "'," .
                    " moviDocum1 = '" . $rec[11] . "'," .
                    " moviDocum2 = '" . $rec[12] . "'," .
                    " moviTipoCta = '" . $rec[13] . "' " .
                    " WHERE moviConId = " . $rec[0];
            mysqli_query($con, $query);
            echo 'Ok';
        }
}

function transfiereSaldos($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $perIni = $data->perIni;
    $perFin = $data->perFin;
    $respuesta = '';
    set_time_limit(500);
    while ($perIni < $perFin) {
        $mesini = (int) substr($perIni, 4, 2);
        $anofin = (int) substr($perIni, 0, 4);
        $mesfin = $mesini + 1;
        if ($mesfin > 13) {
            $mesfin = 0;
            $anofin += 1;
        }
        $periodoIni = $perIni;
        $periodoFin = (string) $anofin;
        if ($mesfin < 10) {
            $periodoFin .= '0';
        }
        $periodoFin .= (string) $mesfin;

        $query = "UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
                " saldconFinalCr=saldcontInicialCr + saldcontCreditos " .
                " WHERE saldcontEmpresaid= " . $empresa . " AND saldcontPeriodo = '" . $periodoIni . "' ";
        mysqli_query($con, $query);

        $query = "UPDATE contasaldoscontables SET saldconNeto = saldcontFinalDb - saldconFinalCr " .
                " WHERE saldcontEmpresaid= " . $empresa . " AND saldcontPeriodo = '" . $periodoIni . "' ";
        mysqli_query($con, $query);

        $query = "INSERT INTO contasaldoscontables (saldcontEmpresaid, saldcontPeriodo, saldcontTipo,  " .
                " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr,  " .
                " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr,saldconNeto)  " .
                " SELECT " . $empresa . ", '" . $periodoFin . "', 'cont', ' ', saldcontCuentaContable, " .
                " saldcontFinalDb, saldconFinalCr, 0, 0, 0, 0, 0 FROM contasaldoscontables  " .
                " WHERE saldcontCuentaContable NOT IN (SELECT saldcontCuentaContable FROM contasaldoscontables  " .
                " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo =  '" . $periodoFin .
                "') AND saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo =  '" . $periodoIni .
                "' ORDER BY saldcontCuentaContable";
        mysqli_query($con, $query);

        $query = "UPDATE contasaldoscontables SET  saldcontDebitos = 0, saldcontCreditos = 0 " .
                " WHERE saldcontEmpresaid= " . $empresa . " AND saldcontPeriodo = '" . $periodoFin . "' ";
        mysqli_query($con, $query);

        $query = " UPDATE contasaldoscontables sFin, contasaldoscontables sIni " .
                " SET sFin.saldcontInicialDb = sIni.saldcontFinalDb, sFin.saldcontInicialCr = sIni.saldconFinalCr " .
                " WHERE sFin.saldcontEmpresaid = sIni.saldcontEmpresaid " .
                " AND sFin.saldcontTipo = sIni.saldcontTipo " .
                " AND sFin.saldcontCuentaContable = sIni.saldcontCuentaContable " .
                " AND sIni.saldcontPeriodo = '" . $periodoIni . "'  AND sFin.saldcontPeriodo =  '" . $periodoFin .
                "' AND sFin.saldcontEmpresaid = " . $empresa;
        mysqli_query($con, $query);
        if ($mesfin === 0) {
            $query = "SELECT empresaCuentaCierre FROM contaempresas WHERE empresaId = " . $empresa;
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $cierre .= $row['empresaCuentaCierre'] . ',';
            }
            $salIng = 0;
            $salGas = 0;
            $query = "SELECT saldconNeto FROM contasaldoscontables WHERE saldcontCuentaContable = '4' " .
                    " AND saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $periodoIni . "'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $salIng .= $row['saldconNeto'] . ',';
            }
            $query = "SELECT saldconNeto FROM contasaldoscontables WHERE saldcontCuentaContable = '5' " .
                    " AND saldcontEmpresaid = " . $empresa . " AND saldcontPeriodo = '" . $periodoIni . "'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $salGas .= $row['saldconNeto'] . ',';
            }
        } else {
            $selected = '';
            $query = "SELECT movicaId FROM contamovicabeza WHERE movicaEmpresaId  = " . $empresa .
                    " AND movicaPeriodo = '" . $periodoFin . "' ";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $selected .= $row['movicaId'] . ',';
            }
            $n = strlen($selected);
            $selected = substr($selected, 0, $n - 1);

            actualizaCp($empresa, $periodoFin, $selected, '', '1');

            $respuesta .= " Del " . $periodoFin . ' Al ' . $periodoFin;
            $perIni = $periodoFin;
            if ($mesfin === 13) {
                $query = "UPDATE contasaldoscontables SET saldcontFinalDb = saldcontInicialDb + saldcontDebitos, " .
                        " saldconFinalCr=saldcontInicialCr + saldcontCreditos " .
                        " WHERE saldcontEmpresaid= " . $empresa . " AND saldcontPeriodo = '" . $periodoFin . "' ";
                mysqli_query($con, $query);
                $query = "UPDATE contasaldoscontables SET saldconNeto = saldcontFinalDb - saldconFinalCr " .
                        " WHERE saldcontEmpresaid= " . $empresa . " AND saldcontPeriodo = '" . $periodoFin . "' ";
                mysqli_query($con, $query);
            }
        }
    }
    $respuesta = "Saldos trasferidos " . $respuesta;
    echo $respuesta;
    return $respuesta;
}

function creaCuentas($empresa, $periodo, $cuenta, $debito, $credito) {
    global $objClase;
    $con = $objClase->conectar();
    $ok = true;
    while ($ok) {
        $query = "SELECT count(*) AS nrec FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
                " AND saldcontPeriodo = '" . $periodo . "' AND saldcontTipo = 'cont' " .
                " AND saldcontCuentaContable = '" . $cuenta . "' ";
        $result = mysqli_query($con, $query);
        while ($fila = mysqli_fetch_assoc($result)) {
            $nr = $fila['nrec'];
            if ($nr == 0) {
                $query = "INSERT INTO contasaldoscontables(saldcontEmpresaid, saldcontPeriodo, saldcontTipo, " .
                        " saldcontCuenta, saldcontCuentaContable, saldcontInicialDb, saldcontInicialCr, " .
                        " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr, saldconNeto) VALUES ( " .
                        $empresa . ", '" . $periodo . "','cont', '', '" . $cuenta . "'," . $debito . "," . $credito . "0,0,,0,0,0)";
                $resultag = mysqli_query($con, $query);
            } else {
                $query = "UPDATE contasaldoscontables " .
                        " SET saldcontInicialDb  =  saldcontInicialDb + " . $debito .
                        " , saldcontInicialCr  =  saldcontInicialCr + " . $credito .
                        " WHERE saldcontEmpresaid = " . $empresa .
                        " AND saldcontPeriodo = '" . $periodo .
                        "' AND saldcontTipo = 'cont'   AND saldcontCuentaContable = '" . $cuenta .
                        "'  AND saldcontId > 0 ";
                $resultag = mysqli_query($con, $query);
            }

            $query = "SELECT pucMayor FROM contaplancontable WHERE pucEmpresaId = " . $empresa .
                    "  AND pucCuenta = '" . $cuenta . "' ";
            $resultag = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($resultag)) {
                $mayor = $row['pucMayor'];
            }
            if ($mayor === 0) {
                $ok = false;
            }
        }
    }
}

function actualizaOper($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = $data->dato;
    $rec = explode('||', $dato);
    $query = "INSERT INTO contamovicabeza(movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, " .
            " movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec) " .
            " VALUES ('" . $rec[1] . "','" . $rec[12] . "','" . $rec[11] . "','" . $rec[4] . "','" .
            $rec[5] . "','N','" . $rec[3] . "','" . $rec[2] . "','0','" . $rec[0] . "')";
    mysqli_query($con, $query);
    $nroCabeza = mysqli_insert_id($con);
//"MEC||5||--||2018-01-17||922||Arriendo Local 26 mes de||--31|| ||undefined||undefined||06||83||06|| 
//13-> 3599375|| || || || || ||683881|| || ||4283256|| || ||111005|| || ||415505||236705||"
    $an[0][0] = 13;
    $an[0][1] = 14;
    $an[1][0] = 15;
    $an[1][1] = 16;
    $an[2][0] = 17;
    $an[2][1] = 18;
    $an[3][0] = 19;
    $an[3][1] = 20;
    $an[4][0] = 21;
    $an[4][1] = 22;
    $an[5][0] = 23;
    $an[5][1] = 24;

    for ($i = 25; $i < 31; $i++) {
//echo '('.$i.')  db ' .$an[$i-25][0] .' cr '.   $an[$i-25][1];        
        if ($rec[$i] != '') {
            $db = $an[$i - 25][0];
            $cr = $an[$i - 25][1];
            $tpCta = 'D';
            if ($rec[$cr] != '') {
                $tpCta = 'C';
            }
            if ($rec[$cr] === '') {
                $rec[$cr] = '0';
            }
            if ($rec[$db] === '') {
                $rec[$db] = '0';
            }
            $query = "INSERT INTO contamovidetalle (moviConCabezaId ,moviConDetalle, moviConCuenta, " .
                    " moviConDebito, moviConCredito, moviConBase, moviConImpTipo, moviConImpPorc, " .
                    " moviConImpValor, moviConIdTercero, moviDocum1, moviDocum2, moviTipoCta) VALUES (" .
                    $nroCabeza . ",'" . $rec[5] . "','" . $rec[$i] . "','" . $rec[$db] . "','" . $rec[$cr] . "','0','','0','0','" .
                    $rec[4] . "','','" . $rec[0] . "','" . $tpCta . "')";
            mysqli_query($con, $query);
//echo $query;                
        }
    }
    $query = " UPDATE contacomprobantes SET compConsecutivo = compConsecutivo + 1 " .
            " WHERE compCodigo = '" . $rec[12] . "' AND compEmpresaId = " . $rec[1];
    mysqli_query($con, $query);
    echo 'Ok';
}

function exportaXls($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $periodo = $data->periodo;
    $expo = '';
    $expo .= '<table border=1 class="table2Excel"> ';
    $expo .= '<tr> ';

    $expo .= '          <th>COMPROBANTE</th>';
    $expo .= '          <th>NOM COMPROBANTE</th>';
    $expo .= '          <th>NUMERO</th>';
    $expo .= '          <th>TERCERO</th>';
    $expo .= '          <th>DETALLE</th>';
    $expo .= '          <th>PROCESADO</th>';
    $expo .= '          <th>FECHA</th>';
    $expo .= '          <th>PERIODO</th>';
    $expo .= '          <th>DOCUMPPAL</th>';
    $expo .= '          <th>DOCUMSEC</th>';

    $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, compNombre,  movicaCompNro, movicaTerceroId, " .
            " terceroNombre, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec" .
            " FROM contamovicabeza  " .
            " INNER JOIN contacomprobantes ON movicaComprId=compCodigo AND movicaEmpresaId = compEmpresaId " .
            " INNER JOIN contaterceros ON movicaTerceroId = terceroId " .
            " WHERE movicaEmpresaId = " . $empresa . " AND movicaPeriodo = '" . $periodo . "' " .
            " ORDER BY movicaPeriodo ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
//                    $expo .=  	'<td>' .$row['movicaId']. '</td> ';
//                    $expo .=  	'<td>' .$row['movicaEmpresaId']. '</td> ';
//                    $expo .=  	'<td>' .$row['movicaComprId']. '</td> ';
            $expo .= '<td>' . $row['movicaComprId'] . '</td> ';
            $expo .= '<td>' . $row['compNombre'] . '</td> ';
            $expo .= '<td>' . $row['movicaCompNro'] . '</td> ';
            $expo .= '<td>' . utf8_decode($row['terceroNombre']) . '</td> ';
            $expo .= '<td>' . utf8_decode($row['movicaDetalle']) . '</td> ';
            $expo .= '<td>' . $row['movicaProcesado'] . '</td> ';
            $expo .= '<td>' . $row['movicaFecha'] . '</td> ';
            $expo .= '<td>' . $row['movicaPeriodo'] . '</td> ';
            $expo .= '<td>' . $row['movicaDocumPpal'] . '</td> ';
            $expo .= '<td>' . $row['movicaDocumSec'] . '</td> ';
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
    $query = "SELECT  MAX(movicaId) as id 
                    FROM contamovicabeza";
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
    $movicaId = $data->movicaId;
    $query = "SELECT  movicaId, movicaEmpresaId, movicaComprId, movicaCompNro, movicaTerceroId, movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec  " .
            " FROM contamovicabeza  WHERE movicaId = " . $movicaId .
            " ORDER BY movicaPeriodo ";
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
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $control = $data->control;
    $query = "SELECT compCodigo, compNombre FROM contacomprobantes WHERE compEmpresaId = " . $empresa;
    if ($control === 'M') {
        $query .= " AND compTipo = 'O' ";
    } else {
        $query .= " AND compTipo = 'C' ";
    }
    $query .= " ORDER BY  compNombre";
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
    $query = "SELECT terceroId,  terceroNombre FROM contaterceros  WHERE terceroEmpresaId = " . $empresa .
            "ORDER BY  terceroNombre";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista2($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $control = $data->control;
    $query = '';
    if ($control === 'C2') {
        $query .= "SELECT '' AS pucCuenta , 'Ninguna' As pucNombre UNION  ";
    }
    $query .= "SELECT pucCuenta,  CONCAT(pucCuenta,'-', pucNombre) pucNombre FROM contaplancontable " .
            "WHERE pucTipo = 'M' AND pucEmpresaId = " . $empresa .
            " ORDER BY  pucCuenta";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista2c($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT pucCuenta,  CONCAT(pucCuenta,'-', pucNombre) pucNombre FROM contaplancontable " .
            "WHERE pucTipo = 'T' AND pucEmpresaId = " . $empresa .
            " ORDER BY  pucCuenta";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 11, 2020 7:44:09   <<<<<<< 
