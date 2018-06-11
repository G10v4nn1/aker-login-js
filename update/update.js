myApp.controller("updateData", function($scope, $http, $location){
    $scope.name="";
    $scope.password = "";
    $scope.confirmPassword = "";
    $scope.message = "";
    $scope.updateInfo = function() {
        $http({
            url: "http://localhost/aker-login-js/update/update.php",
            method: "POST",
            data: {"name": $scope.name, "password": $scope.password, "confirmPassword": $scope.confirmPassword}
            }).then(function (data){
            var response = data.data;
            $scope.message = response[1];
        });
    };
    $scope.deleteUser = function(){
        $http.get("http://localhost/aker-login-js/update/deleteuser.php").then(function (data){
            console.log(data);
            var response = data.data;
            $scope.didItDeleted = response[0];
            if($scope.didItDeleted == true){
            $location.path('/');
            }
            
        });
    };
});