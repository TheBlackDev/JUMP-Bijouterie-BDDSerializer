<?php
    require 'private/front/inc/header.php';
    unset($_SESSION['auth']);    
    unset($_SESSION['ids']);
    $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
    header('Location: login.php');