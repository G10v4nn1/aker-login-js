<?php

header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');

include 'includes/validationError.php';
include 'includes/dbh-inc.php';

    //Vai receber uma entrada de arquivo
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    //esta variavel vai receber o nickname de usuário do formulário do site
    $inputUsername = $request->username;
    //esta condicional impede que usernames como "" ou muito curtos sejam cadastrados
    if(strlen($inputUsername) < 6){
        validationError("Your username is too short");
        exit;
    }
    //esta variavel vai receber o nome do usuário do formulário do site
    $inputName = $request->name;
    //esta condicional impede que nomes vazios ou com uma letra sejam cadastrados
    if(strlen($inputName) <= 1){
        validationError("Your name is too short");
        exit;
    }
    //esta variavel vai receber a senha de usuário do formulário do site
    $inputPassword = $request->password;
    //esta condicional impede que senhas muito curtas sejam cadastrados
    if(strlen($inputPassword) < 6){
        validationError("Your password is too short");
        exit;
    }
    $inputConfirmPassword = $request->confirmPassword;
    //esta variável receberá o resultado de uma query que irá checar se o usuário já existe
    $checkUsernameDisponibility = mysqli_query($conn, "SELECT nome FROM usuario WHERE nome='".$inputUsername."';");
    //se o numero de resultados for maior que 0 esse usuário já existe
    if(mysqli_num_rows($checkUsernameDisponibility) > 0){
        validationError("This username is not available");
        exit;
    //Confere se a senha e a confirmação batem
    } else if ($inputPassword != $inputConfirmPassword){
        validationError("Passwords does not match");
        exit;
    }
    //se o numero de resultados for 0 vai executar uma query que cadastrará o usuário no banco de dados
        else if(mysqli_num_rows($checkUsernameDisponibility) == 0){
        $myMsg = array(true);
        $myResponse = json_encode($myMsg);
        mysqli_query($conn, "INSERT INTO usuario(nome, senha, datacriacao) VALUES ('". $inputUsername ."', '". $inputPassword ."', now());");
        $queryId = mysqli_query($conn, "SELECT id FROM usuario WHERE nome='". $inputUsername ."';");
        $fetchId = mysqli_fetch_assoc($queryId);
        $id = $fetchId['id'];
        mysqli_query($conn, "INSERT INTO perfil(id, nome) VALUES (".$id.", '".$inputName."');");
        echo $myResponse;
    }