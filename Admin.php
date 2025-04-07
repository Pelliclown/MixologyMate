<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Admin</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/Admin.css">
</head>
<body>
    <h1>Lista utenti MixologyMate</h1>

    <?php
        include 'Connessione.php';

        $sql = "SELECT * FROM utenti";
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>
                <tr>
                    <th>Nickname</th>
                    <th>Password</th>
                    <th>Drink Caricati</th>
                    <th>Preferiti</th>
                    <th>Immagine Profilo</th>
                    <th>Ban</th>
                    <th>Profilo</th>
                    <th>Elimina</th>
                </tr>';
            while ($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nickname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                echo "<td>" . $row['numeroDrinkCaricati'] . "</td>";
                echo "<td>" . $row['numeroPreferiti'] . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['immagineProfilo']) . "' alt='Profilo' class='profile-img'></td>";
                echo "<td><a href='Ban.php?nickname=" . urlencode($row['nickname']) . "' class='btn delete' onclick='return confirm(\"Sei sicuro di volerlo bannare?\")'>Ban</a></td>";
                echo "<td><a href='PaginaProfilo.php?nickname=" . urlencode($row['nickname']) . "' class='btn'>Profilo</a></td>";
                echo "<td><a href='EliminaUtente.php?nickname=" . urlencode($row['nickname']) . "' class='btn delete' onclick='return confirm(\"Sei sicuro di volerlo eliminare?\")'>Elimina</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='empty'>Nessun utente trovato nel database.</p>";
        }
    ?>

    <div class="footer">
        <a href="Login.php" class="btn back">Vai al login</a>
    </div>
</body>
</html>
