<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Registrazione</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/Registrazione.css">
</head>
<body>

    <div class="container">
        <div class="image-container">
            <img src="immagini/Logo app schede.png" alt="Logo MixologyMate">
            <div class="site-name">MixologyMate</div>
        </div>

        <h2>Registrazione</h2>
        <form action="ControlloRegistrazione.php" method="POST">
            <input type="text" name="nickname" placeholder="Nickname" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Registrati">
        </form>

        <div class="register-link">
            <a href="Login.php">Hai già un account? Accedi</a>
        </div>
    </div>
    

</body>
</html>
