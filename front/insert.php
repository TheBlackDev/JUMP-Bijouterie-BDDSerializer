<?php 

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

require "private/front/inc/header.php";


if(!isset($_SESSION['auth'])) {
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: login.php');
    exit();
}

if(!isset($_SESSION['ids'])){
    $_SESSION['ids']=array();
}

$ids = $_SESSION['ids'];


require_once "private/front/inc/db.php";

if(!empty($_POST)){

  if(!empty($_POST['clear'])){
    unset($_SESSION['ids']);
    $_SESSION['flash']['success'] = "La liste de fichier a été vidée.";
    header('Location: insert.php');
    exit();
  }

  $errors = array();

  if(!empty($_POST['lot'])) {
    $lot = $_POST['lot'];
    $result = $pdo->prepare("SELECT lot FROM inventory WHERE lot = '$lot'");
    try {
      $result->execute();
    } catch (PDOException $e) {
      $_SESSION['flash']['error'] = "Erreur lors de la requête : ".$e->getMessage();
      header("Location: insert.php");
      exit();
    }
    $num = count($result->fetchAll());
    if($num > 0) {
      $_SESSION['flash']['error'] = "Le lot numéro ".$_POST['lot']." existe déjà. Si vous ne savez pas quels numéro de lot sont libres, vous pouvez laisser celui proposer par défaut.";
      header("Location: insert.php");
      exit();
    }
  }

  function parsePostParameter($parameter) {
    if(!empty($_POST[$parameter])) {
      return $_POST[$parameter];
    } else {
      return NULL;
    }
  }

  $lot = parsePostParameter('lot'); 
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

  $media = "";
  if(empty($_SESSION['ids'])) {
    $media = NULL;
  } else {
    foreach($_SESSION['ids'] as $med) {
      $media .= $med . ",";
    }
    $media = substr($media, 0, -1);
  }

  
  
  $pre_req = "INSERT INTO inventory VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" ;
  $request = $pdo->prepare($pre_req);	
   
  try {
    $request -> execute(array($lot, $buy_date, $seller, $description, $buy_price*100, $sold, $place, $sell_price*100, $sell_date, $eesonia, $eeprice*100, $eedate, $ombprice*100, $bill, $type, $type2, $period, $metal, $brand, $stone, $weight, $media));
  } catch (PDOException $e) {
    $_SESSION['flash']['error'] = "Erreur lors de la requête : ".$e->getMessage();
    $_SESSION['flash']['info'] = $pre_req;
    header("Location: insert.php");
    exit();
  }

  $_SESSION['flash']['success'] = "Le lot ".$lot." a bien été ajouté.";
  header("Location: insert.php");
  exit();
}

if(!empty($_FILES)){
  $files = $_FILES['file'];
  if(isset($_FILES["file"]) && isArrayComposedOf(0, $files['error'])) {	

    foreach($_FILES["file"]["name"] as $key => $name){
      $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
      if(!array_key_exists($extension, $photo) && !array_key_exists($extension, $video)) {
        $_SESSION['flash']['warning'] = "Vous devez uploader uniquement des images ou des vidéos.";
        header('Location: insert.php');
        exit();
      }
    }

    $file_count = count($files["name"]);

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
      array_push($ids, $file_name);
    } 
    unset($_SESSION['ids']);
    $_SESSION['ids'] = $ids;
    $_SESSION['flash']['success'] = "Les fichiers ont bien été uploadés.";
    header('Location: insert.php');
    exit();    
  } else {
    $_SESSION['flash']['error'] = "Erreur de type ". var_dump($_FILES["file"]["error"]) . ".";
    $_SESSION['flash']['warning'] = "Une erreur est survenue lors de l'upload, veuillez réessayer.";
    if(isset($_SESSION['ids']) && !empty($_SESSION['ids'])) {
      $_SESSION['flash']['info'] = "Pas d'inquiétude! Les fichiers déjà uploadés jusqu'à présent (pour cet article) ont été conservés!";
    }	
    header('Location: insert.php');
    exit();
  }
}

require 'private/front/insert_front.php';

if(isset($_SESSION['openmedia'])) {
  unset($_SESSION['openmedia']);
  echo('<script> 
    openmediaadd();
  </script>');
}