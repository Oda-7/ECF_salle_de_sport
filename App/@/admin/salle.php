<?php $pageName = 'Salle partenaires/franchisés'; 

require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';

$req = $pdo->prepare('SELECT * FROM salles');
$req->execute();
$salles = $req->fetchAll();
?>

<?php include '../../@/inc/header.php';?>

<div class="mx-5">
<h1 class="my-4">Voici la liste des salles :</h1>
<?php foreach($salles as $salle => $key){
    echo '<div class="card flex-sm-row my-4 rounded-3" >
        <img class="card-img-left img-fluid rounded-3" src="/oda/App/public/assets/image/fitness-868415_960_720.jpg" alt="Card image cap" style="width:18rem" >
        <div class="card-body">
            <h5 class="card-title">'.$key->name.'</h5>
            <p class="card-text">'.$key->description.'</p>
            <p class="card-text">'.$key->adress.'</p>
        </div>
    </div>';
}
?>
</div>

<?php include '../../@/inc/footer.php'; ?>