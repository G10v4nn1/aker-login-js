<?php

function validationError($message){
    $myMsg = array(false, "");
    $myMsg[1] = $message;
    $myResponse = json_encode($myMsg);
    echo $myResponse;
}