<?php 

define("dbServerName", "localhost");
define("dbUsername", "root");
define("dbPassword", "");
define("dbName", "projectakernstalker");

$conn = mysqli_connect(dbServerName, dbUsername, dbPassword, dbName);

function createCookie($name, $value){
	setcookie($name, $value, 0, "/");
}

function getCookie($name){
	return htmlspecialchars($_COOKIE[$name]);
}