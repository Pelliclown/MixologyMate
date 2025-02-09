<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Dettagli Drink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .drink-container {
            width: 90%;
            max-width: 600px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .drink-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .creator {
            font-weight: bold;
            margin-left: 10px;
        }

        .drink-content {
            display: flex;
            flex-direction: column;
        }

        .drink-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .drink-details {
            padding: 15px;
        }

        .drink-title {
            font-size: 20px;
            font-weight: bold;
        }

        .drink-description {
            margin: 10px 0;
            font-size: 14px;
            color: #555;
        }

        .drink-info {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #ddd;
            padding: 10px 15px;
        }

        .back-button {
            background-color: #3897f0;
            color: white;
            border: none;
            padding: 10px 20px;  
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
            margin: 15px;
            width: 50%;  
            margin-left: auto;
            margin-right: auto;
        }

        .back-button:hover {
            background-color: #2778b0;
        }
    </style>
</head>
<body>

<?php
$idDrink = $_GET['idDrink'];

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "SELECT * FROM drink WHERE idDrink = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idDrink);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idCreatore = $row['idCreatore'];
    $idImmagine = $row['idImmagine'];

    $stmtUser = $conn->prepare("SELECT nickname FROM utenti WHERE idUtente = ?");
    $stmtUser->bind_param("i", $idCreatore);
    $stmtUser->execute();
    $stmtUser->bind_result($nickname);
    $stmtUser->fetch();
    $stmtUser->close();

    $stmtImg = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
    $stmtImg->bind_param("i", $idImmagine);
    $stmtImg->execute();
    $stmtImg->store_result();
    $stmtImg->bind_result($tipo, $immagine);
    $stmtImg->fetch();
    $stmtImg->close();

    echo '<div class="drink-container">';
    echo '  <div class="drink-header">';
    echo "      <span class='creator'>$nickname</span>";
    echo '  </div>';

    echo '<div class="drink-content">';
    if ($immagine) {
        $immagineBase64 = base64_encode($immagine);
        echo "<img class='drink-image' src='data:$tipo;base64,$immagineBase64' alt='Immagine del drink'>";
    } else {
        echo "<img class='drink-image' src='default-image.jpg' alt='Immagine del drink'>";
    }

    echo '<div class="drink-details">';
    echo "  <h3 class='drink-title'>" . $row['nome'] . "</h3>";
    echo "  <p class='drink-description'>" . $row['descrizione'] . "</p>";
    echo '</div>';

    echo '<div class="drink-info">';
    echo "  <span><strong>Ingredienti:</strong> " . $row['ingredienti'] . "</span>";
    echo "  <span><strong>Tempo:</strong> " . $row['tempoPreparazione'] . " min</span>";
    echo '</div>';

    echo '<button class="back-button" onclick="history.back()">Torna indietro</button>';

    echo '</div>';
    echo '</div>';
} else {
    echo "<h2>Nessun drink trovato</h2>";
}

$conn->close();
?>

</body>
</html>
