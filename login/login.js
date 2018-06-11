myApp.controller("loginControl", function($scope, $http, $location) {
    $scope.name = "";
    $scope.password = "";
    $scope.errorMessage = "";
    $scope.login = function() {
    $http({
        url: 'http://localhost/aker-login-js/login/login-system.php',
        method: "POST",
        data: {'username': $scope.name, 'password': $scope.password}
    }).then(function(response) {
        var login = response.data;
        $scope.result = login;
        console.log($scope.result);
        if($scope.result['correctPassword'] == true){
            $location.path('/profile');
        } else {
            $scope.errorMessage = $scope.result[1];
            console.log($scope.errorMessage);
        }
    });
    };
});