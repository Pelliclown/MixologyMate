<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Visualizza Drink</title>
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

        .navbar a:hover {
            color: #3897f0;
        }

        .drink-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px;
            width: 350px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .drink-card:hover {
            transform: scale(1.05);
        }

        .drink-card img {
            width: 100%;
            border-radius: 10px;
            height: 250px;
            object-fit: cover;
            margin-bottom: 15px;
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

        .btn-back {
            background-color: #3897f0;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #2779b3;
        }

    </style>
</head>
<body>

    <h1>Dettagli Drink</h1>

 

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mixologymate";

    session_start();


    if (isset($_SESSION['idUtente'])) {

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        $stmt = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($tipo, $immagine);
            $stmt->fetch();

            echo '<div class="drink-card">';
            echo "<img src='data:$tipo;base64," . base64_encode($immagine) . "' 
                alt='Immagine del drink'>";
        } else {
            echo "Immagine non trovata.<br>";
        }
        $stmt->close();


        $stmt = $conn->prepare("SELECT nome, tempoPreparazione, ingredienti, descrizione, idCreatore FROM drink WHERE idImmagine = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();


        echo $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($nome, $tempoPreparazione, $ingredienti, $descrizione, $idCreatore);
            $stmt->fetch();

            echo '<div class="drink-info">';
            echo "<h3>$nome</h3>";
            echo "<p><strong>Tempo di preparazione:</strong> $tempoPreparazione minuti</p>";
            echo "<p><strong>Ingredienti:</strong> $ingredienti</p>";

            $stmt = $conn->prepare("SELECT nickname FROM utenti WHERE idUtente = ?");
            $stmt->bind_param("i", $idCreatore);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($nickname);
            $stmt->fetch();


            echo "<p><strong>Descrizione:</strong> $descrizione</p>";
            echo "<p class='creator'>Creato da: $nickname</p>";
            echo '</div>';

            echo '</div>';  
        } else {
            echo "Informazioni del drink non trovate.";
        }
        $stmt->close();
    }

    $conn->close();

     } else {
         header("location: Login.php");
    }
    ?>

    <a href="ListaDrinkLogged.php" class="btn-back">Torna ai drink</a>

</body>
</html>
