<?php

include 'Connessione.php';

session_start();

if(isset($_SESSION['nickname'])){
$_SESSION['banner'] = 0;

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | ListaDrink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/ListaDrinkLogged.css">
</head>
<body>

    <h1>Lista Drink</h1>

    <div class="navbar">
        <a href="MieCreazioni.php">Le mie creazioni</a>
        <a href="UploadDrink.php">Aggiungi Drink</a>
    </div>

    <?php

$sql = "SELECT drink.idDrink, drink.creatore, drink.immagine, gestioneDrink.nome, gestioneDrink.descrizione 
FROM drink 
JOIN gestioneDrink ON drink.idDrink = gestioneDrink.idDrink";

$result = $connessione->query($sql);

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
echo "Nessun drink trovato.";
}

    $connessione->close();
}else{
    header("location: Login.php");
}

    ?>
</body>
</html>
