<?php $pageName = 'Suppression de l\'employé';
require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';

$user_id = $_GET['id'];
$user_roles = $_GET['roles'];
debug($user_roles);
if(isset($_POST['valide'])){
    $req = $pdo->prepare('UPDATE users SET roles = ? WHERE id = "'.$user_id.'"');
    $req->execute([$user_roles]);

    return header('Location: admin.php');
} 


?>

<?php require_once '../../@/inc/header.php'; ?>

<div class="d-flex">
    <div class="p-5 my-6 m-auto bg-light rounded-3">
        <h1>Voules vous confirmer le role PDG ? </h1>
        <form action="" method="post">
            <button type="submit" name="valide" class="btn btn-success">Validé</button>
            <?php echo '<a type="submit" name="annuler" class="btn btn-warning" href="form.php?id='.$user_id.'">Annuler</a>'; ?>
        </form>
    </div>
</div>