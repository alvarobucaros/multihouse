var angularTodo = angular.module('lostsysApp', []);
 
function mainController($scope, $http) {
    $scope.names = [ ];
 
    $http.get('model.php')
            .success(function(data) {
                    $scope.names = eval(data);
                    console.log(data)
                })
            .error(function(data) {
                    console.log('Error: ' + data);
            });
 
    $scope.addNom = function() {
        $http.post('model.php', { op: 'append', nom: $scope.nom, telefon: $scope.telefon } )
                .success(function(data) {
                        $scope.names = eval(data);
                        console.log(data)
                    })
                .error(function(data) {
                        console.log('Error: ' + data);
                });
 
        $scope.nom="";
        $scope.telefon="";
        }
 
    $scope.delNom = function( nom ) {
        if ( confirm("Seguro?") ) {
            $http.post('model.php', { op: 'delete', nom: nom } )
                .success(function(data) {
                        $scope.names = eval(data);
                        console.log(data)
                    })
                .error(function(data) {
                        console.log('Error: ' + data);
                });
            }
        }
 
    }