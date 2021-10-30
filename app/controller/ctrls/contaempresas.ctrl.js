var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_titleGen = 'Parámetros Generales';
    $scope.form_titleFac = 'Parámetros Facturación';
    $scope.form_titleCont = 'Parámetros Contabilidad';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
    $scope.form_empresatercero = 'TERCERO CONTABLE';
    $scope.form_empresaActiva160 = 'Inactiva';
    $scope.form_empresaActiva161 = 'Activa';
    $scope.form_empresaPagosParciales500 = 'NO';
    $scope.form_empresaPagosParciales501 = 'SI';
    $scope.redondeo = {model: null,
    availableOptions: [
            {tipo:'L', detalle:'Cincuenta pesos'},
            {tipo:'C', detalle:'Cien pesos'},
            {tipo:'Q', detalle:'Quinientos pesos'},
            {tipo:'M', detalle:'Mil pesos'}]}
    $scope.form_empresaFactorRedondeo520 = 0;
    $scope.form_empresaFactorRedondeo521 = 1;
    $scope.Redondeo = 'PRIORIDAD';
    $scope.form_empresaIdioma550 = 'Español';
    $scope.form_empresaIdioma551 = 'Inglés';
    $scope.form_empresaIdioma552 = 'Otro';
    $scope.form_empresaccosto580 = 'SI';
    $scope.form_empresaccosto581 = 'NO';
    $scope.form_empresaservicios590 = 'SI';
    $scope.form_empresaservicios591 = 'NO';
    $scope.form_empresaRegimen690 = 'Común';
    $scope.form_empresaRegimen691 = 'Simplificado';

    $scope.form_empresaId = 'ID';
    $scope.form_empresaClave = 'CLAVE';
    $scope.form_empresaNombre = 'NOMBRE';
    $scope.form_empresaNit = 'NIT';
    $scope.form_empresaDigito = 'DIGITO CONTROL';
    $scope.form_empresaDireccion = 'DIRECCION';
    $scope.form_empresaCiudad = 'CIUDAD';
    $scope.form_empresaTelefonos = 'TELEFONOS';
    $scope.form_empresaFchCreacion = 'FCH CREACION';
    $scope.form_empresaFchModificacion = 'FCH MODIFICA';
    $scope.form_empresaFchVigencia = 'FCH VIGENCIA';
    $scope.form_empresaPeriodoActual = 'PERIODO CONTABLE';
    $scope.form_empresaTwiter = 'CUENTA TWITER';
    $scope.form_empresaFacebook = 'CUENTA FACEBOOK';
    $scope.form_empresaWeb = 'PAGINA WEB';
    $scope.form_empresaEmail = 'CUENTA CORREO';
    $scope.form_empresaActiva = 'ACTIVA';
    $scope.form_empresaPuertoCorreo = 'PRTO_EMAIL';
    $scope.form_empresaRepresentante = 'REPRESENTANTE LEGAL';
    $scope.form_empresaIdentifRepresentante = 'CEDULA REPRESENTANTE';
    $scope.form_empresaContador = 'CONTADOR';
    $scope.form_empresaMatriculaContador = 'MATRICULA CONTADOR';
    $scope.form_empresaIdentifContador = 'CEDULA CONTADOR';
    $scope.form_empresaRevisor = 'REVISOR FISCAL';
    $scope.form_empresaMatriculaRevisor = 'MATRICULA REVISOR';
    $scope.form_empresaIdentifRevisor = 'CEDULA REVISOR';
    $scope.form_empresaAdministrador = 'ADMINISTRADOR';
    $scope.form_empresaAdministradorCed = 'CEDULA ADMON';
    $scope.form_empresaSecretaria = 'SECRETARIA';
    $scope.form_empresaSecretariaCedula = 'CEDULA SECRETARIA';
    $scope.form_empresaMensaje1 = 'MENSAJE FACTURA 1';
    $scope.form_empresaMensaje2 = 'MENSAJE FACTURA 2';
    $scope.form_empresaPeriodoFactura = 'PERIODO FACTURA';
    $scope.form_empresaPeriCierreFactura = 'PERIODO CERRADO';
    $scope.form_empresaCompFra = 'COMPROBANTE FACTURA';
    $scope.form_empresaCompRcaja = 'COMPROBANTE RCAJA';
    $scope.form_empresaCompAjustes = 'COMPR AJUSTES';
    $scope.form_empresaCompEgreso = 'COM. EGRESO';
    $scope.form_empresaAnoFiscal = 'ANO FISCAL';
    $scope.form_empresaEstructura = 'ESTRUCTURA';
    $scope.form_empresaCompCierreMes = 'COMP. CIERRE MES';
    $scope.form_empresaCompApertura = 'COMP. APERTURA';
    $scope.form_empresaCuentaCierre = 'CUENTA CIERRE';
    $scope.form_empresaCuentaCaja = 'CUENTA CAJA';
    $scope.form_empresaRecargoPorc = 'MORA PORC';
    $scope.form_empresaRecargoPesos = 'MORA EN PESOS';
    $scope.form_empresaRecargoDias = 'MORA DIAS';
    $scope.form_empresaDescPorc = 'DESCNTO PORC';
    $scope.form_empresaDescPesos = 'DESCNTO PESOS';
    $scope.form_empresaDescDias = 'DESCNTO DIAS';
    $scope.form_empresaPagosParciales = 'PAGOS PARCIALES';
    $scope.form_empresaPeriodosAnuales = 'PERIODOS ANUALES';
    $scope.form_empresaFactorRedondeo = 'FACTOR REDONDEO';
    $scope.form_empresaConsecRcaja = 'CONSEC R/CAJA';
    $scope.form_empresaConsecFactura = 'CONSEC CTA COBRO';
    $scope.form_empresaConsecNCr = 'CONSEC NOTA  CR';
    $scope.form_empresaConsecNDb = 'CONSEC NOTA DB';
    $scope.form_empresaConsecFact = 'CONSEC SERVICIO';
    $scope.form_empresaIdioma = 'IDIOMA';
    $scope.form_empresaNroInmuebles = 'NRO INMUEBLES';
    $scope.form_empresaLogo = 'LOGO';
    $scope.form_empresaccosto = 'CTRO. COSTO';
    $scope.form_empresaservicios = 'CNTROS SERVICIOS';
    $scope.form_empresafacturaNota = 'FACTURA NOTA';
    $scope.form_empresafacturaresDIAN = 'FACTURA RES DIAN';
    $scope.form_empresafacturaNumeracion = 'NUMERACION FAC DIAN';
    $scope.form_empresafacturanotaiva = 'FACTURA NOTA IVA';
    $scope.form_empresafacturanotaica = 'FACTURA NOTA ICA';
    $scope.form_empresafacturactacxc = 'CUENTA CXC';
    $scope.form_empresafacturactaivta = 'CUENTA VENTAS';
    $scope.form_empresafacturactaica = 'CUENTA ICA';
    $scope.form_empresafacturactaiva = 'CUENTA IVA';
    $scope.form_empresaRegimen = 'REGIMEN';
    $scope.form_empresaporcentajeiva = 'PORCENTAJE IVA';
    $scope.form_empresaporcentajeiva = 'PORCENTAJE IVA';
    $scope.form_empresaProformaCon = 'PROFORMA CONTABLE';
    $scope.form_empresaProformaFac = 'PROFORMA FACTURA';
    $scope.form_empresaProformaCon0 = 'NO';
    $scope.form_empresaProformaCon1 = 'SI';
    $scope.form_empresaProformaFac0 = 'NO';
    $scope.form_empresaProformaFac1 = 'SI';
    $scope.form_empresaActividad = 'ACTIVIDAD ECONOMICA';
    $scope.form_empresaObservaciones='OBSERVACIONES';
    $scope.empresaProformaLimite = "LIMITES PROFORMA";
    $scope.empresaProformaLimiteSup = "SUPERIOR";
    $scope.empresaProformaLimiteInf = "INFERIOR";
    $scope.form_PhempresaId = 'Digite id';
    $scope.form_PhempresaClave = 'Digite clave';
    $scope.form_PhempresaNombre = 'Digite nombre';
    $scope.form_PhempresaNit = 'Digite nit';
    $scope.form_PhempresaDigito = 'Digite digito';
    $scope.form_PhempresaDireccion = 'Digite direccion';
    $scope.form_PhempresaCiudad = 'Digite ciudad';
    $scope.form_PhempresaTelefonos = 'Digite telefonos';
    $scope.form_PhempresaFchCreacion = 'Digite fch creacion';
    $scope.form_PhempresaFchModificacion = 'Digite fch modifica';
    $scope.form_PhempresaFchVigencia = 'Digite fch vigencia';
    $scope.form_PhempresaPeriodoActual = 'Digite periodo';
    $scope.form_PhempresaTwiter = 'Digite cuenta twiter';
    $scope.form_PhempresaFacebook = 'Digite cuenta facebook';
    $scope.form_PhempresaWeb = 'Digite pagina web';
    $scope.form_PhempresaEmail = 'Digite cuenta correo';
    $scope.form_PhempresaActiva = 'Digite activa';
    $scope.form_PhempresaPuertoCorreo = 'Digite prto_email';
    $scope.form_PhempresaRepresentante = 'Digite repreentante legal';
    $scope.form_PhempresaIdentifRepresentante = 'Digite cedula repreentante';
    $scope.form_PhempresaContador = 'Digite contador';
    $scope.form_PhempresaMatriculaContador = 'Digite matricula contador';
    $scope.form_PhempresaIdentifContador = 'Digite cedula contador';
    $scope.form_PhempresaRevisor = 'Digite revisor fiscal';
    $scope.form_PhempresaMatriculaRevisor = 'Digite matricula revisor';
    $scope.form_PhempresaIdentifRevisor = 'Digite cedula revisor';
    $scope.form_PhempresaAnoFiscal = 'Digite ano fiscal';
    $scope.form_PhempresaEstructura = 'Digite estructura';
    $scope.form_PhempresaAdministrador = 'Digite administrador';
    $scope.form_PhempresaAdministradorCed = 'Digite cedula admon';
    $scope.form_PhempresaSecretaria = 'Digite secretaria';
    $scope.form_PhempresaSecretariaCedula = 'Digite cedula secretaria';
    $scope.form_PhempresaMensaje1 = 'Digite mensaje 1';
    $scope.form_PhempresaMensaje2 = 'Digite mensaje 2';
    $scope.form_PhempresaPeriodoFactura = 'Digite periodo factura';
    $scope.form_PhempresaPeriCierreFactura = 'Digite periodo cerrado';
    $scope.form_PhempresaCompFra = 'Digite compr factura';
    $scope.form_PhempresaCompRcaja = 'Digite compr rcaja';
    $scope.form_PhempresaCompAjustes = 'Digite compr ajustes';
    $scope.form_PhempresaCompEgreso = 'Digite compegreso';
    $scope.form_PhempresaCompCierreMes = 'Digite compcierremes';
    $scope.form_PhempresaCompApertura = 'Digite compapertura';
    $scope.form_PhempresaCuentaCierre = 'Digite cuentacierre';
    $scope.form_PhempresaCuentaCaja = 'Digite cuenta caja';
    $scope.form_PhempresaRecargoPorc = 'Digite mora porc';
    $scope.form_PhempresaRecargoPesos = 'Digite mora en pesos';
    $scope.form_PhempresaRecargoDias = 'Digite mora dias';
    $scope.form_PhempresaDescPorc = 'Digite descnto porc';
    $scope.form_PhempresaDescPesos = 'Digite descnto pesos';
    $scope.form_PhempresaDescDias = 'Digite descnto dias';
    $scope.form_PhempresaPagosParciales = 'Digite pagos parciales';
    $scope.form_PhempresaPeriodosAnuales = 'Digite periodos anuales';
    $scope.form_PhempresaFactorRedondeo = 'Digite redondeo';
    $scope.form_PhempresaConsecRcaja = 'Digite consec rcaja';
    $scope.form_PhempresaConsecFactura = 'Digite consec factura';
    $scope.form_PhempresaIdioma = 'Digite idioma';
    $scope.form_PhempresaNroInmuebles = 'Digite nroinmuebles';
    $scope.form_PhempresaLogo = 'Digite logo';
    $scope.form_Phempresaccosto = 'Digite ccosto';
    $scope.form_Phempresaservicios = 'Digite servicios';
    $scope.form_PhempresafacturaNota = 'Digite facturanota';
    $scope.form_PhempresafacturaresDIAN = 'Digite facturaresdian';
    $scope.form_PhempresafacturaNumeracion = 'Digite facturanumeracion';
    $scope.form_Phempresafacturanotaiva = 'Digite facturanotaiva';
    $scope.form_Phempresafacturanotaica = 'Digite facturanotaica';
    $scope.form_Phempresafacturactacxc = 'Digite facturactacxc';
    $scope.form_Phempresafacturactaivta = 'Digite facturactaivta';
    $scope.form_Phempresafacturactaica = 'Digite facturactaica';
    $scope.form_Phempresafacturactaiva = 'Digite facturactaiva';
    $scope.form_PhempresaRegimen = 'Digite regimen';
    $scope.form_Phempresaporcentajeiva = 'Digite porcentajeiva';
    $scope.id=0;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];

    $scope.empresa = $('#e').val();
    $scope.tipo = $('#tipo').val();
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_containformes.php?op=4',{'op':'4','empresa':empresa}).success(function(data){
        $scope.operators0 = data;
        }); 
        
        $http.post('modulos/mod_contaempresas.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        registro = data.split('||');
        $scope.registro.empresaId = registro[0]; 
        $scope.registro.empresaClave = registro[1]; 
        $scope.registro.empresaNombre = registro[2]; 
        $scope.registro.empresaNit = registro[3]; 
        $scope.registro.empresaDigito = registro[4]; 
        $scope.registro.empresaDireccion = registro[5]; 
        $scope.registro.empresaCiudad = registro[6]; 
        $scope.registro.empresaTelefonos = registro[7]; 
        $scope.registro.empresaFchCreacion = registro[8]; 
        $scope.registro.empresaFchModificacion = registro[9]; 
        $scope.registro.empresaFchVigencia = registro[10]; 
        $scope.registro.empresaPeriodoActual = registro[11]; 
        $scope.registro.empresaTwiter = registro[12]; 
        $scope.registro.empresaFacebook = registro[13]; 
        $scope.registro.empresaWeb = registro[14]; 
        $scope.registro.empresaEmail = registro[15]; 
        $scope.registro.empresaActiva = registro[16]; 
        $scope.registro.empresaPuertoCorreo = registro[17]; 
        $scope.registro.empresaRepresentante = registro[18]; 
        $scope.registro.empresaIdentifRepresentante = registro[19]; 
        $scope.registro.empresaContador = registro[20]; 
        $scope.registro.empresaMatriculaContador = registro[21]; 
        $scope.registro.empresaIdentifContador = registro[22]; 
        $scope.registro.empresaRevisor = registro[23]; 
        $scope.registro.empresaMatriculaRevisor = registro[24]; 
        $scope.registro.empresaIdentifRevisor = registro[25]; 
        $scope.registro.empresaAnoFiscal = registro[26]; 
        $scope.registro.empresaEstructura = registro[27]; 
        $scope.registro.empresaAdministrador = registro[28]; 
        $scope.registro.empresaAdministradorCed = registro[29]; 
        $scope.registro.empresaSecretaria = registro[30]; 
        $scope.registro.empresaSecretariaCedula = registro[31]; 
        $scope.registro.empresaMensaje1 = registro[32]; 
        $scope.registro.empresaMensaje2 = registro[33]; 
        $scope.registro.empresaPeriodoFactura = registro[34]; 
        $scope.registro.empresaPeriCierreFactura = registro[35]; 
        $scope.registro.empresaCompFra = registro[36]; 
        $scope.registro.empresaCompRcaja = registro[37]; 
        $scope.registro.empresaCompAjustes = registro[38]; 
        $scope.registro.empresaCompEgreso = registro[39]; 
        $scope.registro.empresaCompCierreMes = registro[40]; 
        $scope.registro.empresaCompApertura = registro[41]; 
        $scope.registro.empresaCuentaCierre = registro[42]; 
        $scope.registro.empresaCuentaCaja = registro[43]; 
        $scope.registro.empresaRecargoPorc = registro[44]; 
        $scope.registro.empresaRecargoPesos = registro[45]; 
        $scope.registro.empresaRecargoDias = registro[46]; 
        $scope.registro.empresaDescPorc = registro[47]; 
        $scope.registro.empresaDescPesos = registro[48]; 
        $scope.registro.empresaDescDias = registro[49]; 
        $scope.registro.empresaPagosParciales = registro[50]; 
        $scope.registro.empresaPeriodosAnuales = registro[51]; 
        $scope.registro.empresaFactorRedondeo = registro[52]; 
        $scope.registro.empresaConsecRcaja = registro[53]; 
        $scope.registro.empresaConsecFactura = registro[54]; 
        $scope.registro.empresaIdioma = registro[55]; 
        $scope.registro.empresaNroInmuebles = registro[56]; 
        $scope.registro.empresaLogo = registro[57]; 
        $scope.registro.empresaccosto = registro[58]; 
        $scope.registro.empresaservicios = registro[59]; 
        $scope.registro.empresafacturaNota = registro[60]; 
        $scope.registro.empresafacturaresDIAN = registro[61]; 
        $scope.registro.empresafacturaNumeracion = registro[62]; 
        $scope.registro.empresafacturanotaiva = registro[63]; 
        $scope.registro.empresafacturanotaica = registro[64]; 
        $scope.registro.empresafacturactacxc = registro[65]; 
        $scope.registro.empresafacturactaivta = registro[66]; 
        $scope.registro.empresafacturactaica = registro[67]; 
        $scope.registro.empresafacturactaiva = registro[68]; 
        $scope.registro.empresaRegimen = registro[69]; 
        $scope.registro.empresaporcentajeiva = registro[70]; 
        $scope.registro.empresatercero = registro[71]; 
        $scope.registro.empresaProformaCon = registro[72]; 
        $scope.registro.empresaProformaFac = registro[73]; 
        $scope.registro.empresaProformaLimSup = registro[74]; 
        $scope.registro.empresaProformaLimInf = registro[75]; 
        $scope.registro.empresaActividad=registro[76];;
        $scope.registro.empresaConsecFact=registro[77];
        $scope.registro.empresaObservaciones=registro[78];
        $scope.registro.empresaConsecNDb = registro[79]; 
        $scope.registro.empresaConsecNCr = registro[80]; 
        $scope.id=$scope.registro.empresatercero;
        $("#empresatercero").find($scope.id);
        $("#empresatercero option[value="+$scope.id+"]").attr('selected','selected');
        $("#redondeo option[value="+$scope.registro.empresaFactorRedondeo+"]").attr('selected','selected');
        });  
    }

// Function to add toggle behaviour to form
    $scope.formToggle =function(){
        $('#idForm').slideToggle();
        $scope.empresaId=0;
        $('#idForm').css('display', 'none');
    };

$scope.show_form = true;
// Function to add toggle behaviour to form
    $scope.formToggle =function(){
        $('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
    };

    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;  
        $('#idForm').slideToggle();

    };


    $scope.updateInfo =function(info)
    {
        er='';      
        empresa = $('#e').val();       
        if($('#empresaId').val()===''){er+='falta id\n';}
        if($('#empresaClave').val()===''){er+='falta clave\n';}
        if($('#empresaNombre').val()===''){er+='falta nombre\n';}
        if($('#empresaNit').val()===''){er+='falta nit\n';}
        if($('#empresaDigito').val()===''){er+='falta digito\n';}
        if($('#empresaDireccion').val()===''){er+='falta direccion\n';}
        if($('#empresaCiudad').val()===''){er+='falta ciudad\n';}
        if($('#empresaTelefonos').val()===''){er+='falta telefonos\n';}
        if($('#empresaFchCreacion').val()===''){er+='falta fch creacion\n';}
        if($('#empresaFchModificacion').val()===''){er+='falta fch modifica\n';}
        if($('#empresaFchVigencia').val()===''){er+='falta fch vigencia\n';}
        if($('#empresaPeriodoActual').val()===''){er+='falta periodo\n';}       
        if($('#empresaActiva').val()===''){er+='falta activa\n';}
        if($('#empresaCompFra').val()===''){er+='falta compr factura\n';}
        if($('#empresaCompRcaja').val()===''){er+='falta compr rcaja\n';}
        if($('#empresaCuentaCaja').val()===''){er+='falta cuenta caja\n';}
        if($('#empresaRecargoPorc').val()===''){er+='falta mora porc\n';}
        if($('#empresaRecargoPesos').val()===''){er+='falta mora en pesos\n';}
        if($('#empresaRecargoDias').val()===''){er+='falta mora dias\n';}
        if($('#empresaDescPorc').val()===''){er+='falta descnto porc\n';}
        if($('#empresaDescPesos').val()===''){er+='falta descnto pesos\n';}
        if($('#empresaDescDias').val()===''){er+='falta descnto dias\n';}
        if($('#empresaPagosParciales').val()===''){er+='falta pagos parciales\n';}
        if($('#empresaPeriodosAnuales').val()===''){er+='falta periodos anuales\n';}
        if($('#empresaFactorRedondeo').val()===''){er+='falta redondeo\n';}
        if($('#empresaConsecRcaja').val()===''){er+='falta consec rcaja\n';}
        if($('#empresaConsecFactura').val()===''){er+='falta consec factura\n';}
        if($('#empresaIdioma').val()===''){er+='falta idioma\n';}
        if($('#empresaNroInmuebles').val()===''){er+='falta nro inmuebles\n';}
        if($('#empresaLogo').val()===''){er+='falta logo\n';}
        if($('#empresafacturaNota').val()===''){er+='falta factura nota\n';}
        if($('#empresafacturaresDIAN').val()===''){er+='falta factura res DIAN\n';}
        if($('#empresafacturaNumeracion').val()===''){er+='falta factura numeracion\n';}
        if($scope.tipo == 'G'){
             if($('#empresaEmail').val()===''){er+='falta cuenta correo\n';}
        }
        if (er==''){
        $http.post('modulos/mod_contaempresas.php?op=a',{'op':'a', 'empresaId':info.empresaId, 
            'empresaClave':info.empresaClave, 'empresaNombre':info.empresaNombre, 'empresaNit':info.empresaNit,
            'empresaDigito':info.empresaDigito, 'empresaDireccion':info.empresaDireccion, 
            'empresaCiudad':info.empresaCiudad, 'empresaTelefonos':info.empresaTelefonos, 
            'empresaFchCreacion':info.empresaFchCreacion, 'empresaFchModificacion':info.empresaFchModificacion, 
            'empresaFchVigencia':info.empresaFchVigencia, 'empresaPeriodoActual':info.empresaPeriodoActual, 
            'empresaTwiter':info.empresaTwiter, 'empresaFacebook':info.empresaFacebook, 
            'empresaWeb':info.empresaWeb, 'empresaEmail':info.empresaEmail, 'empresaActiva':info.empresaActiva, 
            'empresaPuertoCorreo':info.empresaPuertoCorreo, 'empresaRepresentante':info.empresaRepresentante, 
            'empresaIdentifRepresentante':info.empresaIdentifRepresentante, 'empresaContador':info.empresaContador,
            'empresaMatriculaContador':info.empresaMatriculaContador, 
            'empresaIdentifContador':info.empresaIdentifContador, 'empresaRevisor':info.empresaRevisor, 
            'empresaMatriculaRevisor':info.empresaMatriculaRevisor, 
            'empresaIdentifRevisor':info.empresaIdentifRevisor, 'empresaAnoFiscal':info.empresaAnoFiscal, 
            'empresaEstructura':info.empresaEstructura, 'empresaAdministrador':info.empresaAdministrador, 
            'empresaAdministradorCed':info.empresaAdministradorCed, 'empresaSecretaria':info.empresaSecretaria, 
            'empresaSecretariaCedula':info.empresaSecretariaCedula, 'empresaMensaje1':info.empresaMensaje1, 
            'empresaMensaje2':info.empresaMensaje2, 'empresaPeriodoFactura':info.empresaPeriodoFactura, 
            'empresaPeriCierreFactura':info.empresaPeriCierreFactura, 'empresaCompFra':info.empresaCompFra, 
            'empresaCompRcaja':info.empresaCompRcaja, 'empresaCompAjustes':info.empresaCompAjustes, 
            'empresaCompEgreso':info.empresaCompEgreso, 'empresaCompCierreMes':info.empresaCompCierreMes, 
            'empresaCompApertura':info.empresaCompApertura, 'empresaCuentaCierre':info.empresaCuentaCierre, 
            'empresaCuentaCaja':info.empresaCuentaCaja, 'empresaRecargoPorc':info.empresaRecargoPorc, 
            'empresaRecargoPesos':info.empresaRecargoPesos, 'empresaRecargoDias':info.empresaRecargoDias, 
            'empresaDescPorc':info.empresaDescPorc, 'empresaDescPesos':info.empresaDescPesos, 
            'empresaDescDias':info.empresaDescDias, 'empresaPagosParciales':info.empresaPagosParciales, 
            'empresaPeriodosAnuales':info.empresaPeriodosAnuales, 
            'empresaFactorRedondeo':info.empresaFactorRedondeo, 'empresaConsecRcaja':info.empresaConsecRcaja, 
            'empresaConsecFactura':info.empresaConsecFactura, 'empresaIdioma':info.empresaIdioma, 
            'empresaNroInmuebles':info.empresaNroInmuebles, 'empresaLogo':info.empresaLogo, 
            'empresaccosto':info.empresaccosto, 'empresaservicios':info.empresaservicios, 
            'empresafacturaNota':info.empresafacturaNota, 'empresafacturaresDIAN':info.empresafacturaresDIAN, 
            'empresafacturaNumeracion':info.empresafacturaNumeracion, 
            'empresafacturanotaiva':info.empresafacturanotaiva, 'empresafacturanotaica':info.empresafacturanotaica, 
            'empresafacturactacxc':info.empresafacturactacxc, 'empresafacturactaivta':info.empresafacturactaivta, 
            'empresafacturactaica':info.empresafacturactaica, 'empresafacturactaiva':info.empresafacturactaiva, 
            'empresaRegimen':info.empresaRegimen,'empresaporcentajeiva':info.empresaporcentajeiva, 
            'empresaProformaLimSup':info.empresaProformaLimSup,'empresaProformaLimInf':info.empresaProformaLimInf,
            'empresaProformaCon':info.empresaProformaCon,'empresaProformaFac':info.empresaProformaFac,
            'empresaProformaLimSup':info.empresaProformaLimSup,'empresaProformaLimInf':info.empresaProformaLimInf,
            'empresatercero':info.empresatercero,'empresaActividad':info.empresaActividad,
            'empresaConsecFact':info.empresaConsecFact,'empresaObservaciones':info.empresaObservaciones,
            'empresaConsecNDb':info.empresaConsecNDb,'empresaConsecNCr':info.empresaConsecNCr}).success(function(data){
 
        if (data === 'Ok') {
           // getInfo(empresa);
            alert ('Registro Actualizado ');
        }
        });
   }else{alert (data);}  
    };
    
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm').slideToggle();
    };

}]);
	 

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
         
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Sep 09, 2019 7:25:07   <<<<<<< 
