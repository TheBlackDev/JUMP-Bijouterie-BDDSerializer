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
    $result = $pdo->prepare("SELECT COUNT() FROM inventory WHERE lot = ' $lot '");
    try {
      $result->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      return "MYSQL ERROR";
      exit;
    }
    
    $num = $result->fetch();
    if($num[0] > 0) {
      $errors['lot'] = "Ce lot existe déjà, si vous ne voulez pas imposer le numéro de lot, laisser la case vide.";
    }
    return $errors;
  }

  $request = $pdo->prepare("INSERT INTO inventory (lot, name, quantity, price, date_expiration, date_creation) VALUES (:lot, :name, :quantity, :price, :date_expiration, :date_creation)");

  $lot = $_POST['lot'];
  $buy_price = $_POST['buy_price'];
  $buy_date = $_POST['buy_date'];
  $seller = $_POST['seller'];
  $type1 = $_POST['type'];
  $type2 = $_POST['type2'];
  $periode = $_POST['periode'];
  $brand = $_POST['brand'];
  $metal = $_POST['metal'];
  $b_weight = $_POST['weight'];
  $pierre = $_POST['pierre'];

  $request = $pdo->prepare("INSERT INTO inventory (lot, buy_price, buy_date, seller, type1, type2, periode, brand, metal, b_weight, pierre) 
  VALUES ($lot, $buy_price, $buy_date, $seller, $type1, $type2, $periode, $brand, $metal, $b_weight, $pierre)");
  
  try {
    $request->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return "MYSQL ERROR";
    exit;
  }

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