<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Registrazione</title> 
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
            top: 100px;
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
</head>
<body>


    <div>
        <h2>Registrazione</h2>
        <form action="Insert.php" method="POST">
            <input type="text" name="nicknameEmail" placeholder="Nickname/email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Registrati">
        </form>
    </div>


    <a href="Login.php">Hai già un account accedi</a>
</body>
</html>
