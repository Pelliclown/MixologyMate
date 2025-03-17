<?php

include 'Connessione.php';

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
    <link rel="stylesheet" href="style/PaginaDrink.css">
</head>
<body>

<?php
$idDrink = $_GET['idDrink'];


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