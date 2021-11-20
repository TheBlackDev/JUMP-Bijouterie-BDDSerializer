<?php
    require_once("db.php");
    $req = $pdo->prepare("SELECT DISTINCT periode FROM inventory");
    $req -> execute();
    $res = $req -> fetchAll(); 
    foreach($res as $b) {
        $c = $b->periode;
        if($c != '') {
            echo "<option value='$c'>$c</option>";
        }
    }	