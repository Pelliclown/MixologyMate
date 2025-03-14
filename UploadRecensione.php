<?php
 session_start();
    
 if (isset($_SESSION['nickname'])) {

$descrizione = $_POST['descrizione'];
$idDrink = $_POST['idDrink'];
$numeroStelle = $_POST['numeroStelle'];
$idUtente = $_SESSION['idUtente'];


$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO recensioni (descrizione, idCreatore, idDrink, numeroStelle) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siis",  $descrizione, $idUtente, $idDrink, $numeroStelle);
$stmt->execute();
$stmt->close();
   
header("location: PaginaDrink.php?idDrink=".$idDrink);

}else{
    header("location: Login.php");
}
?>