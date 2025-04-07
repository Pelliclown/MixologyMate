<?php

include 'Connessione.php';
session_start();

$nickname = $_REQUEST['nickname'];
$userPassword = $_REQUEST['password'];

$stmt = $connessione->prepare("SELECT * FROM utenti WHERE nickname = ?");
$stmt->bind_param("s", $nickname);
$stmt->execute();
$result = $stmt->get_result();  


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row['ban'] == 1) {
        header("Location: Banned.php");
    }else if ($row['ban'] == 0){
        // Verifica della password
        if (password_verify($userPassword, $row['password'])) {
        
            $_SESSION['nickname'] = $nickname;
            header("Location: ListaDrinkLogged.php");
            
        } else {
            echo "<script>
            alert('Credenziali errate!');
            window.history.back();
            </script>";
        }
    }
}
$connessione->close();

?>
