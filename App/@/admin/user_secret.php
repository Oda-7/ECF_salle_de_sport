<?php 
require_once '../../@/sys/bd.php';
require_once '../../@/sys/functions.php';
session_start();

$req = $pdo->prepare('SELECT id,surname,username FROM users');
$req->execute();
$users = $req->fetchAll();

if(isset($_POST['update'])){
    if(isset($_POST['select'])){
        $post = $_POST['select'];
        $req_update_new_admin = $pdo->prepare('UPDATE users SET user_secret = 7 WHERE id ="'.$post.'"');
        $req_update_new_admin->execute();
        $id_select = $_SESSION['auth']->id;
        $req_update_retired = $pdo->prepare('UPDATE users SET user_secret = 0 WHERE id ="'.$id_select.'"');
        $req_update_retired->execute();
        $_SESSION['flash']['success'] = "Vous avez bien donner tout vos droits !";
        header('Location: admin.php');
    }
} 

require_once '../../@/inc/header.php'; ?>

<?php 
if($_SESSION['auth']->user_secret):?>
    <div class="container mt-5">
        <form method="POST">
            <div class="form-group">
                <label>Voulez vous transferer tout les droit d'administration ? </label>
                <select class="form-select my-5" name="select" id="select">
                    <option selected> ---  --- </option>
                    <?php foreach($users as $user => $u){
                        echo '<option value="'.$u->id.'">'.$u->id.' - '.$u->username.' '.$u->surname.'</option>';
                    }?>
                </select>
            </div>  
            <div>
                <button class="btn btn-primary" name="update">Validé</button>
            </div>
        </form>
    </div>
<?php endif; ?>
