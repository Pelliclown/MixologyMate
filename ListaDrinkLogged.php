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

    $sql = "SELECT * FROM drink";
    $result = $connessione->query($sql);

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
