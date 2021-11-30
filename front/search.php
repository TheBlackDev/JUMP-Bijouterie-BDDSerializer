<?php 

require "./inc/header.php";

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: ./login.php');
    exit();
}



require_once "./inc/functions.php";
require_once "./inc/db.php";


require "./inc/header.php";

require "./search_front.php";


if(!empty($_POST)) {
    
    $_SESSION['flash']['error'] = $_POST;
    header('Location: ./search.php');
    exit();

    echo('Erreur Interne');
    $_SESSION['flash']['error'] = "Erreur interne...";
}

# TODO: MySQL request to get the products
