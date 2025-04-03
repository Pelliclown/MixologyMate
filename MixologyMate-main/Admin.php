<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Admin</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/Admin.css">
    <h1>Lista utenti MixologyMate</h1>
</head>
<body>
        <?php
            include 'Connessione.php';

            $sql = "SELECT * FROM utenti";
            $result = $connessione -> query("select * from utenti");
            if($result -> num_rows > 0){

                echo '<table>
                <tr>
                <th>ID</th>
                <th>Nickname/Email</th>
                <th>Password</th>
                <th>numeroDrinkCaricati</th>
                <th>numeroPreferiti</th>
                <th>immagineProfilo</th>
                <th></th>
                <th></th>
                <th></th>     
                </tr>';
                while($row = $result -> fetch_array()){
                    echo "<tr>";
                    echo "<td>".$row['idUtente']."</td>";
                    echo "<td>".$row['nickname']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<td>".$row['numeroDrinkCaricati']."</td>";
                    echo "<td>".$row['numeroPreferiti']."</td>";
                    echo "<td>".$row['immagineProfilo']."</td>";
                    echo "<td><a href='PaginaUtente.php?idUtente=".$row['idUtente']."'>Profilo</a></td>";
                    echo "<td><a href='ModificaUtente.php?idUtente=".$row['idUtente']."'>Modifica</a></td>";
                    echo "<td><a onclick='javascript:return confirm(\"Sei sicuro di volerlo eliminare?\");' href='EliminaUtente.php?idUtente=".$row['idUtente']."'>Elimina</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{
                echo "Database vuoto";
            }
            

        ?>
        <a href="Login.php">Vai al login</a>
</body>
</html>