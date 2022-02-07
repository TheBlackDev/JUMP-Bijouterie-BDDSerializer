<?php 

require "private/front/inc/header.php";

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['warning'] = "Vous devez être connecté pour accéder à cette page";
    header('Location: login.php');
    exit();
}

require_once "private/front/inc/functions.php";
require_once "private/front/inc/db.php";


require "private/front/inc/header.php";

require "private/front/search_front.php";





#<img src="/private/front/loadMedia.php?file=1.png" alt="">






/**

<!--

if(!empty($_GET)) {
    $dom = new DOMDocument();
    $dom->loadHTMLFile('/private/front/inc/search_front.php');
    $input_list = $dom->getElementsByTagName('input');
}



-->

*/