<?php
$hostName = "localhost";
$dbUser="root";
$dbPassword ="";
$dbName="login-register";
$conn=mysqkli_connect($hostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("something went wrong");
}

?>