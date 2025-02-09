<?php

session_start();

if (isset($_SESSION['idUtente'])) {



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MixologyMate | Aggiungi Drink</title>
    <link rel="icon" type="image/png" href="immagini/Logo app schede.png">
</head>
<body>
<form action="VerificaUploadDrink.php" method="post" enctype="multipart/form-data">  
    <h1>Pubblica il tuo Drink</h1>
    <input type="nome" name="nome" placeholder="Nome Drink" required>
    <label for="tempoNecessario" >Tempo necessario:</label>
    <select id="tempoNecessario" name="tempoNecessario" placeholder="Tempo necessario" required>
        <option value="2-3 Minuti">2-3 Minuti</option>
        <option value="3-4 Minuti">3-4 Minuti</option>
        <option value="5-6 Minuti">5-6 Minuti</option>
        <option value="7-8 Minuti">7-8 Minuti</option>
        <option value="9-10 Minuti">9-10 Minuti</option>
    </select>
    <label for="ingredienti" >Scegli un ingrediente:</label>
<select id="ingredienti" name="ingredienti" placeholder="Ingrediente" required>
    <optgroup label="Distillati">
        <option value="vodka">Vodka</option>
        <option value="gin">Gin</option>
        <option value="rum bianco">Rum Bianco</option>
        <option value="rum scuro">Rum Scuro</option>
        <option value="rum speziato">Rum Speziato</option>
        <option value="tequila">Tequila</option>
        <option value="tequila blanco">Tequila Blanco</option>
        <option value="tequila reposado">Tequila Reposado</option>
        <option value="tequila añejo">Tequila Añejo</option>
        <option value="whiskey">Whiskey</option>
        <option value="bourbon">Bourbon</option>
        <option value="scotch">Scotch Whisky</option>
        <option value="irish whiskey">Irish Whiskey</option>
        <option value="rye whiskey">Rye Whiskey</option>
        <option value="brandy">Brandy</option>
        <option value="cognac">Cognac</option>
        <option value="armagnac">Armagnac</option>
        <option value="grappa">Grappa</option>
        <option value="pisco">Pisco</option>
        <option value="mezcal">Mezcal</option>
        <option value="aquavit">Aquavit</option>
    </optgroup>

    <optgroup label="Liquori e Amari">
        <option value="triple sec">Triple Sec</option>
        <option value="cointreau">Cointreau</option>
        <option value="grand marnier">Grand Marnier</option>
        <option value="curaçao blu">Curaçao Blu</option>
        <option value="curaçao arancione">Curaçao Arancione</option>
        <option value="amaretto">Amaretto</option>
        <option value="sambuca">Sambuca</option>
        <option value="anisetta">Anisetta</option>
        <option value="baileys">Baileys Irish Cream</option>
        <option value="kahlua">Kahlúa</option>
        <option value="frangelico">Frangelico</option>
        <option value="chartreuse verde">Chartreuse Verde</option>
        <option value="chartreuse gialla">Chartreuse Gialla</option>
        <option value="liquore strega">Liquore Strega</option>
        <option value="maraschino">Maraschino</option>
        <option value="drambuie">Drambuie</option>
        <option value="benedictine">Benedictine</option>
        <option value="cherry heering">Cherry Heering</option>
        <option value="campari">Campari</option>
        <option value="aperol">Aperol</option>
        <option value="vermut rosso">Vermut Rosso</option>
        <option value="vermut bianco">Vermut Bianco</option>
        <option value="vermut dry">Vermut Dry</option>
        <option value="fernet">Fernet</option>
        <option value="amaro">Amaro Generico</option>
        <option value="jagermeister">Jägermeister</option>
        <option value="sloe gin">Sloe Gin</option>
    </optgroup>

    <optgroup label="Succhi e Sciroppi">
        <option value="succo limone">Succo di Limone</option>
        <option value="succo lime">Succo di Lime</option>
        <option value="succo arancia">Succo d'Arancia</option>
        <option value="succo ananas">Succo d'Ananas</option>
        <option value="succo pompelmo">Succo di Pompelmo</option>
        <option value="succo mela">Succo di Mela</option>
        <option value="succo mirtillo">Succo di Mirtillo</option>
        <option value="succo uva">Succo d'Uva</option>
        <option value="sciroppo zucchero">Sciroppo di Zucchero</option>
        <option value="sciroppo agave">Sciroppo d'Agave</option>
        <option value="sciroppo grenadina">Grenadina</option>
        <option value="sciroppo mirtillo">Sciroppo di Mirtillo</option>
        <option value="sciroppo cocco">Sciroppo di Cocco</option>
        <option value="sciroppo pesca">Sciroppo di Pesca</option>
        <option value="sciroppo lampone">Sciroppo di Lampone</option>
        <option value="sciroppo mandorla">Sciroppo di Mandorla</option>
        <option value="sciroppo menta">Sciroppo di Menta</option>
        <option value="sciroppo cioccolato">Sciroppo di Cioccolato</option>
    </optgroup>

    <optgroup label="Bevande e Altri Ingredienti">
        <option value="soda">Soda</option>
        <option value="acqua tonica">Acqua Tonica</option>
        <option value="cola">Cola</option>
        <option value="ginger ale">Ginger Ale</option>
        <option value="ginger beer">Ginger Beer</option>
        <option value="red bull">Energy Drink</option>
        <option value="birra">Birra</option>
        <option value="sidro">Sidro</option>
        <option value="prosecco">Prosecco</option>
        <option value="champagne">Champagne</option>
        <option value="vino rosso">Vino Rosso</option>
        <option value="vino bianco">Vino Bianco</option>
        <option value="porto">Porto</option>
        <option value="sherry">Sherry</option>
        <option value="caffè">Caffè</option>
        <option value="tè">Tè</option>
        <option value="latte">Latte</option>
        <option value="panna">Panna</option>
        <option value="albume">Albume d'Uovo</option>
        <option value="menta">Foglie di Menta</option>
        <option value="basilico">Basilico</option>
        <option value="zucchero">Zucchero</option>
        <option value="sale">Sale</option>
        <option value="pepe">Pepe</option>
        <option value="cannella">Cannella</option>
        <option value="noce moscata">Noce Moscata</option>
        <option value="chiodi di garofano">Chiodi di Garofano</option>
        <option value="zenzero">Zenzero</option>
        <option value="cioccolato">Cioccolato</option>
    </optgroup>
</select>

    <input type="descrizione" name="descrizione" placeholder="Descrizione" required>
    <input type="file" name="immagine" required>
    <input type="submit" name="submit" value="Pubblica Drink">
</form>

</body>
<style>
    form{
        display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
    height: 100vh; 
    margin: 2;
    gap: 12px;
    }
</style>
</html>

<?php
} else {
    header("location: Login.php");
}
?>