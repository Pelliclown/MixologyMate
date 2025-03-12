<?php

    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "mixologymate";
    session_start();


   

    $connessione = new mysqli($host,$user,$password,$database);

    if($connessione === false){
        die("Errore di connessione : ".$connessione->connect_error);
    }
    $nickname = $_REQUEST['nickname'];
    $password = $_REQUEST['password'];

    if( $nickname=="ciao" and $password==1234){
        header("Location: Admin.php");
    } 
   
    if($sql = "SELECT * FROM gestionepassword WHERE nickname='$nickname' and password = '$password'"){
        echo "Accesso effettuato con successo bentornato ";
        
        $sql = "SELECT idUtente FROM utenti WHERE nickname='$nickname' AND password = '$password'";
        $result = $connessione->query($sql);
        $row = $result->fetch_assoc();

        $idUtente = $row['idUtente']; 

        $_SESSION['idUtente'] = $idUtente;
        header("Location: ListaDrinkLogged.php");
        
    }else{
        echo "Email o password errati , riprova";
    }

    $connessione->close();


?>
