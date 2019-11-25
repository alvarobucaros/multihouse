var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title = 'Contactáctenos';   
    $scope.form_subtitle = 'Comuníquenos sus apreciaciones, inquietudes o incidencias';   
    $scope.form_btnEnvia = 'Enviar';
    $scope.form_btnBorra = 'Limpiar';
    $scope.form_mnu1 = 'Otros Productos';
    $scope.form_mnu0='MutiHouse';
    
    $scope.tit01='Administración de conjuntos residenciales, comerciales o de oficinas';
    $scope.tit02='Para ingresar y probar la aplicación emplee';
    $scope.tit03='Usuario : admin@com.co Contraseña: Admin123';
    $scope.tit04='Sistema para la administración de conjuntos residenciales como una herramienta de apoyo en su gestión administrativa, es aplicable a conjuntos residenciales, centros comerciales o unidades empresariales de oficinas. ';
    $scope.tit05='Lleva el control de las unidades del conjunto (casa, apartamentos, oficinas,…) y de las personas responsables de estos: propietarios o arrendatarios; en éstos se definen las características del inmueble como es su ubicación dentro del conjunto, el tipo de inmueble y su coeficiente de área entre otras. Se definen una serie de servicios que presta la administración del conjunto los cuales pueden ser: generales de la administración como la cuota administrativa u otras expensas comunes, o servicios particulares que se cobran a uno o varios inmuebles tales como cuotas extras o cuotas de financiación por trabajos de servicios adicionales como pueden ser, arreglos de infraestructura, pago de uso de parqueadero comunal, etc. Con esta definición de servicios se emiten las cuentas de cobro mensuales a cada unidad del conjunto, se lleva una relación de pagos pendientes y los causados con la emisión de las cuentas de cobro, éstas se imprimen para su distribución física, pero también pueden ser enviadas por correo electrónico. Una funcionalidad permite cargar los pagos a través de recibos de caja, éstos ajustan los intereses de mora, el pago de expensas, permite el pago por anticipado y cruza contra cuentas de cobro futuras. Dispone de control de cartera y de informes de vencimientos, pude editar cartas de paz y salvo o cartas de cobro de cartera en mora. ';
    $scope.tit06='La aplicación puede correr de namera local o en la WEB haciendo la instalación pertinenete, esto se explica en el manual de instalación';
    $scope.tit07='';
    $scope.tit08='El sistema es seguro pues solo las personas autorizadas pueden acceder a la funcionalidad que se les permita.';
    $scope.tit09='Por ser un ambiente de trabajo tipo WEB, la información estará disponible en cualquier sitio utilizando cualquier navegador, este es un sistema habilitado para ser utilizado en computadores o en dispositivos móviles.';
    $scope.tit10='Precio: La aplicación es de uso libre, solo debe registrarse, hacer su donación y seguir las intrucciones en el manual de instalación';
    $scope.tit11='Si no posee un servidor WEB. puede utilizar la APP en nuestro sitio WEB con un cotrato de renta por un plazo mayor o igual a seis(6) meses con una inversión mensual de diez mil pesos ($10.000); este valor incluye: el alquiler del servidor WEB, actualizaciones de la APP y copias de seguridad diarias ';						
    $scope.tit12='';
    
    $scope.registroMail = {};
    $scope.retorno = false;
    
     $scope.sendMail = function(registroMail){
         dato= $scope.registroMail.nombre+'||'+$scope.registroMail.tema+'||'+$scope.registroMail.email+'||'+$scope.registroMail.celular+'||'+$scope.registroMail.message;
         $http.post('app/modulos/mod_mm_contacto.php?op=cnt',{'op':'cnt','dato':dato}).success(function(data){
         $scope.registroMail.retorno = data;
         });          
         $scope.retorno = true;    
     };     
    $scope.reset = function(){
        $scope.registroMail = {};     
    };    
}]);

