var app = angular.module('login', []);

app.controller("loginControl", function($scope, $http) {
    $scope.name = "";
    $scope.password = "";
    $scope.login = function() {
    $http({
        url: 'http://localhost/aker-login-js/scripts/login-system.php',
        method: "POST",
        data: {'username': $scope.name, 'password': $scope.password}
    }).then(function(response) {
        console.log(response);
    });
    };
});