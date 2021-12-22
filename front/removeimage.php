<?php

require "private/front/inc/header.php";

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: login.php');
    exit();
}

if(isset($_GET['reset']) && $_GET['reset'] == 1){
    unset($_SESSION['ids']);
    $_SESSION['flash']['success'] = "Liste de fichier vidée.";
    header('Location: insert.php');
    exit();
}

if(isset($_GET['id'])){
    $toremoveid = $_GET['id'];
    if(isset($_SESSION['ids'])){
        $id_array = $_SESSION['ids'];
        if(in_array($toremoveid, $id_array)){
            $key = array_search($id, $id_array);
            unset($id_array[$key]);
            $_SESSION['ids'] = $id_array;
            $_SESSION['flash']['success'] = "Image supprimée.";
            $_SESSION['openmedia'] = 1;
            header('Location: insert.php');
            exit();
        } else {
            $_SESSION['flash']['error'] = "Cette image n'existe pas.";
            header('Location: insert.php');
            exit();
        }
    } else {
        $_SESSION['flash']['error'] = "Erreur interne.";
        header('Location: insert.php');
        exit();
    }
} 
else {
    $_SESSION['flash']['warning'] = "Vous vous êtes perdus ?";
    header('Location: insert.php');
    exit();
}



