<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host,$user,$password,$database);

$nickname =  $connessione->real_escape_string($_POST['nickname']);
$password =  $connessione->real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql_select = "SELECT * FROM gestionepassword WHERE nickname = '$nickname'";
if($result = $connessione->query($sql_select)){
    if($result->num_rows == 1){ //solo se è presente solo una riga
        echo "<script>
            alert('Username già in uso');
            window.location.href = 'Registrazione.php';
            </script>";
            exit;
    }else{
        $sql = "INSERT INTO utenti (email,username,password) VALUES ('$email','$username','$hashed_password')";
        if($result = $connessione->query($sql)){
            echo "Registrazione avvenuta con successo <br>";
            echo "<a href='Login.php'>Vai al login</a>";
        }else{
            echo "Errore durante la registrazione $slq. " . $connessione2->error;
        }
    }
}