<?php $pageName = 'Tableau de bord'; //franchisés

require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';
require_once '../../@/sys/roles.php';
?>

<?php include '../../@/inc/header.php';?>

<?php 

$salle_id = $_SESSION['auth']->salle_id;
if(!$_SESSION['auth']->roles > 5){
    $req_salle = $pdo->prepare('SELECT name FROM salles WHERE id = "'.$salle_id.'"');
    $req_salle->execute();
    $salle = $req_salle->fetch();
    $req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at,salle_id FROM users WHERE salle_id = "'.$salle_id.'"');
    $req->execute();
    $users = $req->fetchAll();
}
$req_salle_option = $req = $pdo->prepare('SELECT id,name FROM salles');
$req_salle_option->execute();
$salles_id = $req_salle_option->fetchAll();

if(isset($_POST['salles'])){
    $salle_id = $_POST['salles'];
} 

$req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at FROM users WHERE salle_id = "'.$salle_id.'"');
$req->execute();
$users = $req->fetchAll();
?>

<div class="w-100 p-5 my-6 m-auto bg-light table-responsive rounded h-100">
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
        } else {
            echo $salle->name ;
        }
    ?></h3>
    <div class="d-flex justify-content-between">
        <h4 class="mb-4">Voici la liste des employés de votre salle :</h4>
        <?php
            if($_SESSION['auth']->roles == 6 ){
                if(isset($_POST['salles'])){
                    echo'<a class="btn btn-success my-2" href="/App/@/franchises/create.php?salle_id='.$_POST['salles'].'">Ajouter un employé</a>'; 
                }
            }else{
                echo'<a class="btn btn-success my-2" href="/App/@/franchises/create.php?salle_id='.$_SESSION['auth']->salle_id.'">Ajouter un employé</a>'; 
            }
        ?>
    </div>
    <?php if(!isset($salle_id)):?>
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
                <th>'. $post->username .'</th>
                <th>'. $post->surname .'</th>
                <th>'. $post->email .'</th>
                <th>'. $post->age .'</th>
                <th>'. roles($post->roles) .'</th>
                <th>'. $post->confirmed_at .'</th>
                <th class="d-flex justify-content-around">
                <div> ';
                if($post->roles < 4 || $_SESSION['auth']->roles == 6){
                    echo '
                    <a class="btn btn-warning my-2 mx-2" href="/App/@/franchises/form_franchises.php?id=' . $post->id .'">Modifier</a>
                    <a class="btn btn-danger my-2 mx-2" href="/App/@/franchises/delete.php?id=' . $post->id .'">Supprimer</a>
                ';
                }else{
                    echo'<p>Aucune action</p><br><p></p>';
                }
                echo '</div>
                </th>
            </tbody>';
        }
        ?>
    </table>
    <?php endif; ?>
</div>



<?php include '../../@/inc/footer.php'; ?>