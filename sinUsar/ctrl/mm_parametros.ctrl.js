var app = angular.module('app', []);
app.controller("MainController", ['$scope','$http', function($scope,$http){
        $scope.form_btnNuevo = 'Nuevo';
        $scope.form_btnActualiza = 'Actualizar';
	$scope.lenguajes = ["ESP", "ING", "FRC", "OTR"];
        $scope.txtEmail=' Por correo';
        $scope.txtUsuario=' Por usuario';
        $scope.txtCelular=' Por celular';
        $scope.from_title = 'Parámetros del sistema';
	$scope.from_btnNuevo = 'Nuevo';
	$scope.from_btnActualiza = 'Actualizar';
        
	$scope.form_registrsoXpagina = 'Registros en grilla';   
	$scope.form_diasTrabaja = 'Dias laborales'; 
	$scope.form_horarioInicio = 'Inicia labores'; 
	$scope.form_horarioTermina   = 'Finaliza labores'; 
	$scope.form_intervaloCalendario = 'intervalo horario'; 
   
	$scope.form_PhregistrsoXpagina = 'Nr registros en la grilla';   
	$scope.form_PhdiasTrabaja = 'lu-ma-mi-ju-vi-sa-do'; 
	$scope.form_PhhorarioInicio = 'hora inicial'; 
	$scope.form_PhhorarioTermina   = 'hora final'; 
	$scope.form_PhintervaloCalendario = '1 o 1/2 hora'; 
    
        $scope.empresa_id = '';
	$scope.registrsoXpagina = '';   
	$scope.diasTrabaja = ''; 
	$scope.horarioInicio = ''; 
	$scope.horarioTermina   = ''; 
	$scope.intervaloCalendario = ''; 

        getInfo();
        
    function getInfo(){
        empresa = $('#comite_empresa').val();
        $http.post('modulos/modEmpresa.php?op=r',{'op':'r', 'empresa_id':empresa}).success(function(data, textStatus){
        $scope.registrsoXpagina = data[0].registrsoXpagina; 
        $scope.empresa_id = data[0].empresa_id;	
	$scope.diasTrabaja = data[0].diasTrabaja;  
	$scope.horarioInicio = data[0].horarioInicio;  
	$scope.horarioTermina   = data[0].horarioTermina;  
	$scope.intervaloCalendario = data[0].intervaloCalendario; 
	$scope.empresa_telefonos  = data[0].empresa_telefonos; 
	$scope.empresa_ciudad = data[0].empresa_ciudad;  
	$scope.empresa_logo = data[0].empresa_logo;  
	$scope.empresa_autentica  = data[0].empresa_autentica; 
	$scope.empresa_lenguaje = data[0].empresa_lenguaje; 
	$scope.empresa_clave = data[0].empresa_clave;  
	$scope.empresa_versionPrd = data[0].empresa_versionPrd;  
	$scope.empresa_versionDB = data[0].empresa_versionBd; 
        if (data[0].empresa_autentica==='M'){$scope.autenticaM=true;}
        if (data[0].empresa_autentica==='U'){$scope.autenticaU=true;}
        });       
    }        
        
   
// param_empresaid, param_registrsoXpagina, param_diasTrabaja, param_horarioInicio, param_horarioTermina, param_intervaloCalendario 

           
    $scope.btnSend = function() {
        er='';
        if($scope.registrsoXpagina===''){er+='falta nombre\n';}
        if( $scope.diasTrabaja===''){er+='falta nit\n';}
        if($scope.horarioTermina===''){er+='falta email\n';}
        if($scope.intervaloCalendario===''){er+='falta Dirección\n';}
        if($scope.empresa_telefonos===''){er+='falta teléfono\n';}
        if($scope.empresa_ciudad===''){er+='falta la ciudad\n';}
        if($scope.empresa_clave===''){er+='falta una clave\n';}
        if($scope.empresa_versionPrd===''){er+='falta la verdion de la aplicación\n';}
        if($scope.empresa_versionDB===''){er+='falta la versión de la base de datos\n';}
        if (er==''){  
            $scope.empresa_autentica = 'M';
            if ($scope.autenticaU===true){$scope.empresa_autentica = 'U';}

            $http.post('modulos/modEmpresa.php?op=a',{"op":'a', empresa_id: $scope.empresa_id,  
                    registrsoXpagina: $scope.registrsoXpagina, diasTrabaja: $scope.diasTrabaja,  
                    horarioInicio: $scope.horarioInicio, horarioTermina: $scope.horarioTermina,  
                    intervaloCalendario: $scope.intervaloCalendario, empresa_telefonos: $scope.empresa_telefonos, 
                    empresa_ciudad: $scope.empresa_ciudad, empresa_logo: $scope.empresa_logo,
                    empresa_autentica: $scope.empresa_autentica, empresa_lenguaje: $scope.empresa_lenguaje,     
                    empresa_clave: $scope.empresa_clave, empresa_versionPrd: $scope.empresa_versionPrd,
                    empresa_versionDB: $scope.empresa_versionDB }).success(function(data){
                if (data === 'Ok') {
                    getInfo();
                    alert ('Registro Actualizado ');
                    }
            });

        }else
        {
            alert(er);
        }
 
    };
}]);

