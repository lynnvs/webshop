<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit klant</title>
</head>
<body>
<?php
include 'database.php';
require_once('header.php'); 
$db = new db(); 

if(isset($_GET['klant_klantcode'])){
    $db = new db();
    $klant = $db->select("SELECT * FROM klant WHERE klantcode = :klantcode", ['klantcode'=>$_GET['klant_klantcode']]);
    //print_r($artikel); // uitkomst in browser: Array ( [0] => Array ( [id] => 5 [artikel] => bloesem [prijs] => 5.95 ) )
}
    
// if(isset($_POST['submit'])){
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "UPDATE klant SET voorletters=:voorletters, tussenvoegsel=:tussenvoegsel, achternaam=:achternaam, adres=:adres, postcode=:postcode, geboortedatum=:geboortedatum, woonplaats=:woonplaats, gebruikersnaam=:gebruikersnaam WHERE klantcode=:klantcode";

    $placeholders = [
        'voorletters'=>$_POST['voorletters'],
        'tussenvoegsel'=>$_POST['tussenvoegsel'],
        'achternaam'=>$_POST['achternaam'],
        'adres'=>$_POST['adres'],
        'postcode'=>$_POST['postcode'],
        'geboortedatum'=>$_POST['geboortedatum'],
        'woonplaats'=>$_POST['woonplaats'],
        'gebruikersnaam'=>$_POST['gebruikersnaam'],
        'klantcode'=>$_POST['klantcode']
    ];

    
    $db->update_or_delete($sql, $placeholders);

}
?>

<div class="container">
    <form action="edit_klant.php" method="POST">
        <div class="form-group">
            <input type="hidden" name="klantcode" value="<?php echo isset($_GET['klant_klantcode']) ? $_GET['klant_klantcode'] : '' ?>">
            <label for="voorletters">voorletters</label>
            <input class="form-control" type="text" name="voorletters" placeholder="voorletters" value="<?php echo isset($klant) ? $klant[0]['voorletters'] : ''?>">
            <br>
            <label for="tussenvoegsel">tussenvoegsel</label>
            <input class="form-control" type="text" name="tussenvoegsel" placeholder="tussenvoegsel" value="<?php echo isset($klant) ? $klant[0]['tussenvoegsel'] : ''?>">
            <br>
            <label for="achternaam">achternaam</label>
            <input class="form-control" type="text" name="achternaam" placeholder="achternaam" value="<?php echo isset($klant) ? $klant[0]['achternaam'] : ''?>">
            <br>
            <label for="adres">adres</label>
            <input class="form-control" type="text" name="adres" placeholder="adres" value="<?php echo isset($klant) ? $klant[0]['adres'] : ''?>">
            <br>
            <label for="postcode">postcode</label>
            <input class="form-control" type="text" name="postcode" placeholder="postcode" value="<?php echo isset($klant) ? $klant[0]['postcode'] : ''?>">
            <br>
            <label for="geboortedatum">geboortedatum</label>
            <input class="form-control" type="text" name="geboortedatum" placeholder="geboortedatum" value="<?php echo isset($klant) ? $klant[0]['geboortedatum'] : ''?>">
            <br>
            <label for="woonplaats">woonplaats</label>
            <input class="form-control" type="text" name="woonplaats" placeholder="woonplaats" value="<?php echo isset($klant) ? $klant[0]['woonplaats'] : ''?>">
            <br>
            <label for="gebruikersnaam">gebruikersnaam</label>
            <input class="form-control" type="text" name="gebruikersnaam" placeholder="gebruikersnaam" value="<?php echo isset($klant) ? $klant[0]['gebruikersnaam'] : ''?>">
            <br>
            <input type="submit" class="btn btn-lg btn-success btn-block" value="Edit">
        </div>
    </form>
    
</body>
</html>