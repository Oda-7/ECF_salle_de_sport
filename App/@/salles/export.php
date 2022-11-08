<?php 

require_once '../sys/functions.php';
require_once '../sys/bd.php';

$req = $pdo->prepare('SELECT name_img,size,type,bin FROM salles WHERE id = ?');
$req->setFetchMode(PDO::FETCH_ASSOC);
$req->execute(array($_GET["id"]));
$tab = $req->fetchAll();
echo $tab[0]['bin'];
?>