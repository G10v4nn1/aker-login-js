var myApp = angular.module('index', ['ngRoute'])
.config(['$routeProvider', function($routeProvider){
    $routeProvider
        .when("/", {
            templateUrl: "views/login.html",
            controller: "loginControl"})
        .when("/signup", {
            templateUrl: "views/signup.html",
            controller: "signUpControl"})
        .when("/profile", {
            templateUrl: "views/profile.html",
            controller: "profileControler"})
        .when("/update", {
        templateUrl: "views/update.html",
        controller: "updateData"});
}]);

myApp.controller("loginControl", function($scope, $http, $location) {
    $scope.name = "";
    $scope.password = "";
    $scope.errorMessage = "";
    $scope.login = function() {
    $http({
        url: 'http://localhost/aker-login-js/scripts/login-system.php',
        method: "POST",
        data: {'username': $scope.name, 'password': $scope.password}
    }).then(function(response) {
        var login = response.data;
        $scope.result = login;
        console.log($scope.result);
        if($scope.result[0] == true){
            $location.path('/profile');
        } else {
            $scope.errorMessage = $scope.result[1];
            console.log($scope.errorMessage);
        }
    });
    };
});

myApp.controller('signUpControl', function($scope, $http, $location) {
    $scope.username = "";
    $scope.name = "";
    $scope.password = "";
    $scope.confirmPassword = "";
    $scope.errorMessage = "";
    $scope.signup = function(){
        $scope.responseFields
    $http({
        url: 'http://localhost/aker-login-js/scripts/sign-up.php',
        method: "POST",
        data: {'username': $scope.username, 'name': $scope.name, 'password': $scope.password, 'confirmPassword': $scope.confirmPassword}
    }).then(function(data) {
        console.log(data);
        var response = data.data;
        $scope.responseFields = response;
        console.log($scope.responseFields[0]);
        if($scope.responseFields[0] == false){
            $scope.errorMessage = $scope.responseFields[1];
            } else {
            $location.path('/');
            }
    });
    };
});

myApp.controller("profileControler", function($scope, $http, $location){
    $scope.id='';
    $scope.name='';
    $scope.creationDate='';
    $scope.lastLogin='';
    $scope.responseFields=[];
    $http.get("http://localhost/aker-login-js/scripts/profile.php").then(function(data){
        var response = data.data;
        $scope.responseFields = response;
        $scope.id = $scope.responseFields['id'];
        $scope.name = $scope.responseFields['name'];
        $scope.creationDate = $scope.responseFields['creationDate'];
        $scope.lastLogin = $scope.responseFields['lastLogin'];
    });
    $scope.logoff = function(){
        $http.get('http://localhost/aker-login-js/scripts/logoff.php').then(function (data){
            console.log(data);
            $scope.response = data.data;
            if($scope.response[0] == true){
                $location.path('/');
            }
        })
    }
});

myApp.controller("updateData", function($scope, $http, $location){
    $scope.name="";
    $scope.password = "";
    $scope.confirmPassword = "";
    $scope.message = "";
    $scope.updateInfo = function() {
        $http({
            url: "http://localhost/aker-login-js/scripts/update.php",
            method: "POST",
            data: {"name": $scope.name, "password": $scope.password, "confirmPassword": $scope.confirmPassword}
            }).then(function (data){
            var response = data.data;
            $scope.message = response[1];
        });
    };
    $scope.deleteUser = function(){
        $http.get("http://localhost/aker-login-js/scripts/deleteuser.php").then(function (data){
            console.log(data);
            var response = data.data;
            $scope.didItDeleted = response[0];
            if($scope.didItDeleted == true){
            $location.path('/');
            }
            
        });
    };
});