<?php
    require_once("private/front/inc/db.php");
    $req = $pdo->prepare("SELECT DISTINCT seller FROM inventory");
    $req -> execute();
    $res = $req -> fetchAll(); 
    foreach($res as $b) {
        $c = $b->seller;
        if($c != '') {
            echo "<option value='$c'>$c</option>";
        }
    }	