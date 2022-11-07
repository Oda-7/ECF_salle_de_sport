<?php $pageName = 'Panel PDG';

if(!isset($_SESSION['auth'])){
    header('Location: /');
    exit();
}

require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';
require_once '../../@/sys/roles.php';
require_once '../../@/sys/salles.php';

$req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at,salle_id,user_secret FROM users ORDER BY roles DESC');
$req->execute();
$users = $req->fetchAll();

?>
<?php include '../../@/inc/header.php';?>

<div class="w-100 p-5 my-6 m-auto bg-light table-responsive rounded-3">
<h1>Bonjour, <?= $_SESSION['auth']->username ?></h1>
<div class="d-flex justify-content-between">
<h4 class="mb-4">Voici la liste des employés :</h4>
<a class="btn btn-success my-2" href="/App/@/admin/create.php">Créer un employé</a>
    </div>

    <table class="table align-middle">

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
        
        foreach($users as $user => $post): ?>
            <tbody>
                <?php echo '<th>'. $post->username .'</th>';
                echo '<th>'. $post->surname .'</th>';
                echo '<th>'. $post->email .'</th>';
                echo '<th>'. $post->age .'</th>';
                echo '<th>'. roles($post->roles).'</th>';
                echo '<th>'. $post->confirmed_at .'</th>';
                echo '<th>'. fetchSalleName($post->salle_id) .'</th>';
                echo '<th >
                    <div class="d-flex justify-content-around">';
                    if($post->user_secret != 7){
                        echo'<a class="btn btn-warning my-2 mx-2" href="/App/@/admin/form.php?id=' . $post->id .'&salle_id='.$post->salle_id.'">Modifier</a>';
                        if($post->roles = 6 || $post->roles = 4){
                            echo '<a class="btn btn-danger my-2 mx-2" href="/App/@/admin/delete.php?id=' . $post->id .'">Supprimer</a>  ';
                        }
                    }else{
                        echo'<p>Aucune action</p><br><p></p>';
                    }
                    echo '</div>
                </th>';
            ?></tbody>
        <?php endforeach;?>
    </table>
</div>

<?php include '../../@/inc/footer.php'; ?>

