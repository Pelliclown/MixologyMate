<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];



    $stmt = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($tipo, $immagine);
        $stmt->fetch();

        echo "<img src='data:$tipo;base64," . base64_encode($immagine) . "' 
                alt='Immagine del drink' 
                style='width: 300px; height: auto; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.2);'>";
    } else {
        echo "Immagine non trovata.<br>";
    }
    $stmt->close();

    $stmt = $conn->prepare("SELECT nome, tempoPreparazione, ingredienti, descrizione, idCreatore FROM drink WHERE idImmagine = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nome, $tempoPreparazione, $ingredienti, $descrizione, $idCreatore);
        $stmt->fetch();

        echo "<h2>$nome</h2>";
        echo "<p><strong>Tempo di preparazione:</strong> $tempoPreparazione minuti</p>";
        echo "<p><strong>Ingredienti:</strong> $ingredienti</p>";
        echo "<p><strong>Descrizione:</strong> $descrizione</p>";
        echo "<p><strong>ID Creatore:</strong> $idCreatore</p>";
    } else {
        echo "Informazioni del drink non trovate.";
    }
    $stmt->close();
}

$conn->close();
?>
