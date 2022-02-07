<?php


    require_once 'private/front/inc/db.php';
    require_once 'private/front/inc/functions.php';

    require 'private/front/inc/header.php';
    require 'private/front/login_front.php';

    $redirection = "search.php";

    $errors = array();

    if(isset($_SESSION['auth'])) {
        $_SESSION['flash']['info'] = "Vous êtes déjà connecté.";
        header('Location: ' . $redirection);
        exit();
    }

    if(!empty($_POST)) {

        sleep(0.5);

        if(empty($_POST['username'])){
            $_SESSION['flash']['error'] = "Veuillez renseigner votre nom d'utilisateur.";
            exit();
        }

        if(empty($_POST['password'])){
            $_SESSION['flash']['error'] = "Veuillez renseigner votre mot de passe.";
            exit();
        }

        if(empty($errors)) {
            $req = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();
            
            if($user != "") {
                if(password_verify($_POST['password'], $user->hash)) {
                    $_SESSION['auth'] = $user;
                    $_SESSION['flash']['success'] = "Bienvenue " . $user->username . " !";
                    header('Location: ' . $redirection);
                    exit();
                }
            } else {
                $_SESSION['flash']['error'] = "Identifiant ou mot de passe incorrect.";
                exit();
            }
        }

        echo('Erreur Interne');
        $_SESSION['flash']['error'] = "Erreur interne...";
    }
