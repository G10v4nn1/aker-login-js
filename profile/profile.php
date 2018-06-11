<?php
    header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');

    include '../includes/validationError.php';
    include '../includes/dbh-inc.php';
    
    //Esta variável vai acessar os cookies e armazenar o nome de usuário
    $currentUser = getCookie("CurrentUser");
    //Esta sessão pega a tabela referente ao usuário, dá fetch em sua data de criação e armazena na variável para o JSON
    $getCreationDate = mysqli_query($conn, "SELECT datacriacao FROM usuario WHERE nome='".$currentUser."';");
    $fetchCreationDate = mysqli_fetch_assoc($getCreationDate);
    $creationDate = $fetchCreationDate['datacriacao'];
    //Esta sessão pega a tabela referente ao usuário, dá fetch em seu id e armazena na variável para o JSON
    $getId = mysqli_query($conn, "SELECT id FROM usuario WHERE nome='".$currentUser."';");
    $fetchId = mysqli_fetch_assoc($getId);
    $id = $fetchId['id'];
    //Esta sessão pega a tabela referente ao usuário, dá fetch em seu ultimo login e armazena na variável para o JSON
    $getLastLogin = mysqli_query($conn, "SELECT datalogin FROM usuario WHERE nome='".$currentUser."';");
    $fetchLastLogin = mysqli_fetch_assoc($getLastLogin);
    $lastLogin = $fetchLastLogin['datalogin'];
    
    $getName = mysqli_query($conn, "SELECT nome FROM perfil WHERE id='".$id."';");
    $fetchName = mysqli_fetch_assoc($getName);
    $name = $fetchName['nome'];
    //Este comando vai atualizar o ultimo login
    
    $JSONMessage = new \stdClass();
    $JSONMessage->id = $id;
    $JSONMessage->name = $name;
    $JSONMessage->creationDate = $creationDate;
    $JSONMessage->lastLogin = $lastLogin;
    $response = json_encode($JSONMessage);
    echo $response;

mysqli_query($conn, "UPDATE usuario SET datalogin = now() WHERE nome='".$currentUser."';");


    