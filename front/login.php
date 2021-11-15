<?php 

    require_once './inc/db.php';
    require_once './inc/functions.php';

    $errors = array();

    if(!empty($_POST)) {
        if(empty($_POST['username'])){
            $errors['username'] = 'Veuillez renseigner votre nom d\'utilisateur';
        }

        if(empty($_POST['password'])){
            $errors['password'] = 'Veuillez renseigner votre nom d\'utilisateur';
        }

        if(!empty($errors)){
            debug($errors);
        }
    }



?>

<?php require './login.html'?>