<?php

include 'Connessione.php';

$sql = "DELETE FROM utenti WHERE idUtente = ".$_GET['idUtente'];

if ($conn->query($sql)===TRUE) {
    header("location:Admin.php");
}
else
{
    echo "Errore durante l'eliminazione: ".$conn->error;
}
?>