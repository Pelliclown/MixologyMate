<?php

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host, $user, $password, $database);


$nickname=$_POST['nickname'];
$password=$_POST['password'];
$idUtente=$_POST['idUtente'];

$sql="update utenti set nickname='$nickname',password='$password' where idUtente=$idUtente";


$conn->query($sql);


    
header("location:Admin.php");


?>