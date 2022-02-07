<?php
require_once 'private/front/inc/header.php';
require_once 'private/front/inc/db.php';


if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page.";
    header('Location: /login.php');
    exit();
}

if(!isset($_GET) || !isset($_GET['lot'])) {
    $_SESSION['flash']['warning'] = "Vous devez sélectionner un lot pour accéder à cette page.";
    header('Location: /search.php');
    exit();
}

$req = $pdo -> prepare("SELECT * FROM inventory WHERE lot = ?");
$req -> execute(array($_GET['lot']));
$res = ($req -> fetchAll());

if(count($res) == 0) {
    $_SESSION['flash']['info'] = "SELECT * FROM inventory WHERE lot = ".$_GET['lot'] ;
    $_SESSION['flash']['warning'] = "Le lot n'existe pas.";
    header('Location: /search.php');
    exit();
}

if(count($res) > 1) {
    $_SESSION['flash']['warning'] = "Erreur interne (plusieurs lots existent).";
    header('Location: /search.php');
    exit();
}

?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Modification d'un produit</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
  
  <style>

    .img_wrapper {
      height: 85%;
      padding: none;
      margin: none;
    }

  </style>

</head>


<?php 

$res = $res[0];

$lot = $res -> lot;

function isArrayComposedOf($value, $array) {
  foreach ($array as $element) {
    if ($value != $element) {
      return false;
    }
  }
  return true;
}

$photo = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
$video = array("mp4" => "video/mp4", "avi" => "video/avi", "mkv" => "video/mkv", "mov" => "video/mov");

$ids = $res -> media;

if($ids != NULL) {
  $ids = explode(",", $ids);
} else {
  $ids = array();
}

if(!empty($_POST)){

  $errors = array();

  function parsePostParameter($parameter) {
    if(!empty($_POST[$parameter])) {
      return $_POST[$parameter];
    } else {
      return NULL;
    }
  }

  $buy_date = parsePostParameter('buy_date');
  $seller = parsePostParameter('seller');
  $description = parsePostParameter('description');
  $buy_price = parsePostParameter('buy_price');
  $sold = parsePostParameter('sold');
  $place = parsePostParameter('place');
  $sell_price = parsePostParameter('sell_price');
  $sell_date = parsePostParameter('sell_date');
  $eesonia = parsePostParameter('ees');
  $eeprice = parsePostParameter('eep');
  $eedate = parsePostParameter('eed');
  $ombprice = parsePostParameter('omb');
  $bill = parsePostParameter('bill');
  $type = parsePostParameter('type');
  $type2 = parsePostParameter('type2');
  $period = parsePostParameter('periode');


  $metal = "";
  if(empty($_POST['metal'])) {
    $metal = NULL;
  } else {
    foreach($_POST['metal'] as $met) {
      $metal .= $met . "-";
    }
    $metal = substr($metal, 0, -1);
  }
  
  $brand = parsePostParameter('brand');

  $stone = "";
  if(empty($_POST['pierre'])) {
    $stone = NULL;
  } else {
    foreach($_POST['pierre'] as $sto) {
      $stone = $stone . $sto . "-";
    }
    $stone = substr($stone, 0, -1);
  }
  
  $weight = parsePostParameter('weight');

  function priceParser($price) {
    if(empty($price) || $price == 'NULL' || $price == '') {
      return NULL;
    } else {
      return $price*100;
    }
  }

  $pre_req = "UPDATE inventory SET buy_date=?, seller=?, description=?, buy_price=?, sold=?, place=?, sell_price=?, sell_date=?, eesonia=?, eeprice=?, eedate=?, ombprice=?, bill=?, type=?, type2=?, period=?, metal=?, brand=?, stone=?, weight=? WHERE lot=?";
  $request = $pdo->prepare($pre_req);	   
  try {
    $request -> execute(array($buy_date, $seller, $description, priceParser($buy_price), $sold, $place, priceParser($sell_price), $sell_date, $eesonia, priceParser($eeprice), $eedate, priceParser($ombprice), $bill, $type, $type2, $period, $metal, $brand, $stone, $weight, $lot));
  } catch (PDOException $e) {
    $_SESSION['flash']['error'] = "Erreur lors de la requête : " . $e->getMessage();
    $_SESSION['flash']['info'] = $pre_req;
    header("Location: details.php?lot=".$lot);
    exit();
  }

  $_SESSION['flash']['success'] = "Le lot ".$lot." a bien été modifié.";
  header("Location: details.php?lot=".$lot);
  exit();
}

if(!empty($_FILES)){
  $files = $_FILES['file'];
  if(isset($_FILES["file"]) && isArrayComposedOf(0, $files['error'])) {	

    foreach($_FILES["file"]["name"] as $key => $name){
      $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
      if(!array_key_exists($extension, $photo) && !array_key_exists($extension, $video)) {
        $_SESSION['flash']['warning'] = "Vous devez uploader uniquement des images ou des vidéos.";
        header("Location: details.php?lot=".$lot);
        exit();
      }
    }

    $file_count = count($files["name"]);

    $to_add = "";

    for($i = 0; $i < $file_count; $i++){
      $file_name = $files["name"][$i];
      $file_tmp_name = $files["tmp_name"][$i];
      $file_ext = explode('.', $file_name);
      $file_ext = strtolower(end($file_ext));
      do {
        $uuid = uniqid("");
      } while (file_exists("private/media/" . $uuid . "." . $file_ext));
      $file_name = $uuid . '.' . $file_ext;
      $file_destination = 'private/media/' . $file_name;	
      move_uploaded_file($file_tmp_name, $file_destination);
      $to_add .= $file_name . ",";
    }
    $to_add = substr($to_add, 0, -1);
    $new = $to_add;
    if($res->media != NULL) {
      $new = $res->media . "," . $to_add;
    }
    try {
      $request = $pdo -> prepare("UPDATE inventory SET media=? WHERE lot=?");
      $request -> execute(array($new, $lot));
    } catch (PDOException $e) {
      $_SESSION['flash']['error'] = "Erreur lors de la requête : " . $e->getMessage();
      header("Location: details.php?lot=".$lot);
      exit();
    }
    $_SESSION['flash']['success'] = "Les fichiers ont bien été ajoutés en tant que media de ce lot.";
    header("Location: details.php?lot=".$lot);
    exit();    
  } else {
    $_SESSION['flash']['error'] = "Erreur de type ". var_dump($_FILES["file"]["error"]) . ".";
    $_SESSION['flash']['warning'] = "Une erreur est survenue lors de l'upload, veuillez réessayer.";
    header("Location: details.php?lot=".$lot);
    exit();
  }
}

require 'private/front/details_front.php';

if(isset($_SESSION['openmedia'])) {
  unset($_SESSION['openmedia']);
  echo('<script> 
    openmediaadd();
  </script>');
}

?>

</html>