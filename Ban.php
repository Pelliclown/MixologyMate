<?php
include 'Connessione.php';

if (isset($_GET['nickname'])) {
    $nickname = $_GET['nickname'];


    $stmt = $connessione->prepare("UPDATE utenti SET ban = 1 WHERE nickname = ?");
    $stmt->bind_param("s", $nickname);

    if ($stmt->execute()) {
        header("Location: Admin.php");
        exit();
    } else {
        echo "Errore durante il ban: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Parametro 'nickname' mancante.";
}

$connessione->close();
?>
