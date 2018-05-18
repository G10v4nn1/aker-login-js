<?php
    
    include_once 'includes/dbh-inc.php'; 
    include 'includes/validationError.php';
    header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');

    unset($_COOKIE['CurrentUser']);

    if(!isset($_COOKIE['CurrentUser'])){
    $myMsg = array(true);
    $response = json_encode($myMsg);
    echo $response;
    }