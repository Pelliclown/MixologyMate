<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Conferma Registrazione</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/ControlloRegistrazione.css">
</head>
<body>

<?php
include 'Connessione.php';

$nickname = $_REQUEST['nickname'];
$password = $_REQUEST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql_select = "SELECT * FROM utenti WHERE nickname = '$nickname'";
if($result = $connessione->query($sql_select)){
    if($result->num_rows == 1){ //solo se è presente solo una riga
        echo "<script>
            alert('Username già in uso');
            window.history.back();
            </script>";
            exit;
    }else{
        $sql = "INSERT INTO utenti (nickname,password) VALUES ('$nickname','$hashed_password')";
        if($result = $connessione->query($sql)){
            ?>
        <html>
            <h2>Registrazione avvenuta con successo</h2>
            <h2><?php $nickname ?></h2>
        </html>
        <a href="Login.php">fai l'accesso per entrare nel tuo account</a>
        <?php

        }else{
            echo "Errore durante la registrazione $slq. " . $connessione2->error;
        }
    }
}