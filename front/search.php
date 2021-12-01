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


if(!empty($_GET)) {
    
}