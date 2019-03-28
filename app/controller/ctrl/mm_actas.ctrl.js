var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Actas de reunión';
    
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnPrint = 'Imprime';
    $scope.form_btnActualiza = 'Habilita'
    $scope.form_btnCierra = 'Cierra Acta'
    $scope.form_btnRegreso = 'Cancela'
    $scope.form_agenda_comiteId = 'COMITE';
    $scope.tituloFormulario='';
    
    $scope.detail = {};
    
    $scope.empresa = $('#e').val();
    $scope.parametro = '';
    $scope.nota='';
    $scope.acta=0;
    $scope.agenda_id=0;
    $scope.formato = '';
    $scope.btnActualiza = true;
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
    
    $scope.cierraActa = function(detail){
        agenda=$scope.agenda_id;        
        param=$scope.parametro; 
   
        alert('Cierra acta ' + $scope.acta + ' ' + $scope.nota);      
        empresa=$scope.empresa;
        $http.post('modulos/mod_mm_agendamiento.php?op=cra',{'op':'cra','empresa':empresa,'agenda':agenda}).success(function(data){ 
        alert (data);
//        alert($scope.formato);
         });  
    }
    
    $scope.editInfo = function (detail){ 
        $scope.agenda_id =  detail.agenda_id
        $scope.parametro = 'I';
        $scope.aviso=''
        $scope.nota=detail.agenda_Descripcion;
        $scope.acta=detail.agenda_acta;
        if(detail.agenda_cierraActa=='S'){$scope.aviso = "** ACTA CERRADA **";}
        $scope.tituloFormulario='Habilita ' + detail.agenda_Descripcion + ' para modificarla o enviar nuevamente la citación ';
        if (detail.agenda_observa.trim() == ''){
            $scope.parametro = 'A';
            var fecha = detail.agenda_fechaDesde.substr(0,10);
            $scope.tituloFormulario='Acta: ' + detail.agenda_acta + ' del ' + fecha + '\n' +detail.agenda_Descripcion  ;
        }
            $scope.showEdit = true;
            $scope.btnActualiza = true;
            if(detail.agenda_cierraActa=='S'){$scope.btnActualiza = false; }
    }; 
    
    $scope.anulaRegistro = function(){
        $scope.showEdit = false;
    }
    
    $scope.actualizaRegistro = function(detail){
        agenda=$scope.agenda_id;        
        param=$scope.parametro;        
        $http.post('modulos/mod_mm_agendamiento.php?op=ha',{'op':'ha', 'agenda_id':agenda,'parametro':param}).success(function(data){
    //    alert(data);
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


