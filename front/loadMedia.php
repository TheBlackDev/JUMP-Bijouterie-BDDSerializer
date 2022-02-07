<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: /login.php');
    exit();
}

if(empty($_GET) or !isset($_GET['file'])) {
    $_SESSION['flash']['error'] = "Erreur interne (requête incorrecte). Merci de réessayer.";
    header('Location: /search.php');
    exit(); 
}


$file = $_GET['file'];

$extension = pathinfo($file, PATHINFO_EXTENSION);
$img_ext = array("jpg", "jpeg", "png", "gif");
$vid_ext = array("mp4", "avi", "mkv", "mov");

if(!in_array($extension, $img_ext) && !in_array($extension, $vid_ext)) {
    $_SESSION['flash']['error'] = "Erreur interne (extension incorrecte) . Merci de réessayer.";
    header('Location: /search.php');
    exit();
}

$path = "/private/media/".$file;
$path = $_SERVER['DOCUMENT_ROOT'].$path;

if(!file_exists($path)) {
    $_SESSION['flash']['error'] = "Erreur interne (fichier inexistant). Merci de réessayer.";
    header('Location: /search.php');
    exit();
}

$mime = mime_content_type($path);

if(in_array($extension, $img_ext)) {
    header('Content-Type: '.$mime);
    readfile($path);
} else if(in_array($extension, $vid_ext)) {
    header('Content-Type: '.$mime);
    readfile($path);
} else {
    $_SESSION['flash']['error'] = "Erreur interne (extension incorrecte). Merci de réessayer.";
    header('Location: /search.php');
}

exit();