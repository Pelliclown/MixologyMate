<?php

include 'Connessione.php';

 session_start();
    
 if (isset($_SESSION['nickname'])) {

$descrizione = $_POST['descrizione'];
$idDrink = $_POST['idDrink'];
$numeroStelle = $_POST['numeroStelle'];
$idUtente = $_SESSION['idUtente'];



$stmt = $conn->prepare("INSERT INTO recensioni (descrizione, idCreatore, idDrink, numeroStelle) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siis",  $descrizione, $idUtente, $idDrink, $numeroStelle);
$stmt->execute();
$stmt->close();
   
header("location: PaginaDrink.php?idDrink=".$idDrink);

}else{
    header("location: Login.php");
}
?>