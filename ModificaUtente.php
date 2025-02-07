<?php 
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "mixologymate";

$conn = new mysqli($host,$user,$password,$database);

if(isset($_GET['idUtente']))
    $idUtente=$_GET['idUtente'];
else
    $idUtente=-1;
$result = $conn->query("select * from utenti where idUtente=".$idUtente);
if(mysqli_num_rows($result)>0){
    $riga=mysqli_fetch_array($result);

?>
<html>
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
    <style>
        html{
                size: 150%;
                align-items: center;
                background-color: #f0f8ff;
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column; 
                align-items: center; 
                gap: 10px; 
                background-image: url('immagini/Logo\ app.png'); 
                background-size: cover; 
                background-position: center; 
                background-size: 400px  400px;
            }
            form{
                display: flex;
                flex-direction: column;
                gap: 10px;
                top: 100px;
            }
            input{
                padding: 10px;
                border-radius: 10px;
                border: 6px ;
            }

    </style>
</html>


<?php
} 
else{
    header("location:Admin.php");
}
mysqli_close($conn);