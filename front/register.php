<?php

    require_once 'private/front/inc/db.php';
    require_once 'private/front/inc/functions.php';

    require 'private/front/register_front.php';

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