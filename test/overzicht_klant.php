<?php
session_start();
$_SESSION['uname'];

include "database.php";

require_once('header.php');

$title = "Login";


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Overzicht klant</title>
</head>
<body>

<?php
    $db = new db();
    $winkels = $db->select("SELECT * FROM klant WHERE klantcode = :code;", ['code'=>$_SESSION['klantcode']]);
    // print_r($winkels);

    $columns = array_keys($winkels[0]);
    $row_data = array_values($winkels);
?>
<div class="">
<button type="button"><a href="klant.php">Terug</a></button>
    <table class="table table-hover">
        <tr>
            <?php

                foreach($columns as $column){ 
                    echo "<th><strong> $column </strong></th>";
                }

            ?>
            <th colspan="2">action</th>
        </tr>
        
        <?php
            foreach($row_data as $rows){ ?>
            <tr>
            <?php
            foreach($rows as $data){
                echo "<td> $data </td>";
            }
            ?>
                <td>
                    <a type="button" href="edit_klant.php?klant_klantcode=<?php echo $rows['klantcode']?>">Edit</a>
                </td>
            </tr>
     <?php } ?>
            </tr>
    </table>
</div>

    
</body>
</html>

<?php
require_once('footer.php');
?>