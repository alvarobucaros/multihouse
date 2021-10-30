<?php

include_once("../bin/cls/clsConection.php");
//$objClase = new DBconexion();
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

    case 'rn':
        renumeraLista($data);
        break;
    case 'exp':
        exportaXls($data);
        break;
    case 'exl':
        exportaContaXls($data);
        break;
    case '0':
        lista0($data);
        break;
    case '1':
        lista1($data);
        break;
    case '2m':
        lista2m($data);
        break;
    case '2t':
        lista2t($data);
        break;
    case '3':
        lista3($data);
        break;
    case '4':
        lista4($data);
        break;
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $lista = $data->lista;
    {
        $query = "SELECT  infoId, infoEmpresa, infoReporte, infoLinea, " .
                " CASE intoTipo WHEN 'S' THEN 'Salto' WHEN 'T' THEN 'Titulo' WHEN 'R' THEN 'Resume' ELSE 'Cuenta'  " .
                " END  intoNomTipo, intoTipo, infoCodigo, infoNombre, " .
                " infoCuentasIN, infoCuentasOUT, infoFormula, infoNro, infoNotas, infoIndenta,  " .
                " infoNuevaPagina, infoMultiplicador " .
                " FROM containformes WHERE infoEmpresa = " . $empresa . " AND infoReporte = '" . $lista .
                "' ORDER BY infoLinea ";
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
    $query = "DELETE FROM containformes WHERE infoId=$data->infoId";
    mysqli_query($con, $query);
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $infoId = $data->infoId;
    $infoEmpresa = $data->infoEmpresa;
    $infoReporte = $data->infoReporte;
    $infoLinea = $data->infoLinea;
    $intoTipo = $data->intoTipo;
    $infoCodigo = $data->infoCodigo;
    $infoNombre = $data->infoNombre;
    $infoCuentasIN = $data->infoCuentasIN;
    $infoCuentasOUT = $data->infoCuentasOUT;
    $infoFormula = $data->infoFormula;
    $infoNro = $data->infoNro;
    $infoNotas = $data->infoNotas;
    $infoIndenta = $data->infoIndenta;
    $infoNuevaPagina = $data->infoNuevaPagina;
    $infoMultiplicador = $data->infoMultiplicador;

    if ($infoId == 0) {
        $query = "INSERT INTO containformes(infoEmpresa, infoReporte, infoLinea, intoTipo, infoCodigo, " .
                " infoNombre, infoCuentasIN, infoCuentasOUT, infoFormula, infoNro, infoNotas, infoIndenta, " .
                " infoNuevaPagina, infoMultiplicador)";
        $query .= "  VALUES ('" . $infoEmpresa . "', '" . $infoReporte . "', '" . $infoLinea . "', '" .
                $intoTipo . "', '" . $infoCodigo . "', '" . $infoNombre . "', '" . $infoCuentasIN . "', '" .
                $infoCuentasOUT . "', '" . $infoFormula . "', '" . $infoNro . "', '" . $infoNotas . "', '" .
                $infoIndenta . "', '" . $infoNuevaPagina . "', '" . $infoMultiplicador . "')";
        mysqli_query($con, $query);
        echo 'Ok';
    } else {
        $query = "UPDATE containformes  SET infoEmpresa = '" . $infoEmpresa . "', infoReporte = '" . $infoReporte .
                "', infoLinea = '" . $infoLinea . "', intoTipo = '" . $intoTipo . "', infoCodigo = '" . $infoCodigo .
                "', infoNombre = '" . $infoNombre . "', infoCuentasIN = '" . $infoCuentasIN . "', infoCuentasOUT = '" .
                $infoCuentasOUT . "', infoFormula = '" . $infoFormula . "', infoNro = '" . $infoNro . "', infoNotas = '" .
                $infoNotas . "', infoIndenta = '" . $infoIndenta . "', infoNuevaPagina = '" .
                $infoNuevaPagina . "', infoMultiplicador = '" . $infoMultiplicador .
                "' WHERE infoId = " . $infoId;
        mysqli_query($con, $query);
        echo 'Ok';
    }
}

function valida($info) {
    
}

function exportaContaXls($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $dato = $data->dato;
    $rec = explode('||', $dato);
    $fchIni = $rec[1];
    $fchFin = $rec[2];
    $expo = '';
    $expo .= '<table border=1 class="table2Excel"> ';
    $expo .= '<tr> ';
    $expo .= '          <th>COMPROBANTE</th>';
    $expo .= '          <th>NUMERO</th>';
    $expo .= '          <th>PERIODO</th>';
    $expo .= '          <th>FECHA</th>';
    $expo .= '          <th>CUENTA</th>';
    $expo .= '          <th>NOMBRE</th>';
    $expo .= '          <th>DEBITO</th>';
    $expo .= '          <th>CREDITO</th>';
    if ($rec[4]) {
        $expo .= '          <th>TERCERO</th>';
    }
    if ($rec[5]) {
        $expo .= '          <th>TIPO ID</th>';
        $expo .= '          <th>NRO ID</th>';
    }
    if ($rec[6]) {
        $expo .= '          <th>DETALLE</th>';
    }
    if ($rec[8]) {
        $expo .= '          <th>DOCUMENTO</th>';
    }
    if ($rec[9]) {
        $expo .= '          <th>BASE</th>';
    }
    if ($rec[10]) {
        $expo .= '          <th>PORCENTAJE</th>';
    }
    $expo .= '</tr> ';
    $query = "SELECT movicaId, movicaComprId, compNombre, movicaCompNro,  movicaPeriodo, movicaFecha, " .
            " movicaDetalle, movicaTerceroId , movicaDocumPpal , movicaDocumSec, terceroIdenTipo," .
            " terceroIdenNumero,terceroNombre, moviConCuenta, pucNombre, moviConDebito, moviConCredito, " .
            " moviConImpTipo, moviConImpPorc, moviConImpValor " .
            " FROM contamovicabeza" .
            " INNER JOIN  contamovidetalle ON movicaId = moviConCabezaId " .
            " INNER JOIN contaplancontable ON pucCuenta = moviConCuenta  AND pucEmpresaId = movicaEmpresaId " .
            " INNER JOIN contacomprobantes ON movicaComprId = compCodigo  AND compEmpresaId = movicaEmpresaId " .
            " INNER JOIN contaterceros ON  terceroId = movicaTerceroId AND terceroEmpresaId = movicaEmpresaId " .
            " WHERE  movicaEmpresaId = " . $empresa .
            "  AND movicaFecha >= '" . $fchIni . "' AND movicaFecha <= '" . $fchFin . "'" .
            " ORDER BY movicaPeriodo, movicaCompNro, moviConDebito DESC";

    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $expo .= '<tr> ';
        $expo .= '<td>' . $row['compNombre'] . '</td> ';
        $expo .= '<td>' . $row['movicaCompNro'] . '</td> ';
        $expo .= '<td>' . $row['movicaPeriodo'] . '</td> ';
        $expo .= '<td>' . $row['movicaFecha'] . '</td> ';
        $expo .= '<td>' . $row['moviConCuenta'] . '</td> ';
        $expo .= '<td>' . utf8_decode($row['pucNombre']) . '</td> ';
        $expo .= '<td>' . $row['moviConDebito'] . '</td> ';
        $expo .= '<td>' . $row['moviConCredito'] . '</td> ';
        if ($rec[4]) {
            $expo .= '<td>' . utf8_decode($row['terceroNombre']) . '</td>';
        }
        if ($rec[5]) {
            $expo .= '<td>' . $row['terceroIdenTipo'] . '</td>';
            $expo .= '<td>' . $row['terceroIdenNumero'] . '</td>';
        }
        if ($rec[6]) {
            $expo .= '<td>' . utf8_decode($row['movicaDetalle']) . '</td>';
        }
        if ($rec[8]) {
            $expo .= '<td>' . utf8_decode($row['movicaDocumPpal'] . ' - ' . $row['movicaDocumSec']) . '</td>';
        }
        if ($rec[9]) {
            $expo .= '<td>' . $row['moviConImpValor'] . '</td>';
        }
        if ($rec[10]) {
            $expo .= '<td>' . $row['moviConImpPorc'] . '</td>';
        }
        $expo .= '</tr> ';
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
//      $expo .=  '          <th>ID</th>';
//      $expo .=  '          <th>EMPRESA</th>';
    $expo .= '          <th>REPORTE</th>';
    $expo .= '          <th>LINEA</th>';
    $expo .= '          <th>TIPO</th>';
    $expo .= '          <th>NOM TIPO</th>';
    $expo .= '          <th>CODIGO</th>';
    $expo .= '          <th>NOMBRE</th>';
    $expo .= '          <th>INCLUIDA</th>';
    $expo .= '          <th>EXCLUIDA</th>';
    $expo .= '          <th>FORMULA</th>';
//      $expo .=  '          <th>NRO</th>';
    $expo .= '          <th>NOTAS</th>';
    $expo .= '          <th>INDENTA</th>';
    $expo .= '          <th>PAGINA</th>';
    $expo .= '          <th>MULTIPLICA</th>';
    $query = "SELECT  infoId, infoEmpresa, infoReporte, infoLinea, intoTipo, infoCodigo, infoNombre, " .
            " infoCuentasIN, infoCuentasOUT, infoFormula, infoNro, infoNotas, infoIndenta, infoNuevaPagina, infoMultiplicador"
            . " FROM containformes ORDER BY infoCodigo ";
    $query = "SELECT  infoId, infoEmpresa, infoReporte, infoLinea,  " .
            " CASE intoTipo WHEN 'S' THEN 'Salto' WHEN 'T' THEN 'Titulo' WHEN 'R' THEN 'Resume' ELSE 'Cuenta'  " .
            " END  intoNomTipo, intoTipo, infoCodigo, infoNombre, " .
            " infoCuentasIN, infoCuentasOUT, infoFormula, infoNro, infoNotas, infoIndenta,  " .
            " infoNuevaPagina, infoMultiplicador " .
            " FROM containformes WHERE infoEmpresa = " . $empresa . " AND infoReporte = '" . $lista .
            "' ORDER BY infoLinea ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $expo .= '<tr> ';
//                $expo .=  	'<td>' .$row['infoId']. '</td> ';
//                $expo .=  	'<td>' .$row['infoEmpresa']. '</td> ';
            $expo .= '<td>' . $row['infoReporte'] . '</td> ';
            $expo .= '<td>' . $row['infoLinea'] . '</td> ';
            $expo .= '<td>' . $row['intoTipo'] . '</td> ';
            $expo .= '<td>' . $row['intoNomTipo'] . '</td> ';
            $expo .= '<td>' . $row['infoCodigo'] . '</td> ';
            $expo .= '<td>' . $row['infoNombre'] . '</td> ';
            $expo .= '<td>' . $row['infoCuentasIN'] . '</td> ';
            $expo .= '<td>' . $row['infoCuentasOUT'] . '</td> ';
            $expo .= '<td>' . $row['infoFormula'] . '</td> ';
            //               $expo .=  	'<td>' .$row['infoNro']. '</td> ';
            $expo .= '<td>' . $row['infoNotas'] . '</td> ';
            $expo .= '<td>' . $row['infoIndenta'] . '</td> ';
            $expo .= '<td>' . $row['infoNuevaPagina'] . '</td> ';
            $expo .= '<td>' . $row['infoMultiplicador'] . '</td> ';
            $expo .= '</tr> ';
        }
    }
    $expo .= '</table> ';
    echo $expo;
    return $expo;
}

function renumeraLista($data) {
    global $objClase;
    $con = $objClase->conectar();
    $dato = $data->dato;
    $dat = explode(',', $dato);
    $lin = array();
    $num = array();
    $i = 0;
    $query = "SELECT infoId, infoLinea, infoCodigo, infoFormula FROM containformes " .
            " WHERE infoEmpresa = " . $dat[0] . " AND infoReporte ='" . $dat[1] . "' ORDER BY  infoLinea";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $i += 1;
        array_push($lin, $row['infoLinea']);
        array_push($num, $i * 10);
    }
    mysqli_data_seek($result, 0);
    $longitud = count($lin);
    while ($row = mysqli_fetch_assoc($result)) {
        $indice = array_search($row['infoLinea'], $lin, false);
        $id = $row['infoId'];
        $ln = $num[$indice];
        $cod = 'L' . $ln;
        $frm = str_replace([':', '\\', '/', '*', ' '], '', $row['infoFormula']);
        if ($frm != '') {
            for ($i = 0; $i < count($lin); $i++) {
                $frm = str_replace($lin[$i], $num[$i], $frm);
            }
        }

        $query = "UPDATE containformes SET infoLinea = '" . $ln . "', infoCodigo = '" .
                $cod . "', infoFormula = '" . $frm . "' WHERE infoId = " . $id;
        $resulte = mysqli_query($con, $query);
    }
    echo 'Proceso renumeroa Ok.';
}

function maxRegistroId($data) {
    global $objClase;
    $con = $objClase->conectar();
    $id = 0;
    $query = "SELECT  MAX(infoId) as id 
                    FROM containformes";
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
    $infoId = $data->infoId;
    $query = "SELECT  infoId, infoEmpresa, infoReporte, infoLinea, intoTipo, infoCodigo, infoNombre, infoCuentasIN, infoCuentasOUT, infoFormula, infoNro, infoNotas, infoIndenta, infoNuevaPagina, infoMultiplicador  " .
            " FROM containformes  WHERE infoId = " . $infoId .
            " ORDER BY infoCodigo ";
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
    $query = "SELECT tipoCodigo,  tipoDetalle FROM contatipoinforme WHERE tipoEmpresa = " .
            $empresa . " ORDER BY tipoDetalle";
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
    $query = "SELECT 00 compCodigo,'TODOS LOS COMPROBANTES' compNombre UNION " .
            " SELECT compCodigo,compNombre FROM contacomprobantes WHERE  compEmpresaId = " .
            $empresa . " AND compTipo = 'C' ORDER BY compCodigo";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista2m($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT pucCuenta,  CONCAT(pucCuenta,'-', pucNombre) pucNombre FROM contaplancontable " .
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

function lista2t($data) {
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

function lista3($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT tipoCodigo, tipoDetalle FROM contatipoinforme WHERE tipoEmpresa= " . $empresa .
            " ORDER BY  tipoDetalle";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

function lista4($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    $query = "SELECT terceroId, terceroNombre FROM contaterceros WHERE  terceroEmpresaId = " . $empresa .
            " ORDER BY  terceroNombre";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Mar 09, 2020 8:33:07   <<<<<<< 

    