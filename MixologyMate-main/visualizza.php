<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Visualizza Drink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/Visualizza.css">
<body>

    <h1>Dettagli Drink</h1>

 

    <?php
    
    include 'Connessione.php';

    session_start();


    if (isset($_SESSION['idUtente'])) {
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
