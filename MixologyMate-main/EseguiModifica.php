<?php

include 'Connessione.php';

$nickname=$_POST['nickname'];
$password=$_POST['password'];
$idUtente=$_POST['idUtente'];

$sql="update utenti set nickname='$nickname',password='$password' where idUtente=$idUtente";


$conn->query($sql);


    
header("location:Admin.php");


?>