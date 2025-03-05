<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host,$user,$password,$database);

if($connessione === false){
    die("Errore di connessione : ".$connessione->connect_error);
}
$sql = "DELETE FROM utenti WHERE idUtente = ".$_GET['idUtente'];

if ($conn->query($sql)===TRUE) {
    header("location:Admin.php");
}
else
{
    echo "Errore durante l'eliminazione: ".$conn->error;
}
?>