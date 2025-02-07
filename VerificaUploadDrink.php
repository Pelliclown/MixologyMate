<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nome = $_FILES['immagine']['name'];
    $tipo = $_FILES['immagine']['type'];
    $immagine = file_get_contents($_FILES['immagine']['tmp_name']);

    $nomeDrink = $_POST['nome'];
    $tempoPreparazione = $_POST['tempoNecessario'];
    $ingredienti = $_POST['ingredienti'];
    $descrizione = $_POST['descrizione'];

    $stmt = $conn->prepare("INSERT INTO immaginidrink (nome, tipo, immagine) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $tipo, $immagine);
    $idImmagine = $conn->insert_id;


    
    $stmt = $conn->prepare("INSERT INTO drink (nome, tempoPreparazione, ingredienti, descrizione, idImmagine) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi",  $nomeDrink, $tempoPreparazione, $ingredienti, $descrizione, $idImmagine);
    $stmt->execute();

    
    if ($stmt->execute()) {
        echo "Immagine caricata con successo! <br>";
        echo "<img src='visualizza.php?id=" . $conn->insert_id . "' width='300px'>";
    } else {
        echo "Errore nel caricamento dell'immagine.";
    }

    $stmt->close();
}

$conn->close();
?>