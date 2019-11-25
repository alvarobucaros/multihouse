var app = angular.module('app', []);
app.controller('mainController',['$scope','$http', function($scope,$http){
    $scope.form_title1 = 'Multi';
    $scope.form_title2 = 'House';
    $scope.form_subTitle = 'Sistema Administrativo de Conjuntos';
    $scope.form_btnRegresa = 'Al Menú';
    $scope.form_titulo     = 'Documentos y videos disponibles';
}]);

$(document).ready(function(){
   $("a.external").click(function() {
      url = $(this).attr("href");
      window.open(url, '_blank');
       window.open("../documentation/Generalidades.pdf", "windowName", windowOptions);
      return false;
   });
});