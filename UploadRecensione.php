<?php

include 'Connessione.php';

 session_start();
    
 if (isset($_SESSION['nickname'])) {

$descrizione = $_POST['descrizione'];
$idDrink = $_POST['idDrink'];
$numeroStelle = $_POST['numeroStelle'];
$nickname = $_SESSION['nickname'];



$stmt = $connessione->prepare("INSERT INTO recensioni (descrizione, nicknameCreatore , idDrink, numeroStelle) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis",  $descrizione, $nickname, $idDrink, $numeroStelle);
$stmt->execute();
$stmt->close();

session_start(); 

$_SESSION['banner'] = 1;

header("location: PaginaDrink.php?idDrink=".$idDrink);

$connessione->close();

}else{
    header("location: Login.php");
}
?>