<?php $pageName = 'Suppression de l\'employé';
require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';

$user_id = $_GET['id'];

if(isset($_POST['valide'])){
    $req = $pdo->prepare('DELETE FROM users WHERE id="'.$user_id.'"');
    $req->execute();
    return header('Location: franchises.php');
} 

?>

<?php require_once '../../@/inc/header.php'; ?>

<div class="d-flex">
    <div class="p-5 my-6 m-auto bg-light rounded-3">
        <h1>Voulez vous vraiment supprimer cette utilisateur !</h1>
        <form action="" method="post">
            <button type="submit" name="valide" class="btn btn-danger">Validé</button>
            <a href="franchises.php" type="submit" name="annuler" class="btn btn-warning">Annuler</a>
        </form>
    </div>
</div>