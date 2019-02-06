var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Actas de reunión';
    
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnPrint = 'Imprime';
    $scope.form_btnActualiza = 'Habilita'
    $scope.form_btnRegreso = 'Regresa'
    $scope.form_agenda_comiteId = 'COMITE';
    $scope.tituloFormulario='';
    
    $scope.detail = {};
    
    $scope.empresa = $('#e').val();
    $scope.parametro = '';
    $scope.agenda_id=0;
    $scope.formato = '';
 
    var defaultForm= {
        agenda_comiteId:0
   };

         
    getCombos($scope.empresa);
    
    getInfo();
    
    $scope.show_form = true;

    $scope.formToggle =function(){
    $('#idForm').slideToggle();
        $scope.formato.$setPristine();
        $scope.registro = angular.copy(defaultForm);
    };
    
    function getInfo(){
      // alert($scope.empresa);
    }


    function getCombos(empresa){
         $http.post('modulos/mod_mm_agendamiento.php?op=1',{'op':'1','empresa':empresa}).success(function(data){ 
         $scope.operators1 = data;
         });    
    }

    $scope.updateComite = function() { 
        traeAgendamientos();
    };    
    
    function traeAgendamientos(){
        empresa=$scope.empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=rc',{'op':'rc', 'comite_Id':$scope.agenda_comiteId,'empresa':empresa,'param':'excluye'}).success(function(data){
        if(data == 'No Hay'){
            alert('Este comité no tiene reuniones convocadas');
        }
        else{
          $scope.details = data;
        }
       });
    }
    
    $scope.editInfo = function (detail){ 
        $scope.agenda_id =  detail.agenda_id
        $scope.parametro = 'I';
        $scope.tituloFormulario='Habilita ' + detail.agenda_Descripcion + ' para modificarla o enviar nuevamente la citación ';
        if (detail.agenda_observa.trim() == ''){
            $scope.parametro = 'A';
            $scope.tituloFormulario='Habilita para adelantar la citación  ' + detail.agenda_Descripcion ;
        }
       
            $scope.showEdit = true;
        
    }; 
    
    $scope.anulaRegistro = function(){
        $scope.showEdit = false;
    }
    
    $scope.actualizaRegistro = function(detail){
        agenda=$scope.agenda_id;        
        param=$scope.parametro;        
        $http.post('modulos/mod_mm_agendamiento.php?op=ha',{'op':'ha', 'agenda_id':agenda,'parametro':param}).success(function(data){
        alert(data);
            if(data === 'Ok'){
               traeAgendamientos();
                alert('Comité habilitado. ');
        }
        else{
          alert(data);
        }
       });     
    };
    
    $scope.printInfo = function(detail){   
        agenda=detail.agenda_id; 
        empresa=$scope.empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=rfa',{'op':'rfa','empresa':empresa}).success(function(data){ 
        $scope.formato = data;
//        alert($scope.formato);
         });  
        if (confirm('Va a imprimir el acta. Continua ?')) { 
                location.href="reports/rpt_mm_actas.php?op="+agenda+"&em="+empresa; 
        }
    }; 
    
    
    
    }]);
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Tuesday,Jan 09, 2018 10:54:14   <<<<<<< 


