<?php 
$pageName = 'Salle partenaires'; 
include '../inc/header.php';

if(empty($_SESSION['auth'])){
    header('Location: /');
    exit();
}
require_once '../sys/functions.php';
?>

<div class="mx-5">
    <div>
        <h1 class="my-4">Voici la liste des salles :</h1>
        <a class="btn btn-success my-2" href="/App/@/salles/create.php">Ajouter une salle</a>
        
    </div>
<?php
    require_once '../sys/bd.php';
    $req = $pdo->prepare('SELECT * FROM salles');
    $req->execute();
    $salles = $req->fetchAll();

    foreach($salles as $salle => $key){
        echo '<div class="card flex-sm-row my-4 rounded-3" >
            <img class="card-img-left img-fluid rounded-3" src="export.php?id='.$key->id.'" alt="Card image cap" style="width:18rem">
            <div class="card-body">
                <h5 class="card-title">'.$key->name.'</h5>
                <p class="card-text">'.$key->description.'</p>
                <p class="card-text">'.$key->adress.'</p>
                <a class="btn btn-danger my-2" href="/App/@/salles/delete.php?id='.$key->id.'">Supprimer une salle</a>
            </div>
        </div>';
    }
    ?>
</div>

<?php include '../inc/footer.php'; ?>