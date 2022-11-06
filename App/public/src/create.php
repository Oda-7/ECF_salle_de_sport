<?php $pageName = 'Création de l\'employé'; ?>
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

    if(empty($_POST['password']) && empty($_POST['password_confirm']) != $_POST['password']){
        $errors['password'] = "Les mots de passe ne sont pas renseigné";
    }

    if(empty($errors)){
        $req = $pdo->prepare("INSERT INTO users SET username = ?, surname = ?, email = ?, password = ?, age = ?, roles = ?, confirmed_at = NOW()");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute([$_POST['username'], $_POST['surname'], $_POST['email'], $password, $_POST['age'],$_POST['roles']]);
        
        header('Location: admin.php');
        exit();
    }
}

?>

<?php require_once '../../@/inc/header.php'; ?>

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

<div class="d-flex">
    <div class="p-5 my-6 m-auto bg-light rounded-3">
        <h1>Ajouter un employé/franchisés</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="surname" class="form-control"/>
            </div>
            <div class="form-group">
            <label>Votre age</label>
            <input type="date" name="age" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Adresse E-mail</label>
                <input type="email" name="email" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="password" name="password" class="form-control"> 
            </div>
            <div class="form-group">
                <label for="">Confirmer le mot de passe</label>
                <input type="password" name="password_confirm" class="form-control"> 
            </div>
            <label>Roles</label>
            <select class="form-select" name="roles" id="roles">
                <option selected value="0">Membre</option>
                <option value="1">Receptionniste</option>
                <option value="2">Coach personnel</option>
                <option value="3">Manager</option>
                <option value="4">Directeur franchisé</option>
                <option value="5">Directeur régionale</option>
                <option value="6">PDG</option>
            </select>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary" name="update">Ajouter</button>
                <a class="btn btn-secondary" href="admin.php">Retour</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../@/inc/footer.php'; ?>