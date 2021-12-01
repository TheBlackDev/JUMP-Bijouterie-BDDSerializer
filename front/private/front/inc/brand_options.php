<?php
    require_once("private/front/inc/db.php");
    $req = $pdo->prepare("SELECT DISTINCT brand FROM inventory");
    $req -> execute();
    $res = $req -> fetchAll(); 
    foreach($res as $b) {
        $c = $b->brand;
        if($c != '') {
            echo "<option value='$c'>$c</option>";
        }
    }	