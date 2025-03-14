<?php
  

    session_start();
    
    if (isset($_SESSION['nickname'])) {
        
    // Connessione al database
    $host = "localhost";
    $user = "root"; 
    $password = ""; 
    $database = "mixologymate";

    $conn = new mysqli($host, $password, $password, $database);

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

         

            // Controllo connessione
            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }

            // Query per salvare il percorso nel database
            $stmt = $conn->prepare("INSERT INTO images (img_dir) VALUES (?)");
            $stmt->bind_param("s", $targetFilePath);

            if ($stmt->execute()) {
                echo "Percorso salvato nel database.<br>";
            } else {
                echo "Errore durante il salvataggio nel database: " . $stmt->error;
            }

            $stmt->close();

            // Mostra tutte le immagini caricate
            echo "<h2>Galleria Immagini</h2>";

            $sql = "SELECT img_dir FROM images";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<img src='" . $row["img_dir"] . "' width='200' style='margin:10px;'><br>";
                }
            } else {
                echo "Nessuna immagine trovata.";
            }

            $conn->close();
        } else {
            echo "Errore nel caricamento del file.";
        }
    } else {
        echo "Formato file non valido. Sono consentiti solo JPG, JPEG, PNG e GIF.";
    }
} else {
    echo "Nessun file selezionato.";
}





        $idCreatore = $_SESSION['nickname'];
        
        $stmt = $conn->prepare("INSERT INTO drink (nome, nickname, Immagine, datareazione) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi",  $nomeDrink, $nickname, $Immagine, $datareazione);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        
     }else{
         header("location: Login.php");
}

?>