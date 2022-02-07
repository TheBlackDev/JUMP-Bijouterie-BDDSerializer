<!DOCTYPE html>
<html>


<body>

BOUH

<?php

require_once 'private/front/inc/db.php';

$req = $pdo -> prepare("SELECT lot, metal FROM inventory WHERE metal LIKE '%Or Spécial%'");
$req -> execute();
$special_lots = $req -> fetchAll();


echo("coucou");
#var_dump($special_lots);

foreach($special_lots as $lot) {
  var_dump($lot);
  echo($lot->metal." ");
  $metals = explode("-", $lot->metal);
  var_dump($metals);
  for($i = 0; $i < count($metals); $i++) {
    if($metals[$i] == "Or Spécial") {
      $metals[$i] = "Or Sans Précision";
    }
  }
  $result = implode("-", $metals);
  $pdo -> prepare("UPDATE inventory SET metal = ? WHERE lot = ?") -> execute(array($result, $lot->lot));
  echo($lot->lot . " " . $result . "<br>");
}

?>

</body>
</html>