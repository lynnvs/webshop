<?php
// this inserts the header
require_once('header.php');

// include the database class
 include "database.php";

    $db = new db();
    echo "<h1>Welcome </h1>".$_SESSION['uname'];
?>

<body>

        <div class="col-3">
            <button type="button"><a href="artikel_bestellen.php">Artikel bestellen</a></button>
        </div>

        <div class="col-3">
        <button type="button"><a href="overzicht_klant.php">gegevens bewerken</a></button>
        </div>

</body>



<?php
// this inserts the header
    require_once('footer.php');
?>