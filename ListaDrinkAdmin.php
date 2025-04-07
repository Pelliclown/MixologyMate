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
$result = $connessione->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ingredienti</th>
            <th>Descrizione</th>
            <th>Creatore</th> 
            <th>ImmagineDrink</th>   
        </tr>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idDrink'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['ingredienti'] . "</td>";
        echo "<td>" . $row['descrizione'] . "</td>";
        echo "<td>" . $row['creatore'] . "</td>";
        echo "<img src='" . $row["immagine"] . "' class='drink-image'><br>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Database vuoto";
}

$connessione->close();
?>

