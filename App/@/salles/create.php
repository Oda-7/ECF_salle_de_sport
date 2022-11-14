<?php $pageName = 'Ajout d\'une salle'; ?>
<?php
require_once '../sys/functions.php';
session_start();
require_once '../inc/header.php'; 

if(!empty($_POST)){
    $errors = array();

    require_once '../sys/bd.php';
    
    if(empty($_POST['name']) || !preg_match('/^[a-zA-Zéèàêâ+\s]+$/', $_POST['name'])){
        $errors['name'] = "Le nom de la salle n'est pas valide ou vide";
    }
    
    $_POST['name'] ='Fitness Core - '.$_POST['name'] ; 
    
    if(empty($_POST['adress']) || !preg_match('/^[a-zA-Zéèàêâ+\s\-0-9]+$/', $_POST['adress'])){
        $errors['adress'] = "L'adresse de la salle n'est pas valide ou vide";
    }

    if(empty($errors)){ 
        $req = $pdo->prepare("INSERT INTO salles SET name = ?,adress = ?, description = ?, name_img = ?, size = ?,type = ?, bin = ?");
        $req->execute([$_POST['name'],$_POST['adress'],$_POST['description'],$_FILES['images']['name'],$_FILES['images']['size'],$_FILES['images']['type'],file_get_contents($_FILES['images']['tmp_name'])]);
        header('Location: salle.php');
        exit();
    }
    
}

?>



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
        <h1>Ajouter une salle</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom de la salle</label>
                <input type="text" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adress" class="form-control" placeholder="Nom de la ville - Code postal - rue(facultatif)"/>
            </div>
            <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control"/>
            </div>
            <div class="mt-3">
                <input class="form-control mt-3" type="file" accept="image/png,image/jpg" name="images"><br>
                <button type="submit" class="btn btn-primary" name="update">Ajouter</button>
                <a class="btn btn-secondary" href="salle.php">Retour</a>
            </div>
        </form>
    </div>
</div>