var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Asamblea o reunión - Llamado a lista';
    $scope.form_btnNuevo = 'Crear lista';
    $scope.form_btnGuarda = 'Guarda la lista';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnAnula = 'Cerrar';
    $scope.form_btnExcel = 'Exporta Excel';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_btnImprime  = 'Imprime';
    $scope.form_titModal = 'Actualiza lista de registros';
    $scope.form_Phbusca = 'Consulta';
    $scope.form_selectLista = 'Cual Lista ?';
    $scope.form_lista_quorum = 'Quorum:';
    $scope.form_lista_asisten = 'Asisten:';
    $scope.form_lista_codigo = 'Fecha:';
    $scope.form_numeroLlamado = 'Llamado';

    $scope.verNueva = true;
    $scope.td1=false;
    $scope.td2=false;
    $scope.td3=false;
    $scope.td4=false;
    $scope.td5=false;
    $scope.td6=false;
    $scope.nroAsisten=0;
    $scope.porcQuorum=50.5;
    $scope.semaforo=0;

    $scope.empresa = $('#e').val();
    $scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.pages = [];
    $scope.registro = [];   
    $scope.detalles = [];
    $scope.numeroLlamado=0;
    
    getInfo($scope.empresa);
    getCombos($scope.empresa);
    
    function getInfo2(empresa){
        
    }
    
    function getInfo(empresa){
        var codigo = traeCodigo();
        $scope.registro.lista_empresa = empresa;
        $scope.registro.codigo = codigo;
        $scope.registro.lista_id = 0; 
        $http.post('modulos/mod_mm_llamalista.php?op=ri',{'op':'ri','empresa':empresa,'codigo':codigo}).success(function(data){           
        $scope.details = data;
        $scope.configPages();         
        });   
            $http.post('modulos/mod_mm_llamalista.php?op=vl',{'op':'vl','empresa':empresa,'codigo':codigo}).success(function(data){
            $scope.registro.lista_id = data;
            $scope.numeroLlamado = data;
            $scope.nombreLlamado = nomLista(data);
        });   
    }
    
    function getCombos(empresa){  // llena lista de fechas
        $http.post('modulos/mod_mm_llamalista.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
        $scope.operators0 = data;
        });
    } 

    
    $scope.nueva =  function (){
        var codigo = traeCodigo();
        var empresa = $('#e').val();
        $http.post('modulos/mod_mm_llamalista.php?op=rn',{'op':'rn', 'empresa':empresa,'codigo':codigo}).success(function(data){
            $scope.details = data;
        // va a cargar el combo de fechas    
        $http.post('modulos/mod_mm_llamalista.php?op=0',{'op':'0','empresa':empresa}).success(function(data){
            $scope.operators0 = data;
        });
        $scope.configPages(); 
        nomLista(1)
        }); 
    };

    $scope.guarda = function(){
        $scope.datos = [];   
        $scope.datos = $scope.details;
        i=Math.ceil($scope.details.length );
        for(x=0;x<=i;x++){
            id = $scope.datos[x].lista_id;
            j1 = $scope.datos[x].lista_asiste1;
            j2 = $scope.datos[x].lista_asiste2;
            j3 = $scope.datos[x].lista_asiste3;
            j4 = $scope.datos[x].lista_asiste4;
            j5 = $scope.datos[x].lista_asiste5;
            j6 = $scope.datos[x].lista_asiste6;
            obs = $scope.datos[x].lista_obervacion;
            datos=id+'||'+j1+'||'+j2+'||'+j3+'||'+j4+'||'+j5+'||'+j6+'||'+obs;
            $http.post('modulos/mod_mm_llamalista.php?op=a',{'op':'a', 'datos':datos}).success(function(data){
        }); 

        }    
        alert ('Lista guardada ');
    };
    
    $scope.selecCodigo = function(){        
        empresa=$('#e').val();
        lista=$scope.numeroLlamado;
        id = $scope.registro.lista_codigo;
        $http.post('modulos/mod_mm_llamalista.php?op=dl',{'op':'dl', 'id':id,'lista':lista}).success(function(data){            
            var res = data.split("||");
            $scope.registro.lista_id = res[0];
            $scope.numeroLlamado = res[1];
            $scope.nombreLlamado = nomLista(res[1]);
            $scope.nroAsisten = 0;
            $scope.registro.codigo = res[2];
            $scope.semaforo = sumaCoeficientes(1);
            if (res[1]>0){ $scope.verNueva = false;}
        });        
        
        $http.post('modulos/mod_mm_llamalista.php?op=ll',{'op':'ll', 'id':id}).success(function(data){
        $scope.details = data;
        $scope.configPages();   
        });
    };
    
    $scope.nuevaLista = function(){
        i = $scope.numeroLlamado;
        $scope.nombreLlamado = nomLista(i);
        ccontador(i);
        $scope.semaforo = sumaCoeficientes(i);
    };
    
    $scope.cuentaLista = function(fila){
        ccontador(fila)
    };
    
    function ccontador(fila){
        var u = $scope.nroAsisten;
        var c = parseFloat($scope.semaforo/100);
        var q = parseFloat($scope.porcQuorum);
        var lista = $scope.numeroLlamado; //$scope.registro.lista_id;
        $scope.detalles = $scope.details[fila];
        var coef = parseFloat($scope.detalles.lista_coeficiente);
        var action = '';
        if(lista === '1'){action=$scope.detalles.lista_asiste1;}
        if(lista === '2'){action=$scope.detalles.lista_asiste2;}
        if(lista === '3'){action=$scope.detalles.lista_asiste3;}
        if(lista === '4'){action=$scope.detalles.lista_asiste4;}
        if(lista === '5'){action=$scope.detalles.lista_asiste5;}
        if(lista === '6'){action=$scope.detalles.lista_asiste6;}
 //alert ('action '+action);      
        if (action === '1'){
            u+=1; c+=coef; 
        } else {
            u-=1; c-=coef;}
        $scope.nroAsisten = u;
        $scope.semaforo = c*100;
        if (c > q){$scope.color = 'green';} else {$scope.color = 'red';}   
    }
    
    function nomLista(i){
        $scope.td1=false;
        $scope.td2=false;
        $scope.td3=false;
        $scope.td4=false;
        $scope.td5=false;
        $scope.td6=false;

        lista=['Todas','Primero','Segundo','Tercero','Cuarto','Quinto','Sexto'];
        if(i==='1' || i==='0'){$scope.td1=true;}
        if(i==='2' || i==='0'){$scope.td2=true;}
        if(i==='3' || i==='0'){$scope.td3=true;}
        if(i==='4' || i==='0'){$scope.td4=true;}
        if(i==='5' || i==='0'){$scope.td5=true;}
        if(i==='6' || i==='0'){$scope.td6=true;}                     
        return lista[i];
        sumaCoeficientes(i);
    }
   
    function sumaCoeficientes(lista){
        var q = parseFloat($scope.porcQuorum);
        $scope.datos = [];   
        $scope.datos = $scope.details;
        i=Math.ceil($scope.details.length );
        coef=0.0;
        nr=0;
        ar=[];
        ll='lista_asiste'+lista;
        for(x=0;x<i;x++){
            ar=$scope.datos[x];
            if ((lista==='1' && ar['lista_asiste1'] === '1')||
                (lista==='2' && ar['lista_asiste2'] === '1')){
                coef += parseFloat($scope.datos[x].lista_coeficiente);
                nr +=1;
            }
        }

        $scope.nroAsisten = nr;
        nr=coef*100;
        $scope.nroQuorum =  nr.toFixed(2);
        if (coef > q){ return "smaforored";} else {return smaforogreen}
        //if (coef > q){ $scope.colorClass = { verde:true};} else {$scope.colorClass =  { rojo:true};}
   }
   
    $scope.semaforo = function(){
        co= $scope.nroQuorum;
        q = parseFloat($scope.porcQuorum);
        if (coef*100 > q){ $scope.semaforo= "smaforored";} else { $scope.semaforo="semaforogreen"}
//     if(someValue=="first")
//            return "ClassA"
//     else if(someValue=="second")
//         return "ClassB";
//     else
//         return "ClassC";
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

 
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#idForm').slideToggle();
$scope.lista_id=0;
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
       if (valor === true) {
            empresa = $('#e').val();
            codigo = $scope.registro.codigo;
            $http.post('modulos/mod_mm_llamalista.php?op=exp',{'op':'exp',
                'empresa':empresa,'codigo':codigo}).success(function(data){
           $('#miExcel').html(data); 
            alert('exporta a Excel. Cargue y renombre el documento... ');
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#miExcel').html()));
        }); 
       }  
    };

    $scope.imprime = function(){
        empresa = $scope.empresa;
        codigo = $scope.registro.codigo;
        if (confirm('Va a imprimir el listado de asistencia con nombre\n c:/tmp/asistenciaAsamblea'+codigo+'.pdf. \n Antes se debe crear la carpeta c:/tmp   Continua ?')) { 
            location.href="reports/rpt_mm_listas.php?co="+codigo+"&em="+empresa; 
        }
       // return;
        empresa = $scope.empresa;
        codigo = $scope.registro.codigo;
           $http.post('modulos/mod_mm_llamalista.php?op=imp',{'op':'imp',
               'empresa':empresa, 'codigo':codigo}).success(function(data){
                alert ('Impresión concluída revise c:/tmp/asistenciaAsamblea'+codigo+'.pdf');
           });       
    };
    
    $scope.deleteInfo =function(info)
    { 
        if (confirm('Desea borrar el registro con nombre : '+info.lista_inmueble+' ?')) {  
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
        if($('#lista_asiste1').val()===''){er+='falta asiste1\n';}
        if($('#lista_asiste2').val()===''){er+='falta asiste2\n';}
        if($('#lista_asiste3').val()===''){er+='falta asiste3\n';}
        if($('#lista_asiste4').val()===''){er+='falta asiste4\n';}
        if($('#lista_asiste5').val()===''){er+='falta asiste5\n';}
        if($('#lista_asiste6').val()===''){er+='falta asiste6\n';}
        if($('#lista_area').val()===''){er+='falta area\n';}
        if($('#lista_coeficiente').val()===''){er+='falta coeficiente\n';}
        if($('#lista_propietario').val()===''){er+='falta propietario\n';}
        if($('#lista_cedula').val()===''){er+='falta cedula\n';}
        if($('#lista_obervacion').val()===''){er+='falta obervacion\n';}
        if($('#lista_descripcion').val()===''){er+='falta descripcion\n';}
        if (er===''){
        $http.post('modulos/mod_mm_llamalista.php?op=a',{'op':'a', 'lista_id':info.lista_id, 'lista_empresa':info.lista_empresa, 'lista_codigo':info.lista_codigo, 'lista_inmueble':info.lista_inmueble, 'lista_asiste1':info.lista_asiste1, 'lista_asiste2':info.lista_asiste2, 'lista_asiste3':info.lista_asiste3, 'lista_asiste4':info.lista_asiste4, 'lista_asiste5':info.lista_asiste5, 'lista_asiste6':info.lista_asiste6, 'lista_area':info.lista_area, 'lista_coeficiente':info.lista_coeficiente, 'lista_propietario':info.lista_propietario, 'lista_cedula':info.lista_cedula, 'lista_obervacion':info.lista_obervacion, 'lista_descripcion':info.lista_descripcion}).success(function(data){
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
        if(mm<10){codigo +='0';}
        codigo += mm.toString();
        if(dd<10){codigo +='0';}
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
	 
// >>>>>>>   Creado por: Alvaro Ortiz Castellanos   Sunday,Aug 26, 2018 10:18:56   <<<<<<< 
