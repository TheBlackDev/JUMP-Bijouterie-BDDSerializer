<?php


    require_once './inc/db.php';
    require_once './inc/functions.php';

    require './inc/header.php';
    require './login_front.php';

    $redirection = "./insert.php";

    $errors = array();

    if(isset($_SESSION['auth'])) {
        $_SESSION['flash']['info'] = "Vous êtes déjà connecté.";
        header('Location: ' . $redirection);
        exit();
    }

    if(!empty($_POST)) {
        if(empty($_POST['username'])){
            $errors['username'] = 'Veuillez renseigner votre nom d\'utilisateur';
        }

        if(empty($_POST['password'])){
            $errors['password'] = 'Veuillez renseigner votre nom d\'utilisateur';
        }

        if(empty($errors)) {
            $req = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $req->execute([$_POST['username']]);
            $user = $req->fetch();

            if(password_verify($_POST['password'], $user->hash)) {
                $_SESSION['auth'] = $user;
                $_SESSION['flash']['success'] = "Bienvenue " . $user->username . " !";
                header('Location: ' . $redirection);
                exit();
            } else {
                $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect.";
            }
        }

        if(!empty($errors)){
            debug($errors);
        }
    }
