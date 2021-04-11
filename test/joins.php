<?php
    require_once('header.php');
    include "database.php";
    $db = new db();

    $join = $db->select("SELECT medewerkers.gebruikersnaam, medewerkers.wachtwoord, bestelling.afgehaald,
    bestelling.aantal, klant.gebruikersnaam, artikel.prijs, bestelling.aantal*artikel.prijs as Totaal 
    FROM bestelling
    INNER JOIN medewerkers
    ON bestelling.medewerkers_medewerkerscode = medewerkers.medewerkerscode
    INNER JOIN artikel
    ON bestelling.artikel_artikelcode = artikel.artikelcode
    INNER JOIN klant
    ON bestelling.klant_klantcode = klant.klantcode
    ", []);
    // print_r($join);

    $columns = array_keys($join[0]);
    $row_data = array_values($join);
    $subtotaal=0;
?>
<br>
<div class="container">
    <table class="table table-hover">
        <tr>
            <?php

                foreach($columns as $column){ 
                    echo "<th><strong> $column </strong></th>";
                }

            ?>
        </tr>

        <?php
            foreach($row_data as $rows){ 
                $subtotaal += $rows["Totaal"];
                ?>
            <tr>
            <?php
            foreach($rows as $data){
                echo "<td> $data </td>";
            }
            ?>
               
     <?php } ?>
            </tr>
    </table>
    <?php
            echo "<p align=right>subtotaal=$subtotaal</p>";
            ?>
            <button style="text-align:right" onclick="window.print()">Print uw reservering</button>
</div>