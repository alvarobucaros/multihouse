var app = angular.module('plunker', []);

app.controller('MainCtrl', function($scope) {
  $scope.rma = {};

  var dateVal = '2020-07-02';
  var datePartials = dateVal.split("-");
  var dateModel = new Date(datePartials[0], datePartials[1] - 1, datePartials[2]);
  console.log(dateModel);
  $scope.rma.purchaseDate = dateModel;
});