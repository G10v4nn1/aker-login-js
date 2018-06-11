<?php

    include_once '../includes/dbh-inc.php'; 
    include '../includes/validationError.php';
    header('Access-Control-Allow-Origin: http://localhost/aker-login-js/');
    //Vai receber uma entrada de arquivo
    $postdata = file_get_contents("php://input");
    //Aqui decodificamos o JSON recebido pela tela de login
    $request = json_decode($postdata);
    //recebe o nome inserido no campo usu�rio e armazena nesta vari�vel
    $inputUsername = $request->username;
    //recebe o nome de usu�rio do database usando como base o username inserido no campo de login
    $DBUsername = mysqli_query($conn, "SELECT nome FROM usuario WHERE nome='" . $inputUsername . "'");
     /*conta o numero de resultados obtidos na requisi��o sql:
    Se o username n�o existir = sem resultados.
    Se ele existir = um resultado*/
    $DBUsernameResult = mysqli_fetch_assoc($DBUsername);
    $UsernameResultCheck = mysqli_num_rows($DBUsername);
       //se houver um resultado 
       if($UsernameResultCheck > 0){
        //recebe a senha no campo senha enviado pelo JS e armazena nessa vari�vel
         $inputPassword = $request->password;
        //Procura a senha do usu�rio usando como base o nome de usu�rio.
        $DBPassword = mysqli_query($conn, "SELECT senha FROM usuario WHERE nome='" . $inputUsername . "'");
        //Faz uma Fetch no banco de dados pela senha
        $DBPasswordResult = mysqli_fetch_assoc($DBPassword);
        //Compara as senhas
        //Se a senha for correta
           if($inputPassword == $DBPasswordResult['senha']){
               //Emite um JSON com o resultado TRUE, atestando que a senha � correta
               $loginResult = array('correctPassword' => true);
               $loginResultJSON = json_encode($loginResult);
               createCookie("CurrentUser", $inputUsername);
               echo $loginResultJSON;
            //Caso contrario chama o metodo Validation Error e informa que a senha � incorreta
           } else {
               validationError("Incorrect password");
           }
           //Se o usu�rio n�o existir, chama o metodo ValidationError e informa que o usu�rio n�o existe
       } else {
           validationError("User don't exists");
           
       }
?>