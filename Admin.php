<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Admin</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <h1>Lista utenti MixologyMate</h1>
</head>
<style>
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
h1{
    text-align: center;
}
a{
    text-decoration: none;
}
</style>
<body>
        <?php
            $host = "127.0.0.1";
            $user = "root";
            $password = "";
            $database = "mixologymate";
            $connessione = new mysqli($host, $user, $password, $database);

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