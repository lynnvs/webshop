<?php

include "database.php";

require_once('header.php');

$title = "Login";

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>overzicht medewerker</title>
</head>
<body>

<?php
    $db = new db();
    $winkels = $db->select("SELECT * FROM medewerkers", []);
    // print_r($winkels);

    $columns = array_keys($winkels[0]);
    $row_data = array_values($winkels);
?>
<div class="">
<button type="button"><a href="medewerker.php">terug</a></button>
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
                    <a type="button"  href="edit_medewerkers.php?medewerkers_medewerkerscode=<?php echo $rows['medewerkerscode']?>">Edit</a>
                </td>
                <td>
                    <a type="button"  href="delete_medewerkers.php?medewerkers_medewerkerscode=<?php echo $rows['medewerkerscode']?>">Delete</a>
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