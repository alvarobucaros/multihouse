var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
   
    $scope.form_titleImportar = 'Importa Información desde CSV  Saldos de cartera';
    $scope.nota1 = 'Importante !!!, esto borra toda la cartera del sistema. La información debe estar en formato .CSV cada campo separado por un punto y coma (;) y en un solo documento'
    $scope.nota2 = 'El formato debe ser: '
    $scope.nota3 = 'Numero Doc; Inmuebleid; Cédula Propietario; Servicio; Periodo; Fecha Factura; Fecha Vence; Saldo; Detalle; Tipo';

    $scope.form_subtit1 = '';
    $scope.form_subtit2 = 'Crea la lista de ervicios prestados por el Conjunto';
    $scope.progress = false;

    $('document').ready(function(){
        cargaCombos();
        document.getElementById('fileUpload').addEventListener('change', upload, false);
    });
 
   $('#nf').click(function(){
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        return false;
    });
    
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        inf = $('#tipoInfo').find(":selected").val();
        $('#informe').val(inf);
        return false;
    });


    $(':file').change(function(){
        var file = this.files[0];
        var name = file.name;
        var size = file.size;
        var type = file.type;
        $('#archivo').val(name);
        $('#tamano').val(size);
        empresa = $('#e').val();
        $('#empresa').val(empresa);
    });
    
    function upload(evt) {

        empresa = $('#e').val();

        if (!browserSupportFileUpload()) {
            alert('Este browser no permite carga de archivos !');
        } 
        else 
        {        
            var data = null;
            var file =   evt.target.files[0];  
            var reader = new FileReader();
            reader.readAsText(file, 'ISO-8859-1');
            reader.onload = function(event)
            
            {
                var csvData = reader.result; //event.target.result;
                data =  $.csv.toArrays(csvData); 
                var name =  $('#archivo').val();
                var empresa  = $('#empresa').val();
                if (confirm('importa los datos a la tabla  desde el archivo... '+name)){
                    $scope.progress = true;
                    condicion = empresa
                    $.post("inc/opcGrales.php", {accion:'borraSaldos', condicion:condicion}, function(dato){ 
                    }) 

                     for(i=1;i<data.length;i++){
                        condicion = empresa+'||'+name+'||'+data[i]+'||S';    
                        $.post("inc/opcGrales.php", {accion:'importaDatos', condicion:condicion}, function(data){ 
                         
                    }) 
                     }
                      alert('Importó -' + i + '- pagos. correcto !!! + data');
                      $scope.progress = false;
                    } else {
                        alert('No importo registros!');
                    }                
                }
            };
            reader.onerror = function() {
                alert('No puede leer  ' + file.fileName);
            };
        } 
   
   function unicodex(cadena){
       i=0;
       dele='';
       for(i=0;i<=length(cadena); i++)
       {
           dele += cadena.charCodeAt(i)
       }
       alert(dele);
   }    
   
        function browserSupportFileUpload() {
        var isCompatible = false;
        if (window.File && window.FileReader && window.FileList && window.Blob) {
        isCompatible = true;
        }
        return isCompatible;
    }
    
    function opcion(op){
       $('#tabla').val(op);
       $('#informe').val('');
    }
    
    function selectConta(){
        selectedVal = "";
        var selected = $("input[type='radio'][name='impo']:checked");
        if (selected.length > 0) {
        selectedVal = selected.val();
        } 
    }
 
  function cargaCombos()
  {
  }
  
function carga(){
}
    $('#fileUpload').click(function(){
    var _this = $(this);
    $('#fileUpload').show().focus().click().hide();

    var filename = $('#fileUpload').val();
    _this.html(filename);
   
});

}]);

