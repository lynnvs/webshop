<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit artikel</title>
</head>
<body>
<?php
require "database.php";
require_once('header.php');
$db = new db();

if(isset($_GET['artikel_artikelcode'])){
    $db = new db();
    $artikel = $db->select("SELECT * FROM artikel WHERE artikelcode = :artikelcode", ['artikelcode'=>$_GET['artikel_artikelcode']]);
    //print_r($artikel);
}
    
// if(isset($_POST['submit'])){
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "UPDATE artikel SET artikel=:artikel, prijs=:prijs WHERE artikelcode=:artikelcode";

    $placeholders = [
        'artikel'=>$_POST['artikel'],
        'prijs'=>$_POST['prijs'],
        'artikelcode'=>$_POST['artikelcode']
    ];

    
    $db->update_or_delete($sql, $placeholders);

}
?>

    <form action="edit_artikel.php" method="POST">
            <input type="hidden" name="artikelcode" value="<?php echo isset($_GET['artikel_artikelcode']) ? $_GET['artikel_artikelcode'] : '' ?>">

            <label for="Artikel">Artikel</label>
            <input type="text"  name="artikel" placeholder="artikel" value="<?php echo isset($artikel) ? $artikel[0]['artikel'] : ''?>">
            <br>
            <label for="Prijs">Prijs</label>
            <input type="text"  name="prijs" placeholder="prijs" value="<?php echo isset($artikel) ? $artikel[0]['prijs'] : ''?>">
            <br>
            <input type="submit" value="Edit">
    </form>

</body>
</html>