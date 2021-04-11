<?php

include "database.php";

require_once('header.php');

if(isset($_POST['submit'])){

    $fields = ['voorletters', 'achternaam', 'adres', 'postcode', 'woonplaats', 'geboortedatum', 'uname', 'pword'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){

    $voorletters= $_POST['voorletters'];
    $tussenvoegsel= isset($_POST['tussenvoegsel']) ? $_POST['tussenvoegsel'] : '';
    $achternaam= $_POST['achternaam'];
    $adres= $_POST['adres'];
    $postcode= $_POST['postcode'];
    $woonplaats= $_POST['woonplaats'];
    $geboortedatum= $_POST['geboortedatum'];
    $username= $_POST['uname'];
    $password= $_POST['pword'];


        
    $database = new db();

    $database->registreer_klant($voorletters, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $geboortedatum, $username, $password);
 }
}
?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>klant toevoegen</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body> 

            <form action="" method="post">
            <h1>Registreer</h1>

                <label for="voorletters">voorletters</label>
                <input type="text" name="voorletters"  required="">
                <br>

                <label for="Tussenvoegsel">Tussenvoegsel</label>
                <input type="text" name="tussenvoegsel" >
                <br>

                <label for="achternaam">achternaam</label>
                <input type="text" name="achternaam" required="">
                <br>

                <label for="adres">adres</label>
                <input type="text" name="adres" required="">
                <br>

                <label for="postcode">postcode</label>
                <input type="text" name="postcode" required="">
                <br>

                <label for="woonplaats">woonplaats</label>
                <input type="text" name="woonplaats" required="">
                <br>

                <label for="geboortedatum">geboortedatum</label>
                <input type="date" name="geboortedatum" required="" >
                <br>

                <label for="gebruikersnaam">gebruikersnaam</label>
                <input type="text" name="uname" required="">
                <br>

                <label for="Wachtwoord">Wachtwoord</label>
                <input type="password" name="pword" required="">
                <br>

                <input type="submit" name="submit" value="submit">
                <a href="loginCustomer.php" id="loginCustomer" role="button">Login user</a>
            </form>  
</body>

<?php
require_once('footer.php');
?>