var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Consultas ';
    $scope.form_subTitle = 'Consulta por comité según: Acta, fecha o tema';
    $scope.form_agenda_comiteId = 'Comite ';
    $scope.form_agenda_fechaDesde = 'Desde Fecha ';    
    $scope.form_agenda_fechaHasta = 'Hasta Fecha ';
    $scope.form_agenda_actaDesde='Desde acta';
    $scope.form_agenda_actaHasta='Hasta acta';
    $scope.form_titTema = 'Tema';
    $scope.form_btnConsulta = 'Consulta';
    
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
        if($scope.comiteId == 0){er+='falta comite\n';}
        if (er !=''){
            alert(er);
            return;
            
        }
        dato= $scope.comiteId+'||'+$scope.registro1.agenda_actaDesde+'||'+$scope.registro1.agenda_actaHasta+'||'+$scope.registro1.agenda_fechaDesde
        +'||'+$scope.registro1.agenda_fechaHasta+'||'+$scope.registro1.tema+'||'+$scope.empresa;
//        alert (dato); 
//cnslta
        $http.post('modulos/mod_mm_agendamiento.php?op=cnslta',{'op':'cnslta','dato':dato}).success(function(data){ 
//            alert(data);
         $scope.detailResponses = data;
         });  
    };   

    $scope.exportToExcel = function(registro1){
        dato= $scope.comiteId+'||'+$scope.registro1.agenda_actaDesde+'||'+$scope.registro1.agenda_actaHasta+'||'+$scope.registro1.agenda_fechaDesde
        +'||'+$scope.registro1.agenda_fechaHasta+'||'+$scope.registro1.tema+'||'+$scope.empresa;  
        $http.post('modulos/mod_mm_agendamiento.php?op=excel',{'op':'excel','dato':dato}).success(function(data){ 
//            alert(data);
            $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + decodeURIComponent($('#miExcel').html()));
         }); 
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


