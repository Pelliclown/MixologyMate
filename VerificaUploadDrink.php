<?php
  

    session_start();
    
    if (isset($_SESSION['idUtente'])) {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mixologymate";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        if (isset($_POST['submit'])) {
            $nome = $_FILES['immagine']['name'];
            $tipo = $_FILES['immagine']['type'];
            $immagine = file_get_contents($_FILES['immagine']['tmp_name']);

            $nomeDrink = $_POST['nome'];
            $tempoPreparazione = $_POST['tempoNecessario'];
            $ingredienti = $_POST['ingredienti'];
            $descrizione = $_POST['descrizione'];

            $stmt = $conn->prepare("INSERT INTO immaginidrink (nome, tipo, immagine) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $tipo, $immagine);
            
            if ($stmt->execute()) {  
                $idImmagine = $conn->insert_id;  
            } else {
                die("Errore nell'inserimento dell'immagine: " . $stmt->error);
            }

            $idCreatore = $_SESSION['idUtente'];
            
            $stmt = $conn->prepare("INSERT INTO drink (nome, tempoPreparazione, ingredienti, descrizione, idImmagine, idCreatore) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssii",  $nomeDrink, $tempoPreparazione, $ingredienti, $descrizione, $idImmagine, $idCreatore);
            $stmt->execute();

            
            if ($stmt->execute()) {
                echo "Immagine caricata con successo! <br>";
                header ("location: visualizza.php?id=".$idImmagine);
            } else {
                echo "Errore nel caricamento dell'immagine.";
            }

            $stmt->close();
       
        $conn->close();
    }    
    }else{
        header("location: Login.php");
}

?>