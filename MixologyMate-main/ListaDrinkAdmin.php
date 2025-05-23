<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | ListaDrink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/ListaDrinkAdmin.css">
</head>
<body>
    <img src="immagini/Logo app.png" alt="">
    <a href="Home.php">Home</a>
    <a href="UploadDrink.php">Aggiungi Drink</a>
</body>
</html>

<?php

include 'Connessione.php';

$sql = "SELECT * FROM drink";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>TempoPreparazione</th>
            <th>Ingredienti</th>
            <th>Descrizione</th>
            <th>IdCreatore</th> 
            <th>ImmagineDrink</th>   
        </tr>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idDrink'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['tempoPreparazione'] . "</td>";
        echo "<td>" . $row['ingredienti'] . "</td>";
        echo "<td>" . $row['descrizione'] . "</td>";
        echo "<td>" . $row['idCreatore'] . "</td>";

        $idImmagine = $row['idImmagine'];

        $stmt = $conn->prepare("SELECT tipo, immagine FROM immaginidrink WHERE idimmagine = ?");
        $stmt->bind_param("i", $idImmagine);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tipo, $immagine);
        $stmt->fetch();

       
        if ($immagine) {
            $immagineBase64 = base64_encode($immagine);
            echo "<td><img src='data:$tipo;base64," . base64_encode($immagine) . "' 
                alt='Immagine del drink' 
                style='width: 150px; height: auto; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.2);'></td>";
        } else {
            echo "<td>Immagine non trovata</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Database vuoto";
}

$conn->close();
?>

