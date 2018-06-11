myApp.controller('signUpControl', function($scope, $http, $location) {
    $scope.username = null;
    $scope.name = null;
    $scope.password = null;
    $scope.confirmPassword = null;
    $scope.errorMessage = null;
    $scope.signup = function(){
        $scope.responseFields
    $http({
        url: 'http://localhost/aker-login-js/signup/sign-up.php',
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

    $scope.$watch('confirmPassword', function(){
        if($scope.confirmPassword != null){
            console.log("confirm password not null anymore");
            $scope.comparePasswords();
        }
    });
});