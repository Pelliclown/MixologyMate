<?php 

include 'Connessione.php';

if(isset($_GET['idUtente']))
    $idUtente=$_GET['idUtente'];
else
    $idUtente=-1;
$result = $conn->query("select * from utenti where idUtente=".$idUtente);
if(mysqli_num_rows($result)>0){
    $riga=mysqli_fetch_array($result);

?>
<html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
        <link rel="stylesheet" href="style/ModificaUtente.css">
    </head>
    <body>
        
    </body>
    </html>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <h4>Modifica utente</h4>
    <form action="EseguiModifica.php" method="POST">
    <div class="mb-3">
        <input type="hidden" name="idUtente" value="<?php echo $riga['idUtente'] ?>">
        <label for="username" class="form-label">UserName</label>
        <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo $riga['nickname']?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password" value="<?php echo $riga['password']?>">
    </div>
    </div>
    <input type="submit" value="Esegui modifica">
    </form>
</html>


<?php
} 
else{
    header("location:Admin.php");
}
mysqli_close($conn);