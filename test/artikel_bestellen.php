<?php
//index.php

// include the database class
include "database.php";

require_once('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

    $fields = ['winkelcode', 'artikelcode', 'aantal', 'medewerkerscode'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){
    // store posted form values in variables
    $winkelcode= $_POST['winkelcode'];
    $artikelcode= $_POST['artikelcode'];
    $aantal= $_POST['aantal'];
    $medewerkerscode= $_POST['medewerkerscode'];
    print_r($_POST);
    $database = new db();
    // fixme: should supply more arguments
    // btw also fix number of params of bestellen()
    $database->bestellen($winkelcode, $artikelcode, $aantal, $medewerkerscode);

 }
}


?>
<body> 
<div class="none">
<?php
$database = new db();
$vestigingen = $database->select("SELECT winkelcode, winkelplaats, winkelnaam FROM winkel", []);
$artikel = $database->select("SELECT artikelcode, artikel, prijs FROM artikel", []);
$medewerkers = $database->select("SELECT medewerkerscode, gebruikersnaam, achternaam FROM medewerkers", []);
?>
</div>

            <form action="artikel_bestellen.php" method="post">
            <h1 >Artikel Bestellen</h1>

                <label for="winkel">winkel</label>
                <select name="winkelcode">
                <?php foreach ($vestigingen as $vestigingen): ?>
                    <option value="<?=$vestigingen["winkelcode"]?>"><?=$vestigingen["winkelplaats"]?> <?=$vestigingen["winkelnaam"]?></option>
                <?php endforeach ?>
                </select>
                <br>

                <label for="winkel">Artikel</label>
                <select name="artikelcode">
                <?php foreach ($artikel as $artikel): ?>
                    <option value="<?=$artikel["artikelcode"]?>"><?=$artikel["artikel"]?> <?=$artikel["prijs"]?></option>
                <?php endforeach ?>
                </select>
                <br>
 
                <label for="aantal">Aantal</label>
                <input type="text" name="aantal" >
                <br>

                <label for="winkelcode">Medewerker</label>
                <select name="medewerkerscode" >
                <?php foreach ($medewerkers as $medewerkers): ?>
                    <option value="<?=$medewerkers["medewerkerscode"]?>"><?=$medewerkers["gebruikersnaam"]?> <?=$medewerkers["achternaam"]?></option>
                <?php endforeach ?>
                </select>
                <br>

                <input type="submit" name="submit" value="submit">
                <a href="artikel_bestellen.php" id="zwart"  role="button">Login</a> 
            </form>
 
</body>

<?php
require_once('footer.php');
?>