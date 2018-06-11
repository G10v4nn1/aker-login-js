myApp.config(['$routeProvider', function($routeProvider){
    $routeProvider
        .when("/", {
            templateUrl: "login/login.html",
            controller: "loginControl"})
        .when("/signup", {
            templateUrl: "signup/signup.html",
            controller: "signUpControl"})
        .when("/profile", {
            templateUrl: "profile/profile.html",
            controller: "profileControler"})
        .when("/update", {
        templateUrl: "update/update.html",
        controller: "updateData"});
}]);