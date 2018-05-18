var app = angular.module('signUp', []);

app.controller('signUpControl', function($scope, $http) {
    
    $scope.username = "";
    $scope.name = "";
    $scope.password = "";
    $scope.confirmPassword = "";
    $scope.signup = function(){
    $http({
        url: 'http://localhost/aker-login-js/scripts/sign-up.php',
        method: "POST",
        data: {'username': $scope.username, 'name': $scope.name, 'password': $scope.password, 'confirmPassword': $scope.confirmPassword}
    }).then(function(data) {
        console.log(data);
    });
    };
});