var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'PUCC Plan Unico Contable Copropiedades';
    $scope.form_btnNuevo = 'Nuevo registro';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
 
    $scope.form_pucTipo60 = 'Movimiento';
    $scope.form_pucTipo61 = 'Totaliza';
    $scope.form_pucActivo70 = 'Activo';
    $scope.form_pucActivo71 = 'Inactivo';
    $scope.form_pucClase80 = 'Normal';
    $scope.form_pucClase81 = 'Iva';
    $scope.form_pucClase82 = 'Retefuente';

    $scope.form_pucId = 'ID';
    $scope.form_pucEmpresaId = 'EMPRESA';
    $scope.form_pucCuenta = 'CUENTA';
    $scope.form_pucNombre = 'NOMBRE CUENTA';
    $scope.form_pucMayor = 'MAYOR';
    $scope.form_pucNivel = 'NIVEL';
    $scope.form_pucTipo = 'TIPO';
    $scope.form_pucActivo = 'ACTIVO';
    $scope.form_pucClase = 'CLASE';
    $scope.form_pucValor = 'VALOR';

    $scope.form_PhpucId = 'Digite id';
    $scope.form_PhpucEmpresaId = 'Digite empresa';
    $scope.form_PhpucCuenta = 'Digite cuenta';
    $scope.form_PhpucNombre = 'Digite nombre cuenta';
    $scope.form_PhpucMayor = 'Digite mayor';
    $scope.form_PhpucNivel = 'Digite nivel';
    $scope.form_PhpucTipo = 'Digite tipo';
    $scope.form_PhpucActivo = 'Digite activo';
    $scope.form_PhpucClase = 'Digite clase';
    $scope.form_PhpucValor = 'Digite valor';
   
     $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.pages = [];
     $scope.registro = [];
     $scope.empresa = $('#e').val();
    var defaultForm= {
   
        pucId:0,
        pucEmpresaId:$scope.empresa,
        pucCuenta:'',
        pucNombre:'',
        pucMayor:'',
        pucNivel:0,
        pucTipo:'',
        pucActivo:'A',
        pucClase:'N',
        pucValor:0
   };
    
    
    getInfo($scope.empresa);
    
    function getInfo(empresa){
        $http.post('modulos/mod_contaprocesos.php?op=par',{'op':'par', 'empresa':empresa}).success(function(data){ 
        rec=data.split('||');
        $scope.periodo = rec[1];
        $scope.registro.ultimoPeriodo =  rec[1];
        $scope.estructura = rec[14];
        $scope.form_PhpucCuenta='Estructura: '+rec[14];
         }); 
        $http.post('modulos/mod_contaplancontable.php?op=r',{'op':'r', 'empresa':empresa}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });       
    }

    function getCombos(){
    };
 
    $scope.miEstructura = function(){
        var niveles = new Array();
        var tura = $scope.estructura;      
        var estruc = tura.split('-');
        var suma = 0;
        var lng = estruc.length;
        for(i=0;i<lng;i++){
            suma += estruc[i].length;
            niveles[i]=suma;
        }
        var cta = $scope.registro.pucCuenta; 
        
        var longCta = cta.length;
        var ok=0;
        var niv=0;
        var mayor = '';
        suma = 0;
        for(i=0;i<niveles.length;i++){
            if(niveles[i]==longCta){
                ok=1;
                niv=i+1;
            }
            if(niveles[i] < longCta){
                suma = suma  + estruc[i].length;
            }
        } 
            
        if (ok==1){
            $scope.registro.pucNivel=niv; 
            $('#pucNombre').focus();
            if (niv==1){
            mayor = 0;
            }else {
                mayor = cta.slice(0,suma);
            }
        }else{
            alert ('La cuenta no esta de acuerdo a la estructura: '+tura);
            mayor='';
        }

         $scope.registro.pucMayor = mayor;      
    };
    
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

 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.pucId=0;
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

$scope.exporta = function(){
    valor = confirm('Exporta la tabla de inmuebles y propietarios a Excel, continua?');
   if (valor == true) {
        empresa = $('#e').val();
        $http.post('modulos/mod_contaplancontable.php?op=exp',{'op':'exp','empresa':empresa}).success(function(data){
       $('#miExcel').html(data); 
        alert('exporta a Excel. Cargue y renombre el documento... ');
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
    }); 
   }  
}
    $scope.deleteInfo =function(info)
    { 
        empresa = $scope.empresa;
        if (confirm('Desea borrar el registro con nombre : '+info.pucCuenta+' ?')) {  
            $http.post('modulos/mod_contaplancontable.php?op=b',{'op':'b', 'pucId':info.pucId, 
                'empresa':empresa, 'cuenta':info.pucCuenta}).success(function(data){
            alert(data);
            if (data.substr(0,3) === 'OK.') {
             getInfo(empresa);
            
            }
            });
         }
    };

    $scope.updateInfo =function(info)
    {
        er='';
        empresa = $('\#e').val(); 
        if($('#pucId').val()===''){er+='falta id\n';}
        if($('#pucEmpresaId').val()===''){er+='falta empresa\n';}
        if($('#pucCuenta').val()===''){er+='falta cuenta\n';}
        if($('#pucNombre').val()===''){er+='falta nombre cuenta\n';}
        if($('#pucMayor').val()===''){er+='falta mayor\n';}
        if($('#pucNivel').val()===''){er+='falta nivel\n';}
        if($('#pucTipo').val()===''){er+='falta tipo\n';}
        if($('#pucActivo').val()===''){er+='falta activo\n';}
        if($('#pucClase').val()===''){er+='falta clase\n';}
        if($('#pucValor').val()===''){er+='falta valor\n';}
        if($scope.registro.pucTipo===''){er+='falta tipo\n';}
        if (er===''){
        $http.post('modulos/mod_contaplancontable.php?op=a',{'op':'a', 'pucId':info.pucId, 'pucEmpresaId':info.pucEmpresaId,
            'pucCuenta':info.pucCuenta, 'pucNombre':info.pucNombre, 'pucMayor':info.pucMayor, 'pucNivel':info.pucNivel,
            'pucTipo':info.pucTipo, 'pucActivo':info.pucActivo, 'pucClase':info.pucClase, 'pucValor':info.pucValor}).success(function(data){           
        if (data.substr(0,3) === 'OK.') {
            getInfo(empresa);
            alert ('Registro Actualizado ');
            $('#idForm').slideToggle();
            $('#idForm').slideToggle();
        }else{
            getInfo(empresa);
            alert(data);
        }
        });
   }else{alert (er);}  
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Monday,Jan 13, 2020 11:54:47   <<<<<<< 
