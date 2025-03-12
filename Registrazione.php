<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Registrazione</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            width: 100px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .site-name {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        input[type="text"], input[type="password"] {
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #ddd;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            padding: 12px;
            background-color: #3897f0;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2779b3;
        }

        a {
            text-decoration: none;
            color: #3897f0;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s;
        }

        a:hover {
            color: #2779b3;
        }

        .register-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="image-container">
            <img src="immagini/Logo app schede.png" alt="Logo MixologyMate">
            <div class="site-name">MixologyMate</div>
        </div>

        <h2>Registrazione</h2>
        <form action="Insert.php" method="POST">
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
