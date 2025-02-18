<?php

session_start();

if(isset($_SESSION['idUtente'])){


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | ListaDrink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #fafafa;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .navbar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #3897f0;
        }

        .drink-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px;
            width: 300px;
            padding: 15px;
            transition: transform 0.3s;
        }

        .drink-card:hover {
            transform: scale(1.05);
        }

        .drink-card img {
            width: 100%;
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .drink-info {
            text-align: left;
        }

        .drink-info h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .drink-info p {
            color: #666;
            margin-bottom: 8px;
        }

        .creator {
            font-weight: bold;
            margin-top: 10px;
            color: #3897f0;
        }

        table {
            display: none; 
        }

    </style>
</head>
<body>

    <h1>Lista Drink</h1>

    <div class="navbar">
        <a href="MieCreazioni.php">Le mie creazioni</a>
        <a href="UploadDrink.php">Aggiungi Drink</a>
    </div>

    <?php
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "mixologymate";

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM drink";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idCreatore = $row['idCreatore'];
            $idImmagine = $row['idImmagine'];

            
            $stmt = $conn->prepare("SELECT nickname FROM utenti WHERE idUtente = ?");
            $stmt->bind_param("i", $idCreatore);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($nickname);
            $stmt->fetch();

            
            $stmt = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
            $stmt->bind_param("i", $idImmagine);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($tipo, $immagine);
            $stmt->fetch();

            $idDrink = $row['idDrink'];

            echo '<div class="drink-card">';
            if ($immagine) {
                $immagineBase64 = base64_encode($immagine);
                echo "<a href='PaginaDrink.php?idDrink=" . $idDrink."'>
                        <img src='data:$tipo;base64,$immagineBase64' alt='Immagine del drink'>
                      </a>";
            } else {
                echo "<img src='default-image.jpg' alt='Immagine del drink'>"; 
            }
            

            echo '<div class="drink-info">';
            echo "<h3>" . $row['nome'] . "</h3>";
            echo "<p class='creator'>Creato da: $nickname</p>";
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Database vuoto";
    }

    $conn->close();
}else{
    header("location: Login.php");
}

    ?>
</body>
</html>
