<?php $pageName = 'Mot de passe oublié'; ?>
<?php

if(!empty($_POST) && !empty($_POST['email'])){
   require_once '../../@/sys/bd.php';
   require_once '../../@/sys/functions.php';
   
   $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
   $req->execute([$_POST['email']]);
   var_dump($_POST['email']);
   $user = $req->fetch();

   if($user){
        session_start();
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = "Les instructions de rappel du mot de passe vous ont été envoyées par courrier électronique.";

        mail($_POST['email'],"antoinedemarlypro@gmail.com", "Reset your password", "In order to renationalize your password please click on this link\n\nhttp://localhost/oda/src/reset.php?id={$user->id}&token=$reset_token");
        header('Location: login.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "No account corresponds to this email";
    }
}
?>
<?php $pageName = 'Mot de passe oublié'; ?>
<?php require '../../@/inc/header.php'; ?>

<div class="w-50 p-5 my-5 m-auto bg-light">
    <h1>Forget password</h1>
    <form method="POST">
        <div class="form-group mb-3">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control"/>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer le mail</button>
    </form>
</div>

<?php require_once '../../@/inc/footer.php'; ?>