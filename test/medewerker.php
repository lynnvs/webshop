<?php
// this inserts the header
    require_once('header.php');

   // include the database class
    include "database.php";


$db = new db();
echo "<h1>hallo " .$_SESSION['uname']. ",</h1>";
$vestigingen = $db->select("SELECT winkelcode, winkelplaats, winkelnaam FROM winkel", []);

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $winkelcode = $_POST['winkelplaats'];
    $id = (int)substr($winkelcode, 0, 1);
    $sql = "SELECT * FROM bestelling WHERE winkel_winkelcode = :id";
    $orders = $db->select($sql, ['id'=>$id]); //[[id=>1....],[id->2....],[id=>3...]]
    $columns = array_keys($orders[0]);
    $row_data = array_values($orders);

}
?>
<body>
    <div class="row ruim">
            <button type="button"><a href="overzicht_artikelen.php">Overzicht artikelen</a></button>
            <br>
            <br>
            <button type="button"><a href="artikel_toevoegen.php">Artikel toegvoegen</a></button>

            <button type="button" ><a href="overzicht_medewerker.php">Overzicht medewerker</a></button>
            <br>
            <br>
            <button type="button"><a href="medewerkertoevoegen.php">Medewerker toevoegen</a></button>

            <button type="button" ><a href="joins.php">totaal omzet</a></button>
            <br>

        <div class="col-2">
        <form  action="medewerker.php" method="post">
        <!-- hier begint de dropdown  -->
        <label for="Bestellingen per Winkel">Bestellingen per Winkel</label>
            <select name="winkelplaats">
                <?php foreach ($vestigingen as $vestigingen): ?>
                    <option name="<?php echo $vestigingen["winkelcode"]?>" value="<?php echo $vestigingen["winkelcode"]?>"><?=$vestigingen["winkelcode"]?> <?=$vestigingen["winkelplaats"]?> <?=$vestigingen["winkelnaam"]?></option>
                <?php endforeach ?>
            </select>
            <br>
            <input type="submit" name="submit" value="submit">
        </form>
        </div>
        <!-- hier eindigd de dropdown -->
        <div class="container spacing" >
            <table class="table table-hover">
                <tr>
                    <?php
                        if(isset($columns) && !empty($columns)){
                        foreach($columns as $column){ ?>
                            <th><strong><?php echo $column; ?></strong></th>
                    <?php  
                      }
                    ?>
                </tr>

                <?php
                    foreach($row_data as $rows){ 
                ?>
                    <tr>
                <?php
                    foreach($rows as $data){
                        echo "<td> $data </td>";
                    }
                    }
                ?>

            <?php } 
            ?>
                    </tr>
            </table>
        </div>
    </div>
</body>

<?php
// this inserts the header
    require_once('footer.php');

?>