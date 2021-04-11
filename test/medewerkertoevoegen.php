<?php
include "database.php";

require_once('header.php');

if(isset($_POST['submit'])){

    $fields = ['voorletters', 'voorvoegsel', 'achternaam', 'gebruikersnaam', 'wachtwoord'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){

    $voorletters= $_POST['voorletters'];
    $voorvoegsel= isset($_POST['voorvoegsel']) ? $_POST['voorvoegsel'] : '';
    $achternaam= $_POST['achternaam'];
    $username= $_POST['uname'];
    $password= $_POST['pword'];


        
    $database = new db();
    $database->registreer_medewerker($voorletters, $voorvoegsel, $achternaam, $gebruikersnaam, $wachtwoord);
 }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker toevoegen</title>

    <link rel="stylesheet" href="styles.css">

</head>

<body> 
    <form action="" method="post">
        <h1>Medewerker toevoegen</h1>

            <label for="voorletters">voorletters</label>
            <input type="text" name="voorletters" required="">
            <br>

            <label for="voorvoegsel">Voorvoegsel</label>
            <input type="text" name="voorvoegsel">
            <br>

            <label for="achternaam">Achternaam</label>
            <input type="text" name="achternaam" required="">
            <br>

            <label for="Gebruikersnaam">Gebruikersnaam</label>
            <input type="text" name="uname" required="">
            <br>

            <label for="Wachtwoord">Wachtwoord</label>
            <input type="password" name="pword" required="">
            <br>

            <input type="submit" name="submit" value="submit">
            <br>
            <button type="button" name="submit" value="submit"> <a href="medewerker.php">terug</a></button>
            <a href="overzicht_medewerker.php" id="medewerkeroverzicht">overzicht</a>
            </form> 
</body>

<?php
require_once('footer.php');
?>