var profile = angular.module("profilePage", []);

profile.controller("profileControler", function($scope, $http){
    $scope.id='';
    $scope.creationDate='';
    $scope.responseFields=[];
    $http.get("http://localhost/aker-login-js/scripts/profile.php").then(function(data){
        var response = data.data;
        $scope.responseFields = response;
        $scope.id = $scope.responseFields['id'];
        $scope.creationDate = $scope.responseFields['creationDate'];
    });
});