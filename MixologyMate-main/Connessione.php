<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "mixologymate";
$port = "3307";

$connessione = new mysqli($host,$user,$password,$database,$port);

if($connessione === false){
    die("Errore di connessione : ".$connessione->connect_error);
}

?>