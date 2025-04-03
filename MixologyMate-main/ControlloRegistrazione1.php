<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Conferma Registrazione</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
</head>
<body>
    

<?php

    include 'Connessione.php';

    $nickname = $_REQUEST['nickname'];
    $password = $_REQUEST['password'];


    $sql = "INSERT INTO utenti (nickname, password) VALUES (?,?)";

    if($statement = $connessione->prepare($sql)){
        ($statement->bind_param("ss", $nickname, $password));

        $nickname;
        $password;
   
        $statement->execute();
        

        ?>
        <html>
            <h2>Registrazione avvenuta con successo</h2>
            <h2><?php $nickname ?></h2>
        </html>
        <a href="Login.php">fai l'accesso per entrare nel tuo account</a>
        <?php

    }else{
        echo "Errore durante l'inserimento, registrazione non avvenuta con successo ". $connessione->error;
    }

    
    $statement->close();

    $connessione->close();

?>
</body>
</html>
<style>
    a{
        text-decoration: none;
        color: #3897f0;
        font-weight: bold;
        font-size: 1rem;
        transition: color 0.3s;
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
            background-color: #f0f8ff;
    }
    body {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            
        }
</style>
