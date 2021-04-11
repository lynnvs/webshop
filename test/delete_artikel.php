<?php

if(isset($_GET['artikel_artikelcode'])){
    include "database.php";
    $db = new db();

    $sql = "DELETE FROM artikel WHERE artikelcode = :artikelcode";
    $placeholders = ['artikelcode'=>$_GET['artikel_artikelcode']];

    $db->update_or_delete($sql, $placeholders);
}

?>