var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Llama lista';
    $scope.form_btnNuevo = 'Crear lista';
    $scope.form_btnGuarda = 'Guarda la lista';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
    $scope.form_selectLista = 'Cual Lista ?';
    $scope.form_lista_quorum = 'Quorum:';
    $scope.form_lista_asisten = 'Asisten:';
//    $scope.form_lista_id = 'ID';
//    $scope.form_lista_empresa = 'EMPRESA';
//    $scope.form_lista_codigo = 'CODIGO';
//    $scope.form_lista_inmueble = 'INMUEBLE';
//    $scope.form_lista_asiste = 'ASISTE';
//    $scope.form_lista_obervacion = 'OBERVACION';
//    $scope.form_lista_area = 'AREA';
//    $scope.form_lista_coeficiente = 'COEFICIENTE';
//    $scope.form_lista_descripcion = 'DESCRIPCION';
//    $scope.form_lista_propietario = 'PROPIETARIO';
//    $scope.form_lista_cedula = 'CEDULA';

//    $scope.form_Phlista_id = 'Digite id';
//    $scope.form_Phlista_empresa = 'Digite empresa';
//    $scope.form_Phlista_codigo = 'Digite codigo';
//    $scope.form_Phlista_inmueble = 'Digite inmueble';
//    $scope.form_Phlista_asiste = 'Digite asiste';
//    $scope.form_Phlista_obervacion = 'Digite obervacion';
//    $scope.form_Phlista_area = 'Digite area';
//    $scope.form_Phlista_coeficiente = 'Digite coeficiente';
//    $scope.form_Phlista_descripcion = 'Digite descripcion';
//    $scope.form_Phlista_propietario = 'Digite propietario';
//    $scope.form_Phlista_cedula = 'Digite cedula';
   
    $scope.empresa = $('#e').val();
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];
      
    var defaultForm= {
        lista_id:0,
        lista_empresa:0,
        lista_codigo:'',
        lista_inmueble:'',
        lista_asiste:'',
        lista_obervacion:'',
        lista_area:'',
        lista_coeficiente:'',
        lista_descripcion:'',
        lista_propietario:'',
        lista_cedula:''
   };
    
    getInfo();
    
    function getInfo(){
    var codigo = traeCodigo();
    var empresa = $('#e').val();
    $scope.registro.lista_empresa = empresa;
    $scope.registro.codigo = codigo;
    $scope.registro.lista_id =0;  
    $http.post('modulos/mod_mm_llamalista.php?op=ri',{'op':'ri', 'empresa':empresa,'codigo':codigo
            }).success(function(data){
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

$scope.show_form = true;

$scope.nueva =  function (){
    var codigo = traeCodigo();
    var empresa = $('#e').val();
    $scope.lista_empresa = empresa;
    $scope.codigo = codigo;
    $http.post('modulos/mod_mm_llamalista.php?op=r',{'op':'r', 'empresa':empresa,'codigo':codigo
            }).success(function(data){
        alert (data);
    $scope.details = data;
    $scope.configPages();   
    }); 
}


$scope.guarda =  function (){
    alert('guarda'); 
}

$scope.exporta = function(){
    valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
   if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_mm_llamalista.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.lista_codigo+' ?')) {  
            $http.post('modulos/mod_mm_llamalista.php?op=b',{'op':'b', 'lista_id':info.lista_id}).success(function(data){
            if (data === 'Ok') {
            getInfo();
            alert ('Registro Borrado ');
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
    er='';
        if($('#lista_id').val()===''){er+='falta id\n';}
        if($('#lista_empresa').val()===''){er+='falta empresa\n';}
        if($('#lista_codigo').val()===''){er+='falta codigo\n';}
        if($('#lista_inmueble').val()===''){er+='falta inmueble\n';}
        if($('#lista_asiste').val()===''){er+='falta asiste\n';}
        if($('#lista_obervacion').val()===''){er+='falta obervacion\n';}
        if($('#lista_area').val()===''){er+='falta area\n';}
        if($('#lista_coeficiente').val()===''){er+='falta coeficiente\n';}
        if($('#lista_descripcion').val()===''){er+='falta descripcion\n';}
        if($('#lista_propietario').val()===''){er+='falta propietario\n';}
        if($('#lista_cedula').val()===''){er+='falta cedula\n';}
        if (er==''){
        $http.post('modulos/mod_mm_llamalista.php?op=a',{'op':'a', 'lista_id':info.lista_id, 'lista_empresa':info.lista_empresa, 'lista_codigo':info.lista_codigo, 'lista_inmueble':info.lista_inmueble, 'lista_asiste':info.lista_asiste, 'lista_obervacion':info.lista_obervacion, 'lista_area':info.lista_area, 'lista_coeficiente':info.lista_coeficiente, 'lista_descripcion':info.lista_descripcion, 'lista_propietario':info.lista_propietario, 'lista_cedula':info.lista_cedula}).success(function(data){
        if (data === 'Ok') {
            getInfo();
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
        }
        });
   }else{alert (er);}  
    };
    
    $scope.clearInfo =function(info)
    {
        console.log('empty');
        $('#idForm').slideToggle();
    };
    
    function traeCodigo(){        
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        codigo=yyyy.toString();
        if(mm<10){codigo +='0'}
        codigo += mm.toString();
        if(dd<10){codigo +='0'}
           codigo+=dd.toString();
        return codigo;   
    }

}]);
	 

   app.filter('startFromGrid', function() {
         return function(input, start) {
             start =+ start;
             return input.slice(start);
         };
     });  
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Aug 19, 2018 9:56:50   <<<<<<< 
