var app = angular.module('app', ["ngResource"]);
app.controller('mainController',['$scope','$http',  function($scope,$http){
    $scope.form_title = 'Lista de asistentes permanentes por comité';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta'; 

    $scope.form_asistente_id = 'ID';
    $scope.form_asistente_comiteId = 'COMITE';
    $scope.form_asistente_usuarioId = 'USUARIO';
    $scope.form_asistente_nombre = 'NOMBRE';
    $scope.form_asistente_empresa = 'EMPRESA';
    $scope.form_asistente_cargo = 'CARGO';
    $scope.form_asistente_celuar = 'CELULAR';
    $scope.form_asistente_email = 'E_MAIL';
    $scope.form_asistente_titulo = 'TITULO EN REUNION'
    $scope.form_tituloP = 'Presidente';
    $scope.form_tituloS = 'Secretario';
    $scope.form_tituloT = 'Trascriptor';
    $scope.form_tituloN = 'Ninguno';

    $scope.form_Phasistente_id = 'Digite id';
    $scope.form_Phasistente_comiteId = 'Digite grupo';
    $scope.form_Phasistente_usuarioId = 'Digite usuario';
    $scope.form_Phasistente_nombre = 'Digite nombre';
    $scope.form_Phasistente_empresa = 'Digite empresa';
    $scope.form_Phasistente_cargo = 'Digite cargo';
    $scope.form_Phasistente_celuar = 'Digite celular';
    $scope.form_Phasistente_email = 'Digite e_mail';
   
    $scope.registro = {};
    $scope.empresa = $('#e').val();
    $scope.AsistenteForm = false;
    $scope.chkTitulo = true;
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    
    
    getCombos($scope.empresa);
    
    getInfo($scope.empresa);
    
    function getCombos(empresa){
         $http.post('modulos/mod_mm_asistentes.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
         $scope.operators0 = data;
         });
         
         $http.post('modulos/mod_mm_asistentes.php?op=1',{'op':'1','empresa':empresa}).success(function(data){
         $scope.operators1 = data;
         });
    } 
    
    function getInfo(empresa){
        $http.post('modulos/mod_mm_asistentes.php?op=r',{'op':'r','empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();
        });       
    }

    $scope.configPages = function() {
        $scope.pages.length = 0;
        var ini = $scope.currentPage - 4;
        var fin = $scope.currentPage + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.details.length / $scope.pageSize) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.details.length / $scope.pageSize);
        }
        else {
            if (ini >= Math.ceil($scope.details.length / $scope.pageSize) - 10) {
                ini = Math.ceil($scope.details.length / $scope.pageSize) - 10;
                fin = Math.ceil($scope.details.length / $scope.pageSize);
            }
        }
        if (ini < 1) ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pages.push({no: i});
        }

        if ($scope.currentPage >= $scope.pages.length)
            $scope.currentPage = $scope.pages.length - 1;
    };

    $scope.setPage = function(index) {
        $scope.currentPage = index - 1;
    };
    

      $scope.changeUser = function() {
        $http.post('modulos/mod_mm_asistentes.php?op=su',{'op':'su','asistente_usuarioId':$scope.registro.asistente_usuarioId}).success(function(data){
            var n = data.length;
            var res = data.substring(1,n-2);
            var obj = JSON.parse(res, function (key, value) {
            if (key == "fecha") {
                return new Date(value);
                } else {
                    return value;
                }});
            $scope.registro.asistente_nombre=obj.usuario_nombre; 
            $scope.registro.asistente_empresa=obj.empresa_nombre; 
            $scope.registro.asistente_email=obj.usuario_email; 
            $scope.registro.asistente_celuar=obj.usuario_celular; 
        });
      };
      

$scope.show_form = true;

$scope.formToggle =function(){
        $scope.formato.$setPristine();
        $scope.registro = {};
        $scope.registro.asistente_usuarioId=0;
        $scope.registro.asistente_id=0;
        $scope.AsistenteForm = true;
};


    $scope.registro = [];
    
    $scope.editInfo =function(info)
    {  
        $scope.registro =  info;
        $scope.registro.asistente_titulo = info.asistente_titulo.substr(0, 1);
        $scope.AsistenteForm=true;
    };

    $scope.deleteInfo =function(info)
    { 
         $scope.empresa = $('#e').val();
        if (confirm('Desea borrar el registro con nombre : '+info.asistente_nombre+' ?')) {  
            $http.post('modulos/mod_mm_asistentes.php?op=b',{'op':'b', 'asistente_id':info.asistente_id}).success(function(data){
//alert(data);
            if (data.trim() === 'Ok') {
            getInfo($scope.empresa);
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        $scope.empresa = $('#e').val();
        if($('#asistente_id').val()===''){er+='falta id\n';}
        if($scope.registro.asistente_comite===0){er+='falta comité\n';}
        if($('#asistente_nombre').val()===''){er+='falta nombre\n';}
        if($('#asistente_empresa').val()===''){er+='falta empresa\n';}
        if($('#asistente_cargo').val()===''){er+='falta cargo\n';}
        if($('#asistente_celuar').val()===''){er+='falta celular\n';}
        if($('#asistente_email').val()===''){er+='falta e_mail\n';}
        if(info.asistente_titulo===undefined){info.asistente_titulo='N';}
        if(info.asistente_titulo===''){info.asistente_titulo='N';}
        if (er===''){
        $http.post('modulos/mod_mm_asistentes.php?op=a',{'op':'a', 'asistente_id':info.asistente_id, 'asistente_comite':info.asistente_comite,
            'asistente_usuarioId':info.asistente_usuarioId, 'asistente_nombre':info.asistente_nombre, 'asistente_empresa':info.asistente_empresa, 
            'asistente_cargo':info.asistente_cargo, 'asistente_celuar':info.asistente_celuar, 'asistente_email':info.asistente_email,
            'asistente_empresaId':$scope.empresa, 'asistente_titulo':info.asistente_titulo}).success(function(data){   
            if (data.trim() === 'Ok') {           
                getInfo($scope.empresa);
                $scope.AsistenteForm = false;             
                alert ('Registro Actualizado');
            }
        });
    } else{alert (er);} 
    };

    $scope.clearInfo =function(info)
    {
       $scope.AsistenteForm=false;
    };

}]);

  app.filter('startFromGrid', function() {
        return function(input, start) {
            start =+ start;
            return input.slice(start);
        }
    });
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Friday,Oct 27, 2017 7:40:45   <<<<<<< 
