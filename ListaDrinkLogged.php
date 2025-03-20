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
            
            
            $stmt = $connessione->prepare("
                SELECT drink.idDrink, drink.creatore, drink.immagine, gestioneDrink.nome, gestioneDrink.descrizione, gestioneDrink.idDrink 
                FROM drink 
                JOIN gestionedrink ON drink.idDrink = gestionedrink.idDrink
            ");
            $stmt->execute();



            echo '<div class="drink-card">';
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<img src='" . $row["immagine"] . "' width='200' style='margin:10px;'><br>";
                    echo '<div class="drink-info">';
                    echo "<h3>" . $row['nome'] . "</h3>";
                    echo "<p class='creator'>Creato da:". $row['creatore'] . "</p>";
                    echo '</div>';
                }
            } else {
                echo "Nessuna immagine trovata.";
            }
            
 
            
        }
    } else {
        echo "Database vuoto";
    }

    $connessione->close();
}else{
    header("location: Login.php");
}

    ?>
</body>
</html>
