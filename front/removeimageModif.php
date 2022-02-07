<?php

require "private/front/inc/header.php";
require_once "private/front/inc/db.php";

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header($loc);
    exit();
}

$loc = "Location: details.php?lot=".$_GET['lot'];

if(!isset($_GET['lot'])) {
    $_SESSION['flash']['error'] = "Vous devez sélectionner un lot pour accéder à cette page.";
    header("Location: $loc");
    exit();
}

if(isset($_GET['id'])){
    $toremoveid = $_GET['id'];
    $currentMedia = "";
    try {
        $req = $pdo -> prepare("SELECT media FROM inventory WHERE lot = ?");
        $req -> execute(array($_GET['lot']));
        $currentMedia = $req -> fetchAll()[0]->media;
    } catch (PDOException $e) {
        $_SESSION['flash']['error'] = "Erreur interne: ".$e->getMessage();
        header($loc);
        exit();
    }
    if($currentMedia != NULL) {
        $media_array = explode(",", $currentMedia);
        if(in_array($toremoveid, $media_array)) {
            $key = array_search($toremoveid, $media_array);
            unset($media_array[$key]);
            if(count($media_array) == 0) {
                $media_array = NULL;
            } else {
                $media_array = implode(",", $media_array);
            }
            $req = $pdo -> prepare("UPDATE inventory SET media = ? WHERE lot = ?");
            try {
                $req -> execute(array($media_array, $_GET['lot']));
            } catch (PDOException $e) {
                $_SESSION['flash']['error'] = "Erreur interne: ".$e->getMessage();
                header($loc);
                exit();
            }
            $_SESSION['flash']['success'] = "Image supprimée.";
            header($loc);
            exit();
        }
    }
    $_SESSION['flash']['error'] = "Ce fichier n'est pas un média de ce lot.";
    header($loc);
    exit();
} 
else {
    $_SESSION['flash']['warning'] = "Vous vous êtes perdus ?";
    header($loc);
    exit();
}



