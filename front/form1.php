<?php 

require "./inc/header.php";

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['danger'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: ./login.php');
    exit();
}

require_once "./inc/db.php";

if(!empty($_POST)){

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

  # TODO : Upload image


  

}

require './form1_front.php';