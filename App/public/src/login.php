<?php $pageName = 'Login'; ?>
<?php
require_once '../../@/sys/functions.php';
reconnect_from_cookie();

if(isset($_SESSION['auth'])){
    header('Location: index.php');
    exit();
}

if(!empty($_POST['email']) && !empty($_POST['password'])){
    require_once '../../@/sys/bd.php';
   
    $req = $pdo->prepare('SELECT * FROM users WHERE (email = :email)');
    $req->execute(['email' => $_POST['email']]);
    $user = $req->fetch();
   
    if(password_verify($_POST['password'], $user->password)){
        if(!$user->confirmed_at == null){
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = "Vous étes maintenant connecté";

            if($_POST['remember']){
                $remember_token = str_random(250);
                $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
                setcookie('remember', $user->id . '//' . $remember_token . sha1($user->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
            }
            
            
            header('Location: index.php');
            exit();
        }else{
            $_SESSION['flash']['danger'] = "Veuillez confirmer votre E-mail";
        }
    }else{
        $_SESSION['flash']['danger'] = "Adresse e-mail ou mot de passe incorrecte";
    }
}
?>
<?php require_once '../../@/inc/header.php'; ?>

<div class="d-flex">
<div class=" p-5 my-6 m-auto bg-light rounded-3">
<h1>Se connecter</h1>
<form method="POST" class="">
        <div class="form-group">
            <label>Adresse E-mail</label>
            <input type="email" name="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Password <a href="forget.php"> (Forget password)</a></label>
            <input type="password" name="password" class="form-control"/>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1"/>Remember me
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</div>

<?php require_once '../../@/inc/footer.php'; ?>
