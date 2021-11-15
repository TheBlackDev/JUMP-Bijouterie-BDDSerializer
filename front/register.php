<?php

    require_once './inc/db.php';
    require_once './inc/functions.php';

    require './register_front.php';

    $errors = array();

    if(!empty($_POST)) {
        if($_POST['password'] === $_POST['confirmation']) {
            $pdo->prepare('INSERT INTO users VALUES(NULL, ?, ?)')
            ->execute([
                $_POST['username'],
                password_hash($_POST['password'], null)
            ]);
        } else {
            $errors['confirmation'] = 'Les mots de passe ne correspondent pas';
        }
        debug($errors);
    }