<?php

header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');

    include 'includes/validationError.php';
    include 'includes/dbh-inc.php';

        $queryId = mysqli_query($conn, "SELECT id FROM usuario WHERE nome='".$_COOKIE["CurrentUser"]."';");
        $fetchId = mysqli_fetch_assoc($queryId);
        $id = $fetchId['id'];

        mysqli_query($conn, "DELETE FROM usuario WHERE nome='".$_COOKIE['CurrentUser']."';");
        mysqli_query($conn, "DELETE FROM perfil WHERE id='".$id."';");
        
        $myMsg = array(true);
        $response = json_encode($myMsg);
        echo $response;
    
    