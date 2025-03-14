<?php

session_start();

if(isset($_SESSION['nickname'])){


?>

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
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding-bottom: 80px;
        }

        .drink-container {
            width: 90%;
            max-width: 600px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
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

        .review-box {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .review-author {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .review-stars {
            color: #f5c518;
        }

        .review-text {
            font-size: 14px;
            color: #333;
        }

        .review-input-container {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            padding: 10px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .review-select {
            flex: 0 0 auto;
            max-width: 20%;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            background-color: #fafafa;
            margin-right: 10px;
        }


        .review-input {
            flex: 1;
            max-width: 70%;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
        }

        .review-button {
            background-color: #3897f0;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            margin-left: 10px;
        }

        .review-button:hover {
            background-color: #2778b0;
        }

        .back-button {
            background-color: #3897f0;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: bold;
            display: block;
            margin: 15px auto;
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

    echo '<div class="drink-container">';
    echo '  <div class="drink-header">';
    echo "      <span class='creator'>$nickname</span>";
    echo '  </div>';

    $stmtImg = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
    $stmtImg->bind_param("i", $idImmagine);
    $stmtImg->execute();
    $stmtImg->bind_result($tipo, $immagine);
    $stmtImg->fetch();
    $stmtImg->close();

    if ($immagine) {
        $immagineBase64 = base64_encode($immagine);
        echo "<img class='drink-image' src='data:$tipo;base64,$immagineBase64' alt='Immagine del drink'>";
    } else {
        echo "<img class='drink-image' src='immagini/default-drink.jpg' alt='Immagine del drink'>";
    }

    echo '<div class="drink-content">';
    echo "  <h3 class='drink-title'>" . $row['nome'] . "</h3>";
    echo "  <p class='drink-description'>" . $row['descrizione'] . "</p>";
    echo '</div>';

    echo '<div class="drink-info">';
    echo "  <span><strong>Ingredienti:</strong> " . $row['ingredienti'] . "</span>";
    echo "  <span><strong>Tempo:</strong> " . $row['tempoPreparazione'] . " min</span>";
    echo '</div>';

    echo '<button class="back-button" onclick="history.back()">Torna indietro</button>';
    echo '</div>';
} else {
    echo "<h2>Nessun drink trovato</h2>";
}

echo '<div class="reviews-container">';


$stmtRecensioni = $conn->prepare("SELECT descrizione, numeroStelle, idCreatore FROM recensioni WHERE idDrink = ?");
$stmtRecensioni->bind_param("i", $idDrink);
$stmtRecensioni->execute();
$stmtRecensioni->bind_result($descrizione, $numeroStelle, $idCreatoreRec);
$stmtRecensioni->fetch();
$stmtRecensioni->close();

$stmtUserRec = $conn->prepare("SELECT nickname FROM utenti WHERE idUtente = ?");
$stmtUserRec->bind_param("i", $idCreatoreRec);
$stmtUserRec->execute();
$stmtUserRec->bind_result($nicknameRec);
$stmtUserRec->fetch();
$stmtUserRec->close();

echo "<div class='review-box'>";
echo "<div class='review-author'>$nicknameRec</div>";
echo "<div class='review-stars'>" . str_repeat("★", $numeroStelle) . "</div>";
echo "<div class='review-text'>$descrizione</div>";
echo "</div>";



$conn->close();

echo '</div>';
?>

<form class="review-input-container" method="POST" action="UploadRecensione.php">
    <select name="numeroStelle" class="review-select">
        <option value="1">★</option>
        <option value="2">★★</option>
        <option value="3">★★★</option>
        <option value="4">★★★★</option>
        <option value="5">★★★★★</option>
    </select>
    
    <input type="text" class="review-input" placeholder="Scrivi una recensione..." name="descrizione">
    
    <input type="hidden" value="<?php echo $idDrink ?>" name="idDrink">
    <button class="review-button">Pubblica</button>
</form>

</body>
</html>
<?php
}else{
    header("location: Login.php");
}
?>