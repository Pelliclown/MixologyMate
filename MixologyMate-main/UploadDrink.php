<?php
session_start();

if (isset($_SESSION['idUtente'])) {
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Aggiungi Drink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #fafafa;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        input, select {
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        select {
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #3897f0;
            color: white;
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2779b3;
        }

        label {
            font-size: 1rem;
            color: #666;
            font-weight: bold;
        }

        .ingredient-select {
            width: 100%;
            font-size: 1rem;
        }

        .ingredient-select optgroup {
            font-weight: bold;
        }

        .ingredient-select option {
            padding: 8px;
        }

        .back-button {
            margin-top: 20px;
            text-decoration: none;
            color: #3897f0;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #2779b3;
        }
    </style>
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
            <input type="file" name="immagine" required>
        </div>

        <input type="submit" name="submit" value="Pubblica Drink">

    </form>

    <a href="ListaDrink.php" class="back-button">Torna alla lista dei drink</a>

</body>
</html>

<?php
} else {
    header("location: Login.php");
}
?>
