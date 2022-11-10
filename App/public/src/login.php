<?php $pageName = 'Login'; ?>
<?php
ini_set('display_errors','off');
require_once '../../@/sys/functions.php';
reconnect_from_cookie();

if(isset($_SESSION['auth'])){
    header('Location: /');
    exit();
}

if(isset($_POST['submit'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        require_once '../../@/sys/bd.php';
    
        $req = $pdo->prepare('SELECT * FROM users WHERE (email = :email)');
        $req->execute(['email' => $_POST['email']]);
        $user = $req->fetch();

        if($_POST['email'] == $user->email){
            if(password_verify($_POST['password'], $user->password)){
                if(!$user->confirmed_at == null){
                    $_SESSION['auth'] = $user;
                    $_SESSION['flash']['success'] = "Vous étes maintenant connecté";

                    if($_POST['remember']){
                        $remember_token = str_random(10);
                        $req_remember = $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = "'.$user->id.'"');
                        $req_remember->execute([$remember_token]);
                        var_dump($remember_token);
                        var_dump($req_remember->execute());
                        setcookie('remember', $user->id . '//' . $remember_token . sha1($user->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
                        echo 'la';
                    }
                    
                    //header('Location: profil.php');
                    exit();
                }else{
                    $_SESSION['flash']['danger'] = "Veuillez confirmer votre E-mail";
                }
            }
            $_SESSION['flash']['danger'] = "Mot de passe incorrecte";
        }else{
        $_SESSION['flash']['danger'] = "E-mail incorrecte";
        }
    }else{
    $_SESSION['flash']['danger'] = "Adresse e-mail/Mot de passe vide";
    }
}

?>
<?php require_once '../../@/inc/header.php'; ?>

<div class="d-flex mt-5">
<div class=" p-5 my-6 m-auto bg-light rounded-3">
<h1>Se connecter</h1>
<form method="POST" class="">
        <div class="form-group">
            <label>Adresse E-mail</label>
            <input type="email" name="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Mot de passe <a href="forget.php"> (mot de passe oublie ?)</a></label>
            <input type="password" name="password" class="form-control"/>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1"/>Se souvenir de moi
            </label>
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
</div>

<?php require_once '../../@/inc/footer.php'; ?>
