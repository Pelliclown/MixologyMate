<?php

include 'Connessione.php';

session_start();

$idDrink = $_GET['idDrink'];

if($_SESSION['banner'] == 1) {
    echo "<script>
        alert('Recensione caricata con successo!');
        window.location.href = 'PaginaDrink.php?idDrink=".$idDrink."';
      </script>";
    $_SESSION['banner'] = 0;
} 
    
if (isset($_SESSION['nickname'])) {
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
    
    $sql = ("
    SELECT * FROM gestionedrink
    JOIN drink ON drink.idDrink = gestionedrink.idDrink 
    WHERE drink.idDrink = ?");

    $stmt = $connessione->prepare($sql);
    $stmt->bind_param("i", $idDrink);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="drink-container">';
            echo '  <div class="drink-header">';
            echo "      <span class='creator'>" . $row['creatore'] . "</span>";
            echo '  </div>';

            echo '<div class="drink-content">';
            echo "<img src='" . $row["immagine"] . "' class='drink-image'><br>";
            echo "  <h3 class='drink-title'>" . $row['nome'] . "</h3>";
            echo "  <p class='drink-description'>" . $row['descrizione'] . "</p>";
            echo '</div>';

            echo '<div class="drink-info">';
            echo "  <span><strong>Ingredienti:</strong> " . $row['ingredienti'] . "</span>";
            echo '</div>';

            echo '<button class="back-button" onclick="window.location.href=\'ListaDrinkLogged.php\'">Torna indietro</button>';

            echo '</div>';
        }
    } else {
        echo "<h2>Nessun drink trovato</h2>";
    }

    echo '<div class="reviews-container">';

    $stmtRecensioni = $connessione->prepare("SELECT descrizione, numeroStelle, nicknameCreatore FROM recensioni WHERE idDrink = ?");
    $stmtRecensioni->bind_param("i", $idDrink);
    $stmtRecensioni->execute();
    $result = $stmtRecensioni->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='review-box'>";
            echo "<div class='review-author'>" . $row['nicknameCreatore'] . "</div>";
            echo "<div class='review-stars'>" . str_repeat("★", $row['numeroStelle']) . "</div>";
            echo "<div class='review-text'>" . $row['descrizione'] . "</div>";
            echo "</div>";
        }
    } else {
        echo "<h2>Nessuna recensione trovata</h2>";
    }

    $stmtRecensioni->close();
    $connessione->close();

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
} else {
    header("location: Login.php");
    exit();
}
?>