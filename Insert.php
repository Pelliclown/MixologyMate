<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Conferma Registrazione</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
</head>
<body>
    
</body>
</html>
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


    $sql = "INSERT INTO utenti (nickname, password) VALUES (?,?)";

    if($statement = $connessione->prepare($sql)){
        ($statement->bind_param("ss", $nicknameEmail, $password));

        $nicknameEmail;
        $password;
   
        $statement->execute();
        

        ?>
        <html>
            <h2>Registrazione avvenuta con successo</h2>
        </html>
        <a href="Login.php">fai l'accesso per entrare nel tuo account</a>
        <?php

    }else{
        echo "Errore durante l'inserimento, registrazione non avvenuta con successo ". $connessione->error;
    }

    
    $statement->close();

    $connessione->close();

?>
<style>
    a{
        text-decoration: none;
        align-items: center;
    }
    h2{
        color: black;
        text-align: center;
    }
    html{
        text-align: center;
        background-image: url('immagini/Logo\ app.png'); 
            background-size: cover; 
            background-size: 400px  400px;
            background-repeat: no-repeat;
            background-position: center 100px;
    }
</style>
