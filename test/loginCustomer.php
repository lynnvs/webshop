<?php
include "database.php";

require_once('header.php');

$title = "Login";


if(isset($_POST['submit'])){

    $fields = ['unames', 'pword'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){
    // store posted form values in variables
    $username= $_POST['unames'];
    $password= $_POST['pword'];
        
    $database = new db();
    $database->logincustomer($username, $password);
 }
}


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body >


    <form action="" method="post">
        <h1>Log in</h1>

        <label for="text" >Gebruikersnaam</label>
        <input type="text" name="unames" placeholder="username" required="" autocomplete="off">
        <br>

        <label for="Password">Password</label>
        <input type="password" name="pword" placeholder="Wachtwoord" required="" autocomplete="off">
        <br>
                
        <input type="submit" name="submit" value="Login">
        <br>
        <a href="register.php" id="register" role="button">Geen account? Registreren</a>

    </form>



</body>

</html>
<?php
require_once('footer.php');
?>