<?php

    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "mixologymate";

    $connessione = new mysqli($host,$user,$password,$database);

    if($connessione === false){
        die("Errore di connessione : ".$connessione->connect_error);
    }
    $nicknameEmail = $_REQUEST['nicknameEmail'];
    $password = $_REQUEST['password'];

    if( $nicknameEmail=="ciao" and $password==1234){
        header("Location: Admin.php");
    } 
   
    if($sql = "SELECT * FROM persone WHERE email='$nicknameEmail' and password = '$password'"){
        echo "Accesso effettuato con successo bentornato ";
        
    }else{
        echo "Email o password errati , riprova";
    }

    $connessione->close();

?>