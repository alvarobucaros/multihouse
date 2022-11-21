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
}

function leeRegistros($data) {
    global $objClase;
    $con = $objClase->conectar();
    $empresa = $data->empresa;
    {
        $query = "SELECT  empresaId, empresaClave, empresaNombre, empresaNit, empresaDigito, empresaDireccion, " .
                " empresaCiudad, empresaTelefonos, empresaFchCreacion, empresaFchModificacion, empresaFchVigencia,  " .
                " empresaPeriodoActual, empresaTwiter, empresaFacebook, empresaWeb, empresaEmail, empresaActiva,  " .
                " empresaPuertoCorreo, empresaRepresentante, empresaIdentifRepresentante, empresaContador,  " .
                " empresaMatriculaContador, empresaIdentifContador, empresaRevisor, empresaMatriculaRevisor,  " .
                " empresaIdentifRevisor, empresaAnoFiscal, empresaEstructura, empresaAdministrador,  " .
                " empresaAdministradorCed, empresaSecretaria, empresaSecretariaCedula, empresaMensaje1,  " .
                " empresaMensaje2, empresaPeriodoFactura, empresaPeriCierreFactura, empresaCompFra,  " .
                " empresaCompRcaja, empresaCompAjustes, empresaCompEgreso, empresaCompCierreMes,  " .
                " empresaCompApertura, empresaCuentaCierre, empresaCuentaCaja, empresaRecargoPorc,  " .
                " empresaRecargoPesos, empresaRecargoDias, empresaDescPorc, empresaDescPesos, empresaDescDias,  " .
                " empresaPagosParciales, empresaPeriodosAnuales, empresaFactorRedondeo, empresaConsecRcaja,  " .
                " empresaConsecFactura, empresaIdioma, empresaNroInmuebles, empresaLogo, empresaccosto,  " .
                " empresaservicios, empresafacturaNota, empresafacturaresDIAN, empresafacturaNumeracion,  " .
                " empresafacturanotaiva, empresafacturanotaica, empresafacturactacxc, empresafacturactaivta,  " .
                " empresafacturactaica, empresafacturactaiva, empresaRegimen, empresaporcentajeiva, empresatercero," .
                " empresaProformaCon, empresaProformaFac,  empresaProformaLimSup, empresaProformaLimInf, " .
                " empresaActividad, empresaConsecFact, empresaObservaciones, empresaConsecNDb, empresaConsecNCr   " .
                " FROM contaempresas WHERE empresaId = " . $empresa .
                " ORDER BY empresaNombre ";
        $result = mysqli_query($con, $query);
        $arr = array();
        if (mysqli_num_rows($result) != 0) {
            while ($rec = mysqli_fetch_assoc($result)) {
                $ret = $rec['empresaId'] . '||' . $rec['empresaClave'] . '||' . $rec['empresaNombre'] . '||' . $rec['empresaNit'] . '||' . $rec['empresaDigito'] . '||' .
                        $rec['empresaDireccion'] . '||' . $rec['empresaCiudad'] . '||' . $rec['empresaTelefonos'] . '||' . $rec['empresaFchCreacion'] . '||' . $rec['empresaFchModificacion'] . '||' .
                        $rec['empresaFchVigencia'] . '||' . $rec['empresaPeriodoActual'] . '||' . $rec['empresaTwiter'] . '||' . $rec['empresaFacebook'] . '||' . $rec['empresaWeb'] . '||' .
                        $rec['empresaEmail'] . '||' . $rec['empresaActiva'] . '||' . $rec['empresaPuertoCorreo'] . '||' . $rec['empresaRepresentante'] . '||' . $rec['empresaIdentifRepresentante'] . '||' .
                        $rec['empresaContador'] . '||' . $rec['empresaMatriculaContador'] . '||' . $rec['empresaIdentifContador'] . '||' . $rec['empresaRevisor'] . '||' .
                        $rec['empresaMatriculaRevisor'] . '||' . $rec['empresaIdentifRevisor'] . '||' . $rec['empresaAnoFiscal'] . '||' . $rec['empresaEstructura'] . '||' .
                        $rec['empresaAdministrador'] . '||' . $rec['empresaAdministradorCed'] . '||' . $rec['empresaSecretaria'] . '||' . $rec['empresaSecretariaCedula'] . '||' .
                        $rec['empresaMensaje1'] . '||' . $rec['empresaMensaje2'] . '||' . $rec['empresaPeriodoFactura'] . '||' . $rec['empresaPeriCierreFactura'] . '||' .
                        $rec['empresaCompFra'] . '||' . $rec['empresaCompRcaja'] . '||' . $rec['empresaCompAjustes'] . '||' . $rec['empresaCompEgreso'] . '||' . $rec['empresaCompCierreMes'] . '||' .
                        $rec['empresaCompApertura'] . '||' . $rec['empresaCuentaCierre'] . '||' . $rec['empresaCuentaCaja'] . '||' . $rec['empresaRecargoPorc'] . '||' .
                        $rec['empresaRecargoPesos'] . '||' . $rec['empresaRecargoDias'] . '||' . $rec['empresaDescPorc'] . '||' . $rec['empresaDescPesos'] . '||' . $rec['empresaDescDias'] . '||' .
                        $rec['empresaPagosParciales'] . '||' . $rec['empresaPeriodosAnuales'] . '||' . $rec['empresaFactorRedondeo'] . '||' . $rec['empresaConsecRcaja'] . '||' .
                        $rec['empresaConsecFactura'] . '||' . $rec['empresaIdioma'] . '||' . $rec['empresaNroInmuebles'] . '||' . $rec['empresaLogo'] . '||' . $rec['empresaccosto'] . '||' .
                        $rec['empresaservicios'] . '||' . $rec['empresafacturaNota'] . '||' . $rec['empresafacturaresDIAN'] . '||' . $rec['empresafacturaNumeracion'] . '||' .
                        $rec['empresafacturanotaiva'] . '||' . $rec['empresafacturanotaica'] . '||' . $rec['empresafacturactacxc'] . '||' . $rec['empresafacturactaivta'] . '||' .
                        $rec['empresafacturactaica'] . '||' . $rec['empresafacturactaiva'] . '||' . $rec['empresaRegimen'] . '||' .
                        $rec['empresaporcentajeiva'] . '||' . $rec['empresatercero'] . '||' . $rec['empresaProformaCon'] . '||' . $rec['empresaProformaFac'] . '||' .
                        $rec['empresaProformaLimSup'] . '||' . $rec['empresaProformaLimInf'] .'||'.
                        $rec['empresaActividad'].'||'.$rec['empresaConsecFact'].'||'.
                        $rec['empresaObservaciones'] .'||'.
                        $rec['empresaConsecNDb'].'||'.$rec['empresaConsecNCr'].'||';
            }
        }
        echo $ret;
    }
}

function borra($data) {
    global $objClase;
    $con = $objClase->conectar();
    $query = "DELETE FROM contaempresas WHERE empresaId=$data->empresaId";
    mysqli_query($con, $query);
    echo 'Ok';
}

function actualiza($data) {
    global $objClase;
    $con = $objClase->conectar();
    $op = $data->op;
    $empresaId = $data->empresaId;
    $empresaClave = $data->empresaClave;
    $empresaNombre = $data->empresaNombre;
    $empresaNit = $data->empresaNit;
    $empresaDigito = $data->empresaDigito;
    $empresaDireccion = $data->empresaDireccion;
    $empresaCiudad = $data->empresaCiudad;
    $empresaTelefonos = $data->empresaTelefonos;
    $empresaFchCreacion = $data->empresaFchCreacion;
    $empresaFchModificacion = $data->empresaFchModificacion;
    $empresaFchVigencia = $data->empresaFchVigencia;
    $empresaPeriodoActual = $data->empresaPeriodoActual;
    $empresaTwiter = $data->empresaTwiter;
    $empresaFacebook = $data->empresaFacebook;
    $empresaWeb = $data->empresaWeb;
    $empresaEmail = $data->empresaEmail;
    $empresaActiva = $data->empresaActiva;
    $empresaPuertoCorreo = $data->empresaPuertoCorreo;
    $empresaRepresentante = $data->empresaRepresentante;
    $empresaIdentifRepresentante = $data->empresaIdentifRepresentante;
    $empresaContador = $data->empresaContador;
    $empresaMatriculaContador = $data->empresaMatriculaContador;
    $empresaIdentifContador = $data->empresaIdentifContador;
    $empresaRevisor = $data->empresaRevisor;
    $empresaMatriculaRevisor = $data->empresaMatriculaRevisor;
    $empresaIdentifRevisor = $data->empresaIdentifRevisor;
    $empresaAnoFiscal = $data->empresaAnoFiscal;
    $empresaEstructura = $data->empresaEstructura;
    $empresaAdministrador = $data->empresaAdministrador;
    $empresaAdministradorCed = $data->empresaAdministradorCed;
    $empresaSecretaria = $data->empresaSecretaria;
    $empresaSecretariaCedula = $data->empresaSecretariaCedula;
    $empresaMensaje1 = $data->empresaMensaje1;
    $empresaMensaje2 = $data->empresaMensaje2;
    $empresaPeriodoFactura = $data->empresaPeriodoFactura;
    $empresaPeriCierreFactura = $data->empresaPeriCierreFactura;
    $empresaCompFra = $data->empresaCompFra;
    $empresaCompRcaja = $data->empresaCompRcaja;
    $empresaCompAjustes = $data->empresaCompAjustes;
    $empresaCompEgreso = $data->empresaCompEgreso;
    $empresaCompCierreMes = $data->empresaCompCierreMes;
    $empresaCompApertura = $data->empresaCompApertura;
    $empresaCuentaCierre = $data->empresaCuentaCierre;
    $empresaCuentaCaja = $data->empresaCuentaCaja;
    $empresaRecargoPorc = $data->empresaRecargoPorc;
    $empresaRecargoPesos = $data->empresaRecargoPesos;
    $empresaRecargoDias = $data->empresaRecargoDias;
    $empresaDescPorc = $data->empresaDescPorc;
    $empresaDescPesos = $data->empresaDescPesos;
    $empresaDescDias = $data->empresaDescDias;
    $empresaPagosParciales = $data->empresaPagosParciales;
    $empresaPeriodosAnuales = $data->empresaPeriodosAnuales;
    $empresaFactorRedondeo = $data->empresaFactorRedondeo;
    $empresaConsecRcaja = $data->empresaConsecRcaja;
    $empresaConsecFactura = $data->empresaConsecFactura;
    $empresaIdioma = $data->empresaIdioma;
    $empresaNroInmuebles = $data->empresaNroInmuebles;
    $empresaLogo = $data->empresaLogo;
    $empresaccosto = $data->empresaccosto;
    $empresaservicios = $data->empresaservicios;
    $empresafacturaNota = $data->empresafacturaNota;
    $empresafacturaresDIAN = $data->empresafacturaresDIAN;
    $empresafacturaNumeracion = $data->empresafacturaNumeracion;
    $empresafacturanotaiva = $data->empresafacturanotaiva;
    $empresafacturanotaica = $data->empresafacturanotaica;
    $empresafacturactacxc = $data->empresafacturactacxc;
    $empresafacturactaivta = $data->empresafacturactaivta;
    $empresafacturactaica = $data->empresafacturactaica;
    $empresafacturactaiva = $data->empresafacturactaiva;
    $empresaRegimen = $data->empresaRegimen;
    $empresaporcentajeiva = $data->empresaporcentajeiva;
    $empresatercero = $data->empresatercero;
    $empresaProformaCon = $data->empresaProformaCon;
    $empresaProformaFac = $data->empresaProformaFac;
    $empresaProformaLimSup = $data->empresaProformaLimSup;
    $empresaProformaLimInf = $data->empresaProformaLimInf;
    $empresaActividad = $data->empresaActividad;
    $empresaConsecFact = $data->empresaConsecFact;
    $empresaObservaciones = $data->empresaObservaciones;
    $empresaConsecNDb = $data->empresaConsecNDb;
    $empresaConsecNCr = $data->empresaConsecNCr;
    if ($empresaId == 0) {
        $query = "INSERT INTO contaempresas(empresaClave, empresaNombre, empresaNit, empresaDigito, empresaDireccion,"
                . " empresaCiudad, empresaTelefonos, empresaFchCreacion, empresaFchModificacion, empresaFchVigencia, "
                . " empresaPeriodoActual, empresaTwiter, empresaFacebook, empresaWeb, empresaEmail, empresaActiva, "
                . " empresaPuertoCorreo, empresaRepresentante, empresaIdentifRepresentante, empresaContador, "
                . " empresaMatriculaContador, empresaIdentifContador, empresaRevisor, empresaMatriculaRevisor, "
                . " empresaIdentifRevisor, empresaAnoFiscal, empresaEstructura, empresaAdministrador, "
                . " empresaAdministradorCed, empresaSecretaria, empresaSecretariaCedula, empresaMensaje1, "
                . " empresaMensaje2, empresaPeriodoFactura, empresaPeriCierreFactura, empresaCompFra, empresaCompRcaja, "
                . " empresaCompAjustes, empresaCompEgreso, empresaCompCierreMes, empresaCompApertura, "
                . " empresaCuentaCierre, empresaCuentaCaja, empresaRecargoPorc, empresaRecargoPesos, "
                . " empresaRecargoDias, empresaDescPorc, empresaDescPesos, empresaDescDias, empresaPagosParciales, "
                . " empresaPeriodosAnuales, empresaFactorRedondeo, empresaConsecRcaja, empresaConsecFactura, "
                . " empresaIdioma, empresaNroInmuebles, empresaLogo, empresaccosto, empresaservicios, "
                . " empresafacturaNota, empresafacturaresDIAN, empresafacturaNumeracion, empresafacturanotaiva, "
                . " empresafacturanotaica, empresafacturactacxc, empresafacturactaivta, empresafacturactaica, "
                . " empresafacturactaiva, empresaRegimen, empresaporcentajeiva, empresaProformaCon, "
                . " empresaProformaFac, empresatercero, empresaActividad, empresaConsecFact,empresaObservaciones,"
                . "empresaConsecNDb,empresaConsecNCr)";
        $query .= "  VALUES ('" . $empresaClave . "', '" . $empresaNombre . "', '" . $empresaNit . "', '" . $empresaDigito . "', '" .
                $empresaDireccion . "', '" . $empresaCiudad . "', '" . $empresaTelefonos . "', '" . $empresaFchCreacion . "', '" .
                $empresaFchModificacion . "', '" . $empresaFchVigencia . "', '" . $empresaPeriodoActual . "', '" .
                $empresaTwiter . "', '" . $empresaFacebook . "', '" . $empresaWeb . "', '" . $empresaEmail . "', '" .
                $empresaActiva . "', '" . $empresaPuertoCorreo . "', '" . $empresaRepresentante . "', '" .
                $empresaIdentifRepresentante . "', '" . $empresaContador . "', '" . $empresaMatriculaContador . "', '" .
                $empresaIdentifContador . "', '" . $empresaRevisor . "', '" . $empresaMatriculaRevisor . "', '" .
                $empresaIdentifRevisor . "', '" . $empresaAnoFiscal . "', '" . $empresaEstructura . "', '" .
                $empresaAdministrador . "', '" . $empresaAdministradorCed . "', '" . $empresaSecretaria . "', '" .
                $empresaSecretariaCedula . "', '" . $empresaMensaje1 . "', '" . $empresaMensaje2 . "', '" .
                $empresaPeriodoFactura . "', '" . $empresaPeriCierreFactura . "', '" . $empresaCompFra . "', '" .
                $empresaCompRcaja . "', '" . $empresaCompAjustes . "', '" . $empresaCompEgreso . "', '" .
                $empresaCompCierreMes . "', '" . $empresaCompApertura . "', '" . $empresaCuentaCierre . "', '" .
                $empresaCuentaCaja . "', '" . $empresaRecargoPorc . "', '" . $empresaRecargoPesos . "', '" .
                $empresaRecargoDias . "', '" . $empresaDescPorc . "', '" . $empresaDescPesos . "', '" . $empresaDescDias . "', '" .
                $empresaPagosParciales . "', '" . $empresaPeriodosAnuales . "', '" . $empresaFactorRedondeo . "', '" .
                $empresaConsecRcaja . "', '" . $empresaConsecFactura . "', '" . $empresaIdioma . "', '" .
                $empresaNroInmuebles . "', '" . $empresaLogo . "', '" . $empresaccosto . "', '" . $empresaservicios . "', '" .
                $empresafacturaNota . "', '" . $empresafacturaresDIAN . "', '" . $empresafacturaNumeracion . "', '" .
                $empresafacturanotaiva . "', '" . $empresafacturanotaica . "', '" . $empresafacturactacxc . "', '" .
                $empresafacturactaivta . "', '" . $empresafacturactaica . "', '" . $empresafacturactaiva . "', '" .
                $empresaRegimen . "', '" . $empresaporcentajeiva . "', '" . $empresaProformaCon . "', '" .
                $empresaProformaFac . "', '" . $empresatercero . "','".$empresaActividad . "','" .  
                $empresaConsecFact . "','" .$empresaObservaciones ."','".$empresaConsecNDb."','".
                $empresaConsecNCr.".')"; 
    //echo $query;
        mysqli_query($con, $query);
        echo 'Ok'.$query;
    } else {
        $query = "UPDATE contaempresas  SET empresaClave = '" . $empresaClave . "', empresaNombre = '" . $empresaNombre . "', "
                . "empresaNit = '" . $empresaNit . "', empresaDigito = '" . $empresaDigito . "', "
                . "empresaDireccion = '" . $empresaDireccion . "', empresaCiudad = '" . $empresaCiudad . "', "
                . "empresaTelefonos = '" . $empresaTelefonos . "', empresaFchCreacion = '" . $empresaFchCreacion . "', "
                . "empresaFchModificacion = '" . $empresaFchModificacion . "', "
                . "empresaFchVigencia = '" . $empresaFchVigencia . "', empresaPeriodoActual = '" . $empresaPeriodoActual . "', "
                . "empresaTwiter = '" . $empresaTwiter . "', empresaFacebook = '" . $empresaFacebook . "',"
                . "empresaWeb = '" . $empresaWeb . "', empresaEmail = '" . $empresaEmail . "', "
                . "empresaActiva = '" . $empresaActiva . "', empresaPuertoCorreo = '" . $empresaPuertoCorreo . "', "
                . "empresaRepresentante = '" . $empresaRepresentante . "', "
                . "empresaIdentifRepresentante = '" . $empresaIdentifRepresentante . "', "
                . "empresaContador = '" . $empresaContador . "', "
                . "empresaMatriculaContador = '" . $empresaMatriculaContador . "', "
                . "empresaIdentifContador = '" . $empresaIdentifContador . "', empresaRevisor = '" . $empresaRevisor . "', "
                . "empresaMatriculaRevisor = '" . $empresaMatriculaRevisor . "', "
                . "empresaIdentifRevisor = '" . $empresaIdentifRevisor . "', empresaAnoFiscal = '" . $empresaAnoFiscal . "', "
                . "empresaEstructura = '" . $empresaEstructura . "', empresaAdministrador = '" . $empresaAdministrador . "', "
                . "empresaAdministradorCed = '" . $empresaAdministradorCed . "', "
                . "empresaSecretaria = '" . $empresaSecretaria . "', "
                . "empresaSecretariaCedula = '" . $empresaSecretariaCedula . "', "
                . "empresaMensaje1 = '" . $empresaMensaje1 . "', empresaMensaje2 = '" . $empresaMensaje2 . "', "
                . "empresaPeriodoFactura = '" . $empresaPeriodoFactura . "', "
                . "empresaPeriCierreFactura = '" . $empresaPeriCierreFactura . "', "
                . "empresaCompFra = '" . $empresaCompFra . "', empresaCompRcaja = '" . $empresaCompRcaja . "', "
                . "empresaCompAjustes = '" . $empresaCompAjustes . "', empresaCompEgreso = '" . $empresaCompEgreso . "', "
                . "empresaCompCierreMes = '" . $empresaCompCierreMes . "', "
                . "empresaCompApertura = '" . $empresaCompApertura . "', "
                . "empresaCuentaCierre = '" . $empresaCuentaCierre . "', empresaCuentaCaja = '" . $empresaCuentaCaja . "', "
                . "empresaRecargoPorc = '" . $empresaRecargoPorc . "', empresaRecargoPesos = '" . $empresaRecargoPesos . "', "
                . "empresaRecargoDias = '" . $empresaRecargoDias . "', empresaDescPorc = '" . $empresaDescPorc . "', "
                . "empresaDescPesos = '" . $empresaDescPesos . "', empresaDescDias = '" . $empresaDescDias . "', "
                . "empresaPagosParciales = '" . $empresaPagosParciales . "', "
                . "empresaPeriodosAnuales = '" . $empresaPeriodosAnuales . "', "
                . "empresaFactorRedondeo = '" . $empresaFactorRedondeo . "', "
                . "empresaConsecRcaja = '" . $empresaConsecRcaja . "', "
                . "empresaConsecFactura = '" . $empresaConsecFactura . "', empresaIdioma = '" . $empresaIdioma . "', "
                . "empresaNroInmuebles = '" . $empresaNroInmuebles . "', empresaLogo = '" . $empresaLogo . "', "
                . "empresaccosto = '" . $empresaccosto . "', empresaservicios = '" . $empresaservicios . "', "
                . "empresafacturaNota = '" . $empresafacturaNota . "', "
                . "empresafacturaresDIAN = '" . $empresafacturaresDIAN . "', "
                . "empresafacturaNumeracion = '" . $empresafacturaNumeracion . "', "
                . "empresafacturanotaiva = '" . $empresafacturanotaiva . "', "
                . "empresafacturanotaica = '" . $empresafacturanotaica . "', "
                . "empresafacturactacxc = '" . $empresafacturactacxc . "', "
                . "empresafacturactaivta = '" . $empresafacturactaivta . "', "
                . "empresafacturactaica = '" . $empresafacturactaica . "', "
                . "empresatercero = '" . $empresatercero . "', "
                . "empresafacturactaiva = '" . $empresafacturactaiva . "', empresaRegimen = '" . $empresaRegimen . "', "
                . "empresaporcentajeiva = '" . $empresaporcentajeiva ."',"
                . "empresaActividad= '" . $empresaActividad . "', empresaConsecFact = '" . $empresaConsecFact . "', "
                . "empresaObservaciones= '" . $empresaObservaciones . "', " 
                . "empresaConsecNDb= '" . $empresaConsecNDb . "', " 
                . "empresaConsecNCr= '" . $empresaConsecNCr . "' " 
                . " WHERE empresaId = " . $empresaId;
//echo $query;
      mysqli_query($con, $query);
      echo 'Ok';
    }
}

function maxRegistroId($data) {
    global $objClase;
    $con = $objClase->conectar();
    $id = 0;
    $query = "SELECT  MAX(empresaId) as id 
                    FROM contaempresas";
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
    $empresaId = $data->empresaId;
    $query = "SELECT  empresaId, empresaClave, empresaNombre, empresaNit, empresaDigito, empresaDireccion, "
            . "empresaCiudad, empresaTelefonos, empresaFchCreacion, empresaFchModificacion, empresaFchVigencia, "
            . "empresaPeriodoActual, empresaTwiter, empresaFacebook, empresaWeb, empresaEmail, empresaActiva, "
            . "empresaPuertoCorreo, empresaRepresentante, empresaIdentifRepresentante, empresaContador, "
            . "empresaMatriculaContador, empresaIdentifContador, empresaRevisor, empresaMatriculaRevisor, "
            . "empresaIdentifRevisor, empresaAnoFiscal, empresaEstructura, empresaAdministrador, "
            . "empresaAdministradorCed, empresaSecretaria, empresaSecretariaCedula, empresaMensaje1, "
            . "empresaMensaje2, empresaPeriodoFactura, empresaPeriCierreFactura, empresaCompFra, empresaCompRcaja, "
            . "empresaCompAjustes, empresaCompEgreso, empresaCompCierreMes, empresaCompApertura, "
            . "empresaCuentaCierre, empresaCuentaCaja, empresaRecargoPorc, empresaRecargoPesos, "
            . "empresaRecargoDias, empresaDescPorc, empresaDescPesos, empresaDescDias, empresaPagosParciales, "
            . "empresaPeriodosAnuales, empresaFactorRedondeo, empresaConsecRcaja, empresaConsecFactura, "
            . "empresaIdioma, empresaNroInmuebles, empresaLogo, empresaccosto, empresaservicios, "
            . "empresafacturaNota, empresafacturaresDIAN, empresafacturaNumeracion, empresafacturanotaiva, "
            . "empresafacturanotaica, empresafacturactacxc, empresafacturactaivta, empresafacturactaica, "
            . "empresafacturactaiva, empresaRegimen, empresaporcentajeiva, empresaProformaCon, "
            . " empresaProformaFac, empresatercero, empresaActividad, empresaConsecFact, empresaObservaciones  " .
            " FROM contaempresas  WHERE empresaId = " . $empresaId .
            " ORDER BY empresaNombre ";
    $result = mysqli_query($con, $query);
    $arr = array();
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    }
    echo $json_info = json_encode($arr);
}

// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 7:25:07   <<<<<<< 
