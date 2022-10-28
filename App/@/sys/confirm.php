<?php

$user_id = $_GET['id'];
$token = $_GET['token'];

require 'bd.php';

$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if($user && $user->confirmation_token == $token){
    $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id= ?')->execute([$user_id]);
    $_SESSION['flash']['success'] = "Votre compte est bien validé";
    $_SESSION['auth'] = $user;
    header('Location: ../../public/src/index.php');
}else{
    $_SESSION['flash']['danger'] = "Le token n'est pas valide";
    header('Location: ../../public/src/login.php');
}