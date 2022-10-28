<?php $pageName = 'Tableau de bord'; //franchisés

require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';
?>

<?php include '../../@/inc/header.php';?>

<?php 

if(!$_SESSION['auth']->roles > 5){
    $salle_id = $_SESSION['auth']->salle_id;
    $req_salle = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
    $req_salle->execute();
    $salle = $req_salle->fetch();
    $req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at FROM users WHERE salle_id = "'.$salle_id.'"');
    $req->execute();
    $users = $req->fetchAll();
}
$req_salle_option = $req = $pdo->prepare('SELECT id,name FROM salles');
$req_salle_option->execute();
$salles_id = $req_salle_option->fetchAll();

if(isset($_POST['salles'])){
    $salle_id = $_POST['salles'];
} else {
    $salle_id = 0;
}
$req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at FROM users WHERE salle_id = "'.$salle_id.'"');
$req->execute();
$users = $req->fetchAll();
?>

<p>Admin (FULL droit) meme ajouter un Admin après demande de validation (click,voir mot de passe privée)</p>

<div class="w-100 p-5 my-6 m-auto bg-light table-responsive rounded">
    <h1>Bonjour, <?= $_SESSION['auth']->username ?></h1>
<?php if($_SESSION['auth']->roles > 5): ?>
    <form method="post" class="">
    <label>Salles</label>
        <select class="form-select" name="salles" id="salles" class="d-flex">
            <?php 
                foreach($salles_id as $salle_id){
                    echo '<option value="'.$salle_id->id.'">'.$salle_id->name.'</option>';
                }
            ?>
        </select>
        <button type="submit" class="btn btn-primary my-3" name="update">Confirmer</button>
    </form>
<?php endif;?>
    <h3><?php 
        if($_SESSION['auth']->roles > 2){
            if(isset($_POST['salles'])){
                $req_salle = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$_POST['salles'].'"');
                $req_salle->execute();
                $salle = $req_salle->fetch();
                echo $salle->name;
            }
        }else{
            echo $salle->name ;
        }
    ?></h3>
    <div class="d-flex justify-content-between">
        <h4 class="mb-4">Voici la liste des employés de votre salle :</h4>
        <a class="btn btn-success my-2" href="#">Créer un employé</a>
    </div>
    <?php if($_SESSION['auth']->salle_id == null):?>
        <p> 'Vous n'etes lié a aucune salles pour le moment '</p>
    <?php else: ?>
    <table class="table align-middle ">
   
        <thead>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Adresse Email</th>
        <th>Age</th>
        <th>Roles</th>
        <th>E-mail confirmé</th>
        <th>Action</th>
        </thead> 
    <?php  
        
        foreach($users as $user => $post){
            echo '
            <tbody>
                <th>'
                    . $post->username .
                '</th>
                <th>'
                    . $post->surname .
                '</th>
                <th>'
                    . $post->email .
                '</th>
                <th>'
                    . $post->age .
                '</th>
                <th>'
                    . $post->roles .'
                </th>
                <th>'
                    . $post->confirmed_at .'
                </th>
                <th class="d-flex justify-content-around">
                    <!-- <a class="btn btn-warning my-2" href="/oda/App/@/admin/form.php?id=' . $post->id .'">Modifier</a>
                    <a class="btn btn-danger my-2" href="/oda/App/@/admin/delete.php?id=' . $post->id .'">Supprimer</a> -->
                </th>
            </tbody>';
        }
        ?>
    </table>
    <?php endif; ?>
</div>



<?php include '../../@/inc/footer.php'; ?>