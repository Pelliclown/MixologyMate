<?php
  
    include 'Connessione.php';

    session_start();
    
    if (isset($_SESSION['nickname'])) {
        
        $nomeDrink = $_POST['nome'];
        $creatore = $_SESSION['nickname'];
        $descrizione = $_POST['descrizione'];
        
        

    // Cartella in cui salvare le immagini
    $targetDir = "images/";

    // Controlla se la cartella esiste, altrimenti la crea
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Verifica che il file sia stato caricato
    if (isset($_FILES["image"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    
    // Estensioni consentite
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            echo "L'immagine è stata caricata con successo.<br>";

         
           
            $stmt = $connessione->prepare("INSERT INTO drink (creatore, immagine, datacreazione) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $creatore, $targetFilePath, $dataCreazione);
            

            if ($stmt->execute()) {
                $idDrink = $connessione->insert_id;
                echo "Percorso salvato nel database.<br>";
            } else {
                echo "Errore durante il salvataggio nel database: " . $stmt->error;
            }
            $stmt->close();

            $stmt = $connessione->prepare("INSERT INTO gestionedrink (nome, descrizione, idDrink) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi",  $nomeDrink, $descrizione, $idDrink);
            $stmt->execute();
            $stmt->close();

            
            // Mostra l'immagine caricata

            $sql = "SELECT immagine FROM drink WHERE idDrink = ?";
            $stmt = $connessione->prepare($sql);
            $stmt->bind_param("i", $idDrink);
            $stmt->execute();
            $stmt->bind_result($immagine);
            $stmt->fetch();
            $stmt->close();

            echo "<img src='$immagine' alt='Immagine del drink'>";

            ?>

                <a href="ListaDrinkLogged.php" style="text-decoration: none; color:black">Torna alla Home</a>

            <?php
            $connessione->close();
        } else {
            echo "Errore nel caricamento del file.";
        }
    } else {
        echo "Formato file non valido. Sono consentiti solo JPG, JPEG, PNG e GIF.";
    }
        
} else {
    echo "Nessun file selezionato.";
}
   
    }else{
        header("location: Login.php");
}

?>