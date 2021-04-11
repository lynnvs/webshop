<?php
//index.php

// start the session
session_start();

// include the database class
include "database.php";

require_once('header.php');

if(isset($_POST['submit'])){

    $fields = ['artikel', 'prijs'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){
    // store posted form values in variables
    $artikel= $_POST['artikel'];
    $prijs= $_POST['prijs'];

    $database = new db();
    $database->artikel_toevoegen($artikel, $prijs);
 }
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel toevoegen</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="styles.css">
    
</head>

<body> 
    <form action="" method="post">
        <h1>Artikel toevoegen</h1>

        <label for="artikel">Artikel</label>
            <input type="text" name="artikel" required="">
            <br>
        <label for="prijs">Prijs</label>
            <input type="number" name="prijs" required="">
            <br>

        <input type="submit" name="submit" value="submit">
    </form>
        <br>
        <button type="button"><a href="medewerker.php">terug</a></button>
</body>

<?php
require_once('footer.php');
?>