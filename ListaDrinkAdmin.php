<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | ListaDrink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
</head>
<style>
    img{
        width: 100px;
        height: auto;
    }
    a{
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        top: 100%;
    }
    body{
        text-align: center;
    }
    table {
        width: 100%; 
        border-collapse: collapse;
        border-radius: 20px;
    }
    th, td {
        border: 1px solid black; 
        padding: 10px; 
        text-align: left; 
    }
    th {
        background-color:hsl(189, 100.00%, 53.50%);
    }
    td{
        background-color:rgb(255, 10, 10);
    }
</style>
<body>
    <img src="immagini/Logo app.png" alt="">
    <a href="Home.php">Home</a>
    <a href="UploadDrink.php">Aggiungi Drink</a>
</body>
</html>

<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

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

