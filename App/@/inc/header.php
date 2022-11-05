<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Fitness Core - <?= $pageName ?></title>
    <link rel="stylesheet" href="/App/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-zrnmn8R8KkWl12rAZFt4yKjxplaDaT7/EUkKm7AovijfrQItFWR7O/JJn4DAa/gx" crossorigin="anonymous">
</head>

<body class="vh-100">
    <header class="">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <img class="img-fluid" src="/App/public/assets/image/logofitnesscore.jpg">
                <a class="navbar-brand" href="/">Fitness Core</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/App/public/src/a_propos.php">À propos</a>
                        </li>
                        
                <?php if(isset($_SESSION['auth'])) : 
                    $user = $_SESSION['auth'];
                    if ($user->roles == 6 ):
                ?>
                    <li class="navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a> 
                        <ul class="dropdown-menu ">
                            <li class="nav-item">
                                <a class="nav-link" href="/App/@/admin/admin.php">Panel PDG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/App/@/salles/salle.php">Salle partenaires</a>
                            </li>
                            <?php endif; ?>
                        <?php if($user->roles > 2 || $user->roles == 6):?>
                            <li class="nav-item">
                                <a class="nav-link" href="/App/@/franchises/franchises.php">Tableau de bord</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif;?>
                <?php endif;?>

                    </ul>

                    <?php if (isset($_SESSION['auth'])) : ?>
                    <ul>
                        <li class="navbar-nav nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/App/public/src/logout.php">Se déconnecter</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php else : ?>
                        <ul class="navbar-nav navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <li class="nav-item">
                                <a class="nav-link" href="/App/public/src/login.php">Se connecter</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <div class="container min-vh-100">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type; ?> mt-3">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>