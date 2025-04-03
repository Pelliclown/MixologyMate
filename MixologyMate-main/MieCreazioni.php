<?php

include 'Connessione.php';

session_start();

if (isset($_SESSION['nickname'])) {
    $nickname = $_SESSION['nickname']; 

    $sql = "SELECT drink.idDrink, drink.creatore, drink.immagine, gestioneDrink.nome, gestioneDrink.descrizione 
    FROM drink 
    JOIN gestioneDrink ON drink.idDrink = gestioneDrink.idDrink
    WHERE mickname = $nickname";

 ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Profilo di <?php echo htmlspecialchars($nickname); ?></title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/MieCreazioni.css">
</head>
<body>

    <h1>Profilo di <?php echo htmlspecialchars($nickname); ?></h1>

    <div class="drink-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $idDrink = $row['nickname'];
                $immagine = $row['immagine'];
                $tipo = $row['tipo'];

                echo '<div class="drink-card">';
                if ($immagine) {
                    $immagineBase64 = base64_encode($immagine);
                    echo "<a href='PaginaDrink.php?idDrink=" . $idDrink . "'>
                            <img src='data:$tipo;base64,$immagineBase64' alt='Immagine del drink'>
                          </a>";
                } else {
                    echo "<img src='default-image.jpg' alt='Immagine del drink'>";
                }

                echo '<div class="drink-info">';
                echo "<h3>" . htmlspecialchars($row['nome']) . "</h3>";
                echo '<p class="creator">Creato da: ' . htmlspecialchars($nickname) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Nessun drink trovato.</p>";
        }
        ?>
    </div>

</body>
</html>
<?php
} else {
    header("location: Login.php");
}
?>
