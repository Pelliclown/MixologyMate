<?php

include 'Connessione.php';

session_start();

if (isset($_SESSION['nickname'])) {
    $nicknameUtente = $_SESSION['nickname'];
    $nickname = $_GET['nickname']; 
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

<?php
    if ($nickname == $nicknameUtente) {
    echo "<h1>Il tuo profilo</h1>";
    } else {
    echo "<h1>Profilo di " . htmlspecialchars($nickname) . "</h1>";
    }
?>
    <div class="drink-grid">
        <?php

        $sql = "SELECT *
                FROM drink 
                JOIN gestioneDrink ON drink.idDrink = gestioneDrink.idDrink
                WHERE drink.creatore = ?";
        $stmt = $connessione->prepare($sql);
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='PaginaDrink.php?idDrink=" . $row["idDrink"] . "' class='drink-link'>";
                echo '<div class="drink-card">';
                echo "<img src='" . htmlspecialchars($row["immagine"]) . "' width='200' alt='Drink Image'>";
                echo '<div class="drink-info">';
                echo "<h3 style='margin-top: 10px;'>" . htmlspecialchars($row['nome']) . "</h3>";
                echo "<p class='creator'>Creato da: " . htmlspecialchars($row['creatore']) . "</p>";
                echo '</div>';
                echo '</div>';
                echo "</a>";
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
