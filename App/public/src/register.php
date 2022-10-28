<?php $pageName = 'S\'inscrire'; ?>
<?php
require_once '../../@/sys/functions.php';
session_start();

if(!empty($_POST)){
    $errors = array();
    require_once '../../@/sys/bd.php';

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Zéèàêâ]+$/', $_POST['username'])){
        $errors['username'] = "Votre prénom n'est pas valide";
    }else{
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
    }

    if(empty($_POST['surname']) || !preg_match('/^[a-zA-Zéèàêâ]+$/', $_POST['surname']) ){
        $errors['surname'] = "Votre nom n'est pas valide";
    }else{
        $req = $pdo->prepare('SELECT id FROM users WHERE surname = ?');
        $req->execute([$_POST['surname']]);
        
    }
    
    


    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email n'est pas valide";
    }else{
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        
        if($user){
            $errors['email'] = "Cette adresse email est déja utilisé";
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Les mots de passe ne corresponde pas";
    }

    if(empty($errors)){
        $req = $pdo->prepare("INSERT INTO users SET username = ?, surname = ?, email = ?, password = ?, age = ?, confirmation_token = ?, roles = 0");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $_POST['surname'], $_POST['email'], $password, $_POST['age'], $token]);
        $user_id = $pdo->LastInsertId();
        
        mail($_POST['email'], "antoinedemarlypro@gmail.com", "Confirmation de votre compte", "Merci de cliquer sur le lien ci-dessous pour confirmer votre compte\n\nhttp://localhost/oda/App/@/sys/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyer";
        header('Location: login.php');
        exit();
    }
}
?>

<?php include '../../@/inc/header.php'; ?>

<div class="d-flex h-100">
<div class="m-auto p-5 my-6 bg-light rounded-3">
<h1>S'enregistrer</h1>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" class="mb-4 h-100">
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="surname" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Adresse email</label>
            <input type="email" name="email" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Votre age</label>
            <input type="date" name="age" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control"/>
        </div>
        <div class="form-group mb-3">
            <label>Confirmer votre mot de passe</label>
            <input type="password" name="password_confirm" class="form-control"/>
        </div>
        
        <div>
            <button type="submit" class="btn btn-primary">S'enregistrer</button>
        </div>
    </form>
</div>
</div>

<?php include '../../@/inc/footer.php'; ?>
