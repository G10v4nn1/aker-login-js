<?php
    header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');

    include '../includes/validationError.php';
    include '../includes/dbh-inc.php';

    //Vai receber uma entrada de arquivo
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    //esta variavel vai receber o nome do usuário do formulário do site
    $inputName = $request->name;
    $hadUpdates = false;
    //Este bloco recebe o ID
    $queryId = mysqli_query($conn, "SELECT id FROM usuario WHERE nome='".getCookie("CurrentUser")."';");
    $fetchId = mysqli_fetch_assoc($queryId);
    $id = $fetchId['id'];
    //esta condicional impede que nomes vazios ou com uma letra sejam cadastrados
    if($inputName != ""){
        if(strlen($inputName) <= 1){
            validationError("Your name is too short");
            exit;
        } else {
            mysqli_query($conn, "UPDATE perfil SET nome = '".$inputName."' WHERE id = '".$id."';");
            $hadUpdates = true;
        }
    }
    //esta variavel vai receber a senha de usuário do formulário do site
    $inputPassword = $request->password;
    
    $inputConfirmPassword = $request->confirmPassword;
    //esta condicional impede que senhas muito curtas sejam cadastrados
    if($inputPassword != ""){
        if(strlen($inputPassword) < 6){
            validationError("Your password is too short");
            exit;
        } else {
            if($inputPassword == $inputConfirmPassword){
                mysqli_query($conn, "UPDATE usuario SET senha = '".$inputPassword."' WHERE nome = '".getCookie("CurrentUser")."';");
                $hadUpdates = true;
            } else {
                validationError("Passwords does not match");
                exit;
            }
        }
    }
    if($hadUpdates == true){
        $myMsg = array(true, "Updates saved!");
        $response = json_encode($myMsg);
        echo $response;
    } else {
        $myMsg = array(false, "No updates were made");
        $response = json_encode($myMsg);
        echo $response;
    }