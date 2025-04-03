<?php

session_start();

if (isset($_SESSION['nickname'])) {
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Aggiungi Drink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <link rel="stylesheet" href="style/UploadDrink.css">
</head>
<body>

    <h1>Pubblica il tuo Drink</h1>

    <form action="VerificaUploadDrink.php" method="post" enctype="multipart/form-data">
        
        <input type="text" name="nome" placeholder="Nome Drink" required>
        
        <div>
        </div>

        <div>
            <label for="ingredienti">Scegli un ingrediente:</label>
            <select id="ingredienti" name="ingredienti" class="ingredient-select" required>
                <optgroup label="Distillati">
                    <option value="vodka">Vodka</option>
                    <option value="gin">Gin</option>
                    <option value="rum bianco">Rum Bianco</option>
                    <option value="rum scuro">Rum Scuro</option>
                    <option value="tequila">Tequila</option>
                    <option value="whiskey">Whiskey</option>
                </optgroup>
                <optgroup label="Liquori e Amari">
                    <option value="cointreau">Cointreau</option>
                    <option value="baileys">Baileys Irish Cream</option>
                    <option value="campari">Campari</option>
                </optgroup>
                <optgroup label="Succhi e Sciroppi">
                    <option value="succo limone">Succo di Limone</option>
                    <option value="sciroppo zucchero">Sciroppo di Zucchero</option>
                    <option value="sciroppo menta">Sciroppo di Menta</option>
                </optgroup>
                <optgroup label="Bevande e Altri Ingredienti">
                    <option value="soda">Soda</option>
                    <option value="acqua tonica">Acqua Tonica</option>
                    <option value="cola">Cola</option>
                    <option value="birra">Birra</option>
                </optgroup>
            </select>
        </div>

        <input type="text" name="descrizione" placeholder="Descrizione" required>

        <div>
            <label for="immagine">Carica un'immagine del drink:</label>
            <input type="file" name="image" required>
        </div>

        <input type="submit" name="submit" value="Pubblica Drink">

    </form>

    <a href="ListaDrinkLogged.php" class="back-button">Torna alla lista dei drink</a>

</body>
</html>

<?php
} else {
    header("location: Login.php");
}
?>
