myApp.factory("getProfile", function($http) {
    return $http.get("http://localhost/aker-login-js/profile/profile.php")
    .then(function(data){
        return data.data;
    });
});

myApp.factory("logoff", function($http) {
    return $http.get('http://localhost/aker-login-js/profile/logoff.php')
    .then(function (data){
            return data.data;
        });
});

myApp.controller("profileControler", function($scope, $http, $location, getProfile, logoff){
    
    $scope.id=null;
    $scope.name=null;
    $scope.creationDate=null;
    $scope.lastLogin=null;
    
    getProfile.then(function(data){
        $scope.id=data['id'];
        $scope.name=data['name'];
        $scope.creationDate=data['creationDate'];
        $scope.lastLogin=data['lastLogin'];
    });
    
    $scope.logoff = function(){
        logoff.then(function(data){
            if(data[0] == true){
                $location.path('/');
            }
        });
    }
});