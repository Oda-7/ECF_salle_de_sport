<?php $pageName = 'Modification de l\'employé';
require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';

$user_id = $_GET['id'];
$errors = array();
if(isset($_POST['update']) && $_POST['roles'] == 6){
    return header('location: confirm_pdg.php?id='.$_GET['id'].'&roles='.$_POST['roles']);  
}   
if(!empty($_POST['username']) && !empty($_POST['surname']) && !empty($_POST['email'])){
        
    $req_update = $pdo->prepare('UPDATE users SET username = ?,surname = ?,email = ?, roles = ? WHERE id = "'.$user_id.'"');
    $req_update->execute([$_POST['username'],$_POST['surname'],$_POST['email'], $_POST['roles']]);
    
    return header('Location: admin.php');
}else{
    if(isset($_POST['update'])){
        $errors = '<div class="alert alert-danger" role="alert">Veuillez remplir les champs</div>';
        echo $errors;
    }
}


$req = $pdo->prepare("SELECT * FROM users WHERE id='" . $user_id . "'");
$req->execute();
$users = $req->fetch();

?>

<?php require_once '../../@/inc/header.php'; ?>

<div class="d-flex">
    <div class="p-5 my-6 m-auto bg-light rounded-3">
        <h1>Modifier, <?= $users->username ?></h1>
        <form action="" method="POST">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="username" class="form-control" value="<?= $users->username ?>"/>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="surname" class="form-control" value="<?= $users->surname ?>"/>
            </div>
            <div class="form-group">
                <label>Adresse E-mail</label>
                <input type="email" name="email" class="form-control" value="<?= $users->email ?>"/>
            </div>
            <label>Roles</label>
            <select class="form-select" name="roles" id="roles">
                <option selected>
                    <?php  
                        if($users->roles == 0){
                            echo 'Membre';
                        }elseif($users->roles == 1){
                            echo 'Receptionniste';
                        }elseif($users->roles == 2){
                            echo 'Coach personnel';
                        }elseif($users->roles == 3){
                            echo 'Manager';
                        }elseif($users->roles == 4){
                            echo 'Directeur Franchisé';
                        }elseif($users->roles == 5){
                            echo 'Directeur régionale';
                        }elseif($users->roles == 6){
                            echo 'PDG';
                        } 
                    ?>
                </option>
                <option value="0">Membre</option>
                <option value="1">Receptionniste</option>
                <option value="2">Coach personnel</option>
                <option value="3">Manager</option>
                <option value="4">Directeur Franchisé</option>
                <option value="5">Directeur régionale</option>
                <option value="6">PDG</option>
            </select>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary" name="update">Modifier</button>
                <a class="btn btn-secondary" href="admin.php">Retour</a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../@/inc/footer.php'; ?>