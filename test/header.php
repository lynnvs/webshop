<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="index.php" class="navbar-brand"><img class="img-fluid" src="img/flower-logo.png" alt="logo"></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
            
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <?php
                if(isset($_SESSION)){
                    if( array_key_exists('logged_in', $_SESSION)){
                        echo '<a href="medewerker.php">Medewerker</a>';
                }else{
                    echo '<a href="loginEmployee.php" >Inloggen Medewerkers</a>';
                    }
                }
                ?>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                    <a href="loginCustomer.php" class="nav-item nav-link">Inloggen Klant</a>
                    <a href="loginEmployee.php" class="nav-item nav-link">Inloggen medewerker</a>                
                    <a href="register.php" class="nav-item nav-link">Registreren</a>
                    <a href="overzicht_artikelen.php" class="nav-item nav-link">Artikelen</a>
            </div>
                <form class="form-inline ml-auto">
                    <div class="navbar-nav">
                    <?php 
                    session_start();
                    if(isset($_SESSION)){
                        if( array_key_exists('logged_in', $_SESSION)){
                        echo '<a href="logout.php">Logout</a>';
                        }
                    }
                    ?>
                </div>
                </form>
        </div>
    </nav>
</header>