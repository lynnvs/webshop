<?php
// this inserts the header
    require_once('header.php');

   // include the database class
    include "database.php";


$db = new db();
echo "<h1>hallo " .$_SESSION['uname']. ",</h1>";
$vestigingen = $db->select("SELECT winkelcode, winkelplaats, winkelnaam FROM winkel", []);
// winkelcode is id. winkelplaats en naam tafel. winkelnaam niet nodig... from bestelling
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $winkelcode = $_POST['winkelplaats']; // id ander var geven waarde blijft id
    $id = (int)substr($winkelcode, 0, 1); //  tafelnummer
    $sql = "SELECT * FROM bestelling WHERE winkel_winkelcode = :id"; //tabellen samenvoegen (idk of nodig)
    $orders = $db->select($sql, ['id'=>$id]); //[[id=>1....],[id->2....],[id=>3...]]
    $columns = array_keys($orders[0]);
    $row_data = array_values($orders);


    // $vestiging veranderen in iets met tafel! hier en in de body.
}
?>
<body>
    <div class="row ruim">

        <div class="col-2">
        <form  action="medewerker.php" method="post">
        <!-- hier begint de dropdown  -->
        <label for="Bestellingen per Winkel">Bestellingen per Winkel</label> <!-- bestelling per tafelnummer -->
            <select name="winkelplaats"> <!-- tafelnummer -->
                <?php foreach ($vestigingen as $vestigingen): ?>
                <!-- $tafelnummer['id'] winkelplaats = tafelnummer dus $tafelnummer['tafel'] , winkelnaam weglaten-->
                    <option name="<?php echo $vestigingen["winkelcode"]?>" value="<?php echo $vestigingen["winkelcode"]?>"><?=$vestigingen["winkelcode"]?> <?=$vestigingen["winkelplaats"]?> <?=$vestigingen["winkelnaam"]?></option>
                <?php endforeach ?>
            </select>
            <br>
            <input type="submit" name="submit" value="submit">
        </form>
        </div>
        <!-- hier eindigd de dropdown en komen de bestellingen per tafelnummer-->
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