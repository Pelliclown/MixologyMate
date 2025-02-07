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
        header("Content-Type: " . $tipo);
        echo $immagine;
    } else {
        echo "Immagine non trovata.";
    }

    $stmt->close();
}
echo $id;
$conn->close();
?>