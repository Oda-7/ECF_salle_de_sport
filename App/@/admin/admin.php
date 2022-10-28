<?php $pageName = 'Admin';

require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';

$req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at,salle_id FROM users');
$req->execute();
$users = $req->fetchAll();

//Ajout dun bouton pour ajouter un utilisateurs a la bd 
?>
<?php include '../../@/inc/header.php';?>

<p>Admin (FULL droit) meme ajouter un Admin après demande de validation (click,voir mot de passe privée)</p>

<div class="w-100 p-5 my-6 m-auto bg-light table-responsive">
<h1>Bonjour, <?= $_SESSION['auth']->username ?></h1>
<div class="d-flex justify-content-between">
<h4 class="mb-4">Voici la liste des employés :</h4>
<a class="btn btn-success my-2" href="/oda/App/@/admin/create.php">Créer un employé</a>
    </div>

    <table class="table align-middle ">

    <thead>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Adresse Email</th>
        <th>Age</th>
        <th>Roles</th>
        <th>E-mail confirmé</th>
        <th>Salle</th>
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
            <th>'
                . $post->salle_id .'
            </th>
            <th class="d-flex justify-content-around">
                    <a class="btn btn-warning my-2" href="/oda/App/@/admin/form.php?id=' . $post->id .'">Modifier</a>
                    <a class="btn btn-danger my-2" href="/oda/App/@/admin/delete.php?id=' . $post->id .'">Supprimer</a>                
            </th>
            </tbody>';
        }
        ?>
    </table>
</div>



<?php include '../../@/inc/footer.php'; ?>



