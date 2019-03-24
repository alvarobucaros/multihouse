var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Consultas ';
    $scope.form_subTitle = 'Consulta por comité según: Acta, fecha, tema ...';
    $scope.form_agenda_comiteId = 'Comite ';
    $scope.form_agenda_fechaDesde = 'Desde Fecha ';    
    $scope.form_agenda_fechaHasta = 'Hasta Fecha ';
    $scope.form_agenda_actaDesde='Desde acta';
    $scope.form_agenda_actaHasta='Hasta acta';
    $scope.form_titTema = 'Tema';
    $scope.form_btnConsulta = 'Consulta';
    $scope.form_titAnexos = 'Con anexos';
    $scope.form_AnexoN = 'No';
    $scope.form_AnexoS = 'Si';
    $scope.form_titAnexoDescripcion= 'Anexo sobre:';
    $scope.form_titAsistente = "Invitados :"
    $scope.form_imprime = "Imprime Consulta :"
    $scope.chk=true;
    $scope.ventana = true;
    var hoy = new Date();
    anoHoy = hoy.getFullYear();
    
    $scope.empresa = $('#e').val();
    $scope.comiteId=0;
    $scope.registro1 = {};
    $scope.registro1.agenda_fechaDesde= anoHoy+'-01-01';
    $scope.registro1.agenda_fechaHasta= anoHoy+'-12-31';
    $scope.registro1.agenda_actaDesde = 0000;
    $scope.registro1.agenda_actaHasta = 9999;
    $scope.registro1.tema='';
    getCombos($scope.empresa);
    
    getInfo();       
        
     function getInfo(){
      // alert($scope.empresa);
    }    
        
      function getCombos(empresa){
        $http.post('modulos/mod_mm_agendamiento.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
        $scope.operators1 = data;
      });     
         
    } 
      
    $scope.agenda_fechaDesde = function()
    {
        $scope.registro1.agenda_fechaHasta = $scope.registro1.agenda_fechaDesde;
    };        
        
    $scope.updateComite = function(){
        $scope.comiteId = $scope.registro1.agenda_comiteId;
    }
    
    
    $scope.editDetailResponse = function(detailResponse){
        agenda=detailResponse.agenda_id; 
        empresa=$scope.empresa;
        if (confirm('Consulta el acta con la información ?')) { 
            location.href="reports/rpt_mm_actas.php?op="+agenda+"&em="+empresa; 
        }
    };
    
    $scope.creaSolicitud = function(registro1){
        er='';
        anexoDescripcion = $scope.registro1.anexoDescripcion;
        if( anexoDescripcion === undefined){anexoDescripcion = "";}
        asistente= $scope.registro1.asistente;
        if( asistente === undefined){ asistente="";}
        anexos=$scope.registro1.anexos;
        if(anexos==undefined){anexos='S';}
        dato= $scope.comiteId+'||'+$scope.registro1.agenda_actaDesde+'||'+$scope.registro1.agenda_actaHasta+'||'+$scope.registro1.agenda_fechaDesde
        +'||'+$scope.registro1.agenda_fechaHasta+'||'+$scope.registro1.tema+'||'+$scope.empresa+'||'+anexoDescripcion  +'||'+asistente 
        +'||'+anexos+'||P';
        $http.post('modulos/mod_mm_agendamiento.php?op=cnslta',{'op':'cnslta','dato':dato}).success(function(data){ 
         $scope.detailResponses = data;
         });  
    };   

    $scope.exportToExcel = function(registro1){
        if ($scope.comiteId==0){
            alert('Requiere seleccionar un comité');
            return
        }
        anexoDescripcion = $scope.registro1.anexoDescripcion;
        if( anexoDescripcion === undefined){anexoDescripcion = "";}
        asistente= $scope.registro1.asistente;
        if( asistente === undefined){ asistente="";}
        anexos=$scope.registro1.anexos;
        if(anexos==undefined){anexos='S';}
        dato= $scope.comiteId+'||'+$scope.registro1.agenda_actaDesde+'||'+$scope.registro1.agenda_actaHasta+'||'+$scope.registro1.agenda_fechaDesde
        +'||'+$scope.registro1.agenda_fechaHasta+'||'+$scope.registro1.tema+'||'+$scope.empresa+'||'+anexoDescripcion  +'||'+asistente 
        +'||'+anexos+'||P';
        if (confirm('Va a imprimir la consulta. Continua ?'+dato)) { 
                location.href="reports/rpt_mm_consulta.php?dt="+dato; 
        }      
    };
    
//    function aExcel(parametros){
//            $.post("includes/opcAdmParam.php", {accion:'aExcelUsuarios', condicion:parametros}, function(data){
//            $('#miExcel').html(data); 
//            alert('exporta a Excel. Cargue y renombre el documento... ');
//            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
//        }); 
//    }


    }]);
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Feb 14, 2018 10:54:14   <<<<<<< 


