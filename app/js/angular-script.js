// Application module
var crudApp = angular.module('crudApp',[]);
crudApp.controller("DbController",['$scope','$http', function($scope,$http){
 $scope.form_title = 'Lista de perfiles';
    $scope.form_btnNuevo = 'Nuevo perfil';
    $scope.form_btnEdita = 'Edita';
    $scope.form_btnActualiza = 'Actualiza';
    $scope.form_btnElimina = 'Elimina';
    $scope.form_btnActualiza = 'Actualizar';
    $scope.form_titModal = 'Actualiza lista de perfiles';
    $scope.form_Phbusca = 'Consulta tabla de perfiles';
// Function to get employee details from the database
getInfo();
function getInfo(){
// Sending request to EmpDetails.php files 
    $http.post('databaseFiles/empDetails.php').success(function(data){
// Stored the returned data into scope 
    $scope.details = data;
});
}

// Setting default value of gender 
$scope.empInfo = {'gender' : 'male'};
// Enabling show_form variable to enable Add employee button
$scope.show_form = true;
// Function to add toggle behaviour to form
$scope.formToggle =function(){
$('#empForm').slideToggle();
$('#editForm').css('display', 'none');
}
$scope.insertInfo = function(info){
$http.post('databaseFiles/insertDetails.php',{"name":info.name,"email":info.email,"address":info.address,"gender":info.gender}).success(function(data){
if (data == true) {
getInfo();
$('#empForm').css('display', 'none');
}
});
}
$scope.deleteInfo = function(info){
$http.post('databaseFiles/deleteDetails.php',{"del_id":info.emp_id}).success(function(data){
if (data == true) {
getInfo();
}
});
}
$scope.registro = {};
$scope.editInfo = function(info){
$scope.registro = info;
$('#empForm').slideUp();
$('#editForm').slideToggle();
}
$scope.UpdateInfo = function(info){
$http.post('databaseFiles/updateDetails.php',{"id":info.emp_id,"name":info.emp_name,"email":info.emp_email,"address":info.emp_address,"gender":info.emp_gender}).success(function(data){
$scope.show_form = true;
if (data == true) {
getInfo();
}
});
}
$scope.updateMsg = function(emp_id){
$('#editForm').css('display', 'none');
}
}]);