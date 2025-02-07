<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Accedi</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <style>

        body{
            size: 150%;
            align-items: center;
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; 
            align-items: center; 
            gap: 10px; 
            background-image: url('immagini/Logo\ app.png'); 
            background-size: cover; 
            background-position: center; 
            background-size: 400px  400px;
        }
        form{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        a {
            text-decoration: none;
        }
        input{
            padding: 10px;
            border-radius: 10px;
            border: 6px ;
        }
</style>

    </style>
    
</head>
<body>

    <div>
        <h2>Accedi</h2>
        <form action="VerificaLogin.php" method="POST">
            <input type="Nickname/Email" name="nicknameEmail" placeholder="nicknameEmail" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" value="Login">
        </form>
    </div>

    
    <a href="Registrazione.php">Non hai un account registrati</a>
</body>
</html>
