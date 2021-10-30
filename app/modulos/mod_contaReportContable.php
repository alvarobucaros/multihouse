<?php

if (!isset($_SESSION)) {
    session_start();
}

class reportesContCls {

    public function cargaEmpresa($empresa) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $result = '';
        $sql = "SELECT empresaId, empresaNombre, empresaNit, empresaDigito, empresaWeb, " .
                " empresaDireccion ,empresaCiudad ,empresaTelefonos ,empresaLogo ," .
                " empresaMensaje1, empresaMensaje2, empresaEmail, empresafacturaNota, " .
                " empresaRecargoPorc, empresaRecargoPesos, empresaRecargoDias, empresaDescPorc," .
                " empresaDescPesos, empresaFactorRedondeo, empresaPeriCierreFactura, empresatercero " .
                " FROM contaempresas  WHERE  empresaId = " . $empresa;
        $result = mysqli_query($con, $sql);
        return $result;
    }

    function saldosContables($empresa, $nivel, $periodo, $ctaini, $ctafin) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();

        $query = "SELECT saldcontCuentaContable, pucNombre,  saldcontInicialDb, saldcontInicialCr, " .
                " saldcontDebitos, saldcontCreditos, saldcontFinalDb, saldconFinalCr " .
                " FROM contasaldoscontables INNER JOIN contaplancontable ON pucCuenta = saldcontCuentaContable " .
                " WHERE saldcontEmpresaid=" . $empresa . " AND  pucEmpresaId = saldcontEmpresaid AND pucNivel = " .
                $nivel . "  AND saldcontPeriodo = '" . $periodo . "' AND saldcontTipo='cont' ";
        if ($ctaini != '0') {
            $query .= " AND saldcontCuentaContable >= '" . $ctaini . "' ";
        }
        if ($ctafin != '0') {
            $query .= " AND saldcontCuentaContable <= '" . $ctafin . "' ";
        }
        $query .= " ORDER BY saldcontCuentaContable ";
        $result = mysqli_query($con, $query);
//        echo $query;
//        return $query;
//        echo $result;
        return $result;
    }

    function detalleSaldo($empresa, $cabeza) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT moviConCuenta, pucNombre, moviConDebito, moviConCredito, moviConBase,  " .
                " moviConImpTipo, moviConImpPorc, moviConImpValor, moviConIdTercero, moviDocum1,  " .
                " moviDocum2, moviTipoCta FROM contamovidetalle  " .
                " INNER JOIN contaplancontable ON pucCuenta = moviConCuenta  " .
                " WHERE moviConCabezaId = " . $cabeza . " AND pucEmpresaId = " . $empresa;
        //         echo $query;
//         return $query;
        $result = mysqli_query($con, $query);
        return $result;
    }

    function comprobantesPeriodo($empresa, $periodo, $comprobante, $orden) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $when1 = " movicaComprId = movicaComprId ";
        if ($comprobante != 0) {
            $when1 = " movicaComprId =  " . $comprobante;
        }
        $ord = " ORDER BY movicaComprId, movicaFecha, movicaCompNro ";
        if ($orden === 'fch') {
            $ord = " ORDER BY movicaFecha, movicaComprId, movicaCompNro ";
        }
        $query = "SELECT movicaId, movicaComprId, compNombre, movicaCompNro, movicaTerceroId,  " .
                " CONCAT(terceroIdenTipo,' ',terceroIdenNumero,' - ', terceroNombre) tercero, movicaDetalle,  " .
                " movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec  " .
                " FROM contamovicabeza  " .
                " INNER JOIN contacomprobantes ON compCodigo = movicaComprId " .
                " INNER JOIN contaterceros ON movicaTerceroId = terceroId " .
                " WHERE movicaEmpresaId = " . $empresa . " AND movicaEmpresaId = compEmpresaId " .
                " AND movicaEmpresaId = terceroEmpresaId  " .
                " AND " . $when1 . " AND movicaPeriodo = '" . $periodo . "' " .
                " AND movicaTerceroId > 0 " .
                " UNION " .
                " SELECT movicaId, movicaComprId, compNombre, movicaCompNro, '' movicaTerceroId, '' tercero, " .
                " movicaDetalle, movicaProcesado, movicaFecha, movicaPeriodo, movicaDocumPpal, movicaDocumSec " .
                " FROM contamovicabeza " .
                " INNER JOIN contacomprobantes ON compCodigo = movicaComprId " .
                " WHERE movicaEmpresaId = " . $empresa . " AND movicaEmpresaId = compEmpresaId " .
                " AND " . $when1 . " AND movicaPeriodo = '" . $periodo . "' " .
                " AND movicaTerceroId <0 " . $ord;
//         echo $query; $periodoIni, $periodoFin, $empresa, $orden, $comprob
//         return $query;
        $result = mysqli_query($con, $query);
        return $result;
    }

    function comprobantesDelMes($periodoIni, $periodoFin, $empresa, $orden, $proc, $tercero) {
        if (is_null($tercero) || empty($tercero)) {
            $ter = "(movicaTerceroId = 0 OR movicaTerceroId = -1)";
        } else {
            $ter = "movicaTerceroId = " . $tercero;
        }
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $cond = 'movicaProcesado = "' . $proc . '" ';
        if ($proc == '') {
            $cond = 'movicaProcesado <> "" ';
        }
        $result = "";
        $query = " SELECT movicaId, movicafecha, movicaComprId, compNombre, movicaCompNro, terceroNombre, " .
                " movicaProcesado , movicaDetalle, movicaPeriodo, movicaDocumPpal, movicaDocumSec, terceroId " .
                " FROM contamovicabeza " .
                " INNER JOIN contacomprobantes ON movicaComprId  = compCodigo AND compEmpresaId = movicaEmpresaId " .
                " INNER JOIN contaterceros ON   movicaTerceroId =  terceroId AND terceroEmpresaId = movicaEmpresaId " .
                " WHERE movicaEmpresaId = compEmpresaId   and movicaEmpresaId = terceroEmpresaId  AND " .
                " movicaPeriodo BETWEEN '" . $periodoIni . "' AND '" . $periodoFin .
                "' AND movicaEmpresaId = " . $empresa . " AND " . $cond .
//            " UNION  " .
//            " SELECT movicaId, movicafecha, movicaComprId, compNombre, movicaCompNro, '' AS terceroNombre, ".
//                " movicaProcesado , movicaDetalle, movicaPeriodo , movicaDocumPpal, movicaDocumSec, -1 AS terceroId ".
//                " FROM contamovicabeza  ".
//                " INNER JOIN contacomprobantes ON movicaComprId  = compCodigo  AND compEmpresaId = movicaEmpresaId ".
//                " WHERE " . $ter . " AND movicaEmpresaId = compEmpresaId AND ".
//                " movicaPeriodo BETWEEN '".$periodoIni. "' AND '" . $periodoFin . 
//                "' AND movicaEmpresaId = " . $empresa . " AND " . $cond .
                "  ORDER BY ";
        if ($orden == 'FC') {
            $orden = "movicafecha , movicaComprId, movicaCompNro ";
        } else {
            $orden = "movicaComprId , movicafecha ";
        }
        $query .= $orden;
//         echo $query;
//         return $query;
        $result = mysqli_query($con, $query);
        return $result;
//    
    }

    function listamoviConCuentaRep($empresa, $comprobante) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = " SELECT moviConCuenta, pucNombre, moviConDetalle ,moviConDebito, moviConCredito,  " .
                " CASE moviConIdTercero WHEN -1 THEN ''  ELSE (select terceroNombre  " .
                " FROM contaterceros WHERE terceroId = moviConIdTercero  ) END AS moviConTercero,  " .
                " CASE moviConIdTercero WHEN -1 THEN ''  ELSE (select concat(terceroIdenTipo,'-' ,terceroIdenNumero) " .
                " FROM contaterceros WHERE terceroId = moviConIdTercero  ) END AS moviConTerceroId,  " .
                " moviDocum1, moviDocum2 FROM contamovidetalle  " .
                " INNER JOIN contaplancontable ON pucCuenta = moviConCuenta  " .
                " WHERE pucEmpresaId = " . $empresa . " AND moviConCabezaId = " . $comprobante;
        $result = mysqli_query($con, $query);
        return $result;
    }

    function dias_transcurridos($fecha_i, $fecha_f) {
        $di = (int) substr($fecha_i, 0, 4) * 360 + (int) substr($fecha_i, 5, 2) * 30 + (int) substr($fecha_i, 8, 2); //    2018/01/31
        $df = (int) substr($fecha_f, 0, 4) * 360 + (int) substr($fecha_f, 5, 2) * 30 + (int) substr($fecha_f, 8, 2);
        $dias = abs($df - $di);
        return $dias;
    }

    function nombreLista($empresa, $informe) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT tipoDetalle FROM contatipoinforme WHERE tipoEmpresa = " .
                $empresa . " AND tipoCodigo = '" . $informe . "'";

        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $tipoDetalle = $row['tipoDetalle'];
        }
        //       echo $tipoDetalle; 
        return $tipoDetalle;
    }

    function saldosContablesLM($empresa, $periodo, $ctaIni, $ctaFin) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = " SELECT movicaFecha, movicaComprId, compNombre, movicaCompNro, movicaDetalle, movicaProcesado, " .
                " moviConDetalle, moviConCuenta, moviConDebito, moviConCredito " .
                " FROM contamovidetalle " .
                " INNER JOIN contamovicabeza ON moviConCabezaId=movicaId and movicaPeriodo = '" . $periodo . "' " .
                " INNER JOIN contacomprobantes ON movicaComprId = compCodigo AND  compEmpresaId = " . $empresa .
                " WHERE moviConCuenta " .
                " IN (SELECT pucCuenta FROM contaplancontable " .
                " WHERE pucEmpresaId = " . $empresa .
                " AND pucCuenta BETWEEN  '" . $ctaIni . "' AND '" . $ctaFin . "' AND pucTipo='M'  ) " .
                " AND movicaPeriodo = '" . $periodo . "' ORDER BY  moviConCuenta, movicaFecha ";
        $result = mysqli_query($con, $query);
//         echo $query;
//        return $query;
        return $result;
    }

    function nombreCuentaLM($empresa, $cuenta, $periodo) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $fin = true;
        $saldo = 0.0;
        $cta = array();
        $query = "SELECT saldcontInicialDb - saldcontInicialCr As saldo  " .
                " FROM contasaldoscontables WHERE saldcontEmpresaid = " . $empresa .
                " AND saldcontPeriodo = '" . $periodo . "'  AND saldcontCuentaContable = '" . $cuenta . "'";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $saldo = $row['saldo'];
        }
        array_push($cta, $saldo);
        while ($fin) {
            //echo $cuenta.' ';
            $query = " SELECT pucCuenta, pucNombre, pucMayor " .
                    " FROM  contaplancontable " .
                    " WHERE pucEmpresaId = " . $empresa . " AND  pucCuenta='" . $cuenta . "'";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $pucCuenta = $row['pucCuenta'];
                $pucNombre = $row['pucNombre'];
                $pucMayor = $row['pucMayor'];
                if ($pucMayor === '0') {
                    array_push($cta, $cuenta . ' ' . $pucNombre);
                    $fin = false;
                } else {
                    array_push($cta, $cuenta . ' ' . $pucNombre);
                    $cuenta = $pucMayor;
                }
            }
        }
        //       echo count($cta);
// return $query;
        return $cta;
    }

    function saldosCtaMvtos($empresa, $periIni, $periFin, $ctaIni, $ctaFin) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT movicaPeriodo, movicaFecha, moviConCuenta,  pucNombre,  moviConCabezaId, movicaComprId, " .
                " compNombre, movicaCompNro,  movicaDetalle, moviConIdTercero, terceroNombre, " .
                " moviConDebito, moviConCredito,  moviDocum1 " .
                " FROM contamovidetalle, contamovicabeza, contaterceros, contacomprobantes,contaplancontable  " .
                " WHERE movicaEmpresaId =" . $empresa .
                " AND movicaPeriodo BETWEEN '" . $periIni . "' AND '" . $periFin .
                "' AND  moviConCuenta BETWEEN '" . $ctaIni . " ' AND '" . $ctaFin .
                "' AND  moviConCabezaId = movicaId AND movicaComprId=compCodigo " .
                " AND terceroId = moviConIdTercero AND terceroEmpresaId=movicaEmpresaId " .
                " AND compEmpresaId=movicaEmpresaId " .
                " AND pucEmpresaId=movicaEmpresaId AND pucCuenta = moviConCuenta AND pucTipo='M' " .
                " ORDER BY  moviConCuenta, movicaFecha, compNombre, moviConDebito DESC ";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function nombreCuenta($empresa, $cuenta) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT pucNombre FROM contaplancontable WHERE pucEmpresaId = " .
                $empresa . " AND pucCuenta = '" . $cuenta . "' ";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $pucNombre = $row['pucNombre'];
        }
//        echo $pucNombre;
        return $pucNombre;
    }

        function traeTerceros($tercero) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT terceroNombre, terceroIdenTipo, terceroIdenNumero " .
                " FROM contaterceros WHERE terceroId = ". $tercero;
        $result = mysqli_query($con, $query);
        return $result;
        }
        
    function movimientoTerceros($empresa, $tercero, $fchIni, $fchFin) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "SELECT movicaPeriodo, movicaFecha, movicaComprId, compNombre, movicaCompNro, movicaDetalle, " .
                " movicaTerceroId, terceroNombre, moviConDetalle, moviConCuenta, pucNombre, moviConDebito," .
                "  moviConCredito, terceroIdenTipo, terceroIdenNumero, movicaProcesado " .
                " FROM contamovidetalle " .
                " INNER JOIN contamovicabeza ON moviConCabezaId=movicaId  " .
                " INNER JOIN contacomprobantes ON movicaComprId = compCodigo AND compEmpresaId = " . $empresa .
                " INNER JOIN contaplancontable ON moviConCuenta = pucCuenta AND pucEmpresaId = " . $empresa .
                " INNER JOIN contaterceros ON movicaTerceroId = terceroId AND terceroEmpresaId = " . $empresa .
                " WHERE movicaTerceroId =  " . $tercero .
                " AND movicaFecha BETWEEN '" . $fchIni . "' AND '" . $fchFin . "' " .
                " ORDER BY terceroNombre, movicaFecha, moviConDebito DESC";
        $result = mysqli_query($con, $query);
        return $result;
        //   return $query;
    }

// fin de la clase
}

class reportesNif {

    var $cod = array();
    var $vlr = array();
    var $vlrD = array();

    public function reportesNifObj($data) {
        global $objClase;
        $con = $objClase->conectar();
        ;
        $dt = explode(',', $data->dato);
        $empresa = $dt[0];
        $PeriodoDer = $dt[1];
        $PeriodoIzq = $dt[2];
        $variaciones = $dt[3];
        $notas = $dt[4];
        $fchini = $dt[5];
        $fchfin = $dt[6];
        $control = $dt[7];
        $informe = $dt[8];
        $resul = $this->calculaNeto($empresa, $PeriodoDer);
        if ($PeriodoDer <> $PeriodoIzq) {
            $resul = $this->calculaNeto($empresa, $PeriodoIzq);
        }

        $query = "DELETE FROM  contatmpbalance  WHERE tmpbalempresa = " . $empresa .
                " AND tmpbalreporte = '" . $informe . "' AND  tmpbalid > 0";
        $result = mysqli_query($con, $query);

        $query = "SELECT infoLinea, infoEmpresa, infoCodigo, intoTipo, infoNombre, infoCuentasIN, infoCuentasOUT, " .
                " infoFormula, infoNotas, infoIndenta, infoNuevaPagina, infoMultiplicador, infoReporte " .
                " FROM containformes WHERE infoEmpresa = " . $empresa .
                " AND infoReporte='" . $informe . "' ORDER BY infoLinea ";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $query = $this->grabatmp($row, $PeriodoDer, $PeriodoIzq);

            $qry = explode('<>', $query);
            $resultado = mysqli_query($con, $qry[0]);
// echo ' -> '.$qry[0].' '.$qry[1].' '.$qry[2].' '.$row['infoCodigo'].' | ';
            array_push($this->vlr, $qry[1]);
            array_push($this->vlrD, $qry[2]);
            array_push($this->cod, $row['infoCodigo']);
        }

        return;
    }

    function grabatmp($row, $PeriodoDer, $PeriodoIzq) {
        $valor01 = 0.0;
        $valor02 = 0.0;
        $valor03 = 0.0;
        $query = "INSERT INTO contatmpbalance (tmpbalempresa, tmpbalreporte, tmpbalusuario, tmpbalcuenta, tmpbalnombre, " .
                " tmpbalvalor01, tmpbalvalor02, tmpbalvalor03, tmptipo, tmpbalIndenta, " .
                " tmpbalNuevaPagina, tmpbalcodigo,  tmpbalnotas)VALUES(" . $row['infoEmpresa'] . ",'" .
                $row['infoReporte'] . "','" . $row['infoLinea'] . "','";

// echo ' tp='.$row['intoTipo'].' ';    
        if ($row['intoTipo'] == 'T' || $row['intoTipo'] == 'S') {
            $query .= "','" . $row['infoNombre'] . "',0,0,0,'" . $row['intoTipo'] . "','" . $row['infoIndenta'] .
                    "','" . $row['infoNuevaPagina'] . "','" . $row['infoCodigo'] . "','" . $row['infoNotas'] . "')";
            return $query . '<>' . $valor01 . '<>' . $valor02;
        }

        if ($row['intoTipo'] == 'C') {

            if ($row['infoCuentasIN'] != '') {
                $valor01 = ($this->suma($row['infoEmpresa'], $row['infoCuentasIN'], $PeriodoDer));

                if ($PeriodoDer != $PeriodoIzq) {
                    $valor02 = ($this->suma($row['infoEmpresa'], $row['infoCuentasIN'], $PeriodoIzq));
                }
                if ($row['infoCuentasOUT'] != '') {
                    $valor01 -= ($this->suma($row['infoEmpresa'], $row['infoCuentasOUT'], $PeriodoDer));
                    if ($PeriodoDer != $PeriodoIzq) {
                        $valor02 -= ($this->suma($row['infoEmpresa'], $row['infoCuentasOUT'], $PeriodoIzq));
                    }
                }
            }
            if ($valor02 != 0) {
                $valor03 = $valor01 / $valor02;
            }
            if ($valor01 != 0 || $valor02 != 0) {
                $query .= "','" . $row['infoNombre'] . "'," . $valor01 . "," . $valor02 . "," . $valor03 .
                        ",'" . $row['intoTipo'] . "','" . $row['infoIndenta'] .
                        "','" . $row['infoNuevaPagina'] . "','" . $row['infoCodigo'] . "','" . $row['infoNotas'] . "')";
            }
            return $query . '<>' . $valor01 . '<>' . $valor02;
        }

        if ($row['intoTipo'] === 'R') {
            if ($row['infoFormula'] != '') {
                $valor01 = $this->sumaR($row['infoFormula'], $this->cod, $this->vlr); //*$row['infoMultiplicador'];
                if ($PeriodoDer != $PeriodoIzq) {
                    $valor02 = $this->sumaR($row['infoFormula'], $this->cod, $this->vlrD); //*$row['infoMultiplicador'];
                }
            }
            $query .= "','" . $row['infoNombre'] . "'," . $valor01 . "," . $valor02 . "," . $valor03 .
                    ",'" . $row['intoTipo'] . "','" . $row['infoIndenta'] .
                    "','" . $row['infoNuevaPagina'] . "','" . $row['infoCodigo'] . "','" . $row['infoNotas'] . "')";
            return $query . '<>' . $valor01 . '<>' . $valor02;  //
        }
    }

    function calculaNeto($empresa, $periodo) {
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = "UPDATE contasaldoscontables SET saldconNeto =  saldcontFinalDb - saldconFinalCr  " .
                " WHERE saldcontEmpresaid = " . $empresa .
                " AND saldcontPeriodo='" . $periodo . "'  ";
        $result = mysqli_query($con, $query);
        return 'Ok';
    }

    function suma($empresa, $dato, $periodo) {
        $sum = 0.0;
        $dato = str_replace(" ", "", $dato);
        $n = strlen($dato);
        if ($n === 0) {
            return $sum;
        }
        $rmas = explode('+', $dato);
        for ($i = 0; $i < count($rmas); $i++) {
            if (!strpos($rmas[$i], '-')) {
                if (!strpos($rmas[$i], '..')) {
                    $sum += $this->traeValor($empresa, trim($rmas[0]), $periodo);
                } else {
                    $ptos = explode('..', $rmas[$i]);
                    $sum += $this->traeValorPtos($empresa, trim($ptos[0]), trim($ptos[1]), $periodo);
                }
            } else {
                if (!strpos($rmas[$i], '..')) {
                    $rmenos = explode('-', $rmas[$i]);
                    $sum += $this->traeValor($empresa, trim($rmenos[0]), $periodo);
                    $sum -= $this->traeValor($empresa, trim($rmenos[1]), $periodo);
                } else {
                    $ptos = explode('..', $rmas[$i]);
                    $sum += $this->traeValorPtos($empresa, trim($ptos[0]), trim($ptos[1]), $periodo);
                }
            }
        }
        return $sum;
    }

    function sumaR($dato, $cod, $vlr) {
        $sum = 0.0;
        $dato = str_replace(" ", "", $dato);
        $n = strlen($dato);

        if ($n === 0) {
            return $sum;
        }
        $rmas = explode('+', $dato);
        $sum = 0.0;
        for ($i = 0; $i < count($rmas); $i++) {

            if (!strpos($rmas[$i], '-')) {
                if (!strpos($rmas[$i], '..')) {
                    $indice = array_search(trim($rmas[$i]), $cod, true);
                    $sum += $vlr[$indice];
                } else {
                    $ptos = explode('..', $rmas[$i]);

                    $indice1 = array_search(trim($ptos[0]), $cod, true);
                    $indice2 = array_search(trim($ptos[1]), $cod, true);
                    for ($k = $indice1; $k <= $indice2; $k++) {
                        $sum += $vlr[$k];
                    }
                    //$obj->traeValorPtos($empresa, trim($ptos[0]),trim($ptos[1]), $periodo);
                }
            } else {
                if (!strpos($rmas[$i], '..')) {
                    $rmenos = explode('-', $rmas[$i]);
                    $indice = array_search(trim($rmenos[0]), $cod, true);
                    $sum += $vlr[$indice];
                    $indice = array_search(trim($rmenos[1]), $cod, true);
                    $sum -= $vlr[$indice];
                } else {
                    $ptos = explode('..', $rmas[$i]);
                    $indice1 = array_search(trim($ptos[0]), $cod, true);
                    $indice2 = array_search(trim($ptos[1]), $cod, true);
                    for ($k = $indice1; $k <= $indice2; $k++) {
                        $sum += $vlr[$k];
                        ;
                    }
                }
            }
        }
        //      echo $sum;
        return $sum;
    }

    function traeValor($empresa, $cta, $periodo) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $valor = 0.0;
        $query = "SELECT saldconNeto as saldo " .
                " FROM contasaldoscontables WHERE saldcontCuentaContable = '" .
                $cta . "' AND saldcontEmpresaid = " . $empresa . " AND saldcontTipo ='cont' " .
                " AND saldcontPeriodo = '" . $periodo . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) != '0') {
            while ($row = mysqli_fetch_assoc($result)) {
                $valor = $row['saldo'];
            }
        }
// echo $query;
// return $query;
//    echo $valor;
        return $valor;
    }

    function traeValorPtos($empresa, $ctaIni, $ctaFin, $periodo) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $valor = 0.0;
        $query = " SELECT SUM(saldconNeto) AS saldo FROM contasaldoscontables  " .
                " WHERE saldcontEmpresaid = " . $empresa . " AND saldcontTipo ='cont' " .
                " AND saldcontPeriodo = '" . $periodo . "' AND " .
                " saldcontCuentaContable IN ( SELECT pucCuenta FROM contaplancontable WHERE " .
                " pucEmpresaId = " . $empresa . "  AND pucCuenta BETWEEN " .
                " '" . $ctaIni . "' AND '" . $ctaFin . "' AND pucNivel = " .
                " (SELECT pucNivel FROM contaplancontable " .
                " WHERE pucEmpresaId =  " . $empresa . "  AND pucCuenta = '" . $ctaIni . "'))";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $valor = $row['saldo'];
            }
        }
        return $valor;
    }

    public function traeInforme($empresa, $informe, $PeriodoDer, $PeriodoIzq) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $query = " SELECT tmpbalusuario, tmpbalcodigo, tmpbalnombre,  tmpbalvalor01,  tmpbalvalor02, " .
                " ROUND(((tmpbalvalor02 - tmpbalvalor01) / tmpbalvalor01),8) * 100 tmpbalvalor03, " .
                " tmptipo, tmpbalIndenta, tmpbalNuevaPagina, tmpbalnotas " .
                " FROM contatmpbalance WHERE tmpbalempresa = " . $empresa . "  AND tmpbalreporte = '" .
                $informe . "' ORDER BY  tmpbalusuario ";
        $result = mysqli_query($con, $query);
        return $result;
    }

    public function traeContador($empresa) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $sql = "SELECT  empresaRepresentante, empresaIdentifRepresentante, empresaContador, " .
                " empresaMatriculaContador, empresaIdentifContador, empresaRevisor, empresaMatriculaRevisor, " .
                " empresaIdentifRevisor " .
                " FROM contaempresas  " .
                " WHERE empresaId = " . $empresa;
        $result = mysqli_query($con, $sql);
        return $result;
    }

    public function traeNotas($empresa, $informe, $condi) {
        include_once("../bin/cls/clsConection.php");
        $objClase = new DBconexion();
        $con = $objClase->conectar();
        $sql = "SELECT notacodigo, notadetalle FROM contanotascont WHERE notaempresa = " . $empresa .
                " AND notareporte = '" . $informe . "' AND notacodigo  IN (" . $condi .
                ") ORDER BY notacodigo";
        $result = mysqli_query($con, $sql);
        return $result;
    }

}
