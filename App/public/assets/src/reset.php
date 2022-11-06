<?php $pageName = 'Réinitialiser votre mot de passe ';

if(isset($_GET['id']) && isset($_GET['token'])){
    require '../../@/sys/bd.php';
    require '../../@/sys/functions.php';

    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();

    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();

                $_SESSION['flash']['success'] = "Votre mot de passe a était modifier";
                $_SESSION['auth'] = $user;

                header('Location: index.php');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['danger'] = "Ce numéro de Jeton n'est pas valide";      
        header('Location: login.php');
        exit();
    }

}else{
    header('Location: login.php');
    exit();
}
?>
<?php require '../../@/inc/header.php'; ?>

<h1>Change ton mon de passe</h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control no-border" />
    </div>
    <div class="form-group">
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary">Reset password</button>
</form>

<?php require_once '../../@/inc/footer.php'; ?>