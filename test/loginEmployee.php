<?php

$title = "Login";
include "database.php";
require_once('header.php');

    //$database = new database();
    //$database->insert_admin();

    if(isset($_POST['submit'])){
        $fields = ['uname', 'pword'];
        $error = false;
        foreach($fields as $field){
            if(!isset($_POST[$field]) || empty($_POST[$field])){
             $error = true;
        }
    }

    if(!$error){
        // store posted form values in variables
        $username= $_POST['uname'];
        $password= $_POST['pword'];

        $database = new db();
        $database->loginmedewerker($username, $password);
     }
}


?>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker inloggen</title>

    <link rel="stylesheet" href="styles.css">

</head>

<body class="text-center">
            <form action="loginEmployee.php" method="post">
            <h1>Log in</h1>

                <label for="text" >Gebruikersnaam</label>
                <input type="text" name="uname" placeholder="Gebruikersnaam" required="" autocomplete="off">
                <br>

                <label for="Password">Password</label>
                <input type="password" name="pword"  placeholder="Wachtwoord" required="" autocomplete="off">
                <br>
                
                <input type="submit" name="submit" value="Login">

            </form>
</body>
</html>
<?php
require_once('footer.php');
?>