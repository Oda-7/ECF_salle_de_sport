<?php $pageName = 'Panel PDG';

require_once '../../@/sys/functions.php';
require_once '../../@/sys/bd.php';
require_once '../../@/sys/roles.php';
require_once '../../@/sys/salles.php';

$req = $pdo->prepare('SELECT id, username, surname, email, age, roles,confirmed_at,salle_id,user_secret FROM users ORDER BY roles DESC');
$req->execute();
$users = $req->fetchAll();

include '../../@/inc/header.php';?>