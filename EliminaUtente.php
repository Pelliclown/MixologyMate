<?php
include 'Connessione.php';

if (isset($_GET['nickname'])) {
    $nickname = $_GET['nickname'];


    $stmt = $connessione->prepare("DELETE FROM utenti WHERE nickname = ?");
    $stmt->bind_param("s", $nickname);

    if ($stmt->execute()) {
        header("Location: Admin.php");
        exit();
    } else {
        echo "Errore durante l'eliminazione: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Parametro 'nickname' mancante.";
}

$connessione->close();
?>
